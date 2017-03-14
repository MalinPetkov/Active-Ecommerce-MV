

        
        <script src="<?php echo base_url(); ?>template/front/plugins/owl-carousel2/owl.carousel.min.js"></script>
        <script>
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
                        		$("#amount").val(currency + Math.round((Number(ui.values[0])*exchange)) + " - " + currency + Math.round((Number(ui.values[1])*exchange)));
                                $("#rangeaa").val(ui.values[0] + ";" + ui.values[1]);
                            },
                            stop: function( event, ui ) {
                            	do_product_search();
                            }
                        });
						$("#amount").val(
							currency + Math.round(Number($("#slider-range").slider("values", 0))*exchange) + " - " + currency + Math.round(Number($("#slider-range").slider("values", 1))*exchange)
						);
                        $("#rangeaa").val($("#slider-range").slider("values", 0) + ";" + $("#slider-range").slider("values", 1));
                    }
                    
                }
            }
        </script>