<?php 
$role='supportstaff';
if(isset($_POST['save_supportstaff']))
{
	$nonce = $_POST['_wpnonce'];
	if ( wp_verify_nonce( $nonce, 'save_supportstaff_admin_nonce' ) )
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
		
		$usermetadata=array('middle_name'=>MJ_smgt_onlyLetter_specialcharacter_validation($_POST['middle_name']),
							'gender'=>MJ_smgt_onlyLetterSp_validation($_POST['gender']),
							'birth_date'=>$_POST['birth_date'],
							'address'=>MJ_smgt_address_description_validation($_POST['address']),
							'city'=>MJ_smgt_city_state_country_validation($_POST['city_name']),
							'state'=>MJ_smgt_city_state_country_validation($_POST['state_name']),
							'zip_code'=>MJ_smgt_onlyLetterNumber_validation($_POST['zip_code']),
							
							'phone'=>MJ_smgt_phone_number_validation($_POST['phone']),
							'mobile_number'=>MJ_smgt_phone_number_validation($_POST['mobile_number']),
							'alternet_mobile_number'=>MJ_smgt_phone_number_validation($_POST['alternet_mobile_number']),
							'working_hour'=>MJ_smgt_onlyLetter_specialcharacter_validation($_POST['working_hour']),
							'possition'=>MJ_smgt_address_description_validation($_POST['possition']),
							'smgt_user_avatar'=>$photo,
							
		);
		
		if($_REQUEST['action']=='edit')
		{
			$userdata['ID']=$_REQUEST['supportstaff_id'];
			$result=update_user($userdata,$usermetadata,$firstname,$lastname,$role);
			//var_dump($result);
			if($result)
			{
				wp_redirect ( admin_url().'admin.php?page=smgt_supportstaff&tab=supportstaff_list&message=2'); 
			}		
		}
		else
		{
			if( !email_exists( $_POST['email'] ) && !username_exists( smgt_strip_tags_and_stripslashes($_POST['username']))) {
				$result=add_newuser($userdata,$usermetadata,$firstname,$lastname,$role);
				if($result)
				{ 
						wp_redirect ( admin_url().'admin.php?page=smgt_supportstaff&tab=supportstaff_list&message=1');
				 }
			}
			else 
			{ 
				wp_redirect ( admin_url().'admin.php?page=smgt_supportstaff&tab=supportstaff_list&message=3');
			}
		}
	}
}

	if(isset($_REQUEST['action'])&& $_REQUEST['action']=='delete')
		{
			
			$result=delete_usedata($_REQUEST['supportstaff_id']);
			if($result)
			{
				wp_redirect ( admin_url().'admin.php?page=smgt_supportstaff&tab=supportstaff_list&message=4');
			}
		}
if(isset($_REQUEST['delete_selected']))
	{		
		if(!empty($_REQUEST['id']))
		foreach($_REQUEST['id'] as $id)
			$result=delete_usedata($id);
		if($result)
			{
				wp_redirect ( admin_url().'admin.php?page=smgt_supportstaff&tab=supportstaff_list&message=4');
			}
	}
$active_tab = isset($_GET['tab'])?$_GET['tab']:'supportstaff_list';
	
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
			$message_string = __('Support Staff Inserted Successfully.','school-mgt');
			break;
		case '2':
			$message_string = __('Support Staff Updated Successfully.','school-mgt');
			break;	
		case '3':
			$message_string = __('Username Or Email-id Already Exist.','school-mgt');
			break;
		case '4':
			$message_string = __('Support Staff Deleted Successfully.','school-mgt');
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
    	<a href="?page=smgt_supportstaff&tab=supportstaff_list" class="nav-tab <?php echo $active_tab == 'supportstaff_list' ? 'nav-tab-active' : ''; ?>">
		<?php echo '<span class="dashicons dashicons-menu"></span>'.__('Support Staff List', 'school-mgt'); ?></a>
    	
        <?php if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit')
		{?>
        <a href="?page=smgt_supportstaff&tab=addsupportstaff&&action=edit&supportstaff_id=<?php echo $_REQUEST['supportstaff_id'];?>" class="nav-tab <?php echo $active_tab == 'addsupportstaff' ? 'nav-tab-active' : ''; ?>">
		<?php _e('Edit Support Staff', 'school-mgt'); ?></a>  
		<?php 
		}
		else
		{?>
			<a href="?page=smgt_supportstaff&tab=addsupportstaff" class="nav-tab margin_bottom <?php echo $active_tab == 'addsupportstaff' ? 'nav-tab-active' : ''; ?>">
		<?php echo '<span class="dashicons dashicons-plus-alt"></span> '.__('Add New Support Staff', 'school-mgt'); ?></a>  
		<?php }?>
       
    </h2>
     <?php 
	//Report 1 
	if($active_tab == 'supportstaff_list')
	{ 
	
	?>	
    
    <form name="wcwm_report" action="" method="post">
    
        <div class="panel-body">
		<script>
jQuery(document).ready(function() {
	var table =  jQuery('#supportstaff_list').DataTable({
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
        <table id="supportstaff_list" class="display admin_supportstaff_datatable" cellspacing="0" width="100%">
        	 <thead>
            <tr>
			<th style="width: 20px;"><input name="select_all" value="all" id="checkbox-select-all" 
				type="checkbox" /></th> 
			   <th><?php  _e( 'Photo', 'school-mgt' ) ;?></th>
                <th><?php _e( 'Name', 'school-mgt' ) ;?></th>			  
                <th> <?php _e( 'Email', 'school-mgt' ) ;?></th>
                <th><?php  _e( 'Action', 'school-mgt' ) ;?></th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th></th>
				<th><?php  _e( 'Photo', 'school-mgt' ) ;?></th>
              <th><?php _e( 'Name', 'school-mgt' ) ;?></th>			  
                <th> <?php _e( 'Email', 'school-mgt' ) ;?></th>
                <th><?php  _e( 'Action', 'school-mgt' ) ;?></th>
                
            </tr>
        </tfoot>
 
        <tbody>
         <?php 
		$teacherdata=get_usersdata('supportstaff');
		 if(!empty($teacherdata))
		 {
		 	foreach (get_usersdata('supportstaff') as $retrieved_data){ 
			
			
		 ?>
            <tr>
			<td><input type="checkbox" class="select-checkbox" name="id[]" 
				value="<?php echo $retrieved_data->ID;?>"></td>
				<td class="user_image" width="50px"><?php $uid=$retrieved_data->ID;
							$umetadata=get_user_image($uid);
		 	if(empty($umetadata['meta_value']))
									{
										echo '<img src='.get_option( 'smgt_supportstaff_thumb' ).' height="50px" width="50px" class="img-circle" />';
									}
							else
							echo '<img src='.$umetadata['meta_value'].' height="50px" width="50px" class="img-circle"/>';
				?></td>
                <td class="name"><a href="?page=smgt_supportstaff&tab=addsupportstaff&action=edit&supportstaff_id=<?php echo $retrieved_data->ID;?>"><?php echo $retrieved_data->display_name;?></a></td>
               
			
                <td class="email"><?php echo $retrieved_data->user_email;?></td>
               	<td class="action"> <a href="?page=smgt_supportstaff&tab=addsupportstaff&action=edit&supportstaff_id=<?php echo $retrieved_data->ID;?>" class="btn btn-info"> <?php _e('Edit', 'school-mgt' ) ;?></a>
                <a href="?page=smgt_supportstaff&tab=supportstaff_list&action=delete&supportstaff_id=<?php echo $retrieved_data->ID;?>" class="btn btn-danger" 
                onclick="return confirm('<?php _e('Are you sure you want to delete this record?','school-mgt');?>');">
                <?php _e( 'Delete', 'school-mgt' ) ;?> </a>
                
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
       
</form>
     <?php 
	 }
	
	if($active_tab == 'addsupportstaff')
	 {
	require_once SMS_PLUGIN_DIR. '/admin/includes/supportstaff/add-staff.php';
	 }
	 ?>
</div>
			
		</div>
	</div>
</div>