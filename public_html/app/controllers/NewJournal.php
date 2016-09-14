<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/journal.php';
require_once 'app/models/user.php';
require_once 'app/models/comment.php';

class NewJournal extends Controller{


	public function __construct(){
		

	}

	public function post() {
		$jour = new journal();
		$input = Functions::input("POST");
		$journal = $input["journal"];
		$title = $input["title"];

		/* check length*/
		if(strlen($journal) > 50000){
			$data = ["message" => "Journal is too long."];
			$this->render("error.view.php", $data);
			return;
		}

		$data = ["text" => $journal,
				"title" => $title,
				"Users_id" => $_SESSION['userid']];

		$jour->addJournal($data);

		$data = ["message" => "Your journal has been updated."];
		$this->render("information.view.php", $data);
		return;	
	}

	public function get() {
		$user = new user();
		$jour = new journal();

		$input = Functions::input("GET");
		$username = $input["u"];
		$info = $user->getUserInfoFromUsername($username);
		$uid = $info['id'];


		$data = ["user" => $username,
				"uid" => $uid];

		$this->render("newJournal.view.php", $data);
	}



}