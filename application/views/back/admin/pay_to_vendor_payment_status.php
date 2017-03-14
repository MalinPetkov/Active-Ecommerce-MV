<div>
	<?php
        echo form_open(base_url() . 'index.php/admin/pay_to_vendor/payment_status_set/' . $vendor_invoice_id, array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'vendor_payment_status',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">
			<?php
                if($status !== ''){
            ?>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('payment_status'); ?></label>
                        <div class="col-sm-6">
                        <?php
                            if($method == 'cash'){
                        ?>
                            <?php
                                $from = array('due','paid');
                                echo $this->crud_model->select_html($from,'vendor_payment_status','','edit','demo-chosen-select',$status);
                            ?>	
                        <?php
                            } else if($method == 'paypal' || $method == 'stripe'){
                        ?>
                            <input type="text" class="form-control" name="payment_status" value="<?php echo $status; ?>" readonly />
                        <?php
                            }
                        ?>
                        </div>
                </div>
            <?php
            	}
            ?>
			
			<?php
                if($status !== ''){
            ?>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-3"><?php echo translate('payment_details'); ?></label>
                <div class="col-sm-6">
                    <textarea name="payment_details" class="form-control" <?php if($method == 'paypal' || $method == 'stripe'){ ?>readonly<?php } ?> rows="10"><?php echo $payment_details; ?></textarea>
                </div>
            </div>
            <?php
            	}
            ?>

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

