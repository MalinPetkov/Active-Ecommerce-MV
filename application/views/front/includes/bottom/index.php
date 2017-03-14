		<script>
            var base_url = "<?php echo base_url(); ?>";
        </script>
        <script src="<?php echo base_url(); ?>template/front/js/ajax_method.js"></script>
        <script src="<?php echo base_url(); ?>template/front/js/bootstrap-notify.min.js"></script>
        <script src="<?php echo base_url(); ?>template/front/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="<?php echo base_url(); ?>template/front/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>template/front/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>
        <!-- JS Global -->
        <script src="<?php echo base_url(); ?>template/front/plugins/superfish/js/superfish.min.js"></script>
        <script src="<?php echo base_url(); ?>template/front/plugins/jquery.sticky.min.js"></script>
        <script src="<?php echo base_url(); ?>template/front/plugins/jquery.easing.min.js"></script>
        <script src="<?php echo base_url(); ?>template/front/plugins/jquery.smoothscroll.min.js"></script>
        <script src="<?php echo base_url(); ?>template/front/plugins/smooth-scrollbar.min.js"></script>
        <script src="<?php echo base_url(); ?>template/front/plugins/jquery.cookie.js"></script>
        
        <script src="<?php echo base_url(); ?>template/front/plugins/modernizr.custom.js"></script>
        <script src="<?php echo base_url(); ?>template/front/modal/js/jquery.active-modals.js"></script>
        <script src="<?php echo base_url(); ?>template/front/js/theme.js"></script>
        
        <?php
	       include $asset_page.'.php';
		?>


        <form id="cart_form_singl">
                <input type="hidden" name="color" value="">
                <input type="hidden" name="qty" value="1">
        </form>