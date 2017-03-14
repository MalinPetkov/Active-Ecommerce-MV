<!-- BREADCRUMBS -->
<section class="page-section breadcrumbs">
    <div class="container">
        <div class="page-header">
            <h2 class="section-title section-title-lg">
                <span>
                    <?php echo translate('all_brands');?>
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
				$this->db->where('digital',NULL);
                $categories=$this->db->get('category')->result_array();
                foreach($categories as $row){
            ?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="all-brands-list">
                    <div class="brands-list-heading">
                        <div class="heading-text">
                        	<a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $row['category_id']; ?>">
                            	<?php echo $row['category_name'];?>
                            </a>
                        </div>
                    </div>
                    <div class="brands-list-body" style="background-image:linear-gradient(rgba(255, 255, 255, 0.87),rgba(241, 241, 241, 0.98)),url('<?php echo base_url();?>uploads/category_image/<?php echo $row['banner'];?>');">
					<?php 
                    $sub_categories = $this->db->get_where('sub_category', array('category'=> $row['category_id']))->result_array();
                    $result= array();
						foreach($sub_categories as $row1){
							$brands = json_decode($row1['brand'],TRUE);
							foreach($brands as $row2){
								if(!in_array($row2,$result)){
									array_push($result,$row2);
								}
							}
						}
						foreach($result as $row3){
                    ?>
                        <div class="brands-show">
                            <table>
                                <tr>
                                    <td class="brand-image">
                                        <?php
										if(file_exists('uploads/brand_image/'.$this->crud_model->get_type_name_by_id('brand',$row3,'logo'))){
										?>
										<img class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url();?>uploads/brand_image/<?php echo $this->crud_model->get_type_name_by_id('brand',$row3,'logo'); ?>" alt=""/> 
										<?php
											} else {
										?>
										<img  class="image_delay" src="<?php echo img_loading(); ?>" data-src="<?php echo base_url(); ?>uploads/brand_image/default.jpg" />
										<?php
											}
										?>
                                    </td>
                                    <td class="brand-name">
                                        <a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $row['category_id']; ?>/0-<?php echo $row3; ?>">
											<?php echo $this->crud_model->get_type_name_by_id('brand',$row3,'name');?>
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
    </div>
</section>
<!-- /PAGE -->