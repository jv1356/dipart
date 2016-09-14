<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/submissionTag.php';
require_once 'app/models/user.php';

class Feedback extends Controller{


	public function __construct(){
		

	}

	public function get() {
		$user = new user();

		$input = Functions::input("GET");
		$username = $input["u"];
		$info = $user->getUserInfoFromUsername($username);
		$uid = $info['id'];

		$data = [
				"user" => $username,
				"uid" => $uid
			];
		$this->render("feedback.view.php", $data);

	}

	public function post() {

	}



}