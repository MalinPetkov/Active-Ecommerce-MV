<?php
	$vendor_categories = $this->crud_model->vendor_categories($vendor_id);
	if(count($vendor_categories) !== 0){
?>
<h2 class="section-title section-title-lg" style="margin-top:30px;">
    <span>
        <?php echo translate('vendor');?> 
        <span class="thin"><?php echo translate('categories');?></span>
    </span>
</h2>
<?php
	foreach($vendor_categories as $category_id){
		$digital_ckeck=$this->db->get_where('category',array('category_id'=>$category_id))->row()->digital;
		if($this->crud_model->if_publishable_category($category_id)){
?>
<section class="page-section">
    <div class="container">
        <div class="row home_category_theme_1">
        	<div class="col-md-4 col-sm-12 col-xs-12">
                <h2 class="category_title">
                    <span>
                    	<a href="<?php echo base_url(); ?>index.php/home/vendor_category/<?php echo $vendor_id; ?>/<?php echo $category_id; ?>" style="color:#fff;">
							<?php echo $this->crud_model->get_type_name_by_id('category',$category_id,'category_name');?>
                        </a>
                    </span>
                </h2>
                <div class="row hidden-sm hidden-xs">
                	<?php
                    if ($digital_ckeck !== 'ok') {
					?>
                    <div class="col-md-6">
                        <article class="post-wrap">
                            <div class="owl-carousel img-carousel">
                            <?php
								$i=1;
                                $this->db->order_by('sub_category_id', 'ASC');
                                $sub_categories = $this->db->get_where('sub_category',array('category'=>$category_id))->result_array();
								$all_brands= $this->crud_model->get_brands('category',$category_id,$vendor_id);
								foreach($all_brands as $row3){
									$brand=explode(':::',$row3);
										if($i==1){
							?>
                                <div class="item">
                                    <div class="row">
										<?php
                                            }
                                        ?>
                                        <div class="col-md-12">
                                            <a href="<?php echo base_url(); ?>index.php/home/vendor_category/<?php echo $vendor_id; ?>/<?php echo $category_id; ?>/0-<?php echo $brand[0]; ?>" class="brand-box">
                                                <?php
												if(file_exists('uploads/brand_image/'.$this->crud_model->get_type_name_by_id('brand',$brand[0],'logo'))){
												?>
                                                <img class="img-responsive brand-img" src="<?php echo base_url();?>uploads/brand_image/<?php echo $this->crud_model->get_type_name_by_id('brand',$brand[0],'logo'); ?>" alt=""/> 
												<?php
													} else {
												?>
												<img  class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/brand_image/default.jpg" />
												<?php
													}
												?>
                                            </a>
                                        </div>
										<?php
                                            if($i==4 ){
                                        ?>
                                    </div>
                                </div>
                            <?php
									}
									if($i<4){
										$i++;
									}
									else{
										$i=1;
									}
                                }
                            ?>
                            </div>
                        </article>
                    </div>
                    <?php
					}
					?>
                    <div class="<?php if ($digital_ckeck == 'ok') { echo 'col-md-12'; } else { echo 'col-md-6'; }?>">
                        <div class="list-items">
                            <ul>
                            <?php
                                $this->db->order_by('sub_category_id', 'ASC');
                                $sub_categories = $this->db->get_where('sub_category',array('category'=>$category_id))->result_array();
                                foreach($sub_categories as $row1){
									if($this->crud_model->is_sub_cat_of_vendor($row1['sub_category_id'],$vendor_id)){
                            ?>
                                <li>
                                    <a href="<?php echo base_url();?>index.php/home/vendor_category/<?php echo $vendor_id; ?>/<?php echo $category_id;?>/<?php echo $row1['sub_category_id'];?>-0">
                                        <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                        <?php echo $row1['sub_category_name']; ?>
                                    </a>
                                </li>
                            <?php
									}
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="tabs-wrapper content-tabs">
                    <div class="tab-content">
                        <div class="tab-pane fade in active">
                            <div class="row">
                            	<div class="col-md-6 col-sm-6 col-xs-6 category">
                                	<div class="p-item p-item-type-zoom">
                                        <span class="p-item-hover" href="#" target="_blank">
                                            <div class="p-item-info">
                                                <div class="p-headline">
                                                    <span><?php echo $this->crud_model->get_type_name_by_id('category',$category_id,'category_name'); ?></span>
                                                    <div class="p-line"></div>
                                                    <div class="p-btn">
                                                        <a href="<?php echo base_url(); ?>index.php/home/vendor_category/<?php echo $vendor_id; ?>/<?php echo $category_id; ?>" class="btn  btn-theme-transparent btn-theme-xs">Browse</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-mask"></div>
                                        </span>
                                        <div class="p-item-img">
                                        	<?php 
												if(file_exists('uploads/category_image/'.$this->crud_model->get_type_name_by_id('category',$category_id,'banner'))){
											?>
                                            <img src="<?php echo base_url();?>uploads/category_image/<?php echo $this->crud_model->get_type_name_by_id('category',$category_id,'banner'); ?>" class="img-responsive" alt=""/>
                                            <?php }else{?>
                                            <img class="img-responsive img-box" src="<?php echo base_url();?>uploads/category_image/default.jpg" alt=""/>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-6">
                                	<div class="row">
                                    	<?php
										$this->db->limit(4);
										$this->db->order_by('sub_category_id', 'ASC');
										$this->db->where('category',$category_id);
										$sub_banner = $this->db->get('sub_category')->result_array();
										foreach($sub_banner as $row2){
											if($this->crud_model->is_sub_cat_of_vendor($row2['sub_category_id'],$vendor_id)){
										?>
                                        <div class="col-md-6 col-sm-6 col-xs-6 sub-category">
                                        	<div class="p-item p-item-type-zoom">
                                                <span class="p-item-hover" target="_blank">
                                                    <div class="p-item-info">
                                                        <div class="p-headline">
                                                        	<span><?php echo $row2['sub_category_name']; ?></span>
                                                            <div class="p-line"></div>
                                                            <div class="p-btn">
                                                            	<a href="<?php echo base_url(); ?>index.php/home/vendor_category/<?php echo $vendor_id; ?>/<?php echo $category_id; ?>/<?php echo $row2['sub_category_id']; ?>-0" class="btn  btn-theme-transparent btn-theme-xs"><?php echo translate('browse'); ?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="p-mask"></div>
                                                </span>
                                                <div class="p-item-img">
                                                	<?php 
														if(file_exists('uploads/sub_category_image/'.$row2['banner'])){
													?>
                                                	<img class="img-responsive img-box" src="<?php echo base_url();?>uploads/sub_category_image/<?php echo $row2['banner']; ?>" alt=""/>
                                                    <?php }
													else{
													?>
                                                    <img class="img-responsive img-box" src="<?php echo base_url();?>uploads/sub_category_image/default.jpg" alt=""/>
													<?php }?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
											}
										}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
		}
	}
}
?>