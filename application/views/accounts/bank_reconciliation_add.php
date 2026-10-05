<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>

<div class="p-6 w-full">
	<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
		<!-- Header -->
		<div class="flex justify-between items-center mb-6 pb-4 border-b border-gray-100">
			<div>
				<h2 class="text-2xl font-bold text-gray-800 tracking-tight flex items-center gap-2">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
					</svg>
					Bank Reconciliation
				</h2>
				<p class="text-xs text-gray-500 mt-1">Select bank account and date range to collect unreconciled transactions and reconcile.</p>
			</div>
			<div class="flex gap-3"> 
				<a href="<?= base_url('index.php/Accounts/list_bank_reconciliation') ?>"
					class="inline-flex items-center gap-2 bg-blue-50 hover:bg-blue-100 text-blue-700 px-4 py-2 rounded-xl text-sm font-semibold transition">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
					</svg>
					Reconciliation Records
				</a> 
			</div>
		</div>

		<form class="form-horizontal"
			action="<?php echo base_url() . 'index.php/Accounts/view_bank_reconciliation'; ?>"
			id="receipt"
			method="post"
			name="receipt">

			<!-- Filters -->
			<div class="bg-slate-50 p-4 rounded-xl border border-slate-200 mb-6 flex flex-wrap items-end gap-4">
				<!-- Account -->
				<div class="w-80"> 
					<label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1"> Select Bank Account <span class="text-red-500">*</span> </label>
					<select tabindex="1" class="w-full border border-gray-300 rounded-lg px-3 py-2 select2 account-select" id="account_id" name="account_id" required onchange="get_doc_list()">
						<option value="">Choose Bank Account</option> 
						<?php foreach ($account_ledgers as $s) { ?> 
							<option <?php if ($s->account_id == $account_id) echo 'selected'; ?> value="<?php echo $s->account_id; ?>"> 
								<?php echo $s->account_name; ?> 
							</option> 
						<?php } ?>
					</select>
				</div> 
				<!-- From -->
				<div>
					<label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1">From Date</label>
					<input type="date" class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none" id="from_date" name="from_date" onchange="get_doc_list()">
				</div> 
				<!-- To -->
				<div>
					<label class="block text-xs font-semibold uppercase tracking-wider text-slate-600 mb-1">To Date</label>
					<input type="date" class="border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-blue-500 focus:outline-none" id="to_date" name="to_date" onchange="get_doc_list()">
				</div>
				<!-- Fetch Button / Status -->
				<div>
					<button type="button" onclick="get_doc_list()" class="bg-slate-800 hover:bg-slate-900 text-white text-sm font-medium px-4 py-2 rounded-lg transition flex items-center gap-1.5 shadow-sm">
						<svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
						</svg>
						Fetch Records
					</button>
				</div>
			</div> 

			<!-- Reconciliation List Container -->
			<div id="reco_list" class="mb-6 min-h-[150px]"> 
				<div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50 text-gray-400">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
					</svg>
					<p class="font-medium text-gray-600">No Account Selected</p>
					<p class="text-xs text-gray-400 mt-1">Please select a Bank Account above to view unreconciled transactions.</p>
				</div>
			</div>

		</form>

	</div>
</div>
<script>

function get_doc_list() {

    var account_id = $('#account_id').val();
    var from_date  = $('#from_date').val();
    var to_date    = $('#to_date').val();

    if (account_id !== '') {

        $('#reco_list').html(`
            <div class="flex flex-col items-center justify-center py-12 border border-gray-200 rounded-2xl bg-gray-50">
                <svg class="animate-spin h-8 w-8 text-blue-600 mb-3"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24">

                    <circle class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4">
                    </circle>

                    <path class="opacity-75"
                          fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                    </path>
                </svg>

                <span class="text-sm font-medium text-gray-600">
                    Loading unreconciled transactions...
                </span>
            </div>
        `);

        $.ajax({

            url: "<?= site_url('Ajax/get_reco_list'); ?>",

            type: 'POST',

            data: {
                account_id: account_id,
                from_date: from_date,
                to_date: to_date
            },

            success: function(msg) {

                $('#reco_list').html(msg);

                // Initialize DataTable AFTER AJAX HTML is loaded
                initializeRecoTable();

                // Update selected totals
                updateSelectedTotals();
            },

            error: function(xhr) {

                console.log(xhr.responseText);

                $('#reco_list').html(`
                    <div class="text-center py-8 text-red-500 bg-red-50 rounded-2xl border border-red-200">
                        Failed to load reconciliation records.
                        Please try again.
                    </div>
                `);
            }
        });

    } else {

        $('#reco_list').html(`
            <div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50 text-gray-400">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-12 h-12 mx-auto text-gray-300 mb-2"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.5"
                          d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>

                <p class="font-medium text-gray-600">
                    No Account Selected
                </p>

                <p class="text-xs text-gray-400 mt-1">
                    Please select a Bank Account above to view unreconciled transactions.
                </p>

            </div>
        `);
    }
}


/*
|--------------------------------------------------------------------------
| Initialize DataTable
|--------------------------------------------------------------------------
*/

function initializeRecoTable() {

    if ($('#dr_table').length && $.fn.DataTable) {

        // Destroy existing instance if any
        if ($.fn.DataTable.isDataTable('#dr_table')) {
            $('#dr_table').DataTable().destroy();
        }

        $('#dr_table').DataTable({

            pageLength: 25,

            columnDefs: [
                {
                    orderable: false,
                    targets: [0, 9, 10]
                }
            ]
        });
    }
}


/*
|--------------------------------------------------------------------------
| Select All
|--------------------------------------------------------------------------
*/

function toggleSelectAll(masterCb) {

    $('.reco-cb').prop('checked', masterCb.checked);

    updateSelectedTotals();
}


/*
|--------------------------------------------------------------------------
| Selected Totals
|--------------------------------------------------------------------------
*/

function updateSelectedTotals() {

    let selectedCount = 0;
    let selectedTotal = 0;

    $('.reco-cb:checked').each(function() {

        selectedCount++;

        let row = $(this).closest('tr');

        let amount = parseFloat(
            row.find('td[data-amount]').attr('data-amount')
        ) || 0;

        selectedTotal += amount;
    });

    $('#card_selected_count').text(selectedCount);

    $('#card_selected_total').text(
        '₹ ' +
        selectedTotal.toLocaleString('en-IN', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        })
    );
}


/*
|--------------------------------------------------------------------------
| Set Today's Date
|--------------------------------------------------------------------------
*/

function fillTodayDates() {

    let today = new Date().toISOString().split('T')[0];

    $('.reco-cb:checked').each(function() {

        let row = $(this).closest('tr');

        row.find('.bank-date-input').val(today);
    });
}


/*
|--------------------------------------------------------------------------
| Copy Voucher Date
|--------------------------------------------------------------------------
*/

function copyVoucherDates() {

    $('.reco-cb:checked').each(function() {

        let row = $(this).closest('tr');

        let vdate = row
            .find('td[data-vdate]')
            .attr('data-vdate');

        if (vdate) {
            row.find('.bank-date-input').val(vdate);
        }
    });
}


/*
|--------------------------------------------------------------------------
| Reconcile Single Row
|--------------------------------------------------------------------------
*/

function reconcileSingleRow(voucherId) {

    let row = $('#row_' + voucherId);

    let bankDate = $('#bank_date_' + voucherId).val();

    let instNo = $('#inst_no_' + voucherId).val();

    let instDate = row
        .find('input[name="instrument_dates[' + voucherId + ']"]')
        .val();

    let amount = row
        .find('input[name="deposit_amounts[' + voucherId + ']"]')
        .val();

    let accountId = $('#account_id').val();


    if (!bankDate) {

        alert('Please select a valid Bank Clearing Date first.');

        return;
    }


    if (!confirm(
        'Reconcile this item with Bank Date: ' + bankDate + '?'
    )) {
        return;
    }


    $.ajax({

        url: "<?= site_url('Ajax/reconcile_single_item'); ?>",

        type: "POST",

        dataType: "json",

        data: {

            voucher_id: voucherId,
            bank_date: bankDate,
            instrument_no: instNo,
            instrument_date: instDate,
            amount: amount,
            account_id: accountId

        },

        success: function(res) {

            if (res.status === 'success') {

                row
                    .addClass('bg-emerald-50 text-emerald-800')
                    .fadeOut(600, function() {

                        $(this).remove();

                        updateSelectedTotals();

                    });

            } else {

                alert(
                    res.message ||
                    'Error occurred while reconciling.'
                );
            }
        },

        error: function(xhr) {

            console.log(xhr.responseText);

            alert(
                'Server error occurred during reconciliation.'
            );
        }
    });
}


/*
|--------------------------------------------------------------------------
| Page Load
|--------------------------------------------------------------------------
*/

$(document).ready(function() {

    $('.account-select').select2({
        width: '100%'
    });

});

</script>
<!-- 
<script>
	function get_doc_list() {
		var account_id = document.getElementById('account_id').value;
		var from_date = document.getElementById('from_date').value;
		var to_date = document.getElementById('to_date').value;
		
		if (account_id != '') {
			document.getElementById('reco_list').innerHTML = `
				<div class="flex flex-col items-center justify-center py-12 border border-gray-200 rounded-2xl bg-gray-50">
					<svg class="animate-spin h-8 w-8 text-blue-600 mb-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
						<circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
						<path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
					</svg>
					<span class="text-sm font-medium text-gray-600">Loading unreconciled transactions...</span>
				</div>
			`;

			$.ajax({
				url: "<?php echo site_url('Ajax/get_reco_list'); ?>",
				type: 'POST',
				data: {
					account_id: account_id,
					from_date: from_date,
					to_date: to_date
				},
				success: function(msg) {
					document.getElementById('reco_list').innerHTML = msg;
				},
				error: function() {
					document.getElementById('reco_list').innerHTML = `
						<div class="text-center py-8 text-red-500 bg-red-50 rounded-2xl border border-red-200">
							Failed to load reconciliation records. Please try again.
						</div>
					`;
				}
			});
		} else {
			document.getElementById('reco_list').innerHTML = `
				<div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50 text-gray-400">
					<svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
					</svg>
					<p class="font-medium text-gray-600">No Account Selected</p>
					<p class="text-xs text-gray-400 mt-1">Please select a Bank Account above to view unreconciled transactions.</p>
				</div>
			`;
		}
	}

	$(document).ready(function() {
		$('.account-select').select2({
			width: '100%'
		});
	});
</script> -->
