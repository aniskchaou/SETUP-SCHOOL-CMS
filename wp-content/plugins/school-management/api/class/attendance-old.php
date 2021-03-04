<?php 
class Attendance{
	public function __construct() {
		add_action('template_redirect', array($this,'redirectMethod'), 1);
		
	}
	public function redirectMethod()
	{
		
		//error_reporting(0);
			if($_REQUEST['smgt-json-api']=='save-attendance')
			{	
				$school_obj = new School_Management($_REQUEST['student_id']);
				if($school_obj->role=='student'){
					$response=$this->attendance_save($_REQUEST);	
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
			if($_REQUEST['smgt-json-api']=='save-teacher-attendance')
			{	
				$school_obj = new School_Management($_REQUEST['teacher_id']);
				if($school_obj->role=='teacher'){
					$response=$this->teacher_attendance_save($_REQUEST);	
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
			if($_REQUEST['smgt-json-api']=='save-subject-attendance')
			{	
				$school_obj = new School_Management($_REQUEST['student_id']);
				if($school_obj->role=='student'){
					$response=$this->attendance_save_subject($_REQUEST);	
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
			if($_REQUEST['smgt-json-api']=='view-attendance-list')
			{	
				$school_obj = new School_Management($_REQUEST['current_user']);
					if($school_obj->role=='teacher' || $school_obj->role=='admin'){
					$response=$this->attendance_view_list($_REQUEST);	
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
			if($_REQUEST['smgt-json-api']=='view-teacher-attendance-list')
			{	
				$school_obj = new School_Management($_REQUEST['current_user']);
					if($school_obj->role=='admin'){
					$response=$this->teachers_attendance_list($_REQUEST);	
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
			if($_REQUEST['smgt-json-api']=='view-subject-attendance-list')
			{	
				$school_obj = new School_Management($_REQUEST['current_user']);
					if($school_obj->role=='teacher' || $school_obj->role=='admin'){
					$response=$this->subject_attendance_view_list($_REQUEST);	
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
	public function attendance_save_subject($data)
	{	
		$response=array();
		$obj_attend=new Attendence_Manage();
		if($_REQUEST['current_user']!=0)
		$school_obj = new School_Management($data['current_user']);
		if($school_obj->role=='teacher' || $school_obj->role=='admin'){
			if($data['attendance_date']!="" && $data['student_id']!="" && $data['class_id']!="" && $data['attendance_status']!="" &&  $data['current_user']!="" && $data['subject_id']!=""){	

			$result = $obj_attend->insert_subject_wise_attendance($data['attendance_date'],$data['class_id'],$data['student_id'],$data['current_user'],$data['attendance_status'],$data['subject_id'],$data['attendance_comment']);	
			
			if($result!=0){
					$message['message']=__("Record successfully Inserted",'school-mgt');
					$response['status']=1;
					$response['resource']=$message;
				}	
			}
			else
			{
				$message['message']=__("Please Fill All Fields",'school-mgt');
				$response['status']=0;
				$response['resource']=$message;
			}
			return $response;
		}
	}
	public function attendance_save($data)
	{	
		$response=array();
		$obj_attend=new Attendence_Manage();
		if($_REQUEST['current_user']!=0)
		$school_obj = new School_Management($_REQUEST['current_user']);
		
		if($school_obj->role=='teacher' || $school_obj->role=='admin'){
		
			if($data['attendance_date']!="" && $data['student_id']!="" && $data['class_id']!="" && $data['attendance_status']!="" &&  $data['current_user']!=""){	
			
			$result = $obj_attend->insert_student_attendance($data['attendance_date'],$data['class_id'],$data['student_id'],$data['current_user'],$data['attendance_status'],$data['attendance_comment']);	
			
			if($result!=0){
					$message['message']=__("Record successfully Inserted",'school-mgt');
					$response['status']=1;
					$response['resource']=$message;
				}	
			}
			else
			{
				$message['message']=__("Please Fill All Fields",'school-mgt');
				$response['status']=0;
				$response['resource']=$message;
			}
			return $response;
		}
	}
	public function teacher_attendance_save($data)
	{	
		$response=array();
		$obj_attend=new Attendence_Manage();
		if($_REQUEST['current_user']!=0)
		$school_obj = new School_Management($_REQUEST['current_user']);
		if($school_obj->role=='admin'){
			if($data['attendance_date']!="" && $data['teacher_id']!="" && $data['attendance_status']!="" &&  $data['current_user']!=""){	

			$result = $obj_attend->insert_teacher_attendance($data['attendance_date'],$data['teacher_id'],$data['current_user'],$data['attendance_status'],$data['attendance_comment']);	
			
			if($result!=0){
					$message['message']=__("Record successfully Inserted",'school-mgt');
					$response['status']=1;
					$response['resource']=$message;
					return $response;
				}
					
			}
			else
			{
				$error['message']=__("Please Fill All Fields",'school-mgt');
				$response['status']=0;
				$response['resource']=$error;
			}
				return $response;
			
		}
		
		
	}
	public function attendance_view_list($data)
	{		
		
		$obj_attend=new Attendence_Manage();
		$class_id=$data['class_id'];
		$class_section=0;
		if($data['class_id']!="" && $data['section_id']!="" && $data['current_user']!="" && $data['current_user']!=0){  
			if(isset($data['section_id']) && $data['section_id'] !=0){
				$class_section=$data['section_id'];
				$exlude_id = smgt_approve_student_list();
				$student = get_users(array('meta_key' => 'class_section', 'meta_value' =>$data['section_id'],
						 'meta_query'=> array(array('key' => 'class_name','value' => $class_id,'compare' => '=')),'role'=>'student','exclude'=>$exlude_id));	
			}
			else
			{ 
				$exlude_id = smgt_approve_student_list();
					  $student = get_users(array('meta_key' => 'class_name', 'meta_value' => $class_id,'role'=>'student','exclude'=>$exlude_id));
			}
			
			$response=array();
			if(!empty($student))
			{
				$result['date']=$data['attendance_date'];
				$result['class']=get_class_name($class_id);
				if($class_section!=""){
					$section=smgt_get_section_name($class_section); 
				}
				else
				{
					$section=__('No Section','school-mgt');
				}
				$result['section']=$section;
				foreach($student as $user ){
					    $date = $data['attendance_date'];
						
						$check_attendance = $obj_attend->check_attendence($user->ID,$class_id,$date);
						$attendanc_status = "";
						if(!empty($check_attendance))
						{
							$attendanc_status = $check_attendance->status;

						}
						else
						{
							$comment="";
							$obj_attend->insert_student_attendance($date,$class_id,$user->ID,$data['current_user'],"Present",$comment);
							$check_attendance =$obj_attend->check_attendence($user->ID,$class_id,$date);
							$attendanc_status = $check_attendance->status;
						}
						$students[]=array('student_id'=>$user->ID,'student_name'=>$user->display_name,'attendance_status'=>$attendanc_status);
				}
				$result['students']=$students;
				$response['status']=1;
				$response['resource']=$result;
				return $response;
			}
			
		}
		else
			{
			
				$error['message']=__("Please Fill All Fields",'school-mgt');
				$response['status']=0;
				$response['resource']=$error;
			}
				return $response;
	}
	public function subject_attendance_view_list($data)
	{		
		
			$obj_attend=new Attendence_Manage();
			$class_id=$data['class_id'];
			$class_section=0;
		if($data['class_id']!="" && $data['section_id']!="" && $data['subject_id']!="" && $data['current_user']!="" && $data['current_user']!=0){  
			if(isset($data['section_id']) && $data['section_id'] !=0){
				$class_section=$data['section_id'];
				$exlude_id = smgt_approve_student_list();
				$student = get_users(array('meta_key' => 'class_section', 'meta_value' =>$data['section_id'],
						 'meta_query'=> array(array('key' => 'class_name','value' => $class_id,'compare' => '=')),'role'=>'student','exclude'=>$exlude_id));	
			}
			else
			{ 
				$exlude_id = smgt_approve_student_list();
					  $student = get_users(array('meta_key' => 'class_name', 'meta_value' => $class_id,'role'=>'student','exclude'=>$exlude_id));
			}
			
			$response=array();
			if(!empty($student))
			{
				$result['date']=$data['attendance_date'];
				$result['class']=get_class_name($class_id);
				if($class_section!=""){
					$section=smgt_get_section_name($class_section); 
				}
				else
				{
					$section=__('No Section','school-mgt');
				}
				$result['section']=$section;
				$result['subject']=get_subject_byid($data['subject_id']);
				foreach($student as $user ){
					$date = $data['attendance_date'];
						$check_attendance = $obj_attend->check_sub_attendence($user->ID,$class_id,$date,$data['subject_id']);
						$attendanc_status = "";
						if(!empty($check_attendance))
						{
							$attendanc_status = $check_attendance->status;
							
						}
						else
						{
							$comment="";
							$obj_attend->insert_subject_wise_attendance($date,$class_id,$user->ID,$data['current_user'],"Present",$data['subject_id'],$comment);
							$check_attendance = $obj_attend->check_sub_attendence($user->ID,$class_id,$date,$data['subject_id']);
							$attendanc_status = $check_attendance->status;
						}
							
						$students[]=array('student_id'=>$user->ID,'student_name'=>$user->display_name,'attendance_status'=>$attendanc_status);
						
				}
				$result['students']=$students;
				$response['status']=1;
				$response['resource']=$result;
				return $response;
			}
			
		}
		else
		{
			$error['message']=__("Please Fill All Fields",'school-mgt');
			$response['status']=0;
			$response['resource']=$error;
		}
			return $response;
	}
	public function teachers_attendance_list($data)
	{		
		$response=array();
		$obj_attend=new Attendence_Manage();
		 $teacher = get_users(array('role'=>'teacher'));
           $class_id=0;
			if(!empty($teacher))
			{
				$result['date']=$data['attendance_date'];
				
				
				 foreach ($teacher as $user) {
					$date = $data['attendance_date'];
					   
						$check_attendance = $obj_attend->check_attendence($user->ID,$class_id,$date);
						$attendanc_status = "";
						if(!empty($check_attendance))
						{
							$attendanc_status = $check_attendance->status;
							
						}
						if($attendanc_status=="")
							$attendanc_status="Present";
						$teachers[]=array('teacher_id'=>$user->ID,'teacher_name'=>$user->display_name,'attendance_status'=>$attendanc_status);
						
				}
				$result['teachers']=$teachers;
				$response['status']=1;
				$response['resource']=$result;
				//return $response;
			}
			else
			{
				$error['message']=__("Please Fill All Fields",'school-mgt');
				$response['status']=0;
				$response['resource']=$error;
			}
				return $response;		
	}
	
	
} ?>