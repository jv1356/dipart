<?php
require_once 'Model.php';

class log extends Model{
	var $table = "Logs";
	var $prefix = "";

	/* construction and helper functions */
	public function __construct() {

	}

	public function addLog($data){
		$mod = new Model();
		$mod->orm("insert")->
				table($this->table)->
				insert($data)->
				commit();
	}
}