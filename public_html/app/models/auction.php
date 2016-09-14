<?php
require_once 'Model.php';

class auction extends Model{
	var $table = "Auctions";
	var $prefix = "";

	/* construction and helper functions */
	public function __construct() {

	}

	public function addAuction($data){
		$this->orm("insert")->
				table($this->table)->
				insert($data)->
				commit();
	}

	public function getAuctionsByUserID($uid){
		$sql = "SELECT * FROM Auctions WHERE Submissions_Users_id = '{$uid}';";
		$ret = $this->sqlRaw($sql)->fetachArray();
		return $ret;
	}

	public function getAuctionInfo($aid){
		$ret = $this->orm("select")->
				selectAll()->
				table($this->table)->
				where("auction_id", "=", $aid)->
				limit(1)->
				fetchRow();

		return $ret;

	}

	public function getAuctionsInfoBySubmission_id($sid){
		$ret = $this->orm("select")->
				selectAll()->
				table($this->table)->
				where("Submissions_id", "=", $sid)->
				fetchArray();

		return $ret;

	}

	public function reduceQuantity($aid){
		$sql = "UPDATE Auctions SET quantity = quantity - 1 WHERE auction_id = '{$aid}' LIMIT 1;";
		$this->sqlRaw($sql)->commit();

		$qty = $this->getAuctionInfo($aid)["quantity"];
		if($qty < 1){
			$this->closeAuction($aid);
		}
	}


	public function closeAuction($aid){
		$sql = "UPDATE Auctions SET open = 0 WHERE auction_id = '{$aid}' LIMIT 1;";
		$this->sqlRaw($sql)->commit();
	}

	public function archive($aid){
		$sql = "UPDATE Auctions SET archived = 1 WHERE auction_id = '{$aid}' LIMIT 1;";
		$this->sqlRaw($sql)->commit();
	}

}