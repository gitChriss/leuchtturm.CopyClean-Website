<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>CopyClean – Imprint</title>

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
          <a class="nav-link active" href="imprint.html">Imprint</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="privacy.html">Privacy</a>
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
          <h1 class="h3 fw-bold mb-2">Imprint</h1>
          <p class="text-soft mb-0">
            Legal disclosure and provider information according to German law.
          </p>
        </div>
      </div>

      <div class="row justify-content-center">
        <div class="col-lg-8">
          <div class="card shadow-sm">
            <div class="card-body p-4 p-md-5">
              <h2 class="h5 mb-3">Service provider</h2>
              <p class="mb-3">
                Leuchtturm.app<br>
                Christian Ruppelt<br>
                Fliederstraße 5<br>
                37586 Dassel<br>
                Germany
              </p>

              <h2 class="h6 mt-4 mb-2">Contact</h2>
              <p class="mb-2">
                Email: <a href="mailto:post@christianruppelt.de">post@christianruppelt.de</a> (no support)<br>
                Phone: <a href="tel:+4955647553926">+49 (0)5564 7553926</a> (no support)
              </p>
              <p class="small text-soft mb-4">
                Please do not use the email address or phone number above for CopyClean product support.
                For questions about the app, bugs or feature ideas, use the support form on the website instead.
              </p>

              <h2 class="h6 mt-4 mb-2">Responsible according to § 5 TMG and § 18 MStV</h2>
              <p class="mb-4">
                Christian Ruppelt<br>
                Fliederstraße 5<br>
                37586 Dassel<br>
                Germany
              </p>

              <h2 class="h6 mt-4 mb-2">Liability for content</h2>
              <p class="mb-3">
                The contents of this website have been created with great care.
                However, no guarantee is given for the correctness, completeness or up-to-dateness of the information provided.
              </p>

              <h2 class="h6 mt-4 mb-2">Liability for links</h2>
              <p class="mb-3">
                Where this website contains links to external websites of third parties, no influence can be taken on their content.
                The respective provider or operator of the pages is always responsible for the content of the linked pages.
              </p>

              <h2 class="h6 mt-4 mb-2">Copyright</h2>
              <p class="mb-0">
                The content and works created by the site operator on these pages are subject to German copyright law.
                Any duplication, editing, distribution or any kind of use outside the limits of copyright law
                requires the prior written consent of the respective author.
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
