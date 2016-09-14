<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/bid.php';
require_once 'app/models/user.php';
require_once 'app/models/auction.php';

class BidSub extends Controller{


	public function __construct(){
		

	}

	public function get() {

	}

	public function post() {
		$bd   = new bid();
		$user = new user();
		$auc  = new auction();
		$input = Functions::input("POST");
		
		$bid = $input["yourBid"];
		$aid = $input["auctionID"];

		$auctionInfo = $auc->getAuctionInfo($aid);

		/* check hacking attempts */
		if(!is_numeric($bid) || $bid < 0){
			$data = ["message" => "This bid is far from valid."];
			$this->render("error.view.php", $data);
			return;			
		}

		/* check if bid is valid */
		$maxCurrentBid = $bd->maxCurrentBid($aid);
		$minimumAllowed = $maxCurrentBid+$auctionInfo['increase'];

		if($bid < $minimumAllowed){
			$data = ["message" => "This bid is not valid (too small)."];
			$this->render("error.view.php", $data);
			return;			
		}

		/* check if auction is still open */
		if(time() > $auctionInfo['end_date'] || $auctionInfo['open'] == 0){
			$data = ["message" => "This auction has expired or it's closed."];
			$this->render("error.view.php", $data);
			return;								
		}

		/* it's ok, let's bid */
		$data = ["Auctions_id" => $aid,
				"amount" => $bid,
				"Users_id" => $_SESSION['userid']
				];

		$bd->addBid($data);

		$data = ["message" => "You have placed your bid successfully."];
		$this->render("information.view.php", $data);
		return;
	}



}