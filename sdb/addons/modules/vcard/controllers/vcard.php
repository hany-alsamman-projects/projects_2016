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
class vcard extends Public_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('vcard_m');   
                    
    }
        
    public function index($since = false)
    {
        
        //if the request is ajax set layout to false
        if( $this->input->is_ajax_request() ) {
            
        $this->template
        ->set("vcards",$vcards)
        ->set_layout(FALSE)
        ->build('index');
            
        }
        
        if(!$this->uri->segment(3)) redirect('vcard/since/2011');
        
        $this->load->helper('text');

        $vcards = @$this->vcard_m->get_all(false,$since);

        if(!$vcards)

        $this->template
        ->set_breadcrumb("الرئيسية", '/home')
        ->set_breadcrumb('لا توجد اعمال ضمن السنة المختارة', false)
        ->set("vcards",$vcards)
        ->title($this->module_details['name'])
        ->build('index');

        else

        $this->template
        ->set_breadcrumb("الرئيسية", '/home')
        ->set_breadcrumb('أرشيف دراما', false)
        ->set_breadcrumb($this->uri->segment(3), false)
        ->set("vcards",$vcards)
        ->title($this->module_details['name'])
        ->build('index');
    }
    
    
    public function view($id = '')
    {
        //$this->load->helper('vcard');
        
		if ( ! $id or ! $vcard = $this->vcard_m->get($id))
		{
			redirect('vcard');
		}
        
        
        //get the stars of the vcard by stars group ID
        $stars = $this->vcard_m->get_cast_by_id($vcard->id, 3);
        
        //get the stars of the vcard by stars group ID
        $cast = $this->vcard_m->get_cast_by_id($vcard->id, array(1,13,36));
                
        $this->template
        ->set_breadcrumb('أرشيف دراما', 'vcard/')
        ->set_breadcrumb($vcard->name, false)
        ->set('cast', $cast)
        ->set('vcard', $vcard)
        ->set('stars', $stars)
        ->title($this->module_details['name'])
        ->build('view');
    }
    
    
    public function full($id = '')
    {
        //$this->load->helper('vcard');
        
		if ( ! $id or ! $vcard = $this->vcard_m->get($id))
		{
			redirect('vcard');
		}
        

        //get the stars of the vcard by stars group ID
        //$fullcast = $this->vcard_m->get_cast_by_id($vcard->id, array(1,4,3));

        $fullcast = $this->vcard_m->get_fullcast_by_vid($vcard->id);
        
        //print_r($fullcast);
                
        $this->template
        ->set_breadcrumb('أرشيف دراما', 'vcard/')
        ->set_breadcrumb($vcard->name, 'vcard/view/'.$vcard->id)
        ->set_breadcrumb("طاقم العمل", false)
        ->set('vcard', $vcard)
        ->set('fullcast', $fullcast)
        ->title($this->module_details['name'])
        ->build('full');
    }
    
    public function test(){


        //if the request is ajax set layout to false		
		$this->input->is_ajax_request() and $this->template->set_layout(FALSE);
    }
}
