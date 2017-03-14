<?php
echo form_open(base_url() . 'index.php/home/cart_finish/go', array(
            'method' => 'post', 
            'enctype' => 'multipart/form-data', 
            'id' => 'cart_form' 
        )
    );
?>
<script src="https://checkout.stripe.com/checkout.js"></script>
<!-- PAGE -->
<section class="page-section color">
    <div class="container box_shadow">

        <h3 class="block-title alt">
            <i class="fa fa-angle-down"></i>
            <?php echo translate('1');?>. 
            <?php echo translate('orders');?>
        </h3>
        <div class="row orders">

        </div>

        <h3 class="block-title alt">
            <i class="fa fa-angle-down"></i>
            <?php echo translate('2');?>. 
            <?php echo translate('delivery_address');?>
        </h3>
        <div action="#" class="form-delivery delivery_address">
        </div>

        <h3 class="block-title alt">
            <i class="fa fa-angle-down"></i>
            <?php echo translate('3');?>. 
            <?php echo translate('payments_options');?>
        </h3>
        <div class="panel-group payments-options" id="accordion" role="tablist" aria-multiselectable="true">
        </div>

        <div class="overflowed">
            <a class="btn btn-theme-dark" href="<?php echo base_url(); ?>index.php/home/cancel_order">
                <?php echo translate('cancel_order');?>
            </a>
            <span class="btn btn-theme pull-right disabled" id="order_place_btn" onclick="cart_submission();">
                <?php echo translate('place_order');?>
            </span>
        </div>
    </div>
</section>
<!-- /PAGE -->
</form>
<script>       
    $(document).ready(function(){ 
		var top = Number(200);  
		$('.orders').html('<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');                
        var state = check_login_stat('state');
        state.success(function (data) {
            if(data == 'hypass'){
                load_orders();
            } else {
                signin();
            }
        });
    });

    function load_orders(){
		var top = Number(200);
		$('.orders').html('<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $('.orders').load('<?php echo base_url(); ?>index.php/home/cart_checkout/orders');
    }

    function load_address_form(){

		var top = Number(200);
		$('.delivery_address').html('<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
		
        $('.delivery_address').load('<?php echo base_url(); ?>index.php/home/cart_checkout/delivery_address',
            function(){
                var top_off = $('.header').height();
                $('.selectpicker').selectpicker();
                $('html, body').animate({
                    scrollTop: $(".delivery_address").offset().top-(2*top_off)
                }, 1000);
            }
        );
    }

    function load_payments(){
		$('#order_place_btn').removeClass('disabled')
        var okay = 'yes';
        var sel = 'no';
        $('.delivery_address').find('.required').each(function(){
            if($(this).is('select') || $(this).is('input')){
                //alert($(this).val());
                if($(this).val() == ''){
                    okay = 'no';
                    if($(this).is('select')){
                        $(this).closest('.form-group').find('.selectpicker').focus();
                    } else {
                        if(sel == 'no'){
                            $(this).focus();
                        }
                    }

                    //alert(okay);
                    //$(this).css('background','red');
                }
            }
        });
        if(okay == 'yes'){			
			var top = Number(200);
			$('.payments-options').html('<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');				
            $('.payments-options').load('<?php echo base_url(); ?>index.php/home/cart_checkout/payments_options',
                function(){
                    var top_off = $('.header').height();
                    $('html, body').animate({
                        scrollTop: $(".payments-options").offset().top-(2*top_off)
                    }, 1000);
                }
            );
        } else {              
            var top_off = $('.header').height();              
            $('html, body').animate({
                scrollTop: $(".delivery_address").offset().top-(2*top_off)
            }, 1000);
        }
    }

    function radio_check(id){
        $( "#visa" ).prop( "checked", false );
        $( "#mastercardd" ).prop( "checked", false );
        $( "#mastercard" ).prop( "checked", false );
        $( "#"+id ).prop( "checked", true );
    }
	
</script>



