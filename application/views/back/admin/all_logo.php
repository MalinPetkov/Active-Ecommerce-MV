<div class="panel-body">
    <!-- Delete Logo Div -->
    <?php foreach ($logo as $row){ ?>
        <div class="delete-div-wrap">
            <span class="close"><i class="fa fa-trash"></i></span>
            <div class="inner-div tr-bg">
                <img class="img-responsive img-md" 
                	src="<?php echo base_url(); ?>uploads/logo_image/logo_<?php echo $row['logo_id']; ?>.png" 
                    	data-id="<?php echo $row['logo_id']; ?>" >
            </div>
        </div>
    <?php } ?>
</div>
<script>

	$('.delete-div-wrap .close').on('click', function() {
	    var id = $(this).closest('.delete-div-wrap').find('img').data('id');
		
		//alert(img_src);
	    delete_confirm1(id, '<?php echo translate('really_want_to_delete_this_logo?'); ?>','logo');
		
	});
	function delete_confirm1(id,msg){
		msg = '<div class="modal-title">'+msg+'</div>';
		bootbox.confirm(msg, function(result) {
			if (result) {
				ajax_load(base_url+'index.php/'+user_type+'/'+module+'/'+dlt_cont_func+'/'+id,'list','delete');
				$.activeitNoty({
					type: 'danger',
					icon : 'fa fa-check',
					message : dss,
					container : 'floating',
					timer : 3000
				});
				sound('delete');
				var img_src='<?php echo base_url()?>uploads/others/photo_default.png';
				$('#blah5').attr('src',img_src);
			}else{
				$.activeitNoty({
					type: 'danger',
					icon : 'fa fa-minus',
					message : cncle,
					container : 'floating',
					timer : 3000
				});
				sound('cancelled');
			};
		});
	}
</script>