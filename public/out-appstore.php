<?php
// out-appstore.php
// Tracks an App Store click and then redirects to the real App Store URL.

require __DIR__ . '/tracking.php';

// Source marker, e.g. "hero", "footer", "faq"
$src = $_GET['src'] ?? 'unknown';

cc_track_event('appstore_click', ['src' => $src]);

// TODO: Replace with your real Mac App Store URL
$appStoreUrl = 'https://apps.apple.com/app/id0000000000';

header('Location: ' . $appStoreUrl, true, 302);
exit;
