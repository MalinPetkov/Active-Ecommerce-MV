<!-- BREADCRUMBS -->
<section class="page-section breadcrumbs">
    <div class="container">
        <div class="page-header">
            <h2 class="section-title section-title-lg">
                <span>
                    <?php echo translate('all_vendors');?>
                </span>
            </h2>
        </div>
    </div>
</section>
<!-- /BREADCRUMBS -->

<!-- PAGE -->
<section class="page-section all-vendors">
    <div class="container">
        <div class="row">
        	<?php 
				$all_vendors = $this->db->get_where('vendor',array('status'=>'approved'))->result_array();
				foreach($all_vendors as $row){
			?>
            <div class="col-md-4 col-sm-6 col-xs-12">
            	<div class="vendor-details">
                	<div class="vendor-banner">
                    	<?php if(file_exists('uploads/vendor_banner_image/banner_'.$row['vendor_id'].'.jpg')){?>
                    		<img src="<?php echo base_url();?>uploads/vendor_banner_image/banner_<?php echo $row['vendor_id'];?>.jpg"/>
                        <?php }else{?>
                        	<img src="<?php echo base_url();?>uploads/vendor_banner_image/default.jpg"/>	
                        <?php }?>
                    </div>
                    <div class="vendor-profile">
                    	<h3>
                        	<a href="<?php echo $this->crud_model->vendor_link($row['vendor_id']); ?>">
							<?php echo $row['display_name'];?>
                            </a>
                        </h3>
                        <h5><?php echo $row['address1'];?></h5>
                        <h5>
                        	<strong><?php echo translate('email'); ?>: </strong><?php echo $row['email'];?>
                            <?php
								if($row['phone'] !== NULL){
							?>
                            <strong><?php echo translate('phone'); ?>: </strong><?php echo $row['phone'];?>
                            <?php
								}
							?>
                        </h5>
                    </div>
                    <div class="vendor-products">
                    	<h4><?php echo translate('sold_category_of_vendor');?>:</h4>
                        <div class="product-category">
                        <?php
                        	$vendor_categories = $this->crud_model->vendor_categories($row['vendor_id']);
							foreach($vendor_categories as $row1){
						?>
                        	<div class="category-name-box">
                            	<a href="<?php echo base_url(); ?>index.php/home/vendor_category/<?php echo $row['vendor_id'].'/'.$row1;?>">
                            		<?php echo $this->crud_model->get_type_name_by_id('category',$row1,'category_name'); ?>
                                </a>
                            </div>
                        <?php
							}
						?>
                        </div>
                        <div class="vendor-btn">
                        	<a href="<?php echo $this->crud_model->vendor_link($row['vendor_id']); ?>" class="btn btn-custom btn-block btn-theme">
                            	<?php echo translate('visit');?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="vendor-photo">
                	<?php if(file_exists('uploads/vendor_logo_image/logo_'.$row['vendor_id'].'.png')){?>
                    <img src="<?php echo base_url();?>uploads/vendor_logo_image/logo_<?php echo $row['vendor_id'];?>.png" />
                    <?php }else{?>
                    	<img src="<?php echo base_url();?>uploads/vendor_logo_image/default.jpg"/>
                    <?php }?>
                </div>
            </div>
        	<?php 
				}
			?>
        </div>
    </div>
</section>
<!-- /PAGE -->