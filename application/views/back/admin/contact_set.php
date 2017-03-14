<div class="col-md-12 col-sm-12">
    <div class="panel">
		<?php 
            $contact_address =  $this->db->get_where('general_settings',array('type' => 'contact_address'))->row()->value;
            $contact_phone =  $this->db->get_where('general_settings',array('type' => 'contact_phone'))->row()->value;
            $contact_email =  $this->db->get_where('general_settings',array('type' => 'contact_email'))->row()->value;
            $contact_website =  $this->db->get_where('general_settings',array('type' => 'contact_website'))->row()->value;
            $contact_about =  $this->db->get_where('general_settings',array('type' => 'contact_about'))->row()->value;
            $lat_lang =  $this->db->get_where('general_settings',array('type' => 'contact_lat_lang'))->row()->value;
        ?>
        <script>
             $("a[href='#demo-contact']").on('shown.bs.tab', function(e) {
                  //set_cart_map();
             });
        </script>
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo translate('contact_page');?></h3>
        </div>
        <?php
            echo form_open(base_url() . 'index.php/admin/general_settings/contact', array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => '',
                'enctype' => 'multipart/form-data'
            ));
        ?>
            <div class="panel-body">
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="demo-hor-inputemail">
                        <?php echo translate('contact_address'); ?>
                    </label>
                    <div class="col-sm-8">
                        <div class="col-sm-">
                            <input type="text" name="contact_address" value="<?php echo $contact_address; ?>" class="form-control" >
                        </div>
                    </div>
                </div>
            
                
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="demo-hor-inputemail">
                        <?php echo translate('contact_phone'); ?>
                    </label>
                    <div class="col-sm-8">
                        <div class="col-sm-">
                            <input type="text" name="contact_phone" value="<?php echo $contact_phone; ?>" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="demo-hor-inputemail">
                        <?php echo translate('contact_email'); ?>
                    </label>
                    <div class="col-sm-8">
                        <div class="col-sm-">
                            <input type="text" name="contact_email" value="<?php echo $contact_email; ?>" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="demo-hor-inputemail">
                        <?php echo translate('contact_website'); ?>
                    </label>
                    <div class="col-sm-8">
                        <div class="col-sm-">
                            <input type="text" name="contact_website" value="<?php echo $contact_website; ?>" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="demo-hor-inputemail">
                        <?php echo translate('contact_about'); ?>
                    </label>
                    <div class="col-sm-8">
                        <div class="col-sm-">
                            <textarea class="summernotes" data-height='400' data-name='contact_about'><?php echo $contact_about; ?></textarea>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="panel-footer text-right">
                <span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
                    <?php echo translate('save');?>
                </span>
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
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