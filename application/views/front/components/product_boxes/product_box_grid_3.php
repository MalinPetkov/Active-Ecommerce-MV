<div class="thumbnail box-style-3 no-border no-padding">
    <div class="media">
    	<div class="cover"></div>
        <div class="media-link image_delay" data-src="<?php echo $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one'); ?>" style="background-image:url('<?php echo img_loading(); ?>');background-size:cover;">
            <span class="icon-view" onclick="quick_view('<?php echo $this->crud_model->product_link($product_id,'quick'); ?>')"
            		data-toggle="tooltip" data-original-title="<?php  echo translate('quick_view'); ?>">
                <strong><i class="fa fa-eye"></i></strong>
            </span>
        </div>
    </div>
    <div class="caption text-center">
        <h4 class="caption-title">
        	<a href="<?php echo $this->crud_model->product_link($product_id); ?>">
				<?php echo $title; ?>
            </a>
        </h4>
        <div class="price">
        	<?php if($this->crud_model->get_type_name_by_id('product',$product_id,'discount') > 0){ ?> 
                <ins><?php echo currency($this->crud_model->get_product_price($product_id)); ?> </ins> 
                <del><?php echo currency($sale_price); ?></del>
            <?php } else { ?>
                <ins><?php echo currency($sale_price); ?></ins> 
            <?php }?>
        </div>
        <div class="buttons">
            <span class="btn  btn-theme-transparent btn-wish-list" onclick="to_wishlist(<?php echo $product_id; ?>,event)"
            		data-toggle="tooltip" data-original-title="<?php if($this->crud_model->is_wished($product_id)=="yes"){ echo translate('added_to_wishlist'); } else { echo translate('add_to_wishlist'); } ?>">
            	<i class="fa fa-heart"></i>
            </span>
            <span class="btn  btn-theme-transparent btn-icon-left" onclick="to_cart(<?php echo $product_id; ?>,event)">
            	<i class="fa fa-shopping-cart"></i>
            	<?php if($this->crud_model->is_added_to_cart($product_id)=="yes"){ 
					echo translate('added_to_cart');  
					} else { 
					echo translate('add_to_cart');  
					} 
				?>
            </span>
            <span class="btn  btn-theme-transparent btn-compare" onclick="do_compare(<?php echo $product_id; ?>,event)"
            		data-toggle="tooltip" data-original-title="<?php if($this->crud_model->is_compared($product_id)=="yes"){ echo translate('compared'); } else { echo translate('compare'); } ?>">
            	<i class="fa fa-exchange"></i>
            </span>
        </div>
    </div>
</div>
                                        
