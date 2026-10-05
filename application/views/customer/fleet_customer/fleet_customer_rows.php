<?php if (!empty($customers)) : ?>

    <?php $sl = 1; ?>
    <?php foreach ($customers as $c) : ?>
<tr class="border-b hover:bg-gray-50 text-sm">

	<td class="p-3"><?= $sl++ ?></td>

	<td class="p-3 font-medium"><?= $c->name ?></td>

	<td class="p-3"><?= $c->company_contact_person ?></td>

	<td class="p-3"><?= $c->phone ?></td>

	<td class="p-3"><?= $c->email ?></td>

	<td class="p-3"><?= number_format($c->credit_limit, 2) ?></td>

	<td class="p-3"><?= $c->payment_terms ?> days</td>

	<td class="p-3 text-center flex justify-center gap-3">

		<a href="<?= base_url('index.php/customer/edit_fleet/' . $c->customer_id); ?>"
			class="p-2 rounded bg-yellow-100 hover:bg-yellow-200"
			title="Edit">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none"
				viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
				class="w-5 h-5 text-yellow-700">
				<path stroke-linecap="round" stroke-linejoin="round"
					d="M16.862 3.487l3.651 3.651M17.708 
                    2.64a2.25 2.25 0 113.182 3.182L7.125 
                    19.586a4.5 4.5 0 01-1.91 1.146L3 
                    21l.268-2.214a4.5 4.5 0 011.146-1.91L17.708 2.64z" />
			</svg>
		</a>

		<a onclick="return confirm('Delete this fleet customer?');"
			href="<?= base_url('index.php/customer/delete_fleet/' . $c->customer_id); ?>"
			class="p-2 rounded bg-red-100 hover:bg-red-200"
			title="Delete">
			<svg xmlns="http://www.w3.org/2000/svg" fill="none"
				viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
				class="w-5 h-5 text-red-700">
				<path stroke-linecap="round" stroke-linejoin="round"
					d="M6 7.5h12M9.75 7.5V4.5h4.5V7.5M10.5 
                    10.5v6M13.5 10.5v6M4.5 7.5l1.5 
                    12h12l1.5-12" />
			</svg>
		</a>

	</td>

</tr>
    <?php endforeach; ?>

<?php else : ?>

<tr>
	<td></td>
    <td></td>
    <td></td>
    <td class="text-center p-4">No fleet customers found.</td>
    
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>

<?php endif; ?>