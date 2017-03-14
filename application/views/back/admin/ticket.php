<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('manage_ticket');?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content"> 
                    <div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding: 5px;">
                    
                        <button class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn" 
                            style="display:none;"  onclick="ajax_set_list();  proceed('to_add');"><?php echo translate('back_to_ticket_list');?>
                        </button> 
                    </div>         
                                      
                    <div class="tab-pane fade active in" id="list" 
                        style="border:1px solid #ebebeb; border-radius:4px;">   
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<span id="prod" style="display:none;"></span>
<script>
    var base_url = '<?php echo base_url(); ?>';
    var user_type = 'admin';
    var module = 'ticket';
    var list_cont_func = 'list';
    var dlt_cont_func = 'delete';

    function proceed(type) {
        if (type == 'to_list') {
            $(".pro_list_btn").show();
        } else if (type == 'to_add') {
            $(".pro_list_btn").hide();
        }
    }
	function set_summer(){
        $('.summernotes').each(function() {
            var now = $(this);
            var h = now.data('height');
            var n = now.data('name');
            now.closest('div').append('<input type="hidden" class="val" name="'+n+'">');
            now.summernote({
                height: h,
                onChange: function() {
                    now.closest('div').find('.val').val(now.code());
                }
            });
            now.closest('div').find('.val').val(now.code());
        });
	}
</script>

