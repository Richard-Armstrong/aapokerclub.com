
<?php $this->load->view("includes/header") ?>

<script>
	function confirm_delete() {
		if (confirm("Are you sure you wish to delete this group?"))
			window.location.href = "<?= base_url("index.php/management/delete_delete/{$record->id}") ?>";
	}
</script>

<div class="content">
	<div class="container-fluid">
		<h1>Edit Player</h1>

		<?php if ($message) : ?>
			<div><?= $message ?></div>
		<?php endif ?>

		<?= form_open("management/edit_player/{$record->ID}") ?>

		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label class="form-control-label">First Name</label>
					<input type="text" class="form-control" name="FirstName" value="<?= $record->FirstName ?>"/>
				</div>
				<div class="form-group">
					<label class="form-control-label">Last Name</label>
					<input type="text" class="form-control" name="LastName" value="<?= $record->LastName ?>"/>
				</div>
				<div class="form-group">
					<label class="form-control-label">Email</label>
					<input type="text" class="form-control" name="email" value="<?= $record->email ?>"/>
				</div>

				<div class="form-group">
					<label class="form-control-label">Image URL</label>
					<input type="text" class="form-control" name="img" value="<?= $record->img ?>"/>
				</div>

				<button type="submit" class="btn btn-primary">Save Player</button>

				<button type="button" class="btn btn-primary" onclick="confirm_delete()">Delete Player</button>
			</div>
		</div>

		<?= form_close() ?>

		<div class="card">
			<div class="card-body">
				<table class="table table-striped">
					<tr>
						<th>Date</th>
						<th>Finish</th>
						<th>Points</th>
					</tr>
					<?php
					$count = 0;
					$total_points = 0;
					$finish_position = 0;
					foreach ($tournament_records as $tourney) {
						echo "<tr>";
							// First Name    date('d/m/Y',strtotime($test1));
							echo "<td>" . date('m/d/Y',strtotime($tourney->tourney_date)) . "</td>";
							// Last Name
							echo "<td>" . htmlspecialchars($tourney->position, ENT_QUOTES, 'UTF-8') . "</td>";
							// entrants
							echo "<td>" . htmlspecialchars($tourney->points, ENT_QUOTES, 'UTF-8') . "</td>";

						echo "</tr>";
						$count += 1;
						$total_points += $tourney->points;
						$finish_position += $tourney->position;
					}
					?>
					<tr>
						<td>&nbsp;</td>
						<td><?php echo number_format($finish_position/$count, 2) ?></td>

						<td><?php echo number_format($total_points/$count, 2) ?> </td>
					</tr>

				</table>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view("includes/footer") ?>
