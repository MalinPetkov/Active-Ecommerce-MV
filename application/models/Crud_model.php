<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud_model extends CI_Model
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
    
    function clear_cache()
    {
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
    
    /////////GET NAME BY TABLE NAME AND ID/////////////
    function get_type_name_by_id($type, $type_id = '', $field = 'name')
    {
        if ($type_id != '') {
            $l = $this->db->get_where($type, array(
                $type . '_id' => $type_id
            ));
            $n = $l->num_rows();
            if ($n > 0) {
                return $l->row()->$field;
            }
        }
    }
	function get_settings_value($type, $type_name = '', $field = 'value')
    {
        if ($type_name != '') {
            return $this->db->get_where($type, array('type' => $type_name))->row()->$field;       
		}
    }
    
    /////////Filter One/////////////
    function filter_one($table, $type, $value)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($type, $value);
        return $this->db->get()->result_array();
    }
    
    // FILE_UPLOAD
    function img_thumb($type, $id, $ext = '.jpg', $width = '400', $height = '400')
    {
        $this->load->library('image_lib');
        ini_set("memory_limit", "-1");
        
        $config1['image_library']  = 'gd2';
        $config1['create_thumb']   = TRUE;
        $config1['maintain_ratio'] = TRUE;
        $config1['width']          = $width;
        $config1['height']         = $height;
        $config1['source_image']   = 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext;
        
        $this->image_lib->initialize($config1);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }
    
    // FILE_UPLOAD
    function file_up($name, $type, $id, $multi = '', $no_thumb = '', $ext = '.jpg')
    {
        if ($multi == '') {
            move_uploaded_file($_FILES[$name]['tmp_name'], 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext);
            if ($no_thumb == '') {
                $this->crud_model->img_thumb($type, $id, $ext);
            }
        } elseif ($multi == 'multi') {
            $ib = 1;
            foreach ($_FILES[$name]['name'] as $i => $row) {
                $ib = $this->file_exist_ret($type, $id, $ib);
                move_uploaded_file($_FILES[$name]['tmp_name'][$i], 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext);
                if ($no_thumb == '') {
                    $this->crud_model->img_thumb($type, $id . '_' . $ib, $ext);
                }
            }
        }
    }
    
    // FILE_UPLOAD : EXT :: FILE EXISTS
    function file_exist_ret($type, $id, $ib, $ext = '.jpg')
    {
        if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $ib . $ext)) {
            $ib = $ib + 1;
            $ib = $this->file_exist_ret($type, $id, $ib);
            return $ib;
        } else {
            return $ib;
        }
    }
    
    
    // FILE_VIEW
    function file_view($type, $id, $width = '100', $height = '100', $thumb = 'no', $src = 'no', $multi = '', $multi_num = '', $ext = '.jpg')
    {
        if ($multi == '') {
            if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . $ext)) {
                if ($thumb == 'no') {
                    $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . $ext;
                } elseif ($thumb == 'thumb') {
                    $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_thumb' . $ext;
                }
                
                if ($src == 'no') {
                    return '<img src="' . $srcl . '" height="' . $height . '" width="' . $width . '" />';
                } elseif ($src == 'src') {
                    return $srcl;
                }
            }
			else{
				return base_url() . 'uploads/'. $type.'_image/default.jpg';
			}
            
        } else if ($multi == 'multi') {
            $num    = $this->crud_model->get_type_name_by_id($type, $id, 'num_of_imgs');
            //$num = 2;
            $i      = 0;
            $p      = 0;
            $q      = 0;
            $return = array();
            while ($p < $num) {
                $i++;
                if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
                    if ($thumb == 'no') {
                        $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext;
                    } elseif ($thumb == 'thumb') {
                        $srcl = base_url() . 'uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . '_thumb' . $ext;
                    }
                    
                    if ($src == 'no') {
                        $return[] = '<img src="' . $srcl . '" height="' . $height . '" width="' . $width . '" />';
                    } elseif ($src == 'src') {
                        $return[] = $srcl;
                    }
                    $p++;
                } else {
                    $q++;
                    if ($q == 10) {
                        break;
                    }
                }
                
            }
            if (!empty($return)) {
                if ($multi_num == 'one') {
                    return $return[0];
                } else if ($multi_num == 'all') {
                    return $return;
                } else {
                    $n = $multi_num - 1;
                    unset($return[$n]);
                    return $return;
                }
            } else {
                if ($multi_num == 'one') {
                    return base_url() . 'uploads/'. $type.'_image/default.jpg';
                } else if ($multi_num == 'all') {
                	return array(base_url() . 'uploads/'. $type.'_image/default.jpg');
                } else {
                	return array(base_url() . 'uploads/'. $type.'_image/default.jpg');
                }
            }
        }
    }
    
    
    // FILE_VIEW
    function file_dlt($type, $id, $ext = '.jpg', $multi = '', $m_sin = '')
    {
        if ($multi == '') {
            if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . $ext)) {
                unlink("uploads/" . $type . "_image/" . $type . "_" . $id . $ext);
            }
            if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . "_thumb" . $ext)) {
                unlink("uploads/" . $type . "_image/" . $type . "_" . $id . "_thumb" . $ext);
            }
            
        } else if ($multi == 'multi') {
            $num = $this->crud_model->get_type_name_by_id($type, $id, 'num_of_imgs');
            if ($m_sin == '') {
                $i = 0;
                $p = 0;
                while ($p < $num) {
                    $i++;
                    if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $i . $ext)) {
                        unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . $ext);
                        $p++;
                        $data['num_of_imgs'] = $num - 1;
                        $this->db->where($type . '_id', $id);
                        $this->db->update($type, $data);
                    }
                    
                    if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . "_thumb" . $ext)) {
                        unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $i . "_thumb" . $ext);
                    }
                    if ($i > 50) {
                        break;
                    }
                }
            } else {
                if (file_exists('uploads/' . $type . '_image/' . $type . '_' . $id . '_' . $m_sin . $ext)) {
                    unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . $ext);
                }
                if (file_exists("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . "_thumb" . $ext)) {
                    unlink("uploads/" . $type . "_image/" . $type . "_" . $id . '_' . $m_sin . "_thumb" . $ext);
                }
                $data['num_of_imgs'] = $num - 1;
                $this->db->where($type . '_id', $id);
                $this->db->update($type, $data);
            }
        }
    }
    
    //DELETE MULTIPLE ITEMS	
    function multi_delete($type, $ids_array)
    {
        foreach ($ids_array as $row) {
            $this->file_dlt($type, $row);
            $this->db->where($type . '_id', $row);
            $this->db->delete($type);
        }
    }
    
    //DELETE SINGLE ITEM	
    function single_delete($type, $id)
    {
        $this->file_dlt($type, $id);
        $this->db->where($type . '_id', $id);
        $this->db->delete($type);
    }
    
    //GET PRODUCT LINK
    function product_link($product_id,$quick='')
    {
		if($quick=='quick'){
			return base_url() . 'index.php/home/quick_view/' . $product_id;
		} else {
			$name = url_title($this->crud_model->get_type_name_by_id('product', $product_id, 'title'));
        	return base_url() . 'index.php/home/product_view/' . $product_id . '/' . $name;
		}
    }
    
    //GET PRODUCT LINK
    function blog_link($blog_id)
    {
		$name = url_title($this->crud_model->get_type_name_by_id('blog', $blog_id, 'title'));
		return base_url() . 'index.php/home/blog_view/' . $blog_id . '/' . $name;
    }

    //GET PRODUCT LINK
    function vendor_link($vendor_id)
    {
        $name = url_title($this->crud_model->get_type_name_by_id('vendor', $vendor_id, 'display_name'));
        return base_url() . 'index.php/home/vendor_profile/' . $vendor_id . '/' . $name;
    }

    /////////GET CHOICE TITLE////////
    function choice_title_by_name($product,$name)
    {
        $return = '';
        $options = json_encode($this->get_type_name_by_id('product',$product_id,'options'),true);
        foreach ($options as $row) {
            if($row['name'] == $name){
                $return = $row['title'];
            }
        }
        return $return;
    }

    /////////SELECT HTML/////////////
    function select_html($from, $name, $field, $type, $class, $e_match = '', $condition = '', $c_match = '', $onchange = '',$condition_type='single')
    {
        $return = '';
        $other  = '';
        $multi  = 'no';
        $phrase = 'Choose a ' . $name;
        if ($class == 'demo-cs-multiselect') {
            $other = 'multiple';
            $name  = $name . '[]';
            if ($type == 'edit') {
                $e_match = json_decode($e_match);
                if ($e_match == NULL) {
                    $e_match = array();
                }
                $multi = 'yes';
            }
        }
        $return = '<select name="' . $name . '" onChange="' . $onchange . '(this.value,this)" class="' . $class . '" ' . $other . '  data-placeholder="' . $phrase . '" tabindex="2" data-hide-disabled="true" >';
        if (!is_array($from)) {
            if ($condition == '') {
                $all = $this->db->get($from)->result_array();
            } else if ($condition !== '') {
				if($condition_type=='single'){
					$all = $this->db->get_where($from, array(
						$condition => $c_match
					))->result_array();
				}else if($condition_type=='multi'){
					$this->db->where_in($condition,$c_match);
					$all = $this->db->get($from)->result_array();
				}
            }
            
            $return .= '<option value="">Choose one</option>';
            
            foreach ($all as $row):
                if ($type == 'add') {
                    $return .= '<option value="' . $row[$from . '_id'] . '">' . $row[$field] . '</option>';
                } else if ($type == 'edit') {
                    $return .= '<option value="' . $row[$from . '_id'] . '" ';
                    if ($multi == 'no') {
                        if ($row[$from . '_id'] == $e_match) {
                            $return .= 'selected=."selected"';
                        }
                    } else if ($multi == 'yes') {
                        if (in_array($row[$from . '_id'], $e_match)) {
                            $return .= 'selected=."selected"';
                        }
                    }
                    $return .= '>' . $row[$field] . '</option>';
                }
            endforeach;
        } else {
            $all = $from;
            $return .= '<option value="">Choose one</option>';
            foreach ($all as $row):
                if ($type == 'add') {
                    $return .= '<option value="' . $row . '">';
                    if ($condition == '') {
                        $return .= ucfirst(str_replace('_', ' ', $row));
                    } else {
                        $return .= $this->crud_model->get_type_name_by_id($condition, $row, $c_match);
                    }
                    $return .= '</option>';
                } else if ($type == 'edit') {
                    $return .= '<option value="' . $row . '" ';
                    if ($row == $e_match) {
                        $return .= 'selected=."selected"';
                    }
                    $return .= '>';
                    
                    if ($condition == '') {
                        $return .= ucfirst(str_replace('_', ' ', $row));
                    } else {
                        $return .= $this->crud_model->get_type_name_by_id($condition, $row, $c_match);
                    }
                    
                    $return .= '</option>';
                }
            endforeach;
        }
        $return .= '</select>';
        return $return;
    }
    
    //CHECK IF PRODUCT EXISTS IN TABLE
    function exists_in_table($table, $field, $val)
    {
        $ret = '';
        $res = $this->db->get($table)->result_array();
        foreach ($res as $row) {
            if ($row[$field] == $val) {
                $ret = $row[$table . '_id'];
            }
        }
        if ($ret == '') {
            return false;
        } else {
            return $ret;
        }
        
    }
    
    //FORM FIELDS
    function form_fields($array)
    {
        $return = '';
        foreach ($array as $row) {
            $return .= '<div class="form-group">';
            $return .= '    <label class="col-sm-4 control-label" for="demo-hor-inputpass">' . $row . '</label>';
            $return .= '    <div class="col-sm-6">';
            $return .= '       <input type="text" name="ad_field_values[]" id="demo-hor-inputpass" class="form-control">';
            $return .= '       <input type="hidden" name="ad_field_names[]" value="' . $row . '" >';
            $return .= '    </div>';
            $return .= '</div>';
        }
        return $return;
    }
    
    // PAGINATION
    function pagination($type, $per, $link, $f_o, $f_c, $other, $current, $seg = '3', $ord = 'desc')
    {
        $t   = explode('#', $other);
        $t_o = $t[0];
        $t_c = $t[1];
        $c   = explode('#', $current);
        $c_o = $c[0];
        $c_c = $c[1];
        
        $this->load->library('pagination');
        $this->db->order_by($type . '_id', $ord);
        $config['total_rows']  = $this->db->count_all_results($type);
        $config['base_url']    = base_url() . $link;
        $config['per_page']    = $per;
        $config['uri_segment'] = $seg;
        
        $config['first_link']      = '&laquo;';
        $config['first_tag_open']  = $t_o;
        $config['first_tag_close'] = $t_c;
        
        $config['last_link']      = '&raquo;';
        $config['last_tag_open']  = $t_o;
        $config['last_tag_close'] = $t_c;
        
        $config['prev_link']      = '&lsaquo;';
        $config['prev_tag_open']  = $t_o;
        $config['prev_tag_close'] = $t_c;
        
        $config['next_link']      = '&rsaquo;';
        $config['next_tag_open']  = $t_o;
        $config['next_tag_close'] = $t_c;
        
        $config['full_tag_open']  = $f_o;
        $config['full_tag_close'] = $f_c;
        
        $config['cur_tag_open']  = $c_o;
        $config['cur_tag_close'] = $c_c;
        
        $config['num_tag_open']  = $t_o;
        $config['num_tag_close'] = $t_c;
        $this->pagination->initialize($config);
        
        $this->db->order_by($type . '_id', $ord);
        return $this->db->get($type, $config['per_page'], $this->uri->segment($seg))->result_array();
    }
    
    //IF PRODUCT ADDED TO CART
    function is_added_to_cart($product_id, $set = '', $op = '')
    {
        $carted = $this->cart->contents();
        //var_dump($carted);
        if (count($carted) > 0) {
            foreach ($carted as $items) {
                if ($items['id'] == $product_id) {
                    
                    if ($set == '') {
                        return true;
                    } else {
                        if($set == 'option'){
                            $option = json_decode($items[$set],true);
                            return $option[$op]['value'];
                        } else {
                            return $items[$set];
                        }
                    }
                }
            }
        } else {
            return false;
        }
    }
    
    //TOTALING OF CART ITEMS BY TYPE
    function cart_total_it($type)
    {
        $carted = $this->cart->contents();
        $ret    = 0;
        if (count($carted) > 0) {
            foreach ($carted as $items) {
                $ret += $items[$type] * $items['qty'];
            }
            return $ret;
        } else {
            return false;
        }
    }


    //SALE WISE TOTAL BY TYPE
    function db_sale_total_it($sale_id, $type)
    {
        $carted = json_decode($this->db->get_where('sale', array(
            'sale_id' => $sale_id
        ))->row()->product_details, true);
        $ret    = 0;
        if (count($carted) > 0) {
            foreach ($carted as $items) {
                $ret += $items[$type] * $items['qty'];
            }
            return $ret;
        } else {
            return false;
        }
    }
    
    
    //GETTING ADDITIONAL FIELDS FOR PRODUCT ADD
    function get_additional_fields($product_id)
    {
        $additional_fields = $this->crud_model->get_type_name_by_id('product', $product_id, 'additional_fields');
        $ab                = json_decode($additional_fields,true);
		$name = json_decode($ab['name']);
		$value = json_decode($ab['value']);
		$final = array();
		if(!empty($name)){
			foreach ($name as $n => $row) {
				$final[] = array(
					'name' => $row,
					'value' => $value[$n]
				);
			}
		}
        return $final;
    }
    
    //DECREASEING PRODUCT QUANTITY
    function decrease_quantity($product_id, $quantity, $sale_id = '')
    {
        $prev_quantity          = $this->crud_model->get_type_name_by_id('product', $product_id, 'current_stock');
        $data1['current_stock'] = $prev_quantity - $quantity;
        if ($data1['current_stock'] < 0) {
            $data1['current_stock'] = 0;
        }
        $this->db->where('product_id', $product_id);
        $this->db->update('product', $data1);
    }
    
    //INCREASEING PRODUCT QUANTITY
    function increase_quantity($product_id, $quantity, $sale_id = '')
    {
        $prev_quantity          = $this->crud_model->get_type_name_by_id('product', $product_id, 'current_stock');
        $data1['current_stock'] = $prev_quantity + $quantity;
        if ($data1['current_stock'] < 0) {
            $data1['current_stock'] = 0;
        }
        $this->db->where('product_id', $product_id);
        $this->db->update('product', $data1);
    }
    
    //IF PRODUCT IS IN SALE
    function product_in_sale($sale_id, $product_id, $field)
    {
        $return          = '';
        $product_details = json_decode($this->get_type_name_by_id('sale', $sale_id, 'product_details'), true);
        foreach ($product_details as $row) {
            if ($row['id'] == $product_id) {
                $return = $row[$field];
            }
        }
        if ($return == '') {
            return false;
        } else {
            return $return;
        }
    }
    
    //GETTING IDS OF A TABLE FILTERING SPECIFIC TYPE OF VALUE RANGE
    function ids_between_values($table, $value_type, $up_val, $down_val)
    {
        $this->db->order_by($table . '_id', 'desc');
        return $this->db->get_where($table, array(
            $value_type . ' <=' => $up_val,
            $value_type . ' >=' => $down_val
        ))->result_array();
    }
    
    //DAYS START-END TIMESTAMP
    function date_timestamp($date, $type)
    {
        $date = explode('-', $date);
        $d    = $date[2];
        $m    = $date[1];
        $y    = $date[0];
        if ($type == 'start') {
            return mktime(0, 0, 0, $m, $d, $y);
        }
        if ($type == 'end') {
            return mktime(0, 0, 0, $m, $d + 1, $y);
        }
    }
    
    //GETTING STOCK REPORT
    function stock_report($product_id)
    {
        $report = array();
        $start  = $this->get_type_name_by_id('product', $product_id, 'add_timestamp');
        $end    = time();
        $stock  = 0;
        
        $diff = 86400;
        $days = array();
        while ($end > $start) {
            $date = date('Y-m-d', $start);
            $start += $diff;
            $dstart     = $this->date_timestamp($date, 'start');
            $dend       = $this->date_timestamp($date, 'end');
            $all_stocks = $this->ids_between_values('stock', 'datetime', $dend, $dstart);
            
            $all_stocks = array_reverse($all_stocks);
            
            foreach ($all_stocks as $row) {
                if ($row['product'] == $product_id) {
                    if ($row['type'] == 'add') {
                        $stock += $row['quantity'];
                    } else if ($row['type'] == 'destroy') {
                        $stock -= $row['quantity'];
                    }
                }
            }
            $report[] = array(
                'date' => $date,
                'stock' => $stock
            );
        }
        //return array_reverse($report);
        return $report;
    }
    
    //GETTING ALL SALE DATES
    function all_sale_date($product_id)
    {
        $dates = array();
        $sales = $this->db->get('sale')->result_array();
        foreach ($sales as $i => $row) {
            if ($this->product_in_sale($row['sale_id'], $product_id, 'id')) {
                $date = $this->get_type_name_by_id('sale', $row['sale_id'], 'sale_datetime');
                $date = date('Y-m-d', $date);
                if (!in_array($date, $dates)) {
                    array_push($dates, $date);
                }
            }
        }
        return $dates;
    }
    
    //GETTING ALL SALE DATES
    function all_sale_date_n($product_id)
    {
        $dates      = array();
        $first_date = '';
        $sales      = $this->db->get('sale')->result_array();
        foreach ($sales as $i => $row) {
            if($this->session->userdata('title') !== 'vendor' || $this->is_sale_of_vendor($row['sale_id'],$this->session->userdata('vendor_id'))){
                if ($this->product_in_sale($row['sale_id'], $product_id, 'id')) {
                    $first_date = $this->get_type_name_by_id('sale', $row['sale_id'], 'sale_datetime');
                    break;
                }
            }
        }
        if ($first_date !== '') {
            $current = $first_date;
            $last    = time();
            while ($current <= $last) {
                $dates[] = date('Y-m-d', $current);
                $current = strtotime('+1 day', $current);
            }
        }
        return $dates;
        
    }
    
    //GETTING SALE DETAILS BY PRODUCT DAYS
    function sale_details_by_product_date($product_id, $date, $type)
    {
        
        $return   = 0;
        $up_val   = $this->date_timestamp($date, 'end');
        $down_val = $this->date_timestamp($date, 'start');
        $sales    = $this->ids_between_values('sale', 'sale_datetime', $up_val, $down_val);
        foreach ($sales as $i => $row) {
            if ($a = $this->product_in_sale($row['sale_id'], $product_id, $type)) {
                $return += $a;
            }
        }
        return $return;
    }
    
    //GETTING TOTAL OF A VALUE TYPE IN SALES
    function total_sale($product_id, $field = 'qty')
    {
        $return = 0;
        $sales  = $this->db->get('sale')->result_array();
        foreach ($sales as $row) {
            if ($a = $this->product_in_sale($row['sale_id'], $product_id, $field)) {
                $return += $a;
            }
        }
        return $return;
    }
    
    //GETTING MOST SOLD PRODUCTS
    function most_sold_products()
    {
        $result  = array();
        $product = $this->db->get('product')->result_array();
        foreach ($product as $row) {
            $result[] = array(
                'id' => $row['product_id'],
                'sale' => $this->total_sale($row['product_id'])
            );
        }
        if (!function_exists('compare_lastname')) {
            function compare_lastname($a, $b)
            {
                return strnatcmp($b['sale'], $a['sale']);
            }
        }
        
        usort($result, 'compare_lastname');
        return $result;
    }
    
    
    
    //GETTING BOOTSTRAP COLUMN VALUE
    function boot($num)
    {
        return (12 / $num);
    }
    
    //GETTING LIMITING CHARECTER
    function limit_chars($string, $char_limit)
    {
        $length = 0;
        $return = array();
        $words  = explode(" ", $string);
        foreach ($words as $row) {
            $length += strlen($row);
            $length += 1;
            if ($length < $char_limit) {
                array_push($return, $row);
            } else {
                array_push($return, '...');
                break;
            }
        }
        
        return implode(" ", $return);
    }
    
    //GETTING LOGO BY TYPE
    function logo($type)
    {
        $logo = $this->db->get_where('ui_settings', array(
            'type' => $type
        ))->row()->value;
        return base_url() . 'uploads/logo_image/logo_' . $logo . '.png';
    }
    
    //GETTING PRODUCT PRICE CALCULATING DISCOUNT
    function get_product_price($product_id)
    {
        $price         = $this->get_type_name_by_id('product', $product_id, 'sale_price');
        $discount      = $this->get_type_name_by_id('product', $product_id, 'discount');
        $discount_type = $this->get_type_name_by_id('product', $product_id, 'discount_type');
        if ($discount_type == 'amount') {
            $number = ($price - $discount);
        }
        if ($discount_type == 'percent') {
            $number = ($price - ($discount * $price / 100));
        }
        return number_format((float) $number, 2, '.', '');
    }
    
    //GETTING SHIPPING COST
    function get_shipping_cost($product_id)
    {
        $price              = $this->get_type_name_by_id('product', $product_id, 'sale_price');
        $shipping           = $this->get_type_name_by_id('product', $product_id, 'shipping_cost');
        $shipping_cost_type = $this->get_type_name_by_id('business_settings', '3', 'value');
        if ($shipping_cost_type == 'product_wise') {
            if($shipping == ''){
                return 0;
            } else {
                return ($shipping);                
            }
        }
        if ($shipping_cost_type == 'fixed') {
            return 0;
        }
    }
    
    //GETTING PRODUCT TAX
    function get_product_tax($product_id)
    {
        $price    = $this->get_type_name_by_id('product', $product_id, 'sale_price');
        $tax      = $this->get_type_name_by_id('product', $product_id, 'tax');
        $tax_type = $this->get_type_name_by_id('product', $product_id, 'tax_type');
        if ($tax_type == 'amount') {
            if($tax == ''){
                return 0;
            } else {
                return $tax;                
            }
        }
        if ($tax_type == 'percent') {
            if($tax == ''){
                $tax = 0;
            }
            return ($tax * $price / 100);
        }
    }
    
    //GETTING MONTH'S TOTAL BY TYPE
    function month_total($type, $filter1 = '', $filter_val1 = '', $filter2 = '', $filter_val2 = '', $notmatch = '', $notmatch_val = '')
    {
        $ago = time() - (86400 * 30);
        $a   = 0;
        if ($type == 'sale') {
            $result = $this->db->get_where('sale', array(
                'sale_datetime >= ' => $ago,
                'sale_datetime <= ' => time()
            ))->result_array();
            foreach ($result as $row) {
                if($this->session->userdata('title') == 'admin'){
                    if($this->sale_payment_status($row['sale_id'],'admin') == 'fully_paid'){
                        //make version for vendor
                        $res_cat = $this->db->get_where('product', array(
                            'category' => $filter_val1
                        ))->result_array();
                        foreach ($res_cat as $row1) {
                            if ($p = $this->product_in_sale($row['sale_id'], $row1['product_id'], 'subtotal')) {
                                $a += $p;
                            }
                        }
                    }
                }
                if($this->session->userdata('title') == 'vendor'){
                    if($this->sale_payment_status($row['sale_id'],'vendor',$this->session->userdata('vendor_id')) == 'fully_paid'){
                        //make version for vendor
                        $res_cat = $this->db->get_where('product', array(
                            'category' => $filter_val1
                        ))->result_array();
                        foreach ($res_cat as $row1) {
                            if ($p = $this->vendor_share_in_sale($row['sale_id'],$this->session->userdata('vendor_id'),'paid')) {
                                $p = $p['total'];
                                $a += $p;
                            }
                        }
                    }
                }
            }
        } else if ($type == 'stock') {
			if($this->session->userdata('title') == 'admin'){
				$this->db->get_where('added_by',json_encode(array('type'=>'vendor','id'=>$this->session->userdata('vendor_id'))));
				$this->db->get_where('datetime >= ',$ago);
				$this->db->get_where('datetime <= ',time());
				$result = $this->db->get('stock')->result_array();
				foreach ($result as $row) {
					if ($row[$filter2] == $filter_val2) {
						if ($row[$filter1] == $filter_val1) {
							if ($notmatch == '') {
								$a += $row['total'];
							} else {
								if ($row[$notmatch] !== $notmatch_val) {
									$a += $row['total'];
								}
							}
						}
					}
				}
			}
			if($this->session->userdata('title') == 'vendor'){
				$result = $this->db->get_where('stock', array(
					'datetime >= ' => $ago,
					'datetime <= ' => time()
				))->result_array();
				foreach ($result as $row) {
					if ($row[$filter2] == $filter_val2) {
						if ($row[$filter1] == $filter_val1) {
							if ($notmatch == '') {
								$a += $row['total'];
							} else {
								if ($row[$notmatch] !== $notmatch_val) {
									$a += $row['total'];
								}
							}
						}
					}
				}
			}
        }
        return $a;
    }
    
    function email_invoice($sale_id){
        $email = $this->get_type_name_by_id('user', $this->get_type_name_by_id('sale', $sale_id, 'buyer'), 'email');
        $sale_code = '#'.$this->get_type_name_by_id('sale', $sale_id, 'sale_code');
        $from = $this->db->get_where('general_settings', array(
            'type' => 'system_email'
        ))->row()->value;
        $page_data['sale_id'] = $sale_id;
        $text = $this->load->view('front/shopping_cart/invoice_email', $page_data, TRUE);
        $this->email_model->do_email($text, $sale_code, $email, $from);
        $admins = $this->db->get_where('admin',array('role'=>'1'))->result_array();
        foreach ($admins as $row) {
            $this->email_model->do_email($text, $sale_code, $row['email'], $from);
        }       
    }

    //GETTING VENDOR PERMISSION
    function vendor_permission($codename)
    {
        if ($this->session->userdata('vendor_login') !== 'yes') {
            return false;
        } else {
            return true;
        }
    }

    function is_added_by($type,$id,$user_id,$user_type = 'vendor')
    {
        $added_by = json_decode($this->db->get_where($type,array($type.'_id'=>$id))->row()->added_by,true);
        if($user_type == 'admin'){
            $user_id = $added_by['id'];
        }
		$this->benchmark->mark_time();
        if($added_by['type'] == $user_type && $added_by['id'] == $user_id){
            return true;
        } else {
            return false;
        }
    }


    //SALE WISE TOTAL BY TYPE
    function product_by($product_id,$with_link='')
    {
        $added_by = json_decode($this->db->get_where('product',array('product_id'=>$product_id))->row()->added_by,true);
        if($added_by['type'] == 'admin'){
            $name = $this->db->get_where('general_settings',array('type'=>'system_name'))->row()->value;
            if($with_link == ''){
                return $name;
            } else if($with_link == 'with_link') {
                return '<a href="'.base_url().'">'.$name.'</a>';
            }
        } else if($added_by['type'] == 'vendor'){
            $name = $this->db->get_where('vendor',array('vendor_id'=>$added_by['id']))->row()->display_name;
            if($with_link == ''){
                return $name;
            } else if($with_link == 'with_link') {
                return '<a href="'.$this->vendor_link($added_by['id']).'">'.$name.'</a>';
            }
        }
    }

    function is_sale_of_vendor($sale_id,$vendor_id)
    {
        $return          = array();
        $product_details = json_decode($this->get_type_name_by_id('sale', $sale_id, 'product_details'), true);
        foreach ($product_details as $row) {
            if ($this->is_added_by('product',$row['id'],$vendor_id)) {
                $return[] = $row['id'];
            }
        }
        if (empty($return)) {
            return false;
        } else {
            return $return;
        }
    }

    function is_admin_in_sale($sale_id)
    {
        $return          = array();
        $product_details = json_decode($this->get_type_name_by_id('sale', $sale_id, 'product_details'), true);
        foreach ($product_details as $row) {
            if ($this->is_added_by('product',$row['id'],0,'admin')) {
                $return[] = $row['id'];
            }
        }
        if (empty($return)) {
            return false;
        } else {
            return $return;
        }
    }

    function vendors_in_sale($sale_id){
        $vendors = $this->db->get('vendor')->result_array();
        $return = array();
        foreach ($vendors as $row) {
            if($this->is_sale_of_vendor($sale_id,$row['vendor_id'])){
                $return[] = $row['vendor_id'];
            }
        }
        return $return;
    }

    function vendor_share_in_sale($sale_id,$vendor_id,$pay='',$pay_type=''){
        $product_price = 0;
        $tax = 0;
        $shipping = 0;
        $total = 0;
        if($pay == 'paid'){
            $pay = 'fully_paid';
        }
        if($this->sale_payment_status($sale_id,'vendor',$vendor_id) == $pay || $pay == ''){
            if($this->db->get_where('sale',array('sale_id'=>$sale_id))->row()->payment_type == $pay_type || $pay_type == ''){
                if($products = $this->is_sale_of_vendor($sale_id,$vendor_id)){
                    $products_in_sale = json_decode($this->get_type_name_by_id('sale', $sale_id, 'product_details'), true);
                    foreach ($products_in_sale as $row) {
                        if(in_array($row['id'], $products)){
                            $product_price  += $row['subtotal'];
                            $tax            += $row['tax'];
                            $shipping       += $row['shipping'];
                            $total          += $row['subtotal']+$row['tax']+$row['shipping'];
                        }
                    }
                }
            }
        }
        return array('price'=>$product_price,'tax'=>$tax,'shipping'=>$shipping,'total'=>$total);
    }

    function vendor_share_total($vendor_id,$pay='',$pay_type=''){
        $product_price = 0;
        $tax = 0;
        $shipping = 0;
        $total = 0;
        $sales = $this->db->get('sale')->result_array();
        foreach ($sales as $row) {
            $share = $this->vendor_share_in_sale($row['sale_id'],$vendor_id,$pay,$pay_type);
            $product_price  += $share['price'];
            $tax            += $share['tax'];
            $shipping       += $share['shipping'];
            $total          += $share['price']+$share['tax']+$share['shipping'];
        }
        return array('price'=>$product_price,'tax'=>$tax,'shipping'=>$shipping,'total'=>$total);
    }

    function paid_to_vendor($vendor_id){
        $total = 0;
        $vendor_invoice = $this->db->get_where('vendor_invoice',array('vendor_id'=>$vendor_id,'status'=>'paid'))->result_array();
        foreach ($vendor_invoice as $row) {
            $total += $row['amount'];
        }
        return $total;
    }

    function sale_payment_status($sale_id,$type='',$id=''){
        $payment_status = json_decode($this->db->get_where('sale', array(
            'sale_id' => $sale_id
        ))->row()->payment_status,true);
        $paid = '';
        $unpaid = '';
        foreach ($payment_status as $row) {
            if($type == ''){
                if($row['status'] == 'paid'){
                    $paid = 'yes';
                }
                if($row['status'] == 'due'){
                    $unpaid = 'yes';
                }
            } else {
                if(isset($row[$type])){
                    if($type == 'vendor'){
                        if($row[$type] == $id){
                            if($row['status'] == 'paid'){
                                $paid = 'yes';
                            }
                            if($row['status'] == 'due'){
                                $unpaid = 'yes';
                            }
                        }
                    } else if($type == 'admin'){
                        if($row['status'] == 'paid'){
                            $paid = 'yes';
                        }
                        if($row['status'] == 'due'){
                            $unpaid = 'yes';
                        }
                    }
                }
            }
        }
        if($paid == 'yes' && $unpaid == ''){
            return 'fully_paid';
        }
        else if($paid == 'yes' && $unpaid == 'yes'){
            return 'partially_paid';
        }
        else if($paid == '' && $unpaid == 'yes'){
            return 'due';
        }
        if($paid == '' && $unpaid == ''){
            return 'due';
        }
    }
	
	function get_brands($type,$id,$vendor=''){
		if($type == 'category'){
			if($id !== '0'){
				$this->db->where('category',$id);
			}
			$sub_cats = $this->db->get('sub_category')->result_array();
		} else if($type == 'sub_category') {
			$sub_cats = array(array('sub_category_id'=>$id));
		}
		$brands = array();
		
		foreach($sub_cats as $row){
			$n_brands = json_decode($this->db->get_where('sub_category',array('sub_category_id'=>$row['sub_category_id']))->row()->brand);
			foreach($n_brands as $n){
				if($vendor !== ''){
					if($this->is_brand_of_vendor($n,$vendor)){
						$na = $n;
						$na .= ':::';
						$brn_data = $this->db->get_where('brand',array('brand_id'=>$n));
						if($brn_data->num_rows() > 0){
							$na .= $brn_data->row()->name;
							array_push($brands,$na);
						}
					}
				} else {
					$na = $n;
					$na .= ':::';
					$brn_data = $this->db->get_where('brand',array('brand_id'=>$n));
					if($brn_data->num_rows() > 0){
						$na .= $brn_data->row()->name;
						array_push($brands,$na);
					}
				}
			}
		}
		//print_r(array_unique($brands));
		return array_unique($brands);
	}

	
	function sub_details_by_cat($cat=''){
		$subs = $this->db->get_where('sub_category',array('category'=>$cat))->result_array();
		$result = array();
		foreach($subs as $row){
			$result[] = array(
							'sub_id' => $row['sub_category_id'],
							'sub_name' => str_replace("'",' ',$row['sub_category_name']),
							'min' => round($this->crud_model->get_range_lvl('sub_category', $row['sub_category_id'], "min")),
							'max' => round($this->crud_model->get_range_lvl('sub_category', $row['sub_category_id'], "max")),
							'brands' => str_replace("'",' ',join(';;;;;;',$this->get_brands('sub_category',$row['sub_category_id'])))
						);
		}
		return json_encode($result);
	}

	function get_vendors_by($type,$id){
		$this->db->where('status','approved');
		$vendors = $this->db->get('vendor')->result_array();
		$result = array();
		foreach($vendors as $row){
			if($type == 'category'){
				if($id == '0'){
					$result[] = $row['vendor_id'].':::'.$row['display_name'];
				} else {
					if($this->is_category_of_vendor($id,$row['vendor_id'])){
						$result[] = $row['vendor_id'].':::'.$row['display_name'];
					}
				}
			}
			if($type == 'sub_category'){
				if($this->is_sub_cat_of_vendor($id,$row['vendor_id'])){
					$result[] = $row['vendor_id'].':::'.$row['display_name'];
				}
			}
		}
		return $result;
	}

    function is_category_of_vendor($category,$vendor_id){
        $product = $this->db->get_where('product',array('category'=>$category))->result_array();
        $p = 'no';
        foreach ($product as $row) {
            if($this->is_added_by('product',$row['product_id'],$vendor_id,'vendor')){
                $p = 'yes';
            }
        }
		
		$this->config->cache_query();
        if($p == 'yes'){
            return true;
        } else {
            return false;
        }
    }
	
	function vendor_categories($vendor){
		$categories = $this->db->get('category')->result_array();
		$result = array();
		foreach($categories as $row){
			if($this->is_category_of_vendor($row['category_id'],$vendor)){
				$result[] = $row['category_id'];
			}
		}
		return $result;
	}

    function is_sub_cat_of_vendor($sub_cat,$vendor_id){
        $product = $this->db->get_where('product',array('sub_category'=>$sub_cat))->result_array();
        $p = 'no';
        foreach ($product as $row) {
            if($this->is_added_by('product',$row['product_id'],$vendor_id,'vendor')){
                $p = 'yes';
            }
        }
        if($p == 'yes'){
            return true;
        } else {
            return false;
        }
    }
	
	function vendor_sub_categories($vendor,$category){
		$sub_categories = $this->db->get_where('sub_category',array('category'=>$category))->result_array();
		$result = array();
		foreach($sub_categories as $row){
			if($this->is_sub_cat_of_vendor($row['sub_category_id'],$vendor)){
				$result[] = $row['sub_category_id'];
			}
		}
		return $result;
	}
	function vendor_products_by_sub($vendor,$sub_category){
		$products = $this->db->get_where('product',array('sub_category'=>$sub_category))->result_array();
		$result = array();
		foreach($products as $row){
			if($this->is_added_by('product',$row['product_id'],$vendor,'vendor')){
				$result[] = $row['product_id'];
			}
		}
		return $result;
	}

    function is_brand_of_vendor($brand,$vendor_id){
        $product = $this->db->get_where('product',array('brand'=>$brand))->result_array();
        $p = 'no';
        foreach ($product as $row) {
            if($this->is_added_by('product',$row['product_id'],$vendor_id,'vendor')){
                $p = 'yes';
            }
        }
        if($p == 'yes'){
            return true;
        } else {
            return false;
        }
    }

    function can_add_product($vendor){
        $membership = $this->db->get_where('vendor',array('vendor_id'=>$vendor))->row()->membership;
        $expire = $this->db->get_where('vendor',array('vendor_id'=>$vendor))->row()->member_expire_timestamp;
        $already = $this->db->get_where('product',array('added_by'=>'{"type":"vendor","id":"'.$vendor.'"}','status'=>'ok'))->num_rows();
        if($membership == '0'){
            $max = $this->db->get_where('general_settings',array('type'=>'default_member_product_limit'))->row()->value;
        } else {
            $max = $this->db->get_where('membership',array('membership_id'=>$membership))->row()->product_limit;
        }
        
		if($expire > time() || $membership == '0'){
			if($max <= $already){
				return false;
			} else if($max > $already){
				return true;
			}
		} else {
			return false;
		}
    }

    function is_publishable($product_id){
        //maximum product + membership change
		$product_data = $this->db->get_where('product',array('product_id'=>$product_id));
		if($product_data->row()->status !== 'ok'){
			return false;
		}
        $physical_product_activation = $this->db->get_where('general_settings',array('type'=>'physical_product_activation'))->row()->value;
        $digital_product_activation = $this->db->get_where('general_settings',array('type'=>'digital_product_activation'))->row()->value;
		
		if($product_data->row()->download == NULL){
			if($physical_product_activation !== 'ok'){
				return false;
			}
		} else if($product_data->row()->download == 'ok'){
			if($digital_product_activation !== 'ok'){
				return false;
			}
		}
		
        $by = json_decode($product_data->row()->added_by,true);
        if($by['type'] == 'admin'){
            return true;
        } else if($by['type'] == 'vendor'){
            $vendor_status = $this->db->get_where('vendor',array('vendor_id'=>$by['id']))->row()->status;
            $vendor_system = $this->db->get_where('general_settings',array('type'=>'vendor_system'))->row()->value;
			if($vendor_system !== 'ok'){
				return false;
			}
            if ($vendor_status == 'approved') {
                return true;
            } else {
                return false;
            }
        }
    }
	
    function is_publishable_count($type,$id,$vendor_id=''){
		$i = 0;
		if($vendor_id !== ''){
			$this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$vendor_id)));
		}
		$products = $this->db->get_where('product',array($type=>$id))->result_array();
		foreach($products as $row){
			if($this->is_publishable($row['product_id'])){
				$i++;
			}
		}
		return $i;		
	}
	

    function set_product_publishability($vendor,$except=''){
        $membership = $this->db->get_where('vendor',array('vendor_id'=>$vendor))->row()->membership;
        $this->db->order_by('product_id','desc');
        $approved_products = $this->db->get_where('product',array('added_by'=>'{"type":"vendor","id":"'.$vendor.'"}','status'=>'ok'));
        $already = $approved_products->num_rows();        
        if($membership == '0'){
            $max = $this->db->get_where('general_settings',array('type'=>'default_member_product_limit'))->row()->value;
        } else {
            $max = $this->db->get_where('membership',array('membership_id'=>$membership))->row()->product_limit; 
        }
        if($max <= $already){
            $approved_products = $approved_products->result_array();
            $i = 0;
            foreach ($approved_products as $row) {
                $i++;
                if($row['product_id'] !== $except){
                    if($i < $max){
                        $data['status'] = 'ok';
                    } else {
                        $data['status'] = '0';
                    }
                    $this->db->where('product_id', $row['product_id']);
                    $this->db->update('product', $data);
                }
            }
        }
    }

    function check_vendor_mambership(){
        //interval loop check for end membership + email terminsation
        $vendors = $this->db->get('vendor')->result_array();
        foreach ($vendors as $row) {
            if($row['membership'] !== '0'){
                if($row['member_expire_timestamp'] < time()){
                    $data['membership'] = '0';
                    $this->db->where('vendor_id', $row['vendor_id']);
                    $this->db->update('vendor', $data);
                    $this->set_product_publishability($row['vendor_id']);
                    $this->email_model->membership_upgrade_email($row['vendor_id']);
                }
            }
        } 
    }

    function upgrade_membership($vendor,$membership){
        $vendor_cur         = $this->db->get_where('vendor',array('vendor_id'=>$vendor));
        $cur_membership     = $vendor_cur->row()->membership;
        $cur_expire         = $vendor_cur->row()->member_expire_timestamp;
        $membership_spec    =  $this->db->get_where('membership',array('membership_id'=>$membership));
        $timespan           = $membership_spec->row()->timespan;
        //$new_expire       = $cur_expire+($timespan*24*60*60);
        $new_expire         = time()+($timespan*24*60*60);
        $data['member_expire_timestamp'] = $new_expire;
        $data['membership'] = $membership;
        $this->db->where('vendor_id', $vendor);
        $this->db->update('vendor', $data);
        $this->email_model->membership_upgrade_email($vendor);
    }
    
    //GETTING ADMIN PERMISSION
    function admin_permission($codename)
    {
        
        if ($this->session->userdata('admin_login') != 'yes') {
            return false;
        }$admin_id   = $this->session->userdata('admin_id');
        $admin      = $this->db->get_where('admin', array(
            'admin_id' => $admin_id
        ))->row();
		$this->benchmark->mark_time();
        $permission = $this->db->get_where('permission', array(
            'codename' => $codename
        ))->row()->permission_id;
        if ($admin->role == 1) {
            return true;
        } else {
            $role             = $admin->role;
            $role_permissions = json_decode($this->crud_model->get_type_name_by_id('role', $role, 'permission'));
            if (in_array($permission, $role_permissions)) {
                return true;
            } else {
                return false;
            }
        }/**/
    }
    
    
    //GETTING USER TOTAL
    function user_total($last_days = 0)
    {
        if ($last_days == 0) {
            $time = 0;
        } else {
            $time = time() - (24 * 60 * 60 * $last_days);
        }
        $sales  = $this->db->get_where('sale', array(
            'buyer' => $this->session->userdata('user_id'),
            'payment_status' => 'paid',
            'sale_datetime >=' => $time
        ))->result_array();
        $return = 0;
        foreach ($sales as $row) {
            $return += $row['grand_total'];
        }
        return number_format((float) $return, 2, '.', '');
    }
    
    
    //GETTING NUMBER OF WISHED PRODUCTS BY CURRENT USER
    function user_wished()
    {
        $user = $this->session->userdata('user_id');
        return count(json_decode($this->get_type_name_by_id('user', $user, 'wishlist')));
    }
    
    //ADDING PRODUCT TO WISHLIST
    function add_wish($product_id)
    {
        $user = $this->session->userdata('user_id');
        if ($this->get_type_name_by_id('user', $user, 'wishlist') !== 'null') {
            $wished = json_decode($this->get_type_name_by_id('user', $user, 'wishlist'));
        } else {
            $wished = array();
        }
        if ($this->is_wished($product_id) == 'no') {
            array_push($wished, $product_id);
            $this->db->where('user_id', $user);
            $this->db->update('user', array(
                'wishlist' => json_encode($wished)
            ));
        }
    }
    
    //REMOVING PRODUCT FROM WISHLIST
    function remove_wish($product_id)
    {
        $user = $this->session->userdata('user_id');
        if ($this->get_type_name_by_id('user', $user, 'wishlist') !== 'null') {
            $wished = json_decode($this->get_type_name_by_id('user', $user, 'wishlist'));
        } else {
            $wished = array();
        }
        $wished_new = array();
        foreach ($wished as $row) {
            if ($row !== $product_id) {
                $wished_new[] = $row;
            }
        }
        $this->db->where('user_id', $user);
        $this->db->update('user', array(
            'wishlist' => json_encode($wished_new)
        ));
    }
    
    
    //NUMBER OF WISHED PRODUCTS
    function wished_num()
    {
        $user = $this->session->userdata('user_id');
        if ($this->get_type_name_by_id('user', $user, 'wishlist') !== '') {
            return count(json_decode($this->get_type_name_by_id('user', $user, 'wishlist')));
        } else {
            return 0;
        }
    }
    
    
    //IF PRODUCT IS ADDED TO CURRENT USER'S WISHLIST
    function is_wished($product_id)
    {
        if ($this->session->userdata('user_login') == 'yes') {
            $user = $this->session->userdata('user_id');
            //$wished = array('0');
            if ($this->get_type_name_by_id('user', $user, 'wishlist') !== '') {
                $wished = json_decode($this->get_type_name_by_id('user', $user, 'wishlist'));
            } else {
                $wished = array(
                    '0'
                );
            }
            if (in_array($product_id, $wished)) {
                return 'yes';
            } else {
                return 'no';
            }
        } else {
            return 'no';
        }
    }
    
    //GETTING TOTAL WISHED PRODUCTT BY USER
    function total_wished($product_id)
    {
        $num   = 0;
        $users = $this->db->get('user')->result_array();
        foreach ($users as $row) {
            $wishlist = json_decode($row['wishlist']);
            if (is_array($wishlist)) {
                if (in_array($product_id, $wishlist)) {
                    $num++;
                }
            }
            
        }
        return $num;
    }
    
    //GETTING MOST WISHED PRODUCTS
    function most_wished()
    {
        $result  = array();
        $product = $this->db->get('product')->result_array();
        foreach ($product as $row) {
            $result[] = array(
                'title' => $row['title'],
                'wish_num' => $this->total_wished($row['product_id']),
                'id' => $row['product_id']
            );
        }
        if (!function_exists('compare_lastname')) {
            function compare_lastname($a, $b)
            {
                return strnatcmp($b['wish_num'], $a['wish_num']);
            }
        }
        usort($result, 'compare_lastname');
        return $result;
    }
    
    //RATING
    function rating($product_id)
    {
        $total = $this->get_type_name_by_id('product', $product_id, 'rating_total');
        $num   = $this->get_type_name_by_id('product', $product_id, 'rating_num');
        if ($num > 0) {
            $number = $total / $num;
            return number_format((float) $number, 2, '.', '');
        } else {
            return 0;
        }
    }
	
    function vendor_rating($id)
    {
		$this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$id)));
		$products = $this->db->get('product')->result_array();
		$num = 0;
		$total = 0;
		foreach($products as $row){
			if($this->is_publishable($row['product_id'])){
				$num += $row['rating_num'];
				$total += $row['rating_total'];
			}
		}
        if ($num > 0) {
            $number = $total / $num;
            return number_format((float) $number, 2, '.', '');
        } else {
            return 0;
        }
    }
    
    //IF CURRENT USER RATED THE PRODUCT
    function is_rated($product_id)
    {
        if ($this->session->userdata('user_login') == 'yes') {
            $user = $this->session->userdata('user_id');
            if ($this->get_type_name_by_id('product', $product_id, 'rating_user') !== '') {
                $rating_user = json_decode($this->get_type_name_by_id('product', $product_id, 'rating_user'));
            } else {
                $rating_user = array(
                    '0'
                );
            }
            if (in_array($user, $rating_user)) {
                return 'yes';
            } else {
                return 'no';
            }
        } else {
            return 'no';
        }
    }
    
    //SETTING RATING
    function set_rating($product_id, $rating)
    {
        if ($this->is_rated($product_id) == 'yes') {
            return 'no';
        }
        
        $total = $this->get_type_name_by_id('product', $product_id, 'rating_total');
        $num   = $this->get_type_name_by_id('product', $product_id, 'rating_num');
        $user  = $this->session->userdata('user_id');
        $total = $total + $rating;
        $num   = $num + 1;
        
        $rating_user = json_decode($this->get_type_name_by_id('product', $product_id, 'rating_user'));
        if (!is_array($rating_user)) {
            $rating_user = array();
        }
        array_push($rating_user, $user);
        
        $this->db->where('product_id', $product_id);
        $this->db->update('product', array(
            'rating_user' => json_encode($rating_user)
        ));
        $this->db->where('product_id', $product_id);
        $this->db->update('product', array(
            'rating_total' => $total
        ));
        $this->db->where('product_id', $product_id);
        $this->db->update('product', array(
            'rating_num' => $num
        ));
        
        return 'yes';
    }
    
    
    //GETTING IP DATA OF PEOPLE BROWING THE SYSTEM
    function ip_data()
    {
        if(!$this->input->is_ajax_request()){
            $this->session->set_userdata('timestamp', time());
            $user_data = $this->session->userdata('surfer_info');
            $ip        = $_SERVER['REMOTE_ADDR'];
            if (!$user_data) {
                if ($_SERVER['HTTP_HOST'] !== 'localhost') {
                    $ip_data = file_get_contents("http://ip-api.com/json/" . $ip);
                    $this->session->set_userdata('surfer_info', $ip_data);
                }
            }
        }
    }
    
    
    //GETTING TOTAL PURCHASE
    function total_purchase($user_id)
    {
        $return = 0;
        $sales  = $this->db->get('sale')->result_array();
        foreach ($sales as $row) {
            if ($row['buyer'] == $user_id) {
                $return += $row['grand_total'];
            }
        }
        return $this->cart->format_number($return);
    }


    function seo_stat($type='') {
        try {
            $url = base_url();
            $seostats = new \SEOstats\SEOstats;
            if ($seostats->setUrl($url)) {

                if($type == 'facebook'){
                    return SEOstats\Services\Social::getFacebookShares();
                }
                elseif ($type == 'gplus') {
                    return SEOstats\Services\Social::getGooglePlusShares();
                }
                elseif ($type == 'twitter') {
                    return SEOstats\Services\Social::getTwitterShares();
                }
                elseif ($type == 'linkedin') {
                    return SEOstats\Services\Social::getLinkedInShares();
                }
                elseif ($type == 'pinterest') {
                    return SEOstats\Services\Social::getPinterestShares();
                }

                elseif ($type == 'alexa_global') {
                    return SEOstats\Services\Alexa::getGlobalRank();
                }
                elseif ($type == 'alexa_country') {
                    return SEOstats\Services\Alexa::getCountryRank();
                }

                elseif ($type == 'alexa_bounce') {
                    return SEOstats\Services\Alexa::getTrafficGraph(5);
                }
                elseif ($type == 'alexa_time') {
                    return SEOstats\Services\Alexa::getTrafficGraph(4);
                }
                elseif ($type == 'alexa_traffic') {
                    return SEOstats\Services\Alexa::getTrafficGraph(1);
                }
                elseif ($type == 'alexa_pageviews') {
                    return SEOstats\Services\Alexa::getTrafficGraph(2);
                }

                elseif ($type == 'google_siteindex') {
                    return SEOstats\Services\Google::getSiteindexTotal();
                }
                elseif ($type == 'google_back') {
                    return SEOstats\Services\Google::getBacklinksTotal();
                }
                elseif ($type == 'search_graph_1') {
                    return SEOstats\Services\SemRush::getDomainGraph(1);
                }
                elseif ($type == 'search_graph_2') {
                    return SEOstats\Services\SemRush::getDomainGraph(2);
                }

            }
        }
        catch(\Exception $e) {
            echo 'Caught SEOstatsException: ' . $e->getMessage();
        }
    }
	
	
    //ADDING PRODUCT TO WISHLIST
    function add_compare($product_id)
    {
        if($this->session->userdata('compare') == '' || $this->session->userdata('compare') == 'null'){
            $this->session->set_userdata('compare','[]');
        }
        $compared = json_decode($this->session->userdata('compare'),true);
        if ($this->is_compared($product_id) == 'no') {
            array_push($compared, $product_id);
            $compared = json_encode($compared);
			//echo $this->compare_category_num($product_id);
			if($this->compare_category_num($product_id) <= 3){
				$this->session->set_userdata('compare',$compared);
				echo 'done';
			} else {
				echo 'cat_full';
			}
        } else {
            echo 'already';
        }
    }

	function compare_category_num($product_id){
        if($this->session->userdata('compare') == '' || $this->session->userdata('compare') == 'null'){
            $this->session->set_userdata('compare','[]');
        }
        $compared = json_decode($this->session->userdata('compare'),true);
		$category = $this->db->get_where('product',array('product_id'=>$product_id))->row()->category;
		$i = 0;
		foreach($compared as $row){
			$n_cat = $this->db->get_where('product',array('product_id'=>$row))->row()->category;
			if($n_cat == $category){
				$i++;
			}
		}
		return $i;		
	}

    //REMOVING PRODUCT FROM WISHLIST
    function remove_compare($product_id)
    {
        $compared = json_decode($this->session->userdata('compare'),true);
        $new = array();
        foreach ($compared as $row) {
            if($row !== $product_id){
                $new[] = $product_id;
            }
        }
        $compared = json_encode($new);
        $this->session->set_userdata('compare',$compared);
    }    


    //NUMBER OF WISHED PRODUCTS
    function compared_num()
    {
        return count(json_decode($this->session->userdata('compare'),true));
    }    


    //IF PRODUCT IS ADDED TO CURRENT USER'S WISHLIST
    function is_compared($product_id)
    {        
        //echo $this->session->userdata('compare');
        if($this->session->userdata('compare') == '' || $this->session->userdata('compare') == 'null'){
            $this->session->set_userdata('compare','[]');
        }
        $compared = json_decode($this->session->userdata('compare'),true);
        foreach ($compared as $row) {
            if($row == $product_id){
                return 'yes';
            } 
        } 
        return 'no';
    } 

    //IF PRODUCT IS ADDED TO CURRENT USER'S WISHLIST
    function compared_shower()
    {        
        if($this->session->userdata('compare') == ''){
            $this->session->set_userdata('compare','[]');
        }
        $compared = json_decode($this->session->userdata('compare'),true);
        $cats = array();
        $products = array();
        $result = array();
        foreach ($compared as $row) {
            $cat = $this->db->get_where('product',array('product_id'=>$row))->row()->category;
            $cats[] = $cat;
            $products[] = array('c'=>$cat,'p'=>$row);
        }
		
        $cats   = array_unique($cats);
        foreach ($cats as $row) {
            $ps     = array();
            foreach ($products as $r) {
                if($r['c'] == $row){
                    $ps[] = $r['p'];
                }
            }
            $result[] = array('category'=>$row,'products'=>$ps);
        }
        return $result;
    }

 
    /* FUNCTION: Price Range Load by AJAX*/
    function get_range_lvl($by = "", $id = "", $type = "")
    {
		$physical= $this->crud_model->get_settings_value('general_settings','physical_product_activation');
		$digital= $this->crud_model->get_settings_value('general_settings','digital_product_activation');
		$vendor= $this->crud_model->get_settings_value('general_settings','vendor_system');
        if ($type == "min") {
            $set = 'asc';
        } elseif ($type == "max") {
            $set = 'desc';
        }
        $this->db->limit(1);
		if($physical == 'ok' && $digital !== 'ok') {
			$this->db->where('download',NULL);
		}
		if($physical !== 'ok' &&$digital == 'ok'){
			$this->db->where('download','ok');
		}
        $this->db->order_by('sale_price', $set);
        if (count($a = $this->db->get_where('product', array(
            $by => $id
        ))->result_array()) > 0) {
            foreach ($a as $r) {
                return $r['sale_price'];
            }
        } else {
            return 0;
        }
    }

    /* FUNCTION: Regarding Digital*/
    function is_digital($id){
        if($this->db->get_where('product',array('product_id'=>$id))->row()->download == 'ok'){
            return true;
        } else {
            return false;
        }
    }

    function download_product($id){
        if($this->can_download($id)){
            $this->load->helper('download');
            $name       = $this->db->get_where('product',array('product_id'=>$id))->row()->download_name;
            $folder     = $this->db->get_where('general_settings', array('type' => 'file_folder'))->row()->value;
            $link       = 'uploads/file_products/' . $folder .'/' . $name;
            force_download($link, NULL);
            echo 'ok';
        } else {
            echo 'not';
        }
    }

    function digital_to_customer($sale_id){
        $carted = json_decode($this->db->get_where('sale', array(
                    'sale_id' => $sale_id
                ))->row()->product_details, true);
        $user = $this->db->get_where('sale', array(
                    'sale_id' => $sale_id
                ))->row()->buyer;
        $downloads = $this->db->get_where('user', array(
                    'user_id' => $user
                    ))->row()->downloads;
        $result = array();
        foreach ($carted as $row) {
            if($this->is_digital($row['id'])){
                $result[] = array('sale'=>$sale_id,'product'=>$row['id']);
            }
        }
        if($downloads !== ''){
            $downloads = json_decode($downloads,true);
        } else if($downloads == ''){
            $downloads = json_decode('[]',true);
        }
        $data['downloads'] = json_encode(array_merge($downloads,$result));
        $this->db->where('user_id',$user);
        $this->db->update('user',$data);
    }

    function download_count($product){
		$users = $this->db->get('user')->result_array();
		$i = 0;
		foreach($users as $row){
            $downloads = json_decode($row['downloads'],true);
			$ids = array();
			foreach($downloads as $row){
				$ids[] = $row['product'];
			}
			if(in_array($product,$ids)){
				$i++;
			}
		}
		return $i;
	}

    function can_download($product){
        if($this->session->userdata('admin_login') == 'yes'){
            return true;
        }
        if($this->session->userdata('vendor_login') == 'yes'){
            if($this->is_added_by('product',$product,$this->session->userdata('vendor_id'),'vendor')){
                return true;
            } else {
                return false;
            }
        }
        if($this->session->userdata('user_login') == 'yes'){
            $user = $this->session->userdata('user_id');
            $downloads = $this->db->get_where('user', array(
                        'user_id' => $user
                        ))->row()->downloads;
            $ok = 'no';
            if($downloads !== ''){
                $downloads = json_decode($downloads,true);
            } else if($downloads == ''){
                $downloads = json_decode('[]',true);
            }
			//print_r($downloads);
            foreach ($downloads as $row) {
                if($row['product'] == $product){
                    $by = json_decode($this->db->get_where('product', array(
                                'product_id' => $product
                              ))->row()->added_by,true);
                    $type = $by['type'];
                    $id = $by['id'];
                    $status = json_decode($this->db->get_where('sale', array(
                                'sale_id' => $row['sale']
                              ))->row()->payment_status,true);
                    $fs = '';
                    foreach ($status as $t) {
                        if($type == 'vendor'){
                            if($t[$type] == $id){
                                $fs = $t['status'];
                            }
                        } else if($type == 'admin'){
                            $fs = $t['status'];
                        }
                    }
					//echo $fs;
                    if($fs == 'paid'){
                        $ok = 'yes';
                    }
                }
            }
            if($ok == 'yes'){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }
	function ticket_unread_messages($ticket_id,$user_type){
		$count = 0;
		if($ticket_id !== 'all'){
			$msgs  = $this->db->get_where('ticket_message',array('ticket_id'=>$ticket_id))->result_array();
		} else if($ticket_id == 'all'){
			$msgs  = $this->db->get('ticket_message')->result_array();
		}
		foreach($msgs as $row){
			$status = json_decode($row['view_status'],true);
			foreach($status as $type => $row1){
				if($type == $user_type.'_show'){
					if($row1 == 'no'){
						$count++;
					}
				}
			}
		}
		return $count;
		
	}
	
	function ticket_message_viewed($ticket_id,$user_type){
		
		$msgs  = $this->db->get_where('ticket_message',array('ticket_id'=>$ticket_id))->result_array();
		foreach($msgs as $row){
			$status = json_decode($row['view_status'],true);
			$new_status = array();
			foreach($status as $type=>$row1){
				if($type == $user_type.'_show'){
					$new_status[$type] =  'ok';
				} else{
					$new_status[$type] =  $row1;
				}
			}
			$view_status = json_encode($new_status);
			$this->db->where('ticket_message_id', $row['ticket_message_id']);
        	$this->db->update('ticket_message', array(
            	'view_status' => $view_status
        	));
			
		}
			
	}


    //GET PRODUCT LINK
    function category_link($cat='',$scat='',$brand='')
    {
        $cat_name       = 'all-category';
        $scat_name      = 'all-subcategory';
        $brand_name     = 'all-brand';

        if($cat !== ''){
            $cat_name = $this->crud_model->get_type_name_by_id('category', $cat, 'category_name');
        }
        if($scat !== ''){
            $scat_name = $this->crud_model->get_type_name_by_id('sub_category', $scat, 'sub_category_name');
        }
        if($brand !== ''){
            $brand_name = $this->crud_model->get_type_name_by_id('brand', $brand, 'name');
        }

        $url = url_title($cat.'-'.$cat_name.'-'.$scat.'-'.$scat_name.'-'.$brand.'-'.$brand_name);

        return base_url() . 'index.php/home/' . $url;
    }
	
	function product_list_set($speciality,$limit,$id=''){
        $physical_product_activation = $this->crud_model->get_settings_value('general_settings','physical_product_activation');
        $digital_product_activation = $this->crud_model->get_settings_value('general_settings','digital_product_activation');
		$approved_vendors = $this->db->get_where('vendor',array('status'=>'approved'))->result_array();
		$admins = $this->db->get('admin')->result_array();
		foreach ($approved_vendors as $row) {
			$vendors[] = '{"type":"vendor","id":"'.$row['vendor_id'].'"}';
		}
		foreach ($admins as $row) {
			$vendors[] = '{"type":"admin","id":"'.$row['admin_id'].'"}';
		}
		$result = array();
		$category = $this->get_type_name_by_id('product',$id,'category');
		//$this->db->select('product_id');
		$this->db->where('status','ok');
		$this->db->limit($limit);
		$this->db->where_in('added_by',$vendors);
	
		if($physical_product_activation == 'ok' && $digital_product_activation !== 'ok'){
			$this->db->where('download',NULL);
		} else if($physical_product_activation !== 'ok' && $digital_product_activation == 'ok'){
			$this->db->where('download','ok');
		} else if($physical_product_activation !== 'ok' && $digital_product_activation !== 'ok'){
			$this->db->where('product_id','');
		}
		
		if($speciality == 'most_viewed'){
			$this->db->order_by('number_of_view','desc');
		}
		
		if($speciality == 'recently_viewed'){
			$this->db->order_by('last_viewed','desc');
		}
		
		if($speciality == 'featured'){
			$this->db->where('featured','ok');
		}
		
		if($speciality == 'vendor_featured'){
			$this->db->where('featured','ok');
			$this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$id)));
		}
		
		if($speciality == 'related'){
			$this->db->where('product_id!=',$id);
			$this->db->where('category',$category);
		}
		
		if($speciality == 'sub_category'){
			$this->db->where('sub_category',$id);
		}
		
		if($speciality == 'deal'){
			$this->db->where('deal','ok');
		}
		
		$this->db->order_by('product_id','desc');
		$res = $this->db->get('product')->result_array();
		return $res;
		/*
		$i = 0;
		foreach($res as $row){
			if($this->is_publishable($row['product_id'])){
				$i++;
				if($i <= $limit){
					$result[] = $row['product_id'];
				}
			}
		}
		
		if(empty($result)){
			$result = array(0);
		}
		$this->db->where_in('product_id',$result);
		if($speciality == 'most_viewed'){
			$this->db->order_by('number_of_view','desc');
		}
		
		if($speciality == 'recently_viewed'){
			$this->db->order_by('last_viewed','desc');
		}
		$this->db->order_by('product_id','desc');
		return $this->db->get('product')->result_array();	
		*/	
	}
	
	function if_publishable_category($cat_id){
		$category_data = $this->db->get_where('category',array('category_id'=>$cat_id));
        $physical_product_activation = $this->db->get_where('general_settings',array('type'=>'physical_product_activation'))->row()->value;
        $digital_product_activation = $this->db->get_where('general_settings',array('type'=>'digital_product_activation'))->row()->value;
		
		if($category_data->row()->digital == ''){
			if($physical_product_activation !== 'ok'){
				return false;
			}
		} else if($category_data->row()->digital == 'ok'){
			if($digital_product_activation !== 'ok'){
				return false;
			}
		}
		return true;
	}
	function if_publishable_subcategory($id){
		$sub_category_data = $this->db->get_where('sub_category',array('sub_category_id'=>$id));
        $physical_product_activation = $this->db->get_where('general_settings',array('type'=>'physical_product_activation'))->row()->value;
        $digital_product_activation = $this->db->get_where('general_settings',array('type'=>'digital_product_activation'))->row()->value;
		
		if($sub_category_data->row()->digital == ''){
			if($physical_product_activation !== 'ok'){
				return false;
			}
		} else if($sub_category_data->row()->digital == 'ok'){
			if($digital_product_activation !== 'ok'){
				return false;
			}
		}
		return true;
	}
	
	/*<span 
	class="arrow search_cat search_cat_click" 
	data-cat="1" 
	data-min="13150" 
	data-max="4800000"
	data-brands= "41:::Chevrolet-40:::Ford-39:::Nissan-38:::Audi-44:::Hyundai-45:::BMW-46:::Marcedes-Benz-47:::Mitsubishi-51:::Toyota-52:::Honda-54:::Volvo-50:::Lamborghini-55:::Porsche-48:::Suzuki-56:::Dunlop-57:::Yamaha" 
	data-vendors="1:::Lavinia Mckee-3:::Tom"
>
	*/
	
	/*
	data-brands= "41:::Chevrolet-40:::Ford-39:::Nissan-38:::Audi-44:::Hyundai-45:::BMW-46:::Marcedes-Benz-47:::Mitsubishi-51:::Toyota-52:::Honda-54:::Volvo-50:::Lamborghini-55:::Porsche-48:::Suzuki-56:::Dunlop-57:::Yamaha" 
	data-subdets= "[{&quot;sub_id&quot;:&quot;1&quot;,&quot;sub_name&quot;:&quot;Car&quot;,&quot;min&quot;:0,&quot;max&quot;:0,&quot;brands&quot;:&quot;41:::Chevrolet-40:::Ford-39:::Nissan-38:::Audi-44:::Hyundai-45:::BMW-46:::Marcedes-Benz-47:::Mitsubishi-51:::Toyota-52:::Honda-54:::Volvo&quot;},{&quot;sub_id&quot;:&quot;2&quot;,&quot;sub_name&quot;:&quot;Racing Car&quot;,&quot;min&quot;:145000,&quot;max&quot;:145000,&quot;brands&quot;:&quot;41:::Chevrolet-40:::Ford-39:::Nissan-38:::Audi-45:::BMW-46:::Marcedes-Benz-47:::Mitsubishi-50:::Lamborghini-51:::Toyota-52:::Honda-54:::Volvo-55:::Porsche&quot;},{&quot;sub_id&quot;:&quot;3&quot;,&quot;sub_name&quot;:&quot;Luxury SUV&quot;,&quot;min&quot;:46545,&quot;max&quot;:140825,&quot;brands&quot;:&quot;41:::Chevrolet-40:::Ford-39:::Nissan-45:::BMW-47:::Mitsubishi-51:::Toyota-54:::Volvo&quot;},{&quot;sub_id&quot;:&quot;5&quot;,&quot;sub_name&quot;:&quot;Chopper Bike&quot;,&quot;min&quot;:13150,&quot;max&quot;:79560,&quot;brands&quot;:&quot;39:::Nissan-45:::BMW-48:::Suzuki-52:::Honda-56:::Dunlop-57:::Yamaha&quot;},{&quot;sub_id&quot;:&quot;6&quot;,&quot;sub_name&quot;:&quot;Racing Bike&quot;,&quot;min&quot;:35000,&quot;max&quot;:48000,&quot;brands&quot;:&quot;45:::BMW-52:::Honda-57:::Yamaha&quot;},{&quot;sub_id&quot;:&quot;63&quot;,&quot;sub_name&quot;:&quot;Private Air&quot;,&quot;min&quot;:775000,&quot;max&quot;:4800000,&quot;brands&quot;:&quot;40:::Ford-39:::Nissan-38:::Audi-46:::Marcedes-Benz-47:::Mitsubishi-55:::Porsche&quot;}]">
	*/
	
	function set_category_data($cat_id){
		if($cat_id !== '' && $cat_id !== 0){
			$this->db->where('category_id',$cat_id);
		}
		$categories = $this->db->get('category')->result_array();
		foreach($categories as $row){
			$data['data_brands'] = join(';;;;;;',$this->get_brands('category',$row['category_id']));
			$data['data_vendors'] = join(';;;;;;',$this->get_vendors_by('category',$row['category_id']));
			$data['data_subdets'] = $this->sub_details_by_cat($row['category_id']);
			$this->db->where('category_id',$row['category_id']);
			$this->db->update('category',$data);
		}	
		
			$data1['value'] = join(';;;;;;',$this->get_brands('category','0'));
			$this->db->where('type','data_all_brands');
			$this->db->update('general_settings',$data1);
			
			$data2['value'] = join(';;;;;;',$this->get_vendors_by('category','0'));
			$this->db->where('type','data_all_vendors');
			$this->db->update('general_settings',$data2);
	}
	
}






