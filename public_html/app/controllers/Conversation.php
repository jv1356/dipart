<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/user.php';
require_once 'app/models/message.php';

class Conversation extends Controller{


	public function __construct(){
		

	}

	public function post() {

	}

	public function get() {
		$user = new user();
		$msg = new message();
		$input = Functions::input("GET");
		$username = $input["u"];
		$cid = $input["c"];
		$info = $user->getUserInfoFromUsername($username);
		
		/* check if user is in this conversation */
		$isParticipant = $msg->isParticipant($_SESSION['userid'], $cid);
		if(!$isParticipant)
		{
			$data = ["message" => "You are not participant of this conversation."];
			$this->render("error.view.php", $data);
			return;
		}

		$chats = $msg->getMessages($cid);

		/* mark as read */
		$msg->markRead($cid, $_SESSION['userid']);

		$messages = $msg->getMessageGroups($_SESSION['userid']);
		$data = ["username" => $info['name'],
				"msgs" => $messages,
				"chats" => $chats,
				"cid" => $cid, 
				"u" => $username];
		
		$this->render("conversation.view.php", $data);
	}



}