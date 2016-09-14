<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/user.php';

class Settings extends Controller{


	public function __construct(){
		

	}

	public function post() {

	}

	public function get() {
		$user = new user();
		$info = $user->getUserInfoFromUserID($_SESSION['userid']);
		$avatar = "/".$info['avatar'];
		$wall = "/".$info['wall_pic'];

		$ex = explode("/", $avatar);
		$exW = explode("/", $wall);

		$thumb = $ex[0]."/".$ex[1]."/".$ex[2]."/".$ex[3]."/thumb_".$ex[4];
		$thumbW = $exW[0]."/".$exW[1]."/".$exW[2]."/".$exW[3]."/thumb_".$exW[4];


		if(empty($info['avatar'])){
			$thumb = "https://placeholdit.imgix.net/~text?txtsize=8&txt=ProfilePic2&w=150&h=150";
			$avatar = "#";
		}

		if(empty($info['wall_pic'])){
			$thumbW = "https://placeholdit.imgix.net/~text?txtsize=18&txt=WALL_PICTURE&w=550&h=150";
			$wall = "#";
		}		

		$data = ["username" => $info['name'],
				"email" => $info['email'],
				"age" => $info['age'],
				"sex" => $info['sex'],
				"description" => $info['description'],
				"thumb" => $thumb,
				"thumbW" => $thumbW];
		$this->render("settings.view.php", $data);
	}



}