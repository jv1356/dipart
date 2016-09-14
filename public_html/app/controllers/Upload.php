<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/submission.php';
require_once 'app/models/tag.php';
require_once 'app/models/submissionTag.php';
require_once 'app/models/auction.php';

class Upload extends Controller{


	public function __construct(){
		

	}

	public function post() {
		$post = Functions::input("POST");
		$subm = new submission();
		$tg = new tag();
		$subTag = new submissionTag();
		$auc = new auction();

		$addData = [];

		$title = $post["title"];
		$description = $post["description"];
		$tags = $post["tags"];
		$sType = $post["type"];
		$category = $post["category"];
		$nsfw = $post["nsfw"];
		$isAuction = 0;
		$auctionType = $post["auctionType"];

		if($auctionType == "auction"){
			$isAuction = 1;
		}

		/* upload file */
		$target = "static/images/submissions/";
		$size   = basename( $_FILES['picture']['size']);
		$size   = (int)($size / 1024);  // size is in kB now
		$type   = basename( $_FILES['picture']['type']);
		$tmpName = $_FILES['picture']['tmp_name'];
		
		list($width, $height) = getimagesize($tmpName);
		$ratio = $width/$height;

		$maxSize = 50*1024;  //50MB

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

		$fname = rand(100,999)."s".rand(100000,900000).$_SESSION['userid'].".png";
		$destination = $target.$fname;
		
		move_uploaded_file($tmpName, $destination);

		/* prepare thumb and upload it */
		$thumbHeight = 250;
		$hR = $height/$thumbHeight;
		$nWidth = $width/$hR;

		$thumbDestination = $target."thumb_".$fname;
		$thumb = new Imagick($destination);
		$thumb->resizeImage($nWidth, $thumbHeight, Imagick::FILTER_LANCZOS, 1);
		$thumb->writeImage($thumbDestination);

		/* add to DB */
			/* insert into submissions */
			$data = ["title" => $title,
					"description" => $description,
					"type" => $sType,
					"category" => $category,
					"nsfw" => $nsfw,
					"file_location" => $destination,
					"thumb_location" => $thumbDestination,
					"auction" => $isAuction,
					"Users_id" => $_SESSION['userid']];
			
			/* get id of added submission */
			$submissionID = $subm->addSubmission($data, $_SESSION['userid']);

			/* add tags */
			$tags = explode(",", $tags);

			foreach ($tags as $tagName) {
				$tagName = trim($tagName);
				/* check if tag exists */
				$exists = $tg->exists($tagName);
				
				/* if it exists get ID*/
				if($exists){
					$tagID = $tg->getTagID($tagName);
				}
				else{
					$tagID = $tg->addTag(["Tag_name" => $tagName]);
				}

				/* add relation submissions_tags*/
				$tmpData = ["Submissions_id" => $submissionID,
							"Submissions_Users_id" => $_SESSION['userid'],
							"Tags_id" => $tagID];
				$subTag->addSubTag($tmpData);

			}


			/* add to Auctions */
			if($auctionType == "buy_now"){
				$data = ["name" => $title,
						"quantity" => $post["quantity"],
						"price" => $post["price"],
						"Submissions_id" => $submissionID,
						"Submissions_Users_id" => $_SESSION['userid']];
				$auc->addAuction($data);
			}


			if($auctionType == "auction"){

				/* iterate through auction slots */
				$stillExist = true;
				$counter = 1;
				while($stillExist){
					$slotName = "slotName".$counter;
					if(!isset($_POST[$slotName])){
						$stillExist = false;
						break;
					}

					$name = $post[$slotName];
					$startPrice = "startPrice".$counter;
					$minInc = "minimumIncrement".$counter;
					$autoBuy = "autobuy".$counter;
					$duration = "duration".$counter;

					$data = ["name" => $name,
						"price" => $post[$startPrice],
						"increase" => $post[$minInc],
						"autobuy" => $post[$autoBuy],
						"Submissions_id" => $submissionID,
						"Submissions_Users_id" => $_SESSION['userid'],
						"end_date" => ($post[$duration]*86400)+time()];
					$auc->addAuction($data);

					$counter += 1;
				}
			}


			$data = ["message" => "Picture is uploaded."];
			$this->render("information.view.php", $data);
			return;


	}

	public function get() {
		$subm = new submission();
		$submissions = $subm->latestSubmissions($_SESSION['userid']);
		$data = ["latestSubmissions" => $submissions];
		$this->render("upload.view.php", $data);
	}



}