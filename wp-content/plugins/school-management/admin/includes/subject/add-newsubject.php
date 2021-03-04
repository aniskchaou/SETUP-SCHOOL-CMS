<?php
//add new subject
?>
<script type="text/javascript">
$(document).ready(function() {
    $('#subject_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});
    
    $("#subject_teacher").multiselect({ 
         nonSelectedText :'<?php _e('Select Teacher','school-mgt'); ?>',
         includeSelectAllOption: true ,
		selectAllText : '<?php _e('Select all','school-mgt'); ?>'
     });	
	 $(".teacher_for_alert").click(function()
	{	
		checked = $(".multiselect_validation_teacher .dropdown-menu input:checked").length;
		if(!checked)
		{
		  alert("<?php _e('Please select atleast one teacher','school-mgt');?>");
		  return false;
		}	
	}); 	  
} );
</script>
		<?php 	$edit=0;
					if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit')
					{	
						$edit=1;
						$subject=get_subject($_REQUEST['subject_id']);
					}
?>
        <div class="panel-body">
        <form name="student_form" action="" method="post" class="form-horizontal" enctype="multipart/form-data" id="subject_form">
         <?php $action = isset($_REQUEST['action'])?$_REQUEST['action']:'insert';?>
		<input type="hidden" name="action" value="<?php echo $action;?>">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="subject_name"><?php _e('Subject Name','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="subject_name" class="form-control validate[required,custom[address_description_validation]]" type="text" maxlength="50" value="<?php if($edit){ echo $subject->sub_name;}?>" name="subject_name">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="subject_teacher"><?php _e('Teacher','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8 multiselect_validation_teacher">
				<?php 
                $teachval = array();
                if($edit){      
                $teachval = smgt_teacher_by_subject($subject);  
                }
                //var_dump($subject->subid);die;
                ?>
                        <select name="subject_teacher[]" multiple="multiple" id="subject_teacher" class="form-control validate[required]">               
                           <?php 
                                foreach(get_usersdata('teacher') as $teacherdata)
                                { ?>
                                 <option value="<?php echo $teacherdata->ID;?>" <?php echo $teacher_obj->in_array_r($teacherdata->ID, $teachval) ? 'selected' : ''; ?>><?php echo $teacherdata->display_name;?></option>
                            <?php }?>
                        </select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="subject_class"><?php _e('Class','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
						 
				        <select name="subject_class" class="form-control validate[required]" id="class_list">
                            <option value=""><?php echo _e( 'Select Class', 'school-mgt' ) ;?></option>
                            <?php $classval='';
                            if($edit){  
                                
                                //$classes = $teacher_obj->smgt_get_class_by_teacher($subject->teacher_id);
                                //var_dump($classes);
                                $classval=$subject->class_id; 
                                foreach(get_allclass() as $class)
                                { ?>
                                <option value="<?php echo $class['class_id'];?>" <?php selected($class['class_id'],$classval);  ?>>
                                <?php echo get_class_name($class['class_id']);?></option> 
                            <?php }
                            }else
                            {
                                foreach(get_allclass() as $classdata)
                                { ?>
                                <option value="<?php echo $classdata['class_id'];?>" <?php selected($classdata['class_id'],$classval);  ?>><?php echo $classdata['class_name'];?></option> 
                            <?php }
                            }
                            ?>
                        </select>
			</div>
		</div>
		<?php wp_nonce_field( 'save_subject_admin_nonce' ); ?>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="class_name"><?php _e('Class Section','school-mgt');?></label>
			<div class="col-sm-8">
				<?php if($edit){ $sectionval=$subject->section_id; }elseif(isset($_POST['class_section'])){$sectionval=$_POST['class_section'];}else{$sectionval='';}?>
                        <select name="class_section" class="form-control" id="class_section">
                        	<option value=""><?php _e('Select Class Section','school-mgt');?></option>
                            <?php
							if($edit){
								foreach(smgt_get_class_sections($subject->class_id) as $sectiondata)
								{  ?>
								 <option value="<?php echo $sectiondata->id;?>" <?php selected($sectionval,$sectiondata->id);  ?>><?php echo $sectiondata->section_name;?></option>
							<?php } 
							}?>
                        </select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="subject_edition"><?php _e('Edition','school-mgt');?></label>
			<div class="col-sm-8">
				<input id="subject_edition" class="form-control validate[custom[address_description_validation]]" maxlength="50" type="text" value="<?php if($edit){ echo $subject->edition;}?>" name="subject_edition">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="subject_author"><?php _e('Author Name','school-mgt');?></label>
			<div class="col-sm-8">
				<input id="subject_author" class="form-control validate[custom[onlyLetter_specialcharacter]]" maxlength="100" type="text" value="<?php if($edit){ echo $subject->author_name;}?>" name="subject_author">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="subject_syllabus"><?php _e('Syllabus','school-mgt');?></label>
			<div class="col-sm-8">
				 <input type="file" accept=".pdf" name="subject_syllabus"  id="subject_syllabus"/>				 
				 <input type="hidden" name="sylybushidden" value="<?php if($edit){ echo $subject->syllabus;} else echo "";?>">
                   <p class="help-block"><?php _e('Upload syllabus in PDF','school-mgt');?></p>     
			</div>
		</div>
		<div class="col-sm-offset-2 col-sm-8">
        	
        	<input type="submit" value="<?php if($edit){ _e('Save Subject','school-mgt'); }else{ _e('Add Subject','school-mgt');}?>" name="subject" class="btn btn-success teacher_for_alert"/>
        </div>
            	
        
        </form>
		</div>
<?php

?>