
<?php $this->load->view("includes/header") ?>

<script>
	function confirm_delete() {
		if (confirm("Are you sure you wish to delete this group?"))
			window.location.href = "<?= base_url("index.php/management/delete_group/{$record->id}") ?>";
	}
</script>

<div class="content">
	<div class="container-fluid">
		<h1>Edit Group</h1>

		<?php if ($message) : ?>
			<div><?= $message ?></div>
		<?php endif ?>

		<?= form_open("management/edit_group/{$record->id}") ?>

		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label class="form-control-label">Group Name</label>
					<input type="text" class="form-control" name="name" value="<?= $record->name ?>"/>
				</div>

				<div class="form-group">
					<label class="form-control-label">Description</label>
					<input type="text" class="form-control" name="description" value="<?= $record->description ?>"/>
				</div>

				<button type="submit" class="btn btn-primary">Save Group</button>

				<button type="button" class="btn btn-primary" onclick="confirm_delete()">Delete Group</button>
			</div>
		</div>

		<?= form_close() ?>
	</div>
</div>

<?php $this->load->view("includes/footer") ?>
