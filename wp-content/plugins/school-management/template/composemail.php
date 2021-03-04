<div id="demo"></div>
<?php
$role = get_user_role(get_current_user_id());
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(isset($_POST['save_message']))
{
	$created_date = date("Y-m-d H:i:s");
	$subject = MJ_smgt_popup_category_validation($_POST['subject']);
	$message_body = MJ_smgt_address_description_validation($_POST['message_body']);
	$created_date = date("Y-m-d H:i:s");
	$tablename="smgt_message";
	$smgt_sms_service_enable=isset($_REQUEST['smgt_sms_service_enable'])?$_REQUEST['smgt_sms_service_enable']:0;
	$role=$_POST['receiver'];
	$MailBody  		= 	get_option('message_received_mailcontent');	
	$SchoolName 	=  	get_option('smgt_school_name');
	$SubArr['{{school_name}}'] 	= $SchoolName;
	$SubArr['{{from_mail}}'] = get_display_name(get_current_user_id());
	$MailSub = string_replacement($SubArr,get_option('message_received_mailsubject'));
	
	if(isset($_REQUEST['class_id']))
	$class_id = $_REQUEST['class_id'];
	
	
	$role = $_REQUEST['receiver'];
	$class_id = isset($_REQUEST['class_id'])?$_REQUEST['class_id']:'';
	$class_section = isset($_REQUEST['class_section'])?$_REQUEST['class_section']:'';
	$selected_users = isset($_REQUEST['selected_users'])?$_REQUEST['selected_users']:array();
		
	if(!empty($selected_users)){		
		$post_id = wp_insert_post( array(
			'post_status' => 'publish',
			'post_type' => 'message',
			'post_title' => $subject,
			'post_content' =>$message_body
		) );
		
		$reci_number =array();
		foreach($selected_users as $user_id)
		{
			$user_info = get_userdata($user_id);				 	
			$reci_number[]= "+".smgt_get_countery_phonecode(get_option( 'smgt_contry' )).get_user_meta($user_id, 'mobile_number',true);
		}
		
		$result=add_post_meta($post_id, 'message_for',$role);
		$result=add_post_meta($post_id, 'smgt_class_id',$_REQUEST['class_id']);
		foreach($selected_users as $user_id)
		{
			$user_info = get_userdata($user_id);				 	
			$reciever_number = "+".smgt_get_countery_phonecode(get_option( 'smgt_contry' )).get_user_meta($user_id, 'mobile_number',true);
			$message_content = $_POST['sms_template'];						
			$current_sms_service = get_option( 'smgt_sms_service');
			if($smgt_sms_service_enable)
			{
				if(is_plugin_active('sms-pack/sms-pack.php'))
				{				
					$args = array();
					$args['mobile']=$reci_number;
					$args['message_from']="message";
					$args['message_side']="front";
					$args['message']=str_replace(" ","%20",$message_content);					
					if($current_sms_service=='telerivet' || $current_sms_service ="MSG91" || $current_sms_service=='bulksmsgateway.in' || $current_sms_service=='textlocal.in' || $current_sms_service=='bulksmsnigeria' || $current_sms_service=='africastalking')
					{					
						$send = send_sms($args);						
					}					
				}
				
				
				$user_info = get_userdata($user_id);				 	
				$reciever_number = "+".smgt_get_countery_phonecode(get_option( 'smgt_contry' )).get_user_meta($user_id, 'mobile_number',true);
				
				if($current_sms_service == 'clickatell')
				{ 								 				
				 	$clickatell=get_option('smgt_clickatell_sms_service');
				 	$to = $reciever_number;
				 	$message = str_replace(" ","%20",$message_content);
				 	$username = $clickatell['username']; //clickatell username
				 	$password = $clickatell['password']; // clickatell password
				 	$api_key = $clickatell['api_key'];//clickatell apikey
				 	$sender_id = $clickatell['sender_id'];//clickatell sender_id
				 	$baseurl ="http://api.clickatell.com";
				 				
				 	$ret = file($url);
				 	$sess = explode(":",$ret[0]);
				 	if ($sess[0] == "OK")
					{
				 		$sess_id = trim($sess[1]); // remove any whitespace
				 		$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$message&from=$sender_id";
						$ret = file($url);
				 		$send = explode(":",$ret[0]);				 					
				 	}
				 				
				 }
		 		if($current_sms_service == 'twillo')
	 			{
	 				require_once SMS_PLUGIN_DIR. '/lib/twilio/Services/Twilio.php';
	 				$twilio=get_option( 'smgt_twillo_sms_service');
	 				$account_sid = $twilio['account_sid']; //Twilio SID
	 				$auth_token = $twilio['auth_token']; // Twilio token
	 				$from_number = $twilio['from_number'];//My number
	 				$receiver = $reciever_number; //Receiver Number
	 				$message = $message_content; // Message Text
	 				$client = new Services_Twilio($account_sid, $auth_token);
	 				$message_sent = $client->account->messages->sendMessage(
						$from_number, // From a valid Twilio number
						$receiver, // Text this number
						$message
					);
				 				
				 }
			}
			
		$message_data=array('sender'=>get_current_user_id(),
			'receiver'=>$user_id,
			'subject'=>$subject,
			'message_body'=>$message_body,
			'date'=>$created_date,
			'post_id'=>$post_id,
			'status' =>0
		);
		insert_record($tablename,$message_data);
		$user_info = get_userdata($user_id);
		$to = $user_info->user_email;           
		$MesArr['{{receiver_name}}']	=	get_display_name($user_id);
		$MesArr['{{message_content}}']	=	$message_body;
		$MesArr['{{school_name}}']		=	$SchoolName;
		$messg = string_replacement($MesArr,$MailBody);
		wp_mail($to, $MailSub, $messg); 
	}
				
}
else
{
	$user_list = array();
	$class_list = $class_id ;
	$query_data['role']=$role;
	$exlude_id = smgt_approve_student_list();
	if($role == 'student')
	{
		$query_data['exclude']=$exlude_id;
		if($class_section)
		{
			$query_data['meta_key'] = 'class_section';
			$query_data['meta_value'] = $class_section;
			$query_data['meta_query'] = array(array('key' => 'class_name','value' => $class_list,'compare' => '=')
			);
		}
		elseif($class_list != '')
		{
			$query_data['meta_key'] = 'class_name';
			$query_data['meta_value'] = $class_list;
		}
			$results = get_users($query_data);
	}
	if($role == 'teacher')
	{
		if($class_list != '')
		{
			global $wpdb;
			$table_smgt_teacher_class = $wpdb->prefix. 'smgt_teacher_class';	
			$teacher_list = $wpdb->get_results("SELECT * FROM $table_smgt_teacher_class where class_id = $class_list");
			if($teacher_list)
			{
				foreach($teacher_list as $teacher)
				{
					$user_list[] = $teacher->teacher_id;
				}
			}
		}
		else
			$results = get_users($query_data);
	}
		if($role == 'supportstaff'){
			
			$results = get_users($query_data);
		}
		if($role == 'parent'){
			
			if($class_list == '')
				$results = get_users($query_data);
			else{
				$query_data['role'] = 'student';
				$query_data['exclude']=$exlude_id;
			if($class_section){
				$query_data['meta_key'] = 'class_section';
				$query_data['meta_value'] = $class_section;
				$query_data['meta_query'] = array(array('key' => 'class_name','value' => $class_list,'compare' => '=')
							 );
			}
			elseif($class_list != '')
			{
				$query_data['meta_key'] = 'class_name';
				$query_data['meta_value'] = $class_list;
			}
			
				
				
			$userdata=get_users($query_data);
				foreach($userdata as $users)
				{
					$parent = get_user_meta($users->ID, 'parent_id', true);
					//var_dump($parent);
					if(!empty($parent))
					foreach($parent as $p)
					{
						$user_list[]=$p;
					}
				}
				//$userdata =  $user_list;
			}
		}
		if(isset($results))
		{
			foreach($results as $user_datavalue)
				$user_list[] = $user_datavalue->ID;
		}
		$user_data_list = array_unique($user_list);
		if(!empty($user_data_list))
		{
			
			$post_id = wp_insert_post( array(
							'post_status' => 'publish',
							'post_type' => 'message',
							'post_title' => $subject,
							'post_content' =>$message_body
						) );
				$result=add_post_meta($post_id, 'message_for',$role);
				$result=add_post_meta($post_id, 'smgt_class_id',$_REQUEST['class_id']);
			foreach($user_data_list as $user_id)
			{
				$user_info = get_userdata($user_id);				 	
				$reciever_number = "+".smgt_get_countery_phonecode(get_option( 'smgt_contry' )).get_user_meta($user_id, 'mobile_number',true);
				$message_content = $_POST['sms_template'];						
				$current_sms_service = get_option( 'smgt_sms_service');
				if($smgt_sms_service_enable)
				{
					if($current_sms_service == 'clickatell')
				 	{			 								 				
						$clickatell=get_option('smgt_clickatell_sms_service');
						$to = $reciever_number;
						$message = str_replace(" ","%20",$message_content);
						$username = $clickatell['username']; //clickatell username
						$password = $clickatell['password']; // clickatell password
						$api_key = $clickatell['api_key'];//clickatell apikey
						$sender_id = $clickatell['sender_id'];//clickatell sender_id
						$baseurl ="http://api.clickatell.com";
				 					
				 		$ret = file($url);
				 		$sess = explode(":",$ret[0]);
				 		if ($sess[0] == "OK")
						{				 						
							$sess_id = trim($sess[1]); // remove any whitespace
							$url = "$baseurl/http/sendmsg?session_id=$sess_id&to=$to&text=$message&from=$sender_id";				 						
							$ret = file($url);
							$send = explode(":",$ret[0]);				 					
				 		}					 				
				 	}
				 	if($current_sms_service == 'twillo')
				 	{
						//Twilio lib
						require_once SMS_PLUGIN_DIR. '/lib/twilio/Services/Twilio.php';
						$twilio=get_option( 'smgt_twillo_sms_service');
						$account_sid = $twilio['account_sid']; //Twilio SID
						$auth_token = $twilio['auth_token']; // Twilio token
						$from_number = $twilio['from_number'];//My number
						$receiver = $reciever_number; //Receiver Number
						$message = $message_content; // Message Text
						//twilio object
						$client = new Services_Twilio($account_sid, $auth_token);
						$message_sent = $client->account->messages->sendMessage(
							$from_number, // From a valid Twilio number
							$receiver, // Text this number
							$message
						);
				 				
				 	}
				}
				$message_data=array(
					'sender'=>get_current_user_id(),
					'receiver'=>$user_id,
					'subject'=>$subject,
					'message_body'=>$message_body,
					'date'=>$created_date,
					'post_id'=>$post_id,
					'status' =>0
				);
				insert_record($tablename,$message_data);
				$user_info = get_userdata($user_id);
				$to = $user_info->user_email;           
				$MesArr['{{receiver_name}}']	= 	get_display_name($user_id);	
				$MesArr['{{message_content}}']	=	$message_body;
				$MesArr['{{school_name}}']		=	$SchoolName;
				$messa = string_replacement($MesArr,$MailBody);
				wp_mail($to, $MailSub, $messa); 
			}
		}
		
	}	
}
if(isset($result)){
	 
	 
	wp_redirect ( home_url() . '?dashboard=user&page=message&tab=compose&message=1');	
	}
if(isset($_REQUEST['message']))
{
	$message =$_REQUEST['message'];
	if($message == 1)
	{ ?>
		<div id="message" class="updated below-h2 "><p>
			<?php _e('Message sent successfully','school-mgt');	?></p></div>
	<?php 			
	}
	elseif($message == 2){ ?>
		<div id="message" class="updated below-h2 ">
			<p><?php _e("Message deleted successfully",'school-mgt');?></p>
		</div>
	<?php 			
	}
}
?>
<script type="text/javascript">
$(document).ready(function() {
	 $('#message_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});
} );
$(document).ready(function() {	
 $('#selected_users').multiselect({ 
	 nonSelectedText :'Select Users',
	 includeSelectAllOption: true           
 });
});

</script>
	<div class="mailbox-content overflow-hidden">
		<h2>
        <?php
			$edit=0;
			if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit')
			{
				echo esc_html( __( 'Edit Message', 'school-mgt') );
				$edit=1;
				$exam_data= get_exam_by_id($_REQUEST['exam_id']);
			}
		?>
        </h2>
        <?php
			/* if(isset($message))
				echo '<div id="message" class="updated below-h2"><p>'.$message.'</p></div>'; */
		?>
		
         <form name="class_form" action="" method="post" class="form-horizontal" id="message_form">
          <?php $action = isset($_REQUEST['action'])?$_REQUEST['action']:'insert';?>
		<input type="hidden" name="action" value="<?php echo $action;?>">
		
        <div class="form-group">
            <label class="col-sm-2 control-label" for="to"><?php _e('Message To','school-mgt');?><span class="require-field">*</span></label>
               <div class="col-sm-8">
                 <select name="receiver" class="form-control validate[required] text-input" id="send_to">	
					<?php if($school_obj->role != 'parent' )
					{ ?>
					<option value="student"><?php _e('Student','school-mgt');?></option>	
					<?php } ?>
					<option value="teacher"><?php _e('Teachers','school-mgt');?></option>	
					<?php if($school_obj->role != 'student' &&  $school_obj->role != 'parent' ) /* Student should not send SMS to parents */
					{ ?>
						<option value="parent"><?php _e('Parents','school-mgt');?></option>	
					<?php } ?>
					<option value="supportstaff"><?php _e('Support Staff','school-mgt');?></option>	
					<?php //echo smgt_get_all_user_in_message();?>
				</select>
               </div>	
        </div>
          <div id="smgt_select_class">
		<div class="form-group class_list_id">
			<label class="col-sm-2 control-label" for="sms_template"><?php _e('Select Class','school-mgt');?></label>
			<div class="col-sm-8">
				<?php
					$result = array();
					$role = get_user_role(get_current_user_id());
					if($role=="parent")
					{
						$parentdata = get_user_meta(get_current_user_id(),'child',true);						
						foreach($parentdata as $student_key=>$student_id)
						{
							$class_id[] = get_user_meta($student_id,'class_name',true);
							$class_id_arr = array_unique($class_id);															
						}				
					}					
					
					if($role=="student")
					{
						$student_class_id = get_user_meta(get_current_user_id(),'class_name',true);	
						$student_class_name = get_class_by_id($student_class_id);
					}
					
					if($role=="teacher"){
						$classdatas = array_filter(get_all_teacher_data(get_current_user_id()));	
						
						foreach($classdatas as $class_key=>$class_val)
						{						
							$result[]= get_class_by_id($class_val->class_id);
						
						}						
					}			
				?>
				 <select name="class_id"  id="class_list_id" class="form-control">					
						<option value="">All</option>
					           	
                    <?php
					if($role=="teacher"){
						foreach($result as $key=>$value){ ?> 
						<option value="<?php print $value->class_id; ?>"><?php print $value->class_name ?></option>
					<?php } ?>
						
					<?php } elseif($role=="student"){
						print '<option value="'.$student_class_id.'"> '.$student_class_name->class_name.' </option>';
					}
					elseif($role="parent")
					{						
						foreach($class_id_arr as $key=>$class_id_val)
						{
							print '<option value="'.$class_id_val.'">'.get_class_name_by_id($class_id_val).'</option>';
						}									
					}					
					else
					{
						
					foreach(get_allclass() as $classdata) {   ?>
					   <option  value="<?php echo $classdata['class_id'];?>" ><?php echo $classdata['class_name'];?></option>
					 <?php } }?>
                </select>
			</div>
		</div>
		</div>
		
			<div class="form-group class_section_id">
			<label class="col-sm-2 control-label" for="class_name"><?php _e('Class Section','school-mgt');?></label>
			<div class="col-sm-8">
				<?php if(isset($_POST['class_section'])){$sectionval=$_POST['class_section'];}else{$sectionval='';}?>
                        <select name="class_section" class="form-control" id="class_section_id">
                        	<option value=""><?php _e('Select Class Section','school-mgt');?></option>
                            <?php
							if($edit){
								foreach(smgt_get_class_sections($user_info->class_name) as $sectiondata)
								{  ?>
								 <option value="<?php echo $sectiondata->id;?>" <?php selected($sectionval,$sectiondata->id);  ?>><?php echo $sectiondata->section_name;?></option>
							<?php } 
							} ?>
                        </select>
			</div>
		</div>
		
		<div class="form-group">
		<div id="messahe_test"></div>
			<label class="col-sm-2 control-label"><?php _e('Select Users','school-mgt');?></label>
			<div class="col-sm-8">
			<span class="user_display_block">
			<?php
				
				
			?>
			
			<?php  $teacher_access = get_option('smgt_students_access');?>
			<select name="selected_users[]" id="selected_users" class="form-control" multiple="multiple">					
					<?php				
					if($role=="teacher"){
						$student_list = get_teacher_class_student(get_current_user_id());
					}elseif($role=="student"){
						$std_list = get_student_by_class_id($student_class_id);						
						foreach($std_list as $std_list_ley=>$std_list_val){
							echo '<option value="'.$std_list_val->ID.'">'.$std_list_val->display_name.'</option>';
						}
						
					}else{					
						$student_list = get_all_student_list();
					}					
					foreach($student_list  as $retrive_data){
					echo '<option value="'.$retrive_data->ID.'">'.$retrive_data->display_name.'</option>';
					}
					?>
				</select>
				</span>
			</div>
		</div>
		<div id="class_student_list"></div>
         <div class="form-group">
            <label class="col-sm-2 control-label" for="subject"><?php _e('Subject','school-mgt');?><span class="require-field">*</span></label>
                <div class="col-sm-8">
                     <input id="subject" class="form-control validate[required,custom[popup_category_validation]] text-input" maxlength="50" type="text" name="subject" >
                </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label" for="subject"><?php _e('Message Comment','school-mgt');?><span class="require-field">*</span></label>
                <div class="col-sm-8">
                    <textarea name="message_body" id="message_body" maxlength="150" class="form-control validate[required,custom[address_description_validation]] text-input"></textarea>
                </div>
        </div>
										
		<div class="form-group">
			<label class="col-sm-2 control-label " for="enable"><?php _e('Send SMS','school-mgt');?></label>
			<div class="col-sm-8">
				 <div class="checkbox">
				 	<label>
  						<input id="chk_sms_sent" type="checkbox"  value="1" name="smgt_sms_service_enable">
  					</label>
  				</div>
			</div>
		</div>
		<div id="hmsg_message_sent" class="hmsg_message_none">
		<div class="form-group">
			<label class="col-sm-2 control-label" for="sms_template"><?php _e('SMS Text','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<textarea name="sms_template" class="form-control validate[required]" maxlength="160"></textarea>
				<label><?php _e('Max. 160 Character','school-mgt');?></label>
			</div>
		</div>
		</div>			
           <div class="form-group">
                <div class="col-sm-10">
                    <div class="pull-right">
                         <input type="submit" value="<?php if($edit){ _e('Save Message','school-mgt'); }else{ _e('Send Message','school-mgt');}?>" name="save_message" class="btn btn-success"/>
                    </div>
                </div>
            </div>        
        </form>        
        </div>
<?php

?>