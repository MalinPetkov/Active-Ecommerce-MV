
<aside class="col-md-3 sidebar" id="sidebar">
    <!-- widget shop categories -->
    <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onClick="close_sidebar();" style="border-radius:50%; position: absolute; top:5px;">
        <i class="fa fa-times"></i>
    </span>
    <div class="widget shop-categories">
        <div class="widget-content">
            <ul>   
                <li class="title-for-list">
                    <span class="arrow search_cat search_cat_click all_category_set" style="display:none;" data-cat="0" 
                        data-min="<?php echo round($this->crud_model->get_range_lvl('product_id !=', '0', "min")); ?>" 
                           data-max="<?php echo round($this->crud_model->get_range_lvl('product_id !=', '0', "max")); ?>" 
                            data-brands="<?php echo $this->db->get_where('general_settings',array('type'=>'data_all_brands'))->row()->value; ?>"
                                data-vendors="<?php echo $this->db->get_where('general_settings',array('type'=>'data_all_vendors'))->row()->value; ?>"
                           >
                                    <i class="fa fa-angle-down"></i>
                    </span>
                    <a href="#" class="search_cat" data-cat="0"
                        data-min="<?php echo round($this->crud_model->get_range_lvl('product_id !=', '0', "min")); ?>" 
                           data-max="<?php echo round($this->crud_model->get_range_lvl('product_id !=', '0', "max")); ?>" >
                        <?php echo translate('all_products');?>
                    </a>
                </li>                                                 
                <?php
                    $all_category = $this->db->get('category')->result_array();
                    foreach($all_category as $row)
                    {
						if($this->crud_model->is_category_of_vendor($row['category_id'],$vendor_id)){
                ?>
                <li>
                    <span class="arrow search_cat search_cat_click" data-cat="<?php echo $row['category_id']; ?>" 
                        data-min="<?php echo round($this->crud_model->get_range_lvl('category', $row['category_id'], "min")); ?>" 
                           data-max="<?php echo round($this->crud_model->get_range_lvl('category', $row['category_id'], "max")); ?>" 
                            data-brands="<?php echo $row['data_brands']; ?>"
                                data-vendors="<?php echo $row['data_vendors']; ?>"
                           >
                                    <i class="fa fa-angle-down"></i>
                    </span>
                    <a href="#" class="search_cat" data-cat="<?php echo $row['category_id']; ?>"
                        data-min="<?php echo round($this->crud_model->get_range_lvl('category', $row['category_id'], "min")); ?>" 
                            data-max="<?php echo round($this->crud_model->get_range_lvl('category', $row['category_id'], "max")); ?>" >
                        <?php echo $row['category_name']; ?>
                    </a>
                    <ul class="children">
                        <?php
                            $sub_category = $this->db->get_where('sub_category',array('category'=>$row['category_id']))->result_array();
                            foreach($sub_category as $row1)
                            {
								if($this->crud_model->is_sub_cat_of_vendor($row1['sub_category_id'],$vendor_id)){
                        ?>
                        <li class="on_click_search checkbox">
                            <label for="sub_<?php echo $row1['sub_category_id']; ?>" onClick="check(this)" >
                                <input type="checkbox" name="jsut_show" id="sub_<?php echo $row1['sub_category_id']; ?>" class="search_sub" value="<?php echo $row1['sub_category_id']; ?>">
                                <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                <?php echo $row1['sub_category_name']; ?>
                                <span class="count">
                                   <?php echo $this->crud_model->is_publishable_count('sub_category',$row1['sub_category_id'],$vendor_id); ?>
                                </span>
                            </label>
                        </li>
                        <?php  
								}
                            }
                        ?>
                    </ul>
                </li>
                <?php 
						}
                    }
                ?>
            </ul>
        </div>
    </div>
    <!-- /widget shop categories -->
    <!-- widget price filter -->
    <div class="widget widget-filter-price">
        <h4 class="widget-title">
            <?php echo translate('price');?>
        </h4>
        <div class="widget-content">
            <div id="slider-range"></div>
            <input type="text" id="amount"  disabled />
            <button class="btn btn-theme"><?php echo translate('filters');?></button>
        </div>
    </div>
    <!-- /widget price filter -->
    <!-- widget tabs -->
    <div class="widget widget-tabs hidden-sm hidden-xs">
        <div class="widget-content">
            <ul id="tabs" class="nav nav-justified">
                <li>
                    <a href="#tab-s1" data-toggle="tab">
                        <?php echo translate('popular');?>
                    </a>
                </li>
                <li class="active">
                    <a href="#tab-s2" data-toggle="tab">
                        <?php echo translate('latest');?>
                    </a>
                </li>
                <li>
                    <a href="#tab-s3" data-toggle="tab">
                        <?php echo translate('deals');?>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <!-- tab 1 -->
                <div class="tab-pane fade" id="tab-s1">
                    <div class="product-list">
						<?php
							$this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$vendor_id)));
							$this->db->limit(4);
							$this->db->order_by("number_of_view", "desc");
							$most_viewed=$this->db->get('product')->result_array();
							foreach($most_viewed as $row){
						?>
                        <div class="media">
                            <a class="pull-left media-link" href="<?php echo $this->crud_model->product_link($row['product_id']); ?>">
                                <img class="media-object img-responsive" src="<?php echo $this->crud_model->file_view('product',$row['product_id'],'100','','thumb','src','multi','one');?>" alt="">
                                <i class="fa fa-eye"></i>
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                	<a href="<?php echo $this->crud_model->product_link($row['product_id']); ?>">
                                    	<?php echo $row['title']; ?>
                               		</a>
                          		</h4>
                                <div class="rating">
                                    <div class="rating ratings_show" data-original-title="<?php echo $rating = $this->crud_model->rating($row['product_id']); ?>"	
                                        data-toggle="tooltip" data-placement="left">
                                        <?php
                                            $r = $rating;
                                            $i = 6;
                                            while($i>1){
                                                $i--;
                                        ?>
                                            <span class="star <?php if($i<=$rating){ echo 'active'; } $r++; ?>"></span>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="price">
                                	<?php if($this->crud_model->get_type_name_by_id('product',$row['product_id'],'discount') > 0){ ?> 
                                        <ins><?php echo currency($this->crud_model->get_product_price($row['product_id'])); ?> </ins> 
                                        <del><?php echo currency($row['sale_price']); ?></del>
                                    <?php } else { ?>
                                        <ins><?php echo currency($row['sale_price']); ?></ins> 
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <?php
							}
						?>
                    </div>
                </div>
    
                <!-- tab 2 -->
                <div class="tab-pane fade in active" id="tab-s2">
                    <div class="product-list">
                        <?php
							$this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$vendor_id)));
							$this->db->limit(4);
							$this->db->order_by("product_id", "desc");
							$latest=$this->db->get('product')->result_array();
							foreach($latest as $row){
						?>
                        <div class="media">
                            <a class="pull-left media-link" href="<?php echo $this->crud_model->product_link($row['product_id']); ?>">
                                <img class="media-object img-responsive" src="<?php echo $this->crud_model->file_view('product',$row['product_id'],'100','','thumb','src','multi','one');?>" alt="">
                                <i class="fa fa-eye"></i>
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                	<a href="<?php echo $this->crud_model->product_link($row['product_id']); ?>">
                                    	<?php echo $row['title']; ?>
                               		</a>
                          		</h4>
                                <div class="rating">
                                    <div class="rating ratings_show" data-original-title="<?php echo $rating = $this->crud_model->rating($row['product_id']); ?>"	
                                        data-toggle="tooltip" data-placement="left">
                                        <?php
                                            $r = $rating;
                                            $i = 6;
                                            while($i>1){
                                                $i--;
                                        ?>
                                            <span class="star <?php if($i<=$rating){ echo 'active'; } $r++; ?>"></span>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="price">
                                	<?php if($this->crud_model->get_type_name_by_id('product',$row['product_id'],'discount') > 0){ ?> 
                                        <ins><?php echo currency($this->crud_model->get_product_price($row['product_id'])); ?> </ins> 
                                        <del><?php echo currency($row['sale_price']); ?></del>
                                    <?php } else { ?>
                                        <ins><?php echo currency($row['sale_price']); ?></ins> 
                                    <?php }?>
                                </div>
                            </div>
                        </div>	
                        <?php
							}
						?>
                    </div>
                </div>
                <!-- tab 3 -->
                <div class="tab-pane fade" id="tab-s3">
                    <div class="product-list">
                        <?php
							$this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$vendor_id)));
							$this->db->limit(4);
							$this->db->order_by("product_id", "desc");
							$todays_deal=$this->db->get_where('product',array('deal'=>'ok'))->result_array();
							foreach($todays_deal as $row){
						?>
                       	<div class="media">
                            <a class="pull-left media-link" href="<?php echo $this->crud_model->product_link($row['product_id']); ?>">
                                <img class="media-object img-responsive" src="<?php echo $this->crud_model->file_view('product',$row['product_id'],'100','','thumb','src','multi','one');?>" alt="">
                                <i class="fa fa-eye"></i>
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">
                                	<a href="<?php echo $this->crud_model->product_link($row['product_id']); ?>">
                                    	<?php echo $row['title']; ?>
                               		</a>
                          		</h4>
                                <div class="rating">
                                    <div class="rating ratings_show" data-original-title="<?php echo $rating = $this->crud_model->rating($row['product_id']); ?>"	
                                        data-toggle="tooltip" data-placement="left">
                                        <?php
                                            $r = $rating;
                                            $i = 6;
                                            while($i>1){
                                                $i--;
                                        ?>
                                            <span class="star <?php if($i<=$rating){ echo 'active'; } $r++; ?>"></span>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                </div>
                                <div class="price">
                                	<?php if($this->crud_model->get_type_name_by_id('product',$row['product_id'],'discount') > 0){ ?> 
                                        <ins><?php echo currency($this->crud_model->get_product_price($row['product_id'])); ?> </ins> 
                                        <del><?php echo currency($row['sale_price']); ?></del>
                                    <?php } else { ?>
                                        <ins><?php echo currency($row['sale_price']); ?></ins> 
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                        <?php
							}
						?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /widget tabs -->
</aside>

<input type="hidden" id="univ_max" value="<?php echo $this->crud_model->get_range_lvl('product_id !=', '', "max"); ?>">
<input type="hidden" id="cur_cat" value="0">
<?php include 'search_script.php'; ?>
