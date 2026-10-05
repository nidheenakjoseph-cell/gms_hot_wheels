<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login | GMS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
	<style>
		:root {
			color-scheme: light;
			font-family: 'Manrope', 'Segoe UI', sans-serif;
			font-synthesis: none;
			text-rendering: optimizeLegibility;
			--ink: #18252b;
			--muted: #68777b;
			--accent: #147d78;
			--accent-dark: #0c625e;
		}

		* {
			box-sizing: border-box;
		}

		body {
			min-height: 100vh;
			margin: 0;
			padding: 36px;
			display: grid;
			place-items: center;
			position: relative;
			isolation: isolate;
			background: #1c3035 url("<?= base_url('public/images/bg.jpg') ?>") center / cover fixed no-repeat;
			color: var(--ink);
		}

		body::before {
			position: fixed;
			inset: 0;
			z-index: -1;
			background: linear-gradient(115deg, rgba(11, 31, 36, .74), rgba(17, 37, 42, .42));
			content: '';
		}

		.login-shell {
			width: min(100%, 1020px);
			min-height: 610px;
			display: grid;
			grid-template-columns: 1fr .88fr;
			overflow: hidden;
			border: 1px solid rgba(255, 255, 255, .42);
			border-radius: 12px;
			background: rgba(255, 255, 255, .97);
			box-shadow: 0 28px 80px rgba(4, 20, 24, .3);
			animation: arrive .55s ease-out both;
		}

		.brand-panel {
			padding: 56px clamp(30px, 5vw, 72px);
			display: flex;
			flex-direction: column;
			align-items: flex-start;
			justify-content: center;
			background: linear-gradient(145deg, rgba(19, 50, 55, .96), rgba(20, 70, 72, .91));
			color: #fff;
		}

		.logo-frame {
			width: min(100%, 310px);
			min-height: 126px;
			padding: 20px 25px;
			display: grid;
			place-items: center;
			border-radius: 8px;
			background: #fff;
		}

		.logo-frame img {
			width: 100%;
			max-width: 260px;
			max-height: 94px;
			object-fit: contain;
		}

		.brand-panel h1 {
			max-width: 430px;
			margin: 34px 0 12px;
			font-size: clamp(27px, 3vw, 38px);
			line-height: 1.2;
			font-weight: 700;
		}

		.tagline {
			max-width: 360px;
			margin: 0;
			color: rgba(255, 255, 255, .78);
			font-size: 16px;
			line-height: 1.7;
		}

		.brand-rule {
			width: 54px;
			height: 3px;
			margin-top: 30px;
			border: 0;
			background: #72c8b5;
		}

		.form-panel {
			padding: 60px clamp(30px, 5vw, 66px) 28px;
			display: flex;
			flex-direction: column;
			justify-content: center;
		}

		.form-heading {
			margin-bottom: 30px;
		}

		.form-heading h2 {
			margin: 0;
			font-size: 28px;
			font-weight: 700;
			letter-spacing: 0;
		}

		.form-heading p {
			margin: 8px 0 0;
			color: var(--muted);
			font-size: 14px;
		}

		.alert {
			margin-bottom: 16px;
			padding: 12px 14px;
			border: 1px solid transparent;
			border-radius: 6px;
			font-size: 13px;
			line-height: 1.5;
		}

		.alert-error { color: #9b3030; background: #fff0ef; border-color: #f3d0cd; }
		.alert-success { color: #246b48; background: #edf8f1; border-color: #cce9d6; }
		.alert-warning { color: #825c16; background: #fff8e7; border-color: #f2e2b6; }

		.login-form {
			display: grid;
			gap: 21px;
		}

		.field label {
			margin-bottom: 8px;
			display: block;
			color: #34464a;
			font-size: 13px;
			font-weight: 700;
		}

		.field input {
			width: 100%;
			min-height: 50px;
			padding: 0 14px;
			border: 1px solid #d5dfe0;
			border-radius: 6px;
			outline: none;
			background: #fff;
			color: var(--ink);
			font: inherit;
			font-size: 14px;
			transition: border-color .18s ease, box-shadow .18s ease;
		}

		.field input::placeholder { color: #98a5a7; }
		.field input:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(20, 125, 120, .14); }

		.password-wrap { position: relative; }
		.password-wrap input { padding-right: 50px; }

		.password-toggle {
			width: 42px;
			height: 42px;
			position: absolute;
			top: 4px;
			right: 4px;
			display: grid;
			place-items: center;
			border: 0;
			border-radius: 5px;
			background: transparent;
			color: #758487;
			cursor: pointer;
		}

		.password-toggle:hover, .password-toggle:focus-visible { background: #edf4f3; color: var(--accent-dark); }
		.password-toggle svg { width: 19px; height: 19px; }

		.submit-button {
			min-height: 50px;
			margin-top: 4px;
			border: 0;
			border-radius: 6px;
			background: var(--accent);
			color: #fff;
			font: inherit;
			font-size: 14px;
			font-weight: 700;
			cursor: pointer;
			transition: background .18s ease, transform .18s ease;
		}

		.submit-button:hover { background: var(--accent-dark); transform: translateY(-1px); }
		.submit-button:focus-visible, .forgot-link:focus-visible { outline: 3px solid rgba(20, 125, 120, .35); outline-offset: 3px; }

		.forgot-link {
			margin-top: 19px;
			align-self: center;
			color: var(--accent-dark);
			font-size: 13px;
			font-weight: 600;
			text-decoration: none;
		}

		.forgot-link:hover { text-decoration: underline; }

		.attribution {
			margin: 44px 0 0;
			padding-top: 18px;
			border-top: 1px solid #e7eded;
			color: #738184;
			font-size: 11px;
			text-align: center;
		}

		@keyframes arrive {
			from { opacity: 0; transform: translateY(10px); }
			to { opacity: 1; transform: translateY(0); }
		}

		@media (max-width: 760px) {
			body { padding: 22px; background-attachment: scroll; }
			.login-shell { width: min(100%, 520px); min-height: 0; grid-template-columns: 1fr; }
			.brand-panel { padding: 30px 30px 26px; align-items: center; text-align: center; }
			.logo-frame { width: min(100%, 260px); min-height: 94px; padding: 14px 22px; }
			.logo-frame img { max-height: 66px; }
			.brand-panel h1 { margin: 22px 0 7px; font-size: 25px; }
			.tagline { font-size: 14px; }
			.brand-rule { margin-top: 19px; }
			.form-panel { padding: 32px 30px 24px; }
			.form-heading { margin-bottom: 24px; }
			.attribution { margin-top: 30px; }
		}

		@media (max-width: 420px) {
			body { padding: 12px; }
			.login-shell { border-radius: 9px; }
			.brand-panel { padding: 25px 20px 22px; }
			.form-panel { padding: 27px 21px 22px; }
		}

		@media (prefers-reduced-motion: reduce) {
			*, *::before, *::after { scroll-behavior: auto !important; animation-duration: .01ms !important; transition-duration: .01ms !important; }
		}
	</style>
</head>

<body>
	<main class="login-shell">
		<section class="brand-panel" aria-label="Garage Management System">
			<div class="logo-frame">
				<img src="<?= base_url('public/images/logoauto1.png') ?>" alt="Garage Management System logo">
			</div>
			<h1>Everything your workshop needs, in one place.</h1>
			<hr class="brand-rule">
		</section>

		<section class="form-panel" aria-labelledby="login-title">
			<header class="form-heading">
				<h2 id="login-title">Sign in</h2>
				<p>Enter your account details to continue.</p>
			</header>

		<?php if (!empty($error)): ?>
			<div class="alert alert-error" role="alert">
				<?= html_escape($error) ?>
			</div>
		<?php endif; ?>
		<?php if ($this->session->flashdata('success')): ?>
			<div class="alert alert-success" role="status">
				<?= html_escape($this->session->flashdata('success')) ?>
			</div>
		<?php endif; ?>
		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-error" role="alert">
				<?= html_escape($this->session->flashdata('error')) ?>
			</div>
		<?php endif; ?>
		<?php if ($this->session->flashdata('demo_warning')): ?>
			<div class="alert alert-warning" role="status">
				<?= html_escape($this->session->flashdata('demo_warning')) ?>
			</div>
		<?php endif; ?>

			<form method="post" action="<?= base_url('index.php/login/verify_login') ?>" class="login-form">
				<div class="field">
					<label for="username">Username</label>
					<input type="text" id="username" name="username" autocomplete="username" required placeholder="Enter your username">
			</div>

				<div class="field">
					<label for="password">Password</label>
					<div class="password-wrap">
						<input type="password" name="password" id="password" autocomplete="current-password" required placeholder="Enter your password">
						<button type="button" class="password-toggle" onclick="togglePassword()" aria-label="Show password" aria-pressed="false">
							<svg viewBox="0 0 24 24" fill="none" aria-hidden="true"><path d="M2.5 12s3.4-6 9.5-6 9.5 6 9.5 6-3.4 6-9.5 6-9.5-6-9.5-6Z" stroke="currentColor" stroke-width="1.7"/><circle cx="12" cy="12" r="2.7" stroke="currentColor" stroke-width="1.7"/></svg>
						</button>
					</div>
				</div>

				<button type="submit" class="submit-button">Sign in</button>
			</form>

			<a href="<?= base_url('index.php/login/forgot_password') ?>" class="forgot-link">Forgot password?</a>

			<p class="attribution">@Developed by Concepts 360 Plus</p>
		</section>
	</main>

	<script>
		function togglePassword() {
			const input = document.getElementById('password');
			const button = document.querySelector('.password-toggle');
			const isVisible = input.type === 'password';
			input.type = isVisible ? 'text' : 'password';
			button.setAttribute('aria-pressed', String(isVisible));
			button.setAttribute('aria-label', isVisible ? 'Hide password' : 'Show password');
		}
	</script>
</body>
</html>
