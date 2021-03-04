<?php 
class ViewProfile{
	public function __construct() {
		add_action('template_redirect', array($this,'redirectMethod'), 1);
		
	}
	public function redirectMethod()
	{
			
			//error_reporting(0);
			
			if($_REQUEST["smgt-json-api"]=='view-profile')
			{
				
				if(isset($_REQUEST["user_id"]) && $_REQUEST["user_id"]!="")
				{
					$response=$this->view_profile($_REQUEST["user_id"]);	 
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
	public function view_profile($user_id)
	{
		
		if($user_id!=0){
			
			$user_data=get_userdata($user_id); 
		}
		$school_obj = new School_Management($user_id);
		if(!empty($user_data)){
			
			
						$umetadata=get_user_image($user_id);
						if(empty($umetadata['meta_value'])){
							$imageurl=get_option('smgt_student_thumb');
						}
						else
						{
							$imageurl=$umetadata['meta_value'];
						}
						
						
							$result['ID']=$user_data->ID;
							$result['image']=$imageurl;
							$result['name']=$user_data->display_name;
							$result['email']=$user_data->user_email;
							$result['address']=$user_data->address;
							$result['city']=$user_data->city;
							$result['phone']=$user_data->phone;
						if($school_obj->role=='student'){
							if($user_data->class_name!="")
								$classname=get_class_name($user_data->class_name);
							if(isset($user_data->class_section) && $user_data->class_section!=0){
									$section=smgt_get_section_name($user_data->class_section); 
							}
							else
							{
								$section=__('No Section','school-mgt');;
							}
							
							$parentdata =get_user_meta($user_data->ID, 'parent_id', true); 
							
							$result['class']=$classname;
							$result['section']=$section;
							 foreach($parentdata as $parentid)
							  {
								$parent=get_userdata($parentid);
								$parentarray['name']=$parent->display_name;
								$parentarray['image']=$parent->smgt_user_avatar;
								$parents[]=$parentarray;
							  }
							  if(!empty($parents))
								$result['parents']=$parents;
							
						}
						if($school_obj->role=='parent')
						 {
							 $childsdata =get_user_meta($user_data->ID, 'child', true); 
							  foreach($childsdata as $childid)
							  {
								$child=get_userdata($childid);
								$childsarray['name']=$child->display_name;
								$childsarray['image']=$child->smgt_user_avatar;
								$childrens[]=$childsarray;
							  }
							  if(!empty($childrens))
								$result['child']=$childrens;
						 }
						 if($school_obj->role=='teacher')
						 {
							$result['subjects']=get_subject_name_by_teacher($user_data->ID);
						 }
			$response['status']=1;
			$response['resource']=$result;
			return $response;
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