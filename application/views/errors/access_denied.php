<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Access denied</title>
    <style>
        :root {
            color-scheme: light;
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f4f7fb;
            color: #172033;
        }

        * { box-sizing: border-box; }

        body {
            min-height: 100vh;
            margin: 0;
            display: grid;
            place-items: center;
            padding: 24px;
            background: linear-gradient(135deg, #eef4ff 0%, #f8fafc 52%, #edf7f4 100%);
        }

        .access-panel {
            width: min(100%, 520px);
            padding: 48px 40px;
            text-align: center;
            background: #ffffff;
            border: 1px solid #dce4ef;
            border-radius: 12px;
            box-shadow: 0 18px 45px rgba(35, 55, 85, 0.12);
        }

        .access-code {
            margin: 0 0 12px;
            color: #2563eb;
            font-size: 64px;
            line-height: 1;
            font-weight: 800;
            letter-spacing: 0;
        }

        h1 {
            margin: 0 0 12px;
            font-size: 28px;
            line-height: 1.2;
        }

        p {
            margin: 0 auto 28px;
            max-width: 390px;
            color: #526174;
            font-size: 16px;
            line-height: 1.6;
        }

        a {
            display: inline-block;
            padding: 11px 20px;
            border-radius: 7px;
            background: #2563eb;
            color: #ffffff;
            font-weight: 700;
            text-decoration: none;
        }

        a:hover { background: #1d4ed8; }
    </style>
</head>
<body>
    <main class="access-panel" role="alert">
        <div class="access-code">403</div>
        <h1>Access denied</h1>
        <p>You do not have permission to access this page. Please contact your administrator if you believe this is an error.</p>
        <a href="<?= html_escape(base_url('index.php/dashboard')); ?>">Return to dashboard</a>
    </main>
</body>
</html>
