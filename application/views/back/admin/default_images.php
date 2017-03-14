<div id="content-container"> 
    <div id="page-title">
        <h1 class="page-header text-overflow"></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="tab-base tab-stacked-left">
                <ul class="nav nav-tabs">
                	<?php
					$i=0;
                    foreach($default_list as $row){
						$i++;
					?>
                    <li <?php if($i==1){ ?>class="active"<?php } ?> >
                        <a data-toggle="tab" href="#<?php echo $row; ?>"><?php echo translate($row);?></a>
                    </li>
                    <?php
					}
					?>
                </ul>

                <div class="tab-content bg_grey">
                	<?php
					$i=0;
                    foreach($default_list as $row){
						$i++;
					?>
                    <div id="<?php echo $row; ?>" class="tab-pane fade <?php if($i==1){ ?>active in<?php } ?>">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?php echo translate($row);?></h3>
                            </div>
							<?php
                                echo form_open(base_url() . 'index.php/admin/default_images/set_images/'.$row.'/', array(
                                    'class' => 'form-horizontal',
                                    'method' => 'post',
                                    'id' => 'gen_set',
                                    'enctype' => 'multipart/form-data'
                                ));
                            ?>
                                <div class="panel-body">
                                    <div class="form-group margin-top-10">
                                        <div class="col-sm-12">
                                            <div class="col-sm-6 col-sm-offset-3">
                                                <center>
                                                	<?php
														if(file_exists('uploads/'.$row.'/default.jpg')){
													?>
                                                    <img class="img-responsive img-border blah" src="<?php echo base_url(); ?>uploads/<?php echo $row;?>/default.jpg"
                                                    <?php
														}else{
													?>
                                                    <img class="img-responsive img-border blah" style="width:50%;height:40%" src="">
                                                    <?php
														}
													?>
                                                    <br />
                                                    <span class="btn btn-default btn-file margin-top-10">
                                                        <?php echo translate('select_default_image');?>
                                                        <input type="file" name="<?php echo $row; ?>" class="form-control imgInp">
                                                    </span>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer text-right">
                                    <span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate($row.'_updated!'); ?>'>
                                        <?php echo translate('save');?>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
					}
					?>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="display:none;" id="site"></div>
<!-- for logo settings -->
<script>
var base_url = '<?php echo base_url(); ?>';
var user_type = 'admin';
var module = 'default_images';
var list_cont_func = 'list';
var dlt_cont_func = 'delete';

$(document).ready(function() {
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
});
</script>
