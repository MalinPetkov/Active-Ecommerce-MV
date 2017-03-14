<div class="thumbnail list_box_style1">
    <div class="row product-single">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="media">
            	<div class="cover"></div>                
        		<div class="media-link image_delay" data-src="<?php echo $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one'); ?>" style="background-image:url('<?php echo img_loading(); ?>');background-size:cover; background-position:center;">
                    <span onclick="quick_view('<?php echo $this->crud_model->product_link($product_id,'quick'); ?>')">
                        <span class="icon-view">
                            <strong><i class="fa fa-eye"></i></strong>
                        </span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12 padding-l-0-md">
            <div class="caption">
                <h4 class="caption-title">
                    <a href="<?php echo $this->crud_model->product_link($product_id); ?>">
                        <?php echo $title; ?>
                    </a>
                </h4>
                <div class="product-info">
                    <p>
                        <a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $category; ?>">
                            <?php echo $this->crud_model->get_type_name_by_id('category',$category,'category_name');?>
                        </a>
                    </p>
                    ||
                    <p>
                        <a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $category; ?>/<?php echo $sub_category; ?>">
                            <?php echo $this->crud_model->get_type_name_by_id('sub_category',$sub_category,'sub_category_name');?>
                        </a>
                    </p>
                    ||
                    <p>
                        <a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $category; ?>/<?php echo $sub_category; ?>-<?php echo $brand; ?>">
                        <?php echo $this->crud_model->get_type_name_by_id('brand',$brand,'name');?>
                        </a>
                    </p>
                </div>
                <div class="added_by">
                    <?php echo translate('sold_by_:');?>
                    <p>
                        <?php echo $this->crud_model->product_by($product_id,'with_link');?>
                    </p>
                </div>
                <hr class="page-divider"/>
                <div class="product-price">
                    <?php echo translate('price_:');?>
                    <?php if($discount > 0){ ?> 
                        <ins>
                            <?php echo currency($this->crud_model->get_product_price($product_id)); ?>
                            <unit><?php echo ' /'.$unit;?></unit>
                        </ins> 
                        <del><?php echo currency($sale_price); ?></del>
                        <span class="label label-success">
                        <?php 
                            echo translate('discount:_').$discount;
                            if($discount_type =='percent'){
                                echo '%';
                            }
                            else{
                                echo currency();
                            }
                        ?>
                        </span>
                    <?php } else { ?>
                        <ins>
                            <?php echo currency($sale_price); ?>
                            <unit><?php echo ' /'.$unit;?></unit>
                        </ins> 
                    <?php }?>
                </div>
                <?php
                    if($current_stock > 0){
                ?>
                <div class="stock">
                    <?php echo $current_stock.' '.$unit.translate('_available');?>
                </div>
                <?php
                    }else{
                ?>
                <div class="out_of_stock">
                    <?php echo translate('out_of_stock');?>
                </div>
                <?php
                    }
                ?>
                <hr class="page-divider"/>
                <div class="buttons">
                    <span class="btn btn-add-to cart" onclick="to_cart(<?php echo $product_id; ?>,event)">
                        <i class="fa fa-shopping-cart"></i>
                        <?php if($this->crud_model->is_added_to_cart($product_id)){ 
                            echo translate('added_to_cart');  
                            } else { 
                            echo translate('add_to_cart');  
                            } 
                        ?>
                    </span>
                    <?php 
                        $wish = $this->crud_model->is_wished($product_id); 
                    ?>
                    <span class="btn btn-add-to <?php if($wish == 'yes'){ echo 'wished';} else{ echo 'wishlist';} ?>" onclick="to_wishlist(<?php echo $product_id; ?>,event)">
                        <i class="fa fa-heart"></i>
                        <span class="hidden-sm hidden-xs">
							<?php if($wish == 'yes'){ 
                                echo translate('_added_to_wishlist'); 
                                } else { 
                                echo translate('_add_to_wishlist');
                                } 
                            ?>
                        </span>
                    </span>
                    <?php 
                        $compare = $this->crud_model->is_compared($product_id); 
                    ?>
                    <span class="btn btn-add-to compare btn_compare" onclick="do_compare(<?php echo $product_id; ?>,event)">
                        <i class="fa fa-exchange"></i>
                        <span class="hidden-sm hidden-xs">
							<?php if($compare == 'yes'){ 
                                echo translate('_compared'); 
                                } else { 
                                echo translate('_compare');
                                } 
                            ?>
                        </span>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>