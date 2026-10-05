<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Corporate_tax_model extends CI_Model
{
    private function company_id()
    {
		return get_current_company_id();
    }

    public function get_calculation($financial_year_id)
    {
        return $this->db
            ->where('company_id', $this->company_id())
            ->where('financial_year_id', (int) $financial_year_id)
            ->order_by('id', 'DESC')
            ->get('corporate_tax_calculations')
            ->row();
    }

    public function get_adjustments($financial_year_id)
    {
        return $this->db
            ->where('company_id', $this->company_id())
            ->where('financial_year_id', (int) $financial_year_id)
            ->order_by('id', 'DESC')
            ->get('corporate_tax_adjustments')
            ->result();
    }

    public function add_adjustment($data)
    {
        $financial_year_id = (int) ($data['financial_year_id'] ?? 0);
        $calculation = $this->get_calculation($financial_year_id);
        if ($calculation && in_array($calculation->status, ['FINALIZED', 'FILED'], true)) {
            return ['success' => false, 'message' => 'Finalized Corporate Tax cannot be changed.'];
        }

        $year = $this->db
            ->where('id', $financial_year_id)
            ->where('company_id', $this->company_id())
            ->get('financial_years')->row();
        if (!$year) {
            return ['success' => false, 'message' => 'Financial Year not found.'];
        }

        if (!$calculation) {
            $this->db->insert('corporate_tax_calculations', [
                'company_id' => $this->company_id(),
                'financial_year_id' => $financial_year_id,
                'status' => 'DRAFT',
                'created_by' => (int) $this->session->userdata('user_id'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $calculation = $this->get_calculation($financial_year_id);
        }
        $data['corporate_tax_calculation_id'] = (int) $calculation->id;

        $data['company_id'] = $this->company_id();
        $data['created_by'] = (int) $this->session->userdata('user_id');
        $data['created_at'] = date('Y-m-d H:i:s');
        $success = $this->db->insert('corporate_tax_adjustments', $data);
        if ($success) {
            $this->calculate($financial_year_id, (float) ($calculation->tax_loss_brought_forward ?? 0));
        }
        return [
            'success' => $success,
            'message' => $success ? 'Tax adjustment added.' : 'Tax adjustment could not be added.'
        ];
    }

    public function update_adjustment($adjustment_id, $data)
    {
        $adjustment = $this->db
            ->where('id', (int) $adjustment_id)
            ->where('company_id', $this->company_id())
            ->get('corporate_tax_adjustments')->row();
        if (!$adjustment) return ['success' => false, 'message' => 'Tax adjustment not found.'];
        $calculation = $this->get_calculation($adjustment->financial_year_id);
        if ($calculation && in_array($calculation->status, ['FINALIZED', 'FILED'], true)) {
            return ['success' => false, 'message' => 'Finalized Corporate Tax cannot be changed.'];
        }

        $this->db->where('id', (int) $adjustment_id)->where('company_id', $this->company_id())->update('corporate_tax_adjustments', [
            'adjustment_type' => $data['adjustment_type'],
            'description' => $data['description'],
            'accounting_amount' => $data['accounting_amount'],
            'tax_adjustment' => $data['tax_adjustment'],
            'adjustment_direction' => $data['adjustment_direction'],
            'source_account_id' => $data['source_account_id']
        ]);
        $this->calculate($adjustment->financial_year_id, (float) ($calculation->tax_loss_brought_forward ?? 0));
        return ['success' => true, 'message' => 'Tax adjustment updated.'];
    }

    public function delete_adjustment($adjustment_id)
    {
        $adjustment = $this->db
            ->where('id', (int) $adjustment_id)
            ->where('company_id', $this->company_id())
            ->get('corporate_tax_adjustments')->row();
        if (!$adjustment) return ['success' => false, 'message' => 'Tax adjustment not found.'];
        $calculation = $this->get_calculation($adjustment->financial_year_id);
        if ($calculation && in_array($calculation->status, ['FINALIZED', 'FILED'], true)) {
            return ['success' => false, 'message' => 'Finalized Corporate Tax cannot be changed.'];
        }

        $this->db->where('id', (int) $adjustment_id)->where('company_id', $this->company_id())->delete('corporate_tax_adjustments');
        $this->calculate($adjustment->financial_year_id, (float) ($calculation->tax_loss_brought_forward ?? 0));
        return ['success' => true, 'message' => 'Tax adjustment deleted.'];
    }

    public function calculate($financial_year_id, $tax_loss_brought_forward = 0)
    {
        $this->config->load('corporate_tax');
        $zero_rate_threshold = (float) $this->config->item('corporate_tax_zero_rate_threshold');
        $standard_rate = (float) $this->config->item('corporate_tax_standard_rate');

        $this->load->model('Financial_year_model');
        $year = $this->db->where('id', (int) $financial_year_id)
            ->where('company_id', $this->company_id())
            ->get('financial_years')->row();
        if (!$year) {
            throw new RuntimeException('Financial Year not found.');
        }

        $this->load->model('Accounts_model');
        // Retrieve accounting profit/loss using the SAME logic as the P&L report
        // (get_income / get_expense) so both pages always show identical figures.
        $income_rows  = $this->Accounts_model->get_income($year->start_date, $year->end_date);
        $expense_rows = $this->Accounts_model->get_expense($year->start_date, $year->end_date);

        $total_income  = array_sum(array_column($income_rows, 'total'));
        $total_expense = array_sum(array_map(function ($r) { return abs($r->total); }, $expense_rows));

        $accounting_profit = $total_income - $total_expense;

        $adjustments = $this->get_adjustments($financial_year_id);
        $additions = 0;
        $deductions = 0;
        foreach ($adjustments as $adjustment) {
            $amount = (float) $adjustment->tax_adjustment;
            if ($adjustment->adjustment_direction === 'ADD') {
                $additions += $amount;
            } elseif ($adjustment->adjustment_direction === 'DEDUCT') {
                $deductions += $amount;
            }
        }

        $before_losses = max(0, $accounting_profit + $additions - $deductions);
        $loss_utilised = min(max(0, (float) $tax_loss_brought_forward), $before_losses);
        $final_income = max(0, $before_losses - $loss_utilised);
        $zero_rate_income = min($final_income, $zero_rate_threshold);
        $standard_rate_income = max(0, $final_income - $zero_rate_threshold);
        $tax = $standard_rate_income * $standard_rate;

        $values = [
            'company_id' => $this->company_id(),
            'financial_year_id' => (int) $financial_year_id,
            'accounting_profit' => round($accounting_profit, 2),
            'total_additions' => round($additions, 2),
            'total_deductions' => round($deductions, 2),
            'taxable_income_before_losses' => round($before_losses, 2),
            'tax_loss_brought_forward' => round((float) $tax_loss_brought_forward, 2),
            'tax_loss_utilised' => round($loss_utilised, 2),
            'final_taxable_income' => round($final_income, 2),
            'tax_at_zero_rate' => round($zero_rate_income * 0, 2),
            'tax_at_standard_rate' => round($tax, 2),
            'corporate_tax_payable' => round($tax, 2),
            'status' => 'CALCULATED',
            'calculated_at' => date('Y-m-d H:i:s'),
            'created_by' => (int) $this->session->userdata('user_id'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $existing = $this->get_calculation($financial_year_id);
        if ($existing && $existing->status !== 'FINALIZED' && $existing->status !== 'FILED') {
            $this->db->where('id', (int) $existing->id)->update('corporate_tax_calculations', $values);
            $id = $existing->id;
        } elseif (!$existing) {
            $this->db->insert('corporate_tax_calculations', $values);
            $id = $this->db->insert_id();
        } else {
            throw new RuntimeException('Finalized Corporate Tax cannot be recalculated.');
        }

        $this->load->helper('log');
        add_log_entry((int) $this->session->userdata('user_id'), 1, 'Accounts/corporate_tax_calculate', 'corporate_tax_calculations', 'id', $id);
        return $this->get_calculation($financial_year_id);
    }

    public function finalize($financial_year_id)
    {
        $this->load->model('Financial_year_model');
        $year = $this->db->where('id', (int) $financial_year_id)
            ->where('company_id', $this->company_id())
            ->get('financial_years')->row();
        $calculation = $this->get_calculation($financial_year_id);
        if (!$year || $year->status !== 'CLOSED') {
            return ['success' => false, 'message' => 'Financial Year must be closed before Corporate Tax finalization.'];
        }
        if (!$calculation || $calculation->status !== 'CALCULATED') {
            return ['success' => false, 'message' => 'Corporate Tax must be calculated before finalization.'];
        }

        $validation = $this->Financial_year_model->validate_close($financial_year_id);
        if (!$validation['valid']) {
            return ['success' => false, 'message' => 'Finalization blocked: ' . $validation['message']];
        }

        $user_id = (int) $this->session->userdata('user_id');

        $this->db->trans_begin();
        try {
            // Find main branch or fallback
            $main_branch = $this->db
                ->where('company_id', $this->company_id())
                ->where('is_main_branch', 1)
                ->get('branches')
                ->row();
            $branch_id = $main_branch ? (int)$main_branch->branch_id : get_primary_branch_id();

            // Find or create Corporate Tax Expense Account
            $expense_account = $this->db->get_where('general_ledger', ['account_name' => 'Corporate Tax Expense', 'branch_id' => $branch_id])->row();
            if (!$expense_account) {
                $expense_account = $this->db->get_where('general_ledger', ['account_name' => 'Corporate Tax Expense'])->row();
            }
            if (!$expense_account) {
                $this->db->insert('general_ledger', [
                    'account_name' => 'Corporate Tax Expense',
                    'group_no' => 11, // Indirect Expenses
                    'branch_id' => $branch_id,
                    'isdeleteable' => 'N'
                ]);
                $expense_account_id = $this->db->insert_id();
            } else {
                $expense_account_id = $expense_account->account_id;
            }

            // Find or create Corporate Tax Payable Account
            $payable_account = $this->db->get_where('general_ledger', ['account_name' => 'Corporate Tax Payable', 'branch_id' => $branch_id])->row();
            if (!$payable_account) {
                $payable_account = $this->db->get_where('general_ledger', ['account_name' => 'Corporate Tax Payable'])->row();
            }
            if (!$payable_account) {
                $this->db->insert('general_ledger', [
                    'account_name' => 'Corporate Tax Payable',
                    'group_no' => 23, // Duties & Taxes
                    'branch_id' => $branch_id,
                    'isdeleteable' => 'N'
                ]);
                $payable_account_id = $this->db->insert_id();
            } else {
                $payable_account_id = $payable_account->account_id;
            }

            $tax_payable = (float) $calculation->corporate_tax_payable;
            $voucher_code = 'TX-JV-' . $financial_year_id;

            // Delete any existing voucher transaction entry first
            $this->db->where('voucher_code', $voucher_code)->delete('voucher_transaction');

            if ($tax_payable > 0) {
                // Post Debit to Corporate Tax Expense
                insert_voucher_transaction([
                    'voucher_code' => $voucher_code,
                    'voucher_date' => $year->end_date . ' 23:59:59',
                    'voucher_type' => 'J',
                    'account_id' => $expense_account_id,
                    'amount' => $tax_payable,
                    'drcr_type' => 'Dr',
                    'narration' => 'Accrual of Corporate Tax for Financial Year ' . $year->year_name,
                    'trans_type' => 'JV',
                    'branch_id' => $branch_id,
                    'financial_year_id' => $financial_year_id,
                    'recordCreatedBy' => $user_id
                ]);

                // Post Credit to Corporate Tax Payable
                insert_voucher_transaction([
                    'voucher_code' => $voucher_code,
                    'voucher_date' => $year->end_date . ' 23:59:59',
                    'voucher_type' => 'J',
                    'account_id' => $payable_account_id,
                    'amount' => $tax_payable,
                    'drcr_type' => 'Cr',
                    'narration' => 'Accrual of Corporate Tax for Financial Year ' . $year->year_name,
                    'trans_type' => 'JV',
                    'branch_id' => $branch_id,
                    'financial_year_id' => $financial_year_id,
                    'recordCreatedBy' => $user_id
                ]);
            }

            $this->db->where('id', (int) $calculation->id)->update('corporate_tax_calculations', [
                'status' => 'FINALIZED',
                'finalized_at' => date('Y-m-d H:i:s'),
                'finalized_by' => $user_id,
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $this->db->trans_commit();
        } catch (Exception $e) {
            $this->db->trans_rollback();
            return ['success' => false, 'message' => 'Finalization failed: ' . $e->getMessage()];
        }

        $this->load->helper('log');
        add_log_entry($user_id, 1, 'Accounts/corporate_tax_finalize', 'corporate_tax_calculations', 'id', $calculation->id);
        return ['success' => true, 'message' => 'Corporate Tax finalized and posted to accounting successfully.'];
    }
}
