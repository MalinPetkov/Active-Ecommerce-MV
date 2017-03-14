<aside class="col-md-3 hidden-sm hidden-xs" id="sidebar">
    <!-- widget shop categories -->
    <div class="widget shop-categories">
        <div class="widget-content">
            <ul>
                <li><a href="#" onClick="get_blogs_by_cat('all')"><?php echo translate('all_blogs');?></a></li>
                <?php
                    $blogs=$this->db->get('blog_category')->result_array();
                    foreach($blogs as $row){
                ?>
                    <li>
                        <a href="#" onClick="get_blogs_by_cat('<?php echo $row['blog_category_id']; ?>')" >
                            <?php echo $row['name']; ?> 
                        </a>
                    </li>
                <?php 
                    }
                ?>
            </ul>
        </div>
    </div>
    <!-- /widget shop categories -->
    <br>
    <div class="row">
    <?php
		echo $this->html_model->widget('special_blogs');
	?>
    </div>
</aside>