<?php
    foreach($message_data as $row)
    { 
?>
	<div>
        <?php
			echo form_open(base_url() . 'index.php/admin/contact_message/reply/' . $row['contact_message_id'], array(
				'class' => 'form-horizontal',
				'method' => 'post',
				'id' => 'contact_message_reply',
				'enctype' => 'multipart/form-data'
			));
		?>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="demo-hor-inputemail">
						<?php echo translate('reply_message');?>
                        	</label>
                    <div class="col-sm-10">
                        <textarea class="summernotes" data-height='500' data-name='reply' ></textarea>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-6">
                        <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                            onclick="ajax_set_full('view','<?php echo translate('view_contact_message'); ?>','<?php echo translate('successfully_viewed!'); ?>','contact_message_view','<?php echo $row['contact_message_id']; ?>');">
                                <?php echo translate('view_original_message');?>
                        </span>
                    </div>
                    <div class="col-md-6">
                        <span class="btn btn-success btn-md btn-labeled fa fa-reply " 
                            onclick="form_submit('contact_message_reply','<?php echo translate('successfully_replied!'); ?>')" >
                                <?php echo translate('reply');?>
                        </span>
                    </div>
                </div>
            </div>
		</form>
	</div>
<?php
    }
?>

<script>
	$(document).ready(function() {
		$("form").submit(function(e) {
			return false;
		});
	
		$('.summernotes').each(function() {
			var now = $(this);
			var h = now.data('height');
			var n = now.data('name');
			now.closest('div').append('<input type="hidden" class="val" name="' + n + '">');
			now.summernote({
				height: h,
				onChange: function() {
					now.closest('div').find('.val').val(now.code());
				}
			});
		});
	});
</script>