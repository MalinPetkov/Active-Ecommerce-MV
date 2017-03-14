<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" >
        <thead>
            <tr>
                <th><?php echo translate('logo');?></th>
                <th><?php echo translate('display_name');?></th>
                <th><?php echo translate('name');?></th>
                <th><?php echo translate('status');?></th>

                <th class="text-right"><?php echo translate('options');?></th>
            </tr>
        </thead>				
        <tbody >
        <?php
            $i = 0;
            foreach($all_vendors as $row){
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
            <td><?php echo $row['display_name']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td>
            	<div class="label label-<?php if($row['status'] == 'approved'){ ?>purple<?php } else { ?>danger<?php } ?>">
                	<?php echo $row['status']; ?>
                </div>
            </td>
            <td class="text-right">
                <a class="btn btn-dark btn-xs btn-labeled fa fa-user" data-toggle="tooltip" 
                    onclick="ajax_modal('view','<?php echo translate('view_profile'); ?>','<?php echo translate('successfully_viewed!'); ?>','vendor_view','<?php echo $row['vendor_id']; ?>')" data-original-title="View" data-container="body">
                        <?php echo translate('profile');?>
                </a>
                <a class="btn btn-success btn-xs btn-labeled fa fa-check" data-toggle="tooltip" 
                    onclick="ajax_modal('approval','<?php echo translate('vendor_approval'); ?>','<?php echo translate('successfully_viewed!'); ?>','vendor_approval','<?php echo $row['vendor_id']; ?>')" data-original-title="View" data-container="body">
                        <?php echo translate('approval');?>
                </a>
                <a class="btn btn-info btn-xs btn-labeled fa fa-dollar" data-toggle="tooltip" 
                    onclick="ajax_modal('pay_form','<?php echo translate('pay_vendor'); ?>','<?php echo translate('successfully_viewed!'); ?>','vendor_pay','<?php echo $row['vendor_id']; ?>')" data-original-title="View" data-container="body">
                        <?php echo translate('pay');?>
                </a>
                <a onclick="delete_confirm('<?php echo $row['vendor_id']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" 
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
		<h1 id ='export-title' style="display:none;"><?php echo translate('vendors'); ?></h1>
		<table id="export-table" class="table" data-name='vendors' data-orientation='p' data-width='1500' style="display:none;">
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
                        <th><?php echo translate('display_name');?></th>
                        <th><?php echo translate('name');?></th>
                        <th><?php echo translate('status');?></th>
                        <th><?php echo translate('e-mail');?></th>
					</tr>
				</thead>



				<tbody >
				<?php
					$i = 0;
	            	foreach($all_vendors as $row){
	            		$i++;
				?>
				<tr>
					<td><?php echo $i; ?></td>
                    <td><?php echo $row['display_name']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td><?php echo $row['email']; ?></td>          	
				</tr>
	            <?php
	            	}
				?>
				</tbody>
		</table>
	</div>
           