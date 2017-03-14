<link rel="stylesheet" href="<?php echo base_url(); ?>template/front/layerslider/css/layerslider.css" type="text/css">
<script src="<?php echo base_url(); ?>template/front/layerslider/js/greensock.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/front/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/front/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>

<style>
    #layerslider * {
        font-family: 'Roboto', sans-serif;
    }
    body {
        padding: 0 !important;
    }
</style>

<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow"><?php echo translate('manage_layer_slider');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
                <div class="tab-content">
                    <div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding: 5px;">
                        <button class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right" 
                        	onclick="ajax_set_full('add','<?php echo translate('title'); ?>','<?php echo translate('successfully_added!'); ?>','slider_add','')">
								<?php echo translate('create_slider');?>
                        </button>
                        <button class="btn btn-info btn-labeled fa fa-plus-circle add_pro_btn pull-right" 
                        	onclick="ajax_set_list()">
								<?php echo translate('slider_list');?>
                        </button>
                        <button class="btn btn-purple btn-labeled fa fa-align-justify add_pro_btn pull-right" 
                        	onclick="ajax_set_full('serial','<?php echo translate('slider_serial'); ?>','<?php echo translate('successfully_serialized!'); ?>','slider_serial',''); ">
								<?php echo translate('slider_serial');?>
                        </button>
                        <div class="col-sm-6">
                            <input id="set_slider" class='sw' data-set='set_slider' type="checkbox" <?php if($this->crud_model->get_type_name_by_id('general_settings','53','value') == 'ok'){ ?>checked<?php } ?> />
                        </div>
                    </div>
                    <!-- LIST -->
                    <div class="tab-pane fade active in" id="list" 
                        style="border:1px solid #ddd; border-radius:4px;">					
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<span id="slid"></span>
<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'admin';
	var module = 'slider';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';

    $(document).ready(function(){
        $(".sw").each(function(){
            var h = $(this);
            var id = h.attr('id');
            var set = h.data('set');
            new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
            var changeCheckbox = document.querySelector('#'+id);
            changeCheckbox.onchange = function() {
              //alert($(this).data('id'));
              ajax_load(base_url+'index.php/'+user_type+'/general_settings/'+set+'/'+changeCheckbox.checked,'site','othersd');
              if(changeCheckbox.checked == true){
                $.activeitNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : s_e,
                    container : 'floating',
                    timer : 3000
                });
                sound('published');
              } else {
                $.activeitNoty({
                    type : 'danger',
                    icon : 'fa fa-check',
                    message : s_d,
                    container : 'floating',
                    timer : 3000
                });
                sound('unpublished');
              }
              //alert(changeCheckbox.checked);
            };
        });
    }); 
</script>