<section class="page-section color get_into">
    <div class="container">
        <div class="row margin-top-0">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="logo_top">
                    <a href="<?php echo base_url()?>">
                        <img class="img-responsive" src="<?php echo $this->crud_model->logo('home_bottom_logo'); ?>" alt="Shop" style="z-index:200">
                    </a>
                </div>
                <div class="row box_shape">
                    <div class="title" style="background:#ffffff;">
                        <?php echo translate('thanks_for_registration')?>!
                        <div class="option" style="margin-top: 15px;">
                            <?php echo translate('you_have_to_wait_for_admin_approval');?>.
                            <?php echo translate('approval_confirmation_will_be_sent_to_your_email');?>.
                            <br>
                            <?php echo translate('check_your_email');?>.
                            <?php echo translate('after_confirmation_you_can_');?>
                            <a href="<?php echo base_url();?>index.php/vendor"> 
                                <?php echo translate('login_from_here');?>
                            </a>
                            <?php echo translate('as_vendor');?>!
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>