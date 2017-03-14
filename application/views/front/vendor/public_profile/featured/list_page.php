<!-- Blog List -->
<div class="products list">
	<div  id="result">
    </div>
</div>
<!-- /Blog list -->

<?php
	echo form_open(base_url() . 'index.php/home/vendor_featured/get_ajax_list/', array(
		'class' => 'form-horizontal',
		'method' => 'post',
		'id' => 'filter_form'
	));
?>
	<input type="hidden" name="vendor" value="<?php echo $vendor_id; ?>" id="vendor_id" />
</form>
    
<script>		
	function filter_vendor_featured(page){
		var form = $('#filter_form');
		var alert = $('#result');
		var formdata = false;
		if (window.FormData){
			formdata = new FormData(form[0]);
		}
		var top = Number(200);
		var loading_set = '<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>';
		$.ajax({
			url: form.attr('action')+page+'/', // form action url
			type: 'POST', // form submit method get/post
			dataType: 'html', // request type html/json/xml
			data: formdata ? formdata : form.serialize(), // serialize form data 
			cache       : false,
			contentType : false,
			processData : false,
			beforeSend: function() {
				alert.fadeOut();
				alert.html(loading_set).fadeIn(); // change submit button text
			},
			success: function(data) {
				setTimeout(function(){
					alert.html(data); // fade in response data
				}, 20);
				setTimeout(function(){
					alert.fadeIn(); // fade in response data
				}, 30);
			},
			error: function(e) {
				console.log(e)
			}
		});
		
	}
	
	$(document).ready(function() {
		filter_vendor_featured('0');
	});	
</script>