<!--[if lt IE 9]>
<script
 src="<?php echo base_url(); ?>template/front/layerslider/assets/js/html5.js"></script>
<![endif]-->

<!-- LayerSlider stylesheet -->
<link rel="stylesheet" href="<?php echo base_url(); ?>template/front/layerslider/css/layerslider.css" type="text/css">
<script src="<?php echo base_url(); ?>template/front/layerslider/js/greensock.js"></script>
<script src="<?php echo base_url(); ?>template/front/layerslider/js/layerslider.transitions.js"></script>
<script src="<?php echo base_url(); ?>template/front/layerslider/js/layerslider.kreaturamedia.jquery.js"></script>

<style>
	#layerslider * {
		font-family: Lato, 'Open Sans', sans-serif;
	}

</style>

	<div id="full-slider-wrapper" style="margin-bottom:30px;">
		<div id="layerslider" style="width:100%;height:500px;">

		<?php
			$this->db->where('status','ok');
			$this->db->order_by('serial','desc');
			$this->db->order_by('slider_id','desc');
			$sliders = $this->db->get('slider')->result_array();
			$h = count($sliders);
			$n = 0;
			foreach ($sliders as $row1) {
				$elements = json_decode($row1['elements'],true);
				$oimgs 	= $elements['images'];
				$txts 	= $elements['texts'];
				$style = json_decode($this->db->get_where('slider_style',array('slider_style_id'=>$row1['style']))->row()->value,true);
				$n++;
			?>
			
            <div class="ls-slide" <?php echo $style['full_slide_style']; ?> >
                <!--BACKGROUND-->
				<?php if(file_exists('uploads/slider_image/background_'.$row1['slider_id'].'.jpg')){ ?>
					<img src="<?php echo base_url(); ?>uploads/slider_image/background_<?php echo $row1['slider_id']; ?>.jpg" class="ls-bg" alt="Slide background"/>	
				<?php } else { ?>
					<img src="<?php echo base_url(); ?>uploads/others/slider default.jpg" class="ls-bg" alt="Slide background"/>
				<?php } ?>
                
                <?php 
                	foreach($style['images'] as $image){ 
                		if(in_array($image['name'], $oimgs)){
                ?>
                    <img class="ls-l" src="<?php echo base_url(); ?>uploads/slider_image/<?php echo $row1['slider_id']; ?>_<?php echo $image['name']; ?>.png"   style="<?php echo $image['style']; ?>" data-ls="<?php echo $image['data_ls']; ?>" >
                <?php
                		}
                	}
                ?>
                <?php 
                	foreach($style['texts'] as $text){
                		$txt = ''; $color = ''; $background = '';
                		foreach ($txts as $a) {
            				if($a['name'] == $text['name']){
            					$txt = $a['text'];
            					$color = $a['color']; 
            					$background = $a['background'];
                			}
                		}
                		if($txt !== ''){
                ?>
                    <<?php echo $text['element']; ?> class="ls-l" style="<?php echo $text['style']; ?> color:<?php echo $color; ?>; background:<?php echo $background; ?>" data-ls="<?php echo $text['data_ls']; ?>" >
                        <?php echo $txt; ?>
                    </<?php echo $text['element']; ?>>
                <?php 
                		}
                	}
                ?>
				<!--LEFT RIGHT WING-->
				<img class="ls-l ls-linkto-<?php if($n == 1){ echo $h;} else {echo $n-1; } ?>" style="top:460px;left:48%;white-space: nowrap;" data-ls="offsetxin:-50;delayin:1000;rotatein:-40;offsetxout:-50;rotateout:-40;"
					 src="<?php echo base_url(); ?>uploads/slider_image/defaults/left.png" alt="">
				<img class="ls-l ls-linkto-<?php if($n == $h){ echo 1;} else {echo $n+1; } ?>" style="top:460px;left:52%;white-space: nowrap;" data-ls="offsetxin:50;delayin:1000;offsetxout:50;"
					 src="<?php echo base_url(); ?>uploads/slider_image/defaults/right.png" alt="">
			</div>
		<?php
			}
		?>
		</div>
	</div>


	<!-- Initializing the slider -->
	<script>
		function start_slider(){
			jQuery("#layerslider").layerSlider({
				responsive: true,
				responsiveUnder: 1280,
				layersContainer: 1280,
				skin: 'noskin',
				hoverPrevNext: false,
				skinsPath: '<?php echo base_url(); ?>template/front/layerslider/skins/'
			});
		}
		
		$(document).ready(function(e) {
            setTimeout(function(){ start_slider(); }, 500);
        });
		
	</script>
    
