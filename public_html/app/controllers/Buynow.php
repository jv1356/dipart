<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/submission.php';
require_once 'app/models/user.php';
require_once 'app/models/auction.php';
require_once 'app/models/updates.php';

class Buynow extends Controller{


	public function __construct(){
		

	}

	public function post() {

	}

	public function get() {
		global $_http, $_Domain;
		$subm = new submission();
		$user = new user();
		$auc = new auction();
		$upd = new updates();
		$input = Functions::input("GET");

		$username = $input["u"];
		$aid = $input["a"];

		$info = $user->getUserInfoFromUsername($username);
		$ainfo = $auc->getAuctionInfo($aid);
		$sinfo = $subm->submissionInfo($ainfo['Submissions_id']);

		/* check if opened */
		if($ainfo['open'] != 1){
			$data = ["message" => "This commission is not opened."];
			$this->render("error.view.php", $data);
			return;
		}

		/* check if expired */
		if($ainfo['end_date'] < time()){
			$data = ["message" => "This commission has expired."];
			$this->render("error.view.php", $data);
			return;
		}

		/* check if out of stock */
		if($ainfo['quantity'] < 1){
			$data = ["message" => "Out of stock."];
			$this->render("error.view.php", $data);
			return;
		}

		/* reduce quantity */
		$auc->reduceQuantity($aid);  // function also closes auction if item gets out of stock

		/* insert into updates */
		$data = ["thumb_location" => $sinfo['thumb_location'],
				"file_location" => $sinfo['file_location'],
				"Auctions_id" => $aid,
				"Users_id" => $info['id']];
		$upd->addAUpdate($data);

		$data = ["message" => "You have bought this commission."];
		$this->render("information.view.php", $data);
		return;

	}



}