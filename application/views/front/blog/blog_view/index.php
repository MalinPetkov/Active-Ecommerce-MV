<section class="page-section with-sidebar">
    <div class="container">
        <div class="row">
            <!-- SIDEBAR -->
            <aside class="col-md-3 sidebar hidden-sm hidden-xs" id="sidebar">
                <!-- widget shop categories -->
                <div class="widget shop-categories">
                    <div class="widget-content">
                        <ul>
                            <li><a href="<?php echo base_url(); ?>index.php/home/blog/"><?php echo translate('all_blogs');?></a></li>
                            <?php
                                $categories=$this->db->get('blog_category')->result_array();
                                foreach($categories as $row){
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
                <!-- /widget shop categories -->
                <!-- widget tabs -->
                <div class="widget widget-tabs">
                    <div class="widget-content special-blogs">
                        <ul id="tabs" class="nav nav-justified">
                            <li class="active">
                                <a href="#tab-s1" data-toggle="tab">
                                    <?php echo translate('recent');?>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-s2" data-toggle="tab">
                                    <?php echo translate('popular');?>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- tab 1 -->
                            <div class="tab-pane fade in active" id="tab-s1">
                                <div class="product-list">
                                <?php
                                    $this->db->limit(3);
                                    $this->db->order_by("blog_id", "desc");
                                    $latest=$this->db->get('blog')->result_array();
                                    foreach($latest as $row){
                                ?>
                                    <div class="media">
                                        <a class="pull-left media-link" href="<?php echo $this->crud_model->blog_link($row['blog_id']); ?>">
                                            <img class="img-responsive" src="<?php echo $this->crud_model->file_view('blog',$row['blog_id'],'','','thumb','src','',''); ?>" alt=""/>
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <div class="media-body">
                                            <h6 class="media-heading">
                                                <a href="<?php echo $this->crud_model->blog_link($row['blog_id']); ?>">
                                                    <?php echo $row['title']; ?>
                                                </a>
                                            </h6>
                                            <div class="date">
                                                <ins><?php echo $row['date']; ?></ins>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                ?>
                                </div>
                            </div>
                            <!-- tab 2 -->
                            <div class="tab-pane fade" id="tab-s2">
                                <div class="product-list">
                                    <?php
                                    $this->db->limit(3);
                                    $this->db->order_by("number_of_view", "desc");
                                    $popular=$this->db->get('blog')->result_array();
                                    foreach($popular as $row){
                                ?>
                                    <div class="media">
                                        <a class="pull-left media-link" href="<?php echo $this->crud_model->blog_link($row['blog_id']); ?>">
                                            <img class="img-responsive" src="<?php echo $this->crud_model->file_view('blog',$row['blog_id'],'','','thumb','src','',''); ?>" alt=""/>
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <div class="media-body">
                                            <h6 class="media-heading">
                                                <a href="<?php echo $this->crud_model->blog_link($row['blog_id']); ?>">
                                                    <?php echo $row['title']; ?>
                                                </a>
                                            </h6>
                                            <div class="date">
                                                <ins><?php echo $row['date']; ?></ins>
                                            </div>
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
                <!-- /widget tabs -->
            </aside>
            <!-- /SIDEBAR -->
            <!-- CONTENT -->
            <div class="col-md-9 content" id="content">
            	<?php
                	foreach($blog as $row){
				?>
            	<article class="post-wrap post-single">
                    <div class="post-media">
                        <img class="img-responsive" src="<?php echo $this->crud_model->file_view('blog',$row['blog_id'],'','','no','src','',''); ?>" alt=""/>
                    </div>
                    <div class="post-header">
                        <h2 class="post-title">
                        	<?php echo $row['title']; ?>
                        </h2>
                        <div class="post-meta">
							<?php echo translate('by'); ?> 
							<?php echo $row['author']; ?> / 
                            <?php echo $row['date']; ?>
                        </div>
                    </div>
                    <div class="buttons">
                        <div id="share"></div>
                    </div>
                    <div class="post-body">
                        <div class="post-excerpt">
                            <p class="text-xl">
                        		<?php echo $row['summery']; ?>
                            </p>
                            <p>
                            	<?php echo $row['description']; ?>
                            </p>
                        </div>
                    </div>
                </article>
               <hr class="page-divider"/>
                <?php
					}
				?>
                <div class="row">
                	<div class="col-md-12">
                		<?php
							$discus_id = $this->db->get_where('general_settings',array('type'=>'discus_id'))->row()->value;
							$fb_id = $this->db->get_where('general_settings',array('type'=>'fb_comment_api'))->row()->value;
							$comment_type = $this->db->get_where('general_settings',array('type'=>'comment_type'))->row()->value;
						?>
						<?php if($comment_type == 'disqus'){ ?>
                        <div id="disqus_thread"></div>
                        <script type="text/javascript">
                            /* * * CONFIGURATION VARIABLES * * */
                            var disqus_shortname = '<?php echo $discus_id; ?>';
                            
                            /* * * DON'T EDIT BELOW THIS LINE * * */
                            (function() {
                                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                            })();
                        </script>
                        <script type="text/javascript">
                            /* * * CONFIGURATION VARIABLES * * */
                                var disqus_shortname = '<?php echo $discus_id; ?>';
                            
                            /* * * DON'T EDIT BELOW THIS LINE * * */
                            (function () {
                                var s = document.createElement('script'); s.async = true;
                                s.type = 'text/javascript';
                                s.src = '//' + disqus_shortname + '.disqus.com/count.js';
                                (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
                            }());
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
                        <?php
                            }
                            else if($comment_type == 'facebook'){
                        ?>
            
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=<?php echo $fb_id; ?>";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-comments" data-href="<?php echo $this->crud_model->product_link($row['product_id']); ?>" data-numposts="5"></div>
            
                        <?php
                            }
                        ?>
                	</div>
                </div>
            </div>
            <!-- /CONTENT -->
        </div>
    </div>
</section>
<script>
	$(document).ready(function() {
		$('#share').share({
			networks: ['facebook','googleplus','twitter','linkedin','tumblr','in1','stumbleupon','digg'],
			theme: 'square'
		});
	});
</script>