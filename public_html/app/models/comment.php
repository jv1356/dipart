<?php
require_once 'Model.php';

class comment extends Model{
	var $table = "Comments";
	var $prefix = "";

	/* construction and helper functions */
	public function __construct() {

	}

	public function getCommentsFromJournalID($jid){
		$sql = "SELECT * FROM Comments c LEFT JOIN Users u ON (u.id = c.Users_id) WHERE Journals_id = '{$jid}' ORDER BY c.id DESC;";
		$data = $this->sqlRaw($sql)->
						fetchArray();
		return $data;
	}	

	public function getCommentsFromSubmissionID($sid){
		$sql = "SELECT * FROM Comments c LEFT JOIN Users u ON (u.id = c.Users_id) WHERE Submissions_id = '{$sid}' ORDER BY c.id DESC;";
		$data = $this->sqlRaw($sql)->
						fetchArray();
		return $data;
	}		


	public function addComment($data){
		$this->orm("insert")->
				table($this->table)->
				insert($data)->
				commit();
	}

	public function updateComment($jid, $data){
		$this->orm("update")->
				table($this->table)->
				update($data)->
				where("id", "=", $jid)->
				limit(1)->
				commit();
	}
}