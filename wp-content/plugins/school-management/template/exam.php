<?php 
//exam
require_once SMS_PLUGIN_DIR. '/school-management-class.php';
$tablename="exam";
$access=page_access_rolewise_and_accessright();
if($access)
{
?>
<script>
$(document).ready(function() {
    $('#examt_list').DataTable({
        responsive: true
    });
} );
</script>
<!-- Nav tabs -->
<div class="panel-body panel-white">
 <ul class="nav nav-tabs panel_tabs" role="tablist">
      <li class="active">
          <a href="#examlist" role="tab" data-toggle="tab">
            <i class="fa fa-align-justify"></i> <?php _e('Exam List', 'school-mgt'); ?></a>
          </a>
      </li>
</ul>

    
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade active in" id="examlist">         
        <?php 
		 	$retrieve_class = get_all_data($tablename);			
		?>
		<div class="panel-body">
        <div class="table-responsive">
        <table id="examt_list" class="display dataTable exam_datatable" cellspacing="0" width="100%">
        	 <thead>
            <tr>                
                <th><?php _e('Exam Title','school-mgt');?></th>
                <th><?php _e('Exam Date','school-mgt');?></th>
                <th><?php _e('Exam Comment','school-mgt');?></th>               
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th><?php _e('Exam Title','school-mgt');?></th>
                <th><?php _e('Exam Date','school-mgt');?></th>
                <th><?php _e('Exam Comment','school-mgt');?></th>
                
            </tr>
        </tfoot>
 
        <tbody>
          <?php 
		 	foreach ($retrieve_class as $retrieved_data){ 			
		 ?>
            <tr>
                <td><?php echo $retrieved_data->exam_name;?></td>
                <td><?php echo smgt_getdate_in_input_box( $retrieved_data->exam_date);?></td>
                <td class=""><?php echo $retrieved_data->exam_comment;?></td>   
                
            </tr>
            <?php } ?>
     
        </tbody>
        
        </table>
        </div>
		  </div>
      </div>
      <div class="tab-pane fade" id="examresult">
          <h2><?php _e('Exam Result','school-mgt');?></h2>
          
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