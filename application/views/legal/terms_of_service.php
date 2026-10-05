<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= html_escape($title ?? 'Terms of Service | GMS ERP') ?></title>
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
            <h1 class="h2 mt-2 mb-1 fw-bold">Terms of Service</h1>
            <p class="text-white-50 mb-0">Last Updated: <?= html_escape($last_updated ?? 'September 24, 2026') ?></p>
        </div>
    </header>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="legal-card">
                    <p class="lead" style="font-size: 1.05rem;">
                        These Terms of Service ("Terms") govern your access to and use of <strong>GMS ERP</strong> ("the Platform"), developed and operated by <strong>Concept 360 Plus / Green Earth Network</strong>. By accessing or using the Platform, you agree to be bound by these Terms.
                    </p>

                    <h2>1. Use of the Platform</h2>
                    <p>GMS ERP provides workshop management, vehicle repair estimations, job card tracking, vehicle inspections, accounting, and automated messaging capabilities for auto garages and service centers. Users agree to:</p>
                    <ul>
                        <li>Use the platform only for lawful business operations and in accordance with these Terms.</li>
                        <li>Ensure all customer, vehicle, and repair data entered into the system is accurate and authorized.</li>
                        <li>Maintain the confidentiality of login credentials and immediately report any unauthorized access.</li>
                    </ul>

                    <h2>2. WhatsApp Messaging Terms & Conditions</h2>
                    <p>GMS ERP integrates with Meta's WhatsApp Business Cloud API to enable garages to communicate with their customers. By utilizing our WhatsApp integration:</p>
                    <ul>
                        <li><strong>Authorized Communications Only:</strong> Garages may only transmit operational messages (invoices, repair updates, job cards, service reminders) to customers who have voluntarily provided their contact numbers for vehicle servicing.</li>
                        <li><strong>Opt-In and Opt-Out:</strong> Customers must be provided an option to opt out of automated messaging at any time (e.g. by replying <code>STOP</code>).</li>
                        <li><strong>Meta Policy Compliance:</strong> All messaging must comply with Meta's <a href="https://www.whatsapp.com/legal/business-policy/" target="_blank">WhatsApp Business Messaging Policy</a> and <a href="https://www.whatsapp.com/legal/commerce-policy/" target="_blank">Commerce Policy</a>. Sending spam, unauthorized marketing, or prohibited content is strictly forbidden.</li>
                    </ul>

                    <h2>3. Data Protection & Intellectual Property</h2>
                    <p>Garages retain full ownership of customer records and business data entered into the platform. GMS ERP, including its source code, user interface, brand assets, and proprietary workflows, remains the exclusive intellectual property of Concept 360 Plus / Green Earth Network.</p>

                    <h2>4. Limitation of Liability</h2>
                    <p>To the fullest extent permitted by applicable law, GMS ERP and its operators shall not be liable for indirect, incidental, special, consequential, or punitive damages resulting from:</p>
                    <ul>
                        <li>Service interruptions, network failures, or delays by third-party APIs (including Meta / WhatsApp or SMS gateways).</li>
                        <li>Incorrect vehicle information or customer contact numbers entered by users.</li>
                        <li>Unauthorized access resulting from compromised user credentials.</li>
                    </ul>

                    <h2>5. Termination of Access</h2>
                    <p>We reserve the right to suspend or terminate access to the Platform or its WhatsApp messaging integration if a user violates these Terms, abuses the messaging service, or engages in fraudulent activities.</p>

                    <h2>6. Modifications to Terms</h2>
                    <p>We may update these Terms from time to time. Continued use of the Platform after changes are posted constitutes acceptance of the revised Terms.</p>

                    <h2>7. Contact Information</h2>
                    <p>For questions or support regarding these Terms of Service, please reach out to:</p>
                    <ul>
                        <li><strong>Entity:</strong> Concept 360 Plus / Green Earth Network</li>
                        <li><strong>System:</strong> Garage Management System (GMS ERP)</li>
                        <li><strong>Website:</strong> <a href="https://c3p.greenearthnetwork.in/gms_erp/" target="_blank">https://c3p.greenearthnetwork.in/gms_erp/</a></li>
                    </ul>
                </div>

                <div class="footer-note">
                    <p>&copy; <?= date('Y') ?> GMS ERP. All rights reserved. | <a href="<?= site_url('privacy-policy') ?>">Privacy Policy</a></p>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
