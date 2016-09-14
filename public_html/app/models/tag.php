<?php
require_once 'Model.php';

class tag extends Model{
	var $table = "Tags";
	var $prefix = "";

	/* construction and helper functions */
	public function __construct() {

	}

	public function addTag($data){
		/* inserts tag and returns ID of tag */
		$mod = new Model();
		$mod->orm("insert")->
				table($this->table)->
				insert($data)->
				commit();

		$mod2 = new Model();
		$ret = $mod2->orm("select")->
				table($this->table)->
				select("id")->
				where("Tag_name", "=", $data["Tag_name"])->
				limit(1)->
				fetchSingle();
		
		return $ret;
	}


	public function exists($tagName){
		/* check if tag exists, if it does returns it's ID */
		$mod = new Model();
		$ret = $mod->orm("select")->
				table($this->table)->
				select("COUNT(id)")->
				where("Tag_name", "=", $tagName)->
				fetchSingle();

		return $ret > 0;
	}

	public function getTagID($tagName){
		/* check if tag exists, if it does returns it's ID */
		$mod = new Model();
		$ret = $mod->orm("select")->
				table($this->table)->
				select("id")->
				where("Tag_name", "=", $tagName)->
				fetchSingle();

		return $ret;
	}

}