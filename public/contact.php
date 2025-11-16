<?php
// contact.php

// ========================================
// Konfiguration
// ========================================

$to            = 'post@christianruppelt.de';    // <- anpassen
$subjectPrefix = '[CopyClean Contact] ';
$fromAddress   = 'support@leuchtturm.app';  // <- existierende Adresse auf deinem Server

// Optional: Danke-Seite für non-AJAX
$redirectUrlOnSuccess = null;

// ========================================
// Helfer
// ========================================

function isAjaxRequest(): bool
{
	return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
		&& strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
}

function sanitizeText(string $value): string
{
	$value = trim($value);
	return filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
}

function hasHeaderInjection(string $value): bool
{
	return preg_match('/[\r\n]/', $value) === 1;
}

function respondJson(array $data, int $statusCode = 200): void
{
	http_response_code($statusCode);
	header('Content-Type: application/json; charset=utf-8');
	echo json_encode($data);
	exit;
}

function respondHtml(string $title, string $body, int $statusCode = 200): void
{
	http_response_code($statusCode);
	echo '<!DOCTYPE html><html lang="en"><head><meta charset="utf-8"><title>' . htmlspecialchars($title) . '</title></head><body>';
	echo $body;
	echo '</body></html>';
	exit;
}

// ========================================
// Nur POST akzeptieren
// ========================================

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	if (isAjaxRequest()) {
		respondJson(['status' => 'error', 'errors' => ['Method Not Allowed']], 405);
	}
	respondHtml('Method Not Allowed', '<h1>405 Method Not Allowed</h1>', 405);
}

// ========================================
// Formdaten
// ========================================

$name     = isset($_POST['name']) ? sanitizeText($_POST['name']) : '';
$email    = isset($_POST['email']) ? trim($_POST['email']) : '';
$subject  = isset($_POST['subject']) ? sanitizeText($_POST['subject']) : '';
$message  = isset($_POST['message']) ? trim($_POST['message']) : '';
$logs     = !empty($_POST['logs']) ? 'Yes' : 'No';
$honeypot = isset($_POST['contact_meta_info']) ? trim($_POST['contact_meta_info']) : '';

$errors = [];

// ========================================
// Spam-Schutz: simpler Honeypot
// ========================================

if ($honeypot !== '') {
	// Wir tun so, als ob alles ok war, aber senden nichts
	if (isAjaxRequest()) {
		respondJson([
			'status'  => 'ok',
			'message' => 'Thank you. Your message has been sent.',
		]);
	}

	if ($redirectUrlOnSuccess) {
		header('Location: ' . $redirectUrlOnSuccess);
		exit;
	}

	respondHtml('Message sent', '<h1>Thank you</h1><p>Your message has been sent.</p>');
}

// ========================================
// Validierung
// ========================================

if ($name === '') {
	$errors[] = 'Please enter your name.';
}

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$errors[] = 'Please enter a valid email address.';
}

if (hasHeaderInjection($email) || hasHeaderInjection($name)) {
	$errors[] = 'Invalid input.';
}

if ($subject === '') {
	$errors[] = 'Please choose a topic.';
}

if ($message === '') {
	$errors[] = 'Please enter a message.';
}

if (!empty($errors)) {
	if (isAjaxRequest()) {
		respondJson(['status' => 'error', 'errors' => $errors], 400);
	}

	$body = '<h1>There was a problem with your message</h1><ul>';
	foreach ($errors as $error) {
		$body .= '<li>' . htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</li>';
	}
	$body .= '</ul><p><a href="javascript:history.back()">Go back</a></p>';

	respondHtml('Contact error', $body, 400);
}

// ========================================
// E-Mail vorbereiten
// ========================================

$topicMap = [
	'bug'      => 'Bug or issue',
	'idea'     => 'Feature request',
	'question' => 'Usage question',
	'other'    => 'Other',
];

$topicLabel = $topicMap[$subject] ?? 'Other';
$siteUrl    = 'https://copyclean.leuchtturm.app';
$logoUrl    = 'https://copyclean.leuchtturm.app/assets/img/copyclean-256x256@1x.png';

$ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';

// Für HTML escapen
$htmlName    = htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$htmlEmail   = htmlspecialchars($email, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$htmlTopic   = htmlspecialchars($topicLabel, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$htmlLogs    = htmlspecialchars($logs, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$htmlIp      = htmlspecialchars($ipAddress, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$htmlDate    = htmlspecialchars(date('Y-m-d H:i:s'), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
$htmlMessage = nl2br(htmlspecialchars($message, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'));

// Farben
$bgColor     = '#f3f6fb'; // sehr helles Blau/Grau
$cardBg      = '#ffffff';
$accentColor = '#3ba7e1';
$textColor   = '#2d3f51';
$mutedColor  = '#7b8a9a';

// Basistemplate als Funktion
function buildCopyCleanEmailHtml(string $title, string $introHtml, string $contentHtml, string $footerNote, string $logoUrl, string $bgColor, string $cardBg, string $accentColor, string $textColor, string $mutedColor, string $siteUrl): string
{
	return '
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>' . htmlspecialchars($title, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background-color:' . $bgColor . ';font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',sans-serif;">
	<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color:' . $bgColor . ';padding:24px 0;">
		<tr>
			<td align="center" style="padding:0 16px;">
				<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width:600px;background-color:' . $cardBg . ';border-radius:16px;overflow:hidden;box-shadow:0 6px 20px rgba(0,0,0,0.04);">
					<tr>
						<td align="center" style="padding:24px 24px 0 24px;">
							<img src="' . $logoUrl . '" alt="CopyClean" width="96" height="96" style="display:block;border-radius:24px;">
						</td>
					</tr>
					<tr>
						<td style="padding:24px 24px 8px 24px;text-align:center;color:' . $textColor . ';">
							<h1 style="margin:0 0 8px 0;font-size:20px;font-weight:600;color:' . $textColor . ';">' . $title . '</h1>
							<p style="margin:0;font-size:14px;line-height:1.5;color:' . $mutedColor . ';">' . $introHtml . '</p>
						</td>
					</tr>
					<tr>
						<td style="padding:16px 24px 24px 24px;color:' . $textColor . ';font-size:14px;line-height:1.6;">
							' . $contentHtml . '
						</td>
					</tr>
					<tr>
						<td style="padding:16px 24px 24px 24px;border-top:1px solid rgba(0,0,0,0.03);text-align:center;">
							<p style="margin:0 0 4px 0;font-size:12px;color:' . $mutedColor . ';">' . $footerNote . '</p>
							<p style="margin:0;font-size:12px;color:' . $mutedColor . ';">
								<a href="' . $siteUrl . '" style="color:' . $accentColor . ';text-decoration:none;">' . $siteUrl . '</a>
							</p>
							<p style="margin:8px 0 0 0;font-size:11px;color:' . $mutedColor . ';">CopyClean</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>';
}

// Inhalt für dich (Owner)
$ownerTitle = 'New CopyClean support request';
$ownerIntro = 'You received a new message through the CopyClean support form.';
$ownerContent = '
	<p><strong>Details</strong></p>
	<table role="presentation" cellspacing="0" cellpadding="0" border="0" style="width:100%;font-size:14px;">
		<tr>
			<td style="padding:2px 0;width:120px;color:' . $mutedColor . ';">Name</td>
			<td style="padding:2px 0;">' . $htmlName . '</td>
		</tr>
		<tr>
			<td style="padding:2px 0;width:120px;color:' . $mutedColor . ';">Email</td>
			<td style="padding:2px 0;">' . $htmlEmail . '</td>
		</tr>
		<tr>
			<td style="padding:2px 0;width:120px;color:' . $mutedColor . ';">Topic</td>
			<td style="padding:2px 0;">' . $htmlTopic . '</td>
		</tr>
		<tr>
			<td style="padding:2px 0;width:120px;color:' . $mutedColor . ';">Logs</td>
			<td style="padding:2px 0;">' . $htmlLogs . '</td>
		</tr>
		<tr>
			<td style="padding:2px 0;width:120px;color:' . $mutedColor . ';">IP</td>
			<td style="padding:2px 0;">' . $htmlIp . '</td>
		</tr>
		<tr>
			<td style="padding:2px 0;width:120px;color:' . $mutedColor . ';">Date</td>
			<td style="padding:2px 0;">' . $htmlDate . ' (server time)</td>
		</tr>
	</table>
	<p style="margin-top:16px;"><strong>Message</strong></p>
	<div style="padding:12px 14px;border-radius:8px;background-color:#f8fafc;color:' . $textColor . ';font-family:SF Mono,Menlo,Monaco,Consolas,\'Liberation Mono\',\'Courier New\',monospace;font-size:13px;line-height:1.5;white-space:pre-wrap;">
		' . $htmlMessage . '
	</div>
';

$ownerFooterNote = 'This email was sent to you because someone used the CopyClean support form.';

// Inhalt für Absender (Bestätigung)
$userTitle = 'We received your CopyClean request';
$userIntro = 'Thank you for reaching out. Your message arrived and I will get back to you as soon as possible.';

$userContent = '
	<p>Hi ' . $htmlName . ',</p>
	<p>Thank you for contacting me about CopyClean. Your request is in the inbox and will be reviewed soon.</p>
	<p><strong>Your request</strong></p>
	<table role="presentation" cellspacing="0" cellpadding="0" border="0" style="width:100%;font-size:14px;">
		<tr>
			<td style="padding:2px 0;width:120px;color:' . $mutedColor . ';">Topic</td>
			<td style="padding:2px 0;">' . $htmlTopic . '</td>
		</tr>
		<tr>
			<td style="padding:2px 0;width:120px;color:' . $mutedColor . ';">Logs</td>
			<td style="padding:2px 0;">' . $htmlLogs . '</td>
		</tr>
		<tr>
			<td style="padding:2px 0;width:120px;color:' . $mutedColor . ';">Submitted</td>
			<td style="padding:2px 0;">' . $htmlDate . ' (server time)</td>
		</tr>
	</table>
	<p style="margin-top:16px;"><strong>Message</strong></p>
	<div style="padding:12px 14px;border-radius:8px;background-color:#f8fafc;color:' . $textColor . ';font-family:SF Mono,Menlo,Monaco,Consolas,\'Liberation Mono\',\'Courier New\',monospace;font-size:13px;line-height:1.5;white-space:pre-wrap;">
		' . $htmlMessage . '
	</div>
	<p style="margin-top:16px;font-size:13px;color:' . $mutedColor . ';">If you did not send this request you can ignore this email.</p>
';

$userFooterNote = 'You receive this email as confirmation of your support request.';

// HTML-Bodies bauen
$ownerHtml = buildCopyCleanEmailHtml(
	$ownerTitle,
	$ownerIntro,
	$ownerContent,
	$ownerFooterNote,
	$logoUrl,
	$bgColor,
	$cardBg,
	$accentColor,
	$textColor,
	$mutedColor,
	$siteUrl
);

$userHtml = buildCopyCleanEmailHtml(
	$userTitle,
	$userIntro,
	$userContent,
	$userFooterNote,
	$logoUrl,
	$bgColor,
	$cardBg,
	$accentColor,
	$textColor,
	$mutedColor,
	$siteUrl
);

// Header für HTML-Mails
$baseHeaders = [
	'From: CopyClean Support <' . $fromAddress . '>',
	'Reply-To: ' . $htmlName . ' <' . $htmlEmail . '>',
	'MIME-Version: 1.0',
	'Content-Type: text/html; charset=UTF-8',
];

$ownerSubjectRaw = $subjectPrefix . $topicLabel;
$userSubjectRaw  = 'We received your CopyClean request';

$ownerSubject = '=?UTF-8?B?' . base64_encode($ownerSubjectRaw) . '?=';
$userSubject  = '=?UTF-8?B?' . base64_encode($userSubjectRaw) . '?=';

// Envelope-From
$additionalParams = '-f ' . $fromAddress;

// ========================================
// E-Mails senden
// ========================================

// an dich
$successOwner = mail(
	$to,
	$ownerSubject,
	$ownerHtml,
	implode("\r\n", $baseHeaders),
	$additionalParams
);

// Bestätigungs-Mail an den Absender
$userHeaders = $baseHeaders;
// Reply-To für diese Mail lieber auf Support setzen
$userHeaders[1] = 'Reply-To: CopyClean Support <' . $fromAddress . '>';

$successUser = mail(
	$email,
	$userSubject,
	$userHtml,
	implode("\r\n", $userHeaders),
	$additionalParams
);

// Für das Formular reicht es, wenn deine Mail ankommt
if ($successOwner) {
	if (isAjaxRequest()) {
		respondJson([
			'status'  => 'ok',
			'message' => 'Thank you. Your message has been sent.',
		]);
	}

	if ($redirectUrlOnSuccess) {
		header('Location: ' . $redirectUrlOnSuccess);
		exit;
	}

	respondHtml('Message sent', '<h1>Thank you</h1><p>Your message has been sent successfully.</p>');
}

// Fehlerfall
if (isAjaxRequest()) {
	respondJson([
		'status' => 'error',
		'errors' => ['Sorry, something went wrong while sending your message. Please try again later.'],
	], 500);
}

respondHtml('Error', '<h1>Oops</h1><p>Sorry, something went wrong while sending your message. Please try again later.</p>', 500);
