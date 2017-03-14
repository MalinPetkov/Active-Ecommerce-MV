<input type="hidden" value="<?php echo $vendor_id; ?>" id="vendor" />
<!-- PAGE WITH SIDEBAR -->
<section class="page-section with-sidebar">
    <div class="container">
        <div class="row">
            <!-- SIDEBAR -->
            <?php 
                include 'sidebar.php';
            ?>
            <!-- /SIDEBAR -->
            <!-- CONTENT -->
            <div class="col-md-9 content" id="content">
                <div id="featured-content">
                </div>
            </div>
            <!-- /CONTENT -->
        </div>
    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->
<script>
	function get_featured_by_vendor(id){	
		$("#featured-content").load("<?php echo base_url()?>index.php/home/vendor_featured/get_list/"+id);
	}
	$(document).ready(function(){
		var vendor=$('#vendor').val();
		get_featured_by_vendor(vendor);
    });
</script>