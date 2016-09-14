<?php
require_once 'Model.php';

class user extends Model{
	var $table = "Users";
	var $prefix = "";

	/* construction and helper functions */
	public function __construct() {

	}

	public function getUserInfoFromUsername($username){
		$sql = "SELECT * FROM Users WHERE name LIKE ('{$username}') LIMIT 1;";
		$data = $this->sqlRaw($sql)->fetchRow();
		return $data;
	}

	public function getUserInfoFromUserID($uid){
		$data = $this->orm("select")->
						selectAll()->
						table($this->table)->
						where("id", "=", $uid)->
						limit(1)->
						fetchRow();
		return $data;
	}	

	public function getUserInfoFromEmail($email){
		$data = $this->orm("select")->
						selectAll()->
						table($this->table)->
						where("email", "=", $email)->
						limit(1)->
						fetchRow();
		return $data;
	}	

	public function userExists($username){
		$sql = "SELECT COUNT(*) FROM Users WHERE name LIKE ('{$username}') LIMIT 1;";
		$exists = $this->sqlRaw($sql)->fetchSingle();
		return $exists == 1;
	}

	public function valueExists($key, $value){
		$exists = $this->orm("select")->
						count("*")->
						table($this->table)->
						where($key, "=", $value)->
						limit(1)->
						fetchSingle();
		return $exists == 1;
	}

	public function addUser($data){
		$this->orm("insert")->
				table($this->table)->
				insert($data)->
				commit();
	}

	public function updateUser($userid, $data){
		$this->orm("update")->
				table($this->table)->
				update($data)->
				where("id", "=", $userid)->
				limit(1)->
				commit();
	}
}