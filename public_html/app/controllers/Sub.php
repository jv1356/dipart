<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/submission.php';
require_once 'app/models/user.php';
require_once 'app/models/submissionTag.php';
require_once 'app/models/bid.php';
require_once 'app/models/auction.php';
require_once 'app/models/favourites.php';
require_once 'lib/Time.php';
require_once 'app/models/comment.php';

class Sub extends Controller{


	public function __construct(){
		

	}

	public function post() {

	}

	public function get() {
		$input = Functions::input("GET");
		$u = $input["u"];
		$s = $input["s"];

		if(empty($u) || empty($s)){
			$data = ["message" => "Something is wrong."];
			$this->render("error.view.php", $data);
			return;

		}

		$subm = new submission();
		$user = new user();
		$stag = new submissionTag();
		$bid = new bid();
		$comm = new comment();
		$auc = new auction();
		$fav = new favourites();

		$sub = $subm->getSubmissionInfo($s);
		$info = $user->getUserInfoFromUsername($u);
		$uid = $info['id'];
		$tags = [];
		$sid = $s;
		$currBids = [];

		/* update how many times submission has been viewed */
		$subm->increaseViews($sid);

		/* prepare data for the view */

		foreach ($sub as $s) {
			
			/* image info */
			$title = $s['title'];
			$desc = $s['description'];
			$type = $s['type'];
			$cat  = $s['category'];
			$floc = $s['file_location'];
			$tloc = $s['thumb_location'];
			$originalPoster = $s['Users_id'];
			$created = $s['created'];
			$numViews = $s['numViews'];

			/* auction info */
			$aname = $s['name'];
			$apric = $s['price'];

			$curbid = max($apric, $bid->maxCurrentBid($s['auction_id']));
			$currBids[$s['auction_id']] = $curbid;

			/* tags info */
			array_push($tags, $s['Tag_name']);
		}

		//var_dump($currBids);
		//exit();
		$tags = array_unique($tags);


		/* get auctions info */
		$auctions = $auc->getAuctionsInfoBySubmission_id($sid);

		/* random submissions */
		$rs = $subm->randomSubmissions($originalPoster, $limit = 6);

		/* similar tag submissions */
		$srs = $stag->getRandomSubmissionIDsFromTagNames(implode(",", $tags), $sid, $title, $limit = 6, $spaceReg = true);

		/* get original poster username */
		$originalPoster = $user->getUserInfoFromUserID($originalPoster)["name"];

		/* get comments for this submission */
		$comments = $comm->getCommentsFromSubmissionID($sid);

		list($width, $height) = getimagesize($floc);
		$size = round(filesize($floc)/1024);  // size in kB
		$units = "kB";
		if($size > 1024){
			$size = number_format($size/1024, 2);
			$units = "MB";
		}

		/* check if favourite */
		$isFav = $fav->isFavourite($_SESSION['userid'], $sid);
		if($isFav){
			$favourite = "<a href='/removeFavourite/u/{$u}/s/{$sid}/'><img src='/static/images/star_full.png' style='height:25px;'/></a>";
		}else{
			$favourite = "<a href='/addFavourite/u/{$u}/s/{$sid}/'><img src='/static/images/star.png' style='height:25px;'/></a>";
		}
		$data = ["title" => $title,
				"desc" => $desc,
				"type" => $type,
				"cat" => $cat,
				"floc" => $floc,
				"tloc" => $tloc,
				"auctions" => $auctions,
				"tags" => $tags,
				"rs" => $rs,
				"srs" => $srs,
				"u" => $u,
				"sid" => $sid,
				"op" => $originalPoster,
				"comments" => $comments,
				"height" => $height,
				"width" => $width,
				"size" => $size,
				"units" => $units,
				"created" => $created,
				"currBids" => $currBids,
				"numViews" => $numViews,
				"favourite" => $favourite];

		$this->render("sub.view.php", $data);
	}



}