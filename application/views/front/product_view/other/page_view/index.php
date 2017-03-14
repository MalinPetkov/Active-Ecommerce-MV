<link rel="stylesheet" href="<?php echo base_url(); ?>template/front/js/share/jquery.share.css">
<script src="<?php echo base_url(); ?>template/front/js/share/jquery.share.js"></script>
<?php
	foreach($product_details as $row){
		include 'product_detail.php';
		include 'product_specification.php';
		include 'related_products.php';
	}
?>