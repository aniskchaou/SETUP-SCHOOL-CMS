<?php 
class StudentListing
{
	public function __construct() {
		add_action('template_redirect', array($this,'redirectMethod'), 1);
		
	}
	
	public function redirectMethod()
	{
		
		if($_REQUEST["smgt-json-api"]=='student-listing')
		{
			
			if(isset($_REQUEST["current_user"]))
			{				
				$response=$this->student_listing($_REQUEST);	 
			}
			else
			{			
				$response=$this->student_listing();
			}
			if(is_array($response)){
				echo json_encode($response);
			}
			else
			{
				header("HTTP/1.1 401 Unauthorized");
			}
			die();
		}
		if($_REQUEST["smgt-json-api"]=='edit-student')
		{		
			$school_obj = new School_Management($_REQUEST['current_user']);
			$role = smgt_get_role($_REQUEST['student_id']);
			
			if($role[0]=='admin'){
				$response=$this->api_edit_student($_REQUEST);	 
			}
			elseif($role[0]=='student'){
				$response=$this->api_edit_student($_REQUEST);	 
			}
			if(is_array($response)){
				echo json_encode($response);
			}
			else
			{
				header("HTTP/1.1 401 Unauthorized");
			}
			die();
		}
		if($_REQUEST['smgt-json-api']=='delete-student')
		{
			$school_obj = new School_Management($_REQUEST['current_user']);
			if($school_obj->role=='admin'){
				$response=$this->delete_student($_REQUEST);	 
			}
			if(is_array($response)){
				echo json_encode($response);
			}
			else
			{
				header("HTTP/1.1 401 Unauthorized");
			}
			die();
		}
			
	}
	
public function student_listing($data)
{
	if($data["current_user"]!=0){
		$role= smgt_get_user_role($data["current_user"]);
		
		if($role=='parent'){
			$studentdata =$school_obj->child_list;
		}
		
		if($role=='teacher'){
			$studentdata =$school_obj->student;
		}
		
		if($role=='supportstaff'){
			$studentdata =$school_obj->student;
		}
		
		if($role=='student'){			
			//$studentdata =$school_obj->student;
			$student = get_userdata($data["current_user"]);		
			$exlude_id = smgt_approve_student_list();
			$studentdata = get_users(array('meta_key' => 'class_name', 'meta_value' => $student->class_name, 'role'=>'student','exclude'=>$exlude_id));
			 		
		}
	
		if($role=='admin'){
			$studentdata =get_users(array('role'=>'student'));
		}	
	}	

	
	$filter_classid=0;
	$section_id=0;
	
	if(isset($data['class_id']) && $data['class_id']!=0)
	{
		$filter_classid=$data['class_id'];
	}
	
	if(isset($data['section_id']) && $data['section_id']!=0)
	{
		$section_id=$data['section_id'];
	}
	//$response=array();
		
	if(!empty($studentdata)){		
		$i=0;		
		$rollno="Roll NO";
	if($role=='student')
	{		
		foreach($studentdata as $retrieved_data)
		{
			$userimagedata=get_user_image($retrieved_data->ID);
			if(empty($userimagedata['meta_value']))
			{
				$imageurl=get_option( 'smgt_student_thumb');
			}
			else
			{
				$imageurl=$userimagedata['meta_value'];
			}
			if(get_user_meta($retrieved_data->ID, 'roll_id', true))
				$rollno=get_user_meta($retrieved_data->ID, 'roll_id',true);
				$class_id=get_user_meta($retrieved_data->ID, 'class_name',true);
				$classname=get_class_name($class_id);
				$section_name=get_user_meta($retrieved_data->ID, 'class_section',true);
				
				if($section_name!=''){
					$section=smgt_get_section_name($section_name); 
				}
				else
				{
					$section=__('No Section','school-mgt');
				} 
				
				$result[$i]['ID']=$retrieved_data->ID;
				$result[$i]['image']=$imageurl;
				$result[$i]['name']=$retrieved_data->display_name;
				$result[$i]['rollno']=$rollno;
				$result[$i]['class']=$classname;
				$result[$i]['section']=$section;
				$result[$i]['email']=$retrieved_data->user_email;
				$i++; 
		}
	}
		$response['status']=1;
		$response['resource']=$result;
	}
	else
	{
		//$error['message']=__("Please Fill All Fields",'school-mgt');
		$response['status']=0;
		$response['message']=__("Record not found",'school-mgt');
	}
	return $response; 

}



function api_edit_student($data)
{
var_dump($data);
die;		
		
		var_dump($data);
		die;
		$firstname=$data['first_name'];
			$lastname=$data['last_name'];
			$userdata = array(
			'user_login'=>$data['username'],			
			'user_nicename'=>NULL,
			'user_email'=>$data['email'],
			'user_url'=>NULL,
			'display_name'=>$firstname." ".$lastname,
			);
			if($data['password'] != "")
				$userdata['user_pass']=$data['password'];
			$userdata['ID']=$data['student_id'];
			$usermetadata=array('middle_name'=>$data['middle_name'],
						'gender'=>$data['gender'],
						'birth_date'=>$data['birth_date'],
						'address'=>$data['address'],
						'city'=>$data['city_name'],
						'state'=>$data['state_name'],
						'zip_code'=>$data['zip_code'],
						'class_name'=>$data['class_name'],
						'class_section'=>$data['class_section'],
						'phone'=>$data['phone'],
						'mobile_number'=>$data['mobile_number'],
						'alternet_mobile_number'=>$data['alternet_mobile_number'],
						'smgt_user_avatar'=>$data['smgt_user_avatar']);
		
					
		$user_id = wp_update_user($userdata);
		$flag=0;
		foreach($usermetadata as $key=>$val){
		
			$returnans=update_user_meta( $data['student_id'], $key,$val );
			if($returnans){
				$returnval=$returnans;
				$flag=1;
			}
		}
		
		if($flag=1)
		{
			$message=__("Record successfully Updated!","school-mgt");
			$response['status']=1;
			$response['resource']=$message;
			return $response;
		}
		else
		{
			$error['message']=__("Record Not Updated",'school-mgt');
			$response['status']=0;
			$response['resource']=$error;
		}
			return $response;	
	}
	public function delete_student($data)
	{
		$response=array();
		if($data['student_id']!=0){
			$result=delete_usedata($data['student_id']);
			if($result)
			{
				$message=__("Record successfully Deleted!","school-mgt");
				$response['status']=1;
				$response['resource']=$message;
				return $response;
			}
			else
			{
				$error['message']=__("Records Not Delete",'school-mgt');
				$response['status']=0;
				$response['resource']=$error;
			}
			return $response;
		}
		else
		{
			$message['message']=__("Please Fill All Fields",'school-mgt');
			$response['status']=0;
			$response['resource']=$message;
		}
			return $response;
		
	}
} ?>