<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Forgot Password | GMS</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="<?= base_url('public/css/auth-pages.css') ?>">
</head>
<body>
	<main class="auth-shell">
		<section class="auth-brand" aria-label="Garage Management System">
			<div class="auth-logo-frame">
				<img src="<?= base_url('public/images/logoauto1.png') ?>" alt="Garage Management System logo">
			</div>
			<h1>Everything your workshop needs, in one place.</h1>
			<hr class="auth-brand-rule">
		</section>

		<section class="auth-content" aria-labelledby="forgot-title">
			<header class="auth-heading">
				<h2 id="forgot-title">Reset Your Password</h2>
				<p>Enter your account email and we will send you a reset link.</p>
			</header>

		<?php if ($this->session->flashdata('success')): ?>
			<div class="auth-alert" role="status" style="color:#246b48;background:#edf8f1;border-color:#cce9d6"><?= html_escape($this->session->flashdata('success')) ?></div>
		<?php endif; ?>
		<?php if ($this->session->flashdata('error')): ?>
			<div class="auth-alert" role="alert"><?= html_escape($this->session->flashdata('error')) ?></div>
		<?php endif; ?>

			<form method="post" action="<?= base_url('index.php/login/send_reset_link') ?>" class="auth-form">
			<div class="auth-field">
				<label for="email">Email address</label>
				<input type="email" id="email" name="email" autocomplete="email" required autofocus placeholder="you@example.com">
			</div>
			<div id="mailtrap-recipient" class="auth-field hidden">
				<label for="test_recipient">Mailtrap recipient</label>
				<input type="email" id="test_recipient" name="test_recipient" placeholder="Mailtrap inbox email">
				<p class="field-help">Use an existing GMS email above to create the reset link, and your Mailtrap inbox email here to receive it.</p>
			</div>
			<!-- <div class="auth-actions">
				<button type="submit" class="auth-button">Send reset link</button>
				<button type="button" onclick="testMailtrapEmail()" class="auth-button auth-button-secondary">Test reset link with Mailtrap</button>
			</div> -->
		</form>

		<a href="<?= base_url('index.php/login') ?>" class="auth-link">Back to login</a>
		<p class="auth-attribution">@Developed by Concepts 360 Plus</p>
		</section>
	</main>
	<script>
	function testMailtrapEmail() {
		var form = document.querySelector('form');
		var email = document.getElementById('email').value;
		var recipient = document.getElementById('test_recipient');
		var recipientGroup = document.getElementById('mailtrap-recipient');
		if (!email) {
			document.getElementById('email').focus();
			return;
		}
		if (!recipient.value) {
			recipientGroup.classList.remove('hidden');
			recipient.required = true;
			recipient.focus();
			return;
		}

		var input = document.createElement('input');
		input.type = 'hidden';
		input.name = 'test_mailtrap';
		input.value = '1';
		form.appendChild(input);
		form.submit();
	}
	</script>
</body>
</html>
