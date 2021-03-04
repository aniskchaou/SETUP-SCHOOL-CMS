<?php 
class StudentResult{
	public function __construct() {
		add_action('template_redirect', array($this,'redirectMethod'), 1);
	public function redirectMethod()
	{
{	
	if($section_id)
		$subject = $obj_mark->student_subject($class_id,$section_id);
	else
		$subject = $obj_mark->student_subject($class_id);
	$total_subject=count($subject);
		global $wpdb;
	public function exam_marks($data)
	{
		$obj_marks = new Marks_Manage();
		if($data['class_id']!="" && $data['section_id']!="" && $data['exam_id']!="")
		{
			$section_id=0;
			$class_id=0;
			if($_REQUEST['section_id'] !=0){
					$class_id=$data['class_id'];
					$section_id=$data['section_id'];
					$exlude_id = smgt_approve_student_list();
					$student = get_users(array('meta_key' => 'class_section', 'meta_value' =>$_REQUEST['section_id'],
								 'meta_query'=> array(array('key' => 'class_name','value' => $class_id,'compare' => '=')),'role'=>'student','exclude'=>$exlude_id));	
				}
				elseif($data['class_id']!=0)
				{ 
					$class_id=$data['class_id'];
					$exlude_id = smgt_approve_student_list();
					$student = get_users(array('meta_key' => 'class_name', 'meta_value' => $class_id,'role'=>'student','exclude'=>$exlude_id));
				} 	
				$result_array['class_id']=$class_id;
				$result_array['section_id']=$section_id;
				$result_array['exam_id']=$data['exam_id'];
				$result_array['exam_name']=get_exam_name_id($data['exam_id']);				
			if($data['subject_id']!="")
			{
				$subjectid=$data['subject_id'];
				foreach ( $student as $user ) {
				
							$mark_detail = $obj_marks->subject_makrs_detail_byuser($data['exam_id'],$class_id,$subjectid,$user->ID);
							if($mark_detail)
							{
								$mark_id=$mark_detail->mark_id;
								$marks=$mark_detail->marks;
								$marks_comment=$mark_detail->marks_comment;
							}
							else
							{
								$marks=0;
								$attendance=0;
								$marks_comment="";
								$mark_id="0";
							}
							$studentmarks[]=array('subject_id'=>$subjectid,
											  'student_id'=>$user->ID,
											  'student_name'=>$user->display_name,
											  'mark_id'=>$mark_id,
											   'marks'=>$marks,
											   'marks_comment'=>$marks_comment,
							 );
							
				}
				$result_array['students']=$studentmarks;
			}
			else
			{
				
				foreach ( $student as $user ) {
					
					$subject_list = $obj_marks->student_subject($class_id,$section_id);
					if(!empty($subject_list))
					{		
						$subjects=array();		
						foreach($subject_list as $sub_id)
						{
							
							$mark_detail = $obj_marks->subject_makrs_detail_byuser($data['exam_id'],$class_id,$sub_id->subid,$user->ID);
							if($mark_detail)
							{
								$mark_id=$mark_detail->mark_id;
								$marks=$mark_detail->marks;
								$marks_comment=$mark_detail->marks_comment;
							}
							else
							{
								$marks=0;
								$attendance=0;
								$marks_comment="";
								$mark_id="0";
							}
							$subjects[]=array('subject_id'=>$sub_id->subid,
												'mark_id'=>$mark_id,
											   'marks'=>$marks,
											   'marks_comment'=>$marks_comment,
											   );
							
						}
						$studentmarks[]=array('student_id'=>$user->ID,
											'student_name'=>$user->display_name,
										  'sebjects'=>$subjects);
					}	
				}
				$result_array['students']=$studentmarks;
			}
			$response['status']=1;
			$response['resource']=$result_array;
			return $response;
		}
		else
		{
			$error['message']=__("Result Not Found",'school-mgt');
			$response['status']=0;
			$response['resource']=$error;
			return $response;
		}
	}
	
} ?>