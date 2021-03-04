<?php 
class HomeworkListing{
	public function __construct() {
		add_action('template_redirect', array($this,'redirectMethod'), 1);
		
	}
	public function redirectMethod()
	{
			
			//error_reporting(0);
			
			if($_REQUEST["smgt-json-api"]=='homework-listing')
			{
				
				if(isset($_REQUEST["current_user"]))
				{
					
					$response=$this->homework_listing($_REQUEST);	 
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
	public function homework_listing($data)
	{
		
		if($data["current_user"]!=0)
		{
			$role = smgt_get_role($data["current_user"]);				
			//$school_obj = new School_Management($data["current_user"]);
			$homework_obj = new Smgt_Homework;
			
			if($role[0]=='teacher')
			{				
				$retrieve_class = $homework_obj->smgt_get_all_homework_by_teacher($data["current_user"]);
			}
			
			if($role[0]=='student')
			{
				$retrieve_class = $homework_obj->smgt_get_homework_by_student($data["current_user"]);
			}
			if($role[0]=='admin')
			{
				$retrieve_class = $homework_obj->smgt_get_all_homework();
			}
		}
		
		
		
		$response=array();
		//$response['error']="";
		//$response['status']=0;
		//$response['resource']=array();
	
		if(!empty($retrieve_class)){
			
			$i=0;
			if(isset($data["date"]) && $data["date"]!="")
			{
				
				foreach ($retrieve_class as $retrieved_data){
					if($data["date"]==$retrieved_data['to_date']){
						$classname=get_class_name($retrieved_data['class_id']);
							$subjectname=get_single_subject_name($retrieved_data['subject_id']);
							if(isset($retrieved_data['section_id']) && $retrieved_data['section_id']!=0){
									$section=smgt_get_section_name($retrieved_data['section_id']); 
							}
							else
							{
								$section=__('No Section','school-mgt');;
							}
							
							$result[$i]['homework_id']=$retrieved_data['homework_id'];
							$result[$i]['homework_title']=$retrieved_data['homework_title'];
							$result[$i]['class']=$classname;
							$result[$i]['section']=$section;
							$result[$i]['subject_name']=$subjectname;
							$result[$i]['to_date']=$retrieved_data['to_date'];
							$i++;
						}	
						
				}
				$response['status']=1;	
				$response['resource']=$result;
				return $response;
			}
			else
			{
				
				foreach ($retrieve_class as $retrieved_data){
						$classname=get_class_name($retrieved_data['class_id']);
							$subjectname=get_single_subject_name($retrieved_data['subject_id']);
							if(isset($retrieved_data['section_id']) && $retrieved_data['section_id']!=0){
									$section=smgt_get_section_name($retrieved_data['section_id']); 
							}
							else
							{
								$section=__('No Section','school-mgt');;
							}
							
							$result[$i]['homework_id']=$retrieved_data['homework_id'];
							$result[$i]['homework_title']=$retrieved_data['homework_title'];
							$result[$i]['class']=$classname;
							$result[$i]['section']=$section;
							$result[$i]['subject_name']=$subjectname;
							$result[$i]['to_date']=$retrieved_data['to_date'];
						
							
						$i++;
				}
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
			return $response;
			
		}
		
		//return $response;
	}
} ?>