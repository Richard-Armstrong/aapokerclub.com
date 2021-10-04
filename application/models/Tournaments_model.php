<?php
class Tournaments_Model extends MY_Model {
	// Define protected attributes
	public $protected_attributes = array('ID');
	public $_table = 'tournaments';
	public $primary_key = 'ID';

	public function get_all_tournaments() {

		$sql = "SELECT ID, tourney_date, location, prize_pool, entrants from tournaments ORDER BY tourney_date";
		$q = $this->db->query($sql);
		return $q->result();
	}

	public function get_prize_pool() {
		$sql = "SELECT SUM(prize_pool) as total_prize_pool FROM tournaments ";
		$q = $this->db->query($sql);
		return $q->result()[0]->total_prize_pool;
	}

}
