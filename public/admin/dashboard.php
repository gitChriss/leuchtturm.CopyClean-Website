<?php
// admin/dashboard.php
// CopyClean Analytics Dashboard using CoreUI + Chart.js (Dark/Light Toggle)

require __DIR__ . '/../tracking.php';

$analyticsFile = __DIR__ . '/../logs/analytics.log';
$eventsFile    = __DIR__ . '/../logs/events.log';

$pageviews        = [];
$pageviewsByDay   = [];
$uniqueIps        = [];
$uniqueByDayIps   = [];
$events           = [];
$appstoreClicks   = 0;
$appstoreBySrc    = [];

if (is_readable($analyticsFile)) {
	$fh = fopen($analyticsFile, 'r');
	if ($fh) {
		while (($line = fgets($fh)) !== false) {
			$line = trim($line);
			if ($line === '') continue;

			$row = json_decode($line, true);
			if (!is_array($row)) continue;

			$page = $row['page'] ?? 'unknown';
			$ts   = $row['ts'] ?? null;
			$ip   = $row['ip'] ?? null;

			$pageviews[$page] = ($pageviews[$page] ?? 0) + 1;

			if ($ts) {
				$day = substr($ts, 0, 10); // YYYY-MM-DD
				$pageviewsByDay[$day] = ($pageviewsByDay[$day] ?? 0) + 1;

				if ($ip) {
					$uniqueByDayIps[$day][$ip] = true;
				}
			}

			if ($ip) {
				$uniqueIps[$ip] = true;
			}
		}
		fclose($fh);
	}
}

if (is_readable($eventsFile)) {
	$fh = fopen($eventsFile, 'r');
	if ($fh) {
		while (($line = fgets($fh)) !== false) {
			$line = trim($line);
			if ($line === '') continue;

			$row = json_decode($line, true);
			if (!is_array($row)) continue;

			$events[] = $row;

			if (($row['event'] ?? null) === 'appstore_click') {
				$appstoreClicks++;
				$src = $row['meta']['src'] ?? 'unknown';
				$appstoreBySrc[$src] = ($appstoreBySrc[$src] ?? 0) + 1;
			}
		}
		fclose($fh);
	}
}

// Sortierungen
ksort($pageviewsByDay);         // chronologisch (für Charts)
arsort($pageviews);             // meistbesuchte Seiten
arsort($appstoreBySrc);         // wichtigste Quellen

// Unique per day
$uniqueByDayCounts = [];
foreach ($uniqueByDayIps as $day => $set) {
	$uniqueByDayCounts[$day] = count($set);
}
ksort($uniqueByDayCounts);

// Letzte 50 Events
$events = array_slice(array_reverse($events), 0, 50);

// Chart-Daten
$chartDays         = array_keys($pageviewsByDay);
$chartViews        = array_values($pageviewsByDay);
$chartUniqueByDay  = [];
foreach ($chartDays as $d) {
	$chartUniqueByDay[] = $uniqueByDayCounts[$d] ?? 0;
}

$chartSources = array_keys($appstoreBySrc);
$chartClicks  = array_values($appstoreBySrc);

// KPIs
$totalPageviews       = array_sum($pageviews);
$totalUniqueVisitors  = count($uniqueIps);
$trackedDays          = count($pageviewsByDay);

// Last 7 days
$last7Views  = array_slice($chartViews, -7);
$last7Unique = array_slice($chartUniqueByDay, -7);
$last7ViewsSum  = array_sum($last7Views);
$last7UniqueSum = array_sum($last7Unique);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CopyClean Analytics Dashboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CoreUI + Bootstrap -->
  <link rel="stylesheet" href="https://unpkg.com/@coreui/coreui/dist/css/coreui.min.css">
</head>
<body class="c-app" data-coreui-theme="dark">

  <!-- Sidebar -->
  <div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
	<div class="sidebar-brand d-none d-md-flex">
	  <span class="fw-bold">CopyClean Analytics</span>
	</div>
	<ul class="sidebar-nav" data-coreui="navigation">
	  <li class="nav-item">
		<a class="nav-link active" href="dashboard.php">
		  <span class="nav-icon">📊</span> Dashboard
		</a>
	  </li>
	  <li class="nav-title">Navigation</li>
	  <li class="nav-item">
		<a class="nav-link" href="../">
		  <span class="nav-icon">🏠</span> Back to Site
		</a>
	  </li>
	</ul>
  </div>

  <div class="wrapper d-flex flex-column min-vh-100 bg-body">

	<!-- Header -->
	<header class="header header-sticky mb-4">
	  <div class="container-fluid">
		<button class="header-toggler px-md-0 me-md-3" type="button"
				onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
		  <span class="navbar-toggler-icon"></span>
		</button>
		<a class="header-brand d-md-none" href="#">
		  <span class="fw-bold">CopyClean</span>
		</a>
		<ul class="header-nav ms-auto me-3">
		  <li class="nav-item">
			<button class="btn btn-ghost-secondary" id="themeToggleBtn" type="button">
			  <span id="themeToggleIcon">🌙</span>
			  <span class="d-none d-sm-inline ms-1">Toggle theme</span>
			</button>
		  </li>
		</ul>
	  </div>
	</header>

	<!-- Content -->
	<div class="body flex-grow-1 px-3">
	  <div class="container-lg">

		<!-- KPI Cards (CoreUI-style) -->
		<div class="row g-3 mb-4">
		  <div class="col-sm-6 col-xl-3">
			<div class="card text-white bg-primary">
			  <div class="card-body pb-0 d-flex justify-content-between align-items-start">
				<div>
				  <div class="fw-semibold text-uppercase small mb-2">Total pageviews</div>
				  <div class="fs-2 fw-bold"><?php echo $totalPageviews; ?></div>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="col-sm-6 col-xl-3">
			<div class="card text-white bg-info">
			  <div class="card-body pb-0 d-flex justify-content-between align-items-start">
				<div>
				  <div class="fw-semibold text-uppercase small mb-2">Approx. unique visitors</div>
				  <div class="fs-2 fw-bold"><?php echo $totalUniqueVisitors; ?></div>
				  <div class="small opacity-75 mt-1">Based on anonymized IPs.</div>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="col-sm-6 col-xl-3">
			<div class="card text-white bg-success">
			  <div class="card-body pb-0 d-flex justify-content-between align-items-start">
				<div>
				  <div class="fw-semibold text-uppercase small mb-2">App Store clicks</div>
				  <div class="fs-2 fw-bold"><?php echo $appstoreClicks; ?></div>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="col-sm-6 col-xl-3">
			<div class="card text-white bg-danger">
			  <div class="card-body pb-0 d-flex justify-content-between align-items-start">
				<div>
				  <div class="fw-semibold text-uppercase small mb-2">Last 7 days</div>
				  <div class="fs-6 fw-semibold">Views: <?php echo $last7ViewsSum; ?></div>
				  <div class="fs-6 fw-semibold">Visitors: <?php echo $last7UniqueSum; ?></div>
				  <div class="small opacity-75 mt-1"><?php echo $trackedDays; ?> tracked days total</div>
				</div>
			  </div>
			</div>
		  </div>
		</div>

		<!-- Charts -->
		<div class="row g-4 mb-4">
		  <div class="col-lg-8">
			<div class="card h-100">
			  <div class="card-header">
				Traffic (pageviews & unique visitors)
			  </div>
			  <div class="card-body">
				<div class="chart-wrapper" style="height: 280px;">
				  <canvas id="trafficChart"></canvas>
				</div>
			  </div>
			</div>
		  </div>
		  <div class="col-lg-4">
			<div class="card h-100">
			  <div class="card-header">
				App Store clicks by source
			  </div>
			  <div class="card-body">
				<div class="chart-wrapper" style="height: 280px;">
				  <canvas id="appstoreChart"></canvas>
				</div>
			  </div>
			</div>
		  </div>
		</div>

		<!-- Tables -->
		<div class="row g-4">
		  <div class="col-md-6">
			<div class="card h-100">
			  <div class="card-header">
				Pageviews by page
			  </div>
			  <div class="card-body p-0">
				<table class="table mb-0">
				  <thead>
					<tr>
					  <th>Page</th>
					  <th class="text-end">Views</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php if (empty($pageviews)): ?>
					<tr><td colspan="2" class="text-center text-medium-emphasis py-3">No data yet.</td></tr>
				  <?php else: ?>
					<?php foreach ($pageviews as $page => $count): ?>
					  <tr>
						<td><?php echo htmlspecialchars($page, ENT_QUOTES, 'UTF-8'); ?></td>
						<td class="text-end"><?php echo $count; ?></td>
					  </tr>
					<?php endforeach; ?>
				  <?php endif; ?>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>

		  <div class="col-md-6">
			<div class="card h-100">
			  <div class="card-header">
				Pageviews by day
			  </div>
			  <div class="card-body p-0">
				<table class="table mb-0">
				  <thead>
					<tr>
					  <th>Date</th>
					  <th class="text-end">Views</th>
					  <th class="text-end">Visitors</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php if (empty($pageviewsByDay)): ?>
					<tr><td colspan="3" class="text-center text-medium-emphasis py-3">No data yet.</td></tr>
				  <?php else: ?>
					<?php foreach ($pageviewsByDay as $day => $count): ?>
					  <tr>
						<td><?php echo htmlspecialchars($day, ENT_QUOTES, 'UTF-8'); ?></td>
						<td class="text-end"><?php echo $count; ?></td>
						<td class="text-end"><?php echo $uniqueByDayCounts[$day] ?? 0; ?></td>
					  </tr>
					<?php endforeach; ?>
				  <?php endif; ?>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>
		</div>

		<!-- App Store sources + Events -->
		<div class="row g-4 mt-1">
		  <div class="col-md-6">
			<div class="card h-100">
			  <div class="card-header">
				App Store clicks by source
			  </div>
			  <div class="card-body p-0">
				<table class="table mb-0">
				  <thead>
					<tr>
					  <th>Source</th>
					  <th class="text-end">Clicks</th>
					</tr>
				  </thead>
				  <tbody>
				  <?php if (empty($appstoreBySrc)): ?>
					<tr><td colspan="2" class="text-center text-medium-emphasis py-3">No data yet.</td></tr>
				  <?php else: ?>
					<?php foreach ($appstoreBySrc as $src => $count): ?>
					  <tr>
						<td><?php echo htmlspecialchars($src, ENT_QUOTES, 'UTF-8'); ?></td>
						<td class="text-end"><?php echo $count; ?></td>
					  </tr>
					<?php endforeach; ?>
				  <?php endif; ?>
				  </tbody>
				</table>
			  </div>
			</div>
		  </div>

		  <div class="col-md-6">
			<div class="card h-100">
			  <div class="card-header">
				Latest events
			  </div>
			  <div class="card-body p-0">
				<div class="table-responsive">
				  <table class="table mb-0">
					<thead>
					  <tr>
						<th>Time</th>
						<th>Event</th>
						<th>Meta</th>
					  </tr>
					</thead>
					<tbody>
					<?php if (empty($events)): ?>
					  <tr><td colspan="3" class="text-center text-medium-emphasis py-3">No events yet.</td></tr>
					<?php else: ?>
					  <?php foreach ($events as $e): ?>
						<tr>
						  <td class="text-nowrap">
							<?php echo htmlspecialchars($e['ts'] ?? '', ENT_QUOTES, 'UTF-8'); ?>
						  </td>
						  <td>
							<?php
							  $eventName = $e['event'] ?? '';
							  $badgeClass = 'bg-secondary';
							  if ($eventName === 'appstore_click') $badgeClass = 'bg-primary';
							?>
							<span class="badge <?php echo $badgeClass; ?>">
							  <?php echo htmlspecialchars($eventName, ENT_QUOTES, 'UTF-8'); ?>
							</span>
						  </td>
						  <td>
							<?php
							$meta = $e['meta'] ?? [];
							if (empty($meta)) {
								echo '<span class="text-medium-emphasis">–</span>';
							} else {
								echo htmlspecialchars(json_encode($meta), ENT_QUOTES, 'UTF-8');
							}
							?>
						  </td>
						</tr>
					  <?php endforeach; ?>
					<?php endif; ?>
					</tbody>
				  </table>
				</div>
			  </div>
			</div>
		  </div>
		</div>

	  </div><!-- /.container-lg -->
	</div><!-- /.body -->

	<footer class="footer px-3">
	  <div class="container-fluid">
		<div class="d-flex justify-content-between small">
		  <span>CopyClean Analytics</span>
		  <span>Cookie-free · Server-side only</span>
		</div>
	  </div>
	</footer>

  </div><!-- /.wrapper -->

  <script src="https://unpkg.com/@coreui/coreui/dist/js/coreui.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
  <script>
	// Theme toggle (Dark/Light) with localStorage
	const root          = document.body;
	const themeBtn      = document.getElementById('themeToggleBtn');
	const themeIconSpan = document.getElementById('themeToggleIcon');

	function applyTheme(theme) {
	  root.setAttribute('data-coreui-theme', theme);
	  themeIconSpan.textContent = theme === 'dark' ? '🌙' : '☀️';
	}

	(function initTheme() {
	  const stored = localStorage.getItem('cc_theme');
	  if (stored === 'light' || stored === 'dark') {
		applyTheme(stored);
	  } else {
		applyTheme('dark');
	  }
	})();

	themeBtn.addEventListener('click', () => {
	  const current = root.getAttribute('data-coreui-theme') === 'dark' ? 'dark' : 'light';
	  const next = current === 'dark' ? 'light' : 'dark';
	  applyTheme(next);
	  localStorage.setItem('cc_theme', next);
	});

	// Traffic chart
	const trafficLabels = <?php echo json_encode($chartDays); ?>;
	const trafficViews  = <?php echo json_encode($chartViews); ?>;
	const trafficUnique = <?php echo json_encode($chartUniqueByDay); ?>;

	const trafficCtx = document.getElementById('trafficChart');
	if (trafficCtx && trafficLabels.length > 0) {
	  new Chart(trafficCtx, {
		type: 'line',
		data: {
		  labels: trafficLabels,
		  datasets: [
			{
			  label: 'Pageviews',
			  data: trafficViews,
			  tension: 0.3,
			  borderWidth: 2
			},
			{
			  label: 'Unique visitors',
			  data: trafficUnique,
			  tension: 0.3,
			  borderWidth: 2
			}
		  ]
		},
		options: {
		  responsive: true,
		  scales: {
			y: { beginAtZero: true }
		  }
		}
	  });
	}

	// App Store clicks chart
	const asLabels = <?php echo json_encode($chartSources); ?>;
	const asData   = <?php echo json_encode($chartClicks); ?>;

	const asCtx = document.getElementById('appstoreChart');
	if (asCtx && asLabels.length > 0) {
	  new Chart(asCtx, {
		type: 'doughnut',
		data: {
		  labels: asLabels,
		  datasets: [{
			data: asData
		  }]
		},
		options: {
		  responsive: true,
		  plugins: {
			legend: { position: 'bottom' }
		  }
		}
	  });
	}
  </script>
</body>
</html>
