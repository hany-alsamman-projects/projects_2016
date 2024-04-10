<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 *
 * @author 		Hany alsamman - Codex FrameWork Dev Team
 * @package 	Codex FrameWork
 * @subpackage 	Controllers for public
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class wall extends Public_Controller
{
    
    var $user_auth;
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->helper('wall');
        $this->load->model('wall_m');   
        $this->load->model('users/users_m');
        
        //$this->user_auth = $this->users_m->get($this->uri->segment(4));   
        
        if ( $this->uri->segment(3) == 'index' && $this->uri->segment(1) == 'my-profile') {

            $this->user_auth = $this->user;           
            
        }else{
            
            $username = $this->uri->segment(4);
            if(is_numeric($username)) $id = array('id'=>$username); else $id = array('username'=>$username);
            $this->user_auth = $this->users_m->get($id);

        }
        
        //if the request is ajax set layout to false
        if(!$this->input->is_ajax_request() and $this->user->id != $this->user_auth->user_id) die();
                 
    }
        
    public function index()
    {
        
    }
    
    
    public function view($id = '')
    {
        //$this->load->helper('wall');

    }
    
    public function insert_update(){        

        $update_msg = $this->input->post('update', TRUE);
        
        $myupdate = $this->wall_m->Insert_Update($this->user->id,$update_msg);
      
        return $this->template
        ->set("update", $myupdate)
        ->set_layout(FALSE)
        ->build('new_update');        
    }
    
    public function insert_comment(){        
        
        $update_comment = $this->input->post('comment', TRUE);
        
        $msg_id = (int)$this->input->post('msg_id');
        
        $myupdate = $this->wall_m->Insert_Comment($this->user->id,$msg_id,nl2br($update_comment));
      
        return $this->template
        ->set("comment", $myupdate)
        ->set_layout(FALSE)
        ->build('new_comment');        
    }
    
    public function delete_update(){        
        
        $msg_id = (int)$this->input->post('msg_id');
        
        $this->wall_m->Delete_Update($this->user->id, $msg_id);
        
        return true;
     
    }
    
    public function delete_comment(){        
             
        $com_id = (int)$this->input->post('com_id');
        
        $this->wall_m->Delete_Comment($this->user->id, $com_id);
        
        return true;
     
    }
    
}
