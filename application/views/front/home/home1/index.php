<?php 
	if($this->crud_model->get_type_name_by_id('general_settings','53','value') == 'ok'){
		include 'slider.php';
	}
?>
<?php 
	if($this->crud_model->get_type_name_by_id('general_settings','62','value') == 'ok'){
		include 'category_menu.php';
	}
?>
<?php 
	include 'top_banner.php';
?>
<?php 
	include 'advanced_search.php';
?>
<?php
	if($this->crud_model->get_type_name_by_id('ui_settings','24','value') == 'ok'){
		include 'featured_products.php';
	}
?>
<?php 
	if ($this->crud_model->get_type_name_by_id('general_settings','58','value') == 'ok') {
		if($this->crud_model->get_type_name_by_id('ui_settings','25','value') == 'ok'){
			include 'vendors.php';
		}
	}
?>
<?php 
	include 'category_products.php';
?>
<?php 
	if($this->crud_model->get_type_name_by_id('ui_settings','26','value') == 'ok'){
		include 'blog.php';
	}
?>
<?php
	if($this->crud_model->get_type_name_by_id('ui_settings','31','value') == 'ok'){
		include 'special_products.php';
	}
?>
<?php 
	if ($this->crud_model->get_type_name_by_id('general_settings','68','value') == 'ok') {
		if($this->crud_model->get_type_name_by_id('ui_settings','23','value') == 'ok'){
			include 'brands.php';
		}
	}
?>

