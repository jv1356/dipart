<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/comment.php';

class PostComment extends Controller{


	public function __construct(){
		

	}

	public function post() {
		$comm = new comment();

		$input = Functions::input("POST");
		$u = $input["u"];
		$j = $input["jid"];
		$s = $input["sid"];
		$comment = $input["comment"];

		if(strlen($comment) > 250){
			$data = ["message" => "Your comment is too long."];
			$this->render("error.view.php", $data);
			return;

		}

		if(isset($_POST['jid'])){
			$returnTo = Functions::internalLink("journals/u/".$u."/j/".$j."/");

			$data = ["text" => $comment, 
					"Users_id" => $_SESSION['userid'],
					"Journals_id" => $j,
					"active" => 1];
		}

		if(isset($_POST['sid'])){
			$returnTo = Functions::internalLink("sub/u/".$u."/s/".$s."/");

			$data = ["text" => $comment, 
					"Users_id" => $_SESSION['userid'],
					"Submissions_id" => $s,
					"active" => 1];
		}		

		$comm->addComment($data);

		Functions::redirect($returnTo);
	}

	public function get() {

	}



}