<?php
	$paypal    = $this->db->get_where('business_settings', array(
		'type' => 'paypal_email'
	))->row()->value;	
	$stripe_publishable = $this->db->get_where('business_settings', array(
		'type' => 'stripe_publishable'
	))->row()->value;
	$stripe_secret = $this->db->get_where('business_settings', array(
		'type' => 'stripe_secret'
	))->row()->value;
	$paypal_type= $this->db->get_where('business_settings', array(
		'type' => 'paypal_type'
	))->row()->value;
	$sp_val    = $this->db->get_where('business_settings', array(
		'type' => 'shipping_cost'
	))->row()->value;
	$sp_type   = $this->db->get_where('business_settings', array(
		'type' => 'shipping_cost_type'
	))->row()->value;
				 
	$shipment_info = $this->db->get_where('business_settings', array(
		'type' => 'shipment_info'
	))->row()->value;   
	
    $c2_user =  $this->db->get_where('business_settings', array('type' =>'c2_user' ))->row()->value;
    $c2_secret =  $this->db->get_where('business_settings', array('type' => 'c2_secret' ))->row()->value;
    $c2_type= $this->db->get_where('business_settings', array('type' => 'c2_type'))->row()->value;            	
?>            
<div id="content-container">
    <div id="page-title">
        <center>
        	<h1 class="page-header text-overflow">
				<?php echo translate('manage_payment_methods_&_shipment')?>
            </h1>
        </center>
    </div>
    <?php
		echo form_open(base_url() . 'index.php/admin/business_settings/set1/', array(
			'class'     => 'form-horizontal',
			'method'    => 'post',
			'id'        => 'gen_set',
			'enctype'   => 'multipart/form-data'
		));
	?>
    
        <div class="col-md-12">
            <div class="panel panel-bordered panel-dark">
                <div class="panel-heading">
                    <center>
                        <h3 class="panel-title"><?php echo translate('payment_methods_settings')?></h3>
                    </center>
                </div>
                <div class="panel-body" style="background:#fffffb;">
                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-heading bg-white">
                                <h4 class="panel-title"><?php echo translate('paypal_settings')?></h4>
                            </div>       
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('paypal_email');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="paypal_email" value="<?php echo $paypal; ?>" class="form-control">
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="demo-hor-inputemail">
                                        <?php echo translate('paypal_account_type');?>
                                    </label>
                                    <div class="col-sm-6">
                                        <?php
                                            $from = array('sandbox','original');
                                            echo $this->crud_model->select_html($from,'paypal_type','','edit','demo-chosen-select',$paypal_type);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-heading bg-white">
                                <h4 class="panel-title"><?php echo translate('stripe_settings')?></h4>
                            </div>
                
                            <!--Panel body-->
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('stripe_secret_key');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="stripe_secret" value="<?php echo $stripe_secret; ?>" class="form-control">
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo translate('stripe_publishable_key');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="stripe_publishable" value="<?php echo $stripe_publishable; ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel">
                            <div class="panel-heading bg-white">
                                <h4 class="panel-title"><?php echo translate('twocheckout_settings')?></h4>
                            </div>
                
                            <!--Panel body-->
                            <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo translate('user_id');?></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="c2_user" value="<?php echo $c2_user; ?>" class="form-control">
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"><?php echo translate('secret_key');?></label>
                                    <div class="col-sm-8">
                                        <input type="text" name="c2_secret" value="<?php echo $c2_secret; ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="demo-hor-inputemail">
                                        <?php echo translate('account_type');?>
                                    </label>
                                    <div class="col-sm-8">
                                        <?php
                                            $from = array('demo','original');
                                            echo $this->crud_model->select_html($from,'c2_type','','edit','demo-chosen-select',$c2_type);
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="panel panel-bordered panel-dark">
                        <div class="panel-heading">
                                    <center>
                                        <h3 class="panel-title"><?php echo translate('shipment_settings')?></h3>
                                    </center>
                                </div>
                        <div class="panel-body" style="background:#fffffb;">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('shipping_cost_type');?></label>
                                        <div class="col-sm-6">
                                            <select name="shipping_cost_type" class="demo-cs-multiselect">
                                                <option value="product_wise" 
                                                    <?php if($sp_type == 'product_wise'){ echo 'selected'; } ?> >
                                                        <?php echo translate('product_wise');?>
                                                            </option>
                                                <option value="fixed" 
                                                    <?php if($sp_type == 'fixed'){ echo 'selected'; } ?> >
                                                        <?php echo translate('fixed');?>
                                                            </option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" ><?php echo translate('shipping_cost_(If_fixed)');?> (<?php echo currency('','def'); ?>)</label>
                                        <div class="col-sm-6">
                                            <input type="text" name="shipping_cost" 
                                                value="<?php echo $sp_val; ?>" 
                                                    class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo translate('shipment_info');?></label>
                                        <div class="col-sm-6">
                                            <textarea class="summernotes" data-height="200" data-name="shipment_info" ><?php echo $shipment_info; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    	<div class="panel-footer text-right">
            <span class="btn btn-info submitter enterer" 
                data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>' >
                    <?php echo translate('save');?>
            </span>
        </div>
    </form>
</div>
<style>
.bg-white{
	background:#ffffff !important;
	color:#000 !important;
}
</style>
<script>
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'business_settings';
	var list_cont_func = '';
	var dlt_cont_func = '';
</script>

<script src="<?php echo base_url(); ?>template/back/js/custom/business.js"></script>
