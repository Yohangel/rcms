<?php 
$site = new site;
?>
<!doctype html>
<html lang="es" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $site->siteConfig()->sitename.': '.$pagetitle; ?></title>
	<link rel="stylesheet" href="<?= $site->siteConfig()->url ?>/css/reset.css"> <!-- CSS reset -->
	<link rel="stylesheet" href="<?= $site->siteConfig()->url ?>/css/style.css"> <!-- Gem style -->
	<script src="<?= $site->siteConfig()->url ?>/js/modernizr.js"></script> <!-- Modernizr -->
</head>
<body>