<?php

require_once 'Controller.php';
require_once 'core/Functions.php';
require_once 'app/models/submission.php';
require_once 'app/models/user.php';
require_once 'lib/Time.php';

class Commissions extends Controller{


	public function __construct(){
		

	}

	public function post() {

	}

	public function get() {
		global $_http, $_Domain;
		$subm = new submission();
		$user = new user();
		$input = Functions::input("GET");
		$username = $input["u"];
		$info = $user->getUserInfoFromUsername($username);
		$coms = $subm->usersCommissions($info['id']);

		/* prepare dictionary   submission_id => [ auctions info, auctions info, ...] */
		$commitions = [];
		$descs = [];
		$titles = [];
		$thumbs = [];
		foreach ($coms as $com) {
			$sid = $com['Submissions_id'];
			$tloc = $_http.$_Domain."/".$com['thumb_location'];
			//$tloc = "/".$com['thumb_location'];

			$descs[$sid] = $com['description'];
			$titles[$sid] = $com['title'];
			$thumbs[$sid] = $tloc;

			if(!array_key_exists($sid, $commitions)){
				$commitions[$sid] = [];
			}
			$auction = [];

			$auction["aid"]= $com['auction_id'];
			$auction["aname"] = $com['name'];
			$auction["aqty"] = $com['quantity'];
			$auction["abuy"] = $com['autobuy'];
			$auction["aend"] = $com['end_date'];

			array_push($commitions[$sid], $auction);

		}

		$data = ["coms" => $commitions,
				"descs" => $descs,
				"thumbs" => $thumbs,
				"titles" => $titles,
				"u" => $username];

		$this->render("commissions.view.php", $data);
	}



}