<div class="col-md-12">
	<div class="widget shop-categories">
        <div class="widget-content">
            <ul>
                <li style="background: #e9e9e9;"><a href="<?php echo base_url(); ?>index.php/home/all_category"><?php echo translate('product_categories');?></a></li>
				<?php
                    $all_category = $this->db->get('category')->result_array();
                    foreach($all_category as $row)
                    {
						if($this->crud_model->if_publishable_category($row['category_id'])){
                ?>
                <li>
                    <a href="<?php echo base_url(); ?>index.php/home/category/<?php echo $row['category_id']; ?>">
                        <?php echo $row['category_name']; ?>
                    </a>
                </li>
                <?php
						}
                    }
                ?>
            </ul>
        </div>
    </div>
</div>