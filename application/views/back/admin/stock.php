<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow" ><?php echo translate('manage_product_stock');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
                <div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding:10px;">
                	<button class="btn btn-dark btn-labeled fa fa-minus-square pull-right" 
                    	onclick="ajax_modal('destroy','<?php echo translate('destroy_product_entry'); ?>','<?php echo translate('add_stock_entry_taken!'); ?>','stock_destroy','')">
                        	<?php echo translate('destroy');?>
                            	</button>           
					<button class="btn btn-primary btn-labeled fa fa-plus-circle pull-right mar-rgt" 
                    	onclick="ajax_modal('add','<?php echo translate('add_product_stock'); ?>','<?php echo translate('destroy_entry_taken!'); ?>', 'stock_add', '' )">
							<?php echo translate('create_stock');?>
                            	</button>
                </div>
				<!-- LIST -->
				<div class="tab-pane fade active in" id="list" style="border:1px solid #ebebeb; border-radius:4px;">
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script>
	var base_url 		= '<?php echo base_url(); ?>'
	var user_type 		= 'admin';
	var module 			= 'stock';
	var list_cont_func  = 'list';
	var dlt_cont_func 	= 'delete';
</script>


