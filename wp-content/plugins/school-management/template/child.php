<?php $obj_mark = new Marks_Manage();
$access=page_access_rolewise_and_accessright();
if($access)
{
?>
<script>
$(document).ready(function() {
    $('#student_list').DataTable({
        responsive: true
    });
} );
</script>
<!-- POP up code -->
<div class="popup-bg">
    <div class="overlay-content">
    
     <div class="result"></div>
      <div class="view-parent"></div>
       <div class="view-attendance"></div>
     
    </div> 
</div>
<?php if(isset($_REQUEST['attendance']) && $_REQUEST['attendance'] == 1)
{
	?>
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
<input type="hidden" name="user_id" value=<?php echo $_REQUEST['student_id'];?>>       
	<div class="form-group col-md-3">
    	<label for="exam_id"><?php _e('Strat Date','school-mgt');?></label>
       
					
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
	 <div class="table-responsive">
	<table class="table col-md-12">
	<tr>
	<th width="200px"><?php _e('Date','school-mgt');?></th>
	<th><?php _e('Day','school-mgt');?></th>
	<th><?php _e('Attendance','school-mgt');?></th>
	<th><?php _e('Comment','school-mgt');?></th>
	</tr>
	<?php 
	while ($end_date >= $curremt_date)
	{
		echo '<tr>';
		echo '<td>';
		echo smgt_getdate_in_input_box($curremt_date);
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
		echo '<td>';
		echo smgt_get_attendence_comment($user_id,$curremt_date);
		echo '</td>';
		echo '</tr>';
		$curremt_date = strtotime("+1 day", strtotime($curremt_date));
		$curremt_date = date("Y-m-d", $curremt_date);
	}
?>
</table>
</div>
<?php }?>
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
          <a href="#child" role="tab" data-toggle="tab">
             <i class="fa fa-align-justify"></i> <?php _e('Child List', 'school-mgt'); ?></a>
          </a>
      </li>
</ul>
   

<div class="tab-content">
      
        	<div class="panel-body">
<form name="wcwm_report" action="" method="post">
	 <div class="table-responsive">
        <table id="student_list" class="display dataTable child_datatable" cellspacing="0" width="100%">
        	 <thead>
            <tr>
				<th width="75px"><?php  _e( 'Photo', 'school-mgt' ) ;?></th>
				<th><?php echo _e( 'Child Name', 'school-mgt' ) ;?></th>
				<th><?php _e('Roll No.','school-mgt');?></th>
                <th> <?php echo _e( 'Class', 'school-mgt' ) ;?></th>
				<th> <?php echo _e( 'Child Email', 'school-mgt' ) ;?></th>
				<th><?php echo _e( 'Action', 'school-mgt' ) ;?></th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
               <th><?php echo _e( 'Photo', 'school-mgt' ) ;?></th>
			   <th><?php echo _e( 'Child Name', 'school-mgt' ) ;?></th>
				<th><?php _e('Roll No.','school-mgt');?></th>
                <th> <?php echo _e( 'Class', 'school-mgt' ) ;?></th>
				<th> <?php echo _e( 'Child Email', 'school-mgt' ) ;?></th>
				
                 <th><?php echo _e( 'Action', 'school-mgt' ) ;?></th>
                
            </tr>
        </tfoot>
 
        <tbody>
         <?php 
			
			if(!empty($school_obj->child_list))
			{
				foreach ($school_obj->child_list as $child_id){ 
				$retrieved_data= get_userdata($child_id);
				if($retrieved_data)
				{
			
		 ?>
            <tr>
				<td class="user_image text-center"><?php $uid=$retrieved_data->ID;
							$umetadata=get_user_image($uid);
							if(empty($umetadata['meta_value']))
								//echo get_avatar($retrieved_data->ID,'46');
								echo '<img src='.get_option( 'smgt_student_thumb' ).' height="50px" width="50px" class="img-circle" />';
							else
							echo '<img src='.$umetadata['meta_value'].' height="50px" width="50px" class="img-circle"/>';
				?></td>
                <td class="name"><?php echo $retrieved_data->display_name;?></td>
				<td><?php echo get_user_meta($retrieved_data->ID, 'roll_id',true);?></td>
				<td class="name"><?php $class_id=get_user_meta($retrieved_data->ID, 'class_name',true);
									echo $classname=	get_class_name($class_id);
				?></td>
                <td class="email"><?php echo $retrieved_data->user_email;?></td>
                
               	<td class="action"> 
					<a href="?dashboard=user&page=student&action=result&student_id=<?php echo $retrieved_data->ID;?>" class="show-popup btn btn-default"  
					idtest="<?php echo $retrieved_data->ID; ?>"><i class="fa fa-bar-chart"></i> <?php _e('View Result','school-mgt');?></a> 
					<a href="?dashboard=user&page=student&tab=studentlist&action=showparent&student_id=<?php echo $retrieved_data->ID;?>" class="show-parent btn btn-default"  
					idtest="<?php echo $retrieved_data->ID; ?>"><i class="fa fa-user" style="margin-right:3px;"></i><?php _e('View Parent','school-mgt');?> </a>
					<a href="?dashboard=user&page=view-attendance&tab=stud_attendance&student_id=<?php echo $retrieved_data->ID;?>" class="btn btn-default"  
					idtest="<?php echo $retrieved_data->ID; ?>"><i class="fa fa-eye"></i> <?php _e('View Attendance','school-mgt');?> </a>
                </td>
               
            </tr>
				<?php  }
				} 
			}
			?>
     
        </tbody>
        
        </table>
       </div>
		
</form>
</div>
</div>
</div>
<?php 
}
}
else
{
	wp_redirect ( admin_url () . 'index.php' );
} 
?>