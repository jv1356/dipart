<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/user.php';
require_once 'app/models/message.php';

class NewMessage extends Controller{


	public function __construct(){
		

	}

	public function post() {
		$user = new user();
		$msg = new message();
		$input = Functions::input("POST");
		$u = $input["u"];
		$receiver = $input['receiver'];
		$text = $input["message"];
		$gname = $input['group_name'];

		/* check if receiver exists */
			$exists = $user->userExists($receiver);
			if(!$exists)
			{
				$data = ["message" => "Receiver does not exist."];
				$this->render("error.view.php", $data);
				return;
			}

		/* check length */
			if(strlen($text) > 500)
			{
				$data = ["message" => "Message is too long."];
				$this->render("error.view.php", $data);
				return;
			}

			$info = $user->getUserInfoFromUsername($receiver);
			$rid = $info['id'];


		/* insert conversation */
		$data = ["group_name" => $gname,
				"createdByUserID" => $_SESSION['userid']];
		$msg->insertConversation($data);

		/* get ID of inserted conversation */
		$cid = $msg->getLastConversationID($_SESSION['userid'], $gname);

		/* insert into Conversation_users */
		$data = ["Conversations_id" => $cid,
				"Users_id" => $_SESSION['userid']];
		$msg->addConversationUsers($data);

		$data = ["Conversations_id" => $cid,
				"Users_id" => $rid];
		$msg->addConversationUsers($data);		

		/* insert message */ 
		$data = ["text" => $text,
				"Messages_Users_id" => $_SESSION['userid'],
				"Conversations_id" => $cid];
		$msg->addMessage($data);

		$returnTo = Functions::internalLink("conversation/u/".$u."/c/".$cid."/");
		Functions::redirect($returnTo);
	}

	public function get() {
		$input = Functions::input("GET");
		$username = $input["u"];

		$data = ["u" => $username];
		
		$this->render("newmessage.view.php", $data);
	}



}