<?php 
	$contact_address =  $this->db->get_where('general_settings',array('type' => 'contact_address'))->row()->value;
	$contact_phone =  $this->db->get_where('general_settings',array('type' => 'contact_phone'))->row()->value;
	$contact_email =  $this->db->get_where('general_settings',array('type' => 'contact_email'))->row()->value;
	$contact_website =  $this->db->get_where('general_settings',array('type' => 'contact_website'))->row()->value;
	$contact_about =  $this->db->get_where('general_settings',array('type' => 'contact_about'))->row()->value;
	
	$facebook =  $this->db->get_where('social_links',array('type' => 'facebook'))->row()->value;
	$googleplus =  $this->db->get_where('social_links',array('type' => 'google-plus'))->row()->value;
	$twitter =  $this->db->get_where('social_links',array('type' => 'twitter'))->row()->value;
	$skype =  $this->db->get_where('social_links',array('type' => 'skype'))->row()->value;
	$youtube =  $this->db->get_where('social_links',array('type' => 'youtube'))->row()->value;
	$pinterest =  $this->db->get_where('social_links',array('type' => 'pinterest'))->row()->value;
	
	$footer_text =  $this->db->get_where('general_settings',array('type' => 'footer_text'))->row()->value;
	$footer_category =  json_decode($this->db->get_where('general_settings',array('type' => 'footer_category'))->row()->value);
?>
<footer class="footer1">
	<div class="footer1-widgets">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-sm col-xs-12">
					<div class="widget">
						<a href="<?php echo base_url(); ?>">
                          	<img class="img-responsive" src="<?php echo $this->crud_model->logo('home_bottom_logo'); ?>" alt="">
						</a>
						<p><?php echo $footer_text ;?></p>
						<?php
							echo form_open(base_url() . 'index.php/home/subscribe', array(
								'class' => '',
								'method' => 'post'
							));
						?>    
							<div class="form-group row">
                            	<div class="col-md-12">
									<input type="text" class="form-control col-md-8" name="email" id="subscr" placeholder="<?php echo translate('email_address'); ?>">
                                	<span class="btn btn-subcribe subscriber enterer"><?php echo translate('subscribe'); ?></span>
                                </div>
							</div>                
					   </form> 
					</div>
				</div>
				<div class="col-md-3 hidden-xs hidden-sm">
					<div class="widget widget-categories">
						<h4 class="widget-title"><?php echo translate('categories');?></h4>
						<ul>
							<?php
								foreach($footer_category as $row){
									if($this->crud_model->if_publishable_category($row)){
							?>
								<li>
									<a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $row; ?>">
										<?php
											echo $this->crud_model->get_type_name_by_id('category',$row,'category_name');
										?>
									</a>
								</li>
							<?php
									}
								}
							?>
						</ul>
					</div>
				</div>
				<div class="col-md-3  col-sm-12 hidden-xs">
					<div class="widget widget-categories">
						<h4 class="widget-title"><?php echo translate('useful_links');?></h4>
						<ul>
							<li>
								<a href="<?php echo base_url(); ?>index.php/home/"><?php echo translate('home');?>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>index.php/home/category/0/0-0"><?php echo translate('all_products');?>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>index.php/home/others_product/featured"><?php echo translate('featured_products');?>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url(); ?>index.php/home/contact/"><?php echo translate('contact');?>
								</a>
							</li>
                            <?php
							$this->db->where('status','ok');
                            $all_page = $this->db->get('page')->result_array();
							foreach($all_page as $row){
							?>
                            <li>
                                <a href="<?php echo base_url(); ?>index.php/home/page/<?php echo $row['parmalink']; ?>">
                                    <?php echo $row['page_name']; ?>
                                </a>
                            </li>
                            <?php
							}
							?>
						</ul>
					</div>
				</div>
				<div class="col-md-3 hidden-xs hidden-sm">
					<div class="widget contact">
						<h4 class="widget-title"><?php echo translate('contact_us');?></h4>
						<div class="media-list">
							<div class="media">
								<i class="pull-left fa fa-home"></i>
								<div class="media-body">
									<strong><?php echo translate('address');?>:</strong>
                                    <br>
									<?php echo $contact_address;?>
								</div>
							</div>
							<div class="media">
								<i class="pull-left fa fa-phone"></i>
								<div class="media-body">
									<strong><?php echo translate('phone');?>:</strong>
                                    <br>
									<?php echo $contact_phone;?>
								</div>
							</div>
							<div class="media">
								<i class="pull-left fa fa-globe"></i>
								<div class="media-body">
									<strong><?php echo translate('website');?>:</strong>
                                    <br>
									<a href="https://<?php echo $contact_website;?>"><?php echo $contact_website;?></a>
								</div>
							</div>
							<div class="media">
								<i class="pull-left fa fa-envelope-o"></i>
								<div class="media-body">
									<strong><?php echo translate('email');?>:</strong>
                                    <br>
									<a href="mailto:<?php echo $contact_email;?>">
										<?php echo $contact_email;?>
									</a>
								</div>
							</div>
							<ul class="social-icons">
								<li><a href="<?php echo $facebook;?>" class="facebook"><i class="fa fa-facebook"></i></a></li>
								<li><a href="<?php echo $twitter;?>" class="twitter"><i class="fa fa-twitter"></i></a></li>
								<li><a href="<?php echo $googleplus;?>" class="google"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="<?php echo $pinterest;?>" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
								<li><a href="<?php echo $youtube;?>" class="youtube"><i class="fa fa-youtube"></i></a></li>
								<li><a href="<?php echo $skype;?>" class="skype"><i class="fa fa-skype"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="footer1-meta">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-xs-12">
					<div class="copyright">
						2016 &copy; 
						<?php echo translate('all_rights_reserved'); ?> @ 
						<a href="<?php echo base_url(); ?>">
							<?php echo $system_title; ?>
						</a> 
							| 
						<a href="<?php echo base_url(); ?>index.php/home/legal/terms_conditions" class="link">
							<?php echo translate('terms_&_condition'); ?>
						</a> 
							| 
						<a href="<?php echo base_url(); ?>index.php/home/legal/privacy_policy" class="link">
							<?php echo translate('privacy_policy'); ?>
						</a>
					</div>
				</div>
				<div class="col-md-4 hidden-xs hidden-sm">
					<div class="payments" style="font-size: 30px;">
						<ul>
							<li><i class="fa fa-cc-paypal cards"></i></li>
							<li><i class="fa fa-cc-visa cards"></i></li>
							<li><i class="fa fa-cc-mastercard cards"></i></li>
							<li><i class="fa fa-cc-discover cards"></i></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<style>
.link:hover{
	text-decoration:underline;
}
</style>