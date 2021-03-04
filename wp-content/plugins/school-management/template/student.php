<?php 
$access=page_access_rolewise_and_accessright();
if($access)
{
$obj_mark = new Marks_Manage();
$active_tab=isset($_REQUEST['tab'])?$_REQUEST['tab']:'studentlist';
$role='student';
if(isset($_POST['save_student']))
{
	
	$nonce = $_POST['_wpnonce'];
	if ( wp_verify_nonce( $nonce, 'save_student_frontend_nonce' ) )
	{
		$firstname=MJ_smgt_onlyLetter_specialcharacter_validation($_POST['first_name']);
		$lastname=MJ_smgt_onlyLetter_specialcharacter_validation($_POST['last_name']);
		$userdata = array(
			'user_login'=>MJ_smgt_username_validation($_POST['username']),
			'user_nicename'=>NULL,
			'user_email'=>MJ_smgt_email_validation($_POST['email']),
			'user_url'=>NULL,
			'display_name'=>$firstname." ".$lastname,
		);
		if($_POST['password'] != "")
			$userdata['user_pass']=strip_tags($_POST['password']);
		
		if(isset($_FILES['upload_user_avatar_image']) && !empty($_FILES['upload_user_avatar_image']) && $_FILES['upload_user_avatar_image']['size'] !=0)
		{
			if($_FILES['upload_user_avatar_image']['size'] > 0)
				$member_image=smgt_load_documets($_FILES['upload_user_avatar_image'],'upload_user_avatar_image','pimg');
				$photo=content_url().'/uploads/school_assets/'.$member_image;
		}
		else
		{
			if(isset($_REQUEST['hidden_upload_user_avatar_image']))
			$member_image=$_REQUEST['hidden_upload_user_avatar_image'];
			$photo=$member_image;
		}
		
		/*if(isset($_POST['smgt_user_avatar']) && $_POST['smgt_user_avatar'] != "")
		{
			
			$photo=$_POST['smgt_user_avatar'];

		}
		else
		{
			$photo="";
		}*/
		$usermetadata=array('roll_id'=>smgt_strip_tags_and_stripslashes($_POST['roll_id']),
				'middle_name'=>smgt_strip_tags_and_stripslashes($_POST['middle_name']),
				'gender'=>$_POST['gender'],
				'birth_date'=>$_POST['birth_date'],
				'address'=>smgt_strip_tags_and_stripslashes($_POST['address']),
				'city'=>smgt_strip_tags_and_stripslashes($_POST['city_name']),
				'state'=>smgt_strip_tags_and_stripslashes($_POST['state_name']),
				'zip_code'=>smgt_strip_tags_and_stripslashes($_POST['zip_code']),
				'class_name'=>$_POST['class_name'],
				'class_section'=>$_POST['class_section'],
				'phone'=>$_POST['phone'],
				'mobile_number'=>$_POST['mobile_number'],
				'alternet_mobile_number'=>$_POST['alternet_mobile_number'],
				'smgt_user_avatar'=>$photo,

		);
		//var_dump($usermetadata);
		//exit;
		$userbyroll_no=get_users(
				array('meta_query'=>
						array('relation' => 'AND',
							array('key'=>'class_name','value'=>$_POST['class_name']),
							array('key'=>'roll_id','value'=>smgt_strip_tags_and_stripslashes($_POST['roll_id']))
						),
						'role'=>'student'));
		$is_rollno = count($userbyroll_no);
		if($_REQUEST['action']=='edit')
		{
			$userdata['ID']=$_REQUEST['student_id'];
			$result=update_user($userdata,$usermetadata,$firstname,$lastname,$role);
			if($result)
			{ ?>
				<div id="message" class="updated below-h2">
					<p><?php _e('Student updated successfully','school-mgt');?></p>
				</div>
		  <?php }
		}
		else
		{
			if( !email_exists( $_POST['email'] ) && !username_exists( smgt_strip_tags_and_stripslashes($_POST['username']))) 
			{			
				if($is_rollno)
				{
				?>
				<div id="message" class="updated below-h2">
					<p><?php _e('Roll No All Ready Exist!','school-mgt');?></p>
				</div>
				<?php 
				}
				else
				{
					$result=add_newuser($userdata,$usermetadata,$firstname,$lastname,$role);
					if($result)
					{ ?>
					<div id="message" class="updated below-h2">
						<p><?php _e('Student Added successfully','school-mgt');?></p>
					</div>
			<?php }
				}
			}
			else
			{
			?>
			<div id="message" class="updated below-h2">
				<p><?php _e('Username Or Emailid All Ready Exist','school-mgt');?></p>
			</div>
			<?php 
			}	 
		}
	}
}
?>
<script>
jQuery(document).ready(function() {
	jQuery('#students_list').DataTable({
        responsive: true,
		"order": [[ 1, "asc" ]],
		"aoColumns":[
	                  {"bSortable": false},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                 /*  {"bSortable": true},
	                  {"bSortable": true}, */
					  <?php if($school_obj->role != 'parent'){?>
	                  {"bSortable": false} <?php } ?>]
    });
} );
</script>
<!-- POP up code -->	
<div class="popup-bg">
    <div class="overlay-content">   
		<div class="result"></div>
		<div class="view-parent"></div>   
    </div> 
</div>
<div class="panel-body panel-white">
 <ul class="nav nav-tabs panel_tabs" role="tablist">
      <li class="<?php if($active_tab=='studentlist'){?>active<?php }?>">
          <a href="?dashboard=user&page=student&tab=studentlist" class="nav-tab2">
             <i class="fa fa-align-justify"></i> <?php _e('Student List', 'school-mgt'); ?></a>
          </a>
      </li>
      <?php if($school_obj->role == 'supportstaff'){?>
       <li class="<?php if($active_tab=='addstudent'){?>active<?php }?>">
          <a href="?dashboard=user&page=student&tab=addstudent" class="nav-tab2 margin_bottom">
             <i class="fa fa-plus-circle"></i> 
             <?php 
             if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit')
             	_e('Edit Student', 'school-mgt');
             else 
             	_e('Add Student', 'school-mgt');
              ?></a>
          </a>
      </li>
      <?php }?>
</ul>

 <div class="tab-content">
     <?php if($active_tab == 'studentlist')
     {
     ?>
		 <div class="panel-body"> 
	<?php
	if($school_obj->role != 'student')
    { ?>
        <form method="post">  
	<div class="form-group col-md-3">
			<label for="class_id"><?php _e('Select Class','school-mgt');?></label>			
			<?php $class_id="";
			if(isset($_REQUEST['class_id'])) $class_id=$_REQUEST['class_id']; ?>
            <select name="class_id"  id="class_list"  class="form-control ">
                <option value=" "><?php _e('Select class Name','school-mgt');?></option>
                <?php 
                foreach(get_allclass() as $classdata)
				{  
                ?>
					<option  value="<?php echo $classdata['class_id'];?>" <?php selected($classdata['class_id'],$class_id)?>><?php echo $classdata['class_name'];?></option>
               <?php }?>
            </select>			
	</div>
		<div class="form-group col-md-3">
			<label for="class_id"><?php _e('Select Class Section','school-mgt');?></label>			
			<?php 
			$class_section="";
			if(isset($_REQUEST['class_section'])) $class_section=$_REQUEST['class_section']; ?>
					<select name="class_section" class="form-control validate[required]" id="class_section">
                        	<option value=""><?php _e('Select Class Section','school-mgt');?></option>
						<?php if(isset($_REQUEST['class_section'])){
								$class_section=$_REQUEST['class_section']; 
								foreach(smgt_get_class_sections($_REQUEST['class_id']) as $sectiondata)
								{  ?>
								 <option value="<?php echo $sectiondata->id;?>" <?php selected($class_section,$sectiondata->id);  ?>><?php echo $sectiondata->section_name;?></option>
							<?php } 
							}?>		
	
                    </select>
		</div>
		 <div class="form-group col-md-3 button-possition">
			<label for="subject_id">&nbsp;</label>
			<input type="submit" value="<?php _e('Go','school-mgt');?>" name="filter_class"  class="btn btn-info"/>
		</div>       
    </form>
	<?php 
	} ?>
 </div>
<?php 
	if(isset($_REQUEST['filter_class']) )
	{
		$exlude_id = smgt_approve_student_list();
		if(isset($_REQUEST['class_section']) && $_REQUEST['class_section'] != ""){
			$class_id =$_REQUEST['class_id'];
			$class_section =$_REQUEST['class_section'];
			 $studentdata = get_users(array('meta_key' => 'class_section', 'meta_value' =>$class_section,
				'meta_query'=> array(array('key' => 'class_name','value' => $class_id,'compare' => '=')),'role'=>'student','exclude'=>$exlude_id));	
		}
		if(isset($_REQUEST['class_id']) && $_REQUEST['class_section'] == "")
		{
			$class_id =$_REQUEST['class_id'];
			$studentdata = get_users(array('meta_key' => 'class_name', 'meta_value' => $class_id,'role'=>'student','exclude'=>$exlude_id));	
		}	
	}	
	else 
	{
		$studentdata =$school_obj->student;
	}
?>

	<div class="panel-body">
		<div class="table-responsive">
        <table id="students_list" class="display dataTable student_datatable" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th><?php echo _e( 'Photo', 'school-mgt' ) ;?></th>
                <th><?php echo _e( 'Student Name', 'school-mgt' ) ;?></th>
				 <th> <?php echo _e( 'Roll No.', 'school-mgt' ) ;?></th>
                <th> <?php echo _e( 'Student Email', 'school-mgt' ) ;?></th>
				<!--<th> <?php echo _e( 'Class', 'school-mgt' ) ;?></th>
				<th> <?php echo _e( 'Section', 'school-mgt' ) ;?></th>-->				
				<?php if($school_obj->role != 'parent'){ ?>
				 <th><?php echo _e( 'Action', 'school-mgt' ) ;?></th>
				<?php } ?>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th><?php echo _e( 'Photo', 'school-mgt' ); ?></th>
                <th><?php echo _e( 'Student Name', 'school-mgt' ) ;?></th>
				 <th> <?php echo _e( 'Roll No.', 'school-mgt' ) ;?></th>
                <th> <?php echo _e( 'Student Email', 'school-mgt' ) ;?></th>
				<!--<th> <?php echo _e( 'Class', 'school-mgt' ) ;?></th>
				<th> <?php echo _e( 'Section', 'school-mgt' ) ;?></th>-->
				<?php if($school_obj->role != 'parent'){?>
				 <th><?php echo _e( 'Action', 'school-mgt' ) ;?></th>
				<?php } ?>                
            </tr>
        </tfoot>
 
        <tbody>
        <?php 
		if(!empty($studentdata))
		{
			
			if($school_obj->role != 'student')
            {
			
				foreach ($studentdata as $retrieved_data){
				?>
        <tr>
			<td class="user_image text-center">
			<?php 
			$uid=$retrieved_data->ID;
			$umetadata=get_user_image($uid);
			if(empty($umetadata['meta_value'])){
				echo '<img src='.get_option( 'smgt_student_thumb' ).' height="50px" width="50px" class="img-circle" />';
			}
			else
				echo '<img src='.$umetadata['meta_value'].' height="50px" width="50px" class="img-circle"/>';
			?>
			</td>
            <td class="name"><?php echo $retrieved_data->display_name;?></td>
			<td class="roll_no"><?php echo get_user_meta($retrieved_data->ID, 'roll_id',true);?></td>
			<td class="email"><?php echo $retrieved_data->user_email;?></td>
			<!--<td class="name"><?php $class_id=get_user_meta($retrieved_data->ID, 'class_name',true);
				echo $classname=get_class_name($class_id);
			?></td>
			<td class="name"><?php $section_name=get_user_meta($retrieved_data->ID, 'class_section',true);
				if($section_name!=""){
					echo smgt_get_section_name($section_name); 
				}
				else
				{
					_e('No Section','school-mgt');;
				}
				?>
			</td>-->
             <?php if($school_obj->role != 'parent'){ ?>
               	 <td class="action">               
						<a href="?dashboard=user&page=student&action=result&student_id=<?php echo $retrieved_data->ID;?>" class="show-popup btn btn-default" 
                            idtest="<?php echo $retrieved_data->ID; ?>"><i class="fa fa-bar-chart"></i> <?php _e('View Result', 'school-mgt');?></a> 
                        <a href="?dashboard=user&page=student&tab=studentlist&action=showparent&student_id=<?php echo $retrieved_data->ID;?>" class="show-parent btn btn-default" 
                            idtest="<?php echo $retrieved_data->ID; ?>"><i class="fa fa-user"></i> <?php _e('View Parent', 'school-mgt');?></a>
                        <a href="?dashboard=user&page=view-attendance&tab=stud_attendance&student_id=<?php echo $retrieved_data->ID;?>" class="btn btn-default"  
                            idtest="<?php echo $retrieved_data->ID; ?>"><i class="fa fa-eye"></i> <?php _e('View Attendance','school-mgt');?> </a>
						<?php 
                            if($school_obj->role == 'supportstaff')
                            {
                            ?>
                                <a href="?dashboard=user&page=student&tab=addstudent&action=edit&student_id=<?php echo $retrieved_data->ID;?>" class="btn btn-info"><?php _e('Edit', 'school-mgt');?></a>
                        <?php 
                           } ?>
					</td>			  
            </tr>	
            <?php }			
			}

			} 
		
		if($school_obj->role == 'student')
        {
			foreach ($studentdata as $retrieved_data)
			{ ?>
				<tr>
					<td class="user_image text-center">
					<?php 
					$uid=$retrieved_data->ID;
					$umetadata=get_user_image($uid);
					if(empty($umetadata['meta_value'])){
						echo '<img src='.get_option( 'smgt_student_thumb' ).' height="50px" width="50px" class="img-circle" />';
					}
					else
						echo '<img src='.$umetadata['meta_value'].' height="50px" width="50px" class="img-circle"/>';
					?>
					</td>
					<td class="name"><?php echo $retrieved_data->display_name;?></td>
					<td class="roll_no"><?php echo get_user_meta($retrieved_data->ID, 'roll_id',true);?></td>
					<td class="email"><?php echo $retrieved_data->user_email;?></td>
					<!--<td class="name"><?php $class_id=get_user_meta($retrieved_data->ID, 'class_name',true);
						echo $classname=get_class_name($class_id);
					?></td>
					<td class="name"><?php $section_name=get_user_meta($retrieved_data->ID, 'class_section',true);
						if($section_name!=""){
							echo smgt_get_section_name($section_name); 
						}
						else
						{
							_e('No Section','school-mgt');;
						}
						?>
					</td>-->
					 <td class="action">						
						<a href="?dashboard=user&page=student&action=result&student_id=<?php echo $retrieved_data->ID;?>" class="show-popup btn btn-default" 
							idtest="<?php echo $retrieved_data->ID; ?>"><i class="fa fa-bar-chart"></i> <?php _e('View Result', 'school-mgt');?></a> 
						<a href="?dashboard=user&page=student&tab=studentlist&action=showparent&student_id=<?php echo $retrieved_data->ID;?>" class="show-parent btn btn-default" 
							idtest="<?php echo $retrieved_data->ID; ?>"><i class="fa fa-user"></i> <?php _e('View Parent', 'school-mgt');?></a>
									<!-- <a href="?dashboard=user&page=student&student_id=<?php echo $retrieved_data->ID;?>&attendance=daily" class="btn btn-default"  
									idtest="<?php echo $retrieved_data->ID; ?>"><i class="fa fa-eye"></i> <?php _e('View Attendance','school-mgt');?> </a>-->
						<a href="?dashboard=user&page=view-attendance&tab=stud_attendance&student_id=<?php echo $retrieved_data->ID;?>" class="btn btn-default"  
									idtest="<?php echo $retrieved_data->ID; ?>"><i class="fa fa-eye"></i> <?php _e('View Attendance','school-mgt');?> </a>
											
							
					   </td>
				</tr>			
				<?php 
					
			} 
			
		} ?> 





			
        </tbody>        
        </table>
        </div>       
	</div>
	<?php }
	
	
	?>
	

</div>
</div>
	 <?php }
if($active_tab == 'addstudent')
	{
		$role='student';
		$edit=0;
		if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit'){
				
			$edit=1;
			$user_info = get_userdata($_REQUEST['student_id']);
				
		}
		?>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#student_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});	 
		$('#birth_date').datepicker({
			maxDate : 0,
			changeMonth: true,
			changeYear: true,
			yearRange:'-65:+25',
			onChangeMonthYear: function(year, month, inst) {
				$(this).val(month + "/" + year);
			}
		});
	} );
	</script>
	<div class="panel-body">
        <form name="student_form" action="" method="post" class="form-horizontal" id="student_form" enctype="multipart/form-data">
         <?php $action = isset($_REQUEST['action'])?$_REQUEST['action']:'insert';?>
		<input type="hidden" name="action" value="<?php echo $action;?>">
		<input type="hidden" name="role" value="<?php echo $role;?>"  />
		<div class="form-group">
			<label class="col-sm-2 control-label" for="class_name"><?php _e('Class','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<?php if($edit){ $classval=$user_info->class_name; }elseif(isset($_POST['class_name'])){$classval=$_POST['class_name'];}else{$classval='';}?>
                    <!-- <select name="class_name" class="form-control validate[required]" id="class_name"> -->
                    <select name="class_name" class="form-control validate[required]" id="class_list">
                      	<option value=""><?php _e('Select Class','school-mgt');?></option>
                        <?php
						foreach(get_allclass() as $classdata)
						{  
						?>
							<option value="<?php echo $classdata['class_id'];?>" <?php selected($classval, $classdata['class_id']);  ?>><?php echo $classdata['class_name'];?></option>
						<?php }?>
                    </select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="class_name"><?php _e('Class Section','school-mgt');?></label>
			<div class="col-sm-8">
				<?php if($edit){ $sectionval=$user_info->class_section; }elseif(isset($_POST['class_section'])){$sectionval=$_POST['class_section'];}else{$sectionval='';}?>
                        <?php //echo  $sectionval;?>
						<select name="class_section" class="form-control" id="class_section">
                        	<option value=""><?php _e('Select Class Section','school-mgt');?></option>
                            <?php
							if($edit){
								foreach(smgt_get_class_sections($user_info->class_name) as $sectiondata)
								{  ?>
								 <option value="<?php echo $sectiondata->section_name;?>" <?php selected($sectionval,$sectiondata->section_name);  ?>><?php echo $sectiondata->section_name;?></option>
							<?php } 
							} ?>
                        </select>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="roll_id"><?php _e('Roll Number','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="roll_id" class="form-control validate[required,custom[onlyNumberSp]]" maxlength="6" type="text" 
				value="<?php if($edit){ echo $user_info->roll_id;}elseif(isset($_POST['roll_id'])) echo $_POST['roll_id'];?>"  <?php if($edit) echo "readonly";?> name="roll_id">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="first_name"><?php _e('First Name','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="first_name" class="form-control validate[required,custom[onlyLetter_specialcharacter]] text-input" maxlength="50" type="text" value="<?php if($edit){ echo $user_info->first_name;}elseif(isset($_POST['first_name'])) echo $_POST['first_name'];?>" name="first_name">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="middle_name"><?php _e('Middle Name','school-mgt');?></label>
			<div class="col-sm-8">
				<input id="middle_name" class="form-control validate[custom[onlyLetter_specialcharacter]]" maxlength="50" type="text"  value="<?php if($edit){ echo $user_info->middle_name;}elseif(isset($_POST['middle_name'])) echo $_POST['middle_name'];?>" name="middle_name">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="last_name"><?php _e('Last Name','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="last_name" class="form-control validate[required,custom[onlyLetter_specialcharacter]] text-input" maxlength="50" type="text"  value="<?php if($edit){ echo $user_info->last_name;}elseif(isset($_POST['last_name'])) echo $_POST['last_name'];?>" name="last_name">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="gender"><?php _e('Gender','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
			<?php $genderval = "male"; if($edit){ $genderval=$user_info->gender; }elseif(isset($_POST['gender'])) {$genderval=$_POST['gender'];}?>
				<label class="radio-inline">
			     <input type="radio" value="male" class="tog validate[required]" name="gender"  <?php  checked( 'male', $genderval);  ?>/><?php _e('Male','school-mgt');?>
			    </label>
			    <label class="radio-inline">
			      <input type="radio" value="female" class="tog validate[required]" name="gender"  <?php  checked( 'female', $genderval);  ?>/><?php _e('Female','school-mgt');?> 
			    </label>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="birth_date"><?php _e('Date of birth','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="birth_date" class="form-control validate[required]" type="text"  name="birth_date" 
				value="<?php if($edit){ echo smgt_getdate_in_input_box($user_info->birth_date);}elseif(isset($_POST['birth_date'])) echo smgt_getdate_in_input_box($_POST['birth_date']);?>" readonly>
			</div>
		</div>		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="address"><?php _e('Address','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="address" class="form-control validate[required,custom[address_description_validation]]" maxlength="150" type="text"  name="address" 
				value="<?php if($edit){ echo $user_info->address;}elseif(isset($_POST['address'])) echo $_POST['address'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="city_name"><?php _e('City','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="city_name" class="form-control validate[required,custom[city_state_country_validation]]" maxlength="50" type="text"  name="city_name" 
				value="<?php if($edit){ echo $user_info->city;}elseif(isset($_POST['city_name'])) echo $_POST['city_name'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="state_name"><?php _e('State','school-mgt');?></label>
			<div class="col-sm-8">
				<input id="state_name" class="form-control validate[custom[city_state_country_validation]]" maxlength="50" type="text"  name="state_name" 
				value="<?php if($edit){ echo $user_info->state;}elseif(isset($_POST['state_name'])) echo $_POST['state_name'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="zip_code"><?php _e('Zip Code','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="zip_code" class="form-control  validate[required,custom[onlyLetterNumber]]" maxlength="15" type="text"  name="zip_code" 
				value="<?php if($edit){ echo $user_info->zip_code;}elseif(isset($_POST['zip_code'])) echo $_POST['zip_code'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="mobile_number"><?php _e('Mobile Number','school-mgt');?></label>
			<div class="col-sm-1">
			
			<input type="text" readonly value="+<?php echo smgt_get_countery_phonecode(get_option( 'smgt_contry' ));?>"  class="form-control" name="phonecode">
			</div>
			<div class="col-sm-7">
				<input id="mobile_number" class="form-control text-input validate[custom[phone_number],minSize[6],maxSize[15]]" type="text"  name="mobile_number"
				value="<?php if($edit){ echo $user_info->mobile_number;}elseif(isset($_POST['mobile_number'])) echo $_POST['mobile_number'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="mobile_number"><?php _e('Alternate Mobile Number','school-mgt');?></label>
			<div class="col-sm-1">
			
			<input type="text" readonly value="+<?php echo smgt_get_countery_phonecode(get_option( 'smgt_contry' ));?>"  class="form-control" name="alter_mobile_number">
			</div>
			<div class="col-sm-7">
				<input id="alternet_mobile_number" class="form-control text-input validate[custom[phone_number],minSize[6],maxSize[15]]" type="text"  name="alternet_mobile_number" maxlength="10"
				value="<?php if($edit){ echo $user_info->alternet_mobile_number;}elseif(isset($_POST['alternet_mobile_number'])) echo $_POST['alternet_mobile_number'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label " for="phone"><?php _e('Phone','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="phone" class="form-control validate[required,custom[phone_number],minSize[6],maxSize[15]] text-input" type="text"  name="phone" 
				value="<?php if($edit){ echo $user_info->phone;}elseif(isset($_POST['phone'])) echo $_POST['phone'];?>">
			</div>
		</div>
		<?php wp_nonce_field( 'add_subject_front_nonce' ); ?>
		<div class="form-group">
			<label class="col-sm-2 control-label " for="email"><?php _e('Email','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="email" class="form-control validate[required,custom[email]] text-input" maxlength="100" type="text"  name="email" 
				value="<?php if($edit){ echo $user_info->user_email;}elseif(isset($_POST['email'])) echo $_POST['email'];?>">
			</div>
		</div>
		<?php wp_nonce_field( 'save_student_frontend_nonce' ); ?>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="username"><?php _e('User Name','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="username" class="form-control validate[required,custom[username_validation]]" maxlength="50" type="text"  name="username" 
				value="<?php if($edit){ echo $user_info->user_login;}elseif(isset($_POST['username'])) echo $_POST['username'];?>" <?php if($edit) echo "readonly";?>>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="password"><?php _e('Password','school-mgt');?><?php if(!$edit) {?><span class="require-field">*</span><?php }?></label>
			<div class="col-sm-8">
				<input id="password" class="form-control <?php if(!$edit){ echo 'validate[required,minSize[8],maxSize[12]]'; }else{ echo 'validate[minSize[8],maxSize[12]]'; }?>" type="password"  name="password" value="">
			</div>
		</div>
		<!--<div class="form-group">
			<label class="col-sm-2 control-label" for="photo"><?php _e('Image','school-mgt');?></label>
			<div class="col-sm-2">
				
				<input type="text" id="smgt_user_avatar_url" class="form-control" name="smgt_user_avatar"  
				value="<?php if($edit)echo esc_url( $user_info->smgt_user_avatar );elseif(isset($_POST['smgt_user_avatar'])) echo $_POST['smgt_user_avatar']; ?>" />
				
			</div>	
				<div class="col-sm-3">
       				 <input id="upload_user_avatar_button" type="button" class="button" value="<?php _e( 'Upload image', 'school-mgt' ); ?>" />
       				 <span class="description"><?php _e('Upload image', 'school-mgt' ); ?></span>
       		
			</div>
			<div class="clearfix"></div>
			
			<div class="col-sm-offset-2 col-sm-8">
                     <div id="upload_user_avatar_preview" >
	                     <?php if($edit) 
	                     	{
	                     	if($user_info->smgt_user_avatar == "")
	                     	{?>
	                     	<img alt="" src="<?php echo get_option( 'smgt_student_thumb' ) ?>">
	                     	<?php }
	                     	else {
	                     		?>
					        <img style="max-width:100%;" src="<?php if($edit)echo esc_url( $user_info->smgt_user_avatar ); ?>" />
					        <?php 
	                     	}
	                     	}
					        else {
					        	?>
					        	<img alt="" src="<?php echo get_option( 'smgt_student_thumb' ) ?>">
					        	<?php 
					        }?>
    				</div>
   		 </div>
		</div>-->
		
		<div class="form-group">
			<label class="col-sm-2 control-label" for="photo"><?php _e('Image','school-mgt');?></label>
			<div class="col-sm-2">
				<input type="text" id="amgt_user_avatar_url" class="form-control" name="smgt_user_avatar"  
				value="<?php if($edit)echo esc_url( $user_info->smgt_user_avatar );elseif(isset($_POST['smgt_user_avatar'])) echo $_POST['smgt_user_avatar']; ?>" />
				<input type="hidden" class="form-control" name="hidden_upload_user_avatar_image"  
				value="<?php if($edit)echo esc_url( $user_info->smgt_user_avatar );elseif(isset($_POST['hidden_upload_user_avatar_image'])) echo $_POST['hidden_upload_user_avatar_image']; ?>" />
			</div>	
				<div class="col-sm-3">
       				 <input id="upload_user_avatar" class="btn_top" name="upload_user_avatar_image" onchange="fileCheck(this);" type="file" />
       		</div>
			<div class="clearfix"></div>
			
			<div class="col-sm-offset-2 col-sm-8">
                <div id="upload_user_avatar_preview" >
	                <?php if($edit) 
	                {
	                    if($user_info->smgt_user_avatar == "")
						{ ?>
							<img class="image_preview_css" src="<?php echo get_option( 'amgt_system_logo' ); ?>">
					<?php }
	                else { ?>
					    <img class="image_preview_css" src="<?php if($edit)echo esc_url( $user_info->smgt_user_avatar ); ?>" />
					<?php }
	                }
				else { 	?>
					    <img class="image_preview_css" src="<?php echo get_option( 'smgt_student_thumb' ); ?>">
			 <?php } ?>
    			</div>
			</div>
		</div>
		<div class="col-sm-offset-2 col-sm-8">        	
        	<input type="submit" value="<?php if($edit){ _e('Save Student','school-mgt'); }else{ _e('Add Student','school-mgt');}?>" name="save_student" class="btn btn-success"/>
        </div> 

        </form>
        </div>
		<?php 
	}	 
}
else
{
	wp_redirect ( admin_url () . 'index.php' );
} 	
?>
<script type="text/javascript">
function fileCheck(obj) {
            var fileExtension = ['jpeg', 'jpg', 'png', 'bmp',''];
            if ($.inArray($(obj).val().split('.').pop().toLowerCase(), fileExtension) == -1)
			{
                alert("<?php _e("Only '.jpeg','.jpg', '.png', '.bmp' formats are allowed.",'school-mgt');?>");
				$(obj).val('');
			}	
}
</script>