<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,3" data-show-toggle="true" data-show-columns="false" data-search="true" >
        <thead>
            <tr>
                <th><?php echo translate('no');?></th>
                <th><?php echo translate('seal');?></th>
                <th><?php echo translate('title');?></th>
                <th><?php echo translate('price');?></th>
                <th><?php echo translate('for');?></th>
                <th class="text-right"><?php echo translate('options');?></th>
            </tr>
        </thead>				
        <tbody >
        <tr>
            <td><?php echo 1; ?></td>
            <td>
                <img class="img-md img-circle"
                    src="<?php echo $this->crud_model->file_view('membership',0,'100','','thumb','src','','','.png') ?>"  />
            </td>
            <td>Free (Default)</td>
            <td><?php echo currency('','def').'0'; ?></td>
            <td><?php echo translate('lifetime');?></td>
            <td class="text-right">
                <a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                    onclick="ajax_modal('default','<?php echo translate('edit_vendor_package'); ?>','<?php echo translate('successfully_edited!'); ?>','membership_edit',0)" data-original-title="Edit" data-container="body">
                        <?php echo translate('edit');?>
                </a>
            </td>
        </tr>
        <?php
            $i=1;
            foreach($all_memberships as $row){
                $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td >
                <img class="img-md img-circle"
                    src="<?php echo $this->crud_model->file_view('membership',$row['membership_id'],'100','','thumb','src','','','.png') ?>"  />
            </td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo currency('','def').$row['price']; ?></td>
            <td><?php echo $row['timespan']; ?> <?php echo translate('days');?></td>
            <td class="text-right">
                <a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                    onclick="ajax_modal('edit','<?php echo translate('edit_vendor_package'); ?>','<?php echo translate('successfully_edited!'); ?>','membership_edit','<?php echo $row['membership_id']; ?>')" data-original-title="Edit" data-container="body">
                        <?php echo translate('edit');?>
                </a>
                <a onclick="delete_confirm('<?php echo $row['membership_id']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" 
                        class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip"
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
           
<div id='export-div'>
    <h1 style="display:none;"><?php echo translate('membership');?></h1>
    <table id="export-table" data-name='membership' data-orientation='p' style="display:none;">
            <thead>
                <tr>
                    <th><?php echo translate('no');?></th>
                    <th><?php echo translate('title');?></th>
                    <th><?php echo translate('price');?></th>
                </tr>
            </thead>
                
            <tbody >
            <?php
                $i = 0;
                foreach($all_memberships as $row){
                    $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo currency('','def').$row['price']; ?></td>
            </tr>
            <?php
                }
            ?>
            </tbody>
    </table>
</div>
           