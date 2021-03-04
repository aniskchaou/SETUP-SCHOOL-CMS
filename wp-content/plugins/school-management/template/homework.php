<script type="text/javascript">
	 $(document).ready(function() {
		  $('#class_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});
	 } );
</script>
<?php 
$access=page_access_rolewise_and_accessright();
if($access)
{ 
//exam
	require_once SMS_PLUGIN_DIR. '/school-management-class.php';
	$homewrk=new Smgt_Homework();
	$active_tab = isset($_GET['tab'])?$_GET['tab']:'homeworklist';
?>
	<script>
	$(document).ready(function() {
		$('#examt_list').DataTable({
			responsive: true
		});
	} );
	</script>
<!-- Nav tabs -->
<?php 
if(isset($_GET['success']) && $_GET['success'] == 1 )
{
	?>
	<div id="message" class="updated below-h2">
		 <p><?php _e('Homework Upload successfully !','school-mgt');?></p>
	</div>
	<?php
}	
if(isset($_GET['filesuccess']) && $_GET['filesuccess'] == 1 )
{
	?>
	<div id="message" class="updated below-h2">
		 <p><?php _e('File Extension Invalid !','school-mgt');?></p>
	</div>
	<?php
}	
if(isset($_GET['addsuccess']) && $_GET['addsuccess'] == 1 )
{
	?>
		<div id="message" class="updated below-h2">
			<p><?php _e('Homework inserted successfully !','school-mgt');?></p>
		</div>
			<?php
}
if(isset($_GET['deletesuccess']) && $_GET['deletesuccess'] == 1 )
{
	?>
		<div id="message" class="updated below-h2">
			<p><?php _e('Homework Delete Successfully','school-mgt');?></p>
		</div>
	<?php 
}		
				
?>
<div class="panel-body panel-white">
	<?php if($school_obj->role=='student' || $school_obj->role=='parent') 
{?>
	<ul class="nav nav-tabs panel_tabs" role="tablist">
		<li class="<?php if($active_tab=='homeworklist'){?>active<?php }?>">
			<a href="?dashboard=user&page=homework&tab=homeworklist">
				<i class="fa fa-align-justify"></i> <?php _e('HomeWork List', 'school-mgt'); ?>
		    </a>
        </li>
				<!--<li>
				<a href="?dashboard=user&page=homework&tab=homeworklist" class="nav-tab <?php echo $active_tab == 'homeworklist' ? 'nav-tab-active' : ''; ?>">
				<?php echo '<span class="dashicons dashicons-menu"></span>'. __('HomeWork List', 'school-mgt'); ?></a></li>-->
				 <?php 
				if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'view')
				{?>
				<!--<li>
				<a href="?dashboard=user&page=homework&tab=Viewhomework&action=view&homework_id=<?php echo $_REQUEST['homework_id'];?>" class="nav-tab <?php echo $active_tab == 'Viewhomework' ? 'nav-tab-active' : ''; ?>">
					<?php _e('Edit Homework', 'school-mgt'); ?></a>  </li>-->
					<li class="<?php if($active_tab=='Viewhomework'){?>active<?php }?>">
						<a href="?dashboard=user&page=homework&tab=Viewhomework&action=view&homework_id=<?php echo $_REQUEST['homework_id'];?>">
							<i class="fa fa-upload"></i> <?php _e('Upload Homework', 'school-mgt'); ?></a>
						</a>
					</li>
				 <?php 
				}?>
    </ul>
	<?php 
}
?>
<?php if($school_obj->role=='teacher') 
{?>
	<ul class="nav nav-tabs panel_tabs" role="tablist">
		<li class="<?php if($active_tab=='homeworklist'){?>active<?php }?>">
			<a href="?dashboard=user&page=homework&tab=homeworklist">
				<i class="fa fa-align-justify"></i> <?php _e('HomeWork List', 'school-mgt'); ?>
			</a>
		</li>
	 
				<!--<li><a href="?dashboard=user&page=homework&tab=homeworklist" class="nav-tab <?php echo $active_tab == 'homeworklist' ? 'nav-tab-active' : ''; ?>">
					<?php echo '<span class="dashicons dashicons-menu"></span>'. __('HomeWork List', 'school-mgt'); ?></a>-->
			<?php 
			if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'view')
			{?>
				<li class="<?php if($active_tab=='homeworklist'){?>active<?php }?>">
					<a href="?dashboard=user&page=homework&tab=homeworklist&&action=view&homework_id=<?php echo $_REQUEST['homework_id'];?>>
						<i class="fa fa-align-justify"></i> <?php _e('Edit Homework', 'school-mgt'); ?>
					</a>
				</li>
					<!-- <a href="?dashboard=user&page=homework&tab=homeworklist&&action=view&homework_id=<?php echo $_REQUEST['homework_id'];?>" class="nav-tab <?php echo $active_tab == 'addhomework' ? 'nav-tab-active' : ''; ?>">
					<?php _e('Edit Homework', 'school-mgt'); ?></a> </li>-->
					<?php 
			}
			else
			{?>
					<li class="<?php if($active_tab=='addhomework'){?>active<?php }?>">
						<a href="?dashboard=user&page=homework&tab=addhomework">
							<i class="fa fa-align-justify"></i> <?php _e('Add Homework', 'school-mgt'); ?>
						</a>
					</li>
					<li class="<?php if($active_tab=='view_stud_detail'){?>active<?php }?>">
						<a href="?dashboard=user&page=homework&tab=view_stud_detail">
							<i class="fa fa-eye"></i> <?php _e('View Submission', 'school-mgt'); ?>
						</a>
					</li>
					<!--<li><a href="?dashboard=user&page=homework&tab=addhomework" class="nav-tab <?php echo $active_tab == 'addhomework' ? 'nav-tab-active' : ''; ?>">
					<?php echo '<span class="dashicons dashicons-plus-alt"></span>'.__('Add Homework', 'school-mgt'); ?></a> </li> 
					<?php 
			} ?>	
					<li><a href="?dashboard=user&page=homework&tab=view_stud_detail" class="nav-tab <?php echo $active_tab == 'view_stud_detail' ? 'nav-tab-active' : ''; ?> ">
					<?php echo '<span class="fa fa-eye"></span>'. __('View Submission', 'school-mgt'); ?></a></li>-->
	</ul>
<?php 
}?>
    
    <!-- Tab panes -->
	<?php
	if($active_tab == 'addhomework')
	 {
		require_once SMS_PLUGIN_DIR. '/template/add-studentHomework.php';
		
	 }
	if($active_tab == 'view_stud_detail')
	{	
			$homework=new Smgt_Homework();
			$res=$homework->get_teacher_homeworklist();
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
											<?php }?>
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
									 require_once SMS_PLUGIN_DIR. '/template/viewsubmission.php';
								}
								else
								{
								  if(isset($_REQUEST['homework_id']))
								  {
									 $data=$_REQUEST['homework_id'];
									 $retrieve_class=$obj-> view_submission($data);
									 require_once SMS_PLUGIN_DIR. '/template/viewsubmission.php';
								  }
								}
								?>
					</form>
			</div>
       <?php
    }
	 ?>
    <div class="tab-content">
	<?php 
	if($active_tab=="homeworklist")
	{?>
		<div class="tab-pane fade active in" id="examlist">         
			<?php 
			 if($school_obj->role=='student')
			{
				$result=$homewrk->student_view_detail();
			}
			else if($school_obj->role=='parent')
			{
			global $user_ID;
			$result=smgt_get_parents_child_id($user_ID);		
			$result = implode(",",$result);
			$result = $homewrk->parent_view_detail($result);
			
			}
			else
			{
				$result=$homewrk->get_teacher_homeworklist();
			}		
			?>
			<div class="panel-body">
				<div class="table-responsive">
						<table id="examt_list" class="display dataTable" cellspacing="0" width="100%">
							<thead>
								<tr>                
									<th><?php _e('Homework Title','school-mgt');?></th>
									 <?php if($school_obj->role=='parent') {?>
									 <th><?php _e('Student','school-mgt');?></th>
									 <?php }?>
									<th><?php _e('Class','school-mgt');?></th>
									<th><?php _e('Subject','school-mgt');?></th>
									<?php   
										if($school_obj->role=='student' || $school_obj->role=='parent')
										{ ?>
										<th><?php _e('Status','school-mgt');?></th>
										<?php 
										}?>
									<th><?php _e('Date','school-mgt');?></th>
									<th><?php _e('Action','school-mgt');?></th>               
								</tr>
							</thead>
					 
							<tfoot>
								  <tr>                
									<th><?php _e('Homework Title','school-mgt');?></th>
									 <?php if($school_obj->role=='parent') {?>
									 <th><?php _e('Student','school-mgt');?></th>
									 <?php }?>
									<th><?php _e('Class','school-mgt');?></th>
									<th><?php _e('Subject','school-mgt');?></th>
									<?php  if($school_obj->role=='student' || $school_obj->role=='parent')
									{ ?>
									<th><?php _e('Status','school-mgt');?></th>
									
								<?php }?>
								<th><?php _e('Date','school-mgt');?></th>
									<th><?php _e('Action','school-mgt');?></th>               
								</tr>
							</tfoot>
				 
							<tbody>
							  <?php 
								foreach ($result as $retrieved_data)
								{ 			
							     ?>
									<tr>
										<td><?php echo $retrieved_data->title;?></td>
										<?php 
										if($school_obj->role=='parent')
										{?>
											<td><?php echo get_user_name_byid($retrieved_data->student_id);?></td>	
											<?php 
										}?>
											<td><?php echo get_class_name($retrieved_data->class_name);?></td>  
											<td><?php echo get_single_subject_name($retrieved_data->subject);?></td>
										<?php  
										if($school_obj->role=='student' || $school_obj->role=='parent')
										{ ?>
										<?php  if($retrieved_data->status==1)
										if($retrieved_data->uploaded_date < $retrieved_data->submition_date)
										{
										 ?>
										 <td style="color:green"><?php echo $stat='Submitted'; ?></td>
										 <?php
										 }
										 else
										 {
										 ?><td style="color:green"><?php echo $stat='Late-Submitted'; ?></td><?php
										 }
										  else
										  {
										  ?>
										  <td style="color:red"><?php echo  $stat='Pending'; ?></td>
										  <?php			     
										  } 
										} ?>
											<td><?php echo $retrieved_data->submition_date;?></td>
									  <?php   
									    if($school_obj->role=='student' || $school_obj->role=='parent')
										{ ?>			
										<td><a href="?dashboard=user&page=homework&tab=Viewhomework&action=view&homework_id=<?php echo $retrieved_data->homework_id;?>&student_id=<?php echo $retrieved_data->student_id;?>" class="btn btn-info"> <?php echo '<i class="fa fa-eye"></i>  '.__('View','school-mgt');?></a></td>
										
									   <?php 
									    }
										else 
										{?>			     
											 <td><a href="?dashboard=user&page=homework&tab=addhomework&action=edit&homework_id=<?php echo $retrieved_data->homework_id;?>" class="btn btn-info"> <?php _e('Edit','school-mgt');?></a>
											   <a href="?dashboard=user&page=homework&tab=homeworklist&action=delete&homework_id=<?php echo $retrieved_data->homework_id;?>" class="btn btn-danger" onclick="return confirm('<?php _e('Are you sure you want to delete this record?','school-mgt');?>');"> <?php _e('Delete','school-mgt');?></a>
											   <a href="?dashboard=user&page=homework&tab=view_stud_detail&action=viewsubmission&homework_id=<?php echo $retrieved_data->homework_id;?>" class="btn btn-default"> <?php echo '<span class="fa fa-eye"></span> '.__('View Submission','school-mgt');?></a>
											  </td>
										
										<?php 
										}?>
									</tr>
								 <?php 
								} ?>
						    </tbody>
						</table>
				</div>
			</div>
		</div>
	  <?php
	} 
	  ?>
	   <?php 
			$view=0;
			if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'view')
					{
					  
						$view=1;
						$objj=new Smgt_Homework();
						$classdata= $objj->parent_update_detail($_GET['homework_id'],$_GET['student_id']);
						$data = $classdata[0];
					} 
					
	?>
	  <?php if($active_tab=="Viewhomework")
	  { 
	  ?>
		  <div class="tab-pane fade" id="examresult">
		   <li class="active">
			  <a href="?dashboard=user&page=homework&tab=Viewhomework" role="tab" data-toggle="tab">
				<i class="fa fa-align-justify"></i> <?php _e('Homework File Upload', 'school-mgt'); ?></a>
			  </a>
			  </li>
			 
		  </div>
		  <div class="tab-pane fade active in" id="">
				<div class="panel-body">	
			        <form name="class_form" action="" method="post" class="form-horizontal" id="class_form" enctype="multipart/form-data">
						<?php $action = isset($_REQUEST['action'])?$_REQUEST['action']:'insert';?>
							<input type="hidden" name="action" value="<?php echo $action;?>">
							<input type="hidden" id="stu_homework_id" name="stu_homework_id" value="<?php if($view){ echo $data->stu_homework_id;}?>">
							<input type="hidden" id="homework_id" name="homework_id" value="<?php if($view){ echo $data->homework_id;}?>">
							<input type="hidden" id="status" name="status" value="<?php if($view){ echo $data->status;}?>">    
							<input type="hidden" id="student_id" name="student_id" value="<?php if($view){ echo $data->student_id;}?>">       		
					    <div class="form-group">
							<label class="col-sm-2 control-label" for="class_name"><?php _e('Title','school-mgt');?></label>
							<div class="col-sm-8">
								<input id="title" class="form-control validate[required]"  value="<?php if($view){ echo $data->title;}?>" name="title" readonly>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="class_name"><?php _e('Subject','school-mgt');?></label>
							<div class="col-sm-8">
								<input id="subject" class="form-control validate[required]"  value="<?php if($view){ echo get_single_subject_name($data->subject);}?>" name="subject" readonly>
							</div>
						</div>
						<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.1/tinymce.jquery.min.js"></script>
							  <script>
							  
								  tinymce.init({
								  selector: 'textarea',
								   menubar:false,
								  toolbar: false,
								  readonly : 1
								   });
							  </script>
				  
						<div class="form-group">
							<label class="col-sm-2 control-label" for="class_name"><?php _e('Content','school-mgt');?></label>
							<div class="col-sm-8" id='conten'>
							<?php $str = $data->content; ?>
							
								<textarea id="content" class="form-control validate[required]" style='width:100%;height:200px' value="" name="content" readonly><?php if($view){ echo '<pre>'.$str.'</pre>'; }?></textarea>
							 
							   <?php //wp_editor(isset($view)?stripslashes($str) : '','content'); ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="class_name"><?php _e('Submission Date','school-mgt');?></label>
							<div class="col-sm-8">
								<input id="submition_date" class="form-control validate[required]"  value="<?php if($view){ echo $data->submition_date;}?>" name="submition_date" readonly>
							</div>
						</div>
						<?php
						    if($data->status == 0)
						    {
								  ?>
								<div class="form-group">
									<label class="col-sm-2 control-label" for="class_name"><?php _e('Upload Homework File','school-mgt');?></label>
									<div class="col-sm-8">
										<input id="file" type='file' class="form-control validate[required]"  value="<?php if($view){ echo $data->submition_date;}?>" name="file">
									</div>
								</div>		
								<div class="col-sm-offset-2 col-sm-8">        	
									<input type="submit" value="<?php  if($view) _e('Save Homework','school-mgt');?>" name="Save_Homework" class="btn btn-success" />
								</div> 
								<?php 
							}
							else
							{?>
								<div class="col-sm-offset-2 col-sm-8">        	
									<label class="col-sm-6 control-label" for="class_name" style='color:green;'><?php _e('HOMEWORK SUBMITTED !','school-mgt');?></label>
								</div> 
								<?php 
							}?>
				</form>
			</div>
		  </div> 
     <?php 
	}?>
    </div>
 </div>   
 <?php 
if($school_obj->role=='teacher')
{
	if(isset($_POST['Save_Homework']))
	{
			if(isset($_REQUEST['smgt_enable_homework_mail']))
				update_option( 'smgt_enable_homework_mail', 1 );
			else
			update_option( 'smgt_enable_homework_mail', 0 );
			$insert=new Smgt_Homework();
			$result=$insert->add_homework($_POST);
			if($result)
			{
				header("Location: ?dashboard=user&page=homework&tab=addhomework&addsuccess=1");
			}
	}
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')
	{
		$delete=new Smgt_Homework();
	    $dele=$delete->get_delete_record($_REQUEST['homework_id']);
			if($dele)
			{
			header("Location: ?dashboard=user&page=homework&tab=addhomework&deletesuccess=1");
			
			}
	}
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
}
if($school_obj->role=='student' || $school_obj->role=='parent')
{
	if(isset($_POST['Save_Homework']))
    {
	  
			$uploadfile=array('stu_homework_id'=>MJ_smgt_onlyNumberSp_validation($_POST['stu_homework_id']),
	        'homework_id'=>MJ_smgt_onlyNumberSp_validation($_POST['homework_id']),
			'status'=>MJ_smgt_onlyNumberSp_validation($_POST['status']),
	        'title'=>MJ_smgt_popup_category_validation($_POST['title']),
			'subject'=>MJ_smgt_popup_category_validation($_POST['subject']),
			'content'=>MJ_smgt_address_description_validation($_POST['content']),
			'submition_date'=>$_POST['submition_date'],
			'upload_file'=>$_FILES['file']
				);
	
		if(!empty($uploadfile))
		{
			if(isset($_FILES['file']))
			{
				$randm = mt_rand(5,15);
		        $file_name = "H".$randm."_".$_FILES['file']['name'];
				$ext = $homewrk->check_valid_extension($file_name);
					if($ext != 0)
			        {
						$file_tmp =$_FILES['file']['tmp_name'];
						$up=move_uploaded_file($file_tmp,SMS_PLUGIN_DIR."/uploadfile/".$file_name);
							global $wpdb;
							$table_name='wp_smgt_student_homework';
							$stud_homework_id=$_POST['stu_homework_id'];
							$stud_id=$_POST['student_id'];
							$homework_id=$_POST['homework_id'];
							$status = 1 ;
							//$file=$_FILES['file'];
							$uploaded_date=date("Y-m-d H:i:s");
							$result=$wpdb->update($table_name, array( 
							'homework_id' => $homework_id,	// string
							'student_id' => $stud_id,	// integer (number) 
							'status' => $status,
							'uploaded_date' => $uploaded_date,
							'file' => $file_name), 
								array( 'stu_homework_id' => $stud_homework_id ), 
								array( '%d','%d','%d','%s','%s'), 
								array( '%d' ));
								if($result)
								{
								header("Location: ?dashboard=user&page=homework&tab=homeworklist&success=1");
								}
					}
					else
					{
					header("Location: ?dashboard=user&page=homework&tab=homeworklist&filesuccess=1");
					}
			}
			else
			{
				echo "File Not Upload";
			}
				
		}
	}
}
}
else
{
	wp_redirect ( admin_url () . 'index.php' );
} 
?>
