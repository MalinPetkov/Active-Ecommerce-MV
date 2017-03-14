
<?php 
    $i = 0;
    foreach ($query as $row1) {
        $i++;
?>
    <tr>
        <td><?php echo $i; ?></td>
        <td class="image">
            <a class="media-link" href="<?php echo $this->crud_model->product_link($row1['product_id']); ?>">
                <i class="fa fa-plus"></i>
                <img width="100" src="<?php echo $this->crud_model->file_view('product',$row1['product_id'],'','','thumb','src','multi','one'); ?>" alt=""/>
            </a>
        </td>
        <td class="description"><?php echo $row1['title']; ?></td>
        <td class="price"><?php echo currency($this->crud_model->get_product_price($row1['product_id'])); ?></td>
        <td class="add">
            <?php if($row1['current_stock'] <= 0 && $row1['download'] !== 'ok'){ ?>
                <span class="label label-danger" style="margin:2px;">
                    <?php echo translate('unvailable'); ?>
                </span>
            <?php } else { ?>
                <span class="label label-success">
                    <?php echo translate('available'); ?>
                </span>
            <?php } ?>
        </td>
        <td class="add">
            <?php if(!$this->crud_model->is_added_to_cart($row1['product_id'])){ ?>
                <span class="btn btn-theme btn-theme-xs btn-icon-left  ajax-to-cart" data-pid='<?php echo $row1['product_id']; ?>' >
                    <i class="fa fa-shopping-cart"></i> 
                    <?php echo translate('add_to_cart'); ?>
                </span>
            <?php } else { ?>
                <span class="btn btn-theme btn-theme-xs btn-icon-left ajax-to-cart" data-pid='<?php echo $row1['product_id']; ?>'  >
                    <i class="fa fa-shopping-cart"></i>
                    <?php echo translate('added_to_cart'); ?>
                </span>
            <?php } ?>
        </td>
        <td class="total">
            <span class="remove_from_wish" style="cursor:pointer;" data-pid='<?php echo $row1['product_id']; ?>' >
                <i class="fa fa-trash" style="color: #f00;"></i>
            </span>
        </td>                        
    </tr>                                      
<?php 
    }
?>


<tr class="text-center" style="display:none;" >
    <td id="pagenation_set_links" ><?php echo $this->ajax_pagination->create_links(); ?></td>
</tr>
<!--/end pagination-->


<script>
    $(document).ready(function(){ 
        product_listing_defaults();
        $('.pagination_box').html($('#pagenation_set_links').html());
    });
</script>