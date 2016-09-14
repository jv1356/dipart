<?php
require_once 'Model.php';

class journal extends Model{
	var $table = "Journals";
	var $prefix = "";

	/* construction and helper functions */
	public function __construct() {

	}

	public function countActiveByUserID($uid){
		$data = $this->orm("select")->
						select("COUNT(*)")->
						table($this->table)->
						whereAnd("Users_id", "=", $uid)->
						where("active", "=", 1)->
						fetchSingle();
		return $data;
	}

	public function getJournalInfoFromJournalID($jid){
		$data = $this->orm("select")->
						selectAll()->
						table($this->table)->
						where("id", "=", $jid)->
						limit(1)->
						fetchRow();
		return $data;
	}	


	public function getJournalsFromUserID($uid, $active = 1){
		$data = $this->orm("select")->
						selectAll()->
						table($this->table)->
						whereAnd("Users_id", "=", $uid)->
						where("active", "=", $active)->
						order("id", "DESC")->
						fetchArray();
		return $data;
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

	public function addJournal($data){
		$this->orm("insert")->
				table($this->table)->
				insert($data)->
				commit();
	}

	public function updateJournal($jid, $data){
		$this->orm("update")->
				table($this->table)->
				update($data)->
				where("id", "=", $jid)->
				limit(1)->
				commit();
	}
}