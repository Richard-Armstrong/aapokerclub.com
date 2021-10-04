<?php
class Players_Model extends MY_Model {
	// Define protected attributes
	public $protected_attributes = array('ID');
	public $_table = 'poker_players';
	public $primary_key = 'ID';

	public function get_all_players() {

		$sql = "SELECT ID, FirstName, LastName, email, img from poker_players ORDER BY FirstName";
		$q = $this->db->query($sql);
		return $q->result();
	}

	public function get_players_dropdown($header_text = NULL, $header_value = NULL) {
		$data = NULL;
		if ($header_text !== NULL) {
			$data[$header_value] = $header_text;
		}
		$sql = "SELECT ID, FirstName from poker_players ORDER BY FirstName";
		$q = $this->db->query($sql);
		if ($q->num_rows() > 0) {
			$dropdowns = $q->result();
			foreach ($dropdowns as $dropdown) {
				$data[$dropdown->ID] = $dropdown->FirstName;
			}
		}

		return $data;
	}

	public function get_user_id_array($company_id = NULL, $header_text = NULL, $header_value = NULL, $straight_names = NULL) {
		$data = NULL;
		if ($header_text !== NULL) {
			$data[$header_value] = $header_text;
		}

		if ($straight_names) {
			$sql = "SELECT id, CONCAT(first_name, ' ', last_name) as name
					FROM users";
		} else {
			$sql = "SELECT id, CONCAT(last_name, ', ', first_name) as name
					FROM users";
		}

		if ($company_id)
			$sql .= "\nWHERE company={$company_id}";

		$q = $this->db->query($sql);
		if ($q->num_rows() > 0) {
			$dropdowns = $q->result();
			foreach ($dropdowns as $dropdown) {
				$data[$dropdown->id] = $dropdown->name;
			}
		}

		return $data;
	}
}
