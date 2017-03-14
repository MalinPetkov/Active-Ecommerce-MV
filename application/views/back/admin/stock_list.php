	<div class="panel-body" id="demo_s">		
		<table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" >
			<thead>
				<tr>
					<th style="width:4ex"><?php echo translate('ID');?></th>
					<th><?php echo translate('product_title');?></th>
					<th><?php echo translate('entry_type');?></th>
					<th><?php echo translate('quantity');?></th>
					<th><?php echo translate('note');?></th>
					<th class="text-right"><?php echo translate('options');?></th>
				</tr>
			</thead>				
			<tbody >
			<?php
            	foreach($all_stock as $row){
			?>
			<tr>
				<td><?php echo $row['stock_id']; ?></td>
				<td><?php echo $this->crud_model->get_type_name_by_id('product',$row['product'],'title'); ?></td>
				<td><?php echo $row['type']; ?></td>
				<td><?php echo $row['quantity']; ?></td>
				<td><?php echo $row['reason_note']; ?></td>
				<td class="text-right">
					<?php
						if($row['type'] == 'add'){
					?>
						<a onclick="delete_confirm('<?php echo $row['stock_id']; ?>','<?php echo translate('added_quantity_will_be_reduced.'); ?> <?php echo translate('really_want_to_delete_this?'); ?>')" 
	                    	class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" 
	                        	data-container="body"><?php echo translate('delete');?>
	                    </a>
					<?php
						} else if($row['type'] == 'destroy') {
					?>
						<a onclick="delete_confirm('<?php echo $row['stock_id']; ?>','<?php echo translate('reduced_quantity_will_be_added.'); ?> <?php echo translate('really_want_to_delete_this?'); ?>')" 
	                    	class="btn btn-xs btn-danger btn-labeled fa fa-trash" data-toggle="tooltip" data-original-title="Delete" 
	                        	data-container="body"><?php echo translate('delete');?>
	                    </a>
					<?php
						}
					?>
				</td>
			</tr>
            <?php
            	}
			?>
			</tbody>
		</table>
	</div>    
    <div id='export-div' style="padding:40px;">
		<h1 id ='export-title' style="display:none;"><?php echo translate('product_stock'); ?></h1>
		<table id="export-table" class="table" data-name='product_stock' data-orientation='p' data-width='1500' style="display:none;">
				<colgroup>
					<col width="50">
					<col width="150">
					<col width="150">
					<col width="150">
					<col width="150">
				</colgroup>
				<thead>
					<tr>
						<th><?php echo translate('No');?></th>
                        <th><?php echo translate('product_title');?></th>
                        <th><?php echo translate('entry_type');?></th>
                        <th><?php echo translate('quantity');?></th>
                        <th><?php echo translate('note');?></th>
					</tr>
				</thead>



				<tbody >
				<?php
					$i = 0;
	            	foreach($all_stock as $row){
	            		$i++;
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $this->crud_model->get_type_name_by_id('product',$row['product'],'title'); ?></td>
					<td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td><?php echo $row['reason_note']; ?></td>
                	
				</tr>
	            <?php
	            	}
				?>
				</tbody>
		</table>
	</div>