<?php $sl = 1; foreach ($customers as $c): ?>
<tr class="border-b hover:bg-gray-50">
	<td class="p-3"><?= $sl++; ?></td>
	<td class="p-3 font-medium"><?= $c->name ?></td>
	<td class="p-3"><?= $c->phone ?></td>
	<td class="p-3"><?= $c->email ?></td>
	<td class="p-3 whitespace-normal break-words"><?= $c->address ?></td>
	<td class="p-3 text-center">
		<a href="<?= base_url('index.php/Customer/edit/'.$c->customer_id) ?>"
		   class="text-blue-600">Edit</a>
		   	<a onclick="return confirm('Are you sure you want to delete this customer?');"
								href="<?= base_url('index.php/Customer/delete/' . $c->customer_id); ?>"
								class="p-2 rounded bg-red-100 hover:bg-red-200"
								title="Delete"
								class="text-blue-600">Delete</a>
							
	</td>
</tr>
<?php endforeach; ?>
