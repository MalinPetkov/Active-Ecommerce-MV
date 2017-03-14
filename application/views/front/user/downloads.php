<div class="information-title">
    <?php echo translate('your_downloads');?></div>
<div class="wishlist">
    <table class="table" style="background: #fff;">
        <thead>
            <tr>
                <th>#</th>
                <th><?php echo translate('image');?></th>
                <th><?php echo translate('name');?></th>
                <th><?php echo translate('download');?></th>
            </tr>
        </thead>
        <tbody id="result8">
        </tbody>
    </table>
</div>

<input type="hidden" id="page_num8" value="0" />

<div class="pagination_box">
</div>

<script>                                                                    
    function downloads_listed(page){
        if(page == 'no'){
            page = $('#page_num8').val();   
        } else {
            $('#page_num8').val(page);
        }
        var alerta = $('#result8');
        alerta.load('<?php echo base_url();?>index.php/home/downloads_listed/'+page,
            function(){
                
            }
        );   
    }
    $(document).ready(function() {
        downloads_listed('0');
    });
</script>