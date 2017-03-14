<link rel="stylesheet" href="<?php echo base_url(); ?>template/back/amcharts/style.css"	type="text/css">
<script src="<?php echo base_url(); ?>template/back/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/amstock.js" type="text/javascript"></script>

<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow" ><?php echo translate('product_sale_comparison');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
				<!-- LIST -->
				<div class="tab-pane fade active in"  id="" >
                    <div class="panel panel-bordered-primary">
                    	<div class="panel-heading">
							<h3 class="panel-title">
                            <?php echo translate('product_sale_comparison_report');?>
                            </h3>
						</div>
                        <div class="panel-body">
                            <div id="chartdiv" style="width:100%; height:600px;"></div>
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
	
	<?php
		foreach($products as $row){
			if($this->crud_model->is_publishable($row['product_id'])){
	?>
		var chartData<?php echo $row['product_id']; ?> = [];
	<?php
			}
		}
	?>
	
	generateChartData();
	
	function generateChartData() {
		<?php
			foreach($products as $row){
				if($this->crud_model->is_publishable($row['product_id'])){
					$dates = $this->crud_model->all_sale_date_n($row['product_id']);
					foreach ($dates as $row1) {
		?>
					var newDate 	= '<?php echo $row1; ?>';
					var value 		= <?php echo $this->crud_model->sale_details_by_product_date($row['product_id'],$row1,'subtotal'); ?>;
					var volume 		= <?php echo $this->crud_model->sale_details_by_product_date($row['product_id'],$row1,'qty'); ?>;

					chartData<?php echo $row['product_id']; ?>.push({
						date: newDate,
						value: value,
						volume: volume
					});
		<?php
					}
				}
			}
		?>
	}
	
		
	var chart = AmCharts.makeChart( "chartdiv", {
	  type: "stock",
	  "theme": "none",
  	  "pathToImages": "http://cdn.amcharts.com/lib/3/images/",
	  "path": "<?php echo base_url(); ?>template/back/amcharts",
	
	  dataSets: [ 
		<?php
			$dataSets = array();
			foreach($products as $row){
				if($this->crud_model->is_publishable($row['product_id'])){
		?>
		{
		  title: "<?php echo $row['title']; ?>",
		  fieldMappings: [ {
			fromField: "value",
			toField: "value"
		  }, {
			fromField: "volume",
			toField: "volume"
		  } ],
		  dataProvider: chartData<?php echo $row['product_id']; ?>,
		  categoryField: "date"
		},
		<?php
				}
			}
		?>
	  ],
	
	  panels: [ {
	
		  showCategoryAxis: false,
		  title: "Value",
		  percentHeight: 70,
	
		  stockGraphs: [ {
			id: "g1",
	
			valueField: "value",
			comparable: true,
			compareField: "value",
			balloonText: "[[title]]:<b>[[value]]</b>",
			compareGraphBalloonText: "[[title]]:<b>[[value]]</b>"
		  } ],
	
		  stockLegend: {
			periodValueTextComparing: "[[percents.value.close]]%",
			periodValueTextRegular: "[[value.close]]"
		  }
		},
	
		{
		  title: "Volume",
		  percentHeight: 30,
		  stockGraphs: [ {
			valueField: "volume",
			type: "column",
			showBalloon: false,
			fillAlphas: 1
		  } ],
	
	
		  stockLegend: {
			periodValueTextRegular: "[[value.close]]"
		  }
		}
	  ],
	
	  chartScrollbarSettings: {
		graph: "g3"
	  },
	
	  chartCursorSettings: {
		valueBalloonsEnabled: true,
		fullWidth: true,
		cursorAlpha: 0.1,
		valueLineBalloonEnabled: true,
		valueLineEnabled: true,
		valueLineAlpha: 0.5
	  },
	
	  periodSelector: {
		position: "left",
		periods: [ {
		  period: "MM",
		  selected: true,
		  count: 1,
		  label: "1 month"
		}, {
		  period: "YYYY",
		  count: 1,
		  label: "1 year"
		}, {
		  period: "YTD",
		  label: "YTD"
		}, {
		  period: "MAX",
		  label: "MAX"
		} ]
	  },
	
	  dataSetSelector: {
		position: "left"
	  },
	  "export": {
		"enabled": true
	  }
	} );

</script>

</div>
