<link href="<?php echo base_url(); ?>template/back/plugins/nestable/nestable.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>template/back/plugins/nestable/nestable.js"></script>
<div>
	<?php
        echo form_open(base_url() . 'index.php/admin/slider/do_serial/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'slider_serial',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">
    		<textarea style="display:none;" name="serial" id="nestable-output"></textarea>
            <div class="cf nestable-lists">
                <div class="dd" id="nestable">
                    <ol class="dd-list">
                        <?php
                        	foreach($slider as $row){
						?>
                        <li class="dd-item row" data-id="<?php echo $row['slider_id']; ?>">
                            <div class="dd-handle col-md-12" style="cursor: ns-resize;moz-user-select: none; -khtml-user-select: none; -webkit-user-select: none; -o-user-select: none; ">
                            	<div class="col-md-8">
                            	   <img class="img-responsive thumbnail img-slider" style="margin-bottom:0px !important;" src="<?php echo base_url(); ?>uploads/slider_image/background_<?php echo $row['slider_id']; ?>.jpg" />
                                </div>
                                <div class="col-md-4">
                                	<?php echo $row['title']; ?>
                                </div>
                            </div>
                        </li>
                        <?php
							}
						?>
                    </ol>
                </div>
            </div>
            
        </div>
        <div class="panel-footer">
            <div class="row">
                <div class="col-md-11">
                    <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                        onclick="ajax_set_full('serial','<?php echo translate('slider_serial'); ?>','<?php echo translate('successfully_serialized!'); ?>','slider_serial',''); "><?php echo translate('reset');?>
                    </span>
                </div>
                
                <div class="col-md-1">
                    <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('slider_serial','<?php echo translate('slider_serial_saved!'); ?>');" ><?php echo translate('save');?></span>
                </div>
                
            </div>
        </div>
	</form>
</div>
<script>
	$(document).ready(function(){
		var updateOutput = function(e)
		{
			var list   = e.length ? e : $(e.target),
				output = list.data('output');
			if (window.JSON) {
				output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
			} else {
				output.val('JSON browser support required for this demo.');
			}
		};
	
		
		// activate Nestable for list

		$('#nestable').nestable({

			group: 1

		})

		.on('change', updateOutput);
		
		// output initial serialised data
		updateOutput($('#nestable').data('output', $('#nestable-output')));
	
	});
</script>

