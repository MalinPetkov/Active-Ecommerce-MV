<div>
    <?php
		echo form_open(base_url() . 'index.php/vendor/stock/do_add/', array(
			'class' => 'form-horizontal',
			'method' => 'post',
			'id' => 'stock_add',
			'enctype' => 'multipart/form-data'
		));
	?>
        <div class="panel-body">

            <input type="hidden" name="product" value="<?php echo $product; ?>">
            <input type="hidden" name="category" value="<?php echo $this->crud_model->get_type_name_by_id('product',$product,'category'); ?>">
            <input type="hidden" name="sub_category" value="<?php echo $this->crud_model->get_type_name_by_id('product',$product,'sub_category'); ?>">

           
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('current_quantity');?></label>
                <div class="col-sm-6">
                    <input type="number" disabled value="<?php echo $this->crud_model->get_type_name_by_id('product',$product,'current_stock'); ?>" class="form-control totals">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('quantity');?></label>
                <div class="col-sm-6">
                    <input type="number" name="quantity" min="0" id="quantity" class="form-control totals required">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-3"><?php echo translate('rate');?></label>
                <div class="col-sm-6">
                    <input type="number" name="rate" id="rate" value="<?php echo $this->crud_model->get_type_name_by_id('product',$product,'purchase_price'); ?>" class="form-control totals">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-4"><?php echo translate('total');?></label>
                <div class="col-sm-6">
                    <input type="number" name="total" id="total" class="form-control totals">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-5"><?php echo translate('reason_note');?></label>
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
        total();
    });

    function total(){
        var total = Number($('#quantity').val())*Number($('#rate').val());
        $('#total').val(total);
    }

    $(".totals").change(function(){
        total();
    });


	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>
<div id="reserve"></div>

