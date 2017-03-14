<div class="panel">
	<div id="page-title">
		<center><h2 class="page-header text-overflow"><?php echo translate('choose_your_slider_style');?></h2></center>
	</div>
    <div class="panel-body">
        <div class="col-md-12" id="adder">
			<?php include 'slider_style_list.php'; ?>
        </div>
    </div>
</div>

<script type="text/javascript">

    function run_slide(elem){
        elem.layerSlider({
            responsive: false,
            responsiveUnder: 1280,
            layersContainer: 1280,
            skin: 'noskin',
            hoverPrevNext: false,
            skinsPath: '<?php echo base_url(); ?>template/front/layerslider/skins/'
        });
    }

    $('.style_chooser').click(function() {
        var id = $(this).data('id');
        $("#adder").load("<?php echo base_url(); ?>index.php/admin/slider/add_form/"+id);
    });
    $('.player').click(function() {
        var outer = $(this).closest('.slider_preview');
		var style_layer = outer.find('.style_layer');
        style_layer.remove();
        outer.append(''
            +'<div class="style_layer" style="width:100%;height:500px;"></div>'
        );
		var style_layer = outer.find('.style_layer');
		style_layer.html(outer.find('.back_layer').html());
		run_slide(style_layer);
    });

    $(document).ready(function() {
        $('.style_layer').each(function(){
            run_slide($(this));
        });
    });

</script>
