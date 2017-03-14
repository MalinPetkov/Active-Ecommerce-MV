 <!-- PAGE WITH SIDEBAR -->
<section class="page-section with-sidebar">
    <div class="container">
        <div class="row">
            <!-- SIDEBAR -->
            <?php 
                include 'sidebar.php';
            ?>
            <!-- /SIDEBAR -->
            <!-- CONTENT -->
            <div class="col-md-9 col-sm-12 col-xs-12 content" id="content">
                <!-- shop-sorting -->
                <div class="shop-sorting">
                    <div class="row">
                        <div class="col-md-10 col-sm-12 col-xs-12 sort-item">
                            <div class="form-inline">
                                <div class="form-group selectpicker-wrapper">
                                    <select class="selectpicker input-price sorter_search" data-live-search="true" data-width="100%"
                                        data-toggle="tooltip" title="Select" onChange="delayed_search()">
                                            <option value=""><?php echo translate('sort_by'); ?></option>
                                            <option value="price_low"><?php echo translate('price_low_to_high'); ?></option>
                                            <option value="price_high"><?php echo translate('price_high_to_low'); ?></option>
                                            <option value="condition_old"><?php echo translate('oldest'); ?></option>
                                            <option value="condition_new"><?php echo translate('newest'); ?></option>
                                            <option value="most_viewed"><?php echo translate('most_viewed'); ?></option>
                                    </select>
                                </div>
                                <div class="form-group selectpicker-wrapper set_brand" style="display:none;">
                                </div>
                                <div style="display:none;">
                                    <div class="form-group selectpicker-wrapper set_vendor">
                                    </div>
                                </div>
                                <div class="form-group widget">
                                    <div class="widget-search">
                                        <input class="form-control" type="text" id="texted" placeholder="<?php echo translate('search'); ?>">
                                        <button class="on_click_search"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-12 col-xs-12 text-right view_select_btn">
                        	<span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onClick="open_sidebar();">
                            	<i class="fa fa-bars"></i>
                            </span>
                            <a class="btn  btn-theme-transparent btn-theme-sm grid" onClick="set_view('grid')" href="#"><img src="<?php echo base_url(); ?>template/front/img/icon-grid.png" alt=""/></a>
                            <a class="btn  btn-theme-transparent btn-theme-sm list" onClick="set_view('list')" href="#"><img src="<?php echo base_url(); ?>template/front/img/icon-list.png" alt=""/></a>
                        </div>
                    </div>
                </div>
                <!-- /shop-sorting -->
                <div id="result">
                
                </div>
            </div>
            <!-- /CONTENT -->
        </div>
    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->

<style>
    .widget.shop-categories ul ul.children label {
        margin-right: 0;
    }
    .widget.shop-categories ul label {
        display: block;
        margin-right: 20px;
        color: #232323;
        cursor: pointer;
    }
	.pagination-wrapper.bottom{
		text-align-last:center;
	}
	.sort-item{
		display:table;
	}
	.sort-item .form-inline{
		display:table-row;
	}
	.sort-item .form-group{
		display:table-cell;
	}
	.sort-item .widget-search .form-control{
		height:35px;
		line-height: 35px;
	}
	.sort-item .widget-search button{
		line-height: 26px;
	}
	.sort-item .widget-search button:before{
		height:30px;
	}
	.shop-sorting .btn-theme-sm {
		padding: 5px 7px;
	}
	.sidebar.close_now{
		position: relative;
		left:0px;
		opacity:1;
	}
	@media(max-width: 991px) {
		.sidebar.open{
			opacity:1;
			position: fixed;
			z-index: 9999;
			top: -30px;
			background: #f5f5f5;
			height: 100vh;
			overflow-y: auto;
			padding-top: 50px;
			left:0px;
		}
		.sidebar.close_now{
			position: fixed;
			left:-500px;
			opacity:0;
		}
		.view_select_btn{
			margin-top: 10px !important;
		}
	}
</style>
<script>
	$(document).ready(function(e) {
        close_sidebar();
    });
	function open_sidebar(){
		$('.sidebar').removeClass('close_now');
		$('.sidebar').addClass('open');
	}
	function close_sidebar(){
		$('.sidebar').removeClass('open');
		$('.sidebar').addClass('close_now');
	}
</script>