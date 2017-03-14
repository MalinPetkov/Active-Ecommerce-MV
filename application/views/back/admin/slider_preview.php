<head>
	
	<!--[if lt IE 9]>
		<script src="<?php echo base_url(); ?>template/front/layerslider/assets/js/html5.js"></script>
	<![endif]-->

	<!-- LayerSlider stylesheet -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>template/front/layerslider/css/layerslider.css" type="text/css">
	<!-- External libraries: jQuery & GreenSock -->
	<script src="<?php echo base_url(); ?>template/front/layerslider/js/greensock.js" type="text/javascript"></script>
	<!-- LayerSlider script files -->
	<script src="<?php echo base_url(); ?>template/front/layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>template/front/layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>

	<style>
		#layerslider * {
			font-family: 'Roboto', sans-serif;
		}
		body {
			padding: 0 !important;
		}
	</style>
</head>
<body class="nobg">

		<div id="layerslider" style="width:100%;height:300px;">
			
			<div class="ls-slide" data-ls="transition2d:1;timeshift:0;">

			</div>

		</div>

	<!-- Initializing the slider -->
	<script>
	function load_set(){
		var back = $('body #background_temp').val();
		$(".ls-slide").append('<img src="'+back+'" class="ls-bg" alt="Slide background"/>');
		
		$('.otherimg').each(function(){
			var now = $(this).closest('.panel');
			var itop = now.find('')
			$(".ls-slide").append(''
				+'	<img class="ls-l" style="top:'+itop+'px;left:'+ileft+'%; width: '+iwidth+'px; white-space: nowrap;" data-ls="delayin:'+idin+';durationin:'+iduin+';durationout:'+idout+';showuntil:'+iswuntl+';"
						 src="'+omg+'" alt="">'
			);
		});

		load_slider();
	}

	function load_slider(){
		jQuery("#layerslider").layerSlider({
			responsive: false,
			responsiveUnder: 1280,
			layersContainer: 1280,
			skin: 'noskin',
			hoverPrevNext: false,
			skinsPath: '<?php echo base_url(); ?>template/front/layerslider/skins/'
		});		
	}
	</script>
</body>
