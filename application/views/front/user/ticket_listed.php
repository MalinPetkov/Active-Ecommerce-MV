<?php 
	$i = 0;
	foreach ($query as $row1) {
		$i++;
?>         
	<tr>
		<td class="description">
			<?php echo $row1['subject'];?>
			<?php
				$num = $this->crud_model->ticket_unread_messages($row1['ticket_id'],'user');
				if($num > 0){
			?>
				<span class="btn btn-info btn-xs" style="margin-left:10px">
					<?php 
						echo translate('new_message').' '.'('.' ';
						echo $num .' '.')'; 
					?>
				</span>
			<?php }?>
		</td>
		<td class="add">
			<a class="btn btn-theme btn-theme-xs btn-icon-left message_view" data-id="<?php echo $row1['ticket_id']?>" href="#">
				<i class="fa fa-envelope"></i>
				<?php echo translate('view_message');?>
			</a>
		</td>
	</tr>
										 
<?php 
	}
?>


<tr class="text-center" style="display:none;" >
	<td id="pagenation_set_links" ><?php echo $this->ajax_pagination->create_links(); ?></td>
</tr>
<!--/end pagination-->


<script>
	$(document).ready(function(){ 
		product_listing_defaults();
		$('.pagination_box').html($('#pagenation_set_links').html());
	});
</script>