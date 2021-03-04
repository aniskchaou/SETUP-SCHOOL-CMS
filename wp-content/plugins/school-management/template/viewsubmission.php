<div class="panel-body">
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
               <!-- <th style="width: 20px;"><input name="select_all" value="all" id="checkbox-select-all" 
				type="checkbox" /></th>-->
                <th><?php _e('Homework Title','school-mgt');?></th>
                <th><?php _e('Class','school-mgt');?></th>
                <th><?php _e('Student','school-mgt');?></th>
				<th><?php _e('Subject','school-mgt');?></th>
				<th><?php _e('Status','school-mgt');?></th>
				<th><?php _e('Submitted Date','school-mgt');?></th>
				<th><?php _e('Date','school-mgt');?></th>
                <td><?php _e('Action','school-mgt');?></td>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
				<th><?php _e('Homework Title','school-mgt');?></th>
                <th><?php _e('Class','school-mgt');?></th>
                <th><?php _e('Student','school-mgt');?></th>
				<th><?php _e('Subject','school-mgt');?></th>
				<th><?php _e('Status','school-mgt');?></th>
				<th><?php _e('Submitted Date','school-mgt');?></th>
				<th><?php _e('Date','school-mgt');?></th>
                <td><?php _e('Action','school-mgt');?></td>
            </tr>
        </tfoot>
 
        <tbody>
          <?php 
		  
		 	foreach ($retrieve_class as $retrieved_data)
			{  ?>
            <tr>
				<!-- <td><input type="checkbox" class="select-checkbox" name="id[]" 
				value="<?php echo $retrieved_data->homework_id;?>"></td>-->
                <td><?php echo $retrieved_data->title;?></td>
				<td><?php echo get_class_name($retrieved_data->class_name);?></td>
				<td><?php echo get_user_name_byid($retrieved_data->student_id);?></td>
                <td><?php echo get_single_subject_name($retrieved_data->subject);?></td>
				<?php  if($retrieved_data->status==1)
				if($retrieved_data->uploaded_date < $retrieved_data->submition_date)
				{
			     ?>
				 <td style="color:green"><?php echo $stat='Submitted'; ?></td>
				 <?php
				 }
				 else
				 {
				 ?><td style="color:green"><?php echo $stat='Late-Submitted'; ?></td><?php
				 }
			  else {?>
			  <td style="color:red"><?php echo  $stat='Pending'; ?></td>
			  <?php
			     
			  }?>
			      <?php  if($retrieved_data->uploaded_date==0000-00-00)
				{
			     ?>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "NA ";?></td>
				<?php } else {?>
				<td><?php echo $retrieved_data->uploaded_date;?></td><?php }?>
                <td><?php echo $retrieved_data->create_date;?></td>
               <?php if($retrieved_data->status==1){ ?><td><a href="?dashboard=user&page=homework&tab=view_stud_detail&action=download&stud_homework_id=<?php echo $retrieved_data->stu_homework_id;?>" class="btn btn-info"> <?php _e('Download','school-mgt');?></a>
             <!--  <a href="?page=smgt_student_homewrok&tab=homeworklist&action=delete&homework_id=<?php echo $retrieved_data->homework_id;?>" class="btn btn-danger" onclick="return confirm('<?php _e('Are you sure you want to delete this record?','school-mgt');?>');"> <?php _e('Delete','school-mgt');?></a>
				<a class="btn btn-default" href="#" id="addremove" value="<?php echo $retrieved_data->homework_id;?>" model="class_sec"><?php _e('View Or Add Section','school-mgt');?></a>
				-->
				</td>
				
				<?php } else { ?><td><a href="<?php echo SMS_PLUGIN_URL;?>/uploadfile/<?php echo $retrieved_data->file;?>" class="btn btn-info" disabled> <?php _e('Download','school-mgt');?></a></th><?php }?>
			   
		  </tr>
            <?php } ?>
     
        </tbody>
        
        </table>
		 <!--<div class="print-button pull-left">
			<input id="delete_selected" type="submit" value="<?php _e('Delete Selected','school-mgt');?>" name="delete_selected" class="btn btn-danger delete_selected"/>
			
		</div>-->
		</form>
        </div>
        </div>
       </div>