<link rel="stylesheet" href="<?php echo base_url(); ?>template/back//amcharts/style.css" type="text/css">
<script src="<?php echo base_url(); ?>template/back/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/serial.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/plugins/morris-js/morris.min.js"></script>
<script src="<?php echo base_url(); ?>template/back/plugins/gauge-js/gauge.min.js"></script>

<div id="content-container">	
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('dashboard');?></h1>
    </div>
    <div id="page-content">
    	
        <div class="row" <?php if($this->crud_model->get_type_name_by_id('general_settings','68','value') == 'ok'){}else{ ?>style="display:none;"<?php } ?> >
            <div class="col-md-4 col-lg-4">
                <div class="panel panel-bordered panel-purple">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo translate('24_hours_stock');?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="text-center">
                            <canvas id="gauge1" height="70" class="canvas-responsive"></canvas>
                            <p class="h4">
                                <span class="label label-purple"><?php echo currency('','def');?></span>
                                <span id="gauge1-txt" class="label label-purple">0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-lg-4">
                <div class="panel panel-bordered panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo translate('24_hours_sale');?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="text-center">
                            <canvas id="gauge2" height="70" class="canvas-responsive"></canvas>
                            <p class="h4">
                                <span class="label label-success"><?php echo currency('','def');?></span>
                                <span id="gauge2-txt" class="label label-success">0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 col-lg-4">
                <div class="panel panel-bordered panel-black">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo translate('24_hours_destroy');?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="text-center">
                            <canvas id="gauge3" height="70" class="canvas-responsive"></canvas>
                            <p class="h4">
                                <span class="label label-black"><?php echo currency('','def');?></span>
                                <span id="gauge3-txt" class="label label-black">0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        	
		?>
        <div class="row" <?php if($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok' && $this->crud_model->get_type_name_by_id('general_settings','69','value') == 'ok'){}else{ ?>style="display:none;"<?php } ?> >
            <div class="col-md-12 col-lg-12">
                <div class="panel panel-bordered panel-success">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo translate('24_hours_sale');?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="text-center">
                            <canvas id="gauge4" height="70" class="canvas-responsive"></canvas>
                            <p class="h4">
                                <span class="label label-success"><?php echo currency('','def');?></span>
                                <span id="gauge4-txt" class="label label-success">0</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row" <?php if($this->crud_model->get_type_name_by_id('general_settings','58','value') == 'ok'){}else{ ?>style="display:none;"<?php } ?> >
            <div class="col-md-4 col-lg-4">
                <div class="panel panel-bordered panel-grad2" style="height:205px;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo translate('total_vendors');?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="text-center">
                            <h1>
                                <?php echo $this->db->get('vendor')->num_rows();?>
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="panel panel-bordered panel-dark" style="height:205px;">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo translate('pending_vendors');?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="text-center">
                            <h1>
                                <?php echo $this->db->get_where('vendor',array('status != '=>'approved'))->num_rows();?>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-8 col-lg-8">
                <div class="panel panel-bordered panel-grad">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo translate('vendor_stattistics');?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="text-center">
                            <div class="col-md-12 col-lg-12">
                                <div class="panel-body">
                                    <div id="chartdiv5" style="width: 100%; height: 300px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        
        <div class="row" <?php if($this->crud_model->get_type_name_by_id('general_settings','68','value') == 'ok'){}else{ ?>style="display:none;"<?php } ?> >
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-bordered panel-purple">
                    <h3 class="panel-title" style="border-bottom:1px #9365b8 solid; !important;">
                        <?php echo translate('category_wise_monthly_stock');?>
                    </h3>
                    <div class="panel-body">
                        <div id="chartdiv" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-bordered panel-black">
                    <h3 class="panel-title" style="border-bottom:1px #303641 solid; !important;">
                        <?php echo translate('category_wise_monthly_destroy');?>
                    </h3>
                    <div class="panel-body">
                        <div id="chartdiv3" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-bordered panel-success">
                    <h3 class="panel-title" style="border-bottom:1px #00a65a solid; !important;">
                        <?php echo translate('category_wise_monthly_sale');?>
                    </h3>
                    <div class="panel-body">
                        <div id="chartdiv2" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="panel panel-bordered panel-primary">
                    <h3 class="panel-title" style="border-bottom:1px #458fd2 solid; !important;">
                        <?php echo translate('category_wise_monthly_grand_profit');?>
                    </h3>
                    <div class="panel-body">
                        <div id="chartdiv4" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
	$ago = time()-86400;
	$result = $this->db->get_where('stock',array('datetime >= '=>$ago,'datetime <= '=>time()))->result_array();
	$result2 = $this->db->get_where('sale',array('sale_datetime >= '=>$ago,'sale_datetime <= '=>time()))->result_array();
	$stock = 0;
	foreach($result as $row){
		if($row['type'] == 'add'){
			$stock += $row['total'];
		}
	}
	$destroy = 0;
	foreach($result as $row){
		if($row['type'] == 'destroy'){
            if($row['reason_note'] !== 'sale'){
    			$destroy += $row['total'];
            }
		}
	}
	$sale = 0;
	foreach($result2 as $row){
		$sale += $row['grand_total'];
	}
?>


<script>
	var base_url = '<?php echo base_url(); ?>';
	var stock = <?php if($stock == 0){echo .1;} else {echo $stock;} ?>;
	var stock_max = <?php echo ($stock*3.5/3+100); ?>;
	var destroy = <?php if($destroy == 0){echo .1;} else {echo $destroy;} ?>;
	var destroy_max = <?php echo ($destroy*3.5/3+100); ?>;
	var sale = <?php if($sale == 0){echo .1;} else {echo $sale;} ?>;
	var sale_max = <?php echo ($sale*3.5/3+100); ?>;
	var currency = '<?php echo currency('','def'); ?>';
	var cost_txt = '<?php echo translate('cost'); ?>(<?php echo currency('','def'); ?>)';
	var value_txt = '<?php echo translate('value'); ?>(<?php echo currency('','def'); ?>)';
	var loss_txt = '<?php echo translate('loss'); ?>(<?php echo currency('','def'); ?>)';
	var pl_txt = '<?php echo translate('profit'); ?>/<?php echo translate('loss'); ?>(<?php echo currency('','def'); ?>)';

	var sale_details = [
	<?php
		$this->db->where('delivery_status','pending');
		$sales = $this->db->get('sale')->result_array();
		foreach($sales as $row){
		$orders 	= json_decode($row['shipping_address'],true);
		$address 	= str_replace("'","",$orders['address1']).' '.str_replace("'","",$orders['address2']);
		$langlat 	= explode(',',str_replace('(','',str_replace(')','',$orders['langlat'])));
		$grand_total = $row['grand_total'];
	?>
		['<?php echo $address; ?>', <?php echo $langlat[0]; ?>, <?php echo $langlat[1]; ?>, '<?php echo currency('','def').$this->cart->format_number($grand_total); ?>'],
	<?php } ?>
	];
	
	var sale_details1 = [];
		
	var chartData1 = [ 
		<?php
			$categories = $this->db->get('category')->result_array();
			foreach($categories as $row) {
				$this->crud_model->month_total('stock', 'category', $row['category_id'], 'type', 'add'); 
		?> 
		{
			 "country": "<?php echo $row['category_name']; ?>",
			 "visits": <?php echo $this->crud_model->month_total('stock', 'category', $row['category_id'], 'type', 'add'); ?> ,
			 "color": "#9365b8"
		 }, 
		 <?php
			} 
		 ?>
	];

	var chartData2 = [
		<?php
			$categories = $this->db->get('category')->result_array();
			foreach($categories as $row) {
				$this->crud_model->month_total('sale', 'category', $row['category_id']);
		 ?>
		 {
			 "country": "<?php echo $row['category_name']; ?>",
			 "visits": <?php echo $this->crud_model->month_total('sale', 'category', $row['category_id']); ?>,
			 "color": "#00a65a"
		 }, 
		 <?php
			}
		?>
	];

	var chartData3 = [
		<?php
			$categories = $this->db->get('category')->result_array();
			foreach($categories as $row) {
				$this->crud_model->month_total('stock', 'category', $row['category_id'], 'type', 'destroy'); 
		 ?>
		 {
			 "country": "<?php echo $row['category_name']; ?>",
			 "visits": <?php echo $this->crud_model->month_total('stock', 'category', $row['category_id'], 'type', 'destroy', 'reason_note', "sale"); ?> ,
			 "color": "#303641"
		 }, 
		 <?php
			} 
		 ?>
	];

	var chartData4 = [
		<?php
			$categories = $this->db->get('category')->result_array();
			foreach($categories as $row) {
				$fin = ($this->crud_model->month_total('sale', 'category', $row['category_id'])) - ($this->crud_model->month_total('stock', 'category', $row['category_id'], 'type', 'add'));
		?>
		{
			"country": "<?php echo $row['category_name']; ?>",
			"visits": <?php echo $fin; ?> ,
			"color": "#458fd2"
		},
		<?php
		}
		?>
	];

	var chartData5 = [
		{
			"country": "Default",
			"visits": <?php echo $this->db->get_where('vendor',array('membership'=>'0'))->num_rows(); ?> ,
			"color": "#458fd2"
		},
		<?php
			$membership_type = $this->db->get('membership')->result_array();
			foreach($membership_type as $row) {
				$fin = $this->db->get_where('vendor',array('membership'=>$row['membership_id']))->num_rows();
		?>
		{
			"country": "<?php echo $row['title']; ?>",
			"visits": <?php echo $fin; ?> ,
			"color": "#458fd2"
		},
		<?php
		}
		?>
	];
</script>
<script src="<?php echo base_url(); ?>template/back/js/custom/dashboard.js"></script>
<style>
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