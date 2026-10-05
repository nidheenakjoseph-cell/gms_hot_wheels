<?php
/**
 * Service Reminders List — UI aligned with app-wide pattern
 * (bg-white rounded-2xl shadow p-6, DataTables, Tailwind-style classes)
 */
$setting = $current_setting ?? null;
?>
<style>
    .act-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 6px;
    text-decoration: none;
    margin-right: 4px;
    transition: all 0.2s ease;
}

/* WhatsApp */
.act-wa {
    background: #25D366;
    color: #fff;
}

.act-wa:hover {
    background: #1ebe5d;
    color: #fff;
}

/* Email */
.act-mail {
    background: #3b82f6;
    color: #fff;
}

.act-mail:hover {
    background: #2563eb;
    color: #fff;
}

/* Close */
.act-close {
    background: #f59e0b;
    color: #fff;
}

.act-close:hover {
    background: #d97706;
    color: #fff;
}

/* Delete */
.act-del {
    background: #ef4444;
    color: #fff;
}

.act-del:hover {
    background: #dc2626;
    color: #fff;
}

/* Disabled */
.act-btn.disabled {
    opacity: 0.45;
    pointer-events: none;
    cursor: not-allowed;
}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<style>
/* ── Action badges – match inspection list style ── */
.act-btn {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 5px;
    font-size: 0.78rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    text-decoration: none;
    white-space: nowrap;
    transition: opacity .15s, filter .15s;
}
.act-wa {
    background: #dcfce7 !important;
    color: #16a34a !important;
}

.act-mail {
    background: #dbeafe !important;
    color: #2563eb !important;
}

.act-close {
    background: #fef3c7 !important;
    color: #d97706 !important;
}

.act-del {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}
.act-btn:hover  { filter: brightness(.92); }
.act-btn:active { opacity: .8; }
.act-wa    { background: #dcfce7; color: #15803d; }
.act-mail  { background: #dbeafe; color: #1d4ed8; }
.act-close { background: #d1fae5; color: #065f46; }
.act-del   { background: #fee2e2; color: #b91c1c; }
.act-btn.disabled { opacity: .35; pointer-events: none; cursor: default; }

/* ── Status pills ── */
.pill {
    display: inline-block;
    padding: 2px 10px;
    border-radius: 12px;
    font-size: 0.72rem;
    font-weight: 700;
}
.pill-pending { background: #fef3c7; color: #92400e; }
.pill-closed  { background: #f1f5f9; color: #64748b; }
.pill-overdue { background: #fee2e2; color: #b91c1c; }
.pill-soon    { background: #fef3c7; color: #b45309; }
.pill-ok      { background: #d1fae5; color: #065f46; }

/* ── Notify count badge ── */
.notif-badge {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    padding: 2px 9px;
    border-radius: 12px;
    font-size: 0.72rem;
    font-weight: 700;
    background: #dbeafe;
    color: #1d4ed8;
    border: 1px solid #bfdbfe;
    cursor: pointer;
    transition: background .15s;
}
.notif-badge:hover { background: #bfdbfe; }
.notif-badge.zero  { background: #f1f5f9; color: #94a3b8; border-color: #e2e8f0; cursor: default; }

/* ── Filter bar ── */
.filter-bar {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
    margin-bottom: 16px;
}
.filter-bar select {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 7px 12px;
    font-size: 0.875rem;
    color: #374151;
    background: #fafafa;
}
.filter-bar select:focus { outline: none; border-color: #3b82f6; }
.btn-filter {
    background: #2563eb;
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 7px 18px;
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
}
.btn-filter:hover { background: #1d4ed8; }

/* ── History modal ── */
.hist-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(15,23,42,.45);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}
.hist-overlay.open { display: flex; }
.hist-modal {
    background: #fff;
    border-radius: 12px;
    width: 90%;
    max-width: 640px;
    max-height: 85vh;
    overflow-y: auto;
    box-shadow: 0 20px 60px rgba(0,0,0,.25);
    animation: modalIn .2s ease;
}
@keyframes modalIn {
    from { opacity:0; transform:translateY(-16px); }
    to   { opacity:1; transform:translateY(0); }
}
.hist-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 24px;
    border-bottom: 1px solid #f1f5f9;
}
.hist-title  { font-size: 1rem; font-weight: 700; color: #1e293b; }
.hist-close  {
    background: none; border: none; font-size: 1.3rem;
    color: #6b7280; cursor: pointer; line-height:1; padding: 0 4px;
}
.hist-close:hover { color: #111; }
.hist-body   { padding: 20px 24px; }
.hist-table  { width: 100%; border-collapse: collapse; font-size: 0.82rem; }
.hist-table th {
    background: #f8fafc; color: #475569; font-weight: 700;
    padding: 8px 12px; text-align: left;
    border-bottom: 2px solid #e2e8f0;
}
.hist-table td {
    padding: 8px 12px;
    border-bottom: 1px solid #f1f5f9;
    color: #374151;
    vertical-align: middle;
}
.hist-table tr:last-child td { border-bottom: none; }
</style>

<div class="bg-white rounded-2xl shadow p-6">

    <!-- Header row -->
    <div class="flex items-center justify-between mb-4 flex-wrap gap-3">
        <div>
            <h2 class="text-2xl font-bold">Service Reminders</h2>
            <p class="text-sm text-gray-500 mt-0.5">Notify customers about upcoming vehicle services.</p>
        </div>
        <a href="<?= base_url('index.php/ServiceReminder/settings') ?>"
           class="inline-flex items-center gap-2 px-4 py-2 bg-gray-700 hover:bg-gray-800 text-white text-sm font-semibold rounded-lg transition">
            ⚙️ Settings
        </a>
    </div>

    <!-- Flash messages -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="mb-4 p-3 rounded-lg bg-green-50 border border-green-200 text-green-800 text-sm font-medium">
            ✅ <?= htmlspecialchars($this->session->flashdata('success')) ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('error')): ?>
        <div class="mb-4 p-3 rounded-lg bg-red-50 border border-red-200 text-red-800 text-sm font-medium">
            ❌ <?= htmlspecialchars($this->session->flashdata('error')) ?>
        </div>
    <?php endif; ?>

    <!-- Status filter -->
    <form method="get" action="<?= base_url('index.php/ServiceReminder/index') ?>">
        <div class="filter-bar">
            <select name="status" id="filter_status">
                <option value="">All Statuses</option>
                <option value="Pending" <?= ($selected_status ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
                <option value="Closed"  <?= ($selected_status ?? '') === 'Closed'  ? 'selected' : '' ?>>Closed</option>
            </select>
            <button type="submit" class="btn-filter">🔍 Filter</button>
        </div>
    </form>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full border border-gray-200 text-sm" id="reminderTable">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-3 py-2 text-center">#</th>
                    <th class="border px-3 py-2">Vehicle</th>
                    <th class="border px-3 py-2">Customer</th>
                    <th class="border px-3 py-2">Last Service</th>
                    <th class="border px-3 py-2">Reminder Date</th>
                    <th class="border px-3 py-2">Next Service</th>
                    <th class="border px-3 py-2 text-center">Days Left</th>
                    <th class="border px-3 py-2 text-center">Status</th>
                    <th class="border px-3 py-2 text-center">Notified</th>
                    <th class="border px-3 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reminders)): ?>
                    <?php $sl = 1; foreach ($reminders as $r): ?>
                        <?php
                            $today     = new DateTime(date('Y-m-d'));
                            $nextDt    = new DateTime($r->next_service_date);
                            $daysLeft  = (int) $today->diff($nextDt)->format('%r%a');
                            $isPending = ($r->status ?? 'Pending') === 'Pending';
                            $count     = (int) ($r->notify_count ?? 0);

                            if ($daysLeft < 0) {
                                $dayClass = 'pill-overdue';
                                $dayLabel = abs($daysLeft) . 'd overdue';
                            } elseif ($daysLeft <= 7) {
                                $dayClass = 'pill-soon';
                                $dayLabel = $daysLeft . ' days';
                            } else {
                                $dayClass = 'pill-ok';
                                $dayLabel = $daysLeft . ' days';
                            }

                            $remindLabel = !empty($r->reminder_date)
                                ? date('d M Y', strtotime($r->reminder_date))
                                : '—';
                        ?>
                        <tr class="hover:bg-gray-50">
                            <!-- # -->
                            <td class="border px-3 py-2 text-center text-gray-500"><?= $sl++ ?></td>

                            <!-- Vehicle -->
                            <td class="border px-3 py-2 font-medium">
                                <?= htmlspecialchars($r->vehicle_no ?? '—') ?>
                            </td>

                            <!-- Customer -->
                            <td class="border px-3 py-2">
                                <div class="font-medium"><?= htmlspecialchars($r->customer_name ?? '—') ?></div>
                                <?php if (!empty($r->customer_phone)): ?>
                                    <div class="text-xs text-gray-500">📞 <?= htmlspecialchars($r->customer_phone) ?></div>
                                <?php endif; ?>
                            </td>

                            <!-- Last Service -->
                            <td class="border px-3 py-2 text-gray-600">
                                <?= !empty($r->last_service_date) ? date('d M Y', strtotime($r->last_service_date)) : '—' ?>
                            </td>

                            <!-- Reminder Date -->
                            <td class="border px-3 py-2 text-gray-500 text-xs">
                                <?= $remindLabel ?>
                            </td>

                            <!-- Next Service -->
                            <td class="border px-3 py-2 font-semibold text-gray-800">
                                <?= date('d M Y', strtotime($r->next_service_date)) ?>
                            </td>

                            <!-- Days Left -->
                            <td class="border px-3 py-2 text-center">
                                <span class="pill <?= $dayClass ?>"><?= $dayLabel ?></span>
                            </td>

                            <!-- Status -->
                            <td class="border px-3 py-2 text-center">
                                <?php if ($isPending): ?>
                                    <span class="pill pill-pending">Pending</span>
                                <?php else: ?>
                                    <span class="pill pill-closed">Closed</span>
                                <?php endif; ?>
                            </td>

                            <!-- Notified count -->
                            <td class="border px-3 py-2 text-center">
                                <?php if ($count > 0): ?>
                                    <span class="notif-badge"
                                          onclick="openHistory(<?= $r->reminder_id ?>)"
                                          title="View notification history">
                                        📨 ×<?= $count ?>
                                    </span>
                                <?php else: ?>
                                    <span class="notif-badge zero">—</span>
                                <?php endif; ?>
                            </td>

                            <!-- Actions -->
                            <td class="border px-3 py-2 text-center space-x-1">
                               <!-- WhatsApp -->
<a href="<?= base_url('index.php/servicereminder/notify_whatsapp/' . $r->reminder_id) ?>" 
   class="act-btn act-wa <?= !$isPending ? 'disabled' : '' ?>" 
   title="Notify via WhatsApp" 
   <?= $isPending ? 'onclick="return confirm(\'Send WhatsApp reminder to ' . addslashes(htmlspecialchars($r->customer_name ?? 'customer')) . '?\')"' : '' ?>>
    <i class="fab fa-whatsapp"></i><?= $count > 0 ? ' Resend' : ' Send' ?>
</a>

<!-- Email -->
<!-- <a href="<?= base_url('index.php/servicereminder/notify_email/' . $r->reminder_id) ?>" 
   class="act-btn act-mail <?= !$isPending ? 'disabled' : '' ?>" 
   title="Notify via Email" 
   <?= $isPending ? 'onclick="return confirm(\'Send Email reminder to ' . addslashes(htmlspecialchars($r->customer_name ?? 'customer')) . '?\')"' : '' ?>>
    <i class="fas fa-envelope"></i>
</a> -->

<!-- Close -->
<?php if ($isPending): ?>
    <a href="<?= base_url('index.php/servicereminder/close/' . $r->reminder_id) ?>" 
       class="act-btn act-close" 
       onclick="return confirm('Mark this reminder as Closed?')"
       title="Close Reminder">
        <i class="fas fa-check"></i>
    </a>
<?php endif; ?>

<!-- Delete -->
<a href="<?= base_url('index.php/servicereminder/delete/' . $r->reminder_id) ?>" 
   class="act-btn act-del" 
   onclick="return confirm('Delete this reminder and its notification history?')"
   title="Delete Reminder">
    <i class="fas fa-trash"></i>
</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- ── Notification History Modal ── -->
<div class="hist-overlay" id="histModal">
    <div class="hist-modal">
        <div class="hist-header">
            <span class="hist-title">📨 Notification History</span>
            <button class="hist-close" onclick="closeHistory()">✕</button>
        </div>
        <div class="hist-body" id="histBody">
            <p class="text-sm text-gray-400 text-center py-6">Loading…</p>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#reminderTable').DataTable({
        pageLength: 25,
        order: [[5, 'asc']],   // sort by Next Service date by default
        columnDefs: [
            { orderable: false, targets: [8, 9] }  // Notified & Actions not sortable
        ],
        language: {
            search: 'Search:',
            lengthMenu: 'Show _MENU_ entries',
            info: 'Showing _START_ to _END_ of _TOTAL_ reminders',
            emptyTable: 'No service reminders found.'
        }
    });
});

var historyUrl = '<?= base_url('index.php/servicereminder/history/') ?>';

function openHistory(reminderId) {
    var modal = document.getElementById('histModal');
    var body  = document.getElementById('histBody');
    body.innerHTML = '<p class="text-sm text-gray-400 text-center py-6">Loading…</p>';
    modal.classList.add('open');

    fetch(historyUrl + reminderId)
        .then(function(r){ return r.json(); })
        .then(function(logs) {
            if (!logs || !logs.length) {
                body.innerHTML = '<p class="text-sm text-gray-400 text-center py-6">No notifications sent yet.</p>';
                return;
            }
            var html = '<table class="hist-table"><thead><tr>'
                + '<th>#</th><th>Channel</th><th>Sent To</th><th>Date &amp; Time</th><th>Status</th><th>Note</th>'
                + '</tr></thead><tbody>';
            logs.forEach(function(log, i) {
                var ch = log.channel === 'whatsapp'
                    ? '<span style="color:#15803d;font-weight:700;">📱 WhatsApp</span>'
                    : '<span style="color:#1d4ed8;font-weight:700;">✉️ Email</span>';
                var st = log.status === 'success'
                    ? '<span style="color:#065f46;">✔ Success</span>'
                    : '<span style="color:#b91c1c;">✗ Failed</span>';
                html += '<tr>'
                    + '<td>' + (i + 1) + '</td>'
                    + '<td>' + ch + '</td>'
                    + '<td>' + (log.sent_to || '—') + '</td>'
                    + '<td style="white-space:nowrap">' + (log.sent_at || '—') + '</td>'
                    + '<td>' + st + '</td>'
                    + '<td style="font-size:.75rem;color:#6b7280">' + (log.note || '—') + '</td>'
                    + '</tr>';
            });
            html += '</tbody></table>';
            body.innerHTML = html;
        })
        .catch(function() {
            body.innerHTML = '<p class="text-sm text-red-500 text-center py-6">Failed to load history.</p>';
        });
}

function closeHistory() {
    document.getElementById('histModal').classList.remove('open');
}

document.getElementById('histModal').addEventListener('click', function(e) {
    if (e.target === this) closeHistory();
});
</script>
