<!-- BREADCRUMBS -->
<section class="page-section breadcrumbs">
    <div class="container">
        <div class="page-header">
            <h2 class="section-title section-title-lg">
                <span>
                    <?php echo translate('our_vendors_location');?>
                </span>
            </h2>
        </div>
    </div>
</section>
<!-- /BREADCRUMBS -->

<!-- PAGE -->
<section class="page-section store_locator">
    <div class="container">
        <div class="row margin-bottom-60">
            <div class="col-md-8 col-sm-8">
                <!-- Google Map -->
                <div id="map" class="height-450">
                </div>
                <!-- End Google Map -->
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="input-group animated fadeInDown">
                    <input type="text" class="form-control" value="<?php echo strtolower(rawurldecode($text)); ?>" placeholder="<?php echo translate('search_vendors');?>" onkeyup="search_loc()" 
                    id="search">
                    <span class="input-group-btn">
                        <button class="btn btn-info" style="border: 3px solid #5bc0de;" type="button"><?php echo translate('go'); ?></button>
                    </span>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="row">
                        <div class="panel panel-purple margin-bottom-40" style="margin-top:10px !important;">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-users"></i> <?php echo translate('our_vendors');?></h3>
                            </div>
                            <div class="panel-body vendors" id="result" style="height:415px; overflow:auto; padding-top:0px !important;">
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /PAGE -->
<script>
	var add_to_cart = '<?php echo translate('add_to_cart'); ?>';
	var valid_email = '<?php echo translate('must_be_a_valid_email_address'); ?>';
	var required = '<?php echo translate('required'); ?>';
	var sent = '<?php echo translate('message_sent!'); ?>';
	var incor = '<?php echo translate('incorrect_captcha!'); ?>';
	var required = '<?php echo translate('required'); ?>';
	var base_url = '<?php echo base_url(); ?>';
</script>

<script>
    
    var sale_details = [
    <?php
    if(!empty($vendors)){
        foreach($vendors as $row){
            $info = $this->db->get_where('vendor',array('vendor_id'=>$row['vendor_id']))->row();
            $address1    = $info->address1;
            $address2    = $info->address2;
            if($info->lat_lang !== ''){
                $langlat    = explode(',',str_replace('(','',str_replace(')','',$info->lat_lang)));
            } else {
                $langlat    = array(23.7984799,90.4224055);
            }
            $vendor_name = $info->display_name;
            $company = $info->company;
            $link = $this->crud_model->vendor_link($row['vendor_id']);
    ?>
        ["<?php echo $address1; ?>", <?php echo $langlat[0]; ?>, <?php echo $langlat[1]; ?>, "<?php echo $vendor_name; ?>", "<?php echo $company; ?>", "<?php echo $address2; ?>", "<?php echo $link; ?>"],
    <?php 
        }
    }
    ?>
    ];

    function search_loc(){
        var sale_details_new = [];
        var text = $('#search').val();
        if(text == ''){
            sale_details_new = sale_details;
        } else {
            for (i = 0; i < sale_details.length; i++) {
                var str = sale_details[i][0]+' '+sale_details[i][3]+' '+sale_details[i][4]+' '+sale_details[i][5];
                str = str.toLowerCase();
                if(str.search(text) !== -1){
                    sale_details_new.push([sale_details[i][0], sale_details[i][1], sale_details[i][2], sale_details[i][3], sale_details[i][4], sale_details[i][5], sale_details[i][6]]);
                }
            }
        }
        var res ='';
        for (i = 0; i < sale_details_new.length; i++) {
            res += ''
                +'<a href="'+sale_details_new[i][6]+'">'
                +'<h4>'+sale_details_new[i][3]+'</h4></a>'
                +sale_details_new[i][0]+'<br>'
                +sale_details_new[i][4]+'<br>'
                +sale_details_new[i][5]+'</p>'
                +'<hr style="margin:3px 0;">'
        }
        $('#result').html(res);
        initialize(sale_details_new);
    }

    //var sale_details = [];    


    google.load('maps', '3', {
        other_params: 'sensor=false&key=<?php echo $map_api_key; ?>'
    });
    
    
    google.setOnLoadCallback(search_loc);
    
    var styles = [
        [{
            url: '../images/conv30.png',
            height: 27,
            width: 30,
            anchor: [3, 0],
            textColor: '#ff00ff',
            opt_textSize: 10
        }, {
            url: '../images/conv40.png',
            height: 36,
            width: 40,
            opt_anchor: [6, 0],
            opt_textColor: '#ff0000',
            opt_textSize: 11
        }, {
            url: '../images/conv50.png',
            width: 50,
            height: 45,
            opt_anchor: [8, 0],
            opt_textSize: 12
        }],
        [{
            url: '../images/heart30.png',
            height: 26,
            width: 30,
            opt_anchor: [4, 0],
            opt_textColor: '#ff00ff',
            opt_textSize: 10
        }, {
            url: '../images/heart40.png',
            height: 35,
            width: 40,
            opt_anchor: [8, 0],
            opt_textColor: '#ff0000',
            opt_textSize: 11
        }, {
            url: '../images/heart50.png',
            width: 50,
            height: 44,
            opt_anchor: [12, 0],
            opt_textSize: 12
        }]
    ];
    
    var markerClusterer = null;
    var map = null;
    var imageUrl = 'http://chart.apis.google.com/chart?cht=mm&chs=24x32&' +
        'chco=FFFFFF,008CFF,000000&ext=.png';
    
    //$('#vendors_list').on('shown.bs.modal', function (e) {
        
    //})

    function refreshMap(sale_details) {
        //if (markerClusterer) {
        //  markerClusterer.clearMarkers();
        //}
    
        var markers = [];
        var infoWindows = [];
    
        var markerImage = new google.maps.MarkerImage(imageUrl,
            new google.maps.Size(24, 32));
    
    
        var bound = new google.maps.LatLngBounds();
        // Loop through our array of markers & place each one on the map  
        for (i = 0; i < sale_details.length; i++) {
            if(sale_details[i][1] !== '' && sale_details[i][2] !== ''){
                var latLng = new google.maps.LatLng(sale_details[i][1], sale_details[i][2])
                var marker = new google.maps.Marker({
                    position: latLng,
                    draggable: false,
                    icon: markerImage,
                    animation: google.maps.Animation.DROP,
                    infoWindowIndex: i
                });
        
                bound.extend(new google.maps.LatLng(sale_details[i][1], sale_details[i][2]));
        
                var content = '<div class="info_content">' +
                    '<a href="'+sale_details[i][6]+'">' +
                    '<h3>' + sale_details[i][0] + '</h3></a>' +
                    '<p>' + sale_details[i][3] + '</p>' +
                    '<p>'+sale_details[i][4]+'</p>' +
                    '<p>'+sale_details[i][5]+'</p>' +
                    '</div>';
        
                var infoWindow = new google.maps.InfoWindow({
                    content: content
                });
        
                google.maps.event.addListener(marker, 'click',
                    function(event) {
                        infoWindows[this.infoWindowIndex].open(map, this);
                    }
                );
        
                infoWindows.push(infoWindow);
                markers.push(marker);
            }
        }
    
    
        var zoom = parseInt(16);
        var size = parseInt(40);
        var style = parseInt(-1);
    
        markerClusterer = new MarkerClusterer(map, markers, {
            maxZoom: zoom,
            gridSize: size,
            styles: styles[style]
        });
    
        //map.setCenter(bound.getCenter())
        //map1.setCenter(bound1.getCenter())
        map.fitBounds(bound);
    }
    
    function initialize(sale_details) {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 4,
            center: new google.maps.LatLng(23.91, 90.38),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        
        refreshMap(sale_details);
    }
    
    function clearClusters(e) {
        e.preventDefault();
        e.stopPropagation();
        markerClusterer.clearMarkers();
    }

</script>
<style>
      #map-container {
        padding: 6px;
        border-width: 1px;
        border-style: solid;
        border-color: #ccc #ccc #999 #ccc;
        -webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
        -moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
        box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
        width: 100%;
      }
      #map {
        width: 100%;
        height: 500px;
      }
      #actions {
        list-style: none;
        padding: 0;
      }
      #inline-actions {
        padding-top: 10px;
      }
      .item {
        margin-left: 20px;
      }

</style>