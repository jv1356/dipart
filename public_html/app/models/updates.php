<?php
require_once 'Model.php';

class updates extends Model{
	var $table = "Updates";
	var $prefix = "";

	/* construction and helper functions */
	public function __construct() {

	}

	public function addAUpdate($data){
		$this->orm("insert")->
				table($this->table)->
				insert($data)->
				commit();
	}

	public function getUpdateInfo($uid){
		$ret = $this->orm("select")->
				selectAll()->
				table($this->table)->
				where("id", "=", $uid)->
				limit(1)->
				fetchRow();

		return $ret;

	}

	public function getUpdatesInfoByUserID($uid){
		$ret = $this->orm("select")->
				selectAll()->
				table($this->table)->
				where("Users_id", "=", $uid)->
				fetchArray();

		return $ret;

	}

}