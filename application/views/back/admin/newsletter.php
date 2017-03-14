<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow" ><?php echo translate('send_newsletter')?></h1>
	</div>
	<div class="tab-base">
		<!--Tabs Content-->
		<div class="panel">
		<!--Panel heading-->
			<div class="panel-body">
				<div class="tab-content">
					<div class="tab-pane fade active in" id="lista">
						<div class="panel-body" id="demo_s">
							<?php
                                echo form_open(base_url() . 'index.php/admin/newsletter/send/', array(
                                    'class' => 'form-horizontal',
                                    'method' => 'post'
                                ));
                            ?>
		                        <div class="row">
			                        <?php
				                        $user_list = array();
				                        $subscribers_list = array();
				                        foreach ($users as $row) {
				                        	$user_list[] = $row['email'];
				                        }
				                        foreach ($subscribers as $row) {
				                        	$subscribers_list[] = $row['email'];
				                        }
			                        	$user_list = join(',',$user_list);
			                        	$subscribers_list = join(',',$subscribers_list);
			                        ?>
	                            	<h3 class="panel-title"><?php echo translate('e-mails_(users)')?></h3>
					                <div class="form-group btm_border">
					                    <div class="col-sm-12">
					                        <input type="text" name="subscribers" data-role="tagsinput" 
					                        	placeholder="<?php echo translate('e-mails_(users)')?>" class="form-control"
					                        		value="<?php echo $user_list; ?>">
					                    </div>
					                </div>
	                            	<h3 class="panel-title"><?php echo translate('e-mails_(subscribers)')?></h3>
					                <div class="form-group btm_border">
					                    <div class="col-sm-12">
					                        <input type="text" name="users" data-role="tagsinput" 
					                        	placeholder="<?php echo translate('e-mails_(subscribers)')?>" class="form-control required"
					                        		value="<?php echo $subscribers_list; ?>">
					                    </div>
					                </div>
	                            	<h3 class="panel-title"><?php echo translate('from_:_email_address')?></h3>
					                <div class="form-group btm_border">
					                    <div class="col-sm-12">
					                        <input type="email" name="from" 
                                            	placeholder="<?php echo translate('from_:_email_address')?>" class="form-control required">
					                
					                    </div>
					                </div>
	                            	<h3 class="panel-title"><?php echo translate('newsletter_subject')?></h3>
					                <div class="form-group btm_border">
					                    <div class="col-sm-12">
					                        <input type="text" name="title" 
                                            	placeholder="<?php echo translate('newsletter_subject')?>" class="form-control required">
					                    </div>
					                </div>
	                            	
	                            	<h3 class="panel-title"><?php echo translate('newsletter_content')?></h3>
	                                <textarea class="summernotes" data-height='700' data-name='text' class="required" ></textarea>

	                            </div>
	                            <div class="panel-footer text-right">
	                                <span class="btn btn-info submitter enterer"  data-ing='<?php echo translate('sending'); ?>' data-msg='<?php echo translate('sent!'); ?>'>
										<?php echo translate('send')?>
                                        	</span>
	                            </div>
	                        </form>
	                    </div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>


<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
<script>
	$(document).ready(function() {
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
			now.closest('div').find('.val').val(now.code());
		});
	});
	
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'newsletter';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
</script>