<?php
    foreach($product_data as $row){
?>
<div class="row">
    <div class="col-md-12">
        <?php
			echo form_open(base_url() . 'index.php/admin/digital/update/' . $row['product_id'], array(
				'class' => 'form-horizontal',
				'method' => 'post',
				'id' => 'digital_edit',
				'enctype' => 'multipart/form-data'
			));
		?>
            <!--Panel heading-->
            <div class="panel-heading">
                <div class="panel-control" style="float: left;">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#product_details"><?php echo translate('product_details'); ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#business_details"><?php echo translate('business_details'); ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#requirements_tab"><?php echo translate('requirements'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="tab-base">
                    <!--Tabs Content-->                    
                    <div class="tab-content">
                        <div id="product_details" class="tab-pane fade active in">

                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-1">
                                    <?php echo translate('product_title');?>
                                        </label>
                                <div class="col-sm-6">
                                    <input type="text" name="title" id="demo-hor-1" value="<?php echo $row['title']; ?>" placeholder="<?php echo translate('product_title');?>" class="form-control required">
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('add_logo');?></label>
                                <div class="col-sm-6">
                                	<img class="img-responsive blah" width="100px"  src="<?php echo base_url(); ?>uploads/digital_logo_image/<?php echo $row['logo']; ?>"  >
                                    <br>
                                	<span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_logo');?>
                                        <input type="file" name="logo" class="form-control imgInp">
                                    </span>
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('category');?></label>
                                <div class="col-sm-6">
                                    <?php echo $this->crud_model->select_html('category','category','category_name','edit','demo-chosen-select required',$row['category'],'digital','ok','get_cat'); ?>
                                </div>
                            </div>
                            <div class="form-group btm_border" id="sub" >
                                <label class="col-sm-4 control-label" for="demo-hor-3"><?php echo translate('sub-category');?></label>
                                <div class="col-sm-6" id="sub_cat">
                                    <?php echo $this->crud_model->select_html('sub_category','sub_category','sub_category_name','edit','demo-chosen-select required',$row['sub_category'],'category',$row['category']); ?>
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('tags');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="tag" data-role="tagsinput" placeholder="<?php echo translate('tags');?>" value="<?php echo $row['tag']; ?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('images');?></label>
                                <div class="col-sm-6">
                                    <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
                                        <input type="file" multiple name="images[]" onchange="preview(this);" id="demo-hor-inputpass" class="form-control">
                                    </span>
                                    <br><br>
                                    <span id="previewImg" ></span>
                                </div>
                            </div>

                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"></label>
                                <div class="col-sm-6">
                                    <?php 
                                        $images = $this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','all');
                                        if($images){
                                            foreach ($images as $row1){
                                                $a = explode('.', $row1);
                                                $a = $a[(count($a)-2)];
                                                $a = explode('_', $a);
                                                $p = $a[(count($a)-2)];
                                                $i = $a[(count($a)-3)];
                                    ?>
                                        <div class="delete-div-wrap">
                                            <span class="close">&times;</span>
                                            <div class="inner-div">
                                                <img class="img-responsive" width="100" src="<?php echo $row1; ?>" data-id="<?php echo $i.'_'.$p; ?>" alt="User_Image" >
                                            </div>
                                        </div>
                                    <?php 
                                            }
                                        } 
                                    ?>
                                </div>
                            </div>
                            <?php
                            	if($row['video']=='[]'){
							?>
                            <input type="hidden" value="no" id="vdo_status">
                            <div class="form-group btm_border" id="vdo_add_selector">
                            	<label class="col-sm-4 control-label" for="demo-hor-inputpass"></label>
                                <div class="col-sm-6">
                                    <h4 class="pull-left">
                                        <i><?php echo translate('if_you_need_to_add_video_for_your_product_,_please_click_here...');?></i>
                                    </h4>
                                    <div id="vdo_add_btn" class="btn btn-mint btn-labeled fa fa-plus pull-right">
                                    <?php echo translate('add_video');?></div>
                                </div>
                            </div>
                            <?php
								}else{
									$video= json_decode($row['video'],true);
                            		if($video[0]['type'] == 'upload'){	
							?>
                            <input type="hidden" value="upload" id="vdo_type">
                            <div class="form-group btm_border" id="uploaded_vdo">
                                <label class="col-sm-4 control-label"><?php echo translate('video');?></label>
                                <div class="col-sm-6">
                                    <video controls width="400" height="300">
                                    	<source src="<?php echo base_url();?><?php echo $video[0]['video_src'];?>">
                                    </video>
                                </div>
                            </div>
                            <?php
									}elseif($video[0]['type'] == 'share'){
							?>
                            <input type="hidden" value="share" id="vdo_type">
                            <div class="form-group btm_border" id="shared_vdo">
                                <label class="col-sm-4 control-label"><?php echo translate('video');?></label>
                                <div class="col-sm-6">
                                    <iframe controls="2" width="400" height="300" src="<?php echo $video[0]['video_src'];?>" frameborder="0">
                                    </iframe>
                                </div>
                            </div>
                            <?php
									}
							?>
                            <input type="hidden" value="yes" id="vdo_status">
                            <div class="form-group btm_border" id="vdo_change_selector">
                                <label class="col-sm-4 control-label" for="demo-hor-inputpass"></label>
                                <div class="col-sm-6">
                                    <h4 class="pull-left">
                                        <i><?php echo translate('if_you_need_to_change_this_video_for_your_product_,_please_click_here...');?></i>
                                    </h4>
                                    <div id="vdo_change_btn" class="btn btn-mint btn-labeled fa fa-plus pull-right">
                                    	<?php echo translate('change_video');?>
                                    </div>
                                </div>
                            </div>
                            <?php
								}
							?>
                            <div class="form-group btm_border" id="vdo_add_option" style="display:none">
                            
                            </div>
                            <div class="form-group btm_border" id="vdo_change_option" style="display:none">
                            
                            </div>
                            <div class="form-group btm_border" id="video_upload" style="display:none">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <?php echo translate('upload_video');?>
                                    </label>
                                    <div class="col-sm-6 abstract">
                                        <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_video_file');?>
                                   			<input type="file" name="videoFile" class="videoInp" accept="video/*">
                                    	</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label"></label>
                                    <div class="col-sm-6 abstract">
                                        <div id="message"></div>
                                        <video controls id="upload_video" width="400">
                                        </video>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group btm_border" id="video_share" style="display:none">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <?php echo translate('choose_sharing_site');?>
                                    </label>
                                    <div class="col-sm-6 abstract">
                                        <select class="demo-chosen-select" name="site" id="site">
                                            <option><?php echo translate('choose_one');?></option>
                                            <option value="youtube"><?php echo translate('youtube');?></option>
                                            <option value="dailymotion"><?php echo translate('dailymotion');?></option>
                                            <option value="vimeo"><?php echo translate('vimeo');?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">
                                        <?php echo translate('link');?>
                                    </label>
                                    <div class="col-sm-6 abstract">
                                        <input type="text" name="video_link" class="form-control video_link" onchange="video_preview(this.value)" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-4" id="video_preview">
                                        
                                    </div>
                                </div>
                                <input type="hidden" value="" id="vl" name="video_code" />
                            </div>
                            
                            <div class="form-group btm_border" id="product_file" >
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('update_product_file');?></label>
                                <div class="col-sm-6">
                                    <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?> (<?php echo translate('compressed');?> *.zip/*.rar)
                                        <input type="file" name="product_file" onchange="preview_details(this);" id="digital_file" class="form-control"  accept='application/zip,application/rar'>
                                    </span>

                                    <br><br>
                                    <span>
                                        <?php echo translate('maximum_size').' : '.ini_get("upload_max_filesize"); ?>
                                    </span>
                                    <span id="previewdetails" ></span>
                                </div>
                            </div>

                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-14">
                                    <?php echo translate('description');?>
                                        </label>
                                <div class="col-sm-6">
                                    <textarea rows="9" class="summernotes" data-height="200" data-name="description">
                                        <?php echo $row['description']; ?>
                                    </textarea>
                                </div>
                            </div>
                            <?php
                                $all_af = $this->crud_model->get_additional_fields($row['product_id']);
                            ?>
                            <div id="more_additional_fields">
                            <?php
                                if(!empty($all_af)){
                                    foreach($all_af as $row1){
                            ?> 
                                <div class="form-group btm_border">
                                    <div class="col-sm-4">
                                        <input type="text" name="ad_field_names[]" value="<?php echo $row1['name']; ?>" placeholder="Field Name" class="form-control" >
                                    </div>
                                    <div class="col-sm-5">
                                          <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values[]"><?php echo $row1['value']; ?></textarea>
                                    </div>
                                    <div class="col-sm-2">
                                        <span class="remove_it_v btn btn-primary" onclick="delete_row(this)">X</span>
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
                                        <h4 class="pull-left">
                                            <i><?php echo translate('if_you_need_more_field_for_your_product_,_please_click_here_for_more...');?></i>
                                        </h4>
                                        <div id="more_btn" class="btn btn-primary btn-labeled fa fa-plus pull-right">
                                        <?php echo translate('add_more_fields');?></div>
                                </div>
                            </div>
                        </div>
                        <div id="business_details" class="tab-pane fade">
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-6"><?php echo translate('sale_price');?></label>
                                <div class="col-sm-4">
                                    <input type="number" name="sale_price" id="demo-hor-6" min='0' step='.01' value="<?php echo $row['sale_price']; ?>" placeholder="<?php echo translate('sale_price');?>" class="form-control required">
                                </div>
                                <span class="btn"><?php echo currency('','def'); ?></span>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-7"><?php echo translate('purchase_price');?></label>
                                <div class="col-sm-4">
                                    <input type="number" name="purchase_price" id="demo-hor-7" min='0' step='.01' value="<?php echo $row['purchase_price']; ?>" placeholder="<?php echo translate('purchase_price');?>" class="form-control required">
                                </div>
                                <span class="btn"><?php echo currency('','def'); ?></span>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-9"><?php echo translate('product_tax');?></label>
                                <div class="col-sm-4">
                                    <input type="number" name="tax" id="demo-hor-9" min='0' step='.01' value="<?php echo $row['tax']; ?>" placeholder="<?php echo translate('product_tax');?>" class="form-control">
                                </div>
                                <div class="col-sm-1">
                                    <select class="demo-chosen-select" name="tax_type">
                                        <option value="percent" <?php if($row['tax_type'] == 'percent'){ echo 'selected'; } ?> >%</option>
                                        <option value="amount" <?php if($row['tax_type'] == 'amount'){ echo 'selected'; } ?> ><?php echo currency('','def'); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-10"><?php echo translate('product_discount');?></label>
                                <div class="col-sm-4">
                                    <input type="number" name="discount" id="demo-hor-10" min='0' step='.01' value="<?php echo $row['discount']; ?>" placeholder="Product Discount" class="form-control">
                                </div>
                                <div class="col-sm-1">
                                    <select class="demo-chosen-select" name="discount_type">
                                        <option value="percent" <?php if($row['discount_type'] == 'percent'){ echo 'selected'; } ?> >%</option>
                                        <option value="amount" <?php if($row['discount_type'] == 'amount'){ echo 'selected'; } ?> ><?php echo currency('','def'); ?></option>
                                    </select>
                                </div>
                            </div> 
                        </div>         
                        <div id="requirements_tab" class="tab-pane fade">
                        	<div class="row">
                                <div id="requirements" class="col-sm-8 col-sm-offset-2">
									<?php
                                        $req= json_decode($row['requirements'],true);
                                        if(!empty($req)){
                                            foreach($req as $row1){
                                    ?>
                                    <div class="rem">
                                        <div class="form-group additional_box">
                                            <div class="col-sm-12">
                                                <input type="text" name="req_title[<?php echo $row1['index']; ?>]" placeholder="<?php echo translate('field_name');?>" value="<?php echo $row1['field'];?>" class="form-control required">
                                            </div>
                                            <div class="col-sm-12">
                                                <textarea rows="9"  class="summernotes" data-height="200" data-name="req_desc[<?php echo $row1['index']; ?>]"><?php echo $row1['desc']; ?></textarea>
                                            </div>
                                            <div class="col-sm-12">
                                                <button class="pull-right btn btn-danger removal">
                                                    <?php echo translate('remove');?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
									<?php
                                        	}
										}
                                    ?> 
                                </div>
                                <div class="col-sm-8 col-sm-offset-2">
                                    <h4 class="pull-left">
                                        <i><?php echo translate('if_you_need_to_add_requirements_of_this_product_for_customers_,please_click_here.');?></i>
                                    </h4>
                                    <div id="add_requirements" class="btn btn-mint btn-labeled fa fa-plus pull-right">
                                        <?php echo translate('add_product_requirements');?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <span class="btn btn-purple btn-labeled fa fa-hand-o-right pull-right" onclick="next_tab()"><?php echo translate('next'); ?></span>
                <span class="btn btn-purple btn-labeled fa fa-hand-o-left pull-right" onclick="previous_tab()"><?php echo translate('previous'); ?></span>
        
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-11">
                    	<span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                            onclick="ajax_set_full('edit','<?php echo translate('edit_product'); ?>','<?php echo translate('successfully_edited!'); ?>','digital_edit','<?php echo $row['product_id']; ?>') "><?php echo translate('reset');?>
                        </span>
                     </div>
                     <div class="col-md-1">
                     	<span class="btn btn-success btn-md btn-labeled fa fa-wrench pull-right enterer" onclick="form_submit('digital_edit','<?php echo translate('successfully_edited!'); ?>');proceed('to_add');" ><?php echo translate('edit');?></span> 
                     </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
    }
?>
<div id="requirements_dummy" style="display:none;">
    <div class="rem">
    	<div class="form-group additional_box">
            <div class="col-sm-12">
                <input type="text" name="req_title[{{i}}]" placeholder="<?php echo translate('field_name');?>" class="form-control required">
            </div>
            <div class="col-sm-12">
                <textarea rows="9"  class="summernotes_o" data-height="200" data-name="req_desc[{{i}}]"></textarea>
            </div>
            <div class="col-sm-12">
                <button class="pull-right btn btn-danger removal">
                    <?php echo translate('remove');?>
                </button>
            </div>
        </div>
    </div>
</div>
<div id="vdo_select_html" style="display:none;">
	<div id="option_set">
    	<label class="col-sm-4 control-label">
			<?php echo translate('video_options');?>
        </label>
        <div class="col-sm-6">
            <select class="demo-chosen-select_o" name="upload_method" onchange="video_sector(this.value)">
                <option value="default" selected><?php echo translate('choose_an_option');?></option>
                <option value="upload"><?php echo translate('upload_video')?></option>
                <option value="share"><?php echo translate('share_link');?></option>
                <option value="not_now"><?php echo translate('i_want_to_add_video_later');?></option>
            </select>
        </div>
    </div>
</div>
<div id="vdo_change_select_html" style="display:none;">
	<div id="change_option_set">
    	<label class="col-sm-4 control-label">
			<?php echo translate('video_options');?>
        </label>
        <div class="col-sm-6">
            <select class="demo-chosen-select_o" name="upload_method" onchange="video_change_sector(this.value)">
                <option value="default" selected><?php echo translate('choose_an_option');?></option>
                <option value="upload"><?php echo translate('upload_video')?></option>
                <option value="share"><?php echo translate('share_link');?></option>
                <option value="not_now"><?php echo translate('i_want_to_change_video_later');?></option>
                <option value="delete"><?php echo translate('i_want_to_remove_existing_video');?></option>
            </select>
        </div>
    </div>
</div>
<script>
	function vdo_selector_add(){
		var vdo_select_html = $('#vdo_select_html').html();
		vdo_select_html = vdo_select_html.replace(/demo-chosen-select_o/g, 'demo-chosen-select'); 
		$('#vdo_add_option').append(vdo_select_html);
		set_select();
	}
	function vdo_change_selector(){
		var vdo_change_select_html = $('#vdo_change_select_html').html();
		vdo_change_select_html = vdo_change_select_html.replace(/demo-chosen-select_o/g, 'demo-chosen-select'); 
		$('#vdo_change_option').append(vdo_change_select_html);
		set_select();
	}
	$('#vdo_add_btn').click(function(){
		vdo_selector_add();
		$('#vdo_add_selector').hide('slow');
		$('#vdo_add_option').show('show');
	});
	$('#vdo_change_btn').click(function(){
		var vdo_type = $('#vdo_type').val();
		if(vdo_type=='upload'){
			$('#uploaded_vdo').hide('slow');
		}
		else if(vdo_type=='share'){
			$('#shared_vdo').hide('slow');
		}
		$('#vdo_change_selector').hide('slow');
		vdo_change_selector();
		$('#vdo_change_option').show('slow');
	});
	function preview_details(){
		var x = document.getElementById("digital_file");
		var txt = "";
		if ('files' in x) {
			if (x.files.length == 0) {
				txt = "Select one or more files.";
			} else {
				for (var i = 0; i < x.files.length; i++) {
					txt += "<br><br>";
					var file = x.files[i];
					if ('name' in file) {
						txt += "<b>Name:</b> " + file.name + "<br>";
					}
					if ('size' in file) {
						txt += "<b>Size:</b> " + file.size/1000 + " KB <br>";
					}
				}
			}
		}
		else {
			if (x.value == "") {
				txt += "Select one or more files.";
			} else {
				txt += "The files property is not supported by your browser!";
				txt  += "<br>The path of the selected file: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead.
			}
		}
		document.getElementById("previewdetails").innerHTML = txt;
	}
	$('#remove_btn').click(function(){
		vdo_selector_add();
		$('#vdo_add_selector').hide('slow');
		$('#vdo_add_option').show('show');
	});
	function video_sector(upload_type){
		if(upload_type == 'upload'){
			$('#video_share').hide('slow');
			$('#video_upload').show('slow');
		}else if(upload_type == 'share'){
			$('#video_upload').hide('slow');
			$('#video_share').show('slow');
		}
		else if(upload_type == 'not_now'){
			$('.row #option_set').remove();
			$('#vdo_add_option').hide('slow');
			$('#video_share').hide('slow');
			$('#video_upload').hide('slow');
			$('#vdo_add_selector').show('slow');
		}
	}
	
	function video_change_sector(upload_type){
		if(upload_type == 'upload'){
			$('#video_share').hide('slow');
			$('#video_upload').show('slow');
		}else if(upload_type == 'share'){
			$('#video_upload').hide('slow');
			$('#video_share').show('slow');
		}
		else if(upload_type == 'not_now'){
			$('.row #change_option_set').remove();
			$('#vdo_change_selector').hide('slow');
			$('#video_share').hide('slow');
			$('#video_upload').hide('slow');
			var vdo_type = $('#vdo_type').val();
			if(vdo_type=='upload'){
				$('#uploaded_vdo').show('slow');
			}
			else if(vdo_type=='share'){
				$('#shared_vdo').show('slow');
			}
			$('#vdo_change_selector').show('slow');
		}
		else if(upload_type == 'delete'){;
			$('#video_share').hide('slow');
			$('#video_upload').hide('slow');
		}
	}
	
	function video_preview(v_link){
		var site = $('#site').val();
		if(site == 'youtube'){
			var x = v_link.split('=');
			var video_link = x[1];
		}
		else if(site == 'dailymotion'){
			var temp = v_link.split('/');
			var x = temp[4].split('_');
			var video_link = x[0];
		}
		else if(site == 'vimeo'){
			var x = v_link.split('/');
			var video_link = x[3];
		}
		$('#vl').val(video_link);
		$('#video_preview').load('<?php echo base_url();?>index.php/admin/digital/video_preview/'+site+'/'+video_link);
	}
	
	(function localFileVideoPlayer(){
		'use strict'
		var URL = window.URL || window.webkitURL ;
		var displayMessage = function (message, isError){
			var element = document.querySelector('#message');
			element.innerHTML = message;
			element.className = isError ? 'error' : 'info' ;
		}
		var playSelectedFile = function (event) {
			var file = this.files[0];
			var type = file.type;
			var videoNode = document.querySelector('#upload_video');
			var canPlay = videoNode.canPlayType(type);
			if (canPlay === '') canPlay = 'no';
			//var message = 'Can play type "' + type + '": ' + canPlay ;
			var isError = canPlay === 'no' ;
			//displayMessage(message, isError) ;
			
			if (isError) {
			  return
			}
			
			var fileURL = URL.createObjectURL(file);
			videoNode.src = fileURL;
		}
		var inputNode = document.querySelector('.videoInp');
		inputNode.addEventListener('change', playSelectedFile, false);
	})();
</script>
<input type="hidden" id="req_count" value="-1">
<!--Bootstrap Tags Input [ OPTIONAL ]-->
<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

<script type="text/javascript">
    window.preview = function (input) {
        if (input.files && input.files[0]) {
            $("#previewImg").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });
        }
    }

     $('.delete-div-wrap .close').on('click', function() { 
	 	var pid = $(this).closest('.delete-div-wrap').find('img').data('id'); 
		var here = $(this); 
		msg = 'Really want to delete this Image?'; 
		bootbox.confirm(msg, function(result) {
			if (result) { 
				 $.ajax({ 
					url: base_url+'index.php/'+user_type+'/'+module+'/dlt_img/'+pid, 
					cache: false, 
					success: function(data) { 
						$.activeitNoty({ 
							type: 'success', 
							icon : 'fa fa-check', 
							message : 'Deleted Successfully', 
							container : 'floating', 
							timer : 3000 
						}); 
						here.closest('.delete-div-wrap').remove(); 
					} 
				}); 
			}else{ 
				$.activeitNoty({ 
					type: 'danger', 
					icon : 'fa fa-minus', 
					message : 'Cancelled', 
					container : 'floating', 
					timer : 3000 
				}); 
			}; 
		  }); 
		});
		
	function readURL_all(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
			var parent = $(input).closest('.form-group');
            reader.onload = function (e) {
                parent.find('.wrap').hide('fast');
                parent.find('.blah').attr('src', e.target.result);
                parent.find('.wrap').show('fast');
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $(".tab-content").on('change','.imgInp',function(){
        readURL_all(this);
    });

    function other_forms(){}
	
	function set_summer(){
        $('.summernotes').each(function() {
            var now = $(this);
            var h = now.data('height');
            var n = now.data('name');
			if(now.closest('div').find('.val').length == 0){
            	now.closest('div').append('<input type="hidden" class="val" name="'+n+'">');
			}
            now.summernote({
                height: h,
                onChange: function() {
                    now.closest('div').find('.val').val(now.code());
                }
            });
			now.closest('div').find('.val').val(now.code());
        });
	}

    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
    
    $(document).ready(function() {
        set_select();
        set_summer();
    });

    function other(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
        $('#sub').show('slow');
    }
    function get_cat(id){
        $('#brand').html('');
        $('#sub').hide('slow');
        ajax_load(base_url+'index.php/admin/digital/sub_by_cat/'+id,'sub_cat','other');
    }

    function get_sub_res(id){}
	
    
    $("#more_btn").click(function(){
        $("#more_additional_fields").append(''
            +'<div class="form-group">'
            +'    <div class="col-sm-4">'
            +'        <input type="text" name="ad_field_names[]" class="form-control"  placeholder="<?php echo translate('field_name'); ?>">'
            +'    </div>'
            +'    <div class="col-sm-5">'
            +'        <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values[]"></textarea>'
            +'    </div>'
            +'    <div class="col-sm-2">'
            +'        <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>'
            +'    </div>'
            +'</div>'
        );
        set_summer();
    });
    
    $('body').on('click', '.rms', function(){
        $(this).parent().parent().remove();
    });
	
	$('#add_requirements').click(function(){
		var requirements_html = $('#requirements_dummy').html();
		var l = $('#req_count').val();
		ln = parseInt(Number(l)+1);
		requirements_html = requirements_html.replace(/{{i}}/g, ln);
		requirements_html = requirements_html.replace(/summernotes_o/g, 'summernotes');
		$('#req_count').val(ln);
		setTimeout(function(){ 
			$('#requirements').append(requirements_html);
			set_summer();
		}, 1);
	});
	$('body').on('click','.removal',function(){
		$(this).closest('.rem').remove();
	});

    function next_tab(){
        $('.nav-tabs li.active').next().find('a').click();                    
    }
    function previous_tab(){
        $('.nav-tabs li.active').prev().find('a').click();                     
    }

   
    function delete_row(e)
    {
        e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
    }    
	
	
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>
<style>
	.btm_border{
		border-bottom: 1px solid #ebebeb;
		padding-bottom: 15px;	
	}
	
	.additional_box{
		border: 1px solid #ebebeb;
		border-radius:5px;
		padding:0 0 10px 0;
	}
	.additional_box input{
		margin:10px auto;
	}
	.additional_box .removal{
		margin:10px auto;
	}
</style>

