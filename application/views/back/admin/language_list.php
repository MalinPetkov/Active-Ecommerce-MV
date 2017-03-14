<form>
    <div class="col-sm-12 form-horizontal" style="margin-top:9px !important;">
        <table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="true" data-show-columns="false" data-search="true" >

            <thead>
                <tr>
                    <th><?php echo translate('no');?></th>
                    <th><?php echo translate('name');?></th>
                    <th><?php echo translate('icon');?></th>
                    <th><?php echo translate('publish');?></th>
                    <th class="text-right"><?php echo translate('options');?></th>
                </tr>
            </thead>
                
            <tbody >
            <?php
                $all_langss = $this->db->get('language_list')->result_array();
                $i = 0;
                foreach($all_langss as $row){
                    $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td>
                    <img class="img-md"
                        src="<?php echo $this->crud_model->file_view('language_list',$row['language_list_id'],'100','','thumb','src','','','.jpg') ?>"  />
                </td>
                <td>
                    <input class='aiz_switchery' type="checkbox" 
                            data-set='lang_set' 
                                data-id='<?php echo $row['language_list_id']; ?>'
                                    data-tm='<?php echo translate('language_enabled'); ?>' data-fm='<?php echo translate('language_disabled'); ?>' 
                                        <?php if($row['status'] == 'ok'){ ?>checked<?php } ?> />
                   
                </td>
                <td class="text-right">
                    <a class="btn btn-info btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                        onclick="ajax_set_full('lang_select','<?php echo translate('edit_language_list'); ?>','<?php echo translate('successfully_edited!'); ?>','language_list_edit','<?php echo $row['db_field']; ?>'); proceed('to_list');" 
                            data-original-title="Edit" data-container="body">
                                <?php echo translate('set_translations');?>
                    </a>
                    <a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                        onclick="ajax_modal('edit_lang','<?php echo translate('edit_language'); ?>','<?php echo translate('successfully_edited!'); ?>','language_edit','<?php echo $row['language_list_id']; ?>')" 
                            data-original-title="Edit" data-container="body">
                                <?php echo translate('edit');?>
                    </a>
                    <a onclick="delete_lang('<?php echo $row['db_field']; ?>')" class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" 
                        data-original-title="Delete" data-container="body">
                            <?php echo translate('delete_language');?>
                    </a>
                </td>
            </tr>
            <?php
                }
            ?>
            </tbody>
        </table>

        <div class="form-group" style="display:none;">
            <label class="col-sm-4 control-label" for="demo-hor-inputemail">
                <?php echo translate('select_language'); ?>
            </label>
            <div class="col-sm-6">
                <select name="language" class="demo-cs-multiselect" onchange="ajax_set_list(this.value);">
                <?php
                    $set_lang = $this->db->get_where('general_settings',array('type'=>'language'))->row()->value;
                    $fields = $this->db->list_fields('language');
                    foreach ($fields as $field)
                    {
                        if($field !== 'word' && $field !== 'word_id'){
                ?>
                    <option value="<?php echo $field; ?>" 
                        <?php if($set_lang == $field){ echo 'selected'; } ?> >
                            <?php echo ucfirst($field); ?>
                    </option>
                <?php
                        }
                    }
                ?>
                </select>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">

    function set_switchery(){
        $(".aiz_switchery").each(function(){
            new Switchery($(this).get(0), {color:'rgb(100, 189, 99)', secondaryColor: '#cc2424', jackSecondaryColor: '#c8ff77'});

            var changeCheckbox = $(this).get(0);
            var false_msg = $(this).data('fm');
            var true_msg = $(this).data('tm');
            changeCheckbox.onchange = function() {
                $.ajax({url: base_url+'index.php/admin/language_settings/'+$(this).data('set')+'/'+$(this).data('id')+'/'+changeCheckbox.checked, 
                success: function(result){  
                  if(changeCheckbox.checked == true){
                    $.activeitNoty({
                        type: 'success',
                        icon : 'fa fa-check',
                        message : true_msg,
                        container : 'floating',
                        timer : 3000
                    });
                    sound('published');
                  } else {
                    $.activeitNoty({
                        type: 'danger',
                        icon : 'fa fa-check',
                        message : false_msg,
                        container : 'floating',
                        timer : 3000
                    });
                    sound('unpublished');
                  }
                }});
            };
        });
    }

    $(document).ready(function() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    });
</script>

