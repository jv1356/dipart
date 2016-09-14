<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/submission.php';
require_once 'app/models/user.php';

class UserGallery extends Controller{


	public function __construct(){
		

	}

	public function post() {

	}

	public function get() {
		$subm = new submission();
		$user = new user();
		$input = Functions::input("GET");
		$username = $input["u"];
		$info = $user->getUserInfoFromUsername($username);
		$subs = $subm->usersSubmissions($info['id']);

		$popular = $subm->mostPopularSubmission($info['id']);
		$data = ["subs" => $subs,
				"popular" => $popular];
		$this->render("userGallery.view.php", $data);
	}



}