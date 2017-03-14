<div class="panel-heading">
    <h3 class="panel-title"><?php echo translate('select');?> <?php echo translate($logo_type); ?></h3>
</div>
<?php
	$now = $this->db->get_where('ui_settings',array('type' => $logo_type))->row()->value;
?>
<div class="panel-body">
    <!-- delete_logo Div -->
    <?php
		echo form_open(base_url() . 'index.php/admin/logo_settings/set_logo/', array(
			'class' => 'form-horizontal',
			'method' => 'post',
			'id' => 'logo_set_change',
			'enctype' => 'multipart/form-data'
		));
	?>
    <input type="hidden" value="<?php echo $logo_type; ?>" name="type" >
    <?php foreach ($logo as $row){ ?>
        <div class="delete-div-wrap cc-selector">
            <input id="log_<?php echo $row['logo_id']; ?>" type="radio" value="<?php echo $row['logo_id']; ?>" name="logo_id" <?php if($row['logo_id'] == $now){ echo 'checked'; } ?> >
            <label class="inner-div tr-bg drinkcard-cc aad" style="margin-bottom:0px;" for="log_<?php echo $row['logo_id']; ?>">
                <img class="img-responsive img-md" 
                	src="<?php echo base_url(); ?>uploads/logo_image/logo_<?php echo $row['logo_id']; ?>.png" 
                    	data-id="<?php echo $row['logo_id']; ?>" >
            </label>
        </div>
    <?php } ?>   
    
    
</div>

<script>
	$('.delete-div-wrap .aad').on('click', function() {
		var id = $(this).closest('.delete-div-wrap').find('img').data('id');
		var typ = '<?php echo $logo_type; ?>';
		$('#'+typ).attr('src', '<?php echo base_url(); ?>uploads/logo_image/logo_'+id+'.png');
	});


	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>