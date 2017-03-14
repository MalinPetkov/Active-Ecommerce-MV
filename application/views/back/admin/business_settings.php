<div id="content-container"> 
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('manage_business_settings');?></h1>
    </div>
    <div class="tab-base">
        <div class="tab-base tab-stacked-left">
            <?php
                $paypal    = $this->db->get_where('business_settings', array(
                    'type' => 'paypal_email'
                ))->row()->value;
                $paypal_set= $this->db->get_where('business_settings', array(
                    'type' => 'paypal_set'
                ))->row()->value;
                $cash_set = $this->db->get_where('business_settings', array(
                    'type' => 'cash_set'
                ))->row()->value;
                $stripe_set = $this->db->get_where('business_settings', array(
                    'type' => 'stripe_set'
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
                $curr_name = $this->db->get_where('business_settings', array(
                    'type' => 'currency_name'
                ))->row()->value;
                $curr      = $this->db->get_where('business_settings', array(
                    'type' => 'currency'
                ))->row()->value;
                $exchange  = $this->db->get_where('business_settings', array(
                    'type' => 'exchange'
                ))->row()->value;                
                $shipment_info = $this->db->get_where('business_settings', array(
                    'type' => 'shipment_info'
                ))->row()->value;              
                $faqs = json_decode($this->db->get_where('business_settings', array(
                    'type' => 'faqs'
                ))->row()->value,true);
				$c2_set =  $this->db->get_where('business_settings', array('type' =>'c2_set' ))->row()->value;
                $c2_user =  $this->db->get_where('business_settings', array('type' =>'c2_user' ))->row()->value;
                $c2_secret =  $this->db->get_where('business_settings', array('type' => 'c2_secret' ))->row()->value;
            ?>
            <div class="col-sm-12">
            <div class="panel panel-bordered-dark">
                <?php
                    echo form_open(base_url() . 'index.php/admin/business_settings/set/', array(
                        'class'     => 'form-horizontal',
                        'method'    => 'post',
                        'id'        => 'gen_set',
                        'enctype'   => 'multipart/form-data'
                    ));
                ?>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="demo-hor-inputemail"><?php echo translate('cash_payment');?></label>
                            <div class="col-sm-6">
                                <div class="col-sm-">
                                    <input id="cash_set" class='sw7' data-set='cash_set' type="checkbox" <?php if($cash_set == 'ok'){ ?>checked<?php } ?> />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="demo-hor-inputemail"><?php echo translate('paypal_payment');?></label>
                            <div class="col-sm-6">
                                <div class="col-sm-">
                                    <input id="paypal_set" class='sw8' data-set='paypal_set' type="checkbox" <?php if($paypal_set == 'ok'){ ?>checked<?php } ?> />
                                </div>
                            </div>
                        </div>

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

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="demo-hor-inputemail"><?php echo translate('stripe_payment');?></label>
                            <div class="col-sm-6">
                                <div class="col-sm-">
                                    <input id="stripe_set" class='sw7' data-set='stripe_set' type="checkbox" <?php if($stripe_set == 'ok'){ ?>checked<?php } ?> />
                                </div>
                            </div>
                        </div>

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
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo translate('currency_name');?></label>
                            <div class="col-sm-6">
                                <input type="text" name="currency_name" id='curr_n_i' value="<?php echo $curr_name; ?>" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo translate('currency_symbol');?></label>
                            <div class="col-sm-6">
                                <input type="text" name="currency" id='curr_s_i' value="<?php echo $curr; ?>" class="form-control">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label">1 U.S Dollar ($) = </label>
                            <div class="col-sm-3">
                                <input type="number" name="exchange" value="<?php echo $exchange; ?>"  class="form-control required">
                            </div>
                            <label class="col-sm-3 control-label text-left">
                                <span id='curr_n_s'><?php echo $curr_name; ?></span>
                                (<span id='curr_s_s'><?php echo $curr; ?></span>)
                            </label>
                        </div>
                        
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
                        <div class="form-group">
                            <label class="col-sm-3 control-label"><?php echo translate('FAQs');?></label>
                            <div class="col-sm-6"></div>
                        </div>
                        <div id="more_additional_fields">
                        <?php
                        //var_dump($all_af);
                            if(!empty($faqs)){
                                foreach($faqs as $row1){
                        ?> 
                            <div class="form-group btm_border">
                                <div class="col-sm-4">
                                    <input type="text" name="f_q[]" value="<?php echo $row1['question']; ?>" placeholder="<?php echo translate('question'); ?>" class="form-control" >
                                </div>
                                <div class="col-sm-5">
                                      <textarea name="f_a[]" class="form-control"  placeholder="<?php echo translate('answer'); ?>"><?php echo $row1['answer']; ?></textarea>
                                </div>
                                <div class="col-sm-2">
                                    <span class="remove_it_v btn btn-primary" onclick="delete_row(this)">X</span>
                                </div>
                            </div>
                        <?php
                                }
                            }
                        ?> 
                        </div>
                        <div class="form-group btm_border">
                            <label class="col-sm-4 control-label" for="demo-hor-17"></label>
                            <div class="col-sm-6">
                                    <div id="more_btn" class="btn btn-primary btn-labeled fa fa-plus pull-right">
                                    <?php echo translate('add_more_FAQs');?></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="panel-footer text-right">
                        <span class="btn btn-info submitter" 
                        	data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>' >
								<?php echo translate('save');?>
                        </span>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
</div>
<div style="display:none;" id="business"></div>
<script>
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'logo_settings';
	var list_cont_func = 'show_all';
	var dlt_cont_func = 'delete_logo';

    $("#more_btn").click(function(){
        $("#more_additional_fields").append(''
            +'<div class="form-group">'
            +'    <div class="col-sm-4">'
            +'        <input type="text" name="f_q[]" class="form-control"  placeholder="<?php echo translate('question'); ?>">'
            +'    </div>'
            +'    <div class="col-sm-5">'
            +'          <textarea name="f_a[]" class="form-control"  placeholder="<?php echo translate('answer'); ?>"></textarea>'
            +'    </div>'
            +'    <div class="col-sm-2">'
            +'        <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>'
            +'    </div>'
            +'</div>'
        );
    });
    function delete_row(e)
    {
        e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
    }   

</script>
<script src="<?php echo base_url(); ?>template/back/js/custom/business.js"></script>
