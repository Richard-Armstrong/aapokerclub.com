<script type="text/javascript">
function loadit( index )
{
    document.getElementById( "theID" ).value=index;
    theVal = eval( "document.myForm.Context_" + index + ".value") ;
    document.myForm.Update_1.value = document.myForm.value = theVal;
    theVal = eval( "document.myForm.Seq_" + index + ".value") ;
    document.myForm.Update_2.value = document.myForm.value = theVal;
    theVal = eval( "document.myForm.Display_" + index + ".value") ;
    document.myForm.Update_3.value = document.myForm.value = theVal;
    theVal = eval( "document.myForm.Value_" + index + ".value") ;
    document.myForm.Update_4.value = document.myForm.value = theVal;
    theVal = eval( "document.myForm.AltValue_" + index + ".value") ;
    document.myForm.Update_5.value = document.myForm.value = theVal;
}
function processAction( theAction )
{
  document.myForm.theAction.value=theAction;
  document.myForm.submit();
}

function processCreate()
{
  if ( document.myForm.Update_1.value != "")
  {
    processAction( "CREATE" );
  }
  else
  {
    alert( "Context is required");
    document.myForm.Update_1.focus();
  }
}

function processDelete()
{
  if ( confirm( "Are you sure you wish to delete this record?" ) )
  {
    processAction( "DELETE" );
  }
}

function trapEnter(e)
{
   var retVal = true;
   if(navigator.appName == 'Netscape' && e.which == 13) {
       processAction( 'SAVE' )
       retVal = false;
   } else if(window.event.keyCode == 13) {
       processAction( 'SAVE' )
       retVal = false;
   }
   return retVal;
}

function change_context()
{
	var e = document.getElementById('the_context');
	var theValue = e.options[e.selectedIndex].value;

    location.href="<?php echo site_url("/maintenance/nvp_codes/")?>/" + theValue;
}
</script>

			<div id="center-column">
                <div class="page-header">

                    <h1>Edit NVP Codes</h1>

                </div>
                <div class="table">
                <?php
                $other = 'name="myForm"';
                echo form_open('maintenance/handle_nvp_form', $other)
                ?>
                    <table class="table"  >
                        <tr>
                            <th>
  	                          <?php
  	                          $id='id="the_context"';
  	                          echo form_dropdown('the_context', $context_list, $current_context, $id) ?>
                   
                             <a class="btn btn-primary btn-large" onClick="change_context()">Get List &raquo;</a>
                            </th>

                        </tr>
                    </table>
               </div>

                <div class="table">
                    <table class="table table-striped"  >
              			<tr>
                        	<th style="width:10px" >&nbsp;</th>
              				<th>Context</th>
              				<th>Seq</th>
              				<th>Display</th>
              				<th>Value</th>
              				<th>Alt</th>
              			</tr>

              			 <?php foreach($nvp_data as $row): ?>

                        <tr>
	                    	<td>
	                    	<?php
	                    	$id = $row->id;
	                    	$loadit = 'loadit('.$id.')';


	                    	$data = array(
								'name' => 'recordSelected',
								'value' => $id,
								'onClick' => $loadit
	                    	);
							echo form_radio($data);
	                    	?>
	                        </td>
	                        <td>
	                        	<?php echo $row->context?>
	                        	<input type="hidden" name="Context_<?php echo $row->id?>" value="<?php echo $row->context?>" />
	                        </td>
	                        <td>
	                        	<?php echo $row->seq?>
	                        	<input type="hidden" name="Seq_<?php echo $row->id?>" value="<?php echo $row->seq?>" />
	                        </td>
                  			<td>
	                        	<?php echo $row->display?>
	                        	<input type="hidden" name="Display_<?php echo $row->id?>" value="<?php echo $row->display?>" />
	                        </td>
	                        <td>
	                        	<?php echo $row->theValue?>
	                        	<input type="hidden" name="Value_<?php echo $row->id?>" value="<?php echo $row->theValue?>" />
	                        </td>
	                        <td>
	                        	<?php echo $row->altValue?>
	                        	<input type="hidden" name="AltValue_<?php echo $row->id?>" value="<?php echo $row->altValue?>" />
	                        </td>
                        </tr>
 						<?php endforeach; ?>

					 	<tr>
					        
					        <TD >&nbsp;<input type="hidden" name="theID" id="theID" value=""></td>
					        <td><input type="text" name="Update_1" class="input-small" maxlength="40" value="<?php echo $current_context?>" onKeyPress="trapEnter('')" /></td>
					        <td><input type="text" name="Update_2" class="input-mini" maxlength="10" onKeyPress="trapEnter('')" /></td>
					        <td><input type="text" name="Update_3" class="input-medium" maxlength="40" onKeyPress="trapEnter('')" /></td>
					        <td><input type="text" name="Update_4" class="input-medium" maxlength="40" onKeyPress="trapEnter('')" /></td>
					        <td><input type="text" name="Update_5" class="input-medium" maxlength="40" onKeyPress="trapEnter('')" /></td>

					      </tr>
                    </table>
                    <input type="submit" name="the_action" value="Save" />
                     <input type="submit" name="the_action" value="Create" />
                     <input type="submit" name="the_action" value = "Delete" />
                </div>


            </div>
             </form>