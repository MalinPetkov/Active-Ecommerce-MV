<?php
	foreach($product_data as $row)
	{
		$thumbs = $this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','all');
		$mains = $this->crud_model->file_view('product',$row['product_id'],'','','no','src','multi','all');  
?>
	<!-- PAGE -->
	<section class="page-section light">
		<div class="container">
			<div class="row product-single" style="background:#FFF;">
				<div class="col-md-7">
                	<div class="digital_gallery">
                        <div class="owl-carousel img-carousel">                                            
                            <?php 
                                foreach ($mains as $row1) {
                            ?>
                            <div class="item">
                                <img class="img-responsive" style="width:100%;" src="<?php echo $row1; ?>" alt=""/>
                            </div>
                            <?php 
                                }
                            ?>
                        </div>
                        <div class="row product-thumbnails" style="margin-top: -20px;">                                     
                            <?php 
                                $i=0;
                                foreach ($thumbs as $id=>$row1) {
                            ?>
                            <div class="col-xs-1 col-sm-1 col-md-1"><span onclick="jQuery('.img-carousel').trigger('to.owl.carousel', [<?php echo $i; ?>, 300]);"><img class="small-img" src="<?php echo $row1; ?>" alt=""/></span></div>
                            <?php 
                                $i++;
                                }
                            ?>
                        </div>
                    </div>
				</div>
				<div class="col-md-5">
                	<div class="pro_logo">
					<?php 
                        if(file_exists('uploads/digital_logo_image/'. $row['logo'])){
                    ?>
                        <img class="img-responsive" src="<?php echo base_url(); ?>uploads/digital_logo_image/<?php echo $row['logo']; ?>" alt=""/>
                    <?php }else{?>
                        <img class="img-responsive" src="<?php echo base_url(); ?>uploads/digital_logo_image/default.jpg" alt=""/>
                    <?php }?>
                    </div>
					<h3 class="product-title"><?php echo $row['title'];?></h3>
                    <div class="product-info">
                        <p>
                            <a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $row['category']; ?>">
                                <?php echo $this->crud_model->get_type_name_by_id('category',$row['category'],'category_name');?>
                            </a>
                        </p>
                        ||
                        <p>
                            <a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $row['category']; ?>/<?php echo $row['sub_category']; ?>">
                                <?php echo $this->crud_model->get_type_name_by_id('sub_category',$row['sub_category'],'sub_category_name');?>
                            </a>
                        </p>
                    </div>
                    <div class="added_by">
                        <?php echo translate('downloads');?>:
                        <p>
                            <?php echo $this->crud_model->download_count($row['product_id']);?>
                        </p>
                    </div>
                    <div class="added_by">
                        <?php echo translate('sold_by');?>:
                        <p>
                            <?php echo $this->crud_model->product_by($row['product_id'],'with_link');?>
                        </p>
                    </div>
                    <div class="added_by">
                        <?php echo translate('last_updated');?>:
                        <p>
                            <?php echo date('M d , Y',$row['update_time']);?>
                        </p>
                    </div>
                    <div class="product-rating clearfix">
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
                        
                        <div class="rating inp_rev list-inline" style="display:none;" data-pid='<?php echo $row['product_id']; ?>'>
                            <span class="star rate_it" id="rating_5" data-rate="5"></span>
                            <span class="star rate_it" id="rating_4" data-rate="4"></span>
                            <span class="star rate_it" id="rating_3" data-rate="3"></span>
                            <span class="star rate_it" id="rating_2" data-rate="2"></span>
                            <span class="star rate_it" id="rating_1" data-rate="1"></span>
                        </div>
                        <a class="reviews ratings_show" href="#">
                            <?php echo $row['rating_num']; ?>
                            <?php echo translate('review(s)'); ?> 
                        </a>  
                        <?php  
                            if($this->session->userdata('user_login') == 'yes'){
                                $user_id = $this->session->userdata('user_id');
                                $rating_user = json_decode($row['rating_user'],true);
                                if(!in_array($user_id,$rating_user)){
                        ?>
                        <a class="add-review rev_show ratings_show" href="#">
                            | <?php echo translate('add_your_review');?>
                        </a>
                        <?php 
                                }
                            }
                        ?>
                    </div>
                    <hr class="page-divider"/>
                    <div class="product-price">
                        <?php echo translate('price_:');?>
                        <?php if($row['discount'] > 0){ ?> 
                            <ins>
                                <?php echo currency($this->crud_model->get_product_price($row['product_id'])); ?>
                            </ins> 
                            <del><?php echo currency($row['sale_price']); ?></del>
                            <span class="label label-success">
                            <?php 
                                echo translate('discount:_').$row['discount'];
                                if($row['discount_type']=='percent'){
                                    echo '%';
                                }
                                else{
                                    echo currency();
                                }
                            ?>
                            </span>
                        <?php } else { ?>
                            <ins>
                                <?php echo currency($row['sale_price']); ?>
                            </ins> 
                        <?php }?>
                    </div>
					<?php
						include 'order_option.php';
						if($row['video'] !== '[]'){
							include 'video.php';
						}
					?>
				</div>
                <div class="col-md-12" style="margin-top:15px;">
				<?php
                	include 'related_products.php';
                ?>
                </div>
			</div>
		</div>
	</section>
	<!-- /PAGE -->
<?php 
	}
?>
<script>
	$('body').on('click', '.rev_show', function(){
		$('.ratings_show').hide('fast');
		$('.inp_rev').show('slow');
	});
</script>
<style>
	.digital_gallery{
		position:relative;
		padding:10px;
		background:#f5f5f5;
	}
	.rate_it{
		display:none;	
	}
	.pro_logo{
		position:absolute; 
		right:15px;
	    height: 50px;
		width: 50px;
		border-radius: 10px;
		overflow: hidden;
		margin-bottom: 10px;
	}
	.pro_logo img{
	    height: 100%;
		width: 100%;
	}
	.owl-prev,
	.owl-next{
		display:none !important;
	}
	.digital_gallery .item img{
		height: 620px; 
	}
	.small-img{
		border: 2px solid #000;
		height: 60px;
		cursor:pointer;
	}
	.rel{
		margin-right:3px;
	}
</style>
<style>
@media(max-width: 768px) {
	.small-img{
		height: 30px;
	}
	.digital_gallery .item img{
		height: 320px; 
	}
}
</style>