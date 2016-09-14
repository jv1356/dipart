<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/user.php';
require_once 'app/models/submission.php';
require_once 'app/models/log.php';

class Login extends Controller{


	public function __construct(){
		

	}

	public function post() {
		$input = Functions::input("POST");
		$user = new user();
		$log = new log();

		$username = $input["username"];
		$pwd = $input["pwd"];

		/* login button pressed */
		if(isset($_POST['login'])){

			$exists = $user->userExists($username);

			if(!$exists){
				$data = ["message" => "This account does not exist."];
				$this->render("error.view.php", $data);
				return;
			}

			$info = $user->getUserInfoFromUsername($username);
			$hash = $info['password'];
			$salt = $info['salt'];
			$hashed = Functions::hashing($pwd.$salt);

			if($hashed != $hash){
				$data = ["message" => "Wrong username or password."];
				$this->render("error.view.php", $data);
				return;
			}

			$IP = Functions::getClientIP();
			$data = ["IP" => $IP,
					"Users_id" => $info['id']];
			$log->addLog($data);
			
			$_SESSION['loggedin'] = true;
			$_SESSION['userid'] = $info['id'];
			$_SESSION['filter'] = "SFW";
			Functions::redirect("/");
		}

		/* register button pressed */
		elseif(isset($_POST['register'])){
			$repwd = $input['repwd'];
			$email = $input['email'];

			/* check credentials */
				/* check if username or email is already taken */
				$usernameExists = $user->valueExists("name", $username);
				$emailExists = $user->valueExists("email", $username);
				$allow = true;
				$error = "";
				
				if($usernameExists){
					$allow = false;
					$error .= "This username is already taken.<br>";
				}

				if($emailExists){
					$allow = false;
					$error .= "This email is already taken.<br>";
				}

				/* check if passwords match */
				if($pwd != $repwd){
					$allow = false;
					$error .= "Password fields don't match.<br>";
				}

				/* if something went wrong, show error */
				if(!$allow){
					$data = ["message" => $error];
					$this->render("error.view.php", $data);
					return;
				}

			/* if all ok, confirm registration */
				/* generate salt */
				$rand = rand(1, 1000000000);
				$salt = sha1($rand);

				$hashed = Functions::hashing($pwd.$salt);
				/* prepare data to be inserted in DB */
				$data = ["name" => $username,
						"password" => $hashed,
						"salt" => $salt,
						"email" => $email];

				$user->addUser($data);
				$data = ["message" => "You have registered successfully."];
				$this->render("information.view.php", $data);
				return;
		}

	}

	public function get() {
		if(!isset($_SESSION['loggedin'])){
			$this->render("login.view.php");
			return;
		}

		/* show latest submissions */
		$subm = new submission();

		$subs = $subm->latestSubmissionsOverall($limit = 30);
		$pop = $subm->mostPopularSubmissionOverAll();
		$data = ["subs" => $subs, "pop" => $pop];
		$this->render("home.view.php", $data);
	}



}