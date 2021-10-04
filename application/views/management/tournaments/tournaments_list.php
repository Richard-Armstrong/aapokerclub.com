
<?php $this->load->view("includes/header") ?>

<div class="content">
	<div class="container-fluid">
		<h1>Tournaments</h1>

		<?php if ($message) : ?>
			<div><?= $message ?></div>
		<?php endif ?>

		<div class="card">
			<div class="card-body">
				<table class="table table-striped">
					<tr>
						<th>Date</th>
						<th>Location</th>
						<th>Entrants</th>
						<th>Prize Pool</th>

						<th>Action</th>
					</tr>

					<?php
					$total_prize_pool = 0;
					$count = 0;
					$total_entrants = 0;
					foreach ($tournament_records as $tourney) {
						echo "<tr>";
							// First Name    date('d/m/Y',strtotime($test1));
							echo "<td>" . date('m/d/Y',strtotime($tourney->tourney_date)) . "</td>";
							// Last Name
							echo "<td>" . htmlspecialchars($tourney->location, ENT_QUOTES, 'UTF-8') . "</td>";
							// entrants
							echo "<td>" . htmlspecialchars($tourney->entrants, ENT_QUOTES, 'UTF-8') . "</td>";
							$total_entrants += $tourney->entrants;

							// Email
							echo "<td>$" . htmlspecialchars($tourney->prize_pool, ENT_QUOTES, 'UTF-8') . "</td>";
							$total_prize_pool += $tourney->prize_pool;
							// Edit
							echo "<td>" . anchor("management/show_tournament_results/{$tourney->ID}", 'Results') . " "
										. anchor("management/edit_tournament/{$tourney->ID}", 'Edit') . "</td>";
						echo "</tr>";
						$count += 1;
					}
					?>
					<tr>
						<td></td>
						<td></td>
						<td>Avg <?php echo number_format($total_entrants/$count,2); ?></td>
						<td>Total: $<?php echo number_format($total_prize_pool); ?></td>
					</tr>

				</table>

				<a href="<?= base_url("index.php/management/create_tournament") ?>" class="btn btn-primary">Create</a>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view("includes/footer") ?>
