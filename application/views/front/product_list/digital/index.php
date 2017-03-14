
                <!-- BREADCRUMBS -->
                <section class="page-section breadcrumbs">
                    <div class="container">
                        <div class="page-header">
                            <h1>
                            	<?php echo translate('category_list_view');?>
                            </h1>
                        </div>
                        <ul class="breadcrumb">
                            <li>
                            	<a href="#">
                                	<?php echo translate('home');?>
                                </a>
                            </li>
                            <li>
                            	<a href="#">
                                	<?php echo translate('shop');?>
                                </a>
                            </li>
                            <li class="active">
                            	<?php echo translate('category_grid_list_view');?>
                            </li>
                        </ul>
                    </div>
                </section>
                <!-- /BREADCRUMBS -->

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
                            <div class="col-md-9 content" id="content">
                                <!-- shop-sorting -->
                                <div class="shop-sorting">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <form class="form-inline" action="">
                                                <div class="form-group selectpicker-wrapper">
                                                    <select
                                                        class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                        data-toggle="tooltip" title="Select">
                                                        <option>Product Name</option>
                                                        <option>Product Name</option>
                                                        <option>Product Name</option>
                                                    </select>
                                                </div>
                                                <div class="form-group selectpicker-wrapper">
                                                    <select
                                                        class="selectpicker input-price" data-live-search="true" data-width="100%"
                                                        data-toggle="tooltip" title="Select">
                                                        <option>Select Manifacturers</option>
                                                        <option>Select Manifacturers</option>
                                                        <option>Select Manifacturers</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-sm-4 text-right-sm">
                                            <a class="btn  btn-theme-transparent btn-theme-sm" href="#"><img src="<?php echo base_url(); ?>template/front/img/icon-list.png" alt=""/></a>
                                            <a class="btn  btn-theme-transparent btn-theme-sm" href="#"><img src="<?php echo base_url(); ?>template/front/img/icon-grid.png" alt=""/></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- /shop-sorting -->
								<div id="result">
                                	<?php include 'list_view.php'; ?>
                                </div>

                            </div>
                            <!-- /CONTENT -->

                        </div>
                    </div>
                </section>
                <!-- /PAGE WITH SIDEBAR -->

                <!-- PAGE -->
                <section class="page-section no-padding-top">
                    <div class="container">
                        <div class="row blocks shop-info-banners">
                            <div class="col-md-4">
                                <div class="block">
                                    <div class="media">
                                        <div class="pull-right"><i class="fa fa-gift"></i></div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Buy 1 Get 1</h4>
                                            Proin dictum elementum velit. Fusce euismod consequat ante.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="block">
                                    <div class="media">
                                        <div class="pull-right"><i class="fa fa-comments"></i></div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Call to Free</h4>
                                            Proin dictum elementum velit. Fusce euismod consequat ante.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="block">
                                    <div class="media">
                                        <div class="pull-right"><i class="fa fa-trophy"></i></div>
                                        <div class="media-body">
                                            <h4 class="media-heading">Money Back!</h4>
                                            Proin dictum elementum velit. Fusce euismod consequat ante.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- /PAGE -->