<?php
	$paypal_set= $this->db->get_where('business_settings', array(
		'type' => 'paypal_set'
	))->row()->value;
	$cash_set = $this->db->get_where('business_settings', array(
		'type' => 'cash_set'
	))->row()->value;
	$stripe_set = $this->db->get_where('business_settings', array(
		'type' => 'stripe_set'
	))->row()->value;
	$c2_set= $this->db->get_where('business_settings', array(
        'type' => 'c2_set'
    ))->row()->value;

	$monthly_set = $this->db->get_where('business_settings', array(
        'type' => 'monthly_set'
    ))->row()->value;



	$direct_seller = $this->db->get_where('business_settings', array(
        'type' => 'direct_seller'
    ))->row()->value;



?>          
<div id="content-container">
    <div id="page-title">
    	<center>
        	<h1 class="page-header text-overflow">
				<?php echo translate('manage_activation')?>
            </h1>
        </center>
    </div>
	<div class="row">
    		<div class="col-md-12">


<div class="col-md-12">
                    <div class="panel panel-bordered panel-dark">
                        <div class="panel-heading">
                            <center>
                                <h3 class="panel-title"><?php echo translate('Commision / Montly Related')?></h3>
                            </center>
                        </div>
                        <div class="panel-body" style="background:#fffffb;">
                            <div class="col-md-4">
                                <div class="panel">
                                    <div class="panel-heading bg-white">
                                        <center>
                                            <h4 class="panel-title">
                                                <?php echo translate('Commision / Monthly Activation')?>
                                            </h4>
                                        </center>
                                    </div>
                        
                                    <!--Panel body-->
                                    <div class="panel-body">
                                       <div class="form-group">
                                           <div class="col-sm-4 col-sm-offset-5">


 <input class='aiz_switchery1' type="checkbox" name="monthly_set" id="id2"									data-set='monthly_set'  value="ok"
                                                        data-id='' 
                                                            data-tm='<?php echo translate('Monthly Activated'); ?>' 
                                                                data-fm='<?php echo translate('Commission Activated'); ?>'
                                                                    <?php if($monthly_set == 'ok'){ ?>checked<?php } ?> />


                                           </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" id="area_direct_seller"  <?php if($monthly_set == 'no'){ ?>style="display:none"<?php } ?>>
                                <div class="panel">
                                    <div class="panel-heading bg-white">
                                        <center>
                                            <h4 class="panel-title">
                                                <?php echo translate('Direct Admin / Direct Seller')?>
                                            </h4>
                                        </center>
                                    </div>
                        
                                    <!--Panel body-->
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-5">
                                             <input class='aiz_switchery1' type="checkbox" name="direct_seller" id="id2"									data-set='direct_seller'  value="ok"
                                                        data-id='' 
                                                            data-tm='<?php echo translate('Direct Seller Activated'); ?>' 
                                                                data-fm='<?php echo translate('Direct Admin Activated'); ?>'
                                                                    <?php if($direct_seller == 'ok'){ ?>checked<?php } ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-12">
                    <div class="panel panel-bordered panel-dark">
                        <div class="panel-heading">
                            <center>
                                <h3 class="panel-title"><?php echo translate('business_related')?></h3>
                            </center>
                        </div>
                        <div class="panel-body" style="background:#fffffb;">
                            <div class="col-md-4">
                                <div class="panel">
                                    <div class="panel-heading bg-white">
                                        <center>
                                            <h4 class="panel-title">
                                                <?php echo translate('physical_product_activation')?>
                                            </h4>
                                        </center>
                                    </div>
                        
                                    <!--Panel body-->
                                    <div class="panel-body">
                                       <div class="form-group">
                                           <div class="col-sm-4 col-sm-offset-5">
                                               <input class='aiz_switchery1' type="checkbox" 
                                                    data-set='physical_product_set' 
                                                        data-id='68'
                                                            data-tm='<?php echo translate('physical_product_enabled'); ?>' 					       	data-fm='<?php echo translate('physical_product_disabled'); ?>' 
                                                                <?php if($this->crud_model->get_type_name_by_id('general_settings','68','value') == 'ok'){ ?>checked<?php } ?> />
                                           </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel">
                                    <div class="panel-heading bg-white">
                                        <center>
                                            <h4 class="panel-title">
                                                <?php echo translate('digital_product_activation')?>
                                            </h4>
                                        </center>
                                    </div>
                        
                                    <!--Panel body-->
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-5">
                                               <input class='aiz_switchery1' type="checkbox" 
                                                    data-set='digital_product_set' 
                                                        data-id='69'
                                                            data-tm='<?php echo translate('digital_product_enabled'); ?>' 					              			data-fm='<?php echo translate('digital_product_disabled'); ?>' 
                                                                <?php if($this->crud_model->get_type_name_by_id('general_settings','69','value') == 'ok'){ ?>checked<?php } ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="panel">
                                    <div class="panel-heading bg-white">
                                        <center>
                                            <h4 class="panel-title">
                                                <?php echo translate('vendor_system_activation')?>
                                            </h4>
                                        </center>
                                    </div>
                        
                                    <!--Panel body-->
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-5">
                                               <input class='aiz_switchery1' type="checkbox" 
                                                        data-set='vendor_set' 
                                                            data-id='58'
                                                                data-tm='<?php echo translate('vendor_system_enabled'); ?>' 					              			data-fm='<?php echo translate('vendor_system_disabled'); ?>' 
                                                                    <?php if($this->crud_model->get_type_name_by_id('general_settings','58','value') == 'ok'){ ?>checked<?php } ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-bordered panel-dark">
                        <div class="panel-heading">
                            <center>
                                <h3 class="panel-title"><?php echo translate('payment_related')?></h3>
                            </center>
                        </div>
                        <div class="panel-body" style="background:#fffffb;">
                            <div class="col-md-3">
                                <div class="panel">
                                    <div class="panel-heading bg-white">
                                        <center>
                                            <h4 class="panel-title">
                                                <?php echo translate('paypal_payment_activation')?>
                                            </h4>
                                        </center>
                                    </div>
                        
                                    <!--Panel body-->
                                    <div class="panel-body">
                                       <div class="form-group">
                                           <div class="col-sm-4 col-sm-offset-5">
                                               <input class='aiz_switchery1' type="checkbox" name="paypal_set" id="id2"								data-set='paypal_set'  value="ok"
                                                        data-id='' 
                                                            data-tm='<?php echo translate('paypal_payment_enabled'); ?>' 
                                                                data-fm='<?php echo translate('paypal_payment_disabled'); ?>'
                                                                    <?php if($paypal_set == 'ok'){ ?>checked<?php } ?> />
                                           </div>
                                       </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel">
                                    <div class="panel-heading bg-white">
                                        <center>
                                            <h4 class="panel-title">
                                                <?php echo translate('stripe_payment_activation')?>
                                            </h4>
                                        </center>
                                    </div>
                        
                                    <!--Panel body-->
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-5">
                                               <input class='aiz_switchery1' type="checkbox" name="stripe_set" id="id2"									data-set='stripe_set'  value="ok"
                                                        	data-id='' 
                                                            	data-tm='<?php echo translate('stripe_payment_enabled'); ?>' 
                                                                	data-fm='<?php echo translate('stripe_payment_disabled'); ?>'
                                                                    <?php if($stripe_set == 'ok'){ ?>checked<?php } ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel">
                                    <div class="panel-heading bg-white">
                                        <center>
                                            <h4 class="panel-title">
                                                <?php echo translate('twocheckout_activation')?>
                                            </h4>
                                        </center>
                                    </div>
                        
                                    <!--Panel body-->
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-5">
                                               <input class='aiz_switchery1' type="checkbox" name="c2_set" id="id2"                                 data-set='c2_set'  value="ok"
                                                            data-id='' 
                                                                data-tm='<?php echo translate('twocheckout_payment_enabled'); ?>' 
                                                                    data-fm='<?php echo translate('twocheckout_payment_disabled'); ?>'
                                                                    <?php if($c2_set == 'ok'){ ?>checked<?php } ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="panel">
                                    <div class="panel-heading bg-white">
                                        <center>
                                            <h4 class="panel-title">
                                                <?php echo translate('cash_payment_activation')?>
                                            </h4>
                                        </center>
                                    </div>
                        
                                    <!--Panel body-->
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <div class="col-sm-4 col-sm-offset-5">
                                               <input class='aiz_switchery1' type="checkbox" name="cash_set" id="id2"									data-set='cash_set'  value="ok"
                                                        data-id='' 
                                                            data-tm='<?php echo translate('cash_payment_enabled'); ?>' 
                                                                data-fm='<?php echo translate('cash_payment_disabled'); ?>'
                                                                    <?php if($cash_set == 'ok'){ ?>checked<?php } ?> />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<style>
.bg-white{
	background:#ffffff !important;
	color:#000 !important;
}
</style>
<script src="<?php echo base_url(); ?>template/back/js/custom/business.js"></script>
<script>
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'business_settings';
	var list_cont_func = '';
	var dlt_cont_func = '';

	$(document).ready(function(e) {
		set_switchery1();
	});
	function set_switchery1(){
		$(".aiz_switchery1").each(function(){
			new Switchery($(this).get(0), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});


if($(this).data('set') == 'monthly_set'){

//alert($(this).val());

}



			var changeCheckbox = $(this).get(0);
			var false_msg = $(this).data('fm');
			var true_msg = $(this).data('tm');
			changeCheckbox.onchange = function() {

if($(this).data('set') == 'monthly_set'){

if(changeCheckbox.checked == false){

$('#area_direct_seller').css('display','none');

}

else{
$('#area_direct_seller').css('display','block');

}

}


				$.ajax({url: base_url+'index.php/admin/business_settings/'+$(this).data('set')+'/'+$(this).data('id')+'/'+changeCheckbox.checked, 
				success: function(result){	
				  if(changeCheckbox.checked == true){
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : true_msg,
						container : 'floating',
						timer : 3000
					});
					sound('published');
				  } else {
					$.activeitNoty({
						type: 'danger',
						icon : 'fa fa-check',
						message : false_msg,
						container : 'floating',
						timer : 3000
					});
					sound('unpublished');
				  }
				}});
			};
		});
	}
	
</script>
