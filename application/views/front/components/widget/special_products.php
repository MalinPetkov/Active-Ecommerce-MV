<div class="col-md-12">
    <div class="widget widget-tabs">
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
                           	$most_viewed=$this->crud_model->product_list_set('most_viewed',4);
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
                            $latest=$this->crud_model->product_list_set('latest',4);
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
                            $todays_deal=$this->crud_model->product_list_set('deal',4);
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
</div>