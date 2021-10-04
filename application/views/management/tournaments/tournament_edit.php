
<?php $this->load->view("includes/header") ?>
<script>
$(document).ready(function() {
$("#tourney_date").datepicker({ format: 'mm/dd/yyyy' });
});
</script>
<div class="content">
	<div class="container-fluid">
		<h1>Add Tournament</h1>

		<?php if ($message) : ?>
			<div><?= $message ?></div>
		<?php endif ?>

		<?= form_open("management/edit_tournament/{$record->ID}") ?>

		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label class="form-control-label">Tournament Date</label>
					<input class="form-control" type="text" name="tourney_date" id="tourney_date" autocomplete="off" value="<?= date('m/d/Y',strtotime($record->tourney_date)) ?>"/>
				</div>


				<div class="form-group">
					<label class="form-control-label">Location</label>
					<input type="text" class="form-control" name="location" value="<?= $record->location ?>"/>
				</div>

				<div class="form-group">
					<label class="form-control-label">Prize Pool</label>
					<input type="text" class="form-control" name="prize_pool" value="<?= $record->prize_pool ?>"/>
				</div>

				<div class="form-group">
					<label class="form-control-label">Entrants</label>
					<input type="text" class="form-control" name="entrants" value="<?= $record->entrants ?>"/>
				</div>

				<button type="submit" class="btn btn-primary">Update Tournament</button>
			</div>
		</div>

		<?= form_close() ?>
	</div>
</div>

<?php $this->load->view("includes/footer") ?>
