
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

		<?= form_open("management/create_tournament") ?>

		<div class="card">
			<div class="card-body">
				<div class="form-group">
					<label class="form-control-label">Tournament Date</label>
					<input class="form-control" type="text" value=""
					name="tourney_date" id="tourney_date" autocomplete="off"/>
				</div>


				<div class="form-group">
					<label class="form-control-label">Location</label>
					<input type="text" class="form-control" name="location"/>
				</div>

				<div class="form-group">
					<label class="form-control-label">Prize Pool</label>
					<input type="text" class="form-control" name="prize_pool"/>
				</div>

				<div class="form-group">
					<label class="form-control-label">Entrants</label>
					<input type="text" class="form-control" name="entrants"/>
				</div>

				<button type="submit" class="btn btn-primary">Create Tournament</button>
			</div>
		</div>

		<?= form_close() ?>
	</div>
</div>

<?php $this->load->view("includes/footer") ?>
