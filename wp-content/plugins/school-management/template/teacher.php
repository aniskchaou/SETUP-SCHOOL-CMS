<?php 
$access=page_access_rolewise_and_accessright();
if($access)
{
if(isset($_REQUEST['attendance']) && $_REQUEST['attendance'] == 1)
{ ?>
<script type="text/javascript">
$(document).ready(function() {	
	$('.sdate').datepicker({dateFormat: "yy-mm-dd"}); 
	$('.edate').datepicker({dateFormat: "yy-mm-dd"});  
} );
</script>
<div class="panel-body panel-white">
<ul class="nav nav-tabs panel_tabs" role="tablist">
    <li class="active">
        <a href="#child" role="tab" data-toggle="tab">
            <i class="fa fa-align-justify"></i> <?php _e('Attendance', 'school-mgt'); ?></a>
        </a>
    </li>
</ul>  

<div class="tab-content">      
<div class="panel-body">
<form name="wcwm_report" action="" method="post">
<input type="hidden" name="attendance" value=1> 
<input type="hidden" name="user_id" value=<?php echo $_REQUEST['teacher_id'];?>>       
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
		<div class="table-responsive">
			<table id="attendance_teacher_list" class="display dataTable" cellspacing="0" width="100%">
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
							foreach(get_user_meta($user_id, 'class_name',true) as $class_id)
							{
								$class .= get_class_name_by_id($class_id).", ";
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
	</div>
<?php } ?>
</div>
</div>
</div>
<?php 
}
else 
{?>
<div class="panel-body panel-white">
	<ul class="nav nav-tabs panel_tabs" role="tablist">
		<li class="active">
			<a href="#teacher" role="tab" data-toggle="tab">
				<i class="fa fa-align-justify"></i> <?php _e('Teacher List', 'school-mgt'); ?></a>
			</a>
		</li>
	</ul>
<script>
jQuery(document).ready(function() {	
    jQuery('#teacher_list1').DataTable({
        responsive: true
    });
} );
</script>
<div class="tab-content">      
    <div class="panel-body">
		<div class="table-responsive">
        <table id="teacher_list1" class="display dataTable teacher_datatable" cellspacing="0" width="100%">
        <thead>
            <tr>
				<th width="75px"><?php echo _e( 'Photo', 'school-mgt' ) ;?></th>
                <th><?php echo _e( 'Teacher Name', 'school-mgt' ) ;?></th>
                <th> <?php echo _e( 'Teacher Email', 'school-mgt' ) ;?></th>
                <?php if($school_obj->role == 'teacher'){?>
                <th> <?php echo _e( 'Action', 'school-mgt' ) ;?></th>
                <?php } ?>
            </tr>
        </thead>
		<tfoot>
            <tr>
				<th><?php echo _e( 'Photo', 'school-mgt' ) ;?></th>
                <th><?php echo _e( 'Teacher Name', 'school-mgt' ) ;?></th>
                <th> <?php echo _e( 'Teacher Email', 'school-mgt' ) ;?></th>
                <?php if($school_obj->role == 'teacher'){ ?>
                <th> <?php echo _e( 'Action', 'school-mgt' ) ;?></th>
                <?php } ?>
            </tr>
        </tfoot> 
        <tbody>
        <?php 		 
		if($school_obj->role == 'student')
		{
			$class_id 	= 	get_user_meta(get_current_user_id(),'class_name',true);			
			$teacherdata	= 	get_teacher_by_class_id($class_id);				
		}
		else
		{ 
			
			$teacherdata	=	get_usersdata('teacher');
			if($school_obj->role == 'teacher')
			{
				
				$view = get_option('smgt_teacher_list_access');
				
			}
			
		} 
		
		if(!empty($teacherdata))
		{
		 	foreach ($teacherdata as $retrieved_data)
			{   
				if(! username_exists($retrieved_data->user_login)){ continue; } /* IF Teacher not exists then we dont want to yprint emprt row. */
				
				if($view == 'own' && $retrieved_data->ID != get_current_user_id())
				{
					
					continue;
					
				}
			?>
            <tr>
				<td class="user_image text-center"><?php $uid=$retrieved_data->ID;
					$umetadata=get_user_image($uid);
					if(empty($umetadata['meta_value']))
					echo '<img src='.get_option( 'smgt_student_thumb' ).' height="50px" width="50px" class="img-circle" />';
					else
					echo '<img src='.$umetadata['meta_value'].' height="50px" width="50px" class="img-circle"/>';
				?></td>
                <td class="name"><?php echo $retrieved_data->display_name;?></td>
                <td class="email"><?php echo $retrieved_data->user_email;?></td>
				 <?php if($school_obj->role == 'teacher'){?>
               <td>
               <?php if($retrieved_data->ID == get_current_user_id())
               	{ ?>
               <a href="?dashboard=user&page=teacher&teacher_id=<?php echo $retrieved_data->ID;?>&attendance=1" class="btn btn-default"  
					idtest="<?php echo $retrieved_data->ID; ?>"><i class="fa fa-eye"></i> <?php _e('View Attendance','school-mgt');?> </a>
					<?php }?>
               </td>
				 <?php } ?>
            </tr>
            <?php }
			} ?>     
        </tbody>        
        </table>
		</div>
	</div>
	</div>
</div>
<?php }
}
else
{
	wp_redirect ( admin_url () . 'index.php' );
} 
?> 