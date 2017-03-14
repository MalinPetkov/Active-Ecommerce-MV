<div class="col-md-12 col-sm-12">
    <div class="panel">
		<?php 
            $footer_text =  $this->db->get_where('general_settings',array('type' => 'footer_text'))->row()->value;
            $footer_category =  $this->db->get_where('general_settings',array('type' => 'footer_category'))->row()->value;
        ?>
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo translate('footer_settings');?></h3>
        </div>
        <?php
            echo form_open(base_url() . 'index.php/admin/general_settings/footer', array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => '',
                'enctype' => 'multipart/form-data'
            ));
        ?>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="demo-hor-inputemail">
                        <?php echo translate('footer_category'); ?>
                    </label>
                    <div class="col-sm-8">
                        <?php
							$categories=json_decode($footer_category);
							$result=array();
							foreach($categories as $row){
								if($this->crud_model->if_publishable_category($row)){
									$result[]=$row;
								}
							}
						
							$physical_system   	 =  $this->crud_model->get_type_name_by_id('general_settings','68','value');
							$digital_system   	 =  $this->crud_model->get_type_name_by_id('general_settings','69','value');
							$status= '';
							$value= '';
							if($physical_system !== 'ok' && $digital_system == 'ok'){
								$status= 'digital';
								$value= 'ok';
							}
							if($physical_system == 'ok' && $digital_system !== 'ok'){
								$status= 'digital';
								$value= NULL;
							}
							if($physical_system !== 'ok' && $digital_system !== 'ok'){
								$status= 'digital';
								$value= '0';
							}
                            echo $this->crud_model->select_html('category','footer_category','category_name','edit','demo-cs-multiselect',json_encode($result),$status,$value);
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="demo-hor-inputemail">
                        <?php echo translate('footer_text'); ?>
                    </label>
                    <div class="col-sm-8">
                        <div class="col-sm-">
                            <textarea class="summernotes" data-height='400' data-name='footer_text'><?php echo $footer_text; ?></textarea>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="panel-footer text-right">
                <span class="btn btn-success btn-labeled fa fa-check submitter"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
                    <?php echo translate('save');?>
                </span>
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
	$('.demo-cs-multiselect').chosen({width:'100%'});
	
	$('.summernotes').each(function() {
		var now = $(this);
		var h = now.data('height');
		var n = now.data('name');
		now.closest('div').append('<input type="hidden" class="val" name="'+n+'">');
		now.summernote({
			height: h,
			onChange: function() {
				now.closest('div').find('.val').val(now.code());
			}
		});
		now.closest('div').find('.val').val(now.code());
		now.focus();
	});
});
</script>