<?php 
require_once (ABSPATH .'wp-admin/includes/user.php');
class FeePaymentClass
{
	public function __construct()
	{
		add_action('template_redirect', array($this,'redirectMethod'), 1);		
	}
	public function redirectMethod()
	{
			
			//error_reporting(0);
			if($_REQUEST['smgt-json-api']=='add-fee-type_cat')
			{	
				$response=$this->add_fee_type_cat($_REQUEST);	
				if(is_array($response)){
					echo json_encode($response);
				}
				else
				{
					header("HTTP/1.1 401 Unauthorized");
				}
				die();
			}
			if($_REQUEST['smgt-json-api']=='fee-type_cat-list')
			{	
				$response=$this->fee_type_cat_list();	
				if(is_array($response)){
					echo json_encode($response);
				}
				else
				{
					header("HTTP/1.1 401 Unauthorized");
				}
				die();
			}
			if($_REQUEST['smgt-json-api']=='delete-fee-type-cat')
			{	
				$response=$this->delete_fee_type_cat($_REQUEST);	
				if(is_array($response)){
					echo json_encode($response);
				}
				else
				{
					header("HTTP/1.1 401 Unauthorized");
				}
				die();
			}
			if($_REQUEST['smgt-json-api']=='add-fee-type')
			{	
				$response=$this->add_fee_type($_REQUEST);	
				if(is_array($response)){
					echo json_encode($response);
				}
				else
				{
					header("HTTP/1.1 401 Unauthorized");
				}
				die();
			}
			if($_REQUEST['smgt-json-api']=='fee-type-listing')
			{	
				
				$response=$this->fee_payment_list($_REQUEST);					
				if(is_array($response)){
					echo json_encode($response);
				}
				else
				{
					header("HTTP/1.1 401 Unauthorized");
				}
				die();
			}
			if($_REQUEST['smgt-json-api']=='edit-fee-type')
			{	
				$response=$this->edit_fee_type($_REQUEST);	
				if(is_array($response)){
					echo json_encode($response);
				}
				else
				{
					header("HTTP/1.1 401 Unauthorized");
				}
				die();
			}
			if($_REQUEST['smgt-json-api']=='delete-fee-type')
			{	
				$school_obj = new School_Management($_REQUEST['current_user']);
				if($school_obj->role=='admin'){
					$response=$this->api_delete_fee_type($_REQUEST);	
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
			if($_REQUEST['smgt-json-api']=='generate-invoice')
			{	
				$school_obj = new School_Management($_REQUEST['current_user']);
				if($school_obj->role=='admin'){
					$response=$this->api_generate_invoice($_REQUEST);	
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
			if($_REQUEST['smgt-json-api']=='fees-listing')
			{					
				
				$response=$this->api_fees_list($_REQUEST);					
				if(is_array($response)){
					echo json_encode($response);
				}
				else
				{
					header("HTTP/1.1 401 Unauthorized");
				}
				die();
			}
			if($_REQUEST['smgt-json-api']=='view-fees')
			{	
				$response=$this->api_view_fees($_REQUEST);	
				if(is_array($response)){
					echo json_encode($response);
				}
				else
				{
					header("HTTP/1.1 401 Unauthorized");
				}
				die();
			}
			if($_REQUEST['smgt-json-api']=='pay-fees')
			{	
				$response=$this->api_pay_fees($_REQUEST);	
				if(is_array($response)){
					echo json_encode($response);
				}
				else
				{
					header("HTTP/1.1 401 Unauthorized");
				}
				die();
			}
			if($_REQUEST['smgt-json-api']=='delete-fee')
			{	
				$school_obj = new School_Management($_REQUEST['current_user']);
				if($school_obj->role=='admin'){
					$response=$this->api_delete_fee($_REQUEST);	
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
			if($_REQUEST['smgt-json-api']=='edit-fee')
			{	
				$response=$this->api_edit_fee($_REQUEST);	
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
	
	public function add_fee_type_cat($data)
	{
		if($data['fee_type']!=""){
		
		$result = wp_insert_post( array(
			'post_status' => 'publish',
			'post_type' => 'smgt_feetype',
			'post_title' => $data['fee_type']) );
		
			if($result!=0){
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
	public function fee_type_cat_list()
	{
		$args= array('post_type'=> 'smgt_feetype','posts_per_page'=>-1,'orderby'=>'post_title','order'=>'Asc');
		$feetypesdata = get_posts( $args );	
		if(!empty($feetypesdata)){
			$i=0;
		foreach($feetypesdata as $feetype){
				$result[$i]['fee_title_id']=$feetype->ID;
				$result[$i]['fee_type']=$feetype->post_title;
				$i++;
			}
			$response['status']=1;
			$response['resource']=$result;
			return $response;
		}
		else
			{
				$message['message']=__("Record empty",'school-mgt');
				$response['status']=0;
				$response['resource']=$message;
			}
			return $response;
			
	}
	public function delete_fee_type_cat($data)
	{
		if($data['fee_type_id']!=0 && $data['fee_type_id']!=""){
			$postdata=get_post($data['fee_type_id']);
			
			if($postdata->post_type=='smgt_feetype'){
			$result=wp_delete_post($data['fee_type_id']);
				if($result)
				{
					$message['message']=__("Records Deleted Successfully!",'school-mgt');
					$response['status']=1;
					$response['resource']=$message;
				}
				
			}
			else
			{
				$message['message']=__("Records Not Delete","school-mgt");
				$response['status']=0;
				$response['resource']=$message;
			}
			return $response;
		}
		else
		{
			$message['message']=__("Please Fill All Fields","school-mgt");
			$response['status']=0;
			$response['resource']=$message;
		}
			return $response;
			
	}
	public function add_fee_type($data)
	{	
		if($data['fee_title_id']!="" && $data['class_id']!=""&& $data['fees_amount']!=""){		
		
		global $wpdb;
		$table_name = $wpdb->prefix. 'smgt_fees';
		//-------usersmeta table data--------------
		$feedata['fees_title_id']=$data['fee_title_id'];
		$feedata['class_id']=$data['class_id'];
		$feedata['section_id']=$data['section_id'];
		$feedata['fees_amount']=$data['fees_amount'];
		$feedata['description']=$data['description'];		
		$feedata['created_date']=date("Y-m-d H:i:s");
		$feedata['created_by']=$data['current_user'];	
				
			$result=$wpdb->insert( $table_name, $feedata);
			if($result!=0){
					$message['message']=__("Record successfully Inserted",'school-mgt');
					$response['status']=1;
					$response['resource']=$message;
				}	
			}
			else
			{
				$message['message']=__("Please Fill All Fields","school-mgt");
				$response['status']=0;
				$response['resource']=$message;
			}
				return $response;
	}
	public function edit_fee_type($data)
	{		
		if($data['fee_title_id']!="" && $data['class_id']!=""&& $data['fees_amount']!="")
		{		
			global $wpdb;
			$table_name = $wpdb->prefix. 'smgt_fees';
			//-------usersmeta table data--------------
			$feedata['fees_title_id']=$data['fee_title_id'];
			$feedata['class_id']=$data['class_id'];
			$feedata['section_id']=$data['section_id'];
			$feedata['fees_amount']=$data['fees_amount'];
			$feedata['description']=$data['description'];		
			$feedata['created_date']=date("Y-m-d H:i:s");
			$feedata['created_by']=$data['current_user'];					
		
			$whereid['fees_id']=$data['fee_type_id'];
			$result=$wpdb->update( $table_name, $feedata,$whereid);
			if($result!=0)
			{
				//$message['message']=__("Record successfully Updated",'school-mgt');
				$response['status']=1;
				$response['message']=__("Record successfully Updated",'school-mgt');
			}	
		}
		else
		{
			//$message['message']=__("Please Fill All Fields","school-mgt");
			$response['status']=0;
			$response['message']=__("Please Fill All Fields","school-mgt");
		}
		return $response;
	}
	
	public function fee_payment_list($data)
	{		
		
		$obj_fees= new Smgt_feespayment();		
		$class_id = get_user_meta($_REQUEST['current_user'],'class_name',true);	
		$feetypedata = $obj_fees->get_all_student_fees_data($_REQUEST['current_user']);	
		
		if(!empty($feetypedata))
		{
			$i=0;
			$response['status']=1;
			foreach ($feetypedata as $retrieved_data){				
				$histrydata = $obj_fees->get_payment_histry_data($retrieved_data->fees_pay_id);
				
			if(!empty($histrydata))
			{
					$histry = $histrydata;
			}
			else
			{
				$histry=array();
			}
			if($retrieved_data->section_id!=0)
			{ 
				$section=smgt_get_section_name($retrieved_data->section_id); 
			}
			else
			{
				$section=__('No Section','school-mgt');
			}
			if($retrieved_data->payment_status=="0")
			{
				$payment_status="Not Paid";
			}
			elseif($retrieved_data->payment_status=="1")
			{
				$payment_status="Partially Paid";
			}
			else
			{
				$payment_status="Fully Paid";
			}
			
			$result[$i]['fee_type']=get_fees_term_name($retrieved_data->fees_id);				
			$result[$i]['payment_status']=$payment_status;				
			$result[$i]['class']=get_class_name($retrieved_data->class_id);
			$result[$i]['roll_no']=get_user_meta($data['current_user'],'roll_id',true);
			$result[$i]['section']=$section;			
			$result[$i]['fees_paid_amount']=$retrieved_data->fees_paid_amount;
			$result[$i]['amount']=$retrieved_data->total_amount;
			$result[$i]['year']=$retrieved_data->start_year .'-'.$retrieved_data->end_year ;
			$result[$i]['paid_by_date']=$retrieved_data->paid_by_date;
			$result[$i]['dueamount']=$retrieved_data->total_amount - $retrieved_data->fees_paid_amount;
			$result[$i]['smgt_school_address']=get_option('smgt_school_address');	
			$result[$i]['smgt_school_name']=get_option('smgt_school_name');	
			$result[$i]['smgt_contact_number']=get_option('smgt_contact_number');
			$result[$i]['std_name_number']=get_user_name_byid($data['current_user']);
			$result[$i]['std_address']=get_user_meta($data['current_user'],'address',true);				
			$result[$i]['std_zip_code']=get_user_meta($data['current_user'],'zip_code',true	);
			$result[$i]['std_state_name']=get_user_meta($data['current_user'],'state',true	);
			$result[$i]['std_country_name']=get_option('smgt_contry');
			$result[$i]['histry']=$histry;			
			$i++;
		}
		$response['resource']=$result;
		return $response;
	}
	else
	{
		//$message['message']=__("Record not found","school-mgt");
		$response['status']=0;
		$response['message']=__("Record not found","school-mgt");
	}
	return $response;
}

function api_delete_fee_type($data)
{		
	$response=array();
	$obj_fees= new Smgt_fees();
	if($data['fee_type_id']!=0 && $data['fee_type_id']!="")
	{
		$result=$obj_fees->smgt_delete_feetype_data($_REQUEST['fee_type_id']);
		if($result)
		{
			$message['message']=__("Records Deleted Successfully!","school-mgt");
			$response['status']=1;
			$response['resource']=$message;
		}
		else
		{
			$message['message']=__("Records Not Delete","school-mgt");
			$response['status']=0;
			$response['resource']=$message;
		}
		return $response;
	}
	else
	{
		$message['message']=__("Please Fill All Fields","school-mgt");
		$response['status']=0;
		$response['resource']=$message;
	}
		return $response;
}

public function view_payment($data)
{		
	$retrieved_data=get_payment_by_id($data['payment_id']);
	if(!empty($retrieved_data))
	{
		$i=0;
		if($retrieved_data->payment_status=='Paid') 
			$status=__('Paid','school-mgt');
		elseif($retrieved_data->payment_status=='Part Paid')
		 	$status=__('Part Paid','school-mgt');
		else
			$status=__('Unpaid','school-mgt');
		
		$result['payment_id']=$retrieved_data->payment_id;
		$result['student']=get_user_name_byid($retrieved_data->student_id);
		$result['roll_no']=get_user_meta($retrieved_data->student_id, 'roll_id',true);
		$result['class']=get_class_name($retrieved_data->class_id);
		$result['payment_title']=$retrieved_data->payment_title;
		$result['amount']=$retrieved_data->amount;
		$result['status']=$status;
		$result['date']=smgt_getdate_in_input_box($retrieved_data->date);
		$response['resource']=$result;
		return $response;
	}
}

public function api_generate_invoice($data)
{	
	$obj_feespayment= new Smgt_feespayment();
	if($data['class_id']!="" && $data['fees_id']!="" && $data['fees_amount']!="" && $data['start_year']!="" && $data['end_year']!="")
	{	
		$result=$obj_feespayment->add_feespayment($data);
		if($result!=0)
		{
			$message['message']=__("Record successfully Inserted","school-mgt");
			$response['status']=1;
			$response['resource']=$message;
			return $response;		
		}	
	}
	else
	{
		$message['message']=__("Please Fill All Fields","school-mgt");
		$response['status']=0;
		$response['resource']=$message;
	}
		return $response;
}

public function api_fees_list($data)
{
	global $wpdb;
	$usemeta=get_userdata($data["current_user"]);
	$class_id=get_user_meta($data['current_user'],'class_name',true);
	$obj_feespayment= new Smgt_feespayment();
	$feetypedata = $obj_feespayment->get_all_fees_data($data['current_user']);
	print "<pre>";
		print_r($feetypedata);
	print "</pre>";
	if(!empty($feetypedata))
	{
		$i=0;
		foreach ($feetypedata as $retrieved_data)
		{ 
			if($retrieved_data->section_id!=0)
			{ 
				$section=smgt_get_section_name($retrieved_data->section_id); 
			}
			else
			{
				$section=__('No Section','school-mgt');
			}	
			$payment_status=get_payment_status($retrieved_data->fees_pay_id);//var_dump($payment_status);die;
			$result[$i]['fees_pay_id']=$retrieved_data->fees_pay_id;;
			$result[$i]['fee_type']=get_fees_term_name($retrieved_data->fees_id);
			$result[$i]['student']=get_user_name_byid($retrieved_data->student_id);
			$result[$i]['roll_no']=get_user_meta($retrieved_data->student_id, 'roll_id',true);
			$result[$i]['class']=get_class_name($retrieved_data->class_id);
			$result[$i]['section']=$section;
			$result[$i]['payment_Status']=$payment_status;
			$result[$i]['amount']=$retrieved_data->total_amount;
			$result[$i]['due_amount']=$retrieved_data->total_amount-$retrieved_data->fees_paid_amount;
			$result[$i]['year']=$retrieved_data->start_year.'-'.$retrieved_data->end_year;
			$i++;
		}
		
		$response['status']=1;
		$response['resource']=$result;
		return $response;
	}
	else
	{
		$message['message']=__("Record empty","school-mgt");
		$response['status']=0;
		$response['resource']=$message;
	}
	return $response;
}

public function api_view_fees($data)
{	
	$obj_feespayment= new Smgt_feespayment();
	$retrieved_data = $obj_feespayment->smgt_get_single_fee_payment($data['fees_pay_id']);
	if(!empty($retrieved_data))
	{
		if($retrieved_data->section_id!=0)
		{ 
			$section=smgt_get_section_name($retrieved_data->section_id); 
		}
		else
		{
			$section=__('No Section','school-mgt');
		}
		
		$payment_status=get_payment_status($retrieved_data->fees_pay_id);
		$result['fees_pay_id']=$retrieved_data->fees_pay_id;;
		$result['fee_type']=get_fees_term_name($retrieved_data->fees_id);
		$result['student']=get_user_name_byid($retrieved_data->student_id);
		$result['roll_no']=get_user_meta($retrieved_data->student_id, 'roll_id',true);
		$result['class']=get_class_name($retrieved_data->class_id);
		$result['section']=$section;
		$result['payment_Status']=$payment_status;
		$result['amount']=$retrieved_data->total_amount;
		$result['due_amount']=$retrieved_data->total_amount-$retrieved_data->fees_paid_amount;
		$result['year']=$retrieved_data->start_year.'-'.$retrieved_data->end_year;
		$response['status']=1;
		$response['resource']=$result;
		return $response;
	}
	else
	{
		$message['message']=__("Please Fill All Fields","school-mgt");
		$response['status']=0;
		$response['resource']=$message;
	}
	return $response;
}

public function api_pay_fees($data)
{	
	$obj_feespayment= new Smgt_feespayment();
	if($data['payment_method']!="" && $data['fees_pay_id']!="" && $data['amount']!="")
	{	
		$result=$obj_feespayment->add_feespayment_history($data);	
		if($result!=0)
		{
			$message['message']=__("Record successfully Inserted","school-mgt");
			$response['status']=1;
			$response['resource']=$message;
			return $response;		
		}	
	}
	else
	{
		$message['message']=__("Please Fill All Fields","school-mgt");
		$response['status']=0;
		$response['resource']=$message;
	}
	return $response;
}

function api_delete_fee($data)
{		
	$response=array();
	$obj_feespayment= new Smgt_feespayment();
	if($data['fees_pay_id']!=0 && $data['fees_pay_id']!="")
	{
		$result=$obj_feespayment->smgt_delete_feetpayment_data($data['fees_pay_id']);
		if($result)
		{
			$message['message']=__("Records Deleted Successfully!","school-mgt");
			$response['status']=1;
			$response['resource']=$message;
		}
		else
		{
			$message['message']=__("Records Not Delete","school-mgt");
			$response['status']=0;
			$response['error']=$message;
		}
		return $response;
	}
	else
	{
		$message['message']=__("Please Fill All Fields","school-mgt");
		$response['status']=0;
		$response['resource']=$message;
	}
		return $response;
}

public function api_edit_fee($data)
{	
	$obj_feespayment= new Smgt_feespayment();
	if($data['class_id']!="" && $data['fees_id']!="" && $data['fees_amount']!="" && $data['start_year']!="" && $data['end_year']!="")
	{	
		$data['action']='edit';
		$result=$obj_feespayment->add_feespayment($data);
		if($result!=0)
		{
			$message['message']=__("Record successfully Updated",'school-mgt');
			$response['status']=1;
			$response['resource']=$message;
			return $response;		
		}
		else
		{
			$message['message']=__("Invalid Id","school-mgt");
			$response['status']=0;
			$response['resource']=$message;
		}
			return $response;	
	}
	else
	{
		$message['message']=__("Please Fill All Fields","school-mgt");
		$response['status']=0;
		$response['resource']=$message;
	}
		return $response;
}
} ?>