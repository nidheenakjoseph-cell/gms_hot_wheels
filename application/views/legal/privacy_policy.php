<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html_escape($title ?? 'Privacy Policy | GMS ERP') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1e293b;
            line-height: 1.7;
        }
        .legal-header {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            color: #ffffff;
            padding: 48px 0;
            margin-bottom: 36px;
        }
        .legal-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid #e2e8f0;
            padding: 40px;
            margin-bottom: 48px;
        }
        h2 {
            font-size: 1.35rem;
            font-weight: 700;
            color: #0f172a;
            margin-top: 28px;
            margin-bottom: 12px;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 8px;
        }
        h2:first-of-type {
            margin-top: 0;
        }
        ul {
            padding-left: 20px;
        }
        li {
            margin-bottom: 6px;
        }
        .footer-note {
            text-align: center;
            color: #64748b;
            font-size: 0.9rem;
            margin-bottom: 36px;
        }
        .badge-tag {
            background: #e0f2fe;
            color: #0369a1;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
        }
    </style>
</head>
<body>

    <header class="legal-header">
        <div class="container">
            <span class="badge-tag">GMS ERP Legal</span>
            <h1 class="h2 mt-2 mb-1 fw-bold">Privacy Policy</h1>
            <p class="text-white-50 mb-0">Last Updated: <?= html_escape($last_updated ?? 'September 24, 2026') ?></p>
        </div>
    </header>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="legal-card">
                    <p class="lead" style="font-size: 1.05rem;">
                        This Privacy Policy describes how <strong>GMS ERP</strong> ("we", "our", or "us"), provided by <strong>Concept 360 Plus / Green Earth Network</strong>, collects, uses, and protects your information when you access our Garage Management System and our integrated communication services, including the Meta WhatsApp Business messaging service.
                    </p>

                    <h2>1. Information We Collect</h2>
                    <p>In operating our Garage Management System, we may collect and process the following categories of information:</p>
                    <ul>
                        <li><strong>Customer Contact Details:</strong> Name, phone number, email address, and physical address.</li>
                        <li><strong>Vehicle Information:</strong> Vehicle registration number, make, model, chassis/VIN number, and service records.</li>
                        <li><strong>Billing & Invoicing Data:</strong> Quotations, repair estimations, invoices, payment history, and job card status.</li>
                        <li><strong>Communications Data:</strong> Message delivery timestamps, delivery status, and responses for communications sent via WhatsApp or Email.</li>
                    </ul>

                    <h2>2. How We Use Your Information</h2>
                    <p>We use the collected information strictly for operational and customer service purposes:</p>
                    <ul>
                        <li>To generate and provide repair quotations, invoices, estimation reports, vehicle inspection cards, and receipts.</li>
                        <li>To send transactional vehicle updates, job card completion alerts, and periodic service reminders.</li>
                        <li>To facilitate automated communications via WhatsApp Business API based on customer service requests.</li>
                        <li>To maintain accurate accounting, tax, and garage audit records.</li>
                    </ul>

                    <h2>3. WhatsApp Business API & Meta Data Handling</h2>
                    <p>Our application integrates with the <strong>WhatsApp Business Cloud API</strong> provided by <strong>Meta Platforms, Inc.</strong>:</p>
                    <ul>
                        <li><strong>Purpose of WhatsApp Messages:</strong> Messages sent via WhatsApp are strictly transactional (e.g., sending PDF invoice links, job card approvals, inspection summaries, and scheduled vehicle service reminders).</li>
                        <li><strong>Consent & Opt-Out:</strong> We only contact customers who have provided their phone number in connection with vehicle services. Customers may opt out of WhatsApp communications at any time by replying <code>STOP</code>.</li>
                        <li><strong>No Third-Party Advertising:</strong> We do not sell, rent, or share customer phone numbers or communications with third-party advertisers or data brokers.</li>
                    </ul>

                    <h2>4. Data Storage & Security</h2>
                    <p>We implement industry-standard technical and organizational security measures to protect customer data from unauthorized access, alteration, disclosure, or destruction. Access to personal and transactional data is restricted to authorized garage staff and system administrators.</p>

                    <h2 id="data-deletion">5. Data Retention & User Data Deletion Instructions</h2>
                    <p>We retain customer and garage records for as long as necessary to fulfill the operational purposes described in this policy, or as mandated by applicable commercial and accounting laws.</p>
                    <p><strong>How to Request Data Deletion:</strong> If you wish to have your personal data, phone number, or service history permanently deleted from GMS ERP, you can submit a deletion request by emailing us at <a href="mailto:concepts360plus@gmail.com">concepts360plus@gmail.com</a> with your name and registered mobile number. Your data will be reviewed and permanently removed from our active databases within 30 days.</p>

                    <h2>6. Third-Party Services</h2>
                    <p>Our software interacts with trusted third-party providers necessary to deliver services:</p>
                    <ul>
                        <li><strong>Meta Platforms, Inc.:</strong> For processing WhatsApp Business messaging under Meta's Business Terms and Data Processing terms.</li>
                        <li><strong>Hosting & Server Infrastructure:</strong> Secure cloud and database hosting infrastructure for system operations.</li>
                    </ul>

                    <h2>7. Changes to This Privacy Policy</h2>
                    <p>We may update this Privacy Policy from time to time. Any changes will be posted on this page with an updated "Last Updated" date.</p>

                    <h2>8. Contact Us</h2>
                    <p>If you have any questions or requests regarding this Privacy Policy or how your data is handled, please contact:</p>
                    <ul>
                        <li><strong>Entity:</strong> Concept 360 Plus / Green Earth Network</li>
                        <li><strong>System:</strong> Garage Management System (GMS ERP)</li>
                        <li><strong>Website:</strong> <a href="https://c3p.greenearthnetwork.in/gms_erp/" target="_blank">https://c3p.greenearthnetwork.in/gms_erp/</a></li>
                    </ul>
                </div>

                <div class="footer-note">
                    <p>&copy; <?= date('Y') ?> GMS ERP. All rights reserved. | <a href="<?= site_url('terms') ?>">Terms of Service</a></p>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
