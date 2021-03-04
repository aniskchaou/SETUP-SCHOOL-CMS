<?php 
class Smgt_Homework
{
	public function check_valid_extension($filename)
	{
			$flag = 2;
			if($filename != '')
			{
				$flag = 0;
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				$valid_extension = array('gif','png','jpg','jpeg');
				if(in_array($ext,$valid_extension) )
				{
					$flag = 1;
				}
			}
			return $flag;
	}
	function get_delete_records($tablenm,$record_id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix . $tablenm;
		return $result=$wpdb->query($wpdb->prepare("DELETE FROM $table_name WHERE homework_id= %d",$record_id));
	}
	public function smgt_check_uploaded($assign_id)
	{
		global $wpdb;
		$table = $wpdb->prefix."smgt_student_homework";
		$result = $wpdb->get_row("SELECT file FROM {$table} WHERE stu_homework_id = {$assign_id}",ARRAY_A);
			if($result['file'] != "")
			{
				return $result['file'];
			}
			else
			{ 
				return false;
			}
	}
	function smgt_get_class_homework()
	{
		global $wpdb;
		$table_name = $wpdb->prefix . 'smgt_homework';
		return $result = $wpdb->get_results("SELECT * FROM $table_name");
	}
	function view_submission($data){
		global $wpdb;
		$table_name = $wpdb->prefix . 'smgt_homework';
		$table_name2 = $wpdb->prefix . 'smgt_student_homework';
		return $result = $wpdb->get_results("SELECT * FROM $table_name as a LEFT JOIN $table_name2 as b ON a.`homework_id` = b.`homework_id` where a.`homework_id`= $data ");
		
	}
	function parent_view_detail($child_ids){
		global $wpdb;
		$table_name = $wpdb->prefix . 'smgt_homework';
		$table_name2 = $wpdb->prefix . 'smgt_student_homework';
		return $result = $wpdb->get_results("SELECT * FROM $table_name as a LEFT JOIN $table_name2 as b ON a.`homework_id` = b.`homework_id`WHERE b.student_id IN ({$child_ids})");
	}
	function student_view_detail(){
		global $wpdb;
		global $user_ID;
		$table_name = $wpdb->prefix . 'smgt_homework';
		$table_name2 = $wpdb->prefix . 'smgt_student_homework';
		return $result = $wpdb->get_results("SELECT * FROM $table_name as a LEFT JOIN $table_name2 as b ON a.`homework_id` = b.`homework_id`WHERE b.student_id = $user_ID");
	}
	function parent_update_detail($data,$student_id){
		global $wpdb;
		global $user_ID;
		$table_name = $wpdb->prefix . 'smgt_homework';
		$table_name2 = $wpdb->prefix . 'smgt_student_homework';
		return $result = $wpdb->get_results("SELECT * FROM $table_name as a LEFT JOIN $table_name2 as b ON a.`homework_id` = b.`homework_id` WHERE a.`homework_id`=$data AND b.student_id = $student_id");
	}
	function add_homework($data)
	{
		$created_date = date("Y-m-d");
		global $current_user;
		$user=$current_user->user_login;
		global $wpdb;
		$table_name=$wpdb->prefix ."smgt_homework";
		$table_name2 = $wpdb->prefix . 'smgt_student_homework';
		$homeworkdata['title']=$data['title'];
		$SearchArr['{{title}}']=$data['title'];
		$SearchArr['{{submition_date}}']= date('m-d-Y',strtotime($data['sdate']));
		$homeworkdata['class_name']=$data['class_name'];
		$homeworkdata['subject']=$data['subject_id'];
		$homeworkdata['content']=$data['content'];
		$homeworkdata['create_date']=$created_date;
		$homeworkdata['submition_date']= date('Y-m-d',strtotime($data['sdate']));
		$homeworkdata['createdby']=$user;  
		
			if(!empty($_REQUEST['homework_id']))
			{
				$homework_id['homework_id']=$_REQUEST['homework_id'];
				$result = $wpdb->update($table_name,$homeworkdata,$homework_id);
				if($result)
				{			
					$class_id =$data['class_name'];
					$studentdata = get_users(array('meta_key' => 'class_name', 'meta_value' => $class_id,'role'=>'student'));	
					$last=$wpdb->insert_id;
					$homeworstud['homework_id']=$last;
						foreach($studentdata as $student)
						{
							 $homeworstud['student_id']=$student->ID;
							 $result = $wpdb->insert($table_name2,$homeworstud);
						}
							if($data['student_id'] == '')
							{	
							
								foreach($studentdata as $user)
								{
									$StdID = $user->ID;
									$StdName = $user->display_name;
										if(get_option( 'smgt_enable_homework_mail')==1)
										{	
											$headers  ="";
											$headers .= 'From: abc<noreplay@gmail.com>' . "\r\n";
											$headers .= "MIME-Version: 1.0\r\n";
											$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
											$parent 		= 	get_user_meta($StdID, 'parent_id', true);
											$student1 = get_users(array('meta_key' => 'class_name', 'meta_value' => $homeworkdata['class_name'] ,'role'=>'student'));
											$class_name		=	get_user_meta($StdID,'class_name',true);
											$result			=	$SearchArr;
												
												if(!empty($parent))
												{
													foreach($parent as $p)
													{
														$user_info	 	=    get_userdata($p);
														$email_to[] 	=	 $user_info->user_email;		
													}
													foreach($email_to as $eamil)
													{
													   
														$Cont = get_option('homework_mailcontent');
														$ParerntData = get_user_by('email',$eamil);							
														$SearchArr['{{parent_name}}']	=	$ParerntData->display_name;
														$SearchArr['{{student_name}}']	=	$StdName;
														$SearchArr['{{school_name}}']	=	get_option('smgt_school_name');
														$data = string_replacement($SearchArr,get_option('homework_mailcontent'));
														$headers='';
														$headers .= 'From: '.get_option('smgt_school_name').' <noreplay@gmail.com>' . "\r\n";
														$headers .= "MIME-Version: 1.0\r\n";
														$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
														$MessageContent ="";
														$MessageContent = $data. $MessageContent;
														$MessageContent = "<pre><font size=3>". $MessageContent ."</font></pre>";	
														wp_mail($eamil,get_option('homework_title'),$MessageContent,$headers);							
													}
												}
											
											if(!empty($user))
											{ 
												
														$Cont = get_option('stu_homework_mailcontent');
														$Student_Data = get_userdata($user->ID);	
														$SearchArr['{{student_name}}']	=	$Student_Data->display_name;
														$SearchArr['{{school_name}}']	=	get_option('smgt_school_name');
														$data1 = string_replacement($SearchArr,get_option('stu_homework_mailcontent'));
														$headers='';
														$headers .= 'From: '.get_option('smgt_school_name').' <noreplay@gmail.com>' . "\r\n";
														$headers .= "MIME-Version: 1.0\r\n";
														$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
														$MessageContent ="";
														$MessageContent = $data1. $MessageContent;	
														$MessageContent = "<pre><font size=3>". $MessageContent ."</font></pre>";
														wp_mail($user->user_email,get_option('homework_title'),$MessageContent,$headers);							
													
											}
										}
								}
							}
				
				}
					?>
							<div id="message" class="updated below-h2">
									<p><?php _e('Homework Update successfully !','school-mgt');?></p>
							</div>
					<?php 
			}
			else
			{
				$result=$wpdb->insert($table_name,$homeworkdata);
				if($result)
				{			
					$class_id =$data['class_name'];
					$studentdata = get_users(array('meta_key' => 'class_name', 'meta_value' => $class_id,'role'=>'student'));	
					$last=$wpdb->insert_id;
					$homeworstud['homework_id']=$last;
						foreach($studentdata as $student)
						{
							 $homeworstud['student_id']=$student->ID;
							 $result = $wpdb->insert($table_name2,$homeworstud);
						}
					if($data['student_id'] == '')
					{	
						foreach($studentdata as $user)
						{
							$StdID = $user->ID;
							$StdName = $user->display_name;
							if(get_option( 'smgt_enable_homework_mail')==1)
							{	
								$headers  ="";
								$headers .= 'From: abc<noreplay@gmail.com>' . "\r\n";
								$headers .= "MIME-Version: 1.0\r\n";
								$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
								$parent 		= 	get_user_meta($StdID, 'parent_id', true);
								$student1 = get_users(array('meta_key' => 'class_name', 'meta_value' => $homeworkdata['class_name'] ,'role'=>'student'));
								$class_name		=	get_user_meta($StdID,'class_name',true);
								$result			=	$SearchArr;
									
								if(!empty($parent))
								{
									foreach($parent as $p)
									{
										$user_info	 	=    get_userdata($p);
										$email_to[] 	=	 $user_info->user_email;		
									}
									foreach($email_to as $eamil)
									{
									   
										$Cont = get_option('homework_mailcontent');
										$ParerntData = get_user_by('email',$eamil);							
										$SearchArr['{{parent_name}}']	=	$ParerntData->display_name;
										$SearchArr['{{student_name}}']	=	$StdName;
										$SearchArr['{{school_name}}']	=	get_option('smgt_school_name');
										$data = string_replacement($SearchArr,get_option('homework_mailcontent'));
										$headers='';
										$headers .= 'From: '.get_option('smgt_school_name').' <noreplay@gmail.com>' . "\r\n";
										$headers .= "MIME-Version: 1.0\r\n";
										$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
										$MessageContent ="";
										$MessageContent = $data. $MessageContent;
										$MessageContent = "<pre><font size=3>". $MessageContent ."</font></pre>";	
										wp_mail($eamil,get_option('homework_title'),$MessageContent,$headers);							
									}
								}
								
								if(!empty($user))
								{ 
									
									$Cont = get_option('stu_homework_mailcontent');
									$Student_Data = get_userdata($user->ID);	
									$SearchArr['{{student_name}}']	=	$Student_Data->display_name;
									$SearchArr['{{school_name}}']	=	get_option('smgt_school_name');
									$data1 = string_replacement($SearchArr,get_option('stu_homework_mailcontent'));
									$headers='';
									$headers .= 'From: '.get_option('smgt_school_name').' <noreplay@gmail.com>' . "\r\n";
									$headers .= "MIME-Version: 1.0\r\n";
									$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";
									$MessageContent ="";
									$MessageContent = $data1. $MessageContent;	
									$MessageContent = "<pre><font size=3>". $MessageContent ."</font></pre>";
									wp_mail($user->user_email,get_option('homework_title'),$MessageContent,$headers);							
								}
							}
						}
					}
				
				}
				return $result;
			}
	}	
	function get_all_homeworklist()
	{
			global $wpdb;
			$table_name = $wpdb->prefix . "smgt_homework";
			return $rows = $wpdb->get_results("SELECT * from $table_name");
	}
	function get_teacher_homeworklist()
	{
			global $wpdb;
			$class_name = array();
			$table_name = $wpdb->prefix . "smgt_homework";
			$class_name=get_user_meta(get_current_user_id (),'class_name',true);
			
				return $rows = $wpdb->get_results("SELECT * from $table_name where class_name IN(".implode($class_name,',').")");
	}	
	function get_edit_record($homework_id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix . "smgt_homework";
		return $rows = $wpdb->get_row("SELECT * from $table_name where homework_id=".$homework_id);
	}
	function get_delete_record($homework_id)
	{
		global $wpdb;
		$table_name = $wpdb->prefix . "smgt_homework";
		return $rows = $wpdb->query("Delete from $table_name where homework_id=".$homework_id);
	}	
	
}