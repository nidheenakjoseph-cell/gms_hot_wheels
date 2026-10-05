<?php
$accountName = "";

$this->load->helper('menu_helper.php');
$this->load->helper('myopeningbalance_helper.php');

$receipt_no = "";
$receipt_date = "";
$amount = 0;
$voucher_type = "";
$remark = "";
$cheque_no = "";
$cheque_date = "";
$cust_code = "";
$occu_add1 = "";
$occu_add2 = "";
$occu_name = "";
$customer_trn = "";

?>
<?php

$receipt_no     = $customer->voucher_code;
$receipt_date   = $customer->voucher_date;
$remark         = $customer->narration;
$cust_code      = $customer->cust_code;
$occu_name      = $customer->customer_name;
$occu_add1      = $customer->address;
$occu_add2      = $customer->emirates;
$customer_trn   = $customer->trn;

$amount = 0;

$drAccounts = [];
$crAccounts = [];

foreach ($receipt as $row) {

    if ($row->drcr_type == 'Dr') {
        $drAccounts[] = $row->account_name;
    } else {
        $crAccounts[] = $row->account_name;
    }

    // Total Debit Amount
    if ($row->drcr_type == 'Dr') {
        $amount += $row->amount;
    }
}

$drAccountName = implode(', ', $drAccounts);
$crAccountName = implode(', ', $crAccounts);

$amount_in_words = convert_number_to_words($amount);

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">

	<style>
		/* =========================================================
		TAILWIND-LIKE BASE
		========================================================= */
body{
    font-family:Arial,sans-serif;
    font-size:14px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table,th,td{
    border:1px solid #ddd;
}

th{
    background:#f0f0f0;
    padding:8px;
    text-align:center;
}

td{
    padding:8px;
}

.right-align{
    text-align:right;
}

.center-align{
    text-align:center;
}

		@media print {

			thead {
				display: table-header-group;
			}

			tfoot {
				display: table-footer-group;
			}

			tr {
				page-break-inside: avoid;
			}

			.content {
				margin-bottom: 120px;
			}

		}
	</style>
</head>
<body>
	<div class="watermark">
		<img src="<?= base_url(); ?>public/header/header.jpg" alt="">
	</div>

	<!-- ============================================================
     FIXED HEADER OUTSIDE TABLE STRUCTURE
=============================================================== -->
	<!-- ================= HEADER ================= -->


	
    <?php $company_profile = get_current_company_details(); ?>
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:10px;">

        <img src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>"
         width="30%"
             style="height:70px;" alt="Company logo">

    <div style="text-align:right; font-size:13px; line-height:1.5;">
           <strong><?= htmlspecialchars($company_profile->company_name ?? '', ENT_QUOTES, 'UTF-8') ?></strong><br>
        <?= htmlspecialchars(implode(', ', array_filter([$company_profile->company_address ?? '', $company_profile->company_city ?? '', $company_profile->company_country ?? ''])), ENT_QUOTES, 'UTF-8') ?><br>
        <?= htmlspecialchars($company_profile->company_website ?? '', ENT_QUOTES, 'UTF-8') ?><br>
        <?= htmlspecialchars($company_profile->company_email_id ?? '', ENT_QUOTES, 'UTF-8') ?><br>
        Tel: <?= htmlspecialchars($company_profile->company_telephone ?? '', ENT_QUOTES, 'UTF-8') ?><br>
        TRN: <?= htmlspecialchars($company_profile->company_TRN ?? '', ENT_QUOTES, 'UTF-8') ?>
    </div>

</div>

<h3 align="center">Credit Note</h3>
<table style="margin-top:10px; width:100%; border-collapse:collapse;">

    <tr>

        <td>
            <strong>No.:</strong>
            <?= htmlspecialchars($receipt_no); ?>
        </td>

        <td style="text-align:right;">
            <strong>Dated:</strong>
            <?= date('d-M-Y', strtotime($receipt_date)); ?>
        </td>

    </tr>

    <?php if(!empty($customer->cust_code)){ ?>

    <tr>

        <td colspan="2">
            <strong>
                [<?= htmlspecialchars($customer->cust_code); ?>]
                <?= htmlspecialchars($customer->customer_name); ?>
            </strong>
        </td>

    </tr>

    <?php } ?>

</table>




			<!-- <div class="text-center font-bold mt-2">
				SUPPLIER PURCHASE ORDER
			</div> -->

		</div>
	</div>

	<div class="container">

		<div class="header-space"></div>

		<!-- <div class="note-card">
			<strong>Purpose:</strong> This credit note has been issued to adjust the amount for the referenced account and customer transaction.
		</div> -->

		<div class="info-section">



			<table class="info-box">
				<tr>
					<td class="label">Credit Note No</td>
					<td><?= htmlspecialchars($receipt_no); ?></td>
				</tr>
				<tr>
					<td class="label">Issue Date</td>
					<td><?= date('d/m/Y', strtotime($receipt_date)); ?></td>
				</tr>
			
			</table>

		</div>


		<!-- ============================================================
		     CREDIT NOTE DETAILS
		============================================================= -->

	<table style="width:100%; border-collapse:collapse; margin-top:15px;">

    <thead>

        <tr style="background:#f0f0f0;">

            <th style="border:1px solid #ddd;padding:8px;width:8%;">
                SL.No
            </th>

            <th style="border:1px solid #ddd;padding:8px;">
                Particulars
            </th>

            <th style="border:1px solid #ddd;padding:8px;width:12%;">
                Type
            </th>

            <th style="border:1px solid #ddd;padding:8px;text-align:right;width:20%;">
                Amount (AED)
            </th>

        </tr>

    </thead>

    <tbody>

    <?php

    $i=1;
    $total=0;

    foreach($receipt as $row){

        $total += $row->amount;

    ?>

        <tr>

            <td style="border:1px solid #ddd;padding:8px;text-align:center;">
                <?= $i++; ?>
            </td>

            <td style="border:1px solid #ddd;padding:8px;">
                <?= htmlspecialchars($row->account_name); ?>
            </td>

            <td style="border:1px solid #ddd;padding:8px;text-align:center;">
                <?= $row->drcr_type; ?>
            </td>

            <td style="border:1px solid #ddd;padding:8px;text-align:right;">
                <?= number_format($row->amount,2); ?>
            </td>

        </tr>

    <?php } ?>

    </tbody>

</table>



		<!-- ============================================================
		     AMOUNT IN WORDS
		============================================================= -->

		<p style="margin-top:20px;">

    <strong>Amount in words:</strong>

    <?= htmlspecialchars($amount_in_words); ?>

</p>

		<?php if(!empty($remark)){ ?>

<p>

    <strong>Remarks</strong><br>

    <?= nl2br(htmlspecialchars($remark)); ?>

</p>

<?php } ?>
<div style="margin-top:60px;">

    <p>
        Receiver's Signature:
        ____________________
    </p>

    <p style="text-align:right;">
        Authorised Signatory
    </p>

</div>
		<br><br><br><br>

	


</body>

</html>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		window.print();
	});
</script>