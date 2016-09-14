<?php
require_once 'Model.php';

class submission extends Model{
	var $table = "Submissions";
	var $prefix = "";

	/* construction and helper functions */
	public function __construct() {

	}

	public function addSubmission($data, $uid){
		/* inserts submission and returns submission ID of last submission of user with ID $uid */
		$mod = new Model();
		$mod->orm("insert")->
				table($this->table)->
				insert($data)->
				commit();
		$mod2 = new Model();
		$ret = $mod2->orm("select")->
				table($this->table)->
				select(" MAX(id) ")->
				where("Users_id", "=", $uid)->
				limit(1)->
				fetchSingle();
		
		return $ret;
	}

	public function usersSubmissions($uid){
		$ret = $this->orm("select")->
					table($this->table)->
					select("file_location, thumb_location, title, id")->
					where("Users_id", "=", $uid)->
					order("id", "DESC")->
					fetchArray();
		return $ret;
	}

	public function usersCommissions($uid){
		$timenow = time();
		$sql = "SELECT * FROM Auctions a 
				LEFT JOIN Submissions s ON (s.id = a.Submissions_id)
				WHERE a.open = 1 
				AND a.end_date > {$timenow}
				AND a.Submissions_Users_id = {$uid}
				ORDER BY a.end_date ASC;";

		$ret = $this->sqlRaw($sql)->
					fetchArray();
		return $ret;
	}	

	public function latestSubmissions($uid, $limit = 6){
		$ret = $this->orm("select")->
					table($this->table)->
					select("file_location, thumb_location, title, id")->
					where("Users_id", "=", $uid)->
					order("id", "DESC")->
					limit($limit)->
					fetchArray();
		return $ret;
	}

	public function latestSubmissionsOverall($limit = 6){
		$filter = "";
		if($_SESSION['filter'] == "SFW"){
			$filter = " WHERE s.nsfw = 0";
		}
		$sql = "SELECT *, s.id AS sid FROM Submissions s 
				LEFT JOIN Users u ON (u.id = s.Users_id)
				{$filter}
				ORDER BY s.id DESC 
				LIMIT {$limit};";

		$ret = $this->sqlRaw($sql)->
					fetchArray();
		return $ret;
	}


	public function randomSubmissions($uid, $limit = 6){
		$ret = $this->orm("select")->
					table($this->table)->
					select("file_location, thumb_location, title, id")->
					where("Users_id", "=", $uid)->
					order("RAND ()", "")->
					limit($limit)->
					fetchArray();
		return $ret;
	}	

	public function getSubmissionInfo($sid){
		$sql = "SELECT * FROM Submissions s 
				LEFT JOIN Auctions a ON (a.Submissions_id = s.id)
				LEFT JOIN Submissions_Tags st ON (st.Submissions_id = s.id)
				LEFT JOIN Tags t ON (t.id = st.Tags_id)
				WHERE s.id = '{$sid}';";

		$ret = $this->sqlRaw($sql)->
					fetchArray();
		return $ret;
	}

	public function submissionInfo($sid){
		$ret = $this->orm("select")->
					selectAll()->
					table($this->table)->
					where("id", "=", $sid)->
					limit(1)->
					fetchRow();
		return $ret;
	}

	public function increaseViews($sid){
		$sql = "UPDATE Submissions SET numViews = numViews+1 WHERE id='{$sid}' LIMIT 1;";
		$this->sqlRaw($sql)->
				commit();
	}

	public function mostPopularSubmission($uid){
		$sql = "SELECT * FROM Submissions s 
				WHERE s.numViews = (SELECT MAX(numViews) FROM Submissions x WHERE x.Users_id = '{$uid}')
				LIMIT 1;";
		$ret = $this->sqlRaw($sql)->
					fetchRow();
		return $ret;
	}

	public function mostPopularSubmissionOverAll(){
		$filter = "";
		if($_SESSION['filter'] == "SFW"){
			$filter = " WHERE s.nsfw = 0";
		}
		$sql = "SELECT *, s.id AS sid, s.description AS sdesc FROM Submissions s 
				LEFT JOIN Users u ON (u.id = s.Users_id) 
				{$filter} 
				ORDER BY s.numViews DESC 
				LIMIT 1;";
		$ret = $this->sqlRaw($sql)->
					fetchRow();
		return $ret;
	}	

	public function exists($sid){
		$sql = "SELECT COUNT(*) FROM Submissions WHERE id = '{$sid}' LIMIT 1;";
		$ret = $this->sqlRaw($sql)->fetchSingle();
		return $ret == 1;
	}
}