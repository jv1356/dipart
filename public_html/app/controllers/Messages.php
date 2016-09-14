<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/user.php';
require_once 'app/models/message.php';

class Messages extends Controller{


	public function __construct(){
		

	}

	public function post() {

	}

	public function get() {
		$user = new user();
		$msg = new message();
		$input = Functions::input("GET");
		$username = $input["u"];
		$info = $user->getUserInfoFromUsername($username);
		$messages = $msg->getMessageGroups($_SESSION['userid']);

		$data = ["username" => $info['name'],
				"msgs" => $messages];
		
		$this->render("messages.view.php", $data);
	}



}