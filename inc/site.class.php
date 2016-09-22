<?php

class site extends connection{
	public $error; 

	public function siteConfig() {
		$db = $this->start(); 

		$stmt = $db->prepare("SELECT * FROM config"); 
		$stmt->execute(); 

		$data = $stmt->fetch(PDO::FETCH_OBJ); 
		$db = '';
		return $data; 
	}

	public function pages() {
		$db = $this->start(); 

		$stmt = $db->prepare("SELECT * FROM pages"); 
		$stmt->execute(); 

		$data = $stmt->fetchAll(PDO::FETCH_OBJ); 
		$db = '';
		return $data; 
	}

	public function modify($token,$tokenConfirm,$sitename,$url){
		try{
			$db = $this->start();
			if ($token != $tokenConfirm) {
				$this->error = 'Token inválido, por favor intenta de nuevo.';
			} elseif(!preg_match('/([a-zA-Z])/', $sitename)) { 
				$this->error = 'El nombre del sitio es inválido (solo letras y números)';
			} elseif(!filter_var($url, FILTER_VALIDATE_URL)) { 
				$this->error = 'La url ingresada es inválida'; 
			}
			if ($this->error=="") { 
				$stmt = $db->prepare("UPDATE config SET sitename = :sitename,url = :url"); 
				$stmt->bindParam("sitename", $sitename,PDO::PARAM_STR) ; 
				$stmt->bindParam("url", $url,PDO::PARAM_STR) ; 
				$stmt->execute();
				$db = ""; 
			}
			
		}
		catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function pageModify($id,$pagecontent,$token,$tokenConfirm){
		try{
			$db = $this->start();
			if ($token != $tokenConfirm) {
				$this->error = 'Token inválido, por favor intenta de nuevo.';
			}
			/* elseif(!preg_match('/([a-zA-Z])/', $sitename)) { 
				$this->error = 'El nombre de la página es inválido (solo letras y números)';
			}*/
			if ($this->error=="") { 
				$stmt = $db->prepare("UPDATE pages SET pagecontent = :pagecontent WHERE id = '$id'"); 
				$stmt->bindParam("pagecontent", $pagecontent,PDO::PARAM_STR); 
				$stmt->execute();
				$db = ""; 	
			}
		}
		catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function pageAdd($pagename,$pagecontent,$token,$tokenConfirm){
		try{
			$db = $this->start();
			if ($token != $tokenConfirm) {
				$this->error = 'Token inválido, por favor intenta de nuevo.';
			}
			if ($this->error=="") { 
				$stmt = $db->prepare("UPDATE pages SET pagecontent = :pagecontent WHERE id = '$id'"); 
				$stmt->bindParam("pagecontent", $pagecontent,PDO::PARAM_STR); 
				$stmt->execute();
				$db = ""; 	
			}
		}
		catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function pageDelete(){

	}

	public function pageHide(){

	}
}
?>