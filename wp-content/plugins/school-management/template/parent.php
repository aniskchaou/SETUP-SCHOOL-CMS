<?php 
//$obj_mark = new Marks_Manage();
$access=page_access_rolewise_and_accessright();
if($access)
{
$active_tab = isset($_GET['tab'])?$_GET['tab']:'parentlist';

?>
<script>
$(document).ready(function() {
    $('#parent_list').DataTable({
        responsive: true
    });
} );
</script>


<div class="panel-body panel-white">
 <ul class="nav nav-tabs panel_tabs" role="tablist">
      <li class="<?php if($active_tab=='parentlist'){?>active<?php }?>">
          <a href="?dashboard=user&page=parent&tab=parentlist">
             <i class="fa fa-align-justify"></i> <?php _e('Parent List', 'school-mgt'); ?></a>
          </a>
      </li>
    
</ul>

<div class="tab-content">
     <?php if($active_tab == 'parentlist')		
           { ?>
        	<div class="panel-body">
<form name="wcwm_report" action="" method="post">
	 <div class="table-responsive">
        <table id="parent_list" class="display dataTable" cellspacing="0" width="100%">
        	 <thead>
            <tr>
				<th width="75px"><?php echo _e('Photo', 'school-mgt' ) ;?></th>
                <th><?php echo _e( 'Parent Name', 'school-mgt' ) ;?></th>
                <th> <?php echo _e( 'Parent Email', 'school-mgt' ) ;?></th>
				
            </tr>
        </thead>
 
        <tfoot>
            <tr>
               <th width="75px"><?php echo _e('Photo', 'school-mgt' ) ;?></th>
                <th><?php echo _e( 'Parent Name', 'school-mgt' ) ;?></th>
                <th> <?php echo _e( 'Parent Email', 'school-mgt' ) ;?></th>
			 </tr>
        </tfoot>
 
        <tbody>
         <?php 
			$parentdata=get_usersdata('parent');
			if($parentdata)
			{
				foreach ($parentdata as $retrieved_data){ ?>	
				<tr>
					<td class="user_image "><?php $uid=$retrieved_data->ID;
								$umetadata=get_user_image($uid);
								if(empty($umetadata['meta_value']))
									{
										echo '<img src='.get_option( 'smgt_parent_thumb' ).' height="50px" width="50px" class="img-circle" />';
									}
								else
								echo '<img src='.$umetadata['meta_value'].' height="50px" width="50px" class="img-circle"/>';
					?></td>
					<td class="name"><a href="#"><?php echo $retrieved_data->display_name;?></a></td>
					<td class="email"><?php echo $retrieved_data->user_email;?></td>
                
             
               
            </tr>
				<?php  }
			}
			
			?>
     
        </tbody>
        
        </table>
       </div>
		
</form>
</div>
	 <?php }?>
</div>
</div>
<?php
}
else
{
	wp_redirect ( admin_url () . 'index.php' );
} ?>