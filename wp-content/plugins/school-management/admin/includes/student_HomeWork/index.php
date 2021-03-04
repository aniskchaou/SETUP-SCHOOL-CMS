<script type="text/javascript">
 $(document).ready(function() {
	  $('#class_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});
 } );
</script>
<?php 
    $obj_feespayment=new Smgt_Homework();
			
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "download")
	{
		$assign_id = $_REQUEST['stud_homework_id'];
		$homework_obj=new Smgt_Homework();
		$filedata = $homework_obj->smgt_check_uploaded($assign_id);
		if($filedata != false)
		{
			$file = $filedata;
		}
		$file = SMS_PLUGIN_DIR ."\uploadfile\\{$file}";
		if (file_exists($file)) 
		{
		   header('Content-Description: File Transfer');
		   header('Content-Type: application/octet-stream');
		   header('Content-Disposition: attachment; filename='.basename($file));
		   header('Content-Transfer-Encoding: binary');
		   header('Expires: 0');
		   header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		   header('Pragma: public');
		   header('Content-Length: ' . filesize($file));
		   ob_clean();
		   flush();
		   readfile($file);
		   exit;	
		}	
	}
// Save HomeWork !!!!!!!!! 
	if(isset($_POST['Save_Homework']))
	{
	  if(isset($_REQUEST['smgt_enable_homework_mail']))
		 update_option( 'smgt_enable_homework_mail', 1 );
	  else
			 update_option( 'smgt_enable_homework_mail', 0 );
			 $insert=new Smgt_Homework();
			 $result=$insert->add_homework($_POST);
			    if($result)
				{?>
					<div id="message" class="updated below-h2">
						<p><?php _e('Homework Inserted successfully !','school-mgt');?></p>
					</div>
				<?php 
			    }
	}
	$tablename="smgt_homework";
	/*Delete selected Subject*/
	if(isset($_REQUEST['delete_selected']))
	{		
	   $ojc=new Smgt_Homework();
		if(!empty($_REQUEST['id']))
		  foreach($_REQUEST['id'] as $id)
			$result=$ojc->get_delete_records($tablename,$id);
			if($result)
			{?>
				<div id="message" class="updated below-h2">
					<p><?php _e('Homework Delete Successfully','school-mgt');?></p>
				</div>
			<?php 
			}
	}
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')
	{
		$delete=new Smgt_Homework();
	    $dele=$delete->get_delete_record($_REQUEST['homework_id']);
			if($dele)
			{ ?>
				<div id="message" class="updated below-h2">
					<p><?php _e('Homework Delete Successfully','school-mgt');?></p>
				</div>
		      <?php 
			}
	}

$active_tab = isset($_GET['tab'])?$_GET['tab']:'homeworklist';
	?>
<!-- POP up code -->
<div class="popup-bg">
    <div class="overlay-content">
    <div class="modal-content">
    <div class="invoice_data">
     </div>
     
    </div>
    </div> 
</div>
<!-- End POP-UP Code -->
<div class="page-inner">
<div class="page-title">
		<h3><img src="<?php echo get_option( 'smgt_school_logo' ) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo get_option( 'smgt_school_name' );?></h3>
	</div>
<div  id="main-wrapper" class="class_list">
	<div class="panel panel-white">
			<div class="panel-body">		
	<h2 class="nav-tab-wrapper">
    	<a href="?page=smgt_student_homewrok&tab=homeworklist" class="nav-tab <?php echo $active_tab == 'homeworklist' ? 'nav-tab-active' : ''; ?>">
		<?php echo '<span class="dashicons dashicons-menu"></span>'. __('HomeWork List', 'school-mgt'); ?></a>
         <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit')
		{?>
          <a href="?page=smgt_student_homewrok&tab=homeworklist&&action=edit&homework_id=<?php echo $_REQUEST['homework_id'];?>" class="nav-tab <?php echo $active_tab == 'addhomework' ? 'nav-tab-active' : ''; ?>">
		<?php _e('Edit Homework', 'school-mgt'); ?></a>  
		<?php 
		}
		else
		{?>
			<a href="?page=smgt_student_homewrok&tab=addhomework" class="nav-tab <?php echo $active_tab == 'addhomework' ? 'nav-tab-active' : ''; ?>">
		<?php echo '<span class="dashicons dashicons-plus-alt"></span>'.__('Add Homework', 'school-mgt'); ?></a>  
        <?php 
		} ?>
		
		<a href="?page=smgt_student_homewrok&tab=view_stud_detail" class="nav-tab <?php echo $active_tab == 'view_stud_detail' ? 'nav-tab-active' : ''; ?> ">
		<?php echo '<span class="fa fa-eye"></span>'. __('View Submission', 'school-mgt'); ?></a>
    
	</h2>
    
    <?php
	
	if($active_tab == 'homeworklist')
	{	
		require_once SMS_PLUGIN_DIR. '/admin/includes/student_HomeWork/homeworklist.php'; 
	}
	if($active_tab == 'addhomework')
	{
		require_once SMS_PLUGIN_DIR. '/admin/includes/student_HomeWork/add-studentHomework.php';
	}
	 
	// view student Status
	if($active_tab == 'view_stud_detail')
	{	
		$homework=new Smgt_Homework();
		$res=$homework->smgt_get_class_homework();
	
		?>
			<div class="panel-body">	
				<form name="class_form" action="" method="post" class="form-horizontal" id="class_form">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="homewrk"><?php _e('Select Homework','school-mgt');?><span class="require-field">*</span></label>
						<div class="col-sm-4">
								<select name="homewrk" class="form-control validate[required]" id="homewrk">
									<option value=""><?php _e('Select Homework','school-mgt');?></option>
										<?php
											foreach($res as $classdata)
											{  
											?>
											 <option value="<?php echo $classdata->homework_id;?>"><?php echo $classdata->title;?></option>
										<?php
											}?>
									</select>
						</div>
						<div class="col-sm-4">
								<label for="subject_id">&nbsp;</label>
						<input type="submit" value="<?php _e('View','school-mgt');?>" name="view"  class="btn btn-info"/>
						  
						</div>
					</div>    
					<?php
					$obj=new Smgt_Homework();
					if(isset($_POST['homewrk']))
					{
					  $data=$_POST['homewrk'];
					  $retrieve_class=$obj-> view_submission($data);
						 require_once SMS_PLUGIN_DIR. '/admin/includes/student_HomeWork/viewsubmission.php';
					}
					else
					{
					  if(isset($_REQUEST['homework_id']))
					  {
						 $data=$_REQUEST['homework_id'];
						 $retrieve_class=$obj-> view_submission($data);
						 require_once SMS_PLUGIN_DIR. '/admin/includes/student_HomeWork/viewsubmission.php';
					  }
					}
					?>
				</form>
			</div>
     <?php
    
	}
	?>