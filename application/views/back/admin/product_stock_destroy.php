<div>
    <?php
		echo form_open(base_url() . 'index.php/admin/stock/do_destroy/', array(
			'class' => 'form-horizontal',
			'method' => 'post',
			'id' => 'destroy_stock',
			'enctype' => 'multipart/form-data'
		));
	?>
        <div class="panel-body">

            <input type="hidden" name="product" value="<?php echo $product; ?>">
            <input type="hidden" name="category" value="<?php echo $this->crud_model->get_type_name_by_id('product',$product,'category'); ?>">
            <input type="hidden" name="sub_category" value="<?php echo $this->crud_model->get_type_name_by_id('product',$product,'sub_category'); ?>" >

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('current_quantity');?></label>
                <div class="col-sm-6">
                    <input type="number" disabled value="<?php echo $this->crud_model->get_type_name_by_id('product',$product,'current_stock'); ?>" class="form-control totals" >
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('quantity');?></label>
                <div class="col-sm-6">
                    <input type="number" name="quantity" min="0" id="quantity" class="form-control totals required">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-3"><?php echo translate('monetary_loss');?></label>
                <div class="col-sm-6">
                    <input type="number" name="total" value="0" class="form-control totals required">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-4"><?php echo translate('reason_note');?></label>
                <div class="col-sm-6">
                    <textarea name="reason_note" class="form-control" rows="3"></textarea>
                </div>
            </div>
        </div>
    </form>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    });


	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>

