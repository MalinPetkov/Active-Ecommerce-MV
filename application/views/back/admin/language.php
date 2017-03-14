<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow"><?php echo translate('manage_languages');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding: 40px 5px 5px 5px;">
						<button class="btn btn-primary btn-labeled fa fa-plus-circle pull-right mar-rgt add_pro_btn" 
							onclick="ajax_modal('add_lang','<?php echo translate('add_language'); ?>','<?php echo translate('successfully_added!'); ?>','language_add','')">
							<?php echo translate('add_language');?>
						</button>
                        <button class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn" 
                            style="display:none;"  onclick="ajax_set_list();  proceed('to_add');"><?php echo translate('back_to_language_list');?>
                        </button>
					</div>
					<br>
                    <div class="row">
                        <div class="form-group" id='lang_select'>
                        </div>
                    </div>
                    <div class="tab-pane fade active in" id="list" style="border:1px solid #ebebeb; border-radius:4px;">
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	if($set_lang = $this->session->userdata('language')){} else {
		$set_lang = $this->db->get_where('general_settings',array('type'=>'language'))->row()->value;
	}
?>
<script>
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'language_settings';
	var list_cont_func = 'lang_list';
	var dlt_cont_func = 'dlt_word';
	var set_lang = '<?php echo $set_lang; ?>';
	var dlt_lang_txt = '<?php echo translate('really_want_to_delete_this_language?'); ?>';
	var upd_txt = '<?php echo translate('settings_updated!'); ?>';
	var dlt_txt = '<?php echo translate('do_you_really_want_to_delete_this_language?'); ?>';
	var saving = '<?php echo translate('saving..'); ?>';	

	function proceed(type){
		if(type == 'to_list'){
			$(".pro_list_btn").show();
			$(".add_pro_btn").hide();
		} else if(type == 'to_add'){
			$(".add_pro_btn").show();
			$(".pro_list_btn").hide();
		}
	}
	
</script>
<script src="<?php echo base_url(); ?>template/back/js/custom/language_main.js"></script>
