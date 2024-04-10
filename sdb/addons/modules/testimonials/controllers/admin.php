<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * The testimonials module enables users to create and manage client testimonials.
 *
 * @author 		Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
 * @package 	CodexFW
 * @subpackage 	Testimonial Module
 * @category 	Modules
 * @license 	Apache License v2.0
 */
class Admin extends Admin_Controller
{
	/**
	 * Validation rules for creating a new testimonial
	 *
	 * @var array
	 * @access private
	 */
	private $testimonial_validation_rules = array(
		array(
			'field' => 'name',
			'label' => 'Name',
			'rules' => 'trim|max_length[50]|required'
		),
		array(
			'field' => 'location',
			'label' => 'Location',
			'rules' => 'trim|max_length[100]'
		),
		array(
			'field' => 'comment',
			'label' => 'Comment',
			'rules' => 'trim|required'
		)

	);
	
	/**
	 * Constructor method
	 *
	 * @author Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
	 * @access public
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		// Load all the required classes
		$this->load->model('testimonials_m');
		$this->load->library('form_validation');
		$this->lang->load('testimonials');
		$this->load->helper('html');

		$this->template->set_partial('shortcuts', 'admin/partials/shortcuts');
	}
	
	/**
	 * List all existing testimonials
	 *
	 * @author Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
	 * @access public
	 * @return void
	 */
	public function index()
	{
		// Get all testimonials
		$view_data = array();
		$view_data['testimonials'] = $this->testimonials_m->get_all();
		// Load the view
		$this->template->build('admin/index', $view_data);
	}
	
	/**
	 * Create a new testimonial
	 *
	 * @author Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
	 * @access public
	 * @return void
	 */
	public function create()
	{
		// Get all testimonials
		$testimonials = $this->testimonials_m->get_all();

		// Set the validation rules
		$this->form_validation->set_rules($this->testimonial_validation_rules);

		if ( $this->form_validation->run() )
		{
			if ($this->testimonials_m->insert_testimonial($_POST))
			{
				// Everything went ok..
				$this->session->set_flashdata('success', lang('testimonials.create_success'));
				redirect('admin/testimonials/index');
			} else {
				// Report error
				$this->session->set_flashdata('error', lang('testimonials.create_error'));
				redirect('admin/testimonials/create');
			}
		}

		// Required for validation
		foreach($this->testimonial_validation_rules as $rule)
		{
			$testimonials[$rule['field']] = $this->input->post($rule['field']);
		}
		$view_data = array(
				'testimonials' => $testimonials
			);
		$this->template->build('admin/create', $view_data);
	}
	
	/**
	 * Edit an existing testimonial
	 *
	 * @author Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
	 * @access public
	 * @param int $id The ID of the testimonial entry to edit
	 * @return void
	 */
	public function edit($id)
	{
		$this->form_validation->set_rules($this->testimonial_validation_rules);

		// Get the testimonial entry
		$testimonial = $this->testimonials_m->get($id);
		
		if ( empty($testimonial) )
		{
			$this->session->set_flashdata('error', lang('testimonials.exists_error'));
			redirect('admin/testimonials');
		}

		// Valid form data?
		if ( $this->form_validation->run() )
		{
			// Try to update the testimonial entry
			if ( $this->testimonials_m->update_entry($id, $_POST) === TRUE )
			{
				if ( isset($_POST['delete']) )
				{
					$this->session->set_flashdata('success', lang('testimonials.delete_success'));
					redirect('admin/testimonials/');
				}
				else
				{
					$this->session->set_flashdata('success', lang('testimonials.update_success'));
					redirect('admin/testimonials/edit/' . $id);
				}
			} else {
				if ( isset($_POST['delete']) )
				{
					$this->session->set_flashdata('error', lang('testimonials.delete_error'));
					redirect('admin/testimonials/edit/' . $id);
				}
				else
				{
					$this->session->set_flashdata('error', lang('testimonials.update_error'));
					redirect('admin/testimonials/edit/' . $id);
				}
			}
		}

		// Required for validation
		foreach($this->testimonial_validation_rules as $rule)
		{
			if ($this->input->post($rule['field']))
			{	
				$testimonial[$rule['field']] = $this->input->post($rule['field']);
			}
		}
		$view_data = array(
				'testimonials' => $testimonial
			);
		$this->template->build('admin/edit', $view_data);
	}

	/**
	 * Delete an existing testimonial entry
	 *
	 * @author Gordon Naldrett - Winking Frog Studion / Moray Web Solutions
	 * @access public
	 * @param int $id The ID of the entry to delete
	 * @return void
	 */
	public function delete($id = NULL)
	{
		$id_array = array();

		// Multiple IDs or just a single one?
		if ( $_POST )
		{
			$id_array = $_POST['action_to'];
		}
		else
		{
			if ( $id !== NULL )
			{
				$id_array[0] = $id;
			}
		}

		if ( empty($id_array) )
		{
			$this->session->set_flashdata('error', lang('testimonials.id_error'));
			redirect('admin/testimonials');
		}

		// Loop through each ID
		
		foreach ( $id_array as $id)
		{
			// Get the entry
			$testimonial = $this->testimonials_m->get($id);
				
			// Does the entry exist?
			if ( !empty($testimonial) )
			{
				// Delete the entry from the database
				if ( $this->testimonials_m->delete($id) == FALSE )
				{
					$this->session->set_flashdata('error', lang('testimonials.delete_error'));
					redirect('admin/testimonials');
				}
			}
		}
		
		$this->session->set_flashdata('success', lang('testimonials.delete_success'));
		redirect('admin/testimonials');
	}
}