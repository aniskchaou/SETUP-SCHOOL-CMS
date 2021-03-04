<?php

// render template//
global $current_user;
$user_roles = $current_user->roles;
$user_role = array_shift($user_roles);

if($user_role != 'teacher' && $user_role != 'student'  && $user_role != 'parent'  && $user_role != 'supportstaff')
{ 
	wp_redirect ( admin_url () . 'index.php' );
}
if(isset($_REQUEST['print']) && $_REQUEST['print'] == 'pdf')
{
	$sudent_id = $_REQUEST['student'];
	downlosd_smgt_result_pdf($sudent_id);
}
$obj_attend = new Attendence_Manage ();
$school_obj = new School_Management ( get_current_user_id () );
$notive_array = array ();

if($school_obj->role=='student'){
    $class_name = $school_obj->class_info->class_id;
	$class_section = $school_obj->class_info->class_section;
	$notice_list_student = student_notice_dashbord($class_name,$class_section);
	
if (! empty ($notice_list_student)) {
	    
		foreach ($notice_list_student as $notice ) {
		
			//$notice=get_post($noticeid);
			
			 $notice_start_date=get_post_meta($notice->ID,'start_date',true);
			$notice_end_date=get_post_meta($notice->ID,'end_date',true);
			//echo $notice->post_title;
				$i=1;
				
				$notive_array [] = array (
						'title' => $notice->post_title,
						'start' => mysql2date('Y-m-d', $notice_start_date ),
						'end' => date('Y-m-d',strtotime($notice_end_date.' +'.$i.' days'))
				);	
		}
	}
	
}
if($school_obj->role=='parent'){
$notice_list_parent = parent_notice_dashbord();
 if (! empty ($notice_list_parent)) {
	    
		foreach ($notice_list_parent as $notice ) {
		
			//$notice=get_post($noticeid);
			
			 $notice_start_date=get_post_meta($notice->ID,'start_date',true);
			$notice_end_date=get_post_meta($notice->ID,'end_date',true);
			//echo $notice->post_title;
				$i=1;
				
				$notive_array [] = array (
						'title' => $notice->post_title,
						'start' => mysql2date('Y-m-d', $notice_start_date ),
						'end' => date('Y-m-d',strtotime($notice_end_date.' +'.$i.' days'))
				);	
		}
	}
	
}
if($school_obj->role=='supportstaff'){
   /* $notice_list_student = get_posts(array(
			'post_type' => 'notice',
			'meta_query' =>  array(
			'relation' => 'AND',
			array(
			'relation' => 'OR',
			array(
			'key' => 'notice_for',
			'value' => 'all',
			'compare' => '='
			),
			array(
			'key' => 'notice_for',
			'value' => 'supportstaff',
			'compare' => '=',
			)
			)
			))); */
			$notice_list_supportstaff = supportstaff_notice_dashbord();

if (! empty ($notice_list_supportstaff)) {
	    
		foreach ($notice_list_supportstaff as $notice ) {
		
			//$notice=get_post($noticeid);
			
			 $notice_start_date=get_post_meta($notice->ID,'start_date',true);
			$notice_end_date=get_post_meta($notice->ID,'end_date',true);
			//echo $notice->post_title;
				$i=1;
				
				$notive_array [] = array (
						'title' => $notice->post_title,
						'start' => mysql2date('Y-m-d', $notice_start_date ),
						'end' => date('Y-m-d',strtotime($notice_end_date.' +'.$i.' days'))
				);	
		}
	}
	
}
if($school_obj->role=='teacher'){
    $class_name = $school_obj->class_info->class_id;
	$class_section = $school_obj->class_info->class_section;
	 $class_name = $school_obj->class_info->class_id;
	$class_section = $school_obj->class_info->class_section;
	$notice_list_teacher = teacher_notice_dashbord($class_name);

if (! empty ($notice_list_teacher)) {
	    
		foreach ($notice_list_teacher as $notice ) {
		
			//$notice=get_post($noticeid);
			
			 $notice_start_date=get_post_meta($notice->ID,'start_date',true);
			$notice_end_date=get_post_meta($notice->ID,'end_date',true);
			//echo $notice->post_title;
				$i=1;
				
				$notive_array [] = array (
						'title' => $notice->post_title,
						'start' => mysql2date('Y-m-d', $notice_start_date ),
						'end' => date('Y-m-d',strtotime($notice_end_date.' +'.$i.' days'))
				);	
		}
	}
	
}

$holiday_list = get_all_data ( 'holiday' );
if (! empty ( $holiday_list )) {
	foreach ( $holiday_list as $notice ) {
		$notice_start_date=$notice->date;
		$notice_end_date=$notice->end_date;
		//echo $notice->post_title;
		$i=1;
			
		$notive_array [] = array (
				'title' => $notice->holiday_title,
				'start' => mysql2date('Y-m-d', $notice_start_date ),
				'end' => date('Y-m-d',strtotime($notice_end_date.' +'.$i.' days')),
				'color' => 'rgb(91,192,222)'
		);
	}
}
//var_dump($notive_array);
//exit;
if (! is_user_logged_in ()) {
	$page_id = get_option ( 'smgt_login_page' );
	
	wp_redirect ( home_url () . "?page_id=" . $page_id );
}
if (is_super_admin ()) {
	wp_redirect ( admin_url () . 'admin.php?page=smgt_school' );
}

?><!-- For Popup -->
<div class="popup-bg">
    <div class="overlay-content">   
    	<div class="notice_content"></div>    
    </div>     
</div>	

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/bootstrap-multiselect.css'; ?>">
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/dataTables.css'; ?>">
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/dataTables.editor.min.css'; ?>">
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/dataTables.tableTools.css'; ?>">
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/jquery-ui.css'; ?>">
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/font-awesome.min.css'; ?>">
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/popup.css'; ?>">
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/style.css'; ?>">
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/fullcalendar.css'; ?>">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/bootstrap.min.css'; ?>">	
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/white.css'; ?>">
    
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/schoolmgt.min.css'; ?>">
<?php if (is_rtl()) {?>
			<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/bootstrap-rtl.min.css'; ?>">
		<?php  }?>

<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/simple-line-icons.css'; ?>">
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/lib/validationEngine/css/validationEngine.jquery.css'; ?>">
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/school-responsive.css'; ?>">
<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/dataTables.responsive.css'; ?>">


<?php 
if(@file_exists(get_stylesheet_directory().'/css/smgt-customcss.css')) {
	?>
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/smgt-customcss.css" type="text/css" />
	<?php 
}
else 
{
	?>
	<link rel="stylesheet"	href="<?php echo SMS_PLUGIN_URL.'/assets/css/smgt-customcss.css'; ?>">
	<?php 
}
?>
<!--<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/js/jquery-1.11.1.min.js'; ?>"></script>-->

<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/accordian/jquery-1.10.2.js'; ?>"></script>

<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/js/bootstrap-multiselect.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/js/jquery.timeago.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/js/jquery-ui.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/js/moment.min.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/js/fullcalendar.min.js'; ?>"></script>
<?php /*--------Full calendar multilanguage---------*/
	$lancode=get_locale();
	$code=substr($lancode,0,2);?>
<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/js/calendar-lang/'.$code.'.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/js/jquery.dataTables.min.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/js/dataTables.tableTools.min.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/js/dataTables.editor.min.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/js/dataTables.responsive.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/assets/js/bootstrap.min.js'; ?>"></script>


<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/lib/validationEngine/js/languages/jquery.validationEngine-'.$code.'.js'; ?>"></script>
<script type="text/javascript"	src="<?php echo SMS_PLUGIN_URL.'/lib/validationEngine/js/jquery.validationEngine.js'; ?>"></script>


<script>
	$(document).ready(function()
	{
		$('.nav>li>a').on('click', function(){
		$(".nav.nav-pills.nav-stacked.collapse.out").css({"background-color": "yellow", "display": "none"});
        });
		
		$('#calendar').fullCalendar(
		{
			 header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				editable: false,
				slotEventOverlap: false,
				timeFormat: 'h(:mm)a',
			eventLimit: true, // allow "more" link when too many events
			events: <?php echo json_encode($notive_array);?>,
			forceEventDuration : true,
	        eventMouseover: function (event, jsEvent, view) {
			//end date change with minus 1 day
			<?php $dformate=get_option('smgt_datepicker_format'); ?>
			var dateformate_value='<?php echo $dformate;?>';	
			if(dateformate_value == 'yy-mm-dd')
			{	
			var dateformate='YYYY-MM-DD';
			}
			if(dateformate_value == 'yy/mm/dd')
			{	
			var dateformate='YYYY/MM/DD';	
			}
			if(dateformate_value == 'dd-mm-yy')
			{	
			var dateformate='DD-MM-YYYY';
			}
			if(dateformate_value == 'mm-dd-yy')
			{	
			var dateformate='MM-DD-YYYY';
			}
			if(dateformate_value == 'mm/dd/yy')
			{	
			var dateformate='MM/DD/YYYY';	
			}
			 var newdate = event.end;
			 var type = event.type;
			 var date = new Date(newdate);
			 var newdate1 = new Date(date);
			 
			 if(type == 'reservationdata')
			 {
				newdate1.setDate(newdate1.getDate());
			 }
			 else
			 {
				 newdate1.setDate(newdate1.getDate() - 1);
			 }
			 var dateObj = new Date(newdate1);
			 var momentObj = moment(dateObj);
			 var momentString = momentObj.format(dateformate);
			 
			 var newstartdate = event.start;
			 var date = new Date(newstartdate);
			 var startdate = new Date(date);
			 var dateObjstart = new Date(startdate);
			 var momentObjstart = moment(dateObjstart);
			 var momentStringstart = momentObjstart.format(dateformate);
						tooltip = "<div class='tooltiptopicevent' style='width:auto;height:auto;background:#feb811;position:absolute;z-index:10001;padding:10px 10px 10px 10px ;  line-height: 200%;'>" + "<?php _e("Title Name","school-mgt"); ?>" + " : " + event.title + "</br>" + " <?php _e("Start Date","school-mgt"); ?> " + " : " + momentStringstart + "</br>" + "<?php _e("End Date","school-mgt"); ?>" + " : " + momentString + "</br>" +  " </div>";						
						$("body").append(tooltip);
						$(this).mouseover(function (e) {
							$(this).css('z-index', 10000);
							$('.tooltiptopicevent').fadeIn('500');
							$('.tooltiptopicevent').fadeTo('10', 1.9);
						}).mousemove(function (e) {
							$('.tooltiptopicevent').css('top', e.pageY + 10);
							$('.tooltiptopicevent').css('left', e.pageX + 20);
						});

					},
					eventMouseout: function (data, event, view) {
						$(this).css('z-index', 8);

						$('.tooltiptopicevent').remove();

					},
		});
	});
</script>



</head>

<body class="schoo-management-content">
  <?php
 // echo get_stylesheet_directory().'/css/smgt-customcss.css';
		$user = wp_get_current_user ();
		?>
  <div class="container-fluid mainpage">
  <div class="navbar">
	
	<div class="col-md-8 col-sm-8 col-xs-6">
		<h3><img src="<?php echo get_option( 'smgt_school_logo' ) ?>" class="img-circle head_logo" width="40" height="40" />
		<span><?php echo get_option( 'smgt_school_name' );?> </span>
		</h3></div>
		
		<ul class="nav navbar-right col-md-4 col-sm-4 col-xs-6">				
			<li class="dropdown">
			<a data-toggle="dropdown" aria-expanded="false"	class="dropdown-toggle" href="javascript:;">
			<?php
				$umetadata = get_user_image ( $user->ID );
				if (empty ( $umetadata ['meta_value'] )){
					echo '<img src='.get_option( 'smgt_student_thumb' ).' height="40px" width="40px" class="img-circle" />';
				}
				else
					echo '<img src=' . $umetadata ['meta_value'] . ' height="40px" width="40px" class="img-circle"/>';
				?>
				<span><?php echo $user->display_name;?> </span> <b class="caret"></b>
			</a>
			<ul class="dropdown-menu extended logout">
				<li><a href="?dashboard=user&page=account"><i class="fa fa-user"></i>
					<?php _e('My Profile','school-mgt');?></a></li>
				<li><a href="<?php echo wp_logout_url(home_url()); ?>"><i class="fa fa-sign-out m-r-xs"></i><?php _e('Log Out','school-mgt');?> </a></li>
			</ul>
			</li><!-- END USER LOGIN DROPDOWN -->
		</ul>
	
	</div>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-2 nopadding school_left nav-side-menu">
				<div class="brand"><?php _e('Menu','school-mgt');?>
					<i class="fa fa-bars fa-2x toggle-btn avbar-toggler"  data-toggle="collapse" data-target="#menu-content" aria-expanded="false" ></i>
				</div>
<?php
	$menu = get_option('smgt_access_right');
	$class = "";
	if (! isset ( $_REQUEST ['page'] ))	
		$class = 'class = "active"'; 
?>
	<ul class="nav nav-pills nav-stacked collapse out" id="menu-content">  
		<li><a href="<?php echo site_url();?>"><span class="icone"><img src="<?php echo SMS_PLUGIN_URL .'/assets/images/icons/home.png'?>"/></span><span class="title"><?php _e('Home','school-mgt');?></span></a></li>
		<li <?php echo $class;?>><a href="?dashboard=user"><span class="icone"><img src="<?php echo SMS_PLUGIN_URL .'/assets/images/icons/dashboard.png'?>"/></span>
			<span class="title"><?php _e('Dashboard','school-mgt');?></span></a> </li>
        <?php
			$role = $school_obj->role;
			
			foreach ($menu as $key=>$value) 
			{
				
				if ($value [$role]) 
				{
					if($key == 'schedule' )
					{
						if (isset ( $_REQUEST ['page'] ) && $_REQUEST ['page'] == $value ['page_link'])
							$class = 'class = "active"';
						else
							$class = "";
							echo '<li ' . $class . '><a href="?dashboard=user&page=' . $value ['page_link'] . '" ><span class="icone"> <img src="' .$value ['menu_icone'].'" /></span><span class="title class_routine">'.change_menutitle($key).'</span></a></li>';	
					}
					else
					{
						
						if (isset ( $_REQUEST ['page'] ) && $_REQUEST ['page'] == $value ['page_link'])
							$class = 'class = "active"';
						else
							$class = "";
							echo '<li ' . $class . '><a href="?dashboard=user&page=' . $value ['page_link'] . '" ><span class="icone"> <img src="' .$value ['menu_icone'].'" /></span><span class="title">'.change_menutitle($key).'</span></a></li>';	
						
					}
				}
				//var_dump($key);
			}
			
		?>							
    </ul>
</div>
		
<div class="page-inner">
	<div id="main-wrapper_fronend">
	<div class="right_side <?php if(isset($_REQUEST['page']))echo $_REQUEST['page'];?>">
   <?php
		if (isset ( $_REQUEST ['page'] )) 
		{
			if(file_exists(SMS_PLUGIN_DIR . '/template/' . $_REQUEST ['page'] . '.php'))
			{
				require_once(SMS_PLUGIN_DIR . '/template/' . $_REQUEST ['page'] . '.php');			
				return false;
			} 
			else
			{
				?><h2><?php print "404 ! Page did not found."; die;?></h2><?php
			}
		}
	?>
	<div class="row">
		<?php
			//$student=get_option('smgt_enable_total_student');
			$page='student';
			$student=page_access_rolewise_accessright_dashboard($page);
			if($student==1)
			{
			?>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="<?php print site_url().'/?dashboard=user&page=student' ?>">
					<div class="panel info-box panel-white">
						<div class="panel-body student">
							<div class="info-box-stats">
							    <?php
								$user_query = new WP_User_Query( array( 'role' => 'student' ) );
								$student_count = (int) $user_query->get_total();
								?>
								<p class="counter"><?php echo $student_count;?></p>
								<span class="info-box-title"><?php echo esc_html( __( 'Student', 'school-mgt' ) );?></span>
							</div>
						</div>
					</div>
				</a>
			</div>
	<?php }
		
	
		//$teacher=get_option('smgt_enable_total_teacher');
		$page='teacher';
		$teacher=page_access_rolewise_accessright_dashboard($page);
		if($teacher==1)
		{
		?>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a href="<?php print site_url().'/?dashboard=user&page=teacher' ?>">
				<div class="panel info-box panel-white">
					<div class="panel-body teacher">
						<div class="info-box-stats">
						    <?php
								$user_query = new WP_User_Query( array( 'role' => 'teacher' ) );
								$teacher_count = (int) $user_query->get_total();
							?>
							<p class="counter"><?php echo $teacher_count;?></p>
							<span class="info-box-title"><?php echo esc_html( __( 'teacher', 'school-mgt' ) );?></span>
						</div>
					</div>
				</div>
			</a>
		</div>
		<?php } 
		
		//$parent=get_option('smgt_enable_total_parent');
		$page='parent';
		$parent=page_access_rolewise_accessright_dashboard($page);
		if($parent==1)
		{
		?>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a href="<?php print site_url().'/?dashboard=user&page=parent' ?>">
				<div class="panel info-box panel-white">
					<div class="panel-body parent">
						<div class="info-box-stats">
						    <?php
								$user_query = new WP_User_Query( array( 'role' => 'parent' ) );
								$parent_count = (int) $user_query->get_total();
							?>
							<p class="counter"><?php echo $parent_count;?></p>
							<span class="info-box-title"><?php echo esc_html( __( 'parent', 'school-mgt' ) );?></span>
						</div>
					</div>
				</div>
			</a>
		</div>
	<?php
	}
	$attendance=get_option('smgt_enable_total_attendance');
	if($attendance==1)
	{
	?>
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
	<?php if($school_obj->role=='teacher')
	{ ?>
        <a href="<?php print site_url().'/?dashboard=user&page=attendance' ?>">
	<?php 
	}
	?>
	
			<div class="panel info-box panel-white">
				<div class="panel-body attendence">
					<div class="info-box-stats">
						<p class="counter"><?php echo $obj_attend->today_presents();?></p>
						<span class="info-box-title"><?php echo esc_html( __( 'Today Attendance', 'school-mgt' ) );?></span>
					</div>
				</div>
			</div>
		<!--</a>-->
	</div>
<?php } ?>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="panel panel-white">
				<div class="panel-body">
					<div id="calendar"></div><br>
					<mark style="height:5px;width:10px; background:rgb(34,186,160)">&nbsp;&nbsp;&nbsp;</mark><span> &nbsp;<?php _e('Notice','school-mgt') ?><span><br><br>
					<mark style="height:5px;width:10px; background:rgb(91,192,222)">&nbsp;&nbsp;&nbsp;</mark><span> &nbsp;<?php _e('Holiday','school-mgt') ?><span>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="panel panel-white">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-bell" aria-hidden="true"></i> <?php _e('Notice','school-mgt');?></h3>
				</div>
			<div class="panel-body">
			
			<table class="table">
				<tr>
					<th><?php _e('Notice Title','school-mgt')?></th>
					<th><?php _e('Notice Date','school-mgt')?></th>
				</tr>	
				<?php
				   /* $args['post_type'] = 'notice';
					$args['posts_per_page'] = 3;
					$args['post_status'] = 'public';
					$q = new WP_Query();				
					$retrieve_class= $school_obj->notice_board($school_obj->role,3); */				
					if($school_obj->role=='student')
					{
						$class_name = $school_obj->class_info->class_id;
						$class_section = $school_obj->class_info->class_section;
						$notice_list_student = student_notice_board($class_name,$class_section);
						foreach ($notice_list_student as $postid)
						{
							$retrieved_data=get_post($postid);
							
						$sdate = strtotime($retrieved_data->start_date);
						$edate = strtotime($retrieved_data->end_date);
						if($sdate == $edate)
						{
							$date = smgt_getdate_in_input_box($retrieved_data->start_date);
						}
						else
						{
							$date = smgt_getdate_in_input_box($retrieved_data->start_date) . " To ". smgt_getdate_in_input_box($retrieved_data->end_date);
						}
						
					?> 
						<a style="color:black; text-decoration:none" id="<?php print $retrieved_data->ID ?>" class="view-notice" href="#">
						<tr>
							<td><?php  echo $retrieved_data->post_title;?></td>
							<td> <?php print $date ?></td>
						</tr>
						</a>				
				
				<?php }
			}
			if($school_obj->role=='teacher')
					{
						$class_name = $school_obj->class_info->class_id;
						//$class_section = $school_obj->class_info->class_section;
						$notice_list_teacher = teacher_notice_board($class_name);
						foreach ($notice_list_teacher as $postid)
						{
							$retrieved_data=get_post($postid);
							
						$sdate = strtotime($retrieved_data->start_date);
						$edate = strtotime($retrieved_data->end_date);
						if($sdate == $edate)
						{
							$date = smgt_getdate_in_input_box($retrieved_data->start_date);
						}
						else
						{
							$date = smgt_getdate_in_input_box($retrieved_data->start_date) . " To ". smgt_getdate_in_input_box($retrieved_data->end_date);
						}
						
					?> 
						<a style="color:black; text-decoration:none" id="<?php print $retrieved_data->ID ?>" class="view-notice" href="#">
						<tr>
							<td><?php  echo $retrieved_data->post_title;?></td>
							<td> <?php print $date ?></td>
						</tr>
						</a>				
				
				<?php }
			}
			if($school_obj->role=='parent')
					{
						//$class_name = $school_obj->class_info->class_id;
						//$class_section = $school_obj->class_info->class_section;
						$notice_list_parent = parent_notice_board();
						foreach ($notice_list_parent as $postid)
						{
							$retrieved_data=get_post($postid);
							
						$sdate = strtotime($retrieved_data->start_date);
						$edate = strtotime($retrieved_data->end_date);
						if($sdate == $edate)
						{
							$date = smgt_getdate_in_input_box($retrieved_data->start_date);
						}
						else
						{
							$date = smgt_getdate_in_input_box($retrieved_data->start_date) . " To ". smgt_getdate_in_input_box($retrieved_data->end_date);
						}
						
					?> 
						<a style="color:black; text-decoration:none" id="<?php print $retrieved_data->ID ?>" class="view-notice" href="#">
						<tr>
							<td><?php  echo $retrieved_data->post_title;?></td>
							<td> <?php print $date ?></td>
						</tr>
						</a>				
				
				<?php }
			}
			if($school_obj->role=='supportstaff')
					{
						//$class_name = $school_obj->class_info->class_id;
						//$class_section = $school_obj->class_info->class_section;
						$notice_list_supportstaff = supportstaff_notice_board();
						foreach ($notice_list_supportstaff as $postid)
						{
							$retrieved_data=get_post($postid);
							
						$sdate = strtotime($retrieved_data->start_date);
						$edate = strtotime($retrieved_data->end_date);
						if($sdate == $edate)
						{
							$date = smgt_getdate_in_input_box($retrieved_data->start_date);
						}
						else
						{
							$date = smgt_getdate_in_input_box($retrieved_data->start_date) . " To ". smgt_getdate_in_input_box($retrieved_data->end_date);
						}
						
					?> 
						<a style="color:black; text-decoration:none" id="<?php print $retrieved_data->ID ?>" class="view-notice" href="#">
						<tr>
							<td><?php  echo $retrieved_data->post_title;?></td>
							<td> <?php print $date ?></td>
						</tr>
						</a>				
				
				<?php }
			}
			/* else
			{					
				foreach ($retrieve_class as $retrieved_data){$sdate = strtotime($retrieved_data->start_date);
						$edate = strtotime($retrieved_data->end_date);
						if($sdate == $edate)
						{
							$date = smgt_getdate_in_input_box($retrieved_data->start_date);
						}
						else
						{
							$date = smgt_getdate_in_input_box($retrieved_data->start_date) . " To ". smgt_getdate_in_input_box($retrieved_data->end_date);
						}
						
					?> 
						<a style="color:black; text-decoration:none" id="<?php print $retrieved_data->ID ?>" class="view-notice" href="#">
						<tr>
							<td><?php  echo $retrieved_data->post_title;?></td>
							<td> <?php print $date ?></td>
						</tr>
						</a>
					<?php } 
			} */ ?>
			</table>
			</div>
			</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-white">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-calendar" aria-hidden="true"></i> <?php _e('Holiday List','school-mgt');?></h3>						
					</div>
					<div class="panel-body">
					<table class="table">
						<tr>
							<th><?php _e('Holiday Title','school-mgt')?></th>
							<th><?php _e('Holiday Date','school-mgt')?></th>
						</tr>
					<?php
					$tablename="holiday";			
					$retrieve_class = get_all_data($tablename);
					
					foreach ($retrieve_class as $retrieved_data){ $sdate = strtotime($retrieved_data->date);
						$edate = strtotime($retrieved_data->end_date);
						if($sdate == $edate)
						{
							$date = smgt_getdate_in_input_box($retrieved_data->date);
						}
						else
						{
							$date = smgt_getdate_in_input_box($retrieved_data->date) . " To ". smgt_getdate_in_input_box($retrieved_data->end_date);
						}
					?>
					<tr>
						<td><?php  echo $retrieved_data->holiday_title;?></td>
						<td> <?php print $date ?></td>
					</tr>
					<?php } ?>
					</table>
					</div>
				</div>
			</div>
		</div>	
		<!---End new dashboard------>
		
  <?php		
	if($school_obj->role == 'teacher')
	{
	?>
	<div class="panel1"> 	
		<div class="row dashboard">
			<div class="col-lg-12 col-md-12">
				<div class="panel panel-white">
					<div class="panel-heading">
                    	<h4 class="panel-title"><?php _e('My Time Table','school-mgt')?></h4>
                    </div>
                     <div class="panel-body">
					<table class="table table-bordered" cellspacing="0" cellpadding="0" border="0">
					<?php 
					$obj_route = new Class_routine();
					$i = 0;
					$i++;
					foreach(sgmt_day_list() as $daykey => $dayname)
					{
					?>
					<tr>
						<th width="100"><?php echo $dayname;?></th>
					<td>
					<?php
						$period = $obj_route->get_periad_by_teacher(get_current_user_id(),$daykey);
						if(!empty($period))
							foreach($period as $period_data)
							{
								echo '<button class="btn btn-primary"><span class="period_box" id='.$period_data->route_id.'>'.get_single_subject_name($period_data->subject_id);
								echo '<span class="time"> ('.$period_data->start_time.'- '.$period_data->end_time.') </span>';
								echo '<span>'.get_class_name($period_data->class_id).'</span>';
								echo '</span></button>';								
							}
					?>
					</td>
				</tr>
		<?php	
		}
		?>
    </table>
   </div>
</div>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
</div>
</body>
</html>