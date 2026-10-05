<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Determine if this is a known business-rule error vs an unexpected system error
$is_business_error = ($exception instanceof RuntimeException);
$page_title   = $is_business_error ? 'Action Not Permitted' : 'An Error Occurred';
$icon_color   = $is_business_error ? '#f59e0b' : '#ef4444';
$badge_text   = $is_business_error ? 'Business Rule Violation' : 'System Error';
$badge_bg     = $is_business_error ? '#fef3c7' : '#fee2e2';
$badge_color  = $is_business_error ? '#92400e' : '#991b1b';
$hint         = $is_business_error
    ? 'This action cannot be completed due to a business restriction. Please review the details below and contact your administrator if you need assistance.'
    : 'An unexpected error occurred. Please try again or contact your system administrator if the problem persists.';
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $page_title ?> — GMS</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    background: #f1f5f9;
    color: #1e293b;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
  }

  .card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.10), 0 2px 8px rgba(0,0,0,0.06);
    max-width: 560px;
    width: 100%;
    overflow: hidden;
  }

  .card-header {
    background: linear-gradient(135deg, #1e293b 0%, #334155 100%);
    padding: 32px 36px 28px;
    text-align: center;
    position: relative;
  }

  .icon-wrap {
    width: 72px;
    height: 72px;
    border-radius: 50%;
    background: rgba(255,255,255,0.12);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px;
    border: 2px solid rgba(255,255,255,0.18);
  }

  .icon-wrap svg {
    width: 36px;
    height: 36px;
  }

  .card-header h1 {
    font-size: 22px;
    font-weight: 700;
    color: #f8fafc;
    margin-bottom: 6px;
  }

  .badge {
    display: inline-block;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    padding: 3px 12px;
    border-radius: 100px;
    background: <?= $badge_bg ?>;
    color: <?= $badge_color ?>;
  }

  .card-body {
    padding: 28px 36px 32px;
  }

  .hint {
    font-size: 14px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 20px;
  }

  .detail-box {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 18px 20px;
    margin-bottom: 24px;
  }

  .detail-row {
    display: flex;
    gap: 12px;
    align-items: flex-start;
    padding: 8px 0;
    border-bottom: 1px solid #f1f5f9;
  }
  .detail-row:last-child { border-bottom: none; }

  .detail-label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #94a3b8;
    min-width: 70px;
    padding-top: 2px;
  }

  .detail-value {
    font-size: 14px;
    color: #1e293b;
    font-weight: 500;
    flex: 1;
    line-height: 1.5;
    word-break: break-word;
  }

  .detail-value.message {
    color: #dc2626;
    font-weight: 600;
  }

  .actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }

  .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    border: none;
    transition: all 0.18s ease;
  }

  .btn-primary {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: #fff;
    box-shadow: 0 2px 8px rgba(59,130,246,0.35);
  }
  .btn-primary:hover { transform: translateY(-1px); box-shadow: 0 4px 14px rgba(59,130,246,0.45); }

  .btn-secondary {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
  }
  .btn-secondary:hover { background: #e2e8f0; }

  .support-note {
    margin-top: 20px;
    font-size: 12px;
    color: #94a3b8;
    text-align: center;
    line-height: 1.6;
  }

  <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>
  .trace-toggle {
    margin-top: 16px;
    font-size: 13px;
    color: #94a3b8;
    cursor: pointer;
    text-decoration: underline;
    background: none;
    border: none;
    padding: 0;
    font-family: inherit;
  }
  .trace-box {
    display: none;
    margin-top: 12px;
    background: #0f172a;
    border-radius: 10px;
    padding: 16px;
    overflow-x: auto;
  }
  .trace-box.open { display: block; }
  .trace-item {
    font-size: 12px;
    color: #94a3b8;
    font-family: 'Courier New', monospace;
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px solid #1e293b;
  }
  .trace-item:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0; }
  .trace-file { color: #60a5fa; }
  .trace-line { color: #a78bfa; }
  .trace-fn   { color: #34d399; }
  <?php endif; ?>
</style>
</head>
<body>

<div class="card">
  <div class="card-header">
    <div class="icon-wrap">
      <?php if ($is_business_error): ?>
      <svg fill="none" stroke="<?= $icon_color ?>" stroke-width="2" viewBox="0 0 24 24">
        <circle cx="12" cy="12" r="10"/>
        <line x1="12" y1="8" x2="12" y2="12"/>
        <line x1="12" y1="16" x2="12.01" y2="16"/>
      </svg>
      <?php else: ?>
      <svg fill="none" stroke="<?= $icon_color ?>" stroke-width="2" viewBox="0 0 24 24">
        <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"/>
        <line x1="12" y1="8" x2="12" y2="12"/>
        <line x1="12" y1="16" x2="12.01" y2="16"/>
      </svg>
      <?php endif; ?>
    </div>
    <h1><?= htmlspecialchars($page_title) ?></h1>
    <span class="badge"><?= htmlspecialchars($badge_text) ?></span>
  </div>

  <div class="card-body">
    <p class="hint"><?= htmlspecialchars($hint) ?></p>

    <div class="detail-box">
      <div class="detail-row">
        <span class="detail-label">Message</span>
        <span class="detail-value message"><?= htmlspecialchars($message) ?></span>
      </div>
      <?php if (!$is_business_error): ?>
      <div class="detail-row">
        <span class="detail-label">Type</span>
        <span class="detail-value"><?= htmlspecialchars(get_class($exception)) ?></span>
      </div>
      <?php endif; ?>
    </div>

    <div class="actions">
      <a href="javascript:history.back()" class="btn btn-secondary">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <polyline points="15 18 9 12 15 6"/>
        </svg>
        Go Back
      </a>
      <a href="<?= base_url() ?>" class="btn btn-primary">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
          <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
          <polyline points="9 22 9 12 15 12 15 22"/>
        </svg>
        Go to Dashboard
      </a>
    </div>

    <?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>
    <button class="trace-toggle" onclick="document.getElementById('trace').classList.toggle('open')">
      Show / hide stack trace
    </button>
    <div class="trace-box" id="trace">
      <?php foreach ($exception->getTrace() as $error): ?>
        <?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
        <div class="trace-item">
          <span class="trace-file"><?= htmlspecialchars($error['file']) ?></span>
          <span class="trace-line"> : line <?= htmlspecialchars($error['line'] ?? '?') ?></span><br>
          <span class="trace-fn">→ <?= htmlspecialchars($error['function'] ?? '') ?>()</span>
        </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <p class="support-note">
      If you believe this is a mistake, please contact your system administrator<br>
      and quote the error message above.
    </p>
  </div>
</div>

</body>
</html>