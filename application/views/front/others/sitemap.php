<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc><?php echo base_url();?></loc>
        <priority>1.0</priority>
    </url>
 
    <!-- Your Sitemap -->
    <?php foreach($otherurls as $url) { ?>

    <url>
        <loc><?php echo $url; ?></loc>
        <priority>0.8</priority>
    </url>
    <?php } ?>
    <?php foreach($producturls as $url) { ?>

    <url>
        <loc><?php echo $url; ?></loc>
        <priority>0.7</priority>
    </url>
    <?php } ?>
    <?php foreach($vendorurls as $url) { ?>
    
    <url>
        <loc><?php echo $url; ?></loc>
        <priority>0.5</priority>
    </url>
    <?php } ?>
 
</urlset>