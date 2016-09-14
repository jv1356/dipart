<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/user.php';

class EditDescription extends Controller{


	public function __construct(){
		

	}

	public function post() {
		$user = new user();

		$input = Functions::input("POST");
		$journal = $input["journal"];

		/* check length*/
		if(strlen($journal) > 5000){
			$data = ["message" => "Description is too long."];
			$this->render("error.view.php", $data);
			return;
		}

		$data = ["description" => $journal];

		$user->updateUser($_SESSION['userid'], $data);

		$data = ["message" => "Your description has been updated."];
		$this->render("information.view.php", $data);
		return;	


	}

	public function get() {
	}



}