<?php
class Attendance 
	public function __construct() 
	{
	public function redirectMethod() 
		if($_REQUEST['smgt-json-api']=='save-attendance')
		}
		
		
		if($_REQUEST['smgt-json-api']=='view-student-attandance')
		{	
			print "Yea"; die;
			$role = smgt_get_roles($_REQUEST['current_user']);
			if($role=='student')
			}				
				echo json_encode($response);
			}
			else
			{
				header("HTTP/1.1 401 Unauthorized");
			}
			die();
		
		if($_REQUEST['smgt-json-api']=='view-student-subjectwise-attandance')
			//$role = smgt_get_roles($_REQUEST['current_user']);
			//if($role=='student'){
			$response=$this->studnent_subject_attendance_view($_REQUEST);
			//}				
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
			if(is_array($response)){
		if($_REQUEST['smgt-json-api']=='save-subject-attendance')
		
			$role = smgt_get_roles($_REQUEST['current_user']);
			
							
		if($_REQUEST['smgt-json-api']=='view-teacher-attendance-list')
		{	
		if($_REQUEST['smgt-json-api']=='view-subject-attendance-list')
	
	
	
	
	
	public function studnent_attendance_view($data)
	{
		$response=array();
		$uid=$data['current_user'];
		global $wpdb;
		$tbl_name = $wpdb->prefix.'attendence';
		$sql ="SELECT * FROM $tbl_name WHERE user_id=$uid";
		$AttData = $wpdb->get_results($sql);
		$response['status']=1;
		$response['error']="";
		//var_dump($AttData);
		//die;
		foreach($AttData as $key=>$attendance)
		{		
			$result[] = array(
				'attendance_date'=>$attendance->attendence_date,
				'status'=>$attendance->status,
				'day'=>date('l', strtotime($attendance->attendence_date))
			);
		}
		$response['result']=$result;
		return $response;
		
	public function studnent_subject_attendance_view($data)
		$holidaydates= array();		
		foreach($HolidayData as $holiday)
		{
			$holidaydates[] = $holiday->date;
			$holidaydates[] = $holiday->end_date;
			$start_date = strtotime($holiday->date);
			$end_date =strtotime($holiday->end_date);
			if($holiday->date != $holiday->end_date)
			{
				for($i=$start_date; $i<$end_date; $i+=86400)
				{
					$holidaydates[] = date("Y-m-d",$i);
				}
			}
		}
		$holidaydates = array_unique($holidaydates);
		$AttData = $wpdb->get_results($sql);
		if(!empty($AttData))
		{
			$response['status']=1;
			foreach($AttData as $key=>$attendance)
			{
				$attendancedate[] = $attendance->attendance_date;
				$status = get_attendace_status($attendance->attendance_date);			
				if($status)
				{
					$status = "Holiday";
				}
				else
				{
					$status = $attendance->status;
				}
				$result[] = array(
					'attendance_date'=>$attendance->attendance_date,
					'status'=>$status,
					'subject'=>get_single_subject_name($attendance->sub_id),
					'subject_id'=>$attendance->sub_id,
					'Day'=>date('l', strtotime($attendance->attendance_date))
				);
			}
			
			 foreach($holidaydates as $holiday)
			{
				if(!in_array($holiday,$attendancedate))
				{
					$result[] = array(
						'attendance_date'=>$holiday,
						'status'=>"Holiday",
						'subject'=>null,
						'subject_id'=>null,
						'Day'=>null
					);
				
				}
			} 
			
			$message['message']=__("Record successfully Inserted",'school-mgt');
			$response['result']=$result;
		}
		else
		{
			$response['status']=0;			
			$response['message']=__("Not Record Found",'school-mgt');
		}
		return $response;
		
	}
	
	public function attendance_save_subject($data)
	{
		$response=array();
		$obj_attend=new Attendence_Manage();
		if($_REQUEST['current_user']!=0)
		$school_obj = new School_Management($data['current_user']);
		if($school_obj->role=='teacher' || $school_obj->role=='admin')
		{
			if($data['attendance_date']!="" && $data['student_id']!="" && $data['class_id']!="" && $data['attendance_status']!="" &&  $data['current_user']!="" && $data['subject_id']!="")
			{
				$result = $obj_attend->insert_subject_wise_attendance($data['attendance_date'],$data['class_id'],$data['student_id'],$data['current_user'],$data['attendance_status'],$data['subject_id'],$data['attendance_comment']);	
				if($result!=0)
				{
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
		if($school_obj->role=='teacher' || $school_obj->role=='admin')
		{
			if($data['attendance_date']!="" && $data['student_id']!="" && $data['class_id']!="" && $data['attendance_status']!="" &&  $data['current_user']!="")
			{
				$result = $obj_attend->insert_student_attendance($data['attendance_date'],$data['class_id'],$data['student_id'],$data['current_user'],$data['attendance_status'],$data['attendance_comment']);
				{
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
		if($school_obj->role=='admin')
		{
			if($data['attendance_date']!="" && $data['teacher_id']!="" && $data['attendance_status']!="" &&  $data['current_user']!="")
			{
				$result = $obj_attend->insert_teacher_attendance($data['attendance_date'],$data['teacher_id'],$data['current_user'],$data['attendance_status'],$data['attendance_comment']);
				{
		{  
			{
				$class_section=$data['section_id'];
				$student = get_users(array('meta_key' => 'class_name', 'meta_value' => $class_id,'role'=>'student','exclude'=>$exlude_id));
				{
				{
	public function subject_attendance_view_list($data)
	{	
		$obj_attend=new Attendence_Manage();
		$class_id=$data['class_id'];
		if($data['class_id']!="" && $data['section_id']!="" && $data['subject_id']!="" && $data['current_user']!="" && $data['current_user']!=0)
		{
			if(isset($data['section_id']) && $data['section_id'] !=0)
			{
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
				{
				{
	public function teachers_attendance_list($data)
			{
} ?>