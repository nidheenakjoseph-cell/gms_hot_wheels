<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Financial_year_model extends CI_Model
{
    public function get_company_id()
    {
		return get_current_company_id();
    }

    public function get_financial_year_by_date($date, $company_id = null)
    {
        $company_id = $company_id ?: $this->get_company_id();
        $date = date('Y-m-d', strtotime($date));

        $year = $this->db
            ->where('company_id', (int) $company_id)
            ->where('start_date <=', $date)
            ->where('end_date >=', $date)
            ->order_by('start_date', 'DESC')
            ->get('financial_years')->row();

        if ($year) {
            return $year;
        }

        return $this->db
            ->select('fy.*')
            ->from('financial_years fy')
            ->join('financial_year_extensions fye', 'fye.financial_year_id = fy.id AND fye.company_id = fy.company_id')
            ->where('fy.company_id', (int) $company_id)
            ->where('fy.start_date <=', $date)
            ->where('fye.status', 'APPROVED')
            ->where('fye.extended_to >=', $date)
            ->order_by('fy.start_date', 'DESC')
            ->get()
            ->row();
    }

    public function get_years($company_id = null)
    {
        return $this->db
            ->select('fy.*, u.username AS closed_by_name')
            ->from('financial_years fy')
            ->join('users u', 'u.id = fy.closed_by', 'left')
            ->where('fy.company_id', (int) ($company_id ?: $this->get_company_id()))
            ->order_by('start_date', 'DESC')
            ->get()
            ->result();
    }

    public function get_extension_requests($company_id = null)
    {
        return $this->db
            ->select('fye.*, fy.year_name, u.username AS requested_by_name, a.username AS approved_by_name')
            ->from('financial_year_extensions fye')
            ->join('financial_years fy', 'fy.id = fye.financial_year_id', 'left')
            ->join('users u', 'u.id = fye.requested_by', 'left')
            ->join('users a', 'a.id = fye.approved_by', 'left')
            ->where('fye.company_id', (int) ($company_id ?: $this->get_company_id()))
            ->order_by('fye.created_at', 'DESC')
            ->get()
            ->result();
    }

    public function validate_close($financial_year_id)
    {
        $year = $this->db
            ->where('id', (int) $financial_year_id)
            ->where('company_id', $this->get_company_id())
            ->get('financial_years')->row();
        if (!$year) {
            return ['valid' => false, 'message' => 'Financial Year not found.'];
        }

        $this->load->model('Accounts_model');
        $trial_balance = $this->Accounts_model->get_account_trial_balance($year->start_date, $year->end_date);
        $debit = 0;
        $credit = 0;
        foreach ($trial_balance as $row) {
            $debit += (float) $row['debit'];
            $credit += (float) $row['credit'];
        }
        if (round($debit, 2) !== round($credit, 2)) {
             return ['valid' => false, 'message' => 'Trial Balance is not balanced.'];
        }

        $tree = $this->Accounts_model->prepare_balance_sheet($year->end_date);
        $profit = $this->Accounts_model->get_profit_loss($year->start_date, $year->end_date);
        $this->Accounts_model->add_profit_to_capital($tree, -$profit);
        $this->Accounts_model->calculate_totals($tree);
        $assets = 0;
        $liabilities = 0;
        foreach ($tree as $group) {
            $name = strtolower(trim($group->group_name));
            if ($name === 'assets') {
                $assets += (float) $group->balance;
            } elseif ($name === 'liabilities' || $name === 'capital account' || $name === 'equity') {
                $liabilities += (float) $group->balance;
            }
        }
        if (round($assets, 2) !== round($liabilities, 2)) {
             return ['valid' => false, 'message' => 'Balance Sheet does not balance.'];
        }

        return ['valid' => true, 'message' => 'Financial Year is ready to close.'];
    }

    public function is_financial_year_open($date, $company_id = null)
    {
        $year = $this->get_financial_year_by_date($date, $company_id);
        if (!$year) {
            return false;
        }

        if ($year->status === 'OPEN') {
            return true;
        }

        if ($year->status === 'EXTENDED' && !empty($year->extended_to)) {
            return $date <= $year->extended_to;
        }

        $extension = $this->db
            ->where('financial_year_id', (int) $year->id)
            ->where('company_id', (int) ($company_id ?: $this->get_company_id()))
            ->where('status', 'APPROVED')
            ->where('extended_to >=', date('Y-m-d', strtotime($date)))
            ->order_by('extended_to', 'DESC')
            ->get('financial_year_extensions')
            ->row();

        return (bool) $extension;
    }

    public function assert_transaction_date_open($date, $company_id = null)
    {
        $year = $this->get_financial_year_by_date($date, $company_id);
        if (!$year) {
            throw new RuntimeException('No Financial Year exists for transaction date ' . date('d-M-Y', strtotime($date)) . '.');
        }

        if (!$this->is_financial_year_open($date, $company_id)) {
            throw new RuntimeException('Financial Year ' . $year->year_name . ' is closed. This transaction cannot be modified.');
        }

        return $year;
    }

    /**
     * Legacy simple close — kept for backward compatibility but now delegates
     * to close_year_with_jv() when called without a retained-earnings account.
     * Direct callers should use close_year_with_jv() instead.
     */
    public function close_year($financial_year_id, $reason, $user_id)
    {
        return $this->close_year_with_jv($financial_year_id, null, $reason, $user_id);
    }

    // =========================================================================
    // UAE YEAR-END CLOSING — CORE METHODS
    // =========================================================================

    /**
     * Full UAE-compliant year-end closing process:
     *  1. Validates year is open and trial balance is balanced.
     *  2. Fetches net balance for every P&L account over the FY period.
     *  3. Builds a balanced YEC Journal Voucher:
     *       - Debit each Income account  (Credit balance → zero it out)
     *       - Credit each Expense account (Debit balance → zero it out)
     *       - Transfer net result to the Retained Earnings ledger
     *  4. Inserts YEC lines with is_year_end_jv = 1 (protected from edit/delete).
     *  5. Updates financial_years: CLOSED + closing_jv_code + net_profit_loss.
     *  6. Writes audit log to financial_year_closing_log.
     *  Everything runs inside a single DB transaction.
     *
     * @param int      $financial_year_id
     * @param int|null $retained_earnings_account_id  GL account to receive net P&L
     * @param string   $reason
     * @param int      $user_id
     * @return array   ['success' => bool, 'message' => string]
     */
    public function close_year_with_jv($financial_year_id, $retained_earnings_account_id, $reason, $user_id)
    {
        $company_id = $this->get_company_id();

        // ── 1. Load & validate year ──────────────────────────────────────────
        $year = $this->db
            ->where('id', (int) $financial_year_id)
            ->where('company_id', $company_id)
            ->get('financial_years')->row();

        if (!$year) {
            return ['success' => false, 'message' => 'Financial Year not found.'];
        }
        if ($year->status === 'CLOSED') {
            return ['success' => false, 'message' => 'Financial Year is already closed.'];
        }
        if ($this->is_tax_finalized($financial_year_id)) {
            return ['success' => false, 'message' => 'Financial Year cannot be closed because Corporate Tax has been finalized.'];
        }

        // ── 2. Validate trial balance ─────────────────────────────────────────
        $this->load->model('Accounts_model');
        $trial_balance = $this->Accounts_model->get_account_trial_balance($year->start_date, $year->end_date);
        $tb_debit  = 0;
        $tb_credit = 0;
        foreach ($trial_balance as $row) {
            $tb_debit  += (float) $row['debit'];
            $tb_credit += (float) $row['credit'];
        }
        if (round($tb_debit, 2) !== round($tb_credit, 2)) {
            return ['success' => false, 'message' =>
                'Trial Balance is not balanced (Dr ' . number_format($tb_debit, 2) .
                ' ≠ Cr ' . number_format($tb_credit, 2) . '). Please resolve before closing.'];
        }

        // ── 3. Get P&L account balances ──────────────────────────────────────
        $pnl_accounts = $this->get_pnl_accounts_for_closing($year->start_date, $year->end_date);

        if (empty($pnl_accounts)) {
            return ['success' => false, 'message' => 'No Income or Expense transactions found for this Financial Year.'];
        }

        // ── 4. Build the closing JV lines ────────────────────────────────────
        //
        //  Accounting convention (double-entry):
        //   Income accounts carry a net CREDIT balance → Debit them to zero
        //   Expense accounts carry a net DEBIT  balance → Credit them to zero
        //   Net Profit (Income > Expense) → Credit Retained Earnings
        //   Net Loss   (Expense > Income) → Debit  Retained Earnings
        //
        $jv_lines    = [];
        $net_income  = 0.0;   // sum of income account credits
        $net_expense = 0.0;   // sum of expense account debits

        foreach ($pnl_accounts as $acc) {
            $net_balance = (float) $acc->net_balance;   // positive = net Dr, negative = net Cr

            if ($acc->account_type === 'INCOME') {
                // Income balance is Dr - Cr. Preserve the sign for abnormal debit balances.
                $credit_amount = abs($net_balance);
                if ($credit_amount < 0.005) continue;
                $jv_lines[] = [
                    'account_id'   => (int) $acc->account_id,
                    'account_name' => $acc->account_name,
                    'drcr_type'    => $net_balance < 0 ? 'Dr' : 'Cr',
                    'amount'       => round($credit_amount, 3),
                ];
                $net_income -= $net_balance;

            } elseif ($acc->account_type === 'EXPENSE') {
                // Expense balance is Dr - Cr. Preserve the sign for abnormal credit balances.
                $debit_amount = abs($net_balance);
                if ($debit_amount < 0.005) continue;
                $jv_lines[] = [
                    'account_id'   => (int) $acc->account_id,
                    'account_name' => $acc->account_name,
                    'drcr_type'    => $net_balance > 0 ? 'Cr' : 'Dr',
                    'amount'       => round($debit_amount, 3),
                ];
                $net_expense += $net_balance;
            }
        }

        if (empty($jv_lines)) {
            return ['success' => false, 'message' => 'No non-zero P&L balances found to close.'];
        }

        // Net Profit/Loss: positive = profit, negative = loss
        $net_profit_loss = round($net_income - $net_expense, 2);

        // Transfer to Retained Earnings (if account specified)
        if ($retained_earnings_account_id) {
            if ($net_profit_loss >= 0) {
                // Profit → Credit Retained Earnings
                $jv_lines[] = [
                    'account_id'   => (int) $retained_earnings_account_id,
                    'account_name' => 'Retained Earnings',
                    'drcr_type'    => 'Cr',
                    'amount'       => round(abs($net_profit_loss), 3),
                ];
            } else {
                // Loss → Debit Retained Earnings
                $jv_lines[] = [
                    'account_id'   => (int) $retained_earnings_account_id,
                    'account_name' => 'Retained Earnings',
                    'drcr_type'    => 'Dr',
                    'amount'       => round(abs($net_profit_loss), 3),
                ];
            }
        }

        // ── 5. Verify the JV is balanced ─────────────────────────────────────
        $jv_dr = 0.0;
        $jv_cr = 0.0;
        foreach ($jv_lines as $line) {
            if ($line['drcr_type'] === 'Dr') $jv_dr += (float) $line['amount'];
            else                              $jv_cr += (float) $line['amount'];
        }
        if (abs(round($jv_dr, 2) - round($jv_cr, 2)) > 0.02) {
            return ['success' => false, 'message' =>
                'Year-End Closing JV is not balanced (Dr ' . number_format($jv_dr, 2) .
                ' ≠ Cr ' . number_format($jv_cr, 2) . '). Please check P&L accounts.'];
        }

        // ── 6. Generate unique YEC voucher code ──────────────────────────────
        $code_prefix = 'YEC/' . date('y') . '/';
        $existing = $this->db
            ->query("SELECT COALESCE(MAX(CAST(SUBSTR(voucher_code, " . (strlen($code_prefix) + 1) . ") AS UNSIGNED)), 0) AS cnt
                       FROM voucher_transaction WHERE voucher_code LIKE '" . $code_prefix . "%'")
            ->row()->cnt;
        $jv_code = $code_prefix . sprintf('%05d', (int) $existing + 1);

        $closing_date = $year->end_date;           // JV dated on the last day of the FY
        $narration    = 'Year-End Closing Entry — ' . $year->year_name . '. ' . $reason;
        $now          = date('Y-m-d H:i:s');

        // ── 7. Insert JV lines (inside a transaction) ────────────────────────
        $this->db->trans_start();

        $this->load->helper('branch');
        $branch_id = get_primary_branch_id();

        foreach ($jv_lines as $line) {
            if ($line['amount'] < 0.005) continue;
            $this->db->insert('voucher_transaction', [
                'voucher_code'       => $jv_code,
                'voucher_date'       => $closing_date . ' 23:59:59',
                'voucher_type'       => 'YEC',
                'account_id'         => $line['account_id'],
                'amount'             => $line['amount'],
                'drcr_type'          => $line['drcr_type'],
                'narration'          => $narration,
                'trans_type'         => 'YEC',
                'cancel'             => 0,
                'is_year_end_jv'     => 1,
                'financial_year_id'  => (int) $financial_year_id,
                'recordCreatedBy'    => (int) $user_id,
                'branch_id'          => $branch_id,
            ]);
        }

        // ── 8. Update financial_years ─────────────────────────────────────────
        $this->db->where('id', (int) $financial_year_id)->update('financial_years', [
            'status'                        => 'CLOSED',
            'closed_at'                     => $now,
            'closed_by'                     => (int) $user_id,
            'close_reason'                  => $reason,
            'closing_jv_code'               => $jv_code,
            'net_profit_loss'               => $net_profit_loss,
            'retained_earnings_account_id'  => $retained_earnings_account_id ? (int) $retained_earnings_account_id : null,
            'updated_at'                    => $now,
        ]);

        // ── 9. Write audit trail ─────────────────────────────────────────────
        $this->db->insert('financial_year_closing_log', [
            'financial_year_id'             => (int) $financial_year_id,
            'company_id'                    => $company_id,
            'action'                        => 'CLOSED',
            'closing_jv_code'               => $jv_code,
            'net_profit_loss'               => $net_profit_loss,
            'retained_earnings_account_id'  => $retained_earnings_account_id ? (int) $retained_earnings_account_id : null,
            'performed_by'                  => (int) $user_id,
            'reason'                        => $reason,
            'performed_at'                  => $now,
        ]);

        $this->db->trans_complete();

        if (!$this->db->trans_status()) {
            return ['success' => false, 'message' => 'Financial Year could not be closed. Database error during JV creation.'];
        }

        $this->load->helper('log');
        add_log_entry($user_id, 1, 'Accounts/close_financial_year', 'financial_years', 'id', $financial_year_id);

        return [
            'success'          => true,
            'message'          => 'Financial Year "' . $year->year_name . '" closed successfully. Closing JV: ' . $jv_code . '. Net ' . ($net_profit_loss >= 0 ? 'Profit' : 'Loss') . ': AED ' . number_format(abs($net_profit_loss), 2),
            'jv_code'          => $jv_code,
            'net_profit_loss'  => $net_profit_loss,
        ];
    }

    /**
     * Fetches all P&L account balances for the given period.
     * Returns objects with: account_id, account_name, account_type (INCOME|EXPENSE),
     *                       net_balance (positive = net Dr, negative = net Cr)
     *
     * Income  accounts: parent_group = 3 (root "Income/Revenue")
     * Expense accounts: parent_group = 4 (root "Expense")
     * Consistent with get_income() / get_expense() in Accounts_model.
     *
     * @param  string $from_date  Y-m-d
     * @param  string $to_date    Y-m-d
     * @return array
     */
    public function get_pnl_accounts_for_closing($from_date, $to_date)
    {
        $this->load->helper('branch');
        $branch_condition = '';
        $selected_branches = get_selected_branch_ids();
        if ($selected_branches !== 'all' && is_array($selected_branches) && !empty($selected_branches)) {
            $branch_ids = array_map('intval', $selected_branches);
            $branch_condition = count($branch_ids) === 1
                ? ' AND vt.branch_id = ' . $branch_ids[0]
                : ' AND vt.branch_id IN (' . implode(',', $branch_ids) . ')';
        }

        $sql = "
            SELECT
                gl.account_id,
                gl.account_name,
                ag.group_no,
                ag.parent_group,
                CASE
                    WHEN ag.group_no IN (
                        SELECT group_no FROM account_group WHERE parent_group = 3
                    ) AND gl.account_id <> 1122 THEN 'INCOME'
                    WHEN (
                        ag.group_no IN (
                        SELECT group_no FROM account_group WHERE parent_group = 4
                        ) OR gl.account_id = 1122
                    ) THEN 'EXPENSE'
                    ELSE NULL
                END AS account_type,
                COALESCE(
                    SUM(CASE WHEN vt.drcr_type = 'Dr' THEN vt.amount
                             WHEN vt.drcr_type = 'Cr' THEN -vt.amount
                             ELSE 0 END),
                    0
                ) AS net_balance
            FROM general_ledger gl
            JOIN account_group ag        ON ag.group_no  = gl.group_no
            JOIN account_group ag_root   ON ag_root.group_no = (
                SELECT CASE WHEN ag2.parent_group = 0 THEN ag2.group_no
                            ELSE ag2.parent_group END
                FROM account_group ag2
                WHERE ag2.group_no = ag.group_no
                LIMIT 1
            )
            LEFT JOIN voucher_transaction vt
                   ON vt.account_id = gl.account_id
                  AND vt.cancel = 0
                  AND DATE(vt.voucher_date) BETWEEN ? AND ?
                  AND (vt.is_year_end_jv = 0 OR vt.is_year_end_jv IS NULL)
                {$branch_condition}
            WHERE ag.pandl = 1
            GROUP BY gl.account_id, gl.account_name, ag.group_no, ag.parent_group, ag_root.parent_group
            HAVING account_type IS NOT NULL
            ORDER BY account_type, gl.account_name
        ";
        return $this->db->query($sql, [$from_date, $to_date])->result();
    }

    /**
     * Returns the closing audit log for a given financial year.
     *
     * @param  int $financial_year_id
     * @return array
     */
    public function get_closing_log($financial_year_id)
    {
        return $this->db
            ->select('log.*, u.username AS performed_by_name, gl.account_name AS retained_account_name')
            ->from('financial_year_closing_log log')
            ->join('users u', 'u.id = log.performed_by', 'left')
            ->join('general_ledger gl', 'gl.account_id = log.retained_earnings_account_id', 'left')
            ->where('log.financial_year_id', (int) $financial_year_id)
            ->where('log.company_id', $this->get_company_id())
            ->order_by('log.performed_at', 'DESC')
            ->get()
            ->result();
    }

    public function request_extension($financial_year_id, $extended_to, $reason, $user_id)
    {
        $year = $this->db
            ->where('id', (int) $financial_year_id)
            ->where('company_id', $this->get_company_id())
            ->get('financial_years')->row();
        if (!$year || $year->status !== 'CLOSED') {
            return ['success' => false, 'message' => 'Only a closed Financial Year can be extended.'];
        }
        if ($extended_to <= $year->end_date) {
            return ['success' => false, 'message' => 'Extension date must be after the original year end date.'];
        }

        // Block extension requests if corporate tax has been finalized
        if ($this->is_tax_finalized($financial_year_id)) {
            return [
                'success' => false,
                'message' => 'Financial Year cannot be extended because Corporate Tax has been finalized.'
            ];
        }

        $this->db->insert('financial_year_extensions', [
            'financial_year_id' => $year->id,
            'company_id' => $year->company_id,
            'original_end_date' => $year->end_date,
            'extended_to' => $extended_to,
            'reason' => $reason,
            'requested_by' => (int) $user_id,
            'status' => 'REQUESTED',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $this->load->helper('log');
        add_log_entry($user_id, 1, 'Accounts/request_financial_year_extension', 'financial_year_extensions', 'id', $this->db->insert_id());
        return ['success' => true, 'message' => 'Extension request submitted.'];
    }

    public function decide_extension($extension_id, $status, $user_id)
    {
        if (!in_array($status, ['APPROVED', 'REJECTED'], true)) {
            return ['success' => false, 'message' => 'Invalid extension decision.'];
        }

        $extension = $this->db
            ->where('id', (int) $extension_id)
            ->where('company_id', $this->get_company_id())
            ->get('financial_year_extensions')->row();
        if (!$extension || $extension->status !== 'REQUESTED') {
            return ['success' => false, 'message' => 'Extension request is not available.'];
        }

        // Block approval if corporate tax has already been finalized for this year
        if ($status === 'APPROVED' && $this->is_tax_finalized($extension->financial_year_id)) {
            return [
                'success' => false,
                'message' => 'Extension cannot be approved because Corporate Tax has been finalized for this Financial Year.'
            ];
        }

        $this->db->where('id', (int) $extension_id)->update('financial_year_extensions', [
            'status' => $status,
            'approved_by' => (int) $user_id,
            'approved_at' => date('Y-m-d H:i:s')
        ]);

        if ($status === 'APPROVED') {
            $this->db->where('id', (int) $extension->financial_year_id)->update('financial_years', [
                'status' => 'EXTENDED',
                'extended_from' => $extension->original_end_date,
                'extended_to' => $extension->extended_to,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        $this->load->helper('log');
        add_log_entry($user_id, 1, 'Accounts/decide_financial_year_extension', 'financial_year_extensions', 'id', $extension_id);
        return ['success' => true, 'message' => 'Extension request ' . strtolower($status) . '.'];
    }
    public function add_financial_year($data)
    {
        $company_id = isset($data['company_id'])
            ? (int) $data['company_id']
            : $this->get_company_id();

        $start_date = date('Y-m-d', strtotime($data['start_date']));
        $end_date   = date('Y-m-d', strtotime($data['end_date']));

        // Validate date range
        if ($start_date >= $end_date) {
            return [
                'success' => false,
                'message' => 'Start Date must be before End Date.'
            ];
        }

        // Check overlapping financial year
        $overlap = $this->db
            ->where('company_id', $company_id)
            ->where('start_date <=', $end_date)
            ->where('end_date >=', $start_date)
            ->count_all_results('financial_years');

        if ($overlap > 0) {
            return [
                'success' => false,
                'message' => 'The selected dates overlap with an existing Financial Year.'
            ];
        }

        // Insert Financial Year
        $insert_data = [
            'company_id' => $company_id,
            'year_name'  => trim($data['year_name']),
            'start_date' => $start_date,
            'end_date'   => $end_date,
            'status'     => 'OPEN',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->trans_start();

        $this->db->insert('financial_years', $insert_data);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        if (!$this->db->trans_status() || !$insert_id) {
            return [
                'success' => false,
                'message' => 'Financial Year could not be created.'
            ];
        }

        return [
            'success' => true,
            'message' => 'Financial Year created successfully.',
            'id'      => $insert_id
        ];
    }

    /**
     * Returns true if the given financial year has a finalized (or filed)
     * corporate tax calculation, meaning the year is permanently locked.
     */
    public function is_tax_finalized($financial_year_id)
    {
        $count = $this->db
            ->where('company_id', $this->get_company_id())
            ->where('financial_year_id', (int) $financial_year_id)
            ->where_in('status', ['FINALIZED', 'FILED'])
            ->count_all_results('corporate_tax_calculations');

        return $count > 0;
    }

    /**
     * Reopen a closed Financial Year.
     * Voids (cancel = 1) the Year-End Closing JV so it no longer affects
     * account balances, then restores status to OPEN.
     * The original JV lines are preserved for the audit trail.
     *
     * @param  int $financial_year_id
     * @param  int $user_id
     * @return array
     */
    public function reopen_year($financial_year_id, $user_id)
    {
        $company_id = $this->get_company_id();

        $year = $this->db
            ->where('id', (int) $financial_year_id)
            ->where('company_id', $company_id)
            ->get('financial_years')->row();

        if (!$year) {
            return ['success' => false, 'message' => 'Financial Year not found.'];
        }
        if ($year->status !== 'CLOSED') {
            return ['success' => false, 'message' => 'Only a closed Financial Year can be reopened.'];
        }

        // Permanently lock the year if corporate tax has been finalized
        if ($this->is_tax_finalized($financial_year_id)) {
            return [
                'success' => false,
                'message' => 'Financial Year cannot be reopened because Corporate Tax has been finalized.'
            ];
        }

        $now = date('Y-m-d H:i:s');

        $this->db->trans_start();

        // Void the Year-End Closing JV (set cancel = 1) so it no longer
        // affects account balances. The rows are NOT deleted — audit trail preserved.
        if (!empty($year->closing_jv_code)) {
            $this->db
                ->where('voucher_code', $year->closing_jv_code)
                ->where('is_year_end_jv', 1)
                ->update('voucher_transaction', [
                    'cancel' => 1,
                ]);
        }

        // Restore Financial Year to OPEN
        $this->db->where('id', (int) $financial_year_id)->update('financial_years', [
            'status'           => 'OPEN',
            'closed_at'        => null,
            'closed_by'        => null,
            'close_reason'     => null,
            'closing_jv_code'  => null,
            'net_profit_loss'  => null,
            'retained_earnings_account_id' => null,
            'updated_at'       => $now,
        ]);

        // Write reopen audit entry
        $this->db->insert('financial_year_closing_log', [
            'financial_year_id'  => (int) $financial_year_id,
            'company_id'         => $company_id,
            'action'             => 'REOPENED',
            'closing_jv_code'    => $year->closing_jv_code ?? null,
            'net_profit_loss'    => $year->net_profit_loss ?? null,
            'performed_by'       => (int) $user_id,
            'reason'             => 'Year reopened for corrections. Previous closing JV voided.',
            'performed_at'       => $now,
        ]);

        // Remove extension requests (year is back to open, they are moot)
        $this->db->where('financial_year_id', (int) $financial_year_id)->delete('financial_year_extensions');

        $this->db->trans_complete();

        if (!$this->db->trans_status()) {
            return ['success' => false, 'message' => 'Financial Year could not be reopened.'];
        }

        $this->load->helper('log');
        add_log_entry($user_id, 1, 'Accounts/reopen_financial_year', 'financial_years', 'id', $financial_year_id);
        return [
            'success' => true,
            'message' => 'Financial Year reopened successfully. The previous Closing JV (' .
                         ($year->closing_jv_code ?? 'N/A') . ') has been voided. Please re-close after corrections.',
        ];
    }
}

