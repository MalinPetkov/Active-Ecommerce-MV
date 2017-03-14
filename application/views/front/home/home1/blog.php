<!-- PAGE -->
<section class="page-section image testimonials" style="background: url(<?php echo base_url(); ?>uploads/others/parralax_blog.jpg) center top no-repeat; background-attachment:fixed; background-size:cover;">
    <div class="container">
        <h2 class="section-title section-title-lg">
            <span>
             	<?php echo $this->db->get_where('ui_settings',array('ui_settings_id' => 19))->row()->value;?>
            </span>
        </h2>
        <div class="testimonials-carousel">
            <div class="owl-carousel" id="testimonials">
                <?php
                    $limit =  $this->db->get_where('ui_settings',array('ui_settings_id' => 28))->row()->value;
                    $this->db->limit($limit);
                    $this->db->order_by("blog_id", "desc");
                    $blogs=$this->db->get('blog')->result_array();
                    foreach($blogs as $row){
                ?>
                <div class="testimonial">
                    <div class="testimonial-text">
                        <?php echo $row['title']; ?>
                    </div>
                    <div class="testimonial-name">
                        <?php echo $row['author']; ?>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->
                