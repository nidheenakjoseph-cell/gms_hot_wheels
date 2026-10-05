<html>

<head>
  <title><?= $title ?></title>

  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
      background-color: white;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #000;
      padding: 6px;
    }

    th {
      background: #f5f5f5;
    }

    .right {
      text-align: right;
    }

    .no-print {
      text-align: right;
      margin-bottom: 10px;
    }

    @media print {
      .no-print {
        display: none;
      }
    }

    /* Header */
    .invoice-header {
      border: 0;
    }

    .invoice-header td {
      vertical-align: middle;
      padding: 10px;
      border: 0;
    }

    .logo-cell {
      text-align: left;
    }

    .logo-cell img {
      display: block;
      max-width: 150px;
      max-height: 70px;
      width: auto;
      height: auto;
      object-fit: contain;
    }

    .company-cell {
      font-size: 14px;
      line-height: 1.6;
      text-align: left;
    }
  </style>
</head>

<body>
  <?php $company_profile = get_current_company_details(); ?>

  <div class="no-print">
    <button onclick="window.print()">🖨️ Print</button>
  </div>

  <!-- 🔥 HEADER SAME AS INVOICE -->
  <table class="invoice-header">
    <tr>
      <td width="20%" class="logo-cell">
        <img src="<?= htmlspecialchars(get_current_company_logo_url('public/images/logoauto1.png', $company_profile), ENT_QUOTES, 'UTF-8') ?>" alt="Company logo">
      </td>

      <td width="80%" class="company-cell">
        <strong><?= htmlspecialchars($company_profile->company_name ?? '', ENT_QUOTES, 'UTF-8') ?></strong><br>
        <?= htmlspecialchars(implode(', ', array_filter([$company_profile->company_address ?? '', $company_profile->company_city ?? '', $company_profile->company_state ?? '', $company_profile->company_pincode ?? '', $company_profile->company_country ?? ''])), ENT_QUOTES, 'UTF-8') ?><br>
        <?= htmlspecialchars($company_profile->company_website ?? '', ENT_QUOTES, 'UTF-8') ?><br>
        <?= htmlspecialchars($company_profile->company_email_id ?? '', ENT_QUOTES, 'UTF-8') ?><br>
        Tel: <?= htmlspecialchars($company_profile->company_telephone ?? '', ENT_QUOTES, 'UTF-8') ?><br>
        TRN: <?= htmlspecialchars($company_profile->company_TRN ?? '', ENT_QUOTES, 'UTF-8') ?>
      </td>
    </tr>
  </table>

  <!-- 🔥 TITLE ROW LIKE INVOICE -->
  <table style="margin-top:10px;">
    <tr>
      <td width="40%" style="border:none;">
        <b>Report:</b> <?= $title ?>
      </td>

      <td width="20%" style="border:none; text-align:center; font-size:16px;">
        <b>EMPLOYEE REPORT</b>
      </td>

      <td width="40%" style="border:none; text-align:right;">
        <b>Date:</b> <?= date('d-M-Y') ?>
      </td>
    </tr>
  </table>

  <br>

  <!-- 🔥 EMPLOYEE TABLE -->
  <table>
    <thead>
      <tr>
        <th width="5%">S.No</th>
        <th width="20%">Employee Name</th>
        <th width="15%">Designation</th>
        <th width="15%">Department</th>
        <th width="12%">Date of Join</th>
        <th width="13%">Contact Number</th>
        <th width="20%">Email ID</th>
        <th width="10%" class="right">Basic Salary</th>
      </tr>
    </thead>

    <tbody>
      <?php if (!empty($records)): $i = 1; ?>
        <?php foreach ($records as $row): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><?= $row->employee_name ?></td>
            <td><?= $row->designation_name ?></td>
            <td><?= $row->department_name ?></td>
            <td><?= date('d-M-Y', strtotime($row->joining_date)) ?></td>
            <td><?= $row->mobile ?></td>
            <td><?= $row->email ?></td>
            <td class="right"><?= $row->basic_salary ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="8" style="text-align:center;">No records found.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

</body>

</html>