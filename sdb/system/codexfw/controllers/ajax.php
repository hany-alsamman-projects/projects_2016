<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @name        Ajax controller
 * @author      PyroCMS Development Team
 * @package     PyroCMS
 * @subpackage  Controllers
 */
class Ajax extends CI_Controller
{

    function url_title()
    {
        $this->load->helper('text');

        //$slug = trim(url_title($this->input->post('title'), 'dash', TRUE), '-');

        $slug = trim(str_replace(' ', '-', $this->input->post('title')));

        $this->output->set_output($slug);
    }


    function ajax_login()
    {

        //check ajax req
        if (!$this->input->is_ajax_request())
            exit();

        if (!$this->ion_auth->login($this->input->post('email'), $this->input->post('password'),
            $this->input->post('keep-logged'))) {
            //$this->form_validation->set_message('_check_login', $this->ion_auth->errors());

            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: ' . date('r', time() + (86400 * 365)));
            header('Content-type: application/json');

            echo json_encode(array('valid' => false, 'error' => 'Wrong user/password, please try again'));

            return false;

        } else {

            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: ' . date('r', time() + (86400 * 365)));
            header('Content-type: application/json');

            echo json_encode(array('valid' => true, 'redirect' => 'admin/login'));

            return true;

        }

    }
    
    function advanced_search(){
        
        //check ajax req
        if (!$this->input->is_ajax_request())
            exit();
        
        $this->load->model('vcard/vcard_m');
        
        $search_in = $this->input->get_post('search_in');
        
        $user_match = $this->input->get_post('user_match', true);
        
        switch ($search_in){
        
            case 1:            
                $results = $this->vcard_m->user_search_with_username($user_match);  
            break;
            
            
            case 2:
                $results = $this->vcard_m->user_search_with_username($user_match, 14);            
            break;
            
            
            case 3:
                $results = $this->vcard_m->vcard_search($user_match);
            break;
        
        }
        
        if ($results == false) {
            return false;
        } elseif (!empty($user_match)) {
            header("Pragma: public"); // required
            header('Cache-Control: no-cache, must-revalidate');
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            //header('Content-type: application/json');

            echo json_encode($results);
            unset($results);
        }
    }


    function ajax_user_search()
    {

        //check ajax req
        //if (!$this->input->is_ajax_request()) exit();

        $gid = $this->input->get_post('gid');
        $vid = $this->input->get_post('vid');
        $user_match = $this->input->get_post('user_match', true);
        
        $userid = $this->input->get_post('userid', true);                

        $this->load->model('vcard/vcard_m');
        
        if($userid == 'username'){
            $profiles = $this->vcard_m->user_search_with_username($user_match);
        }else{
            $profiles = $this->vcard_m->user_search_with_id($user_match);
        }
        


        if ($profiles == false) {
            //echo json_encode(array("data" => 'Sorry not found user like your search',"id" => "error"));
            return false;
        } elseif (!empty($user_match)) {
            //$this->form_validation->set_message('_check_login', $this->ion_auth->errors());
            //print_r($profiles);
            header("Pragma: public"); // required
            header('Cache-Control: no-cache, must-revalidate');
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
            //header('Content-type: application/json');

            echo json_encode($profiles);
            unset($profiles);
            //return FALSE;
        }

    }

    function ajax_user_add()
    {

        //check ajax req
        if (!$this->input->is_ajax_request())
            exit();

        $uid = $this->input->get_post('uid');
        $gid = $this->input->get_post('gid');
        $vid = $this->input->get_post('vid');

        $this->load->model('vcard/vcard_m');
        $user_add = $this->vcard_m->user_add($uid, $gid, $vid);

        //$this->form_validation->set_message('_check_login', $this->ion_auth->errors());
        //print_r($profiles);
        header("Pragma: public"); // required
        header('Cache-Control: no-cache, must-revalidate');
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        //header('Content-type: application/json');

        echo json_encode($user_add);
        unset($user_add);

    }

    function ajax_user_delete()
    {

        //check ajax req
        if (!$this->input->is_ajax_request())
            exit();

        $uid = $this->input->get_post('uid');
        $vid = $this->input->get_post('vid');

        $this->load->model('vcard/vcard_m');
        $user_delete = $this->vcard_m->user_delete($uid, $vid);


        header("Pragma: public"); // required
        header('Cache-Control: no-cache, must-revalidate');
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        //header('Content-type: application/json');

        echo json_encode($user_delete);
        unset($user_delete);

    }

    function ajax_upload()
    {

        $error = "";
        $msg = "";
        $allowed_ext = split('\|',str_replace(';','|',str_replace('*.','',$_REQUEST['fileext'])));
        $uploads_dir = $_SERVER["DOCUMENT_ROOT"] . '/' . $_REQUEST['folder'];
        $name = $_FILES['Filedata']['name'];
        
        if(isset($_REQUEST['removefile']) && $_REQUEST['id']>0){

            $myfile = explode(",",$_REQUEST['folder']);

            $do = unlink($_SERVER["DOCUMENT_ROOT"]."/uploads/".$myfile[1]."/".$myfile[0]."");

            if($do){echo "The file was deleted successfully.";} else { echo "There was an error trying to delete the file."; } 

        ## end
        }else{
            
        $fileElementName = 'Filedata';
        if (!empty($_FILES[$fileElementName]['error'])) {

            switch ($_FILES[$fileElementName]['error']) {

                case '1':
                    $error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
                    break;
                case '2':
                    $error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
                    break;
                case '3':
                    $error = 'The uploaded file was only partially uploaded';
                    break;
                case '4':
                    $error = 'No file was uploaded.';
                    break;

                case '6':
                    $error = 'Missing a temporary folder';
                    break;
                case '7':
                    $error = 'Failed to write file to disk';
                    break;
                case '8':
                    $error = 'File upload stopped by extension';
                    break;
                case '999':
                default:
                    $error = 'No error code avaiable';
            }


        } elseif (empty($_FILES['Filedata']['tmp_name']) || $_FILES['Filedata']['tmp_name'] == 'none') {
            $error = 'No file was uploaded..';

        } else {

            ## check the ext if safe in array of allowed ext
            if (!in_array(strtolower(trim(strrchr($name, '.'), '.')), $allowed_ext)) {

                $error = 'Sorry upload vaild, your file does not have true ext';

            } else {

                move_uploaded_file($_FILES['Filedata']['tmp_name'], "$uploads_dir/$name");

                if (getimagesize($uploads_dir . '/' . $name) == false) {
                    $error = 'someone trying to hack me';
                    unlink($uploads_dir . '/' . $name);
                }

                $filecode = @file_get_contents($uploads_dir . '/' . $name);

                if (ereg("echo", $filecode) or ereg("zend", $filecode) or ereg("print", $filecode) or
                    ereg("phpinfo", $filecode) or ereg("symlink", $filecode) or ereg("ini_set", $filecode) or
                    ereg("telnet", $filecode) or ereg("cgi", $filecode)) {
                    $error = 'someone trying to hack me';
                    unlink($uploads_dir . '/' . $name);
                }

                $msg .= "Your profile picture was changed to the new one (" . $_FILES['Filedata']['name'] .")";
                //$msg .= " File Size: " . @filesize($_FILES['Filedata']['tmp_name']);

                //for security reason, we force to remove all uploaded file
                @unlink($_FILES['Filedata']);
            }

        }

        echo "{";
        echo "error: '" . $error . "',\n";
        echo "msg: '" . $msg . "',\n";
        echo "picture: '" . $name . "'\n";
        echo "}";
        
        }
    }
    
    
    function vcard_search()
    {

        //check ajax req
        if (!$this->input->is_ajax_request())
            exit();
        
        $word = $this->input->get_post('word', true);       
         
          
        //$word = @iconv('UTF-8', 'UTF-8//IGNORE', $myword);
        
        $this->load->model('vcard/vcard_m');        

        if(strlen($word)>2) $result = $this->vcard_m->vcard_search($word);
        
        header("Pragma: public"); // required
        header('Cache-Control: no-cache, must-revalidate');
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        //header('Content-type: application/json');

        echo json_encode($result);
        unset($result);

    }


}
