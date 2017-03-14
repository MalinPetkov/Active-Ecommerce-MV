
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
        <td class="add">
            <span class="btn btn-theme btn-theme-xs btn-icon-left download_it" data-pid='<?php echo $row1['product_id']; ?>'  >
                <i class="fa fa-download"></i>
                <?php echo translate('download'); ?>
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
        
        $('.download_it').on('click',function(){
            var here = $(this);
            var id = here.data('pid');
            var txt = here.html();
            $.ajax({
                url: base_url+'index.php/home/can_download/'+id,
                beforeSend: function() {
                    $(this).html('<?php echo translate('downloading..'); ?>');
                },
                success: function(data) {
                    if(data == 'not'){
                        notify("<?php echo translate('download_permission_denied'); ?>",'warning','bottom','right');
                    } else {
                        window.location =""+base_url+'index.php/home/download/'+id+"";
                    }
                    here.html(txt);
                },
                error: function(e) {
                    console.log(e)
                }
            });
        });
        
    });
</script>