<?php
class Tournament_Results_Model extends MY_Model {
	// Define protected attributes
	public $protected_attributes = array('ID');
	public $_table = 'tournament_results';
	public $primary_key = 'ID';

	public function get_results_by_tourney($tourney_id) {
		// Join this query with the poker_players table to get the first name
		$sql = "SELECT TR.ID, player_id, points, prize, position, FirstName FROM tournament_results TR
				JOIN poker_players PP on (TR.player_id = PP.ID)
				WHERE tourney_id=" . $tourney_id ."
				ORDER BY position";
		$q = $this->db->query($sql);
		return $q->result();
	}

	public function get_results_by_player_id($player_id) {
		$sql = "SELECT points, prize, position, tourney_date FROM tournament_results TR
				JOIN tournaments T on (T.ID = TR.tourney_id)
				WHERE player_id=" . $player_id ." ORDER BY tourney_date";
		$q = $this->db->query($sql);
		return $q->result();
	}


	public function get_leaderboard() {
		$sql = "select y.FirstName, sum(x.points) AS total_points, y.ID as poker_player_id
				from poker_players y,
				(select a.player_id, a.points
				from tournament_results a
				where 10 >= (select count(b.points)
					from tournament_results b
					where a.player_id = b.player_id
					and b.points >= a.points
					group by b.player_id)
				order by a.player_id, a.points desc) x
				where y.ID = x.player_id
				group by y.ID, y.FirstName
				order by total_points desc, y.FirstName;";
		$q = $this->db->query($sql);
		return $q->result();
	}

	public function get_all_results() {
		$sql = "select player_id, tourney_date, position, points, tourney_id, FirstName from tournament_results TR
 				RIGHT JOIN tournaments T on T.ID=tourney_id
				RIGHT JOIN poker_players PP on PP.ID=TR.player_id
				GROUP BY player_id, TR.position, TR.points, tourney_date, tourney_id, FirstName
				ORDER BY player_id, tourney_date, position, points, tourney_id, FirstName";
		$q = $this->db->query($sql);
		return $q->result();
	}

}
