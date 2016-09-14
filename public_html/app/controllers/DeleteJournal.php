<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/journal.php';

class DeleteJournal extends Controller{


	public function __construct(){
		

	}

	public function post() {
		
	}

	public function get() {
		$jour = new journal();
		$input = Functions::input("GET");
		$j = $input["j"];
		$journal = $jour->getJournalInfoFromJournalID($j);

		if($journal['Users_id'] != $_SESSION['userid']){
			$data = ["message" => "This is not your journal."];
			$this->render("error.view.php", $data);
			return;
		}


		$data = ["active" => 0];

		$jour->updateJournal($j, $data);
		
		$data = ["message" => "Journal has been deleted."];
		$this->render("information.view.php", $data);
		return;	
	}



}