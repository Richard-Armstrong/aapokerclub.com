<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);

class Management extends MY_Controller {
	public function index() {
		redirect ('/');
	}


	public function tourneys() {
		$this->load->model('tournaments_model');
		$data['message'] = null;
		$data['tournament_records'] = $this->tournaments_model->get_all_tournaments();

		$this->load->view("management/tournaments/tournaments_list", $data);
	}
	private function validate_date($date) {
		$array = explode('/', $date, 3);
		if (count($array) == 3)
			return checkdate($array[0], $array[1], $array[2]);
		else
			return FALSE;
	}


	public function show_tournament_results($id) {
		if ($id == '' or $id == null) {
			redirect('management/tourneys');
		}

		// Get the results and pass them to the view.
		$this->load->model('tournaments_model');
		$data['tournament_record'] = $this->tournaments_model->get($id);

		// Load the tourney results to display
		$this->load->model('tournament_results_model');
		$data['tournament_results'] = $this->tournament_results_model->get_results_by_tourney($id);

		// Load the this of players
		$this->load->model('players_model');
		$data['players_list'] = $this->players_model->get_players_dropdown();

		$numeric_array = array();
		// Load an array for dropdowns based on the number of tourney entries.
		for ($x = 1; $x <= $data['tournament_record']->entrants; $x++) {
  			$numeric_array[$x] = $x;
		}
		$data['numeric_dropdown'] = $numeric_array;

		// Load the view
		$this->load->view("management/tournaments/results_list", $data);
	}

	public function handle_player_results_form() {
		// Pull form data
		$the_action = $this->input->post('the_action');
		$nvp_codes_id = $this->input->post('recordSelected');
		$tourney_id = $this->input->post('tourney_id');

		// Load the data to update the Name Value Pair
		$data = array (
			'player_id'	=> $this->input->post('Player_ID'),
			'position'		=> $this->input->post('Position'),
			'points'	=> $this->input->post('Points'),
			'tourney_id'=> $tourney_id
		);
		// Insert, update, or delete based on the action chosen in the view
		$this->load->model('tournament_results_model');
		if ($the_action == "Create")
			$this->tournament_results_model->insert($data);
		elseif ($the_action == "Save")
			$this->tournament_results_model->update($nvp_codes_id, $data, TRUE);
		elseif ($the_action == "Delete")
			$this->tournament_results_model->delete($nvp_codes_id);
		// Reload the page with the specified context
		redirect ("management/show_tournament_results/{$tourney_id}", 'refresh');
	}

	public function edit_tournament($id) {
		$format = 'm/d/Y';
		$db_format = 'Y-m-d';

		$tourney_date = $this->input->post('tourney_date');
		$this->load->model('tournaments_model');

		if ($this->validate_date($tourney_date)) {
			$tourney_date_time = DateTime::createFromFormat($format, $tourney_date);
		}

		// Redirect to the tournaments list if given no ID
		if (!$id || empty($id))
			redirect ("management/tournaments");

		// Check if a non-Admin is altering the base groups
		if (!$this->session->userdata('user')->is_admin && ($id == ADMINISTRATION || $id == UNASSIGNED))
			return show_error("You lack permission to access this page.");

		// Set validation rules
		$this->form_validation->set_rules('tourney_date', 'Tournament Date', 'required');
		// Based on form validation, load the page or update the Player
		if ($this->form_validation->run() === FALSE) {
			// Load the Player's record
			$data['record'] = $this->tournaments_model->get($id);
			// Set the flash data error message if there is an error
			$data['message'] = validation_errors() ? validation_errors() : $this->session->flashdata('message');
			// Load view
			$this->load->view("management/tournaments/tournament_edit", $data);
		} else {
			// Pull form data
			$data = array (
				'tourney_date' => $tourney_date_time->format($db_format),
				'location' => trim($this->input->post('location')),
				'prize_pool' => trim($this->input->post('prize_pool')),
				'entrants' => trim($this->input->post('entrants'))
			);

			// update the tourney record
			$this->tournaments_model->update($id,$data);
			// Redirect to the Groups list
			redirect ("management/tourneys");
		}
	}

	public function create_tournament() {
		$format = 'm/d/Y';
		$db_format = 'Y-m-d';

		$tourney_date = $this->input->post('tourney_date');

		if ($this->validate_date($tourney_date)) {
			$tourney_date_time = DateTime::createFromFormat($format, $tourney_date);
		}

		// Set validation rules
		$this->form_validation->set_rules('tourney_date', 'Tournament Date', 'required');
		// Based on form validation, load the page or create the new Group
		if ($this->form_validation->run() === FALSE) {
			// Set the flash data error message if there is an error
			$data['message'] = validation_errors() ? validation_errors() : $this->session->flashdata('message');

			// Load view
			$this->load->view("management/tournaments/tournament_add", $data);
		} else {
			// Pull form data
			$data = array (
				'tourney_date' => $tourney_date_time->format($db_format),
				'location' => trim($this->input->post('location')),
				'prize_pool' => trim($this->input->post('prize_pool')),
				'entrants' => trim($this->input->post('entrants'))
			);

			// Create the new Group
			$this->load->model('tournaments_model');
			$this->tournaments_model->insert($data);
			// Redirect to the Groups list
			redirect ("management/tourneys");
		}
	}

	public function players() {
		$this->load->model('players_model');

		$data['message'] = null;
		$data['player_records'] = $this->players_model->get_all_players();

		$this->load->view("management/players/players_list_view", $data);
	}

	public function create_player() {
		// Set validation rules
		$this->form_validation->set_rules('FirstName', 'First Name', 'required|alpha_dash');
		// Based on form validation, load the page or create the new Group
		if ($this->form_validation->run() === FALSE) {
			// Set the flash data error message if there is an error
			$data['message'] = validation_errors() ? validation_errors() : $this->session->flashdata('message');
			// Load view
			$this->load->view("management/players/player_add", $data);
		} else {
			// Pull form data
			$data = array (
				'FirstName' => trim($this->input->post('FirstName')),
				'LastName' => trim($this->input->post('LastName')),
				'email' => trim($this->input->post('Email')),
				'img' => trim($this->input->post('img'))
			);

			// Create the new Group
			$this->load->model('players_model');
			$this->players_model->insert($data);
			// Redirect to the Groups list
			redirect ("management/players");
		}
	}


	public function edit_player($id) {
		$this->load->model('players_model');

		// Redirect to the Groups list if given no ID
		if (!$id || empty($id))
			redirect ("management/players");
		// Check if a non-Admin is altering the base groups
		if (!$this->session->userdata('user')->is_admin && ($id == ADMINISTRATION || $id == UNASSIGNED))
			return show_error("You lack permission to access this page.");
		// Set validation rules
		$this->form_validation->set_rules('FirstName', 'First Name', 'required|alpha_dash');
		// Based on form validation, load the page or update the Player
		if ($this->form_validation->run() === FALSE) {
			// Load the Player's record
			$data['record'] = $this->players_model->get($id);
			// Set the flash data error message if there is an error
			$data['message'] = validation_errors() ? validation_errors() : $this->session->flashdata('message');

			// Grab the tourney results to display for error checking
			$this->load->model('tournament_results_model');
			$data['tournament_records'] = $this->tournament_results_model->get_results_by_player_id($id);

			// Load view
			$this->load->view("management/players/player_edit", $data);
		} else {
			// Pull form data
			$data = array(
				'FirstName' => trim($this->input->post('FirstName')),
				'LastName' => trim($this->input->post('LastName')),
				'email' => trim($this->input->post('email')),
				'img' => trim($this->input->post('img'))
			);

			$this->players_model->update($id, $data);
			$this->session->set_flashdata('message', "Group updated");

			// Redirect to the Players list
			redirect ("management/players");
		}
	}

	public function delete_player($id) {
		$this->load->model('players_model');

		
	}

	/************************************************************ Groups */
	public function groups() {
		$this->load->library('ion_auth');

		// Load Groups list
		$data['group_records'] = $this->ion_auth->groups();
		//echo("<pre>");
		//print_r($data['group_records']);
		//echo("</pre>");
		die;

		// Set the flash data error message if there is an error
		$data['message'] = validation_errors() ? validation_errors() : $this->session->flashdata('message');
		// Load view
		$this->load->view("management/groups/list", $data);
	}

	public function add_group() {
		// Set validation rules
		$this->form_validation->set_rules('name', 'Group Name', 'required|alpha_dash');
		// Based on form validation, load the page or create the new Group
		if ($this->form_validation->run() === FALSE) {
			// Set the flash data error message if there is an error
			$data['message'] = validation_errors() ? validation_errors() : $this->session->flashdata('message');
			// Load view
			$this->load->view("management/groups/add", $data);
		} else {
			// Pull form data
			$group_name = trim($this->input->post('name'));
			$group_description = trim($this->input->post('description'));
			// Create the new Group
			$this->load->library('ion_auth');
			$this->ion_auth->create_group($group_name, $group_description);
			// Redirect to the Groups list
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect ("management/groups");
		}
	}

	public function edit_group($id) {
		// Redirect to the Groups list if given no ID
		if (!$id || empty($id))
			redirect ("management/groups");
		// Check if a non-Admin is altering the base groups
		if (!$this->session->userdata('user')->is_admin && ($id == ADMINISTRATION || $id == UNASSIGNED))
			return show_error("You lack permission to access this page.");
		// Set validation rules
		$this->form_validation->set_rules('name', 'Group Name', 'required|alpha_dash');
		// Based on form validation, load the page or update the Group
		if ($this->form_validation->run() === FALSE) {
			// Load the Group's record
			$data['record'] = $this->ion_auth->group($id)->row();
			// Set the flash data error message if there is an error
			$data['message'] = validation_errors() ? validation_errors() : $this->session->flashdata('message');
			// Load view
			$this->load->view("management/groups/edit", $data);
		} else {
			// Pull form data
			$group_name = trim($this->input->post('name'));
			$group_description = trim($this->input->post('description'));
			// Attempt to update the Group and set flashdata message based on the success or failure of the update
			$this->load->library('ion_auth');
			if ($this->ion_auth->update_group($id, $group_name, $group_description))
				$this->session->set_flashdata('message', "Group updated");
			else
				$this->session->set_flashdata('message', $this->ion_auth->errors());
			// Redirect to the Groups list
			redirect ("management/groups");
		}
	}

	public function delete_group($id) {
		// Redirect to the Groups list if given no ID
		if (!$id || empty($id))
			redirect ("management/groups");
		// Check if a non-Admin is altering the base groups
		if (!$this->session->userdata('user')->is_admin && ($id == ADMINISTRATION || $id == UNASSIGNED))
			return show_error("You lack permission to access this page.");
		// Remove all Users from this Groups
		$this->load->library('ion_auth');
		$users = $this->ion_auth->users($id)->result();
		foreach ($users as $user) {
			$this->ion_auth->remove_from_group($id, $user->id);
			// If the User is part of no Group after removal, add them to Unassigned
			if (!$this->ion_auth->get_users_groups($user->id)->result())
				$this->ion_auth->add_to_group(UNASSIGNED, $user->id);
		}
		// Attempt to delete the Group and report the result
		if ($this->ion_auth->delete_group($id))
			$this->session->set_flashdata('message', "Group deleted");
		else
			$this->session->set_flashdata('message', "Group deletion failed");
		// Redirect to the Groups list
		redirect ("management/groups");
	}
}
