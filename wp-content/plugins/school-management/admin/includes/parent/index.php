<?php 
	$role='parent';
	if(isset($_POST['save_parent']))
	{
		$nonce = $_POST['_wpnonce'];
	    if ( wp_verify_nonce( $nonce, 'save_parent_admin_nonce' ) )
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
			
			$usermetadata	=	array(
				'middle_name'=>MJ_smgt_onlyLetter_specialcharacter_validation($_POST['middle_name']),
				'gender'=>MJ_smgt_onlyLetterSp_validation($_POST['gender']),
				'birth_date'=>$_POST['birth_date'],
				'address'=>MJ_smgt_address_description_validation($_POST['address']),
				'city'=>MJ_smgt_city_state_country_validation($_POST['city_name']),
				'state'=>MJ_smgt_city_state_country_validation($_POST['state_name']),
				'zip_code'=>MJ_smgt_onlyLetterNumber_validation($_POST['zip_code']),
				'phone'=>MJ_smgt_phone_number_validation($_POST['phone']),
				'mobile_number'=>MJ_smgt_phone_number_validation($_POST['mobile_number']),
				'relation'=>MJ_smgt_onlyLetterSp_validation($_POST['relation']),
				'smgt_user_avatar'=>$photo,								
			);
		
			if($_REQUEST['action']=='edit')
			{			
				$userdata['ID']=$_REQUEST['parent_id'];			
				$result=update_user($userdata,$usermetadata,$firstname,$lastname,$role);
				if($result)
				{ 
					wp_redirect ( admin_url().'admin.php?page=smgt_parent&tab=parentlist&message=1'); 
				}
			}
			else
			{
				if( !email_exists($_POST['email']) && !username_exists(smgt_strip_tags_and_stripslashes($_POST['username']))) 
				{
					$result=add_newuser($userdata,$usermetadata,$firstname,$lastname,$role);
					if($result)
					{ 
						wp_redirect ( admin_url().'admin.php?page=smgt_parent&tab=parentlist&message=2'); 
					} 
				}
				else 
				{ 
					wp_redirect ( admin_url().'admin.php?page=smgt_parent&tab=parentlist&message=3'); 
				}		  
			}
	    }
	}
	$addparent	=	0;
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'addparent')
	{
		if(isset($_REQUEST['student_id']))
		{			
			$student=get_userdata($_REQUEST['student_id']);
			$addparent=1;
		}
	}	
	
	$active_tab = isset($_GET['tab'])?$_GET['tab']:'parentlist';
	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')
	{
		$childs=get_user_meta($_REQUEST['parent_id'], 'child', true);
		if(!empty($childs))
		{
			foreach($childs as $childvalue)
			{
				$parents=get_user_meta($childvalue, 'parent_id', true);
				if(!empty($parents))
				{
					if(($key = array_search($_REQUEST['parent_id'], $parents)) !== false) {
						unset($parents[$key]);
						update_user_meta( $childvalue,'parent_id', $parents );
					}
				}
			}
		}
		$result=delete_usedata($_REQUEST['parent_id']);	
		if($result)
		{ 
			wp_redirect ( admin_url().'admin.php?page=smgt_parent&tab=parentlist&message=4'); 
		}
	}
if(isset($_REQUEST['delete_selected']))
{		
	if(!empty($_REQUEST['id']))
	foreach($_REQUEST['id'] as $id)
	{
		$childs=get_user_meta($id, 'child', true);
		if(!empty($childs))
		{
			foreach($childs as $childvalue)
			{
				$parents=get_user_meta($childvalue, 'parent_id', true);
				if(!empty($parents))
				{
					if(($key = array_search($id, $parents)) !== false)
					{
						unset($parents[$key]);
						update_user_meta( $childvalue,'parent_id', $parents );
					}
				}
			}
		}
		$result=delete_usedata($id);	
	}
		
	if($result) { 
		wp_redirect ( admin_url().'admin.php?page=smgt_parent&tab=parentlist&message=4'); 
	}
}		
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
			$message_string = __('Parent Updated Successfully.','school-mgt');
			break;
		case '2':
			$message_string = __('Parent Inserted Successfully.','school-mgt');
			break;	
		case '3':
			$message_string = __('Username Or Emailid Already Exist.','school-mgt');
			break;	
		case '4':
			$message_string = __('Parent Deleted Successfully.','school-mgt');
			break;		
	}
	
	if($message)
	{ ?>
		<div id="message" class="updated below-h2 notice is-dismissible">
			<p><?php echo $message_string;?></p>
			<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
		</div>
<?php } ?>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white">
					<div class="panel-body">
	<h2 class="nav-tab-wrapper">
    	<a href="?page=smgt_parent&tab=parentlist" class="nav-tab <?php echo $active_tab == 'parentlist' ? 'nav-tab-active' : ''; ?>">
		<?php echo '<span class="dashicons dashicons-menu"></span>'.__('Parent List', 'school-mgt'); ?></a>
    	
        <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit')
		{?>
        <a href="?page=smgt_parent&tab=addparent&&action=edit&parent_id=<?php echo $_REQUEST['parent_id'];?>" class="nav-tab <?php echo $active_tab == 'addparent' ? 'nav-tab-active' : ''; ?>">
		<?php _e('Edit Parent', 'school-mgt'); ?></a>  
		<?php 
		}
		else
		{?>
			<a href="?page=smgt_parent&tab=addparent" class="nav-tab margin_bottom <?php echo $active_tab == 'addparent' ? 'nav-tab-active' : ''; ?>">
		<?php echo '<span class="dashicons dashicons-plus-alt"></span>'.__('Add New Parent', 'school-mgt'); ?></a>  
		<?php }?>
       
    </h2>
     <?php 
	//Report 1 
	if($active_tab == 'parentlist')
	{ 
	?>  
<div class="panel-body">
<script>
jQuery(document).ready(function() {
	var table =  jQuery('#parent_list').DataTable({
        responsive: true,
		"order": [[ 2, "asc" ]],
		"aoColumns":[	                  
		  {"bSortable": false},
		  {"bSortable": false},	                  	                
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
        <table id="parent_list" class="display admin_parent_datatable" cellspacing="0" width="100%">
        	 <thead>
            <tr>
				<th style="width: 20px;"><input name="select_all" value="all" id="checkbox-select-all" 
				type="checkbox" /></th> 
				<th width="75px"><?php echo _e('Photo', 'school-mgt' ) ;?></th>
                <th><?php echo _e( 'Parent Name', 'school-mgt' ) ;?></th>
                <th> <?php echo _e( 'Parent Email', 'school-mgt' ) ;?></th>
                <th><?php echo _e( 'Action', 'school-mgt' ) ;?></th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th></th>
				<th><?php echo _e( 'Photo', 'school-mgt' ) ;?></th>
               <th><?php echo _e( 'Parent Name', 'school-mgt' ) ;?></th>
                <th> <?php echo _e( 'Parent Email', 'school-mgt' ) ;?></th>
                <th><?php echo _e( 'Action', 'school-mgt' ) ;?></th>
                
            </tr>
        </tfoot>
 
        <tbody>
         <?php 
			$parentdata=get_usersdata('parent');
			if($parentdata)
			{
				foreach ($parentdata as $retrieved_data){ ?>	
				<tr>
				<td><input type="checkbox" class="select-checkbox" name="id[]" 
				value="<?php echo $retrieved_data->ID;?>"></td>
					<td class="user_image "><?php $uid=$retrieved_data->ID;
								$umetadata=get_user_image($uid);
								if(empty($umetadata['meta_value']))
									{
										echo '<img src='.get_option( 'smgt_parent_thumb' ).' height="50px" width="50px" class="img-circle" />';
									}
								else
								echo '<img src='.$umetadata['meta_value'].' height="50px" width="50px" class="img-circle"/>';
					?></td>
					<td class="name"><a href="?page=smgt_parent&tab=addparent&action=edit&parent_id=<?php echo $retrieved_data->ID;?>"><?php echo $retrieved_data->display_name;?></a></td>
					<td class="email"><?php echo $retrieved_data->user_email;?></td>
					
					<td class="action"> <a href="?page=smgt_parent&tab=addparent&action=edit&parent_id=<?php echo $retrieved_data->ID;?>" class="btn btn-info"> <?php echo _e( ' Edit', 'school-mgt' ) ;?></a>
										<a href="?page=smgt_parent&tab=parentlist&action=delete&parent_id=<?php echo $retrieved_data->ID;?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');"><?php echo _e( ' Delete', 'school-mgt' ) ;?> </a>
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
	
	if($active_tab == 'addparent')
	 {
	require_once SMS_PLUGIN_DIR. '/admin/includes/parent/add-newparent.php';
	 }
	 ?>				
	 			</div><!-- Panel white -->
	 		</div><!-- col-md-12 -->
	 	</div><!-- Row -->
	 </div><!-- #mainwrapper -->
</div><!-- page-inner -->
<?php ?>