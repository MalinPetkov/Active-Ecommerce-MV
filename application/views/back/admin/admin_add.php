<div>
	<?php
		echo form_open(base_url() . 'index.php/admin/admins/do_add/', array(
			'class' => 'form-horizontal',
			'method' => 'post',
			'id' => 'admin_add'
		));
	?>
        <div class="panel-body">
        
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1">
                    <?php echo translate('name'); ?>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="demo-hor-1" class="form-control required" placeholder="<?php echo translate('name'); ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2">
                    <?php echo translate('email'); ?>
                </label>
                <div class="col-sm-6">
                    <input type="email" name="email" id="demo-hor-2" class="emails form-control required" placeholder="<?php echo translate('email'); ?>">
                	<div class="label label-danger" style="display:none;" id='email_note'></div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-3">
                    <?php echo translate('password'); ?>
                </label>
                <div class="col-sm-6">
                    <input type="password" name="password" id="demo-hor-3" class="emails form-control required" placeholder="<?php echo translate('password'); ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-4">
                    <?php echo translate('phone'); ?>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="phone" id="demo-hor-4" class="form-control " placeholder="<?php echo translate('phone'); ?>">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-5">
                    <?php echo translate('address'); ?>
                </label>
                <div class="col-sm-6">
                    <textarea name="address" id="demo-hor-5" class="form-control " placeholder="<?php echo translate('address'); ?>"></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-4 control-label" >
                    <?php echo translate('role'); ?>
                </label>
                <div class="col-sm-6">
                    <?php echo $this->
                    crud_model->select_html('role','role','name','add','demo-chosen-select required'); ?>
                </div>
            </div>
            
        </div>
	</form>
</div>

<script>
	$(document).ready(function() {
		$("form").submit(function(e){
			return false;
		});
		$('.demo-chosen-select').chosen();
		$('.demo-cs-multiselect').chosen({width:'100%'});
		$('body .modal-dialog').find('.btn-purple').addClass('disabled');
	});
	
	
	$(".emails").blur(function(){
		var email = $(".emails").val();
		$.post("<?php echo base_url(); ?>index.php/admin/exists",
		{
			<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
			email: email
		},
		function(data, status){
			if(data == 'yes'){
				$("#email_note").show();
				$("#email_note").html('*<?php echo 'email_already_registered'; ?>');
				$("body .modal-dialog .btn-purple").addClass("disabled");
			} else if(data == 'no'){
				$("#email_note").hide();
				$("#email_note").html('');
				$("body .modal-dialog .btn-purple").removeClass("disabled");
			}
		});
	});
</script>