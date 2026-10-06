<?php require_once __DIR__.'/app/bootstrap.php'; $site=setting('site_name','Travel World'); $isHome=basename($_SERVER['PHP_SELF'])==='index.php'; ?>
<nav class="navbar navbar-expand-lg tw-nav <?= $isHome?'tw-nav-home':'' ?>">
<div class="container py-2">
<a class="navbar-brand tw-brand d-flex align-items-center gap-2" href="index.php">
  <span class="brand-mark"><i class="fa-solid fa-compass"></i></span>
  <span><strong><?=e($site)?></strong><small>EXPLORE • DISCOVER • REMEMBER</small></span>
</a>
<button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="mainNav">
<ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
<li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Experiences</a>
<ul class="dropdown-menu">
<li><a class="dropdown-item" href="onedaytour.php"><i class="fa-solid fa-sun"></i>One Day Tours</a></li>
<li><a class="dropdown-item" href="roundtour.php"><i class="fa-solid fa-route"></i>Round Tours</a></li>
<li><a class="dropdown-item" href="planyourtrip.php"><i class="fa-solid fa-wand-magic-sparkles"></i>Plan Your Trip</a></li>
</ul></li>
<li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
<li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
<li class="nav-item"><a class="nav-link" href="contactus.php">Contact</a></li>
<li class="nav-item ms-lg-2"><a class="tw-nav-cta" href="booking.php"><i class="fa-solid fa-paper-plane"></i> Book a Journey</a></li>
</ul></div></div></nav>
