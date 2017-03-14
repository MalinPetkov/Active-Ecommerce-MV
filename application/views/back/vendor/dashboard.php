<link rel="stylesheet" href="<?php echo base_url(); ?>template/back//amcharts/style.css" type="text/css">
<script src="<?php echo base_url(); ?>template/back/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/serial.js" type="text/javascript"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerclusterer/1.0/src/markerclusterer.js"></script>
<script src="<?php echo base_url(); ?>template/back/plugins/gauge-js/gauge.min.js"></script>

<div id="content-container">	
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('dashboard');?></h1>
    </div>
    <div id="page-content">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="col-md-4 col-lg-4">
                    <div class="panel panel-bordered panel-grad2" style="height:260px !important;">
                        <div class="panel-heading">
                            <h3 class="panel-title">
								<?php echo translate('membership_type');?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">
                                <?php
                                    $vend = $this->db->get_where('vendor',array('vendor_id'=>$this->session->userdata('vendor_id')))->row();
                                    $membership = $vend->membership;
                                ?>
                                <img class="img-lg" style="height:auto !important;"
                                    src="<?php echo $this->crud_model->file_view('membership',$membership,'100','','thumb','src','','','.png') ?>"  />
                                <h3>
                                    <?php
                                        if($membership == '0'){
                                            echo 'Default';
                                        } else {
                                            echo $this->db->get_where('membership',array('membership_id'=>$membership))->row()->title;
                                        }
                                		
                                	?>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8 col-lg-8">
                    <div class="panel panel-bordered panel-grad" style="height:260px !important;">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                            	<?php echo translate('membership_details');?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                        	<td><?php echo translate('display_name'); ?> </td>
                                            <td><?php echo $vend->display_name; ?></td>
                                        </tr>
                                        <tr>
                                        	<td><?php echo translate('membership_expiration'); ?> 
                                            <td>
                                            <?php 
                                                if($membership == '0'){
                                                    echo 'Lifetime';
                                                } else {
                                                    echo date('d M,Y',$vend->member_expire_timestamp);
                                                } 
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                        	<td><?php echo translate('maximum_products'); ?> </td>
                                            <td>
                                            <?php 
                                                if($membership == '0'){
                                                    echo $this->db->get_where('general_settings',array('type'=>'default_member_product_limit'))->row()->value;
                                                } else {
                                                    echo $this->db->get_where('membership',array('membership_id'=>$membership))->row()->product_limit; 
                                                }
                                            ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><?php echo translate('total_uploaded_products'); ?> </td>
                                            <td><?php echo $this->db->get_where('product',array('added_by'=>'{"type":"vendor","id":"'.$this->session->userdata('vendor_id').'"}'))->num_rows(); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo translate('uploaded_published_products'); ?> </td>
                                            <td><?php echo $this->db->get_where('product',array('added_by'=>'{"type":"vendor","id":"'.$this->session->userdata('vendor_id').'"}','status'=>'ok'))->num_rows(); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-bordered panel-grad2" style="height:260px !important;">
                        <div class="panel-heading">
                            <h3 class="panel-title">
								<?php echo translate('vendorship_timespan');?> 
								<?php echo translate('remaining'); ?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">
                                  <div class="main-example">
                                  <div class="countdown-container" id="main-example"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        
        <script type="text/template" id="main-example-template">
			<div class="time <%= label %>">
			  <span class="count curr top"><%= curr %></span>
			  <span class="count next top"><%= next %></span>
			  <span class="count next bottom"><%= next %></span>
			  <span class="count curr bottom"><%= curr %></span>
			  <span class="label label-purple"><%= label.length < 6 ? label : label.substr(0, 3)  %></span>
			</div>
        </script>
        <script type="text/javascript">
          $(window).on('load', function() {
            var labels = ['weeks', 'days', 'hours', 'minutes', 'seconds'],
              nextYear = '<?php echo date('Y/m/d',$vend->member_expire_timestamp); ?>',
              template = _.template($('#main-example-template').html()),
              currDate = '00:00:00:00:00',
              nextDate = '00:00:00:00:00',
              parser = /([0-9]{2})/gi,
              $example = $('#main-example');
            // Parse countdown string to an object
            function strfobj(str) {
              var parsed = str.match(parser),
                obj = {};
              labels.forEach(function(label, i) {
                obj[label] = parsed[i]
              });
              return obj;
            }
            // Return the time components that diffs
            function diff(obj1, obj2) {
              var diff = [];
              labels.forEach(function(key) {
                if (obj1[key] !== obj2[key]) {
                  diff.push(key);
                }
              });
              return diff;
            }
            // Build the layout
            var initData = strfobj(currDate);
            labels.forEach(function(label, i) {
              $example.append(template({
                curr: initData[label],
                next: initData[label],
                label: label
              }));
            });
            // Starts the countdown
            $example.countdown(nextYear, function(event) {
              var newDate = event.strftime('%w:%d:%H:%M:%S'),
                data;
              if (newDate !== nextDate) {
                currDate = nextDate;
                nextDate = newDate;
                // Setup the data
                data = {
                  'curr': strfobj(currDate),
                  'next': strfobj(nextDate)
                };
                // Apply the new values to each node that changed
                diff(data.curr, data.next).forEach(function(label) {
                  var selector = '.%s'.replace(/%s/, label),
                      $node = $example.find(selector);
                  // Update the node
                  $node.removeClass('flip');
                  $node.find('.curr').text(data.curr[label]);
                  $node.find('.next').text(data.next[label]);
                  // Wait for a repaint to then flip
                  _.delay(function($node) {
                    $node.addClass('flip');
                  }, 50, $node);
                });
              }
            });
          });
        </script>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="col-md-4 col-lg-4">
                    <div class="panel panel-bordered panel-purple">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('total_sold');?></h3>
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
                            <h3 class="panel-title"><?php echo translate('paid_by_customers');?></h3>
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
                            <h3 class="panel-title"><?php echo translate('due_from_admin');?></h3>
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
        </div>
		<div class="row">
        	<div class="col-md-12 col-lg-12">
                <div class="col-md-12 col-lg-12">
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
</div>


<?php
	$vendor_id = $this->session->userdata('vendor_id');
	$cod_paid = $this->crud_model->vendor_share_total($vendor_id,'paid','cash_on_delivery');
	$stock = $this->crud_model->vendor_share_total($vendor_id);
	$stock = $stock['total'];
	$sale = $this->crud_model->vendor_share_total($vendor_id,'paid');
	$sale = $sale['total'];
	$already_paid = $this->crud_model->paid_to_vendor($vendor_id);
	$destroy = $sale-$already_paid-$cod_paid['total'];
    //echo $already_paid;
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

	var sale_details = [];
	
	var sale_details1 = [];

	var chartData1 = [];

	var chartData2 = [];

	var chartData3 = [];

	var chartData4 = [
		<?php
			$categories = $this->db->get('category')->result_array();
			foreach($categories as $row) {
				if($this->crud_model->is_category_of_vendor($row['category_id'],$vendor_id)){
					$fin = ($this->crud_model->month_total('sale', 'category', $row['category_id'])) - ($this->crud_model->month_total('stock', 'category', $row['category_id'], 'type', 'add'));
			?>
			{
				"country": "<?php echo $row['category_name']; ?>",
				"visits": <?php echo $fin; ?> ,
				"color": "#458fd2"
			},
		<?php
				}
			}
		?>
	];

	var chartData5 = [];
</script>
<script src="<?php echo base_url(); ?>template/back/js/custom/dashboard.js"></script>
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
		height: 400px;
	  }
	  #map1 {
		width: 100%;
		height: 400px;
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