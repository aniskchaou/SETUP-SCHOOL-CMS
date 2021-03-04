<script>
$(document).ready(function() {
    $('#holiday_list').DataTable({
        responsive: true
    });
} );
</script>

<?php $retrieve_class = get_all_data ( 'holiday' );
$access=page_access_rolewise_and_accessright();
if($access)
{
 ?>
<div class="panel-body panel-white">
	<ul class="nav nav-tabs panel_tabs" role="tablist">
		<li class="active"><a href="#payment" role="tab" data-toggle="tab"> <i class="fa fa-align-justify"></i>
			<?php _e('Holiday', 'school-mgt'); ?></a>
		</li>
	</ul>
	<div class="tab-content">
		<div class="panel-body">
		<div class="table-responsive">
			<table id="holiday_list" class="display dataTable" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php _e('Holiday Title','school-mgt');?></th>
						<th><?php _e('Description','school-mgt');?></th>
						<th><?php _e('Start Date','school-mgt');?></th>
						<th><?php _e('End Date','school-mgt');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php _e('Holiday Title','school-mgt');?></th>
						<th><?php _e('Description','school-mgt');?></th>
						<th><?php _e('Start Date','school-mgt');?></th>
						<th><?php _e('End Date','school-mgt');?></th>
					</tr>
				</tfoot>

		<tbody>
          <?php
			foreach ( $retrieve_class as $retrieved_data ) 
			{
			?>
            <tr>
				<td><?php echo $retrieved_data->holiday_title;?></td>
				<td><?php echo $retrieved_data->description;?></td>
				<td><?php echo smgt_getdate_in_input_box($retrieved_data->date);?></td>
				<td><?php echo smgt_getdate_in_input_box($retrieved_data->end_date);?></td>
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