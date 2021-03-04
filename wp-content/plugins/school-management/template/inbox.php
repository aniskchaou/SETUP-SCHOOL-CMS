<?php 
//Subject
//var_dump($school_obj->subject);

?>
<div class="mailbox-content">
<div class="table-responsive">
 	<table class="table">
 		<thead>
 			<tr>
 				<!--  <th class="hidden-xs" colspan="1">
                	<span>
                		<div class="checker">
                			<span><input type="checkbox" class="check-mail-all"></span>
                		</div>
                	</span>
                </th> -->
                <th class="text-right" colspan="5">
               <?php $message = smgt_count_inbox_item(get_current_user_id());
              // var_dump($message);
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
 		$totlal_message =count($message);
 		$totlal_message = ceil($totlal_message / $max);
 		$lpm1 = $totlal_message - 1;
 		$offest_value = ($p-1) * $max;
 		echo smgt_inbox_pagination($totlal_message,$p,$lpm1,$prev,$next);?>
                </th>
 			</tr>
 		</thead>
 		<tbody>
 		<tr>
 			<!-- <td class="hidden-xs">
            	<span>&nbsp;</span>
            </td> -->
 			<th class="hidden-xs">
            	<span><?php _e('Message For','school-mgt');?></span>
            </th>
            <th><?php _e('Subject','school-mgt');?></th>
             <th>
                  <?php _e('Description','school-mgt');?>
            </th>
			<th>
                  <?php _e('Date','school-mgt');?>
            </th>
            </tr>
 		<?php 
 		$message = get_inbox_message(get_current_user_id(),$limit,$max);
 		
 		foreach($message as $msg)
 		{
			
 			$message_for=get_post_meta($msg->post_id,'message_for',true);
			if($message_for=='student' || $message_for=='supportstaff' || $message_for=='teacher' || $message_for=='parent'){ 
				$post_id='';
				if($post_id==$msg->post_id)
				{
					continue;
				}
				else{ 
				
				?>
					<tr>	
 			<td><?php echo get_display_name($msg->sender);?></td>
             <td>
                 <a href="?dashboard=user&page=message&tab=view_message&from=inbox&id=<?php echo $msg->message_id;?>"> <?php echo $msg->subject;?><?php if(smgt_count_reply_item($msg->post_id)>=1){ ?><span class="badge badge-success pull-right"><?php echo smgt_count_reply_item($msg->post_id);?></span><?php } ?></a>
            </td>
            <td><?php echo $msg->message_body;?>
            </td>
            <td>	
                <?php  echo  mysql2date('d M', $msg->date );?>
            </td>
            </tr>
						
				
				<?php }
			
			}
			else{ ?>
 			<tr>	
 			<td><?php echo get_display_name($msg->sender);?></td>
             <td>
                 <a href="?dashboard=user&page=message&tab=view_message&from=inbox&id=<?php echo $msg->message_id;?>"> <?php echo $msg->subject;?><?php if(smgt_count_reply_item($msg->post_id)>=1){ ?><span class="badge badge-success pull-right"><?php echo smgt_count_reply_item($msg->post_id);?></span><?php } ?></a>
            </td>
            <td><?php echo $msg->message_body;?>
            </td>
            <td>	
                <?php  echo mysql2date('d M', $msg->date );?>
            </td>
            </tr>
 			<?php 
			}
			$post_id=$msg->post_id;
 		}
			?>
 			<!-- Comment from here <tr>
 			<!-- <td class="hidden-xs">
            	<span><div class="checker"><span class=""><input type="checkbox" class="checkbox-mail"></span></div></span>
            </td>
            -->
            <!--<td><?php echo get_display_name($msg->sender);//echo get_user_name_byid($msg->sender);?></td>
             <td>
               <a href="?dashboard=user&page=message&tab=view_message&from=inbox&id=<?php echo $msg->message_id;?>"> <?php echo $msg->subject;?><?php if(smgt_count_reply_item($msg->post_id)>=1){?><span class="badge badge-success pull-right"><?php echo smgt_count_reply_item($msg->post_id);?></span><?php } ?></a>
            </td>
            <td><?php echo $msg->message_body;?>
            </td>
            <td>
                <?php  echo  mysql2date('d M', $msg->date );?>
            </td>
            </tr>-->
 			<?php 
 		//}
 		?>
 		
 		</tbody>
 	</table>
 	</div>
 </div>
 <?php ?>