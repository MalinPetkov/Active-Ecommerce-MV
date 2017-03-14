<!DOCTYPE html>
<html lang="en">
    <head>
    <?php $ext =  $this->db->get_where('ui_settings',array('type' => 'fav_ext'))->row()->value;?>
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>template/front/ico/apple-touch-icon-144-precomposed.png">
    
    <link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/others/favicon.<?php echo $ext; ?>">
    <?php $theme =  $this->db->get_where('ui_settings',array('type' => 'header_color'))->row()->value;?>
    
    <link href="<?php echo base_url(); ?>template/front/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>template/front/css/theme.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>template/front/css/theme-<?php echo $theme; ?>.css" rel="stylesheet" id="theme-config-link">
    <?php 
        $font =  $this->db->get_where('ui_settings',array('type' => 'font'))->row()->value;
    ?>  
    <link href='https://fonts.googleapis.com/css?family=<?php echo $font; ?>:400,500,600,700,800,900' rel='stylesheet' type='text/css'>
    <style>
        *{
            font-family: '<?php echo str_replace('+',' ',$font); ?>', sans-serif;
        }
        .remove_one{
            cursor:pointer;
            padding-left:5px;   
        }
    </style>
    </head>
    <body id="home" class="wide">
        <section class="page-section text-center error-page">
            <div class="container">

                <div class="col-md-12 text-center">
                    <?php
                        $home_top_logo = $this->db->get_where('ui_settings',array('type' => 'home_top_logo'))->row()->value;
                    ?>
                    <a href="<?php echo base_url();?>">
                        <img src="<?php echo base_url(); ?>uploads/logo_image/logo_<?php echo $home_top_logo; ?>.png" width="25%"/>
                    </a>
                </div>

                <h3>404</h3>
                <h2>
                    <i class="fa fa-warning"></i> 
                    <?php echo translate('oops'); ?>!
                    <?php echo translate('the_page_you_requested_was_not_found'); ?>!
                </h2>
                <p>
                    <a class="btn btn-theme" href="<?php echo base_url(); ?>">
                        <?php echo translate('back_to_home'); ?>
                    </a>
                </p>
            </div>
        </section>
    </body>
</html>