
            <ul class="list-inline">
                <li class="hidden-xs">
                    <a href="<?php echo base_url(); ?>index.php/home/faq">
                        <?php echo translate('faq');?>
                    </a>
                </li>
                <?php
                    if($this->session->userdata('user_login')!='yes'){ 
                ?>
                <li class="icon-user">
                    <a href="<?php echo base_url(); ?>index.php/home/login_set/login"> 
                        <span><?php echo translate('login');?></span>
                    </a>
                </li>
                <?php
                	if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
				?>
                <li class="icon-user">
                    <a href="<?php echo base_url(); ?>index.php/home/login_set/registration">
                        <span><?php echo translate('registration');?></span>
                    </a>
                </li>
                <?php
					}else{
				?>
                <li class="dropdown currency">
                	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<?php echo translate('registration');?><i class="fa fa-angle-down"></i>
                    </a>
                	<ul role="menu" class="dropdown-menu">
                    	<li>
                            <a href="<?php echo base_url(); ?>index.php/home/login_set/registration">
                                <span><?php echo translate('customer_registration');?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>index.php/home/vendor_logup/registration">
                                <span><?php echo translate('vendor_registration');?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php
					}
				?>
                <?php } else {?>
                <li class="icon-user">
                    <a href="<?php echo base_url(); ?>index.php/home/profile/">
                        <span><?php echo translate('my_profile');?></span>
                    </a>
                </li>
                <li class="icon-user">
                    <a href="<?php echo base_url(); ?>index.php/home/profile/part/wishlist">
                        <span><?php echo translate('wishlist');?></span>
                    </a>
                </li>
                <li class="icon-user">
                    <a href="<?php echo base_url(); ?>index.php/home/logout/">
                        <span><?php echo translate('logout');?></span>
                    </a>
                </li>
                <?php }?>
            </ul>