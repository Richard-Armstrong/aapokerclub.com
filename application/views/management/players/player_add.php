
<?php $this->load->view("includes/header") ?>

<div class="content">
	<div class="container-fluid">
		<h1>Add Player</h1>

		<?php if ($message) : ?>
			<div><?= $message ?></div>
		<?php endif ?>

		<?= form_open("management/create_player") ?>

		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label class="form-control-label">First Name</label>
					<input type="text" class="form-control" name="FirstName"/>
				</div>

				<div class="form-group">
					<label class="form-control-label">Last Name</label>
					<input type="text" class="form-control" name="LastName"/>
				</div>

				<div class="form-group">
					<label class="form-control-label">Email</label>
					<input type="text" class="form-control" name="email"/>
				</div>

				<div class="form-group">
					<label class="form-control-label">Image URL</label>
					<input type="text" class="form-control" name="img"/>
				</div>

				<button type="submit" class="btn btn-primary">Create Player</button>
			</div>
		</div>

		<?= form_close() ?>
	</div>
</div>

<?php $this->load->view("includes/footer") ?>
