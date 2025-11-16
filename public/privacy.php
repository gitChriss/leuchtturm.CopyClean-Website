<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CopyClean – Privacy Policy</title>

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="assets/css/app.min.css" rel="stylesheet">

  <style>
	:root {
	  --bs-primary:   #3ba7e1;
	  --bs-secondary: #d46a6a;
	  --bs-success:   #19b698;
	  --bs-info:      #2d3f51;
	  --bs-warning:   #f6c15c;
	  --bs-danger:    #e85a5a;
	  --bs-light:     #f8fafc;
	  --bs-primary-rgb: 59, 167, 225;
	  --bs-secondary-rgb: 212, 106, 106;
	  --bs-success-rgb: 25, 182, 152;
	  --bs-info-rgb: 45, 63, 81;
	  --bs-warning-rgb: 246, 193, 92;
	  --bs-danger-rgb: 232, 90, 90;
	  --bs-light-rgb: 248, 250, 252;
	  --bs-dark-rgb: 27, 39, 50;
	  --bs-dark:     #1b2732;
	}

	body {
	  font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
	  background-color: #f8fafc;
	  color: #1b2732;
	  scroll-behavior: smooth;
	}

	.navbar {
	  background-color: transparent;
	  transition: box-shadow 0.2s ease, background-color 0.2s ease, backdrop-filter 0.2s ease;
	}

	.navbar-nav {
	  gap: 0.6rem;
	  align-items: center;
	}

	.navbar-nav .nav-link {
	  background-color: transparent;
	  position: relative;
	  padding: 0.55rem 1.2rem;
	  border-radius: 0.6rem;
	  font-size: 0.96rem;
	  font-weight: 500;
	  color: #1b2732;
	  transition: color 0.2s ease, background-color 0.2s ease, font-weight 0.2s ease, transform 0.2s ease;
	}

	.navbar-nav .nav-link::after {
	  content: "";
	  position: absolute;
	  left: 16%;
	  right: 16%;
	  bottom: 0.2rem;
	  height: 2px;
	  border-radius: 0.6rem;
	  background: var(--bs-primary);
	  opacity: 0;
	  transform: scaleX(0.4);
	  transform-origin: center;
	  transition: opacity 0.18s ease, transform 0.18s ease;
	}

	.navbar-nav .nav-link:hover {
	  color: #fff;
	  font-weight: 600;
	  transform: translateY(-1px);
	  background-color: rgba(59, 167, 225, 0.25);
	}

	.navbar-nav .nav-link:hover::after {
	  opacity: 0.6;
	  transform: scaleX(1);
	}

	.navbar-nav .nav-link.active {
	  color: var(--bs-primary) !important;
	  background-color: rgba(59, 167, 225, 0.12);
	  font-weight: 600;
	}

	.navbar-nav .nav-link.active::after {
	  opacity: 1;
	  transform: scaleX(1);
	}

	@media (max-width: 991.98px) {
	  .navbar-nav .nav-link {
		padding-inline: 1rem;
		margin-block: 0.2rem;
	  }
	}

	.navbar-scrolled {
	  box-shadow: 0 0.5rem 1.25rem rgba(15, 23, 42, 0.1);
	  background-color: rgba(255, 255, 255, 0.9);
	  backdrop-filter: blur(18px);
	  -webkit-backdrop-filter: blur(18px);
	  border-bottom: 1px solid rgba(15, 23, 42, 0.06);
	}

	main {
	  scroll-padding-top: 80px;
	}

	.page-section {
	  padding-top: 7rem;
	  padding-bottom: 5rem;
	}

	.text-soft {
	  color: #64748b;
	}

	.card {
	  border-radius: 1.25rem;
	  border: 1px solid rgba(15, 23, 42, 0.06);
	}

	footer {
	  background-color: #0f1722;
	  color: #cbd5f5;
	}

	footer a {
	  color: #e5e7eb;
	  text-decoration: none;
	}

	footer a:hover {
	  text-decoration: underline;
	}
  </style>
</head>
<body data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="80" tabindex="0">

<nav id="mainNav" class="navbar navbar-expand-lg fixed-top navbar-light">
  <div class="container">
	<a class="navbar-brand fw-semibold d-flex align-items-center gap-2" href="index.php">
	  <img src="assets/img/copyclean-256x256@1x.png" alt="CopyClean Logo" width="28" height="28" class="rounded-3">
	  <span>CopyClean</span>
	</a>
	<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	  <span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
	  <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
		<li class="nav-item">
		  <a class="nav-link" href="./">Home</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link" href="imprint.html">Imprint</a>
		</li>
		<li class="nav-item">
		  <a class="nav-link active" href="privacy.html">Privacy</a>
		</li>
	  </ul>
	</div>
  </div>
</nav>

<main>
  <section class="page-section">
	<div class="container">
	  <div class="row justify-content-center mb-4">
		<div class="col-lg-8 text-center">
		  <h1 class="h3 fw-bold mb-2">Privacy Policy</h1>
		  <p class="text-soft mb-0">
			Information about how CopyClean handles your data.
		  </p>
		</div>
	  </div>

	  <div class="row justify-content-center">
		<div class="col-lg-8">
		  <div class="card shadow-sm">
			<div class="card-body p-4 p-md-5">
			  <p class="small text-soft text-end mb-4">Last updated: November 2025</p>

			  <h2 class="h5 mb-3">1. Overview</h2>
			  <div class="alert alert-info">
				<p class="mb-0 text-center">
					<b>CopyClean is designed with privacy in mind.</b>
				</p>
				</div>
				<p>The app does not collect, store, transmit or share any personal data.</p>
			<p>
				When you visit our website, we only process minimal, anonymous server-side analytics (such as pageviews and App Store link clicks).
				These logs contain no personal identifiers, no cookies, no profiles, and no advertising or tracking technology.
			</p>
			<p>
				<b>In short: no personal tracking, and no data shared with third parties.</b>
			</p>


			  <h2 class="h5 mt-4 mb-3">2. No data collection in the app</h2>
			  <p>
				The CopyClean macOS app runs entirely on your device.
				It works only with the text that is currently stored in your system clipboard.
				This content stays on your Mac and is not transmitted to any server.
			  </p>
			  <p>
				The app does not create user accounts, does not use cloud services and does not integrate
				any third-party SDKs, analytics or advertising tools.
			  </p>

			  <h2 class="h5 mt-4 mb-3">3. No tracking on the website</h2>
			  <p>
				The public CopyClean website is deliberately simple and privacy-friendly.
				<strong>We do not use client-side web analytics, tracking pixels, advertising networks or social media plugins.</strong>
			  </p>
			  <p>
				We do not set non-essential cookies, we do not use fingerprinting, and we do not build profiles about visitors.
			  </p>
			  <p>Any statistics we generate are based solely on anonymous, server-side logs without identifiers.</p>

			  <h2 class="h5 mt-4 mb-3">4. Server logs</h2>
			  <p>
				When you access this website, the web server processes minimal technical information (such as the requested file, date and time of access, referrer and the browser used).
			  </p>
			  <p>These logs are used exclusively for:
			  <ul>
				  <li>ensuring the technical operation of the site</li>
				  <li>detecting errors</li>
				  <li>generating anonymous aggregated statistics (e.g. pageviews)</li>
			  </ul>
			  <p>IP addresses are anonymized and we do not combine this information with other data. We do not attempt to identify individual visitors and we do not share any data with third parties.</p>

			  <h2 class="h5 mt-4 mb-3">5. Contact by email or support form</h2>
			  <p>
				If you contact us by email or via the support form on the website,
				the data you provide (such as your name, email address and the content of your message)
				will be used solely to process and answer your request.
			  </p>
			  <p>
				The legal basis is Art. 6(1)(b) GDPR (performance of a contract or steps prior to entering into a contract)
				or Art. 6(1)(f) GDPR (legitimate interest in handling your request).
			  </p>
			  <p>
				Your messages will be stored only as long as necessary to handle your request or as long as legal retention obligations require.
			  </p>

			  <h2 class="h5 mt-4 mb-3">6. Local settings</h2>
			  <p>
				CopyClean stores a few simple preferences, such as your shortcut configuration,
				using the standard macOS settings system (UserDefaults).
				These values remain on your device and are not shared with third parties.
			  </p>

			  <h2 class="h5 mt-4 mb-3">7. Your rights</h2>
			  <p>
				As far as the GDPR applies, you have the right to request information about personal data we process about you,
				as well as the right to rectification, erasure, restriction of processing and data portability.
				You also have the right to object to processing based on legitimate interests
				and the right to lodge a complaint with a supervisory authority.
			  </p>
			  <p>
				In practice, we process personal data only if you actively contact us.
				In this case you can reach out at any time and request deletion of your messages,
				unless statutory retention obligations prevent this.
			  </p>

			  <h2 class="h5 mt-4 mb-3">8. Changes to this policy</h2>
			  <p>
				We may update this Privacy Policy from time to time to reflect changes in the app, the website or legal requirements.
				The current version is always available on this page.
			  </p>

			  <h2 class="h5 mt-4 mb-3">9. Contact</h2>
			  <p class="mb-1">
				If you have questions about this Privacy Policy or about data protection in relation to CopyClean, you can contact:
			  </p>
			  <p class="mb-0">
				Leuchtturm.app<br>
				Christian Ruppelt<br>
				Fliederstraße 5<br>
				37586 Dassel<br>
				Germany<br>
				Email: <a href="mailto:post@christianruppelt.de">post@christianruppelt.de</a>
			  </p>
			</div>
		  </div>
		</div>
	  </div>
	</div>
  </section>
</main>

<footer class="py-4">
  <div class="container">
	<div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">
	  <div class="d-flex align-items-center gap-2">
		<img src="assets/img/copyclean-256x256@1x.png" alt="CopyClean Logo" width="28" height="28" class="rounded-3">
		<p class="small mb-0">© <span id="year"></span> CopyClean. All rights reserved.</p>
	  </div>
	  <div class="d-flex gap-3 small">
		<a href="imprint.html">Imprint</a>
		<a href="privacy.html">Privacy</a>
		<a href="index.php#support">Support</a>
	  </div>
	</div>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script>
  function updateNavbar() {
	const nav = document.getElementById("mainNav");
	if (!nav) return;
	if (window.scrollY > 10) {
	  nav.classList.add("navbar-scrolled");
	} else {
	  nav.classList.remove("navbar-scrolled");
	}
  }

  window.addEventListener("scroll", updateNavbar);
  window.addEventListener("load", updateNavbar);

  document.addEventListener("DOMContentLoaded", function () {
	const yearSpan = document.getElementById("year");
	if (yearSpan) {
	  yearSpan.textContent = new Date().getFullYear();
	}
  });
</script>

</body>
</html>
