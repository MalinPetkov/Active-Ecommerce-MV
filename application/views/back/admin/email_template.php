<div id="content-container"> 
    <div id="page-title">
        <h1 class="page-header text-overflow"></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="tab-base tab-stacked-left">
                <ul class="nav nav-tabs">
                <?php
					$i=0;
                	foreach($table_info as $row1){
						$i++;
				?>
                    <li class="template_tab <?php if($i==1){ ?>active<?php } ?>">
                        <a data-toggle="tab" href="#demo-stk-lft-tab-<?php echo $row1['email_template_id']; ?>"><?php echo translate($row1['title']);?></a>
                    </li>
                <?php
					}
				?>
                </ul>

                <div class="tab-content bg_grey">
                <?php
					$j=0;
                	foreach($table_info as $row2){
						$j++;
				?>	
                    <div id="demo-stk-lft-tab-<?php echo $row2['email_template_id']; ?>" class="tab-pane fade <?php if($j==1){ ?>active in<?php } ?>">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo translate($row2['title']);?></h3>
                            </div>
							<?php
                                echo form_open(base_url() . 'index.php/admin/email_template/update/'.$row2['email_template_id'], array(
                                    'class' => 'form-horizontal',
                                    'method' => 'post',
                                    'id' => '',
                                    'enctype' => 'multipart/form-data'
                                ));
                            ?>
                                <div class="panel-body">
                                	<div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo translate('subject');?></label>
                                        <div class="col-sm-6">
                                            <input type="text" name="subject" value="<?php echo $row2['subject']; ?>"  class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo translate('email_body');?></label>
                                        <div class="col-sm-6">
                                            <textarea class="summernotes" data-height='500' data-name='body' ><?php echo $row2['body']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"></label>
                                        <div class="col-sm-6" style="color:#C00;">
                                        	**<?php echo translate('N.B');?> : <?php echo translate('do_not_change_the_variables_like');?> [[ ____ ]].
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-right">
                                    <span class="btn btn-success btn-labeled fa fa-check submitter"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>'>
                                        <?php echo translate('update');?>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php
					}
				?>    
                </div>
            </div>
        </div>
    </div>
</div>
<div style="display:none;" id="site"></div>
<!-- for logo settings -->
<script>
    var base_url = '<?php echo base_url(); ?>'
    var user_type = 'admin';
    var module = 'logo_settings';
    var list_cont_func = 'show_all';
    var dlt_cont_func = 'delete_logo';
	
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

	$(document).ready(function() {
		$("form").submit(function(e){
			return false;
		});
	
	});
</script>
