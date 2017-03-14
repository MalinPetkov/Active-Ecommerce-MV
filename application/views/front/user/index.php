<section class="page-section profile_top">
    <div class="wrap container">
    	<div class="row">
            <div class="col-md-10">
                <div class="top_nav">
                    <ul>
                        <li class="active">
                            <span id="info">
                                <?php echo translate('profile');?>
                            </span>
                        </li>
                        <li>
                        	<span id="wishlist">
                        		<?php echo translate('wishlist');?>
                        	</span>
                        </li>
                        <li>
                        	<span id="order_history">
                        		<?php echo translate('order_history');?>
                        	</span>
                        </li>
                        <li>
                        	<span id="downloads">
                        		<?php echo translate('downloads');?>
                        	</span>
                        </li>
                        <li>
                        	<span id="update_profile">
                        		<?php echo translate('edit_profile');?>
                        	</span>
                        </li>
                        <li>
                        	<span id="ticket">
                        		<?php echo translate('support_ticket');?>
                        	</span>
                        </li>
                      </ul>
                </div>
            </div>
            <div class="col-md-2">
                <div class="top_nav">
                    <ul>
                        <li><a style="color:#F00;" href="<?php echo base_url(); ?>index.php/home/logout/">logout</a></li>
                     </ul>
                </div>
            </div>
        </div>
	</div>
</section>
<hr class="hr_sp">
<section class="page-section">
    <div class="wrap container">
        <div id="profile-content">
        </div>
    </div>
</section>
<script>
	var top = Number(200);
	var loading_set = '<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>';
	
	$('#info').on('click',function(){
		$("#profile-content").html(loading_set);
		$("#profile-content").load("<?php echo base_url()?>index.php/home/profile/info");
		$("li").removeClass("active");
		$(this).closest("li").addClass("active");
	});
	$('#wishlist').on('click',function(){
		$("#profile-content").html(loading_set);
		$("#profile-content").load("<?php echo base_url()?>index.php/home/profile/wishlist");
		$("li").removeClass("active");
		$(this).closest("li").addClass("active");
	});
	$('#order_history').on('click',function(){
		$("#profile-content").html(loading_set);
		$("#profile-content").load("<?php echo base_url()?>index.php/home/profile/order_history");
		$("li").removeClass("active");
		$(this).closest("li").addClass("active");
	});
	$('#downloads').on('click',function(){
		$("#profile-content").html(loading_set);
		$("#profile-content").load("<?php echo base_url()?>index.php/home/profile/downloads");
		$("li").removeClass("active");
		$(this).closest("li").addClass("active");
	});
	$('#update_profile').on('click',function(){
		$("#profile-content").html(loading_set);
		$("#profile-content").load("<?php echo base_url()?>index.php/home/profile/update_profile");
		$("li").removeClass("active");
		$(this).closest("li").addClass("active");
	});
	$('#ticket').on('click',function(){
		$("#profile-content").html(loading_set);
		$("#profile-content").load("<?php echo base_url()?>index.php/home/profile/ticket");
		$("li").removeClass("active");
		$(this).closest("li").addClass("active");
	});
	$('#message_view').on('click',function(){
		$("#profile-content").html(loading_set);
		$("#profile-content").load("<?php echo base_url()?>index.php/home/profile/message_view");
	});
	$(document).ready(function(){
		$("#<?php echo $part; ?>").click();
    });
</script>
<style type="text/css">
    .pagination_box a{
        cursor: pointer;
    }
</style>