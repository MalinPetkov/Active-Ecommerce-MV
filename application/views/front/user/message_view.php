<?php 
    foreach($message_data as $row)
    { 
?>
    <div class="information-title">
        <mark>
            <?php echo translate('ticket_from');?> : 
            <?php 
                $from = json_decode($row['from_where'],true);
                if($from['type'] == 'user'){
            ?>
                <?php echo $this->db->get_where('user',array('user_id'=>$from['id']))->row()->username; ?>
            </a>
            <?php	
                } else {
            ?>
                <?php echo translate('admin');?> 
            <?php
                }
            ?>
            <span class="pull-right" id="ticket_set" onClick="set_message_box()" style="cursor:pointer;">
                <i class="fa fa-refresh" style="color:#fff;"></i>
            </span>
        </mark>
    </div>
    <div id="all_messages_box">
        <div class="comments comments-scroll" id="messages_box">  
        
        </div>  
    </div>
    <hr class="page-divider">
    <div class="comments-form tickets">
        <h4 class="block-title">
            <?php echo translate('reply_message');?>
        </h4>
        <?php
            echo form_open(base_url() . 'index.php/home/ticket_reply/'.$row['ticket_id'], array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'ticket_reply',
                'enctype' => 'multipart/form-data'
            ));
        ?>
            <div class="form-group">
                <textarea placeholder="<?php echo translate('your_message');?>" class="form-control" title="comments-form-comments" name="reply" rows="6"></textarea>
            </div>
            <div class="form-group">                                    
                <span class="btn  btn-theme-transparent btn-icon-left submit_button enterer" onclick="form_submit('ticket_reply');" data-ing="<?php echo translate('replying...'); ?>" data-success="<?php echo translate('reply_sent_successfully'); ?>!" data-unsuccessful="<?php echo translate('unsuccessful'); ?>!" data-redirectclick="#ticket_set"  >
                    <i class="fa fa-comment"></i> 
                    <?php echo translate('reply');?>
                </span>
            </div>
        </form>
        <div id="ticket_setf" class="message_view" data-id="<?php echo $row['ticket_id']?>"></div> 
    </div>     
    <style>
        .comment-text {
            cursor:pointer;	
        }
    </style>
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
            set_message_box();
            //setInterval(function(){ set_message_box(); }, 3000);
        });
        
        function set_message_box(){
            $('#all_messages_box').load('<?php echo base_url(); ?>index.php/home/profile/message_box/<?php echo $row['ticket_id']?>');
        }
    </script>   
<?php 
    }
?>