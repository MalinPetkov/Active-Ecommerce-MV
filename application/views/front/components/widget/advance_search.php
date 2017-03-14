<div class="col-md-12">
	<div style="background:#fff; padding:15px;">
        <h4 class="section-title">
            <?php echo translate('advance_search'); ?>
        </h4>
        <?php
            echo form_open(base_url() . 'index.php/home/home_search/text', array(
                'class' => 'sky-form',
                'method' => 'post',
                'enctype' => 'multipart/form-data',
                'style' => 'border:none !important;'
            ));
        ?>
            <div class="row">
                <div class="col-md-12">
                    <select class="selectpicker" data-live-search="true" name="category" data-toggle="tooltip" title="<?php echo translate('select');?>" onChange="set_search_by_cat(this);">
                        <option value="0"  data-cat="0" 
                            data-min="<?php echo round($this->crud_model->get_range_lvl('product_id !=', '0', "min")); ?>" 
                               data-max="<?php echo round($this->crud_model->get_range_lvl('product_id !=', '0', "max")); ?>" 
                                data-brands="<?php echo $this->db->get_where('general_settings',array('type'=>'data_all_brands'))->row()->value; ?>" 
                                    data-subdets='[]'>
                                    <?php echo translate('all_categories');?>
                        </option>
                        <?php 
                            $categories = $this->db->get('category')->result_array();
                            foreach ($categories as $row1) {
								if($this->crud_model->if_publishable_category($row1['category_id'])){
                        ?>
                        <option value="<?php echo $row1['category_id']; ?>" 
                            data-cat="<?php echo $row1['category_id']; ?>" 
                                data-min="<?php echo round($this->crud_model->get_range_lvl('category', $row1['category_id'], "min")); ?>" 
                                   data-max="<?php echo round($this->crud_model->get_range_lvl('category', $row1['category_id'], "max")); ?>" 
                                    data-brands="<?php echo $row1['data_brands']; ?>" 
                                        data-subdets='<?php echo $row1['data_subdets']; ?>'>
                                            <?php echo $row1['category_name']; ?>
                        </option>
                        <?php 
								}
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-12 search_sub">
                    <select class="selectpicker header-search-select" data-live-search="true" name="sub_category" data-toggle="tooltip" title="<?php echo translate('select');?>">
                        <option value="0" ><?php echo translate('all_sub_categories');?></option>
                    </select>
                </div>
                <?php
                	if ($this->crud_model->get_type_name_by_id('general_settings','68','value') == 'ok') {
				?>
                <div class="col-md-12 search_brands">
                    <select class="selectpicker header-search-select" data-live-search="true" name="brand" data-toggle="tooltip" title="<?php echo translate('select');?>">
                        <option value="0" ><?php echo translate('all_brands');?></option>
                    </select>
                </div>
                <?php
					}
				?>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="widget widget-filter-price" style="padding: 2px 20px;height: 40px;">                
                        <div id="slider-range"></div>
                        <input type="text" style="position: absolute; width:75%; text-align:center;margin-top: -30px;border: none;" id="amount" disabled />
                        <input type="hidden" name="price" id="rangeaa" />
                        <input type="hidden" id="univ_max" value="<?php echo $this->crud_model->get_range_lvl('product_id !=', '', "max"); ?>">
                    </div>
                </div>
                <div class="col-md-12">
                <input class="form-control" type="text" name="query" placeholder="<?php echo translate('what_are_you_looking_for'); ?>?">
                </div>
                <div class="col-md-12">
                    <button class="btn btn-theme btn-block" style="padding:10px 20px;">
                        <span class="fa fa-search" aria-hidden="true"></span>
                        <span class=""> <?php echo translate('search'); ?> </span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function set_search_by_cat(now){
        var cat 		= $(now).data('cat');
        var min 		= Number($(now).find(':selected').data('min'));
        var max 		= Number($(now).find(':selected').data('max'));
        var brands 		= $(now).find(':selected').data('brands');
        var subdets 	= $(now).find(':selected').data('subdets');
                                
        brands = brands.split(';;;;;;');
        var select_brand_options = '';
        for(var i=0, len=brands.length; i < len; i++){
            brand = brands[i].split(':::');
            if(brand.length == 2){		
                select_brand_options = select_brand_options
                                       +'        <option value="'+brand[0]+'" >'+brand[1]+'</option>'
            }
        }
        
        var select_brand_html =  '<select class="selectpicker input-price " name="brand" data-live-search="true" '
                                +'	data-width="100%" data-toggle="tooltip" title="Select" >'
                                +'		<option value="0"><?php echo translate('all_brands'); ?></option>'
                                +		select_brand_options
                                +'</select>';
        $('.search_brands').html(select_brand_html);
        
        
        var select_sub_options = '';
        $.each(subdets, function (i, v) {
            var min = v.min;
            var max = v.max;
            var brands = v.brands;
            var sub_id = v.sub_id;
            var sub_name = v.sub_name;	
			select_sub_options = select_sub_options
								   +'        <option value="'+sub_id+'" data-subcat="'+sub_id+'"  data-min="'+min+'"  data-max="'+max+'" data-brands="'+brands+'" >'+sub_name+'</option>';
        });
        
        var select_sub_html =  '<select class="selectpicker input-price " name="sub_category" data-live-search="true" '
                                +'	data-width="100%" data-toggle="tooltip" title="Select" onchange="set_search_by_scat(this)" >'
                                +'		<option value="0"><?php echo translate('all_sub_categories'); ?></option>'
                                +		select_sub_options
                                +'</select>';
        $('.search_sub').html(select_sub_html);
        
        $('.selectpicker').selectpicker();
        set_price_slider(min,max,min,max);
        
    }
    
    
    function set_search_by_scat(now){
        var scat 		= $(now).data('subcat');
        var min 		= Number($(now).find(':selected').data('min'));
        var max 		= Number($(now).find(':selected').data('max'));
        var brands 		= $(now).find(':selected').data('brands');						
        
        brands = brands.split(';;;;;;');
        var select_brand_options = '';
        for(var i=0, len=brands.length; i < len; i++){
            brand = brands[i].split(':::');
            if(brand.length == 2){		
                select_brand_options = select_brand_options
                                       +'        <option value="'+brand[0]+'" >'+brand[1]+'</option>'
            }
        }
        
        var select_brand_html =  '<select class="selectpicker input-price " name="brand" data-live-search="true" '
                                +'	data-width="100%" data-toggle="tooltip" title="Select" >'
                                +'		<option value="0"><?php echo translate('all_brands'); ?></option>'
                                +		select_brand_options
                                +'</select>';
        $('.search_brands').html(select_brand_html);
        
        $('.selectpicker').selectpicker();
        set_price_slider(min,max,min,max);
        
    }
    
    function set_price_slider(min,max,univ_min,univ_max){ 
        var priceSliderRange = $('#slider-range');
        if ($.ui) {
            /**/
            if ($(priceSliderRange).length) {
                $(priceSliderRange).slider({
                    range: true,
                    min: univ_min,
                    max: univ_max,
                    values: [min, max],
                    slide: function (event, ui){
                        $("#amount").val(currency + (Number(ui.values[0])*exchange) + " - " + currency + (Number(ui.values[1])*exchange));
                        $("#rangeaa").val(ui.values[0] + ";" + ui.values[1]);
                    },
                    stop: function( event, ui ) {
                        do_product_search();
                    }
                });
                $("#amount").val(
                    currency + Number($("#slider-range").slider("values", 0))*exchange + " - " + currency + Number($("#slider-range").slider("values", 1))*exchange
                );
                $("#rangeaa").val($("#slider-range").slider("values", 0) + ";" + $("#slider-range").slider("values", 1));
            }
            
        }
    }
    
    $(document).ready(function(e) {
        var univ_max = $('#univ_max').val(); 
        set_price_slider(0,univ_max,0,univ_max);
        setTimeout(function(){ $('.selectpicker').selectpicker(); }, 3000);
    });
</script>