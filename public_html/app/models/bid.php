<?php
require_once 'Model.php';

class bid extends Model{
	var $table = "Bidds";
	var $prefix = "";

	/* construction and helper functions */
	public function __construct() {

	}

	public function addBid($data){
		/* inserts tag and returns ID of tag */
		$mod = new Model();
		$mod->orm("insert")->
				table($this->table)->
				insert($data)->
				commit();
	}


	public function maxCurrentBid($auctionID){
		
		$sql = "SELECT MAX(amount) FROM Bidds WHERE Auctions_id = '{$auctionID}' LIMIT 1;";
		$ret = $this->sqlRaw($sql)->
				fetchSingle();

		return $ret;
	}

}