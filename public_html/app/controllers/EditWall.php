<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/user.php';

class EditWall extends Controller{


	public function __construct(){
		

	}

	public function post() {
		$user = new user();

		/* reading info about file */
		$target = "static/images/walls/";
		#$upfile = $target . basename( $_FILES['profilePicture']['name']); // if required
		$size   = basename( $_FILES['profilePicture']['size']);
		$size   = (int)($size / 1024);  // size is in kB now
		$type   = basename( $_FILES['profilePicture']['type']);
		$tmpName = $_FILES['profilePicture']['tmp_name'];

		$maxSize = 20*1024;  //20MB

		/* If you want to allow more formats, just put them in this array */
		$allowedFormats = array('jpeg', 'gif', 'png'); 

		if(!in_array($type, $allowedFormats))
		{
			$data = ["message" => "Wrong picture format. Only JPG, GIF and PNG are supported."];
			$this->render("error.view.php", $data);
			return;
		}

		if($size > $maxSize)
		{
			$data = ["message" => "File is too big. Max size: {$maxSize} kB."];
			$this->render("error.view.php", $data);
			return;
		}		

		$fname = rand(100000,900000).$_SESSION['userid'].".png";
		$destination = $target.$fname;
		
		move_uploaded_file($tmpName, $destination);

		$thumb = new Imagick($destination);

		$thumb->resizeImage(500, 150, Imagick::FILTER_LANCZOS, 1);
		$thumb->writeImage($target."thumb_".$fname);

		/* delete old profile picture before uploading new one */
		$info = $user->getUserInfoFromUserID($_SESSION['userid']);
		$avatar = $info['wall_pic'];
		if(file_exists($avatar)){
			$unlink1 = $avatar;
			unlink($unlink1);
			$ex = explode("/", $avatar);

			$thumb = $ex[0]."/".$ex[1]."/".$ex[2]."/"."thumb_".$ex[3];
			$unlink2 = $thumb;
			unlink($unlink2);
		}


		$data = ["wall_pic" => $destination];
		$user->updateUser($_SESSION['userid'], $data);

		$data = ["message" => "Your profile picture has been changed successfully."];
		$this->render("information.view.php", $data);
		return;


	}

	public function get() {

	}



}