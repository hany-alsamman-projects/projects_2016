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
	 * Validation rules for creating a new wall
	 *
	 * @var array
	 * @access private
	 */
	private $wall_validation_rules = array(
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
		$this->load->model('wall_m');
		$this->load->library('form_validation');
		$this->lang->load('wall');
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
	   	
		// Get all wall entries
		$wall = $this->wall_m->get_all_admin();
        
        $view_data = array('wall' => $wall);
        
        // Load the view
		$this->template->title('wall list view')->build('admin/index', $view_data);
	}
    
    
	/**
	 * Create a new wall
	 *
	 * @author Hany alsamman
	 * @access public
	 * @return void
	 */
	public function create()
	{
		// Get all wall entries
		//$wall = $this->wall_m->get_all();

		// Set the validation rules
		$this->form_validation->set_rules($this->wall_validation_rules);

		if ( $this->form_validation->run() )
		{
			if ($this->wall_m->insert_wall($_POST))
			{
				// Everything went ok..
				$this->session->set_flashdata('success', lang('wall.create_success'));
				redirect('admin/wall/index');
			} else {
				// Report error
				$this->session->set_flashdata('error', lang('wall.create_error'));
				redirect('admin/wall/create');
			}
		}

		// Required for validation
		foreach($this->wall_validation_rules as $rule)
		{
			$wall[$rule['field']] = $this->input->post($rule['field']);
		}
		$view_data = array('wall' => $wall, 'groups' => $this->wall_m->get_groups());

        
		$this->template
        //->title($this->module_details['name'])
        ->build('admin/create', $view_data);
	}
    
    
	/**
	 * Edit an existing wall
	 *
	 * @author Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
	 * @access public
	 * @param int $id The ID of the testimonial entry to edit
	 * @return void
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules($this->wall_validation_rules);

		// Get the $id entry
		$wall = $this->wall_m->get($id);
		
		if ( empty($wall) )
		{
			$this->session->set_flashdata('error', lang('wall.exists_error'));
			redirect('admin/wall');
		}

		// Valid form data?
		if ( $this->form_validation->run() )
		{
			// Try to update the wall entry
			if ( $this->wall_m->update_entry($id, $_POST) === TRUE )
			{
				if ( isset($_POST['delete']) )
				{
					$this->session->set_flashdata('success', lang('wall.delete_success'));
					redirect('admin/wall/');
				}
				else
				{
					$this->session->set_flashdata('success', lang('wall.update_success'));
					redirect('admin/wall/edit/' . $id);
				}
			} else {
				if ( isset($_POST['delete']) )
				{
					$this->session->set_flashdata('error', lang('wall.delete_error'));
					redirect('admin/wall/edit/' . $id);
				}
				else
				{
					$this->session->set_flashdata('error', lang('wall.update_error'));
					redirect('admin/wall/edit/' . $id);
				}
			}
		}

		// Required for validation
		foreach($this->wall_validation_rules as $rule)
		{
			if ($this->input->post($rule['field']))
			{	
				$wall[$rule['field']] = $this->input->post($rule['field']);
			}
		}
		$view_data = array(
				'wall' => $wall , 'groups' => $this->wall_m->get_groups()
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
        
		// delete selected wall
		$wall = $this->wall_m->update_entry($id,$input);

		if($wall) 
        $this->session->set_flashdata('success', lang('wall.delete_success')); 
        else
        $this->session->set_flashdata('error', lang('wall.delete_error'));
        
		redirect('admin/wall');
	}
	

}