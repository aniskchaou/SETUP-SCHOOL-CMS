<?php 
	// This is Dashboard at admin side!!!!!!!!! 
	$obj_attend=new Attendence_Manage();
	$all_notice = "";
	$args['post_type'] = 'notice';
	$args['posts_per_page'] = -1;
	$args['post_status'] = 'public';
	$q = new WP_Query();
	$all_notice = $q->query( $args );
	$notive_array = array ();
	if (! empty ( $all_notice )) {
		foreach ( $all_notice as $notice ) {
			 $notice_start_date=get_post_meta($notice->ID,'start_date',true);
			 $notice_end_date=get_post_meta($notice->ID,'end_date',true);
			$i=1;
			
			$notive_array [] = array (
				'title' => $notice->post_title,
				'start' => mysql2date('Y-m-d', $notice_start_date ),
				'end' => date('Y-m-d',strtotime($notice_end_date.' +'.$i.' days')),
				'color'=>'#22BAA0'
			);				
		}
	}
	$holiday_list = get_all_data ( 'holiday' );	
	if (! empty ( $holiday_list )) {
		foreach ( $holiday_list as $holiday ) {
			$notice_start_date=$holiday->date;
			$notice_end_date=$holiday->end_date;
			//echo $notice->post_title;
			$i=1;
				
			$notive_array [] = array (
				'title' => $holiday->holiday_title,
				'start' => mysql2date('Y-m-d', $notice_start_date ),
				'end' => date('Y-m-d',strtotime($notice_end_date.' +'.$i.' days')),
				'color' => '#5BC0DE'
			);
		}
	}
	/* print "<pre>";
	print_r($notive_array);
	print "</pre>";
	die; */
	?>
<script>
	$(document).ready(function()
	{
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


<div class="popup-bg">
    <div class="overlay-content">   
    	<div class="notice_content"></div>    
    </div>     
</div>
<div class="page-inner">
	<div class="page-title">
		<h3><img src="<?php echo get_option( 'smgt_school_logo' ) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo get_option( 'smgt_school_name' );?>
		</h3>
	</div>
<div id="main-wrapper">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
			<a href="<?php print admin_url().'admin.php?page=smgt_student'; ?>">
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
		
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="<?php print admin_url().'admin.php?page=smgt_teacher'; ?>">
					<div class="panel info-box panel-white">
						<div class="panel-body teacher">
							<div class="info-box-stats">
								<?php
								$user_query = new WP_User_Query( array( 'role' => 'teacher' ) );
								$teacher_count = (int) $user_query->get_total();
								?>
								<p class="counter"><?php echo $teacher_count;?></p>
								<span class="info-box-title"><?php echo esc_html( __( 'Teacher', 'school-mgt' ) );?></span>
							</div>						
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="<?php print admin_url().'admin.php?page=smgt_parent'; ?>">
					<div class="panel info-box panel-white">
						<div class="panel-body parent">
							<div class="info-box-stats">
							   <?php
								$user_query = new WP_User_Query( array( 'role' => 'parent' ) );
								$parent_count = (int) $user_query->get_total();
								?>
								<p class="counter"><?php echo $parent_count;?></p>
								<span class="info-box-title"><?php echo esc_html( __( 'Parent', 'school-mgt' ) );?></span>
							</div>						
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
				<a href="<?php print admin_url().'admin.php?page=smgt_attendence'; ?>">
					<div class="panel info-box panel-white">
						<div class="panel-body attendence">
							<div class="info-box-stats">
								<p class="counter"><?php echo $obj_attend->today_presents();?></p>
								<span class="info-box-title"><?php echo esc_html( __( 'Today Attendance', 'school-mgt' ) );?></span>
							</div>                       
						</div>
					</div>
				</a>
			</div>
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
						<h3 class="panel-title"><i class="fa fa-bell" aria-hidden="true"></i> <?php _e('Noticeboard','school-mgt');?></h3>						
					</div>					
					<div class="panel-body">
					<table class="table">
						<tr>
							<th><?php _e('Notice Title','school-mgt')?></th>
							<th><?php _e('Notice Date','school-mgt')?></th>
						</tr>					
					<?php
					  $args['post_type'] = 'notice';
					  $args['posts_per_page'] = 3;
					  $args['post_status'] = 'public';
					  $q = new WP_Query();
					$retrieve_class = $q->query( $args );
					foreach ($retrieve_class as $retrieved_data){
						
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
					
					<!--<div class="events">
					<div class="calendar-event"> 
					<p>
					<a id="<?php print $retrieved_data->ID ?>" class="view-notice" href="#" style="color:black; text-decoration:none;"><?php  echo $retrieved_data->post_title;?></a>
					</p>
					</div>
					</div>-->
					<?php }?>
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
					foreach ($retrieve_class as $retrieved_data){
						//var_dump($retrieved_data);
						$sdate = strtotime($retrieved_data->date);
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
					<!--<div class="events">
					<div class="calendar-event"> 
					<p>
					<?php  echo $retrieved_data->holiday_title;?>
					</p>
					</div>
					</div>-->
					<?php } ?>
					</table>
					</div>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-white">
					<div class="panel-heading">
						<h3 class="panel-title"><?php _e('Report','school-mgt');?></h3>
					</div>
					<div class="panel-body">
					<div class="col-md-6">					
					<div class="panel-body">
					<?php 
					global $wpdb;
					$table_attendance = $wpdb->prefix .'attendence';
					$table_class = $wpdb->prefix .'smgt_class';
					require_once SMS_PLUGIN_DIR. '/lib/chart/GoogleCharts.class.php';
					$report_1 =$wpdb->get_results("SELECT  at.class_id,
							SUM(case when `status` ='Present' then 1 else 0 end) as Present,
							SUM(case when `status` ='Absent' then 1 else 0 end) as Absent
							from $table_attendance as at,$table_class as cl where at.attendence_date >  DATE_SUB(NOW(), INTERVAL 1 WEEK) AND at.class_id = cl.class_id AND at.role_name = 'student' GROUP BY at.class_id") ;
					$chart_array = array();
					$chart_array[] = array(__('Class','school-mgt'),__('Present','school-mgt'),__('Absent','school-mgt'));
					if(!empty($report_1))
						foreach($report_1 as $result)
						{
					
							$class_id =get_class_name($result->class_id);
							$chart_array[] = array("$class_id",(int)$result->Present,(int)$result->Absent);
						}
					
					$options = Array(
							'title' => __('Last Week Attendance Report','school-mgt'),
							'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
							'legend' =>Array('position' => 'right',
									'textStyle'=> Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans')),
					
							'hAxis' => Array(
									'title' =>  __('Class','school-mgt'),
									'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
									'textStyle' => Array('color' => '#222','fontSize' => 10),
									'maxAlternation' => 2
					
					
							),
							'vAxis' => Array(
									'title' =>  __('No of Student','school-mgt'),
									'minValue' => 0,
									'maxValue' => 5,
									'format' => '#',
									'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
									'textStyle' => Array('color' => '#222','fontSize' => 12)
							),
							'colors' => array('#22BAA0','#f25656')
							
					);
					
					$GoogleCharts = new GoogleCharts;
					if(!empty($report_1))					
					{	
						$chart = $GoogleCharts->load( 'column' , 'chart_div' )->get( $chart_array , $options );
					}
					else
						_e("There is not enough data to generate report",'school-mgt');
					 
					
					?>
					 <div id="chart_div" style="width: 100%; height: 500px;"></div>
  
					<!-- Javascript --> 
					<script type="text/javascript" src="https://www.google.com/jsapi"></script> 
					<script type="text/javascript">
						<?php 
						if(isset($chart))
						echo $chart;?>
					</script>
					</div>
					</div>
					<div class="col-md-6">
					<div class="panel-body">
					<?php 
					global $wpdb;
					
					$table_attendance = $wpdb->prefix .'attendence';
					$table_class = $wpdb->prefix .'smgt_class';
					$report_2 =$wpdb->get_results("SELECT  at.class_id,
							SUM(case when `status` ='Present' then 1 else 0 end) as Present,
							SUM(case when `status` ='Absent' then 1 else 0 end) as Absent
							from $table_attendance as at,$table_class as cl where at.attendence_date >  DATE_SUB(NOW(), INTERVAL 1 MONTH) AND at.class_id = cl.class_id AND at.role_name = 'student' GROUP BY at.class_id") ;
					$chart_array = array();
					$chart_array[] = array('Class','Present','Absent');
					if(!empty($report_2))
						foreach($report_2 as $result)
						{
					
							$class_id =get_class_name($result->class_id);
							$chart_array[] = array("$class_id",(int)$result->Present,(int)$result->Absent);
						}
					
					//var_dump($chart_array);
					
					
					$options = Array(
							'title' => __('Last Month Attendance Report','school-mgt'),
							'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
							'legend' =>Array('position' => 'right',
									'textStyle'=> Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans')),
					
							'hAxis' => Array(
									'title' =>  __('Class','school-mgt'),
									'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
									'textStyle' => Array('color' => '#222','fontSize' => 10),
									'maxAlternation' => 2
					
					
							),
							'vAxis' => Array(
									'title' =>  __('No of Student','school-mgt'),
									'minValue' => 0,
									'maxValue' => 5,
									'format' => '#',
									'titleTextStyle' => Array('color' => '#222','fontSize' => 14,'bold'=>true,'italic'=>false,'fontName' =>'open sans'),
									'textStyle' => Array('color' => '#222','fontSize' => 12)
							),
							'colors' => array('#22BAA0','#f25656')
					);
					
					$GoogleCharts = new GoogleCharts;
					if(!empty($report_2))					
					{	
						$chart = $GoogleCharts->load( 'column' , 'chart_div1' )->get( $chart_array , $options );
					}
					else
						_e("There is not enough data to generate report",'school-mgt');
					 
					
					?>
					 <div id="chart_div1" style="width: 100%; height: 500px;"></div>
  
					  <!-- Javascript --> 
					  <script type="text/javascript" src="https://www.google.com/jsapi"></script> 
					  <script type="text/javascript"><?php 	if(isset($chart))	echo $chart;?></script>
					</div>
					</div>
					</div>
					</div>
				</div>
			</div>
		</div>		
	</div>