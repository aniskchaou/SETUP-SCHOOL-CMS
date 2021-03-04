<?php 
	// This is Class at admin side!!!!!!!!! 
	
	?> 
	<div class="mailbox-content">
 	<table class="table">
 		<thead>
 			<tr>
 				<th class="text-right" colspan="5">
               	<?php 
               	$max = 10;
               	if(isset($_GET['pg'])){
               		$p = $_GET['pg'];
               	}else{
               		$p = 1;
               	}
               
               	$limit = ($p - 1) * $max;
               $prev = $p - 1;
               	$next = $p + 1;
               	$limits = (int)($p - 1) * $max;
               	$totlal_message = smgt_count_send_item(get_current_user_id());
               	$totlal_message = ceil($totlal_message / $max);
               	$lpm1 = $totlal_message - 1;               	
               	$offest_value = ($p-1) * $max;
               	echo smgt_pagination($totlal_message,$p,$lpm1,$prev,$next);
               	
               	?>
                </th>
 			</tr>
 		</thead>
 		<tbody>
 		<tr>
 			
 			<th class="hidden-xs">
            	<span><?php _e('Message For','school-mgt');?></span>
            </th>
            <th class="hidden-xs">
            	<span><?php _e('Class','school-mgt');?></span>
            </th>
            <th><?php _e('Subject','school-mgt');?></th>
             <th>
                  <?php _e('Description','school-mgt');?>
            </th>
            </tr>
 		<?php 
 		$offset = 0;
 		if(isset($_REQUEST['pg']))
 			$offset = $_REQUEST['pg'];
 		
 		$message = get_send_message(get_current_user_id(),$max,$offset);
 		
 		foreach($message as $msg_post)
 		{
 			if($msg_post->post_author==get_current_user_id())
 			{
 			?>
 			<tr>
 			<td>
            	<span><?php 
            	if(get_post_meta( $msg_post->ID, 'message_for',true) == 'user')
            	{
            		echo get_display_name(get_post_meta( $msg_post->ID, 'message_smgt_user_id',true));
            	}
            	else
            	echo get_post_meta( $msg_post->ID, 'message_for',true);?></span>
            </td>
            <td>
            	<span><?php 
			
            	if(get_post_meta( $msg_post->ID, 'smgt_class_id',true) !="" && get_post_meta( $msg_post->ID, 'smgt_class_id',true) == 'all')
				{
					
					_e('All','school-mgt');
				}
				elseif(get_post_meta( $msg_post->ID, 'smgt_class_id',true) !="")
				{
					echo get_class_name(get_post_meta( $msg_post->ID, 'smgt_class_id',true)); 
				}else{
					echo "NA";
				}?></span>
            </td>
            <td>
			
			<a href="?page=smgt_message&tab=view_message&from=sendbox&id=<?php echo $msg_post->ID;?>"><?php echo $msg_post->post_title;?><?php if(smgt_count_reply_item($msg_post->ID)>=1){?><span class="badge badge-success pull-right"><?php echo smgt_count_reply_item($msg_post->ID);?></span><?php } ?></a>
			</td>
             <td>
                  <?php echo $msg_post->post_content;?>
            </td>
            </tr>
 			<?php 
 			}
 		}
 		?>
 		
 		</tbody>
 	</table>
 </div>
 <?php ?>