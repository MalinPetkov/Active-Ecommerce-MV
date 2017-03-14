
<div class="comments comments-scroll" id="messages_box">                            	
    <?php
        $msgs = $this->db->get_where('ticket_message',array('ticket_id'=>$ticket))->result_array();
        foreach ($msgs as $row1){
            $from1 = json_decode($row1['from_where'],true);
    ?>
        <div class="media comment">
            <a href="#" class="pull-left comment-avatar">                                
                <?php
                    if($from1['type'] == 'admin'){
                ?>
                    <img src="<?php echo $this->crud_model->logo('admin_login_logo'); ?>" class="media-object"  />
                <?php
                    } else if($from1['type'] == 'user'){
                ?>
                <img <?php if(file_exists('uploads/user_image/user_'.$from1['id'].'.jpg')){ ?>
                    src="<?php echo base_url(); ?>uploads/user_image/user_<?php echo $from1['id']; ?>.jpg"
                <?php } else if($this->db->get_where('user',array('user_id'=>$from1['id']))->row()->fb_id !== ''){ ?>
                    src="https://graph.facebook.com/<?php echo $this->db->get_where('user',array('user_id'=>$from1['id']))->row()->fb_id; ?>/picture?type=large" 
                <?php } else { ?>
                    src="<?php echo base_url(); ?>template/front/uploads/img/user.jpg"
                <?php } ?>
                class="media-object"  alt="Profile Picture">
                <?php
                    }
                ?>
            </a>
            <div class="media-body" style="display:block;">
                <p>
                    <span class="comment-author">
                        <a href="#">
                            <?php
                                
                                if($from1['type'] == 'admin'){
                                    echo translate('admin');
                                } else if($from1['type'] == 'user'){
                                    echo $this->crud_model->get_type_name_by_id('user',$from1['id'],'username');
                                }
                            ?>
                        </a> 
                        <span class="comment-date"> 
                            <?php echo date('d F, Y h:i:s A',$row1['time']); ?>
                        </span>
                    </span>
                </p>
                <p class="comment-text shortened_message">
                    <?php 
                        $msg = str_replace("<div>", "", $row1['message']);
                        $msg1 = str_replace("</div>", "", $msg);
                    ?>
                        <?php echo strip_tags(limit_chars($msg1,200)); ?>
                </p>
                <p class="comment-text big_message" style="display:none;">
                    <?php echo $row1['message']; ?>
                </p>
            </div>
        </div>
    <?php 
        }
    ?>                                
</div>
<script>											
    $(document).ready(function(){
        $('.shortened_message').on('click',function(){
            $(this).closest('.media-body').find('.shortened_message').hide();
            $(this).closest('.media-body').find('.big_message').show();
        });
        $('.big_message').on('click',function(){
            $(this).closest('.media-body').find('.shortened_message').show();
            $(this).closest('.media-body').find('.big_message').hide();
        });
        var objDiv = document.getElementById("messages_box");
        objDiv.scrollTop = objDiv.scrollHeight;
    });
</script>