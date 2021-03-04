<?php 
$teacher_obj = new Smgt_Teacher;
$role='teacher';
if(isset($_POST['save_teacher']))
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
		$userdata['user_pass']=MJ_smgt_password_validation($_POST['password']);
	if(isset($_POST['smgt_user_avatar']) && $_POST['smgt_user_avatar'] != "")
	{
		$photo=$_POST['smgt_user_avatar'];
	}
	else
	{
		$photo="";
	}
	$attechment='';
	if(!empty($_POST['attachment']))
	{
		$attechment=implode(',',$_POST['attachment']);
	}
	$usermetadata=array(
		'middle_name'=>MJ_smgt_onlyLetter_specialcharacter_validation($_POST['middle_name']),
		'gender'=>MJ_smgt_onlyLetterSp_validation($_POST['gender']),
		'birth_date'=>$_POST['birth_date'],
		'address'=>MJ_smgt_address_description_validation($_POST['address']),
		'city'=>MJ_smgt_city_state_country_validation($_POST['city_name']),
		'state'=>MJ_smgt_city_state_country_validation($_POST['state_name']),
		'zip_code'=>MJ_smgt_onlyLetterNumber_validation($_POST['zip_code']),
		'class_name'=>$_POST['class_name'],
		'phone'=>MJ_smgt_phone_number_validation($_POST['phone']),
		'mobile_number'=>MJ_smgt_phone_number_validation($_POST['mobile_number']),
		'alternet_mobile_number'=>MJ_smgt_phone_number_validation($_POST['alternet_mobile_number']),
		'working_hour'=>MJ_smgt_onlyLetter_specialcharacter_validation($_POST['working_hour']),
		'possition'=>MJ_smgt_address_description_validation($_POST['possition']),
		'smgt_user_avatar'=>$photo,
		'attachment'=>$attechment
	);
	if($_REQUEST['action']=='edit')
	{		
		$userdata['ID']=$_REQUEST['teacher_id'];
		$result=update_user($userdata,$usermetadata,$firstname,$lastname,$role);
		$result1 = $teacher_obj->smgt_update_multi_class($_POST['class_name'],$_REQUEST['teacher_id']);
		wp_redirect ( admin_url().'admin.php?page=smgt_teacher&tab=teacherlist&message=2'); 		
	}
	else
	{
		if( !email_exists( $_POST['email'] ) && !username_exists( smgt_strip_tags_and_stripslashes($_POST['username']))) 
		{
			$result=add_newuser($userdata,$usermetadata,$firstname,$lastname,$role);
			$result1 = $teacher_obj->smgt_add_muli_class($_POST['class_name'],smgt_strip_tags_and_stripslashes($_POST['username']));
			wp_redirect ( admin_url().'admin.php?page=smgt_teacher&tab=teacherlist&message=1'); 			
		}
		else 
		{
		?>
			<div id="message" class="updated below-h2">
				<p><?php _e('Username Or Emailid All Ready Exist.','school-mgt');?></p>
			</div>
	<?php 
		}
	}
}
	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')
	{			
		$result=delete_usedata($_REQUEST['teacher_id']);
		if($result)
		{
			wp_redirect ( admin_url().'admin.php?page=smgt_teacher&tab=teacherlist&message=5'); 			
		}
	}
	if(isset($_REQUEST['delete_selected']))
	{		
		if(!empty($_REQUEST['id']))
		foreach($_REQUEST['id'] as $id)
			$result=delete_usedata($id);
		if($result)
		{ 
			wp_redirect ( admin_url().'admin.php?page=smgt_teacher&tab=teacherlist&message=5');  
		}
	}
	
if(isset($_REQUEST['attendance']) && $_REQUEST['attendance'] == 1)
{
?>
<script type="text/javascript">
$(document).ready(function() {	
	$('.sdate').datepicker({
		dateFormat: "yy-mm-dd",
		beforeShow: function (textbox, instance) 
			{
				instance.dpDiv.css({
					marginTop: (-textbox.offsetHeight) + 'px'                   
				});
			}
		}); 
	$('.edate').datepicker({
		dateFormat: "yy-mm-dd",
		beforeShow: function (textbox, instance) 
			{
				instance.dpDiv.css({
					marginTop: (-textbox.offsetHeight) + 'px'                   
				});
			}
		});  
} );
</script>

<div class="page-inner">
	<div class="page-title"> 
		<h3><img src="<?php echo get_option( 'smgt_school_logo' ) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo get_option( 'smgt_school_name' );?></h3>
	</div>
	<div id="main-wrapper">	
		<div class="row">
			<div class="panel panel-white">
				<div class="panel-body">
				<h2 class="nav-tab-wrapper">
			    	<a href="?page=sm_student&attendance=1" class="nav-tab nav-tab-active">
					<?php echo '<span class="dashicons dashicons-menu"></span>'.__('View Attendance', 'school-mgt'); ?></a>
				</h2>
				<form name="wcwm_report" action="" method="post">
					<input type="hidden" name="attendance" value=1> 
					<input type="hidden" name="user_id" value=<?php echo $_REQUEST['student_id'];?>>       
					<div class="form-group col-md-3">
						<label for="exam_id"><?php _e('Start Date','school-mgt');?></label>					
						<input type="text"  class="form-control sdate" name="sdate" value="<?php if(isset($_REQUEST['sdate'])) echo $_REQUEST['sdate'];else echo date('Y-m-d');?>" readonly>            	
					</div>
					<div class="form-group col-md-3">
						<label for="exam_id"><?php _e('End Date','school-mgt');?></label>
						<input type="text"  class="form-control edate" name="edate" value="<?php if(isset($_REQUEST['edate'])) echo $_REQUEST['edate'];else echo date('Y-m-d');?>" readonly>							
					</div>
					<div class="form-group col-md-3 button-possition">
						<label for="subject_id">&nbsp;</label>
						<input type="submit" name="view_attendance" Value="<?php _e('Go','school-mgt');?>"  class="btn btn-info"/>
					</div>	
				</form>
	<div class="clearfix"></div>
	<?php if(isset($_REQUEST['view_attendance']))
	{
		$start_date = $_REQUEST['sdate'];
		$end_date = $_REQUEST['edate'];
		$user_id = $_REQUEST['user_id'];
		$attendance = smgt_view_student_attendance($start_date,$end_date,$user_id);	
		$curremt_date =$start_date;
	?>
	<script>
	jQuery(document).ready(function() {
		var table =  jQuery('#attendance_teacher_list').DataTable({
			responsive: true,
			"order": [[ 0, "asc" ]],
			"aoColumns":[	                  
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": true},
			{"bSortable": true},					           
			{"bSortable": false}],		
		});
	});
	</script>
	<div class="panel-body">
	<table id="attendance_teacher_list" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th><?php _e('Teacher Name','school-mgt');?></th>
				<th><?php _e('Class Name','school-mgt');?></th>
				<th><?php _e('Date','school-mgt');?></th>
				<th><?php _e('Day','school-mgt');?></th>
				<th><?php _e('Attendance','school-mgt');?></th>				
			</tr>
		</thead>
 
        <tfoot>
            <tr>
				<th><?php _e('Teacher Name','school-mgt');?></th>
				<th><?php _e('Class Name','school-mgt');?></th>
				<th><?php _e('Date','school-mgt');?></th>
				<th><?php _e('Day','school-mgt');?></th>
				<th><?php _e('Attendance','school-mgt');?></th>				
			</tr>
        </tfoot> 
        <tbody>
			<?php 
			while ($end_date >= $curremt_date)
			{
				echo '<tr>';
				echo '<td>';
				echo get_display_name($user_id);
				echo '</td>';
				
				echo '<td>';
					$class='';
					$get_users = get_user_meta($user_id, 'class_name',true);
					if(!empty($get_users))
					{
						foreach($get_users as $class_id)
						{
							$class .= get_class_name_by_id($class_id).", ";
						}
					}
					print rtrim($class,",");
				echo '</td>';
				
				echo '<td>';
				echo $curremt_date;
				echo '</td>';
				
				$attendance_status = smgt_get_attendence($user_id,$curremt_date);
				echo '<td>';
				echo date("D", strtotime($curremt_date));
				echo '</td>';
				
				if(!empty($attendance_status))
				{
					echo '<td>';
					echo smgt_get_attendence($user_id,$curremt_date);
					echo '</td>';
				}
				else 
				{
					echo '<td>';
					echo __('Absent','school-mgt');
					echo '</td>';
				}
				
				echo '</tr>';
				$curremt_date = strtotime("+1 day", strtotime($curremt_date));
				$curremt_date = date("Y-m-d", $curremt_date);
			}
		?>
        </tbody>        
    </table>
	</div>
	
	<!--<table class="table col-md-12">
	<tr>
	<th width="200px"><?php _e('Date','school-mgt');?></th>
	<th><?php _e('Day','school-mgt');?></th>
	<th><?php _e('Attendance','school-mgt');?></th>
	</tr>
	<?php 
	while ($end_date >= $curremt_date)
	{
		echo '<tr>';
		echo '<td>';
		echo $curremt_date;
		echo '</td>';
		
		$attendance_status = smgt_get_attendence($user_id,$curremt_date);
		echo '<td>';
		echo date("D", strtotime($curremt_date));
		echo '</td>';
		
		if(!empty($attendance_status))
		{
			echo '<td>';
			echo smgt_get_attendence($user_id,$curremt_date);
			echo '</td>';
		}
		else 
		{
			echo '<td>';
			echo __('Absent','school-mgt');
			echo '</td>';
		}
		
		echo '</tr>';
		$curremt_date = strtotime("+1 day", strtotime($curremt_date));
		$curremt_date = date("Y-m-d", $curremt_date);
	}
?>
</table>-->

<?php }?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php 

}
else 
{
?>
	<?php
$active_tab = isset($_GET['tab'])?$_GET['tab']:'teacherlist';
	
	?>


<div class="page-inner">
<div class="page-title">
		<h3><img src="<?php echo get_option( 'smgt_school_logo' ) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo get_option( 'smgt_school_name' );?></h3>
	</div>
	<div id="main-wrapper">
	<?php
	$message = isset($_REQUEST['message'])?$_REQUEST['message']:'0';
	
	switch($message)
	{
		case '1':
			$message_string = __('Teacher Added Successfully.','school-mgt');
			break;
		case '2':
			$message_string = __('Teacher Updated Successfully.','school-mgt');
			break;
		case '3':
			$message_string = __('Roll No Already Exist.','school-mgt');
			break;
		case '4':
			$message_string = __('Teacher Username Or Emailid Already Exist.','school-mgt');
			break;
		case '5':
			$message_string = __('Teacher Deleted Successfully.','school-mgt');
			break;
		case '6':
			$message_string = __('Student CSV Successfully Uploaded.','school-mgt');
			break;
		case '7':
			$message_string = __('Student Activated Auccessfully.','school-mgt');
			break;
		
		
	}
	if($message)
	{
		?>
		<div id="message" class="updated below-h2 notice is-dismissible">
			<p><?php echo $message_string;?></p>
			<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
		</div>
		<?php
	}
?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white">
					<div class="panel-body">
	<h2 class="nav-tab-wrapper">
    	<a href="?page=smgt_teacher&tab=teacherlist" class="nav-tab <?php echo $active_tab == 'teacherlist' ? 'nav-tab-active' : ''; ?>">
		<?php echo '<span class="dashicons dashicons-menu"></span>'.__('Teacher List', 'school-mgt'); ?></a>
    	
        <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit')
		{?>
        <a href="?page=smgt_teacher&tab=addteacher&&action=edit&teacher_id=<?php echo $_REQUEST['teacher_id'];?>" class="nav-tab <?php echo $active_tab == 'addteacher' ? 'nav-tab-active' : ''; ?>">
		<?php _e('Edit Teacher', 'school-mgt'); ?></a>  
		<?php 
		}
		else
		{?>
			<a href="?page=smgt_teacher&tab=addteacher" class="nav-tab margin_bottom<?php echo $active_tab == 'addteacher' ? 'nav-tab-active' : ''; ?>">
		<?php echo '<span class="dashicons dashicons-plus-alt"></span>'.__('Add New Teacher', 'school-mgt'); ?></a>  
		<?php }?>
       
    </h2>
     <?php 
	//Report 1 
	if($active_tab == 'teacherlist')
	{ 
	
	?>	
 <div class="panel-body">
<script>
jQuery(document).ready(function() {
	var table =  jQuery('#teacher_list').DataTable({
        responsive: true,
		"order": [[ 2, "asc" ]],
		"aoColumns":[
            {"bSortable": false},
            {"bSortable": false},
            {"bSortable": true},
            {"bSortable": true},	                
            {"bSortable": true},
            {"bSortable": true},	                  
            {"bSortable": false}],
		language:<?php echo smgt_datatable_multi_language();?>
    });
	 jQuery('#checkbox-select-all').on('click', function(){
    var rows = table.rows({ 'search': 'applied' }).nodes();
      jQuery('input[type="checkbox"]', rows).prop('checked', this.checked);
	}); 
   
	jQuery('#delete_selected').on('click', function(){
		 var c = confirm('Are you sure to delete?');
		if(c){
			jQuery('#frm-example').submit();
		}		
	});   
});
</script>
<div class="table-responsive">
	<form name="frm-example" action="" method="post">
        <table id="teacher_list" class="display admin_taecher_datatable" cellspacing="0" width="100%">
		<thead>
           <tr>
				<th style="width: 20px;"><input name="select_all" value="all" id="checkbox-select-all" 
					type="checkbox" /></th> 
				<th><?php  _e( 'Photo', 'school-mgt' ) ;?></th>
				<th><?php _e( 'Teacher Name', 'school-mgt' ) ;?></th>
				<th> <?php _e( 'Class', 'school-mgt' ) ;?></th>
				<th> <?php _e( 'Subject', 'school-mgt' ) ;?></th>
				<th> <?php _e( 'Teacher Email', 'school-mgt' ) ;?></th>
				<th><?php  _e( 'Action', 'school-mgt' ) ;?></th>
           </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th></th>
				<th><?php  _e( 'Photo', 'school-mgt' ) ;?></th>
				<th><?php _e( 'Teacher Name', 'school-mgt' ) ;?></th>
				<th> <?php _e( 'Class', 'school-mgt' ) ;?></th>
				<th> <?php _e( 'Subject', 'school-mgt' ) ;?></th>
                <th> <?php _e( 'Teacher Email', 'school-mgt' ) ;?></th>
                <th><?php  _e( 'Action', 'school-mgt' ) ;?></th>                
            </tr>
        </tfoot>
 
        <tbody>
         <?php 
		$teacherdata=get_usersdata('teacher');
		/* print "</pre>";
			print_r($teacherdata);
		print "</pre>";
		die; */
		if(!empty($teacherdata))
		{
		 	foreach (get_usersdata('teacher') as $retrieved_data)
            {   	
				
                $teacher_group = array();
                $teacher_ids = smgt_teacher_by_subject($retrieved_data);                             
                foreach($teacher_ids as $teacher_id)
                {
                    $teacher_group[] = get_teacher($teacher_id);
                }
                $teachers = implode(',',$teacher_group);
				
		 ?>
            <tr>
			<td><input type="checkbox" class="select-checkbox" name="id[]" 
				value="<?php echo $retrieved_data->ID;?>"></td>
				<td class="user_image"><?php $uid=$retrieved_data->ID;
							$umetadata=get_user_image($uid);
		 	if(empty($umetadata['meta_value']))
									{
										echo '<img src='.get_option( 'smgt_teacher_thumb' ).' height="50px" width="50px" class="img-circle" />';
									}
							else
							echo '<img src='.$umetadata['meta_value'].' height="50px" width="50px" class="img-circle"/>';
				?></td>
                <td class="name"><a href="?page=smgt_teacher&tab=addteacher&action=edit&teacher_id=<?php echo $retrieved_data->ID;?>"><?php echo $retrieved_data->display_name;?></a></td>
                 <td class="class_name">
				<?php 
						// $class_id=get_user_meta($uid, 'class_name', true);
						$classes="";
						$classes = $teacher_obj->smgt_get_class_by_teacher($retrieved_data->ID);
						
						// $classname = implode(',',array_column($classes, 'class_id'));
						$classname = "";
						foreach($classes as $class)
						{
							$classname .= get_class_name($class['class_id']).",";
						}
						$classname = trim($classname,",");
						
						echo $classname;
						
				?></td>
				<td class="subject_name"><?php $subjectname=get_subject_name_by_teacher($uid); 
				echo rtrim($subjectname,", ");?></td>
                <td class="email"><?php echo $retrieved_data->user_email;?></td>
               	<td class="action"> <a href="?page=smgt_teacher&tab=addteacher&action=edit&teacher_id=<?php echo $retrieved_data->ID;?>" class="btn btn-info"> <?php _e('Edit', 'school-mgt' ) ;?></a>
                <a href="?page=smgt_teacher&tab=teacherlist&action=delete&teacher_id=<?php echo $retrieved_data->ID;?>" class="btn btn-danger" 
                onclick="return confirm('<?php _e('Are you sure you want to delete this record?','school-mgt');?>');">
                <?php _e( 'Delete', 'school-mgt' ) ;?> </a>
                <a href="?page=smgt_teacher&student_id=<?php echo $retrieved_data->ID;?>&attendance=1" class="btn btn-default">
               <i class="fa fa-eye"></i> <?php _e('View Attendance','school-mgt');?></a>
                </td>
               
            </tr>
            <?php } 
			
		}?>
     
        </tbody>
        
        </table>
		<div class="print-button pull-left">
			<input id="delete_selected" type="submit" value="<?php _e('Delete Selected','school-mgt');?>" name="delete_selected" class="btn btn-danger delete_selected"/>
			
		</div>
		</form>
        </div>
        </div>
       

     <?php 
	 }
	
	if($active_tab == 'addteacher')
	{
		require_once SMS_PLUGIN_DIR. '/admin/includes/teacher/add-newteacher.php';
	}
	?>
</div>
			
		</div>
	</div>
</div>
<?php } ?>