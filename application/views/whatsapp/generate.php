<div class="form-group">
    <label>WhatsApp Number</label>
    <input type="text"
           name="whatsapp_number"
           class="form-control" value="<?= @$whatsapp->whatsapp_number ?>">
</div>

<div class="form-group">
    <label>Phone Number ID</label>
    <input type="text"
           name="phone_number_id"
           class="form-control" value="<?= @$whatsapp->phone_number_id ?>">
</div>

<div class="form-group">
    <label>Access Token</label>
    <textarea name="access_token"
              class="form-control"><?= @$whatsapp->access_token ?></textarea>
</div>

<button type="button"
        onclick="saveWhatsapp()">
    Save Settings
</button>

<button type="button"
        onclick="testWhatsapp()">
    Test Connection
</button>

<script>
function testWhatsapp()
{
    $.post(
        '<?=base_url("index.php/Whatsapp_integration/test_connection")?>',
        {
            mobile:
                $('[name=whatsapp_number]').val()
        },
        function(res)
        {
            console.log(res);

            alert(
                res.http_code == 200
                ? 'Connected Successfully'
                : 'Connection Failed'
            );
        },
        'json'
    );
}
</script>


<script>
function saveWhatsapp()
{
    $.post(
        '<?=base_url("index.php/Whatsapp_integration/save_whatsapp")?>',
        {
            whatsapp_number:
                $('[name=whatsapp_number]').val(),

            phone_number_id:
                $('[name=phone_number_id]').val(),

            access_token:
                $('[name=access_token]').val()
        },
        function(res)
        {
            alert(res.message);
        },
        'json'
    );
}
</script>