<?php 
class StudentResult{
	public function __construct() {
		add_action('template_redirect', array($this,'redirectMethod'), 1);
		
	}
	public function redirectMethod()
	{		if($_REQUEST["smgt-json-api"]=='student-result')		{					$role = smgt_get_role($_REQUEST['student_id']);			if($role[0]=='student'){				$response=$this->studentResult($_REQUEST);	 			}			if(is_array($response)){				echo json_encode($response);			}			else			{				header("HTTP/1.1 401 Unauthorized");			}				die();			}			if($_REQUEST["smgt-json-api"]=='exam-marks')			{				$response=$this->exam_marks($_REQUEST);	 				if(is_array($response)){					echo json_encode($response);				}				else				{					header("HTTP/1.1 401 Unauthorized");				}				die();			}	}
public function studentResult($data)
{			$response=array();	$obj_mark = new Marks_Manage(); 	$uid = $data['student_id'];	$user =get_userdata( $uid );	$user_meta =get_user_meta($uid);		$class_id = $user_meta['class_name'][0];			$section_id=get_user_meta($uid,'class_section',true);
	if($section_id)
		$subject = $obj_mark->student_subject($class_id,$section_id);
	else
		$subject = $obj_mark->student_subject($class_id);			
	$total_subject=count($subject);	$total = 0;	$grade_point = 0;		
	global $wpdb;	$table_name = $wpdb->prefix . "marks";	$examdata = get_all_data('exam');	foreach($examdata as $key=>$exam)	{				if($exam->exam_id!=0 && $exam->exam_id!=""){						$exam_id =$exam->exam_id;						$exam=get_exam_by_id($exam_id);						$exam_array=array('exam'=>$exam->exam_name);			$total=0;			$grade_point=0;			if (! empty ( $subject )){				//var_dump($subject);				//$periods[$dayname]=array();				$subject_array=array();				foreach($subject as $sub)				{						$marks=0;					$retrieve_result = $wpdb->get_row("SELECT *FROM $table_name WHERE exam_id = $exam_id AND class_id=".$class_id." AND subject_id = ".$sub->subid." AND student_id = $uid");					$grade=$obj_mark->get_grade($exam_id,$class_id,$sub->subid,$uid);						$grade_comment=$obj_mark->get_grade_marks_comment($obj_mark->get_grade($exam_id,$class_id,$sub->subid,$uid));						$subject_array[]=array(							'subject'=>$sub->sub_name,							'obtained_marks'=>$retrieve_result->marks,							'grade'=>$grade,							'grade_comment'=>$grade_comment,							'marks_id'=>$retrieve_result->mark_id,						);							$total += $retrieve_result->marks;						$grade_point += $obj_mark->get_grade_point($exam_id,$class_id,$sub->subid,$uid);					}					//var_dump($subject_array);					//response here					$exam_array['total_marks']=$total;					$GPA=$grade_point/$total_subject;					$exam_array['GPA']=round($GPA, 2);					$exam_array['subject']=$subject_array;					$result_array[]=$exam_array;					//$result_array[]=array_merge($exam_array,$subject_array);					$response['status']=1;					$response['resource']=$result_array;									}				else				{					$subject_array=array();									}							} 			else			{				$error['message']=__("Please Fill All Fields",'school-mgt');				$response['status']=0;				$response['resource']=$error;				return $response;			} 					}					return $response;			} //end of function 			
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