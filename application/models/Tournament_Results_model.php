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
		/*
		// Grab a list of the distinct player_id's from the database
	 	$sql = "select distinct player_id, FirstName from tournament_results
				RIGHT JOIN poker_players PP on PP.ID=player_id";
		$q = $this->db->query($sql);
		$player_list = $q->result();

		$unsorted = array();
		$sorted = array();
		echo "<pre>";

		// Loop through the results and pull the top ten results for each player
		foreach($player_list as $record) {
			$sql = "SELECT points FROM tournament_results
					WHERE player_id={$record->player_id}
					ORDER BY points desc
					LIMIT 10";
			$q = $this->db->query($sql);
			$player_results = $q->result();

			$player_points = 0;
			// Loop through the results and sum the top 10 scores
			foreach($player_results as $tourney_points) {
				$player_points += $tourney_points->points;
			}
			$unsorted[$record->player_id]['player_name'] = $record->FirstName;
			$unsorted[$record->player_id]['total_points'] = $player_points;
		}

		$current_high_score = 0;
		$current_high_name = '';
		$record_count = 0;
		// Now sort the array for display
		//for($x=0;$x<=count($unsorted); $x++) {
		while(!empty($unsorted)) {
			echo "<br>Count - " . count($unsorted) . "<br>";
			foreach($unsorted as $key=>$record) {
				echo "<br>Current_high " . $current_high_score;
				echo "<br>Looking at :" . $record['total_points'];
				if ($record['total_points'] > $current_high_score) {
					$current_high_name = $record['player_name'];
					$current_high_score = $record['total_points'];
					$current_key = $key;
				}
			}
			$sorted[$record_count]['player_id'] = $current_key;
			$sorted[$record_count]['player_name'] = $current_high_name;
			$sorted[$record_count]['total_points'] = $current_high_score;

			$current_high_score=0;
			unset($unsorted[$key]);
			$record_count += 1;
		}
		print_r($sorted);
		die();
*/

		$sql = "select x.player_id, y.FirstName, sum(x.points) AS total_points
				from (
				select r.player_id, r.points,
				row_number() over (partition by r.player_id order by r.player_id, r.points desc) as points_rank
				from tournament_results r
				order by r.player_id, r.points desc
				) x, poker_players y
				where points_rank between 1 and 10
				and x.player_id = y.ID
				group by x.player_id, y.FirstName
				order by sum(x.points) desc, y.FirstName;";
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
