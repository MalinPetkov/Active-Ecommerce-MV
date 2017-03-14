<div class="panel panel-default" style="margin-bottom:0px">
    <div class="panel-heading">
    	<h3 class="panel-title"><?php echo translate('video'); ?></h3>
    </div>
    <div class="panel-body">
    	<?php 
			$video= json_decode($row['video'],true);
			if($video[0]['type'] == 'upload'){
		?>
				<video controls width="100%" height="330">
					<source src="<?php echo base_url();?><?php echo $video[0]['video_src'];?>">
				</video>
		<?php 
			}
			else
			{
		?>
				<iframe controls="2" width="100%" height="330" src="<?php echo $video[0]['video_src'];?>" frameborder="0" >
				</iframe>
		 <?php
			}
		 ?>
    </div>
</div>