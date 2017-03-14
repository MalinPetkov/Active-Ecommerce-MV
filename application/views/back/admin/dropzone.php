
                                        <?php
                                            echo form_open(base_url() . 'index.php/admin/logo_settings/upload_logo', array(
                                                'class' => 'dropzone',
                                                'method' => 'post',
                                                'id' => 'demo-dropzone',
                                                'enctype' => 'multipart/form-data'
                                            ));
                                        ?>
                                            <div class="dz-default dz-message">
                                                <div class="dz-icon icon-wrap icon-circle icon-wrap-md">
                                                    <i class="fa fa-cloud-upload fa-3x"></i>
                                                </div>
                                                <div>
                                                    <p class="dz-text"><?php echo translate('drop_logos_to_upload');?></p>
                                                    <p class="text-muted"><?php echo translate('or_click_to_pick_manually');?></p>
                                                </div>
                                            </div>
                                            <div class="fallback">
                                                <input name="logo" type="file"  />
                                            </div>
                                        </form>

<script type="text/javascript">                  
    $(document).ready(function() {

        
        
    });
</script>            