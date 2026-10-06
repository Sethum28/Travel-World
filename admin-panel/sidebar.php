<?php $current=basename($_SERVER["PHP_SELF"]); ?>
<aside class="sidebar text-white position-fixed top-0 start-0 h-100" style="z-index:1040">
<div class="brand-wrap">
 <div class="d-flex align-items-center gap-2 px-1">
  <span class="d-inline-flex align-items-center justify-content-center rounded-circle" style="width:42px;height:42px;background:rgba(14,159,154,.16);"><i class="fa-solid fa-compass" style="color:#6fd3ce"></i></span>
  <div class="brand-text"><div class="fw-bold">Travel World</div><small style="color:#71849a;letter-spacing:1px;">ADMIN CONSOLE</small></div>
 </div>
</div>
<nav class="nav flex-column">
<a class="nav-link <?= $current==='dashboard.php'?'active':'' ?>" href="dashboard.php"><i class="fa-solid fa-chart-pie me-2"></i><span class="nav-text">Dashboard</span></a>
<a class="nav-link <?= $current==='slider.php'?'active':'' ?>" href="slider.php"><i class="fa-solid fa-images me-2"></i><span class="nav-text">Slider</span></a>
<a class="nav-link <?= $current==='packages.php'?'active':'' ?>" href="packages.php"><i class="fa-solid fa-suitcase-rolling me-2"></i><span class="nav-text">Packages</span></a>
<a class="nav-link <?= $current==='onedaytour.php'?'active':'' ?>" href="onedaytour.php"><i class="fa-solid fa-map-location-dot me-2"></i><span class="nav-text">One Day Tours</span></a>
<a class="nav-link <?= $current==='gallery.php'?'active':'' ?>" href="gallery.php"><i class="fa-solid fa-photo-film me-2"></i><span class="nav-text">Gallery</span></a>
<a class="nav-link <?= $current==='tourtype.php'?'active':'' ?>" href="tourtype.php"><i class="fa-solid fa-tags me-2"></i><span class="nav-text">Tour Types</span></a>
<a class="nav-link <?= $current==='booking.php'?'active':'' ?>" href="booking.php"><i class="fa-solid fa-calendar-check me-2"></i><span class="nav-text">Bookings</span></a>
<a class="nav-link <?= $current==='messages.php'?'active':'' ?>" href="messages.php"><i class="fa-solid fa-envelope me-2"></i><span class="nav-text">Messages</span></a>
<a class="nav-link <?= $current==='plans.php'?'active':'' ?>" href="plans.php"><i class="fa-solid fa-route me-2"></i><span class="nav-text">Travel Plans</span></a>
<a class="nav-link <?= $current==='settings.php'?'active':'' ?>" href="settings.php"><i class="fa-solid fa-sliders me-2"></i><span class="nav-text">Settings</span></a>
</nav>
<div class="position-absolute bottom-0 start-0 p-3 w-100 border-top" style="border-color:rgba(255,255,255,.08)!important">
<a class="logout-link text-decoration-none fw-semibold" href="logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i><span class="nav-text">Logout</span></a>
</div></aside>