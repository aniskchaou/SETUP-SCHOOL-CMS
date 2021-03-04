<?php 	
if(isset($_POST['save_access_right']))
{
	$access_right = array();
	$result=get_option( 'smgt_access_right');
	//---------NEW MENU LINK START------------------
	$access_right['teacher'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/teacher.png' ),'menu_title'=>'Teacher',
	'student' => isset($_REQUEST['student_teacher'])?$_REQUEST['student_teacher']:0,
	'teacher' => isset($_REQUEST['teacher_teacher'])?$_REQUEST['teacher_teacher']:0,
	'parent' =>isset($_REQUEST['parent_teacher'])?$_REQUEST['parent_teacher']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_teacher'])?$_REQUEST['supportstaff_teacher']:0,
	'page_link'=>'teacher');
	//---------NEW MENU LINK END------------------
	//---------NEW MENU LINK START------------------
	$access_right['student'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/student-icon.png' ),'menu_title'=>'Student',
	'student' => isset($_REQUEST['student_student'])?$_REQUEST['student_student']:0,
	'teacher' => isset($_REQUEST['teacher_student'])?$_REQUEST['teacher_student']:0,
	'parent' =>isset($_REQUEST['parent_student'])?$_REQUEST['parent_student']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_student'])?$_REQUEST['supportstaff_student']:0,
	'page_link'=>'student');
	//---------NEW MENU LINK END------------------
	//---------NEW MENU LINK START------------------
	$access_right['child'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/student-icon.png' ),'menu_title'=>'Child',
	'student' => isset($_REQUEST['student_child'])?$_REQUEST['student_child']:0,
	'teacher' => isset($_REQUEST['teacher_child'])?$_REQUEST['teacher_child']:0,
	'parent' =>isset($_REQUEST['parent_child'])?$_REQUEST['parent_child']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_child'])?$_REQUEST['supportstaff_child']:0,
	'page_link'=>'child');
	//---------NEW MENU LINK END------------------
	
	//---------NEW MENU LINK START------------------
	$access_right['parent'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/parents.png' ),'menu_title'=>'Parent',
	'student' => isset($_REQUEST['student_parent'])?$_REQUEST['student_parent']:0,
	'teacher' => isset($_REQUEST['teacher_parent'])?$_REQUEST['teacher_parent']:0,
	'parent' =>isset($_REQUEST['parent_parent'])?$_REQUEST['parent_parent']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_parent'])?$_REQUEST['supportstaff_parent']:0,
	'page_link'=>'parent');
	//---------NEW MENU LINK END------------------
	//---------NEW MENU LINK START------------------
	$access_right['subject'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/subject.png' ),'menu_title'=>'Subject',
	'student' => isset($_REQUEST['student_subject'])?$_REQUEST['student_subject']:0,
	'teacher' => isset($_REQUEST['teacher_subject'])?$_REQUEST['teacher_subject']:0,
	'parent' =>isset($_REQUEST['parent_subject'])?$_REQUEST['parent_subject']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_subject'])?$_REQUEST['supportstaff_subject']:0,
	'page_link'=>'subject');
	//---------NEW MENU LINK END------------------
	//---------NEW MENU LINK START------------------
	$access_right['schedule'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/class-route.png' ),'menu_title'=>'Class Routine',
	'student' => isset($_REQUEST['student_schedule'])?$_REQUEST['student_schedule']:0,
	'teacher' => isset($_REQUEST['teacher_schedule'])?$_REQUEST['teacher_schedule']:0,
	'parent' =>isset($_REQUEST['parent_schedule'])?$_REQUEST['parent_schedule']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_schedule'])?$_REQUEST['supportstaff_schedule']:0,
	'page_link'=>'schedule');
	//---------NEW MENU LINK END------------------
	//---------NEW MENU LINK START------------------
	$access_right['attendance'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/attandance.png' ),'menu_title'=>'Attendance',
	'student' => isset($_REQUEST['student_attendance'])?$_REQUEST['student_attendance']:0,
	'teacher' => isset($_REQUEST['teacher_attendance'])?$_REQUEST['teacher_attendance']:0,
	/* 'parent' =>isset($_REQUEST['parent_attendance'])?$_REQUEST['parent_attendance']:0, */
	'parent' =>0,
	/* 'supportstaff' =>isset($_REQUEST['supportstaff_attendance'])?$_REQUEST['supportstaff_attendance']:0, */
	'supportstaff' =>0,
	'page_link'=>'attendance');
	//---------NEW MENU LINK END------------------
	//---------NEW MENU LINK START----------------
	$access_right['exam'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/exam.png' ),'menu_title'=>'Exam',
	'student' => isset($_REQUEST['student_exam'])?$_REQUEST['student_exam']:0,
	'teacher' => isset($_REQUEST['teacher_exam'])?$_REQUEST['teacher_exam']:0,
	'parent' =>isset($_REQUEST['parent_exam'])?$_REQUEST['parent_exam']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_exam'])?$_REQUEST['supportstaff_exam']:0,
	'page_link'=>'exam');
	//---------NEW MENU LINK END------------------
		//---------NEW MENU homework LINK START----------------
	/*$access_right['homework'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/homework.png' ),'menu_title'=>'Homework',
	'student' => isset($_REQUEST['student_homework'])?$_REQUEST['student_homework']:0,
	'teacher' => isset($_REQUEST['teacher_homework'])?$_REQUEST['teacher_homework']:0,
	'parent' =>isset($_REQUEST['parent_homework'])?$_REQUEST['parent_homework']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_homework'])?$_REQUEST['supportstaff_homework']:0,
	'page_link'=>'homework');*/
	
	//---------NEW MENU homework LINK End----------------
	//---------NEW MENU LINK START------------------
	$access_right['manage_marks'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/mark-manage.png' ),'menu_title'=>'Manage Marks',
	'student' => isset($_REQUEST['student_manage_marks'])?$_REQUEST['student_manage_marks']:0,
	'teacher' => isset($_REQUEST['teacher_manage_marks'])?$_REQUEST['teacher_manage_marks']:0,
	/* 'parent' =>isset($_REQUEST['parent_manage_marks'])?$_REQUEST['parent_manage_marks']:0, */
	'parent' =>0,
	/* 'supportstaff' =>isset($_REQUEST['supportstaff_manage_marks'])?$_REQUEST['supportstaff_manage_marks']:0, */
	'supportstaff' =>0,
	'page_link'=>'manage_marks');
	//---------NEW MENU LINK END------------------
	//---------NEW MENU LINK START------------------
	$access_right['feepayment'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/fee.png' ),'menu_title'=>'Feepayment',
	'student' => isset($_REQUEST['student_feepayment'])?$_REQUEST['student_feepayment']:0,
	'teacher' => isset($_REQUEST['teacher_feepayment'])?$_REQUEST['teacher_feepayment']:0,
	'parent' =>isset($_REQUEST['parent_feepayment'])?$_REQUEST['parent_feepayment']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_feepayment'])?$_REQUEST['supportstaff_feepayment']:0,
	'page_link'=>'feepayment');
	//---------NEW MENU LINK END------------------
	//---------NEW MENU LINK START------------------
	$access_right['payment'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/payment.png' ),'menu_title'=>'Payment',
	'student' => isset($_REQUEST['student_payment'])?$_REQUEST['student_payment']:0,
	'teacher' => isset($_REQUEST['teacher_payment'])?$_REQUEST['teacher_payment']:0,
	'parent' =>isset($_REQUEST['parent_payment'])?$_REQUEST['parent_payment']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_payment'])?$_REQUEST['supportstaff_payment']:0,
	'page_link'=>'payment');
	//---------NEW MENU LINK END------------------
	
	//---------NEW MENU LINK START------------------
	$access_right['transport'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/transport.png' ),'menu_title'=>'Transport',
	'student' => isset($_REQUEST['student_transport'])?$_REQUEST['student_transport']:0,
	'teacher' => isset($_REQUEST['teacher_transport'])?$_REQUEST['teacher_transport']:0,
	'parent' =>isset($_REQUEST['parent_transport'])?$_REQUEST['parent_transport']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_transport'])?$_REQUEST['supportstaff_transport']:0,
	'page_link'=>'transport');
	//---------NEW MENU LINK END------------------
	//---------NEW MENU LINK START----------------
	$access_right['notice'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/notice.png' ),'menu_title'=>'Notice Board',
	'student' => isset($_REQUEST['student_notice'])?$_REQUEST['student_notice']:0,
	'teacher' => isset($_REQUEST['teacher_notice'])?$_REQUEST['teacher_notice']:0,
	'parent' =>isset($_REQUEST['parent_notice'])?$_REQUEST['parent_notice']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_notice'])?$_REQUEST['supportstaff_notice']:0,
	'page_link'=>'notice');
	//---------NEW MENU LINK END------------------
	
	
	//---------NEW MENU LINK START----------------
	$access_right['message'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/message.png' ),'menu_title'=>'Message',
	'student' => isset($_REQUEST['student_message'])?$_REQUEST['student_message']:0,
	'teacher' => isset($_REQUEST['teacher_message'])?$_REQUEST['teacher_message']:0,
	'parent' =>isset($_REQUEST['parent_message'])?$_REQUEST['parent_message']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_message'])?$_REQUEST['supportstaff_message']:0,
	'page_link'=>'message&tab=inbox');
	//---------NEW MENU LINK END------------------
	//---------NEW MENU LINK START------------------
	$access_right['holiday'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/holiday.png' ),'menu_title'=>'Holiday',
	'student' => isset($_REQUEST['student_holiday'])?$_REQUEST['student_holiday']:0,
	'teacher' => isset($_REQUEST['teacher_holiday'])?$_REQUEST['teacher_holiday']:0,
	'parent' =>isset($_REQUEST['parent_holiday'])?$_REQUEST['parent_holiday']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_holiday'])?$_REQUEST['supportstaff_holiday']:0,
	'page_link'=>'holiday');
	//---------NEW MENU LINK END------------------
	//---------NEW MENU LINK START------------------
	$access_right['library'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/library.png' ),'menu_title'=>'Library',
	'student' => isset($_REQUEST['student_library'])?$_REQUEST['student_library']:0,
	'teacher' => isset($_REQUEST['teacher_library'])?$_REQUEST['teacher_library']:0,
	'parent' =>isset($_REQUEST['parent_library'])?$_REQUEST['parent_library']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_library'])?$_REQUEST['supportstaff_library']:0,
	'page_link'=>'library');
	//---------NEW MENU LINK END------------------
	//---------NEW MENU LINK START------------------
	$access_right['account'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/account.png' ),'menu_title'=>'Account',
	'student' => isset($_REQUEST['student_account'])?$_REQUEST['student_account']:0,
	'teacher' => isset($_REQUEST['teacher_account'])?$_REQUEST['teacher_account']:0,
	'parent' =>isset($_REQUEST['parent_account'])?$_REQUEST['parent_account']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_account'])?$_REQUEST['supportstaff_account']:0,
	'page_link'=>'account');
	//---------NEW MENU LINK END------------------
	$access_right['report'] =array('menu_icone'=>plugins_url( 'school-management/assets/images/icons/report.png' ),'menu_title'=>'Report',
	'student' => isset($_REQUEST['student_report'])?$_REQUEST['student_report']:0,
	'teacher' => isset($_REQUEST['teacher_report'])?$_REQUEST['teacher_report']:0,
	'parent' =>isset($_REQUEST['parent_report'])?$_REQUEST['parent_report']:0,
	'supportstaff' =>isset($_REQUEST['supportstaff_report'])?$_REQUEST['supportstaff_report']:0,
	'page_link'=>'report');
	
	
	$result=update_option( 'smgt_access_right',$access_right );
	wp_redirect ( admin_url() . 'admin.php?page=smgt_access_right&message=1');
}
if(isset($_POST['save_other_access_right']))
{
	$result=update_option('smgt_subject_access',$_POST['subject_access']);
	$result=update_option('smgt_students_access',$_POST['students_access']);
	$result=update_option('smgt_attendance_access',$_POST['attendance_access']);
	$result=update_option('smgt_teacher_list_access',$_POST['smgt_teacher_list_access']);
	
	
	wp_redirect (admin_url() . 'admin.php?page=smgt_access_right&tab=teacher_accesslist&message=1');
}

if(isset($_POST['save_student_access_right']))
{
	$result=update_option('smgt_student_list_access',$_POST['smgt_student_list_access']);	
	
	wp_redirect (admin_url() . 'admin.php?page=smgt_access_right&tab=student_accesslist&message=1');
}




$access_right=get_option( 'smgt_access_right');

//var_dump($access_right);	

$active_tab = isset($_GET['tab'])?$_GET['tab']:'menu_accesslist';
?>

<div class="page-inner" >
<div class="page-title">


		<h3><img src="<?php echo get_option( 'smgt_school_logo' ) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo get_option( 'smgt_school_name' );?></h3>
	</div>
	<div id="main-wrapper">
	<?php
	$message = isset($_REQUEST['message'])?$_REQUEST['message']:'0';
	switch($message)
	{
		case '1':
			$message_string = __('Access Right Updated Successfully.','school-mgt');
			break;
	}
	
	if($message)
	{ ?>
		<div id="message" class="updated below-h2 notice is-dismissible">
			<p><?php echo $message_string;?></p>
			<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button>
		</div>
<?php } ?>
	 
		<div class="row"><!-- ROW DIV START-->
			<div class="col-md-12"><!-- COL 12 DIV START-->
				<div class="panel panel-white"><!-- PANEL WHITE DIV START-->
					<div class="panel-body"><!-- PANEL BODY DIV START-->
					<h2 class="nav-tab-wrapper">
						<a href="?page=smgt_access_right&tab=menu_accesslist" class="nav-tab <?php echo $active_tab == 'menu_accesslist' ? 'nav-tab-active' : ''; ?>">
						<?php echo '<span class="dashicons dashicons-menu"></span>'.__('Access Right Settings', 'school-mgt'); ?></a>
						<a href="?page=smgt_access_right&tab=teacher_accesslist" class="nav-tab <?php echo $active_tab == 'teacher_accesslist' ? 'nav-tab-active' : ''; ?>">
						<?php echo '<span class="dashicons dashicons-menu"></span>'.__('Teacher Access Right', 'school-mgt'); ?></a>
						<a href="?page=smgt_access_right&tab=student_accesslist" class="nav-tab margin_bottom <?php echo $active_tab == 'student_accesslist' ? 'nav-tab-active' : ''; ?>">
						<?php echo '<span class="dashicons dashicons-menu"></span>'.__('Student Access Right', 'school-mgt'); ?></a>
					</h2>
					<?php if($active_tab=='menu_accesslist'){ ?>
					 <div class="panel-body panel-body_acccess"><!-- PANEL BODY DIV START-->
						<form name="student_form" action="" method="post" class="form-horizontal" id="access_right_form">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3"><?php _e('Menu','school-mgt');?></div>
								<div class="col-md-2 col-sm-2 col-xs-2 teacher_label"><?php _e('Teacher','school-mgt');?></div>
								<div class="col-md-2 col-sm-2 col-xs-2"><?php _e('Student','school-mgt');?></div>
								<div class="col-md-2 col-sm-2 col-xs-2"><?php _e('Parent','school-mgt');?></div>
								<div class="col-md-2 col-sm-2 col-xs-2"><?php _e('Support Staff','school-mgt');?></div>
							</div>
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Teacher','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['teacher']['teacher'],1);?> value="1" name="teacher_teacher" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['teacher']['student'],1);?> value="1" name="student_teacher" readonly>	              
										</label>
									</div>
								</div>
							
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['teacher']['parent'],1);?> value="1" name="parent_teacher" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['teacher']['supportstaff'],1);?> value="1" name="supportstaff_teacher" readonly>	              
										</label>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Student','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['student']['teacher'],1);?> value="1" name="teacher_student" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['student']['student'],1);?> value="1" name="student_student" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['student']['parent'],1);?> value="1" name="parent_student" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['student']['supportstaff'],1);?> value="1" name="supportstaff_student" readonly>	              
										</label>
									</div>
								</div>
								
							</div>
							
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Child','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['child']['teacher'],1);?> value="1" name="teacher_child" disabled="disabled">	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['child']['student'],1);?> value="1" name="student_child" disabled="disabled">	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['child']['parent'],1);?> value="1" name="parent_child" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['child']['supportstaff'],1);?> value="1" name="supportstaff_child" disabled="disabled">
											</label>
									</div>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Parent','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['parent']['teacher'],1);?> value="1" name="teacher_parent" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['parent']['student'],1);?> value="1" name="student_parent" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['parent']['parent'],1);?> value="1" name="parent_parent" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['parent']['supportstaff'],1);?> value="1" name="supportstaff_parent" readonly>
											</label>
									</div>
								</div>
							</div>
							
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Subject','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['subject']['teacher'],1);?> value="1" name="teacher_subject" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['subject']['student'],1);?> value="1" name="student_subject" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['subject']['parent'],1);?> value="1" name="parent_subject" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['subject']['supportstaff'],1);?> value="1" name="supportstaff_subject" readonly>
											</label>
									</div>
								</div>
							</div>
								
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Class Routine','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['schedule']['teacher'],1);?> value="1" name="teacher_schedule" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['schedule']['student'],1);?> value="1" name="student_schedule" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['schedule']['parent'],1);?> value="1" name="parent_schedule" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['schedule']['supportstaff'],1);?> value="1" name="supportstaff_schedule" readonly>
											</label>
									</div>
								</div>
							</div>	
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Attendance','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['attendance']['teacher'],1);?> value="1" name="teacher_attendance" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['attendance']['student'],1);?> value="1" name="student_attendance" disabled >	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['attendance']['parent'],1);?> disabled value="1" name="parent_attendance" disabled >	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['attendance']['supportstaff'],1);?> disabled value="1" name="supportstaff_attendance" readonly>
											</label>
									</div>
								</div>
							</div>	
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Exam','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['exam']['teacher'],1);?> value="1" name="teacher_exam" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['exam']['student'],1);?> value="1" name="student_exam" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['exam']['parent'],1);?> value="1" name="parent_exam" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['exam']['supportstaff'],1);?> value="1" name="supportstaff_exam" readonly>
											</label>
									</div>
								</div>
							</div>	
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Manage Marks','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['manage_marks']['teacher'],1);?> value="1" name="teacher_manage_marks" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['manage_marks']['student'],1);?> value="1" name="student_manage_marks" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['manage_marks']['parent'],1);?> disabled value="1" name="parent_manage_marks" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['manage_marks']['supportstaff'],1);?> disabled value="1" name="supportstaff_manage_marks" readonly>
											</label>
									</div>
								</div>
							</div>	
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Fee Payment','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['feepayment']['teacher'],1);?> value="1" name="teacher_feepayment" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['feepayment']['student'],1);?> value="1" name="student_feepayment" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['feepayment']['parent'],1);?> value="1" name="parent_feepayment" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['feepayment']['supportstaff'],1);?> value="1" name="supportstaff_feepayment" readonly>
											</label>
									</div>
								</div>
							</div>	
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Payment','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['payment']['teacher'],1);?> value="1" name="teacher_payment" disabled="disabled">	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['payment']['student'],1);?> value="1" name="student_payment">	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['payment']['parent'],1);?> value="1" name="parent_payment">	              
										</label>
									</div>
								</div>
							<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['payment']['supportstaff'],1);?> value="1" name="supportstaff_payment" readonly>
											</label>
									</div>
								</div>
							</div>	
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Transport','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['transport']['teacher'],1);?> value="1" name="teacher_transport" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['transport']['student'],1);?> value="1" name="student_transport" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['transport']['parent'],1);?> value="1" name="parent_transport" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['transport']['supportstaff'],1);?> value="1" name="supportstaff_transport" readonly>
											</label>
									</div>
								</div>
							</div>	
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Notice Board','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['notice']['teacher'],1);?> value="1" name="teacher_notice" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['notice']['student'],1);?> value="1" name="student_notice" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['notice']['parent'],1);?> value="1" name="parent_notice" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['notice']['supportstaff'],1);?> value="1" name="supportstaff_notice" readonly>
											</label>
									</div>
								</div>
							</div>	
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Message','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['message']['teacher'],1);?> value="1" name="teacher_message" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['message']['student'],1);?> value="1" name="student_message" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['message']['parent'],1);?> value="1" name="parent_message" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['message']['supportstaff'],1);?> value="1" name="supportstaff_message" readonly>
											</label>
									</div>
								</div>
							</div>


							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Holiday','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['holiday']['teacher'],1);?> value="1" name="teacher_holiday" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['holiday']['student'],1);?> value="1" name="student_holiday" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['holiday']['parent'],1);?> value="1" name="parent_holiday" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['holiday']['supportstaff'],1);?> value="1" name="supportstaff_holiday" readonly>
											</label>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Library','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['library']['teacher'],1);?> value="1" name="teacher_library" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['library']['student'],1);?> value="1" name="student_library" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['library']['parent'],1);?> value="1" name="parent_library" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['library']['supportstaff'],1);?> value="1" name="supportstaff_library" readonly>
											</label>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Account','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['account']['teacher'],1);?> value="1" name="teacher_account" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['account']['student'],1);?> value="1" name="student_account" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['account']['parent'],1);?> value="1" name="parent_account" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['account']['supportstaff'],1);?> value="1" name="supportstaff_account" readonly>
											</label>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<span class="menu-label">
										<?php _e('Report','school-mgt');?>
									</span>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['report']['teacher'],1);?> value="1" name="teacher_report" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['report']['student'],1);?> value="1" name="student_report" readonly>	              
										</label>
									</div>
								</div>
								
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['report']['parent'],1);?> value="1" name="parent_report" readonly>	              
										</label>
									</div>
								</div>
								<div class="col-md-2 col-sm-2 col-xs-2">
									<div class="checkbox">
										<label>
											<input type="checkbox" <?php echo checked($access_right['report']['supportstaff'],1);?> value="1" name="supportstaff_report" readonly>
											</label>
									</div>
								</div>
							</div>
					 
							<div class="col-sm-offset-2 col-sm-8 row_bottom">
								<input type="submit" value="<?php _e('Save', 'school-mgt' ); ?>" name="save_access_right" class="btn btn-success btn_top"/>
							</div>
							
							
							</div>
							<?php }
								if($active_tab=='teacher_accesslist')
								{ ?>
									<div class="panel-body">
									<form name="student_form" action="" method="post" class="form-horizontal" id="access_right_form">
										<div class="row">
											<div class="col-md-2">
												<span class="menu-label">
													<?php _e('View Subjects','school-mgt');?>
												</span>
											</div>
											<div class="col-md-4">
											<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_subject_access'),'all');?> value="all" name="subject_access" readonly><span class="access_right_text"><?php _e('All Subjects','school-mgt'); ?></span>	              
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_subject_access'),'own_class');?> value="own_class" name="subject_access" readonly><span class="access_right_text"><?php _e('Only Own Class Subjects','school-mgt'); ?>	</span>              
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_subject_access'),'own_subjects');?> value="own_subjects" name="subject_access" readonly><span class="access_right_text"><?php _e('Only Own Subjects','school-mgt'); ?>	</span>              
													</label>
												</div>
											</div>
											
										</div>
										<div class="row">
											<div class="col-md-2">
												<span class="menu-label">
													<?php _e('View Students','school-mgt');?>
												</span>
											</div>
											<div class="col-md-4">
												<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_students_access'),'all');?> value="all" name="students_access" readonly><span class="access_right_text"><?php _e('All Students','school-mgt'); ?>	</span>                    
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_students_access'),'own');?> value="own" name="students_access" readonly><span class="access_right_text"><?php _e('Only Own Class Students','school-mgt'); ?>	</span>                  
													</label>  
												</div>
											</div>
											
										</div>
										<div class="row">
											<div class="col-md-2">
												<span class="menu-label">
													<?php _e('Students Attendance','school-mgt');?>
												</span>
											</div>
											<div class="col-md-4">
												<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_attendance_access'),'all');?> value="all" name="attendance_access" readonly><span class="access_right_text"><?php _e('All Students Attendance','school-mgt'); ?>	</span>                  
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_attendance_access'),'own_subject');?> value="own_subject" name="attendance_access" readonly><span class="access_right_text"><?php _e('Only Own Subject Students Attendance','school-mgt'); ?></span>    	              
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_attendance_access'),'own_class');?> value="own_class" name="attendance_access" readonly><span class="access_right_text"><?php _e('Only Own Class Students Attendance','school-mgt'); ?></span>    	              
													</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<span class="menu-label">
													<?php _e('View Teachers','school-mgt');?>
												</span>
											</div>
											<div class="col-md-4">
											<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_teacher_list_access'),'all');?> value="all" name="smgt_teacher_list_access" readonly><span class="access_right_text"> <?php _e('All Teachers','school-mgt'); ?>	   </span>               
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_teacher_list_access'),'own');?> value="own" name="smgt_teacher_list_access" readonly><span class="access_right_text"> <?php _e('Only Own','school-mgt'); ?>	  </span>                
													</label>
												</div>
											</div>
										</div>
										
										
										<div class="col-sm-offset-2 col-sm-8 row_bottom">
											<input type="submit" value="<?php _e('Save', 'school-mgt' ); ?>" name="save_other_access_right" class="btn btn-success btn_top"/>
										</div>
							
									</form>
									</div>
								<?php } 
								if($active_tab=='student_accesslist')
								{ ?>
								<div class="panel-body">
									<form name="student_form" action="" method="post" class="form-horizontal" id="access_right_form">
										<div class="row">
											<div class="col-md-2">
												<span class="menu-label">
													<?php _e('View Students','school-mgt');?>
												</span>
											</div>
											<div class="col-md-4">
											<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_student_list_access'),'all');?> value="all" name="smgt_student_list_access" readonly> <?php _e('All Student','school-mgt'); ?>	              
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_student_list_access'),'own_class');?> value="own_class" name="smgt_student_list_access" readonly> <?php _e('Only Own','school-mgt'); ?>	              
													</label>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-2">
												<span class="menu-label">
													<?php _e('View Teachers','school-mgt');?>
												</span>
											</div>
											<div class="col-md-4">
											<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_teacher_show_access'),'all');?> value="all" name="smgt_student_access" readonly> <?php _e('All Teachers','school-mgt'); ?>	              
													</label>
												</div>
												<div class="checkbox">
													<label>
														<input type="radio" <?php echo checked(get_option('smgt_teacher_show_access'),'own_class');?> value="own_class" name="smgt_student_access" readonly> <?php _e('Only Own Class Teachers','school-mgt'); ?>	              
													</label>
												</div>
											</div>
										</div>
					
					<div class="col-sm-offset-2 col-sm-8 row_bottom">
						<br>
						<input type="submit" value="<?php _e('Save', 'school-mgt' ); ?>" name="save_student_access_right" class="btn btn-success btn_top"/>
					</div>
				</form>
			<?php } ?>
        </form>
		</div>
        </div>
        </div>
        </div>
        
 <?php

?> 