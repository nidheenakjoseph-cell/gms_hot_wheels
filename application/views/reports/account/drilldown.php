
<div class="mb-3">
    <a href="<?php echo base_url().'index.php/Accounts/view_profit_and_loss?from='.$from.'&to='.$to; ?>" 
       class="btn btn-sm btn-primary">
        ← Back to Profit & Loss
    </a>
</div>
<table class="table table-bordered">
<tr>
    <th>Date</th>
    <th>Ledger</th>
    <th>Amount</th>
</tr>

<?php foreach($ledgers as $l){ ?>
<tr>
    <td><?= date('d-m-Y', strtotime($l->date)) ?></td>
    <td><?= $l->ledger_name ?></td>
    <td align="right" style="color: <?= ($l->amount >= 0) ? 'green' : 'red'; ?>">
        <?= number_format(abs($l->amount), 2) ?>
    </td>
</tr>
<?php 
$total = array_sum(array_column($ledgers, 'amount'));
?>


<?php } ?>
<tr>
    <td colspan="2"><b>Total</b></td>
    <td align="right"><b><?= number_format($total,2) ?></b></td>
</tr>
</table>
