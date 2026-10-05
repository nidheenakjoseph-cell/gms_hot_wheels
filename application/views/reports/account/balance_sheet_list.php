<style>
    @media print {

        @page {
            size: A4 portrait;
            margin: 10mm;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11px;
            color: #000;
            background: #fff;
        }

        form,
        .btn,
        .modal,
        .alert {
            display: none !important;
        }

        #printArea {
            width: 100%;
        }

        .report-header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .report-header h2 {
            font-size: 22px;
            margin: 0;
            color: #000;
        }

        .report-header p {
            margin-top: 5px;
            font-size: 12px;
            color: #000;
        }

        .bs-container {
            display: table;
            width: 100%;
            table-layout: fixed;
        }

        .bs-column {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 8px;
        }

        .bs-column:last-child {
            padding-right: 0;
            padding-left: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        th {
            background: #eee !important;
            color: #000 !important;
            border: 1px solid #000;
            padding: 6px;
            font-size: 12px;
        }

        td {
            border: 1px solid #000;
            padding: 4px 6px;
            font-size: 11px;
            word-wrap: break-word;
        }

        .text-right {
            text-align: right;
        }

        tfoot td {
            font-weight: bold;
            background: #f3f3f3 !important;
        }

        .divider {
            border-top: 2px solid #000 !important;
        }

        a {
            color: #000 !important;
            text-decoration: none !important;
        }

        .treegrid-expander {
            display: none !important;
        }
    }

    .report-header {
        width: 100%;
        padding: 10px 0 20px;
    }

    .report-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .report-header h2 {
        margin: 0;
        font-size: 32px;
        color: #1e3a5f;
        font-weight: 700;
    }

    .report-header h4 {
        margin: 5px 0;
        font-size: 18px;
    }

    .report-header p {
        margin-top: 6px;
        color: #555;
        font-size: 15px;
    }

    .bs-container {
        display: flex;
        gap: 20px;
    }

    #printArea {
        width: 100%;
    }

    .bs-container {
        display: flex;
        width: 100%;
        gap: 15px;
        align-items: flex-start;
    }

    .bs-column {
        flex: 1;
        min-width: 0;
        background: #fff;
        border: 1px solid #d8dee6;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0, 0, 0, .08);
    }

    .bs-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
        background: #fff;
    }

    .bs-table th {
        background: #1e3a5f;
        color: #fff;
        padding: 12px;
        border: 1px solid #d0d7de;
        text-align: left;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .bs-table td {
        border: 1px solid #e6e6e6;
        padding: 10px 12px;
        vertical-align: middle;
    }

    .bs-table tbody tr:nth-child(even) {
        background: #fbfcfd;
    }

    .bs-table tbody tr:hover {
        background: #f1f8ff;
        transition: .2s;
    }

    .text-right {
        text-align: right;
        font-family: Consolas, monospace;
        font-weight: 600;
    }

    .divider {
        border-top: 3px solid #1e3a5f !important;
        height: 8px;
    }

    tfoot th {
        background: #f2f2f2;
        font-size: 15px;
        font-weight: bold;
    }

    .bs-status {
        text-align: right;
        margin-top: 15px;
        font-size: 16px;
        font-weight: bold;
    }

    .ok {
        color: #0a8f2d;
    }

    .error {
        color: #c82333;
    }

    .drilldown-link {
        color: #0d6efd;
        text-decoration: none;
    }

    .drilldown-link:hover {
        text-decoration: underline;
    }

    .form-group,
    .row {
        margin-bottom: 20px;
    }

    label {
        font-weight: 600;
        color: #333;
    }

    .btn {
        min-width: 110px;
    }

    #to {
        height: 40px;
    }

    .mb-4 {
        margin-bottom: 25px;
    }

    .card {
        border-radius: 10px;
    }

    .report-header {
        margin: 25px 0;
    }

    .report-header h2 {
        margin-bottom: 8px;
    }

    .btn-lg {
        min-width: 150px;
    }

    .bs-container {
        margin-top: 20px;
    }

    .modal {
        display: none;
        position: fixed;
        inset: 0;
        z-index: 1050;
        background: rgba(0, 0, 0, 0.45);
        overflow-x: hidden;
        overflow-y: auto;
        padding: 1.5rem;
    }

    .modal.show {
        display: block;
    }

    body.modal-open {
        overflow: hidden;
    }

    .modal-dialog {
        max-width: 900px;
        margin: 1.75rem auto;
        pointer-events: none;
    }

    .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        width: 100%;
        pointer-events: auto;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.2);
        border-radius: 0.5rem;
        outline: 0;
    }

    .modal-header,
    .modal-footer {
        padding: 1rem;
        border-bottom: 1px solid #e9ecef;
    }

    .modal-footer {
        border-top: 1px solid #e9ecef;
        border-bottom: 0;
    }

    .modal-body {
        position: relative;
        flex: 1 1 auto;
        padding: 1rem;
        max-height: 70vh;
        overflow: auto;
    }

    .modal .btn-default {
        background: #f8f9fa;
        border: 1px solid #d1d5db;
        color: #111827;
    }

    .modal .close {
        cursor: pointer;
    }
</style>
<?php $this->load->helper('Account_helper.php'); ?>
<div class="bg-white shadow-md rounded-xl p-6">

    <!-- =========================
     BALANCE SHEET HEADER
========================== -->
    <div class="text-center mb-5">
        <!-- <h2 class="text-2xl font-bold uppercase"><?php echo htmlspecialchars($company_records[0]->company_name); ?></h2> -->
        <h2 class="text-2xl font-bold uppercase">Balance Sheet</h2>
    </div>

    <!-- =========================
     FILTER FORM
     This will NOT be printed
========================== -->
    <form id="main"
        class="grid md:grid-cols-12 gap-4 items-end"
        method="post"
        action="<?php echo base_url() . 'index.php/'; ?>Accounts/view_balance_sheet"
        autocomplete="off">


        <div class="md:col-span-3">
            <label class="block text-sm font-medium mb-1" for="to">
                Till Date
            </label>

            <input type="date"
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
                id="to"
                name="to"
                value="<?php echo htmlspecialchars($to); ?>"
                required>
        </div>

        <!-- Buttons -->
        <div class="md:col-span-5 flex flex-wrap gap-2">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
                <i class="fa fa-search"></i>
                View Report
            </button>

            <button type="submit"
                formaction="<?php echo base_url('index.php/Accounts/balance_sheet_full_export'); ?>"
                formmethod="post"
                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow">
                <i class="fa fa-file-excel-o mr-1"></i> Export to Excel
            </button>

            <button type="button" onclick="printBalanceSheet()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg shadow">
                <i class="fa fa-print mr-1"></i> Print
            </button>
        </div>

    </form>

    <!-- =========================
     PRINT AREA
========================== -->


    <!-- Existing Balance Sheet tables continue here -->


    <?php
    $asset_total = array_sum(array_map(fn($g) => $g->balance, $assets));
    $liab_total  = array_sum(array_map(fn($g) => $g->balance, $liabilities));
    ?>

    <div class="row">
        <div class="col-md-12">
            <div id="printArea">


                <!-- TWO COLUMN LAYOUT -->
                <div class="bs-container">
                    <!-- LIABILITIES -->
                    <div class="bs-column">
                        <table class="bs-table tree">
                            <thead>
                                <tr>
                                    <th>Liabilities</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row_id = 1000;
                                if (empty($liabilities)): ?>
                                    <tr>
                                        <td colspan="2">No Data</td>
                                    </tr>
                                <?php endif;

                                render_tree_rows($liabilities, $row_id);
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2" class="divider"></td>
                                </tr>

                                <tr style="font-weight:bold;background:#e8e8e8;">
                                    <td><strong>Total</strong></td>
                                    <td class="text-right">
                                        <strong><?php echo number_format($liab_total, 2); ?></strong>
                                    </td>
                                </tr>
                            </tfoot>

                        </table>
                    </div>
                    <!-- ASSETS -->
                    <div class="bs-column">
                        <table class="bs-table tree">
                            <thead>
                                <tr>
                                    <th>Assets</th>
                                    <th class="text-right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $row_id = 1;
                                if (empty($assets)): ?>
                                    <tr>
                                        <td colspan="2">No Data</td>
                                    </tr>
                                <?php endif;
                                render_tree_rows($assets, $row_id);
                                ?>
                            </tbody>
                            <tfoot>

                                <tr>
                                    <td colspan="2" class="divider"></td>
                                </tr>

                                <tr style="font-weight:bold;background:#e8e8e8;">
                                    <td><strong>Total</strong></td>
                                    <td class="text-right">
                                        <strong><?php echo number_format($asset_total, 2); ?></strong>
                                    </td>
                                </tr>

                            </tfoot>
                        </table>
                    </div>



                </div>

                <!-- STATUS -->
                <div class="bs-status">
                    <?php if (round($asset_total, 2) == round($liab_total, 2)): ?>
                        <div class="alert alert-success text-center" style="font-size:18px;font-weight:bold;">
                            ✔ Balance Sheet Tallied
                        </div>
                    <?php else: ?>
                        <div class="alert alert-danger text-center" style="font-size:18px;font-weight:bold;">
                            Difference :
                            <?php echo number_format(abs($asset_total - $liab_total), 2); ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>
    <!-- DRILLDOWN MODAL -->
    <div id="drillModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">


                <div class="modal-header">

                    <h4 class="modal-title">Ledger Drilldown</h4>
                </div>


                <div class="modal-body">
                    <div id="drillContent">Loading...</div>
                </div>
                <!-- FOOTER -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-danger" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Static Table End -->

<?php

function render_tree_rows($groups, &$row_id = 1, $parent_id = 0, $level = 0)
{
    foreach ($groups as $group) {

        if (round($group->balance, 2) == 0) {
            continue;
        }

        $current_id = $row_id++;
        $parent_class = $parent_id ? "treegrid-parent-$parent_id" : "";

        echo "<tr class='treegrid-$current_id $parent_class'>";

        echo "<td style='padding-left:" . ($level * 20) . "px; font-weight:bold;'>";
        echo htmlspecialchars($group->group_name);
        echo "</td>";

        echo "<td style='text-align:right; font-weight:bold;'>";
        echo number_format(abs($group->balance), 2);
        echo "</td>";

        echo "</tr>";

        // Ledgers
        if (!empty($group->ledgers)) {

            foreach ($group->ledgers as $ledger) {

                if (round($ledger->balance, 2) == 0) {
                    continue;
                }

                $ledger_id = $row_id++;

                echo "<tr class='treegrid-$ledger_id treegrid-parent-$current_id'>";

                echo "<td style='padding-left:" . (($level + 1) * 20) . "px'>";

                global $from, $to;

                if (!empty($ledger->account_id)) {

                    echo "<a href='javascript:void(0);' 
    class='drilldown-link'  
    data-id='" . (int) $ledger->account_id . "' 
    data-from='" . htmlspecialchars((string)($from ?? ''), ENT_QUOTES, 'UTF-8') . "'  
    data-to='" . htmlspecialchars((string)($to ?? ''), ENT_QUOTES, 'UTF-8') . "'>";

                    echo htmlspecialchars((string)($ledger->name ?? ''), ENT_QUOTES, 'UTF-8');

                    echo "</a>";
                } else {

                    echo htmlspecialchars((string)($ledger->name ?? ''), ENT_QUOTES, 'UTF-8');
                }

                echo "</td>";

                echo "<td style='text-align:right'>";

                echo ($ledger->balance < 0 ? '(' : '')
                    . number_format(abs($ledger->balance), 2)
                    . ($ledger->balance < 0 ? ')' : '');

                echo "</td>";

                echo "</tr>";
            }
        }

        // Children
        if (!empty($group->children)) {

            render_tree_rows(
                $group->children,
                $row_id,
                $current_id,
                $level + 1
            );
        }
    }
}

?>

<script type="text/javascript">
    <?php $company_profile = get_current_company_details(); ?>
    const balanceSheetCompany = <?= json_encode([
        'logo' => get_current_company_logo_url('public/images/logoauto1.png', $company_profile),
        'name' => $company_profile->company_name ?? '',
        'address' => implode(', ', array_filter([
            $company_profile->company_address ?? '',
            $company_profile->company_city ?? '',
            $company_profile->company_state ?? '',
            $company_profile->company_pincode ?? '',
            $company_profile->company_country ?? '',
        ])),
        'website' => $company_profile->company_website ?? '',
        'email' => $company_profile->company_email_id ?? '',
        'telephone' => $company_profile->company_telephone ?? '',
        'trn' => $company_profile->company_TRN ?? '',
    ], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;

    function escapeBalanceSheetPrintHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, function(character) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[character];
        });
    }

    function printBalanceSheet() {

        if ($.fn.treegrid) {
            $('.tree').treegrid('expandAll');
        }

        var myWindow = window.open('', '', 'width=1000,height=700');

        if (!myWindow) {
            alert('Please allow pop-ups to print the Balance Sheet.');
            return;
        }

        myWindow.document.write(`
        <html>
        <head>
            <title>Balance Sheet</title>

            <style>
                body {
                    font-family: Arial, Helvetica, sans-serif;
                    font-size: 13px;
                    margin: 20px;
                    color: #000;
                }

                h2 {
                    text-align: center;
                    margin-bottom: 5px;
                }

                table {
                    width: 100%;
                    border-collapse: collapse;
                    table-layout: fixed;
                }

                th {
                    background: #e9ecef;
                    font-weight: bold;
                    text-align: left;
                    padding: 8px;
                    border: 1px solid #000;
                }

                td {
                    padding: 6px 8px;
                    border: 1px solid #000;
                }

                .text-right {
                    text-align: right;
                }

                .total {
                    font-weight: bold;
                    border-top: 2px solid #000;
                }

                .company-header {
                    margin-bottom: 16px;
                }

                .company-header td {
                    border: 0;
                    padding: 6px;
                    vertical-align: middle;
                }

                .company-logo {
                    max-width: 150px;
                    max-height: 70px;
                    object-fit: contain;
                }

                a {
                    color: #000;
                    text-decoration: none;
                }
            </style>
        </head>

        <body>

            <table class="company-header">
                <tr>
                    <td style="width:25%;">
                        <img class="company-logo" src="${escapeBalanceSheetPrintHtml(balanceSheetCompany.logo)}" alt="Company logo">
                    </td>
                    <td style="width:75%; text-align:right; line-height:1.5;">
                        <strong>${escapeBalanceSheetPrintHtml(balanceSheetCompany.name)}</strong>
                        ${balanceSheetCompany.address ? `<br>${escapeBalanceSheetPrintHtml(balanceSheetCompany.address)}` : ''}
                        ${[balanceSheetCompany.website, balanceSheetCompany.email, balanceSheetCompany.telephone, balanceSheetCompany.trn ? 'TRN: ' + balanceSheetCompany.trn : ''].filter(Boolean).length ? `<br>${[balanceSheetCompany.website, balanceSheetCompany.email, balanceSheetCompany.telephone, balanceSheetCompany.trn ? 'TRN: ' + balanceSheetCompany.trn : ''].filter(Boolean).map(escapeBalanceSheetPrintHtml).join(' | ')}` : ''}
                    </td>
                </tr>
            </table>

            <h2>Balance Sheet</h2>

            <table>

                <thead>
                    <tr>

                        <th>Liabilities & Equity</th>
                        <th class="text-right">Amount</th>

                         <th>Assets</th>
                        <th class="text-right">Amount</th>
                    </tr>
                </thead>

                <tbody>
                    ${formatSingleTable()}
                </tbody>

            </table>

        </body>
        </html>
    `);

        myWindow.document.close();

        myWindow.onload = function() {
            myWindow.focus();
            myWindow.print();
            myWindow.close();
        };
    }


    /*
     * Convert the two screen columns into one
     * four-column print table.
     *
     * Screen:
     *   Column 1 = Liabilities
     *   Column 2 = Assets
     *
     * Print:
     *   Assets | Amount | Liabilities | Amount
     */
    function formatSingleTable() {

        let assetRows = [];
        let liabRows = [];

        // First screen column = Liabilities
        document.querySelectorAll(
            '.bs-column:nth-child(1) table tr'
        ).forEach(function(tr) {
            liabRows.push(tr.innerHTML);
        });

        // Second screen column = Assets
        document.querySelectorAll(
            '.bs-column:nth-child(2) table tr'
        ).forEach(function(tr) {
            assetRows.push(tr.innerHTML);
        });

        let max = Math.max(
            assetRows.length,
            liabRows.length
        );

        let html = '';

        for (let i = 0; i < max; i++) {

            html += '<tr>';

            // Liabilities
            html += liabRows[i] ?
                liabRows[i] :
                '<td></td><td></td>';

            // Assets
            html += assetRows[i] ?
                assetRows[i] :
                '<td></td><td></td>';

            html += '</tr>';
        }

        return html;
    }

    /*
     * Treegrid initialization
     */
    $(document).ready(function() {

        if ($.fn.treegrid) {

            $('.tree').treegrid({
                initialState: 'collapsed',
                expanderExpandedClass: 'glyphicon glyphicon-minus',
                expanderCollapsedClass: 'glyphicon glyphicon-plus'
            });

        } else {

            console.warn('treegrid plugin not loaded.');

        }


        /*
         * Set default Till Date
         */
        if (!$('#to').val()) {

            let today = new Date();

            $('#to').val(today.toISOString().split('T')[0]);
        }
    });


    /*
     * Open Ledger Drilldown
     */
    $(document).on('click', '.drilldown-link', function(e) {

        e.preventDefault();

        let account_id = $(this).data('id');
        let from = $(this).data('from');
        let to = $(this).data('to');

        if (!account_id) {
            return;
        }

        /*
         * Show custom modal
         * Do NOT use $('#drillModal').modal()
         */
        $('#drillModal').addClass('show');

        $('body').addClass('modal-open');

        $('#drillContent').html(`
        <div style="text-align:center;padding:30px;">
            <i class="fa fa-spinner fa-spin fa-2x"></i>
            <div style="margin-top:10px;">
                Loading transactions...
            </div>
        </div>
    `);


        /*
         * Load ledger transactions
         */
        $.ajax({

            url: "<?php echo base_url('index.php/Accounts/drilldown_balance_sheet'); ?>",

            type: "GET",

            dataType: "html",

            data: {
                account_id: account_id,
                from: from,
                to: to
            },

            success: function(response) {

                $('#drillContent').html(response);

            },

            error: function(xhr) {

                console.error(xhr.responseText);

                $('#drillContent').html(`
                <div style="
                    color:#c82333;
                    background:#f8d7da;
                    border:1px solid #f5c6cb;
                    padding:12px;
                    border-radius:5px;
                ">
                    Error loading transaction details.
                </div>
            `);

            }

        });

    });


    /*
     * Close modal
     */
    function hideDrillModal() {

        $('#drillModal').removeClass('show');

        $('body').removeClass('modal-open');

    }


    /*
     * Close button
     */
    $(document).on(
        'click',
        '#drillModal .close, #drillModal .btn-default',
        function(e) {

            e.preventDefault();

            hideDrillModal();

        }
    );


    /*
     * Close when clicking outside modal content
     */
    $(document).on('click', '#drillModal', function(e) {

        if (e.target === this) {

            hideDrillModal();

        }

    });


    /*
     * ESC key closes modal
     */
    $(document).on('keydown', function(e) {

        if (e.key === 'Escape') {

            hideDrillModal();

        }

    });
</script>