<div>
	<?php
        echo form_open(base_url() . 'index.php/vendor/slides/do_add/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'slides_add',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('slide_banner');?></label>
                <div class="col-sm-6">
                    <span class="pull-left btn btn-default btn-file">
                        <?php echo translate('select_slide_banner');?>
                        <input type="file" name="img" id='imgInp' accept="image">
                    </span>
                    <br><br>
                    <span id='wrap' class="pull-left" >
                        <img src="<?php echo base_url(); ?>uploads/others/photo_default.png" 
                        	width="100%" id='blah' > 
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo translate('button_color:');?></label>
                <div class="col-sm-6">
                    <div class="input-group demo2">
                       <input type="text" value="rgba(0,0,0,1)" name="color_button" class="form-control" />
                       <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo translate('button_text_color:');?></label>
                <div class="col-sm-6">
                    <div class="input-group demo2">
                       <input type="text" value="rgba(0,0,0,1)" name="color_text" class="form-control" />
                       <span class="input-group-addon"><i></i></span>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-3"><?php echo translate('button_text');?></label>
                <div class="col-sm-6">
                    <input type="text" name="button_text" id="demo-hor-3" 
                    	placeholder="<?php echo translate('button_text'); ?>" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-4"><?php echo translate('button_link');?></label>
                <div class="col-sm-6">
                    <input type="text" name="button_link" id="demo-hor-4" 
                    	placeholder="<?php echo translate('button_link'); ?>" class="form-control">
                </div>
            </div>
        </div>
	</form>
</div>

<script src="<?php echo base_url(); ?>template/back/js/custom/brand_form.js"></script>

<script>
$(document).ready(function() {
	createColorpickers();
});

function createColorpickers(){

	$('.demo2').colorpicker({
		format: 'rgba'
	});
	
}
</script>

