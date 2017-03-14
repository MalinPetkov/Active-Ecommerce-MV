<div class="row products grid">
    <?php
        foreach ($products as $row) {
    ?>
    <div class="col-md-4 col-sm-6 col-xs-6">
        <?php echo $this->html_model->product_box($row,'grid', '1'); ?>
    </div>
    <?php
        }
    ?>
</div>
<div class="pagination-wrapper">
    <?php echo $this->ajax_pagination->create_links(); ?>
</div>
<!-- /Pagination -->
<script>
$(document).ready(function(){
	set_product_box_height();
	$('[data-toggle="tooltip"]').tooltip();
});

function set_product_box_height(){
	var max_img = 0;
	$('.products .media img').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_img){
			max_img = current_height;
		}
    });
	$('.products .media img').css('height',max_img);
	
	var max_title=0;
	$('.products .caption-title').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_title){
			max_title = current_height;
		}
    });
	$('.products .caption-title').css('height',max_title);
}
</script>