<div class="card" style="max-width: 900px; margin: 24px auto;">
    <div class="card-header" style="font-weight: 700; font-size: 1.1rem; padding: 18px 20px; background: #f8f9fa; border-bottom: 1px solid #dee2e6;">
        WhatsApp Integration
    </div>
    <div class="card-body" style="padding: 20px; display: grid; gap: 24px;">
        <div>
            <p>Connect your garage WhatsApp Business account using Meta login, or enter the WhatsApp configuration manually if you already have the values.</p>

            <button class="btn btn-success" id="wa-connect-btn" style="padding: 10px 18px; border-radius: 6px; font-weight: 600;">
                Connect WhatsApp
            </button>

            <?php if (!empty($whatsapp) && !empty($whatsapp->whatsapp_number)): ?>
                <div style="margin-top: 18px; padding: 16px; background: #f1f3f5; border-radius: 6px;">
                    <strong>Connected number:</strong>
                    <div><?= htmlspecialchars($whatsapp->whatsapp_number) ?></div>
                    <div style="margin-top: 8px; font-size: 0.95rem; color: #495057;">
                        Phone Number ID: <?= htmlspecialchars($whatsapp->phone_number_id) ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div style="padding: 18px; border: 1px solid #dee2e6; border-radius: 10px; background: #ffffff;">
            <h4 style="margin-top: 0;">Manual WhatsApp Settings</h4>
            <p>Fill these fields if you already have an existing WhatsApp Business phone number and access token.</p>

            <div style="display: grid; gap: 14px;">
                <div>
                    <label style="font-weight: 600; display: block; margin-bottom: 6px;">WhatsApp Number</label>
                    <input type="text" name="whatsapp_number" class="form-control" value="<?= htmlspecialchars(@$whatsapp->whatsapp_number) ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" />
                </div>

                <div>
                    <label style="font-weight: 600; display: block; margin-bottom: 6px;">Phone Number ID</label>
                    <input type="text" name="phone_number_id" class="form-control" value="<?= htmlspecialchars(@$whatsapp->phone_number_id) ?>" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" />
                </div>

                <div>
                    <label style="font-weight: 600; display: block; margin-bottom: 6px;">Access Token</label>
                    <textarea name="access_token" class="form-control" rows="4" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;"><?= htmlspecialchars(@$whatsapp->access_token) ?></textarea>
                </div>

                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button type="button" class="btn btn-success" onclick="saveWhatsapp()" style="padding: 10px 18px; border-radius: 6px;">Save Settings</button>
                    <button type="button" class="btn btn-secondary" onclick="testWhatsapp()" style="padding: 10px 18px; border-radius: 6px;">Test Connection</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<script>
window.fbAsyncInit = function() {
    FB.init({
        appId      : '1246618450540161',
        cookie     : true,
        xfbml      : true,
        version    : 'v21.0'
    });
};

$('#wa-connect-btn').click(function() {
    FB.login(
        function(response) {

        if (response.authResponse) {
            console.log(response);
            // Fixed: Pointing to your actual CodeIgniter 3 Class/Method endpoint path
            window.location = "<?= base_url('index.php/Whatsapp_integration/callback') ?>?code=" + response.authResponse.code;
        } else {
            alert('WhatsApp connect was not completed.');
        }
            // if (response.authResponse) {
            //     console.log(response);
            //     window.location = "<?= site_url('whatsapp/callback') ?>?code=" + response.authResponse.code;
            // }
            // else {
            //     alert('WhatsApp connect was not completed.');
            // }
        },
        {
            config_id: '1544634777391172',
            response_type: 'code',
            override_default_response_type: true,
            extras: {
                setup: {},
                sessionInfoVersion: '2'
            }
        }
    );
});

function saveWhatsapp() {
    $.post(
        '<?= base_url("index.php/Whatsapp_integration/save_whatsapp") ?>',
        {
            whatsapp_number: $('[name=whatsapp_number]').val(),
            phone_number_id: $('[name=phone_number_id]').val(),
            access_token: $('[name=access_token]').val()
        },
        function(res) {
            if (res && res.message) {
                alert(res.message);
            } else {
                alert('Settings saved successfully.');
            }
        },
        'json'
    );
}

function testWhatsapp() {
    $.post(
        '<?= base_url("index.php/Whatsapp_integration/test_connection") ?>',
        {
            mobile: $('[name=whatsapp_number]').val()
        },
        function(res) {
            if (res && res.http_code == 200) {
                alert('Connected Successfully');
            } else {
                alert('Connection Failed');
            }
        },
        'json'
    );
}
</script>
