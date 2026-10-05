<!DOCTYPE html>

<html>

    <head>

        <meta charset="UTF-8">

        <title>
            <?= htmlspecialchars($title) ?>
        </title>

        <style>

            @page {
                size: A4 landscape;
                margin: 12mm;
            }

            body {
                font-family: Arial, sans-serif;
                font-size: 11px;
                color: #222;
                margin: 0;
            }

            .header {
                text-align: center;
                border-bottom: 2px solid #222;
                padding-bottom: 10px;
                margin-bottom: 15px;
            }

            .header h1 {
                margin: 0;
                font-size: 20px;
            }

            .header p {
                margin: 4px 0;
                color: #666;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                table-layout: fixed;
            }

            th,
            td {
                border: 1px solid #ccc;
                padding: 6px;
                text-align: left;
                vertical-align: middle;
                word-wrap: break-word;
            }

            th {
                background: #f3f4f6;
                font-weight: bold;
                font-size: 10px;
            }

            td {
                font-size: 10px;
            }

            .footer {
                margin-top: 20px;
                padding-top: 8px;
                border-top: 1px solid #ccc;
                text-align: center;
                font-size: 9px;
                color: #777;
            }

        </style>

    </head>

    <body>

        <div class="header">

            <h1>
                Garage Management System
            </h1>

            <p>
                <?= htmlspecialchars($title) ?>
            </p>

            <p>
                Generated:
                <?= date('d-m-Y h:i A') ?>
            </p>

        </div>

        <?php if (!empty($policies)) : ?>

            <table>

                <thead>

                    <tr>

                        <th>Policy Number</th>

                        <th>Insured Vehicle</th>

                        <th>Customer / Policyholder</th>

                        <th>Insurance Company</th>

                        <th>Policy Type</th>

                        <th>Policy Term</th>

                        <th>Coverage Type</th>

                        <th>Sum Insured</th>

                        <th>Premium Amount</th>

                        <th>Discount</th>

                        <th>VAT Treatment</th>

                        <th>VAT %</th>

                        <th>VAT Amount</th>

                        <th>Total Premium</th>

                        <th>Insurance Policy Status</th>

                    </tr>

                </thead>

                <tbody>

                <?php  $grouped_policies = array(); foreach ($policies as $row) { $policy_id = $row->policy_id; if (!isset($grouped_policies[$policy_id])) { $grouped_policies[$policy_id] = $row; $grouped_policies[$policy_id]->coverage_types = array(); } if ( !empty($row->coverage_type_name) && !in_array( $row->coverage_type_name, $grouped_policies[$policy_id]->coverage_types ) ) { $grouped_policies[$policy_id]->coverage_types[] = $row->coverage_type_name; } } ?>

                    <?php foreach ($policies as $row) : ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars(
                                    $row->policy_number ?? '-'
                                ) ?>
                            </td>

                            <td>
                                <?php
                                $vehicle = '';

                                if (!empty($row->brand)) {
                                    $vehicle .= $row->brand;
                                }

                                if (!empty($row->registration_no)) {

                                    if ($vehicle !== '') {
                                        $vehicle .= ' - ';
                                    }

                                    $vehicle .= $row->registration_no;
                                }

                                echo htmlspecialchars(
                                    $vehicle !== '' ? $vehicle : '-'
                                );
                                ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $row->name ?? '-'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $row->company_name ?? '-'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $row->policy_type_name ?? '-'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $row->policy_term_name ?? '-'
                                ) ?>
                            </td>

                            <td> <?php if (!empty($row->coverage_types)) : ?> <?= htmlspecialchars( implode( ', ', $row->coverage_types ) ) ?> <?php else : ?> - <?php endif; ?> </td>

                            <td>
                                <?= htmlspecialchars(
                                    $row->sum_insured ?? '-'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $row->premium_amount ?? '-'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $row->discount_amount ?? '-'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $row->vat_treatment ?? '-'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $row->vat_rate ?? '-'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $row->vat_amount ?? '-'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $row->total_premium ?? '-'
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    $row->policy_status ?? '-'
                                ) ?>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        <?php else : ?>

            <p>
                No policy records found.
            </p>

        <?php endif; ?>

        <div class="footer">

            Garage Management System

        </div>

    </body>

</html>
