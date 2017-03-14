<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true"  data-show-toggle="true" data-show-columns="true" data-search="true" >

        <thead>
            <tr>
                <th style="width:4ex"><?php echo translate('ID');?></th>
                <th><?php echo translate('from');?></th>
                <th><?php echo translate('date');?></th>
                <th><?php echo translate('total');?></th>
                <th><?php echo translate('total_due');?></th>
                <th><?php echo translate('paid_amount');?></th>
                <th><?php echo translate('payment_method');?></th>
                <th><?php echo translate('payment_status');?></th>
                <th class="text-right"><?php echo translate('options');?></th>
            </tr>
        </thead>
            
        <tbody>
        <?php
            $i = 0;
			//$total = $this->crud_model->vendor_share_total($this->session->userdata('vendor_id'));
			$total = $this->crud_model->vendor_share_total($this->session->userdata('vendor_id'),'paid');
			$cod_paid = $this->crud_model->vendor_share_total($this->session->userdata('vendor_id'),'paid','cash_on_delivery');
			$to_be_paid = $total['total'] - $cod_paid['total'];
			$paid_amount = 0;
			foreach($payment_list as $row){
				$paid_amount += $row['amount'];
			}
			foreach($payment_list as $row){
                $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo translate('admin');?></td>
            <td><?php echo date('d-m-Y',$row['timestamp']); ?></td>
            <td><?php echo currency('','def').$to_be_paid;?></td>
            <td><?php echo currency('','def').($to_be_paid - $paid_amount);?></td>
            <td><?php echo currency('','def').$row['amount'];?></td>
            <td>
                <?php 
                    if($row['method'] =='c2'){
                        echo 'Twocheckout';
                    }else{
                        echo $row['method'];
                    }
                ?>
            </td>
            <td><?php echo $row['status'];?></td>
            
            <td class="text-right">
                <a class="btn btn-info btn-xs btn-labeled fa fa-usd" data-toggle="tooltip" 
                    onclick="ajax_modal('admin_payment_details','<?php echo translate('admin_payment_details'); ?>','<?php echo translate('successfully_edited!'); ?>','admin_payment_details','<?php echo $row['vendor_invoice_id']; ?>')" 
                        data-original-title="Edit" data-container="body">
                            <?php echo translate('check_details'); ?>
                </a>
            </td>
        </tr>
        <?php
				$paid_amount -= $row['amount'];
            }
        ?>
        </tbody>
    </table>
</div>  
    <div id='export-div' style="padding:40px;">
        <h1 id ='export-title' style="display:none;"><?php echo translate('admin_payments'); ?></h1>
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
                        <th>Total Amount</th>
                        <th>Due Amount</th>
                        <th>Paid Amount</th>
                    </tr>
                </thead>

                <tbody >
                <?php
                    $i = 0;
					$paid_amount;
                    foreach($payment_list as $row){
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td> 
                    <td><?php echo date('d-M-Y',$row['timestamp']); ?></td>
                    <td><?php echo currency('','def').$to_be_paid;?></td>
                    <td><?php echo currency('','def').($to_be_paid - $paid_amount);?></td>
                    <td><?php echo currency('','def').$row['amount'];?></td>              
                </tr>
                <?php
						$paid_amount = $paid_amount - $row['amount'];
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



           