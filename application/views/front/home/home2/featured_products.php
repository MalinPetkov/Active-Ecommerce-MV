<!-- PAGE -->
<section class="page-section featured-products">
    <div class="container">
        <h2 class="section-title section-title-lg">
            <span>
            	<span class="thin"> <?php echo translate('latest');?></span>
                <?php echo translate('featured');?> 
                <span class="thin"> <?php echo translate('product');?></span>
            </span>
        </h2>
        <div class="featured-products-carousel">
            <div class="owl-carousel" id="featured-products-carousel">
                <?php
					$box_style =  $this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;
					$limit =  $this->db->get_where('ui_settings',array('ui_settings_id' => 20))->row()->value;
                    $featured=$this->crud_model->product_list_set('featured',$limit);
                    foreach($featured as $row){
                		echo $this->html_model->product_box($row, 'grid', $box_style);
					}
                ?>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->
<script>
$(document).ready(function(){
	setTimeout( function(){ 
		set_featured_product_box_height();
	},1000 );
});

function set_featured_product_box_height(){
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