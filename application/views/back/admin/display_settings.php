<input type="hidden" name="tab_name" value="<?php echo $tab_name; ?>" id="tab_name"/>
<div id="content-container"> 
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('display_settings');?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="tab-base tab-stacked-left">
                <ul class="nav nav-tabs" style="display:none;">
                    <li class="active">
                        <a data-toggle="tab" href="#tab-1" id="theme"><?php echo translate('theme_color');?></a>
                    </li>
                    
                    <li>
                        <a data-toggle="tab" href="#tab-2" id="logo"><?php echo translate('logo');?></a>
                    </li>
                    
                    <li>
                        <a data-toggle="tab" href="#tab-3" id="favicon"><?php echo translate('favicon');?></a>
                    </li>
                    
                    <li>
                        <a data-toggle="tab" href="#tab-4" id="font"><?php echo translate('fonts');?></a>
                    </li>
                    
                    <li>
                        <a data-toggle="tab" href="#tab-5" id="preloader"><?php echo translate('preloader');?></a>
                    </li>
                     <li>
                        <a data-toggle="tab" href="#tab-6" id="home"><?php echo translate('home_page');?></a>
                    </li>
                    <li>
                        <a data-toggle="tab" href="#tab-7" id="contact"><?php echo translate('contact');?></a>
                    </li>
                     <li>
                        <a data-toggle="tab" href="#tab-8" id="footer"><?php echo translate('footer');?></a>
                    </li>
                   
                </ul>

                <div class="tab-content bg_grey">
                	<span id="genset"></span>
                	<!--select : theme ---------->
                    <div id="tab-1" class="tab-pane fade active in">
                        <div id="theme_set">
                        </div>
                    </div>
                    <!--UPLOAD : logo---------->
                    <div id="tab-2" class="tab-pane fade">
                        <div id="logo_set">
                        </div>
                    </div>
                    <!--UPLOAD : FAVICON---------->
                    <div id="tab-3" class="tab-pane fade">
                         <div id="favicon_set">
                        </div>
                    </div>
                    <!--select : font ---------->
                    <div id="tab-4" class="tab-pane fade">
                        <div id="font_set">
                        </div>
                    </div>
                    <!--select : preloader ---------->
                    <div id="tab-5" class="tab-pane fade">
                        <div id="preloader_set">
                        </div>
                    </div>
                    <!--UPLOAD : homepage settings ---------->
                    <div id="tab-6" class="tab-pane fade">             
                        <div id="home_set">
                        </div>
                    </div>
                    <div id="tab-7" class="tab-pane fade">             
                        <div id="contact_set">
                        </div>
                    </div>
                    <div id="tab-8" class="tab-pane fade">             
                        <div id="footer_set">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="display:none;" id="site"></div>
<!-- for logo settings -->
<script>
var base_url = '<?php echo base_url(); ?>'
var user_type = 'admin';
var module = 'logo_settings';
var list_cont_func = 'show_all';
var dlt_cont_func = 'delete_logo';

$('#theme').on('click',function(){
	$("#theme_set").load("<?php echo base_url()?>index.php/admin/theme_part/");
});
$('#logo').on('click',function(){
	$("#logo_set").load("<?php echo base_url()?>index.php/admin/logo_part/");
});
$('#font').on('click',function(){
	$("#font_set").load("<?php echo base_url()?>index.php/admin/font_part/");
});
$('#favicon').on('click',function(){
	$("#favicon_set").load("<?php echo base_url()?>index.php/admin/favicon_part/");
});
$('#preloader').on('click',function(){
	$("#preloader_set").load("<?php echo base_url()?>index.php/admin/preloader_part/");
});
$('#home').on('click',function(){
	$("#home_set").load("<?php echo base_url()?>index.php/admin/home_part/");
});
$('#contact').on('click',function(){
	$("#contact_set").load("<?php echo base_url()?>index.php/admin/contact_part/");
});
$('#footer').on('click',function(){
	$("#footer_set").load("<?php echo base_url()?>index.php/admin/footer_part/");
});
$(document).ready(function() {
	var tab_name= $('#tab_name').val();
	if(tab_name=="theme"){
		$('#theme').click();
	}else if(tab_name=="logo"){
		$('#logo').click();
	}
	else if(tab_name=="font"){
		$('#font').click();
	}
	else if(tab_name=="favicon"){
		$('#favicon').click();
	}
	else if(tab_name=="preloader"){
		$('#preloader').click();
	}
	else if(tab_name=="home"){
		$('#home').click();
	}
	else if(tab_name=="contact"){
		$('#contact').click();
	}
	else if(tab_name=="footer"){
		$('#footer').click();
	}
	$("form").submit(function(e){
		return false;
	});
});
</script>

<style>
.img-fixed{
	width: 100px;	
}
.tr-bg{
background-image: url(http://www.mikechambers.com/files/html5/canvas/exportWithBackgroundColor/images/transparent_graphic.png)	
}

.cc-selector input{
    margin:0;padding:0;
    -webkit-appearance:none;
       -moz-appearance:none;
            appearance:none;
}
 
.cc-selector input:active +.drinkcard-cc
{
	opacity: 1;
	border:4px solid #169D4B;
}
.cc-selector input:checked +.drinkcard-cc{
	-webkit-filter: none;
	-moz-filter: none;
	filter: none;
	border:4px solid black;
}
.drinkcard-cc{
	cursor:pointer;
	background-size:contain;
	background-repeat:no-repeat;
	display:inline-block;
	-webkit-transition: all .6s ease-in-out;
	-moz-transition: all .6s ease-in-out;
	transition: all .6s ease-in-out;
	-webkit-filter:opacity(.7);
	-moz-filter:opacity(.7);
	filter:opacity(.7);
	border:4px solid transparent;
	border-radius:5px !important;
}
.drinkcard-cc:hover{
	-webkit-filter:opacity(1);
	-moz-filter: opacity(1);
	filter:opacity(1);
	border:4px solid #8400C5;
			
}

</style>

