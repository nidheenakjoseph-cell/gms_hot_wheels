<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>

.es-tab-btn {
    padding: 10px 24px;
    font-size: 0.875rem;
    font-weight: 600;
    border: none;
    border-bottom: 3px solid transparent;
    background: transparent;
    color: #6b7280;
    cursor: pointer;
    transition: all .2s;
}
.es-tab-btn.active {
    color: #2563eb;
    border-bottom-color: #2563eb;
}
.es-tab-btn:hover:not(.active) {
    color: #374151;
    background: #f3f4f6;
}
.es-tab-pane { display: none; }
.es-tab-pane.active { display: block; }

.es-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 1px 6px rgba(0,0,0,.08);
    padding: 28px 32px;
    margin-bottom: 24px;
}
.es-section-title {
    font-size: 1rem;
    font-weight: 700;
    color: #1e3a5f;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e5e7eb;
}

.es-form-row {
    display: grid;
    grid-template-columns: 180px 1fr;
    align-items: center;
    gap: 12px;
    margin-bottom: 14px;
}
.es-form-row label {
    font-size: 0.875rem;
    font-weight: 600;
    color: #374151;
}
.es-input {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 0.875rem;
    color: #111827;
    transition: border-color .15s, box-shadow .15s;
    background: #fafafa;
}
.es-input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
    background: #fff;
}
select.es-input { appearance: auto; }

/* ---- Buttons ---- */
.btn-primary {
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 9px 22px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s, transform .1s;
}
.btn-primary:hover { background: #1d4ed8; }
.btn-primary:active { transform: scale(.97); }

.btn-success {
    background: #16a34a;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 9px 22px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s;
}
.btn-success:hover { background: #15803d; }

.btn-danger {
    background: #dc2626;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 6px 14px;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    border-radius: 5px;
    transition: background .2s;
}
.btn-danger:hover { background: #b91c1c; }

.btn-edit {
    background: #f59e0b;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 6px 14px;
    font-size: 0.8rem;
    font-weight: 600;
    cursor: pointer;
    transition: background .2s;
}
.btn-edit:hover { background: #d97706; }

.btn-outline {
    background: transparent;
    border: 1.5px solid #2563eb;
    color: #2563eb;
    border-radius: 6px;
    padding: 8px 18px;
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all .2s;
}
.btn-outline:hover { background: #2563eb; color: #fff; }

/* ---- Test email inline row ---- */
.test-row {
    display: flex;
    gap: 10px;
    align-items: center;
    margin-top: 6px;
}
.test-row .es-input { max-width: 320px; }
#test-result {
    font-size: 0.82rem;
    font-weight: 600;
    padding: 6px 12px;
    border-radius: 5px;
    display: none;
}
#test-result.ok  { background:#dcfce7; color:#166534; display:inline-block; }
#test-result.err { background:#fee2e2; color:#991b1b; display:inline-block; }

/* ---- Placeholder badges ---- */
.placeholder-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 6px;
}
.placeholder-chip {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    color: #1d4ed8;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 3px 9px;
    border-radius: 20px;
    cursor: pointer;
    user-select: none;
    transition: background .15s;
}
.placeholder-chip:hover { background: #dbeafe; }

/* ---- Template table ---- */
.es-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}
.es-table th {
    background: #f1f5f9;
    color: #475569;
    font-weight: 700;
    padding: 10px 14px;
    text-align: left;
    border-bottom: 2px solid #e2e8f0;
}
.es-table td {
    padding: 10px 14px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
    color: #374151;
}
.es-table tr:hover td { background: #f8fafc; }
.es-table .badge {
    display: inline-block;
    padding: 2px 9px;
    border-radius: 12px;
    font-size: 0.72rem;
    font-weight: 700;
}
.badge-blue { background: #dbeafe; color: #1d4ed8; }
.badge-gray { background: #f1f5f9; color: #64748b; font-family: monospace; }

/* ---- Modal ---- */
.es-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(15,23,42,.45);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}
.es-modal-overlay.open { display: flex; }
.es-modal {
    background: #fff;
    border-radius: 12px;
    width: 90%;
    max-width: 760px;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,.25);
    padding: 32px;
    animation: modalIn .22s ease;
}
@keyframes modalIn {
    from { opacity: 0; transform: translateY(-18px); }
    to   { opacity: 1; transform: translateY(0); }
}
.es-modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 22px;
}
.es-modal-title { font-size: 1.05rem; font-weight: 700; color: #1e3a5f; }
.es-modal-close {
    background: none;
    border: none;
    font-size: 1.4rem;
    color: #6b7280;
    cursor: pointer;
    line-height: 1;
    padding: 0 4px;
}
.es-modal-close:hover { color: #111; }
.es-modal-footer {
    margin-top: 22px;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

/* ---- Textarea editor ---- */
.es-textarea {
    width: 100%;
    min-height: 200px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 10px 12px;
    font-size: 0.82rem;
    font-family: 'Courier New', monospace;
    color: #111827;
    resize: vertical;
    background: #fafafa;
    transition: border-color .15s;
}
.es-textarea:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,.1);
    background: #fff;
}

/* ---- Alert flash ---- */
.flash-success {
    background: #dcfce7;
    border: 1px solid #bbf7d0;
    color: #166534;
    border-radius: 8px;
    padding: 12px 18px;
    margin-bottom: 18px;
    font-weight: 600;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 8px;
}
</style>

<div style="padding:24px;">

    <!-- Flash message -->
    <?php if ($this->session->flashdata('success')): ?>
    <div class="flash-success">
        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <?= $this->session->flashdata('success') ?>
    </div>
    <?php endif; ?>

    <!-- Page title -->
    <div style="margin-bottom:20px;">
        <h1 style="font-size:1.35rem;font-weight:800;color:#1e293b;margin:0;">📧 Email Settings</h1>
        <p style="color:#64748b;font-size:0.875rem;margin:4px 0 0;">Manage SMTP credentials and email templates per company.</p>
    </div>

    <!-- Tab Nav -->
    <div style="border-bottom:2px solid #e5e7eb;margin-bottom:24px;display:flex;gap:4px;">
        <button class="es-tab-btn active" data-tab="smtp-tab" id="tab-smtp">
            🔐 SMTP Configuration
        </button>
        <button class="es-tab-btn" data-tab="templates-tab" id="tab-templates">
            📝 Email Templates
        </button>
    </div>

    <!-- ========================================================
         TAB 1: SMTP CONFIGURATION 
         ======================================================== -->
    <div class="es-tab-pane active" id="smtp-tab">
        <div class="es-card">
            <p class="es-section-title">Outgoing Mail Server (SMTP)</p>

            <form id="smtp-form" action="<?= base_url('index.php/Admin/save_smtp_settings') ?>" method="POST" autocomplete="off">
                <input type="hidden" name="company_id" value="<?= $company_id ?>">

                <!-- Host -->
                <div class="es-form-row">
                    <label for="smtp_host">SMTP Host <span style="color:#dc2626;">*</span></label>
                    <input type="text" class="es-input" id="smtp_host" name="smtp_host"
                           placeholder="e.g. smtp.gmail.com"
                           value="<?= $smtp_settings ? htmlspecialchars($smtp_settings->smtp_host) : '' ?>" required>
                </div>

                <!-- Port + Encryption -->
                <div class="es-form-row">
                    <label>Port / Encryption <span style="color:#dc2626;">*</span></label>
                    <div style="display:flex;gap:10px;">
                        <input type="number" class="es-input" id="smtp_port" name="smtp_port"
                               style="max-width:110px;"
                               placeholder="587"
                               value="<?= $smtp_settings ? (int)$smtp_settings->smtp_port : 587 ?>" required>
                        <select class="es-input" id="smtp_encryption" name="smtp_encryption" style="max-width:150px;">
                            <option value="tls"  <?= ($smtp_settings && $smtp_settings->smtp_encryption === 'tls')  ? 'selected' : '' ?>>TLS (recommended)</option>
                            <option value="ssl"  <?= ($smtp_settings && $smtp_settings->smtp_encryption === 'ssl')  ? 'selected' : '' ?>>SSL</option>
                            <option value="none" <?= ($smtp_settings && $smtp_settings->smtp_encryption === 'none') ? 'selected' : '' ?>>None</option>
                        </select>
                    </div>
                </div>

                <!-- Username -->
                <div class="es-form-row">
                    <label for="smtp_username">SMTP Username <span style="color:#dc2626;">*</span></label>
                    <input type="text" class="es-input" id="smtp_username" name="smtp_username"
                           placeholder="your@email.com"
                           value="<?= $smtp_settings ? htmlspecialchars($smtp_settings->smtp_username) : '' ?>" required>
                </div>

                <!-- Password -->
                <div class="es-form-row">
                    <label for="smtp_password">Password</label>
                    <div style="position:relative;max-width:400px;">
                        <input type="password" class="es-input" id="smtp_password" name="smtp_password"
                               placeholder="<?= $smtp_settings ? '••••••••  (leave blank to keep existing)' : 'Enter SMTP password' ?>"
                               style="padding-right:40px;">
                        <button type="button" onclick="toggleSmtpPassword()"
                                style="position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#6b7280;font-size:1rem;"
                                title="Show/hide password">👁</button>
                    </div>
                </div>

                <!-- From Email -->
                <div class="es-form-row">
                    <label for="smtp_from_email">From Email <span style="color:#dc2626;">*</span></label>
                    <input type="email" class="es-input" id="smtp_from_email" name="smtp_from_email"
                           placeholder="noreply@yourworkshop.com" style="max-width:400px;"
                           value="<?= $smtp_settings ? htmlspecialchars($smtp_settings->smtp_from_email) : '' ?>" required>
                </div>

                <!-- From Name -->
                <div class="es-form-row">
                    <label for="smtp_from_name">From Name</label>
                    <input type="text" class="es-input" id="smtp_from_name" name="smtp_from_name"
                           placeholder="e.g. Elite Auto Workshop" style="max-width:400px;"
                           value="<?= $smtp_settings ? htmlspecialchars($smtp_settings->smtp_from_name) : '' ?>">
                </div>

                <!-- Save button -->
                <div style="display:flex;justify-content:flex-end;gap:12px;margin-top:20px;padding-top:16px;border-top:1px solid #f1f5f9;">
                    <button type="submit" class="btn-primary">💾 Save SMTP Settings</button>
                </div>
            </form>
        </div>

        <!-- Test Connection -->
        <div class="es-card">
            <p class="es-section-title">🧪 Test SMTP Connection</p>
            <p style="font-size:0.875rem;color:#64748b;margin-bottom:14px;">
                Send a test email to verify your SMTP settings are working correctly.
            </p>
            <div class="test-row">
                <input type="email" class="es-input" id="test_email" placeholder="recipient@example.com">
                <button type="button" class="btn-outline" id="btn-test-smtp" onclick="sendTestEmail()">
                    ✉ Send Test Email
                </button>
                <span id="test-result"></span>
            </div>
        </div>

        <!-- Help card -->
        <!-- <div class="es-card" style="background:#fffbeb;border:1px solid #fde68a;">
            <p class="es-section-title" style="color:#92400e;">💡 Common SMTP Settings</p>
            <table style="font-size:0.82rem;border-collapse:collapse;width:100%;">
                <thead>
                    <tr style="background:#fef3c7;">
                        <th style="padding:8px 12px;text-align:left;color:#78350f;border-bottom:1px solid #fde68a;">Provider</th>
                        <th style="padding:8px 12px;text-align:left;color:#78350f;border-bottom:1px solid #fde68a;">Host</th>
                        <th style="padding:8px 12px;text-align:left;color:#78350f;border-bottom:1px solid #fde68a;">Port</th>
                        <th style="padding:8px 12px;text-align:left;color:#78350f;border-bottom:1px solid #fde68a;">Encryption</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td style="padding:7px 12px;border-bottom:1px solid #fef3c7;">Gmail</td><td style="padding:7px 12px;border-bottom:1px solid #fef3c7;font-family:monospace;">smtp.gmail.com</td><td style="padding:7px 12px;border-bottom:1px solid #fef3c7;">587</td><td style="padding:7px 12px;border-bottom:1px solid #fef3c7;">TLS</td></tr>
                    <tr><td style="padding:7px 12px;border-bottom:1px solid #fef3c7;">Outlook / Office 365</td><td style="padding:7px 12px;border-bottom:1px solid #fef3c7;font-family:monospace;">smtp.office365.com</td><td style="padding:7px 12px;border-bottom:1px solid #fef3c7;">587</td><td style="padding:7px 12px;border-bottom:1px solid #fef3c7;">TLS</td></tr>
                    <tr><td style="padding:7px 12px;border-bottom:1px solid #fef3c7;">Yahoo Mail</td><td style="padding:7px 12px;border-bottom:1px solid #fef3c7;font-family:monospace;">smtp.mail.yahoo.com</td><td style="padding:7px 12px;border-bottom:1px solid #fef3c7;">465</td><td style="padding:7px 12px;border-bottom:1px solid #fef3c7;">SSL</td></tr>
                    <tr><td style="padding:7px 12px;">Zoho Mail</td><td style="padding:7px 12px;font-family:monospace;">smtp.zoho.com</td><td style="padding:7px 12px;">587</td><td style="padding:7px 12px;">TLS</td></tr>
                </tbody>
            </table>
            <p style="font-size:0.78rem;color:#92400e;margin-top:10px;">
                ⚠ For Gmail, use an <strong>App Password</strong> (not your main password). Enable 2FA → Google Account → Security → App Passwords.
            </p>
        </div> -->
    </div><!-- /smtp-tab -->


    <!-- ========================================================
         TAB 2: EMAIL TEMPLATES
         ======================================================== -->
    <div class="es-tab-pane" id="templates-tab">
        <div class="es-card">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:16px;">
                <p class="es-section-title" style="margin:0;border:none;padding:0;">All Email Templates</p>
                <button class="btn-primary" onclick="openTemplateModal(0)">+ Add Template</button>
            </div>

            <div style="overflow-x:auto;">
                <table class="es-table" id="templates-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Template Key</th>
                            <th>Template Name</th>
                            <th>Subject</th>
                            <th>Company</th>
                            <th>Updated</th>
                            <th style="text-align:center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($email_templates)): ?>
                            <?php foreach ($email_templates as $i => $t): ?>
                            <tr id="template-row-<?= $t->id ?>">
                                <td style="color:#94a3b8;"><?= $i + 1 ?></td>
                                <td><span><?= htmlspecialchars($t->template_key) ?></span></td>
                                <td style="font-weight:600;"><?= htmlspecialchars($t->template_name) ?></td>
                                <td style="max-width:260px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"
                                    title="<?= htmlspecialchars($t->subject) ?>">
                                    <?= htmlspecialchars($t->subject) ?>
                                </td>
                                <td><span><?= htmlspecialchars($t->company_name ?? 'Company #'.$t->company_id) ?></span></td>
                                <td style="color:#94a3b8;font-size:0.78rem;"><?= $t->updated_at ? date('d M Y', strtotime($t->updated_at)) : '—' ?></td>
                                <td style="text-align:center;white-space:nowrap;">
                                    <button class="btn-edit" onclick="openTemplateModal(<?= $t->id ?>)">✏ Edit</button>
                                    <button class="btn-danger" onclick="deleteTemplate(<?= $t->id ?>)">🗑</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="7" style="text-align:center;color:#94a3b8;padding:30px;">No templates found. Click <strong>+ Add Template</strong> to create one.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Placeholder reference card -->
        <div class="es-card" style="background:#f0fdf4;border:1px solid #bbf7d0;">
            <p class="es-section-title" style="color:#166534;border-color:#bbf7d0;">📌 Available Placeholders</p>
            <p style="font-size:0.82rem;color:#166534;margin-bottom:10px;">Click a placeholder to copy it to your clipboard.</p>
            <div class="placeholder-chips" id="global-chips">
                <span class="placeholder-chip" onclick="copyChip(this)">{customer_name}</span>
                <span class="placeholder-chip" onclick="copyChip(this)">{vehicle_no}</span>
                <span class="placeholder-chip" onclick="copyChip(this)">{invoice_no}</span>
                <span class="placeholder-chip" onclick="copyChip(this)">{quotation_no}</span>
                <span class="placeholder-chip" onclick="copyChip(this)">{jobcard_no}</span>
                <span class="placeholder-chip" onclick="copyChip(this)">{amount}</span>
                <span class="placeholder-chip" onclick="copyChip(this)">{date}</span>
                <span class="placeholder-chip" onclick="copyChip(this)">{company_name}</span>
                <span class="placeholder-chip" onclick="copyChip(this)">{company_phone}</span>
                <span class="placeholder-chip" onclick="copyChip(this)">{policy_no}</span>
                <span class="placeholder-chip" onclick="copyChip(this)">{expiry_date}</span>
            </div>
        </div>
    </div><!-- /templates-tab -->

</div><!-- /page wrapper -->


<!-- ================================================================
     TEMPLATE MODAL (Add / Edit)
     ================================================================ -->
<div class="es-modal-overlay" id="template-modal">
    <div class="es-modal">
        <div class="es-modal-header">
            <span class="es-modal-title" id="modal-title">Add Email Template</span>
            <button class="es-modal-close" onclick="closeTemplateModal()">×</button>
        </div>

        <input type="hidden" id="modal_template_id" value="0">
        <input type="hidden" id="modal_company_id" value="<?= $company_id ?>">

        <!-- Template Key -->
        <div style="margin-bottom:14px;">
            <label style="font-size:0.85rem;font-weight:700;color:#374151;display:block;margin-bottom:5px;">
                Template Key <span style="color:#dc2626;">*</span>
                <span style="font-weight:400;color:#94a3b8;font-size:0.78rem;">(unique slug, e.g. invoice_sent)</span>
            </label>
            <input type="text" class="es-input" id="modal_template_key" placeholder="e.g. invoice_sent"
                   style="font-family:monospace;">
        </div>

        <!-- Template Name -->
        <div style="margin-bottom:14px;">
            <label style="font-size:0.85rem;font-weight:700;color:#374151;display:block;margin-bottom:5px;">
                Template Name <span style="color:#dc2626;">*</span>
            </label>
            <input type="text" class="es-input" id="modal_template_name" placeholder="e.g. Invoice Sent to Customer">
        </div>

        <!-- Subject -->
        <div style="margin-bottom:14px;">
            <label style="font-size:0.85rem;font-weight:700;color:#374151;display:block;margin-bottom:5px;">
                Email Subject <span style="color:#dc2626;">*</span>
            </label>
            <input type="text" class="es-input" id="modal_subject" placeholder="e.g. Invoice #{invoice_no} from {company_name}">
        </div>

        <!-- HTML Body -->
        <div style="margin-bottom:10px;">
            <label style="font-size:0.85rem;font-weight:700;color:#374151;display:block;margin-bottom:5px;">
                Email Body (HTML) <span style="color:#dc2626;">*</span>
            </label>
            <div class="placeholder-chips" style="margin-bottom:8px;">
                <span class="placeholder-chip" onclick="insertPlaceholder(this)">{customer_name}</span>
                <span class="placeholder-chip" onclick="insertPlaceholder(this)">{vehicle_no}</span>
                <span class="placeholder-chip" onclick="insertPlaceholder(this)">{invoice_no}</span>
                <span class="placeholder-chip" onclick="insertPlaceholder(this)">{amount}</span>
                <span class="placeholder-chip" onclick="insertPlaceholder(this)">{date}</span>
                <span class="placeholder-chip" onclick="insertPlaceholder(this)">{company_name}</span>
                <span class="placeholder-chip" onclick="insertPlaceholder(this)">{company_phone}</span>
            </div>
            <textarea class="es-textarea" id="modal_html_body" rows="10"
                      placeholder="<p>Dear {customer_name},</p>&#10;<p>Your invoice #{invoice_no} is ready.</p>"></textarea>
        </div>

        <!-- Save feedback -->
        <div id="modal-save-msg" style="font-size:0.82rem;font-weight:600;min-height:20px;"></div>

        <div class="es-modal-footer">
            <button type="button" class="btn-outline" onclick="closeTemplateModal()">Cancel</button>
            <button type="button" class="btn-success" onclick="saveTemplate()">💾 Save Template</button>
        </div>
    </div>
</div>


<script>
const EMAIL_ADMIN_URL = '<?= base_url('index.php/Admin/') ?>';
const EMAIL_COMPANY_ID = <?= (int)$company_id ?>;

// ---- TAB SYSTEM ----
document.querySelectorAll('.es-tab-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.es-tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.es-tab-pane').forEach(p => p.classList.remove('active'));
        this.classList.add('active');
        document.getElementById(this.dataset.tab).classList.add('active');
    });
});

// ---- PASSWORD TOGGLE ----
function toggleSmtpPassword() {
    const f = document.getElementById('smtp_password');
    f.type = (f.type === 'password') ? 'text' : 'password';
}

// ---- SEND TEST EMAIL ----
function sendTestEmail() {
    const email = document.getElementById('test_email').value.trim();
    const btn   = document.getElementById('btn-test-smtp');
    const res   = document.getElementById('test-result');

    if (!email) { alert('Please enter a test email address.'); return; }

    btn.disabled = true;
    btn.textContent = '⏳ Sending…';
    res.className = '';
    res.style.display = 'none';

    fetch(EMAIL_ADMIN_URL + 'test_smtp', {
        method: 'POST',
        credentials: 'same-origin',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'company_id=' + EMAIL_COMPANY_ID + '&test_email=' + encodeURIComponent(email)
    })
    .then(async r => {
        const responseText = await r.text();
        if (r.redirected && /\/login(?:[/?#]|$)/i.test(r.url)) {
            console.error('SMTP test was redirected to login:', r.url);
            return {status: false, message: 'Your login session has expired. Please log in again and retry.'};
        }

        let data;
        try {
            data = JSON.parse(responseText);
        } catch (error) {
            console.error('SMTP test returned a non-JSON response:', r.status, responseText);
            return {status: false, message: 'The server returned an invalid response (HTTP ' + r.status + ').'};
        }
        if (!r.ok) {
            return {status: false, message: data.message || ('Server returned HTTP ' + r.status + '.')};
        }
        return data;
    })
    .then(data => {
        res.textContent = data.message;
        res.className = data.status ? 'ok' : 'err';
        res.style.display = 'inline-block';
    })
    .catch((error) => {
        console.error('SMTP test request failed:', error);
        res.textContent = error.message || 'SMTP test request failed.';
        res.className = 'err';
        res.style.display = 'inline-block';
    })
    .finally(() => {
        btn.disabled = false;
        btn.textContent = '✉ Send Test Email';
    });
}

// ---- TEMPLATE MODAL ----
function openTemplateModal(id) {
    document.getElementById('modal-title').textContent  = id ? 'Edit Email Template' : 'Add Email Template';
    document.getElementById('modal_template_id').value  = id;
    document.getElementById('modal_template_key').value = '';
    document.getElementById('modal_template_name').value = '';
    document.getElementById('modal_subject').value      = '';
    document.getElementById('modal_html_body').value    = '';
    document.getElementById('modal-save-msg').textContent = '';

    // Lock key field for existing templates
    document.getElementById('modal_template_key').readOnly = (id > 0);
    document.getElementById('modal_template_key').style.background = id ? '#f1f5f9' : '';

    if (id > 0) {
        fetch(EMAIL_ADMIN_URL + 'get_email_template', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'id=' + id
        })
        .then(r => r.json())
        .then(resp => {
            if (resp.status) {
                const d = resp.data;
                document.getElementById('modal_template_key').value  = d.template_key;
                document.getElementById('modal_template_name').value = d.template_name;
                document.getElementById('modal_subject').value       = d.subject;
                document.getElementById('modal_html_body').value     = d.html_body;
            }
        });
    }
    document.getElementById('template-modal').classList.add('open');
}

function closeTemplateModal() {
    document.getElementById('template-modal').classList.remove('open');
}

// Close on overlay click
document.getElementById('template-modal').addEventListener('click', function(e) {
    if (e.target === this) closeTemplateModal();
});

function saveTemplate() {
    const id   = document.getElementById('modal_template_id').value;
    const key  = document.getElementById('modal_template_key').value.trim();
    const name = document.getElementById('modal_template_name').value.trim();
    const subj = document.getElementById('modal_subject').value.trim();
    const body = document.getElementById('modal_html_body').value.trim();
    const msg  = document.getElementById('modal-save-msg');

    if (!key || !name || !subj || !body) {
        msg.style.color = '#dc2626';
        msg.textContent = '⚠ All fields are required.';
        return;
    }

    msg.style.color = '#6b7280';
    msg.textContent = 'Saving…';

    const params = new URLSearchParams({
        template_id:   id,
        company_id:    EMAIL_COMPANY_ID,
        template_key:  key,
        template_name: name,
        subject:       subj,
        html_body:     body
    });

    fetch(EMAIL_ADMIN_URL + 'save_email_template', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: params.toString()
    })
    .then(r => r.json())
    .then(resp => {
        if (resp.status) {
            msg.style.color = '#16a34a';
            msg.textContent = '✓ ' + resp.message;
            setTimeout(() => { closeTemplateModal(); location.reload(); }, 800);
        } else {
            msg.style.color = '#dc2626';
            msg.textContent = '✗ ' + resp.message;
        }
    })
    .catch(() => {
        msg.style.color = '#dc2626';
        msg.textContent = 'Request failed.';
    });
}

function deleteTemplate(id) {
    if (!confirm('Delete this email template? This cannot be undone.')) return;

    fetch(EMAIL_ADMIN_URL + 'delete_email_template', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: 'id=' + id
    })
    .then(r => r.json())
    .then(resp => {
        if (resp.status) {
            const row = document.getElementById('template-row-' + id);
            if (row) row.remove();
        } else {
            alert(resp.message);
        }
    });
}

// ---- PLACEHOLDER HELPERS ----
function insertPlaceholder(chip) {
    const ta = document.getElementById('modal_html_body');
    const start = ta.selectionStart;
    const end   = ta.selectionEnd;
    const val   = ta.value;
    ta.value = val.substring(0, start) + chip.textContent + val.substring(end);
    ta.selectionStart = ta.selectionEnd = start + chip.textContent.length;
    ta.focus();
}

function copyChip(chip) {
    navigator.clipboard.writeText(chip.textContent).then(() => {
        const orig = chip.textContent;
        chip.textContent = '✓ Copied!';
        chip.style.background = '#dcfce7';
        setTimeout(() => { chip.textContent = orig; chip.style.background = ''; }, 1200);
    });
}
</script>
