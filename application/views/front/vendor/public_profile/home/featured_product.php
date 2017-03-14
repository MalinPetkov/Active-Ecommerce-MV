<!-- PAGE -->
<?php
$featured=$this->crud_model->product_list_set('vendor_featured',10,$vendor_id);
if(count($featured) !== 0){
?>
<section class="page-section featured-products">
    <div class="container">
        <h2 class="section-title section-title-lg">
            <span>
                <?php echo translate('featured');?> 
                <span class="thin"> <?php echo translate('product');?></span>
            </span>
        </h2>
        <div class="featured-products-carousel">
            <div class="owl-carousel" id="featured-products-carousel">
                <?php
                    foreach($featured as $row){
                		echo $this->html_model->product_box($row, 'grid', '1');
					}
                ?>
            </div>
        </div>
    </div>
</section>
<?php
}
?>
<!-- /PAGE -->
<script>
$(document).ready(function(){
	setTimeout( function(){ 
		set_product_box_height();
	},1000 );
});

function set_product_box_height(){
	var max_img = 0;
	$('.featured-products img').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_img){
			max_img = current_height;
		}
    });
	$('.featured-products img').css('height',max_img);
	
	var max_title=0;
	$('.featured-products .caption-title').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_title){
			max_title = current_height;
		}
    });
	$('.featured-products .caption-title').css('height',max_title);
}
</script>