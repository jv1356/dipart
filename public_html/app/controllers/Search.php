<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/submissionTag.php';
require_once 'app/models/user.php';

class Search extends Controller{


	public function __construct(){
		

	}

	public function get() {

	}

	public function post() {
		$subm = new submissionTag();
		$user = new user();
		$input = Functions::input("POST");
		
		$tags = $input["search"];
		$tags = trim($tags);

		/* check if searching for user */
		$ex = explode(" ", $tags);
		if($ex[0] == "user:"){
			$username = str_replace("user: ", "", $tags);
			if($user->userExists($username)){
				Functions::redirect("/profile/u/{$username}/");
			} else {
				$data = ["message" => "This user does not exist."];
				$this->render("error.view.php", $data);
				return;
			}
		}

		/* if not, then it must be search for tags :) */
		$subs = $subm->getSubmissionIDsFromTagNames($tags);

		$data = ["subs" => $subs];
		$this->render("search.view.php", $data);
	}



}