<div class="row products grid">
<?php
	foreach($products as $row){
?>
    <div class="col-md-4 col-sm-6 col-xs-6">
        <?php echo $this->html_model->product_box($row, 'grid', '1'); ?>
    </div>
<?php
	}
?>
</div>
<div class="pagination-wrapper">  
	<?php echo $this->ajax_pagination->create_links();  ?>
</div>
