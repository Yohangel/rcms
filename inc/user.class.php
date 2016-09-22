<?php

class user extends connection{

	public $error; 

	public function login($token,$tokenConfirm,$username,$password){ 
		try{
			$db = $this->start();
			$this->error = "";

			$password = hash('sha256', $password); 

			if ($token != $tokenConfirm) {
				$this->error = 'Token inválido, por favor intenta de nuevo.';
			} elseif(!preg_match('/([a-zA-Z0-9])/', $username)) { 
				$this->error = "El usuario ingresado es inválido";  
			} else {
				$stmt = $db->prepare("SELECT id FROM users WHERE (username=:username) AND password=:password"); 
				$stmt->bindParam("username", $username,PDO::PARAM_STR) ; 
				$stmt->bindParam("password", $password,PDO::PARAM_STR) ; 
				$stmt->execute(); 

				$count=$stmt->rowCount(); 
				$data=$stmt->fetch(PDO::FETCH_OBJ); 

				$db = ""; 

				if($count>0){ 
					$_SESSION['id']=$data->id; 
				} else { 
					$this->error = 'Los datos de ingreso indicados no son válidos.'; 
				}
			}
		}
		catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function register($token,$tokenConfirm,$username,$name,$lastname,$password,$passwordConfirm,$email,$emailConfirm){ 
		try{
			$db = $this->start(); 
			$this->error = ""; 

			$st = $db->prepare("SELECT id FROM users WHERE (username=:username) OR (email=:email)"); 
			$st->bindParam("username", $username,PDO::PARAM_STR); 
			$st->bindParam("email", $email,PDO::PARAM_STR); 
			$st->execute(); 
			$count=$st->rowCount(); 
			if ($token != $tokenConfirm) {
				$this->error = 'Token inválido, por favor intenta de nuevo.';
			} elseif($count>0){ 
				$this->error = 'El usuario o email ingresado ya existe.'; 
			} elseif(strlen($username)<5 or strlen($username)>20) { 
				$this->error = 'El usuario debe tener entre 5 y 20 carácteres.'; 
			} elseif(strlen($password)<5 or strlen($password)>20) { 
				$this->error = 'La contraseña debe tener entre 5 y 20 carácteres.'; 
			} elseif(strlen($name)<3 or strlen($name)>20) { 
				$this->error = 'El nombre debe tener entre 3 y 20 carácteres.'; 
			} elseif(strlen($lastname)<3 or strlen($lastname)>20) { 
				$this->error = 'El apellido debe tener entre 3 y 20 carácteres.'; 
			} elseif(!preg_match('/([a-zA-Z0-9])/', $username)) { 
				$this->error = 'El usuario ingresado es inválido'; 
			} elseif(!preg_match('/([a-zA-Z])/', $name)) { 
				$this->error = 'El nombre ingresado es inválido'; 
			} elseif(!preg_match('/([a-zA-Z])/', $lastname)) { 
				$this->error = 'El apellido ingresado es inválido'; 
			} elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) { 
				$this->error = 'El email ingresado es inválido'; 
			} elseif($password !== $passwordConfirm) { 
				$this->error = 'Las contraseñas no coinciden.'; 
			} elseif($email !== $emailConfirm) { 
				$this->error = 'Los email no coinciden.'; 
			}
			if ($this->error=="") { 
				$stmt = $db->prepare("INSERT INTO users(id,username,name,lastname,password,email,regdate,rank) VALUES (null,:username,:name,:lastname,:password,:email,:regdate,1)"); 
				$stmt->bindParam("username", $username,PDO::PARAM_STR); 
				$stmt->bindParam("name", $name,PDO::PARAM_STR); 
				$stmt->bindParam("lastname", $lastname,PDO::PARAM_STR); 
				$password = hash('sha256', $password); 
				$stmt->bindParam("password", $password,PDO::PARAM_STR); 
				$stmt->bindParam("email", $email,PDO::PARAM_STR); 
				$date = date('Y-m-d H:i:s'); 
				$stmt->bindParam('regdate', $date, PDO::PARAM_STR); 
				$stmt->execute(); 

				$_SESSION['id']=$db->lastInsertId();
				$db = '';
			} else { 
				$db = ''; 
			}
		}
		catch(PDOException $e) {
			echo '{"error":{"text":'. $e->getMessage() .'}}';
		}
	}

	public function details($id){ 
		$db = $this->start(); 

		$stmt = $db->prepare("SELECT * FROM users WHERE id=:id"); 
		$stmt->bindParam("id", $id,PDO::PARAM_INT); 
		$stmt->execute(); 

		$data = $stmt->fetch(PDO::FETCH_OBJ); 
		$db = ''; 
		return $data; 
	}

	public function my(){ 
		if(isset($_SESSION['id']) && !empty($_SESSION['id'])){ 
			$db = $this->start(); 

			$stmt = $db->prepare("SELECT * FROM users WHERE id=:id"); 
			$stmt->bindParam("id", $_SESSION['id'],PDO::PARAM_INT); 
			$stmt->execute(); 

			$data = $stmt->fetch(PDO::FETCH_OBJ); 
			$db = ''; 
			return $data; 
		}
	}
	public function status(){ 
		if(isset($_SESSION['id']) && !empty($_SESSION['id'])){ 
			return true;
		} else {
			return false;
		}
	}
}

?>