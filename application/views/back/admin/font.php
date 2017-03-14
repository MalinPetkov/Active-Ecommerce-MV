<div class="panel">
	<?php 
        $font =  $this->db->get_where('ui_settings',array('type' => 'font'))->row()->value;
    ?>
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo translate('choose_font');?></h3>
    </div>
    <?php
        echo form_open(base_url() . 'index.php/admin/general_settings/font', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => '',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <?php
                        $fonts = array(
                                    'Slabo+27px'=>'Slabo 27px',
                                    'Roboto'=>'Roboto',
                                    'Oswald'=>'Oswald',
                                    'Ubuntu'=>'Ubuntu',
                                    'Fjalla+One'=>'Fjalla One',
                                    'Lato'=>'Lato',
                                    'Lobster'=>'Lobster',
                                    'Salsa'=>'Salsa',
                                    'Fjord+One'=>'Fjord One',
                                    'New+Rocker'=>'New Rocker',
									'Raleway'=>'Raleway',
									'Lora'=>'Lora',
									'Arvo'=>'Arvo',
									'Sahitya'=>'Sahitya',
									'Dosis'=>'Dosis',
									'Poppins'=>'Poppins',
									'Glegoo'=>'Glegoo',
									'Iceberg'=>'Iceberg'
                                );
                        foreach($fonts as $n => $value){
                    ?>
                        <div class="cc-selector col-sm-4">
                            <input id="font_<?php echo str_replace('+','_',$n); ?>" type="radio" value="<?php echo $n; ?>" name="font" <?php if($font == $n){ echo 'checked'; } ?> >
                            <label class="drinkcard-cc" for="font_<?php echo str_replace('+','_',$n); ?>" 
                                style="margin-bottom:0px; width:100%; overflow:hidden; height:100px;">
                                    <?php /*?><h3><?php echo $font; ?></h3>  <?php */?>
                                   
                                    <img src="<?php echo base_url() ?>uploads/fonts/<?php echo str_replace('+','_',$n); ?>.jpg" width="100%" height="100%" alt="<?php echo str_replace('+','_',$n); ?>" />
                                   
                            </label>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <div class="panel-footer text-right">
            <span class="btn btn-success btn-labeled fa fa-check submitter enterer"  data-ing='<?php echo translate('saving'); ?>' data-msg='<?php echo translate('font_updated!'); ?>'>
                <?php echo translate('save');?>
            </span>
        </div>
    </form>
</div>