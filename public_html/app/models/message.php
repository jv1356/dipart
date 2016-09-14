<?php
require_once 'Model.php';

class message extends Model{
	var $table = "Messages";
	var $prefix = "";

	/* construction and helper functions */
	public function __construct() {

	}

	public function addMessage($data){
		$this->orm("insert")->
				table($this->table)->
				insert($data)->
				commit();
	}

	public function addConversationUsers($data){
		$this->orm("insert")->
				table("Conversations_users")->
				insert($data)->
				commit();
	}

	public function getLastConversationID($uid, $gname){
		$sql = "SELECT MAX(id) 
				FROM Conversations 
				WHERE group_name LIKE ('{$gname}') 
				AND createdByUserID = '{$uid}' LIMIT 1;";

		$ret = $this->sqlRaw($sql)->fetchSingle();

		return $ret;
	}

	public function insertConversation($data){
		$this->orm("insert")->
				table("Conversations")->
				insert($data)->
				commit();	
	}

	public function existsConversationUsersEntry($uid, $cid){
		$sql = "SELECT COUNT(*) FROM Conversations_users WHERE Conversations_id = '{$cid}' AND Users_id = '{$uid}' LIMIT 1;";
		$ret = $this->sqlRaw($sql)->fetchSingle();
		return $ret == 1;
	}

	public function getMessageGroups($uid){
		$sql = "SELECT * FROM Conversations_users cu 
				LEFT JOIN Conversations c ON (c.id = cu.Conversations_id) 
				LEFT JOIN Messages m ON (m.Conversations_id = cu.Conversations_id)
				WHERE cu. Users_id = '{$uid}' 
				GROUP BY cu.Conversations_id 
				ORDER BY m.created DESC;";

		$ret = $this->sqlRaw($sql)->fetchArray();
		
		return $ret;
	}

	public function getMessagesFromConversation($cid){
		$sql = "";

		$ret = $this->sqlRat($sql)->fetchArray();
		return $ret;
	}

	public function isParticipant($uid, $cid){
		$ret = $this->orm("select")->
					count("Conversations_id")->
					table("Conversations_users")->
					whereAnd("Users_id", "=", $uid)->
					where("Conversations_id", "=", $cid)->
					limit(1)->
					fetchSingle();
		return $ret == 1;
	}


	public function numUnread($uid){
		$sql = "SELECT COUNT(DISTINCT Conversations_id) 
				FROM Messages 
				WHERE unread = 1 AND Messages_Users_id = '{$uid}' 
				GROUP BY Conversations_id;";
		$ret = $this->sqlRaw($sql)->fetchSingle();
		return $ret;
	}


	public function marKRead($cid, $uid){
		$sql = "UPDATE Messages SET unread=0 WHERE Conversations_id = '{$cid}' AND Messages_Users_id = '{$uid}';";
		$this->sqlRaw($sql)->commit();
	}

	public function getMessages($cid){
		$sql = "SELECT * FROM Messages m 
				LEFT JOIN Users u ON (u.id = m.Messages_Users_id)
				JOIN Conversations c ON (c.id = m.Conversations_id)
				WHERE m.Conversations_id = '{$cid}'
				ORDER BY m.created ASC
				LIMIT 50;";

		$ret = $this->sqlRaw($sql)->fetchArray();
		return $ret;
	}

	public function getMessagesHistory($cid){
		$sql = "SELECT * FROM Messages m 
				LEFT JOIN Users u ON (u.id = m.Messages_Users_id)
				JOIN Conversations c ON (c.id = m.Conversations_id)
				WHERE m.Conversations_id = '{$cid}'
				ORDER BY m.created ASC;";

		$ret = $this->sqlRaw($sql)->fetchArray();
		return $ret;
	}	

	/*  
		previously used SQLs

				$sql = "SELECT * FROM Messages m 
				LEFT JOIN Conversations_users cu ON (cu.Conversations_id = m.Conversations_id)
				LEFT JOIN Users u ON (u.id = cu.Users_id)
				WHERE cu.Users_id = '{$uid}' 
				GROUP BY m.Conversations_id
				ORDER BY m.created DESC;";

	*/

}