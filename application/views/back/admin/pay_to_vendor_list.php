<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" >
        <thead>
            <tr>
                <th><?php echo translate('logo');?></th>
                <th><?php echo translate('vendor');?></th>
                <th><?php echo translate('amount');?></th>
                <th><?php echo translate('payment_method');?></th>
                <th><?php echo translate('status');?></th>

                <th class="text-right"><?php echo translate('options');?></th>
            </tr>
        </thead>				
        <tbody >
        <?php
            $i = 0;
            foreach($vendor_payments as $row){
                $i++;
        ?>                
        <tr>
            <td>
				<?php
                    if(file_exists('uploads/vendor_logo_image/logo_'.$row['vendor_id'].'.png')){
                ?>
                <img class="img-sm img-border"
                    src="<?php echo base_url(); ?>uploads/vendor_logo_image/logo_<?php echo $row['vendor_id']; ?>.png" />  
                <?php
                    } else {
                ?>
                <img class="img-sm img-border"
                    src="<?php echo base_url(); ?>uploads/vendor_logo_image/default.jpg" alt="">
                <?php
                    }
                ?>
                
            </td>
            <td><?php echo $this->db->get_where('vendor',array('vendor_id'=>$row['vendor_id']))->row()->display_name; ?></td>
            <td><?php echo currency('','def').$row['amount']; ?></td>
            <td>
                <?php 
                    if($row['method'] =='c2'){
                        echo 'Twocheckout';
                    }else{
                        echo $row['method'];
                    }
                ?>        
            </td>
            <td>
                <div class="label label-<?php if($row['status'] == 'paid'){ ?>purple<?php } else { ?>danger<?php } ?>">
                	<?php echo $row['status']; ?>
                </div>
                <br>
                
            </td>
            <td class="text-right">
                <a class="btn btn-success btn-xs btn-labeled fa fa-usd" data-toggle="tooltip" 
                    onclick="ajax_modal('vendor_payment_status','<?php echo translate('vendor_payment_status'); ?>','<?php echo translate('successfully_edited!'); ?>','vendor_payment_status','<?php echo $row['vendor_invoice_id']; ?>')" 
                        data-original-title="Edit" data-container="body">
                            <?php echo translate('payment_status'); ?>
                </a>
                
                <a onclick="delete_confirm('<?php echo $row['vendor_invoice_id']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" 
                    data-original-title="Delete" data-container="body">
                        <?php echo translate('delete');?>
                </a>
            </td>
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
</div>
    <div id="vendr"></div>
    <div id='export-div' style="padding:40px;">
		<h1 id ='export-title' style="display:none;"><?php echo translate('pay_to_vendor'); ?></h1>
		<table id="export-table" class="table" data-name='membership_payments' data-orientation='p' data-width='1500' style="display:none;">
				<colgroup>
					<col width="50">
					<col width="150">
					<col width="150">
                    <col width="150">
                    <col width="150">
				</colgroup>
				<thead>
					<tr>
						<th><?php echo translate('no');?></th>
                        <th><?php echo translate('vendor');?></th>
                        <th><?php echo translate('amount');?></th>
                        <th><?php echo translate('payment_method');?></th>
                        <th><?php echo translate('status');?></th>
					</tr>
				</thead>



				<tbody >
				<?php
					$i = 0;
	            	foreach($vendor_payments as $row){
	            		$i++;
				?>
				<tr>
					<td><?php echo $i; ?></td>
                    <td><?php echo $this->db->get_where('vendor',array('vendor_id'=>$row['vendor_id']))->row()->display_name; ?></td>
                    <td><?php echo currency('','def').$row['amount']; ?></td>
                    <td><?php echo $row['method'];?></td>
                    <td><?php echo $row['status']; ?></td>         	
				</tr>
	            <?php
	            	}
				?>
				</tbody>
		</table>
	</div>
           