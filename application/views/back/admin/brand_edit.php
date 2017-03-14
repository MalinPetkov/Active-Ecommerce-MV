<?php
	foreach($brand_data as $row){
?>
    <div>
        <?php
			echo form_open(base_url() . 'index.php/admin/brand/update/' . $row['brand_id'], array(
				'class' => 'form-horizontal',
				'method' => 'post',
				'id' => 'brand_edit',
				'enctype' => 'multipart/form-data'
			));
		?>
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('brand_name');?></label>
                    <div class="col-sm-6">
                        <input type="text" value="<?php echo $row['name'];?>" 
                        	name="name" id="demo-hor-1" class="form-control required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('brand_logo');?></label>
                    <div class="col-sm-6">
                        <span class="pull-left btn btn-default btn-file">
                            <?php echo translate('select_brand_logo');?>
                            <input type="file" name="img" id='imgInp' accept="image">
                        </span>
                        <br><br>
                        <span id='wrap' class="pull-left" >
                            <?php
								if(file_exists('uploads/brand_image/'.$row['logo'])){
							?>
							<img src="<?php echo base_url(); ?>uploads/brand_image/<?php echo $row['logo']; ?>" width="60%" id='blah' />  
							<?php
								} else {
							?>
							<img src="<?php echo base_url(); ?>uploads/brand_image/default.jpg" width="60%" alt="" id='blah' />
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

<script src="<?php echo base_url(); ?>template/back/js/custom/brand_form.js"></script>


