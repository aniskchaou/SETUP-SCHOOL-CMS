<?php 
class ExamList{
	public function __construct() {
		add_action('template_redirect', array($this,'redirectMethod'), 1);
		
	}
	public function redirectMethod()
	{
		
			if($_REQUEST["smgt-json-api"]=='examlist')
			{
				$response=$this->examlist($_REQUEST);	 
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
	public function examlist($data)
	{
			$response=array();
			
			$all_exam = get_exam_list();
			global $wpdb;
			$table_name = $wpdb->prefix . "marks";
			if(!empty($all_exam)){
						
				foreach ($all_exam as $exam)
				{
					$exam_id =$exam->exam_id;
						$exam_array=array('exam_id'=>$exam->exam_id,
										 'exam_name'=>$exam->exam_name,
										  'exam_date'=>$exam->exam_date);
						
					$result_array[]=$exam_array;		
				}
				$response['status']=1;
				$response['resource']=$result_array;
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