<?php
class ClassRoutine
{
	public function __construct()
	{
		add_action('template_redirect', array($this,'redirectMethod') , 1);
	}

	public function redirectMethod()
	{
		if ($_REQUEST["smgt-json-api"] == 'class-routin')
		{
			if (isset($_REQUEST["current_user"]))
			{
				$response = $this->classRoutine($_REQUEST["current_user"]);
			}
			else
			{
				$response = $this->classRoutine();
			}

			if (is_array($response))
			{
				echo json_encode($response);
			}
			else
			{
				header("HTTP/1.1 401 Unauthorized");
			}
			die();
		}
	}

	public function classRoutine($userid = 0)
	{
		if ($userid != 0)
		{
			$school_obj = new School_Management($userid);
			$role = smgt_get_roles($userid);
			if ($role == 'teacher')
			{
				$retrieve_class = get_allclass($userid);
			}

			if ($role == 'supportstaff')
			{
				$retrieve_class = get_allclass($userid);
			}

			if ($role == 'student')
			{
				$retrieve_class = get_allclass($userid);
			}

			if ($role == 'admin')
			{
				$retrieve_class = get_allclass();
			}
		}

		$response = array();
		if ($role == 'student')
		{
			$i = 0;
			$obj_route = new Class_routine();
			$class = $school_obj->get_user_class_id($userid);
			$section = get_user_meta($userid, 'class_section', true);
			if (!empty($class))
			{
				if ($section != "")
				{
					$section_name = smgt_get_section_name($section);
				}
				 else
				{
					$section = 0;
					$section_name = "No Section";
				}

				$class_array = array(
					'class' => $class->class_name,
					'section' => $section_name
				);
				
				foreach(sgmt_day_list() as $daykey => $dayname)
				{
					$period = $obj_route->get_periad($class->class_id, $section, $daykey);
					if (!empty($period))
					{	$periods = array();
						$start_at = "";
						$end_at = "";
						foreach($period as $period_data)
						{
							$subject = get_single_subject_name($period_data->subject_id);
							$start_time = $period_data->start_time;
							$start_array = explode(" ", $period_data->start_time);
							if (!empty($start_array)) $start_at = $start_array[1];
							$end_time = $period_data->end_time;
							$end_array = explode(" ", $period_data->end_time);
							if (!empty($end_array)) $end_at = $end_array[1];

							// $periods[$dayname][]=array(

							$periods[] = array(
								'class' => $class->class_name,
								'section' => $section_name,
								'day' => $dayname,
								'subject' => $subject,
								'start_time' => $start_time,
								'start_at' => $start_at,
								'end_time' => $end_time,
								'end_at' => $end_at,
							);
						}
					}
					else
					{
						$periods = array();
					}
						$new_array[$dayname] = $periods;
				}
				$periods_array[] = array_merge($class_array, $new_array);
				$response['status']=1;
				$response['resource'] = $periods_array;
				return $response;
			}		
		}	
			
		elseif ($school_obj->role == 'parent')
		{
			$chil_array = $school_obj->child_list;
			$i = 0;
			$obj_route = new Class_routine();
			if (!empty($chil_array))
			{
				foreach($chil_array as $child_id)
					{
					$class = $school_obj->get_user_class_id($child_id);
					$section = get_user_meta($child_id, 'class_section', true);
					if ($section != "")
					{
						$section_name = smgt_get_section_name($section);
					}
					 else
					{
						$section = 0;
						$section_name = "No Section";
					}

					$class_array = array(
						'class' => $class->class_name,
						'section' => $section_name
					);
					foreach(sgmt_day_list() as $daykey => $dayname)
						{
						$period = $obj_route->get_periad($class->class_id, $section, $daykey);
						if (!empty($period))
							{

							// $periods[$dayname]=array();

							$periods = array();
							$start_at = "";
							$end_at = "";
							foreach($period as $period_data)
								{
								$subject = get_single_subject_name($period_data->subject_id);
								$start_time = $period_data->start_time;
								$start_array = explode(" ", $period_data->start_time);
								if (!empty($start_array)) $start_at = $start_array[1];
								$end_time = $period_data->end_time;
								$end_array = explode(" ", $period_data->end_time);
								if (!empty($end_array)) $end_at = $end_array[1];

								// $periods[$dayname][]=array(

								$periods[] = array(
									'class' => $class->class_name,
									'section' => $section_name,
									'day' => $dayname,
									'subject' => $subject,
									'start_time' => $start_time,
									'start_at' => $start_at,
									'end_time' => $end_time,
									'end_at' => $end_at,
								);
								}
							}
						  else
							{
							$periods = array();
							}

						$new_array[$dayname] = $periods;
						}

					$periods_array[] = array_merge($class_array, $new_array);
					/*$periods_array[]=array(
					'class'=>$class->class_name,
					'section'=>$section_name,
					'periods'=>$periods);*/

					// }
					// }

					}

				$response['resource'] = $periods_array;
				return $response;
			}		
		}
		else
		{
			$i = 0;
			$obj_route = new Class_routine();
			if (!empty($retrieve_class))
				{
				foreach($retrieve_class as $class)
					{
					$classsections = smgt_get_class_sections($class['class_id'], $userid);
					foreach($classsections as $section)
						{
						if (get_option('smgt_students_access') == 'own' && $school_obj->role == 'teacher')
							{
							$section = smgt_get_section($section);
							}

						$class_array = array(
							'class' => $class['class_name'],
							'section' => $section->section_name
						);
						foreach(sgmt_day_list() as $daykey => $dayname)
							{
							$period = $obj_route->get_periad($class['class_id'], $section->id, $daykey);
							if (!empty($period))
								{

								// $periods[$dayname]=array();

								$periods = array();
								$start_at = "";
								$end_at = "";
								foreach($period as $period_data)
									{
									$subject = get_single_subject_name($period_data->subject_id);
									$start_time = $period_data->start_time;
									$start_array = explode(" ", $period_data->start_time);
									if (!empty($start_array)) $start_at = $start_array[1];
									$end_time = $period_data->end_time;
									$end_array = explode(" ", $period_data->end_time);
									if (!empty($end_array)) $end_at = $end_array[1];

									//	$periods[$dayname][]=array(

									$periods[] = array(
										'class' => $class['class_name'],
										'section' => $section->section_name,
										'day' => $dayname,
										'subject' => $subject,
										'start_time' => $start_time,
										'start_at' => $start_at,
										'end_time' => $end_time,
										'end_at' => $end_at,
									);
									}
								}
							  else
								{

								// $periods[$dayname]=array();

								$periods = array();
								}

							$new_array[$dayname] = $periods;
							}

						$periods_array[] = array_merge($class_array, $new_array);
						/*$periods_array[]=array(
						'class'=>$class['class_name'],
						'section'=>$section->section_name,
						'periods'=>$periods);*/
						}
					}

				$response['status'] = 1;
				$response['resource'] = $periods_array;
				return $response;
				}
			  else
				{
				//$error['message'] = ;
				$response['status'] = 0;
				$response['message'] = __("Records Not Found", 'school-mgt');
				}

			return $response;
		}
	}
} 
?>