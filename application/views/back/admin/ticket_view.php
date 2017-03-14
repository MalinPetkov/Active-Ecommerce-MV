<?php 
    foreach($message_data as $row)
    { 
?>
    <h4 class="modal-title text-center padd-all">
    	<?php echo translate('ticket_from');?> 
		<?php 
            $from = json_decode($row['from_where'],true);
            if($from['type'] == 'user'){
        ?>
        <a class="btn btn-mint btn-xs btn-labeled fa fa-location-arrow" data-toggle="tooltip" 
        onclick="ajax_modal('view_user','<?php echo translate('view_profile'); ?>','<?php echo translate('successfully_viewed!'); ?>','user_view','<?php echo $from['id']; ?>')" data-original-title="View" data-container="body">
            <?php echo $this->db->get_where('user',array('user_id'=>$from['id']))->row()->username; ?>
        </a>
        <?php	
            } else {
        ?>
            <?php echo translate('admin');?> 
        <?php
            }
        ?>
        
    </h4>
    <hr style="margin-top: 10px !important;">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center pad-all">
                <div class="col-md-12"> 
                    <table class="table table-striped" style="border-radius:3px;">
                        
                        <tr>
                            <th class="custom_td"><?php echo translate('subject');?></th>
                            <td class="custom_td">
                                <?php echo $row['subject']?>
                            </td>
                        </tr>
                        
                        <tr>
                            <th class="custom_td"><?php echo translate('date_&_time');?></th>
                            <td class="custom_td">
                                <?php echo date('d M,Y h:i:s',$row['time']); ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <hr>
            </div>
            <script>
				$('.overer').click(function(){
					var now = $(this);
					if(now.hasClass('collapsed')){
						now.css('background-color','#fff');
						now.css('border-color','#fff');
						now.find('.reth').css('color','#fff');
					} else {
						now.css('background-color','#F5F5F5');
						now.css('border-color','#D8D8D8');
						now.find('.reth').css('color','black');
					}
				});
			</script>
			<?php
            $msgs=$this->db->get_where('ticket_message',array(' ticket_id'=>$row['ticket_id']))->result_array();
            foreach ($msgs as $row1){
				$from1 = json_decode($row1['from_where'],true);
            ?>
              <div class="col-md-12" >
                  <div class="col-md-12 btn btn-md btn-default overer" data-toggle="collapse" data-target="#demo<?php echo $row1['ticket_message_id']; ?>" style="cursor:pointer; background-color: #F5F5F5; border-color: #D8D8D8; margin-top: 5px;">
                  	<div class="col-md-1 text-left">
                        <div class="row" style="padding:5px;">
                            <?php
                                if($from1['type'] == 'admin'){
                            ?>
                                <img src="<?php echo $this->crud_model->logo('admin_login_logo'); ?>" class="img-sm img-border" />
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
                            class="img-sm img-border" alt="Profile Picture">
                            <?php
                                }
                            ?>
                        </div>
                     </div>
                  	 <div class="col-md-9 text-left">
                        <div class="row">
                            <b><i>
							<?php
                                if($from1['type'] == 'admin'){
                                    echo translate('admin');
                                } else if($from1['type'] == 'user'){
                                    echo $this->crud_model->get_type_name_by_id('user',$from['id'],'username');
                                }
                            ?>
                            </i></b>
                         </div>
                        <div class="row reth" style="padding:5px;">
							<?php echo limit_chars($row1['message'],160); ?>
                         </div>
                      </div>
                  	 <div class="col-md-2 text-left">
                        <div class="row">
                            <b>
                            <?php echo date('d F, Y h:i:s A',$row1['time']); ?>
                            </b>
                         </div>
                      </div>
                  </div>
                  
                  <div id="demo<?php echo $row1['ticket_message_id']; ?>" class="collapse" style="text-align:justify; border-bottom:1px solid #D8D8D8">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-10" style="padding:20px; background:white; font-size:12px;">
                        <?php echo $row1['message']; ?> 
                    </div>
                  </div>
              </div>
            <?php
                }
            ?>
        </div>
    </div>
    <div>
        <?php
			echo form_open(base_url() . 'index.php/admin/ticket/reply/'.$row['ticket_id'], array(
				'class' => 'form-horizontal',
				'method' => 'post',
				'id' => 'ticket_reply',
				'enctype' => 'multipart/form-data'
			));
		?>
            <div class="panel-body">
                <div class="form-group">
                <div class="col-sm-12" for="demo-hor-1">
                	<?php echo translate('reply_message');?>
                    	</div>
                <div class="col-sm-12">
                   <textarea  class="col-md-12 required" rows="9" data-height="200" name="reply" style="resize:both"></textarea>
                </div>
            </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    
                    <div class="col-md-6 col-md-offset-6">
                        <span class="btn btn-success btn-md btn-labeled fa fa-reply pull-right" 
                            onclick="form_submit('ticket_reply','<?php echo translate('successfully_replied!'); ?>')" >
                                <?php echo translate('reply');?>
                        </span>
                        <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                            onclick="ajax_set_full('view','<?php echo translate('view_ticket'); ?>','<?php echo translate('successfully_viewed!'); ?>','ticket_view','<?php echo $row['ticket_id']; ?>');">
                                <?php echo translate('refresh');?>
                        </span>
                    </div>
                </div>
            </div>
		</form>
	</div>    
<?php 
	}
?>        
<style>
	.custom_td{
		border-left: 1px solid #ddd;
		border-right: 1px solid #ddd;
		border-bottom: 1px solid #ddd;
	}
</style>

<script>
	
    $(document).ready(function(e) {
        proceed('to_list');
    });
	$("form").submit(function(e){
			return false;
		});
</script>