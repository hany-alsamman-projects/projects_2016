<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 *
 * @author 		Hany alsamman - Codex FrameWork Dev Team
 * @package 	Codex FrameWork
 * @subpackage 	Controllers for Admin
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Admin extends Admin_Controller
{

	/**
	 * Validation rules for creating a new vcard
	 *
	 * @var array
	 * @access private
	 */
	private $vcard_validation_rules = array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'trim|max_length[255]|required'
		),
		array(
			'field' => 'description',
			'label' => 'Description',
			'rules' => 'trim|max_length[255]|required'
		),
		array(
			'field' => 'date',
			'label' => 'Date',
			'rules' => 'trim|required'
		)

	);

	/**
	 * Constructor method
	 *
	 * @author Hany alsamman - Codex FrameWork Dev Team
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
        
		// Load all the required classes
		$this->load->model('vcard_m');
		$this->load->library('form_validation');
		$this->lang->load('vcard');
		$this->load->helper('html');
        
        //if the request is ajax set layout to false		
		$this->input->is_ajax_request() and $this->template->set_layout(FALSE);
	}

	/**
	 * 
	 *
	 * @access public
	 * @return void
	 */
	public function index()
	{
	   	
		// Get all vcard entries
		$vcard = $this->vcard_m->get_all_admin();
        
        $view_data = array('vcard' => $vcard);
        
        // Load the view
		$this->template->title('vcard list view')->build('admin/index', $view_data);
	}
    
    
	/**
	 * Create a new vcard
	 *
	 * @author Hany alsamman
	 * @access public
	 * @return void
	 */
	public function create()
	{
		// Get all vcard entries
		//$vcard = $this->vcard_m->get_all();

		// Set the validation rules
		$this->form_validation->set_rules($this->vcard_validation_rules);

		if ( $this->form_validation->run() )
		{
			if ($this->vcard_m->insert_vcard($_POST))
			{
				// Everything went ok..
				$this->session->set_flashdata('success', lang('vcard.create_success'));
				redirect('admin/vcard/index');
			} else {
				// Report error
				$this->session->set_flashdata('error', lang('vcard.create_error'));
				redirect('admin/vcard/create');
			}
		}

		// Required for validation
		foreach($this->vcard_validation_rules as $rule)
		{
			$vcard[$rule['field']] = $this->input->post($rule['field']);
		}
		$view_data = array('vcard' => $vcard, 'groups' => $this->vcard_m->get_groups());

        
		$this->template
        //->title($this->module_details['name'])
        ->build('admin/create', $view_data);
	}
    
    
	/**
	 * Edit an existing vcard
	 *
	 * @author Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
	 * @access public
	 * @param int $id The ID of the testimonial entry to edit
	 * @return void
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules($this->vcard_validation_rules);

		// Get the $id entry
		$vcard = $this->vcard_m->get($id);
		
		if ( empty($vcard) )
		{
			$this->session->set_flashdata('error', lang('vcard.exists_error'));
			redirect('admin/vcard');
		}

		// Valid form data?
		if ( $this->form_validation->run() )
		{
			// Try to update the vcard entry
			if ( $this->vcard_m->update_entry($id, $_POST) === TRUE )
			{
				if ( isset($_POST['delete']) )
				{
					$this->session->set_flashdata('success', lang('vcard.delete_success'));
					redirect('admin/vcard/');
				}
				else
				{
					$this->session->set_flashdata('success', lang('vcard.update_success'));
					redirect('admin/vcard/edit/' . $id);
				}
			} else {
				if ( isset($_POST['delete']) )
				{
					$this->session->set_flashdata('error', lang('vcard.delete_error'));
					redirect('admin/vcard/edit/' . $id);
				}
				else
				{
					$this->session->set_flashdata('error', lang('vcard.update_error'));
					redirect('admin/vcard/edit/' . $id);
				}
			}
		}

		// Required for validation
		foreach($this->vcard_validation_rules as $rule)
		{
			if ($this->input->post($rule['field']))
			{	
				$vcard[$rule['field']] = $this->input->post($rule['field']);
			}
		}
		$view_data = array(
				'vcard' => $vcard , 'groups' => $this->vcard_m->get_groups()
			);
            
		$this->template->build('admin/edit', $view_data);
	}
    
	/**
	 * 
	 *
	 * @access public
	 * @return void
	 */
	public function delete($id)
	{
	   	
        $input['delete'] = true;
        
		// delete selected vcard
		$vcard = $this->vcard_m->update_entry($id,$input);

		if($vcard) 
        $this->session->set_flashdata('success', lang('vcard.delete_success')); 
        else
        $this->session->set_flashdata('error', lang('vcard.delete_error'));
        
		redirect('admin/vcard');
	}
	

}