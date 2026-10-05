/* ================================
   VEHICLE SELECTION & AUTO-UPDATE
   ================================ */
function updateVehicleDetailsQ() {
	const select = document.getElementById('vehicleSelectQ');
	if (!select) return;

	const selectedValue = select.value;

	if (selectedValue === 'ADD_NEW') {
		openVehicleModalQ();
		select.value = '';
		return;
	}

	if (!selectedValue) {
		return;
	}

	const option = select.options[select.selectedIndex];
	const hiddenVehicleId = document.getElementById('hiddenVehicleIdQ');
	const vehicleModelField = document.getElementById('vehicleModelFieldQ');
	const vinField = document.getElementById('vinNoFieldQ');

	if (hiddenVehicleId) {
		hiddenVehicleId.value = selectedValue;
	}

	if (vehicleModelField) {
		vehicleModelField.value = option.dataset.model || '';
	}

	if (vinField) {
		vinField.value = option.dataset.vin || '';
	}
}

function openVehicleModalQ() {
	document.getElementById('addVehicleModalQ').classList.remove('hidden');
}

function closeVehicleModalQ() {
	document.getElementById('addVehicleModalQ').classList.add('hidden');
}

// Brand dropdown change listener
document.getElementById('brandSelectQ').addEventListener('change', function() {
	const brandId = this.value;
	const modelSelect = document.getElementById('modelSelectQ');
	
	if (brandId) {
		fetch('<?= base_url("index.php/Customer/get_models_by_brand") ?>', {
			method: 'POST',
			headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
			body: 'brand_id=' + encodeURIComponent(brandId)
		})
		.then(response => response.json())
		.then(data => {
			modelSelect.innerHTML = '<option value="">-- Select Model --</option>';
			if (data && Array.isArray(data)) {
				data.forEach(model => {
					const option = document.createElement('option');
					option.value = model.model_id;
					option.textContent = model.model_name;
					modelSelect.appendChild(option);
				});
			}
		});
	} else {
		modelSelect.innerHTML = '<option value="">-- Select Model --</option>';
	}
});

// Add vehicle form submit
document.getElementById('addVehicleFormQ').addEventListener('submit', function(e) {
	e.preventDefault();
	
	const formData = new FormData();
	formData.append('customer_id', CUSTOMER_ID);
	formData.append('brand_id', document.getElementById('brandSelectQ').value);
	formData.append('model_id', document.getElementById('modelSelectQ').value);
	formData.append('registration_no', document.getElementById('registrationNoQ').value);
	formData.append('chassis_no', document.getElementById('chassisNoQ').value);
	formData.append('engine_no', document.getElementById('engineNoQ').value);
	formData.append('year', document.getElementById('yearQ').value);
	formData.append('color', document.getElementById('colorQ').value);
	formData.append('variant', document.getElementById('variantQ').value);
	
	fetch('<?= base_url("index.php/Customer/save_vehicle_ajax") ?>', {
		method: 'POST',
		body: formData
	})
	.then(response => response.json())
	.then(data => {
		if (data.status === 'success') {
			// Reload vehicles
			location.reload();
		} else {
			alert(data.message);
		}
	});
});

// KM In auto-save
document.getElementById('kmInFieldQ').addEventListener('change', function() {
	const quotationId = QUOTATION_ID;
	const kmin = this.value;
	const statusEl = document.getElementById('kmSaveStatusQ');
	
	statusEl.textContent = 'Saving...';
	statusEl.style.color = '#3b82f6';
	
	fetch('<?= base_url("index.php/Quotation/update_km_in") ?>', {
		method: 'POST',
		headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
		body: 'quotation_id=' + encodeURIComponent(quotationId) + '&kmin=' + encodeURIComponent(kmin)
	})
	.then(response => response.json())
	.then(data => {
		if (data.status === 'success') {
			statusEl.textContent = '✓ Saved';
			statusEl.style.color = '#22c55e';
			setTimeout(() => { statusEl.textContent = ''; }, 2000);
		} else {
			statusEl.textContent = 'Error saving';
			statusEl.style.color = '#ef4444';
		}
	});
});

// Modal click outside to close
document.getElementById('addVehicleModalQ').addEventListener('click', function(e) {
	if (e.target === this) {
		closeVehicleModalQ();
	}
});
