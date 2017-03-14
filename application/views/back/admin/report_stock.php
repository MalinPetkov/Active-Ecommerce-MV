 <link rel="stylesheet" href="<?php echo base_url(); ?>template/back/amcharts/style.css"	type="text/css">
<script src="<?php echo base_url(); ?>template/back/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/themes/light.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/amstock.js" type="text/javascript"></script>
<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow"><?php echo translate('manage_stock_report');?></h1>
	</div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                <!-- LIST -->
                    <div class="tab-pane fade active in" id="" style="border:1px solid #ebebeb; border-radius:4px;">
						<?php
                            echo form_open(base_url() . 'index.php/admin/report_stock', array(
                                'class' => 'form-horizontal',
                                'method' => 'post',
                                'id' => 'stock_add',
                                'enctype' => 'multipart/form-data'
                            ));
                        ?>
                                                	
                			<div class="panel-body">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label" for="demo-hor-inputpass"><?php echo translate('category'); ?></label>
                                    <div class="col-sm-6">
                                        <?php echo $this->crud_model->select_html('category','category','category_name','add','demo-chosen-select','','','','get_cat'); ?>
                                    </div>
                                </div>
                    
                                <div class="form-group" id="sub" style="display:none;">
                                    <label class="col-sm-4 control-label" for="demo-hor-inputpass"><?php echo translate('sub_category'); ?></label>
                                    <div class="col-sm-6" id="sub_cat">
                                    </div>
                                </div>
                    
                                <div class="form-group" id="pro" style="display:none;">
                                    <label class="col-sm-4 control-label" for="demo-hor-inputemail"><?php echo translate('product'); ?></label>
                                    <div class="col-sm-6" id="product">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="panel-footer">
                                <div class="row">
                                    <div class="col-sm-7 col-sm-offset-5">
                                        <button class="btn btn-primary btn-lg btn-labeled fa fa-file-text enterer">
                                            <?php echo translate('get_stock_report');?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                         </form>
                        <div class="panel panel-bordered-primary margin-top-10 margin-all-15">
                            <?php if(isset($product)){ ?>
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo translate('stock'); ?>: <?php echo $product_name; ?></h3>
                                </div>
                                <div id="chartdiv"style="width:100%; height:600px;"></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <!--Panel body-->
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

	var chart = AmCharts.makeChart("chartdiv", {
        "type": "serial",
        "theme": "none",
        "pathToImages": "http://www.amcharts.com/lib/3/images/",
        "dataDateFormat": "YYYY-MM-DD",
        "valueAxes": [{
            "id":"v1",
            "axisAlpha": 0,
            "position": "left"
        }],
        "graphs": [{
			"id": "g1",
            "bullet": "round",
            "bulletBorderAlpha": 1,
            "bulletColor": "#FFFFFF",
            "bulletSize": 5,
            "hideBulletsCount": 50,
            "lineThickness": 2,
            "title": "red line",
            "useLineColorForBulletBorder": true,
            "valueField": "value"
        }],
        "chartScrollbar": {
			"graph": "g1",
			"scrollbarHeight": 30
		},
        "chartCursor": {
            "cursorPosition": "mouse",
            "pan": true,
             "valueLineEnabled":true,
             "valueLineBalloonEnabled":true
        },
        "categoryField": "date",
        "categoryAxis": {
            "parseDates": true,
            "dashLength": 1,
            "minorGridEnabled": true,
            "position": "top"
        },
        exportConfig:{
          menuRight: '20px',
          menuBottom: '50px',
          menuItems: [{
          icon: 'http://www.amcharts.com/lib/3/images/export.png',
          format: 'png'
          }]  
        },
        "dataProvider": [
            <?php
            	if(isset($product)){
    	        	$stocks = $this->crud_model->stock_report($product);
    	        	foreach ($stocks as $row) {
            ?>
            {
    			"date": "<?php echo $row['date']; ?>",
    			"value": <?php echo $row['stock']; ?>

            	},
            <?php
        			}
            	}
            ?>
            ]
        }
    );

    chart.addListener("rendered", zoomChart);

    zoomChart();
    function zoomChart(){
        chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
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
        $('#sub').hide('slow');
		$('#pro').hide('slow');
        ajax_load(base_url+'index.php/admin/stock/sub_by_cat/'+id,'sub_cat','other');
        $('#sub').show('slow');
        total();
    }
	function get_product(id){
        $('#pro').hide('slow');
        ajax_load(base_url+'index.php/admin/stock/pro_by_sub/'+id,'product','other');
        $('#pro').show('slow');
        total();
    }

    function get_pro_res(id){

    }
</script>
