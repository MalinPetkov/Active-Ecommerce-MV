        
<?php
    echo form_open(base_url() . 'index.php/home/listed/click', array(
        'method' => 'post',
        'id' => 'plistform',
        'enctype' => 'multipart/form-data'
    ));
?>
    <input type="hidden" name="category" id="categoryaa">
    <input type="hidden" name="sub_category" id="sub_categoryaa">
    <input type="hidden" name="brand" id="brandaa">
    <input type="hidden" name="vendor" id="vendoraa">
    <input type="hidden" name="featured" id="featuredaa">
    <input type="hidden" name="range" id="rangeaa">
    <input type="hidden" name="text" id="search_text">
    <input type="hidden" name="view_type" id="view_type" value="grid">
    <input type="hidden" name="sort" id="sorter" value="">

</form>
<input type="hidden" class="first_load_check" value="no">

<style>
    .sub_cat{
        padding-left:30px !important;
    }
</style>

<script>
    var range 				= '<?php echo $range; ?>';
    var cur_sub_category 	= '<?php echo $cur_sub_category; ?>';
    var cur_brand 			= '<?php echo $cur_brand; ?>';
    var cur_category 		= '<?php echo $cur_category; ?>';
    var search_text 		= '<?php echo $text; ?>';
    var base_url 			= '<?php echo base_url(); ?>';
	
    $(document).ready(function(){
		set_view('grid');
        var univ_max = $('#univ_max').val(); 
        $('.on_click_search').on('click',function(){
            setTimeout(function(){ do_product_search('0'); }, 500);
        });
		
		setTimeout(function(){ $(".search_cat_click[data-cat='" + cur_category +"']").click(); }, 300);
		
        $('.search_cat').on('click',function(event){
            if(!$(this).hasClass('arrow')){
                $(this).closest('li').find('.arrow').click();
            } else {		
				$(this).closest('ul').find('.search_sub').prop("checked", false);
				$('.cr-icon').removeClass('add');
				$('.cr-icon').addClass('remove');					
				if ($(".first_load_check").val() == 'no') {
					if(cur_sub_category == '0' || cur_sub_category == ''){
						$(this).closest('li').find('.search_sub').prop("checked", true);
						$(this).closest('li').find('.cr-icon').removeClass('remove');
						$(this).closest('li').find('.cr-icon').addClass('add');
					} else {
						$("#sub_" + cur_sub_category).hide();
						$("#sub_" + cur_sub_category).prop("checked", true);							
						$("#sub_" + cur_sub_category).closest('label').find('.cr-icon').removeClass('remove');
						$("#sub_" + cur_sub_category).closest('label').find('.cr-icon').addClass('add');
					}
				} else {
					$(this).closest('li').find('.search_sub').prop("checked", true);
					$(this).closest('li').find('.cr-icon').removeClass('remove');
					$(this).closest('li').find('.cr-icon').addClass('add');
				}
                var min = $(this).data('min');
                var max = $(this).data('max');
				$('#cur_cat').val($(this).data('cat'));
                var vendors = $(this).data('vendors');
                var brands = $(this).data('brands');
				
				brands = brands.split(';;;;;;');
				var select_brand_options = '';
				for(var i=0, len=brands.length; i < len; i++){
					brand = brands[i].split(':::');
					if(brand.length == 2){						
						if(brand[0] == cur_brand){
							if ($(".first_load_check").val() == 'no') {
								selected = 'selected';
							}
						} else {
							selected = '';
						}
						select_brand_options = select_brand_options
											   +'        <option value="'+brand[0]+'" '+selected+' >'+brand[1]+'</option>'
					}
				}
				
                var select_brand_html =  '<select class="selectpicker input-price brand_search" data-live-search="true" '
										+'	data-width="100%" data-toggle="tooltip" title="Select" onchange="delayed_search()" >'
										+'		<option value="0"><?php echo translate('all_brands'); ?></option>'
										+		select_brand_options
										+'</select>';
				$('.set_brand').show();
				$('.set_brand').html(select_brand_html);
				
				vendors = vendors.split(';;;;;;');
				var select_vendor_options = '';
				for(var i=0, len=vendors.length; i < len; i++){
					vendor = vendors[i].split(':::');
					if(vendor.length == 2){
						select_vendor_options = select_vendor_options
											   +'        <option value="'+vendor[0]+'">'+vendor[1]+'</option>'
					}
				}
				
                var select_vendor_html =  '<select class="selectpicker input-price vendor_search" data-live-search="true" '
										+'	data-width="100%" data-toggle="tooltip" title="Select" onchange="delayed_search()">'
										+'		<option value="0"><?php echo translate('all_vendors'); ?></option>'
										+		select_vendor_options
										+'</select>';
				$('.set_vendor').show();
				$('.set_vendor').html(select_vendor_html);
				
				$('.selectpicker').selectpicker();			
                set_price_slider(min,max,min,max);
				if($(this).find('i').hasClass('fa-angle-down') || $(this).hasClass('all_category_set')){
                	setTimeout(function(){ do_product_search('0'); }, 500);
				}
            }
        });
        $('#cur_cat').val(cur_category);
        if(range == '0;0'){
            set_price_slider(0,univ_max,0,univ_max);
        } else {
            var new_range = range.split(';');
            set_price_slider(new_range[0],new_range[1],0,univ_max);
        }
        if(cur_category == '' || cur_category == '0'){
			do_product_search('0');
		}
    });
	
	function check(now){
		if($(now).find('input[type="checkbox"]').prop('checked') == true){
			$(now).find('.cr-icon').removeClass('remove');
			$(now).find('.cr-icon').addClass('add');
		}else{
			$(now).find('.cr-icon').removeClass('add');
			$(now).find('.cr-icon').addClass('remove');
		}
	}
	
	function set_view(type){
		if(type=='grid'){
			$('.view_select_btn').find('.list').removeClass('active');
			$('.view_select_btn').find('.grid').addClass('active');
		}else
			if(type=='list'){
			$('.view_select_btn').find('.grid').removeClass('active');
			$('.view_select_btn').find('.list').addClass('active');
		}
		$("#view_type").val(type);
		setTimeout(function(){ do_product_search('0'); }, 500);
	}
	
	
   function delayed_search(){
		setTimeout(function(){ do_product_search('0'); }, 500);
   };
	
    function do_product_search(page){

        $('#categoryaa').val($('#cur_cat').val());
        $('#sub_categoryaa').val($('.search_sub:checked').map(function() {return this.value;}).get().join(','));
        $('#search_text').val($('#texted').val());
        $('#vendoraa').val('<?php echo $vendor_id; ?>');
        $('#brandaa').val($('.set_brand').find('.brand_search').val());
        $('#sorter').val($('.sorter_search').val());
        //alert($('#sub_categoryaa').val());

        var form = $('#plistform');
        var place = $('#result');
        //var form = $(this);
        var formdata = false;
        if (window.FormData){
            formdata = new FormData(form[0]);
        }
		
		var top = Number(200);
		var loading_set = '<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>';
        
    
        $.ajax({
            url: form.attr('action')+'/'+page, // form action url
            type: 'POST', // form submit method get/post
            dataType: 'html', // request type html/json/xml
            data: formdata ? formdata : form.serialize(), // serialize form data 
            cache       : false,
            contentType : false,
            processData : false,
            beforeSend: function() {
                place.html(loading_set); // change submit button text\
            },
            success: function(data) {
                place.html(data);	
				load_iamges();					
            },
            error: function(e) {
                console.log(e)
            }
        });
		
		setTimeout(function(){ $(".first_load_check").val('done'); }, 300);
    }

</script>
