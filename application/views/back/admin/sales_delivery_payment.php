<div>
	<?php
        echo form_open(base_url() . 'index.php/admin/sales/delivery_payment_set/' . $sale_id, array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'delivery_payment',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">
			<?php
                if($payment_status !== ''){
            ?>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('payment_status'); ?></label>
                        <div class="col-sm-6">
                        <?php
                            if($payment_type == 'cash_on_delivery'){
                        ?>
                            <?php
                                $from = array('due','paid');
                                echo $this->crud_model->select_html($from,'payment_status','','edit','demo-chosen-select',$payment_status);
                            ?>	
                        <?php
                            } else if($payment_type == 'paypal' || $payment_type == 'stripe' || $payment_type == 'c2'){
                        ?>
                            <input type="text" class="form-control" name="payment_status" value="<?php echo $payment_status; ?>" readonly />
                        <?php
                            }
                        ?>
                        </div>
                </div>
            <?php
            	}
            ?>
			<?php
                if($delivery_status !== ''){
            ?>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('delivery_status'); ?></label>
                    <div class="col-sm-6">
                        <?php
                            $from = array('pending','on_delivery','delivered');
                            echo $this->crud_model->select_html($from,'delivery_status','','edit','demo-chosen-select',$delivery_status);
                        ?>
                    </div>
                </div>
            <?php
            	}
            ?>
			<?php
                if($payment_status !== ''){
            ?>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-3"><?php echo translate('payment_details'); ?></label>
                <div class="col-sm-6">
                    <textarea name="payment_details" class="form-control" <?php if($payment_type == 'paypal' || $payment_type == 'stripe'){ ?>readonly<?php } ?> rows="10"><?php echo $payment_details; ?></textarea>
                </div>
            </div>
            <?php
            	}else{
			?>
            <center>
            	<h3><?php echo translate('no_product_from_admin'); ?></h3>
            </center>
            <script>
				$(document).ready(function(e) {
					$('.btn-purple').hide();
				});
			</script>
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

