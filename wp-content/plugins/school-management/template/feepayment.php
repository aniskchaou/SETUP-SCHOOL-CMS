<?php 
$access=page_access_rolewise_and_accessright();
if($access)
{
$tablename="smgt_payment";
$obj_invoice= new Smgtinvoice();
$obj_feespayment= new Smgt_feespayment();
$active_tab=isset($_REQUEST['tab'])?$_REQUEST['tab']:'feepaymentlist';

if(isset($_POST['add_feetype_payment']))
{
	if($_POST['payment_method'] == 'Paypal')
	{		
		require_once SMS_PLUGIN_DIR. '/lib/paypal/paypal_process.php';				
	}
	else
	{			
		$result=$obj_feespayment->add_feespayment_history($_POST);			
		if($result)
		{
			wp_redirect ( home_url() . '?dashboard=user&page=feepayment&message=1');
		}
	}
}
if(isset($_REQUEST['action'])&& $_REQUEST['action']=='success')
{ ?>
	<div id="message" class="updated below-h2 "><p>
		<?php 	_e('Payment successfully','school-mgt'); ?></p>
	</div>
<?php
}
//if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'ipn')
if(isset($_REQUEST['payment_status']) && $_REQUEST['payment_status'] == 'Completed')
{ 

	$trasaction_id  = $_POST["txn_id"];
	$custom_array = explode("_",$_POST['custom']);
	$feedata['fees_pay_id']=$custom_array[1];

	$feedata['amount']=$_POST['mc_gross_1'];
	$feedata['payment_method']='paypal';	
	$feedata['trasaction_id']=$trasaction_id ;
	
	$PaymentSucces = $obj_feespayment->add_feespayment_history($feedata);
	if($PaymentSucces)
	{
		wp_redirect ( home_url() . '?dashboard=user&page=feepayment&action=success');
	}		
}

if(isset($_REQUEST['action'])&& $_REQUEST['action']=='cancel')
{ ?>
	<div id="message" class="updated below-h2 "><p><?php _e('Payment Cancel','school-mgt');	?></p></div>
<?php
}

if(isset($_POST['save_feetype_payment']))
{
			
	if($_REQUEST['action']=='edit')
	{	
		$result=$obj_feespayment->add_feespayment($_POST);
		if($result)
		{
			wp_redirect ( home_url() . '?dashboard=user&page=feepayment&message=2');
		}
	}
	else
	{
		$result=$obj_feespayment->add_feespayment($_POST);			
		if($result)
		{
			wp_redirect ( home_url() . '?dashboard=user&page=feepayment&message=1');
		}
	}
			
}
if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')
{
	if(isset($_REQUEST['fees_pay_id']))
	{
		$result=$obj_feespayment->smgt_delete_feetpayment_data($_REQUEST['fees_pay_id']);
		if($result)
		{
			wp_redirect ( admin_url() . '?dashboard=user&page=feepayment&message=3');
		}
	}
}
if(isset($_REQUEST['message']))
{
	$message =$_REQUEST['message'];
	if($message == 1){  ?>
		<div id="message" class="updated below-h2 "><p><?php _e('Payment Added successfully','school-mgt');	?></p></div>
	<?php 
	}
	elseif($message == 2)
	{ ?><div id="message" class="updated below-h2 "><p>
		<?php	_e("Payment updated successfully.",'school-mgt');?></p>
		</div>
	<?php 		
	}
elseif($message == 3) 
{ ?>
	<div id="message" class="updated below-h2"><p><?php _e('Payment deleted successfully','school-mgt');?></div></p>
<?php
}
}	
?>

<script type="text/javascript">
$(document).ready(function() {
	//jQuery('#invoice').DataTable();
	//jQuery('#income').DataTable();
	//jQuery('#expense').DataTable();
	$('#invoice_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});
	$('#income_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});
	$('#expense_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});	
	
	$('#invoice_date').datepicker({
		  changeMonth: true,
	        changeYear: true,
	        dateFormat: 'yy-mm-dd',
	        yearRange:'-65:+25',
	        onChangeMonthYear: function(year, month, inst) {
	            $(this).val(month + "/" + year);
	        }
                    
                }); 
} );
</script>
<!-- POP up code -->
<div class="popup-bg">
    <div class="overlay-content">
		<div class="modal-content">
			<div class="invoice_data"></div>     
		</div>
    </div>     
</div>
<!-- End POP-UP Code -->
<script type="text/javascript">
$(document).ready(function() {
	jQuery('#paymentt_list').DataTable({
		 responsive: true,
		"order": [[ 8, "desc" ]],
		"aoColumns":[
	         {"bSortable": false},
	         {"bSortable": true},
	         {"bSortable": true},
	         {"bSortable": true},
	         {"bSortable": true},
	         {"bSortable": true},
			 {"bSortable": true},
			 {"bSortable": true},
			 {"bSortable": true},
	         {"bSortable": false}]
		});
} );
</script>

<?php //$retrieve_class =  get_payment_list();?>
<div class="panel-body panel-white">
 <ul class="nav nav-tabs panel_tabs" role="tablist">
      <li class="<?php if($active_tab=='feepaymentlist'){?>active<?php }?>">
          <a href="?dashboard=user&page=feepayment&tab=feepaymentlist"  class="tab <?php echo $active_tab == 'feepaymentlist' ? 'active' : ''; ?>">
             <i class="fa fa-align-justify"></i> <?php _e('Fees Payment', 'school-mgt'); ?></a>
          </a>
      </li>   
</ul>
		<div class="tab-content">
		<?php 
		if($active_tab == 'feepaymentlist')
		{
		?>
		<div class="panel-body">
		<div class="table-responsive">
			<table id="paymentt_list" class="display dataTable feespayment_datatable" cellspacing="0" width="100%">
				 <thead>
				<tr>                
					<th><?php _e('Fee Type','school-mgt');?></th>   
					<th><?php _e('Student Name','school-mgt');?></th>
					 <th><?php _e('Roll No.','school-mgt');?></th>
					<th><?php _e('Class','school-mgt');?> </th> 
					<th><?php _e('Section','school-mgt');?> </th> 
					<th><?php _e('Payment <BR>Status','school-mgt');?></th>
					<th><?php _e('Amount','school-mgt');?></th>
					<th><?php _e('Due <BR>Amount','school-mgt');?></th>
					<!--<th><?php _e('Description','school-mgt');?></th>-->
					<th><?php _e('Year','school-mgt');?></th>
					<th><?php _e('Action','school-mgt');?></th> 
				</tr>
			</thead>
	 
			<tfoot>
				<tr>
				<th><?php _e('Fee Type','school-mgt');?></th>   
					<th><?php _e('Student Name','school-mgt');?></th>
					 <th><?php _e('Roll No.','school-mgt');?></th>
					<th><?php _e('Class','school-mgt');?> </th> 
					<th><?php _e('Section','school-mgt');?> </th> 
					<th><?php _e('Payment <BR>Status','school-mgt');?></th>
					<th><?php _e('Amount','school-mgt');?></th>
					<th><?php _e('Due <BR>Amount','school-mgt');?></th>
					<!--<th><?php _e('Description','school-mgt');?></th> -->
					<th><?php _e('Year','school-mgt');?></th>                
					<th><?php _e('Action','school-mgt');?></th> 
					  
				</tr>
			</tfoot>
	 
			<tbody>
			  <?php 
				foreach ($school_obj->feepayment as $retrieved_data){ ?>
				<tr>
					<td width="110px"><?php echo get_fees_term_name($retrieved_data->fees_id);?></td>
					<td><?php echo get_user_name_byid($retrieved_data->student_id);?></td>
					<td><?php echo get_user_meta($retrieved_data->student_id, 'roll_id',true);?></td>
					<td><?php echo get_class_name($retrieved_data->class_id);?></td>  
					  <td><?php if($retrieved_data->section_id!=0){ echo smgt_get_section_name($retrieved_data->section_id); }else { _e('No Section','school-mgt');}?></td>
					<td>
						<?php 
						echo "<span class='btn btn-success btn-xs'>";
						echo get_payment_status($retrieved_data->fees_pay_id);
						echo "</span>";						
						?>
					</td>
					<td><?php echo "<span> ". get_currency_symbol() ." </span>" .number_format($retrieved_data->total_amount,2);?></td>
					<?php $Due_amt = $retrieved_data->total_amount-$retrieved_data->fees_paid_amount; ?>
					 <td><?php echo "<span> ". get_currency_symbol() ." </span>" .number_format($Due_amt,2);?></td>
				   
					<!--<td><?php  echo $retrieved_data->description;?></td>  -->
					<td><?php echo $retrieved_data->start_year.'-'.$retrieved_data->end_year;?></td>
					 <td>
					  <?php if($school_obj->role == 'supportstaff' || $school_obj->role == 'parent')
					   { 
						if($retrieved_data->fees_paid_amount < $retrieved_data->total_amount || $retrieved_data->fees_paid_amount == 0){ ?>
					<a href="#" class="show-payment-popup btn btn-default" idtest="<?php echo $retrieved_data->fees_pay_id; ?>" view_type="payment" due_amount="<?php echo number_format($Due_amt,2); ?>" ><?php _e('Pay','school-mgt');?></a>
						<?php }
						} ?> 
					<a href="#" class="show-view-payment-popup btn btn-default" idtest="<?php echo $retrieved_data->fees_pay_id; ?>" view_type="view_payment"><?php _e('View','school-mgt');?></a>
					 <?php /*if($school_obj->role == 'supportstaff')
					   {?>
				   <a href="?dashboard=user&page=feepayment&tab=addpaymentfee&action=edit&fees_pay_id=<?php echo $retrieved_data->fees_pay_id;?>" class="btn btn-info"><?php _e('Edit','school-mgt');?></a>
				  <!-- <a href="?dashboard=user&page=feepayment&tab=feespaymentlist&action=delete&fees_pay_id=<?php echo $retrieved_data->fees_pay_id;?>" class="btn btn-danger"
				   onclick="return confirm('<?php _e('Are you sure you want to delete this record?','school-mgt');?>');"> <?php _e('Delete','school-mgt');?></a> -->
					   <?php } */?>
				   </td>
					   
				   
				</tr>
				<?php } ?>
		 
			</tbody>
			
			</table>
		</div>
        </div>
        <?php }
        if($active_tab == 'addpaymentfee'){
        	?>
        	
<script type="text/javascript">
$(document).ready(function() {
	$('#payment_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});
	$('#end_year').change(function(){
		var end_value = parseInt($('#end_year option:selected').val());
		var start_value = parseInt($('#start_year option:selected').attr("id"));
		if(end_value < start_value)
		{
			alert('You can not select year lower then starting year');
			$("#end_year option[value='']").attr('selected','selected');
		}
		
	});
});
</script>
<?php
		$fees_pay_id=0;
			if(isset($_REQUEST['fees_pay_id']))
				$fees_pay_id=$_REQUEST['fees_pay_id'];
			$edit=0;
				if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
					
					$edit=1;
					$result = $obj_feespayment->smgt_get_single_fee_payment($fees_pay_id);
				}
											?>
  
<div class="panel-body">
<form name="payment_form" action="" method="post" class="form-horizontal" id="payment_form">
          <?php $action = isset($_REQUEST['action'])?$_REQUEST['action']:'insert';?>
		<input type="hidden" name="action" value="<?php echo $action;?>">
		<input type="hidden" name="fees_pay_id" value="<?php echo $fees_pay_id;?>">
		<input type="hidden" name="invoice_type" value="expense">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="class_id"><?php _e('Class','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<?php
				if($edit){ $classval=$result->class_id; }else{$classval='';}?>
                     <select name="class_id" id="class_id" class="form-control validate[required] load_fees">
                     <?php if($addparent){ 
					 		$classdata=get_class_by_id($student->class_name);
						?>
						<option value="<?php echo $student->class_name;?>" ><?php echo $classdata->class_name;?></option>
                     <?php }?>
                    	<option value=""><?php _e('Select Class','school-mgt');?></option>
                            <?php
								foreach(get_allclass() as $classdata)
								{ ?>
								 <option value="<?php echo $classdata['class_id'];?>" <?php selected($classval, $classdata['class_id']);  ?>><?php echo $classdata['class_name'];?></option>
						   <?php }?>
                     </select>
			</div>
		</div>
		<?php if($edit){?>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="student_list"><?php _e('Student','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<?php if($edit){ $classval=$result->class_id; }else{$classval='';}?>
                     
                     <select name="student_id" id="student_list" class="form-control validate[required]">
                      	<option value=""><?php _e('Select student','school-mgt');?></option>
						<?php 
							if($edit)
							{
				echo '<option value="'.$result->student_id.'" '.selected($result->student_id,$result->student_id).'>'.get_user_name_byid($result->student_id).'</option>';
							}
						?>
                     </select>
			</div>
		</div>
		<?php }?>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="category_data"><?php _e('Fee Type','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<select name="fees_id" id="fees_data" class="form-control validate[required]">
					<option value = ""><?php _e('Select Fee Type','school-mgt');?></option>
				<?php 				
				if($edit)
							{
				echo '<option value="'.$result->fees_id.'" '.selected($result->fees_id,$result->fees_id).'>'.get_fees_term_name($result->fees_id).'</option>';
							}
				?>
			</select>
			</div>
			
		</div>
		
		
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="fees_amount"><?php _e('Amount','school-mgt');?>(<?php echo get_currency_symbol();?>)<span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="fees_amount" class="form-control validate[required,min[0],maxSize[8]] text-input" type="number" step="0.01" value="<?php if($edit){ echo $result->total_amount;}elseif(isset($_POST['fees_amount'])) echo $_POST['fees_amount'];?>" name="fees_amount" readonly>
			</div>
		</div>
		<!-- <div class="form-group">
			<label class="col-sm-2 control-label" for="fees_paid_amount"><?php _e('Paid Amount','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="fees_paid_amount" class="form-control validate[required] text-input" type="text" value="<?php if($edit){ echo $result->fees_paid_amount;}elseif(isset($_POST['fees_paid_amount'])) echo $_POST['fees_paid_amount'];?>" name="fees_paid_amount">
			</div>
		</div> -->
		<div class="form-group">
			<label class="col-sm-2 control-label" for="description"><?php _e('Description','school-mgt');?></label>
			<div class="col-sm-8">
				<textarea name="description" class="form-control validate[custom[address_description_validation]]" maxlength="150"> <?php if($edit){ echo $result->description;}elseif(isset($_POST['description'])) echo $_POST['description'];?> </textarea>
				
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="start_year"><?php _e('Year','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-4">
				 <select name="start_year" id="start_year" class="form-control validate[required]">
                      	<option value=""><?php _e('Starting year','school-mgt');?></option>
						<?php 
							$x = 00;
							for($i=2000 ;$i<2030;$i++)
							{
								echo '<option value="'.$i.'"  id="'.$x.'">'.$i.'</option>';
							}
						?>
					</select>
			</div>
			<div class="col-sm-4">
				 <select name="end_year" id="end_year" class="form-control validate[required]">
                      	<option value=""><?php _e('Ending year','school-mgt');?></option>
						<?php 
							for($i=00 ;$i<31;$i++)
							{
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
						?>
					</select>
			</div>
		</div>
		<div class="col-sm-offset-2 col-sm-8">
        	 <input type="submit" value="<?php if($edit){ _e('Save Fee Type','school-mgt'); }else{ _e('Create Fee Type','school-mgt');}?>" name="save_feetype_payment" class="btn btn-success"/>
        </div>
	

</form>
</div>
        	<?php 
        	 }
        
        ?>
        </div>
        </div>
 <?php 
 }
else
{
	wp_redirect ( admin_url () . 'index.php' );
} 
 ?>