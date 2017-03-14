<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow"><?php echo translate('manage_top_carousal_slides');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding:10px;">
						<button class="btn btn-primary btn-labeled fa fa-plus-circle pull-right" 
                        	onclick="ajax_modal('add','<?php echo translate('add_slides'); ?>','<?php echo translate('successfully_added!');?>','slides_add','')">
								<?php echo translate('create_slides');?>
						</button>
                        <div class="col-sm-6">
                            <input id="set_slides" class='sw' data-set='set_slides' type="checkbox" <?php if($this->crud_model->get_type_name_by_id('general_settings','62','value') == 'ok'){ ?>checked<?php } ?> />
                        </div>
					</div>
					<div class="tab-pane fade active in" id="list" 
                    	style="border:1px solid #ebebeb; 
                        	border-radius:4px;">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'admin';
	var module = 'slides';
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

