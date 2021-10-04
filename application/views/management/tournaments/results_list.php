
<?php $this->load->view("includes/header") ?>


		<script>
			function loadit(index) {
				//alert(index);
				theVal = eval( "document.myForm.Player_" + index + ".value");
				document.querySelector("#Player_ID").value = theVal;

				theVal = eval( "document.myForm.Position_" + index + ".value");
				document.querySelector("#Position").value = theVal;

				theVal = eval( "document.myForm.Points_" + index + ".value");
				document.querySelector("#Points").value = theVal;

				//document.getElementById("Points").selectedIndex = theVal;

				//document.myForm.Update_1.value = document.myForm.value = theVal;

				//document.myForm.Update_2.value = document.myForm.value = theVal;
				//theVal = eval( "document.myForm.Display_" + index + ".value");
				//document.myForm.Update_3.value = document.myForm.value = theVal;
			}

			function processAction(theAction) {
				document.myForm.theAction.value = theAction;
				document.myForm.submit();
			}

			function processCreate() {
				if (document.myForm.Update_1.value != "") {
					processAction("CREATE");
				} else {
					alert("Context is required");
					document.myForm.Update_1.focus();
				}
			}

			function processDelete() {
				if (confirm("Are you sure you wish to delete this record?"))
					processAction("DELETE");
			}

			function trapEnter(e) {
				var retVal = true;
				if (navigator.appName == 'Netscape' && e.which == 13) {
					processAction('SAVE')
					retVal = false;
				} else if (window.event.keyCode == 13) {
					processAction('SAVE')
					retVal = false;
				}

				return retVal;
			}

			function change_context() {
				var theValue = document.getElementById('the_context').selectedOptions[0].value;
				location.href = "<?= base_url("index.php/admin/nvp_codes/") ?>" + theValue;
			}
		</script>
		<div class="content">
			<div class="container-fluid">
				<h1>Tournament Results - <?php echo date('m/d/Y',strtotime($tournament_record->tourney_date)); ?></h1>

				<?= form_open("management/handle_player_results_form", array( 'name' => 'myForm' )) ?>
				<input type="hidden" name="tourney_id" value="<?php echo $tournament_record->ID; ?>" />
				<div class="card">
					<div class="card-body">
						<table class="table table-striped">
							<tr>
								<th style="width:10px;">&nbsp;</th>
								<th>Player</th>
								<th>Position</th>
								<th>Points</th>

							</tr>

							<?php foreach ($tournament_results as $row) : ?>
								<tr>
									<td>
										<?php
										$id = $row->ID;
										$loadit = "loadit({$id})";
										$data = array(
											'name'		=> 'recordSelected',
											'value'		=> $id,
											'onClick'	=> "loadit({$id})"
										);

										echo form_radio($data);
										?>
									</td>

									<td>
										<?= $row->FirstName ?>
										<input type="hidden" name="Player_<?= $row->ID ?>" value="<?= $row->player_id ?>"/>
									</td>

									<td>
										<?= $row->position ?>
										<input type="hidden" name="Position_<?= $row->ID ?>" value="<?= $row->position ?>"/>
									</td>

									<td>
										<?= $row->points ?>
										<input type="hidden" name="Points_<?= $row->ID ?>" value="<?= $row->points ?>"/>
									</td>


								</tr>
							<?php endforeach ?>

							<tr>
								<td>&nbsp;<input type="hidden" name="theID" id="theID" value=""></td>
								<td><?php echo form_dropdown("Player_ID", $players_list, '', 'id="Player_ID"'); ?></td>
								<td><?php echo form_dropdown("Position", $numeric_dropdown, '', 'id="Position"'); ?></td>
								<td><?php echo form_dropdown("Points", $numeric_dropdown, '', 'id="Points"'); ?></td>


							</tr>
						</table>

						<input type="submit" class="btn btn-secondary" name="the_action" value="Save"/>
						<input type="submit" class="btn btn-secondary" name="the_action" value="Create"/>
						<input type="submit" class="btn btn-secondary" name="the_action" value="Delete"/>
					</div>
				</div>

				<?= form_close() ?>
			</div>
		</div>

		<?php $this->load->view("includes/footer") ?>
