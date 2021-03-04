<?php
add_filter( 'login_redirect', 'smgt_login_redirect',10, 3 );

function smgt_login_redirect($redirect_to, $request, $user )
{
	if (isset($user->roles) && is_array($user->roles)) 
	{
		$roles = ['student','teacher','parent','supportstaff'];
		foreach($roles as $role)
		{
			if (in_array($role, $user->roles))
			{ 
				$redirect_to =  home_url('?dashboard=user');
				break;
			}
		}
	}
	return $redirect_to;
}

function student_notice_board($class_name,$class_section)
{
  return $notice_list_student = get_posts(array(
			'post_type' => 'notice',
			'posts_per_page' =>3,
			'meta_query' =>  array(
			'relation' => 'OR',
			array(
			'key' => 'notice_for',
			'value' => 'all',
			'compare' => '='
			),
			array(
			'relation' => 'AND',
			array(
			'key' => 'smgt_class_id',
			'value' => $class_name,
			'compare' => '=',
			),
			array(
			'key' => 'smgt_section_id',
			'value' => $class_section,
			'compare' => '=',	
			)	

			), 
			array(
			'relation' => 'AND',
			array(
			'key' => 'notice_for',
			'value' => 'student',
			'compare' => '=',
			),
			array(
			'key' => 'smgt_class_id',
			'value' => $class_name,
			'compare' => '=',	
			)	
			),
			array(
			'relation' => 'AND',
			array(
			'key' => 'notice_for',
			'value' => 'student',
			'compare' => '=',
			),
			array(
			'key' => 'smgt_class_id',
			'value' => 'all',
			'compare' => '=',
			),
			)
			)
			));
}
function student_notice_dashbord($class_name,$class_section)
{
  return $notice_list_student = get_posts(array(
			'post_type' => 'notice',
			'meta_query' =>  array(
			'relation' => 'OR',
			array(
			'key' => 'notice_for',
			'value' => 'all',
			'compare' => '='
			),
			array(
			'relation' => 'AND',
			array(
			'key' => 'smgt_class_id',
			'value' => $class_name,
			'compare' => '=',
			),
			array(
			'key' => 'smgt_section_id',
			'value' => $class_section,
			'compare' => '=',	
			)	

			), 
			array(
			'relation' => 'AND',
			array(
			'key' => 'notice_for',
			'value' => 'student',
			'compare' => '=',
			),
			array(
			'key' => 'smgt_class_id',
			'value' => $class_name,
			'compare' => '=',	
			)	
			),
			array(
			'relation' => 'AND',
			array(
			'key' => 'notice_for',
			'value' => 'student',
			'compare' => '=',
			),
			array(
			'key' => 'smgt_class_id',
			'value' => 'all',
			'compare' => '=',
			),
			)
			)
			));
}
function teacher_notice_board($class_name)
{
  return $notice_list_teacher = get_posts(array(
			'post_type' => 'notice',
			'posts_per_page' =>3,
			'meta_query' =>  array(
			'relation' => 'OR',
			array(
			'key' => 'notice_for',
			'value' => 'all',
			'compare' => '='
			),
			array(
			'relation' => 'AND',
			array(
			'key' => 'smgt_class_id',
			'value' => $class_name,
			'compare' => '=',
			)
			), 
			array(
			'relation' => 'AND',
			array(
			'key' => 'notice_for',
			'value' => 'teacher',
			'compare' => '=',
			),
			array(
			'key' => 'smgt_class_id',
			'value' => $class_name,
			'compare' => '=',	
			)	
			),
			array(
			'relation' => 'AND',
			array(
			'key' => 'notice_for',
			'value' => 'teacher',
			'compare' => '=',
			)
			)
			)
			));
}
function teacher_notice_dashbord($class_name)
{
  return $notice_list_teacher = get_posts(array(
			'post_type' => 'notice',
			'meta_query' =>  array(
			'relation' => 'OR',
			array(
			'key' => 'notice_for',
			'value' => 'all',
			'compare' => '='
			),
			array(
			'relation' => 'AND',
			array(
			'key' => 'smgt_class_id',
			'value' => $class_name,
			'compare' => '=',
			)
			), 
			array(
			'relation' => 'AND',
			array(
			'key' => 'notice_for',
			'value' => 'teacher',
			'compare' => '=',
			),
			array(
			'key' => 'smgt_class_id',
			'value' => $class_name,
			'compare' => '=',	
			)	
			),
			array(
			'relation' => 'AND',
			array(
			'key' => 'notice_for',
			'value' => 'teacher',
			'compare' => '=',
			)
			)
			)
			));
}
function parent_notice_board()
{
  return $notice_list_parent = get_posts(array(
			'post_type' => 'notice',
			'posts_per_page' =>3,
			'meta_query' =>  array(
			'relation' => 'AND',
			array(
			'relation' => 'OR',
			array(
			'key' => 'notice_for',
			'value' => 'all',
			'compare' => '='
			),
			
			array(
			'key' => 'notice_for',
			'value' => 'parent',
			'compare' => '=',
			)
			),
			
			)));
}
function parent_notice_dashbord()
{
  return $notice_list_parent = get_posts(array(
			'post_type' => 'notice',
			'meta_query' =>  array(
			'relation' => 'AND',
			array(
			'relation' => 'OR',
			array(
			'key' => 'notice_for',
			'value' => 'all',
			'compare' => '='
			),
			array(
			'key' => 'notice_for',
			'value' => 'parent',
			'compare' => '=',
			)
			),
			
			)));
}
function supportstaff_notice_board()
{
  return $notice_list_supportstaff = get_posts(array(
			'post_type' => 'notice',
			'posts_per_page' =>3,
			'meta_query' =>  array(
			'relation' => 'AND',
			array(
			'relation' => 'OR',
			array(
			'key' => 'notice_for',
			'value' => 'all',
			'compare' => '='
			),
			
			array(
			'key' => 'notice_for',
			'value' => 'supportstaff',
			'compare' => '=',
			)
			),
			
			)));
}
function supportstaff_notice_dashbord()
{
  return $notice_list_supportstaff = get_posts(array(
			'post_type' => 'notice',
			'meta_query' =>  array(
			'relation' => 'AND',
			array(
			'relation' => 'OR',
			array(
			'key' => 'notice_for',
			'value' => 'all',
			'compare' => '='
			),
			array(
			'key' => 'notice_for',
			'value' => 'supportstaff',
			'compare' => '=',
			)
			),
			
			)));
}
function page_access_rolewise_and_accessright()
{
$menu = get_option( 'smgt_access_right');
global $current_user;
$user_roles 	= 	$current_user->roles;
$user_role 		= 	array_shift($user_roles);
	foreach ( $menu as $key=>$value ) 
	{
		 if($value['page_link']==$_REQUEST['page'])
		 {
			if($value[$user_role]==0)
			{
				//wp_redirect ( admin_url () . 'index.php' );
				$flage=0;
			}
			else
			{
			   $flage=1;
			}
		}
	}
	return $flage;
}
function cmgt_check_ourserver()
{
	//$api_server = 'http://license.dasinfomedia.com';
	$api_server = 'license.dasinfomedia.com';
	//$api_server = '192.168.1.22';
	$fp = @fsockopen($api_server,80, $errno, $errstr, 2);
	$location_url = admin_url().'admin.php?page=smgt_school';
	if (!$fp)
        return false; /*server down*/
   else
        return true; /*Server up*/
}
function cmgt_check_productkey($domain_name,$licence_key,$email)
{	
	//$api_server = 'http://license.dasinfomedia.com';
	$api_server = 'license.dasinfomedia.com';
	//$api_server = '192.168.1.22';
	$fp = @fsockopen($api_server,80, $errno, $errstr, 2);
	$location_url = admin_url().'admin.php?page=smgt_school';
	if (!$fp)
              $server_rerror = 'Down';
        else
              $server_rerror = "up";
	if($server_rerror == "up")
	{
	// $url = 'http://192.168.1.22/php/test/index.php';
	$url = 'http://license.dasinfomedia.com/index.php';
	$fields = 'result=2&domain='.$domain_name.'&licence_key='.$licence_key.'&email='.$email.'&item_name=school';
	//open connection
	$ch = curl_init();

	//set the url, number of POST vars, POST data
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch,CURLOPT_POST,1);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_POSTFIELDS, $fields);

	//execute post
	$result = curl_exec($ch);
	
	curl_close($ch);
	return $result;
	}
	else{
		return '3';
	}
		
}
/* Setup form submit*/
function cmgt_submit_setupform($data)
{
	$domain_name= $data['domain_name'];
	$licence_key = $data['licence_key'];
	$email = $data['enter_email'];
	
	
	$result = cmgt_check_productkey($domain_name,$licence_key,$email);
	if($result == '1')
	{
		$message = 'Please provide correct Envato purchase key.';
			$_SESSION['cmgt_verify'] = '1';
	}
	elseif($result == '2')
	{
		$message = 'This purchase key is already registered with the different domain. If have any issue please contact us at sales@dasinfomedia.com';
			$_SESSION['cmgt_verify'] = '2';
	}
	elseif($result == '3')
	{
		$message = 'There seems to be some problem please try after sometime or contact us on sales@dasinfomedia.com';
			$_SESSION['cmgt_verify'] = '3';
	}
	elseif($result == '4')
	{
		$message = 'Please provide correct Envato purchase key for this plugin.';
			$_SESSION['cmgt_verify'] = '1';
	}
	else
	{
		update_option('domain_name',$domain_name,true);
		update_option('licence_key',$licence_key,true);
		update_option('cmgt_setup_email',$email,true);
		$message = 'Success fully register';
			$_SESSION['cmgt_verify'] = '0';
	}	
	$result_array = array('message'=>$message,'cmgt_verify'=>$_SESSION['cmgt_verify']);
	return $result_array;
}
/* check server live */
function cmgt_chekserver($server_name)
{
	if($server_name == 'localhost')
	{
		return true;
	}		
}
/*Check is_verify*/
function cmgt_check_verify_or_not($result)
{		
	$server_name = $_SERVER['SERVER_NAME'];
	$current_page = isset($_REQUEST['page'])?$_REQUEST['page']:'';
	$pos = strrpos($current_page, "smgt_");	
	if($pos !== false)			
	{ 	 
		if($server_name == 'localhost')
		{
			return true;
		}
		else
		{ 
			if($result == '0')
			{
				return true;
			}
		}	
		return false;
	}
	
}
function cmgt_is_cmgtpage()
{
	$current_page = isset($_REQUEST['page'])?$_REQUEST['page']:'';
	$pos = strrpos($current_page, "smgt_");	
	
	if($pos !== false)			
	{
		return true;
	}
	return false;
}


//Function File
//-----------INSERT NEW RECORD IN CUSOTOM TABLE------------
$obj_attend=new Attendence_Manage();
function smgt_datatable_multi_language()
{
	$datatable_attr=array("sEmptyTable"=> __("No data available in table","school-mgt"),
		"sInfo"=>__("Showing _START_ to _END_ of _TOTAL_ entries","school-mgt"),
		"sInfoEmpty"=>__("Showing 0 to 0 of 0 entries","school-mgt"),
		"sInfoFiltered"=>__("(filtered from _MAX_ total entries)","school-mgt"),
		"sInfoPostFix"=> "",
		"sInfoThousands"=>",",
		"sLengthMenu"=>__("Show _MENU_ entries","school-mgt"),
		"sLoadingRecords"=>__("Loading...","school-mgt"),
		"sProcessing"=>__("Processing...","school-mgt"),
		"sSearch"=>__("Search:","school-mgt"),
		"sZeroRecords"=>__("No matching records found","school-mgt"),
		"oPaginate"=>array(
			"sFirst"=>__("First","school-mgt"),
			"sLast"=>__("Last","school-mgt"),
			"sNext"=>__("Next","school-mgt"),
			"sPrevious"=>__("Previous","school-mgt")
		),
		"oAria"=>array(
			"sSortAscending"=>__(": activate to sort column ascending","school-mgt"),
			"sSortDescending"=>__(": activate to sort column descending","school-mgt")
		)
	);
	
	return $data=json_encode( $datatable_attr);
}
function change_menutitle($key)
{
	$menu_titlearray=array('teacher'=>__('Teacher','school-mgt'),'student'=>__('Student','school-mgt'),'child'=>__('Child','school-mgt'),'parent'=>__('Parent','school-mgt'),'subject'=>__('Subject','school-mgt'),'schedule'=>__('Class Routine','school-mgt'),'attendance'=>__('Attendance','school-mgt'),'exam'=>__('Exam','school-mgt'),'manage_marks'=>__('Manage Marks','school-mgt'),'feepayment'=>__('Fee Payment','school-mgt'),'payment'=>__('Payment','school-mgt'),'transport'=>__('Transport','school-mgt'),'notice'=>__('Notice Board','school-mgt'),'message'=>__('Message','school-mgt'),'holiday'=>__('Holiday','school-mgt'),'library'=>__('Library','school-mgt'),'account'=>__('Account','school-mgt'),'report'=>__('Report','school-mgt'),'homework'=>__('Homework','school-mgt'));
	
	return $menu_titlearray[$key];
}
function smgt_approve_student_list()
{
	 $studentdata = get_users(array('meta_key' => 'hash','role'=>'student'));	
	 $inactive_student_id = wp_list_pluck( $studentdata, 'ID' );
	 return  $inactive_student_id;	 
}

function get_remote_file($url, $timeout = 30)
{
	$ch = curl_init();
	curl_setopt ($ch, CURLOPT_URL, $url);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$file_contents = curl_exec($ch);
	curl_close($ch);
	return ($file_contents) ? $file_contents : FALSE;
}
/*function subject_exists($tid,$class_id)
{
		
		global $wpdb;
		$table_name = $wpdb->prefix . "subject";
        
        $subjects = $wpdb->get_var('SELECT subid FROM $table_name WHERE teacher_id = $tid and class_id=$class_id' );
		if ( !empty($subjects) )
			return true;
		else
			return false;
		
}*/
function smgt_change_read_status($id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "smgt_message";
	$data['status']=1;
	$whereid['message_id']=$id;
	return $retrieve_subject = $wpdb->update($table_name,$data,$whereid);
}
function get_subject_class($subject_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "subject";
	$result = $wpdb->get_row("SELECT class_id FROM $table_name where subid=$subject_id");
	return $result->class_id;
}
function get_teachers_subjects($tid)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "subject";
	$result = $wpdb->get_results("SELECT * FROM $table_name where teacher_id=$tid");
	return $result;
}
function get_all_student_list()
{
	$exlude_id = smgt_approve_student_list();
	$student = get_users(array('role'=>'student','exclude'=>$exlude_id));
	return $student;
}


function get_teacher_class_student($id)
{	
	$meta_val = get_user_meta($id,'class_name',true);	
	$meta_query_result =  get_users(	
		array(
			'meta_key' => 'class_name',
			'meta_value' =>$meta_val,	   
		)
	);
}

function check_class_exits_in_teacher_class($id)
{	
	$TeacherData = get_users(array('role'=>'teacher'));
	$Teacher = array(); 
	foreach($TeacherData as $teacher)
	{
		$TeacherClass =  get_user_meta($teacher->ID,'class_name',true);
		if(in_array($id,$TeacherClass))
		{
			$Teacher[] = $teacher->ID;			
		}
	}
	return $Teacher;
} 

function get_all_student_list_class()
{
	$exlude_id = smgt_approve_student_list();
	$student = get_users(array('role'=>'student','exclude'=>$exlude_id));
	return $student;
}

function smgt_get_all_user_in_message()
{
	$school_obj = new School_Management ( get_current_user_id () );
	$teacher = get_users(array('role'=>'teacher'));
	$parent = get_users(array('role'=>'parent'));
	$exlude_id = smgt_approve_student_list();
	$student = get_users(array('role'=>'student','exclude'=>$exlude_id));
	
	$supportstaff = get_users(array('role'=>'supportstaff'));
	
	$parents_child_list=get_user_meta(get_current_user_id(), 'child', true);
	//var_dump($user_meta);
	

	$all_user = array(
		'student'=>$student,
		'teacher'=>$teacher,
		'parent'=>$parent,
		'supportstaff'=>$supportstaff		
	);
	
	if($school_obj->role == 'administrator' || $school_obj->role == 'teacher')
	{
		$all_user = array(
			'student'=>$student,
			'teacher'=>$teacher,
			'parent'=>$parent,
			'supportstaff'=>$supportstaff
		);
	}
	if($school_obj->role == 'parent')
		if(get_option('parent_send_message'))
		{
			if(!empty($parents_child_list))
			{
				$class_array = array();
				foreach ($parents_child_list as $user)
				{
					$class_id=get_user_meta($user, 'class_name',true);
					$class_array[]= $class_id;
				}
				//print_r($class_array);
				//echo "<BR> Unique";
				$unique = array_unique($class_array);
				//print_r($unique);
				$student = array();
				if(!empty($unique))
					foreach($unique as $class_id)
						$student[]=get_users(array('role'=>'student','meta_key' => 'class_name', 'meta_value' => $class_id));
			
			
			}
			
			$all_user = array(
				'student'=>$student,
				'teacher'=>$teacher,
				'parent'=>$parent,
				'supportstaff'=>$supportstaff
			);			
		}
		else 
		{
			$all_user = array(
				'teacher'=>$teacher,
				'parent'=>$parent,
				'supportstaff'=>$supportstaff
			);
		}
		
	if(get_option('student_send_message'))
	if($school_obj->role == 'student')
	{
		$school_obj->class_info = $school_obj->get_user_class_id(get_current_user_id());
		$student = $school_obj->get_student_list($school_obj->class_info->class_id);
		$all_user = array('student'=>$student);
	}
	$return_array = array();
	//echo count($all_user['doctor']);
	//exit;
	foreach($all_user as $key => $value)
	{
		if(!empty($value))
		{
		 echo '<optgroup label="'.$key.'" style = "text-transform: capitalize;">';
		 foreach($value as $user)
		 {
		 	if(get_option('parent_send_message'))
			 	if($key == 'student' && $school_obj->role == 'parent')
			 	{
			 		foreach($user as $student_class)
			 		{
			 			//echo $student_class->ID;
			 			echo '<option value="'.$student_class->ID.'">'.$student_class->display_name.'</option>';
			 		}
			 	}
			 	else 
			 	echo '<option value="'.$user->ID.'">'.$user->display_name.'</option>';
			 else 
			 	echo '<option value="'.$user->ID.'">'.$user->display_name.'</option>';
		 }
		}
	}
}
function smgt_send_replay_message($data)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "smgt_message_replies";
	$messagedata['message_id'] = $data['message_id'];
	$messagedata['sender_id'] = $data['user_id'];
	$messagedata['receiver_id'] = $data['receiver_id'];
	$messagedata['message_comment'] = $data['replay_message_body'];
	$messagedata['created_date'] = date("Y-m-d h:i:s");
	$result=$wpdb->insert( $table_name, $messagedata );
	if($result)	
		return $result;
}
function smgt_get_all_replies($id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "smgt_message_replies";
	return $result =$wpdb->get_results("SELECT *  FROM $table_name where message_id = $id");
}
function smgt_delete_reply($id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "smgt_message_replies";
	$reply_id['id']=$id;
	return $result=$wpdb->delete( $table_name, $reply_id);
}
function smgt_count_reply_item($id)
{
	global $wpdb;
	$tbl_name = $wpdb->prefix .'smgt_message_replies';	
	$result=$wpdb->get_var("SELECT count(*)  FROM $tbl_name where message_id = $id");
	return $result;
}
function smgt_get_countery_phonecode($country_name)
{
	$url = plugins_url( 'countrylist.xml', __FILE__ );
	//$xml=simplexml_load_file(plugins_url( 'countrylist.xml', __FILE__ )) or die("Error: Cannot create object");
	$xml =simplexml_load_string(get_remote_file($url));
	foreach($xml as $country)
	{
		if($country_name == $country->name)
			return $country->phoneCode;
		
	}							
}

function smgt_get_roles($user_id){
	$roles = array();
	$user = new WP_User( $user_id );

	if ( !empty( $user->roles ) && is_array( $user->roles ) )
	{
		foreach ( $user->roles as $role )
			 return $role;
	}

	
}

function smgt_get_student_parent_id($student_id)
{
	$parent = get_user_meta($student_id, 'parent_id');
	$parent_idarray = array();
	if(!empty($parent))
	{
	foreach ($parent[0] as $parent_id)
		$parent_idarray[]=$parent_id;
	}
	return  $parent_idarray;
}
function get_bookname($id)
{
	global $wpdb;
		$table_book=$wpdb->prefix.'smgt_library_book';
		$result = $wpdb->get_row("SELECT * FROM $table_book where id=".$id);
		return $result->book_name;
}
function smgt_get_parents_child_id($parent_id)
{
	$parent = get_user_meta($parent_id, 'child');
	$parent_idarray = array();
	if(!empty($parent))
	{
		foreach ($parent[0] as $parent_id)
			$parent_idarray[]=$parent_id;
	}
	return  $parent_idarray;
}
function smgt_get_user_notice($role,$class_id,$section_id=0)
{
	if($role == 'all' )
	{
		$userdata = array();
		$roles = array('teacher', 'student', 'parent','supportstaff');
		
		foreach ($roles as $role) :
		$users_query = new WP_User_Query( array(
				'fields' => 'all_with_meta',
				'role' => $role,
				'orderby' => 'display_name'
		));
		$results = $users_query->get_results();
		if ($results) $userdata = array_merge($userdata, $results);
		endforeach;
	}
	elseif($role == 'parent' )
	{
		$new =array();
		if($class_id == 'all')
		{
			$userdata=get_users(array('role'=>$role));
			
		}
		else
		{
			$userdata=get_users(array('role'=>'student','meta_key' => 'class_name', 'meta_value' => $class_id));
			foreach($userdata as $users)
			{
				$parent = get_user_meta($users->ID, 'parent_id', true);
				//var_dump($parent);
				if(!empty($parent))
				foreach($parent as $p)
				{
					$new[]=array('ID'=>$p);
				}
			}
			$userdata =  $new;
		}
		
	}
	elseif($role == 'administrator' )
	{
		$userdata=get_users(array('role'=>$role));
	}
	else 
	{
		if($class_id == 'all'){
			$userdata=get_users(array('role'=>$role));
		}
		elseif($section_id!=0){
		$userdata = get_users(array('meta_key' => 'class_section', 'meta_value' =>$section_id,
				'meta_query'=> array(array('key' => 'class_name','value' => $class_id,'compare' => '=')),'role'=>'student'));	
		}
		else{
			$userdata=get_users(array('role'=>$role,'meta_key' => 'class_name', 'meta_value' => $class_id));
		}
	}
		
	return $userdata;
}
function get_feepayment_all_record()
{
	global $wpdb;
	$smgt_fees_payment = $wpdb->prefix .'smgt_fees_payment';
	$result = $wpdb->get_results("SELECT * FROM $smgt_fees_payment where start_year != '' AND end_year != '' group by start_year,end_year");
	return $result;
}
function get_payment_report($class_id,$fee_term,$payment_status,$sdate,$edate,$section_id)
{
	
	
	$where = '';
	$array_test = array();
	if($class_id != ' ')
		$array_test[] = 'class_id = '.$class_id; 
	if($section_id !=0)
		$array_test[] = 'section_id = '.$section_id; 
	if($fee_term != ' ')
		$array_test[] = 'fees_id = '.$fee_term; 
	if($payment_status != ' ')
		$array_test[] = 'payment_status = '.$payment_status; 
	/*if($year != '')
	{
		$array_test[] = 'start_year = '.$year_year[0]; 
		$array_test[] = 'end_year = '.$year_year[1]; 
	}*/
	//$sdate=date("Y-m-d h:i:s", strtotime($sdate));
	//$edate=date("Y-m-d h:i:s", strtotime($edate));
	global $wpdb;
	$smgt_fees_payment = $wpdb->prefix .'smgt_fees_payment';
	$sql = "SELECT * FROM $smgt_fees_payment  ";
	$test_string = implode(" AND ",$array_test);
	$date_string=" AND (paid_by_date BETWEEN '$sdate' AND '$edate')";
	$test_string .=$date_string;
	if(!empty($array_test))
	{
		$sql .= " Where "; 
	}
	 $sql .= $test_string;
	//echo $sql;
	
	$result = $wpdb->get_results($sql);
	return $result;
	
}
function insert_record($tablenm,$records)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	return $result=$wpdb->insert( $table_name, $records);
	
}
function add_class_section($tablenm,$sectiondata)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	return $result=$wpdb->insert( $table_name, $sectiondata);
	
}
function smgt_get_class_sections($id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'smgt_class_section';
	return $result = $wpdb->get_results("SELECT * FROM $table_name where class_id=$id");
	
}
function smgt_get_section_name($id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'smgt_class_section';
	$result = $wpdb->get_row("SELECT *FROM $table_name where id=$id");
	return $result->section_name;
}
function delete_class_section($id)
{
	global $wpdb;
	$table_name = $wpdb->prefix. 'smgt_class_section';
	$result = $wpdb->query("DELETE FROM $table_name where id= ".$id);
	return $result;
}
//-----------UPDATE RECORD IN CUSOTOM TABLE------------
function update_record($tablenm,$data,$record_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	$result=$wpdb->update($table_name, $data,$record_id);
	return $result;
	
}
//-----------DELETE RECORD IN CUSOTOM TABLE------------
function delete_subject($tablenm,$record_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	return $result=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE subid= %d",$record_id));
	
}
function delete_class($tablenm,$record_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	return $result=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE class_id= %d",$record_id));
}
function delete_grade($tablenm,$record_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	return $result=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE grade_id= %d",$record_id));
}
function delete_exam($tablenm,$record_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	return $result=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE exam_id= %d",$record_id));
}
function delete_usedata($record_id)
{
	global $wpdb;
	
	$table_name = $wpdb->prefix . 'usermeta';
	$result=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE user_id= %d",$record_id));
	$retuenval=wp_delete_user( $record_id );
	return $retuenval;
}
function delete_message($tablenm,$record_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	return $result=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE message_id= %d",$record_id));

}
function get_class_name($cid)
{
	
	global $wpdb;
	$table_name = $wpdb->prefix .'smgt_class';
	
	$classname =$wpdb->get_row("SELECT class_name FROM $table_name WHERE class_id=".$cid);
	if(!empty($classname))
		return $classname->class_name;
	else
		return " ";
}

function get_fees_term_name($fees_id)
{
	
	global $wpdb;
	$table_smgt_fees = $wpdb->prefix .'smgt_fees';
	
	$classname =$wpdb->get_row("SELECT fees_title_id FROM $table_smgt_fees WHERE fees_id=".$fees_id);
	if(!empty($classname))
		return get_the_title($classname->fees_title_id);
	else
		return " ";
}
function get_payment_status($fees_pay_id)
{
	global $wpdb;
	$table_smgt_fees_payment = $wpdb->prefix .'smgt_fees_payment';
	
	$result =$wpdb->get_row("SELECT * FROM $table_smgt_fees_payment WHERE fees_pay_id=".$fees_pay_id);
	if(!empty($result))
	{	
		if($result->fees_paid_amount == 0)
		{
			return _e('Not Paid','school-mgt');
		}
		elseif($result->fees_paid_amount < $result->total_amount)
		{
			return _e('Partially Paid','school-mgt');
		}
		else
			return _e('Fully Paid','school-mgt');
	}
	else
		return " ";
}
function get_single_fees_payment_record($fees_pay_id)
{
	global $wpdb;
	$table_smgt_fees_payment = $wpdb->prefix .'smgt_fees_payment';
	
	$result =$wpdb->get_row("SELECT * FROM $table_smgt_fees_payment WHERE fees_pay_id=".$fees_pay_id);
	return $result;
}
function get_payment_history_by_feespayid($fees_pay_id)
{
	global $wpdb;
	$table_smgt_fee_payment_history = $wpdb->prefix .'smgt_fee_payment_history';
	
	$result =$wpdb->get_results("SELECT * FROM $table_smgt_fee_payment_history WHERE fees_pay_id=".$fees_pay_id);
	return $result;
}
function get_user_name_byid($user_id)
{
	$user_info = get_userdata($user_id);
	if($user_info)
	return  $user_info->first_name." ".$user_info->last_name;
}
function get_display_name($user_id) {
	if (!$user = get_userdata($user_id))
		return false;
	return $user->data->display_name;
}
function get_emailid_byuser_id($id)
{
	if (!$user = get_userdata($id))
		return false;
	return $user->data->user_email;
}
function get_teacher($id)
{
	
	$user_info = get_userdata($id);
	if($user_info)
	 return  $user_info->first_name." ".$user_info->last_name;
}
function get_payment_list()
{
	global $wpdb;
	$table_users = $wpdb->prefix .'users';
	$table_payment = $wpdb->prefix .'smgt_payment';
	return  $retrieve_paymentlist = $wpdb->get_results( "SELECT * FROM $table_users as u,$table_payment  p  where u.ID=p.student_id");
	
}
function get_all_data($tablenm)
{
	global $wpdb;
	$user_id=get_current_user_id ();
	$school_obj = new School_Management ($user_id);
	$table_name = $wpdb->prefix . $tablenm;
	
	if($tablenm =='subject' && $school_obj->role == 'teacher' && get_option('smgt_subject_access')=='own_class')
	{
		
		$class_name=get_user_meta(get_current_user_id (),'class_name',true);		
		$sql = "SELECT * from $table_name Where class_id IN (".implode(',',$class_name).")"; 
		return $retrieve_subjects = $wpdb->get_results( $sql );		
	}

	elseif($tablenm =='subject' && $school_obj->role == 'teacher' && get_option('smgt_subject_access')=='own_subjects')
	{		
		$tbl = $wpdb->prefix . "teacher_subject";
		$retrieve_subjects = $wpdb->get_results( "SELECT * FROM $tbl where  teacher_id=$user_id");
		$data = array();
		foreach($retrieve_subjects as $subdata)
		{			
			$data[] = get_subject($subdata->subject_id);
		}
		return $data;
	}
	
	else
	{		
		return $retrieve_subjects = $wpdb->get_results( "SELECT * FROM ".$table_name);
	}
	
}	
function smgt_get_teacher_subjects($teacher_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix .'subject';
	return $retrieve_subjects = $wpdb->get_results( "SELECT * FROM $table_name where teacher_id=$teacher_id");
}
function smgt_get_subject_by_classid($class_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "subject";
	$retrieve_subject = $wpdb->get_results( "SELECT * FROM $table_name WHERE class_id=".$class_id);
	return $retrieve_subject;	
}
function get_subject($sid)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "subject";
	return $retrieve_subject = $wpdb->get_row( "SELECT * FROM $table_name WHERE subid=".$sid);	
}
function get_single_subject_name($subject_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "subject";
	return $retrieve_subject = $wpdb->get_var( "SELECT sub_name FROM $table_name WHERE subid=".$subject_id);	
}
function get_subject_name_by_teacher($teacher_id)
{
	global $wpdb;
    $table_name = $wpdb->prefix . "teacher_subject";
    $retrieve_subject = $wpdb->get_results( "SELECT * FROM $table_name WHERE teacher_id=".$teacher_id);    
    $subjec = '';
    if(!empty($retrieve_subject))
    {
        foreach($retrieve_subject as $retrive_data)
        {
            $sub_name = get_single_subject_name($retrive_data->subject_id);
            $subjec .= $sub_name.', ';
        }
    }
    return $subjec;
	
}

function get_subject_id_by_teacher($teacher_id)
{
	global $wpdb;
    $table_name = $wpdb->prefix . "teacher_subject";
    $retrieve_subject = $wpdb->get_results( "SELECT * FROM $table_name WHERE teacher_id=".$teacher_id);    
    $subjects = array();
    if(!empty($retrieve_subject))
    {
        foreach($retrieve_subject as $retrive_data)
        {
            $count = is_subject($retrive_data->subject_id);
			if($count > 0)
			{
				$subjects[] = $retrive_data->subject_id;
			}
        }
    }
    return $subjects;
	
}

function is_subject($subject_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "subject";
	return $retrieve_subject = $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE subid=".$subject_id);	
}

function get_class_by_id($sid)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "smgt_class";
	 $retrieve_subject = $wpdb->get_row( "SELECT * FROM $table_name WHERE class_id=".$sid);
	return $retrieve_subject;
}

function get_class_name_by_id($sid)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "smgt_class";
	 $retrieve_subject = $wpdb->get_row( "SELECT * FROM $table_name WHERE class_id=".$sid);
	return $retrieve_subject->class_name;
}

function get_grade_by_id($gid)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "grade";
	return $retrieve_subject = $wpdb->get_row( "SELECT * FROM $table_name WHERE grade_id = ".$gid);
	
}
function get_exam_by_id($eid)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "exam";
	return $retrieve_subject = $wpdb->get_row( "SELECT * FROM $table_name WHERE exam_id = ".$eid);
	
}
function get_exam_name_id($eid)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "exam";
	return $retrieve_subject = $wpdb->get_var( "SELECT exam_name FROM $table_name WHERE exam_id = ".$eid);

}
function get_transport_by_id($tid)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "transport";
	return $retrieve_subject = $wpdb->get_row( "SELECT * FROM $table_name WHERE transport_id = ".$tid);
	
}
function get_hall_by_id($id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "hall";
	return $retrieve_subject = $wpdb->get_row( "SELECT * FROM $table_name WHERE hall_id = ".$id);
}
function get_holiday_by_id($id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "holiday";
	return $retrieve_subject = $wpdb->get_row( "SELECT * FROM $table_name WHERE holiday_id = ".$id);
}

function get_route_by_id($id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "smgt_time_table";
	return $retrieve_subject = $wpdb->get_row( "SELECT * FROM $table_name WHERE route_id = ".$id);
}
function get_payment_by_id($id)
{
	
	global $wpdb;
	$table_name = $wpdb->prefix . "smgt_payment";
	return $retrieve_subject = $wpdb->get_row( "SELECT * FROM $table_name WHERE payment_id = ".$id);
}
function delete_payment($tablenm,$tid)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	return $result=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE payment_id= %d",$tid));
}
function delete_transport($tablenm,$tid)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	return $result=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE transport_id= %d",$tid));

}
function delete_hall($tablenm,$id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	return $result=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE hall_id= %d",$id));
}
function delete_holiday($tablenm,$id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	return $result=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE holiday_id= %d",$id));
}
function delete_route($tablenm,$id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . $tablenm;
	return $result=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE route_id= %d",$id));
}
function get_teacherid_by_subjectid($id)
{
	global $wpdb;
    $teacher = array();
    
    $table_name = $wpdb->prefix . "teacher_subject";
    $retrieve_subject = $wpdb->get_results( "SELECT teacher_id FROM $table_name WHERE subject_id = ".$id);
    foreach($retrieve_subject as $subject)
    {
        $teacher[] = $subject->teacher_id;
    }
    return $teacher;
}

function smgt_get_user_role($user_id)
{
	$user = new WP_User( $user_id );
	if ( !empty( $user->roles ) && is_array( $user->roles ) ) {
	foreach ( $user->roles as $role )
		return $role;
	}
}
//------------------------------

function smgt_get_teachers_class($teacher_id)
{
	global $wpdb;
		$table = $wpdb->prefix . 'smgt_teacher_class';
		$result = $wpdb->get_results('SELECT * FROM '.$table.' where teacher_id ='.$teacher_id);
		$return_r = array();
		foreach($result as $retrive_data)
		{
			$return_r[] = $retrive_data->class_id;
		}
		if(!empty($return_r))
			$class_idlist = implode(',',$return_r);
		else
			$class_idlist= '0';
		return $class_idlist;
}
function get_allclass($user_id=0){
	
	
	
	global $wpdb;
	$table_name = $wpdb->prefix .'smgt_class';
	if($user_id==0){
		$user_id=get_current_user_id();
	}
	
	if(get_option('smgt_students_access')=='own' && smgt_get_roles($user_id)=='teacher'){
		
		$class_id=get_user_meta($user_id,'class_name',true);
		$class_id=smgt_get_teachers_class($user_id);	
		return $classdata =$wpdb->get_results("SELECT * FROM $table_name where class_id in ($class_id)", ARRAY_A);
		
	}
	else if(smgt_get_roles($user_id)=='teacher')
	{
		$class_id=get_user_meta($user_id,'class_name',true);
		$class_id=smgt_get_teachers_class($user_id);	
		return $classdata =$wpdb->get_results("SELECT * FROM $table_name where class_id in ($class_id)", ARRAY_A);
    }
	else
	{
		return $classdata =$wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
	}

	//print_r($classdata);
}

function smgt_get_role($user_id)
{
	$user_meta=get_userdata($user_id);	
	return $user_roles=$user_meta->roles;
}
function get_attendace_status($AttDate)
{
	global $wpdb;
	$tbl_name = $wpdb->prefix .'holiday';	
	$sql = "SELECT * FROM $tbl_name WHERE '$AttDate' between date and end_date";
	return $result = $wpdb->get_results($sql);
	
}
function cheak_type_status($user_id,$type,$type_id)
{
	global $wpdb;	
	$tbl_smgt_check_status = $wpdb->prefix .'smgt_check_status';	
	
	 $rowcount = $wpdb->get_var("SELECT COUNT(*) FROM $tbl_smgt_check_status WHERE user_id =$user_id AND type ='$type' AND type_id=$type_id");
	
	if($rowcount=="0")
	{
		$status ="Unread";		
	}
	else
	{
		$status = "Read";
	}
	return $status;
}


function get_student_payment_list($std_id)
{
	global $wpdb;	
	$table_payment = $wpdb->prefix .'smgt_payment';
	return $retrieve_paymentlist = $wpdb->get_results( "SELECT * FROM $table_payment WHERE student_id={$std_id}");	
	
}
//get all class   teacher id
function get_all_teacher_data($teacher_id){
	global $wpdb;
	$table_name = $wpdb->prefix .'smgt_teacher_class';	
	return $classdata =$wpdb->get_results("SELECT * FROM $table_name where teacher_id in ($teacher_id)");
	
	/* if(get_option('smgt_students_access')=='own' && smgt_get_roles($user_id)=='teacher'){	
		print "if";
		$class_id=get_user_meta($user_id,'class_name',true);
		$class_id=smgt_get_teachers_class($user_id);					
		return $classdata =$wpdb->get_results("SELECT * FROM $table_name where class_id in ($class_id)", ARRAY_A);
		
	}
	else{
		print "else";
	return $classdata =$wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
	}  */

}
//-----------FOR GET USER DATA ROLE WISE------------------------------------------
function get_usersdata($role){
	global $wpdb;
	
	$capabilities = $wpdb->prefix .'capabilities';
	$this_role = "'[[:<:]]".$role."[[:>:]]'";
	$query = "SELECT * FROM $wpdb->users WHERE ID = ANY (SELECT user_id FROM $wpdb->usermeta WHERE meta_key = '$capabilities' AND meta_value RLIKE $this_role)";
	$users_of_this_role = $wpdb->get_results($query);
	
	if(!empty($users_of_this_role))
		return $users_of_this_role;
	
}

function get_useraa_by_role($role)
{
	return get_users(array('role'=>$role));
}

function get_student_groupby_class()
{
	global $wpdb;
	$student_list = get_usersdata('student');
	$students = array();
	if(!empty($student_list))
	{
	foreach($student_list as $student_obj)
	{		
		$class_id=get_user_meta($student_obj->ID, 'class_name',true);
		if($class_id != '')
		{
			$classname=	get_class_name($class_id);
			$students[$classname][$student_obj->ID]=get_user_name_byid($student_obj->ID)." ( ".get_user_meta($student_obj->ID, 'roll_id',true)." )";
		}
	}
	}
	return $students;

}

//------------------FOR GET USER IMAGE------------------
function get_user_image($uid)
{
	global $wpdb;
	
	$query = "SELECT meta_value FROM $wpdb->usermeta WHERE user_id = $uid AND meta_key='smgt_user_avatar'";
	 $usersdata = $wpdb->get_results($query,ARRAY_A); 
	
	foreach($usersdata as $data)
	{
		return $data;
	}
}
function get_user_driver_image($tid)
{
	global $wpdb;
	$table_name = $wpdb->prefix .'transport';
	$query = "SELECT smgt_user_avatar FROM $table_name WHERE transport_id = $tid";
	$usersdata = $wpdb->get_results($query,ARRAY_A); 
	foreach($usersdata as $data)
	{
		return $data;
	}
	
}
//---------------FOR ADD NEW USER --------------------------
function add_newuser($userdata,$usermetadata,$firstname,$lastname,$role)
{	
	$Schoolname = 	 get_option('smgt_school_name');		
	$MailSub 	=	 get_option('student_assign_to_teacher_subject');
	$MailCon	=	 get_option('student_assign_to_teacher_content');

	$returnval;
	$user_id = wp_insert_user( $userdata );
 	$user = new WP_User($user_id);
	 $user->set_role($role);
	foreach($usermetadata as $key=>$val)
	{		
		$returnans=add_user_meta( $user_id, $key,$val, true );		
	}
	
	if($user_id)
	{		
		$string = array();
		$string['{{user_name}}']   =  $firstname .' '.$lastname;
		$string['{{school_name}}'] =  get_option('smgt_school_name');
		$string['{{role}}']        =  $role;
		$string['{{login_link}}']  =  site_url() .'/index.php/school-management-login-page';
		$string['{{username}}']    =  $userdata['user_login'];
		$string['{{Password}}']    =  $userdata['user_pass'];
			
		$MsgContent                =  get_option('add_user_mail_content');		
		$MsgSubject				   =  get_option('add_user_mail_subject');
		$message = string_replacement($string,$MsgContent);
		$MsgSubject = string_replacement($string,$MsgSubject);
	
		$email= $userdata['user_email'];
		smgt_send_mail($email,$MsgSubject,$message);
		
		
		// send mail when student assin to teacher.
		if($role=='student')
		{
			$TeacherIDs = check_class_exits_in_teacher_class($usermetadata['class_name']);	
			$TeacherEmail = array();
			$string['{{school_name}}']  = $Schoolname;
			$string['{{student_name}}'] =  get_display_name($user_id);
			$subject = get_option('student_assign_teacher_mail_subject');
			$MessageContent = get_option('student_assign_teacher_mail_content');
			foreach($TeacherIDs as $teacher)
			{		
				$TeacherData = get_userdata($teacher);		
				//$TeacherData->user_email;
				$string['{{teacher_name}}']= get_display_name($TeacherData->ID);
				$message = string_replacement($string,$MessageContent);
				smgt_send_mail($TeacherData->user_email,$subject,$message);
			}			
			
		}
	}
	
	$returnval=update_user_meta( $user_id, 'first_name', $firstname );
	$returnval=update_user_meta( $user_id, 'last_name', $lastname );
	if($role=='parent')
	{
		$child_list = $_REQUEST['chield_list'];
		foreach($child_list as $child_id)
		{
			$student_data = get_user_meta($child_id, 'parent_id', true);
			$parent_data = get_user_meta($user_id, 'child', true); 
		
			if($student_data)
			{
				if(!in_array($user_id, $student_data))
				{
					$update = array_push($student_data,$user_id);				
					$returnans=update_user_meta($child_id,'parent_id', $student_data);
					if($returnans)
					$returnval=$returnans;
				}				
			}
			else
			{
				$parant_id = array($user_id);
				$returnans=add_user_meta($child_id,'parent_id', $parant_id );
				if($returnans)
				$returnval=$returnans;
			}
			if ($parent_data)
			{
				if(!in_array($child_id, $parent_data))
				{
					$update = array_push($parent_data,$child_id);			
					$returnans=update_user_meta($user_id,'child', $parent_data);
					if($returnans)
					$returnval=$returnans;
				}
			}
			else 
			{		
				$child_id = array($child_id);
				$returnans=add_user_meta($user_id,'child', $child_id );
				if($returnans)
					$returnval=$returnans;
			}		
		}
	}
	
	if($role=="teacher")
	{
		$Schoolname = get_option('smgt_school_name');		
		$MailSub 	=	 get_option('student_assign_to_teacher_subject');
		$MailCon	=	 get_option('student_assign_to_teacher_content');
		if(!empty($usermetadata['class_name']))
		{			
			$std	= array();	
			foreach($usermetadata['class_name'] as $class)
			{			
				 $std = array_merge(get_student_by_class_id($class),$std);			
			}
			$student_name ='';
			foreach($std as $studentdata)
			{			
				if(!empty($studentdata))
				{
					$MailArr = array();		
					foreach($studentdata as $key=>$student)
					{					
						
						if(isset($student) && !empty($student))
						{
							$student_name = get_display_name($student->ID);							
							$MailArr['{{school_name}}'] 	= 	$Schoolname;				
							$MailArr['{{teacher_name}}'] 	= 	get_display_name($user_id);
							$MailArr['{{class_name}}'] 		= 	get_class_name(get_user_meta($student->ID,'class_name',true)); 
							$MailArr['{{student_name}}'] 	=  	$student_name; 					
							$MailSub = string_replacement($MailArr,$MailSub);
							$MailCon = string_replacement($MailArr,$MailCon);
							smgt_send_mail($student->user_email,$MailSub,$MailCon);  
						}
							 
				
					}			
				} 			
			} 		
		}		
	}
	return $returnval;	
}

function smgt_load_documets($file,$type,$nm) 
{  
	$parts = pathinfo($_FILES[$type]['name']);
	$inventoryimagename = time()."-".$nm."-"."in".".".$parts['extension'];
	$document_dir = WP_CONTENT_DIR ;
    $document_dir .= '/uploads/school_assets/';
	$document_path = $document_dir;

	if (!file_exists($document_path))
	{
		mkdir($document_path, 0777, true);
	}	
	if (move_uploaded_file($_FILES[$type]['tmp_name'], $document_path.$inventoryimagename)) 
	{
        $imagepath= $inventoryimagename;	
    }
	return $imagepath;
}

function smgt_frontend_menu_list() 
{
	$access_array=array('teacher' => 
    array (
      'menu_icone' =>plugins_url( 'school-management/assets/images/icons/teacher.png' ),
      'menu_title' =>'Teacher',
      'student' =>'1',
      'teacher' =>'1',
      'parent' =>'1',
      'supportstaff' => 0,
      'page_link' =>'teacher'),
	  
	  'student' => 
    array (
      'menu_icone' =>plugins_url( 'school-management/assets/images/icons/student-icon.png'),
      'menu_title' =>'student',
      'student' =>'1',
      'teacher' =>'1',
      'parent' =>'0',
      'supportstaff' =>'1',
      'page_link' =>'student'),
	  
	  'child' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/student-icon.png'),
      'menu_title' =>'Child',
      'student' =>'0',
      'teacher' =>'0',
      'parent' =>'1',
      'supportstaff' =>0 ,
      'page_link' =>'child'),
	  
	  'parent' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/parents.png'),
      'menu_title' =>'Parent',
      'student' =>'0',
      'teacher' =>'0',
      'parent' =>'0',
      'supportstaff' => 0,
      'page_link' =>'parent'),
	  
	  'subject' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/subject.png'),
      'menu_title' =>'Subject',
      'student' =>'1',
      'teacher' =>'1',
      'parent' =>'0',
      'supportstaff' => 0,
      'page_link' =>'subject'),
	  
	  'schedule' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/class-route.png'),
      'menu_title' =>'Class Routine',
      'student' =>'1',
      'teacher' =>'1',
      'parent' =>'1',
      'supportstaff' => 0,
      'page_link' =>'schedule'),
	  
	  'attendance' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/attandance.png'),
      'menu_title' =>'Attendance',
      'student' =>'0',
      'teacher' =>'1',
      'parent' =>'0',
      'supportstaff' => 0,
      'page_link' =>'attendance'),
	  
	  'exam' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/exam.png'),
      'menu_title' =>'Exam',
      'student' =>'1',
      'teacher' =>'1',
      'parent' =>'1',
      'supportstaff' => 0,
      'page_link' =>'exam'),
	 /* 
	  'homework' => 
    array (
      'menu_icone' =>plugins_url( 'school-management/assets/images/icons/homework.png'),
      'menu_title' =>'Home Work',
      'student' =>'1',
      'teacher' =>'1',
      'parent' =>'1',
      'supportstaff' => 0,
      'page_link' =>'homework'),
	  */
	  'manage_marks' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/mark-manage.png'),
      'menu_title' =>'Mark Manage',
      'student' =>'0',
      'teacher' =>'1',
      'parent' =>'0',
      'supportstaff' => 1,
      'page_link' =>'manage_marks'),
	  
	  'feepayment' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/fee.png'),
      'menu_title' =>'Fee Payment',
      'student' =>'1',
      'teacher' =>'0',
      'parent' =>'1',
      'supportstaff' => 1,
      'page_link' =>'feepayment'),
	  
	  'payment' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/payment.png'),
      'menu_title' =>'Payment',
      'student' =>'1',
      'teacher' =>'0',
      'parent' =>'1',
      'supportstaff' => 1,
      'page_link' =>'payment'),
	  
	   'transport' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/transport.png'),
      'menu_title' =>'Transport',
      'student' =>'1',
      'teacher' =>'1',
      'parent' =>'1',
      'supportstaff' => 1,
      'page_link' =>'transport'),
	  
	   'notice' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/notice.png'),
      'menu_title' =>'Notice Board',
      'student' =>'1',
      'teacher' =>'1',
      'parent' =>'1',
      'supportstaff' => 1,
      'page_link' =>'notice'),
	  
	   'message' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/message.png'),
      'menu_title' =>'Message',
      'student' =>'1',
      'teacher' =>'1',
      'parent' =>'1',
      'supportstaff' => 1,
      'page_link' =>'message&tab=inbox'),
	  
	   'holiday' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/holiday.png'),
      'menu_title' =>'Holiday',
      'student' =>'1',
      'teacher' =>'1',
      'parent' =>'1',
      'supportstaff' => 1,
      'page_link' =>'holiday'),
	  
	   'library' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/library.png'),
      'menu_title' =>'Library',
      'student' =>'1',
      'teacher' =>'1',
      'parent' =>'0',
      'supportstaff' => 1,
      'page_link' =>'library'),
	  
	   'account' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/account.png'),
      'menu_title' =>'Account',
      'student' =>'1',
      'teacher' =>'1',
      'parent' =>'1',
      'supportstaff' => 1,
      'page_link' =>'account'),
	   'report' => 
    array (
	  'menu_icone' =>plugins_url( 'school-management/assets/images/icons/report.png'),
      'menu_title' =>'Report',
      'student' =>'0',
      'teacher' =>'1',
      'parent' =>'0',
      'supportstaff' => '1',
      'page_link' =>'report')	  
	  );
	
	if ( !get_option('smgt_access_right') ) {
		update_option( 'smgt_access_right', $access_array );
	}
	
}
add_action('init','smgt_frontend_menu_list');
//-----------------FOR UPDATE USER Profile- ---------------------------------
function update_user_profile($userdata,$usermetadata)
{
	$returnans='';
	$user_id= wp_update_user($userdata);
	foreach($usermetadata as $key=>$val)
	{	
		$returnans=update_user_meta( $user_id, $key,$val );		
	}
	return $returnans;
}

function smgt_get_all_user_in_plugin()
{
	$all_user=array();
	$student = get_users(array('role'=>'student'));
	$teacher = get_users(array('role'=>'teacher'));
	$supportstaff = get_users(array('role'=>'supportstaff'));
	$parent = get_users(array('role'=>'parent'));
	$all_role = array_merge($student,$teacher,$supportstaff,$parent);
	$all_user = array($all_role);
	
	foreach($all_user as $key=>$values){
		return $values;
	}
}

//-----------------FOR UPDATE USER-------------------------------------------
function update_user($userdata,$usermetadata,$firstname,$lastname,$role)
{	
	
	$returnval;
	$user_id 	= 	wp_update_user($userdata);		
	$returnval	=	update_user_meta( $user_id, 'first_name', $firstname );
	$returnval	=	update_user_meta( $user_id, 'last_name', $lastname );
	foreach($usermetadata as $key=>$val)
	{		
		$returnans=update_user_meta( $user_id, $key,$val );
		if($returnans)
			$returnval=$returnans;
	}
	if($role=='parent')
	{
		$child_list = $_REQUEST['chield_list'];	
		$old_child 	= 	get_user_meta($user_id, 'child', true);
		if(!empty($old_child))
		{
			$different_insert_child 	= array_diff($child_list,$old_child);
		    $different_delete_child  	= array_diff($old_child,$child_list);
			
			if(!empty($different_insert_child))
			{
				
				foreach($different_insert_child as $key=>$child)
				{
					$parent 	=	array();
					$parent 	= 	get_user_meta($child, 'parent_id', true);
					$old_child  	= 	get_user_meta($user_id, 'child', true);
					
					array_push($old_child,$child);				
					update_user_meta($user_id,'child',$old_child);
					
					if(empty($parent))
					{					
						$parent1[] = $user_id;
						
						update_user_meta($child,'parent_id',$parent1);
					} 
					else
					{					
						array_push($parent,$user_id);
						update_user_meta($child,'parent_id',$parent);
					}				
				} 
			} 
			
			if(!empty($different_delete_child))
			{		
				
				$child  	= 	get_user_meta($user_id, 'child', true);			
				$childdata = array_diff($child,$different_delete_child);
				update_user_meta($user_id,'child',$childdata);			
				foreach($different_delete_child as $del_key=>$del_child)
				{
					$parent 	=	array();
					$parent 	= 	get_user_meta($del_child, 'parent_id', true);				
									
					if(!empty($parent))
					{
						if(in_array($user_id,$parent))
						{						
							unset($parent[array_search($user_id,$parent)]);
							update_user_meta($del_child,'parent_id',$parent); 
						}
					} 				
					
				} 
			}
		}
		else
		{
			foreach($child_list as $child_id)
			{
				$student_data = get_user_meta($child_id, 'parent_id', true);
				$parent_data = get_user_meta($user_id, 'child', true); 
				if($student_data)
				{
					if(!in_array($user_id, $student_data))
					{
						$update = array_push($student_data,$user_id);				
						$returnans=update_user_meta($child_id,'parent_id', $student_data);
						if($returnans)
						$returnval=$returnans;
					}				
				}
				else
				{
					$parant_id = array($user_id);
					$returnans=add_user_meta($child_id,'parent_id', $parant_id );
					if($returnans)
					$returnval=$returnans;
				}
				if ($parent_data)
				{
					if(!in_array($child_id, $parent_data))
					{
						$update = array_push($parent_data,$child_id);			
						$returnans=update_user_meta($user_id,'child', $parent_data);
						if($returnans)
						$returnval=$returnans;
					}
				}
				else 
				{		
					$child_id = array($child_id);
					$returnans=add_user_meta($user_id,'child', $child_id );
					if($returnans)
						$returnval=$returnans;
				}		
			}
		}
	}
	return $user_id;
}
function sgmt_day_list()
{
	$day_list = array('1' => __('Monday','school-mgt'),
		'2' => __('Tuesday','school-mgt'),
		'3' => __('Wednesday','school-mgt'),
		'4' => __('Thursday','school-mgt'),
		'5' => __('Friday','school-mgt'),
		'6' => __('Saturday','school-mgt'),
		'7' => __('Sunday','school-mgt'));
	return $day_list;
	
}
function smgt_menu()
{
	$user_menu = array();
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/student-icon.png' ),'menu_title'=>__( 'Student', 'school-mgt' ),'teacher' => 1,'student' => 1,'parent' =>0,'supportstaff' =>1,'page_link'=>'student');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/student-icon.png' ),'menu_title'=>__( 'Child', 'school-mgt' ),'teacher' => 0,'student' => 0,'parent' =>1,'supportstaff' =>0,'page_link'=>'child');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/teacher.png' ),'menu_title'=>__( 'Teacher', 'school-mgt' ),'teacher' => 1,'student' => 1,'parent' =>1,'supportstaff' =>0,'page_link'=>'teacher');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/parents.png' ),'menu_title'=>__( 'Parent', 'school-mgt' ),'teacher' => 0,'student' => 0,'parent' =>0,'supportstaff' =>0,'page_link'=>'parent');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/subject.png' ),'menu_title'=>__( 'Subject', 'school-mgt' ),'teacher' => 1,'student' => 1,'parent' =>0,'supportstaff' =>0,'page_link'=>'subject');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/class-route.png' ),'menu_title'=>__( 'Class Routine', 'school-mgt' ),'teacher' => 1,'student' => 1,'parent' =>1,'supportstaff' =>0,'page_link'=>'schedule');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/attandance.png' ),'menu_title'=>__( 'Attendance', 'school-mgt' ),'teacher' => 1,'student' => 0,'parent' =>0,'supportstaff' =>0,'page_link'=>'attendance');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/exam.png' ),'menu_title'=>__( 'Exam', 'school-mgt' ),'teacher' => 1,'student' => 1,'parent' =>1,'supportstaff' =>0,'page_link'=>'exam');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/mark-manage.png' ),'menu_title'=>__( 'Manage Marks', 'school-mgt' ),'teacher' => 1,'student' => 0,'parent' =>0,'supportstaff' =>1,'page_link'=>'manage_marks');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/fee.png' ),'menu_title'=>__( 'Fee Payment', 'school-mgt' ),'teacher' => 0,'student' => 1,'parent' =>1,'supportstaff' =>1,'page_link'=>'feepayment');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/payment.png' ),'menu_title'=>__( 'Payment', 'school-mgt' ),'teacher' => 0,'student' => 1,'parent' =>1,'supportstaff' =>1,'page_link'=>'payment');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/transport.png' ),'menu_title'=>__( 'Transport', 'school-mgt' ),'teacher' => 1,'student' => 1,'parent' =>1,'supportstaff' =>1,'page_link'=>'transport');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/notice.png' ),'menu_title'=>__( 'Notice Board', 'school-mgt' ),'teacher' => 1,'student' => 1,'parent' =>1,'supportstaff' =>1,'page_link'=>'notice');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/message.png' ),'menu_title'=>__( 'Message', 'school-mgt' ),'teacher' => 1,'student' => 1,'parent' =>1,'supportstaff' =>1,'page_link'=>'message&tab=inbox');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/holiday.png' ),'menu_title'=>__( 'Holiday', 'school-mgt' ),'teacher' => 1,'student' => 1,'parent' =>1,'supportstaff' =>1,'page_link'=>'holiday');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/library.png' ),'menu_title'=>__( 'Library', 'school-mgt' ),'teacher' => 1,'student' => 1,'parent' =>0,'supportstaff' =>1,'page_link'=>'library');
	$user_menu[] = array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/account.png' ),'menu_title'=>__( 'Account', 'school-mgt' ),'teacher' => 1,'student' => 1,'parent' =>1,'supportstaff' =>1,'page_link'=>'account');
	return  $user_menu;
}
//----------------- Exam data ------//
function get_exam_list()
{
	global $wpdb;
	$tbl_name = $wpdb->prefix .'exam';
	
	$exam =$wpdb->get_results("SELECT *  FROM $tbl_name");
	return $exam;
}
function get_exam_id()
{
	global $wpdb;
	$tbl_name = $wpdb->prefix .'exam';
	
	$exam =$wpdb->get_row("SELECT *  FROM $tbl_name");
	return $exam;
}
function get_subject_byid($id)
{
	global $wpdb;
	$tbl_name = $wpdb->prefix .'subject';
	
	$subject =$wpdb->get_row("SELECT * FROM $tbl_name where subid=".$id);
	return $subject->sub_name;
}
function get_student_by_class_id($id)
{
	global $wpdb;
	$student = get_users(array('meta_key' => 'class_name', 'meta_value' => $id));
	return $student;
}
//Migration
function fail_student_list($current_class,$next_class,$exam_id,$passing_marks)
{
	global $wpdb;
	$table_users = $wpdb->prefix . 'users';
	$table_usermeta = $wpdb->prefix . 'usermeta';
	$capabilities = $wpdb->prefix .'capabilities';
	$table_marks = $wpdb->prefix . 'marks';
	$sql ="SELECT DISTINCT u.id,u.user_login,um.meta_value FROM $table_users as u,$table_usermeta as um,$table_marks as m where
	(um.meta_key = 'class_name' AND um.meta_value = '$current_class') AND u.id = um.user_id
	AND u.ID = ANY (SELECT user_id FROM $table_usermeta WHERE meta_key = '$capabilities' AND meta_value RLIKE 'student')
	AND m.marks < $passing_marks AND u.id = m.student_id AND m.exam_id = $exam_id";
	$student =$wpdb->get_results($sql);
	$failed_list = array();
	if(!empty($student))
	{
	foreach ($student as $fail_student)
	{
		$failed_list[]=$fail_student->id;
	}
	}
	
	return $failed_list;
}

function smgt_migration($current_class,$next_class,$exam_id,$fail_list)
{
	global $wpdb;
	$studentdata=get_usersdata('student');
	$table_usermeta = $wpdb->prefix . 'usermeta';
	if(!empty($studentdata))
	{
		foreach (get_usersdata('student') as $retrieved_data)
		{
			if (!in_array($retrieved_data->ID,$fail_list))
			{
				$sql_update ="UPDATE $table_usermeta set meta_value = '$next_class' where user_id = $retrieved_data->ID AND meta_value = '$current_class' AND meta_key = 'class_name'";
				$student =$wpdb->query($sql_update);
			}			
		}
	}

	
}
//var_dump(get_student_by_class_id(3));
//Message

function smgt_count_inbox_item($id)
{
	global $wpdb;
	$tbl_name = $wpdb->prefix .'smgt_message';
	$inbox =$wpdb->get_results("SELECT *  FROM $tbl_name where receiver = $id");
	return $inbox;
}
function smgt_count_unread_message($user_id)
{
	
	global $wpdb;
	$tbl_name = $wpdb->prefix .'smgt_message';
	//echo "SELECT *  FROM $tbl_name where receiver = $user_id and status=0";
	$inbox =$wpdb->get_results("SELECT *  FROM $tbl_name where receiver = $user_id and status=0");
	
	return $inbox;
}
function get_inbox_message($user_id,$p=0,$lpm1=10)
{
	
	global $wpdb;
	$tbl_name = $wpdb->prefix .'smgt_message';
	$tbl_name_message_replies = $wpdb->prefix .'smgt_message_replies';
	
	
	$inbox =$wpdb->get_results("SELECT DISTINCT b.message_id, a.* FROM $tbl_name a LEFT JOIN $tbl_name_message_replies b ON a.post_id = b.message_id WHERE ( a.receiver = $user_id OR b.receiver_id =$user_id)ORDER BY date DESC limit $p , $lpm1");
	
	
	
	//var_dump($inbox);
	//exit;
	
	return $inbox;
}

function get_send_message($user_id,$max=10,$offset=0)
{
	
	global $wpdb;
	$tbl_name = $wpdb->prefix .'smgt_message';
	$class_obj=new School_Management($user_id);
	;
	
	if(is_admin() || $class_obj->role=='teacher' || $class_obj->role=='parent' || $class_obj->role=='student')
	{
		
		$args['post_type'] = 'message';
		$args['posts_per_page'] =$max;
		$args['offset'] = $offset;
		$args['post_status'] = 'public';
		$args['author'] = $user_id;
		
		$q = new WP_Query();
		$sent_message = $q->query( $args );
	
	}
	else 
	{
		$sent_message =$wpdb->get_results("SELECT *  FROM $tbl_name where sender = $user_id ");
	}
	return $sent_message;
}

function smgt_count_send_item($id)
{
	global $wpdb;
	$posts = $wpdb->prefix."posts";
	$total =$wpdb->get_var("SELECT Count(*) FROM ".$posts." Where post_type = 'message' AND post_author = $id");
	return $total;
}
function smgt_pagination($totalposts,$p,$lpm1,$prev,$next){
	$adjacents = 1;
	$page_order = "";
	$pagination = "";
	$form_id = 1;
	if(isset($_REQUEST['form_id']))
		$form_id=$_REQUEST['form_id'];
	if(isset($_GET['orderby']))
	{
		$page_order='&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
	}
	if($totalposts > 1)
	{
		$pagination .= '<div class="btn-group">';
		
		if ($p > 1)
			$pagination.= "<a href=\"?page=smgt_message&tab=sentbox&form_id=$form_id&pg=$prev$page_order\" class=\"btn btn-default\"><i class=\"fa fa-angle-left\"></i></a> ";
		else
			$pagination.= "<a class=\"btn btn-default disabled\"><i class=\"fa fa-angle-left\"></i></a> ";
		
		if ($p < $totalposts)
			$pagination.= " <a href=\"?page=smgt_message&tab=sentbox&form_id=$form_id&pg=$next\" class=\"btn btn-default next-page\"><i class=\"fa fa-angle-right\"></i></a>";
		else
			$pagination.= " <a class=\"btn btn-default disabled\"><i class=\"fa fa-angle-right\"></i></a>";
		$pagination.= "</div>\n";
	}
	return $pagination;
}
function smgt_fronted_sentbox_pagination($totalposts,$p,$lpm1,$prev,$next){
	$adjacents = 1;
	$page_order = "";
	$pagination = "";
	$form_id = 1;
	if(isset($_REQUEST['form_id']))
		$form_id=$_REQUEST['form_id'];
	if(isset($_GET['orderby']))
	{
		$page_order='&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
	}
	if($totalposts > 1)
	{
		$pagination .= '<div class="btn-group">';
		
		if ($p > 1)
			$pagination.= "<a href=\"?dashboard=user&page=message&tab=sentbox&pg=$prev$page_order\" class=\"btn btn-default\"><i class=\"fa fa-angle-left\"></i></a> ";
		else
			$pagination.= "<a class=\"btn btn-default disabled\"><i class=\"fa fa-angle-left\"></i></a> ";

		if ($p < $totalposts)
			$pagination.= " <a href=\"?dashboard=user&page=message&tab=sentbox&pg=$next\" class=\"btn btn-default next-page\"><i class=\"fa fa-angle-right\"></i></a>";
		else
			$pagination.= " <a class=\"btn btn-default disabled\"><i class=\"fa fa-angle-right\"></i></a>";
		$pagination.= "</div>\n";
	}
	return $pagination;
}
function smgt_admininbox_pagination($totalposts,$p,$lpm1,$prev,$next)
{
	$adjacents = 1;
	$page_order = "";
	$pagination = "";
	$form_id = 1;
	if(isset($_REQUEST['form_id']))
		$form_id=$_REQUEST['form_id'];
	if(isset($_GET['orderby']))
	{
		$page_order='&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
	}
	if($totalposts > 1)
	{
		$pagination .= '<div class="btn-group">';
		
		if ($p > 1)
			$pagination.= "<a href=\"?page=smgt_message&tab=inbox&pg=$prev\" class=\"btn btn-default\"><i class=\"fa fa-angle-left\"></i></a> ";
		else
			$pagination.= "<a class=\"btn btn-default disabled\"><i class=\"fa fa-angle-left\"></i></a> ";

		if ($p < $totalposts)
			$pagination.= " <a href=\"?page=smgt_message&tab=inbox&pg=$next\" class=\"btn btn-default next-page\"><i class=\"fa fa-angle-right\"></i></a>";
		else
			$pagination.= " <a class=\"btn btn-default disabled\"><i class=\"fa fa-angle-right\"></i></a>";
		$pagination.= "</div>\n";
	}
	return $pagination;
}
function smgt_inbox_pagination($totalposts,$p,$lpm1,$prev,$next)
{
	$adjacents = 1;
	$page_order = "";
	$pagination = "";
	$form_id = 1;
	if(isset($_REQUEST['form_id']))
		$form_id=$_REQUEST['form_id'];
	if(isset($_GET['orderby']))
	{
		$page_order='&orderby='.$_GET['orderby'].'&order='.$_GET['order'];
	}
	if($totalposts > 1)
	{
		$pagination .= '<div class="btn-group">';
		
		if ($p > 1)
			$pagination.= "<a href=\"?dashboard=user&page=message&tab=inbox&pg=$prev\" class=\"btn btn-default\"><i class=\"fa fa-angle-left\"></i></a> ";
		else
			$pagination.= "<a class=\"btn btn-default disabled\"><i class=\"fa fa-angle-left\"></i></a> ";
	
		if ($p < $totalposts)
			$pagination.= " <a href=\"?dashboard=user&page=message&tab=inbox&pg=$next\" class=\"btn btn-default next-page\"><i class=\"fa fa-angle-right\"></i></a>";
		else
			$pagination.= " <a class=\"btn btn-default disabled\"><i class=\"fa fa-angle-right\"></i></a>";
		$pagination.= "</div>\n";
	}
	return $pagination;
}
function get_message_by_id($id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "smgt_message";
	$qry = $wpdb->prepare("SELECT * FROM $table_name WHERE message_id= %d",$id);
	return $retrieve_subject = $wpdb->get_row($qry);

}
//add_action( 'wp_login_failed', 'smgt_login_failed' ); // hook failed login 

function smgt_login_failed( $user ) {
	// check what page the login attempt is coming from
	$referrer = $_SERVER['HTTP_REFERER'];
	$curr_args = array(
			'page_id' => get_option('smgt_login_page'),
			'login' => 'failed'
	);
	//print_r($curr_args);
	$referrer_faild = add_query_arg( $curr_args, get_permalink( get_option('smgt_login_page') ) );
	// check that were not on the default login page
	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $user!=null ) {
		// make sure we don't already have a failed login attempt
		if ( !strstr($referrer, '&login=failed' )) {
			// Redirect to the login page and append a querystring of login failed
			wp_redirect( $referrer_faild);
		} else {
			wp_redirect( $referrer );
		}

		exit;
	}
}



function pu_blank_login( $user ){
	// check what page the login attempt is coming from
	$referrer = $_SERVER['HTTP_REFERER'];

	$error = false;

	if($_POST['log'] == '' || $_POST['pwd'] == '')
	{
		$error = true;
	}

	// check that were not on the default login page
	if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') && $error ) {

		// make sure we don't already have a failed login attempt
		if ( !strstr($referrer, '&login=failed') ) {
			// Redirect to the login page and append a querystring of login failed
			wp_redirect( $referrer . '&login=failed' );
		} else {
			wp_redirect(site_url() );
		}

		exit;

	}
}
	
function smgt_login_link()
{

	$args = array( 'redirect' => site_url() );
	
	if(isset($_GET['login']) && $_GET['login'] == 'failed')
	{
		?>
		<div id="login-error" style="background-color: #FFEBE8;border:1px solid #C00;padding:5px;">
			<p>Login failed: You have entered an incorrect Username or password, please try again.</p>
		</div>
		<?php
	}
	if(isset($_GET['smgt_activate']) && $_GET['smgt_activate'] == '2')
	{
	?>
		<div id="login-error" style="background-color: #FFEBE8;border:1px solid #C00;padding:5px;">
			<p>Login failed: Please active your account.</p>
		</div>
<?php
	}
	global $reg_errors;
	$reg_errors = new WP_Error;
		if ( is_wp_error( $reg_errors ) )
		{
 
			foreach ( $reg_errors->get_error_messages() as $error )
			{     
				echo '<div>';
				echo '<strong>ERROR</strong>:';
				echo $error . '<br/>';
				echo '</div>';         
			}
		}
	 $args = array(
			'echo' => true,
			'redirect' => site_url( $_SERVER['REQUEST_URI'] ),
			'form_id' => 'loginform',
			'label_username' => __( 'Username' , 'school-mgt'),
			'label_password' => __( 'Password', 'school-mgt' ),
			'label_remember' => __( 'Remember Me' , 'school-mgt'),
			'label_log_in' => __( 'Log In' , 'school-mgt'),
			'id_username' => 'user_login',
			'id_password' => 'user_pass',
			'id_remember' => 'rememberme',
			'id_submit' => 'wp-submit',
			'remember' => true,
			'value_username' => NULL,
	        'value_remember' => false ); 
	 $args = array('redirect' => site_url('/?dashboard=user') );
	 
	 if ( is_user_logged_in() )
	 {
	 	?>
<a href="<?php echo home_url('/')."?dashboard=user"; ?>">
<?php _e('Dashboard','school-mgt');?>
</a>
<br /><a href="<?php echo wp_logout_url(); ?>"><?php _e('Logout','school-mgt');?></a> 
<?php 
	 }
	 else 
	 {
		wp_login_form( $args );	 
	 }
	 
}
function smgt_view_student_attendance($start_date,$end_date,$user_id)
{
	
	global $wpdb;
	$tbl_name = $wpdb->prefix .'attendence';
	
	$result =$wpdb->get_results("SELECT *  FROM $tbl_name where user_id=$user_id AND role_name = 'student' and attendence_date between '$start_date' and '$end_date'");
	return $result;
}
function smgt_get_attendence($userid,$curr_date)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "attendence";	
	$result=$wpdb->get_var("SELECT status FROM $table_name WHERE attendence_date='$curr_date'  and user_id=$userid");
	return $result;

}
function smgt_get_sub_attendence($userid,$curr_date,$sub_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "smgt_sub_attendance";
	
	$result=$wpdb->get_var("SELECT status FROM $table_name WHERE attendance_date='$curr_date' and user_id=$userid and sub_id=$sub_id");
	
	return $result;

}
function smgt_get_attendence_comment($userid,$curr_date)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "attendence";
	$result=$wpdb->get_row("SELECT comment FROM $table_name WHERE attendence_date='$curr_date'  and user_id=$userid");
	if(!empty($result))
	 return $result->comment;
	else
		return '';

}
function smgt_get_sub_attendence_comment($userid,$curr_date,$sub_id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . "smgt_sub_attendance";
	$result=$wpdb->get_row("SELECT comment FROM $table_name WHERE attendance_date='$curr_date'  and user_id=$userid and sub_id=$sub_id");
	if(!empty($result))
		return $result->comment;
	else
		return '';

}
//All AJAX Function
add_action( 'wp_ajax_smgt_load_subject_class_id_and_section_id',  'smgt_load_subject_class_id_and_section_id');
add_action( 'wp_ajax_smgt_load_subject',  'smgt_load_subject');
add_action( 'wp_ajax_smgt_result',  'ajax_smgt_result');
add_action( 'wp_ajax_smgt_active_student',  'smgt_active_student');
add_action( 'wp_ajax_smgt_result_pdf',  'ajax_smgt_result_pdf');
add_action( 'wp_ajax_smgt_load_user',  'smgt_load_user');
add_action( 'wp_ajax_smgt_load_section_user',  'smgt_load_section_user');
add_action( 'wp_ajax_smgt_load_books',  'smgt_load_books');
add_action( 'wp_ajax_smgt_load_class_fee_type',  'smgt_load_class_fee_type');
add_action( 'wp_ajax_smgt_load_section_fee_type',  'smgt_load_section_fee_type');
add_action( 'wp_ajax_smgt_load_fee_type_amount',  'smgt_load_fee_type_amount');
add_action( 'wp_ajax_cmgt_verify_pkey', 'cmgt_verify_pkey');

add_action( 'wp_ajax_smgt_view_parent',  'smgt_view_parent');
add_action( 'wp_ajax_smgt_view_notice',  'ajax_smgt_view_notice');
add_action( 'wp_ajax_smgt_sms_service_setting',  'smgt_sms_service_setting');
add_action( 'wp_ajax_smgt_student_invoice_view',  'smgt_student_invoice_view');
add_action( 'wp_ajax_smgt_student_add_payment',  'smgt_student_add_payment');
add_action( 'wp_ajax_smgt_student_view_paymenthistory',  'smgt_student_view_paymenthistory');
add_action( 'wp_ajax_smgt_student_view_librarryhistory',  'smgt_student_view_librarryhistory');
add_action( 'wp_ajax_smgt_add_remove_feetype',  'smgt_add_remove_feetype');
add_action( 'wp_ajax_smgt_add_fee_type',  'smgt_add_fee_type');
add_action( 'wp_ajax_smgt_remove_feetype',  'smgt_remove_feetype');
add_action( 'wp_ajax_smgt_edit_section',  'smgt_edit_section');
add_action( 'wp_ajax_smgt_update_section',  'smgt_update_section');
add_action( 'wp_ajax_smgt_update_cancel_section',  'smgt_update_cancel_section');
add_action( 'wp_ajax_smgt_get_book_return_date',  'smgt_get_book_return_date');
add_action( 'wp_ajax_smgt_accept_return_book',  'smgt_accept_return_book');
add_action( 'wp_ajax_smgt_load_class_section',  'smgt_load_class_section');
add_action( 'wp_ajax_nopriv_smgt_load_class_section',  'smgt_load_class_section');
add_action( 'wp_ajax_nopriv_smgt_load_section_subject',  'smgt_load_section_subject');
add_action( 'wp_ajax_smgt_load_section_subject',  'smgt_load_section_subject');
add_action( 'wp_ajax_nopriv_smgt_load_class_student',  'smgt_load_class_student');
add_action( 'wp_ajax_smgt_load_class_student',  'smgt_load_class_student');
add_action( 'wp_ajax_smgt_notification_user_list','smgt_notification_user_list');


add_action( 'wp_ajax_smgt_class_by_teacher','smgt_class_by_teacher');
add_action( 'wp_ajax_smgt_teacher_by_class','smgt_teacher_by_class');
add_action( 'wp_ajax_smgt_sender_user_list','smgt_sender_user_list');

add_action( 'wp_ajax_smgt_frontend_sender_user_list','smgt_frontend_sender_user_list');
add_action( 'wp_ajax_smgt_change_profile_photo','smgt_change_profile_photo');

add_action( 'wp_ajax_smgt_count_student_in_class','smgt_count_student_in_class');
add_action( 'wp_ajax_smgt_count_student_in_class','smgt_count_student_in_class');

function cmgt_verify_pkey()
{
	//$api_server = '192.168.1.22';
	//$api_server = 'http://license.dasinfomedia.com';
	$api_server = 'license.dasinfomedia.com';
	$fp = fsockopen($api_server,80, $errno, $errstr, 2);
	$location_url = admin_url().'admin.php?page=smgt_school';
	if (!$fp)
              $server_rerror = 'Down';
        else
              $server_rerror = "up";
	if($server_rerror == "up")
	{
	$domain_name= $_SERVER['SERVER_NAME'];
	$licence_key = $_REQUEST['licence_key'];
	$email = $_REQUEST['enter_email'];
	$data['domain_name']= $domain_name;
	$data['licence_key']= $licence_key;
	$data['enter_email']= $email;

	//$verify_result = amgt_submit_setupform($data);
	$result = cmgt_check_productkey($domain_name,$licence_key,$email);
	if($result == '1')
	{
		$message = 'Please provide correct Envato purchase key.';
			$_SESSION['cmgt_verify'] = '1';
	}
	elseif($result == '2')
	{
		$message = 'This purchase key is already registered with the different domain. If have any issue please contact us at sales@dasinfomedia.com ';
			$_SESSION['cmgt_verify'] = '2';
	}
	elseif($result == '3')
	{
		$message = 'There seems to be some problem please try after sometime or contact us on sales@dasinfomedia.com';
			$_SESSION['cmgt_verify'] = '3';
	}
	elseif($result == '4')
	{
		$message = 'Please provide correct Envato purchase key for this plugin.';
			$_SESSION['cmgt_verify'] = '4';
	}
	else{
		update_option('domain_name',$domain_name,true);
	update_option('licence_key',$licence_key,true);
	update_option('cmgt_setup_email',$email,true);
		$message = 'Success fully register';
			$_SESSION['cmgt_verify'] = '0';
	}
	
	
	$result_array = array('message'=>$message,'cmgt_verify'=>$_SESSION['cmgt_verify'],'location_url'=>$location_url);
	echo json_encode($result_array);
	}
	else
	{
		$message = 'Server is down Please wait some time';
		$_SESSION['cmgt_verify'] = '3';
		$result_array = array('message'=>$message,'cmgt_verify'=>$_SESSION['cmgt_verify'],'location_url'=>$location_url);
	echo json_encode($result_array);
	}
	die();
}
//section select to load subject
function smgt_load_subject_class_id_and_section_id()
{
		$class_id =$_POST['class_list'];
		$section_id =$_POST['class_section'];
		
		global $wpdb;
		$table_name = $wpdb->prefix . "subject";
		$table_name2 = $wpdb->prefix . "teacher_subject";
		$user_id=get_current_user_id();
		if(smgt_get_roles($user_id)=='teacher' && get_option('smgt_subject_access')=='own_subjects')
		{
		    if($section_id =='')
			{
			  $retrieve_subject = $wpdb->get_results( "SELECT * FROM $table_name where  teacher_id=$user_id and class_id=".$class_id);
			}
			else
			{
			  $retrieve_subject = $wpdb->get_results( "SELECT p1.*,p2.* FROM $table_name p1 INNER JOIN $table_name2 p2 ON(p1.subid = p2.subject_id) WHERE p2.teacher_id = $user_id AND p1.class_id = $class_id AND p1.section_id=$section_id");
			}
			
		}
		elseif(smgt_get_roles($user_id)=='teacher')
		{
			  $retrieve_subject = $wpdb->get_results( "SELECT p1.*,p2.* FROM $table_name p1 INNER JOIN $table_name2 p2 ON(p1.subid = p2.subject_id) WHERE p2.teacher_id = $user_id AND p1.class_id = $class_id AND p1.section_id=$section_id");
		}
		elseif(is_admin())
		{
		  /* $retrieve_subject = $wpdb->get_results( "SELECT p1.*,p2.* FROM $table_name p1 INNER JOIN $table_name2 p2 ON(p1.subid = p2.subject_id) WHERE p1.class_id = $class_id AND p1.section_id=$section_id"); */
		  $retrieve_subject = $wpdb->get_results( "SELECT p1.* FROM $table_name p1 WHERE p1.class_id = $class_id AND p1.section_id=$section_id");
		}
		else
		{
		 $retrieve_subject = $wpdb->get_results( "SELECT * FROM $table_name WHERE class_id=".$class_id);
		}
		$defaultmsg=__( 'Select subject' , 'school-mgt');
			
		echo "<option value=''>".$defaultmsg."</option>";	
		foreach($retrieve_subject as $retrieved_data)
		{
			echo "<option value=".$retrieved_data->subid."> ".$retrieved_data->sub_name ."</option>";
		}
		exit;
}
/* Notification user list*/
function smgt_notification_user_list()
{
	$school_obj = new School_Management ( get_current_user_id () );	
	
	
	$class_list = isset($_REQUEST['class_list'])?$_REQUEST['class_list']:'';
	$class_section = isset($_REQUEST['class_section'])?$_REQUEST['class_section']:'';
	$exlude_id = smgt_approve_student_list();

	
	//$results = get_users($query_data);
	$html_class_section = '';
	$return_results['section'] = '';
	$user_list = array();
	global $wpdb;
	$defaultmsg=__( 'All' , 'school-mgt');
	$html_class_section =  "<option value='All'>".$defaultmsg."</option>";	
	if($class_list != '')
	{
		$retrieve_data=smgt_get_class_sections($class_list);	
		if($retrieve_data)
		foreach($retrieve_data as $section)
		{
			$html_class_section .= "<option value='".$section->id."'>".$section->section_name."</option>";
		}
	}
		
	$query_data['exclude']=$exlude_id;
	if($class_section != 'All' && $class_section != ''){
		$query_data['meta_key'] = 'class_section';
		$query_data['meta_value'] = $class_section;
		$query_data['meta_query'] = array(array('key' => 'class_name','value' => $class_list,'compare' => '=') );
		$results = get_users($query_data);
	}
	elseif($class_list != ''){
		$query_data['meta_key'] = 'class_name';
		$query_data['meta_value'] = $class_list;
		$results = get_users($query_data);
	}
	
	if(isset($results))
	{
		foreach($results as $user_datavalue)
			$user_list[] = $user_datavalue->ID;
	}

	
	$user_data_list = array_unique($user_list);
	$return_results['section'] = $html_class_section;
	$return_results['users'] = '';
	$user_string  = '<select name="selected_users" id="notification_selected_users" class="form-control">';
	$user_string .= '<option value="All">All</option>';
	if(!empty($user_data_list))
	foreach($user_data_list as $retrive_data)
	{
		$user_string .= "<option value='".$retrive_data."'>".get_user_name_byid($retrive_data)."</option>";
	}
	$user_string .= '</select>';
	$return_results['users'] = $user_string;
	echo json_encode($return_results);
	die();
}

function check_book_issued($student_id)
{
	global $wpdb;
	$table_issuebook=$wpdb->prefix.'smgt_library_book_issue';
	$booklist = $wpdb->get_results("SELECT * FROM $table_issuebook where student_id=$student_id and ( status='Issue' OR status ='Submitted')");
	return $booklist;
}
function smgt_accept_return_book()
{
	$stud_id=$_REQUEST['student_id'];
	global $wpdb;
	$table_issuebook=$wpdb->prefix.'smgt_library_book_issue';
	$booklist = $wpdb->get_results("SELECT * FROM $table_issuebook where student_id=$stud_id and status='Issue'");
	$student=get_userdata($stud_id);
	//var_dump($result);?>
	<div class="modal-header">
		<a href="#" class="close-btn-cat badge badge-success pull-right">X</a>
		<h4 class="modal-title"><?php _e('Student Library History','school-mgt');?></h4>
	</div>
	<div class="modal-body">
	<div id="invoice_print"> 
		<?php
		if(!empty($booklist)){ ?>
			<h4><?php echo $student->display_name." Date: ".date('Y-m-d'); ?></h4>
			<hr>
			<form name="issue_book-return" method="post">
			<table class="table" width="100%" style="border-collapse:collapse;">
				<thead>
					<tr>
						<th></th>
						<th class="text-left"><?php _e('Book name','school-mgt');?></th>
						<th class="text-left"><?php _e('Overdue By','school-mgt');?></th>
						<th class="text-left"> <?php _e('Fine','school-mgt');?></th>
					</tr>
				</thead>
				<tbody>
				<?php 
					foreach($booklist as  $retrieved_data)
					{
						$date1=date_create(date('Y-m-d'));
						$date2=date_create(date("Y-m-d", strtotime($retrieved_data->end_date)));
						$diff=date_diff($date2,$date1);
					?>
					<tr>
						<td><input type="checkbox" value="<?php echo $retrieved_data->id;?>" name="books_return[]"></td>
						<td><?php echo stripslashes(get_bookname($retrieved_data->book_id));?></td>
						<td><?php if ($date1 > $date2) echo $diff->format("%a Days"); else echo __("0 Days","school-mgt");?></td>
						<td><input type="text" name="fine[]" value=""> </td>
					</tr>
				<?php } ?>
				</tbody>
					<tr><td colspan="4"><input type="submit" class="btn btn-success" name="submit_book" value="Submit Book"></td></tr>
			</table>
			</form>
			<?php }
				else
				{
					_e('No Any Book Pending','school-mgt');
				}?>
	</div>
	</div>
	<?php 
	die();
}

function smgt_get_book_return_date()
{
	$period_days=get_the_title($_REQUEST['issue_period']);
	$date = date_create($_REQUEST['issue_date']);
	$olddate=date_format($date, 'Y-m-d');
	echo date('m/d/Y', strtotime($olddate. ' + '.$period_days.' days'));
	die();
}

function smgt_load_subject()
{
		
		$class_id =$_POST['class_list'];
		
		global $wpdb;
		$table_name = $wpdb->prefix . "subject";
		$table_name2 = $wpdb->prefix . "teacher_subject";
		$user_id=get_current_user_id();
		if(smgt_get_roles($user_id)=='teacher' && get_option('smgt_subject_access')=='own_subjects')
		{
			$retrieve_subject = $wpdb->get_results( "SELECT * FROM $table_name where  teacher_id=$user_id and class_id=".$class_id);
		}
		elseif(smgt_get_roles($user_id)=='teacher')
		{
			  $retrieve_subject = $wpdb->get_results( "SELECT p1.*,p2.* FROM $table_name p1 INNER JOIN $table_name2 p2 ON(p1.subid = p2.subject_id) WHERE p2.teacher_id = $user_id AND p1.class_id = $class_id");
		}
		else{
		 $retrieve_subject = $wpdb->get_results( "SELECT * FROM $table_name WHERE class_id=".$class_id);
		}
		$defaultmsg=__( 'Select subject' , 'school-mgt');
			
		echo "<option value=''>".$defaultmsg."</option>";	
		foreach($retrieve_subject as $retrieved_data)
		{
			echo "<option value=".$retrieved_data->subid."> ".$retrieved_data->sub_name ."</option>";
		}
		exit;
}

function smgt_load_section_subject()
{
		
		$section_id =$_POST['section_id'];
		global $wpdb;
		$table_name = $wpdb->prefix . "subject";
		$user_id=get_current_user_id();
		if(smgt_get_roles($user_id)=='teacher' && get_option('smgt_subject_access')=='own_subjects')
		{
			$retrieve_subject = $wpdb->get_results( "SELECT * FROM $table_name where  teacher_id=$user_id and section_id=".$section_id);
		}
		else{
		 $retrieve_subject = $wpdb->get_results( "SELECT * FROM $table_name WHERE section_id=".$section_id);
		}
		$defaultmsg=__( 'Select subject' , 'school-mgt');
			
		echo "<option value=''>".$defaultmsg."</option>";	
		foreach($retrieve_subject as $retrieved_data)
		{
			echo "<option value=".$retrieved_data->subid."> ".$retrieved_data->sub_name ."</option>";
		}
		exit;
}

function smgt_load_class_student(){
	//$section_id = $_REQUEST['section_id'];
	$class_list = $_REQUEST['class_list'];
	var_dump($class_list);	
	$args = array(
		'role'=>'student',
		'meta_key'=>'class_name',
		'meta_value'=>$class_list

	);
	$result = get_users( $args );
	foreach($result as $key=>$value){
		print "Yes";
	}
exit;

}

function ajax_smgt_result()
{
	$obj_mark = new Marks_Manage(); 
	$uid = $_REQUEST['student_id'];
	
	$user =get_userdata( $uid );
	$user_meta =get_user_meta($uid);
	
	$class_id = $user_meta['class_name'][0];
	$subject = $obj_mark->student_subject($class_id);
	$total_subject=count($subject);
	$total = 0;
	$grade_point = 0;
	$all_exam = get_exam_list();
	?>
	<style>
	 .modal-header{
		 height:auto;
	 }
	</style>
<div class="modal-header"> <a href="#" class="close-btn badge badge-success pull-right">X</a>
	 <img src="<?php echo get_option( 'smgt_school_logo' ) ?>" class="img-circle head_logo" width="40" height="40" />
 <?php echo get_option( 'smgt_school_name' );?> 
</div>
<hr>
<div class="panel panel-white">
  <div class="panel-heading">
    <h4 class="panel-title"><i class="fa fa-user"></i> <?php echo get_user_name_byid($uid);?></h4>
  </div>
  <?php 
	if(!empty($all_exam))
	{ ?>
	  <div class="clearfix"></div>
	  <div id="accordion" class="panel-group" aria-multiselectable="true" role="tablist">
		<?php 
		$i=0;
		foreach ($all_exam as $exam) /* #### ALL EXAM LOOP STARTS  */
		{
			$exam_id =$exam->exam_id; ?>
			<div class="panel panel-default">
			  <div id="heading_<?php echo $i;?>" class="panel-heading" role="tab">
				<h4 class="panel-title"> <a class="collapsed" aria-controls="collapse_<?php echo $i;?>" aria-expanded="false" href="#collapse_<?php echo $i;?>" data-parent="#accordion" 
					data-toggle="collapse">
				  <?php _e('Exam Result','school-mgt'); ?>
				  : <?php echo $exam->exam_name; ?> </a> </h4>
			  </div>
			  <div id="collapse_<?php echo $i;?>" class="panel-collapse collapse" aria-labelledby="heading_<?php echo $i;?>" role="tabpanel" aria-expanded="false" style="height: 0px;">
				<div class="clearfix"></div>
				<?php
					if(is_super_admin( get_current_user_id() ))
					{ ?>
						<div class="print-button pull-right" style="margin-right: 35px;"> <a href="?page=smgt_student&print=pdf&student=<?php echo $uid;?>&exam_id=<?php echo $exam_id;?>" target="_blank" class="btn btn-info"><?php _e('PDF','school-mgt'); ?></a> <a href="?page=smgt_student&print=print&student=<?php echo $uid;?>&exam_id=<?php echo $exam_id;?>" target="_blank" class="btn btn-info"><?php _e('Print','school-mgt'); ?></a> </div>
						<?php
					}
					else 
					{ ?>
						<div class="print-button pull-right" style="margin-right: 40px;"> <a href="?dashboard=user&page=student&print=pdf&student=<?php echo $uid;?>&exam_id=<?php echo $exam_id;?>" target="_blank" class="btn btn-info"><?php _e('PDF','school-mgt'); ?></a> <a href="?dashboard=user&page=student&print=print&student=<?php echo $uid;?>&exam_id=<?php echo $exam_id;?>" target="_blank" class="btn btn-info"><?php _e('Print','school-mgt'); ?></a> </div>
						<?php 				
					} ?>
					<div class="clearfix"></div>
					<div class="panel-body view_result">
					  <div class="table-responsive">				  
						<table class="table table-bordered">
						  <tr>
							<th><?php _e('Subject','school-mgt')?></th>
							<th><?php _e('Obtain Mark','school-mgt')?></th>
							<th><?php _e('Grade','school-mgt')?></th>
							<th><?php _e('Grade Comment','school-mgt')?></th>
						  </tr>
						  <?php		
							$total=0;
							$grade_point = 0; 
							foreach($subject as $sub) /*** ####  SUBJECT LOOPS STARTS **/
							{
								$marks = $obj_mark->get_marks($exam_id,$class_id,$sub->subid,$uid);
								/* if($marks !=0 )
								{  */?>
							  <tr>
								<td><?php echo $sub->sub_name;?></td>
								<td><?php echo $marks;?> </td>
								<td><?php echo $obj_mark->get_grade($exam_id,$class_id,$sub->subid,$uid);?></td>
								<td><?php echo $obj_mark->get_grade_marks_comment($obj_mark->get_grade($exam_id,$class_id,$sub->subid,$uid));?></td>
							  </tr>
							  <?php
								$total +=  $marks;
								$grade_point += $obj_mark->get_grade_point($exam_id,$class_id,$sub->subid,$uid);
								/* }
								else 
								{ 
									_e("No Result","school-mgt");  ## IF MARKS IS "0" THEN IT WILL PRINT MESSAGE AND DIE. AN ISSUE
									die; 
								}   */
							}   /*####  SUBJECT LOOPS ENDS **/ ?>
						</table>
						  </div>
						  <hr />
						  <p class="result_total">
							<?php _e("Total Marks","school-mgt"); echo "=> ".$total; ?>
						  </p>
						  <hr />
						  <p class="result_point">
							<?php	_e("GPA(grade point average)","school-mgt");
							$GPA=$grade_point/$total_subject;
							echo " => ".round($GPA, 2);?>
						  </p>
						  <hr />
						</div>
			  </div>
			</div>
			<?php
			$i++;
		}  /* #### ALL EXAM LOOP ENDS  */ ?>
	  </div>
	</div>
		<?php 
	}
	else 
	{
		_e('No Result Found','school-mgt');
	}
	exit;
}
function smgt_active_student()
{
	$uid = $_REQUEST['student_id'];
	?>
<div class="modal-header"> <a href="#" class="close-btn badge badge-success pull-right">X</a>
	<h4 id="myLargeModalLabel" class="modal-title"><?php echo get_option( 'smgt_school_name' );?></h4>
</div>
<hr>
<div class="panel panel-white">
	<div class="panel-heading">
		<h4 class="panel-title"><?php echo get_user_name_byid($uid);?></h4>
	</div>
   <form name="expense_form" action="" method="post" class="form-horizontal" id="expense_form">
		<input type="hidden" name="act_user_id" value="<?php echo $uid;?>">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="roll_id"><?php _e('Roll No.','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="roll_id" class="form-control validate[required,custom[onlyNumberSp]] text-input" maxlength="6" type="text" value="" name="roll_id">
			</div>
		</div>
		<div class="col-sm-offset-2 col-sm-8">
        	 <input type="submit" value="<?php _e('Active Student','school-mgt');?>" name="active_user" class="btn btn-success"/>
        </div>
   </form>
</div>
  <?php
  die();
}
function downlosd_smgt_result_pdf($sudent_id)
{
	ob_start();
	$obj_mark = new Marks_Manage();
	$uid = $sudent_id;
	
	$user =get_userdata( $uid );
	$user_meta =get_user_meta($uid);
	$class_id = $user_meta['class_name'][0];
	$subject = $obj_mark->student_subject($class_id);
	$total_subject=count($subject);
	$exam_id =$_REQUEST['exam_id'];
	$total = 0;
	$grade_point = 0;
	$umetadata=get_user_image($uid); ?>
<center>
  <div style="float:left;width:100%;"> <img src="<?php echo get_option( 'smgt_school_logo' ) ?>"  style="max-height:50px;"/> <?php echo get_option( 'smgt_school_name' );?> </div>
  <div style="width:100%;float:left;border-bottom:1px solid red;"></div>
  <div style="width:100%;float:left;border-bottom:1px solid yellow;padding-top:5px;"></div>
  <br>
  <div style="float:left;width:100%;padding:10px 0;">
    <div style="width:70%;float:left;text-align:left;">
      <p>
        <?php _e('Surname','school-mgt');?>
        :
        <?php get_user_meta($uid, 'last_name',true);?>
      </p>
      <p>
        <?php _e('First Name','school-mgt');?>
        : <?php echo get_user_meta($uid, 'first_name',true);?></p>
      <p>
        <?php _e('Class','school-mgt');?>
        :
        <?php $class_id=get_user_meta($uid, 'class_name',true);
											echo $classname=	get_class_name($class_id);
						?>
      </p>
      <p>
        <?php _e('Exam Name','school-mgt');?>
        :
        <?php 
				echo get_exam_name_id($exam_id);?>
      </p>
    </div>
    <div style="float:right;width:30%;"> <img src="<?php echo $umetadata['meta_value'];?>" width="100" /> </div>
  </div>
  <br>
  <table style="float:left;width:100%;border:1px solid #000;" cellpadding="0" cellspacing="0">
    <thead>
      <tr style="border-bottom: 1px solid #000;">
        <th style="border-bottom: 1px solid #000;text-align:left;border-right: 1px solid #000;"><?php _e('S/No','school-mgt');?></th>
        <th style="border-bottom: 1px solid #000;text-align:left;border-right: 1px solid #000;"><?php _e('Subject','school-mgt')?></th>
        <th style="border-bottom: 1px solid #000;text-align:left;border-right: 1px solid #000;"><?php _e('Obtain Mark','school-mgt')?></th>
        <th style="border-bottom: 1px solid #000;text-align:left;border-right: 1px solid #000;"><?php _e('Grade','school-mgt')?></th>
      </tr>
    </thead>
    <tbody>
      <?php
	        $i=1;
			foreach($subject as $sub)
			{
			?>
      <tr style="border-bottom: 1px solid #000;">
        <td style="border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $i;?></td>
        <td style="border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $sub->sub_name;?></td>
        <td style="border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $obj_mark->get_marks($exam_id,$class_id,$sub->subid,$uid);?> </td>
        <td style="border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $obj_mark->get_grade($exam_id,$class_id,$sub->subid,$uid);?></td>
      </tr>
      <?php
			$i++;
			$total +=  $obj_mark->get_marks($exam_id,$class_id,$sub->subid,$uid);
			$grade_point += $obj_mark->get_grade_point($exam_id,$class_id,$sub->subid,$uid);
			} ?>
    </tbody>
  </table>
  <p class="result_total">
    <?php _e("Total Marks","school-mgt");
    echo " : ".$total;?>
  </p>
  <p class="result_point">
    <?php	_e("GPA(grade point average)1","school-mgt");
    $GPA=$grade_point/$total_subject;
    echo " : ".round($GPA, 2);	?>
  </p>
  <hr />
</center>
<?php
		$out_put = ob_get_contents();
		ob_clean();
		header('Content-type: application/pdf');
		header('Content-Disposition: inline; filename="result"');
		header('Content-Transfer-Encoding: binary');
		header('Accept-Ranges: bytes');
		require_once SMS_PLUGIN_DIR. '/lib/mpdf/mpdf.php';
		$mpdf		=	new mPDF( get_bloginfo( 'charset' ) );
		$mpdf		=	new mPDF('+aCJK');
		
		
		$mpdf->WriteHTML($out_put);
		$mpdf->Output();
			
		unset( $out_put );
		unset( $mpdf );
		exit;
}
function downlosd_smgt_result_print($sudent_id)
{
	$obj_mark = new Marks_Manage();
	$uid = $sudent_id;
	
	$user =get_userdata( $uid );
	$user_meta =get_user_meta($uid);
	$class_id = $user_meta['class_name'][0];
	$subject = $obj_mark->student_subject($class_id);
	$total_subject=count($subject);
	$exam_id =$_REQUEST['exam_id'];
	$total = 0;
	$grade_point = 0;
	$umetadata=get_user_image($uid);
	ob_start();
	
	?>
<div style="float:left;width:70%;"> <img src="<?php echo get_option( 'smgt_school_logo' ) ?>"  style="max-height:50px;"/> <?php echo get_option( 'smgt_school_name' );
					
					?> </div>
<div style="width:100%;float:left;border-bottom:1px solid red;"></div>
<div style="width:100%;float:left;border-bottom:1px solid yellow;padding-top:5px;"></div>
<br>
<div style="float:left;width:100%;padding:10px 0;">
  <div style="width:70%;float:left;text-align:left;">
    <p>
      <?php _e('Surname','school-mgt');?>
      :
      <?php echo get_user_meta($uid, 'last_name',true);?>
    </p>
    <p>
      <?php _e('First Name','school-mgt');?>
      : <?php echo get_user_meta($uid, 'first_name',true);?></p>
    <p>
      <?php _e('Class','school-mgt');?>
      :
      <?php $class_id=get_user_meta($uid, 'class_name',true);
											echo $classname=	get_class_name($class_id);
						?>
    </p>
    <p>
      <?php _e('Exam Name','school-mgt');?>
      :
      <?php echo get_exam_name_id($exam_id);?>
    </p>
  </div>
  <div style="float:right;width:30%;"> 
  <?php 
		if(empty($umetadata['meta_value']))
		{
			echo '<img src='.get_option( 'smgt_student_thumb' ).'  width="100" />';
		}
		else
			echo '<img src='.$umetadata['meta_value'].' width="100" />';
		?>
  
  </div>
</div>
<br>
<table style="float:left;width:100%;border:1px solid #000;">
  <thead>
    <tr style="border-bottom: 1px solid #000;">
      <th style="border-bottom: 1px solid #000;text-align:left;border-right: 1px solid #000;"><?php _e('S/No','school-mgt');?></th>
      <th style="border-bottom: 1px solid #000;text-align:left;border-right: 1px solid #000;"><?php _e('Subject','school-mgt')?></th>
      <th style="border-bottom: 1px solid #000;text-align:left;border-right: 1px solid #000;"><?php _e('Obtain Mark','school-mgt')?></th>
      <th style="border-bottom: 1px solid #000;text-align:left;border-right: 1px solid #000;"><?php _e('Grade','school-mgt')?></th>
    </tr>
  </thead>
  <tbody>
    <?php
	$i=1;
	foreach($subject as $sub)
	{ ?>
    <tr style="border-bottom: 1px solid #000;">
      <td style="border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $i;?></td>
      <td style="border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $sub->sub_name;?></td>
      <td style="border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $obj_mark->get_marks($exam_id,$class_id,$sub->subid,$uid);?> </td>
      <td style="border-bottom: 1px solid #000;border-right: 1px solid #000;"><?php echo $obj_mark->get_grade($exam_id,$class_id,$sub->subid,$uid);?></td>
    </tr>
    <?php
		$i++;
		$total +=  $obj_mark->get_marks($exam_id,$class_id,$sub->subid,$uid);
		$grade_point += $obj_mark->get_grade_point($exam_id,$class_id,$sub->subid,$uid);
	} ?>
  </tbody>
</table>
<p class="result_total">
  <?php _e("Total Marks","school-mgt");
    echo " : ".$total;?>
</p>
<p class="result_point">
  <?php	_e("GPA(grade point average)","school-mgt");
  $GPA=$grade_point/$total_subject;
    echo " : ".round($GPA, 2);	?>
</p>
<hr />
<?php
		
		$out_put = ob_get_contents();	
	
		
		
}
function print_init()
{
	if(isset($_REQUEST['print']) && $_REQUEST['print'] == 'print' && $_REQUEST['page'] != 'smgt_payment')
	{
	?>
<script>window.onload = function(){ window.print(); };</script>
<?php 
		$sudent_id = $_REQUEST['student'];
		downlosd_smgt_result_print($sudent_id);
		exit;
	}			
}
add_action('init','print_init');
function ajax_smgt_result_pdf()
{
	$obj_mark = new Marks_Manage();
	$uid = $_REQUEST['student_id'];
	
	$user =get_userdata( $uid );
	$user_meta =get_user_meta($uid);
	$class_id = $user_meta['class_name'][0];
	$subject = $obj_mark->student_subject($class_id);
	$exam_id =get_exam_id()->exam_id;
	$total = 0;
	$grade_point = 0;
	ob_start();
	?>
<div class="panel panel-white">
<form method="post">
  <input type="hidden" name="student_id" value = "<?php echo $uid;?>">
  <button id="pdf" type="button"><?php _e('PDF','school-mgt'); ?>  </button>
</form>
<p class="student_name">
  <?php _e('Result','school-mgt');?>
</p>
<div class="panel-heading clearfix">
  <h4 class="panel-title"><?php echo get_user_name_byid($uid);?></h4>
</div>
<div class="panel-body">
  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
        <th><?php _e('Subject','school-mgt');?></th>
        <th><?php _e('Obtain Mark','school-mgt');?></th>
        <th><?php _e('Grade','school-mgt');?></th>
        <th><?php _e('Attendance','school-mgt');?></th>
        <th><?php _e('Comment','school-mgt');?></th>
      </tr>
      <?php
		foreach($subject as $sub)
		{
		?>
      <tr>
        <td><?php echo $sub->sub_name;?></td>
        <td><?php echo $obj_mark->get_marks($exam_id,$class_id,$sub->subid,$uid);?> </td>
        <td><?php echo $obj_mark->get_grade($exam_id,$class_id,$sub->subid,$uid);?></td>
        <td><?php echo $obj_mark->get_attendance($exam_id,$class_id,$sub->subid,$uid);?></td>
        <td><?php echo $obj_mark->get_marks_comment($exam_id,$class_id,$sub->subid,$uid);?></td>
      </tr>
      <?php
		$total +=  $obj_mark->get_marks($exam_id,$class_id,$sub->subid,$uid);
		$grade_point += $obj_mark->get_grade_point($exam_id,$class_id,$sub->subid,$uid);
		}
		$GPA=$grade_point/$total_subject;?>
    </table>
  </div>
</div>
<hr />
<?php echo "GPA is".$GPA; ?>
<p class="result_total"><?php _e("Total Marks","school-mgt")."=>".$total;?></p>
<hr />
<p class="result_point">
  <?php _e("GPA(grade point average)","school-mgt") ."=> ".$grade_point;	?>
</p>
<hr />
<?php
	$out_put = ob_get_contents();
	ob_end_clean();
	require_once SMS_PLUGIN_DIR. '/lib/mpdf/mpdf.php';
	$mpdf		=	new mPDF( get_bloginfo( 'charset' ) );
	$mpdf		=	new mPDF('+aCJK');
	
	$mpdf->WriteHTML($out_put);
	$mpdf->Output('filename.pdf','F');
		
	unset( $out_put );
	unset( $mpdf );
	exit;
	
}
function smgt_load_user()
{
	$class_id =$_REQUEST['class_list'];
	global $wpdb;		
	$exlude_id = smgt_approve_student_list();
	$retrieve_data = get_users(array('meta_key' => 'class_name', 'meta_value' => $class_id,'role'=>'student','exclude'=>$exlude_id));
	//$retrieve_data = get_users(array('meta_key' => 'class_name', 'meta_value' => $class_id,'role'=>'student'));	
	$defaultmsg=__( 'Select student' , 'school-mgt');
	echo "<option value=''>".$defaultmsg."</option>";	
	foreach($retrieve_data as $users)
	{
		echo "<option value=".$users->id.">".$users->first_name." ".$users->last_name."</option>";
	}
	die();		
}

function smgt_load_section_user()
{		
	$section_id =$_POST['section_id'];	
	
	global $wpdb;	
	$exlude_id = smgt_approve_student_list();
	$retrieve_data = get_users(array('meta_key' => 'class_section', 'meta_value' => $section_id,'role'=>'student','exclude'=>$exlude_id));
	$defaultmsg=__( 'Select student' , 'school-mgt');
	echo "<option value=''>".$defaultmsg."</option>";	
	foreach($retrieve_data as $users)
	{
		echo "<option value=".$users->id.">".$users->first_name." ".$users->last_name."</option>";
	}
	die();		
}

function smgt_load_class_section()
{
		
		echo  $class_id =$_POST['class_id'];
		global $wpdb;
		$retrieve_data=smgt_get_class_sections($_POST['class_id']);
		$defaultmsg=__( 'Select Class Section' , 'school-mgt');
		echo "<option value=''>".$defaultmsg."</option>";	
		foreach($retrieve_data as $section)
		{
			echo "<option value='".$section->id."'>".$section->section_name."</option>";
		}
		die();
		
}
function smgt_teacher_by_subject($subject_id){
	global $wpdb;
	$teacher_rows = array();	
	if(isset($subject_id->subid))
	{
		$subid = (int)$subject_id->subid;	
		$table_smgt_subject = $wpdb->prefix. 'teacher_subject';	
		$result = $wpdb->get_results("SELECT * FROM $table_smgt_subject where subject_id = $subid");
		
		foreach($result as $tch_result)
		{
			$teacher_rows[] = $tch_result->teacher_id;
		}
	}
	return $teacher_rows;
	die();
}
function smgt_class_by_teacher(){
	
	
	$teacher_id = $_REQUEST['teacher_id'];
	$teacher_obj = new Smgt_Teacher;
	$classes = $teacher_obj->smgt_get_class_by_teacher($teacher_id);
	
	foreach($classes as $class)
	{
		$classdata = get_class_by_id($class['class_id']);
		echo "<option value={$class['class_id']}>{$classdata->class_name}</option>";
	}
	wp_die();
}
function smgt_teacher_by_class()
{
	$class_id = $_REQUEST['class_id'];
	$teacher_obj = new Smgt_Teacher;
	$classes = $teacher_obj->get_class_teacher($class_id);

	foreach($classes as $class)
	{
		
		echo "<option value={$class['teacher_id']}>".get_user_name_byid($class['teacher_id'])."</option>";
	}
	wp_die();
}
function smgt_load_books()
{
	$cat_id =$_POST['bookcat_id'];
	global $wpdb;
	$table_book=$wpdb->prefix.'smgt_library_book';
	//print "SELECT * FROM $table_book where cat_id=".$cat_id ."AND quentity !=". 0; die;
	$retrieve_data=$wpdb->get_results(" SELECT * FROM $table_book where cat_id=$cat_id AND quentity !=". 0);
	//$defaultmsg=__( 'Select Book' , 'school-mgt');
	//echo "<option value=''>".$defaultmsg."</option>";	
	foreach($retrieve_data as $book)
	{
		echo "<option value=".$book->id.">".stripslashes($book->book_name)."</option>";
	}
	die();
}

function smgt_load_class_fee_type()
{
	$class_list = $_POST['class_list'];
	global $wpdb;
	$table_smgt_fees = $wpdb->prefix. 'smgt_fees';	
	$result = $wpdb->get_results("SELECT * FROM $table_smgt_fees where class_id = $class_list");
	$defaultmsg=__( 'Select Fee Type' , 'school-mgt');
		echo "<option value=' '>".$defaultmsg."</option>";
	if(!empty($result))
	{
		foreach($result as $retrive_data)
		{
			echo '<option value="'.$retrive_data->fees_id.'">'.get_the_title($retrive_data->fees_title_id).'</option>';
		}
	}
	else
		return false;
	die();
}
function smgt_load_section_fee_type()
{
	$section_id = $_POST['section_id'];
	global $wpdb;
	$table_smgt_fees = $wpdb->prefix. 'smgt_fees';	
	$result = $wpdb->get_results("SELECT * FROM $table_smgt_fees where section_id = $section_id");
	$defaultmsg=__( 'Select Fee Type' , 'school-mgt');
		echo "<option value=' '>".$defaultmsg."</option>";
	if(!empty($result))
	{
		foreach($result as $retrive_data)
		{
			echo '<option value="'.$retrive_data->fees_id.'">'.get_the_title($retrive_data->fees_title_id).'</option>';
		}
	}
	else
		return false;
	die();
}
function smgt_load_fee_type_amount()
{
	$fees_id = $_POST['fees_id'];
	global $wpdb;
	$table_smgt_fees = $wpdb->prefix. 'smgt_fees';	
	$result = $wpdb->get_row("SELECT * FROM $table_smgt_fees where fees_id = $fees_id");
	echo $result->fees_amount;
	die();
}
function smgt_view_parent()
{
	$user_meta =get_user_meta($_REQUEST['student_id'], 'parent_id', true); 
?>
<div class="modal-header"> <a href="#" class="close-btn badge badge-success pull-right">X</a>
  <h4 id="myLargeModalLabel" class="modal-title"><i class="fa fa-user"></i> <?php _e('Parents','school-mgt');?></h4>
</div>
<hr />
<div class="panel-body">
	
	  <p class="student_name"><?php _e('Student Name:','school-mgt');?> <?php echo get_user_meta($_REQUEST['student_id'], 'first_name', true);?></p>
	  <?php if($user_meta)
		{ ?>
	<div class="table-responsive">
	  <table class="table table-bordered" border="1">
		<tr>
		  <th><?php _e('Photo','school-mgt');?></th>
		  <th><?php _e('Name','school-mgt');?></th>
		  <th> <?php _e('Relation','school-mgt');?></th>
		</tr>
		<?php	
			foreach($user_meta as $parentsdata)
			{
				$parent=get_userdata($parentsdata);?>
		<tr>
		  <td><?php 
			if($parentsdata)
			{
				$umetadata=get_user_image($parentsdata);
			}
			if(empty($umetadata['meta_value']))
			{
				echo '<img src='.get_option( 'smgt_parent_thumb' ).' height="50px" width="50px" class="img-circle" />';
			}
			else
				echo '<img src='.$umetadata['meta_value'].' height="50px" width="50px" class="img-circle"/>';?></td>
		  <td><?php echo $parent->first_name." ".$parent->last_name;?></td>
		  <td><?php if($parent->relation=='Father'){ echo __('Father','school-mgt'); }elseif($parent->relation=='Mother'){ echo __('Mother','school-mgt');} ?></td>
		</tr>
			<?php } ?>
	</table>
		<?php 
		}
		else 
		{
				_e('No Parents','school-mgt');
		}
		if(count($user_meta) >= 2)
		{
			 count($user_meta);
		}
		?>
	</div>
</div>
<hr />
<?php
	exit;
}

function ajax_smgt_view_notice()
{
	 $notice = get_post($_REQUEST['notice_id']);
	 ?>
<div class="form-group"> <a class="close-btn badge badge-success pull-right" href="#">X</a>
  <h4 class="modal-title" id="myLargeModalLabel">
    <?php _e('Notice Detail','school-mgt'); ?>
  </h4>
</div>
<hr>
<div class="panel panel-white form-horizontal view_notice_overflow">
  <div class="form-group">
    <label class="col-sm-3" for="notice_title">
    <?php _e('Notice Title','school-mgt');?>
    : </label>
    <div class="col-sm-9"> <?php echo $notice->post_title;?> </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3" for="notice_title">
    <?php _e('Notice Comment','school-mgt');?>
    : </label>
    <div class="col-sm-9"> <?php echo $notice->post_content;?> </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3" for="notice_title">
    <?php _e('Notice For','school-mgt');?>
    : </label>
    <div class="col-sm-9"> <?php echo get_post_meta( $notice->ID, 'notice_for',true);?> </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3" for="notice_title">
    <?php _e('Start Date','school-mgt');?>
    : </label>
    <div class="col-sm-9"> <?php echo smgt_getdate_in_input_box(get_post_meta( $notice->ID, 'start_date',true));?> </div>
  </div>
  <div class="form-group">
    <label class="col-sm-3" for="notice_title">
    <?php _e('End Date','school-mgt');?>
    : </label>
    <div class="col-sm-9"> <?php echo smgt_getdate_in_input_box(get_post_meta( $notice->ID, 'end_date',true));?> </div>
  </div>
</div>
<?php 
	die();
}

function inventory_image_upload($file) {

$type = "subject_syllabus";
$imagepath =$file;
     
$parts = pathinfo($_FILES[$type]['name']);
 $inventoryimagename = mktime()."-"."in".".".$parts['extension'];
 $document_dir = WP_CONTENT_DIR ;
           $document_dir .= '/uploads/school_assets/';
	
		$document_path = $document_dir;

 
if($imagepath != "")
{	
	if(file_exists(WP_CONTENT_DIR.$imagepath))
	unlink(WP_CONTENT_DIR.$imagepath);
}
if (!file_exists($document_path)) {
	mkdir($document_path, 0777, true);
}	
       if (move_uploaded_file($_FILES[$type]['tmp_name'], $document_path.$inventoryimagename)) {
          $imagepath= $inventoryimagename;	
       }


return $imagepath;

}
function smgt_user_avatar_image_upload($type) {


$imagepath =$file;
     
$parts = pathinfo($_FILES[$type]['name']);


 $inventoryimagename = mktime()."-"."student".".".$parts['extension'];
 $document_dir = WP_CONTENT_DIR ;
           $document_dir .= '/uploads/school_assets/';
	
		$document_path = $document_dir;

 
if($imagepath != "")
{	
	if(file_exists(WP_CONTENT_DIR.$imagepath))
	unlink(WP_CONTENT_DIR.$imagepath);
}
if (!file_exists($document_path)) {
	mkdir($document_path, 0777, true);
}	
       if (move_uploaded_file($_FILES[$type]['tmp_name'], $document_path.$inventoryimagename)) {
          $imagepath= $inventoryimagename;	
       }


return $imagepath;

}
function smgt_register_post()
{
	register_post_type( 'message', array(
	
			'labels' => array(
	
					'name' => __( 'Message', 'school-mgt' ),
	
					'singular_name' => 'message'),
	
			'rewrite' => false,
	
			'query_var' => false ) );
	
}
function smgt_sms_service_setting()
{
	
	$select_serveice = $_POST['select_serveice'];
	
	if($select_serveice == 'clickatell')
	{
	$clickatell=get_option( 'smgt_clickatell_sms_service');
			?>
		<div class="form-group">
			<label class="col-sm-2 control-label " for="username"><?php _e('Username','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="username" class="form-control validate[required]" type="text" value="<?php if(isset($clickatell['username'])) echo $clickatell['username'];?>" name="username">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label " for="password"><?php _e('Password','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="password" class="form-control validate[required]" type="text" value="<?php if(isset($clickatell['password'])) echo $clickatell['password'];?>" name="password">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label " for="api_key"><?php _e('API Key','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="api_key" class="form-control validate[required]" type="text" value="<?php if(isset($clickatell['api_key'])) echo $clickatell['api_key'];?>" name="api_key">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label " for="sender_id"><?php _e('Sender Id','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="sender_id" class="form-control validate[required]" type="text" value="<?php echo $clickatell['sender_id'];?>" name="sender_id">
			</div>
		</div>
	<?php 
	}
	
	if($select_serveice == 'twillo')
	{
	$twillo=get_option( 'smgt_twillo_sms_service');
			?>
			<div class="form-group">
			<label class="col-sm-2 control-label " for="account_sid"><?php _e('Account SID','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="account_sid" class="form-control validate[required]" type="text" value="<?php if(isset($twillo['account_sid'])) echo $twillo['account_sid'];?>" name="account_sid">
			</div>
		</div>
	<div class="form-group">
			<label class="col-sm-2 control-label" for="auth_token"><?php _e('Auth Token','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="auth_token" class="form-control validate[required] text-input" type="text" name="auth_token" value="<?php if(isset($twillo['auth_token'])) echo $twillo['auth_token'];?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label" for="from_number"><?php _e('From Number','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="from_number" class="form-control validate[required] text-input" type="text" name="from_number" value="<?php if(isset($twillo['from_number'])) echo $twillo['from_number'];?>">
			</div>
		</div>
		
	<?php }
	
	die();
}

function smgt_student_invoice_view()
{
	$obj_invoice= new Smgtinvoice();
	if($_POST['invoice_type']=='invoice')
	{
		$invoice_data=get_payment_by_id($_POST['idtest']);
	}
	if($_POST['invoice_type']=='income'){
		$income_data=$obj_invoice->smgt_get_income_data($_POST['idtest']);
	}
	if($_POST['invoice_type']=='expense'){
		$expense_data=$obj_invoice->smgt_get_income_data($_POST['idtest']);	
	} ?>
	<div class="modal-header">
			<a href="#" class="close-btn-cat badge badge-success pull-right">X</a>
			<h4 class="modal-title"><?php echo get_option('smgt_school_name');?></h4>
	</div>
	<div class="modal-body" style="height:520px; overflow:hidden;">
		<div id="invoice_print"> 
			<table width="100%" border="0">
				<tbody>
							<tr>
								<td width="50%">
									<img style="max-height:80px;" src="<?php echo get_option( 'smgt_school_logo' ); ?>">
								</td>
								<td align="right" width="24%">
									<h4><?php
									if(!empty($invoice_data)){
										//$invoice_no=$invoice_data->invoice_number;
										//_e('Invoice number','school-mgt');
										//echo " : ".$invoice_no;
										}
									?> </h4>
									<h5>
										<?php $issue_date='DD-MM-YYYY';
											if(!empty($income_data)){
												$issue_date=$income_data->income_create_date;
												$payment_status=$income_data->payment_status;}
											if(!empty($invoice_data)){
												$issue_date=$invoice_data->date;
												$payment_status=$invoice_data->payment_status;	}
											if(!empty($expense_data)){
												$issue_date=$expense_data->income_create_date;
												$payment_status=$expense_data->payment_status;}
								
									echo __('Issue Date','school-mgt')." : ".smgt_getdate_in_input_box(date("Y-m-d", strtotime($issue_date)));?></h5>
									<h5><?php 
										if($payment_status=='Paid') 
										{ echo __('Status','school-mgt')." : ".__('Paid','school-mgt');}
										if($payment_status=='Part Paid')
										{ echo __('Status','school-mgt')." : ".__('Partially Paid','school-mgt');}
										if($payment_status=='Unpaid')
										{echo __('Status','school-mgt')." : ".__('Unpaid','school-mgt'); } ?></h5>
								</td>
							</tr>
						</tbody>
					</table>
					<hr>
					<table width="100%" border="0">
						<tbody>
							<tr>
								<td class="col-md-6 padding_payment">
								
									<h4><?php if($_POST['invoice_type']=='expense'){ _e('Payment From','school-mgt'); }else { _e('Payment From','school-mgt'); }?> </h4>
								</td>
								<td class="col-md-6 padding_payment pull-right" style="text-align:right;">
									<h4><?php _e('Bill To','school-mgt');?> </h4>
								</td>
							</tr>
							<tr>
								<td valign="top" class="col-md-6 padding_payment">
									<?php echo get_option( 'smgt_school_name' )."<br>"; 
									 echo get_option( 'smgt_school_address' ).","; 
									 echo get_option( 'smgt_contry' )."<br>"; 
									 echo get_option( 'smgt_contact_number' )."<br>"; ?>
								</td>
								<td valign="top" class="col-md-6 padding_payment pull-right" style="text-align:right;">
									<?php 
									if(!empty($expense_data)){
									echo $party_name=$expense_data->supplier_name; 
									}
									else
									{
										if(!empty($income_data))
											$student_id=$income_data->supplier_name;
										 if(!empty($invoice_data))
											$student_id=$invoice_data->student_id;
										
										
										
										$patient=get_userdata($student_id);
												
										echo $patient->display_name."<br>"; 
										 echo get_user_meta( $student_id,'address',true ).","; 
										 echo get_user_meta( $student_id,'city_name',true ).","; 
										 echo get_user_meta( $student_id,'zip_code',true ).","; 
										 echo get_user_meta( $student_id,'country_name',true )."<br>"; 
										 echo get_user_meta( $student_id,'mobile',true )."<br>"; 
									}
									?>
								</td>
							</tr>
						</tbody>
					</table>
					<hr>
					<h4><?php _e('Invoice Entries','school-mgt');?></h4>
					<div class="table-responsive">
						<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center"> <?php _e('Date','school-mgt');?></th>
									<th width="60%"><?php _e('Entry','school-mgt');?> </th>
									<th><?php _e('Price','school-mgt');?></th>
									<th class="text-center"> <?php _e('Issue By','school-mgt');?> </th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$id=1;
								$total_amount=0;
								if(!empty($income_data) || !empty($expense_data)){
									if(!empty($expense_data))
										$income_data=$expense_data;
								
								$patient_all_income=$obj_invoice->get_onepatient_income_data($income_data->supplier_name);
								
								foreach($patient_all_income as $result_income){
									$income_entries=json_decode($result_income->entry);
									foreach($income_entries as $each_entry)
									{
										$total_amount+=$each_entry->amount;								
								?>
								<tr>
									<td class="text-center"><?php echo $id;?></td>
									<td class="text-center"><?php echo $result_income->income_create_date;?></td>
									<td><?php echo $each_entry->entry; ?> </td>
									<td class="text-right"> <?php echo "<span> ". get_currency_symbol() ."</span>" .number_format($each_entry->amount,2) ; ?></td>
									<td class="text-center"><?php echo get_display_name($result_income->create_by);?></td>
								</tr>
									<?php $id+=1;}
									}
							 
							}
							 if(!empty($invoice_data)){
								 $total_amount=$invoice_data->amount
								 ?>
								<tr>
									<td class="text-center"><?php echo $id;?></td>
									<td class="text-center"><?php echo date("Y-m-d", strtotime($invoice_data->date));?></td>
									<td><?php echo $invoice_data->payment_title; ?> </td>
									<td class="text-right"> <?php echo "<span> ". get_currency_symbol() ." </span>" .number_format($invoice_data->amount,2); ?></td>
									<td class="text-center"><?php echo get_display_name($invoice_data->payment_reciever_id);?></td>
								</tr>
								<?php }?>
							</tbody>
						</table>
					</div>
					<table width="100%" border="0">
						<tbody>							
							<?php if(!empty($invoice_data))
							{								
								/* $grand_total= $invoice_data->entry;							 */
								$grand_total= $total_amount;							
							}
							if(!empty($income_data))
							{
								$grand_total=$total_amount;
							}
							?>								
							<tr>
								<td width="80%" align="right"><?php _e('Grand Total :','school-mgt');?></td>
								<td align="right"><h4><?php echo "<span> ". get_currency_symbol() ." </span>" .number_format($grand_total,2); ?></h4></td>
							</tr>
						</tbody>
					</table>
		</div>
		<div class="print-button pull-left">
			<a  href="?page=smgt_payment&print=print&invoice_id=<?php echo $_POST['idtest'];?>&invoice_type=<?php echo $_POST['invoice_type'];?>" target="_blank"class="btn btn-success"><?php _e('Print','school-mgt');?></a>
			&nbsp;&nbsp;&nbsp;
			<a  href="?page=smgt_payment&print=pdf&invoice_id=<?php echo $_POST['idtest'];?>&invoice_type=<?php echo $_POST['invoice_type'];?>" target="_blank"class="btn btn-success"><?php _e('PDF','school-mgt');?></a>
		</div>
	</div>
	<?php 
	 die();
}
function smgt_student_add_payment()
{
	$fees_pay_id = $_POST['idtest'];
	$due_amount = $_POST['due_amount'];
	$max_due_amount = str_replace(",", "", $_POST['due_amount']);
?>
		<script type="text/javascript">
$(document).ready(function() {
	$('#expense_form').validationEngine({promptPosition : "bottomRight",maxErrorsPerField: 1});	
} );
</script>
	<div class="modal-header">
			<a href="#" class="close-btn-cat badge badge-success pull-right">X</a>
			<h4 class="modal-title"><?php echo get_option('smgt_school_name');?></h4>
	</div>
	<div class="modal-body">
		 <form name="expense_form" action="" method="post" class="form-horizontal" id="expense_form">
         <?php $action = isset($_REQUEST['action'])?$_REQUEST['action']:'insert';?>
		<input type="hidden" name="action" value="<?php echo $action;?>">
		<input type="hidden" name="fees_pay_id" value="<?php echo $fees_pay_id;?>">
		<div class="form-group">
			<label class="col-sm-3 control-label" for="amount"><?php _e('Paid Amount','school-mgt');?>(<?php echo get_currency_symbol();?>)<span class="require-field">*</span></label>
			<div class="col-sm-8">
				<input id="amount" class="form-control validate[required,min[0],max[<?php echo $max_due_amount; ?>],maxSize[10]] text-input" type="number" step="0.01" value="<?php echo $max_due_amount; ?>" name="amount">
			</div>
		</div>	
		<div class="form-group">
			<input type="hidden" name="payment_status" value="paid">
			<label class="col-sm-3 control-label" for="payment_method"><?php _e('Payment By','school-mgt');?><span class="require-field">*</span></label>
			<div class="col-sm-8">
			<?php global $current_user;
		$user_roles = $current_user->roles;
		$user_role = array_shift($user_roles);?>
				<select name="payment_method" id="payment_method" class="form-control">
				<?php if($user_role != 'parent'){?>
					<option value="Cash"><?php _e('Cash','school-mgt');?></option>
					<option value="Cheque"><?php _e('Cheque','school-mgt');?></option>
					<option value="Bank Transfer"><?php _e('Bank Transfer','school-mgt');?></option>
					<?php } else {?>
					<option value="Paypal"><?php _e('Paypal','school-mgt');?></option>
					<?php } ?>						
				</select>
			</div>
		</div>
		<div class="col-sm-offset-2 col-sm-8">
        	 <input type="submit" value="<?php _e('Add Payment','school-mgt');?>" name="add_feetype_payment" class="btn btn-success"/>
        </div>
		</form>
	</div>
<?php
	die();
}

function smgt_student_view_paymenthistory()
{ ?>
	<script type="text/javascript">

 function PrintElem(elem)
{
Popup($(elem).html());
}

   function Popup(data) 
   {
var mywindow = window.open('', 'my div', 'height=500,width=700');
       mywindow.document.write('<html><head><title></title>');
		mywindow.document.write("<link rel='stylesheet' href='<?php echo $path;?>' type='text/css' />");

       mywindow.document.write('</head><body >');
       mywindow.document.write(data);
       mywindow.document.write('</body></html>');

       mywindow.document.close(); // necessary for IE >= 10
       mywindow.focus(); // necessary for IE >= 10

       mywindow.print();
       mywindow.close();

       return true;
   }


</script>
<?php
	$fees_pay_id = $_REQUEST['idtest'];
	$fees_detail_result = get_single_fees_payment_record($fees_pay_id);
	$fees_history_detail_result = get_payment_history_by_feespayid($fees_pay_id);
?>
<div class="modal-header">				
	<a href="#" class="close-btn-cat badge badge-success pull-right">X</a>
	<h4 class="modal-title"><?php echo get_option('smgt_school_name');?></h4>
</div>	
<div class="modal-body">	
	<div id="invoice_print" class="print-box" width="100%"> 
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="70%">
						<img style="max-height:80px;" src="<?php echo get_option( 'smgt_school_logo' ); ?>">
					</td>
					<td align="right" width="24%">
						<h5><?php $issue_date='DD-MM-YYYY';
							$issue_date=$fees_detail_result->paid_by_date;						
							echo __('Issue Date','school-mgt')." : ". smgt_getdate_in_input_box(date("Y-m-d", strtotime($issue_date)));?></h5>						
							<h5><?php echo __('Status','school-mgt')." : "; echo "<span class='btn btn-success btn-xs'>";
							$payment_status = get_payment_status($fees_detail_result->fees_pay_id);					
								if($payment_status=='Paid') 
									echo __('Paid','school-mgt');
								if($payment_status=='Partially Paid')
									echo __('Part Paid','school-mgt');
								if($payment_status=='Unpaid')
									echo __('Unpaid','school-mgt');		
							echo "</span>";?></h5>	
					</td>
				</tr>
			</tbody>
		</table>
		<hr>
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td class="col-md-6">
						<h4><?php _e('Payment From','school-mgt');?> </h4>
					</td>
					<td class="col-md-6 pull-right" style="text-align: right;">
						<h4><?php _e('Bill To','school-mgt');?> </h4>
					</td>
				</tr>
				<tr>
					<td valign="top"class="col-md-6">
						<?php echo get_option( 'smgt_school_name' )."<br>"; 
						 echo get_option( 'smgt_school_address' ).","; 
						 echo get_option( 'smgt_contry' )."<br>"; 
						 echo get_option( 'smgt_contact_number' )."<br>"; 
						?>
						
					</td>
					<td valign="top" class="col-md-6 pull-right" style="text-align: right;">
						<?php
						$student_id=$fees_detail_result->student_id;						
						$patient=get_userdata($student_id);									
						 echo $patient->display_name."<br>"; 
						 echo get_user_meta( $student_id,'address',true ).","; 
						 echo get_user_meta( $student_id,'city',true ).","; 
						 echo get_user_meta( $student_id,'zip_code',true ).",<BR>"; 
						 echo get_user_meta( $student_id,'state',true ).","; 
						 echo get_option( 'smgt_contry' ).","; 
						 echo get_user_meta( $student_id,'mobile',true )."<br>"; 						
						?>
					</td>
				</tr>
			</tbody>
		</table>
		<hr>
		<div class="table-responsive">
			<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th class="text-center"> <?php _e('Fees Type','school-mgt');?></th>
						<th><?php _e('Total','school-mgt');?> </th>					
					</tr>
				</thead>
				<tbody>
					<td>1</td>
					<td><?php echo get_fees_term_name($fees_detail_result->fees_id);?></td>
					<td><?php echo "<span> ". get_currency_symbol() ." </span>" . number_format($fees_detail_result->total_amount,2); ?></td>
				</tbody>
			</table>
		</div>
		<table width="100%" border="0">
			<tbody>							
				<tr>
					<td  align="right"><?php _e('Sub Total :','school-mgt');?></td>
					<td align="right"><?php echo get_currency_symbol().number_format($fees_detail_result->total_amount,2); ?></td>
				</tr>
				<tr>
					<td width="80%" align="right"><?php _e('Payment Made :','school-mgt');?></td>
					<td align="right"><?php echo get_currency_symbol().number_format($fees_detail_result->fees_paid_amount,2);?></td>
				</tr>
				<tr>
					<td width="80%" align="right"><?php _e('Due Amount  :','school-mgt');?></td>
					<?php $Due_amount = $fees_detail_result->total_amount - $fees_detail_result->fees_paid_amount; ?>
					<td align="right"><?php echo get_currency_symbol().number_format($Due_amount,2); ?></td>
				</tr>				
			</tbody>
		</table>
		<hr>
		<?php if(!empty($fees_history_detail_result))
		{ ?>
		<h4><?php _e('Payment History','school-mgt');?></h4>
		<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
			<thead>
				<tr>
					<th class="text-center"><?php _e('Date','school-mgt');?></th>
					<th class="text-center"> <?php _e('Amount','school-mgt');?></th>
					<th><?php _e('Method','school-mgt');?> </th>
					
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach($fees_history_detail_result as  $retrive_date)
				{
				?>
				<tr>
					<td><?php echo smgt_getdate_in_input_box($retrive_date->paid_by_date);?></td>
					<td><?php echo number_format($retrive_date->amount,2);?></td>
					<td><?php echo $retrive_date->payment_method;?></td>
				</tr>
				<?php }?>
			</tbody>
		</table>
		<?php } ?>
	</div>
	<div class="print-button pull-left">
		<a  href="#" onclick="PrintElem('.print-box')" target="_blank" class="btn btn-success"><?php _e('Print','school-mgt');?></a>
		&nbsp;&nbsp;&nbsp;
		<a href="?page=smgt_fees_payment&print=pdf&payment_id=<?php echo $_POST['idtest'];?>&fee_paymenthistory=<?php echo "fee_paymenthistory";?>" target="_blank"class="btn btn-success"><?php _e('PDF','school-mgt');?></a>
	</div>		
</div>
<?php
die();
}
function smgt_student_paymenthistory_pdf($id)
{ 
	$fees_pay_id = $id;
	$fees_detail_result = get_single_fees_payment_record($fees_pay_id);	
	$fees_history_detail_result = get_payment_history_by_feespayid($fees_pay_id);
	?>
	<div class="modal-body">
		<div id="invoice_print" style="width: 90%;margin:0 auto;"> 
		<div class="modal-header">
			<h4 class="modal-title"><?php echo get_option('smgt_school_name');?></h4>
		</div>	
	
		<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="70%">
					
						<img style="max-height:80px;" src="<?php echo get_option( 'smgt_school_logo' ); ?>">
					</td>
					<td align="right" width="24%">
						<h5><?php $issue_date='DD-MM-YYYY';
								$issue_date=$fees_detail_result->paid_by_date;									
								echo __('Issue Date','school-mgt')." : ". smgt_getdate_in_input_box(date("Y-m-d", strtotime($issue_date)));?></h5>
									
						<h5><?php echo __('Status','school-mgt')." : "; 
							echo "<span class='btn btn-success btn-xs'>";
							$payment_status = get_payment_status($fees_detail_result->fees_pay_id);
								if($payment_status=='Paid') 
									echo __('Paid','school-mgt');
								if($payment_status=='Partially Paid')
									echo __('Part Paid','school-mgt');
								if($payment_status=='Unpaid')
									echo __('Unpaid','school-mgt');	
							echo "</span>";?>
						</h5>
					</td>
				</tr>
			</tbody>
		</table>
		<hr>
		<table width="100%" border="0">
		<tbody>
			<tr>
				<td align="left">
					<h4><?php _e('Payment From1','school-mgt');?> </h4>
				</td>
				<td align="right">
					<h4><?php _e('Bill To','school-mgt');?> </h4>
				</td>
			</tr>
			<tr>
				<td valign="top" align="left">
					<?php
						echo get_option( 'smgt_school_name' )."<br>"; 
						echo get_option( 'smgt_school_address' ).","; 
						echo get_option( 'smgt_contry' )."<br>"; 
						echo get_option( 'smgt_contact_number' )."<br>"; 
					?>
				</td>
				<td valign="top" align="right">
					<?php
						$student_id=$fees_detail_result->student_id;						
						$patient=get_userdata($student_id);
						echo $patient->display_name."<br>"; 
						echo get_user_meta( $student_id,'address',true ).","; 
						echo get_user_meta( $student_id,'city',true ).","; 
						echo get_user_meta( $student_id,'zip_code',true ).",<BR>"; 
						echo get_user_meta( $student_id,'state',true ).","; 
						echo get_option( 'smgt_contry' ).","; 
						echo get_user_meta( $student_id,'mobile',true )."<br>"; 
					?>
				</td>
			</tr>
		</tbody>
	</table>
	<hr>
	<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
		<thead>
			<tr>
				<th class="text-center">#</th>
				<th class="text-center"> <?php _e('Fees Type','school-mgt');?></th>
				<th><?php _e('Total','school-mgt');?> </th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>1</td>
				<td><?php echo get_fees_term_name($fees_detail_result->fees_id);?></td>
				<td><?php echo "<span> ". get_currency_symbol() ." </span>" .number_format($fees_detail_result->total_amount,2); ?></td>
			</tr>
		</tbody>
	</table>
	<table width="100%" border="0">
		<tbody>
			<tr>
				<td width="80%" align="right"><?php _e('Sub Total :','school-mgt');?></td>
				<td align="right"><?php echo "<span> ". get_currency_symbol() ." </span>" .number_format($fees_detail_result->total_amount,2); ?></td>
			</tr>
			<tr>
				<td width="80%" align="right"><?php _e('Payment Made :','school-mgt');?></td>
				<td align="right"><?php echo "<span> ". get_currency_symbol() ." </span>" . number_format($fees_detail_result->fees_paid_amount,2) ;?></td>
			</tr>
			<tr>
				<td width="80%" align="right"><?php _e('Due Amount  :','school-mgt');?></td>
				<?php $Due_amount = $fees_detail_result->total_amount - $fees_detail_result->fees_paid_amount;?>
				<td align="right"><?php echo "<span> ". get_currency_symbol() ." </span>" . number_format($Due_amount,2) ?></td>
			</tr>
		</tbody>
	</table>
	<hr>
	<?php if(!empty($fees_history_detail_result)){ ?>
		<h4><?php _e('Payment History','school-mgt');?></h4>
		<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
			<thead>
				<tr>
					<th class="text-center"><?php _e('Date','school-mgt');?></th>
					<th class="text-center"> <?php _e('Amount','school-mgt');?></th>
					<th><?php _e('Method','school-mgt');?> </th>				
				</tr>
			</thead>
			<tbody>
				<?php 
				foreach($fees_history_detail_result as  $retrive_date)
				{
				?>
				<tr>
					<td><?php echo $retrive_date->paid_by_date;?></td>
					<td><?php echo number_format($retrive_date->amount,2);?></td>
					<td><?php echo $retrive_date->payment_method;?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	<?php } ?>
	</div>
	
	</div>
	<?php 
	//die();
}
function smgt_student_view_librarryhistory()
{
	?>
	
	<?php $student_id = $_REQUEST['student_id'];
	$booklist = get_student_lib_booklist($student_id);
	$student=get_userdata($student_id);
	?>
	<div class="modal-header">
			<a href="#" class="close-btn-cat badge badge-success pull-right">X</a>
			<h4 class="modal-title"><?php _e('Student Library History','school-mgt');?></h4>
	</div>
	<div class="modal-body">
	<div id="invoice_print"> 
	
		
					<?php if(!empty($booklist))
					{ ?>
					<h4><?php echo $student->display_name; ?></h4>
					<hr>
					<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
					<thead>
							<tr>
								<th class="text-center"><?php _e('Book name','school-mgt');?></th>
								<th class="text-center"> <?php _e('Issue Date','school-mgt');?></th>
								<th class="text-center"> <?php _e('Return Date','school-mgt');?></th>
								<th><?php _e('Period','school-mgt');?> </th>
								<th><?php _e('Overdue By','school-mgt');?> </th>
								<th><?php _e('Fine','school-mgt');?> </th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
							foreach($booklist as  $retrieved_data)
							{
							?>
							<tr>
							<td><?php echo stripslashes(get_bookname($retrieved_data->book_id));?></td>
							<td><?php echo $retrieved_data->issue_date;?></td>
							<td><?php echo $retrieved_data->end_date;?></td>
							<td><?php echo get_the_title($retrieved_data->period).__(" Days","school-mgt");?></td>
							<?php 
							/*$date2=date_create(date("Y-m-d", strtotime($retrieved_data->end_date)));
							$date3=date_create(date("Y-m-d", strtotime($retrieved_data->actual_return_date)));
							$date1=date_create(date("Y-m-d", strtotime($retrieved_data->actual_return_date)));
							$diff=date_diff($date1,$date2);*/
							
							$date1=date_create(date('Y-m-d'));
							$date2=date_create(date("Y-m-d", strtotime($retrieved_data->end_date)));
							$diff=date_diff($date2,$date1);							
							
						?>
							<td><?php 
							if($retrieved_data->actual_return_date=='' && $date1 < $date2)
							{ 
								/* echo __("No Returned","school-mgt"); */
								echo __("0 Days","school-mgt");
							}
							elseif ($date2 > $date3 && $retrieved_data->actual_return_date!='')
							{
								echo __("0 Days","school-mgt"); 
							}
							/* elseif($date3 > $date2) */
							elseif($date1 > $date2)
							{ 
								echo $diff->format("%a").__(" Days","school-mgt"); 
							}?></td>
							<td><?php echo  ($retrieved_data->fine != "" || $retrieved_data->fine != 0) ? get_currency_symbol().$retrieved_data->fine : "NA";?></td>
							</tr>
							<?php }?>
						</tbody>
					</table>
					<?php }?>
	</div>
	</div>
	<?php
	die();
}
function get_student_lib_booklist($id)
{
	global $wpdb;
	$table_name = $wpdb->prefix . 'smgt_library_book_issue';
	$results=$wpdb->get_results("select *from $table_name where student_id=$id");
	return $results;
}
function smgt_add_remove_feetype()
{
	$model = $_REQUEST['model'];
	$class_id = $_REQUEST['class_id'];
	smgt_add_category_type($model,$class_id);
}
function smgt_add_category_type($model,$class_id) 
{
	$title = "Title here";
	$table_header_title ="Table head";
	$button_text= "Button Text"; 
	$label_text = "Label Text";
	if($model == 'feetype')
	{
		$obj_fees = new Smgt_fees();
		$cat_result = $obj_fees->get_all_feetype();
		$title = __("Fee type",'school-mgt');
		$table_header_title =  __("Fee Type",'school-mgt');
		$button_text=  __("Add Fee Type",'school-mgt');
		$label_text =  __("Fee Type",'school-mgt');
	}
	if($model == 'book_cat')
	{
		$obj_lib = new Smgtlibrary();
		$cat_result = $obj_lib->smgt_get_bookcat();
		$title = __("Category",'school-mgt');
		$table_header_title =  __("Category Name",'school-mgt');
		$button_text=  __("Add Category",'school-mgt');
		$label_text =  __("Category Name",'school-mgt');
	}
	if($model == 'rack_type')
	{
		$obj_lib = new Smgtlibrary();
		$cat_result = $obj_lib->smgt_get_racklist();
		$title = __("Rack Location",'school-mgt');
		$table_header_title =  __("Rack Location Name",'school-mgt');
		$button_text=  __("Add Rack Location",'school-mgt');
		$label_text =  __("Rack Location Name",'school-mgt');
	}
	if($model == 'period_type')
	{
		$obj_lib = new Smgtlibrary();
		$cat_result = $obj_lib->smgt_get_periodlist();
		$title = __("Issue Period",'school-mgt');
		$table_header_title =  __("Period Time",'school-mgt');
		$button_text=  __("Add Period Time",'school-mgt');
		$label_text =  __("Period Time",'school-mgt');
	}
	if($model == 'class_sec')
	{
		//$obj_lib = new Smgtlibrary();
		//$cat_result = $obj_lib->smgt_get_periodlist();
		
		$title = __("Class Section",'school-mgt');
		$table_header_title =  __("Section Name",'school-mgt');
		$button_text=  __("Add Section Name",'school-mgt');
		$label_text =  __("Section Name",'school-mgt');
	}
	?>
	<div class="modal-header"> <a href="#" class="close-btn-cat badge badge-success pull-right">X</a>
  		<h4 id="myLargeModalLabel" class="modal-title"><?php echo $title;?></h4>
	</div>
	<hr>
	<div class="panel panel-white">
  	<div class="category_listbox">
  	<div class="table-responsive">
  	<table class="table">
  		<thead>
  			<tr>
                <!--  <th>#</th> -->
                <th><?php echo $table_header_title;?></th>
                <th><?php _e('Action','school-mgt');?></th>
            </tr>
        </thead>
        <?php 
			
        	$i = 1;
			if($model == 'class_sec'){
				$section_result=smgt_get_class_sections($class_id);
				//var_dump($section_result);
				
				if(!empty($section_result))
				{
					
					foreach ($section_result as $retrieved_data)
					{
					echo '<tr id="cat-'.$retrieved_data->id.'">';
					//echo '<td>'.$i.'</td>';
					echo '<td>'.$retrieved_data->section_name.'</td>';
					echo '<td id='.$retrieved_data->id.'>
					<a class="btn-delete-cat badge badge-delete" model='.$model.' href="#" id='.$retrieved_data->id.'>X</a>
					<a class="btn-edit-cat badge badge-edit" model='.$model.' href="#" id='.$retrieved_data->id.'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					</td>';
					echo '</tr>';
					$i++;		
					}
				}
			}
			else
			{
				if(!empty($cat_result))
				{
					
					foreach ($cat_result as $retrieved_data)
					{
					echo '<tr id="cat-'.$retrieved_data->ID.'">';
					//echo '<td>'.$i.'</td>';
					if($model == 'period_type')
						echo '<td>'.$retrieved_data->post_title.' Days'.'</td>';
					else
						echo '<td>'.$retrieved_data->post_title.'</td>';
					echo '<td id='.$retrieved_data->ID.'><a class="btn-delete-cat badge badge-delete" model='.$model.' href="#" id='.$retrieved_data->ID.'>X</a></td>';
					echo '</tr>';
					$i++;		
					}
				}
			}
        ?>
  	</table>
  	</div>
  	</div>
  	 <form name="fee_form" action="" method="post" class="form-horizontal" id="fee_form">
  	 	<div class="form-group" style="margin-top: 10px;">
			<label class="col-sm-4 control-label" for="fee_type"><?php echo $label_text;?><span class="require-field">*</span></label>
			<div class="col-sm-4">
				<?php 
				if($model == 'period_type')
				{
				?>					
					<input id="txtfee_type" class="form-control text-input validate[required]" maxlength="3" type="number" value=""  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
					 name="txtfee_type" placeholder="<?php _e('Must Be Enter Number of Days','school-mgt');?>">
				<?php
				}
				else
				{
				?>
					<input id="txtfee_type" class="form-control text-input validate[required,custom[popup_category_validation]]"  maxlength="50" type="text" 
					value="" name="txtfee_type">
				<?php
				}
				?>				
			</div>
			<div class="col-sm-4" style="margin-bottom: 10px;">
				<input type="button" <?php if($model == 'class_sec'){?> class_id=<?php echo $class_id; }?> value="<?php echo $button_text;?>" name="save_category" class="btn btn_top btn-success" model="<?php echo $model;?>" id="btn-add-cat"/>
			</div>
		</div>
		</form>
  	</div>
	<?php 
	die();
}
function smgt_add_fee_type()
{
	global $wpdb;
	$model = $_REQUEST['model'];
	$class_id = $_REQUEST['class_id'];
	$array_var = array();
	$data['category_name'] = smgt_strip_tags_and_stripslashes($_REQUEST['fee_type']);
	if($model == 'feetype')
	{
		$obj_fees = new Smgt_fees();
		$obj_fees->smgt_add_feetype($data);
		$id = $wpdb->insert_id;
		$row1 = '<tr id="cat-'.$id.'"><td>'.stripslashes($_REQUEST['fee_type']).'</td><td><a class="btn-delete-cat badge badge-delete" href="#" id='.$id.'>X</a></td></tr>';
		$option = "<option value='$id'>".stripslashes($_REQUEST['fee_type'])."</option>";
	}
	if($model=='book_cat')
	{
		$obj_lib = new Smgtlibrary();
		$cat_result = $obj_lib->smgt_add_bookcat($data);
		$id = $wpdb->insert_id;
		$row1 = '<tr id="cat-'.$id.'"><td>'.stripslashes($_REQUEST['fee_type']).'</td><td><a class="btn-delete-cat badge badge-delete" href="#" id='.$id.'>X</a></td></tr>';
		$option = "<option value='$id'>".stripslashes($_REQUEST['fee_type'])."</option>";
	}
	if($model=='rack_type')
	{
		$obj_lib = new Smgtlibrary();
		$cat_result = $obj_lib->smgt_add_rack($data);
		$id = $wpdb->insert_id;
		$row1 = '<tr id="cat-'.$id.'"><td>'.stripslashes($_REQUEST['fee_type']).'</td><td><a class="btn-delete-cat badge badge-delete" href="#" id='.$id.'>X</a></td></tr>';
		$option = "<option value='$id'>".stripslashes($_REQUEST['fee_type'])."</option>";
	}
	if($model=='period_type')
	{
		$obj_lib = new Smgtlibrary();
		$cat_result = $obj_lib->smgt_add_period($data);
		$id = $wpdb->insert_id;
		$row1 = '<tr id="cat-'.$id.'"><td>'.stripslashes($_REQUEST['fee_type']).' '.__('Days','school-mgt').'</td><td><a class="btn-delete-cat badge badge-delete" href="#" id='.$id.'>X</a></td></tr>';
		$option = "<option value='$id'>".stripslashes($_REQUEST['fee_type'])." ".__('Days','school-mgt')."</option>";
	}
	if($model=='class_sec')
	{
		$tablename="smgt_class_section";
		
		$sectiondata['class_id']=$_REQUEST['class_id'];
		$sectiondata['section_name']=stripslashes($_REQUEST['fee_type']);
		
		$result=add_class_section($tablename,$sectiondata);
		$id = $wpdb->insert_id;
		$row1 = '<tr id="cat-'.$id.'"><td>'.stripslashes($_REQUEST['fee_type']).'</td>
		<td>
		<a class="btn-delete-cat badge badge-delete" href="#" id="'.$id.'">X</a>
		<a class="btn-edit-cat badge badge-edit" model="section" href="#" id="'.$id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
		</td></tr>';
		$option = "<option value='$id'>".stripslashes($_REQUEST['fee_type'])."</option>";
	}
	$array_var[] = $row1;
	$array_var[] = $option;
	echo json_encode($array_var);
	die();
}
function smgt_remove_feetype()
{
	
	$model = $_REQUEST['model'];
	if($model == 'feetype')
	{
		$obj_fees = new Smgt_fees();
		$obj_fees->delete_fee_type($_POST['cat_id']);
		die();
	}
	if($model == 'book_cat')
	{
		$obj_lib = new Smgtlibrary();
		$obj_lib->delete_cat_type($_POST['cat_id']);
		die();
	}
	if($model == 'rack_type')
	{
		$obj_lib = new Smgtlibrary();
		$obj_lib->delete_rack_type($_POST['cat_id']);
		die();
	}
	if($model == 'period_type')
	{
		$obj_lib = new Smgtlibrary();
		$obj_lib->delete_period($_POST['cat_id']);
		die();
	}
	if($model == 'class_sec')
	{
		$result=delete_class_section($_POST['cat_id']);
		die();
	}
}
function smgt_single_section($section_id)
{
	global $wpdb;
	$smgt_class_section = $wpdb->prefix. 'smgt_class_section';
	$result = $wpdb->get_row('Select * from '.$smgt_class_section.' where id = '.$section_id);
	
	return $result;
}
function smgt_update_section()
{
	global $wpdb;
	$smgt_class_section = $wpdb->prefix. 'smgt_class_section';
	$data['section_name']=$_POST['section_name'];
	$data_id['id']=$_POST['cat_id'];	
	$result=$wpdb->update( $smgt_class_section, $data ,$data_id);
	$retrieved_data = smgt_single_section($_POST['cat_id']);
		echo '<td>'.$retrieved_data->section_name.'</td>';
					echo '<td id='.$retrieved_data->id.'>
					<a class="btn-delete-cat badge badge-delete" model='.$model.' href="#" id='.$retrieved_data->id.'>X</a>
					<a class="btn-edit-cat badge badge-edit" model='.$model.' href="#" id='.$retrieved_data->id.'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					</td>';
	die();
}
function smgt_update_cancel_section()
{
	global $wpdb;
	$smgt_class_section = $wpdb->prefix. 'smgt_class_section';	
	$retrieved_data = smgt_single_section($_POST['cat_id']);
		echo '<td>'.$retrieved_data->section_name.'</td>';
					echo '<td id='.$retrieved_data->id.'>
					<a class="btn-delete-cat badge badge-delete" model='.$model.' href="#" id='.$retrieved_data->id.'>X</a>
					<a class="btn-edit-cat badge badge-edit" model='.$model.' href="#" id='.$retrieved_data->id.'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
					</td>';
	die();
}
function smgt_edit_section()
{
	
	$model = $_REQUEST['model'];
	$cat_id = $_REQUEST['cat_id'];
	$retrieved_data = smgt_single_section($cat_id);
	//echo '<td>'.$i.'</td>';
					echo '<td><input type="text" class="validate[required,custom[popup_category_validation]]" name="section_name" maxlength="50" value="'.$retrieved_data->section_name.'" id="section_name"></td>';
					echo '<td id='.$retrieved_data->id.'>
					<a class="btn-cat-update-cancel btn btn-danger" model='.$model.' href="#" id='.$retrieved_data->id.'>'.__('Cancel','school-mgt').'</a>
					<a class="btn-cat-update btn btn-primary" model='.$model.' href="#" id='.$retrieved_data->id.'>'.__('Save','school-mgt').'</a>
					</td>';
	die();
}
function smgt_student_invoice_print($invoice_id)
{
	$obj_invoice= new Smgtinvoice();
	if($_REQUEST['invoice_type']=='invoice')
	{
		$invoice_data=get_payment_by_id($invoice_id);
	}
	if($_REQUEST['invoice_type']=='income'){
		$income_data=$obj_invoice->smgt_get_income_data($invoice_id);
	}
	if($_REQUEST['invoice_type']=='expense'){
		$expense_data=$obj_invoice->smgt_get_income_data($invoice_id);
	}
	
	?>
		
		<div class="modal-body">
			<div id="invoice_print" style="width: 90%;margin:0 auto;"> 
			<div class="modal-header">
				
				<h4 class="modal-title"><?php echo get_option('smgt_school_name');?></h4>
		</div>
				<table width="100%" border="0">
							<tbody>
								<tr>
									<td width="70%">
										<img style="max-height:80px;" src="<?php echo get_option( 'smgt_school_logo' ); ?>">
									</td>
									<td align="right" width="24%">
										<h4><?php
										if(!empty($invoice_data)){
											//$invoice_no=$invoice_data->invoice_number;
											//_e('Invoice number','school-mgt');
											//echo " : ".$invoice_no;
											}
										?> </h4>
										<h5><?php $issue_date='DD-MM-YYYY';
													if(!empty($income_data)){
														$issue_date=$income_data->income_create_date;
														$payment_status=$income_data->payment_status;}
													if(!empty($invoice_data)){
														$issue_date=$invoice_data->date;
														$payment_status=$invoice_data->payment_status;	}
													if(!empty($expense_data)){
														$issue_date=$expense_data->income_create_date;
														$payment_status=$expense_data->payment_status;}
										
										echo __('Issue Date','school-mgt')." : ".smgt_getdate_in_input_box(date("Y-m-d", strtotime($issue_date)));?></h5>
										<h5><?php if($payment_status=='Paid') 
											echo __('Status','school-mgt')." : ".__('Paid','school-mgt');
										elseif($payment_status=='Part Paid')
											echo __('Status','school-mgt')." : ".__('Part Paid','school-mgt');
										else
											echo __('Status','school-mgt')." : ".__('Unpaid','school-mgt');	?></h5>
									</td>
								</tr>
							</tbody>
						</table>
						<hr>
						<table width="100%" border="0">
							<tbody>
								<tr>
									<td align="left">
										<h4><?php _e('Payment From','school-mgt');?> </h4>
									</td>
									<td align="right">
										<h4><?php _e('Bill To','school-mgt');?> </h4>
									</td>
								</tr>
								<tr>
									<td valign="top" align="left">
										<?php echo get_option( 'smgt_school_name' )."<br>"; 
										 echo get_option( 'smgt_school_address' ).","; 
										 echo get_option( 'smgt_contry' )."<br>"; 
										 echo get_option( 'smgt_contact_number' )."<br>"; 
										?>
										
									</td>
									<td valign="top" align="right">
										<?php 
										if(!empty($expense_data))
										{
											echo $party_name=$expense_data->supplier_name; 
										}
										else
										{
											if(!empty($income_data))
												$student_id=$income_data->supplier_name;
											 if(!empty($invoice_data))
												$student_id=$invoice_data->student_id;
											
											
											
											$patient=get_userdata($student_id);
													
											echo $patient->display_name."<br>"; 
											 echo get_user_meta( $student_id,'address',true ).","; 
											 echo get_user_meta( $student_id,'city_name',true ).","; 
											 echo get_user_meta( $student_id,'zip_code',true ).","; 
											 echo get_user_meta( $student_id,'country_name',true )."<br>"; 
											 echo get_user_meta( $student_id,'mobile',true )."<br>"; 
										}
										?>
									</td>
								</tr>
							</tbody>
						</table>
						<hr>
						<h4><?php _e('Invoice Entries','school-mgt');?></h4>
						<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center"> <?php _e('Date','school-mgt');?></th>
									<th width="60%"><?php _e('Entry','school-mgt');?> </th>
									<th><?php _e('Price','school-mgt');?></th>
									<th class="text-center"> <?php _e('Username','school-mgt');?> </th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$id=1;
								$total_amount=0;
							if(!empty($income_data) || !empty($expense_data)){
								if(!empty($expense_data))
									$income_data=$expense_data;
								
								$patient_all_income=$obj_invoice->get_onepatient_income_data($income_data->supplier_name);
								foreach($patient_all_income as $result_income){
									$income_entries=json_decode($result_income->entry);
									foreach($income_entries as $each_entry){
									$total_amount+=$each_entry->amount;
									
							?>
								<tr>
									<td class="text-center"><?php echo $id;?></td>
									<td class="text-center"><?php echo $result_income->income_create_date;?></td>
									<td><?php echo $each_entry->entry; ?> </td>
									<td class="text-right"> <?php echo "<span> ". get_currency_symbol() ."</span>" .number_format($each_entry->amount,2); ?></td>
									<td class="text-center"><?php echo get_display_name($result_income->create_by);?></td>
								</tr>
									<?php $id+=1;}
									}
							 
							}
							 if(!empty($invoice_data)){
								 $total_amount=$invoice_data->amount
								 ?>
								<tr>
									<td class="text-center"><?php echo $id;?></td>
									<td class="text-center"><?php echo date("Y-m-d", strtotime($invoice_data->date));?></td>
									<td><?php echo $invoice_data->payment_title; ?> </td>
									<td class="text-right"> <?php echo "<span> ". get_currency_symbol() ." </span>" .number_format($invoice_data->amount,2); ?></td>
									<td class="text-center"><?php echo get_display_name($invoice_data->payment_reciever_id);?></td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<table width="100%" border="0">
							<tbody>
								
								<?php if(!empty($invoice_data)){								
									$grand_total= $invoice_data->amount;
									?>
								
								<?php
								}
								if(!empty($income_data)){
									$grand_total=$total_amount;
								}
								?>								
								<tr>
									<td width="80%" align="right">&nbsp;</td>
									<td align="right"><h4><?php _e('Grand Total ','school-mgt');?> : <?php echo "<span>". get_currency_symbol() ."</span>" .number_format($grand_total,2); ?></h4></td>
								</tr>
							</tbody>
						</table>
			</div>
		</div>
	
	<?php 
}
function smgt_student_invoice_pdf($invoice_id)
{
	$obj_invoice= new Smgtinvoice();
	if($_REQUEST['invoice_type']=='invoice')
	{
		$invoice_data=get_payment_by_id($invoice_id);
	}
	if($_REQUEST['invoice_type']=='income'){
		$income_data=$obj_invoice->smgt_get_income_data($invoice_id);
	}
	if($_REQUEST['invoice_type']=='expense'){
		$expense_data=$obj_invoice->smgt_get_income_data($invoice_id);
	}
	
	?>
		
		<div class="modal-body">
			<div id="invoice_print" style="width: 90%;margin:0 auto;"> 
			<div class="modal-header">				
				<h4 class="modal-title"><?php echo get_option('smgt_school_name');?></h4>
			</div>
			<table width="100%" border="0">
				<tbody>
					<tr>
						<td width="70%">
							<img style="max-height:80px;" src="<?php echo get_option( 'smgt_school_logo' ); ?>">
						</td>
						<td align="right" width="24%">
						<h5><?php $issue_date='DD-MM-YYYY';
							if(!empty($income_data)){
								$issue_date=$income_data->income_create_date;
								$payment_status=$income_data->payment_status;}
								if(!empty($invoice_data)){
									$issue_date=$invoice_data->date;
									$payment_status=$invoice_data->payment_status;	}
									if(!empty($expense_data)){
										$issue_date=$expense_data->income_create_date;
										$payment_status=$expense_data->payment_status;
									}
										
									echo __('Issue Date','school-mgt')." : ".date("Y-m-d", strtotime($issue_date));?></h5>
									<h5><?php if($payment_status=='Paid') 
										echo __('Status','school-mgt')." : ".__('Paid','school-mgt');
									elseif($payment_status=='Part Paid')
										echo __('Status','school-mgt')." : ".__('Part Paid','school-mgt');
									else
										echo __('Status','school-mgt')." : ".__('Unpaid','school-mgt');	?></h5>
						</td>
					</tr>
				</tbody>
			</table>
			<hr>
			<table width="100%" border="0">
				<tbody>
					<tr>
						<td align="left">
							<h4><?php _e('Payment From','school-mgt');?> </h4>
						</td>
						<td align="right">
							<h4><?php _e('Bill To','school-mgt');?> </h4>
						</td>
					</tr>
					<tr>
						<td valign="top" align="left">
							<?php echo get_option( 'smgt_school_name' )."<br>"; 
								echo get_option( 'smgt_school_address' ).","; 
								echo get_option( 'smgt_contry' )."<br>"; 
								echo get_option( 'smgt_contact_number' )."<br>"; 
							?>
						</td>
						<td valign="top" align="right">
							<?php 
								if(!empty($expense_data)){
									echo $party_name=$expense_data->supplier_name; 
								}
								else
								{
									if(!empty($income_data))
										$student_id=$income_data->supplier_name;
									 if(!empty($invoice_data))
										$student_id=$invoice_data->student_id;											
										$patient=get_userdata($student_id);
													
										echo $patient->display_name."<br>"; 
										echo get_user_meta( $student_id,'address',true ).","; 
										echo get_user_meta( $student_id,'city_name',true ).","; 
										echo get_user_meta( $student_id,'zip_code',true ).","; 
										echo get_user_meta( $student_id,'country_name',true )."<br>"; 
										echo get_user_meta( $student_id,'mobile',true )."<br>"; 
								}
							?>
						</td>
					</tr>
				</tbody>
			</table>
			<hr>
						<h4><?php _e('Invoice Entries','school-mgt');?></h4>
						<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center"> <?php _e('Date','school-mgt');?></th>
									<th width="60%"><?php _e('Entry','school-mgt');?> </th>
									<th><?php _e('Price','school-mgt');?></th>
									<th class="text-center"> <?php _e('Username','school-mgt');?> </th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$id=1;
								$total_amount=0;
							if(!empty($income_data) || !empty($expense_data)){
								if(!empty($expense_data))
									$income_data=$expense_data;
								
								$patient_all_income=$obj_invoice->get_onepatient_income_data($income_data->supplier_name);
								foreach($patient_all_income as $result_income){
									$income_entries=json_decode($result_income->entry);
									foreach($income_entries as $each_entry){
									$total_amount+=$each_entry->amount;
									
							?>
								<tr>
									<td class="text-center"><?php echo $id;?></td>
									<td class="text-center"><?php echo $result_income->income_create_date;?></td>
									<td><?php echo $each_entry->entry; ?> </td>
									<td class="text-right"> <?php echo "<span>". get_currency_symbol() ."</span>" .number_format($each_entry->amount,2); ?></td>
									<td class="text-center"><?php echo get_display_name($result_income->create_by);?></td>
								</tr>
									<?php $id+=1;}
									}
							 
							}
							 if(!empty($invoice_data)){
								 $total_amount=$invoice_data->amount
								 ?>
								<tr>
									<td class="text-center"><?php echo $id;?></td>
									<td class="text-center"><?php echo date("Y-m-d", strtotime($invoice_data->date));?></td>
									<td><?php echo $invoice_data->payment_title; ?> </td>
									<td class="text-right"> <?php echo "<span> ". get_currency_symbol() ."</span>" .number_format($invoice_data->amount,2); ?></td>
									<td class="text-center"><?php echo get_display_name($invoice_data->payment_reciever_id);?></td>
								</tr>
								<?php }?>
							</tbody>
						</table>
						<table width="100%" border="0">
							<tbody>
								
								<?php if(!empty($invoice_data)){								
									$grand_total= $invoice_data->amount;
									?>
								
								<?php
								}
								if(!empty($income_data)){
									$grand_total=$total_amount;
								}
								?>								
								<tr>
									<td width="60%" align="right">&nbsp;</td>
									<td align="right"><h4><?php _e('Grand Total ','school-mgt');?> : <?php echo "<span>". get_currency_symbol() ."</span>" .number_format($grand_total,2); ?></h4></td>
								</tr>
							</tbody>
						</table>
			</div>
		</div>
	
	<?php 
}
function smgt_print_invoice()
{
	
	
	if(isset($_REQUEST['print']) && $_REQUEST['print'] == 'print' && $_REQUEST['page'] == 'smgt_payment')
	{
		?>
<script>window.onload = function(){ window.print(); };</script>
<?php 
				
				smgt_student_invoice_print($_REQUEST['invoice_id']);
				exit;
	}			
}
add_action('init','smgt_print_invoice');
function install_tables()
{
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	global $wpdb;
	$table_name = $wpdb->prefix . 'attendence';//register attendence table
	
		$sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  `attendence_id` int(50) NOT NULL AUTO_INCREMENT,
			  `user_id` int(50) NOT NULL,
			  `class_id` int(50) NOT NULL,
			  `attend_by` int(11) NOT NULL,
			  `attendence_date` date NOT NULL,
			  `status` varchar(50) NOT NULL,
			  `role_name` varchar(20) NOT NULL,
			  `comment` text NOT NULL,
			  PRIMARY KEY (`attendence_id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);
		
		
		$table_name = $wpdb->prefix . 'exam';//register exam table
		
	  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
		  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
		  `exam_name` varchar(200) NOT NULL,
		  `exam_date` date NOT NULL,
		  `exam_comment` text NOT NULL,
		  `created_date` datetime NOT NULL,
		  `modified_date` datetime NOT NULL,
		  `exam_creater_id` int(11) NOT NULL,
		  PRIMARY KEY (`exam_id`)
		)DEFAULT CHARSET=utf8";
	dbDelta($sql);
		
		$table_name = $wpdb->prefix . 'grade';//register grade table
		
	  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  `grade_id` int(11) NOT NULL AUTO_INCREMENT,
			  `grade_name` varchar(20) NOT NULL,
			  `grade_point` float NOT NULL,
			  `mark_from` tinyint(3) NOT NULL,
			  `mark_upto` tinyint(3) NOT NULL,
			  `grade_comment` text NOT NULL,
			  `created_date` datetime NOT NULL,
			  `creater_id` int(11) NOT NULL,
			  PRIMARY KEY (`grade_id`)
			)DEFAULT CHARSET=utf8";
	dbDelta($sql);
	
	
		$table_name = $wpdb->prefix . 'hall';//register hall table
		
	  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  `hall_id` int(11) NOT NULL AUTO_INCREMENT,
			  `hall_name` varchar(200) NOT NULL,
			  `number_of_hall` int(11) NOT NULL,
			  `hall_capacity` int(11) NOT NULL,
			  `description` text NOT NULL,
			  `date` datetime NOT NULL,
			  PRIMARY KEY (`hall_id`)
			)DEFAULT CHARSET=utf8";
				dbDelta($sql);
				
			$table_name = $wpdb->prefix . 'holiday';//register holiday table
		
	  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  `holiday_id` int(11) NOT NULL AUTO_INCREMENT,
			  `holiday_title` varchar(200) NOT NULL,
			  `description` text NOT NULL,
			  `date` date NOT NULL,
			  `end_date` date NOT NULL,
			  `created_by` int(11) NOT NULL,
			  PRIMARY KEY (`holiday_id`)
			) DEFAULT CHARSET=utf8 ";
		dbDelta($sql);	
			


						
		$table_name = $wpdb->prefix . 'marks';//register marks table
		
	  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  `mark_id` bigint(20) NOT NULL AUTO_INCREMENT,
			  `exam_id` int(11) NOT NULL,
			  `class_id` int(11) NOT NULL,
			  `subject_id` int(11) NOT NULL,
			  `marks` tinyint(3) NOT NULL,
			  `attendance` tinyint(4) NOT NULL,
			  `grade_id` int(11) NOT NULL,
			  `student_id` int(11) NOT NULL,
			  `marks_comment` text NOT NULL,
			  `created_date` datetime NOT NULL,
			  `modified_date` datetime NOT NULL,
			  `created_by` int(11) NOT NULL,
			  PRIMARY KEY (`mark_id`)
			) DEFAULT CHARSET=utf8 ";
		dbDelta($sql);	
		
	$table_name = $wpdb->prefix . 'smgt_class';//register smgt_class table		
	  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  `class_id` int(11) NOT NULL AUTO_INCREMENT,
			  `class_name` varchar(100) NOT NULL,
			  `class_num_name` varchar(5) NOT NULL,
			  `class_section` varchar(50) NOT NULL,
			  `class_capacity` tinyint(4) NOT NULL,
			  `creater_id` int(11) NOT NULL,
			  `created_date` datetime NOT NULL,
			  `modified_date` datetime NOT NULL,
			  PRIMARY KEY (`class_id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);	
		
	$table_smgt_fees = $wpdb->prefix . 'smgt_fees';//register smgt_class table		
	$sql = "CREATE TABLE IF NOT EXISTS ".$table_smgt_fees." (			  
			  `fees_id` int(11) NOT NULL AUTO_INCREMENT,
			  `fees_title_id` bigint(20) NOT NULL,
			  `class_id` int(11) NOT NULL,
			  `fees_amount` float NOT NULL,
			  `description` text NOT NULL,
			  `created_date` datetime NOT NULL,
			  `created_by` int(11) NOT NULL,
			  PRIMARY KEY (`fees_id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);
			
	$table_smgt_fees_payment = $wpdb->prefix . 'smgt_fees_payment';//register smgt_class table		
	$sql = "CREATE TABLE IF NOT EXISTS ".$table_smgt_fees_payment." (			  
			  `fees_pay_id` int(11) NOT NULL AUTO_INCREMENT,
			  `class_id` int(11) NOT NULL,
			  `student_id` bigint(20) NOT NULL,
			  `fees_id` int(11) NOT NULL,
			  `total_amount` float NOT NULL,
			  `fees_paid_amount` float NOT NULL,
			  `payment_status` tinyint(4) NOT NULL,
			  `description` text NOT NULL,
			  `start_year` varchar(20) NOT NULL,
			  `end_year` varchar(20) NOT NULL,
			  `paid_by_date` date NOT NULL,
			  `created_date` datetime NOT NULL,
			  `created_by` bigint(20) NOT NULL,
			  PRIMARY KEY (`fees_pay_id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);
	
	$table_smgt_fee_payment_history = $wpdb->prefix . 'smgt_fee_payment_history';//register smgt_class table		
	$sql = "CREATE TABLE IF NOT EXISTS ".$table_smgt_fee_payment_history." (			  
			  `payment_history_id` bigint(20) NOT NULL AUTO_INCREMENT,
			  `fees_pay_id` int(11) NOT NULL,
			  `amount` float NOT NULL,
			  `payment_method` varchar(50) NOT NULL,
			  `paid_by_date` date NOT NULL,
			  `created_by` bigint(20) NOT NULL,
			  `trasaction_id` varchar(50) NOT NULL,
			  PRIMARY KEY (`payment_history_id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);
		
			$table_name = $wpdb->prefix . 'smgt_message';//register smgt_message table
		
	  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
				  `message_id` int(11) NOT NULL AUTO_INCREMENT,
				  `sender` int(11) NOT NULL,
				  `receiver` int(11) NOT NULL,
				  `date` datetime NOT NULL,
				  `subject` varchar(150) NOT NULL,
				  `message_body` text NOT NULL,
				  `status` int(11) NOT NULL,
				  `post_id` int(11) NOT NULL,
				  PRIMARY KEY (`message_id`)
				)DEFAULT CHARSET=utf8";
		dbDelta($sql);	
		
		
			$table_name = $wpdb->prefix . 'smgt_payment';//register smgt_payment table
		
	  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
			  `student_id` int(11) NOT NULL,
			  `class_id` int(11) NOT NULL,
			  `payment_title` varchar(100) NOT NULL,
			  `description` text NOT NULL,
			  `amount` int(11) NOT NULL,
			  `payment_status` varchar(10) NOT NULL,
			  `date` datetime NOT NULL,
			  `payment_reciever_id` int(11) NOT NULL,
			  PRIMARY KEY (`payment_id`)
			) DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 
			";
		dbDelta($sql);	
		
			$table_name = $wpdb->prefix . 'smgt_time_table';//register smgt_time_table table
		
	  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  `route_id` int(11) NOT NULL AUTO_INCREMENT,
			  `subject_id` int(11) NOT NULL,
			  `teacher_id` int(11) NOT NULL,
			  `class_id` int(11) NOT NULL,
			  `start_time` varchar(10) NOT NULL,
			  `end_time` varchar(10) NOT NULL,
			  `weekday` tinyint(4) NOT NULL,
			  PRIMARY KEY (`route_id`)
			)DEFAULT CHARSET=utf8";
		dbDelta($sql);	
		
		
		$table_name = $wpdb->prefix . 'subject';//register subject table
		
	  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  `subid` int(11) unsigned NOT NULL AUTO_INCREMENT,
			  `sub_name` varchar(255) NOT NULL,
			  `teacher_id` int(11) NOT NULL,
			  `class_id` int(11) NOT NULL,
			  `author_name` varchar(255) NOT NULL,
			  `edition` varchar(255) NOT NULL,
			  `syllabus` varchar(255) DEFAULT NULL,
			  PRIMARY KEY (`subid`)
			)  DEFAULT CHARSET=utf8";
		dbDelta($sql);	
		
		$table_name = $wpdb->prefix .'transport';//register transport table
		
	  $sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  `transport_id` int(11) NOT NULL AUTO_INCREMENT,
			  `route_name` varchar(200) NOT NULL,
			  `number_of_vehicle` tinyint(4) NOT NULL,
			  `vehicle_reg_num` varchar(50) NOT NULL,
			  `smgt_user_avatar` varchar(5000) NOT NULL,
			  `driver_name` varchar(100) NOT NULL,
			  `driver_phone_num` varchar(15) NOT NULL,
			  `driver_address` text NOT NULL,
			  `route_description` text NOT NULL,
			  `route_fare` int(11) NOT NULL,
			  `status` tinyint(4) NOT NULL DEFAULT '1',
			  PRIMARY KEY (`transport_id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);	
		
		$table_smgt_income_expense = $wpdb->prefix .'smgt_income_expense';//register transport table
		
		$sql = "CREATE TABLE IF NOT EXISTS ".$table_smgt_income_expense." (
			 `income_id` int(11) NOT NULL AUTO_INCREMENT,
			  `invoice_type` varchar(50) NOT NULL,
			  `class_id` int(11) NOT NULL,
			  `supplier_name` varchar(100) NOT NULL,
			  `entry` text NOT NULL,
			  `payment_status` varchar(50) NOT NULL,
			  `create_by` int(11) NOT NULL,	
			  `income_create_date` date NOT NULL,
			  PRIMARY KEY (`income_id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);
		
	$table_smgt_library_book = $wpdb->prefix . 'smgt_library_book';//register smgt_class table		
	$sql = "CREATE TABLE IF NOT EXISTS ".$table_smgt_library_book." (			  
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `ISBN` varchar(50) NOT NULL,
			  `book_name` varchar(200) CHARACTER SET utf8 NOT NULL,
			  `author_name` varchar(100) CHARACTER SET utf8 NOT NULL,
			  `cat_id` int(11) NOT NULL,
			  `rack_location` int(11) NOT NULL,
			  `price` varchar(10) NOT NULL,
			  `quentity` int(11) NOT NULL,
			  `description` text CHARACTER SET utf8 NOT NULL,
			  `added_by` int(11) NOT NULL,
			  `added_date` varchar(20) NOT NULL,
			  PRIMARY KEY (`id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);
		
	$table_smgt_library_book_issue = $wpdb->prefix . 'smgt_library_book_issue';//register smgt_class table		
	$sql = "CREATE TABLE IF NOT EXISTS ".$table_smgt_library_book_issue." (			  
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `class_id` int(11) NOT NULL,
			  `student_id` int(11) NOT NULL,
			  `cat_id` int(11) NOT NULL,
			  `book_id` int(11) NOT NULL,
			  `issue_date` varchar(20) NOT NULL,
			  `end_date` varchar(20) NOT NULL,
			  `actual_return_date` varchar(20) NOT NULL,
			  `period` int(11) NOT NULL,
			  `fine` varchar(20) NOT NULL,
			  `status` varchar(50) NOT NULL,
			  `issue_by` int(11) NOT NULL,
			  PRIMARY KEY (`id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);
	
	$smgt_sub_attendance = $wpdb->prefix . 'smgt_sub_attendance';//register smgt_class table		
	$sql = "CREATE TABLE IF NOT EXISTS ".$smgt_sub_attendance." (			  
			  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
			  `user_id` int(11) NOT NULL,
			  `class_id` int(11) NOT NULL,
			  `sub_id` int(11) NOT NULL,
			  `attend_by` int(11) NOT NULL,
			  `attendance_date` date NOT NULL,
			  `status` varchar(50) NOT NULL,
			  `role_name` varchar(50) NOT NULL,
			  `comment` text NOT NULL,
			  PRIMARY KEY (`attendance_id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);
		$table_name = $wpdb->prefix . 'smgt_homework';//homework table
	
		$sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  `homework_id` int(50) NOT NULL AUTO_INCREMENT,
			  `title` varchar(50) NOT NULL,
			  `class_name` varchar(50) NOT NULL,
			  `subject` varchar(50) NOT NULL,
			  `content` varchar(250) NOT NULL,
			  `create_date` date NOT NULL,
			  `submition_date` date NOT NULL,
			  `createdby` varchar(50) NOT NULL,
			  PRIMARY KEY (`homework_id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);
		
		$table_name = $wpdb->prefix . 'smgt_Student_homework';//Student Homework table
	
		$sql = "CREATE TABLE IF NOT EXISTS ".$table_name." (
			  `stu_homework_id` int(50) NOT NULL AUTO_INCREMENT,
			  `homework_id` int(50) NOT NULL,
			  `student_id` int(50) NOT NULL,
			  `status` int(10) NOT NULL,
			  `uploaded_date` date NOT NULL,
			  `file` varchar(50) NOT NULL,
			  PRIMARY KEY (`stu_homework_id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);
	$smgt_message_replies = $wpdb->prefix . 'smgt_message_replies';//register smgt_class table		
	$sql = "CREATE TABLE IF NOT EXISTS ".$smgt_message_replies." (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `message_id` int(11) NOT NULL,
			  `sender_id` int(11) NOT NULL,
			  `receiver_id` int(11) NOT NULL,
			  `message_comment` text NOT NULL,
			  `created_date` datetime NOT NULL,
			  PRIMARY KEY (`id`)
			) DEFAULT CHARSET=utf8";
		dbDelta($sql);	
	
	$smgt_class_section = $wpdb->prefix . 'smgt_class_section';//register smgt_class table		
	$sql = "CREATE TABLE IF NOT EXISTS ".$smgt_class_section." (
			  `id` int(11) NOT NULL AUTO_INCREMENT,
			  `class_id` int(11) NOT NULL,
			  `section_name` varchar(255) NOT NULL,
			  PRIMARY KEY (`id`)
			) DEFAULT CHARSET=utf8";
			
		dbDelta($sql);

	$smgt_teacher_sub = $wpdb->prefix . 'teacher_subject';		
	$sql = "CREATE TABLE IF NOT EXISTS `{$smgt_teacher_sub}` (
			  `teacher_subject_id` int(11) NOT NULL AUTO_INCREMENT,
			  `teacher_id` bigint(20) NOT NULL,
			  `subject_id` bigint(20) NOT NULL,
			  `created_date` datetime NOT NULL,
			  `created_by` bigint(20) NOT NULL,
			  PRIMARY KEY (`teacher_subject_id`)
			) DEFAULT CHARSET=utf8";
	dbDelta($sql);	
	
	$smgt_notification = $wpdb->prefix . 'smgt_notification';		
	$sql = "CREATE TABLE IF NOT EXISTS `{$smgt_notification}` (
			  `notification_id` int(11) NOT NULL AUTO_INCREMENT,
			 `student_id` int(11) NOT NULL,
			 `title` varchar(500) DEFAULT NULL,
			 `message` varchar(5000) DEFAULT NULL,
			 `device_token` varchar(255) DEFAULT NULL,
			 `device_type` tinyint(4) NOT NULL,
			 `bicon` int(11) DEFAULT NULL,
			 `created_date` date DEFAULT NULL,
			 `created_by` int(11) DEFAULT NULL,
			 PRIMARY KEY (`notification_id`)
			) DEFAULT CHARSET=utf8";
	dbDelta($sql);	


		
	
	global $wpdb;
    $section_row = $wpdb->get_results("SELECT *from $smgt_class_section");
	
    if(empty($section_row))
    {
		
		$tablename="smgt_class";
		$retrieve_class = get_all_data($tablename);
		foreach ($retrieve_class as $retrieved_data){ 
			$tablename_section="smgt_class_section";
			$sectiondata['class_id']=$retrieved_data->class_id;
			$sectiondata['section_name']=$retrieved_data->class_section;
			$result=add_class_section($tablename_section,$sectiondata);
			$studentdata = get_users(array('meta_key' => 'class_name', 'meta_value' => $retrieved_data->class_id,'role'=>'student'));
			if(!empty($studentdata))
			{
				foreach($studentdata as $student)
				{
					add_user_meta( $student->ID, "class_section",$retrieved_data->class_section);
				}
			}
			
		}
    }	
	
	$smgt_teacher_class = $wpdb->prefix . 'smgt_teacher_class';//register smgt_class table		
	$sql = "CREATE TABLE IF NOT EXISTS ".$smgt_teacher_class." (
			  `id` bigint(20) NOT NULL AUTO_INCREMENT,
			  `teacher_id` bigint(20) NOT NULL,
			  `class_id` int(11) NOT NULL,
			  `created_by` bigint(20) NOT NULL,
			  `created_date` datetime NOT NULL,
			  PRIMARY KEY (`id`)
			) DEFAULT CHARSET=utf8";
	dbDelta($sql);	
	
	
    $teacher_class = $wpdb->get_results("SELECT *from $smgt_teacher_class");	
	if(empty($teacher_class))
	{
		$teacherlist = get_users(array('role'=>'teacher'));		
		if(!empty($teacherlist))
		{
			foreach($teacherlist as $retrieve_data)
			{
				
				$created_by = get_current_user_id();
				$created_date = date('Y-m-d H:i:s');
				$class_id = get_user_meta($retrieve_data->ID,'class_name',true);				
				$success = $wpdb->insert($smgt_teacher_class,array('teacher_id'=>$retrieve_data->ID,
					'class_id'=>$class_id,
					'created_by'=>$created_by,
					'created_date'=>$created_date));
			}
		}		
	}
	
	$comment_field =  'comment';
	if (!in_array($comment_field, $wpdb->get_col( "DESC " . $smgt_sub_attendance, 0 ) )){  $result= $wpdb->query(
			"ALTER     TABLE $smgt_sub_attendance  ADD   $comment_field   text");}	
	$table_attendance = $wpdb->prefix . 'attendence';
	if (!in_array($comment_field, $wpdb->get_col( "DESC " . $table_attendance, 0 ) )){  $result= $wpdb->query(
			"ALTER     TABLE $table_attendance  ADD   $comment_field   text");}	
	$new_field='post_id';
	$table_smgt_message = $wpdb->prefix . 'smgt_message';	
	if (!in_array($new_field, $wpdb->get_col( "DESC " . $table_smgt_message, 0 ) )){  $result= $wpdb->query(
			"ALTER     TABLE $table_smgt_message  ADD   $new_field   int(11)");}

	$section_id='section_id';
	$table_subject = $wpdb->prefix . 'subject';	
	if (!in_array($section_id, $wpdb->get_col( "DESC " . $table_subject, 0 ) )){  $result= $wpdb->query(
			"ALTER     TABLE $table_subject  ADD   $section_id   int(11) NOT NULL");}	

	$table_smgt_fees = $wpdb->prefix . 'smgt_fees';	
	if (!in_array($section_id, $wpdb->get_col( "DESC " . $table_smgt_fees, 0 ) )){  $result= $wpdb->query(
			"ALTER     TABLE $table_smgt_fees  ADD   $section_id   int(11) NOT NULL");}	

	$table_smgt_fees_payment = $wpdb->prefix . 'smgt_fees_payment';	
	if (!in_array($section_id, $wpdb->get_col( "DESC " . $table_smgt_fees_payment, 0 ) )){  $result= $wpdb->query(
			"ALTER     TABLE $table_smgt_fees_payment  ADD   $section_id   int(11) NOT NULL");}		

   $table_smgt_income_expense = $wpdb->prefix . 'smgt_income_expense';	
	if (!in_array($section_id, $wpdb->get_col( "DESC " . $table_smgt_income_expense, 0 ) )){  $result= $wpdb->query(
			"ALTER     TABLE $table_smgt_income_expense  ADD   $section_id   int(11) NOT NULL");}

	$table_smgt_library_book_issue = $wpdb->prefix . 'smgt_library_book_issue';	
	if (!in_array($section_id, $wpdb->get_col( "DESC " . $table_smgt_library_book_issue, 0 ) )){  $result= $wpdb->query(
			"ALTER     TABLE $table_smgt_library_book_issue  ADD   $section_id   int(11) NOT NULL");}

	$table_smgt_payment = $wpdb->prefix . 'smgt_payment';	
	if (!in_array($section_id, $wpdb->get_col( "DESC " . $table_smgt_payment, 0 ) )){  $result= $wpdb->query(
			"ALTER     TABLE $table_smgt_payment  ADD   $section_id   int(11) NOT NULL");}	
	
	$section_name="section_name";
	$table_smgt_time_table = $wpdb->prefix . 'smgt_time_table';	
	if (!in_array($section_name, $wpdb->get_col( "DESC " . $table_smgt_time_table, 0 ) ))
	{ 
		$result= $wpdb->query("ALTER TABLE $table_smgt_time_table  ADD   $section_name   int(11) NOT NULL");
	}	

	$table_marks = $wpdb->prefix . 'marks';	
	if (!in_array($section_id, $wpdb->get_col( "DESC " . $table_marks, 0 ) )){  $result= $wpdb->query(
			"ALTER     TABLE $table_marks  ADD   $section_id   int(11) NOT NULL");}				
	
	$table_smgt_class = $wpdb->prefix . 'smgt_class';//register smgt_class table	
	$wpdb->query(
			"ALTER     TABLE $table_smgt_class  MODIFY   class_capacity  int");
	

		smgt_transfer_sectionid();
			
	
}

function smgt_transfer_sectionid()
{	
	$allclass=get_all_data('smgt_class');	
	foreach($allclass as $class)
	{		
		$allsections=smgt_get_class_sections($class->class_id);
		foreach($allsections as $section)
		{		
			$usersdata = get_users(array('meta_key' => 'class_section', 'meta_value' =>$section->section_name,
				'meta_query'=> array(array('key' => 'class_name','value' => $class->class_id,'compare' => '=')),'role'=>'student'));	
				
				foreach($usersdata as $user)
				{					
					update_user_meta( $user->ID, "class_section", $section->id);
				}
		}
	}
}

function smgt_datepicker_dateformat()
{
	$date_format_array = array(
	'Y-m-d'=>'yy-mm-dd',
	'Y/m/d'=>'yy/mm/dd',
	'd-m-Y'=>'dd-mm-yy',
	//'d/m/Y'=>'dd/mm/yy',
	//'m-d-Y'=>'mm-dd-yy',
	'm/d/Y'=>'mm/dd/yy');
	return $date_format_array;
}
function smgt_get_phpdateformat($dateformat_value)
{
	$date_format_array = smgt_datepicker_dateformat();
	$php_format = array_search($dateformat_value, $date_format_array);  
	return  $php_format;	
}

function smgt_getdate_in_input_box($date)
{ 	
	return date(smgt_get_phpdateformat(get_option('smgt_datepicker_format')),strtotime($date));	
}
function smgt_sender_user_list()
{
	$school_obj = new School_Management ( get_current_user_id () );	
	$login_user_role = $school_obj->role;	
	$role = $_REQUEST['send_to'];
	$login_user_role = $school_obj->role;
	
	$class_list = isset($_REQUEST['class_list'])?$_REQUEST['class_list']:'';
	$class_section = isset($_REQUEST['class_section'])?$_REQUEST['class_section']:'';
	//$class_section = 1;
	$query_data['role']=$role;
	$exlude_id = smgt_approve_student_list();

	
	//$results = get_users($query_data);
	$html_class_section = '';
	$return_results['section'] = '';
	$user_list = array();
	global $wpdb;
		$defaultmsg=__( 'Select Class Section' , 'school-mgt');
		$html_class_section =  "<option value=''>".$defaultmsg."</option>";	
	if($class_list != '')
	{
		$retrieve_data=smgt_get_class_sections($class_list);	
		if($retrieve_data)
		foreach($retrieve_data as $section)
		{
			$html_class_section .= "<option value='".$section->id."'>".$section->section_name."</option>";
		}
	}
	if($role == 'student')
	{		
		$query_data['exclude']=$exlude_id;
		if($class_section){
			$query_data['meta_key'] = 'class_section';
			$query_data['meta_value'] = $class_section;
			$query_data['meta_query'] = array(array('key' => 'class_name','value' => $class_list,'compare' => '=') );
			$results = get_users($query_data);
		}
		elseif($class_list != ''){
			$query_data['meta_key'] = 'class_name';
			$query_data['meta_value'] = $class_list;
			$results = get_users($query_data);
		}			
		else{
			if($login_user_role=="parent"){
				$parentdata = get_user_meta(get_current_user_id(),'child',true);				
				 foreach($parentdata as $key=>$val){					
					$studentdata[]= get_userdata($val);					
				}
				$results = $studentdata;			
			}
			
			if($login_user_role=="teacher"){				
			  $teacher_class_data = get_all_teacher_data(get_current_user_id());			
				foreach($teacher_class_data as $data_key=>$data_val){
					$course_id[]=$data_val->class_id;						
					$query_data['meta_key'] = 'class_name';
					$query_data['meta_value'] = $course_id;
					$result= get_users($query_data);
				}
				$results =$result;				 
			}			
		}		
		//$results = get_users($query_data);	
	}
	
	
	
	
	if($role == 'teacher'){
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
	if($role == 'supportstaff')
	{
		
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
	
	$return_results['section'] = $html_class_section;
	$return_results['users'] = '';
	$user_string  = '<select name="selected_users[]" id="selected_users" class="form-control" multiple="true">';
	//$user_string .= '<option value=""> Select User</option>';
	if(!empty($user_data_list))
	foreach($user_data_list as $retrive_data)
	{
		$user_string .= "<option value='".$retrive_data."'>".get_user_name_byid($retrive_data)."</option>";
	}
	$user_string .= '</select>';
	$return_results['users'] = $user_string;
	echo json_encode($return_results);
	die();
}

/* ==================  Frantend Tessage Template  ===============*/
/*function smgt_frontend_sender_user_list()
{
	
	$school_obj = new School_Management ( get_current_user_id () );		
	echo $login_user_role = $school_obj->role;
	die();
	$role = $_REQUEST['send_to'];	
	$class_list = isset($_REQUEST['class_list'])?$_REQUEST['class_list']:'';
	$class_section = isset($_REQUEST['class_section'])?$_REQUEST['class_section']:'';
	//$class_section = 1;
	$query_data['role']=$role;
	$exlude_id = smgt_approve_student_list();

	
	//$results = get_users($query_data);
	$html_class_section = '';
	$return_results['section'] = '';
	$user_list = array();
	global $wpdb;
		$defaultmsg=__( 'Select Class Section' , 'school-mgt');
		$html_class_section =  "<option value=''>".$defaultmsg."</option>";	
	if($class_list != '')
	{
		$retrieve_data=smgt_get_class_sections($class_list);	
		if($retrieve_data)
		foreach($retrieve_data as $section)
		{
			$html_class_section .= "<option value='".$section->id."'>".$section->section_name."</option>";
		}
	}
	if($role == 'student'){
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
		/* $current_role = get_user_role(get_current_user_id());
		if($current_role=="teacher"){
			return $results = "yes";
		}else{
			return $results = get_users($query_data);
		} 
	}
	if($role == 'teacher')
	{
	
		if($class_list != ''){			
			global $wpdb;
			$table_smgt_teacher_class = $wpdb->prefix. 'smgt_teacher_class';	
			$teacher_list = $wpdb->get_results("SELECT * FROM $table_smgt_teacher_class where class_id = $class_list");
			if($teacher_list){
				foreach($teacher_list as $teacher){
					$user_list[] = $teacher->teacher_id;
				}
			}
			
		}
		else
		$results = get_users($query_data);
	}
	if($role == 'supportstaff')
	{
		
		$results = get_users($query_data);
	}
	if($role == 'parent')
	{
		
		if($class_list == '')
		$results = get_users($query_data);
		else{
			$query_data['role'] = 'student';
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
	
	$return_results['section'] = $html_class_section;
	$return_results['users'] = '';
	$user_string  = '<select name="selected_users[]" id="selected_users" class="form-control" multiple="true">';
	//$user_string .= '<option value=""> Select User</option>';
	if(!empty($user_data_list))
	foreach($user_data_list as $retrive_data)
	{
		$user_string .= "<option value='".$retrive_data."'>".get_user_name_byid($retrive_data)."</option>";
	}
	$user_string .= '</select>';
	$return_results['users'] = $user_string;
	echo json_encode($return_results);
	die();
}
*/


function string_replacement($arr,$MsgContent)
{
	$data = str_replace(array_keys($arr),array_values($arr),$MsgContent);
	return $data;
}

add_filter( 'wp_mail_from_name', function( $name ) {
	$from = get_option('smgt_school_name');
	$fromemail = get_option('smgt_email');
	return "{$from}";
});

function smgt_send_mail($email,$subject,$message)
{
	$from		= 	get_option('smgt_school_name');
	$fromemail		= 	get_option('smgt_email');
	
	$message 	= 	"<pre style='font-size:14px'>".$message."</pre>";
	/* $headers	=	"";
	$headers   .= 	'From:'.$from."<$fromemail>\r\n";
	$headers   .= 	"MIME-Version: 1.0\r\n";
	$headers   .= "	Content-Type: text/html; charset=UTF-8\r\n"; */
		
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	wp_mail($email,$subject,$message,$headers);	
}

function get_user_role($id){	
	$result = get_userdata($id);
	$role = implode(', ', $result->roles);
	return $role;
}
//geting teacher class studet

function get_currency_symbol( $currency = '' )
{	
	$currency = get_option('smgt_currency_code');
	
	switch ( $currency ) {
	case 'AED' :
	$currency_symbol = 'د.إ';
	break;
	case 'AUD' :
	$currency_symbol = '&#36;';
	break;
	case 'CAD' :
	$currency_symbol = 'C&#36;';
	break;
	case 'CLP' :	
	case 'COP' :	
	case 'HKD' :
	$currency_symbol = '&#36';
	break;
	case 'MXN' :
	$currency_symbol = '&#36';
	break;
	case 'NZD' :
	$currency_symbol = '&#36';
	break;
	case 'SGD' :	
	case 'USD' :
	$currency_symbol = '&#36;';
	break;
	case 'BDT':
	$currency_symbol = '&#2547;&nbsp;';
	break;
	case 'BGN' :
	$currency_symbol = '&#1083;&#1074;.';
	break;
	case 'BRL' :
	$currency_symbol = '&#82;&#36;';
	break;
	case 'CHF' :
	$currency_symbol = '&#67;&#72;&#70;';
	break;
	case 'CNY' :
	case 'JPY' :
	case 'RMB' :
	$currency_symbol = '&yen;';
	break;
	case 'CZK' :
	$currency_symbol = '&#75;&#269;';
	break;
	case 'DKK' :
	$currency_symbol = 'kr.';
	break;
	case 'DOP' :
	$currency_symbol = 'RD&#36;';
	break;
	case 'EGP' :
	$currency_symbol = 'EGP';
	break;
	case 'EUR' :
	$currency_symbol = '&euro;';
	break;
	case 'GBP' :
	$currency_symbol = '&pound;';
	break;
	case 'HRK' :
	$currency_symbol = 'Kn';
	break;
	case 'HUF' :
	$currency_symbol = '&#70;&#116;';
	break;
	case 'IDR' :
	$currency_symbol = 'Rp';
	break;
	case 'ILS' :
	$currency_symbol = '&#8362;';
	break;
	case 'INR' :
	$currency_symbol = 'INR';
	break;
	case 'ISK' :
	$currency_symbol = 'Kr.';
	break;
	case 'KIP' :
	$currency_symbol = '&#8365;';
	break;
	case 'KRW' :
	$currency_symbol = '&#8361;';
	break;
	case 'MYR' :
	$currency_symbol = '&#82;&#77;';
	break;
	case 'NGN' :
	$currency_symbol = '&#8358;';
	break;
	case 'NOK' :
	$currency_symbol = '&#107;&#114;';
	break;
	case 'NPR' :
	$currency_symbol = 'Rs.';
	break;
	case 'PHP' :
	$currency_symbol = '&#8369;';
	break;
	case 'PLN' :
	$currency_symbol = '&#122;&#322;';
	break;
	case 'PYG' :
	$currency_symbol = '&#8370;';
	break;
	case 'RON' :
	$currency_symbol = 'lei';
	break;
	case 'RUB' :
	$currency_symbol = '&#1088;&#1091;&#1073;.';
	break;
	case 'SEK' :
	$currency_symbol = '&#107;&#114;';
	break;
	case 'THB' :
	$currency_symbol = '&#3647;';
	break;
	case 'TRY' :
	$currency_symbol = '&#8378;';
	break;
	case 'TWD' :
	$currency_symbol = '&#78;&#84;&#36;';
	break;
	case 'UAH' :
	$currency_symbol = '&#8372;';
	break;
	case 'VND' :
	$currency_symbol = '&#8363;';
	break;
	case 'ZAR' :
	$currency_symbol = '&#82;';
	break;
	case 'GHC' :
	$currency_symbol = '&#8373;';
	break;
	default :
	$currency_symbol = $currency;
	break;
	}	
return $currency_symbol;
}

function get_teacher_by_class_id($class_id)
{	
	global $wpdb;
	$tbl_name 	= 	$wpdb->prefix .'smgt_teacher_class';	
	$teachers	=	$wpdb->get_results("SELECT * FROM $tbl_name where class_id=".$class_id);
	foreach($teachers as $key=>$teacher)
	{		
		$teachersdata[] = get_userdata($teacher->teacher_id);		
	}
	return $teachersdata;
}

function GetHTMLContent($fees_pay_id)
{		
	$schooName 	= 	get_option('smgt_school_name');
	$schooLogo 	= 	get_option('smgt_school_logo');
	$schooAddress	= 	get_option( 'smgt_school_address' );
	$schoolCountry	= 	get_option( 'smgt_contry' );
	$schoolNo 	=  get_option( 'smgt_contact_number' );
			
	$fees_detail_result = get_single_fees_payment_record($fees_pay_id);	
	$fees_history_detail_result = get_payment_history_by_feespayid($fees_pay_id);
	
	$student_id=$fees_detail_result->student_id;
		$abc="";
	if($student_id !=0)
	{
		$patient=get_userdata($student_id);												
		$patient->display_name."<br>"; 
		$abc = get_user_meta( $student_id,'address',true ).",".get_user_meta( $student_id,'city',true ).",". get_user_meta( $student_id,'zip_code',true ).",<BR>". get_user_meta( $student_id,'state',true ).",".get_option( 'smgt_contry' ).",".get_user_meta( $student_id,'mobile',true )."<br>";
	}
	
	
	
	
	$content	='';
	$content	.='';
	
	$content='	
	<div style="background-color:aliceblue; padding:20px"; class="modal-body">
		<div class="modal-header">
			<h4 class="modal-title">'.$schooName.'</h4>
		</div>
		<div id="invoice_print" class="print-box"> 
			<table width="100%" border="0">
				<tbody>
					<tr>
						<td width="70%">
							<img style="max-height:80px;" src="'.$schooLogo.'">
						</td>
						<td align="right" width="24%">
							<h5>'; ?>
							<?php 
							$payment_status = get_payment_status($fees_detail_result->fees_pay_id);					
							if($payment_status=='Paid') 
								$PStatus= 'Paid';
							if($payment_status=='Partially Paid')
								$PStatus =  'Part Paid';
							if($payment_status=='Unpaid')
								$PStatus = 'Unpaid';
							else
								$PStatus ="";
									
							$issue_date="DD-MM-YYYY";
							$issue_date=$fees_detail_result->paid_by_date;	
							$content .= 'Issue Date: '. smgt_getdate_in_input_box(date("Y-m-d", strtotime($issue_date))).'</h5>';					
							$content .= '<h5>Status : <span class="btn btn-success btn-xs">'. $PStatus .'"</span>"</h5>';	
							$content .= '</td></tr><tbody></table>
							
							<table width="100%" border="0">
								<tbody>
									<tr>
										<td align="left">
											<h4>Payment From</h4>
										</td>
										<td align="right">
											<h4>Bill To</h4>
										</td>
									</tr>
									<tr>
										<td valign="top" align="left">
											'.$schooName.'<br>
											'.$schooAddress.',
											'.$schoolCountry .'<br>
											'.$schoolNo.'<br>		
										</td>
										<td valign="top" align="right">'.$abc.'</td>
								</tr>
							</tbody>
						</table><hr>
						<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center"> Fees Type</th>
									<th><Total </th>					
								</tr>
							</thead>
							<tbody>
								<td>1</td>
								<td>'.get_fees_term_name($fees_detail_result->fees_id).'</td>
								<td><span>'. get_currency_symbol() ." </span>" . number_format($fees_detail_result->total_amount,2).'</td>
							</tbody>
						</table>
						
						<table width="100%" border="0">
							<tbody>							
								<tr>
									<td width="80%" align="right">Sub Total :</td>
									<td align="right"><span>'.get_currency_symbol() ." </span>" .number_format($fees_detail_result->total_amount,2) .'</td>
								</tr>
								<tr>
									<td width="80%" align="right">Payment Made :</td>
									<td align="right"><span>'. get_currency_symbol() ." </span>" . number_format($fees_detail_result->fees_paid_amount,2) .'</td>
								</tr>
								<tr>
									<td width="80%" align="right">Due Amount  :</td>'.
									$Due_amount = $fees_detail_result->total_amount - $fees_detail_result->fees_paid_amount; ?>
									<td align="right"><?php echo "<span> ". get_currency_symbol() ." </span>" .number_format($Due_amount,2) ?></td>
								<?php $content .='</tr>				
							</tbody>
						</table></div></div>';
						return $content;
}
//strip tags and slashes
function smgt_strip_tags_and_stripslashes($string)
{
	$new_string=stripslashes(strip_tags($string));
	return $new_string;
}	
//dashboard page access right
function page_access_rolewise_accessright_dashboard($page)
{
	$school_obj = new School_Management ( get_current_user_id () );	
	$role = $school_obj->role;
	$menu = get_option( 'smgt_access_right');	
	
	foreach ( $menu as $key=>$value ) 
	{		
		if($value['page_link'] == $page)
		{
			return $flage=$value[$role];
		}	
	}	
} 
// CHANGE PROFILE PHOTO IN USER DASHBOARD //
function smgt_change_profile_photo()
{
	?>
	<div class="modal-header"> <a href="#" class="close-btn-cat badge badge-danger pull-right">X</a>
	</div>
	<form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
	<div class="form-group">
	<label for="inputEmail" class="control-label col-sm-3"><?php _e('Select Profile Picture','school-mgt');?></label>
		<div class="col-xs-8">	
			<input id="input-1" name="profile" type="file" onchange="fileCheck(this);" style="border:0px;"  class="form-control file">
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-offset-2 col-sm-10" style="margin-bottom: 5px;">
				<button type="submit" class="btn btn-success" name="save_profile_pic"><?php _e('Save','school-mgt');?></button>
		</div>
	</div>
	</form>
    <?php 
	die();
}
function MJ_smgt_password_validation($post_string)
{
	$string = str_replace('&nbsp;', ' ', $post_string);
    $string = html_entity_decode($string, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');
    $string = html_entity_decode($string);
    $string = htmlspecialchars_decode($string);
    $string = strip_tags($string);
	$replase_string=preg_replace('/[^0-9a-zA-Z\ \_\,\`\.\'\^\-\&\@\()\{}\[]\|\|\=\%\*\%\#\!\~\$\<>\+\n]/s', '', $string);
	return $replase_string;
}

//REMOVE HTML ENTITY STRING FUNCTION 

function MJ_smgt_email_validation($post_string)
{
	$string = str_replace('&nbsp;', ' ', $post_string);
    $string = html_entity_decode($string, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');
    $string = html_entity_decode($string);
    $string = htmlspecialchars_decode($string);
    $string = strip_tags($string);
	$replase_string=preg_replace('/[^0-9a-zA-Z\ \_\,\`\.\'\^\-\&\@\+\n]/s', '', $string);
	return $replase_string;
}
//REMOVE HTML ENTITY STRING FUNCTION //
 //1)roll_id 2)address_description
function MJ_smgt_address_description_validation($post_string)
{
	$string = str_replace('&nbsp;', ' ', $post_string);
    $string = html_entity_decode($string, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');
    $string = html_entity_decode($string);
    $string = htmlspecialchars_decode($string);
    $string = strip_tags($string);
	$replase_string=preg_replace('/[^0-9a-zA-Z\ \_\,\`\.\'\^\-\&\@\+\n]/s', '', $string);
	return $replase_string;
}

function MJ_smgt_phone_number_validation($post_string)
{
	$string = str_replace('&nbsp;', ' ', $post_string);
    $string = html_entity_decode($string, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');
    $string = html_entity_decode($string);
    $string = htmlspecialchars_decode($string);
    $string = strip_tags($string);
	$replase_string=preg_replace('/[^0-9\ \-\+]/s', '', $string);
	return $replase_string;
}

function MJ_smgt_username_validation($post_string)
{
	$string = str_replace('&nbsp;', ' ', $post_string);
    $string = html_entity_decode($string, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');
    $string = html_entity_decode($string);
    $string = htmlspecialchars_decode($string);
    $string = strip_tags($string);
	$replase_string=preg_replace('/[^0-9a-zA-Z\_\.\-\@]/s', '', $string);
	return $replase_string;
}


function MJ_smgt_popup_category_validation($post_string)
{
	$string = str_replace('&nbsp;', ' ', $post_string);
    $string = html_entity_decode($string, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');
    $string = html_entity_decode($string);
    $string = htmlspecialchars_decode($string);
    $string = strip_tags($string);
	$replase_string=preg_replace('/[^0-9a-zA-Z\ \_\,\`\.\'\^]/s', '', $string);
	return $replase_string;
}
function MJ_smgt_city_state_country_validation($post_string)
{
	$string = str_replace('&nbsp;', ' ', $post_string);
    $string = html_entity_decode($string, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');
    $string = html_entity_decode($string);
    $string = htmlspecialchars_decode($string);
    $string = strip_tags($string);
	$replase_string=preg_replace('/[^\x00-\x80]|[^a-zA-Z\ \_\,\`\.\'\^\-\&]/s', '', $string);
	return $replase_string;
}

function MJ_smgt_onlyLetter_specialcharacter_validation($post_string)
{
	$string = str_replace('&nbsp;', ' ', $post_string);
    $string = html_entity_decode($string, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');
    $string = html_entity_decode($string);
    $string = htmlspecialchars_decode($string);
    $string = strip_tags($string);
	$replase_string=preg_replace('/[^\x00-\x80]|[^a-zA-Z\ \_\,\`\.\'\^\-]/s', '', $string);
	return $replase_string;
}

function MJ_smgt_onlyLetterNumber_validation($post_string)
{
	$string = str_replace('&nbsp;', ' ', $post_string);
    $string = html_entity_decode($string, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');
    $string = html_entity_decode($string);
    $string = htmlspecialchars_decode($string);
    $string = strip_tags($string);
	$replase_string=preg_replace('/[^0-9a-zA-Z]/s', '', $string);
	return $replase_string;
}
/* function MJ_smgt_onlyLetterAccentSp_validation($post_string)
{
	$string = str_replace('&nbsp;', ' ', $post_string);
    $string = html_entity_decode($string, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');
    $string = html_entity_decode($string);
    $string = htmlspecialchars_decode($string);
    $string = strip_tags($string);
	$replase_string=preg_replace('/[^a-z\u00C0-\u017F\ ]/s', '', $string);
	return $replase_string;
} */

function MJ_smgt_onlyLetterSp_validation($post_string)
{
	$string = str_replace('&nbsp;', ' ', $post_string);
    $string = html_entity_decode($string, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');
    $string = html_entity_decode($string);
    $string = htmlspecialchars_decode($string);
    $string = strip_tags($string);
	$replase_string=preg_replace('/[^\x00-\x80]|[^a-zA-Z\ \']/s', '', $string);
	return $replase_string;
}

function MJ_smgt_onlyNumberSp_validation($post_string)
{
	$string = str_replace('&nbsp;', ' ', $post_string);
    $string = html_entity_decode($string, ENT_QUOTES | ENT_COMPAT , 'UTF-8');
    $string = html_entity_decode($string, ENT_HTML5, 'UTF-8');
    $string = html_entity_decode($string);
    $string = htmlspecialchars_decode($string);
    $string = strip_tags($string);
	$replase_string=preg_replace('/[^0-9\ ]/s', '', $string);
	return $replase_string;
}
function smgt_count_student_in_class()
{
	global $wpdb;
	$table_name = $wpdb->prefix .'smgt_class';
	$class_id=$_POST['class_id'];
	$student_list =count( get_users(array('meta_key' => 'class_name', 'meta_value' => $class_id, 'role'=>'student')));
	$class_capacity_data =$wpdb->get_row("SELECT class_capacity FROM $table_name WHERE class_id=".$class_id);
	$class_capacity=intval($class_capacity_data->class_capacity);
	
	$class_data=array();
	
	if($class_capacity > $student_list)
	{
		echo "class_empt";
		
		$class_data[0]='class_empt';
	}
	else
	{
		
		$class_data[0]='class_full';
		$class_data[1]=$class_capacity;
		$class_data[2]=$student_list;
	}
	echo json_encode($class_data);
	die;
}

function convert_date_time($date_time)
{
	$format = get_option( 'smgt_datepicker_format' );
	
	if($format == 'yy-mm-dd')
	{
		$change_formate='Y-m-d';
	}
	elseif($format == 'yy/mm/dd')
	{
		$change_formate='Y/m/d';
		
	}
	elseif($format == 'dd-mm-yy')
	{
		$change_formate='d-m-Y';
		
	}
	elseif($format == 'mm/dd/yy')
	{
		$change_formate='m/d/Y';
	}
	else
	{
		$change_formate='Y-m-d';
	}
	//$date='2019-08-22 10:29:56';
	$timestamp = strtotime( $date_time ); // Converting time to Unix timestamp
	$offset = get_option( 'gmt_offset' ) * 60 * 60; // Time offset in seconds
	$local_timestamp = $timestamp + $offset;
	$local_time = date_i18n($change_formate .' H:i:s', $local_timestamp );
	return $local_time;
}
?>