<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/journal.php';
require_once 'app/models/user.php';
require_once 'app/models/comment.php';
require_once 'lib/BBCode.php';

class Journals extends Controller{


	public function __construct(){
		

	}

	public function post() {

	}

	public function get() {
		$user = new user();
		$jour = new journal();
		$comm = new comment();

		$input = Functions::input("GET");
		$username = $input["u"];
		$info = $user->getUserInfoFromUsername($username);
		$uid = $info['id'];
		$numberOfJournals = $jour->countActiveByUserID($uid);
		$journals = $jour->getJournalsFromUserID($uid);

		if(isset($_GET['j'])){
			$latest = $jour->getJournalInfoFromJournalID($input["j"]);
		}
		else {
			$latest = $journals[0];
		}

		if($numberOfJournals > 0 && $latest['active'] == 0){
			$data = ["message" => "This journal has been deleted."];
			$this->render("error.view.php", $data);
			return;
		}
		
		$lid = $latest['id'];
		$comments = $comm->getCommentsFromJournalID($lid);
		$ltext = $latest['text'];

		$data = ["journals" => $journals,
				"latest" => $latest,
				"ltext" => BBCode::code2text($ltext), 
				"user" => $username,
				"uid" => $uid,
				"comments" => $comments,
				"numJournals" => $numberOfJournals];
		$this->render("journals.view.php", $data);
	}



}