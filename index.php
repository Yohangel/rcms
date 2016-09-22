<?php
include("inc/config.php"); 
if(isset($_SESSION['token']) && $_SESSION['token'] != ""){
	accFunctions($_SESSION['token']);
} 
if(isAdmin() && isset($_SESSION['adminToken']) && $_SESSION['adminToken'] != ""){
	siteAdmin($_SESSION['adminToken']);
} 
$pagename = getActUrl(); 
$pagetitle = ucfirst($pagename);
$sites = new site;
$pages = $sites->pages();
$exist = false;
if ($pagename == "home") {
$content = "views/home.php";
$exist = true;
}
foreach ($pages as $page) {
	if ($pagename == $page->pagename) {
		$contentDb = "$page->pagecontent";
		$content = "views/universal.php";
		$exist = true;
	}
}
if ($pagename == "admin") {
$content = "views/admin.php";
$exist = true;
}
if ($exist !== true) {
$content = "views/404.php";
$pagetitle = "Not found";
}
include("views/header.php"); 
include("views/template/top.php"); 
include("views/template/login.php"); 
include($content);
include("views/template/bottom.php"); 
include("views/footer.php"); 
?>