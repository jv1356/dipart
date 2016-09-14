<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/bid.php';
require_once 'app/models/user.php';
require_once 'app/models/auction.php';

class ArchiveAuction extends Controller{


	public function __construct(){
		

	}

	public function get() {
		$auc  = new auction();
		$input = Functions::input("GET");
		$aid = $input["a"];
		$u = $input["u"];
		$auctionInfo = $auc->getAuctionInfo($aid);

		/* check ownership */
		if($_SESSION['userid'] != $auctionInfo['Submissions_Users_id']){
			$data = ["message" => "This is not your auction."];
			$this->render("error.view.php", $data);
			return;			
		}

		$auc->archive($aid);
		
		$data = ["message" => "Auction has been archived."];
		$this->render("information.view.php", $data);
		return;

	}

	public function post() {

	}



}