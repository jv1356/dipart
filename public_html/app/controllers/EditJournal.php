<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/journal.php';
require_once 'app/models/user.php';
require_once 'app/models/comment.php';

class EditJournal extends Controller{


	public function __construct(){
		

	}

	public function post() {
		$jour = new journal();
		$input = Functions::input("POST");
		$j = $input["jid"];
		$text = $input["journal"];
		$title = $input["title"];

		$journal = $jour->getJournalInfoFromJournalID($j);

		if($journal['Users_id'] != $_SESSION['userid']){
			$data = ["message" => "This is not your journal."];
			$this->render("error.view.php", $data);
			return;
		}
		/* check length*/
		if(strlen($text) > 50000){
			$data = ["message" => "Journal is too long."];
			$this->render("error.view.php", $data);
			return;
		}

		$data = ["text" => $text,
				"title" => $title];

		$jour->updateJournal($j, $data);

		$data = ["message" => "Your journal has been updated."];
		$this->render("information.view.php", $data);
		return;	
	}

	public function get() {
		$user = new user();
		$jour = new journal();

		$input = Functions::input("GET");
		$username = $input["u"];
		$j = $input["j"];
		$journal = $jour->getJournalInfoFromJournalID($j);

		if($journal['Users_id'] != $_SESSION['userid']){
			$data = ["message" => "This is not your journal."];
			$this->render("error.view.php", $data);
			return;
		}
		$info = $user->getUserInfoFromUsername($username);
		$uid = $info['id'];


		$data = ["user" => $username,
				"uid" => $uid,
				"journal" => $journal];

		$this->render("editJournal.view.php", $data);
	}



}