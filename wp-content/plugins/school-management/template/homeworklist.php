 <?php 
		 	$obj=new Smgt_Homework();
			$retrieve_class=$obj->get_all_homeworklist();
			
		?><div class="panel-body">
		<script>
jQuery(document).ready(function() {
	var table =  jQuery('#class_list').DataTable({
        responsive: true,
		"order": [[ 1, "asc" ]],
		"aoColumns":[	                  
	                  {"bSortable": false},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": true},
	                  {"bSortable": false}],
		language:<?php echo smgt_datatable_multi_language();?>
    });
	 jQuery('#checkbox-select-all').on('click', function(){
     
      var rows = table.rows({ 'search': 'applied' }).nodes();
      jQuery('input[type="checkbox"]', rows).prop('checked', this.checked);
   }); 
   
	jQuery('#delete_selected').on('click', function(){
		 var c = confirm('Are you sure to delete?');
		if(c){
			jQuery('#frm-example').submit();
		}
		
	});
   
});

</script>	
        <div class="table-responsive">
		<form id="frm-example" name="frm-example" method="post">
        <table id="class_list" class="display" cellspacing="0" width="100%">
        	 <thead>
            <tr>
                <th style="width: 20px;"><input name="select_all" value="all" id="checkbox-select-all" 
				type="checkbox" /></th>
                <th><?php _e('Homework Title','school-mgt');?></th>
				<th><?php _e('Class','school-mgt');?></th>
				<th><?php _e('Subject','school-mgt');?></th>
                <th><?php _e('Created Date','school-mgt');?></th>
                <th><?php _e('Submission Date','school-mgt');?></th>
                <td><?php _e('Action','school-mgt');?></td>
            </tr>
        </thead>
        <tfoot>
            <tr>
				<th></th>
               <th><?php _e('Homework Title','school-mgt');?></th>
				<th><?php _e('Class','school-mgt');?></th>
				<th><?php _e('Subject','school-mgt');?></th>
                <th><?php _e('Created Date','school-mgt');?></th>
                <th><?php _e('Submission Date','school-mgt');?></th>
                <td><?php _e('Action','school-mgt');?></td>
            </tr>
        </tfoot>
 
        <tbody>
          <?php 
		  
		 	foreach ($retrieve_class as $retrieved_data){ 
			
		 ?>
            <tr>
				 <td><input type="checkbox" class="select-checkbox" name="id[]" 
				value="<?php echo $retrieved_data->homework_id;?>"></td>
                <td><?php echo $retrieved_data->title;?></td>
				<td><?php echo get_class_name($retrieved_data->class_name);?></td>
				<td><?php echo get_subject_byid($retrieved_data->subject);?></td>
                <td><?php echo $retrieved_data->create_date;?></td>
                <td><?php echo $retrieved_data->submition_date;?></td>
               <td><a href="?page=smgt_student_homewrok&tab=addhomework&action=edit&homework_id=<?php echo $retrieved_data->homework_id;?>" class="btn btn-info"> <?php _e('Edit','school-mgt');?></a>
               <a href="?page=smgt_student_homewrok&tab=homeworklist&action=delete&homework_id=<?php echo $retrieved_data->homework_id;?>" class="btn btn-danger" onclick="return confirm('<?php _e('Are you sure you want to delete this record?','school-mgt');?>');"> <?php _e('Delete','school-mgt');?></a>
			   <a href="?page=smgt_student_homewrok&tab=view_stud_detail&action=viewsubmission&homework_id=<?php echo $retrieved_data->homework_id;?>" class="btn btn-default"> <?php echo '<span class="fa fa-eye"></span>'._e('View Submission','school-mgt');?></a>
			      
				 <!--<a class="btn btn-default" href="?page=smgt_student_homewrok&tab=view_stud_detail&homework_id=<?php echo $retrieved_data->homework_id;?>" id="addremove" value="<?php echo $retrieved_data->homework_id;?>"><?php _e('View Submission','school-mgt');?></a> 
				-->
				</td>
		  </tr>
            <?php } ?>
     
        </tbody>
        
        </table>
		 <div class="print-button pull-left">
			<input id="delete_selected" type="submit" value="<?php _e('Delete Selected','school-mgt');?>" name="delete_selected" class="btn btn-danger delete_selected"/>
			
		</div>
		</form>
        </div>
        </div>
       </div>