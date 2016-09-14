<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/user.php';
require_once 'app/models/submission.php';
require_once 'app/models/favourites.php';
require_once 'lib/BBCode.php';

class Profile extends Controller{


	public function __construct(){
		

	}

	public function post() {

	}

	public function get() {
		$user = new user();
		$subm = new submission();
		$fav = new favourites();
		$input = Functions::input("GET");
		$username = $input["u"];
		$info = $user->getUserInfoFromUsername($username);
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

		$subs = $subm->latestSubmissions($info['id'], $limit = 9);

		/* get favourites */
		$favs = $fav->usersFavourites($info['id']);

		$data = ["username" => $info['name'],
				"email" => $info['email'],
				"avatar" => $avatar,
				"wall" => $wall,
				"thumb" => $thumb,
				"thumbW" => $thumbW,
				"sex" => $info['sex'],
				"age" => $info['age'],
				"description" => BBCode::code2text($info['description']),
				"uid" => $info['id'],
				"subs" => $subs,
				"favs" => $favs];
		$this->render("profile.view.php", $data);
	}



}