<?php
require_once __DIR__ . '/data.php';
$pageTitle = $pageTitle ?? $siteTitle;
$active = $active ?? 'home';
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width">
  <title><?php echo h($pageTitle); ?></title>
  <link rel="icon" type="image/jpeg" sizes="32x32" href="assets/favicon/favicon-32x32.jpg">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.jpg">
  <link rel="icon" type="image/jpeg" sizes="192x192" href="assets/favicon/icon-192x192.jpg">
  <link rel="stylesheet" href="assets/theme/css/isotope.css" media="screen">
  <link rel="stylesheet" href="assets/theme/css/bootstrap.css">
  <link rel="stylesheet" href="assets/theme/css/bootstrap-theme.css">
  <link rel="stylesheet" href="assets/theme/css/responsive-slider.css">
  <link rel="stylesheet" href="assets/theme/css/thirdeffect.css">
  <link rel="stylesheet" href="assets/theme/css/animate.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/theme/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/theme/js/fancybox/jquery.fancybox.css?v=2.1.5" media="screen">
  <link rel="stylesheet" href="assets/theme/css/default.css">
  <link rel="stylesheet" href="assets/css/static-param.css?v=14">
</head>
<body>
  <div class="header">
    <section id="header" class="appear">
      <div class="navbar navbar-fixed-top" role="navigation">
        <div class="container">
          <div class="row">
            <div class="col-sm-4"><a class="navbar-brand" href="index.php"><img src="assets/theme/img/logo.jpg" alt="Print Pack"></a></div>
            <div class="col-sm-4"><p class="text-center small" style="margin-top:35px">Param Packaging Pvt Ltd | PineTree Packaging Pvt Ltd</p></div>
            <div class="col-sm-4"><a class="navbar-brand pull-right" href="index.php"><img src="assets/theme/img/logo-param.jpg" alt="Param"></a></div>
          </div>
          <div class="clear"></div>
        </div>
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" aria-expanded="false" aria-controls="primary-menu">
            <span class="fa fa-bars color-white"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="primary-menu">
          <ul class="nav navbar-nav skrollable skrollable-after">
            <li class="<?php echo $active === 'home' ? 'active' : ''; ?>"><a href="index.php#index">Home</a></li>
            <li class="<?php echo $active === 'who' ? 'active' : ''; ?>"><a href="index.php#whoweare">Who We Are</a></li>
            <li class="<?php echo $active === 'what' ? 'active' : ''; ?>"><a href="index.php#whatwedo">What We Do</a></li>
            <li><a href="index.php#industry">Industry Verticals</a></li>
            <li><a href="index.php#services">Our Clients</a></li>
            <li><a href="index.php#contact-page">Contact Us</a></li>
          </ul>
        </div>
      </div>
    </section>
  </div>
