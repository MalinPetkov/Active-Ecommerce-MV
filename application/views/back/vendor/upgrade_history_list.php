<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true"  data-show-toggle="true" data-show-columns="true" data-search="true" >

        <thead>
            <tr>
                <th style="width:4ex"><?php echo translate('ID');?></th>
                <th><?php echo translate('date');?></th>
                <th><?php echo translate('package_seal');?></th>
                <th><?php echo translate('upgrade_package');?></th>
                <th><?php echo translate('price');?></th>
                <th><?php echo translate('payment_method');?></th>
                <th><?php echo translate('payment_status');?></th>
                <th class="text-right"><?php echo translate('options');?></th>
            </tr>
        </thead>
            
        <tbody>
        <?php
            $i = 0;
            foreach($package_history as $row){
                $i++;
        ?>
        <tr>
            <td>#<?php echo $i; ?></td>
            <td><?php echo date('d-M-Y',$row['timestamp']); ?></td>
            <td>
            	<img class="img-md img-circle"
                    src="<?php echo $this->crud_model->file_view('membership',$row['membership'],'100','','thumb','src','','','.png') ?>"  />
            </td>
            <td>
				<?php echo $this->crud_model->get_type_name_by_id('membership',$row['membership'],'title'); ?></td>
            <td><?php echo  currency('','def').$row['amount']; ?></td>
            <td>
                <?php
                    if($row['method'] == 'c2'){
                        echo 'Twocheckout';
                    }else{
                        echo $row['method'];
                    }
                ?>
            </td>
            <td>
                <span class="label label-<?php if($row['status'] == 'paid'){ ?>purple<?php } else { ?>danger<?php } ?>">
                <?php echo  $row['status']; ?>
                </span>
            </td>
            <td class="text-right">
                <a class="btn btn-info btn-xs btn-labeled fa fa-check" data-toggle="tooltip" 
                    onclick="ajax_modal('view','<?php echo translate('view_upgrade_details'); ?>','<?php echo translate('successfully_viewed!'); ?>','upgrade_history_view','<?php echo $row['membership_payment_id']; ?>')" data-original-title="View" data-container="body">
                        <?php echo translate('check_details');?>
                </a>
            </td>
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
</div>  
    <div id='export-div' style="padding:40px;">
        <h1 id ='export-title' style="display:none;">
			<?php echo translate('package_upgrade_history'); ?>
        </h1>
        <table id="export-table" class="table" data-name='sales' data-orientation='l' data-width='1500' style="display:none;">
                <colgroup>
                    <col width="50">
                    <col width="150">
                    <col width="150">
                    <col width="150">
                    <col width="250">
                </colgroup>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Package Seal</th>
                        <th>Upgraded Package</th>
                        <th>Price</th>
                        <th>Payment Method</th>
                        <th>Payment Status</th>
                    </tr>
                </thead>

                <tbody >
                <?php
                    $i = 0;
                    foreach($package_history as $row){
                        $i++;
                ?>
                <tr>
                   	<td>#<?php echo $i; ?></td>
                    <td><?php echo date('d-M-Y',$row['timestamp']); ?></td>
                    <td>
                        <img class="img-md img-circle"
                            src="<?php echo $this->crud_model->file_view('membership',$row['membership'],'100','','thumb','src','','','.png') ?>"  />
                    </td>
                    <td>
                        <?php echo $this->crud_model->get_type_name_by_id('membership',$row['membership'],'title'); ?></td>
                    <td><?php echo  currency('','def').$row['amount']; ?></td>
                    <td>
                        <?php echo $row['method']; ?>
                    </td>
                    <td>
                        <span class="label label-<?php if($row['status'] == 'paid'){ ?>purple<?php } else { ?>danger<?php } ?>">
                        <?php echo  $row['status']; ?>
                        </span>
                    </td>               
                </tr>
                <?php
                    }
                ?>
                </tbody>
        </table>
    </div>
    
<style type="text/css">
    .pending{
        background: #D2F3FF  !important;
    }
    .pending:hover{
        background: #9BD8F7 !important;
    }
</style>



           