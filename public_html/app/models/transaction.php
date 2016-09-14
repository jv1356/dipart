<?php
require_once 'Model.php';

class transaction extends Model{
	var $auc = "Auctions";
	var $upd = "Updates";

	/* construction and helper functions */
	public function __construct() {

	}

	public function getMaxBid(){
		$maxAmountPerAuction = "SELECT MAX(amount), Auctions_id FROM Bidds GROUP BY Auctions_id";
		$sql = "SELECT MAX(b.amount), b.Auctions_id, b.Users_id, a.name, a.Submissions_id  FROM Auctions a 
				LEFT JOIN Bidds b ON (b.Auctions_id = a.auction_id);

		";
	}

	public function getClosedAuctionsAndBids($uid){
		$sql = "SELECT 
				a.archived, auction_id AS aid, a.name AS aname, b.amount AS aamount, a.Submissions_id AS asid, u.name AS uname, s.thumb_location AS thumb
				FROM Auctions a 
				LEFT JOIN Bidds b ON(b.Auctions_id = a.auction_id) 
				JOIN Users u ON (u.id = b.Users_id) 
				JOIN Submissions s ON (s.id = a.Submissions_id)
				WHERE a.open = 0  
				AND a.archived = 0
				AND a.Submissions_Users_id = '{$uid}';";
		$ret = $this->sqlRaw($sql)->fetchArray();
		return $ret;
	}

	/* used for bought commissions */
	public function getBoughtClosedAuctionsAndBids($uid){
		$sql = "SELECT 
				a.archived, auction_id AS aid, a.name AS aname, b.amount AS aamount, a.Submissions_id AS asid, u.name AS uname, s.thumb_location AS thumb
				FROM Auctions a 
				LEFT JOIN Bidds b ON(b.Auctions_id = a.auction_id) 
				JOIN Users u ON (u.id = a.Submissions_Users_id) 
				JOIN Submissions s ON (s.id = a.Submissions_id)
				WHERE a.open = 0  
				AND a.archived = 0
				AND b.Users_id = '{$uid}';";
		$ret = $this->sqlRaw($sql)->fetchArray();
		return $ret;
	}

	public function getTransactions($uid){
		$sql = "SELECT * FROM Updates u 
				LEFT JOIN Auctions a ON (a.auction_id = u.Auctions_id) 
				WHERE u.Users_id = '{$uid}' 
				ORDER BY u.id ASC;";
		$ret = $this->sqlRaw($sql)->fetchArray();
		return $ret;
	}
}