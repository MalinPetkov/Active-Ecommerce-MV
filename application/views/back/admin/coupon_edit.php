<?php				
	$physical_system   	 =  $this->crud_model->get_type_name_by_id('general_settings','68','value');
	$digital_system   	 =  $this->crud_model->get_type_name_by_id('general_settings','69','value');
	$status= '';
	$value= '';
	if($physical_system !== 'ok' && $digital_system == 'ok'){
		$status= 'digital';
		$value= 'ok';
	}
	if($physical_system == 'ok' && $digital_system !== 'ok'){
		$status= 'digital';
		$value= NULL;
	}
	if($physical_system !== 'ok' && $digital_system !== 'ok'){
		$status= 'digital';
		$value= '0';
	}
	foreach($coupon_data as $row){
?>
    <div>
        <?php
			echo form_open(base_url() . 'index.php/admin/coupon/update/' . $row['coupon_id'], array(
				'class' => 'form-horizontal',
				'method' => 'post',
				'id' => 'coupon_edit',
				'enctype' => 'multipart/form-data'
			));
		?>
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('coupon_title');?></label>
                    <div class="col-sm-6">
                        <input type="text" name="title" id="demo-hor-1" value="<?php echo $row['title']; ?>" 
                            placeholder="<?php echo translate('title'); ?>" class="form-control required">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('valid_till');?></label>
                    <div class="col-sm-6">
                        <input type="date" name="till" id="demo-hor-1" value="<?php echo $row['till']; ?>" class="form-control">
                    </div>
                </div>
                <?php
                     $spec = json_decode($row['spec'],true);
                ?>                
                <div class="form-group" style="display:none;">
                    <label class="col-sm-4 control-label"><?php echo translate('coupon_discount_for');?></label>
                    <div class="col-sm-6">
                        <?php
                            $array = array('all_products','category','sub_category','product');
                            echo $this->crud_model->select_html($array,'set_type','','edit','demo-chosen-select required chos', $spec['set_type']); 
                        ?>
                    </div>
                </div>      
                <div class="form-group" >
                    <label class="col-sm-4 control-label"><?php echo translate('coupon_discount_for');?></label>
                    <label class="col-sm-6 control-label" style="text-align-last:left;"><?php echo translate($spec['set_type']);?></label>
                </div>

                <div class="form-group category" <?php if($spec['set_type'] !== 'category'){ ?>style="display:none;"<?php } ?>>
                    <label class="col-sm-4 control-label"><?php echo translate('category');?></label>
                    <div class="col-sm-6">
                        <?php 
							$categories =json_decode($spec['set']);
							$result=array();
							foreach($categories as $row1){
								if($this->crud_model->if_publishable_category($row1)){
									$result[]=$row1;
								}
							}
                        	echo $this->crud_model->select_html('category','category','category_name','edit','demo-cs-multiselect',json_encode($result),$status,$value);
                        ?>
                    </div>
                </div>
                
                <div class="form-group sub_category" <?php if($spec['set_type'] !== 'sub_category'){ ?>style="display:none;"<?php } ?>>
                    <label class="col-sm-4 control-label"><?php echo translate('sub_category');?></label>
                    <div class="col-sm-6">
                        <?php 
                            $sub_categories =json_decode($spec['set']);
							$result=array();
							foreach($sub_categories as $row2){
								if($this->crud_model->if_publishable_subcategory($row2)){
									$result[]=$row2;
								}
							}
                         	echo $this->crud_model->select_html('sub_category','sub_category','sub_category_name','edit','demo-cs-multiselect',json_encode($result),$status,$value);
                        ?>
                    </div>
                </div>
                
                <div class="form-group product" <?php if($spec['set_type'] !== 'product'){ ?>style="display:none;"<?php } ?>>
                    <label class="col-sm-4 control-label"><?php echo translate('product');?></label>
                    <div class="col-sm-6">
                        <?php 
							$products =json_decode($spec['set']);
							$result=array();
							foreach($products as $row3){
								if($this->crud_model->is_publishable($row3)){
									$result[]=$row3;
								}
							}
							$status2= '';
							$value2= '';
							if($physical_system !== 'ok' && $digital_system == 'ok'){
								$status2= 'download';
								$value2= 'ok';
							}
							if($physical_system == 'ok' && $digital_system !== 'ok'){
								$status2= 'download';
								$value2= NULL;
							}
							if($physical_system !== 'ok' && $digital_system !== 'ok'){
								$status2= 'download';
								$value2= '0';
							}
                  			echo $this->crud_model->select_html('product','product','title','edit','demo-cs-multiselect',json_encode($result),$status2,$value2);
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('coupon_code');?></label>
                    <div class="col-sm-6">
                        <input type="text" name="code" id="demo-hor-1"  value="<?php echo $row['code']; ?>"
                            placeholder="<?php echo translate('code'); ?>" class="form-control required">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo translate('discount_type');?></label>
                    <div class="col-sm-6">
                        <?php
                            $array = array('percent','amount');
                            echo $this->crud_model->select_html($array,'discount_type','','edit','demo-chosen-select required',$spec['discount_type']); 
                        ?>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('discount_value');?></label>
                    <div class="col-sm-6">
                        <input type="number" name="discount_value" id="demo-hor-1"  value="<?php echo $spec['discount_value']; ?>"
                            placeholder="<?php echo translate('discount_value'); ?>" class="form-control required">
                    </div>
                </div>
            </div>
        </form>
    </div>

<?php
	}
?>

<script src="<?php echo base_url(); ?>template/back/js/custom/brand_form.js"></script>


