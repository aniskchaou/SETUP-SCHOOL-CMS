<?php 
class UserReadStatusAPI{
	public function __construct()
	{
		add_action('template_redirect', array($this,'redirectMethod'), 1);		
	}
	
	public function redirectMethod()
	{	
		if($_REQUEST["smgt-json-api"]=='check-status')
		{
			if(isset($_REQUEST["user_id"]) && $_REQUEST["user_id"]!="")
			{
				$response=$this->check_read_status($_POST);	 
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
		
		if($_REQUEST["smgt-json-api"]=='unread-list')
		{
			if(isset($_REQUEST["current_user"]) && $_REQUEST["current_user"]!="")
			{
				$response=$this->get_unread_list($_POST);	 
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
		
		//if()
	}
	
	public function check_read_status($data)
	{	
	
		if(!empty($data['type']) && !empty($data['type_id']))
		{
			$TypeArr = explode(',',$data['type_id']);
			
			global $wpdb;
			$tbl_status = $wpdb->prefix .'smgt_check_status';
			
			$statusdata['type']=$data['type'];
			//$statusdata['type_id']=$data['type_id'];
			$statusdata['user_id']=$data['user_id'];				
			foreach($TypeArr as $type_id)
			{					
				$statusdata['type_id']=$type_id;
				$result = $wpdb->insert($tbl_status,$statusdata);
			} 			
			if($result)
			{
				$response['status']=1;
					$response['resource']="Record Successfully inserted";
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
	
	
	
	public function get_unread_list($data)
	{
		if(!empty($data['current_user']))
		{
			$TypeList = array("notice",'message','holiday');
			$response['status']=1;
			foreach($TypeList as $type)
			{				
				global $wpdb;				
				if($type=='holiday')
				{							
					$tablename = $wpbd->prefix . 'holiday';
					$retrieve_holiday = get_all_data($tablename);
					foreach($retrieve_holiday as $holiday)
					{
						//var_dump($holiday);
						$HolidayStatus = cheak_type_status($data['current_user'],'holiday',$holiday->holiday_id);						
						if($HolidayStatus=="Unread")
						{
							$List['holiday_id'] = $holiday->holiday_id;
							$List['holiday_title'] = $holiday->holiday_title;
							$List['date'] = $holiday->date;
							$List['end_date'] = $holiday->end_date;
							$List['description'] = $holiday->description;
							$listdata[]=$List;
						}						
					}
					
					$result['holidaylist']=$listdata;
					$i++;	
				} 
				
				if($type=='notice')
				{
					
					$userdata = get_userdata($data['current_user']);
					$class_id = get_user_meta($userdata->ID,'class_name',true);
					$class_section = get_user_meta($userdata->ID,'class_section',true);
					
					//smgt_get_user_notice('student',);
					
					$args = array (
						'post_status'      => 'publish',
						'post_type'        => 'notice',
						 'meta_query'       => array(
							array(
								'key'     => 'smgt_class_id',
								'value'   => $class_id,								
							),
						), 
					);
					$NoticePost = get_posts( $args ); 
					foreach($NoticePost as $key=>$notice)
					{	
						$noticeStatus = cheak_type_status($data['current_user'],'notice',$notice->ID);
						if($noticeStatus=="Unread")
						{							
							$NoticeData['notice_id']=$notice->ID;
							$NoticeData['notice_title']=$notice->post_title;
							$NoticeData['notice_content']=$notice->post_content;
							$NoticeData['start_date']=smgt_getdate_in_input_box(get_post_meta($notice->ID,'start_date',true));
							$NoticeData['end_date']=smgt_getdate_in_input_box(get_post_meta($notice->ID,'end_date',true));
							$StdNotice[] = $NoticeData; 
						}
					}
					$result['noticelist']=$StdNotice;
					
				} // end of notice type condition 
				
				
				
				if($type=='message')
				{
					$messagedata=get_inbox_message($data['current_user']);
					
					if(!empty($messagedata))
					{
						foreach($messagedata as $key=>$message)
						{
							$noticeStatus = cheak_type_status($data['current_user'],'message',$message->message_id);
							if($noticeStatus=="Unread")
							{
								$MessageData['message_id']=$message->message_id;
								$MessageData['message_from']=get_display_name($message->sender);
								$MessageData['subject']=$message->subject;;
								$MessageData['description']=$message->message_body;
								$MessageData['date']= date("Y-m-d",strtotime($message->date));
								$ArrMsg[]= $MessageData;
							}
							
						}
						$result['messagelist']=$ArrMsg;
					}
					else
					{
						$error['message']=__("No Message Found",'school-mgt');
						$response['status']=0;
						$response['resource']=$error;
						return $response;
					}
						
				} // end of message type condition 
				
				
				
				
				
			}
				$response['resource']=$result;
				
				return $response;
		
			
			
		}
		else
		{
			$error['message']=__("Please Fill All Fields",'school-mgt');
			$response['status']=0;
			$response['resource']=$error;
			return $response;
		}
			
	}
	
} ?>