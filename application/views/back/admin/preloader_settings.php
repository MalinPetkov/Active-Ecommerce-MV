<div class="panel">
	<?php 
        $preloader_bg	=  $this->db->get_where('general_settings',array('type' => 'preloader_bg'))->row()->value;
        $preloader_obj	=  $this->db->get_where('general_settings',array('type' => 'preloader_obj'))->row()->value;
        $preloader		=  $this->db->get_where('general_settings',array('type' => 'preloader'))->row()->value;
    ?>
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo translate('preloaders');?></h3>
    </div>
    <?php
        echo form_open(base_url() . 'index.php/admin/general_settings/preloader/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => '',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">
            <div class="col-sm-12 ">
                <div class="form-group" style="margin-top:20px;">
                    <label class="col-sm-2 control-label" for="demo-hor-inputemail">
                        <?php echo translate('preloader_color'); ?>
                    </label>
                    <div class="col-sm-8">
                        <div class="col-sm-12">
                            <div class="input-group demo2">
                               <input type="text" value="<?php echo $preloader_obj; ?>" name="preloader_obj" class="form-control" />
                               <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="demo-hor-inputemail">
                        <?php echo translate('preloader_background'); ?>
                    </label>
                    <div class="col-sm-8">
                        <div class="col-sm-12">
                            <div class="input-group demo2">
                               <input type="text" value="<?php echo $preloader_bg; ?>" name="preloader_bg" class="form-control" />
                               <span class="input-group-addon"><i></i></span>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
            <div class="col-sm-12 ">
                <div class="form-group">
                    <?php
                        for($i=1;$i<=30;$i++){
                    ?>
                    <div class="col-sm-4">
                        <div class="delete-div-wrap cc-selector">
                            <input id="pre_<?php echo $i; ?>" type="radio" value="<?php echo $i; ?>" name="preloader" <?php if($i == $preloader){ echo 'checked'; } ?> >
                            <label class="inner-div tr-bg drinkcard-cc aad col-md-12" style="margin-bottom:0px;background-image:none; height:175px; z-index:99999;" for="pre_<?php echo $i; ?>">
                            </label>
                            <div class="col-md-12" style="height:0px;z-index:1;top:-164px;position:relative;">
                                <iframe style="width:100%" src="<?php echo base_url(); ?>index.php/admin/preloader_view/<?php echo $i; ?>"  data-id="<?php echo $i; ?>" ></iframe>
                            </div>
                        </div>
                    </div> 
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="col-sm-12 ">
                <div class="panel-footer text-right">
                    <span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('preloader_updated!'); ?>'>
                        <?php echo translate('save');?>
                    </span>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
	
$(document).ready(function(){
   // set_cart_map();
	createColorpickers();
});

function createColorpickers() {

	$('.demo2').colorpicker({
		format: 'rgba'
	});
	
}	
$('.delete-div-wrap .aad').on('click', function() {
	var id = $(this).closest('.delete-div-wrap').find('iframe').data('id');
});	
</script>