<?php $access=page_access_rolewise_and_accessright();
if($access)
{
?>
<script>
$(document).ready(function() {
    $('#notice_list').DataTable({
        responsive: true
    });
} );
</script>
<!-- View Popup Code -->	
<div class="popup-bg">
    <div class="overlay-content">    
    	<div class="notice_content"></div>    
    </div>
</div>

<div class="panel-body panel-white">
<ul class="nav nav-tabs panel_tabs" role="tablist">
	<li class="active">
		<a href="#examlist" role="tab" data-toggle="tab">
			<i class="fa fa-align-justify"></i> <?php _e('Notice List', 'school-mgt'); ?></a>		
	</li>
</ul>
	<div class="tab-content">    
		<div class="panel-body">
        <div class="table-responsive">
        <table id="notice_list"class="display dataTable notice_datatable" cellspacing="0" width="100%">
        <thead>
            <tr>                
                <th width="190px"><?php _e( 'Notice Title', 'school-mgt' ) ;?></th>
                <th><?php _e( 'Notice Comment', 'school-mgt' ) ;?></th>
                <th><?php _e('Notice Start Date','school-mgt');?></th>
				<th><?php _e('Notice End Date','school-mgt');?></th>
                <th><?php _e( 'Notice For', 'school-mgt' ) ;?></th>
                <th width="60px"><?php _e( 'Action', 'school-mgt' ) ;?></th>                     
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th><?php  _e( 'Notice Title', 'school-mgt' ) ;?></th>
                <th><?php  _e( 'Notice Comment', 'school-mgt' ) ;?></th>
                <th><?php _e('Notice Start Date','school-mgt');?></th>
				<th><?php _e('Notice End Date','school-mgt');?></th>
                <th><?php  _e( 'Notice For', 'school-mgt' ) ;?></th>
                <th><?php _e( 'Action', 'school-mgt' ) ;?></th>
            </tr>
        </tfoot> 
        <tbody>
        <?php 		
		$class_name  	= 	get_user_meta(get_current_user_id(),'class_name',true);		
		$class_section  = 	get_user_meta(get_current_user_id(),'class_section',true);	
		if($school_obj->role=='student'){
         $notice_list_student = student_notice_dashbord($class_name,$class_section);
		if (! empty ($notice_list_student)) {
	    foreach ($notice_list_student as $retrieved_data ) { ?>
		
			<tr>
							<td><?php echo $retrieved_data->post_title;?></td>
							<td><?php 
								$strlength		= 	strlen($retrieved_data->post_content);
								if($strlength > 60)
									echo substr($retrieved_data->post_content, 0,60).'...';
								else
									echo $retrieved_data->post_content;				
							?></td>
							<td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'start_date',true));?></td> 
							<td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'end_date',true));?></td> 			      
							<td><?php print get_post_meta( $retrieved_data->ID, 'notice_for',true);?></td>         
							
							<td><a href="#" class="btn btn-primary view-notice" id="<?php echo $retrieved_data->ID;?>"> <?php _e('View','school-mgt');?></a></td>
						</tr>	
		<?php }
	}
	
}
if($school_obj->role=='teacher'){
         $notice_list_teacher = teacher_notice_dashbord($class_name);
		if (! empty ($notice_list_teacher)) {
	    foreach ($notice_list_teacher as $retrieved_data ) { ?>
		
			<tr>
							<td><?php echo $retrieved_data->post_title;?></td>
							<td><?php 
								$strlength		= 	strlen($retrieved_data->post_content);
								if($strlength > 60)
									echo substr($retrieved_data->post_content, 0,60).'...';
								else
									echo $retrieved_data->post_content;				
							?></td>
							<td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'start_date',true));?></td> 
							<td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'end_date',true));?></td> 			      
							<td><?php print get_post_meta( $retrieved_data->ID, 'notice_for',true);?></td>         
							
							<td><a href="#" class="btn btn-primary view-notice" id="<?php echo $retrieved_data->ID;?>"> <?php _e('View','school-mgt');?></a></td>
						</tr>	
		<?php }
	}
	
}
if($school_obj->role=='parent'){
         $notice_list_parent = parent_notice_dashbord();
		if (! empty ($notice_list_parent)) {
	    foreach ($notice_list_parent as $retrieved_data ) { ?>
		
			<tr>
							<td><?php echo $retrieved_data->post_title;?></td>
							<td><?php 
								$strlength		= 	strlen($retrieved_data->post_content);
								if($strlength > 60)
									echo substr($retrieved_data->post_content, 0,60).'...';
								else
									echo $retrieved_data->post_content;				
							?></td>
							<td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'start_date',true));?></td> 
							<td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'end_date',true));?></td> 			      
							<td><?php print get_post_meta( $retrieved_data->ID, 'notice_for',true);?></td>         
							
							<td><a href="#" class="btn btn-primary view-notice" id="<?php echo $retrieved_data->ID;?>"> <?php _e('View','school-mgt');?></a></td>
						</tr>	
		<?php }
	}
	
}
if($school_obj->role=='supportstaff'){
         $notice_list_supportstaff = supportstaff_notice_dashbord();
		if (! empty ($notice_list_supportstaff)) {
	    foreach ($notice_list_supportstaff as $retrieved_data ) { ?>
		
			<tr>
							<td><?php echo $retrieved_data->post_title;?></td>
							<td><?php 
								$strlength		= 	strlen($retrieved_data->post_content);
								if($strlength > 60)
									echo substr($retrieved_data->post_content, 0,60).'...';
								else
									echo $retrieved_data->post_content;				
							?></td>
							<td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'start_date',true));?></td> 
							<td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'end_date',true));?></td> 			      
							<td><?php print get_post_meta( $retrieved_data->ID, 'notice_for',true);?></td>         
							
							<td>
					   <a href="#" class="btn btn-primary view-notice" id="<?php echo $retrieved_data->ID; ?>"> <?php _e('View','school-mgt');?></a>     
					 <!-- <a href="?dashboard=user&page=notice&tab=addnotice&action=edit&noticeid=<?php echo $retrieved_data->ID; ?>" class="btn btn-info"> <?php _e('Edit','school-mgt');?></a>
					   <a href="?dashboard=user&page=notice&tab=examlist&action=delete&noticeid=<?php echo $retrieved_data->ID;?>" class="btn btn-danger" 
					   onclick="return confirm('<?php _e('Are you sure you want to delete this record?','school-mgt');?>');"> <?php _e('Delete','school-mgt');?></a>-->
					  
				   </td> 
						</tr>	
		<?php }
	}
	
}
		/* $args['post_type']		= 	'notice';
		$args['posts_per_page'] = 	-1;
		$args['post_status'] 	= 	'public';		
		$retrieve_class 		= 	get_posts($args);		
		$format 				=	get_option('date_format');
	
		if($school_obj->role	==	'student')
		{
		 	foreach($retrieve_class as $postid)
			{			
				$retrieved_data		=	get_post($postid);
				$smgt_class_id 		= 	get_post_meta($retrieved_data->ID,'smgt_class_id',true);
				$smgt_section_id 	= 	get_post_meta($retrieved_data->ID,'smgt_section_id',true);	
				/* var_dump($smgt_section_id);
				var_dump($smgt_class_id); die; 
				if(!empty($smgt_section_id) || $smgt_class_id=='all')
				{
					if(($smgt_section_id == $class_section) || ($smgt_class_id=='all'))
					{ ?>
						<tr>
							<td><?php echo $retrieved_data->post_title;?></td>
							<td><?php 
								$strlength		= 	strlen($retrieved_data->post_content);
								if($strlength > 60)
									echo substr($retrieved_data->post_content, 0,60).'...';
								else
									echo $retrieved_data->post_content;				
							?></td>
							<td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'start_date',true));?></td> 
							<td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'end_date',true));?></td> 			      
							<td><?php print get_post_meta( $retrieved_data->ID, 'notice_for',true);?></td>         
							
							<td><a href="#" class="btn btn-primary view-notice" id="<?php echo $retrieved_data->ID;?>"> <?php _e('View','school-mgt');?></a></td>
						</tr>	
					<?php }					
				}
				elseif( $smgt_class_id == $class_name )
				{ ?>
					<tr>
						<td><?php echo $retrieved_data->post_title;?></td>
						<td><?php 
							$strlength= strlen($retrieved_data->post_content);
							if($strlength > 60)
								echo substr($retrieved_data->post_content, 0,60).'...';
							else
								echo $retrieved_data->post_content;				
						?></td>
						<td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'start_date',true));?></td> 
						<td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'end_date',true));?></td> 			      
						<td><?php print get_post_meta( $retrieved_data->ID, 'notice_for',true);?></td>              
						<td><a href="#" class="btn btn-primary view-notice" id="<?php echo $retrieved_data->ID;?>"> <?php _e('View','school-mgt');?></a></td>
					</tr>	
				<?php			
				}
			}
		}
		else
		{			
			foreach ($retrieve_class as $retrieved_data)
			{  
				$NoticeFOr = get_post_meta($retrieved_data->ID,'notice_for',true);
				/* var_dump($school_obj->role);
				var_dump($NoticeFOr); 
				if($school_obj->role == $NoticeFOr && $school_obj->role  != "teacher")
				{	
				?>
				<tr>
					<td><?php echo $retrieved_data->post_title;?></td>
					<td><?php 
						$strlength= strlen($retrieved_data->post_content);
						if($strlength > 60)
							echo substr($retrieved_data->post_content, 0,60).'...';
						else
							echo $retrieved_data->post_content;
					?></td>
				   <td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'start_date',true));?></td> 
				   <td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'end_date',true));?></td> 			      
				   <td><?php print get_post_meta( $retrieved_data->ID, 'notice_for',true);?></td>        
					<td>
					   <a href="#" class="btn btn-primary view-notice" id="<?php echo $retrieved_data->ID; ?>"> <?php _e('View','school-mgt');?></a>     
					  <?php if($school_obj->role=='supportstaff'){ ?> 
						<a href="?dashboard=user&page=notice&tab=addnotice&action=edit&noticeid=<?php echo $retrieved_data->ID; ?>" class="btn btn-info"> <?php _e('Edit','school-mgt');?></a>
					   <a href="?dashboard=user&page=notice&tab=examlist&action=delete&noticeid=<?php echo $retrieved_data->ID;?>" class="btn btn-danger" 
					   onclick="return confirm('<?php _e('Are you sure you want to delete this record?','school-mgt');?>');"> <?php _e('Delete','school-mgt');?></a>
					   <?php }?>
				   </td>               
				</tr>
            <?php } 
			
			elseif($school_obj->role  == $NoticeFOr)
			{				
				$teacher_class = smgt_get_teachers_class(get_current_user_id());
				$teacher_classArr = explode(",",$teacher_class);				
				$Postclass = get_post_meta($retrieved_data->ID,'smgt_class_id',true);				
				if(in_array($Postclass,$teacher_classArr) || $Postclass=="all")
				{ ?>
					<tr>
					<td><?php echo $retrieved_data->post_title;?></td>
					<td><?php 
						$strlength= strlen($retrieved_data->post_content);
						if($strlength > 60)
							echo substr($retrieved_data->post_content, 0,60).'...';
						else
							echo $retrieved_data->post_content;
					?></td>
				   <td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'start_date',true));?></td> 
				   <td><?php echo smgt_getdate_in_input_box(get_post_meta($retrieved_data->ID,'end_date',true));?></td> 			      
				   <td><?php 
						$section = get_post_meta( $retrieved_data->ID, 'smgt_section_id',true);
						
						echo smgt_get_section_name($section);
					?></td>        
					<td>
					   <a href="#" class="btn btn-primary view-notice" id="<?php echo $retrieved_data->ID; ?>"> <?php _e('View','school-mgt');?></a>     
					  <?php if($school_obj->role=='supportstaff'){ ?> 
						<a href="?dashboard=user&page=notice&tab=addnotice&action=edit&noticeid=<?php echo $retrieved_data->ID; ?>" class="btn btn-info"> <?php _e('Edit','school-mgt');?></a>
					   <a href="?dashboard=user&page=notice&tab=examlist&action=delete&noticeid=<?php echo $retrieved_data->ID;?>" class="btn btn-danger" 
					   onclick="return confirm('<?php _e('Are you sure you want to delete this record?','school-mgt');?>');"> <?php _e('Delete','school-mgt');?></a>
					   <?php }?>
				   </td>               
				</tr>
				<?php }
				
			}

			}
			}  */?>
        </tbody>       
		</table>	
</div>
</div>
</div>
</div>
<?php
}
else
{
	wp_redirect ( admin_url () . 'index.php' );
} ?>