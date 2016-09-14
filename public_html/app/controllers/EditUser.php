<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/user.php';

class EditUser extends Controller{


	public function __construct(){
		

	}

	public function post() {
		$user = new user();
		$info = $user->getUserInfoFromUserID($_SESSION['userid']);
		$input = Functions::input("POST");
		$email = $input["email"];
		$sex = $input["sex"];
		$age = $input["age"];

		/* check if email is available */
		$emailExists = $user->valueExists("email", $email);
		if($email != $info['email'] && $emailExists){
			$data = ["message" => "Email is not available."];
			$this->render("error.view.php", $data);
			return;
		}

		/* check if sex is ok */
		$okSex = ["Male", "Female", "Shemale", "Not-Disclosed", "Pablo Van Gough", "What ever you pay me to be", "Gender Fluid"];
		if(!in_array($sex, $okSex)){
			$data = ["message" => "Selected sex is not valid."];
			$this->render("error.view.php", $data);
			return;
		}

		/* check if age is legit */
		if(!is_numeric($age) || $age < 0 || $age > 130){
			$data = ["message" => "Invalid age."];
			$this->render("error.view.php", $data);
			return;			
		}

		$data = ["email" => $email,
				"sex" => $sex,
				"age" => $age];

		$user->updateUser($_SESSION['userid'], $data);

		$data = ["message" => "Your profile has been updated."];
		$this->render("information.view.php", $data);
		return;	


	}

	public function get() {
	}



}