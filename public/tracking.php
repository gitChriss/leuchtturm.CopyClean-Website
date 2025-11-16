<?php
// tracking.php
// Simple, cookie-free server-side tracking for CopyClean website.

function cc_anonymize_ip(?string $ip): ?string
{
    if (!$ip) {
        return null;
    }

    // IPv4
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
        $parts = explode('.', $ip);
        $parts[3] = '0'; // last octet set to 0
        return implode('.', $parts);
    }

    // IPv6 (rough anonymization)
    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
        return preg_replace('/:[0-9a-f]{1,4}$/i', ':0000', $ip);
    }

    return null;
}

function cc_log_dir(): string
{
    $dir = __DIR__ . '/logs';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    return $dir;
}

function cc_track_pageview(string $page): void
{
    $logFile = cc_log_dir() . '/analytics.log';

    $data = [
        'ts'   => date('c'),
        'page' => $page,
        'ref'  => $_SERVER['HTTP_REFERER'] ?? null,
        'ua'   => $_SERVER['HTTP_USER_AGENT'] ?? null,
        'ip'   => cc_anonymize_ip($_SERVER['REMOTE_ADDR'] ?? null),
    ];

    file_put_contents(
        $logFile,
        json_encode($data, JSON_UNESCAPED_SLASHES) . PHP_EOL,
        FILE_APPEND | LOCK_EX
    );
}

function cc_track_event(string $event, array $meta = []): void
{
    $logFile = cc_log_dir() . '/events.log';

    $data = [
        'ts'    => date('c'),
        'event' => $event,
        'meta'  => $meta,
        'ip'    => cc_anonymize_ip($_SERVER['REMOTE_ADDR'] ?? null),
        'ua'    => $_SERVER['HTTP_USER_AGENT'] ?? null,
    ];

    file_put_contents(
        $logFile,
        json_encode($data, JSON_UNESCAPED_SLASHES) . PHP_EOL,
        FILE_APPEND | LOCK_EX
    );
}
