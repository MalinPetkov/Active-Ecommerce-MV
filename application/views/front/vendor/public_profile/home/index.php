<input type="hidden" id="vendor_id" value="<?php echo $vendor_id ?>"/>

<section class="page-section">
    <div class="container">
    	<div class="row">
            <div class="col-md-12">
                <div id="slider">
                
                </div>
            </div>
       	</div>             
    </div>
</section>

<!-- PAGE WITH SIDEBAR -->
<section class="page-section">
	<div class="container">
		<div class="row">
			<!-- CONTENT -->
			<div class="content" id="content">
				<?php 
					include 'featured_product.php';
				?>
				<!-- /shop-sorting -->
				<?php include 'category.php'; ?>

			</div>
			<!-- /CONTENT -->
		</div>
	</div>
</section>
<!-- /PAGE WITH SIDEBAR -->
<script>
$(document).ready(function(){
	get_slider();
});
function get_slider(){
	var id = $('#vendor_id').val();
	$('#slider').load(
		"<?php echo base_url()?>index.php/home/vendor_profile/get_slider/"+id,
		function(){
			var mainSliderSizeNew = $('#main-slider').find('.item').size();
            $('#main-slider').owlCarousel({
					//items: 1,
					autoplay: true,
					autoplayHoverPause: false,
					loop: mainSliderSizeNew > 1 ? true : false,
					margin: 0,
					dots: true,
					nav: true,
					navText: [
						"<i class='fa fa-angle-left'></i>",
						"<i class='fa fa-angle-right'></i>"
					],
					responsiveRefreshRate: 100,
					responsive: {
						0: {items: 1},
						479: {items: 1},
						768: {items: 1},
						991: {items: 1},
						1024: {items: 1}
					}
            });
		}
	);
}
</script>