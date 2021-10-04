<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);

class Admin extends MY_Controller {
	function __construct() {
		parent::__construct();
		// Check if the User has access to these functions
		if (!$this->session->userdata('user')->is_admin)
			return show_error("You lack permission to access this page.");
	}

	public function index() {
		redirect ('/');
	}

	public function logout() {
		$this->load->library('ion_auth');
		$this->ion_auth->logout();

		redirect ('/');
	}

	/************************************************************** NVP Codes */
	public function nvp_codes($current_context = 'Yes_No') {
		// Load dropdown of all contexts
		$this->load->model("nvp_codes_model");
		$data['context_list'] = $this->nvp_codes_model->get_context_list();
		// Load the data for the current context
		$this->db->where('context', $current_context);
		$this->db->order_by('seq');
		$data['nvp_data'] = $this->nvp_codes_model->get_all();
		// Provide non-loaded data for view
		$data['current_context'] = $current_context;
		// Load view
		$this->load->view("admin/nvp_codes", $data);
	}

	public function handle_nvp_form() {
		// Pull form data
		$the_action = $this->input->post('the_action');
		$nvp_codes_id = $this->input->post('recordSelected');
		// Load the data to update the Name Value Pair
		$data = array (
			'context'	=> $this->input->post('Update_1'),
			'seq'		=> $this->input->post('Update_2'),
			'display'	=> $this->input->post('Update_3'),
			'theValue'	=> $this->input->post('Update_4'),
			'altValue'	=> $this->input->post('Update_5')
		);
		// Insert, update, or delete based on the action chosen in the view
		$this->load->model('nvp_codes_model');
		if ($the_action == "Create")
			$this->nvp_codes_model->insert($data);
		elseif ($the_action == "Save")
			$this->nvp_codes_model->update($nvp_codes_id, $data, TRUE);
		elseif ($the_action == "Delete")
			$this->nvp_codes_model->delete($nvp_codes_id);
		// Reload the page with the specified context
		redirect ("admin/nvp_codes/{$this->input->post('Update_1')}", 'refresh');
	}

	/********************************************************** Miscellaneous */
	public function php_info() {
		phpInfo();
	}
}
