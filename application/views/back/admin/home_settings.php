<?php 
	$home_style =  $this->db->get_where('ui_settings',array('type' => 'home_page_style'))->row()->value;
?>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo translate('choose_home_page_style');?></h3>
        </div>
        <?php
            echo form_open(base_url() . 'index.php/admin/ui_settings/ui_home/update_home_page/', array(
                'class' => 'form-horizontal',
                'method' => 'post'
            ));
        ?>
            <div class="panel-body">
                <div class="form-group">
                    <?php
                        $style = array(1,2);
                        foreach($style as $value){
                    ?>
                        <div class="col-sm-6 box_area">
                            <div class="cc-selector">
                                <input type="radio" id="home_<?php echo $value; ?>" value="<?php echo $value; ?>" name="home_page" <?php if($home_style == $value){ echo 'checked'; } ?> >
                                <label class="drinkcard-cc" style="margin-bottom:0px; width:100%;" for="home_<?php echo $value; ?>">
                                    <div class="col-sm-12">
                                        <div class="img_show">
                                            <img src="<?php echo base_url() ?>uploads/home_pages/<?php echo 'home_'.$value.'.jpg' ?>" width="100%" style=" text-align-last:center;" alt="<?php echo 'home_style_'.$value; ?>" />
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div class="home_title">
                                <h3>
                                	<span>
                                    	<i class="fa fa-check"></i>
                                    </span>
									<?php echo translate('home_page_style').' '.$value; ?> 
                                </h3>
                            </div>
                         </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="panel-footer text-right">
                <span class="btn btn-info submitter enterer" data-ing='<?php echo translate('updating..'); ?>' data-msg='<?php echo translate('home_page_updated!'); ?>' onClick="check_style()">
                    <?php echo translate('update_home_page');?>
                </span>
            </div>       
        </form>
    </div>
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo translate('change_home_page_items');?></h3>
        </div>
        <div id="home_item_set">
            
        </div>     
    </div>
<script>
$(document).ready(function() {
	check_style();
});
function check_style(){
	var style=$('input[name="home_page"]:checked').val();
	$('.home_title').removeClass('active');
	$('input[name="home_page"]:checked').closest(".box_area").find('.home_title').addClass('active');
	$("#home_item_set").load("<?php echo base_url()?>index.php/admin/home_item_change/"+style);
}
</script>
<style>
.horizontal-tab{
    margin:15px;
}
.horizontal-tab .nav-tabs{
    border: 0;
	display:block !important;
	width:100%;
}
.horizontal-tab .nav-tabs li{
    float:left;
}
.horizontal-tab .nav-tabs li:hover{
    border-bottom:2px solid #dadada;
}
.horizontal-tab .nav-tabs li.active{
    border-bottom:2px solid #489eed;
}
.horizontal-tab .nav-tabs li.active a{
    background:#FFF;
}
.horizontal-tab .nav-tabs>li:not(.active) a:hover {
    border-color:#fff !important;
}
.horizontal-tab .tab-content{
    display:block !important;
}
.img_show{
	position:relative;
	height:400px;
	overflow:auto;
}
.img_show::-webkit-scrollbar{
    width: 3px;
	background: #737373;
}
.img_show::-webkit-scrollbar-thumb{
    background: #fff;
}
.img_show::-webkit-scrollbar{
    width: 3px;
	background: #737373;
}
.img_show::-webkit-scrollbar-thumb{
    background: #fff;
}
.home_title{
	display: block;
    text-align: center;
}
.home_title span i{
	opacity: 0;
}
.home_title.active span i{
	opacity: 1;
	color:#096;
}
</style>
