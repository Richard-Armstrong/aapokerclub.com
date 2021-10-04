
<?php $this->load->view("includes/header") ?>

<div class="content">
	<div class="container-fluid">
		<h1>Players</h1>

		<?php if ($message) : ?>
			<div><?= $message ?></div>
		<?php endif ?>

		<div class="card">
			<div class="card-body">
				<table class="table table-striped">
					<tr>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email</th>

						<th>Action</th>
					</tr>

					<?php
					foreach ($player_records as $player) {
						echo "<tr>";
							// First Name
							echo "<td>" . htmlspecialchars($player->FirstName, ENT_QUOTES, 'UTF-8') . "</td>";
							// Last Name
							echo "<td>" . htmlspecialchars($player->LastName, ENT_QUOTES, 'UTF-8') . "</td>";
							// Email
							echo "<td>" . htmlspecialchars($player->email, ENT_QUOTES, 'UTF-8') . "</td>";

							// Edit
							echo "<td>" . anchor("management/edit_player/{$player->ID}", 'Edit') . "</td>";
						echo "</tr>";
					}
					?>
				</table>

				<a href="<?= base_url("index.php/management/create_player") ?>" class="btn btn-primary">Create</a>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view("includes/footer") ?>
