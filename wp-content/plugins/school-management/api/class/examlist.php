<?php 
class ExamList{
	public function __construct() {
		add_action('template_redirect', array($this,'redirectMethod'), 1);
		
	}
	public function redirectMethod()
	{
					
		if($_REQUEST["smgt-json-api"]=='examlist')
		{			
			//$school_obj = new School_Management($_REQUEST['current_user']);	
			if(isset($_REQUEST['current_user']))
			{				
				$response=$this->examlist($_REQUEST);	 
			}
							
			
			if(is_array($response))
			{
				echo json_encode($response);
			}
			else
			{
				header("HTTP/1.1 401 Unauthorized");
			}
			die();
		}
			
	}
	public function examlist($data)
	{
		
		global $wpdb;
		$response	=	array();
		$usemeta	=	get_userdata($data["current_user"]);		
		$class_id	=	get_user_meta($data['current_user'],'class_name',true);		
		$all_exam 	= 	get_exam_list();		
		$table_name = 	$wpdb->prefix . "marks";
		$role 		= 	smgt_get_role($data['current_user']);	
		
		if($role[0]=='student')
		{			
			if(!empty($all_exam))
			{				
				foreach ($all_exam as $exam)
				{					
					$exam_id =$exam->exam_id;
					$exam_array	=	array(
						'exam_id'	=>$exam->exam_id,
						'exam_name'	=>$exam->exam_name,
						'exam_date'	=>$exam->exam_date,
						'exam_comment'=>$exam->exam_comment
					);
					$result_array[]	=	$exam_array;		
				}
				$response['status']	=	1;
				$response['resource']	=	$result_array;
			}
			else
			{
				//$error['message']=__("Please Fill All Fields",'school-mgt');
				$response['status']	=	0;
				$response['message']	=__("Please Fill All Fields",'school-mgt');
			}
			
		}
		else
		{
			//$error['message']=__("No Record Found",'school-mgt');
			$response['status']=0;
			$response['message']=__("No Record Found",'school-mgt');
		}
		return $response;	
	}
	
} ?>