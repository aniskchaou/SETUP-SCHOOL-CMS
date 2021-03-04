<script type="text/javascript">
 $(document).ready(function() {
	  $('#class_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});
 } );
 </script>
 <script type="text/javascript">
$(document).ready(function() {
	 $('#class_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});
	 $('.datepicker').datepicker({
		minDate:0,
		beforeShow: function (textbox, instance) 
			{
				instance.dpDiv.css({
					marginTop: (-textbox.offsetHeight) + 'px'                   
				});
			}
	 });
} );
</script>
<?php 			
$class_obj=new Smgt_Homework();
?>
   <?php 
		$edit=0;
		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit')
		{
			$edit=1;
			$objj=new Smgt_Homework();
			$classdata= $objj->get_edit_record($_REQUEST['homework_id']);
		} 
					
	?>
       
    <div class="panel-body">	
        <form name="class_form" action="" method="post" class="form-horizontal" id="class_form">
		    <?php $action = isset($_REQUEST['action'])?$_REQUEST['action']:'insert';?>
			<input type="hidden" name="action" value="<?php echo $action;?>">
				<div class="form-group">
					<label class="col-sm-2 control-label" for="class_name"><?php _e('Title','school-mgt');?><span class="require-field">*</span></label>
					<div class="col-sm-8">
						<input id="title" class="form-control validate[required]" type="text" value="<?php if($edit){ echo $classdata->title;}?>" name="title">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="class_name"><?php _e('Select Class','school-mgt');?><span class="require-field">*</span></label>
					<div class="col-sm-8">
						<?php if($edit){ $classval=$classdata->class_name; }elseif(isset($_POST['class_name'])){$classval=$_POST['class_name'];}else{$classval='';}?>
								<select name="class_name" class="form-control validate[required]" id="class_list">
									<option value=""><?php _e('Select Class','school-mgt');?></option>
									<?php
										foreach(get_allclass() as $classdata1)
										{  
										?>
										 <option value="<?php echo $classdata1['class_id'];?>" <?php selected($classval, $classdata1['class_id']);  ?>><?php echo $classdata1['class_name'];?></option>
									<?php }?>
								</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="class_name"><?php _e('Select Subject','school-mgt');?></label>
					<div class="col-sm-8">
						<?php
						   $subject = ($edit)?smgt_get_subject_by_classid($classval):array();
						   ?>
						  <select name="subject_id" id="subject_list" class="form-control validate[required] text-input">
						   <?php
						   if($edit)
						   {
								foreach($subject as $record)
								{
									$select = ($record->subid == $classdata->subject)?"selected":"";
								?>
									<option value="<?php echo $record->subid;?>" <?php echo $select; ?>><?php echo $record->sub_name; ?></option>
								<?php
								}
						   }
						   else
						   {
							   echo "<option >Select Subject</option>";
						   }
						   ?>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="class_capacity"><?php _e('Content','school-mgt');?> </label>
					<div class="col-sm-8">
					<!--<textarea name='content' value="" type='text' style='width:100%;height:200px' class="form-control validate[required] text-input" ><?php if($edit){ echo $classdata->content;}?></textarea>-->
						 <?php 
						 $setting=array(
						 'media_buttons' => false
						 );
						 wp_editor(isset($edit)?stripslashes($classdata->content) : '','content',$setting); ?>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="class_capacity"><?php _e('Submission Date','school-mgt');?> </label>
					<div class="col-sm-3">
						<input id="sdate" value="<?php if($edit){ echo date("m/d/Y",strtotime($classdata->submition_date));}?>" class="datepicker form-control validate[required] text-input" type="text" name="sdate" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label" for="smgt_enable_homework_mail"><?php _e('Enable Send  Mail To Parents And Students','school-mgt');?></label>
					<div class="col-sm-8">
						<div class="checkbox">
							<label><input type="checkbox" name="smgt_enable_homework_mail"  value="1" <?php echo checked(get_option('smgt_enable_homework_mail'),'yes');?>/><?php _e('Enable','school-mgt');?>
						  </label>
						</div>
					</div>
				</div>
				<div class="col-sm-offset-2 col-sm-8">        	
					<input type="submit" value="<?php if($edit){ _e('Save Homework','school-mgt'); }else{ _e('Save Homework','school-mgt');}?>" name="Save_Homework" class="btn btn-success" />
				</div>        
        </form>
    </div>