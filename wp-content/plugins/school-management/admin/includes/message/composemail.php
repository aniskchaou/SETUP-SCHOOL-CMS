<script type="text/javascript">
$(document).ready(function() {
	$('#message_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});
} );
</script>
<div class="mailbox-content">
	<h2><?php 
	$edit=0;
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit')
	{
		echo esc_html( __( 'Edit Message', 'school-mgt') );
		$edit=1;
		 $exam_data= get_exam_by_id($_REQUEST['exam_id']);
	}
	?></h2>     
<script type="text/javascript">
$(document).ready(function() {	
	 $('#selected_users').multiselect({ 
		 nonSelectedText :'Select Users',
         includeSelectAllOption: true           
     });
});
</script>
<form name="class_form" action="" method="post" class="form-horizontal" id="message_form">
    <?php $action = isset($_REQUEST['action'])?$_REQUEST['action']:'insert';?>
	<input type="hidden" name="action" value="<?php echo $action;?>">
    <div class="form-group">
        <label class="col-sm-2 control-label" for="to"><?php _e('Message To','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<select name="receiver" class="form-control validate[required] text-input" id="send_to">						
					<option value="student"><?php _e('Student','school-mgt');?></option>	
					<option value="teacher"><?php _e('Teachers','school-mgt');?></option>	
					<option value="parent"><?php _e('Parents','school-mgt');?></option>	
					<option value="supportstaff"><?php _e('Support Staff','school-mgt');?></option>	
					<?php //echo smgt_get_all_user_in_message();?>
				</select>
			</div>	
    </div>
    <div id="smgt_select_class">
		<div class="form-group class_list_id">
			<label class="col-sm-2 control-label" for="sms_template"><?php _e('Select Class','school-mgt');?></label>
			<div class="col-sm-8">			
				 <select name="class_id"  id="class_list_id" class="form-control">
                	<option value=""><?php _e('All','school-mgt');?></option>
                    <?php
					  foreach(get_allclass() as $classdata)
					  {  
					  ?>
					   <option  value="<?php echo $classdata['class_id'];?>" ><?php echo $classdata['class_name'];?></option>
				 <?php }?>
                </select>
			</div>
		</div>
	</div>
		
	<div class="form-group class_section_id">
		<label class="col-sm-2 control-label" for="class_name"><?php _e('Class Section','school-mgt');?></label>
		<div class="col-sm-8">
			<?php if(isset($_POST['class_section'])){$sectionval=$_POST['class_section'];}else{$sectionval='';}?>
				<select name="class_section" class="form-control" id="class_section_id">
					<option value=""><?php _e('Select Class Section','school-mgt');?></option>
					<?php
					if($edit){
						foreach(smgt_get_class_sections($user_info->class_name) as $sectiondata)
						{  ?>
						 <option value="<?php echo $sectiondata->id;?>" <?php selected($sectionval,$sectiondata->id);  ?>><?php echo $sectiondata->section_name;?></option>
					<?php } 
					}?>
				</select>
		</div>
	</div>
	<div class="form-group">
		<div id="messahe_test"></div>
		<label class="col-sm-2 control-label"><?php _e('Select Users','school-mgt');?></label>
		<div class="col-sm-8">
		<span class="user_display_block">
			<select name="selected_users[]" id="selected_users" class="form-control" multiple="true">					
				<?php 
				$student_list = get_all_student_list();
				foreach($student_list  as $retrive_data)
				{
					echo '<option value="'.$retrive_data->ID.'">'.$retrive_data->display_name.'</option>';
				}
				?>
			</select>
		</span>
		</div>
	</div>
		<div id="class_student_list"></div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="subject"><?php _e('Subject','school-mgt');?><span class="require-field">*</span></label>
            <div class="col-sm-8">
				<input id="subject" class="form-control validate[required,custom[popup_category_validation]] text-input" maxlength="50" type="text" name="subject" >
            </div>
		</div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="subject"><?php _e('Message Comment','school-mgt');?><span class="require-field">*</span></label>
            <div class="col-sm-8">
                <textarea name="message_body" id="message_body" maxlength="150" class="form-control validate[required,custom[address_description_validation]] text-input"></textarea>
            </div>
		</div>
										
		<div class="form-group">
			<label class="col-sm-2 control-label " for="enable"><?php _e('Send SMS','school-mgt');?></label>
			<div class="col-sm-8">
				 <div class="checkbox">
				 	<label>
  						<input id="chk_sms_sent" type="checkbox"  value="1" name="smgt_sms_service_enable">
  					</label>
  				</div>
			</div>
		</div>
		<div id="hmsg_message_sent" class="hmsg_message_none">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="sms_template"><?php _e('SMS Text','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<textarea name="sms_template" class="form-control validate[required]" maxlength="160"></textarea>
				<label><?php _e('Max. 160 Character','school-mgt');?></label>
			</div>
		</div>
		</div>			
        <div class="form-group">
            <div class="col-sm-10">
                <div class="pull-right">
                    <input type="submit" value="<?php if($edit){ _e('Save Message','school-mgt'); }else{ _e('Send Message','school-mgt');}?>" name="save_message" class="btn btn-success"/>
                </div>
            </div>
        </div>       
    </form>
</div>