<?php
require_once 'Model.php';

class submissionTag extends Model{
	var $table = "Submissions_Tags";
	var $prefix = "";

	/* construction and helper functions */
	public function __construct() {

	}

	public function addSubTag($data){
		$this->orm("insert")->
				table($this->table)->
				insert($data)->
				commit();
	}

	public function getSubmissionIDsFromTagNames($tags){
		$keywords = "";
		$tags = explode(",", $tags);
		foreach ($tags as $tag) {
			$keywords .= "Tag_name LIKE ('%{$tag}%') OR";
		}
		$keywords = trim($keywords, " OR");

		$sql = "SELECT * FROM Tags t 
				LEFT JOIN Submissions_Tags st ON (st.Tags_id = t.id)
				LEFT JOIN Submissions s ON (s.id = st.Submissions_id)
				WHERE {$keywords}";

		$ret = $this->sqlRaw($sql)->
					fetchArray();

		return $ret;
	}

	public function getRandomSubmissionIDsFromTagNames($tags, $filterOutSub, $title, $limit = 6, $spaceReg = false){
		$keywords = "";
		if($spaceReg){
			$tags = str_replace(" ", "%", $tags);
		}
		$tags = explode(",", $tags);
		foreach ($tags as $tag) {
			$keywords .= " Tag_name LIKE ('%{$tag}%') OR";
		}
		$keywords = trim($keywords, " OR");

		$sql = "SELECT * FROM Tags t 
				LEFT JOIN Submissions_Tags st ON (st.Tags_id = t.id)
				LEFT JOIN Submissions s ON (s.id = st.Submissions_id)
				WHERE (s.id != '{$filterOutSub}') AND (s.title LIKE ('%{$title}%') OR {$keywords})
				ORDER BY RAND()
				LIMIT {$limit};";

		$ret = $this->sqlRaw($sql)->
					fetchArray();

		return $ret;
	}	
}