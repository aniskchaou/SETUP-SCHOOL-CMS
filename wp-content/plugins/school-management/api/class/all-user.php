<?phprequire_once (ABSPATH .'wp-admin/includes/user.php');class AllUserListing {
	public function __construct() {		add_action('template_redirect', array($this,'redirectMethod'));	}		public function redirectMethod()	{				if($_REQUEST['smgt-json-api']=='alluser-listing'){						$response=$this->all_user_listing($_REQUEST);	 			if(is_array($response)){				echo json_encode($response);			}			else			{				header("HTTP/1.1 401 Unauthorized");			}			die();		}			}		public function all_user_listing($data)	{		$response = array();		if(!empty($data)){			$users= get_users();			//var_dump($users);			$result = array();			$error['message']="";			$response['status']=1;			$i=0;			foreach($users as $user){												$userimagedata=get_user_image($user->ID);				if(empty($userimagedata['meta_value']))				{					$imageurl=get_option( 'smgt_teacher_thumb');				}				else				{					$imageurl=$userimagedata['meta_value'];				}								$result[$i]['ID']=$user->ID;				$result[$i]['name']=$user->display_name;				$result[$i]['username']=$user->user_login;				$result[$i]['email']=$user->user_email;				$result[$i]['role']=smgt_get_user_role($user->ID);				$result[$i]['image']=$imageurl;															$i++;			}						$response['resource']=$result; 		}		else		{			$error['message']=__("Please Fill All Fields",'school-mgt');			$response['status']=0;			$response['resource']=$error;		}					return $response;	}				
} 