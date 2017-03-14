<section class="page-section">
    <div class="container">
        <div class="row home_category_theme_1">
        	<div class="col-md-4">
                <h2 class="category_title">
                    <span><?php echo $category_name; ?></span>
                </h2>
                <div class="row">
                    <div class="col-md-6">
                        <article class="post-wrap">
                            <div class="owl-carousel img-carousel">
                            <?php
                                $this->db->order_by('sub_category_id', 'ASC');
                                $sub_categories = $this->db->get_where('sub_category',array('category'=>$category_id))->result_array();
                                foreach($sub_categories as $row3){
                            ?>	
                                <div class="item">
                                    <div class="row">
                                        <?php
                                            $brands=json_decode($row3['brand'],true);
                                            $i=0;
                                            foreach($brands as $row4){
                                                if($i<5){
                                        ?>
                                        <div class="col-md-12">
                                            <a href="#" data-gal="prettyPhoto" class="brand-box">
                                                <img class="img-responsive" src="<?php echo base_url();?>uploads/brand_image/<?php echo $this->crud_model->get_type_name_by_id('brand',$row4[0],'logo'); ?>" alt=""/>
                                            </a>
                                        </div>
                                        <?php
                                            }
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                </div>
                            <?php
                                }
                            ?>
                            </div>
                        </article>
                    </div>
                    <div class="col-md-6">
                        <div class="list-items">
                            <ul>
                            <?php
                                $this->db->order_by('sub_category_id', 'ASC');
                                $sub_categories = $this->db->get_where('sub_category',array('category'=>$category_id))->result_array();
                                foreach($sub_categories as $row1){
                            ?>
                                <li>
                                    <a href="">
                                        <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>
                                        <?php echo $row1['sub_category_name']; ?>
                                    </a>
                                </li>
                            <?php
                                }
                            ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="tabs-wrapper content-tabs">
                    <div class="tab-content">
                        <div class="tab-pane fade in active">
                            <div class="row">
                            	<div class="col-md-6">
                                	<div class="thumbnail no-border no-padding category">
                                        <div class="media">
                                            <a class="media-link" href="#">
                                                <img src="<?php echo base_url();?>uploads/category_image/<?php echo $banner; ?>" class="img-responsive" alt=""/>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                	<div class="row">
                                    	<?php
										$this->db->limit(4);
										$this->db->order_by('sub_category_id', 'ASC');
										$this->db->where('category',$category_id);
										$sub_banner = $this->db->get('sub_category')->result_array();
										foreach($sub_banner as $row2){
										?>
                                        <div class="col-md-6">
                                            <a href="" data-gal="prettyPhoto" class="img-box-sm">
                                            	<h2 class="title">
                                                    <span><?php echo $row2['sub_category_name']; ?></span>
                                                </h2>
                                                <img class="img-responsive img-box" src="<?php echo base_url();?>uploads/sub_category_image/<?php echo $row2['banner']; ?>" alt=""/>
                                            </a>
                                        </div>
                                        <?php
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