<!-- Blog List -->
<div class="products list">
	<div  id="result">
    </div>
</div>
<!-- /Blog list -->

<?php
	echo form_open(base_url() . 'index.php/home/ajax_blog_list/', array(
		'class' => 'form-horizontal',
		'method' => 'post',
		'id' => 'filter_form'
	));
?>
	<input type="hidden" name="blog_category" value="<?php echo $category; ?>" id="blog_category" />
</form>
    
<script>		
	function filter_blog(page){
		var form = $('#filter_form');
		var alert = $('#result');
		var formdata = false;
		if (window.FormData){
			formdata = new FormData(form[0]);
		}
		$.ajax({
			url: form.attr('action')+page+'/', // form action url
			type: 'POST', // form submit method get/post
			dataType: 'html', // request type html/json/xml
			data: formdata ? formdata : form.serialize(), // serialize form data 
			cache       : false,
			contentType : false,
			processData : false,
			beforeSend: function() {
				var top = '200';
				alert.fadeOut();
				alert.html('<div style="text-align:center;width:100%;position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>').fadeIn(); // change submit button text
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
		filter_blog('0');
	});	
</script>