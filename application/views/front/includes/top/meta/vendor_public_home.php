<?php
            $vendor_data = $this->db->get_where('vendor',array('vendor_id'=>$vendor_id))->result_array();
            foreach($vendor_data as $row)
            {
	?>
        <!-- Schema.org markup for Google+ -->
        <meta itemprop="name" content="<?php echo $row['display_name']; ?>">
        <meta itemprop="description" content="<?php echo str_replace('"',"'",strip_tags($row['description'])); ?>">
        <meta itemprop="image" content="<?php echo base_url(); ?>uploads/vendor_logo_image/logo_<?php echo $vendor_id; ?>.png">
        
        <!-- Twitter Card data -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@publisher_handle">
        <meta name="twitter:title" content="<?php echo $row['display_name']; ?>">
        <meta name="twitter:description" content="<?php echo str_replace('"',"'",strip_tags($row['description'])); ?>">
        <!-- Twitter summary card with large image must be at least 280x150px -->
        <meta name="twitter:image:src" content="<?php echo base_url(); ?>uploads/vendor_logo_image/logo_<?php echo $vendor_id; ?>.png">
        
        <!-- Open Graph data -->
        <meta property="og:title" content="<?php echo $row['display_name']; ?>" />
        <meta property="og:type" content="article" />
        <meta property="og:url" content="<?php  echo base_url(); ?>index.php/home/vendor_profile/<?php echo $row['vendor_id']; ?>" />
        <meta property="og:image" content="<?php echo base_url(); ?>uploads/vendor_logo_image/logo_<?php echo $vendor_id; ?>.png" />
        <meta property="og:description" content="<?php echo str_replace('"',"'",strip_tags($row['description'])); ?>" />
        <meta property="og:site_name" content="<?php echo $system_title; ?>" />
    <?php
            }
    ?>