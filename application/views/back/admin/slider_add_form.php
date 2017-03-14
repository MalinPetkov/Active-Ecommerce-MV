<div class="panel">
    <div class="panel-body">
          <div class="col-md-12">
			<?php
                echo form_open(base_url() . 'index.php/admin/slider/create/', array(
                    'class' => 'form-horizontal',
                    'method' => 'post',
                    'enctype' => 'multipart/form-data',
                    'id' => 'slider_form'
                ));
            ?>
                <div class="col-md-12" id="preview">
                    <div style="width:100%; overflow: hidden !important;" id="preview_div">
                        <div id="layerslider" style="width:100%;height:500px;"></div>
                        <div id="setup_slider" style="display:none;"></div>
                        <div id="backup_slider" style="display:none;">
                            <div class="ls-slide" <?php echo $style['full_slide_style']; ?> >
                                <img class="ls-bg out_background"  src="<?php echo base_url(); ?>uploads/slider_image/defaults/<?php echo $style['background']; ?>.jpg" /> 
                                <?php foreach($style['images'] as $image){ ?>
                                    <img class="ls-l out_<?php echo $image['name']; ?>" src="<?php echo base_url(); ?>uploads/slider_image/defaults/<?php echo $image['name']; ?>.png" style="<?php echo $image['style']; ?>" data-ls="<?php echo $image['data_ls']; ?>" >
                                <?php } ?>
                                <?php foreach($style['texts'] as $text){ ?>
                                    <<?php echo $text['element']; ?> class="ls-l out_<?php echo $text['name']; ?>" style="<?php echo $text['style']; ?>  color:<?php echo $text['color']; ?>; background:<?php echo $text['background']; ?>;" data-ls="<?php echo $text['data_ls']; ?>" >
                                        <?php echo $text['show_name']; ?>
                                    </<?php echo $text['element']; ?>>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <center>
                        <div class="col-md-12">
                            <span class="btn btn-info btn-labeled fa fa-location-arrow slider_preview" 
                                data-type="preview">
                                    <?php echo translate('enter_preview');?>
                            </span>
                            <span class="btn btn-success btn-labeled fa fa-check-circle submitter" 
                                data-type="publish" data-ing='<?php echo translate('creating_slider..'); ?>' data-msg='<?php echo translate('slider_added!'); ?>'>
                                    <?php echo translate('publish');?>
                            </span>
                        </div>
                    </center>
                </div>
                
                <hr>

                <div class="col-md-12 margin-top-30">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="demo-hor-inputemail">
                                <?php echo translate('title'); ?>
                            </label>
                            <div class="col-sm-6">
                                <input type="text" name="title" class="form-control required add-tooltip" data-toggle="tooltip" data-original-title="Write your slider title" > 
                                <input type="hidden" name="style_id" value="<?php echo $style_id; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-sm-4 control-label" for="demo-hor-inputemail">
							<?php echo translate('select_background_image');?></label>
                            <div class="col-sm-6">
                                <div class="prev_thumb" style="margin: 5px !important;">
                                    <img width="100px" src='' class="in_background" height="auto" >
                                </div>
                               <span class="pull-left btn btn-default btn-file">
                                    <?php echo translate('select_image');?>
                                    <input type="file" name="background" class='bckimg imgr required add-tooltip' data-toggle="tooltip">
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <div class="col-md-12 margin-top-20">
                	<div class="col-md-6">
                        <div class="panel-group" style="border: 1px solid #E6E6E6;border-radius: 4px; padding-top:20px;">
                        <?php foreach($style['images'] as $image){ ?>
                            <div class="form-group">
                                <label class="col-sm-5 control-label" for="demo-hor-inputemail">
                                    <?php echo $image['show_name']; ?>
                                        </label>
                                <div class="col-sm-6 imager">
                                    <div class="prev_thumb" style="margin: 5px !important;">
                                        <img width="100px" class="in_<?php echo $image['name']; ?>" src='<?php echo base_url(); ?>uploads/slider_image/defaults/<?php echo $image['name']; ?>.png' height="auto" >
                                    </div>
                                    <span class="pull-left btn btn-default btn-file" style="margin-right:5px;">
                                        <?php echo translate('select_image');?>
                                        <input type="file" name="<?php echo $image['name']; ?>" class="otherimg imgr add-tooltip">
                                    </span>
                                    <div class='pull-left btn btn-default cleanr'>
                                        <?php echo translate('clean'); ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        <?php } ?>
                        </div>
                    </div>
                    
                	<div class="col-md-6">
                        <div class="panel-group" style="border: 1px solid #E6E6E6;border-radius: 4px; padding-top:20px;">
                        <?php foreach($style['texts'] as $text){ ?>
                            <div class="form-group txt_group" >
                                <label class="col-sm-5 control-label" for="demo-hor-inputemail">
                                    <?php echo ucwords(str_replace('_',' ',$text['name'])); ?>
                                        </label>
                                <div class="col-sm-6">
                                    <input type="text" placeholder="" value="<?php echo $text['show_name']; ?>" 
                                                name="<?php echo $text['name']; ?>" 
                                                    class="in_<?php echo $text['name']; ?> form-control txt">
                                </div>
                            </div>                          
                            <div class="form-group spec_txt_group" data-typ="<?php echo $text['name']; ?>_color" style="display:block;">
                                <label class="col-sm-5 control-label" for="demo-hor-inputemail">
                                    <?php echo translate('font-color');?>
                                        </label>
                                <div class="col-sm-6">
                                    <div class="input-group demo2">
                                        <input type="text" name="<?php echo $text['name']; ?>_color" value="<?php echo $text['color']; ?>" class="form-control color in_<?php echo $text['name']; ?>_color " >
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group spec_txt_group" data-typ="<?php echo $text['name']; ?>_background" style="display:block;">
                                <label class="col-sm-5 control-label" for="demo-hor-inputemail">
                                    <?php echo translate('background_color');?>
                                        </label>
                                <div class="col-sm-6">
                                    <div class="input-group demo2">
                                        <input type="text" name="<?php echo $text['name']; ?>_background" value="<?php echo $text['background']; ?>" class="form-control color in_<?php echo $text['name']; ?>_background" >
                                        <span class="input-group-addon"><i></i></span>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        <?php } ?>
                        </div>
                    </div>
                </div>      
            </form>
        </div> 
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip(); 
		$('#setup_slider').html($('#backup_slider').html());
        run_prop_slide($('#layerslider'));
        createColorpickers();
    });

    $('.slider_preview').click(function() {
        load_set();
    });

    function createColorpickers() {
    
        $('.demo2').colorpicker({
            format: 'rgba'
        }).on('hidePicker.colorpicker', function(event){
              //load_set();
            });
        
    }
    function run_prop_slide(elem){
        elem.html($('#setup_slider').html());
        elem.layerSlider({
            responsive: false,
            responsiveUnder: 1280,
            layersContainer: 1280,
            skin: 'noskin',
            hoverPrevNext: false,
            skinsPath: '<?php echo base_url(); ?>template/front/layerslider/skins/'
        });
    }

    $('body').on('blur','.txt', function(){
        //load_set();
    });

    $('body').on('change','.color', function(){
        //load_set();
    });

    $('body').on('click','.cleanr', function(){
        $(this).closest('.imager').find('img').attr("src",'');
        var control = $(this).closest('.imager').find("input");
        control.replaceWith( control = control.clone( true ) );
    });

    $('body').on('change','.imgr', function(){
        var here = $(this);
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $.ajax({
                    url:load_img(here,e.target.result),
                       success:function(){
                       //load_set();
                    }
                })
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    function load_img(here,image){
        here.closest(".col-sm-6").find('.prev_thumb').find('img').attr("src",image);
    }

    function load_set(){
        $('#layerslider').remove();
        $('#preview_div').append(''
            +'<div id="layerslider" style="width:100%;height:500px;"></div>'
        );
		$('#setup_slider').html($('#backup_slider').html());
        var bck = $('.in_background').attr("src");
        if(bck !== ''){
            $('#setup_slider .out_background').attr("src",bck);
        }
        <?php foreach($style['texts'] as $text){ ?>
            var ins = $('.in_<?php echo $text['name']; ?>').val();
            var color = $('.in_<?php echo $text['name']; ?>_color').val();
            var background = $('.in_<?php echo $text['name']; ?>_background').val();
			if(ins !=''){
				$('#setup_slider .out_<?php echo $text['name']; ?>').css('color',color);
				$('#setup_slider .out_<?php echo $text['name']; ?>').css('background',background);
				$('#setup_slider .out_<?php echo $text['name']; ?>').html(ins);
			} else {
				$('#setup_slider .out_<?php echo $text['name']; ?>').remove();
			}
        <?php } ?>
        <?php foreach($style['images'] as $image){ ?>
            var ins = $('.in_<?php echo $image['name']; ?>').attr("src");
            if(ins !== ''){
                $('#setup_slider .out_<?php echo $image['name']; ?>').attr("src",ins);
            } else {
				$('#setup_slider .out_<?php echo $image['name']; ?>').remove();
			}
        <?php } ?>
        run_prop_slide($('#layerslider'));
    }


</script>