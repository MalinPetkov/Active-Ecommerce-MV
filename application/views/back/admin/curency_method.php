<?php 
	$curr_name = $this->db->get_where('business_settings', array(
		'type' => 'currency_name'
	))->row()->value;
	$curr      = $this->db->get_where('business_settings', array(
		'type' => 'currency'
	))->row()->value;
	$exchange  = $this->db->get_where('business_settings', array(
		'type' => 'exchange'
	))->row()->value;                 
?>
           
<div id="content-container">
    <div id="page-title">
        <center>
        	<h1 class="page-header text-overflow">
				<?php echo translate('currency_settings')?>
            </h1>
        </center>
    </div>
    <div class="row">
    	<div class="col-md-12">
            <div class="col-md-12">
            	<div class="panel panel-bordered panel-dark">
                    <div class="panel-heading">
                        <center>
                            <h3 class="panel-title"><?php echo translate('home_default_currency')?>s</h3>
                        </center>
                    </div>
                    <div class="panel-body">  
						<?php
                            echo form_open(base_url() . 'index.php/admin/set_def_curr/home', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'enctype' => 'multipart/form-data'
                            ));
                        ?>                                  
                            <div class="form-group">
                            	<label class="col-sm-3 control-label"><?php echo translate('home_default_currency');?></label>
                                <div class="col-sm-6">                              
                                    <?php 
										$home_def_curr = $this->db->get_where('business_settings', array('type' => 'home_def_currency'))->row()->value;
										echo $this->crud_model->select_html('currency_settings','home_def_currency','name','edit','demo-chosen-select required',$home_def_curr,'status','ok'); 
									?>
                                </div>
                                <div class="col-sm-3">  
                                	<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left saver" data-ing="<?php echo translate('saving'); ?>.."><?php echo translate('save');?></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            	<div class="panel panel-bordered panel-dark">
                    <div class="panel-heading">
                        <center>
                            <h3 class="panel-title"><?php echo translate('system_default_currency')?>s</h3>
                        </center>
                    </div>
                    <div class="panel-body">  
						<?php
                            echo form_open(base_url() . 'index.php/admin/set_def_curr/system', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'enctype' => 'multipart/form-data'
                            ));
                        ?>                                  
                            <div class="form-group">
                            	<div class="col-sm-3"> 
                                </div>
                            	<div class="col-sm-9"> 
                                	** Changing <b>System Default Currency</b> will require changing all <b>Product Price</b> & <b>Vendor Package Price</b> Values.
                                </div>
                            	<label class="col-sm-3 control-label"><?php echo translate('system_default_currency');?></label>
                                <div class="col-sm-6">                              
                                    <?php 
										$system_def_curr = $this->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
										echo $this->crud_model->select_html('currency_settings','currency','name','edit','demo-chosen-select required',$system_def_curr,'status','ok'); 
									?>
                                </div>
                                <div class="col-sm-3">  
                                	<span class="btn btn-success btn-md btn-labeled fa fa-upload pull-left saver" data-ing="<?php echo translate('saving'); ?>.."><?php echo translate('save');?></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="panel panel-bordered panel-dark">
                        <div class="panel-heading">
                            <center>
                                <h3 class="panel-title"><?php echo translate('all_currencies')?></h3>
                            </center>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped table-bordered table-list" style="margin-bottom:0px !important">
                              <thead>
                                <tr>
                                    <th><center><?php echo translate('currency_name')?></center></th>
                                    <th><center><?php echo translate('currency_symbol')?></center></th>
                                    <th><center> 1 U.S Dollar ($) =  </center></th>
                                    <?php
										$currency_id = $this->db->get_where('business_settings', array('type' => 'currency'))->row()->value;
                                    	$system_def_curr_name = $this->db->get_where('currency_settings',array('currency_settings_id'=>$currency_id))->row()->name;
										$system_def_curr_symbol = $this->db->get_where('currency_settings',array('currency_settings_id'=>$currency_id))->row()->symbol;
										$system_def_curr_code = $this->db->get_where('currency_settings',array('currency_settings_id'=>$currency_id))->row()->code;
									?>
                                    <th><center>1 <?php echo $system_def_curr_name; ?> (<?php echo $system_def_curr_symbol; ?>) =  ) </center></th>
                                    <th><center><?php echo translate('status')?></center></th>
                                    <th><center><?php echo translate('options')?></center></th>
                                </tr> 
                              </thead>
                              <tbody>
                                  <?php
                                      $currency= $this->db->get('currency_settings')->result_array();
                                      foreach($currency as $row){
                                  ?>
                                  
                                      <tr>
                                      <?php
                                            echo form_open(base_url().'index.php/admin/currency_settings/set_rate/', 
                                            array(
                                                'class' => 'form-horizontal',
                                                'method' => 'post',
                                                'id' => 'test_'.$row['currency_settings_id'],
                                                'enctype' => 'multipart/form-data'
                                            ));
                                       ?>
                                        <td align="center">
                                            <?php 
                                                if($row['currency_settings_id'] !== '27'){
                                                	echo $row['name'];
                                                } else {
											?>		
												<input type="text" name="name" value="<?php echo $row['name']?>"  class="form-control required">
                                            <?php
												}
                                                if($row['currency_settings_id'] == $currency_id){
                                            ?>
                                                (<?php echo translate('default'); ?>)
                                            <?php
												}
                                            ?>
                                        </td>
                                        <td align="center">                                        
                                            <?php                        	
                                                if($row['currency_settings_id'] !== '27'){
													echo $row['symbol'];
												} else {
											?>	
												<input type="text" name="symbol" value="<?php echo $row['symbol']?>"  class="form-control required">
                                            <?php
												}
											?>
                                        </td>
                                        <td>
                                            <?php                                             	
                                                if($row['currency_settings_id'] !== '1'){
                                            ?>
                                            <div class="col-sm-12">
                                                <div class="col-sm-5 col-sm-offset-2">
                                                    <input type="number" name="exchange" value="<?php echo $row['exchange_rate']?>"  class="form-control required valto">
                                                </div>
                                                <div class="col-sm-3" style="padding-left: 0px !important;padding-right: 0px !important">
                                                    
												<?php                        	
                                                    if($row['currency_settings_id'] !== '27'){
                                                ?>
                                                    <span class="btn btn-sm btn-info sync" 
                                                        data-ing='<?php echo translate('syncing..'); ?>' data-msg='<?php echo translate('!'); ?>' data-code="<?php echo $row['code']?>" data-fcode="USD" >
                                                            <?php echo translate('sync');?>
                                                    </span>
                                                </div>
                                                <?php 
													}
												?>
                                            </div>	
                                            <?php 
												}
											?>			
                                        </td>
                                        <td>
                                            <?php                                             	
                                                if($row['currency_settings_id'] !== $currency_id){
                                            ?>
                                            <div class="col-sm-12">
                                                <div class="col-sm-5 col-sm-offset-2">
                                                    <input type="number" name="exchange_def" value="<?php echo $row['exchange_rate_def']?>"  class="form-control required valto_def">
                                                </div>
                                                <div class="col-sm-3" style="padding-left: 0px !important;padding-right: 0px !important">
												<?php                        	
                                                    if($row['currency_settings_id'] !== '27' && $currency_id !== '27'){
                                                ?>
                                                    <span class="btn btn-sm btn-info sync_def" 
                                                        data-ing='<?php echo translate('syncing..'); ?>' data-msg='<?php echo translate('!'); ?>' data-code="<?php echo $row['code']?>" data-fcode="<?php echo $system_def_curr_code; ?>" >
                                                            <?php echo translate('sync');?>
                                                    </span>
                                                <?php 
													}
												?>
                                                </div>
                                            </div>
                                            <?php
                                                }
                                            ?>					
                                        </td>
                                        <td align="center">
                                            <?php                        	
                                                if($row['currency_settings_id'] !== $currency_id){
                                            ?>
                                            <input class='aiz_switchery' type="checkbox" 
                                                data-set='cur_set' 
                                                    data-id='<?php echo $row['currency_settings_id']; ?>'
                                                        data-tm='<?php echo translate('currency_published'); ?>' 					                                            data-fm='<?php echo translate('currency_unpublished'); ?>' 
                                                            <?php if($row['status'] == 'ok'){ ?>checked<?php } ?> />
                                            <?php
                                                }
                                            ?>	
                                        </td>
                                        <td align="center">
                                            <span class="btn btn-sm btn-success submitter1" 
                                                data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('exchange_rate_updated'); ?>' data-id="<?php echo  $row['currency_settings_id']; ?>" >
                                                    <?php echo translate('save');?>
                                            </span>
                                        </td>
                                        </form>
									  <?php 
                                          }
                                      ?>
                              	</tr>
                              </tbody>
                            </table>
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
<script>
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'business_settings';
	var list_cont_func = '';
	var dlt_cont_func = '';
</script>
<script>
$(document).ready(function(e) {
	$("body").on('click','.saver',function(){
		var here = $(this); // alert div for show alert message
		var text = here.html(); // alert div for show alert message
		var form = here.closest('form');
		var submitting = here.data('ing');
		//var form = $(this);
		var formdata = false;
		if (window.FormData){
			formdata = new FormData(form[0]);
		}
		$.ajax({
			url: form.attr('action'), // form action url
			type: 'POST', // form submit method get/post
			dataType: 'html', // request type html/json/xml
			data: formdata ? formdata : form.serialize(), // serialize form data 
			cache       : false,
			contentType : false,
			processData : false,
			beforeSend: function() {
				here.addClass('disabled');
				here.html(submitting); // change submit button text
			},
			success: function(data) {
				here.fadeIn();
				here.html(text);
				here.removeClass('disabled');
				var loc = location.href;
				location.replace(loc);
			},
			error: function(e) {
				console.log(e)
			}
		});
	});
	
    $('.sync').on('click', function(){
		var btn=$(this);
		var ing = btn.data('ing');
		var msg = btn.data('msg');
		var id = btn.data('code');
		var prv = btn.html();
		$.ajax({
			url: 'http://api.fixer.io/latest?base=USD&symbols='+id, // form action url
			type: 'GET', // form submit method get/post
			dataType: 'html', // request type html/json/xml
			cache       : false,
			contentType : false,
			processData : false,
			beforeSend: function() {
				btn.html(ing)
			},
			success: function(data) {
				var parsed = JSON.parse(data);
				var val = parsed['rates'][id];
				btn.closest('tr').find('.valto').val(val);				
				setTimeout(function(){ 
					btn.closest('tr').find('.submitter1').click();
				}, 500);
				
				btn.fadeIn();
				btn.html(prv);
			},
			error: function(e) {
				console.log(e)
			}
		});
	});
	
	
	
    $('.sync_def').on('click', function(){
		var btn=$(this);
		var ing = btn.data('ing');
		var msg = btn.data('msg');
		var id = btn.data('code');
		var fid = btn.data('fcode');
		var prv = btn.html();
		$.ajax({
			url: 'http://api.fixer.io/latest?base='+fid+'&symbols='+id, // form action url
			type: 'GET', // form submit method get/post
			dataType: 'html', // request type html/json/xml
			cache       : false,
			contentType : false,
			processData : false,
			beforeSend: function() {
				btn.html(ing)
			},
			success: function(data) {
				var parsed = JSON.parse(data);
				var val = parsed['rates'][id];
				btn.closest('tr').find('.valto_def').val(val);				
				setTimeout(function(){ 
					btn.closest('tr').find('.submitter1').click();
				}, 500);
				
				btn.fadeIn();
				btn.html(prv);
			},
			error: function(e) {
				console.log(e)
			}
		});
	});
	
    $('.submitter1').on('click', function(){
		var btn=$(this);
		var ing = btn.data('ing');
		var msg = btn.data('msg');
		var id = btn.data('id');
		var prv = btn.html();
		var form = $('#test_'+id);
		var formdata = false;
		if (window.FormData){
			formdata = new FormData(form[0]);
		}
		$.ajax({
			url: form.attr('action')+id, // form action url
			type: 'POST', // form submit method get/post
			dataType: 'html', // request type html/json/xml
			data: formdata ? formdata : form.serialize(), // serialize form data 
			cache       : false,
			contentType : false,
			processData : false,
			beforeSend: function() {
				btn.html(ing)
			},
			success: function() {
				btn.fadeIn();
				btn.html(prv)
				$.activeitNoty({
					type: 'success',
					icon : 'fa fa-check',
					message : msg,
					container : 'floating',
					timer : 3000
				});
			},
			error: function(e) {
				console.log(e)
			}
		});
	});
});
function set_switchery1(){
		$(".aiz_switchery").each(function(){
			new Switchery($(this).get(0), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});

			var changeCheckbox = $(this).get(0);
			var false_msg = $(this).data('fm');
			var true_msg = $(this).data('tm');
			changeCheckbox.onchange = function() {
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
function set_switchery2(){
		$(".aiz_switchery1").each(function(){
			new Switchery($(this).get(0), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});

			var changeCheckbox = $(this).get(0);
			var false_msg = $(this).data('fm');
			var true_msg = $(this).data('tm');
			changeCheckbox.onchange = function() {
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

$(document).ready(function(){
	set_switchery1();
	set_switchery2();
});
</script>
<script src="<?php echo base_url(); ?>template/back/js/custom/business.js"></script>
