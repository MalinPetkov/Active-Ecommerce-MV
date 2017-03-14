<?php
	foreach($category_data as $row){
?>
	<div class="tab-pane fade active in" id="edit">
		<?php
			echo form_open(base_url() . 'index.php/admin/category/update/' . $row['category_id'], array(
				'class' => 'form-horizontal',
				'method' => 'post',
				'id' => 'category_edit',
				'enctype' => 'multipart/form-data'
			));
		?>
			<div class="panel-body">
				<div class="form-group">
					<label class="col-sm-4 control-label" for="demo-hor-1">
                    	<?php echo translate('category_name');?>
                        	</label>
					<div class="col-sm-6">
						<input type="text" name="category_name"  
                        	value="<?php echo $row['category_name'];?>" id="demo-hor-1" 
                            	class="form-control required" placeholder="<?php echo translate('category_name');?>" >
					</div>
				</div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('category_banner');?></label>
                    <div class="col-sm-6">
                        <span class="pull-left btn btn-default btn-file">
                            <?php echo translate('select_category_banner');?>
                            <input type="file" name="img" id='imgInp' accept="image">
                        </span>
                        <br><br>
                        <span id='wrap' class="pull-left" >
                            <?php
								if(file_exists('uploads/category_image/'.$row['banner'])){
							?>
							<img src="<?php echo base_url(); ?>uploads/category_image/<?php echo $row['banner']; ?>" width="100%" id='blah' />  
							<?php
								} else {
							?>
							<img src="<?php echo base_url(); ?>uploads/category_image/default.jpg" width="100%" id='blah' />
							<?php
								}
							?> 
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
	    $("form").submit(function(e) {
	        return false;
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