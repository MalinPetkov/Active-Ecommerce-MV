<?php
	foreach($sub_category_data as $row){
?>
 
<div>
	<?php
        echo form_open(base_url() . 'index.php/admin/sub_category_digital/update/' . $row['sub_category_id'], array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'sub_category_edit_digital',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-inputemail">
                	<?php echo translate('sub-category_name');?>
                    	</label>
                <div class="col-sm-6">
                    <input type="text" name="sub_category_name" value="<?php echo $row['sub_category_name'];?>" class="form-control required" placeholder="<?php echo translate('sub-category_name'); ?>" >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('sub-category_banner');?></label>
                <div class="col-sm-6">
                    <span class="pull-left btn btn-default btn-file">
                        <?php echo translate('select_sub-category_banner');?>
                        <input type="file" name="img" id='imgInp' accept="image">
                    </span>
                    <br><br>
                    <span id='wrap' class="pull-left" >
                        <img src="<?php echo base_url();?>uploads/sub_category_image/<?php echo $row['banner']; ?>" width="100%" id='blah' > 
                    </span>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo translate('category');?></label>
                <div class="col-sm-6">
                    <?php echo $this->crud_model->select_html('category','category','category_name','edit','demo-chosen-select required',$row['category'],'digital','ok'); ?>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
	}
?>
	
<script type="text/javascript">
    $(document).ready(function() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    });


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
</script>