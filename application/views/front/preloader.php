<link href="<?php echo base_url(); ?>template/front/preloader/css/Icomoon/style.css" rel="stylesheet" type="text/css" />
<?php 
	if(isset($from_admin)){
?>
	<!--jQuery [ REQUIRED ]-->
	<script src="<?php echo base_url(); ?>template/back/js/jquery-2.1.1.min.js"></script>
    <style>
		#loading{
			zoom:.4;	
		}
		body{
			margin-left:0px !important;	
		}
	</style>
<?php
	} else {
?>
<script type="text/javascript">
	//$(window).load(function() {
	$(document).ready(function(e) {
		$("#loading").delay(500).fadeOut(500);
		$("#loading-center").click(function() {
			$("#loading").fadeOut(500);
		});
		setTimeout(function(){ load_iamges(); }, 1000);	
		
	});
</script>
<?php
	}
?>
<?php 
	$preloader_bg	=  $this->db->get_where('general_settings',array('type' => 'preloader_bg'))->row()->value;
	$preloader_obj	=  $this->db->get_where('general_settings',array('type' => 'preloader_obj'))->row()->value;
	//$preloader_obj	=  'rgba(79,102,42,1)';
	if(!isset($from_admin)){
		$preloader		=  $this->db->get_where('general_settings',array('type' => 'preloader'))->row()->value;
	}
	include 'preloader/'.$preloader.'.php'; 
?>
<style>

#loading{
	background-color: <?php echo $preloader_bg; ?>;
	height: 100%;
	width: 100%;
	position: fixed;
	z-index: 1050;
	margin-top: 0px;
	top: 0px;
}
</style>
