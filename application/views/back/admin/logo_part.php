<div class="col-md-12 col-sm-12">
    <div class="panel">
    	<div class="panel-heading">
        <h3 class="panel-title"><?php echo translate('upload_logo');?></h3>
    </div>
		<?php
            echo form_open(base_url() . 'index.php/admin/logo_settings/upload_logo1', array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'logo_form',
                'enctype' => 'multipart/form-data'
            ));
        ?>
            <div class="panel-body">
                <div class="form-group margin-top-10">
                    <div class="col-sm-12">
                        <div class="col-sm-6 col-sm-offset-3">
                            <center>
                                <img class="img-responsive img-md img-border" style="width:50%;height:40%" src="<?php echo base_url(); ?>uploads/others/photo_default.png" id="blah5" >
                            
                            <br />
                            <span class="btn btn-default btn-file margin-top-10">
                                <?php echo translate('select_logo');?>
                                <input type="file" name="logo" class="form-control" id="imgInp5">
                            </span>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<br>
<div class="col-md-12 col-sm-12" style="margin-top:20px;">
<div class="panel">
<div class="panel-heading">
    <h3 class="panel-title"><?php echo translate('all_logos');?></h3>
</div>
<div class="panel-body" id="list" >

</div>
</div>
</div>

<form >
	<div class="col-md-12">
<div class="panel">
<div class="panel-heading">
    <h3 class="panel-title"><?php echo translate('select_logo');?></h3>
</div>
<?php
    $admin_login_logo = $this->db->get_where('ui_settings',array('type' => 'admin_login_logo'))->row()->value;
    $admin_nav_logo = $this->db->get_where('ui_settings',array('type' => 'admin_nav_logo'))->row()->value;
    $home_top_logo = $this->db->get_where('ui_settings',array('type' => 'home_top_logo'))->row()->value;
    $home_bottom_logo = $this->db->get_where('ui_settings',array('type' => 'home_bottom_logo'))->row()->value;
?>

<div class="panel-body">
    <table class="table">
        <thead>
            <tr>
                <th><?php echo translate('place');?></th>
                <th><?php echo translate('logo');?></th>
                <th class="text-right"><?php echo translate('options');?></th>
            </tr>
        </thead>
            
        <tbody>
            <tr>
                <td><?php echo translate('admin_logo');?></td>
                <td>
                    <div class="inner-div tr-bg img-fixed">
                        <img class="img-responsive img-sm" src="<?php echo base_url(); ?>uploads/logo_image/logo_<?php echo $admin_login_logo; ?>.png" id="admin_login_logo">
                    </div>
                </td>
                <td class="text-right">
                    <span class="btn btn-info btn-labeled fa fa-plus-circle" 
                        onclick="ajax_modal('show_all/selectable','<?php echo translate('select_logo'); ?>','<?php echo translate('successfully_selected!'); ?>','logo_set_change','admin_login_logo')">
                            <?php echo translate('change');?>
                    </span>
                </td>
            </tr>
            <tr>
                <td><?php echo translate('homepage_header_logo');?></td>
                <td>
                    <div class="inner-div tr-bg img-fixed">
                        <img class="img-responsive img-sm" src="<?php echo base_url(); ?>uploads/logo_image/logo_<?php echo $home_top_logo; ?>.png" id="home_top_logo" >
                    </div>
                </td>
                <td class="text-right">
                    <span class="btn btn-info btn-labeled fa fa-plus-circle" 
                        onclick="ajax_modal('show_all/selectable','<?php echo translate('select_logo'); ?>','<?php echo translate('successfully_selected!'); ?>','logo_set_change','home_top_logo')">
                            <?php echo translate('change');?>
                    </span>
                </td>
            </tr>
            <tr>
                <td><?php echo translate('homepage_footer_logo');?></td>
                <td>
                    <div class="inner-div tr-bg img-fixed">
                        <img class="img-responsive img-sm" src="<?php echo base_url(); ?>uploads/logo_image/logo_<?php echo $home_bottom_logo; ?>.png" id="home_bottom_logo" alt="User_Image" >
                    </div>
                </td>
                <td class="text-right">
                    <span class="btn btn-info btn-labeled fa fa-plus-circle" 
                        onclick="ajax_modal('show_all/selectable','<?php echo translate('select_logo'); ?>','<?php echo translate('successfully_selected!'); ?>','logo_set_change','home_bottom_logo')">
                            <?php echo translate('change');?>
                    </span>
                </td>
            </tr>
        </tbody>
    </table>
</div>

</div>         
</div>
</form>
<script>
function load_logos(){
	ajax_load('<?php echo base_url(); ?>index.php/admin/logo_settings/show_all','list','');
}

$(document).ready(function() {
	load_logos();
	function readURL3(input3) {
		if (input3.files && input3.files[0]) {
			var reader3 = new FileReader();
			
			reader3.onload = function (e) {
				
				$('#wrap').hide('fast');
				$('#blah5').attr('src', e.target.result);
				$('#wrap').show('fast');
				var form = $('#logo_form');
				var formdata = false;
				if (window.FormData){
					formdata = new FormData(form[0]);
				}
				$.ajax({
					
					url: form.attr('action'), // form action url
					type: 'POST', // form submit method get/post
					dataType: 'html', // request type html/json/xml
					data: formdata ? formdata : form.serialize(), // serialize form data 
			        cache       : false,
			        contentType : false,
			        processData : false,
					beforeSend: function() {
						
					},
					success: function() {
						load_logos();
						$.activeitNoty({
							type: 'success',
							icon : 'fa fa-check',
							message : '<?php echo translate('successfully_logo_uploaded')?>',
							container : 'floating',
							timer : 3000
						});
						other_forms();
						
						
					},
					error: function(e) {
						console.log(e)
					}
				});
				
			}
			
			reader3.readAsDataURL(input3.files[0]);
		}
	}

	$("#imgInp5").change(function(){
		readURL3(this);
	});
	
});