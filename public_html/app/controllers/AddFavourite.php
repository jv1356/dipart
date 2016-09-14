<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/submission.php';
require_once 'app/models/user.php';
require_once 'app/models/favourites.php';

class AddFavourite extends Controller{


	public function __construct(){
		

	}

	public function post() {

	}

	public function get() {
		$input = Functions::input("GET");
		$u = $input["u"];
		$s = $input["s"];

		if(empty($u) || empty($s)){
			$data = ["message" => "Something is wrong."];
			$this->render("error.view.php", $data);
			return;

		}

		$subm = new submission();
		$fav = new favourites();

		$exists = $subm->exists($s);
		/* check if submission exists */
		if(!$exists){
			$data = ["message" => "Submission does not exist."];
			$this->render("error.view.php", $data);
			return;
		}

		/* add fav */
		$data = ["Users_id" => $_SESSION['userid'],
				"Submissions_id" => $s];
		$fav->addFavourite($data);

		/* redirect */
		$returnTo = Functions::internalLink("/sub/u/".$u."/s/".$s."/");
		Functions::redirect($returnTo);

	}



}