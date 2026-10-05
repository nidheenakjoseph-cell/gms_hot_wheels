<?php
/**
 * Service Reminder Settings
 * UI styled to match the GMS application pattern (email_settings / whatsapp setup).
 */
$setting = $current_setting;
$period  = (int) ($setting->reminder_period_months ?? 3);
$rm      = (int) ($setting->reminder_date_months   ?? 0);
$rw      = (int) ($setting->reminder_date_weeks    ?? 1);
?>

<style>
/* ── Reuse app-wide card & form patterns ── */
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
    margin: 0 0 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #e5e7eb;
}
.es-form-row {
    display: grid;
    grid-template-columns: 220px 1fr;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
}
.es-form-row label {
    font-size: 0.875rem;
    font-weight: 600;
    color: #374151;
}
.es-form-row .hint {
    grid-column: 2;
    font-size: 0.78rem;
    color: #6b7280;
    margin-top: -10px;
    margin-bottom: 4px;
    line-height: 1.5;
}
.es-input {
    width: 100%;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 0.875rem;
    color: #111827;
    background: #fafafa;
    transition: border-color .15s, box-shadow .15s;
    box-sizing: border-box;
}
.es-input:focus {
    outline: none;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
    background: #fff;
}
select.es-input { appearance: auto; cursor: pointer; }

/* inline selects row */
.inline-selects {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}
.inline-selects select.es-input { width: auto; min-width: 90px; }
.inline-selects .sep {
    font-size: 0.875rem;
    color: #9ca3af;
    font-weight: 600;
}
.inline-selects .unit {
    font-size: 0.82rem;
    color: #6b7280;
    white-space: nowrap;
}

/* Buttons */
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
.btn-primary:hover  { background: #1d4ed8; }
.btn-primary:active { transform: scale(.97); }

.btn-outline-secondary {
    background: transparent;
    border: 1.5px solid #d1d5db;
    color: #374151;
    border-radius: 6px;
    padding: 8px 18px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: background .15s, border-color .15s;
}
.btn-outline-secondary:hover { background: #f3f4f6; border-color: #9ca3af; }

/* Alerts */
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
.flash-error {
    background: #fee2e2;
    border: 1px solid #fecaca;
    color: #991b1b;
    border-radius: 8px;
    padding: 12px 18px;
    margin-bottom: 18px;
    font-weight: 600;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Preview info box */
.preview-box {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 0.82rem;
    color: #1e40af;
    line-height: 1.6;
}
.preview-box strong { color: #1e3a8a; }

/* Divider */
.es-divider { border: none; border-top: 1px solid #f1f5f9; margin: 4px 0 22px; }

/* Form footer */
.form-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
    padding-top: 16px;
    border-top: 1px solid #f1f5f9;
    align-items: center;
}

/* Responsive */
@media (max-width: 640px) {
    .es-form-row { grid-template-columns: 1fr; }
    .es-form-row .hint { grid-column: 1; }
    .form-footer { flex-direction: column-reverse; align-items: stretch; }
    .form-footer .btn-primary,
    .form-footer .btn-outline-secondary { text-align: center; justify-content: center; }
}
</style>

<div style="padding: 24px;">

    <!-- Flash messages -->
    <?php if ($this->session->flashdata('success')): ?>
    <div class="flash-success">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <?= htmlspecialchars($this->session->flashdata('success')) ?>
    </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
    <div class="flash-error">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <?= htmlspecialchars($this->session->flashdata('error')) ?>
    </div>
    <?php endif; ?>

    <!-- Page title -->
    <div style="margin-bottom: 20px; display:flex; align-items:flex-start; justify-content:space-between; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size:1.35rem; font-weight:800; color:#1e293b; margin:0;">⚙️ Service Reminder Settings</h1>
            <p style="color:#64748b; font-size:0.875rem; margin:4px 0 0;">
                Configure when next service is due and how early customers should be reminded.
            </p>
        </div>
        <a href="<?= base_url('index.php/ServiceReminder/index') ?>" class="btn-outline-secondary">
            ← Back to List
        </a>
    </div>

    <form method="post" action="<?= base_url('index.php/ServiceReminder/settings') ?>">

        <!-- ── SECTION 1: Next Service Interval ── -->
        <div class="es-card">
            <p class="es-section-title">📅 Next Service Interval</p>

            <div class="es-form-row">
                <label for="reminder_period_months">Service Due After</label>
                <div class="inline-selects">
                    <select name="reminder_period_months" id="reminder_period_months" class="es-input">
                        <?php for ($m = 1; $m <= 24; $m++): ?>
                            <option value="<?= $m ?>" <?= $period === $m ? 'selected' : '' ?>>
                                <?= $m ?> month<?= $m > 1 ? 's' : '' ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                    <span class="unit">after the last job card closing date</span>
                </div>
            </div>
            <div class="es-form-row">
                <span></span>
                <p class="hint" style="margin-top:0;">
                    When a job card is completed, the system will automatically schedule the customer's next service this many months later.
                </p>
            </div>
        </div>

        <!-- ── SECTION 2: Reminder Date ── -->
        <div class="es-card">
            <p class="es-section-title">🔔 Customer Reminder Timing</p>

            <div class="es-form-row">
                <label>Remind Customer</label>
                <div class="inline-selects">
                    <select name="reminder_date_months" id="reminder_date_months" class="es-input">
                        <?php for ($m = 0; $m <= 6; $m++): ?>
                            <option value="<?= $m ?>" <?= $rm === $m ? 'selected' : '' ?>>
                                <?= $m ?> month<?= $m !== 1 ? 's' : '' ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                    <span class="sep">+</span>
                    <select name="reminder_date_weeks" id="reminder_date_weeks" class="es-input">
                        <?php for ($w = 0; $w <= 4; $w++): ?>
                            <option value="<?= $w ?>" <?= $rw === $w ? 'selected' : '' ?>>
                                <?= $w ?> week<?= $w !== 1 ? 's' : '' ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                    <span class="unit">before the next service date</span>
                </div>
            </div>
            <div class="es-form-row">
                <span></span>
                <p class="hint" style="margin-top:0;">
                    Set how early the reminder should appear so you can notify customers before their service is due.<br>
                    Example: <em>0 months + 2 weeks</em> before → if service is due Jan 1, reminder shows Dec 18.
                </p>
            </div>

            <hr class="es-divider">

            <!-- Live preview -->
            <div class="es-form-row">
                <label style="color:#2563eb;">📋 Preview</label>
                <div class="preview-box" id="sr-preview">Computing…</div>
            </div>

            <!-- Save -->
            <div class="form-footer">
                <a href="<?= base_url('index.php/ServiceReminder/index') ?>" class="btn-outline-secondary">Cancel</a>
                <button type="submit" class="btn-primary">💾 Save Settings</button>
            </div>
        </div>

    </form>
</div>

<script>
(function () {
    var periodSel = document.getElementById('reminder_period_months');
    var rmSel     = document.getElementById('reminder_date_months');
    var rwSel     = document.getElementById('reminder_date_weeks');
    var box       = document.getElementById('sr-preview');

    function update() {
        var period = parseInt(periodSel.value, 10);
        var rm     = parseInt(rmSel.value, 10);
        var rw     = parseInt(rwSel.value, 10);

        var parts = [];
        if (rm > 0) parts.push('<strong>' + rm + ' month' + (rm !== 1 ? 's' : '') + '</strong>');
        if (rw > 0) parts.push('<strong>' + rw + ' week'  + (rw !== 1 ? 's' : '') + '</strong>');

        var remindPart = parts.length
            ? parts.join(' and ') + ' before the next service date'
            : 'on the same day as the next service date';

        box.innerHTML =
            'After a job card closes, the customer\'s next service is scheduled '
            + '<strong>' + period + ' month' + (period !== 1 ? 's' : '') + '</strong> later. '
            + 'A reminder will be flagged '
            + remindPart + '.';
    }

    periodSel.addEventListener('change', update);
    rmSel.addEventListener('change', update);
    rwSel.addEventListener('change', update);
    update();
})();
</script>
