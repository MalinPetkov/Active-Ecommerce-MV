<div class="panel-body" id="demo_s">
    <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,3" data-show-toggle="false" data-show-columns="false" data-search="true" >

        <thead>
            <tr>
                <th style="width:4ex"><?php echo translate('ID');?></th>
                <th><?php echo translate('title');?></th>
                <th><?php echo translate('image');?></th>
                <th><?php echo translate('publish');?></th>
                <th class="text-right"><?php echo translate('options');?></th>
            </tr>
        </thead>
            
        <tbody >
        <?php
            $i = 0;
            foreach($all_slider as $row){
                $i++;
        ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $row['title']; ?></td>
            <td>
                <img  class="img-responsive thumbnail img-slider mr-none" src="<?php echo base_url(); ?>uploads/slider_image/background_<?php echo $row['slider_id']; ?>.jpg" />
            </td>
            <td>
                <input id="sli_<?php echo $row['slider_id']; ?>" class='sw1' type="checkbox" data-id='<?php echo $row['slider_id']; ?>' <?php if($row['status'] == 'ok'){ ?>checked<?php } ?> />
            </td>
            <td class="text-right">
                <a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                    onclick="ajax_set_full('edit','<?php echo translate('title'); ?>','<?php echo translate('successfully_edited!'); ?>','slider_edit','<?php echo $row['slider_id']; ?>')" 
                        data-original-title="Edit" data-container="body"><?php echo translate('edit');?></i>
                </a>
                
                <a onclick="delete_confirm('<?php echo $row['slider_id']; ?>','Really want to delete this?')"
                    class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" 
                        data-original-title="Delete" data-container="body"><?php echo translate('delete');?>
                </a>
            </td>
        </tr>
        <?php
            }
        ?>
        </tbody>
    </table>
</div>
           