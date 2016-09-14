<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/message.php';

class PostMessage extends Controller{


	public function __construct(){
		

	}

	public function post() {
		$msg = new message();

		$input = Functions::input("POST");
		$u = $input["u"];
		$c = $input["cid"];
		$message = $input["message"];

		if(strlen($message) > 500){
			$data = ["message" => "Your message is too long."];
			$this->render("error.view.php", $data);
			return;

		}

		$returnTo = Functions::internalLink("conversation/u/".$u."/c/".$c."/");

		$data = ["text" => $message, 
				"Messages_Users_id" => $_SESSION['userid'],
				"Conversations_id" => $c,
				];

		$msg->addMessage($data);


		Functions::redirect($returnTo);
	}

	public function get() {

	}



}