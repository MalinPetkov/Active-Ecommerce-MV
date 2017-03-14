    <div class="panel-body" id="demo_s">
        <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="true" data-show-columns="false" data-search="true" >
            <thead>
                <tr>
                    <th><?php echo translate('no'); ?></th>
                    <th><?php echo translate('name'); ?></th>
                    <th><?php echo translate('email'); ?></th>
                    <th><?php echo translate('role'); ?></th>
                    <th class="text-right"><?php echo translate('options'); ?></th>
                </tr>
            </thead>
            <tbody >
            <?php
				$i = 0;
                foreach($all_admins as $row){
					$i++;
            ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $this->crud_model->get_type_name_by_id('role',$row['role']); ?></td>
                    <td class="text-right">
                        <a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                            onclick="ajax_modal('edit','<?php echo translate('edit_admin'); ?>','<?php echo translate('successfully_edited!'); ?>','admin_edit','<?php echo $row['admin_id']; ?>')" 
                                data-original-title="Edit" data-container="body">
                                    <?php echo translate('edit');?>
                        </a>
                        <?php if($row['admin_id'] !== '1'){ ?>
                        <a onclick="delete_confirm('<?php echo $row['admin_id']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" 
                        	class="btn btn-danger btn-xs btn-labeled fa fa-trash" 
                            	data-toggle="tooltip"data-original-title="Delete" data-container="body">
                                	<?php echo translate('delete');?>
                        </a>
                        <?php } ?>
                    </td>
                </tr>
            <?php
                }
            ?>
            </tbody>
        </table>
    </div>
           
    <div id='export-div'>
        <h1 style="display:none;"><?php echo translate('staffs');?></h1>
        <table id="export-table" data-name='staffs' data-orientation='l' style="display:none;">
                <thead>
                    <tr>
                        <th><?php echo translate('no');?></th>
                        <th><?php echo translate('name');?></th>
                        <th><?php echo translate('email');?></th>
                        <th><?php echo translate('phone');?></th>
                        <th><?php echo translate('sddress');?></th>
                        <th><?php echo translate('role');?></th>
                    </tr>
                </thead>
                    
                <tbody >
                <?php
                    $i = 0;
                    foreach($all_admins as $row){
                        $i++;
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $this->crud_model->get_type_name_by_id('role',$row['role']); ?></td>
                </tr>
                <?php
                    }
                ?>
                </tbody>
        </table>
    </div>
           