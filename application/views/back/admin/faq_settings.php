<?php            
	$faqs = json_decode($this->db->get_where('business_settings', array(
		'type' => 'faqs'
	))->row()->value,true);
?>          
<div id="content-container">
    <div id="page-title">
    	<center>
        	<h1 class="page-header text-overflow">
				<?php echo translate('manage_faqs')?>
            </h1>
        </center>
    </div>
    <?php
		echo form_open(base_url() . 'index.php/admin/business_settings/faq_set/', array(
			'class'     => 'form-horizontal',
			'method'    => 'post',
			'id'        => 'gen_set',
			'enctype'   => 'multipart/form-data'
		));
	?>
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-12">
               <div class="panel panel-bordered panel-dark">
                        <div class="panel-heading">
                            <center>
                                <h3 class="panel-title"><?php echo translate('FAQs')?></h3>
                            </center>
                        </div>
                        <div class="panel-body" style="background:#fffffb;">
                            <div id="more_additional_fields">
                            <?php
                                if(!empty($faqs)){
                                    foreach($faqs as $row1){
                            ?> 
                                <div class="form-group btm_border">
                                    <div class="col-sm-4">
                                        <input type="text" name="f_q[]" value="<?php echo $row1['question']; ?>" placeholder="<?php echo translate('question'); ?>" class="form-control" >
                                    </div>
                                    <div class="col-sm-6">
                                          <textarea rows="9"  class="summernotes" data-height="100" data-name="f_a[]"><?php echo $row1['answer']; ?></textarea>
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="remove_it_v btn btn-danger" onclick="delete_row(this)"><i class="fa fa-trash"></i></span>
                                    </div>
                                </div>
                            <?php
                                    }
                                }
                            ?> 
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-17"></label>
                                <div class="col-sm-6">
                                        <div id="more_btn" class="btn btn-success btn-labeled fa fa-plus pull-right">
                                        <?php echo translate('add_more_FAQs');?></div>
                                </div>
                            </div>
                        </div>
                     </div>
            	</div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <span class="btn btn-info submitter enterer" 
                data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('settings_updated!'); ?>' >
                    <?php echo translate('save');?>
            </span>
        </div>
    </form>
</div>
<style>
.bg-white{
	background:#ffffff !important;
	color:#000 !important;
}
</style>
<script src="<?php echo base_url(); ?>template/back/js/custom/business.js"></script>
<script>
	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'admin';
	var module = 'business_settings';
	var list_cont_func = '';
	var dlt_cont_func = '';
	
    $("#more_btn").click(function(){
        $("#more_additional_fields").append(''
            +'<div class="form-group">'
            +'    <div class="col-sm-4">'
            +'        <input type="text" name="f_q[]" class="form-control"  placeholder="<?php echo translate('question'); ?>">'
            +'    </div>'
            +'    <div class="col-sm-6">'
            +'          <textarea rows="9"  class="summernotes" data-height="100" data-name="f_a[]"></textarea>'
            +'    </div>'
            +'    <div class="col-sm-2">'
            +'        <span class="remove_it_v btn btn-danger" onclick="delete_row(this)"><i class="fa fa-trash"></i></span>'
            +'    </div>'
            +'</div>'
        );
		set_summer();
    });
    function delete_row(e)
    {
        e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
    } 
	$(document).ready(function() {
		set_summer();
		$("form").submit(function(e){
			return false;
		});
    });  

</script>
