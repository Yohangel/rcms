<?php

function accFunctions($token){ 
	$user = new user(); 
	if(!$user->status()){ 
		if (isset($_POST['login'])){ 
			$tokenConfirm = $_POST['token']; 
			$username = $_POST['username']; 
			$password = $_POST['password']; 
			$user->login($token,$tokenConfirm,$username,$password); 
			if ($user->error == "") { 
				header("Refresh:0");
			} else {
				$_SESSION['error'] = $user->error; 
			}
		}
		if (isset($_POST['register'])){ 
			$tokenConfirm = $_POST['token']; 
			$username = $_POST['username']; 
			$name = $_POST['name']; 
			$lastname = $_POST['lastname']; 
			$password = $_POST['password']; 
			$passwordConfirm = $_POST['passwordConfirm']; 
			$email = $_POST['email']; 
			$emailConfirm = $_POST['emailConfirm'];
			$user->register($token,$tokenConfirm,$username,$name,$lastname,$password,$passwordConfirm,$email,$emailConfirm); 
			if ($user->error == "") { 
				header("Refresh:0");
			} else {
				$_SESSION['errorReg'] = $user->error; 
			}
		}
	} else { 
		if (isset($_POST['logout'])){
			$_SESSION['id'] = ''; 
			session_destroy(); 
			header("Refresh:0");
		}
	} 
}

function isAdmin(){ 
	$user = new user();
	if (($user->status()) && ($user->my()->rank == "9")){ 
	return true;
} else {
	return false;
}
}

function getActUrl(){ 
	$url = explode("/",($_SERVER["REQUEST_URI"]));
	$pagename = strtolower($url[2]);
	$file_parts = pathinfo($pagename);

	if (!empty($file_parts['extension']) and ($file_parts['extension'] == "php")){
		$pagename = strstr($pagename,'.',true);
	}

	if (($pagename == "index") || ($pagename == "") || ($pagename == "home")) {
		$pagename = "home";
	}
	return $pagename;
}

function siteAdmin($token){
	$site = new site();
		if (isset($_POST['modify'])){ 
			$tokenConfirm = $_POST['token']; 
			$sitename = $_POST['sitename'];
			$url = $_POST['url'];
			$site->modify($token,$tokenConfirm,$sitename,$url); 
			if ($site->error == "") { 
				header("Refresh:0");
			} else {
				$_SESSION['error'] = $site->error; 
			}
		}
		if (isset($_POST['modifyPages'])){ 
			$tokenConfirm = $_POST['token']; 
			foreach ($_POST as $name => $value) {
				if (substr($name, 0, 4) === "page"){
					$site->pageModify(str_replace('page', '', $name),$value,$token,$tokenConfirm);
				}
			}
			if ($site->error == "") { 
				header("Refresh:0");
			} else {
				$_SESSION['error'] = $site->error; 
			}
		}
		if (isset($_POST['addPage'])){ 
			
		}
	}
?>