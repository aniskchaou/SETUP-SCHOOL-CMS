<?php 
//transport
$access=page_access_rolewise_and_accessright();
if($access)
{
?>
<script>
$(document).ready(function() {
    $('#transport_list').DataTable({
        responsive: true
    });
} );
</script>
<div class="panel-body panel-white">
 <ul class="nav nav-tabs panel_tabs" role="tablist">
      <li class="active">
          <a href="#transport" role="tab" data-toggle="tab">
              <i class="fa fa-align-justify"></i> <?php _e('Transport list', 'school-mgt'); ?></a>
          </a>
      </li>
</ul>
<div class="tab-content">
		
         <?php 
		 	$retrieve_class = get_all_data('transport');
		?>
	<div class="panel-body">
	<div class="table-responsive">
  <table id="transport_list" class="display dataTable transport_datatable" cellspacing="0" width="100%">
        	 <thead>
            <tr>                
                 <th><?php _e('Photo','school-mgt');?></th>
				<th><?php _e('Route Name','school-mgt');?></th>
                <th><?php _e('Number Of Vehicle','school-mgt');?></th>
                <th><?php _e('Vehicle Registration Number','school-mgt');?></th>
               <th><?php _e('Driver Name','school-mgt');?></th>
                <th><?php _e('Driver Phone Number','school-mgt');?></th>              
                 <th><?php _e('Route Fare','school-mgt');?>(<?php echo get_currency_symbol();?>)</th>
            </tr>
        </thead>
		<tfoot>
            <tr>
               <th><?php _e('Photo','school-mgt');?></th>
				<th><?php _e('Route Name','school-mgt');?></th>
                <th><?php _e('Number Of Vehicle','school-mgt');?></th>
                <th><?php _e('Vehicle Registration Number','school-mgt');?></th>
               <th><?php _e('Driver Name','school-mgt');?></th>
                <th><?php _e('Driver Phone Number','school-mgt');?></th>              
                 <th><?php _e('Route Fare','school-mgt');?>(<?php echo get_currency_symbol();?>)</th>
            </tr>
        </tfoot>
 
        <tbody>
          <?php 
		 
		 	foreach ($retrieve_class as $retrieved_data){ 
			
		 ?>
            <tr>
				<td class="user_image"><?php $tid=$retrieved_data->transport_id;
							$umetadata=get_user_driver_image($tid);
						
							if(empty($umetadata) || $umetadata['smgt_user_avatar'] == "")
							{
								echo '<img src="'.get_option( 'smgt_driver_thumb' ).'" height="50px" width="50px" class="img-circle" />';
							}
							else
							echo '<img src='.$umetadata['smgt_user_avatar'].' height="50px" width="50px" class="img-circle" title="No image" />';?>				
				
				
				</td>
                <td><?php echo $retrieved_data->route_name;?></td>
                <td><?php echo $retrieved_data->number_of_vehicle;?></td>
                <td><?php echo $retrieved_data->vehicle_reg_num;?></td>
                
                 <td><?php echo $retrieved_data->driver_name;?></td>
                  <td><?php echo $retrieved_data->driver_phone_num;?></td>
                  
                <td><?php echo $retrieved_data->route_fare;?></td>         
               
            </tr>
            <?php } ?>
     
        </tbody>
        
        </table>
		</div>
		</div>
		</div>
 </div>  
<?php 
}
else
{
	wp_redirect ( admin_url () . 'index.php' );
} 
?>