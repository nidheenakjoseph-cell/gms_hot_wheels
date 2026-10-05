<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<link rel="stylesheet"
      href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<style>
    /* Main card */
    .scrap-sales-card {
        width: 100%;
        max-width: 100%;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .scrap-sales-card-body {
        padding: 20px;
        width: 100%;
        box-sizing: border-box;
    }

    /* Header */
    .scrap-sales-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 20px;
        gap: 15px;
    }

    .scrap-sales-title {
        margin: 0;
        font-size: 22px;
        font-weight: 600;
        color: #1f2937;
    }

    .add-scrap-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 16px;
        background: #2563eb;
        color: #fff !important;
        text-decoration: none !important;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
    }

    .add-scrap-btn:hover {
        background: #1d4ed8;
        color: #fff !important;
    }

    /* Table wrapper */
    .scrap-table-wrapper {
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        overflow-y: hidden;
    }

    #scrapTable {
        width: 100% !important;
        min-width: 1000px;
        border-collapse: collapse;
    }

    #scrapTable thead th {
        background: #f8fafc;
        color: #374151;
        font-size: 13px;
        font-weight: 600;
        padding: 12px 10px;
        border-bottom: 1px solid #e5e7eb;
        white-space: nowrap;
    }

    #scrapTable tbody td {
        padding: 12px 10px;
        font-size: 14px;
        color: #374151;
        border-bottom: 1px solid #e5e7eb;
        vertical-align: middle;
        white-space: nowrap;
    }

    #scrapTable tbody tr:hover {
        background: #f9fafb;
    }

    /* Status */
    .scrap-status {
        display: inline-block;
        padding: 4px 9px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
        line-height: 1.2;
        white-space: nowrap;
    }

    .scrap-status-paid {
        background: #dcfce7;
        color: #15803d;
    }

    .scrap-status-partial {
        background: #fef3c7;
        color: #b45309;
    }

    .scrap-status-unpaid {
        background: #fee2e2;
        color: #dc2626;
    }

    /* Action buttons */
    .scrap-actions {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        white-space: nowrap;
    }

    .scrap-action-btn {
        width: 36px;
        height: 36px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 5px;
        text-decoration: none !important;
        transition: 0.2s;
    }

    .scrap-action-btn svg {
        width: 18px;
        height: 18px;
    }

    .scrap-view {
        background: #f1f5f9;
        color: #334155;
    }

    .scrap-view:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    .scrap-edit {
        background: #fef3c7;
        color: #a16207;
    }

    .scrap-edit:hover {
        background: #fde68a;
        color: #854d0e;
    }

    .scrap-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .scrap-delete:hover {
        background: #fecaca;
        color: #b91c1c;
    }

    /* DataTables controls */
    .dataTables_wrapper {
        width: 100%;
    }

    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 15px;
    }

    .dataTables_wrapper .dataTables_length select {
        min-width: 65px;
        height: 36px;
        border: 1px solid #d1d5db;
        border-radius: 5px;
        padding: 5px 8px;
        background: #fff;
    }

    .dataTables_wrapper .dataTables_filter input {
        height: 36px;
        width: 220px;
        border: 1px solid #d1d5db;
        border-radius: 5px;
        padding: 5px 10px;
        margin-left: 8px;
        box-sizing: border-box;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.1);
    }

    .dataTables_wrapper .dataTables_info {
        padding-top: 15px;
        font-size: 13px;
        color: #6b7280;
    }

    .dataTables_wrapper .dataTables_paginate {
        padding-top: 10px;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 4px !important;
        padding: 5px 10px !important;
    }

    /* Mobile */
    @media (max-width: 768px) {

        .scrap-sales-card-body {
            padding: 12px;
        }

        .scrap-sales-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .add-scrap-btn {
            width: auto;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            float: none;
            text-align: left;
            margin-bottom: 10px;
        }

        .dataTables_wrapper .dataTables_filter input {
            width: 180px;
        }
    }
</style>


<div class="scrap-sales-card">

    <div class="scrap-sales-card-body">

        <!-- Header -->
        <div class="scrap-sales-header">

            <h2 class="scrap-sales-title">
                Scrap Sales
            </h2>

            <a href="<?= base_url('index.php/scrap/add'); ?>"
               class="add-scrap-btn">
                + Add Scrap Sale
            </a>

        </div>


        <!-- Table -->
        <div class="scrap-table-wrapper">

            <table id="scrapTable">

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Invoice No</th>
                        <th>Date</th>
                        <th>Buyer</th>
                        <th style="text-align:center;">Items</th>
                        <th>Categories</th>
                        <th style="text-align:right;">Total</th>
                        <th style="text-align:right;">Paid / Advance</th>
                        <th style="text-align:right;">Balance</th>
                        <th>Status</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>


                <tbody>

                    <?php
                    $i = 1;

                    if (!empty($scrap_sales)):

                        foreach ($scrap_sales as $sale):

                            $balance = isset($sale->balance)
                                ? (float)$sale->balance
                                : 0;

                            $paid = isset($sale->paid_amt)
                                ? (float)$sale->paid_amt
                                : (isset($sale->advance_used) ? (float)$sale->advance_used : 0);


                            if ($balance <= 0) {

                                $status = 'Paid';
                                $status_class = 'scrap-status-paid';

                            } elseif ($paid > 0) {

                                $status = 'Partially Paid';
                                $status_class = 'scrap-status-partial';

                            } else {

                                $status = 'Unpaid';
                                $status_class = 'scrap-status-unpaid';

                            }
                    ?>

                    <tr>

                        <!-- Number -->
                        <td>
                            <?= $i++; ?>
                        </td>


                        <!-- Invoice -->
                        <td>
                            <?= html_escape($sale->invoice_no ?? '-'); ?>
                        </td>


                        <!-- Date -->
                        <td>
                            <?= !empty($sale->sale_date)
                                ? date('d-m-Y', strtotime($sale->sale_date))
                                : '-'; ?>
                        </td>


                        <!-- Buyer -->
                        <td>
                            <?= html_escape($sale->customer_name ?? '-'); ?>
                        </td>


                        <!-- Items -->
                        <td style="text-align:center;">
                            <?= (int)($sale->item_count ?? 0); ?>
                        </td>


                        <!-- Categories -->
                        <td>
                            <?= html_escape($sale->categories ?? '-'); ?>
                        </td>


                        <!-- Total -->
                        <td style="text-align:right;">
                            <?= number_format(
                                (float)($sale->total_amount ?? $sale->grand_total ?? 0),
                                2
                            ); ?>
                        </td>


                        <!-- Paid / Advance -->
                        <td style="text-align:right;">
                            <?= number_format($paid, 2); ?>
                        </td>


                        <!-- Balance -->
                        <td style="text-align:right;">
                            <?= number_format($balance, 2); ?>
                        </td>


                        <!-- Status -->
                        <td>

                            <span class="scrap-status <?= $status_class; ?>">
                                <?= $status; ?>
                            </span>

                        </td>


                        <!-- Actions -->
                        <td>

                            <div class="scrap-actions">

                                <!-- View -->
                                <a
                                    href="<?= base_url('index.php/scrap/view/' . $sale->id); ?>"
                                    class="scrap-action-btn scrap-view"
                                    title="View Scrap Sale">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.25 12s3.75-7.5 9.75-7.5 9.75 7.5 9.75 7.5-3.75 7.5-9.75 7.5S2.25 12 2.25 12z" />

                                    </svg>

                                </a>


                                <!-- Edit -->
                                <a
                                    href="<?= base_url('index.php/scrap/edit/' . $sale->id); ?>"
                                    class="scrap-action-btn scrap-edit"
                                    title="Edit Scrap Sale">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M16.862 3.487l3.651 3.651
                                            M17.708 2.64a2.25 2.25 0 113.182 3.182
                                            L7.125 19.586a4.5 4.5 0 01-1.91 1.146
                                            L3 21l.268-2.215
                                            a4.5 4.5 0 011.146-1.91
                                            L17.708 2.64z" />

                                    </svg>

                                </a>


                                <!-- Delete -->
                                <a
                                    href="<?= base_url('index.php/scrap/delete/' . $sale->id); ?>"
                                    onclick="return confirm('Delete this scrap sale?');"
                                    class="scrap-action-btn scrap-delete"
                                    title="Delete Scrap Sale">

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke-width="1.5"
                                        stroke="currentColor">

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M6 7.5h12
                                            M9.75 7.5V6
                                            a2.25 2.25 0 012.25-2.25h0
                                            A2.25 2.25 0 0114.25 6v1.5
                                            M18 7.5l-.663 9.947
                                            A2.25 2.25 0 0115.092 19.5H8.908
                                            a2.25 2.25 0 01-2.245-2.053L6 7.5
                                            m3 3v6m6-6v6" />

                                    </svg>

                                </a>

                            </div>

                        </td>

                    </tr>

                    <?php

                        endforeach;

                    endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>


<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {

    $('#scrapTable').DataTable({
    pageLength: 5,
    lengthMenu: [
        [5, 10, 25, 50, -1],
        [5, 10, 25, 50, 'All']
    ],
    responsive: false,
    autoWidth: false,
    order: [],
    language: {
        search: "",
        searchPlaceholder: "Search ...",
        emptyTable: "No scrap sales found."
    },
    columnDefs: [
        {
            targets: [0, 4, 9, 10],
            orderable: false
        }
    ]
});

});
</script>