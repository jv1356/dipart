<?php
require_once 'Model.php';

class favourites extends Model{
	var $table = "Favourites";
	var $prefix = "";

	/* construction and helper functions */
	public function __construct() {

	}

	public function addFavourite($data){
		/* inserts tag and returns ID of tag */
		$mod = new Model();
		$mod->orm("insert")->
				table($this->table)->
				insert($data)->
				commit();
	}

	public function removeFavourite($uid, $sid){
		$sql = "DELETE FROM Favourites WHERE Users_id = '{$uid}' AND Submissions_id = '{$sid}' LIMIT 1;";
		$this->sqlRaw($sql)->commit();
	}

	public function isFavourite($uid, $sid){
		$sql = "SELECT COUNT(*) FROM Favourites WHERE Users_id = '{$uid}' AND Submissions_id = '{$sid}' LIMIT 1;";
		$ret = $this->sqlRaw($sql)->fetchSingle();
		return $ret == 1;
	}

	public function usersFavourites($uid, $limit = 10){
		$sql = "SELECT * FROM Favourites f 
				LEFT JOIN Submissions s ON (s.id = f.Submissions_id) 
				JOIN Users u ON (u.id = f.Users_id) 
				WHERE f.Users_id = '{$uid}' 
				ORDER BY RAND() 
				LIMIT {$limit};";
		$ret = $this->sqlRaw($sql)->fetchArray();
		return $ret;
	}

}