<?php
    foreach($page_data as $row){
?>
    <div class="row">
        <div class="col-md-12">
			<?php
                echo form_open(base_url() . 'index.php/admin/page/update/' . $row['page_id'], array(
                    'class' => 'form-horizontal',
                    'method' => 'post',
                    'id' => 'page_edit',
                    'enctype' => 'multipart/form-data'
                ));
            ?>
                <div class="panel-body">
                    <div class="form-group btm_border">
                        <label class="col-sm-4 control-label" for="page_name"><?php echo translate('page_title');?></label>
                        <div class="col-sm-6">
                            <input type="text" name="page_name" id="page_name" placeholder="<?php echo translate('page_title'); ?>" class="form-control required" value="<?php echo $row['page_name']; ?>">
                        </div>
                    </div>
                    
                    <div class="form-group btm_border">
                        <label class="col-sm-4 control-label" for="page_code"><?php echo translate('parmalink');?></label>
                        <div class="col-sm-6">
                            <input type="text" name="parmalink" id="page_code" placeholder="<?php echo translate('page_code'); ?>" class="form-control disabled required" value="<?php echo $row['parmalink']; ?>">
                        </div>
                    </div>
                                                   
                    <div class="form-group btm_border">
                        <label class="col-sm-4 control-label" ><?php echo translate('tags');?></label>
                        <div class="col-sm-6">
                            <input type="text" name="tag" data-role="tagsinput" placeholder="<?php echo translate('page_tags'); ?>" class="form-control" value="<?php echo $row['tag']; ?>">
                        </div>
                    </div> 
                    
                    <div class="form-group btm_border">
                        <label class="col-sm-4 control-label" >
							<?php echo translate('number_of_page_parts');?>
                            	</label>
                        <div class="col-sm-6">
                            <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn" id="part_num">
                                <?php echo translate('lets_start_to_create_your_page');?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="form-group btm_border col-md-12">
                        <label class="col-sm-4 control-label" ><?php echo translate('parts'); ?></label>
                        <div class="col-md-12" style="padding:0px !important;">
                            <div id="all_parts" >
                                <?php 
									$parts	= json_decode($row['parts'],true); 
										$i = 0;
										foreach($parts as $row1){
										$size		= $row1['size'];
										$type		= $row1['type'];
										$content	= $row1['content'];
										$widget		= explode(',',$row1['widget']);
										$i++;	
								?>
                            	<div class="sets col-md-<?php echo $size; ?>">
                                	<div class="panel panel-bordered panel-info">
                                		<div class="panel-heading">
                                          <span class="pull-right remove rmc"><i class="fa fa-times-circle"></i></span>
                                			<h3 class="panel-title"><?php echo translate('column');?> : <?php echo $i; ?></h3>
                                		</div>
                                		<div class="panel-body">
                                        <div class="col-sm-12">
                                            <select name="part_size[]" class="demo-chosen-select size" >
                                                <option value="0" 
                                                    <?php if($size == '0'){ echo 'selected';} ?>>
                                                        <?php echo translate('select_size');?>
                                                </option>
                                                <option value="3" 
                                                    <?php if($size == '3'){ echo 'selected';} ?>>
                                                        <?php echo translate('one-fourth');?>
                                                </option>
                                                <option value="4" 
                                                    <?php if($size == '4'){ echo 'selected';} ?>>
                                                        <?php echo translate('one-third');?>
                                                </option>
                                                <option value="6" 
                                                    <?php if($size == '6'){ echo 'selected';} ?>>
                                                        <?php echo translate('half');?>
                                                </option>
                                                <option value="8" 
                                                    <?php if($size == '8'){ echo 'selected';} ?>>
                                                        <?php echo translate('two-third');?>
                                                </option>
                                                <option value="9" 
                                                    <?php if($size == '9'){ echo 'selected';} ?>>
                                                        <?php echo translate('three-fourth');?>
                                                </option>
                                                <option value="12" 
                                                    <?php if($size == '12'){ echo 'selected';} ?>>
                                                        <?php echo translate('full');?>
                                                </option>
                                            </select>
                                         </div>
                                   		 <div class="col-sm-12">
                                            <select name="part_content_type[]" class="demo-cs-multiselect type" >
                                                <option value=""><?php echo translate('select_type');?></option>
                                                <option value="content" 
                                                    <?php if($type == 'content'){ echo 'selected';} ?>>
                                                        <?php echo translate('content');?>
                                                </option>
                                                <option value="widget" 
                                                    <?php if($type == 'widget'){ echo 'selected';} ?>>
                                                        <?php echo translate('widget');?>
                                                </option>
                                            </select>
                                   		 </div>
                                			<div class="col-sm-12 widget" <?php if($type !== 'widget'){ ?>style="display:none;"<?php } ?>>
                                            <select class="demo-cs-multiselect widget_select" multiple >
                                            	<?php
                                                $widget_all=array("product_categories","blog_categories","advance_search","special_products","special_blogs");
												foreach($widget as $row2){
												?>
                                                <option value="<?php echo $row2; ?>" selected>
                                                        <?php echo translate($row2);?>
                                                </option>
                                                <?php
												}
												foreach($widget_all as $row3){
													if(!in_array($row3,$widget)){
												?>
                                                <option value="<?php echo $row3; ?>">
                                                        <?php echo translate($row3);?>
                                                </option>
                                                <?php
													}
												}
												?>
                                        </select>
                                      </div>
                                      <input type="hidden" name="part_widget[]" class="hidd" />
                                   		 <div class="col-sm-12 content" <?php if($type !== 'content'){ ?>style="display:none;"<?php } ?>>
                                				<div class="abstract">
                                					<textarea rows="9"  class="summernotes" data-height="400" data-name="part_content[]"><?php echo $content; ?></textarea>
                                   		 	</div>
                                   		 </div>
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
        
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-11">
                            <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                            	onclick="ajax_set_full('edit','<?php echo translate('edit_page'); ?>','<?php echo translate('successfully_edited!'); ?>','page_edit','<?php echo $row['page_id']; ?>')">
                                	<?php echo translate('reset');?>
                            </span>
                        </div>
                        
                        <div class="col-md-1">
                            <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right" onclick="form_submit('page_edit','<?php echo translate('successfully_edited!'); ?>')" ><?php echo translate('upload');?></span>
                        </div>
                        
                    </div>
                </div>
        
            </form>
        </div>
    </div>
    <input type="hidden" id="nums" value='1' />

<?php
    }
?>

    <script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
    </script>
    
    <script>
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
    
        function other_forms(){}
		
        function set_summer(){
            $('.summernotes').each(function() {
                var now = $(this);
                var h = now.data('height');
                var n = now.data('name');
                if(now.closest('.abstract').find('.val').length){
                } else {
                    now.closest('.abstract').append('<input type="hidden" class="val" name="'+n+'">');
                    now.summernote({
                        height: h,
                        onChange: function() {
                            now.closest('.abstract').find('.val').val(now.code());
                        }
                    });
                    now.closest('.abstract').find('.val').val(now.code());
                }
            });
        }
        
        $(document).ready(function() {
            $('.demo-chosen-select').chosen();
            $('.demo-cs-multiselect').chosen({width:'100%'});
            set_summer();
			
			$('.widget_select').each(function(index, element) {
				var a = $(this).val();
				$(this).closest('.sets').find('.hidd').val(a);
            });	
			
        });
        function other(){
            $('.demo-chosen-select').chosen();
            $('.demo-cs-multiselect').chosen({width:'100%'});
        }
        
        $("#page_name").blur(function(){
            var val = $(this).val();
            val = val.split(' ').join('_');
            $("#page_code").val(val);
        });
	
		$("#part_num").click(function(){
			var num = $('#all_parts').find('.sets').length;
			var no	= $('#nums').val();
			var htmls = '';
			htmls =	htmls
				+'<div class="sets col-md-3">'
				+'	<div class="panel panel-bordered panel-info">'
				+'		<div class="panel-heading">'
				+'          <span class="pull-right remove rmc"><i class="fa fa-times-circle"></i></span>'
				+'			<h3 class="panel-title">Column :'+no+'</h3>'
				+'		</div>'
				+'		<div class="panel-body">'
				+'   		 <div class="col-sm-12">'
				+'				<select name="part_size[]" class="demo-chosen-select size" >'
				+'					<option value="0"><?php echo translate('select_size'); ?></option>'
				+'					<option value="3"><?php echo translate('one-fourth'); ?></option>'
				+'					<option value="4"><?php echo translate('one-third'); ?></option>'
				+'					<option value="6"><?php echo translate('half'); ?></option>'
				+'					<option value="8"><?php echo translate('two-third'); ?></option>'
				+'					<option value="9"><?php echo translate('three-fourth'); ?></option>'
				+'					<option value="12"><?php echo translate('full'); ?></option>'
				+'   		 	</select>'
				+'  		  </div>'
				+'   		 <div class="col-sm-12">'
				+'				<select name="part_content_type[]" class="demo-cs-multiselect type" >'
				+'					<option value=""><?php echo translate('select_type'); ?></option>'
				+'					<option value="content"><?php echo translate('content'); ?></option>'
				+'					<option value="widget"><?php echo translate('widget'); ?></option>'
				+'    			</select>'
				+'   		 </div>'
				+'    		<div class="col-sm-12 widget" style="display:none;">'
				+'				<select class="demo-cs-multiselect widget_select" name="" multiple >'
				+'				<option value=""><?php echo translate('select_type'); ?></option>'
								<?php
									$data=array("product_categories","blog_categories","advance_search","special_products","special_blogs");
									foreach($data as $row){
								?>
				
				+'					<option value="<?php echo $row; ?>"><?php echo translate($row); ?></option>'
								<?php
									}
								?>
				+'  		  	</select>'
				+'  		  </div>'
				+'  		  <input type="hidden" name="part_widget[]" class="hidd" />'
				+'   		 <div class="col-sm-12 content" style="display:none;">'
				+'				<div class="abstract">'
				+'					<textarea rows="9"  class="summernotes" data-height="400" data-name="part_content[]"></textarea>'
				+'   		 	</div>'
				+'   		 </div>'
				+'		</div>';
				+'	</div>';
				+'</div>';
			if(num <= 3){
				$("#all_parts").append(htmls);
				$('#nums').val(Number($('#nums').val())+1);
			} else {
				$.activeitNoty({
					type: 'danger',
					icon : 'fa fa-times',
					message : '<?php echo translate('not_more_than_4_columns!'); ?>',
					container : 'floating',
					timer : 3000
				});
			}
			set_summer();
			other();
		});
        
        $('body').on('click', '.rmc', function(){
            $(this).closest('.sets').remove();
        });
        
        $('body').on('change', '.widget_select', function(){	
            var a = $(this).val();
            $(this).closest('.sets').find('.hidd').val(a);
        });
        
        $('body').on('change', '.size', function() {
            var a = $(this).val();
            var p = $(this).parent().parent().parent().parent();
            p.attr('class','');
            p.addClass('sets');
            p.addClass('col-md-'+a);
        });
        
        $('body').on('change', '.type', function(){	
            var h = $(this);
            var a = h.val();
            if(a == 'widget'){
                h.parent().parent().find('.widget').show();
                h.parent().parent().find('.content').hide();
            } else if (a == 'content'){
                h.parent().parent().find('.widget').hide();
                h.parent().parent().find('.content').show();
            }
        });
    
        $(document).ready(function() {
            $("form").submit(function(e){
                return false;
            });
        });
        
    </script>
    
    <style>
    .btm_border{
      border-bottom: 1px solid #ebebeb;
      padding-bottom: 15px;	
    }
    .remove{
        color:#FFF !important;
        margin-right:5px !important;
        font-size:20px !important;
        transition: all .4s ease-in-out;	
    }
    .remove:hover{
        color:#003376 !important;	
    }
    </style>

<!--Bootstrap Tags Input [ OPTIONAL ]-->
    



