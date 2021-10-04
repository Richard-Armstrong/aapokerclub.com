
<?php $this->load->view("includes/header") ?>

<div class="content">
	<div class="container-fluid">
		<h1>Add Group</h1>

		<?php if ($message) : ?>
			<div><?= $message ?></div>
		<?php endif ?>

		<?= form_open("management/add_group") ?>

		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label class="form-control-label">Group Name</label>
					<input type="text" class="form-control" name="name"/>
				</div>

				<div class="form-group">
					<label class="form-control-label">Description</label>
					<input type="text" class="form-control" name="description"/>
				</div>

				<button type="submit" class="btn btn-primary">Create Group</button>
			</div>
		</div>

		<?= form_close() ?>
	</div>
</div>

<?php $this->load->view("includes/footer") ?>
