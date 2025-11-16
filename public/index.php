<?php
	require __DIR__ . '/tracking.php';
	cc_track_pageview('home');
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CopyClean – Clean pasting without formatting</title>

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
			background-color: transparent; /* no background before scroll */
			position: relative;
			padding: 0.55rem 1.2rem; /* slimmer, more airy */
			border-radius: 0.6rem;
			font-size: 0.96rem; /* slightly smaller */
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
			background-color: rgba(59, 167, 225, 0.25); /* light blue on hover */
		}

		.navbar-nav .nav-link:hover::after {
			opacity: 0.6;
			transform: scaleX(1);
		}

		.navbar-nav .nav-link.active {
			color: var(--bs-primary) !important;
			background-color: rgba(59, 167, 225, 0.12); /* subtle */
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

		section {
			padding-top: 5rem;
			padding-bottom: 5rem;
		}

		section:first-of-type {
			padding-top: 7rem;
		}

				.hero {
			min-height: 100vh;
			display: flex;
			align-items: center;
			background: url('assets/img/heroe.jpg') center center / cover no-repeat;
		}


		.hero-badge {
			font-size: 0.9rem;
			text-transform: uppercase;
			letter-spacing: 0.08em;
		}

				.hero-app-shot {
			border-radius: 1.5rem;
			border: 0;
			box-shadow: 0 1.25rem 3rem rgba(15, 23, 42, 0.08);
			background: white;
			overflow: hidden;
		}

		.hero-screenshot-wrapper {
			margin-top: 1rem;
			margin-left: -1.5rem;
			margin-bottom: -1.5rem;
		}

		.hero-screenshot-wrapper img {
			display: block;
		}


				.icon-circle {
			width: 2.75rem;
			height: 2.75rem;
			border-radius: 0.6rem;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			background-color: rgba(59, 167, 225, 0.12);
			color: #2d3f51;
			margin-bottom: 0.75rem;
		}

		.icon-circle svg {
			width: 1.5rem;
			height: 1.5rem;
		}

		.step-number {
			width: 2.25rem;
			height: 2.25rem;
			border-radius: 0.6rem;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			font-weight: 600;
			background-color: rgba(24, 189, 152, 0.12);
			color: #19b698;
		}

		.bg-soft-primary {
			background-color: rgba(59, 167, 225, 0.08);
		}

		.bg-soft-dark {
			background-color: #1b2732;
		}

		.text-soft {
			color: #64748b;
		}

		.card {
			border-radius: 1.25rem;
			border: 1px solid rgba(15, 23, 42, 0.06);
		}

				.screenshot-placeholder {
			border-radius: 1rem;
			border: 1px dashed rgba(15, 23, 42, 0.15);
			background: repeating-linear-gradient(
				45deg,
				rgba(148, 163, 184, 0.08),
				rgba(148, 163, 184, 0.08) 10px,
				rgba(148, 163, 184, 0.02) 10px,
				rgba(148, 163, 184, 0.02) 20px
			);
		}

				.screenshot-placeholder .screenshot-inner {
			position: absolute;
			inset: 0;
			display: flex;
			align-items: center;
			justify-content: center;
			text-align: center;
			padding: 1rem;
		}

		.screenshot-real .screenshot-inner {
			padding: 0;
		}

		.faq-accordion .accordion-button {
			font-weight: 500;
		}

		.faq-accordion .accordion-button:not(.collapsed) {
			color: #1b2732;
			background-color: rgba(59, 167, 225, 0.08);
		}

		.support-card {
			border-radius: 1.5rem;
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

		@media (max-width: 991.98px) {
			.hero {
				padding-top: 6rem;
			}
		}
	
		.screenshot-real {
			border-radius: 0 !important;
			border: 0 !important;
			background: none !important;
		}
	
		.screenshot-real img {
			box-shadow: none !important;
			border-radius: 0 !important;
		}

		/* Shadow now on container */
		.screenshot-real {
			box-shadow: 0 1rem 2.5rem rgba(0,0,0,0.08);
			border-radius: 0 !important;
			background: none !important;
			overflow: hidden;
		}
	
		/* Fix Bootstrap 5 button color variables */
		.btn-primary {
			--bs-btn-bg: var(--bs-primary) !important;
			--bs-btn-border-color: var(--bs-primary) !important;
			--bs-btn-hover-bg: rgba(var(--bs-primary-rgb), 0.9) !important;
			--bs-btn-hover-border-color: rgba(var(--bs-primary-rgb), 0.9) !important;
			--bs-btn-active-bg: rgba(var(--bs-primary-rgb), 0.85) !important;
		}
		
		.hp {
			position: absolute;
			left: -9999px;
			top: auto;
			width: 1px;
			height: 1px;
			overflow: hidden;
		}
	</style>
</head>
<body data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="80" tabindex="0">

<nav id="mainNav" class="navbar navbar-expand-lg fixed-top navbar-light">
	<div class="container">
		<a class="navbar-brand fw-semibold d-flex align-items-center gap-2" href="#hero">
	<img src="assets/img/copyclean-256x256@1x.png" alt="CopyClean Logo" width="28" height="28" class="rounded-3">
	<span>CopyClean</span>
</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link" href="#features">Features</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#how-it-works">How it works</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#audience">For whom</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#faq">FAQ</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#support">Support</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<main>
	<!-- Hero -->
	<section id="hero" class="hero">
		<div class="container">
			<div class="row align-items-center gy-4">
				<div class="col-lg-6">
					<span class="badge rounded-pill bg-soft-primary text-primary hero-badge mb-3">
						macOS menu bar app
					</span>
					<h1 class="display-4 fw-bold mb-3">
						Clean pasting without formatting.
					</h1>
					<p class="lead text-soft mb-4">
						CopyClean removes unnecessary formatting when you paste. You get plain, readable text in every app. No subscription. No account.
					</p>
					<div class="d-flex flex-wrap align-items-center gap-3 mb-4">
						<a href="out-appstore.php?src=hero" class="btn btn-primary btn-lg px-4">
							Buy on the App Store
						</a>
						<a href="#how-it-works" class="btn btn-outline-secondary px-4">
							See how it works
						</a>
					</div>
					<div class="d-flex flex-wrap gap-3 text-soft small">
						<div class="d-flex align-items-center gap-2">
							<span class="badge rounded-pill text-bg-light">No subscription</span>
							<span>One time purchase. Use it right away.</span>
						</div>
						<div class="d-flex align-items-center gap-2">
							<span class="badge rounded-pill text-bg-light">Local only</span>
							<span>No cloud. No tracking.</span>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="hero-app-shot p-4 bg-white mt-lg-0 mt-3">
						<div class="d-flex align-items-center mb-3">
							<img src="assets/img/copyclean-256x256@1x.png" alt="CopyClean Logo" width="48" height="48" class="rounded-3 me-3">
							<div>
								<div class="fw-semibold">CopyClean active</div>
								<div class="small text-soft">Global shortcut and menu bar control</div>
							</div>
						</div>
						<div class="mt-3 hero-screenshot-wrapper">
							<img src="assets/img/screenshot_app_macbook.png" alt="CopyClean App Screenshot" class="img-fluid w-100" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Problem / Solution -->
	<section id="problem">
		<div class="container">
			<div class="row justify-content-center mb-4">
				<div class="col-lg-8 text-center">
					<h2 class="h3 fw-bold mb-3">Formatted paste wastes time every day.</h2>
					<p class="text-soft mb-0">
						You copy text from emails, websites or documents. In the target you get fonts, colors and links you did not ask for. The result looks messy and you spend time cleaning it up.
					</p>
				</div>
			</div>
			<div class="row g-4">
				<div class="col-md-6">
					<div class="card h-100">
						<div class="card-body">
							<div class="icon-circle">
								<svg viewBox="0 0 31.5273 34.8673" aria-hidden="true" focusable="false">
									<path d="M1.84764 33.0123C4.29393 35.4586 7.15037 35.4879 9.55272 33.0855C11.3252 31.3131 13.1855 27.1383 14.5625 25.4976L17.6826 28.6324C18.8252 29.7896 20.2021 29.7896 21.3154 28.6764L23.2051 26.7721C24.3183 25.6441 24.3183 24.3111 23.1611 23.1539L11.7207 11.6988C10.5635 10.5416 9.2158 10.5269 8.08787 11.6549L6.19822 13.5592C5.08494 14.6724 5.07029 16.0347 6.22752 17.192L9.36229 20.3121C7.73631 21.689 3.56151 23.5347 1.78904 25.3072C-0.6133 27.7096-0.598651 30.5806 1.84764 33.0123ZM8.23436 14.8629L9.42088 13.7056C9.80174 13.3248 10.2119 13.3101 10.5928 13.691L21.1836 24.2672C21.5498 24.648 21.5498 25.0582 21.1543 25.4537L20.0117 26.6109C19.6308 27.0211 19.1914 27.0357 18.8105 26.6256L15.3096 23.1099C14.7676 22.568 14.0644 22.6265 13.4492 23.2271C12.3066 24.3551 10.2998 29.1744 7.97068 31.4889C6.56443 32.9097 4.86522 32.9097 3.40037 31.4596C1.96483 30.0094 1.95018 28.2955 3.37108 26.8892C5.70018 24.5748 10.5195 22.568 11.6474 21.4254C12.2334 20.7955 12.3066 20.0924 11.7646 19.565L8.23436 16.0494C7.8535 15.6685 7.8535 15.2437 8.23436 14.8629ZM5.64158 31.064C6.63768 31.064 7.44334 30.2437 7.44334 29.2476C7.44334 28.2515 6.63768 27.4459 5.64158 27.4459C4.64549 27.4459 3.82518 28.2515 3.82518 29.2476C3.82518 30.2437 4.64549 31.064 5.64158 31.064ZM23 24.6041L29.958 17.6461C31.584 16.0201 31.5547 14.0719 29.8847 12.4019L18.3857 0.888265C16.8476-0.649821 14.1816-0.0492352 13.6396 2.33846C12.2773 8.25643 12.2187 8.95955 9.97752 12.0943L11.6621 13.7789C14.2256 10.4244 14.416 8.78377 15.8222 3.55428C16.0127 2.80721 16.6279 2.61678 17.126 3.10018L28.0976 14.0572C28.7715 14.731 28.7715 15.5514 28.1416 16.1812L21.3594 22.9635ZM20.6855 16.2545C21.4619 17.0308 25.7392 14.6578 27.2187 12.7974L23.9961 9.58944C23.7178 12.1822 22.3701 14.0572 20.7295 15.6978C20.539 15.8883 20.5537 16.1226 20.6855 16.2545Z" fill="currentColor" fill-opacity="0.85"></path>
								</svg>
							</div>
							<h3 class="h5 fw-semibold mb-2">Copy with formatting.</h3>
							<p class="text-soft mb-0">
								Different fonts, colors and links end up in your text. In CMS editors and office documents this often leads to broken layouts and extra work.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="card h-100 bg-soft-primary">
						<div class="card-body">
							<div class="icon-circle">
								<svg viewBox="0 0 30.249 29.8975" aria-hidden="true" focusable="false">
									<path d="M14.9414 29.8828C23.1885 29.8828 29.8828 23.1885 29.8828 14.9414C29.8828 6.69434 23.1885 0 14.9414 0C6.69434 0 0 6.69434 0 14.9414C0 23.1885 6.69434 29.8828 14.9414 29.8828ZM14.9414 27.3926C8.05664 27.3926 2.49023 21.8262 2.49023 14.9414C2.49023 8.05664 8.05664 2.49023 14.9414 2.49023C21.8262 2.49023 27.3926 8.05664 27.3926 14.9414C27.3926 21.8262 21.8262 27.3926 14.9414 27.3926Z" fill="currentColor" fill-opacity="0.85"></path>
									<path d="M13.3301 21.8994C13.8135 21.8994 14.2236 21.665 14.5166 21.2109L21.2109 10.6787C21.3721 10.3857 21.5625 10.0635 21.5625 9.74121C21.5625 9.08203 20.9766 8.65723 20.3613 8.65723C19.9951 8.65723 19.6289 8.8916 19.3506 9.31641L13.2715 19.0723L10.3857 15.3369C10.0342 14.8682 9.71191 14.751 9.30176 14.751C8.67188 14.751 8.17383 15.2637 8.17383 15.9082C8.17383 16.2305 8.30566 16.5381 8.51074 16.8164L12.085 21.2109C12.4512 21.6943 12.8467 21.8994 13.3301 21.8994Z" fill="currentColor" fill-opacity="0.85"></path>
								</svg>
							</div>
							<h3 class="h5 fw-semibold mb-2">Paste as plain text.</h3>
							<p class="text-soft mb-0">
								CopyClean removes formatting automatically. Your text adapts to the style of the target app. You save clicks and avoid layout problems.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Features -->
	<section id="features">
		<div class="container">
			<div class="row justify-content-between align-items-end mb-4">
				<div class="col-lg-8">
					<h2 class="h3 fw-bold mb-2">Features you use every day.</h2>
					<p class="text-soft mb-0">
						CopyClean focuses on one job. Clean pasting. No bloated menus. Just the options that make your work faster.
					</p>
				</div>
			</div>
			<div class="row g-4">
				<div class="col-md-6 col-lg-3">
					<div class="card h-100">
						<div class="card-body">
							<div class="icon-circle">
								<svg viewBox="0 0 25.0049 31.4209" aria-hidden="true" focusable="false">
									<path d="M0 26.8213C0 29.8828 1.50879 31.4062 4.54102 31.4062L20.0977 31.4062C23.1299 31.4062 24.6387 29.8828 24.6387 26.8213L24.6387 4.59961C24.6387 1.55273 23.1299 0 20.0977 0L4.54102 0C1.50879 0 0 1.55273 0 4.59961ZM2.3584 26.7773L2.3584 4.64355C2.3584 3.17871 3.13477 2.3584 4.6582 2.3584L19.9805 2.3584C21.5039 2.3584 22.2803 3.17871 22.2803 4.64355L22.2803 26.7773C22.2803 28.2422 21.5039 29.0479 19.9805 29.0479L4.6582 29.0479C3.13477 29.0479 2.3584 28.2422 2.3584 26.7773Z" fill="currentColor" fill-opacity="0.85"></path>
									<path d="M6.76758 8.48145L17.8857 8.48145C18.3984 8.48145 18.7793 8.08594 18.7793 7.57324C18.7793 7.0752 18.3984 6.67969 17.8857 6.67969L6.76758 6.67969C6.24023 6.67969 5.85938 7.0752 5.85938 7.57324C5.85938 8.08594 6.24023 8.48145 6.76758 8.48145Z" fill="currentColor" fill-opacity="0.85"></path>
									<path d="M6.76758 13.5938L17.8857 13.5938C18.3984 13.5938 18.7793 13.1982 18.7793 12.6855C18.7793 12.1875 18.3984 11.792 17.8857 11.792L6.76758 11.792C6.24023 11.792 5.85938 12.1875 5.85938 12.6855C5.85938 13.1982 6.24023 13.5938 6.76758 13.5938Z" fill="currentColor" fill-opacity="0.85"></path>
									<path d="M6.76758 18.7061L12.0264 18.7061C12.5537 18.7061 12.9346 18.3252 12.9346 17.8271C12.9346 17.2998 12.5537 16.9043 12.0264 16.9043L6.76758 16.9043C6.24023 16.9043 5.85938 17.2998 5.85938 17.8271C5.85938 18.3252 6.24023 18.7061 6.76758 18.7061Z" fill="currentColor" fill-opacity="0.85"></path>
								</svg>
							</div>
							<h3 class="h6 fw-semibold">Always plain paste</h3>
							<p class="small text-soft mb-0">
								Enable permanent plain text pasting if you like. You keep using your usual paste shortcut. CopyClean takes care of the rest.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card h-100">
						<div class="card-body">
							<div class="icon-circle">
								<svg viewBox="0 0 28.0371 27.7002" aria-hidden="true" focusable="false">
									<path d="M5.22949 27.6123C8.11523 27.6123 10.459 25.2686 10.459 22.3682L10.459 5.25879C10.459 2.3584 8.11523 0 5.22949 0C2.34375 0 0 2.3584 0 5.25879C0 8.15918 2.34375 10.4297 5.22949 10.4297L9.33105 10.4297C9.94629 10.4297 10.4297 9.94629 10.4297 9.33105C10.4297 8.71582 9.94629 8.21777 9.33105 8.21777L5.22949 8.21777C3.61816 8.21777 2.28516 6.88477 2.28516 5.25879C2.28516 3.63281 3.61816 2.28516 5.22949 2.28516C6.84082 2.28516 8.17383 3.63281 8.17383 5.25879L8.17383 22.3682C8.17383 23.9941 6.84082 25.3271 5.22949 25.3271C3.61816 25.3271 2.28516 23.9941 2.28516 22.3682C2.28516 20.7422 3.61816 19.4092 5.22949 19.4092L22.4414 19.4092C24.0527 19.4092 25.3857 20.7422 25.3857 22.3682C25.3857 23.9941 24.0527 25.3271 22.4414 25.3271C20.8301 25.3271 19.4971 23.9941 19.4971 22.3682L19.4971 5.25879C19.4971 3.63281 20.8301 2.28516 22.4414 2.28516C24.0527 2.28516 25.3857 3.63281 25.3857 5.25879C25.3857 6.88477 24.0527 8.21777 22.4414 8.21777L9.33105 8.21777C8.71582 8.21777 8.21777 8.71582 8.21777 9.33105C8.21777 9.94629 8.71582 10.4297 9.33105 10.4297L22.4414 10.4297C25.3271 10.4297 27.6709 8.15918 27.6709 5.25879C27.6709 2.3584 25.3271 0 22.4414 0C19.5557 0 17.2119 2.3584 17.2119 5.25879L17.2119 22.3682C17.2119 25.2686 19.5557 27.6123 22.4414 27.6123C25.3271 27.6123 27.6709 25.2686 27.6709 22.3682C27.6709 19.4678 25.3271 17.1973 22.4414 17.1973L5.22949 17.1973C2.34375 17.1973 0 19.4678 0 22.3682C0 25.2686 2.34375 27.6123 5.22949 27.6123Z" fill="currentColor" fill-opacity="0.85"></path>
								</svg>
							</div>
							<h3 class="h6 fw-semibold">Custom shortcut</h3>
							<p class="small text-soft mb-0">
								Define a global shortcut just for plain paste. Keep the default shortcut for formatted paste if you prefer.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card h-100">
						<div class="card-body">
							<div class="icon-circle">
								<svg viewBox="0 0 24.7119 30.3662" aria-hidden="true" focusable="false">
									<path d="M12.1729 30.3662C12.4072 30.3662 12.7881 30.2783 13.1543 30.0732C21.4893 25.4004 24.3457 23.4229 24.3457 18.0762L24.3457 6.87012C24.3457 5.33203 23.6865 4.84863 22.4414 4.32129C20.7129 3.60352 15.1318 1.59668 13.4033 0.996094C13.0078 0.864258 12.583 0.776367 12.1729 0.776367C11.7627 0.776367 11.3379 0.893555 10.957 0.996094C9.22852 1.49414 3.63281 3.61816 1.9043 4.32129C0.673828 4.83398 0 5.33203 0 6.87012L0 18.0762C0 23.4229 2.87109 25.3857 11.1914 30.0732C11.5723 30.2783 11.9385 30.3662 12.1729 30.3662ZM12.1729 27.7148C11.9385 27.7148 11.7041 27.627 11.2646 27.3633C4.49707 23.2617 2.3291 22.0605 2.3291 17.5342L2.3291 7.32422C2.3291 6.82617 2.41699 6.63574 2.82715 6.47461C5.05371 5.5957 9.375 4.14551 11.5869 3.2666C11.8213 3.16406 12.0117 3.13477 12.1729 3.13477C12.334 3.13477 12.5244 3.17871 12.7588 3.2666C14.9707 4.14551 19.2627 5.69824 21.5332 6.47461C21.9287 6.62109 22.0166 6.82617 22.0166 7.32422L22.0166 17.5342C22.0166 22.0605 19.8486 23.2471 13.0811 27.3633C12.6562 27.627 12.4072 27.7148 12.1729 27.7148Z" fill="currentColor" fill-opacity="0.85"></path>
									<path d="M6.88477 20.6396C6.88477 21.7383 7.38281 22.251 8.39355 22.251L15.9814 22.251C16.9922 22.251 17.4756 21.7383 17.4756 20.6396L17.4756 14.8096C17.4756 13.7842 17.0508 13.2715 16.1865 13.2129L16.1865 11.4844C16.1865 8.78906 14.5752 6.9873 12.1875 6.9873C9.7998 6.9873 8.18848 8.78906 8.18848 11.4844L8.18848 13.2129C7.32422 13.2715 6.88477 13.7842 6.88477 14.8096ZM9.71191 13.1982L9.71191 11.3232C9.71191 9.59473 10.708 8.4668 12.1875 8.4668C13.667 8.4668 14.6631 9.59473 14.6631 11.3232L14.6631 13.1982Z" fill="currentColor" fill-opacity="0.85"></path>
								</svg>
							</div>
							<h3 class="h6 fw-semibold">Password field safety</h3>
							<p class="small text-soft mb-0">
								CopyClean respects sensitive input fields. Paste actions in password fields are not changed. Security stays in place.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card h-100">
						<div class="card-body">
							<div class="icon-circle">
								<svg viewBox="0 0 30.249 29.8975" aria-hidden="true" focusable="false">
									<path d="M14.9414 29.8828C23.1885 29.8828 29.8828 23.1885 29.8828 14.9414C29.8828 6.69434 23.1885 0 14.9414 0C6.69434 0 0 6.69434 0 14.9414C0 23.1885 6.69434 29.8828 14.9414 29.8828ZM14.9414 27.3926C8.05664 27.3926 2.49023 21.8262 2.49023 14.9414C2.49023 8.05664 8.05664 2.49023 14.9414 2.49023C21.8262 2.49023 27.3926 8.05664 27.3926 14.9414C27.3926 21.8262 21.8262 27.3926 14.9414 27.3926Z" fill="currentColor" fill-opacity="0.85"></path>
									<path d="M8.97949 22.0898C9.66797 22.0898 10.2393 21.5186 10.2393 20.8301C10.2393 20.1416 9.66797 19.5703 8.97949 19.5703C8.29102 19.5703 7.71973 20.1416 7.71973 20.8301C7.71973 21.5186 8.29102 22.0898 8.97949 22.0898ZM6.50391 16.2012C7.19238 16.2012 7.76367 15.6299 7.76367 14.9414C7.76367 14.2529 7.19238 13.6816 6.50391 13.6816C5.81543 13.6816 5.24414 14.2529 5.24414 14.9414C5.24414 15.6299 5.81543 16.2012 6.50391 16.2012ZM8.97949 10.3125C9.66797 10.3125 10.2393 9.74121 10.2393 9.05273C10.2393 8.34961 9.66797 7.79297 8.97949 7.79297C8.29102 7.79297 7.71973 8.34961 7.71973 9.05273C7.71973 9.74121 8.29102 10.3125 8.97949 10.3125ZM14.9268 7.79297C15.6152 7.79297 16.1865 7.22168 16.1865 6.5332C16.1865 5.84473 15.6152 5.27344 14.9268 5.27344C14.2383 5.27344 13.667 5.84473 13.667 6.5332C13.667 7.22168 14.2383 7.79297 14.9268 7.79297ZM20.874 10.3125C21.5625 10.3125 22.1338 9.74121 22.1338 9.05273C22.1338 8.34961 21.5625 7.79297 20.874 7.79297C20.1855 7.79297 19.6143 8.34961 19.6143 9.05273C19.6143 9.74121 20.1855 10.3125 20.874 10.3125ZM23.3203 16.2012C24.0088 16.2012 24.5801 15.6299 24.5801 14.9414C24.5801 14.2529 24.0088 13.6816 23.3203 13.6816C22.6318 13.6816 22.0605 14.2529 22.0605 14.9414C22.0605 15.6299 22.6318 16.2012 23.3203 16.2012ZM12.627 12.6416C11.6748 13.5938 11.6748 14.9854 12.627 15.9375C12.8027 16.1133 13.1836 16.3916 13.418 16.5674L20.5225 21.4893C20.874 21.7383 21.2256 21.665 21.4453 21.46C21.6504 21.2402 21.7236 20.8887 21.4746 20.5371L16.5527 13.4326C16.377 13.1982 16.1133 12.8174 15.9229 12.6416C14.9707 11.6748 13.5938 11.6748 12.627 12.6416Z" fill="currentColor" fill-opacity="0.85"></path>
								</svg>
							</div>
							<h3 class="h6 fw-semibold">Light and unobtrusive</h3>
							<p class="small text-soft mb-0">
								Runs as a menu bar app. Uses few resources. Start your Mac and CopyClean is ready in the background.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- How it works -->
	<section id="how-it-works" class="bg-white">
		<div class="container">
			<div class="row justify-content-center mb-5">
				<div class="col-lg-8 text-center">
					<h2 class="h3 fw-bold mb-3">How CopyClean works.</h2>
					<p class="text-soft mb-0">
						Set up in a few minutes. From then on you paste without unwanted formatting. Your usual workflow stays the same.
					</p>
				</div>
			</div>
			<div class="row g-4 justify-content-center">
				<div class="col-md-4">
					<div class="card h-100 text-center">
						<div class="card-body">
							<div class="step-number mb-3">1</div>
							<h3 class="h6 fw-semibold">Install CopyClean</h3>
							<p class="small text-soft mb-0">
								Download CopyClean from the App Store. Launch the app. The icon appears in your menu bar.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card h-100 text-center">
						<div class="card-body">
							<div class="step-number mb-3">2</div>
							<h3 class="h6 fw-semibold">Choose your mode</h3>
							<p class="small text-soft mb-0">
								Decide whether you want to use plain paste all the time or only through a custom shortcut.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card h-100 text-center">
						<div class="card-body">
							<div class="step-number mb-3">3</div>
							<h3 class="h6 fw-semibold">Paste as usual</h3>
							<p class="small text-soft mb-0">
								Copy text from any source. Paste it where you need it. The content adapts cleanly to the target environment.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Audience -->
	<section id="audience">
		<div class="container">
			<div class="row mb-4 align-items-end">
				<div class="col-lg-8">
					<h2 class="h3 fw-bold mb-2">For people who work with text.</h2>
					<p class="text-soft mb-0">
						CopyClean is built for people who move content between apps all the time. Especially where text will later be published or processed further.
					</p>
				</div>
			</div>
			<div class="row g-4">
				<div class="col-md-6 col-lg-3">
					<div class="card h-100">
						<img src="assets/img/developers.jpg" class="card-img-top" alt="CopyClean for developers">
						<div class="card-body">
							<h3 class="h6 fw-semibold mb-2">Developers</h3>
							<p class="small text-soft mb-0">
								Paste sample text into interfaces, tickets or documentation. Get clean copy without foreign formatting.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card h-100">
						<img src="assets/img/writers_authors.jpg" class="card-img-top" alt="CopyClean for Writers and authors">
						<div class="card-body">
							<h3 class="h6 fw-semibold mb-2">Writers and authors</h3>
							<p class="small text-soft mb-0">
								Work in writing tools and online editors. Paste content that adapts to the style of your target environment.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card h-100">
						<img src="assets/img/office_power_user.jpg" class="card-img-top" alt="CopyClean for office power users">
						<div class="card-body">
							<h3 class="h6 fw-semibold mb-2">Office power users</h3>
							<p class="small text-soft mb-0">
								Build presentations, spreadsheets and reports. Avoid formatting errors caused by mixed sources.
							</p>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="card h-100">
						<img src="assets/img/editors_cms.jpg" class="card-img-top" alt="CopyClean for editors working within CMS">
						<div class="card-body">
							<h3 class="h6 fw-semibold mb-2">Editors in CMS</h3>
							<p class="small text-soft mb-0">
								Paste text into CMS editors without destroying your layout. Prevent foreign formatting that breaks design and forces manual fixes.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Screenshots -->
	<section id="screenshots" class="bg-white">
		<div class="container">
			<div class="row justify-content-between align-items-end mb-4">
				<div class="col-lg-6">
					<h2 class="h3 fw-bold mb-2">A look inside the app.</h2>
					<p class="text-soft mb-0">
						Take a quick look at CopyClean in action. These previews will soon be replaced with additional real screenshots from your Mac.
					</p>
				</div>
			</div>
			<div class="row g-4">
				<div class="col-md-4">
					<div class="screenshot-placeholder screenshot-real ratio ratio-4x3">
						<div class="screenshot-inner">
							<img src="assets/img/screenshot_app_macbook-4x3.png" alt="Menu bar screenshot" class="img-fluid w-100">
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="screenshot-placeholder ratio ratio-4x3">
						<div class="screenshot-inner">
							<span class="small text-soft">Before and after example</span>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="screenshot-placeholder screenshot-real ratio ratio-4x3">
						<div class="screenshot-inner">
							<img src="assets/img/imac_mockup.jpg" alt="Menu bar on iMac" class="img-fluid w-100">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- FAQ -->
	<section id="faq">
		<div class="container">
			<div class="row justify-content-center mb-4">
				<div class="col-lg-8 text-center">
					<h2 class="h3 fw-bold mb-3">Frequently asked questions.</h2>
					<p class="text-soft mb-0">
						Clear answers to common questions about CopyClean, plain paste and privacy.
					</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="accordion faq-accordion" id="faqAccordion">
						<div class="accordion-item">
							<h2 class="accordion-header" id="faqOneHeading">
								<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqOne" aria-expanded="true" aria-controls="faqOne">
									Does CopyClean work in all apps on my Mac?
								</button>
							</h2>
							<div id="faqOne" class="accordion-collapse collapse show" aria-labelledby="faqOneHeading" data-bs-parent="#faqAccordion">
								<div class="accordion-body">
									CopyClean works on system level. The plain paste effect is active in most apps that use the standard keyboard shortcut for pasting. Some applications use custom behaviour and may react differently.
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header" id="faqTwoHeading">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTwo" aria-expanded="false" aria-controls="faqTwo">
									Can I still paste with formatting when I need it?
								</button>
							</h2>
							<div id="faqTwo" class="accordion-collapse collapse" aria-labelledby="faqTwoHeading" data-bs-parent="#faqAccordion">
								<div class="accordion-body">
									You can configure CopyClean so that only a custom shortcut uses plain paste. The default paste shortcut then keeps formatting. You decide which setup fits your workflow best.
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header" id="faqThreeHeading">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqThree" aria-expanded="false" aria-controls="faqThree">
									Which macOS versions are supported?
								</button>
							</h2>
							<div id="faqThree" class="accordion-collapse collapse" aria-labelledby="faqThreeHeading" data-bs-parent="#faqAccordion">
								<div class="accordion-body">
									The exact version requirement is listed on the App Store page. CopyClean is designed for current macOS releases. Very old versions are not supported long term.
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header" id="faqFourHeading">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqFour" aria-expanded="false" aria-controls="faqFour">
									What happens to my clipboard data?
								</button>
							</h2>
							<div id="faqFour" class="accordion-collapse collapse" aria-labelledby="faqFourHeading" data-bs-parent="#faqAccordion">
								<div class="accordion-body">
									CopyClean runs locally on your Mac. Clipboard contents are not sent to a server. There is no account and no tracking.
								</div>
							</div>
						</div>
						<div class="accordion-item">
							<h2 class="accordion-header" id="faqFiveHeading">
								<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqFive" aria-expanded="false" aria-controls="faqFive">
									How do I uninstall CopyClean?
								</button>
							</h2>
							<div id="faqFive" class="accordion-collapse collapse" aria-labelledby="faqFiveHeading" data-bs-parent="#faqAccordion">
								<div class="accordion-body">
									Quit CopyClean. Drag the app from your Applications folder to the Trash. You can optionally remove related preferences from your user directory. Detailed steps are available in the help section inside the app.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Support -->
	<section id="support" class="bg-white">
		<div class="container">
			<div class="row justify-content-center mb-4">
				<div class="col-lg-8 text-center">
					<h2 class="h3 fw-bold mb-3">Support and contact.</h2>
					<p class="text-soft mb-0">
						You have a question about CopyClean, found a bug or want to share an idea. Use the form and I will get back to you.
					</p>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="card support-card shadow-sm">
						<div class="card-body p-4 p-md-5">
							<form id="contact-form" method="post" action="contact.php" novalidate>
								<div id="contact-alert" class="w-100 mb-3"></div>
							
								<div class="row g-3 mb-3">
									<div class="col-md-6">
										<label for="name" class="form-label">Name</label>
										<input type="text" class="form-control" id="name" name="name" placeholder="Your name" required>
									</div>
									<div class="col-md-6">
										<label for="email" class="form-label">Email</label>
										<input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
									</div>
								</div>
							
								<div class="mb-3">
									<label for="subject" class="form-label">Topic</label>
									<select class="form-select" id="subject" name="subject" required>
										<option value="">Please choose a topic</option>
										<option value="bug">Bug or issue</option>
										<option value="idea">Feature request</option>
										<option value="question">Usage question</option>
										<option value="other">Other</option>
									</select>
								</div>
							
								<div class="mb-3">
									<label for="message" class="form-label">Message</label>
									<textarea class="form-control" id="message" name="message" rows="4" placeholder="Describe your request as clearly as possible." required></textarea>
								</div>
							
								<div class="mb-3 form-check">
									<input type="checkbox" class="form-check-input" id="logs" name="logs" value="1">
									<label class="form-check-label small text-soft" for="logs">
										I am willing to provide log files if needed. I will send instructions in my reply.
									</label>
								</div>
							
								<!-- simpler Honeypot -->
								<div class="hp">
									<label for="contact_meta_info">Internal meta info</label>
									<input type="text" id="contact_meta_info" name="contact_meta_info" autocomplete="off">
								</div>
							
								<div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
									<button type="submit" class="btn btn-primary px-4" id="contact-submit">
										Send message
									</button>
									<p class="small text-soft mb-0">
										<em><b>Note:</b> I usually reply within two business days.</em>
									</p>
								</div>
							</form>


						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Download CTA -->
	<section id="download" class="bg-soft-dark text-white">
		<div class="container">
			<div class="row align-items-center gy-3">
				<div class="col-lg-8">
					<h2 class="h4 fw-bold mb-2">Ready for clean pasting.</h2>
					<p class="mb-0 text-white-50">
						Get CopyClean on the App Store and replace noisy formatting with clear text. Every day.
					</p>
				</div>
				<div class="col-lg-4 text-lg-end">
					<a href="out-appstore.php?src=footer" class="btn btn-primary px-4">
						Buy on the App Store
					</a>
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
				<a href="#support">Support</a>
			</div>
		</div>
	</div>
</footer>

<!-- Bootstrap bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="assets/js/app.min.js"></script>

<script>
	// Navbar shadow on scroll
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

	// Current year in footer
	document.addEventListener("DOMContentLoaded", function () {
		const yearSpan = document.getElementById("year");
		if (yearSpan) {
			yearSpan.textContent = new Date().getFullYear();
		}
	});
	
document.addEventListener('DOMContentLoaded', function () {
		const form          = document.getElementById('contact-form');
		const alertBox      = document.getElementById('contact-alert');
		const submitButton  = document.getElementById('contact-submit');
		const defaultButtonText = submitButton ? submitButton.textContent : 'Send message';
	
		if (!form) return;
	
		function showAlert(type, message) {
			// type: 'success' oder 'danger'
			alertBox.innerHTML = `
				<div class="alert alert-${type} alert-dismissible fade show mb-0" role="alert">
					${message}
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			`;
		}
	
		form.addEventListener('submit', function (event) {
			event.preventDefault();
	
			// Button sperren
			if (submitButton) {
				submitButton.disabled = true;
				submitButton.textContent = 'Sending...';
			}
	
			// alten Alert leeren
			alertBox.innerHTML = '';
	
			const formData = new FormData(form);
	
			fetch(form.action, {
				method: 'POST',
				headers: {
					'X-Requested-With': 'XMLHttpRequest'
				},
				body: formData
			})
			.then(response => {
				if (!response.ok) {
					throw new Error('Network response was not ok');
				}
				return response.json();
			})
			.then(data => {
				if (data.status === 'ok') {
					showAlert('success', data.message || 'Thank you. Your message has been sent.');
					form.reset();
				} else if (data.status === 'error') {
					let msg = 'There was a problem with your message.';
					if (Array.isArray(data.errors) && data.errors.length > 0) {
						msg += '<ul class="mb-0">';
						data.errors.forEach(function (err) {
							msg += '<li>' + String(err) + '</li>';
						});
						msg += '</ul>';
					}
					showAlert('danger', msg);
				} else {
					showAlert('danger', 'Unexpected response from server.');
				}
			})
			.catch(error => {
				console.error('Contact form error:', error);
				showAlert('danger', 'Sorry, something went wrong while sending your message. Please try again later.');
			})
			.finally(() => {
				if (submitButton) {
					submitButton.disabled = false;
					submitButton.textContent = defaultButtonText;
				}
			});
		});
	});
</script>

</body>
</html>
