<link rel="stylesheet" href="<?php echo base_url(); ?>template/back/amcharts/style.css"	type="text/css">
<script src="<?php echo base_url(); ?>template/back/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/amstock.js" type="text/javascript"></script>

<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow"><?php echo translate('product_wishes_report');?></h1>
	</div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                <!-- LIST -->
                    <div class="tab-pane fade active in" id="" style="border:1px solid #ebebeb; border-radius:4px;">
                        <div class="panel panel-bordered-primary margin-top-10 margin-all-15">
                            <div id="chartdiv"style="width:100%; height:600px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'admin';
	var module = 'category';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
	var loading = '<div>loading...<div>';

	var chart = AmCharts.makeChart( "chartdiv", {
	  "type": "serial",
	  "theme": "light",
  	  "pathToImages": "http://cdn.amcharts.com/lib/3/images/",
	   "chartScrollbar": {
		"dragIcon": 'dragIconRoundBig',
		"updateOnReleaseOnly": true
	  },
	  "path": "<?php echo base_url(); ?>template/back/amcharts/images/",
	  "dataProvider": [
		<?php
		$i = 0;
		$wishes = $this->crud_model->most_wished();
		$total = count($wishes);
		foreach ($wishes as $row) {
			$i++;
		?>
			{
				"country": "<?php echo $row['title']; ?>",
				"visits": <?php echo $row['wish_num']; ?>
			},
		<?php
			}
		?>
	  
	  ],
	  "valueAxes": [ {
		"gridColor": "#FFFFFF",
		"gridAlpha": 0.2,
		"dashLength": 0
	  } ],
	  "gridAboveGraphs": true,
	  "startDuration": 1,
	  "graphs": [ {
		"balloonText": "[[category]]: <b>[[value]]</b>",
		"fillAlphas": 0.8,
		"lineAlpha": 0.2,
		"type": "column",
		"valueField": "visits"
	  } ],
	  "chartCursor": {
		"categoryBalloonEnabled": false,
		"cursorAlpha": 0,
		"zoomable": false
	  },
	  "categoryField": "country",
	  "categoryAxis": {
		"gridPosition": "start",
		"gridAlpha": 0,
		"tickPosition": "start",
		"tickLength": 20,
    	"labelRotation": 45
	  },
	  "export": {
		"enabled": true
	  }
	
	} );
	
	chart.addListener("rendered", zoomChart);
	zoomChart();
	function zoomChart() {
		chart.zoomToIndexes(chart.dataProvider.length - <?php echo $total; ?>, chart.dataProvider.length - <?php echo $total-20; ?>);
	}

	
	
	$(document).ready(function() {
		$('.demo-chosen-select').chosen();
		$('.demo-cs-multiselect').chosen({width:'100%'});
	});
	
	function other(){
		$('.demo-chosen-select').chosen();
		$('.demo-cs-multiselect').chosen({width:'100%'});
	}
	function get_cat(id){
		$('#brand').html('');
		$('#sub').hide('slow');
		ajax_load(base_url+'index.php/admin/product/sub_by_cat/'+id,'sub_cat','other');
		$('#sub').show('slow');
		$('#brn').hide('slow');
	}
	
	function get_sub_res(id){
		$('#brn').hide('slow');
		$('#additional_fields').hide('slow');
		ajax_load(base_url+'index.php/admin/product/product_by_sub/'+id,'product','other');
		$('#brn').show('slow');
		$('#additional_fields').show('slow');
	}
	
	function get_pro_res(id){
	
	}
</script>
