<!-- BREADCRUMBS -->
<section class="page-section breadcrumbs">
    <div class="container">
        <div class="page-header">
            <h2 class="section-title section-title-lg">
                <span>
                    <?php echo translate('all_categories');?>
                </span>
            </h2>
        </div>
    </div>
</section>
<!-- /BREADCRUMBS -->

<!-- PAGE -->
<section class="page-section">
    <div class="container">
        <div class="row">
            <?php
            $categories=$this->db->get('category')->result_array();
            foreach($categories as $row){
				if($this->crud_model->if_publishable_category($row['category_id'])){
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="all-brands-list">
                    <div class="brands-list-heading">
                        <div class="heading-text">
                            <a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $row['category_id']; ?>">
                                <?php echo $row['category_name'];?>
                                (<?php
                                    echo $this->crud_model->is_publishable_count('category',$row['category_id']);
                                ?>)
                            </a>
                        </div>
                    </div>
                    <div class="brands-list-body" style="background-image:linear-gradient(rgba(255, 255, 255, 0.87),rgba(241, 241, 241, 0.98)),url('<?php echo base_url();?>uploads/category_image/<?php echo $row['banner'];?>');">
                    <?php 
                    $sub_categories=$this->db->get_where('sub_category',array('category'=>$row['category_id']))->result_array();
                    foreach($sub_categories as $row1){
                    ?>
                        <div class="brands-show">
                            <table>
                                <tr>
                                    <td class="brand-image">
                                        <?php
										if(file_exists('uploads/sub_category_image/'.$row1['banner'])){
										?>
										<img class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/sub_category_image/<?php echo $row1['banner']; ?>" alt=""/> 
										<?php
											} else {
										?>
										<img  class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/sub_category_image/default.jpg" />
										<?php
											}
										?>
                                    </td>
                                    <td class="brand-name">
                                        <a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $row['category_id']; ?>/<?php echo $row1['sub_category_id'];?>">
                                            <?php echo $row1['sub_category_name'];?>
                                            (<?php echo $this->crud_model->is_publishable_count('sub_category',$row1['sub_category_id']); ?>)
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php
				}
            }
            ?>
        </div>
    </div>
</section>
<!-- /PAGE -->