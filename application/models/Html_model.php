<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');



class Html_model extends CI_Model
{
    
    /*	
	 *	Developed by: Active IT zone
	 *	Date	: 14 July, 2015
	 *	Active Supershop eCommerce CMS
	 *	http://codecanyon.net/user/activeitezone
	 */
    
    function __construct()
    {
        parent::__construct();
    }
    
    
    function product_box($product_data = array(), $type = '', $style = '')
    {
        $this->load->view('front/components/product_boxes/product_box_'.$type.'_'.$style,$product_data);

    }
	
	function home_category_box($category_data = array(), $style = '')
    {
        $this->load->view('front/components/home_category_box/category_box_'.$style,$category_data);

    }
	
	function widget($name = '')
    {
        $this->load->view('front/components/widget/'.$name);

    }
    
    
}