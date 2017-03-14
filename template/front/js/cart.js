
                    $('body').on('click','.colrs', function(){
                        var here = $(this);
                        var rowid = here.closest('tr').data('rowid');
                        var val = here.closest('li').find('input').val();
                        if(val == 'undefined'){
                            val = '';
                        }
                        val = val.split(",").join("-");
                        val = val.replace(')','--');
                        val = val.replace('(','---');

                        $.ajax({
                            url: base_url+'index.php/home/cart/upd_color/'+rowid+'/'+val,
                            beforeSend: function() {
                            },
                            success: function() {
                                //other option
                                reload_header_cart();
                            },
                            error: function(e) {
                                console.log(e)
                            }
                        });
                    });

                    function others_count(){
                        update_calc_cart();
                    }
                    

                    function check_ok(element){
                        var here = $(element);
                        here.closest('td').find('.minus').click();
                        here.closest('td').find('.plus').click();
                    }

                    $('body').on('click','.quantity-button', function(){
                        var here = $(this);
                        var quantity = here.closest('td').find('.quantity_field').val();
                        var limit = here.closest('td').find('.quantity_field').data('limit');
                        if(here.val()=='minus'){
                            quantity = quantity-1;
                        } else if (here.val()=='plus'){
                            //if(limit == 'no'){
                                quantity = Number(quantity)+1;
                           // }
                        }
                        if(quantity >= 1){
                            here.closest('td').find('.quantity_field').val(quantity);

                            var rowid = here.closest('td').find('.quantity_field').data('rowid');
                            var lim_t = here.closest('tr').find('.limit');
                            var list1 = here.closest('tr').find('.sub_total');

                            $.ajax({
                                url: base_url+'index.php/home/cart/quantity_update/'+rowid+'/'+quantity,
                                beforeSend: function() {
                                    list1.html('...'); 
                                },
                                success: function(data) {
                                    var res = data.split("---")
                                    list1.html(res[0]).fadeIn();
                                    reload_header_cart();
                                    others_count();
                                    if(res[1] !== 'not_limit'){
                                        lim_t.html('!!').fadeIn();
                                        here.closest('td').find('.plus').hide();
                                        here.closest('td').find('.quantity_field').data('limit','yes');
                                        here.closest('td').find('.quantity_field').val(res[1]);
                                    } else {
                                        lim_t.html('').fadeOut();
                                        here.closest('td').find('.plus').show();
                                        here.closest('td').find('.quantity_field').data('limit','no');
                                    }
                                },
                                error: function(e) {
                                    console.log(e)
                                }
                            });
                        }
                    });

                    function cart_submission(){
                        //var payment_type = $('#ab').val();
                        var payment_type = '';
                        var state = check_login_stat('state');
                        state.success(function (data) {
                            if(data == 'hypass'){
                                 var form = $('#cart_form');
                                 form.submit();
                            } else {
                                signin();
                                $('#login_form').attr('action',base_url+'index.php/home/login/do_login/nlog');
                                $('#logup_form').attr('action',base_url+'index.php/home/registration/add_info/nlog');
                            }
                        });
                    }

                    $( document ).ready(function() {
                        update_calc_cart();
                        $('.colrs').each(function() {
                            var here = $(this);
                            var rad = here.closest('li').find('input');
                            if(rad.is(':checked')) {
                                setTimeout( function(){ 
                                    here.click();
                                }
                                , 800 );
                            }
                        });
                    });

                    function update_prices(){

                        var url = base_url+'index.php/home/cart/calcs/prices';
                        $.ajax({
                            url: url,
                            dataType: 'json', 
                            beforeSend: function() {

                            },
                            success: function(data) {
                                $.each(data, function(key, item) {
                                    var elem = $("table").find("[data-rowid='" + item.id + "']");
                                    elem.find('.sub_total').html(item.subtotal);
                                    elem.find('.pric').html(item.price);
                                });
                            },
                            error: function(e) {
                                console.log(e)
                            }
                        });
                    }

                    function update_calc_cart(){
                        var url = base_url+'index.php/home/cart/calcs/full';
                        var total = $('#total');
                        var ship = $('#shipping');
                        var tax = $('#tax');
                        var grand = $('#grand');

                        $.ajax({
                            url: url,
                            beforeSend: function() {
                                total.html('...'); 
                                ship.html('...'); 
                                tax.html('...'); 
                                grand.html('...'); 
                            },
                            success: function(data) {
                                var res = data.split('-');
                                total.html(res[0]).fadeIn(); 
                                ship.html(res[1]).fadeIn(); 
                                tax.html(res[2]).fadeIn(); 
                                grand.html(res[3]).fadeIn(); 
                                //other_action();
                            },
                            error: function(e) {
                                console.log(e)
                            }
                        });
                    }
                
				
            $('body').on('click','.coupon_btn',function(){
                var txt = $(this).html();
                var code = $('.coupon_code').val();
                $('#coup_frm').val(code);
                var form = $('#coupon_set');
                var formdata = false;
                if (window.FormData){
                    formdata = new FormData(form[0]);
                }
                var datas = formdata ? formdata : form.serialize();
                $.ajax({
                    url: base_url+'index.php/home/coupon_check/',
                    type        : 'POST', // form submit method get/post
                    dataType    : 'html', // request type html/json/xml
                    data        : datas, // serialize form data 
                    cache       : false,
                    contentType : false,
                    processData : false,
                    beforeSend: function() {
                        $(this).html(applying);
                    },
                    success: function(result){
                        if(result == 'nope'){
                            notify(coupon_not_valid,'warning','bottom','right');
                        } else {
                            update_calc_cart();
                            reload_header_cart();
                            update_prices();
                            var re = result.split(':-:-:');
                            var ty = re[0];
                            var ts = re[1];
                            $("#coupon_report").fadeOut();
                            notify(coupon_discount_successful,'success','bottom','right');
                            if(ty == 'total'){
                                $(".coupon_disp").show();
                                $("#disco").html(re[2]);
                            }
                            $("#coupon_report").html('<h3>'+ts+'</h3>');
                            $("#coupon_report").fadeIn();
                        }
                    }
                });
            }); 


    function set_cart_map(){
        //$('#maps').animate({ height: '400px' }, 'easeInOutCubic', function(){});
        initialize();
        var address = [];
        //$('#pos').show('fast');
        //$('#lnlat').show('fast');
        $('.address').each(function(index, value){
            if(this.value !== ''){
                address.push(this.value);
            }
        });
        address = address.toString();
        deleteMarkers();
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if($('#langlat').val().indexOf(',')  == -1 || $('#first').val() == 'no'){
					deleteMarkers();
                    var location = results[0].geometry.location; 
                    var marker = addMarker(location);
                    map.setCenter(location);
                    $('#langlat').val(location);
                } else if($('#langlat').val().indexOf(',')  >= 0){
					deleteMarkers();
                    var loca = $('#langlat').val();
                    loca = loca.split(',');
                    var lat = loca[0].replace('(','');
                    var lon = loca[1].replace(')','');
                    var marker = addMarker(new google.maps.LatLng(lat, lon));
                    map.setCenter(new google.maps.LatLng(lat, lon));
                }
				if($('#first').val() == 'yes'){
					$('#first').val('no');
				}
                // Add dragging event listeners.
                google.maps.event.addListener(marker, 'drag', function() {
                    $('#langlat').val(marker.getPosition());
                });
            }
        }); 
    }

        var geocoder;
        var map;
        var markers = [];
        function initialize() {
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(-34.397, 150.644);
            var mapOptions = {
                zoom: 14,
                center: latlng
            }
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            google.maps.event.addListener(map, 'click', function(event) {
                deleteMarkers();
                var marker = addMarker(event.latLng);
                $('#langlat').val(event.latLng);	
            	// Add dragging event listeners.
				google.maps.event.addListener(marker, 'drag', function() {
					$('#langlat').val(marker.getPosition());
				});
				
            });		
        }
        

    /*
        var address = [];
        $('#maps').show('fast');
        $('#pos').show('fast');
        $('#lnlat').show('fast');
        $(".address").each(
        address.push(this.value);
        );
    */

        $('body').on('blur','.address', function(){
            if(!$(this).is('select')){
                set_cart_map();
            }
        });

        $('body').on('change','.address', function(){
            if($(this).is('select')){
                set_cart_map();
            }
        });

        // Add a marker to the map and push to the array.
        function addMarker(location) {
            var image = {
                url: base_url+'uploads/others/marker.png',
                size: new google.maps.Size(40, 60),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(20, 62)
            };

            var shape = {
                coords: [1, 5, 15, 62, 62, 62, 15 , 5, 1],
                type: 'poly'
            };

            var marker = new google.maps.Marker({
                position: location,
                map: map,
                draggable:true,
                icon: image,
                shape: shape,
                animation: google.maps.Animation.DROP
            });
            markers.push(marker);
            return marker;
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }

        // Sets the map on all markers in the array.
        function setAllMap(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setAllMap(null);
        }
        //google.maps.event.addDomListener(window, 'load', initialize);