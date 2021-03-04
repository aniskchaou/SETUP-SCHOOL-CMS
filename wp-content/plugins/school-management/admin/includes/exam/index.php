<?php 
	$tablename="exam";
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete')
	{
		$result=delete_exam($tablename,$_REQUEST['exam_id']);
		if($result){
			wp_redirect ( admin_url().'admin.php?page=smgt_exam&tab=examlist&message=3');
		}
	}
	if(isset($_REQUEST['delete_selected']))
	{		
		if(!empty($_REQUEST['id']))
		foreach($_REQUEST['id'] as $id)
		{ $result=delete_exam($tablename,$id);}
		if($result){ 
			wp_redirect ( admin_url().'admin.php?page=smgt_exam&tab=examlist&message=3');
		}
	}
	//-----------update record-------------------------
	if(isset($_POST['save_exam']))
	{	
        $nonce = $_POST['_wpnonce'];
	    if ( wp_verify_nonce( $nonce, 'save_exam_admin_nonce' ) )
		{
			$created_date = date("Y-m-d H:i:s");
			$examdata=array('exam_name'=>MJ_smgt_popup_category_validation($_POST['exam_name']),
				'exam_date'=>date('Y-m-d', strtotime($_POST['exam_date'])),
				'exam_comment'=>MJ_smgt_address_description_validation($_POST['exam_comment']),					
				'exam_creater_id'=>get_current_user_id(),
				'created_date'=>$created_date						
			);		
			
			//table name without prefix
			$tablename="exam";
			if($_REQUEST['action']=='edit')
			{
				$grade_id=array('exam_id'=>$_REQUEST['exam_id']);
				$modified_date_date = date("Y-m-d H:i:s");
				$examdata['modified_date']=$modified_date_date;
				$result=update_record($tablename,$examdata,$grade_id);
				if($result)
				{
				wp_redirect ( admin_url().'admin.php?page=smgt_exam&tab=examlist&message=2');
				}
			}
			else
			{
				$result=insert_record($tablename,$examdata);
				if($result)
				{ 
					wp_redirect ( admin_url().'admin.php?page=smgt_exam&tab=examlist&message=1');
				}				
			}
		}		
	}
	
	$active_tab = isset($_GET['tab'])?$_GET['tab']:'examlist';
?>
<div class="page-inner">
	<div class="page-title">
		<h3><img src="<?php echo get_option( 'smgt_school_logo' ) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo get_option( 'smgt_school_name' );?></h3>
	</div>
	<div  id="main-wrapper" class="grade_page">
	<?php
	$message = isset($_REQUEST['message'])?$_REQUEST['message']:'0';
	switch($message)
	{
		case '1':
			$message_string = __('Exam Added Successfully.','school-mgt');
			break;
		case '2':
			$message_string = __('Exam Updated Successfully.','school-mgt');
			break;	
		case '3':
			$message_string = __('Exam Delete Successfully.','school-mgt');
			break;
	}
	
	if($message)
	{ ?>
		<div id="message" class="updated below-h2 notice is-dismissible">
			<p><?php echo $message_string;?></p>
			<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
		</div>
<?php } ?>
	<div class="panel panel-white">
	<div class="panel-body">     
	<h2 class="nav-tab-wrapper">
    	<a href="?page=smgt_exam&tab=examlist" class="nav-tab margin_bottom <?php echo $active_tab == 'examlist' ? 'nav-tab-active' : ''; ?>">
		<?php echo '<span class="dashicons dashicons-menu"></span>'.__('Exam List', 'school-mgt'); ?></a>
         <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit')
		{?>
       <a href="?page=smgt_exam&tab=addexam&action=edit&exam_id=<?php echo $_REQUEST['exam_id'];?>" class="nav-tab margin_bottom<?php echo $active_tab == 'addexam' ? 'nav-tab-active' : ''; ?>">
		<?php _e('Edit Exam', 'school-mgt'); ?></a>  
		<?php 
		}
		else
		{?>
    	<a href="?page=smgt_exam&tab=addexam" class="nav-tab margin_bottom <?php echo $active_tab == 'addexam' ? 'nav-tab-active' : ''; ?>">
		<?php echo '<span class="dashicons dashicons-plus-alt"></span>'.__('Add Exam', 'school-mgt'); ?></a>  
        <?php } ?>
    </h2>
    <?php
	
	if($active_tab == 'examlist')
	{	
	?>	
   <?php 
		 	$retrieve_class = get_all_data($tablename);
		?>
        <div class="panel-body">
		<div class="table-responsive">
		<script>
jQuery(document).ready(function() {
	var table =  jQuery('#exam_list').DataTable({
        responsive: true,
		"order": [[ 1, "asc" ]],
		"aoColumns":[	                  
	                  {"bSortable": false},
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
<form id="frm-example" name="frm-example" method="post">	
        <table id="exam_list" class="display" cellspacing="0" width="100%">
        	 <thead>
            <tr>    
				<th style="width: 20px;"><input name="select_all" value="all" id="checkbox-select-all" 
				type="checkbox" /></th>   
                <th><?php _e('Exam Title','school-mgt');?></th>
                <th><?php _e('Exam Date','school-mgt');?></th>
                <th><?php _e('Exam Comment','school-mgt');?></th>
                <th><?php _e('Action','school-mgt');?></th>               
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th></th>
              <th><?php _e('Exam Title','school-mgt');?></th>
                <th><?php _e('Exam Date','school-mgt');?></th>
                <th><?php _e('Exam Comment','school-mgt');?></th>
                <th><?php _e('Action','school-mgt');?></th>     
            </tr>
        </tfoot>
 
        <tbody>
          <?php 
		 	foreach ($retrieve_class as $retrieved_data){ 
			
		 ?>
            <tr>
				<td><input type="checkbox" class="select-checkbox" name="id[]" 
				value="<?php echo $retrieved_data->exam_id;?>"></td>
                <td><?php echo $retrieved_data->exam_name;?></td>
                <td><?php echo smgt_getdate_in_input_box($retrieved_data->exam_date);?></td>
                <td><?php echo $retrieved_data->exam_comment;?></td>              
               <td><a href="?page=smgt_exam&tab=addexam&action=edit&exam_id=<?php echo $retrieved_data->exam_id;?>" class="btn btn-info"><?php _e('Edit','school-mgt');?></a>
               <a href="?page=smgt_exam&tab=examlist&action=delete&exam_id=<?php echo $retrieved_data->exam_id;?>" class="btn btn-danger" 
               onclick="return confirm('<?php _e('Are you sure you want to delete this record?','school-mgt');?>');"><?php _e('Delete','school-mgt');?></a></td>
            </tr>
            <?php } ?>
     
        </tbody>
        
        </table>
		 <div class="print-button pull-left">
			<input id="delete_selected" type="submit" value="<?php _e('Delete Selected','school-mgt');?>" name="delete_selected" class="btn btn-danger delete_selected"/>
			
		</div>
		</form>
       </div>
     <?php 
	 }
	if($active_tab == 'addexam')
	 {
		require_once SMS_PLUGIN_DIR. '/admin/includes/exam/add-exam.php';
		
	 }
	 ?>
	 		</div>
		</div>
	 	</div>
	 </div>
</div>
<?php ?>