<input type="hidden" value="<?php echo $category; ?>" id="blog_cat" />
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
                <div id="blog-content">
                </div>
            </div>
            <!-- /CONTENT -->
        </div>
    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->
<script>
	function get_blogs_by_cat(category){	
		$("#blog-content").load("<?php echo base_url()?>index.php/home/blog_by_cat/"+category);
	}
	$(document).ready(function(){
		var category=$('#blog_cat').val();
		get_blogs_by_cat(category);
    });
</script>