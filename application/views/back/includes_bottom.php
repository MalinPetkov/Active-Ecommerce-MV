
	<!--Activeit Admin [ RECOMMENDED ]-->
	<script src="<?php echo base_url(); ?>template/back/js/activeit.min.js"></script>


	<!--Morris.js [ OPTIONAL ]-->
	
	<script src="<?php echo base_url(); ?>template/back/plugins/morris-js/raphael-js/raphael.min.js"></script>


	<!--Sparkline [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/sparkline/jquery.sparkline.min.js"></script>
    
    
	<!--Skycons [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/skycons/skycons.min.js"></script>


	<!--Bootstrap Select [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-select/bootstrap-select.min.js"></script>


	<!--Demo script [ DEMONSTRATION ]-->
	<script src="<?php echo base_url(); ?>template/back/js/demo/activeit-demo.min.js"></script>


	<!--Demo script [ DEMONSTRATION ]-->
	<script src="<?php echo base_url(); ?>template/back/js/ajax_method.js"></script>


	<!--Demo script [ DEMONSTRATION ]--
	<script src="<?php echo base_url(); ?>template/back/js/jquery.form.js"></script>


	<!--Demo script [ DEMONSTRATION ]--
	<script src="<?php echo base_url(); ?>template/back/js/jspdf.js"></script>


	<!--Specify page [ SAMPLE ]-->
	<script src="<?php echo base_url(); ?>template/back/js/demo/dashboard.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>template/back/export/tableExport.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>template/back/export/jquery.base64.js"></script>



	<script type="text/javascript" src="<?php echo base_url(); ?>template/back/export/html2canvas.js"></script>

	<script type="text/javascript" src="<?php echo base_url(); ?>template/back/export/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>template/back/export/jspdf/jspdf.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>template/back/export/jspdf/libs/base64.js"></script>

	<!--Bootstrap Table [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-table/bootstrap-table.js"></script>


	<!--Data Table [ SAMPLE ]-->
	<script src="<?php echo base_url(); ?>template/back/js/demo/tables.js"></script>


	<!--Bootbox Modals [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/bootbox/bootbox.min.js"></script>


	<!--Switchery [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/switchery/switchery.js"></script>


	<!--Chosen [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/chosen/chosen.jquery.min.js"></script>



	<!--noUiSlider [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/noUiSlider/jquery.nouislider.all.min.js"></script>


	<!--Bootstrap Timepicker [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/Bootstrap-timepicker/bootstrap-timepicker.min.js"></script>

    
    <!--Dropzone [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/dropzone/dropzone.min.js"></script>

	<!--Summernote [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/summernote/summernote.js"></script>



	<!--Bootstrap Validator [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/Bootstrap-validator/bootstrapValidator.min.js"></script>


	<!--Masked Input [ OPTIONAL ]-->
	<script src="<?php echo base_url(); ?>template/back/plugins/masked-input/jquery.maskedinput.min.js"></script>


	<!--Buttons [ SAMPLE ]-->
	<script src="<?php echo base_url(); ?>template/back/js/demo/ui-buttons.js"></script>

	<!--Countdown [ SAMPLE ]-->
	<script src="<?php echo base_url(); ?>template/back/js/jquery.countdown.min.js"></script>
	<script src="<?php echo base_url(); ?>template/back/js/lodash.min.js"></script>
     
	<script type="text/javascript" src="<?php echo base_url(); ?>template/back/js/jspdf.debug.js"></script>
	<?php
    	if ($this->session->userdata('title') == 'admin'){
	?>
    <input type="hidden" value="<?php echo $this->db->get('sale')->num_rows(); ?>" id="total_sale">
    <?php
		} else if ($this->session->userdata('title') == 'vendor'){
			$sales = $this->db->get('sale')->result_array();
			$i = 0;
			foreach($sales as $row){
				if($this->crud_model->is_sale_of_vendor($row['sale_id'],$this->session->userdata('vendor_id'))){
					$i++;
				}
			}
	?>
    <input type="hidden" value="<?php echo $i; ?>" id="total_sale">
    <?php
    	}
	?>
	<?php
	    $audios = scandir('uploads/audio/admin/');
	    foreach ($audios as $row) {
	        if($row !== '' && $row !== '.' && $row !== '..'){
	            $row = str_replace('.mp3', '', $row);
	?>
	<audio style='display:none;' id='<?php echo $row; ?>' ><source type="audio/mpeg" src="<?php echo base_url(); ?>uploads/audio/admin/<?php echo $row; ?>.mp3"></audio>
	<?php
	        }
	    }
	?>
    <script type="text/javascript">
    	setInterval(sale_check, 300000);
    	setInterval(session_check, 600000);
		function sale_check(){
			var toto = $('#total_sale').val();
			$.ajax({
				url: '<?php echo base_url(); ?>index.php/<?php echo $this->session->userdata('title'); ?>/sales/total/'+toto,
				success: function(data) {
					var new_sale = data-toto;
					$('#total_sale').val(data);
					if(new_sale > 0){
		                $.activeitNoty({
		                    type: 'success',
		                    icon : 'fa fa-check',
		                    message : new_sale+' More Sale(s)!',
		                    container : 'floating',
		                    timer : 8000
		                });
						sound('sale_audio');
		            }
				},
				error: function(e) {
					console.log(e)
				}
			});
		}
		
		function session_check(){
			$.ajax({
				url: '<?php echo base_url(); ?>index.php/<?php echo $this->session->userdata('title'); ?>/is_logged/',
				success: function(data) {
					if(data == 'yah!good'){}
					else if (data == 'nope!bad') {
						location.replace('<?php echo base_url(); ?>index.php/<?php echo $this->session->userdata('title'); ?>');
					}
				},
				error: function(e) {
					console.log(e)
				}
			});
		}

		$(document).ready(function(){
			$('#content-container').css('min-height',$('#mainnav-menu').height()+'px');
		});
    </script>
</body>
</html>