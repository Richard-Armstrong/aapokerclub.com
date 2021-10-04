<?php
class Users_Model extends MY_Model {
	// Define protected attributes
	public $protected_attributes = array('id');
	public $_table = 'users';
	public $primary_key = 'id';

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
