<div class="row">
    <div class="col-md-12">
        <!--Panel heading-->
        <div class="tab-base horizontal-tab">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#tabb-1"><?php echo translate('top_slider'); ?></a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tabb-2"><?php echo translate('home_banners'); ?></a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tabb-3"><?php echo translate('featured_products'); ?></a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tabb-4"><?php echo translate('search_section'); ?></a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tabb-5"><?php echo translate('category_wise_banners'); ?></a>
                </li>
                <li>
                    <a data-toggle="tab" href="#tabb-6"><?php echo translate('special_products'); ?></a>
                </li>
                <?php
                	if($this->crud_model->get_type_name_by_id('general_settings','58','value') == 'ok'){
				?>
                <li>
                    <a data-toggle="tab" href="#tabb-7"><?php echo translate('vendors'); ?></a>
                </li>
                <?php
					}
				?>
            </ul>
            <!--Tabs Content-->                    
            <div class="tab-content">
                <div id="tabb-1" class="tab-pane fade active in">
                	<div class="row">
                    	<div class="col-md-12 form-horizontal">
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo translate('layer_slider');?></label>
                                <div class="col-sm-6">
                                    <input id="set_slider" class='sw' data-set='set_slider' type="checkbox" <?php if($this->crud_model->get_type_name_by_id('general_settings','53','value') == 'ok'){ ?>checked<?php } ?> />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo translate('top_carousel_slider');?></label>
                                <div class="col-sm-6">
                                    <input id="set_slides" class='sw' data-set='set_slides' type="checkbox" <?php if($this->crud_model->get_type_name_by_id('general_settings','62','value') == 'ok'){ ?>checked<?php } ?> />
                                </div>
                            </div>
                            <?php
								echo form_open(base_url() . 'index.php/admin/ui_settings/ui_home/top_slide_categories/', array(
									'class' => 'form-horizontal',
									'method' => 'post',
									'id' => '',
									'enctype' => 'multipart/form-data'
								));
							?>
                                <div class="form-group top_cat">
                                    <label class="col-sm-3 control-label" for="demo-hor-3"><?php echo translate('choose_categories_(max_10)');?></label>				
                                    <div class="col-sm-6">
                                        <?php 
											$categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 35))->row()->value,true);
											$result=array();
											foreach($categories as $row){
												if($this->crud_model->if_publishable_category($row)){
													$result[]=$row;
												}
											}
										
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
											echo $this->crud_model->select_html('category','top_category','category_name','edit','demo-cs-multiselect',json_encode($result),$status,$value,'check_cat_length'); 
										?>
                                    </div>
                                </div>
                                <div class="form-group deal">
                                    <label class="col-sm-3 control-label" ><?php echo translate('number_of_todays_deal_(_to_show_)');?></label>
                                    <div class="col-sm-6">
                                        <input type="number" name="deal_no" value="<?php echo $this->crud_model->get_type_name_by_id('ui_settings','30','value'); ?>"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-sm-12 top_cat_update"  style="margin-bottom:300px">
                                    <span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" type= data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('category_menu_updated!'); ?>'>
                                        <?php echo translate('update');?>
                                    </span>
                                </div>
            				</form>
                        </div>
                    </div>
                </div>
                <div id="tabb-2" class="tab-pane fade">
                	<div class="row">
                    	<div class="col-md-12 form-horizontal">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <?php echo translate('after_slider'); ?>
                                </h3>
                            </div>
							<?php
								$home_banner =  $this->db->get_where('banner',array('place' => 'after_slider'))->result_array();
                                foreach($home_banner as $row){
                            ?>
                                <div class="col-md-3">
                                    <?php
                                        echo form_open(base_url() . 'index.php/admin/banner/set/'. $row['banner_id'], array(
                                            'class' => 'form-horizontal',
                                            'method' => 'post',
                                            'enctype' => 'multipart/form-data'
                                        ));
                                    ?>
                                        <div class="panel panel-bordered-grey">
                                            <div class="panel-body">
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <img class="img-responsive img_show img-banner"
                                                            src="<?php echo $this->crud_model->file_view('banner',$row['banner_id'],'','','thumb','src','','',$row['image_ext']) ?>" style="width:300px; height:110px;" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <span class="pull-left btn btn-default btn-file">
                                                            <?php echo translate('select_banner_image');?>
                                                            <input type="file" name="img" class="form-control imgInp" accept="image">
                                                        </span> 
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <input id="ban_<?php echo $row['banner_id']; ?>" 
                                                            data-id="<?php echo $row['banner_id']; ?>" class='sw1' 
                                                                type="checkbox" name="status" 
                                                                    <?php if($row['status'] == 'ok'){ ?>checked<?php } ?>
                                                                        value="ok" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                         <input type="text" name="link" value="<?php echo $row['link']; ?>" 
                                                            placeholder="<?php echo translate('link');?>" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel-footer text-right">
                                                <span class="btn btn-info btn-xs btn-labeled fa fa-check submitter enterer"  
                                                    data-ing='<?php echo translate('updating..');?>' 
                                                        data-msg='<?php echo translate('banner_updated!');?>'>
                                                        <?php echo translate('update');?>
                                                </span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div id="tabb-3" class="tab-pane fade">
                	<div class="row">
                    	<div class="col-md-12 form-horizontal">
                           	<?php
								echo form_open(base_url() . 'index.php/admin/ui_settings/ui_home/home_featured/', array(
									'class' => 'form-horizontal',
									'method' => 'post',
									'id' => '',
									'enctype' => 'multipart/form-data'
								));
							?>
                            <div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo translate('featured_products_(_show_/_hide_)');?></label>
                                <div class="col-sm-6">
                                    <input id="feature_24" 
                                        data-id="24" class='sw2' 
                                            type="checkbox" name="value" 
                                                <?php if($this->crud_model->get_type_name_by_id('ui_settings','24','value') == 'ok'){
													 ?>checked<?php } ?>
                                                    	value="ok" />
                                </div>
                            </div>
                           	<div class="form-group">
                                <label class="col-sm-3 control-label" ><?php echo translate('number_of_products_(_to_show_)');?></label>
                                <div class="col-sm-6">
                                    <input type="number" name="featured_no" value="<?php echo $this->crud_model->get_type_name_by_id('ui_settings','20','value'); ?>"  class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" style="margin-top:15px;" ><?php echo translate('choose_product_box_style');?></label>
                                <div class="col-sm-6">
                                	<div class="row">
									<?php 
                                        $box_style =  $this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;
										$style = array(1,2,3);
                                        foreach($style as $value){
                                    ?>
                                        <div class="cc-selector col-sm-4">
                                            <input type="radio" id="f_box_<?php echo $value; ?>" value="<?php echo $value; ?>" name="fea_pro_box" <?php if($box_style == $value){ echo 'checked'; } ?> >
                                            <label class="drinkcard-cc" style="margin-bottom:0px; width:100%;" for="f_box_<?php echo $value; ?>">
                                                    <img src="<?php echo base_url() ?>uploads/product_boxes/<?php echo 'product_grid_'.$value.'.jpg' ?>" width="100%" height="100%" alt="<?php echo 'product_box_style_'.$value; ?>" />
                                                   
                                            </label>
                                        </div>
                                    <?php
                                        }
                                    ?>
                                	</div>
                            	</div>
                            </div>
            				<div class="form-group col-sm-12">
                            	<span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" type= data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('featured_section_updated!'); ?>'>
									<?php echo translate('update');?>
                                </span>
                            </div>
            			</form>
                        </div>
                    </div>
                </div>
                <div id="tabb-4" class="tab-pane fade">
                	<div class="row">
                    	<div class="col-md-12 form-horizontal">
							<?php
                                echo form_open(base_url() . 'index.php/admin/ui_settings/ui_home/home_search/', array(
                                    'class' => 'form-horizontal',
                                    'method' => 'post',
                                    'id' => '',
                                    'enctype' => 'multipart/form-data'
                                ));
                            ?>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" ><?php echo translate('parallax_title_for_search');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="ps_title" value="<?php echo $this->crud_model->get_type_name_by_id('ui_settings','27','value'); ?>"  class="form-control">
                                    </div>
                                </div>
                                <div class="form-group margin-top-10">
                                    <label class="col-sm-3 control-label margin-top-10" for="demo-hor-inputemail"><?php echo translate('parallax_image_for_search_section');?></label>
                                    <div class="col-sm-9">
                                        <div class="col-sm-5" style="margin:2px;padding:2px;">
                                            <img class="img-responsive img-md img-border img_show2" style="width:100%;height:150px" src="<?php echo base_url(); ?>uploads/others/parralax_search.jpg">
                                        </div>
                                        <br />
                                        <br />
                                        <br />
                                        <div class="col-sm-2">
                                            <span class="pull-left btn btn-default btn-file margin-top-10">
                                                <?php echo translate('select_image');?>
                                                <input type="file" name="par3" class="form-control imgInp2">
                                            </span>
                                        </div>
                                        <div class="col-sm-2"></div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12">
                                    <span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" type= data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('search_section_updated!'); ?>'>
                                        <?php echo translate('update');?>
                                    </span>
                                </div>
                            </form>
                     	</div>
                    </div>
                </div>
                <div id="tabb-5" class="tab-pane fade">
                	<div class="row">
                    	<div class="col-md-12 form-horizontal">
                        	<?php
								echo form_open(base_url() . 'index.php/admin/ui_settings/ui_home/home2_category/', array(
									'class' => 'form-horizontal',
									'method' => 'post',
									'id' => '',
									'enctype' => 'multipart/form-data'
								));
							?>
                            	<div id="home_category_selection_box">
                                	<?php			
                                        $category = $this->db->get('category')->result_array();													
										$home2_categories = json_decode($this->db->get_where('ui_settings',array('type'=>'home_categories'))->row()->value,true);
										foreach($home2_categories as $cdata){
											if($this->crud_model->if_publishable_category($cdata['category'])){
									?>
                                    <div class="col-sm-12 element_box">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label" for="demo-hor-2"><?php echo translate('category');?></label>
                                            <div class="col-sm-9 category_select_div">
                                                <?php
													$l = 0;
													foreach($category as $cat){
														$l++;
														if($this->crud_model->if_publishable_category($cat['category_id'])){
												?>
                                                	<div class="col-sm-3 radio_checker category_btn cat_<?php echo $cat['category_id']; ?>" onClick="get_cat('<?php echo $cat['category_id']; ?>',this)">
                                                    	<span class="cat_text">
															<?php echo $cat['category_name']; ?>
                                                        </span>
                                                    	<input type="checkbox" style="display:none;" class="radio_pat"
                                                        	<?php if($cdata['category'] == $cat['category_id']){ ?>checked<?php } ?> value="<?php echo $cat['category_id']; ?>" name="category[]" />
                                                    </div>
                                                <?php 
														}
													}
												?>
                                            </div>
                                        </div>
                                        <div class="form-group sub">
                                            <label class="col-sm-3 control-label" for="demo-hor-3"><?php echo translate('sub-categories_(max 4)');?></label>				
                                            <div class="col-sm-6 sub_cat">
                                                <?php echo $this->crud_model->select_html('sub_category','sub_category['.$cdata['category'].']','sub_category_name','edit','demo-cs-multiselect',json_encode($cdata['sub_category']),'category',$cdata['category'],'check_sub_length'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo translate('color_preference_:');?></label>
                                            <div class="col-sm-6">
                                                <div class="input-group demo2">
                                                   <input type="text" value="<?php echo $cdata['color_back']; ?>" name="color1[<?php echo $cdata['category']; ?>]" class="form-control color_class1" />
                                                   <span class="input-group-addon"><i></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label"><?php echo translate('title_color:');?></label>
                                            <div class="col-sm-6">
                                                <div class="input-group demo2">
                                                   <input type="text" value="<?php echo $cdata['color_text']; ?>" name="color2[<?php echo $cdata['category']; ?>]" class="form-control color_class2" />
                                                   <span class="input-group-addon"><i></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
											<div class="col-sm-12">
												<div class="btn btn-danger pull-right" onClick="rem_element_box(this)">
                                            		<i class="fa fa-times"></i>
                                               	</div>
                                         	</div>
										</div>
                                    </div>
                                    <?php
											}
										}
									?>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="btn btn-mint btn-labeled fa fa-plus-square pull-right add_new" onClick="add_home_cat_box()">
                                            <?php echo translate('add_new');?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-sm-12" style="margin-top:100px;">
                                    <span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" type= data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('home_categories_updated!'); ?>'>
                                        <?php echo translate('update');?>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div id="tabb-6" class="tab-pane fade">
                	<div class="row">
                    	<div class="col-md-12 form-horizontal">
                        	<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo translate('special_products_(_show_/_hide_)');?></label>
                                <div class="col-sm-6">
                                    <input id="feature_31" 
                                        data-id="31" class='sw2' 
                                            type="checkbox" name="value" 
                                                <?php if($this->crud_model->get_type_name_by_id('ui_settings','31','value') == 'ok'){
                                                     ?>checked<?php } ?>
                                                        value="ok" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                	if($this->crud_model->get_type_name_by_id('general_settings','58','value') == 'ok'){
				?>
                <div id="tabb-7" class="tab-pane fade">
                	<div class="row">
                    	<div class="col-md-12">
                        <?php
							echo form_open(base_url() . 'index.php/admin/ui_settings/ui_home/home_vendor/', array(
								'class' => 'form-horizontal',
								'method' => 'post',
								'id' => '',
								'enctype' => 'multipart/form-data'
							));
						?>
                        	<div class="form-group">
                                <label class="col-sm-3 control-label"><?php echo translate('vandor_(_show_/_hide_)');?></label>
                                <div class="col-sm-6">
                                    <input id="feature_25" 
                                        data-id="25" class='sw2' 
                                            type="checkbox" name="value" 
                                                <?php if($this->crud_model->get_type_name_by_id('ui_settings','25','value') == 'ok'){
                                                     ?>checked<?php } ?>
                                                        value="ok" />
                                </div>
                            </div>
                    		<div class="form-group">
                                <label class="col-sm-3 control-label" ><?php echo translate('title_for_vendor_section');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="pv_title" value="<?php echo $this->crud_model->get_type_name_by_id('ui_settings','17','value'); ?>"  class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label" ><?php echo translate('number_of_vendor_(_to_show_)');?></label>
                                <div class="col-sm-6">
                                    <input type="number" name="vendor_no" value="<?php echo $this->crud_model->get_type_name_by_id('ui_settings','21','value'); ?>"  class="form-control">
                                </div>
                            </div>
            				<div class="form-group col-sm-12">
                            	<span class="btn btn-success btn-labeled fa fa-check submitter pull-right enterer" type= data-ing='<?php echo translate('updating'); ?>' data-msg='<?php echo translate('vendor_section_updated!'); ?>'>
									<?php echo translate('update');?>
                                </span>
                            </div>
            			</form>
                        </div>
                    </div>
                </div>
                <?php
					}
				?>
            </div>
        </div>
    </div>
</div>

<script>

function createColorpickers() {

	$('.demo2').colorpicker({
		format: 'rgba'
	});
	
}
function check_category_slider(){
	if($('#set_slides').is(':checked')){
		$('.top_cat').show();
		$('.top_cat_update').show();
		$('.deal').show();
	}
	else{
		$('.top_cat').hide();
		$('.top_cat_update').hide();
		$('.deal').hide();
	}
}
$('#set_slides').on('change',function() {
	if($('#set_slides').is(':checked')){
		$('.top_cat').show('slow');
		$('.top_cat_update').show('slow');
		$('.deal').show('slow');
	}
	else{
		$('.top_cat').hide('slow');

		$('.top_cat_update').hide('slow');
		$('.deal').hide('slow');
	}
});

function check_cat_length(id,now) {
	var parent = $(now).closest(".form-group");
	if(parent.find("select option:selected").length > 9) {
		parent.find('.chosen-drop').hide();
	}
	else{
		parent.find('.chosen-drop').show();
	}
}
function set_select(){
	$('.demo-chosen-select').chosen();
	$('.demo-cs-multiselect').chosen({width:'100%'});
}

function add_home_cat_box(){
	$('#home_category_selection_box').append(''
											+'	<div class="col-sm-12 element_box">'
											+'		<div class="form-group">'
											+'			<label class="col-sm-3 control-label" for="demo-hor-2"><?php echo translate('category');?></label>'
											+'			<div class="col-sm-9 category_select_div">'
											+'			<?php
															foreach($category as $cat){
																if($this->crud_model->if_publishable_category($cat['category_id'])){
														?>'
											+'				<div class="col-sm-4 radio_checker category_btn cat_<?php echo $cat['category_id']; ?>" onClick="get_cat('+"'"+<?php echo $cat['category_id']; ?>+"'"+',this)">'
											+'					<?php echo $cat['category_name']; ?>'
											+'					<input type="checkbox" style="display:none;" class="radio_pat"'
											+'						value="<?php echo $cat['category_id']; ?>" name="category[]" />'
											+'				</div>'
											+'			<?php 
																}
															}
														?>'
											+'			</div>'
											+'		</div>'
											+'		<div class="form-group sub" style="display:none;">'
											+'			<label class="col-sm-3 control-label" for="demo-hor-3"><?php echo translate('sub-categories_(max 4)');?></label>'
											+'			<div class="col-sm-6 sub_cat">'
											+'			</div>'
											+'		</div>'
											+'		<div class="form-group">'
											+'			<label class="col-sm-3 control-label"><?php echo translate('color_preference_:');?></label>'
											+'			<div class="col-sm-6">'
											+'				<div class="input-group demo2">'
											+'				   <input type="text" value="rgba(71, 4, 103,1)" name="color1" class="form-control color_class1" />'
											+'				   <span class="input-group-addon"><i></i></span>'
											+'				</div>'
											+'			</div>'
											+'		</div>'
											+'		<div class="form-group">'
											+'			<label class="col-sm-3 control-label"><?php echo translate('title_color:');?></label>'
											+'			<div class="col-sm-6">'
											+'				<div class="input-group demo2">'
											+'				   <input type="text" value="rgba(255,255,255,1)" name="color2" class="form-control color_class2" />'
											+'				   <span class="input-group-addon"><i></i></span>'
											+'				</div>'
											+'			</div>'
											+'		</div>'
											+'		<div class="row">'
											+'			<div class="col-sm-12">'
											+'				<div class="btn btn-danger pull-right" onClick="rem_element_box(this)"><i class="fa fa-times"></i></div>'
											+'			</div>'
											+'		</div>'
											+'	</div>');
	createColorpickers();
	set_select();
	disable_selected_cat();
}

function check_sub_length(id,now) {
	var parent = $(now).closest(".form-group");
	if(parent.find("select option:selected").length > 3) {
		parent.find('.chosen-drop').hide();
	}
	else{
		parent.find('.chosen-drop').show();
	}
}
function sub_select_check(){
	$('.sub_cat').each(function(){
		var parent = $(this).closest('.sub');
		if(parent.find("select option:selected").length > 3) {
			parent.find('.chosen-drop').hide();
		}
		else{
			parent.find('.chosen-drop').show();
		}
	});
}

function top_cat_check(){
	if($('.top_cat').find("select option:selected").length > 9) {
		$('.top_cat').find('.chosen-drop').hide();
	}
	else{
		$('.top_cat').find('.chosen-drop').show();
	}
}
function disable_selected_cat(){
	$('#home_category_selection_box').find('.radio_checker').show();
	var selected_cats = [];
	$('#home_category_selection_box').find('.radio_pat').each(function(){
		if($(this).is(':checked')){
			selected_cats.push($(this).val());
		}
	});
	
	$('#home_category_selection_box').find('.category_select_div').each(function(){
		var snow = $(this);
			snow.find('.category_btn').show();
			$.each(selected_cats, function(key, value) {
				//alert(value);
				snow.find('.cat_'+value).hide();
			});
	});
	$('#home_category_selection_box').find('.category_select_div').each(function(){
		var div = $(this);
		var i = 0;
		div.find('.radio_checker').each(function() {
            if($(this).css('display') == 'block'){
				i++;
				if(i == 4){
					$(this).css('border-right','1px solid #e8e8e8');
				}
			}
        });
		var n = 0;
		div.find('.radio_checker').each(function() {
            if($(this).css('display') == 'block'){
				n++;
				if(n == i){
					$(this).css('border-right','1px solid #e8e8e8');
				}
			}
        });
	});
	

	
	setTimeout(function(){
		var p = $('#home_category_selection_box').find('.category_select_div').eq(0).find('.category_btn').length;
		//var q = selected_cats.length;
		var q = $('#home_category_selection_box').find('.category_select_div').length;
		//alert(p+'--'+q);
		if(p == q){
			$('.add_new').hide();
		} else {
			$('.add_new').show();
		}
	}, 10);
	
	
	set_checker();
}

function get_cat(id,now){
	
	setTimeout(function(){ disable_selected_cat(); }, 1);
	var parent = $(now).closest('.element_box');
	parent.find('.sub').hide('slow');
	parent.find('.color_class1').attr('name','color1['+id+']');
	parent.find('.color_class2').attr('name','color2['+id+']');
	parent.find('.sub_cat').load(base_url+'index.php/admin/ui_settings/sub_by_cat/'+id,
		function(){
			parent.find('.demo-cs-multiselect').attr('name','sub_category['+id+'][]');
			parent.find('.sub').show('slow');
			parent.find('.demo-cs-multiselect').chosen({width:'100%'});
		}
	);
}
function rem_element_box(now){
	$(now).closest('.element_box').remove();
	setTimeout(function(){
		var count=0;
		$('.box_no').each(function(){
			count=count+1;
			$(this).val(count);
		});
		disable_selected_cat();
	}, 1000);
}
function set_checker(){
	$('#home_category_selection_box').find('.radio_checker').each(function(){
		if($(this).find('input').is(':checked')){
			$(this).addClass('bordered_box');
		} else {
			$(this).removeClass('bordered_box');
		}
	});	
}

$(document).ready(function() {
	check_category_slider();
	$('#home_category_selection_box').on('click','.radio_checker',function(){
		$(this).closest('.element_box').find('input').prop("checked", false);
		$(this).find('input').prop("checked", true);
		set_checker();
	});
	$(".sw").each(function(){
		var h = $(this);
		var id = h.attr('id');
		var set = h.data('set');
		new Switchery(document.getElementById(id), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});
		var changeCheckbox = document.querySelector('#'+id);
		changeCheckbox.onchange = function() {
		  //alert($(this).data('id'));
		  ajax_load(base_url+'index.php/'+user_type+'/general_settings/'+set+'/'+changeCheckbox.checked,'site','othersd');
		  if(changeCheckbox.checked == true){
			$.activeitNoty({
				type: 'success',
				icon : 'fa fa-check',
				message : s_e,
				container : 'floating',
				timer : 3000
			});
			sound('published');
		  } else {
			$.activeitNoty({
				type : 'danger',
				icon : 'fa fa-check',
				message : s_d,
				container : 'floating',
				timer : 3000
			});
			sound('unpublished');
		  }
		  //alert(changeCheckbox.checked);
		};
	});
	$(".sw1").each(function() {
		new Switchery(document.getElementById('ban_' + $(this).data('id')), {
			color: 'rgb(100, 189, 99)'
		});
		var changeCheckbox = document.querySelector('#ban_' + $(this).data('id'));
		changeCheckbox.onchange = function() {
			ajax_load('<?php echo base_url(); ?>index.php/admin/banner/banner_publish_set/' + $(this).data('id') + '/' + changeCheckbox.checked, 'prod', 'others');
			if (changeCheckbox.checked == true) {
				$.activeitNoty({
					type: 'success',
					icon: 'fa fa-check',
					message: '<?php echo translate('banner_published!'); ?>',
					container: 'floating',
					timer: 3000
				});
				sound('published');
			} else {
				$.activeitNoty({
					type: 'danger',
					icon: 'fa fa-check',
					message: '<?php echo translate('banner_unpublished!'); ?>',
					container: 'floating',
					timer: 3000
				});
				sound('unpublished');
			}
		};
	});
	
	$(".sw2").each(function() {
		new Switchery(document.getElementById('feature_' + $(this).data('id')), {
			color: 'rgb(100, 189, 99)'
		});
		var changeCheckbox = document.querySelector('#feature_' + $(this).data('id'));
		changeCheckbox.onchange = function() {
			ajax_load('<?php echo base_url(); ?>index.php/admin/ui_settings/ui_home/feature_publish_set/' + $(this).data('id') + '/' + changeCheckbox.checked, '', '');
			if (changeCheckbox.checked == true) {
				$.activeitNoty({
					type: 'success',
					icon: 'fa fa-check',
					message: '<?php echo translate('section_published!'); ?>',
					container: 'floating',
					timer: 3000
				});
				sound('published');
			} else {
				$.activeitNoty({
					type: 'danger',
					icon: 'fa fa-check',
					message: '<?php echo translate('section_unpublished!'); ?>',
					container: 'floating',
					timer: 3000
				});
				sound('unpublished');
			}
		};
	});
	
	$(".imgInp").change(function() {
		var tar = $(this).closest('.panel-body').find('.img_show');
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				tar.attr('src', e.target.result);
			}
			reader.readAsDataURL(this.files[0]);
		}
	});
	
	$(".imgInp2").change(function() {
		var tar = $(this).closest('.form-group').find('.img_show2');
		if (this.files && this.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				tar.attr('src', e.target.result);
			}
			reader.readAsDataURL(this.files[0]);
		}
	});
	
	setTimeout(function(){ top_cat_check(); }, 1000);
	setTimeout(function(){ sub_select_check(); }, 1000);
	createColorpickers();
	set_select();
	set_switchery();
	set_checker();
	disable_selected_cat('');
});
</script>
<style>
	.element_box{
		padding:20px 10px;
		border:1px solid #eee;
		border-radius: 4px;
		margin-bottom:15px;
		
	}
	.bordered_box{    
		border: 1px solid #e8e8e8 !important;
		background: #303641 !important;
		display: block !important;
		color: #fff !important;
	}
	
	.radio_checker{
		border:1px solid #e8e8e8;
		background:#fafafa;
		height:auto;
		padding:10px 2px;
		cursor:pointer;
		text-align:center;
		color: #000;
		transition: all .6s ease-in-out;
	}
	.radio_checker:hover{	
		border: 1px solid #e8e8e8;
		background: #303641;
		display: block;
		color: #fff;
		transition: all .6s ease-in-out;
	}
	.cat_text{
		text-align:center;
		vertical-align:middle;	
	}
</style>