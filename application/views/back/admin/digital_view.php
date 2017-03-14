<!--CONTENT CONTAINER-->
<?php 
		foreach($product_data as $row)
        { 
?>

<h4 class="modal-title text-center padd-all"><?php echo translate('details_of');?> <?php echo $row['title'];?></h4>
	<hr style="margin: 10px 0 !important;">
    <div class="row">
    <div class="col-md-12">
        <div class="text-center pad-all">
            <div class="col-md-3">
                <div class="col-md-12">
                    <img class="img-responsive thumbnail" alt="Profile Picture" 
                        src="<?php echo $this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one'); ?>">
                </div>
                <div class="col-md-12" style="text-align:justify;">
                    <p><?php echo $row['description'];?></p>
                </div>
            </div>
            <div class="col-md-9">   
                <table class="table table-striped" style="border-radius:3px;">
                    <tr>
                        <th class="custom_td"><?php echo translate('name');?></th>
                        <td class="custom_td"><?php echo $row['title']?></td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('category');?></th>
                        <td class="custom_td">
                            <?php echo $this->crud_model->get_type_name_by_id('category',$row['category'],'category_name');?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('sub-category');?></th>
                        <td class="custom_td">
                            <?php echo $this->crud_model->get_type_name_by_id('sub_category',$row['sub_category'],'sub_category_name');?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('sale_price');?></th>
                        <td class="custom_td"><?php echo $row['sale_price']; ?> <?php echo currency('','def'); ?></td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('purchase_price');?></th>
                        <td class="custom_td"><?php echo $row['purchase_price']; ?> <?php echo currency('','def'); ?></td>
                    </tr>
                    <?php if($row['discount'] != ''){ ?>
                    <tr>
                        <th class="custom_td"><?php echo translate('discount');?></th>
                        <td class="custom_td">
                            <?php echo $row['discount']; ?>
                            <?php if($row['discount_type'] == 'percent'){ echo '%'; } elseif($row['discount_type'] == 'amount'){ echo currency('','def'); } ?>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
                        <th class="custom_td"><?php echo translate('tax');?></th>
                        <td class="custom_td">
                            <?php echo $row['tax']; ?>
                            <?php if($row['tax_type'] == 'percent'){ echo '%'; } elseif($row['tax_type'] == 'amount'){ echo currency('','def'); } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('featured');?></th>
                        <td class="custom_td"><?php echo $row['featured']; ?></td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('tag');?></th>
                        <td class="custom_td">
                            <?php foreach(explode(',',$row['tag']) as $tag){ ?>
                                <?php echo $tag; ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="custom_td"><?php echo translate('status');?></th>
                        <td class="custom_td"><?php echo $row['status']; ?></td>
                    </tr>
                    <?php
                        if($row['video']!=='[]'){
					?>
                    <tr>
                        <th class="custom_td"><?php echo translate('video');?></th>
                        <td class="custom_td">
							<?php 
								$video= json_decode($row['video'],true);
                            	if($video[0]['type'] == 'upload'){
							?>
                                    <video controls width="400" height="300">
                                        <source src="<?php echo base_url();?><?php echo $video[0]['video_src'];?>">
                                    </video>
                            <?php 
								}
								else
								{
							?>
                                    <iframe controls="2" width="400" height="300" src="<?php echo $video[0]['video_src'];?>" frameborder="0" >
                                    </iframe>
                             <?php
								}
                             ?>
                        </td>
                    </tr
                    ><?php
						}
					?>
                    <?php
						$req= json_decode($row['requirements'],true);
                        if(!empty($req)){
					?>
                    <tr>
                        <th class="custom_td"><?php echo translate('requirements');?></th>
                        <td class="custom_td"></td>
                    </tr>
                    	<?php
                            foreach($req as $row1){
                    	?>
                    <tr>
                        <td class="custom_td">
							<b><?php echo $row1['field'];?></b>
                        </td>
                        <td class="custom_td">
							<?php echo $row1['desc']; ?>
                        </td>
                        <?php
                            }
						?>
                    </tr>
                    <?php
                        }
                    ?>
                </table>
            </div>
            <hr>
        </div>
    </div>
</div>				

<?php 
	}
?>
            
<style>
.custom_td{
border-left: 1px solid #ddd;
border-right: 1px solid #ddd;
border-bottom: 1px solid #ddd;
}
</style>

<script>
	$(document).ready(function(e) {
		proceed('to_list');
	});
</script>