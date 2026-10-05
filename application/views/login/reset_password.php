<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reset Password | GMS</title>
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

		<section class="auth-content" aria-labelledby="reset-title">
			<header class="auth-heading">
				<h2 id="reset-title">Set A New Password</h2>
				<p>Choose a secure password for your account.</p>
			</header>

		<?php if (!empty($error)): ?>
			<div class="auth-alert" role="alert"><?= html_escape($error) ?></div>
		<?php endif; ?>

		<?php if (!empty($selector) && !empty($token)): ?>
		<form method="post" action="<?= base_url('index.php/login/update_password') ?>" class="auth-form">
			<input type="hidden" name="selector" value="<?= html_escape($selector) ?>">
			<input type="hidden" name="token" value="<?= html_escape($token) ?>">
			<div class="auth-field">
				<label for="password">New password</label>
				<input type="password" id="password" name="password" minlength="8" required autocomplete="new-password">
			</div>
			<div class="auth-field">
				<label for="password_confirmation">Confirm new password</label>
				<input type="password" id="password_confirmation" name="password_confirmation" minlength="8" required autocomplete="new-password">
			</div>
			<button type="submit" class="auth-button">Reset password</button>
		</form>
		<?php endif; ?>

		<a href="<?= base_url('index.php/login') ?>" class="auth-link">Back to login</a>
		<p class="auth-attribution">@Developed by Concepts 360 Plus</p>
		</section>
	</main>
</body>
</html>
