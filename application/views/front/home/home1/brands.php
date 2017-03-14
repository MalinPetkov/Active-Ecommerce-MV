<!-- PAGE -->
<section class="page-section brands">
    <div class="container">
        <h2 class="section-title">
            <span><?php echo translate('our_available_brands');?></span>
        </h2>
        <div class="partners-carousel">
            <div class="owl-carousel partners2">
                <?php
					$limit =  $this->db->get_where('ui_settings',array('ui_settings_id' => 22))->row()->value;
                    $this->db->limit($limit);
                    $this->db->order_by("brand_id", "desc");
                    $brands=$this->db->get('brand')->result_array();
                    foreach($brands as $row){
                ?>
                <div class="p-item p-item-type-zoom">
                    <a href="<?php echo base_url(); ?>index.php/home/category/0/0-<?php echo $row['brand_id']; ?>" class="p-item-hover">
                        <div class="p-item-info">
                            <div class="p-headline">
                                <div class="p-btn">
                                    <i class="fa fa-link"></i>
                                </div>
                            </div>
                        </div>
                        <div class="p-mask"></div>
                    </a>
                    <div class="p-item-img">
                        <?php
                        if(file_exists('uploads/brand_image/'.$row['logo'])){
                        ?>
                        <img class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/brand_image/<?php echo $row['logo']; ?>" alt=""/> 
                        <?php
                            } else {
                        ?>
                        <img  class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/brand_image/default.jpg" />
                        <?php
                            }
                        ?>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->