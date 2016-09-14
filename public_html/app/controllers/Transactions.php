<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/user.php';
require_once 'app/models/transaction.php';
require_once 'app/models/bid.php';

class Transactions extends Controller{


	public function __construct(){
		

	}

	public function post() 
	{

	}

	public function get() {
		$user = new user();
		$trs = new transaction();
		$bid = new bid();
		$input = Functions::input("GET");
		$username = $input["u"];
		$uid = $_SESSION['userid'];

		$soldData = [];
		$boughtData = [];
		$tmp = [];
		$tmps = [];

		/* SOLD */
		/* get auctions of user */
		$auctions = $trs->getClosedAuctionsAndBids($uid);
		foreach ($auctions as $auction) {
			if($auction['open'] == 1){
				continue;
			}

			/* check if current offer can top max offer */
				/* no current offer, so yes, we can top it */
				if(!array_key_exists($auction['aid'], $tmps) || !array_key_exists("amount", $tmps[$auction['aid']])){
					/* temporary data */
					$tmp = ["name" => $auction["aname"], 
							"amount" => $auction["aamount"],
							"user" => $auction["uname"],
							"sid" => $auction["asid"],
							"thumb" => $auction['thumb']
							];
				} 

				/* let's check if we can top it */
				else {
					if($tmp["amount"] < $auction["aamount"]){
							$tmp = ["name" => $auction["aname"], 
							"amount" => $auction["aamount"],
							"user" => $auction["uname"],
							"sid" => $auction["asid"],
							"thumb" => $auction['thumb']
							];
					}
				}

				$tmps[$auction['aid']] = $tmp;
			/* get all info and store into dictionary: auctionID => [everything else] */
			$soldData[$auction['aid']] = $tmp;

		}


		/* BOUGHT */
		$tmp = [];
		$tmps = [];
		$auctions = $trs->getBoughtClosedAuctionsAndBids($_SESSION['userid']);
		foreach ($auctions as $auction) {
			if($auction['open'] == 1){
				continue;
			}

			/* check if current offer can top max offer */
				/* no current offer, so yes, we can top it */
				if(!array_key_exists($auction['aid'], $tmps) || !array_key_exists("amount", $tmps[$auction['aid']])){
					/* temporary data */
					$tmp = ["name" => $auction["aname"], 
							"amount" => $auction["aamount"],
							"user" => $auction["uname"],
							"sid" => $auction["asid"],
							"thumb" => $auction['thumb']
							];
				} 

				/* let's check if we can top it */
				else {
					if($tmp["amount"] < $auction["aamount"]){
							$tmp = ["name" => $auction["aname"], 
							"amount" => $auction["aamount"],
							"user" => $auction["uname"],
							"sid" => $auction["asid"],
							"thumb" => $auction['thumb']
							];
					}
				}

				$tmps[$auction['aid']] = $tmp;
			/* get all info and store into dictionary: auctionID => [everything else] */
			$boughtData[$auction['aid']] = $tmp;

		}		

		$data = ["username" => $username,
				"trans" => $soldData,
				"transB" => $boughtData,
				"u" => $username];
		
		$this->render("transactions.view.php", $data);
	}



}