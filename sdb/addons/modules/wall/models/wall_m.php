<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 *
 * @author 		Hany alsamman - Codex FrameWork Dev Team
 * @package 	Codex FrameWork
 * @subpackage 	Wall Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class wall_m extends MY_Model
{

    public function __construct()
    {
        parent::__construct();

        //echo 'hany';
    }

    // Updates
    public function Updates($uid, $limit=5)
    {
        $query = $this->db->query("SELECT M.msg_id, M.uid_fk, M.message, M.created, U.username FROM wall_messages M, users U  WHERE M.uid_fk=U.id and M.uid_fk='$uid' order by M.msg_id DESC LIMIT 5")->result_array();
        return $query;
    }
    //Comments
    public function Comments($msg_id)
    {
        $query = $this->db->query("SELECT C.com_id, C.uid_fk, C.comment, C.created, U.username FROM wall_comments C, users U WHERE C.uid_fk=U.id and C.msg_id_fk='$msg_id' order by C.com_id ASC")->result_array();
        return $query;
    }


    //Insert Update
    public function Insert_Update($uid, $update)
    {
        //$update = htmlentities($update);
        
        $time = time();
        $ip = $_SERVER['REMOTE_ADDR'];
        
        if (!empty($update)) {
            $this->db->query("INSERT INTO `wall_messages` (message, uid_fk, ip,created) VALUES ('$update', '$uid', '$ip','$time')");
            
            $result = $this->db->query("SELECT M.msg_id, M.uid_fk, M.message, M.created, U.username FROM wall_messages M, users U where M.uid_fk=U.id and M.uid_fk='$uid' order by M.msg_id desc limit 1")->row_array();
            return $result;
        } else {
            return false;
        }
    }

    //Delete update
    public function Delete_Update($uid, $msg_id)
    {
        $this->db->query("DELETE FROM `wall_comments` WHERE msg_id_fk = '$msg_id' ");
        
        $this->db->query("DELETE FROM `wall_messages` WHERE msg_id = '$msg_id' and uid_fk='$uid'");
    }

    //Insert Comments
    public function Insert_Comment($uid, $msg_id, $comment)
    {
        $time = time();
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $result = $this->db->query("SELECT com_id,comment FROM `wall_comments` WHERE uid_fk='$uid' and msg_id_fk='$msg_id' order by com_id desc limit 1 ")->result_array();

        if ($comment != $result['comment']) {
            
            $this->db->query("INSERT INTO `wall_comments` (comment, uid_fk,msg_id_fk,ip,created) VALUES ('$comment', '$uid','$msg_id', '$ip','$time')");
            return $this->db->query("SELECT C.com_id, C.uid_fk, C.comment, C.msg_id_fk, C.created, U.username FROM wall_comments C, users U where C.uid_fk=U.id and C.uid_fk='$uid' and C.msg_id_fk='$msg_id' order by C.com_id desc limit 1 ")->row_array();

        } else {
            return false;
        }

    }

    //Delete Comments
    public function Delete_Comment($uid, $com_id)
    {        
        $this->db->query("DELETE FROM `wall_comments` WHERE com_id='$com_id'");
        return true;
    }

}
