<?php
	foreach($coupon_data as $row){
        if($this->crud_model->is_added_by('coupon',$row['coupon_id'],$this->session->userdata('vendor_id'))){
?>
    <div>
        <?php
			echo form_open(base_url() . 'index.php/vendor/coupon/update/' . $row['coupon_id'], array(
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
            
                <div class="form-group">
                    <label class="col-sm-4 control-label"><?php echo translate('product');?></label>
                    <div class="col-sm-6">
                        <select data-placeholder="<?php echo translate('choose_product');?>" name="product[]" class="demo-cs-multiselect" multiple tabindex="2">
                            <?php
                                $e_match = json_decode($spec['set']);
                                if ($e_match == NULL) {
                                    $e_match = array();
                                }
                                $products = $this->db->get_where('product',array('added_by'=>json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id')))))->result_array();
                                foreach ($products as $row1) {
                                    if($this->crud_model->is_publishable($row1['product_id'])){
                            ?>
                            <option value="<?php echo $row1['product_id']; ?>" 
                                <?php if (in_array($row1['product_id'], $e_match)) {
                                    echo 'selected="selected"';
                                } ?> >
                                <?php echo $row1['title']; ?>
                            </option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
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
	}
?>

<script src="<?php echo base_url(); ?>template/back/js/custom/brand_form.js"></script>


