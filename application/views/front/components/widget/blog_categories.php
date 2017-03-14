<div class="col-md-12">
	<div class="widget shop-categories">
        <div class="widget-content">
            <ul>
                <li style="background: #e9e9e9;"><a href="<?php echo base_url(); ?>index.php/home/blog"><?php echo translate('blog_categories');?></a></li>
                <?php
                    $blogs=$this->db->get('blog_category')->result_array();
                    foreach($blogs as $row){
                ?>
                    <li>
                        <a href="<?php echo base_url(); ?>index.php/home/blog/<?php echo $row['blog_category_id']; ?>">
                            <?php echo $row['name']; ?> 
                        </a>
                    </li>
                <?php 
                    }
                ?>
            </ul>
        </div>
    </div>
</div>