<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
ini_set('display_errors',1);
error_reporting(E_ALL|E_STRICT);

class Main extends CI_Controller {
	public function index() {
		// Set the flash data error message if there is an error
		$data['message'] = validation_errors() ? validation_errors() : $this->session->flashdata('message');

		// Grab the prize pool
		$this->load->model("tournaments_model");
		$data['prize_pool'] = $this->tournaments_model->get_prize_pool();

		// Grab the standings to display.
		$this->load->model("tournament_results_model");
		$data['leaderboard_records'] = $this->tournament_results_model->get_leaderboard();

		// Grab the list of all players results then load them into separate arrays for divs
		$all_results = $this->tournament_results_model->get_all_results();

		//echo "<pre>";
		//print_r($all_results);
		//die();
		$results_array = array();

		// Loop through those results and place them in separate array items for display
		$current_id=0;
		foreach($all_results as $record) {
			if ($record->player_id != $current_id) {
				$current_id = $record->player_id;
			}
			$results_array[$current_id][$record->tourney_id]['FirstName'] = $record->FirstName;
			$results_array[$current_id][$record->tourney_id]['tourney_date'] = $record->tourney_date;
			$results_array[$current_id][$record->tourney_id]['position'] = $record->position;
			$results_array[$current_id][$record->tourney_id]['points'] = $record->points;
		}
		//echo "<pre>";
		//foreach ($results_array as $key => $value) {
		//	print_r($value);
		//}
		//die();
		$data['all_results'] = $results_array;

		// Load views
		$this->load->view("landings/home", $data);
	}
}
