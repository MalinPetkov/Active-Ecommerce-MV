<?php
	foreach($lang_data as $row){
?>
<div>
    <?php
		echo form_open(base_url() . 'index.php/admin/language_settings/do_edit_lang/'.$row['language_list_id'], array(
			'class' => 'form-horizontal',
			'method' => 'post',
			'id' => 'language_edit',
			'enctype' => 'multipart/form-data'
		));
	?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1">
                	<?php echo translate('language_name');?>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="language" id="demo-hor-1" 
                    	class="form-control required" placeholder="<?php echo translate('language_name');?>" value="<?php echo $row['name']; ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2">
                    <?php echo translate('language_icon');?>
                </label>
                <div class="col-sm-6">
                    <span class="pull-left btn btn-default btn-file">
                        <?php echo translate('select_language_icon');?>
                        <input type="file" name="icon" id='imgInp' accept="image">
                    </span>
                    <br><br>
                    <span id='wrap' class="pull-left" >
                        <img src="<?php echo $this->crud_model->file_view('language_list',$row['language_list_id'],'','','no','src','','','.jpg') ?>" width="100%" id='blah' > 
                    </span>
                </div>
            </div>
        </div>
	</form>
</div>

<?php
	}
?>

<script>
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#wrap').hide('fast');
				$('#blah').attr('src', e.target.result);
				$('#wrap').show('fast');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$("#imgInp").change(function() {
		readURL(this);
	});
	
	$(document).ready(function() {
		$("form").submit(function(e) {
			return false;
		});
	});
</script>
