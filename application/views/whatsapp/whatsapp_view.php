<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!-- Facebook SDK for Meta Embedded Signup -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

<style>
/* ── Tab System Styling matching GMS ── */
.wa-tab-btn {
    padding: 11px 22px;
    font-size: 0.875rem;
    font-weight: 600;
    border: none;
    border-bottom: 3px solid transparent;
    background: transparent;
    color: #64748b;
    cursor: pointer;
    transition: all .2s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    white-space: nowrap;
}
.wa-tab-btn:hover:not(.active) {
    color: #0f172a;
    background: #f8fafc;
}
.wa-tab-btn.active {
    color: #059669;
    border-bottom-color: #059669;
    background: #ecfdf5;
}
.wa-tab-pane { display: none; }
.wa-tab-pane.active { display: block; }

/* ── Sub-tabs for Templates ── */
.tmpl-pill {
    padding: 7px 16px;
    font-size: 0.825rem;
    font-weight: 600;
    border-radius: 9999px;
    border: 1px solid #e2e8f0;
    background: #ffffff;
    color: #475569;
    cursor: pointer;
    transition: all .15s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.tmpl-pill:hover:not(.active) {
    background: #f1f5f9;
    color: #1e293b;
    border-color: #cbd5e1;
}
.tmpl-pill.active {
    background: #059669;
    color: #ffffff;
    border-color: #059669;
    box-shadow: 0 2px 6px rgba(5, 150, 105, 0.25);
}
.tmpl-pane { display: none; }
.tmpl-pane.active { display: block; }

/* ── Placeholder Badges / Chips ── */
.wa-chip {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    color: #1d4ed8;
    font-size: 0.75rem;
    font-weight: 600;
    font-family: monospace;
    padding: 4px 10px;
    border-radius: 6px;
    cursor: pointer;
    transition: all .15s ease;
    user-select: none;
}
.wa-chip:hover {
    background: #dbeafe;
    border-color: #93c5fd;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(37, 99, 235, 0.1);
}
.wa-chip:active {
    transform: translateY(0);
}

/* ── WhatsApp Phone Simulator ── */
.wa-phone-mockup {
    background: #efeae2;
    background-image: radial-gradient(#d3cbbe 1px, transparent 1px);
    background-size: 16px 16px;
    border-radius: 16px;
    border: 1px solid #e2dcd2;
    overflow: hidden;
    box-shadow: inset 0 2px 6px rgba(0,0,0,0.04);
}
.wa-bubble {
    background: #ffffff;
    border-radius: 10px 10px 10px 2px;
    box-shadow: 0 1px 2px rgba(0,0,0,0.13);
    position: relative;
    max-width: 90%;
    word-break: break-word;
    font-size: 0.85rem;
    line-height: 1.45;
    color: #111b21;
}

/* ── Custom Switch ── */
.switch {
    position: relative;
    display: inline-block;
    width: 44px;
    height: 24px;
}
.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}
.slider {
    position: absolute;
    cursor: pointer;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: #cbd5e1;
    transition: .25s;
    border-radius: 24px;
}
.slider:before {
    position: absolute;
    content: "";
    height: 18px;
    width: 18px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: .25s;
    border-radius: 50%;
    box-shadow: 0 1px 3px rgba(0,0,0,0.2);
}
input:checked + .slider {
    background-color: #10b981;
}
input:checked + .slider:before {
    transform: translateX(20px);
}

/* ── Floating Toast ── */
#wa-toast-container {
    position: fixed;
    top: 24px;
    right: 24px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    gap: 10px;
    pointer-events: none;
}
.wa-toast {
    pointer-events: auto;
    min-width: 280px;
    max-width: 420px;
    background: #ffffff;
    border-radius: 12px;
    padding: 14px 18px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12), 0 1px 3px rgba(0,0,0,0.06);
    border-left: 4px solid #10b981;
    display: flex;
    align-items: flex-start;
    gap: 12px;
    animation: toastSlideIn .25s cubic-bezier(0.16, 1, 0.3, 1);
    transition: all .25s ease;
}
@keyframes toastSlideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
.wa-toast.danger { border-left-color: #ef4444; }
.wa-toast.warning { border-left-color: #f59e0b; }
.wa-toast.info { border-left-color: #3b82f6; }
</style>

<?php
$is_connected = (
    !empty($whatsapp) &&
    !empty($whatsapp->connection_status) &&
    $whatsapp->connection_status === 'CONNECTED'
);
$is_enabled = (!empty($whatsapp) && !empty($whatsapp->whatsapp_enabled));
?>

<div class="p-4 md:p-6 space-y-6">

    <!-- Flash Messages from Session -->
    <?php if ($this->session->flashdata('whatsapp_success')): ?>
        <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                <span class="font-medium text-sm"><?= htmlspecialchars($this->session->flashdata('whatsapp_success')) ?></span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('whatsapp_error')): ?>
        <div class="p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl flex items-center justify-between shadow-sm">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-triangle-exclamation text-red-600 text-lg"></i>
                <span class="font-medium text-sm"><?= htmlspecialchars($this->session->flashdata('whatsapp_error')) ?></span>
            </div>
            <button onclick="this.parentElement.remove()" class="text-red-500 hover:text-red-700">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>
    <?php endif; ?>

    <!-- =====================================================
         PAGE HEADER
         ====================================================== -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-6">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-5">
            <div class="flex items-start md:items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-200 flex items-center justify-center text-emerald-600 text-2xl shadow-sm flex-shrink-0">
                    <i class="fa-brands fa-whatsapp"></i>
                </div>
                <div>
                    <div class="flex flex-wrap items-center gap-2.5">
                        <h1 class="text-xl md:text-2xl font-bold text-gray-900">WhatsApp Integration</h1>
                        <?php if ($is_connected): ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Connected
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                                Not Connected
                            </span>
                        <?php endif; ?>

                        <?php if ($is_enabled): ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                <i class="fa-solid fa-bolt text-[10px]"></i> Active
                            </span>
                        <?php else: ?>
                            <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                <i class="fa-solid fa-pause text-[10px]"></i> Paused
                            </span>
                        <?php endif; ?>
                    </div>
                    <p class="text-sm text-gray-500 mt-1">Connect your Meta WhatsApp Business Cloud API account to automatically dispatch Invoices, Quotations, Job Cards, and Inspection Reports.</p>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button type="button" onclick="testWhatsapp()" id="btn-test-connection"
                    class="px-4 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition shadow-sm text-sm inline-flex items-center gap-2">
                    <i class="fa-solid fa-plug text-gray-500"></i>
                    <span>Test Connection</span>
                </button>
                <button type="button" onclick="saveWhatsapp()" id="btn-save-settings"
                    class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition shadow-sm text-sm inline-flex items-center gap-2">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Save All Changes</span>
                </button>
            </div>
        </div>
    </div>

    <!-- =====================================================
         MAIN NAVIGATION TABS
         ====================================================== -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        
        <div class="border-b border-gray-200 bg-gray-50/70 px-4 pt-3 flex gap-2 overflow-x-auto">
            <button class="wa-tab-btn active" data-tab="tab-config">
                <i class="fa-solid fa-sliders text-sm"></i>
                <span>API & Connection Settings</span>
            </button>
            <button class="wa-tab-btn" data-tab="tab-templates">
                <i class="fa-solid fa-file-lines text-sm"></i>
                <span>Message Templates</span>
            </button>
            <button class="wa-tab-btn" data-tab="tab-guide">
                <i class="fa-solid fa-book-open text-sm"></i>
                <span>Placeholders & Guide</span>
            </button>
        </div>

        <div class="p-5 md:p-8">

            <!-- =====================================================
                 TAB 1: API & CONNECTION SETTINGS
                 ====================================================== -->
            <div class="wa-tab-pane active" id="tab-config">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                    <!-- Left: Meta Account & Connection Status (5 cols) -->
                    <div class="lg:col-span-5 space-y-6">

                        <!-- Meta Embedded Signup Card -->
                        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                            <div class="flex items-center justify-between pb-4 mb-5 border-b border-gray-100">
                                <div class="flex items-center gap-2.5">
                                    <span class="text-blue-600 text-lg"><i class="fa-brands fa-facebook"></i></span>
                                    <h3 class="font-bold text-gray-900 text-base">Meta Embedded Signup</h3>
                                </div>
                                <span class="text-xs font-semibold px-2 py-0.5 rounded bg-gray-100 text-gray-600">Official</span>
                            </div>

                            <p class="text-sm text-gray-600 mb-5 leading-relaxed">
                                Connect your WhatsApp Business Profile with 1-click via official Meta Login. This will automatically link your WABA (WhatsApp Business Account) and phone number.
                            </p>

                            <button type="button" id="wa-connect-btn"
                                class="w-full py-3 px-4 bg-emerald-600 hover:bg-emerald-700 active:scale-[0.99] text-white font-semibold rounded-xl transition shadow-sm flex items-center justify-center gap-2 text-sm">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                                <span>Connect with WhatsApp</span>
                            </button>

                            <p class="text-xs text-gray-400 mt-2.5 text-center">
                                Opens Meta OAuth dialog (v21.0)
                            </p>
                        </div>

                        <!-- Current Connection Status Card -->
                        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                            <h3 class="font-bold text-gray-900 text-base pb-3 mb-4 border-b border-gray-100 flex items-center justify-between">
                                <span>Connection Status</span>
                                <?php if ($is_connected): ?>
                                    <span class="text-xs font-bold text-emerald-600 flex items-center gap-1.5">
                                        <i class="fa-solid fa-circle-check"></i> Active
                                    </span>
                                <?php else: ?>
                                    <span class="text-xs font-bold text-gray-400 flex items-center gap-1.5">
                                        <i class="fa-solid fa-circle-xmark"></i> Offline
                                    </span>
                                <?php endif; ?>
                            </h3>

                            <?php if ($is_connected): ?>
                                <div class="p-4 bg-emerald-50/70 border border-emerald-200/80 rounded-xl space-y-3 mb-5">
                                    <div>
                                        <div class="text-[11px] font-semibold text-emerald-800 uppercase tracking-wider">Registered WhatsApp Number</div>
                                        <div class="text-base font-bold text-emerald-950 font-mono mt-0.5">
                                            <?= htmlspecialchars(!empty($whatsapp->whatsapp_number) ? $whatsapp->whatsapp_number : '—') ?>
                                        </div>
                                    </div>
                                    
                                    <div class="pt-2 border-t border-emerald-200/60 grid grid-cols-1 gap-2 text-xs">
                                        <div>
                                            <span class="text-emerald-700 font-semibold">Phone Number ID:</span>
                                            <span class="font-mono text-emerald-900 ml-1"><?= htmlspecialchars($whatsapp->phone_number_id) ?></span>
                                        </div>
                                        <?php if (!empty($whatsapp->waba_id)): ?>
                                            <div>
                                                <span class="text-emerald-700 font-semibold">WABA ID:</span>
                                                <span class="font-mono text-emerald-900 ml-1"><?= htmlspecialchars($whatsapp->waba_id) ?></span>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (!empty($whatsapp->connected_at)): ?>
                                            <div>
                                                <span class="text-emerald-700 font-semibold">Connected On:</span>
                                                <span class="text-emerald-900 ml-1"><?= date('d M Y, h:i A', strtotime($whatsapp->connected_at)) ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <button type="button" onclick="disconnectWhatsapp()"
                                    class="w-full py-2.5 px-4 bg-white border border-red-300 text-red-600 hover:bg-red-50 font-semibold rounded-xl transition text-sm flex items-center justify-center gap-2">
                                    <i class="fa-solid fa-unlink"></i>
                                    <span>Disconnect Account</span>
                                </button>
                            <?php else: ?>
                                <div class="p-4 bg-amber-50/80 border border-amber-200 rounded-xl text-amber-900 text-sm">
                                    <div class="flex items-start gap-2.5">
                                        <i class="fa-solid fa-circle-info text-amber-600 mt-0.5"></i>
                                        <div>
                                            <strong class="font-semibold">WhatsApp is currently not connected.</strong>
                                            <p class="text-xs text-amber-800 mt-1 leading-relaxed">
                                                Click the <b>Connect with WhatsApp</b> button above or enter your Meta Cloud API Phone Number ID and Access Token in the configuration form.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>

                    <!-- Right: WhatsApp Cloud API Credentials Form (7 cols) -->
                    <div class="lg:col-span-7">
                        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm space-y-6">
                            
                            <div class="border-b border-gray-100 pb-4">
                                <h3 class="font-bold text-gray-900 text-base">Meta Cloud API Credentials</h3>
                                <p class="text-xs text-gray-500 mt-0.5">Configure your Meta Developer App WhatsApp Business Cloud API parameters.</p>
                            </div>

                            <!-- Master Toggle -->
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-200 flex items-center justify-between">
                                <div>
                                    <label for="whatsapp_enabled" class="font-semibold text-gray-800 text-sm cursor-pointer">
                                        Enable WhatsApp Messaging
                                    </label>
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        When disabled, all automatic WhatsApp dispatches will be paused.
                                    </p>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" id="whatsapp_enabled" name="whatsapp_enabled" value="1"
                                        <?= $is_enabled ? 'checked' : '' ?>>
                                    <span class="slider"></span>
                                </label>
                            </div>

                            <!-- WhatsApp Phone Number -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="whatsapp_number">
                                    WhatsApp Phone Number <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                    <input type="text" id="whatsapp_number" name="whatsapp_number"
                                        placeholder="+91XXXXXXXXXX"
                                        value="<?= htmlspecialchars(!empty($whatsapp->whatsapp_number) ? $whatsapp->whatsapp_number : '') ?>"
                                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50/40 focus:bg-white transition">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Include country code with leading + (e.g. +91 9876543210 or +971 501234567).</p>
                            </div>

                            <!-- Phone Number ID -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="phone_number_id">
                                    Phone Number ID <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <i class="fa-solid fa-id-badge"></i>
                                    </div>
                                    <input type="text" id="phone_number_id" name="phone_number_id"
                                        placeholder="e.g. 104593827103948"
                                        value="<?= htmlspecialchars(!empty($whatsapp->phone_number_id) ? $whatsapp->phone_number_id : '') ?>"
                                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50/40 focus:bg-white transition">
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Found under Meta App Dashboard &gt; WhatsApp &gt; API Setup &gt; Phone number ID.</p>
                            </div>

                            <!-- Access Token -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1.5" for="access_token">
                                    Permanent System User Access Token <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                                        <i class="fa-solid fa-key"></i>
                                    </div>
                                    <input type="password" id="access_token" name="access_token"
                                        placeholder="<?= !empty($whatsapp->access_token) ? '••••••••••••••••••••••••  (Token already saved. Leave blank to keep)' : 'Paste permanent system user access token' ?>"
                                        value="<?= htmlspecialchars(!empty($whatsapp->access_token) ? $whatsapp->access_token : '') ?>"
                                        class="w-full pl-10 pr-12 py-2.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50/40 focus:bg-white transition font-mono">
                                    <button type="button" onclick="toggleToken(this)"
                                        class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-gray-400 hover:text-gray-600 transition">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Use a permanent System User Token with <code>whatsapp_business_messaging</code> and <code>whatsapp_business_management</code> scopes.</p>
                            </div>

                            <!-- Save / Test Footer -->
                            <div class="pt-5 border-t border-gray-100 flex flex-wrap items-center justify-end gap-3">
                                <button type="button" onclick="openTestModal()"
                                    class="px-4 py-2.5 bg-blue-50 text-blue-700 border border-blue-200 font-semibold rounded-xl hover:bg-blue-100 transition shadow-sm text-sm inline-flex items-center gap-2">
                                    <i class="fa-brands fa-whatsapp text-blue-600"></i>
                                    <span>Send Test Message</span>
                                </button>
                                <button type="button" onclick="testWhatsapp()" id="btn-test-connection"
                                    class="px-4 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-xl hover:bg-gray-50 transition shadow-sm text-sm inline-flex items-center gap-2">
                                    <i class="fa-solid fa-plug text-gray-500"></i>
                                    <span>Test Connection</span>
                                </button>
                                <button type="button" onclick="saveWhatsapp()" id="btn-save-settings"
                                    class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition shadow-sm text-sm inline-flex items-center gap-2">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    <span>Save Configuration</span>
                                </button>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <!-- =====================================================
                 TAB 2: MESSAGE TEMPLATES & LIVE SIMULATOR
                 ====================================================== -->
            <div class="wa-tab-pane" id="tab-templates">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

                    <!-- Left: Template Editor (7 cols) -->
                    <div class="lg:col-span-7 space-y-5">
                        
                        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                            
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 pb-4 mb-5 border-b border-gray-100">
                                <div>
                                    <h3 class="font-bold text-gray-900 text-base">WhatsApp Document Templates</h3>
                                    <p class="text-xs text-gray-500 mt-0.5">Customize the automated message body sent for each module.</p>
                                </div>
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                    <i class="fa-solid fa-wand-magic-sparkles mr-1"></i> Live Preview
                                </span>
                            </div>

                            <!-- Template Pill Switchers -->
                            <div class="flex flex-wrap gap-2 mb-5">
                                <button type="button" class="tmpl-pill active" data-tmpl="tmpl-invoice">
                                    <i class="fa-solid fa-file-invoice"></i> Invoice
                                </button>
                                <button type="button" class="tmpl-pill" data-tmpl="tmpl-quotation">
                                    <i class="fa-solid fa-file-lines"></i> Quotation
                                </button>
                                <button type="button" class="tmpl-pill" data-tmpl="tmpl-jobcard">
                                    <i class="fa-solid fa-id-card"></i> Job Card
                                </button>
                                <button type="button" class="tmpl-pill" data-tmpl="tmpl-inspection">
                                    <i class="fa-solid fa-clipboard-check"></i> Inspection
                                </button>
                                <button type="button" class="tmpl-pill" data-tmpl="tmpl-estimation">
                                    <i class="fa-solid fa-calculator"></i> Estimation
                                </button>
                                <button type="button" class="tmpl-pill" data-tmpl="tmpl-service-reminder">
                                    <i class="fa-solid fa-bell"></i> Service Reminder
                                </button>
                            </div>

                            <!-- Click to Insert Quick Badges -->
                            <div class="mb-4 p-3 bg-gray-50 rounded-xl border border-gray-200">
                                <div class="text-[11px] font-bold uppercase tracking-wider text-gray-500 mb-2 flex items-center justify-between">
                                    <span><i class="fa-solid fa-tags text-gray-400 mr-1"></i> Quick Insert Variables (Click to Insert)</span>
                                    <span class="text-[10px] text-gray-400 lowercase">click chip to add to editor</span>
                                </div>
                                <div class="flex flex-wrap gap-1.5" id="quick-insert-bar">
                                    <span class="wa-chip" data-token="{customer_name}">{customer_name}</span>
                                    <span class="wa-chip" data-token="{brand}">{brand}</span>
                                    <span class="wa-chip" data-token="{model}">{model}</span>
                                    <span class="wa-chip" data-token="{registration_no}">{registration_no}</span>
                                    <span class="wa-chip" data-token="{amount}">{amount}</span>
                                    <span class="wa-chip" data-token="{invoice_no}">{invoice_no}</span>
                                    <span class="wa-chip" data-token="{quotation_no}">{quotation_no}</span>
                                    <span class="wa-chip" data-token="{jobcard_no}">{jobcard_no}</span>
                                    <span class="wa-chip" data-token="{estimation_no}">{estimation_no}</span>
                                    <span class="wa-chip" data-token="{inspection_date}">{inspection_date}</span>
                                    <span class="wa-chip" data-token="{next_service_date}">{next_service_date}</span>
                                    <span class="wa-chip" data-token="{status}">{status}</span>
                                </div>
                            </div>

                            <!-- Notice Banner for Meta Templates -->
                            <div class="mb-4 p-4 rounded-xl bg-blue-50/80 border border-blue-200 text-xs text-blue-900 leading-relaxed flex items-start gap-3">
                                <i class="fa-solid fa-circle-info text-blue-600 text-base mt-0.5 flex-shrink-0"></i>
                                <div>
                                    <strong class="font-semibold block mb-0.5 text-blue-950">How WhatsApp Business Cloud API Delivers Messages (Bypassing 24-Hour Restriction):</strong>
                                    <span>To reach customers who haven't messaged your garage in the last 24 hours, WhatsApp Cloud API requires using an <b>Approved Meta Template</b> (Category: <i>Utility</i>). Enter the exact <b>Meta Template Name</b> and <b>Language Code</b> (e.g. <code>en_US</code>) for each module. The variables in your message body (e.g. <code>{customer_name}</code>, <code>{invoice_no}</code>, <code>{amount}</code>) are automatically mapped and passed as parameters <code>{{1}}</code>, <code>{{2}}</code>, <code>{{3}}</code> to Meta.</span>
                                    <div class="mt-1.5 text-[11px] text-blue-800"><b>💡 Quick Test Tip:</b> Meta provides a pre-approved template named <code class="bg-blue-100/80 px-1 py-0.5 rounded text-blue-950 font-mono">hello_world</code> on every WhatsApp Cloud account for immediate testing.</div>
                                </div>
                            </div>

                            <!-- Template Textareas -->
                            <form id="templates-form">

                                <!-- Invoice -->
                                <div class="tmpl-pane active" id="tmpl-invoice">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3 p-3 bg-gray-50/80 border border-gray-200 rounded-xl">
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">
                                                Meta Template Name <span class="text-emerald-600 font-normal lowercase">(approved in Meta)</span>
                                            </label>
                                            <input type="text" name="invoice_template_name"
                                                value="<?= htmlspecialchars(!empty($whatsapp_templates['invoice']->template_name) ? $whatsapp_templates['invoice']->template_name : '') ?>"
                                                placeholder="e.g. invoice_notification"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Language Code</label>
                                            <input type="text" name="invoice_meta_language"
                                                value="<?= htmlspecialchars(!empty($whatsapp_templates['invoice']->meta_language) ? $whatsapp_templates['invoice']->meta_language : 'en_US') ?>"
                                                placeholder="en_US or en"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Dispatch Mode</label>
                                            <select name="invoice_dispatch_mode"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                                <option value="template" <?= (empty($whatsapp_templates['invoice']->dispatch_mode) || $whatsapp_templates['invoice']->dispatch_mode === 'template') ? 'selected' : '' ?>>
                                                    Meta Template (Recommended - 100% Delivery)
                                                </option>
                                                <option value="text" <?= (!empty($whatsapp_templates['invoice']->dispatch_mode) && $whatsapp_templates['invoice']->dispatch_mode === 'text') ? 'selected' : '' ?>>
                                                    Direct Text (Requires active 24h conversation)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="text-xs font-semibold text-gray-700">Invoice Message Body & Parameters</label>
                                        <span class="text-[11px] text-gray-400">Triggered from Invoices & Direct Invoices</span>
                                    </div>
                                    <textarea name="invoice_template" rows="8"
                                        class="w-full p-3.5 border border-gray-300 rounded-xl text-sm font-sans focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50/30 focus:bg-white transition leading-relaxed"
                                        placeholder="Enter invoice WhatsApp message..."><?= htmlspecialchars(!empty($whatsapp_templates['invoice']->template_body) ? $whatsapp_templates['invoice']->template_body : '') ?></textarea>
                                </div>

                                <!-- Quotation -->
                                <div class="tmpl-pane" id="tmpl-quotation">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3 p-3 bg-gray-50/80 border border-gray-200 rounded-xl">
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">
                                                Meta Template Name <span class="text-emerald-600 font-normal lowercase">(approved in Meta)</span>
                                            </label>
                                            <input type="text" name="quotation_template_name"
                                                value="<?= htmlspecialchars(!empty($whatsapp_templates['quotation']->template_name) ? $whatsapp_templates['quotation']->template_name : '') ?>"
                                                placeholder="e.g. quotation_update"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Language Code</label>
                                            <input type="text" name="quotation_meta_language"
                                                value="<?= htmlspecialchars(!empty($whatsapp_templates['quotation']->meta_language) ? $whatsapp_templates['quotation']->meta_language : 'en_US') ?>"
                                                placeholder="en_US or en"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Dispatch Mode</label>
                                            <select name="quotation_dispatch_mode"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                                <option value="template" <?= (empty($whatsapp_templates['quotation']->dispatch_mode) || $whatsapp_templates['quotation']->dispatch_mode === 'template') ? 'selected' : '' ?>>
                                                    Meta Template (Recommended - 100% Delivery)
                                                </option>
                                                <option value="text" <?= (!empty($whatsapp_templates['quotation']->dispatch_mode) && $whatsapp_templates['quotation']->dispatch_mode === 'text') ? 'selected' : '' ?>>
                                                    Direct Text (Requires active 24h conversation)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="text-xs font-semibold text-gray-700">Quotation Message Body & Parameters</label>
                                        <span class="text-[11px] text-gray-400">Triggered from Quotations & Direct Quotations</span>
                                    </div>
                                    <textarea name="quotation_template" rows="8"
                                        class="w-full p-3.5 border border-gray-300 rounded-xl text-sm font-sans focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50/30 focus:bg-white transition leading-relaxed"
                                        placeholder="Enter quotation WhatsApp message..."><?= htmlspecialchars(!empty($whatsapp_templates['quotation']->template_body) ? $whatsapp_templates['quotation']->template_body : '') ?></textarea>
                                </div>

                                <!-- Job Card -->
                                <div class="tmpl-pane" id="tmpl-jobcard">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3 p-3 bg-gray-50/80 border border-gray-200 rounded-xl">
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">
                                                Meta Template Name <span class="text-emerald-600 font-normal lowercase">(approved in Meta)</span>
                                            </label>
                                            <input type="text" name="jobcard_template_name"
                                                value="<?= htmlspecialchars(!empty($whatsapp_templates['jobcard']->template_name) ? $whatsapp_templates['jobcard']->template_name : '') ?>"
                                                placeholder="e.g. job_card_update"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Language Code</label>
                                            <input type="text" name="jobcard_meta_language"
                                                value="<?= htmlspecialchars(!empty($whatsapp_templates['jobcard']->meta_language) ? $whatsapp_templates['jobcard']->meta_language : 'en_US') ?>"
                                                placeholder="en_US or en"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Dispatch Mode</label>
                                            <select name="jobcard_dispatch_mode"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                                <option value="template" <?= (empty($whatsapp_templates['jobcard']->dispatch_mode) || $whatsapp_templates['jobcard']->dispatch_mode === 'template') ? 'selected' : '' ?>>
                                                    Meta Template (Recommended - 100% Delivery)
                                                </option>
                                                <option value="text" <?= (!empty($whatsapp_templates['jobcard']->dispatch_mode) && $whatsapp_templates['jobcard']->dispatch_mode === 'text') ? 'selected' : '' ?>>
                                                    Direct Text (Requires active 24h conversation)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="text-xs font-semibold text-gray-700">Job Card Message Body & Parameters</label>
                                        <span class="text-[11px] text-gray-400">Triggered when job card is shared</span>
                                    </div>
                                    <textarea name="jobcard_template" rows="8"
                                        class="w-full p-3.5 border border-gray-300 rounded-xl text-sm font-sans focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50/30 focus:bg-white transition leading-relaxed"
                                        placeholder="Enter job card WhatsApp message..."><?= htmlspecialchars(!empty($whatsapp_templates['jobcard']->template_body) ? $whatsapp_templates['jobcard']->template_body : '') ?></textarea>
                                </div>

                                <!-- Inspection -->
                                <div class="tmpl-pane" id="tmpl-inspection">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3 p-3 bg-gray-50/80 border border-gray-200 rounded-xl">
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">
                                                Meta Template Name <span class="text-emerald-600 font-normal lowercase">(approved in Meta)</span>
                                            </label>
                                            <input type="text" name="inspection_template_name"
                                                value="<?= htmlspecialchars(!empty($whatsapp_templates['inspection']->template_name) ? $whatsapp_templates['inspection']->template_name : '') ?>"
                                                placeholder="e.g. inspection_report"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Language Code</label>
                                            <input type="text" name="inspection_meta_language"
                                                value="<?= htmlspecialchars(!empty($whatsapp_templates['inspection']->meta_language) ? $whatsapp_templates['inspection']->meta_language : 'en_US') ?>"
                                                placeholder="en_US or en"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Dispatch Mode</label>
                                            <select name="inspection_dispatch_mode"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                                <option value="template" <?= (empty($whatsapp_templates['inspection']->dispatch_mode) || $whatsapp_templates['inspection']->dispatch_mode === 'template') ? 'selected' : '' ?>>
                                                    Meta Template (Recommended - 100% Delivery)
                                                </option>
                                                <option value="text" <?= (!empty($whatsapp_templates['inspection']->dispatch_mode) && $whatsapp_templates['inspection']->dispatch_mode === 'text') ? 'selected' : '' ?>>
                                                    Direct Text (Requires active 24h conversation)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="text-xs font-semibold text-gray-700">Inspection Report Body & Parameters</label>
                                        <span class="text-[11px] text-gray-400">Triggered from Vehicle Inspection</span>
                                    </div>
                                    <textarea name="inspection_template" rows="8"
                                        class="w-full p-3.5 border border-gray-300 rounded-xl text-sm font-sans focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50/30 focus:bg-white transition leading-relaxed"
                                        placeholder="Enter inspection WhatsApp message..."><?= htmlspecialchars(!empty($whatsapp_templates['inspection']->template_body) ? $whatsapp_templates['inspection']->template_body : '') ?></textarea>
                                </div>

                                <!-- Estimation -->
                                <div class="tmpl-pane" id="tmpl-estimation">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3 p-3 bg-gray-50/80 border border-gray-200 rounded-xl">
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">
                                                Meta Template Name <span class="text-emerald-600 font-normal lowercase">(approved in Meta)</span>
                                            </label>
                                            <input type="text" name="estimation_template_name"
                                                value="<?= htmlspecialchars(!empty($whatsapp_templates['estimation']->template_name) ? $whatsapp_templates['estimation']->template_name : '') ?>"
                                                placeholder="e.g. estimation_update"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Language Code</label>
                                            <input type="text" name="estimation_meta_language"
                                                value="<?= htmlspecialchars(!empty($whatsapp_templates['estimation']->meta_language) ? $whatsapp_templates['estimation']->meta_language : 'en_US') ?>"
                                                placeholder="en_US or en"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Dispatch Mode</label>
                                            <select name="estimation_dispatch_mode"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                                <option value="template" <?= (empty($whatsapp_templates['estimation']->dispatch_mode) || $whatsapp_templates['estimation']->dispatch_mode === 'template') ? 'selected' : '' ?>>
                                                    Meta Template (Recommended - 100% Delivery)
                                                </option>
                                                <option value="text" <?= (!empty($whatsapp_templates['estimation']->dispatch_mode) && $whatsapp_templates['estimation']->dispatch_mode === 'text') ? 'selected' : '' ?>>
                                                    Direct Text (Requires active 24h conversation)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="text-xs font-semibold text-gray-700">Estimation Message Body & Parameters</label>
                                        <span class="text-[11px] text-gray-400">Triggered from Estimation module</span>
                                    </div>
                                    <textarea name="estimation_template" rows="8"
                                        class="w-full p-3.5 border border-gray-300 rounded-xl text-sm font-sans focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50/30 focus:bg-white transition leading-relaxed"
                                        placeholder="Enter estimation WhatsApp message..."><?= htmlspecialchars(!empty($whatsapp_templates['estimation']->template_body) ? $whatsapp_templates['estimation']->template_body : '') ?></textarea>
                                </div>

                                <!-- Service Reminder -->
                                <div class="tmpl-pane" id="tmpl-service-reminder">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3 p-3 bg-gray-50/80 border border-gray-200 rounded-xl">
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">
                                                Meta Template Name <span class="text-emerald-600 font-normal lowercase">(approved in Meta)</span>
                                            </label>
                                            <input type="text" name="service_reminder_template_name"
                                                value="<?= htmlspecialchars(!empty($whatsapp_templates['service_reminder']->template_name) ? $whatsapp_templates['service_reminder']->template_name : '') ?>"
                                                placeholder="e.g. service_reminder"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Language Code</label>
                                            <input type="text" name="service_reminder_meta_language"
                                                value="<?= htmlspecialchars(!empty($whatsapp_templates['service_reminder']->meta_language) ? $whatsapp_templates['service_reminder']->meta_language : 'en_US') ?>"
                                                placeholder="en_US or en"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs font-mono focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                        </div>
                                        <div>
                                            <label class="block text-[11px] font-bold text-gray-700 uppercase tracking-wider mb-1">Dispatch Mode</label>
                                            <select name="service_reminder_dispatch_mode"
                                                class="w-full px-3 py-1.5 border border-gray-300 rounded-lg text-xs focus:ring-2 focus:ring-emerald-500 focus:outline-none bg-white">
                                                <option value="template" <?= (empty($whatsapp_templates['service_reminder']->dispatch_mode) || $whatsapp_templates['service_reminder']->dispatch_mode === 'template') ? 'selected' : '' ?>>
                                                    Meta Template (Recommended - 100% Delivery)
                                                </option>
                                                <option value="text" <?= (!empty($whatsapp_templates['service_reminder']->dispatch_mode) && $whatsapp_templates['service_reminder']->dispatch_mode === 'text') ? 'selected' : '' ?>>
                                                    Direct Text (Requires active 24h conversation)
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-between mb-2">
                                        <label class="text-xs font-semibold text-gray-700">Service Reminder Body & Parameters</label>
                                        <span class="text-[11px] text-gray-400">Triggered for upcoming service due reminders</span>
                                    </div>
                                    <textarea name="service_reminder_template" rows="8"
                                        class="w-full p-3.5 border border-gray-300 rounded-xl text-sm font-sans focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 bg-gray-50/30 focus:bg-white transition leading-relaxed"
                                        placeholder="Enter service reminder WhatsApp message..."><?= htmlspecialchars(!empty($whatsapp_templates['service_reminder']->template_body) ? $whatsapp_templates['service_reminder']->template_body : '') ?></textarea>
                                </div>

                            </form>

                            <!-- Bottom Action -->
                            <div class="mt-5 pt-4 border-t border-gray-100 flex items-center justify-between">
                                <span class="text-xs text-gray-500">Supports standard WhatsApp formatting: *bold*, _italics_, ~strike~</span>
                                <button type="button" onclick="saveWhatsapp()"
                                    class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition shadow-sm text-sm inline-flex items-center gap-2">
                                    <i class="fa-solid fa-floppy-disk"></i>
                                    <span>Save All Templates</span>
                                </button>
                            </div>

                        </div>

                    </div>

                    <!-- Right: WhatsApp Chat Live Simulator (5 cols) -->
                    <div class="lg:col-span-5 space-y-6">

                        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                            <div class="flex items-center justify-between pb-3 mb-4 border-b border-gray-100">
                                <div class="flex items-center gap-2 text-sm font-bold text-gray-800">
                                    <i class="fa-brands fa-whatsapp text-emerald-600 text-lg"></i>
                                    <span>Customer View Simulator</span>
                                </div>
                                <span id="preview-tmpl-label" class="text-xs font-semibold text-emerald-700 px-2 py-0.5 rounded bg-emerald-50 border border-emerald-200">
                                    Invoice
                                </span>
                            </div>

                            <!-- Phone Container -->
                            <div class="wa-phone-mockup p-4">
                                
                                <!-- Chat Top Bar -->
                                <div class="bg-emerald-700 text-white rounded-t-xl px-3 py-2.5 flex items-center justify-between mb-3 shadow-sm">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-emerald-800 flex items-center justify-center text-white text-xs font-bold border border-emerald-600">
                                            <i class="fa-solid fa-building"></i>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold leading-tight">Garage Service Desk</div>
                                            <div class="text-[10px] text-emerald-200">Business Account</div>
                                        </div>
                                    </div>
                                    <div class="text-emerald-200 text-xs flex gap-2">
                                        <i class="fa-solid fa-video"></i>
                                        <i class="fa-solid fa-phone"></i>
                                    </div>
                                </div>

                                <!-- Date Separator -->
                                <div class="text-center my-2">
                                    <span class="bg-white/80 text-[10px] text-gray-600 px-2.5 py-0.5 rounded-md shadow-xs uppercase font-medium">
                                        Today
                                    </span>
                                </div>

                                <!-- Outgoing Message Bubble -->
                                <div class="flex justify-end my-2">
                                    <div class="wa-bubble p-3">
                                        <div id="wa-preview-text" class="whitespace-pre-line text-gray-800 text-[13px] leading-relaxed">
                                            Loading preview...
                                        </div>
                                        <div class="flex items-center justify-end gap-1 mt-1 text-[10px] text-gray-400">
                                            <span><?= date('h:i A') ?></span>
                                            <span class="text-blue-500 font-bold">✓✓</span>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <p class="text-xs text-gray-400 mt-3 text-center">
                                Live preview automatically replaces placeholders with sample vehicle and customer records.
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            <!-- =====================================================
                 TAB 3: PLACEHOLDERS CHEAT SHEET & GUIDE
                 ====================================================== -->
            <div class="wa-tab-pane" id="tab-guide">
                <div class="space-y-6">

                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                        <h3 class="font-bold text-gray-900 text-base pb-3 mb-4 border-b border-gray-100 flex items-center gap-2">
                            <i class="fa-solid fa-table-list text-emerald-600"></i>
                            <span>Supported Template Placeholders Reference</span>
                        </h3>

                        <p class="text-sm text-gray-600 mb-5">
                            You can place any of the following tokens in your message templates. During dispatch, the system dynamically pulls corresponding live data from the database.
                        </p>

                        <div class="overflow-x-auto border border-gray-200 rounded-xl">
                            <table class="w-full text-left text-sm">
                                <thead class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase">
                                    <tr>
                                        <th class="py-3 px-4">Placeholder Token</th>
                                        <th class="py-3 px-4">Description</th>
                                        <th class="py-3 px-4">Sample Replaced Output</th>
                                        <th class="py-3 px-4 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 text-gray-700">
                                    <tr class="hover:bg-gray-50/60 transition">
                                        <td class="py-3 px-4 font-mono font-bold text-blue-600 text-xs">{customer_name}</td>
                                        <td class="py-3 px-4">Customer's full name from invoice / job card / record</td>
                                        <td class="py-3 px-4 text-gray-500">Ahmed Al-Mansoor</td>
                                        <td class="py-3 px-4 text-center">
                                            <button type="button" onclick="copyToken('{customer_name}')" class="text-xs px-2.5 py-1 rounded bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700">Copy</button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/60 transition">
                                        <td class="py-3 px-4 font-mono font-bold text-blue-600 text-xs">{brand}</td>
                                        <td class="py-3 px-4">Vehicle manufacturer brand</td>
                                        <td class="py-3 px-4 text-gray-500">Toyota</td>
                                        <td class="py-3 px-4 text-center">
                                            <button type="button" onclick="copyToken('{brand}')" class="text-xs px-2.5 py-1 rounded bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700">Copy</button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/60 transition">
                                        <td class="py-3 px-4 font-mono font-bold text-blue-600 text-xs">{model}</td>
                                        <td class="py-3 px-4">Vehicle model name</td>
                                        <td class="py-3 px-4 text-gray-500">Land Cruiser 300</td>
                                        <td class="py-3 px-4 text-center">
                                            <button type="button" onclick="copyToken('{model}')" class="text-xs px-2.5 py-1 rounded bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700">Copy</button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/60 transition">
                                        <td class="py-3 px-4 font-mono font-bold text-blue-600 text-xs">{registration_no}</td>
                                        <td class="py-3 px-4">Vehicle plate number or registration number</td>
                                        <td class="py-3 px-4 text-gray-500">DXB-78912</td>
                                        <td class="py-3 px-4 text-center">
                                            <button type="button" onclick="copyToken('{registration_no}')" class="text-xs px-2.5 py-1 rounded bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700">Copy</button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/60 transition">
                                        <td class="py-3 px-4 font-mono font-bold text-blue-600 text-xs">{amount}</td>
                                        <td class="py-3 px-4">Document total or payable amount</td>
                                        <td class="py-3 px-4 text-gray-500">1,250.00</td>
                                        <td class="py-3 px-4 text-center">
                                            <button type="button" onclick="copyToken('{amount}')" class="text-xs px-2.5 py-1 rounded bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700">Copy</button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/60 transition">
                                        <td class="py-3 px-4 font-mono font-bold text-blue-600 text-xs">{invoice_no}</td>
                                        <td class="py-3 px-4">Generated Invoice reference number</td>
                                        <td class="py-3 px-4 text-gray-500">INV-2026-0042</td>
                                        <td class="py-3 px-4 text-center">
                                            <button type="button" onclick="copyToken('{invoice_no}')" class="text-xs px-2.5 py-1 rounded bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700">Copy</button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/60 transition">
                                        <td class="py-3 px-4 font-mono font-bold text-blue-600 text-xs">{quotation_no}</td>
                                        <td class="py-3 px-4">Quotation reference number</td>
                                        <td class="py-3 px-4 text-gray-500">QT-2026-0188</td>
                                        <td class="py-3 px-4 text-center">
                                            <button type="button" onclick="copyToken('{quotation_no}')" class="text-xs px-2.5 py-1 rounded bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700">Copy</button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/60 transition">
                                        <td class="py-3 px-4 font-mono font-bold text-blue-600 text-xs">{jobcard_no}</td>
                                        <td class="py-3 px-4">Job card reference number</td>
                                        <td class="py-3 px-4 text-gray-500">JC-9021</td>
                                        <td class="py-3 px-4 text-center">
                                            <button type="button" onclick="copyToken('{jobcard_no}')" class="text-xs px-2.5 py-1 rounded bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700">Copy</button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/60 transition">
                                        <td class="py-3 px-4 font-mono font-bold text-blue-600 text-xs">{inspection_date}</td>
                                        <td class="py-3 px-4">Vehicle inspection completed date</td>
                                        <td class="py-3 px-4 text-gray-500">26-09-2026</td>
                                        <td class="py-3 px-4 text-center">
                                            <button type="button" onclick="copyToken('{inspection_date}')" class="text-xs px-2.5 py-1 rounded bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700">Copy</button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/60 transition">
                                        <td class="py-3 px-4 font-mono font-bold text-blue-600 text-xs">{next_service_date}</td>
                                        <td class="py-3 px-4">Recommended date for next periodic maintenance</td>
                                        <td class="py-3 px-4 text-gray-500">26-12-2026</td>
                                        <td class="py-3 px-4 text-center">
                                            <button type="button" onclick="copyToken('{next_service_date}')" class="text-xs px-2.5 py-1 rounded bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700">Copy</button>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50/60 transition">
                                        <td class="py-3 px-4 font-mono font-bold text-blue-600 text-xs">{status}</td>
                                        <td class="py-3 px-4">Record status (e.g. Completed, Ready for Delivery)</td>
                                        <td class="py-3 px-4 text-gray-500">Ready for Delivery</td>
                                        <td class="py-3 px-4 text-center">
                                            <button type="button" onclick="copyToken('{status}')" class="text-xs px-2.5 py-1 rounded bg-gray-100 hover:bg-gray-200 font-semibold text-gray-700">Copy</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Meta Cloud API Setup Instructions -->
                    <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                        <h3 class="font-bold text-gray-900 text-base pb-3 mb-4 border-b border-gray-100 flex items-center gap-2">
                            <i class="fa-brands fa-meta text-blue-600"></i>
                            <span>Meta Developer Setup Guide</span>
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-200">
                                <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs mb-3">1</div>
                                <h4 class="font-bold text-gray-900 text-sm mb-1">Create Meta Business App</h4>
                                <p class="text-xs text-gray-600 leading-relaxed">
                                    Log in to <a href="https://developers.facebook.com" target="_blank" class="text-blue-600 underline">developers.facebook.com</a>, create a Business App, and add the WhatsApp product.
                                </p>
                            </div>

                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-200">
                                <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs mb-3">2</div>
                                <h4 class="font-bold text-gray-900 text-sm mb-1">Obtain Phone Number ID</h4>
                                <p class="text-xs text-gray-600 leading-relaxed">
                                    Go to WhatsApp &gt; API Setup to view your Phone Number ID and test message delivery. Add your real business number.
                                </p>
                            </div>

                            <div class="p-4 rounded-xl bg-gray-50 border border-gray-200">
                                <div class="w-7 h-7 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center font-bold text-xs mb-3">3</div>
                                <h4 class="font-bold text-gray-900 text-sm mb-1">Generate System User Token</h4>
                                <p class="text-xs text-gray-600 leading-relaxed">
                                    In Meta Business Manager &gt; Users &gt; System Users, generate a permanent token with <code>whatsapp_business_messaging</code>.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

<!-- Floating Toast Container -->
<div id="wa-toast-container"></div>

<script>
// ========================================================
// META EMBEDDED SIGNUP SDK INITIALIZATION
// ========================================================
window.fbAsyncInit = function() {
    FB.init({
        appId: '1246618450540161',
        cookie: true,
        xfbml: true,
        version: 'v21.0'
    });
};

let embeddedSignupInfo = {};

// Listener for Meta Embedded Signup message events
window.addEventListener('message', function (event) {
    if (event.origin !== "https://www.facebook.com" && event.origin !== "https://web.facebook.com") {
        return;
    }
    try {
        const data = typeof event.data === 'string' ? JSON.parse(event.data) : event.data;
        if (data && data.type === 'WA_EMBEDDED_SIGNUP') {
            console.log('WhatsApp Embedded Signup Event:', data);
            if (data.event === 'FINISH' && data.data) {
                embeddedSignupInfo = data.data;
                console.log('Captured Embedded Signup Session Data:', embeddedSignupInfo);
            } else if (data.event === 'ERROR') {
                var errMsg = (data.data && data.data.error_message) ? data.data.error_message : JSON.stringify(data.data);
                showToast('Meta Error: ' + errMsg, 'danger');
            }
        }
    } catch (e) {}
});

$(document).ready(function() {

    // Meta Embedded Signup OAuth Redirect
    $("#wa-connect-btn").click(function () {
        const oauthParams = new URLSearchParams({
            client_id: "1246618450540161",
            config_id: "1544634777391172",
            response_type: "code",
            override_default_response_type: "true",
            redirect_uri: "<?= base_url('index.php/Whatsapp_integration/callback') ?>",
            extras: JSON.stringify({
                setup: {},
                sessionInfoVersion: "2"
            })
        });

        window.location.href = "https://www.facebook.com/v21.0/dialog/oauth?" + oauthParams.toString();
    });

    // Main Tab Switching
    $(".wa-tab-btn").click(function() {
        $(".wa-tab-btn").removeClass("active");
        $(".wa-tab-pane").removeClass("active");
        $(this).addClass("active");
        $("#" + $(this).data("tab")).addClass("active");
    });

    // Template Sub-Pills Switching
    $(".tmpl-pill").click(function() {
        $(".tmpl-pill").removeClass("active");
        $(".tmpl-pane").removeClass("active");
        $(this).addClass("active");
        
        var targetPane = $("#" + $(this).data("tmpl"));
        targetPane.addClass("active");

        var labelText = $(this).text().trim();
        $("#preview-tmpl-label").text(labelText);

        updateLivePreview();
    });

    // Real-time Preview updates when typing in any textarea
    $("textarea").on("input", function() {
        updateLivePreview();
    });

    // Initial Live Preview Render
    updateLivePreview();

    // Quick Insert Variable Chip Click Handler
    $(".wa-chip").click(function() {
        var token = $(this).data("token") || $(this).text().trim();
        insertTokenIntoActiveTemplate(token);
    });

});

// ========================================================
// LIVE PREVIEW SIMULATOR LOGIC
// ========================================================
function updateLivePreview() {
    var activeTextarea = $(".tmpl-pane.active textarea");
    if (!activeTextarea.length) return;

    var rawText = activeTextarea.val() || "";

    // Mock realistic values
    var mockData = {
        "{customer_name}": "Ahmed Al-Mansoor",
        "{brand}": "Toyota",
        "{model}": "Land Cruiser",
        "{registration_no}": "DXB-78912",
        "{vehicle_no}": "DXB-78912",
        "{amount}": "AED 1,250.00",
        "{invoice_no}": "INV-2026-0042",
        "{quotation_no}": "QT-2026-0188",
        "{jobcard_no}": "JC-9021",
        "{estimation_no}": "EST-2026-009",
        "{inspection_date}": "<?= date('d-m-Y') ?>",
        "{last_service_date}": "<?= date('d-m-Y', strtotime('-3 months')) ?>",
        "{next_service_date}": "<?= date('d-m-Y', strtotime('+3 months')) ?>",
        "{reminder_date}": "<?= date('d-m-Y') ?>",
        "{status}": "Completed"
    };

    var replaced = rawText;
    for (var key in mockData) {
        if (mockData.hasOwnProperty(key)) {
            replaced = replaced.split(key).join(mockData[key]);
        }
    }

    // Convert basic WhatsApp formatting for preview: *bold* -> <b>bold</b>, _italic_ -> <i>italic</i>
    var formatted = escapeHtml(replaced);
    formatted = formatted.replace(/\*([^*]+)\*/g, "<strong>$1</strong>");
    formatted = formatted.replace(/_([^_]+)_/g, "<em>$1</em>");
    formatted = formatted.replace(/~([^~]+)~/g, "<del>$1</del>");

    $("#wa-preview-text").html(formatted || '<span class="text-gray-400 italic">Type in the template to see preview...</span>');
}

function escapeHtml(text) {
    var map = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;',
        '"': '&quot;',
        "'": '&#039;'
    };
    return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

// ========================================================
// INSERT VARIABLE AT CURSOR
// ========================================================
function insertTokenIntoActiveTemplate(token) {
    var textarea = $(".tmpl-pane.active textarea")[0];
    if (!textarea) return;

    var start = textarea.selectionStart;
    var end = textarea.selectionEnd;
    var text = textarea.value;

    textarea.value = text.substring(0, start) + token + text.substring(end);
    textarea.selectionStart = textarea.selectionEnd = start + token.length;
    textarea.focus();

    updateLivePreview();
    showToast('Inserted ' + token + ' into active template', 'info');
}

function copyToken(token) {
    navigator.clipboard.writeText(token).then(function() {
        showToast('Copied ' + token + ' to clipboard', 'success');
    }).catch(function() {
        showToast('Token: ' + token, 'info');
    });
}

// ========================================================
// SAVE ALL WHATSAPP SETTINGS & TEMPLATES
// ========================================================
function saveWhatsapp() {
    var phone_id = $("#phone_number_id").val().trim();
    var token    = $("#access_token").val().trim();
    var mobile   = $("#whatsapp_number").val().trim();

    var btn = $("#btn-save-settings");
    var origHtml = btn.html();
    btn.prop("disabled", true).html('<i class="fa-solid fa-spinner fa-spin"></i> <span>Saving...</span>');

    $.post(
        "<?= base_url('index.php/Whatsapp_integration/save_whatsapp') ?>",
        {
            whatsapp_number: mobile,
            phone_number_id: phone_id,
            access_token: token,
            whatsapp_enabled: $("#whatsapp_enabled").is(":checked") ? 1 : 0,

            invoice_template: $("[name=invoice_template]").val(),
            invoice_template_name: $("[name=invoice_template_name]").val(),
            invoice_meta_language: $("[name=invoice_meta_language]").val(),
            invoice_dispatch_mode: $("[name=invoice_dispatch_mode]").val(),

            quotation_template: $("[name=quotation_template]").val(),
            quotation_template_name: $("[name=quotation_template_name]").val(),
            quotation_meta_language: $("[name=quotation_meta_language]").val(),
            quotation_dispatch_mode: $("[name=quotation_dispatch_mode]").val(),

            jobcard_template: $("[name=jobcard_template]").val(),
            jobcard_template_name: $("[name=jobcard_template_name]").val(),
            jobcard_meta_language: $("[name=jobcard_meta_language]").val(),
            jobcard_dispatch_mode: $("[name=jobcard_dispatch_mode]").val(),

            inspection_template: $("[name=inspection_template]").val(),
            inspection_template_name: $("[name=inspection_template_name]").val(),
            inspection_meta_language: $("[name=inspection_meta_language]").val(),
            inspection_dispatch_mode: $("[name=inspection_dispatch_mode]").val(),

            estimation_template: $("[name=estimation_template]").val(),
            estimation_template_name: $("[name=estimation_template_name]").val(),
            estimation_meta_language: $("[name=estimation_meta_language]").val(),
            estimation_dispatch_mode: $("[name=estimation_dispatch_mode]").val(),

            service_reminder_template: $("[name=service_reminder_template]").val(),
            service_reminder_template_name: $("[name=service_reminder_template_name]").val(),
            service_reminder_meta_language: $("[name=service_reminder_meta_language]").val(),
            service_reminder_dispatch_mode: $("[name=service_reminder_dispatch_mode]").val()
        },
        function(res) {
            btn.prop("disabled", false).html(origHtml);
            if (res && res.message) {
                showToast(res.message, "success");
            } else {
                showToast("WhatsApp settings saved successfully.", "success");
            }
            setTimeout(function() {
                location.reload();
            }, 1200);
        },
        "json"
    ).fail(function(xhr) {
        btn.prop("disabled", false).html(origHtml);
        showToast("Failed to save settings. Please try again.", "danger");
    });
}

// ========================================================
// TEST CONNECTION
// ========================================================
function testWhatsapp() {
    var phone_id = $("#phone_number_id").val().trim();
    var token    = $("#access_token").val().trim();
    var mobile   = $("#whatsapp_number").val().trim();

    var btn = $("#btn-test-connection");
    var origHtml = btn.html();
    btn.prop("disabled", true).html('<i class="fa-solid fa-spinner fa-spin"></i> <span>Testing...</span>');

    showToast("Testing connection with Meta Graph API...", "info");

    $.post(
        "<?= base_url('index.php/Whatsapp_integration/test_connection') ?>",
        {
            mobile: mobile,
            phone_number_id: phone_id,
            access_token: token
        },
        function(res) {
            btn.prop("disabled", false).html(origHtml);
            if (res && res.success) {
                showToast(res.message || "WhatsApp connection verified successfully.", "success");
            } else {
                var errMsg = (res && res.message) ? res.message : "Connection failed. Please verify credentials.";
                showToast(errMsg, "danger");
            }
        },
        "json"
    ).fail(function(xhr) {
        btn.prop("disabled", false).html(origHtml);
        showToast("Test request failed: " + (xhr.statusText || "Server error"), "danger");
    });
}

// ========================================================
// DISCONNECT WHATSAPP
// ========================================================
function disconnectWhatsapp() {
    if (!confirm("Are you sure you want to disconnect WhatsApp from this company? Automatic messages will stop sending until reconnected.")) {
        return;
    }

    $.ajax({
        url: "<?= base_url('index.php/Whatsapp_integration/disconnect') ?>",
        type: "POST",
        dataType: "json",
        success: function(res) {
            if (res.success) {
                showToast(res.message || "WhatsApp disconnected successfully.", "success");
                setTimeout(function() {
                    location.reload();
                }, 1000);
            } else {
                showToast(res.message || "Unable to disconnect.", "danger");
            }
        },
        error: function() {
            showToast("Failed to disconnect WhatsApp.", "danger");
        }
    });
}

// ========================================================
// PASSWORD / TOKEN VISIBILITY TOGGLE
// ========================================================
function toggleToken(btn) {
    var input = document.getElementById("access_token");
    var icon = btn.querySelector("i");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        input.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}

// ========================================================
// TOAST NOTIFICATION SYSTEM
// ========================================================
function showToast(message, type) {
    type = type || 'info';
    var icon = 'fa-circle-check text-emerald-500';
    if (type === 'danger') icon = 'fa-circle-xmark text-red-500';
    else if (type === 'warning') icon = 'fa-triangle-exclamation text-amber-500';
    else if (type === 'info') icon = 'fa-circle-info text-blue-500';

    var toast = $(`
        <div class="wa-toast ${type}">
            <i class="fa-solid ${icon} text-lg mt-0.5"></i>
            <div class="flex-1 text-sm font-medium text-gray-800 leading-snug">${escapeHtml(message)}</div>
            <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition -mr-1 -mt-1 p-1">
                <i class="fa-solid fa-xmark text-xs"></i>
            </button>
        </div>
    `);

    $("#wa-toast-container").append(toast);

    setTimeout(function() {
        toast.css({ opacity: 0, transform: 'translateX(50px)' });
        setTimeout(function() { toast.remove(); }, 300);
    }, 3500);
}

// ========================================================
// SEND TEST MESSAGE MODAL & ACTION
// ========================================================
function openTestModal() {
    var regMobile = $("#whatsapp_number").val().trim();
    if (!$("#test_phone").val() && regMobile) {
        $("#test_phone").val(regMobile);
    }
    $("#wa-test-modal").removeClass("hidden");
}

function closeTestModal() {
    $("#wa-test-modal").addClass("hidden");
}

function sendTestWhatsappMessage() {
    var phone = $("#test_phone").val().trim();
    var tmpl  = $("#test_template_name").val().trim() || 'hello_world';
    var lang  = $("#test_language").val().trim() || 'en_US';

    if (!phone) {
        showToast("Please enter a destination phone number with country code (e.g. 919876543210).", "warning");
        return;
    }

    var btn = $("#btn-send-test");
    var origHtml = btn.html();
    btn.prop("disabled", true).html('<i class="fa-solid fa-spinner fa-spin"></i> <span>Sending...</span>');

    showToast("Dispatching test WhatsApp message...", "info");

    $.post(
        "<?= base_url('index.php/Whatsapp_integration/send_test_message') ?>",
        {
            phone: phone,
            template_name: tmpl,
            language: lang
        },
        function(res) {
            btn.prop("disabled", false).html(origHtml);
            if (res && res.success) {
                showToast(res.message || "Test WhatsApp message sent successfully!", "success");
                closeTestModal();
            } else {
                var err = (res && res.message) ? res.message : "Failed to dispatch test message.";
                showToast(err, "danger");
            }
        },
        "json"
    ).fail(function(xhr) {
        btn.prop("disabled", false).html(origHtml);
        showToast("Request failed: " + (xhr.statusText || "Server error"), "danger");
    });
}
</script>

<!-- Test WhatsApp Modal -->
<div id="wa-test-modal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-6 m-4 relative animate-scaleIn border border-gray-100">
        <button type="button" onclick="closeTestModal()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition">
            <i class="fa-solid fa-xmark text-lg"></i>
        </button>
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-lg">
                <i class="fa-brands fa-whatsapp"></i>
            </div>
            <div>
                <h3 class="font-bold text-gray-900 text-base">Send Test WhatsApp Message</h3>
                <p class="text-xs text-gray-500">Test immediate delivery to your phone</p>
            </div>
        </div>

        <div class="space-y-3.5">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Destination Phone Number <span class="text-red-500">*</span></label>
                <input type="text" id="test_phone" placeholder="e.g. 919876543210 (country code + number)"
                    class="w-full px-3.5 py-2 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none font-mono">
                <p class="text-[11px] text-gray-400 mt-1">Include country code without + or spaces (e.g. 91 for India).</p>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Meta Template Name</label>
                <input type="text" id="test_template_name" value="hello_world" placeholder="hello_world"
                    class="w-full px-3.5 py-2 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none font-mono">
                <p class="text-[11px] text-gray-400 mt-1">Use <code class="bg-gray-100 px-1 py-0.5 rounded font-mono">hello_world</code> for Meta's default pre-approved template.</p>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Language Code</label>
                <input type="text" id="test_language" value="en_US" placeholder="en_US or en"
                    class="w-full px-3.5 py-2 border border-gray-300 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:outline-none font-mono">
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-2.5 pt-4 border-t border-gray-100">
            <button type="button" onclick="closeTestModal()" class="px-4 py-2 text-sm text-gray-600 hover:bg-gray-100 rounded-xl font-medium transition">Cancel</button>
            <button type="button" id="btn-send-test" onclick="sendTestWhatsappMessage()"
                class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl text-sm inline-flex items-center gap-2 shadow-sm transition">
                <i class="fa-solid fa-paper-plane"></i>
                <span>Send Test Now</span>
            </button>
        </div>
    </div>
</div>