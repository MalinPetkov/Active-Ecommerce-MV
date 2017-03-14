<?php
	$categories=json_decode($this->crud_model->get_settings_value('ui_settings','home_categories'),true);
	if(count($categories)!==0){
		foreach($categories as $row){
			if($this->crud_model->if_publishable_category($row['category'])){
?>
<!-- PAGE -->
<section class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tabs-wrapper content-tabs home1_category_box">
                    <ul class="nav nav-tabs">
                        <li class="category_title" style="background:<?php echo $row['color_back'];?>;border:1px solid <?php echo $row['color_back'];?>;">
                            <a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $row['category']; ?>" style="color:<?php echo $row['color_text'];?>">
                                <?php echo $this->crud_model->get_type_name_by_id('category',$row['category'],'category_name'); ?>
                            </a>
                        </li>
                        <?php
						if(!empty($row['sub_category'])){
							$i=0;
                        	$sub_categories=$row['sub_category'];
							foreach($sub_categories as $row1){
						?>
                        <li class="<?php if($i==0){ echo 'active';}?>">
                            <a href="#tab<?php echo $row1; ?>" data-toggle="tab">
                                <?php echo $this->crud_model->get_type_name_by_id('sub_category',$row1,'sub_category_name'); ?>
                            </a>
                        </li>
                        <?php
                        	$i++;
							}
						}
						?>
                        <a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $row['category']; ?>" class="see_more hidden-xs hidden-sm" style="background:<?php echo $row['color_back'];?>; border:1px solid <?php echo $row['color_back'];?>; color:<?php echo $row['color_text'];?>;">
                        	<i class="fa fa-link"></i>
                        </a>
                    </ul>
                    <div class="tab-content">
                    	<?php
						if(!empty($row['sub_category'])){
							$j=0;
							foreach($sub_categories as $row2){
						?>
                        <div class="tab-pane fade <?php if($j==0){ echo 'in active';}?>" id="tab<?php echo $row2; ?>">
                            <div class="row" style="margin-top:-15px;">
                            	<?php
									$box_style =  $this->db->get_where('ui_settings',array('ui_settings_id' => 34))->row()->value;
									$products= $this->crud_model->product_list_set('sub_category',4,$row2);
									foreach($products as $row3){
								?>
                                <div class="col-md-3 col-sm-6 col-xs-6 padding-lr-10-md" style="margin-top:15px;">
                                	<?php echo $this->html_model->product_box($row3,'grid', $box_style); ?>
                                </div>
                                <?php
									}
								?>
                            </div>
                        </div>
                        <?php
							$j++;
							}
						}
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->
<?php
			}
		}
	}
?>
<script>
$(document).ready(function(){
	setTimeout( function(){ 
		set_cat_product_box_height();
	},1000 );
});

function set_cat_product_box_height(){
	var max_img = 0;
	$('.home1_category_box img').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_img){
			max_img = current_height;
		}
    });
	$('.home1_category_box img').css('height',max_img);
	
	var max_title=0;
	$('.home1_category_box .caption-title').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_title){
			max_title = current_height;
		}
    });
	$('.home1_category_box .caption-title').css('height',max_title);
}
</script>
<style>
@media(max-width: 768px) {
	.nav-tabs>li {
		float: none;
		text-align:center;
	}
}
</style>