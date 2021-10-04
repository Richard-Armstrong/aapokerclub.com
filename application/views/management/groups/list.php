
<?php $this->load->view("includes/header") ?>

<div class="content">
	<div class="container-fluid">
		<h1>
			Groups
			<a href="<?= base_url("index.php/management/add_group") ?>" class="btn btn-primary">Add Group</a>
		</h1>

		<?php if ($message) : ?>
			<div><?= $message ?></div>
		<?php endif ?>

		<div class="card">
			<div class="card-body">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th>Name</th>
							<th>Description</th>
							<th></th>
						</tr>
					</thead>

					<tbody>
					<?php foreach ($group_records as $row) : ?>
						<tr>
							<td><?= htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8') ?></td>
							<td><?= htmlspecialchars($row->description, ENT_QUOTES, 'UTF-8') ?></td>
							<td><a href="<?= base_url("index.php/management/edit_group/{$row->id}") ?>" class="btn btn-primary btn-sm">Edit</a></td>
						</tr>
					<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view("includes/footer") ?>
