<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Admin extends CI_Controller
{
    /*  
     *  Developed by: Active IT zone
     *  Date    : 14 July, 2015
     *  Active Supershop eCommerce CMS
     *  http://codecanyon.net/user/activeitezone
     */
    
    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('paypal');
		$this->load->library('twoCheckout_Lib');
        /*cache control*/
		//$this->output->enable_profiler(TRUE);
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        //$this->crud_model->ip_data();
		$this->config->cache_query();
    }
    
    /* index of the admin. Default: Dashboard; On No Login Session: Back to login page. */
    public function index()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            $page_data['page_name'] = "dashboard";
            $this->load->view('back/index', $page_data);
        } else {
            $page_data['control'] = "admin";
            $this->load->view('back/login',$page_data);
        }
    }
    
    /*Product Category add, edit, view, delete */
    function category($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('category')) {
            redirect(base_url() . 'index.php/admin');
        }
		if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
			redirect(base_url() . 'index.php/admin');
		}
        if ($para1 == 'do_add') {
            $data['category_name'] = $this->input->post('category_name');
            $this->db->insert('category', $data);
            $id = $this->db->insert_id();
			
			$path = $_FILES['img']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$data_banner['banner'] 		 = 'category_'.$id.'.'.$ext;
            $this->crud_model->file_up("img", "category", $id, '', 'no', '.'.$ext);
			$this->db->where('category_id', $id);
            $this->db->update('category', $data_banner);
			$this->crud_model->set_category_data(0);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['category_data'] = $this->db->get_where('category', array(
                'category_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/category_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['category_name'] = $this->input->post('category_name');
            $this->db->where('category_id', $para2);
            $this->db->update('category', $data);
			if($_FILES['img']['name']!== ''){
				$path = $_FILES['img']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$data_banner['banner'] 		 = 'category_'.$para2.'.'.$ext;
				$this->crud_model->file_up("img", "category", $para2, '', 'no', '.'.$ext);
				$this->db->where('category_id', $para2);
				$this->db->update('category', $data_banner);
			}
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
			unlink("uploads/category_image/" .$this->crud_model->get_type_name_by_id('category',$para2,'banner'));
            $this->db->where('category_id', $para2);
            $this->db->delete('category');
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('category_id', 'desc');
			$this->db->where('digital=',NULL);
            $page_data['all_categories'] = $this->db->get('category')->result_array();
            $this->load->view('back/admin/category_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/category_add');
        } else {
            $page_data['page_name']      = "category";
            $page_data['all_categories'] = $this->db->get('category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
	/*Digital Category add, edit, view, delete */
    function category_digital($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('category_digital')) {
            redirect(base_url() . 'index.php/admin');
        }
		if ($this->crud_model->get_type_name_by_id('general_settings','69','value') !== 'ok') {
			redirect(base_url() . 'index.php/admin');
		}
        if ($para1 == 'do_add') {
            $data['category_name'] = $this->input->post('category_name');
			$data['digital'] = 'ok';
            $this->db->insert('category', $data);
            $id = $this->db->insert_id();
            
			$path = $_FILES['img']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$data_banner['banner'] 		 = 'category_'.$id.'.'.$ext;
            $this->crud_model->file_up("img", "category", $id, '', 'no', '.'.$ext);
			$this->db->where('category_id', $id);
            $this->db->update('category', $data_banner);
			$this->crud_model->set_category_data(0);
			
            recache();
        } else if ($para1 == 'edit') {
            $page_data['category_data'] = $this->db->get_where('category', array(
                'category_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/category_edit_digital', $page_data);
        } elseif ($para1 == "update") {
            $data['category_name'] = $this->input->post('category_name');
            $this->db->where('category_id', $para2);
            $this->db->update('category', $data);
			if($_FILES['img']['name']!== ''){
				$path = $_FILES['img']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$data_banner['banner'] 		 = 'category_'.$para2.'.'.$ext;
				$this->crud_model->file_up("img", "category", $para2, '', 'no', '.'.$ext);
				$this->db->where('category_id', $para2);
				$this->db->update('category', $data_banner);
			}
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
			unlink("uploads/category_image/" .$this->crud_model->get_type_name_by_id('category',$para2,'banner'));
            $this->db->where('category_id', $para2);
            $this->db->delete('category');
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('category_id', 'desc');
			$this->db->where('digital=','ok');
            $page_data['all_categories'] = $this->db->get('category')->result_array();
            $this->load->view('back/admin/category_list_digital', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/category_add_digital');
        } else {
            $page_data['page_name']      = "category_digital";
			$this->db->where('digital=','ok');
            $page_data['all_categories'] = $this->db->get('category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /*Product blog_category add, edit, view, delete */
    function blog_category($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('blog')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'do_add') {
            $data['name'] = $this->input->post('name');
            $this->db->insert('blog_category', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['blog_category_data'] = $this->db->get_where('blog_category', array(
                'blog_category_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/blog_category_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['name'] = $this->input->post('name');
            $this->db->where('blog_category_id', $para2);
            $this->db->update('blog_category', $data);
            recache();
        } elseif ($para1 == 'delete') {
            $this->db->where('blog_category_id', $para2);
            $this->db->delete('blog_category');
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('blog_category_id', 'desc');
            $page_data['all_categories'] = $this->db->get('blog_category')->result_array();
            $this->load->view('back/admin/blog_category_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/blog_category_add');
        } else {
            $page_data['page_name']      = "blog_category";
            $page_data['all_categories'] = $this->db->get('blog_category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    

    /*Product slides add, edit, view, delete */
    function slides($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('slides')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'do_add') {
            $type                		= 'slides';
            $data['button_color']      	= $this->input->post('color_button');
			$data['text_color']        	= $this->input->post('color_text');
			$data['button_text']        = $this->input->post('button_text');
			$data['button_link']        = $this->input->post('button_link');
			$data['uploaded_by']		= 'admin';
			$data['status']				= 'ok';
			$data['added_by']           = json_encode(array('type'=>'admin','id'=>$this->session->userdata('admin_id')));
            $this->db->insert('slides', $data);
            $id = $this->db->insert_id();
            $this->crud_model->file_up("img", "slides", $id, '', '', '.jpg');
            recache();
        } elseif ($para1 == "update") {
            $data['button_color']      	= $this->input->post('color_button');
			$data['text_color']        	= $this->input->post('color_text');
			$data['button_text']        = $this->input->post('button_text');
			$data['button_link']        = $this->input->post('button_link');
            $this->db->where('slides_id', $para2);
            $this->db->update('slides', $data);
            $this->crud_model->file_up("img", "slides", $para2, '', '', '.jpg');
            recache();
        } elseif ($para1 == 'delete') {
            $this->crud_model->file_dlt('slides', $para2, '.jpg');
            $this->db->where('slides_id', $para2);
            $this->db->delete('slides');
            recache();
        } elseif ($para1 == 'multi_delete') {
            $ids = explode('-', $param2);
            $this->crud_model->multi_delete('slides', $ids);
        } else if ($para1 == 'edit') {
            $page_data['slides_data'] = $this->db->get_where('slides', array(
                'slides_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/slides_edit', $page_data);
        } elseif ($para1 == 'list') {
            $this->db->order_by('slides_id', 'desc');
			$this->db->where('uploaded_by', 'admin');
            $page_data['all_slidess'] = $this->db->get('slides')->result_array();
            $this->load->view('back/admin/slides_list', $page_data);
        }elseif ($para1 == 'slide_publish_set') {
            $slides_id = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('slides_id', $slides_id);
            $this->db->update('slides', $data);
            recache();
        }
		elseif ($para1 == 'vendor') {
			if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
				redirect(base_url() . 'index.php/admin');
			}
            $page_data['page_name']  = "slides_vendor";
            $this->load->view('back/index', $page_data);
        }
		elseif ($para1 == 'vendor_slides') {
			if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
				redirect(base_url() . 'index.php/admin');
			}
            $this->db->order_by('slides_id', 'desc');
			$this->db->where('uploaded_by', 'vendor');
            $page_data['all_slidess'] = $this->db->get('slides')->result_array();
            $this->load->view('back/admin/slides_list_vendor', $page_data);
        }elseif ($para1 == 'add') {
            $this->load->view('back/admin/slides_add');
        } else {
            $page_data['page_name']  = "slides";
            $page_data['all_slidess'] = $this->db->get('slides')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /*Product Category add, edit, view, delete */
    function blog($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('blog')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'do_add') {
            $data['title']          = $this->input->post('title');
            $data['date']           = $this->input->post('date');
            $data['author']         = $this->input->post('author');
            $data['summery']        = $this->input->post('summery');
            $data['blog_category']  = $this->input->post('blog_category');
            $data['description']    = $this->input->post('description');
            $this->db->insert('blog', $data);
            $id = $this->db->insert_id();
            $this->crud_model->file_up("img", "blog", $id, '', '', '.jpg');
            recache();
        } else if ($para1 == 'edit') {
            $page_data['blog_data'] = $this->db->get_where('blog', array(
                'blog_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/blog_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['title']          = $this->input->post('title');
            $data['date']           = $this->input->post('date');
            $data['author']         = $this->input->post('author');
            $data['summery']        = $this->input->post('summery');
            $data['blog_category']  = $this->input->post('blog_category');
            $data['description']    = $this->input->post('description');
            $this->db->where('blog_id', $para2);
            $this->db->update('blog', $data);
            $this->crud_model->file_up("img", "blog", $para2, '', '', '.jpg');
            recache();
        } elseif ($para1 == 'delete') {
            $this->crud_model->file_dlt('blog', $para2, '.jpg');
            $this->db->where('blog_id', $para2);
            $this->db->delete('blog');
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('blog_id', 'desc');
            $page_data['all_blogs'] = $this->db->get('blog')->result_array();
            $this->load->view('back/admin/blog_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/blog_add');
        } else {
            $page_data['page_name']      = "blog";
            $page_data['all_blogs'] = $this->db->get('blog')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /*Product Sub-category add, edit, view, delete */
    function sub_category($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('sub_category')) {
            redirect(base_url() . 'index.php/admin');
        }
		if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
			redirect(base_url() . 'index.php/admin');
		}
        if ($para1 == 'do_add') {
            $data['sub_category_name'] = $this->input->post('sub_category_name');
            $data['category']          = $this->input->post('category');
			if($this->input->post('brand')==NULL)
			{
				$data['brand']             = '[]';
			}
			else{
				$data['brand']             = json_encode($this->input->post('brand'));
			}
            $this->db->insert('sub_category', $data);
			$id = $this->db->insert_id();
            
			$path = $_FILES['img']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$data_banner['banner'] 		 = 'sub_category_'.$id.'.'.$ext;
            $this->crud_model->file_up("img", "sub_category", $id, '', 'no', '.'.$ext);
			$this->db->where('sub_category_id', $id);
            $this->db->update('sub_category', $data_banner);
			$this->crud_model->set_category_data(0);
			
            recache();
        } else if ($para1 == 'edit') {
            $page_data['sub_category_data'] = $this->db->get_where('sub_category', array(
                'sub_category_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/sub_category_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['sub_category_name'] = $this->input->post('sub_category_name');
            $data['category']          = $this->input->post('category');
			if($this->input->post('brand')==NULL)
			{
				$data['brand']             = '[]';
			}
			else{
				$data['brand']             = json_encode($this->input->post('brand'));
			}
            $this->db->where('sub_category_id', $para2);
            $this->db->update('sub_category', $data);
			
			if($_FILES['img']['name']!== ''){
				$path = $_FILES['img']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$data_banner['banner'] 		 = 'sub_category_'.$para2.'.'.$ext;
				$this->crud_model->file_up("img", "sub_category", $para2, '', 'no', '.'.$ext);
				$this->db->where('sub_category_id', $para2);
				$this->db->update('sub_category', $data_banner);
			}
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
			unlink("uploads/sub_category_image/" .$this->crud_model->get_type_name_by_id('sub_category',$para2,'banner'));
            $this->db->where('sub_category_id', $para2);
            $this->db->delete('sub_category');
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('sub_category_id', 'desc');
			$this->db->where('digital=',NULL);
            $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
            $this->load->view('back/admin/sub_category_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/sub_category_add');
        } else {
            $page_data['page_name']        = "sub_category";
            $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
	
	/*Digital Sub-category add, edit, view, delete */
    function sub_category_digital($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('sub_category_digital')) {
            redirect(base_url() . 'index.php/admin');
        }
		if ($this->crud_model->get_type_name_by_id('general_settings','69','value') !== 'ok') {
			redirect(base_url() . 'index.php/admin');
		}
        if ($para1 == 'do_add') {
            $data['sub_category_name'] = $this->input->post('sub_category_name');
            $data['category']          = $this->input->post('category');
			$data['digital']           = 'ok';
            $this->db->insert('sub_category', $data);
			$id = $this->db->insert_id();
			$path = $_FILES['img']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$data_banner['banner'] 		 = 'sub_category_'.$id.'.'.$ext;
            $this->crud_model->file_up("img", "sub_category", $id, '', 'no', '.'.$ext);
			$this->db->where('sub_category_id', $id);
            $this->db->update('sub_category', $data_banner);
			$this->crud_model->set_category_data(0);
			
            recache();
        } else if ($para1 == 'edit') {
            $page_data['sub_category_data'] = $this->db->get_where('sub_category', array(
                'sub_category_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/sub_category_edit_digital', $page_data);
        } elseif ($para1 == "update") {
            $data['sub_category_name'] = $this->input->post('sub_category_name');
            $data['category']          = $this->input->post('category');
            $this->db->where('sub_category_id', $para2);
            $this->db->update('sub_category', $data);
			
			if($_FILES['img']['name']!== ''){
				$path = $_FILES['img']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$data_banner['banner'] 		 = 'sub_category_'.$para2.'.'.$ext;
				$this->crud_model->file_up("img", "sub_category", $para2, '', 'no', '.'.$ext);
				$this->db->where('sub_category_id', $para2);
				$this->db->update('sub_category', $data_banner);
			}
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
			unlink("uploads/sub_category_image/" .$this->crud_model->get_type_name_by_id('sub_category',$para2,'banner'));
            $this->db->where('sub_category_id', $para2);
            $this->db->delete('sub_category');
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('sub_category_id', 'desc');
			$this->db->where('digital=','ok');
            $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
            $this->load->view('back/admin/sub_category_list_digital', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/sub_category_add_digital');
        } else {
            $page_data['page_name']        = "sub_category_digital";
			$this->db->where('digital=','ok');
            $page_data['all_sub_category'] = $this->db->get('sub_category')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /*Product Brand add, edit, view, delete */
    function brand($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('brand')) {
            redirect(base_url() . 'index.php/admin');
        }
		if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
			redirect(base_url() . 'index.php/admin');
		}
        if ($para1 == 'do_add') {
            $type                = 'brand';
            $data['name']        = $this->input->post('name');
            $this->db->insert('brand', $data);
            $id = $this->db->insert_id();
			
			$path = $_FILES['img']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$data_banner['logo'] 		 = 'brand_'.$id.'.'.$ext;
            $this->crud_model->file_up("img", "brand", $id, '', 'no', '.'.$ext);
			$this->db->where('brand_id', $id);
            $this->db->update('brand', $data_banner);
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == "update") {
            $data['name']        = $this->input->post('name');
            $this->db->where('brand_id', $para2);
            $this->db->update('brand', $data);
            if($_FILES['img']['name']!== ''){
				$path = $_FILES['img']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$data_logo['logo'] 		 = 'brand_'.$para2.'.'.$ext;
				$this->crud_model->file_up("img", "brand", $para2, '', 'no', '.'.$ext);
				$this->db->where('brand_id', $para2);
				$this->db->update('brand', $data_logo);
			}
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'delete') {
            unlink("uploads/brand_image/" .$this->crud_model->get_type_name_by_id('brand',$para2,'logo'));
            $this->db->where('brand_id', $para2);
            $this->db->delete('brand');
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'multi_delete') {
            $ids = explode('-', $param2);
            $this->crud_model->multi_delete('brand', $ids);
        } else if ($para1 == 'edit') {
            $page_data['brand_data'] = $this->db->get_where('brand', array(
                'brand_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/brand_edit', $page_data);
        } elseif ($para1 == 'list') {
            $this->db->order_by('brand_id', 'desc');
            $page_data['all_brands'] = $this->db->get('brand')->result_array();
            $this->load->view('back/admin/brand_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/brand_add');
        } else {
            $page_data['page_name']  = "brand";
            $page_data['all_brands'] = $this->db->get('brand')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /*Product coupon add, edit, view, delete */
    function coupon($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('coupon')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'do_add') {
            $data['title'] = $this->input->post('title');
            $data['code'] = $this->input->post('code');
            $data['till'] = $this->input->post('till');
            $data['status'] = 'ok';
            $data['added_by'] = json_encode(array('type'=>'admin','id'=>$this->session->userdata('admin_id')));
            $data['spec'] = json_encode(array(
                                'set_type'=>$this->input->post('set_type'),
                                'set'=>json_encode($this->input->post($this->input->post('set_type'))),
                                'discount_type'=>$this->input->post('discount_type'),
                                'discount_value'=>$this->input->post('discount_value'),
                                'shipping_free'=>$this->input->post('shipping_free')
                            ));
            $this->db->insert('coupon', $data);
        } else if ($para1 == 'edit') {
            $page_data['coupon_data'] = $this->db->get_where('coupon', array(
                'coupon_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/coupon_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['title'] = $this->input->post('title');
            $data['code'] = $this->input->post('code');
            $data['till'] = $this->input->post('till');
            $data['spec'] = json_encode(array(
                                'set_type'=>$this->input->post('set_type'),
                                'set'=>json_encode($this->input->post($this->input->post('set_type'))),
                                'discount_type'=>$this->input->post('discount_type'),
                                'discount_value'=>$this->input->post('discount_value'),
                                'shipping_free'=>$this->input->post('shipping_free')
                            ));
            $this->db->where('coupon_id', $para2);
            $this->db->update('coupon', $data);
        } elseif ($para1 == 'delete') {
            $this->db->where('coupon_id', $para2);
            $this->db->delete('coupon');
        } elseif ($para1 == 'list') {
            $this->db->order_by('coupon_id', 'desc');
            $page_data['all_coupons'] = $this->db->get('coupon')->result_array();
            $this->load->view('back/admin/coupon_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/coupon_add');
        } elseif ($para1 == 'publish_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('coupon_id', $product);
            $this->db->update('coupon', $data);
        } else {
            $page_data['page_name']      = "coupon";
            $page_data['all_coupons'] = $this->db->get('coupon')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /*Product Sale Comparison Reports*/
    function report($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('report')) {
            redirect(base_url() . 'index.php/admin');
        }
        $page_data['page_name'] = "report";
        $page_data['products']  = $this->db->get('product')->result_array();
        $this->load->view('back/index', $page_data);
    }
    
    /*Product Stock Comparison Reports*/
    function report_stock($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('report')) {
            redirect(base_url() . 'index.php/admin');
        }
		if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
			redirect(base_url() . 'index.php/admin');
		}
        $page_data['page_name'] = "report_stock";
        if ($this->input->post('product')) {
            $page_data['product_name'] = $this->crud_model->get_type_name_by_id('product', $this->input->post('product'), 'title');
            $page_data['product']      = $this->input->post('product');
        }
        $this->load->view('back/index', $page_data);
    }
    
    /*Product Wish Comparison Reports*/
    function report_wish($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('report')) {
            redirect(base_url() . 'index.php/admin');
        }
        $page_data['page_name'] = "report_wish";
        $this->load->view('back/index', $page_data);
    }
    
    /* Product add, edit, view, delete, stock increase, decrease, discount */
    function product($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('product')) {
            redirect(base_url() . 'index.php/admin');
        }
		if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
			redirect(base_url() . 'index.php/admin');
		}
        if ($para1 == 'do_add') {
            $options = array();
            if ($_FILES["images"]['name'][0] == '') {
                $num_of_imgs = 0;
            } else {
                $num_of_imgs = count($_FILES["images"]['name']);
            }
            $data['title']              = $this->input->post('title');
            $data['category']           = $this->input->post('category');
            $data['description']        = $this->input->post('description');
            $data['sub_category']       = $this->input->post('sub_category');
            $data['sale_price']         = $this->input->post('sale_price');
            $data['purchase_price']     = $this->input->post('purchase_price');
            $data['add_timestamp']      = time();
			$data['download']           = NULL;
			$data['featured']           = 'no';
            $data['status']             = 'ok';
            $data['rating_user']        = '[]';
            $data['tax']                = $this->input->post('tax');
            $data['discount']           = $this->input->post('discount');
            $data['discount_type']      = $this->input->post('discount_type');
            $data['tax_type']           = $this->input->post('tax_type');
            $data['shipping_cost']      = $this->input->post('shipping_cost');
            $data['tag']                = $this->input->post('tag');
            $data['color']              = json_encode($this->input->post('color'));
            $data['num_of_imgs']        = $num_of_imgs;
            $data['current_stock']      = $this->input->post('current_stock');
            $data['front_image']        = 0;
            $additional_fields['name']  = json_encode($this->input->post('ad_field_names'));
            $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
            $data['additional_fields']  = json_encode($additional_fields);
            $data['brand']              = $this->input->post('brand');
            $data['unit']               = $this->input->post('unit');
            $choice_titles              = $this->input->post('op_title');
            $choice_types               = $this->input->post('op_type');
            $choice_no                  = $this->input->post('op_no');
			$data['added_by']           = json_encode(array('type'=>'admin','id'=>$this->session->userdata('admin_id')));
			if(count($choice_titles ) > 0){
				foreach ($choice_titles as $i => $row) {
					$choice_options         = $this->input->post('op_set'.$choice_no[$i]);
					$options[]              =   array(
													'no' => $choice_no[$i],
													'title' => $choice_titles[$i],
													'name' => 'choice_'.$choice_no[$i],
													'type' => $choice_types[$i],
													'option' => $choice_options
												);
				}
			}
            $data['options']            = json_encode($options);
            $this->db->insert('product', $data);
            $id = $this->db->insert_id();
			$this->benchmark->mark_time();
            $this->crud_model->file_up("images", "product", $id, 'multi');
			$this->crud_model->set_category_data(0);
            recache();
        } else if ($para1 == "update") {
            $options = array();
            if ($_FILES["images"]['name'][0] == '') {
                $num_of_imgs = 0;
            } else {
                $num_of_imgs = count($_FILES["images"]['name']);
            }
            $num                        = $this->crud_model->get_type_name_by_id('product', $para2, 'num_of_imgs');
            $download                   = $this->crud_model->get_type_name_by_id('product', $para2, 'download');
            $data['title']              = $this->input->post('title');
            $data['category']           = $this->input->post('category');
            $data['description']        = $this->input->post('description');
            $data['sub_category']       = $this->input->post('sub_category');
            $data['sale_price']         = $this->input->post('sale_price');
            $data['purchase_price']     = $this->input->post('purchase_price');
            $data['tax']                = $this->input->post('tax');
            $data['discount']           = $this->input->post('discount');
            $data['discount_type']      = $this->input->post('discount_type');
            $data['tax_type']           = $this->input->post('tax_type');
            $data['shipping_cost']      = $this->input->post('shipping_cost');
            $data['tag']                = $this->input->post('tag');
            $data['color']              = json_encode($this->input->post('color'));
            $data['num_of_imgs']        = $num + $num_of_imgs;
            $data['front_image']        = 0;
            $additional_fields['name']  = json_encode($this->input->post('ad_field_names'));
            $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
            $data['additional_fields']  = json_encode($additional_fields);
            $data['brand']              = $this->input->post('brand');
            $data['unit']               = $this->input->post('unit');
            $choice_titles              = $this->input->post('op_title');
            $choice_types               = $this->input->post('op_type');
            $choice_no                  = $this->input->post('op_no');
			if(count($choice_titles ) > 0){
				foreach ($choice_titles as $i => $row) {
					$choice_options         = $this->input->post('op_set'.$choice_no[$i]);
					$options[]              =   array(
													'no' => $choice_no[$i],
													'title' => $choice_titles[$i],
													'name' => 'choice_'.$choice_no[$i],
													'type' => $choice_types[$i],
													'option' => $choice_options
												);
				}
			}
            $data['options']            = json_encode($options);
            $this->crud_model->file_up("images", "product", $para2, 'multi');
            
            $this->db->where('product_id', $para2);
            $this->db->update('product', $data);
			$this->crud_model->set_category_data(0);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['product_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/product_edit', $page_data);
        } else if ($para1 == 'view') {
            $page_data['product_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/product_view', $page_data);
        } elseif ($para1 == 'delete') {
            $this->crud_model->file_dlt('product', $para2, '.jpg', 'multi');
            $this->db->where('product_id', $para2);
            $this->db->delete('product');
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('product_id', 'desc');
			$this->db->where('download=',NULL);
            $page_data['all_product'] = $this->db->get('product')->result_array();
            $this->load->view('back/admin/product_list', $page_data);
        } elseif ($para1 == 'list_data') {
            $limit      = $this->input->get('limit');
            $search     = $this->input->get('search');
            $order      = $this->input->get('order');
            $offset     = $this->input->get('offset');
            $sort       = $this->input->get('sort');
            if($search){
                $this->db->like('title', $search, 'both');
            }
			$this->db->where('download=',NULL);
            $total      = $this->db->get('product')->num_rows();
            $this->db->limit($limit);
			if($sort == ''){
				$sort = 'product_id';
				$order = 'DESC';
			}
            $this->db->order_by($sort,$order);
            if($search){
                $this->db->like('title', $search, 'both');
            }
			$this->db->where('download=',NULL);
            $products   = $this->db->get('product', $limit, $offset)->result_array();
            $data       = array();
            foreach ($products as $row) {

                $res    = array(
                             'image' => '',
                             'title' => '',
                             'current_stock' => '',
                             'deal' => '',
                             'publish' => '',
                             'featured' => '',
                             'options' => ''
                          );

                $res['image']  = '<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="'.$this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one').'"  />';
                $res['title']  = $row['title'];
                if($row['status'] == 'ok'){
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                if($row['current_stock'] > 0){ 
                    $res['current_stock']  = $row['current_stock'].$row['unit'].'(s)';                     
                } else {
                    $res['current_stock']  = '<span class="label label-danger">'.translate('out_of_stock').'</span>';
                }
                if($row['deal'] == 'ok'){
                    $res['deal']  = '<input id="deal_'.$row['product_id'].'" class="sw3" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['deal']  = '<input id="deal_'.$row['product_id'].'" class="sw3" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                if($row['featured'] == 'ok'){
                    $res['featured'] = '<input id="fet_'.$row['product_id'].'" class="sw2" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['featured'] = '<input id="fet_'.$row['product_id'].'" class="sw2" type="checkbox" data-id="'.$row['product_id'].'" />';
                }

                //add html for action
                $res['options'] = "  <a class=\"btn btn-info btn-xs btn-labeled fa fa-location-arrow\" data-toggle=\"tooltip\" 
                                onclick=\"ajax_set_full('view','".translate('view_product')."','".translate('successfully_viewed!')."','product_view','".$row['product_id']."');proceed('to_list');\" data-original-title=\"View\" data-container=\"body\">
                                    ".translate('view')."
                            </a>
                            <a class=\"btn btn-purple btn-xs btn-labeled fa fa-tag\" data-toggle=\"tooltip\"
                                onclick=\"ajax_modal('add_discount','".translate('view_discount')."','".translate('viewing_discount!')."','add_discount','".$row['product_id']."')\" data-original-title=\"Edit\" data-container=\"body\">
                                    ".translate('discount')."
                            </a>
                            <a class=\"btn btn-mint btn-xs btn-labeled fa fa-plus-square\" data-toggle=\"tooltip\" 
                                onclick=\"ajax_modal('add_stock','".translate('add_product_quantity')."','".translate('quantity_added!')."','stock_add','".$row['product_id']."')\" data-original-title=\"Edit\" data-container=\"body\">
                                    ".translate('stock')."
                            </a>
                            <a class=\"btn btn-dark btn-xs btn-labeled fa fa-minus-square\" data-toggle=\"tooltip\" 
                                onclick=\"ajax_modal('destroy_stock','".translate('reduce_product_quantity')."','".translate('quantity_reduced!')."','destroy_stock','".$row['product_id']."')\" data-original-title=\"Edit\" data-container=\"body\">
                                    ".translate('destroy')."
                            </a>
                            
                            <a class=\"btn btn-success btn-xs btn-labeled fa fa-wrench\" data-toggle=\"tooltip\" 
                                onclick=\"ajax_set_full('edit','".translate('edit_product')."','".translate('successfully_edited!')."','product_edit','".$row['product_id']."');proceed('to_list');\" data-original-title=\"Edit\" data-container=\"body\">
                                    ".translate('edit')."
                            </a>
                            
                            <a onclick=\"delete_confirm('".$row['product_id']."','".translate('really_want_to_delete_this?')."')\" 
                                class=\"btn btn-danger btn-xs btn-labeled fa fa-trash\" data-toggle=\"tooltip\" data-original-title=\"Delete\" data-container=\"body\">
                                    ".translate('delete')."
                            </a>";
                $data[] = $res;
            }
            $result = array(
                             'total' => $total,
                             'rows' => $data
                           );

            echo json_encode($result);

        } else if ($para1 == 'dlt_img') {
            $a = explode('_', $para2);
            $this->crud_model->file_dlt('product', $a[0], '.jpg', 'multi', $a[1]);
            recache();
        } elseif ($para1 == 'sub_by_cat') {
            echo $this->crud_model->select_html('sub_category', 'sub_category', 'sub_category_name', 'add', 'demo-chosen-select required', '', 'category', $para2, 'get_brnd');
        } elseif ($para1 == 'brand_by_sub') {
			$brands=json_decode($this->crud_model->get_type_name_by_id('sub_category',$para2,'brand'),true);
			if(empty($brands)){
				echo translate("No brands are available for this sub category");
			} else {
            	echo $this->crud_model->select_html('brand', 'brand', 'name', 'add', 'demo-chosen-select required', '', 'brand_id', $brands, '', 'multi');
			}
        } elseif ($para1 == 'product_by_sub') {
            echo $this->crud_model->select_html('product', 'product', 'title', 'add', 'demo-chosen-select required', '', 'sub_category', $para2, 'get_pro_res');
        } elseif ($para1 == 'pur_by_pro') {
            echo $this->crud_model->get_type_name_by_id('product', $para2, 'purchase_price');
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/product_add');
        } elseif ($para1 == 'add_stock') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_stock_add', $data);
        } elseif ($para1 == 'destroy_stock') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_stock_destroy', $data);
        } elseif ($para1 == 'stock_report') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_stock_report', $data);
        } elseif ($para1 == 'sale_report') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_sale_report', $data);
        } elseif ($para1 == 'add_discount') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_add_discount', $data);
        } elseif ($para1 == 'product_featured_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['featured'] = 'ok';
            } else {
                $data['featured'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'product_deal_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['deal'] = 'ok';
            } else {
                $data['deal'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'product_publish_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'add_discount_set') {
            $product               = $this->input->post('product');
            $data['discount']      = $this->input->post('discount');
            $data['discount_type'] = $this->input->post('discount_type');
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
			$this->crud_model->set_category_data(0);
            recache();
        } else {
            $page_data['page_name']   = "product";
            $page_data['all_product'] = $this->db->get('product')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
	
	/* Digital add, edit, view, delete, stock increase, decrease, discount */
    function digital($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('product')) {
            redirect(base_url() . 'index.php/admin');
        }
		if ($this->crud_model->get_type_name_by_id('general_settings','69','value') !== 'ok') {
			redirect(base_url() . 'index.php/admin');
		}
        if ($para1 == 'do_add') {
            if ($_FILES["images"]['name'][0] == '') {
                $num_of_imgs = 0;
            } else {
                $num_of_imgs = count($_FILES["images"]['name']);
            }
            $data['title']              = $this->input->post('title');
            $data['category']           = $this->input->post('category');
            $data['description']        = $this->input->post('description');
            $data['sub_category']       = $this->input->post('sub_category');
            $data['sale_price']         = $this->input->post('sale_price');
            $data['purchase_price']     = $this->input->post('purchase_price');
            $data['add_timestamp']      = time();
            $data['featured']           = 'no';
            $data['status']             = 'ok';
            $data['rating_user']        = '[]';
            $data['tax']                = $this->input->post('tax');
            $data['discount']           = $this->input->post('discount');
            $data['discount_type']      = $this->input->post('discount_type');
            $data['tax_type']           = $this->input->post('tax_type');
            $data['shipping_cost']      = 0;
            $data['tag']                = $this->input->post('tag');
            $data['num_of_imgs']        = $num_of_imgs;
            $data['front_image']        = $this->input->post('front_image');
            $additional_fields['name']  = json_encode($this->input->post('ad_field_names'));
            $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
            $data['additional_fields']  = json_encode($additional_fields);
			$data['requirements']		=	'[]';
			$data['video']				=	'[]';
            
			$data['added_by']           = json_encode(array('type'=>'admin','id'=>$this->session->userdata('admin_id')));
			
            $this->db->insert('product', $data);
            $id = $this->db->insert_id();
			$this->benchmark->mark_time();
			
            $this->crud_model->file_up("images", "product", $id, 'multi');
			
			$path = $_FILES['logo']['name'];
			$ext = pathinfo($path, PATHINFO_EXTENSION);
			$data_logo['logo'] 		 = 'digital_logo_'.$id.'.'.$ext;
			$this->db->where('product_id' , $id);
			$this->db->update('product' , $data_logo);
			$this->crud_model->file_up("logo", "digital_logo", $id, '','no','.'.$ext);
			
			//Requirements add
			$requirements				=	array();
			$req_title					=	$this->input->post('req_title');
			$req_desc					=	$this->input->post('req_desc');
			if(!empty($req_title)){
				foreach($req_title as $i => $row){
					$requirements[]			=	array('index'=>$i,'field'=>$row,'desc'=>$req_desc[$i]);
				}
			}
			
			$data_req['requirements']			=	json_encode($requirements);
			$this->db->where('product_id' , $id);
			$this->db->update('product' , $data_req);
			
			//File upload
			$rand           = substr(hash('sha512', rand()), 0, 20);
			$name           = $id.'_'.$rand.'_'.$_FILES['product_file']['name'];
			$da['download_name'] = $name;
			$da['download'] = 'ok';
			$folder = $this->db->get_where('general_settings', array('type' => 'file_folder'))->row()->value;
			move_uploaded_file($_FILES['product_file']['tmp_name'], 'uploads/file_products/' . $folder .'/' . $name);
            $this->db->where('product_id', $id);
            $this->db->update('product', $da);
			
			//vdo upload
			$video_details				=	array();
			if($this->input->post('upload_method') == 'upload'){				
				$video 				= 	$_FILES['videoFile']['name'];
				$ext   				= 	pathinfo($video,PATHINFO_EXTENSION);
				move_uploaded_file($_FILES['videoFile']['tmp_name'],'uploads/video_digital_product/digital_'.$id.'.'.$ext);
				$video_src 			= 	'uploads/video_digital_product/digital_'.$id.'.'.$ext;
				$video_details[] 	= 	array('type'=>'upload','from'=>'local','video_link'=>'','video_src'=>$video_src);
				$data_vdo['video']	=	json_encode($video_details);
				$this->db->where('product_id',$id);
				$this->db->update('product',$data_vdo);		
			}
			elseif ($this->input->post('upload_method') == 'share'){
				$from 				= $this->input->post('site');
				$video_link 		= $this->input->post('video_link');
				$code				= $this->input->post('video_code');
				if($from=='youtube'){
					$video_src  	= 'https://www.youtube.com/embed/'.$code;
				}else if($from=='dailymotion'){
					$video_src   	= '//www.dailymotion.com/embed/video/'.$code;
				}else if($from=='vimeo'){
					$video_src   	= 'https://player.vimeo.com/video/'.$code;
				}
				$video_details[] 	= 	array('type'=>'share','from'=>$from,'video_link'=>$video_link,'video_src'=>$video_src);
				$data_vdo['video']	=	json_encode($video_details);
				$this->db->where('product_id',$id);
				$this->db->update('product',$data_vdo);	
			}
			$this->crud_model->set_category_data(0);
            recache();
        } else if ($para1 == "update") {
            $options = array();
            if ($_FILES["images"]['name'][0] == '') {
                $num_of_imgs = 0;
            } else {
                $num_of_imgs = count($_FILES["images"]['name']);
            }
            $num                        = $this->crud_model->get_type_name_by_id('product', $para2, 'num_of_imgs');
            $download                   = $this->crud_model->get_type_name_by_id('product', $para2, 'download');
            $data['title']              = $this->input->post('title');
            $data['category']           = $this->input->post('category');
            $data['description']        = $this->input->post('description');
            $data['sub_category']       = $this->input->post('sub_category');
            $data['sale_price']         = $this->input->post('sale_price');
            $data['purchase_price']     = $this->input->post('purchase_price');
            $data['tax']                = $this->input->post('tax');
            $data['discount']           = $this->input->post('discount');
            $data['discount_type']      = $this->input->post('discount_type');
            $data['tax_type']           = $this->input->post('tax_type');
            $data['tag']                = $this->input->post('tag');
			$data['update_time']        = time();
            $data['num_of_imgs']        = $num + $num_of_imgs;
            $data['front_image']        = $this->input->post('front_image');
            $additional_fields['name']  = json_encode($this->input->post('ad_field_names'));
            $additional_fields['value'] = json_encode($this->input->post('ad_field_values'));
            $data['additional_fields']  = json_encode($additional_fields);
			
			//File upload
            $this->crud_model->file_up("images", "product", $para2, 'multi');
            if($_FILES['product_file']['name'] !== ''){
                $rand           = substr(hash('sha512', rand()), 0, 20);
                $name           = $para2.'_'.$rand.'_'.$_FILES['product_file']['name'];
                $data['download_name'] = $name;
                $folder = $this->db->get_where('general_settings', array('type' => 'file_folder'))->row()->value;
                move_uploaded_file($_FILES['product_file']['tmp_name'], 'uploads/file_products/' . $folder .'/' . $name);
            }
			
            $this->db->where('product_id', $para2);
            $this->db->update('product', $data);
			
			if($_FILES['logo']['name'] !== ''){
                $path = $_FILES['logo']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$data_logo['logo'] 		 = 'digital_logo_'.$para2.'.'.$ext;
				$this->db->where('product_id' , $para2);
				$this->db->update('product' , $data_logo);
				$this->crud_model->file_up("logo", "digital_logo", $para2, '','no','.'.$ext);
            }
			
			//Requirements add
			$requirements				=	array();
			$req_title					=	$this->input->post('req_title');
			$req_desc					=	$this->input->post('req_desc');
			if(!empty($req_title)){
				foreach($req_title as $i => $row){
					$requirements[]			=	array('index'=>$i,'field'=>$row,'desc'=>$req_desc[$i]);
				}
			}
			$data_req['requirements']			=	json_encode($requirements);
			$this->db->where('product_id' , $para2);
			$this->db->update('product' , $data_req);
			
			//vdo upload
			$video_details				=	array();
			if($this->input->post('upload_method') == 'upload'){				
				$video 				= 	$_FILES['videoFile']['name'];
				$ext   				= 	pathinfo($video,PATHINFO_EXTENSION);
				move_uploaded_file($_FILES['videoFile']['tmp_name'],'uploads/video_digital_product/digital_'.$para2.'.'.$ext);
				$video_src 			= 	'uploads/video_digital_product/digital_'.$para2.'.'.$ext;
				$video_details[] 	= 	array('type'=>'upload','from'=>'local','video_link'=>'','video_src'=>$video_src);
				$data_vdo['video']	=	json_encode($video_details);
				$this->db->where('product_id',$para2);
				$this->db->update('product',$data_vdo);		
			}
			elseif ($this->input->post('upload_method') == 'share'){
				$video= json_decode($this->crud_model->get_type_name_by_id('product',$para2,'video'),true);
				if($video[0]['type'] == 'upload'){
					if(file_exists($video[0]['video_src'])){
						unlink($video[0]['video_src']);			
					}
				}
				$from 				= $this->input->post('site');
				$video_link 		= $this->input->post('video_link');
				$code				= $this->input->post('video_code');
				if($from=='youtube'){
					$video_src  	= 'https://www.youtube.com/embed/'.$code;
				}else if($from=='dailymotion'){
					$video_src   	= '//www.dailymotion.com/embed/video/'.$code;
				}else if($from=='vimeo'){
					$video_src   	= 'https://player.vimeo.com/video/'.$code;
				}
				$video_details[] 	= 	array('type'=>'share','from'=>$from,'video_link'=>$video_link,'video_src'=>$video_src);
				$data_vdo['video']	=	json_encode($video_details);
				$this->db->where('product_id',$para2);
				$this->db->update('product',$data_vdo);	
			}
			elseif ($this->input->post('upload_method') == 'delete'){
				$data_vdo['video']	=	'[]';
				$this->db->where('product_id',$para2);
				$this->db->update('product',$data_vdo);
				
				$video= json_decode($this->crud_model->get_type_name_by_id('product',$para2,'video'),true);
				if($video[0]['type'] == 'upload'){
					if(file_exists($video[0]['video_src'])){
						unlink($video[0]['video_src']);			
					}
				}
			}
			
			$this->crud_model->set_category_data(0);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['product_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/digital_edit', $page_data);
        } else if ($para1 == 'view') {
            $page_data['product_data'] = $this->db->get_where('product', array(
                'product_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/digital_view', $page_data);
        } else if ($para1 == 'download_file') {
            $this->crud_model->download_product($para2);
        } else if ($para1 == 'can_download') {
            if($this->crud_model->can_download($para2)){
				echo "yes";
			} else{
				echo "no";
			}
        } elseif ($para1 == 'delete') {
            $this->crud_model->file_dlt('product', $para2, '.jpg', 'multi');
			unlink("uploads/digital_logo_image/" .$this->crud_model->get_type_name_by_id('product',$para2,'logo'));
			$video=$this->crud_model->get_type_name_by_id('product',$para2,'video');
			if($video!=='[]'){
				$video_details= json_decode($video,true);
				if($video_details[0]['type'] == 'upload'){
					if(file_exists($video_details[0]['video_src'])){
						unlink($video_details[0]['video_src']);			
					}
				}
			}
            $this->db->where('product_id', $para2);
            $this->db->delete('product');
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('product_id', 'desc');
			$this->db->where('download=','ok');
            $page_data['all_product'] = $this->db->get('product')->result_array();
            $this->load->view('back/admin/digital_list', $page_data);
        } elseif ($para1 == 'list_data') {
            $limit      = $this->input->get('limit');
            $search     = $this->input->get('search');
            $order      = $this->input->get('order');
            $offset     = $this->input->get('offset');
            $sort       = $this->input->get('sort');
            if($search){
                $this->db->like('title', $search, 'both');
            }
			$this->db->where('download=','ok');
            $total= $this->db->get('product')->num_rows();
            $this->db->limit($limit);
			if($sort == ''){
				$sort = 'product_id';
				$order = 'DESC';
			}
            $this->db->order_by($sort,$order);
            if($search){
                $this->db->like('title', $search, 'both');
            }
			$this->db->where('download=','ok');
            $products   = $this->db->get('product', $limit, $offset)->result_array();
            $data       = array();
            foreach ($products as $row) {

                $res    = array(
                             'image' => '',
                             'title' => '',
                             'deal' => '',
                             'publish' => '',
                             'featured' => '',
                             'options' => ''
                          );

                $res['image']  = '<img class="img-sm" style="height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="'.$this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','one').'"  />';
                $res['title']  = $row['title'];
                if($row['status'] == 'ok'){
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['publish']  = '<input id="pub_'.$row['product_id'].'" class="sw1" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                if($row['deal'] == 'ok'){
                    $res['deal']  = '<input id="deal_'.$row['product_id'].'" class="sw3" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['deal']  = '<input id="deal_'.$row['product_id'].'" class="sw3" type="checkbox" data-id="'.$row['product_id'].'" />';
                }
                if($row['featured'] == 'ok'){
                    $res['featured'] = '<input id="fet_'.$row['product_id'].'" class="sw2" type="checkbox" data-id="'.$row['product_id'].'" checked />';
                } else {
                    $res['featured'] = '<input id="fet_'.$row['product_id'].'" class="sw2" type="checkbox" data-id="'.$row['product_id'].'" />';
                }

                //add html for action
                $res['options'] = "  <a class=\"btn btn-info btn-xs btn-labeled fa fa-location-arrow\" data-toggle=\"tooltip\" 
                                onclick=\"ajax_set_full('view','".translate('view_product')."','".translate('successfully_viewed!')."','digital_view','".$row['product_id']."');proceed('to_list');\" data-original-title=\"View\" data-container=\"body\">
                                    ".translate('view')."
                            </a>
                            <a class=\"btn btn-purple btn-xs btn-labeled fa fa-tag\" data-toggle=\"tooltip\"
                                onclick=\"ajax_modal('add_discount','".translate('view_discount')."','".translate('viewing_discount!')."','add_discount','".$row['product_id']."')\" data-original-title=\"Edit\" data-container=\"body\">
                                    ".translate('discount')."
                            </a>
                            <a class=\"btn btn-mint btn-xs btn-labeled fa fa-download\" data-toggle=\"tooltip\" 
                                onclick=\"digital_download(".$row['product_id'].")\" data-original-title=\"Download\" data-container=\"body\">
                                    ".translate('download')."
                            </a>
                            
                            <a class=\"btn btn-success btn-xs btn-labeled fa fa-wrench\" data-toggle=\"tooltip\" 
                                onclick=\"ajax_set_full('edit','".translate('edit_product_(_digital_product_)')."','".translate('successfully_edited!')."','digital_edit','".$row['product_id']."');proceed('to_list');\" data-original-title=\"Edit\" data-container=\"body\">
                                    ".translate('edit')."
                            </a>
                            
                            <a onclick=\"delete_confirm('".$row['product_id']."','".translate('really_want_to_delete_this?')."')\" 
                                class=\"btn btn-danger btn-xs btn-labeled fa fa-trash\" data-toggle=\"tooltip\" data-original-title=\"Delete\" data-container=\"body\">
                                    ".translate('delete')."
                            </a>";
                $data[] = $res;
            }
            $result = array(
                             'total' => $total,
                             'rows' => $data
                           );

            echo json_encode($result);

        } else if ($para1 == 'dlt_img') {
            $a = explode('_', $para2);
            $this->crud_model->file_dlt('product', $a[0], '.jpg', 'multi', $a[1]);
            recache();
        } elseif ($para1 == 'sub_by_cat') {
            echo $this->crud_model->select_html('sub_category', 'sub_category', 'sub_category_name', 'add', 'demo-chosen-select required', '', 'category', $para2, '');
        } elseif ($para1 == 'product_by_sub') {
            echo $this->crud_model->select_html('product', 'product', 'title', 'add', 'demo-chosen-select required', '', 'sub_category', $para2, 'get_pro_res');
        } 
		elseif ($para1 == 'pur_by_pro') {
            echo $this->crud_model->get_type_name_by_id('product', $para2, 'purchase_price');
        }elseif ($para1 == 'add') {
            $this->load->view('back/admin/digital_add');
        } elseif ($para1 == 'sale_report') {
            $data['product'] = $para2;
            $this->load->view('back/admin/product_sale_report', $data);
        } elseif ($para1 == 'add_discount') {
            $data['product'] = $para2;
            $this->load->view('back/admin/digital_add_discount', $data);
        } elseif ($para1 == 'product_featured_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['featured'] = 'ok';
            } else {
                $data['featured'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'product_deal_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['deal'] = 'ok';
            } else {
                $data['deal'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
            recache();
        } elseif ($para1 == 'product_publish_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
			$this->crud_model->set_category_data(0);
            recache();
        } elseif ($para1 == 'add_discount_set') {
            $product               = $this->input->post('product');
            $data['discount']      = $this->input->post('discount');
            $data['discount_type'] = $this->input->post('discount_type');
            $this->db->where('product_id', $product);
            $this->db->update('product', $data);
			$this->crud_model->set_category_data(0);
            recache();
        }elseif ($para1 == 'video_preview') {
			if($para2 == 'youtube'){
				echo '<iframe width="400" height="300" src="https://www.youtube.com/embed/'.$para3.'" frameborder="0"></iframe>';
			}else if($para2 == 'dailymotion'){
				echo '<iframe width="400" height="300" src="//www.dailymotion.com/embed/video/'.$para3.'" frameborder="0"></iframe>';
			}else if($para2 == 'vimeo'){
				echo '<iframe src="https://player.vimeo.com/video/'.$para3.'" width="400" height="300" frameborder="0"></iframe>';
			}
		}else {
            $page_data['page_name']   = "digital";
            $this->db->order_by('product_id', 'desc');
			$this->db->where('download=','ok');
            $page_data['all_product'] = $this->db->get('product')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /* Product Stock add, edit, view, delete, stock increase, decrease, discount */
    function stock($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('stock')) {
            redirect(base_url() . 'index.php/admin');
        }
		if ($this->crud_model->get_type_name_by_id('general_settings','68','value') !== 'ok') {
			redirect(base_url() . 'index.php/admin');
		}
        if ($para1 == 'do_add') {
            $data['type']         = 'add';
            $data['category']     = $this->input->post('category');
            $data['sub_category'] = $this->input->post('sub_category');
            $data['product']      = $this->input->post('product');
            $data['quantity']     = $this->input->post('quantity');
            $data['rate']         = $this->input->post('rate');
            $data['total']        = $this->input->post('total');
            $data['reason_note']  = $this->input->post('reason_note');
            $data['datetime']     = time();
            $this->db->insert('stock', $data);
            $prev_quantity          = $this->crud_model->get_type_name_by_id('product', $data['product'], 'current_stock');
            $data1['current_stock'] = $prev_quantity + $data['quantity'];
            $this->db->where('product_id', $data['product']);
            $this->db->update('product', $data1);
            recache();
        } else if ($para1 == 'do_destroy') {
            $data['type']         = 'destroy';
            $data['category']     = $this->input->post('category');
            $data['sub_category'] = $this->input->post('sub_category');
            $data['product']      = $this->input->post('product');
            $data['quantity']     = $this->input->post('quantity');
            $data['total']        = $this->input->post('total');
            $data['reason_note']  = $this->input->post('reason_note');
            $data['datetime']     = time();
            $this->db->insert('stock', $data);
            $prev_quantity = $this->crud_model->get_type_name_by_id('product', $data['product'], 'current_stock');
            $current       = $prev_quantity - $data['quantity'];
            if ($current <= 0) {
                $current = 0;
            }
            $data1['current_stock'] = $current;
            $this->db->where('product_id', $data['product']);
            $this->db->update('product', $data1);
            recache();
        } elseif ($para1 == 'delete') {
            $quantity = $this->crud_model->get_type_name_by_id('stock', $para2, 'quantity');
            $product  = $this->crud_model->get_type_name_by_id('stock', $para2, 'product');
            $type     = $this->crud_model->get_type_name_by_id('stock', $para2, 'type');
            if ($type == 'add') {
                $this->crud_model->decrease_quantity($product, $quantity);
            } else if ($type == 'destroy') {
                $this->crud_model->increase_quantity($product, $quantity);
            }
            $this->db->where('stock_id', $para2);
            $this->db->delete('stock');
            recache();
        } elseif ($para1 == 'list') {
            $this->db->order_by('stock_id', 'desc');
            $page_data['all_stock'] = $this->db->get('stock')->result_array();
            $this->load->view('back/admin/stock_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/stock_add');
        } elseif ($para1 == 'destroy') {
            $this->load->view('back/admin/stock_destroy');
        } elseif ($para1 == 'sub_by_cat') {
            echo $this->crud_model->select_html('sub_category', 'sub_category', 'sub_category_name', 'add', 'demo-chosen-select required', '', 'category', $para2, 'get_product');
        }elseif ($para1 == 'pro_by_sub') {
            echo $this->crud_model->select_html('product', 'product', 'title', 'add', 'demo-chosen-select required', '', 'sub_category', $para2,'get_pro_res');
        }else {
            $page_data['page_name'] = "stock";
            $page_data['all_stock'] = $this->db->get('stock')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /*Frontend Banner Management */
    function banner($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('banner')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == "set") {
            $data['link']   = $this->input->post('link');
            $data['status'] = $this->input->post('status');
			if($_FILES['img']['name'] !== ''){
                $path = $_FILES['img']['name'];
				$ext = pathinfo($path, PATHINFO_EXTENSION);
				$data['image_ext'] 		 = '.'.$ext;
				$this->crud_model->file_up("img", "banner", $para2, '','','.'.$ext);
            }
            $this->db->where('banner_id', $para2);
            $this->db->update('banner', $data);
            $this->crud_model->file_up("img", "banner", $para2);
            recache();
        } else if ($para1 == 'banner_publish_set') {
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else if ($para3 == 'false') {
                $data['status'] = '0';
            }
            $this->db->where('banner_id', $para2);
            $this->db->update('banner', $data);
            recache();
        }
    }
    
    /* Managing sales by users */
    function sales($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('sale')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'delete') {
            $carted = $this->db->get_where('stock', array(
                'sale_id' => $para2
            ))->result_array();
            foreach ($carted as $row2) {
                $this->stock('delete', $row2['stock_id']);
            }
            $this->db->where('sale_id', $para2);
            $this->db->delete('sale');
        } elseif ($para1 == 'list') {
            $all = $this->db->get_where('sale',array('payment_type' => 'go'))->result_array();
            foreach ($all as $row) {
                if((time()-$row['sale_datetime']) > 600){
                    $this->db->where('sale_id', $row['sale_id']);
                    $this->db->delete('sale');
                }
            }
            $this->db->order_by('sale_id', 'desc');
            $page_data['all_sales'] = $this->db->get('sale')->result_array();
            $this->load->view('back/admin/sales_list', $page_data);
        } elseif ($para1 == 'view') {
            $data['viewed'] = 'ok';
            $this->db->where('sale_id', $para2);
            $this->db->update('sale', $data);
            $page_data['sale'] = $this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/sales_view', $page_data);
        } elseif ($para1 == 'send_invoice') {
            $page_data['sale'] = $this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->result_array();
            $text              = $this->load->view('back/includes_top', $page_data);
            $text .= $this->load->view('back/admin/sales_view', $page_data);
            $text .= $this->load->view('back/includes_bottom', $page_data);
        } elseif ($para1 == 'delivery_payment') {
            $data['viewed'] = 'ok';
            $this->db->where('sale_id', $para2);
            $this->db->update('sale', $data);
            $page_data['sale_id']         = $para2;
            $page_data['payment_type']    = $this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->payment_type;
            $page_data['payment_details'] = $this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->payment_details;
            $delivery_status = json_decode($this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->delivery_status,true);
            foreach ($delivery_status as $row) {
                if(isset($row['admin'])){
                    $page_data['delivery_status'] = $row['status'];
                }
				else{
                    $page_data['delivery_status'] = '';
				}
            }
            $payment_status = json_decode($this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->payment_status,true);
            foreach ($payment_status as $row) {
                if(isset($row['admin'])){
                    $page_data['payment_status'] = $row['status'];
                }
				else{
                    $page_data['payment_status'] = '';
				}
            }
            
            $this->load->view('back/admin/sales_delivery_payment', $page_data);
        } elseif ($para1 == 'delivery_payment_set') {
            $delivery_status = json_decode($this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->delivery_status,true);
            $new_delivery_status = array();
            foreach ($delivery_status as $row) {
                if(isset($row['admin'])){
                    $new_delivery_status[] = array('admin'=>'','status'=>$this->input->post('delivery_status'),'delivery_time'=>$row['delivery_time']);
                } else {
                    $new_delivery_status[] = array('vendor'=>$row['vendor'],'status'=>$row['status'],'delivery_time'=>$row['delivery_time']);
                }
            }
            $payment_status = json_decode($this->db->get_where('sale', array(
                'sale_id' => $para2
            ))->row()->payment_status,true);
            $new_payment_status = array();
            foreach ($payment_status as $row) {
                if(isset($row['admin'])) {
                    $new_payment_status[] = array('admin'=>'','status'=>$this->input->post('payment_status'));
                } else {
                    $new_payment_status[] = array('vendor'=>$row['vendor'],'status'=>$row['status']);
                }
            }
            $data['payment_status']  = json_encode($new_payment_status);
            $data['delivery_status'] = json_encode($new_delivery_status);
            $data['payment_details'] = $this->input->post('payment_details');
            $this->db->where('sale_id', $para2);
            $this->db->update('sale', $data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/sales_add');
        } elseif ($para1 == 'total') {
            echo $this->db->get('sale')->num_rows();
        } else {
            $page_data['page_name']      = "sales";
            $page_data['all_categories'] = $this->db->get('sale')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /*User Management */
    function user($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('user')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'do_add') {
            $data['username']    = $this->input->post('user_name');
            $data['description'] = $this->input->post('description');
            $this->db->insert('user', $data);
        } else if ($para1 == 'edit') {
            $page_data['user_data'] = $this->db->get_where('user', array(
                'user_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/user_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['username']    = $this->input->post('username');
            $data['description'] = $this->input->post('description');
            $this->db->where('user_id', $para2);
            $this->db->update('user', $data);
        } elseif ($para1 == 'delete') {
            $this->db->where('user_id', $para2);
            $this->db->delete('user');
        } elseif ($para1 == 'list') {
            $this->db->order_by('user_id', 'desc');
            $page_data['all_users'] = $this->db->get('user')->result_array();
            $this->load->view('back/admin/user_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['user_data'] = $this->db->get_where('user', array(
                'user_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/user_view', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/user_add');
        } else {
            $page_data['page_name'] = "user";
            $page_data['all_users'] = $this->db->get('user')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /* membership_payment Management */
    function membership_payment($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('membership_payment') || $this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'delete') {
            $this->db->where('membership_payment_id', $para2);
            $this->db->delete('membership_payment');
        } else if ($para1 == 'list') {
            $this->db->order_by('membership_payment_id', 'desc');
            $page_data['all_membership_payments'] = $this->db->get('membership_payment')->result_array();
            $this->load->view('back/admin/membership_payment_list', $page_data);
        } else if ($para1 == 'view') {
            $page_data['membership_payment_data'] = $this->db->get_where('membership_payment', array(
                'membership_payment_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/membership_payment_view', $page_data);
        } elseif ($para1 == 'upgrade') {
            if($this->input->post('status')){
                $membership = $this->db->get_where('membership_payment',array('membership_payment_id'=>$para2))->row()->membership;
                $vendor = $this->db->get_where('membership_payment',array('membership_payment_id'=>$para2))->row()->vendor;
                $data['status'] = $this->input->post('status');
                $data['details'] = $this->input->post('details');
                if($data['status'] == 'paid'){
                    $this->crud_model->upgrade_membership($vendor,$membership);
                }
                
                $this->db->where('membership_payment_id', $para2);
                $this->db->update('membership_payment', $data);
            }
        } else {
            $page_data['page_name'] = "membership_payment";
            $page_data['all_membership_payments'] = $this->db->get('membership_payment')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }

    /* Vendor Management */
    function vendor($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('vendor') || $this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
            redirect(base_url() . 'index.php/admin');
        }

        if ($para1 == 'delete') {
            /* delete vendor products start */
            $this->db->where('added_by',json_encode(array('type'=>'vendor','id'=>$para2)));
            $products = $this->db->get('product')->result_array();
            $ids= array();
            foreach($products as $row){
                $this->crud_model->file_dlt('product',$row['product_id'], '.jpg', 'multi');
                $this->db->where('product_id', $row['product_id']);
                $this->db->delete('product');
            }
            $this->crud_model->set_category_data(0);
            /* delete vendor products end */

			$this->db->where('vendor_id', $para2);
            $this->db->delete('vendor');
			
            recache();
        } else if ($para1 == 'list') {
            $this->db->order_by('vendor_id', 'desc');
            $page_data['all_vendors'] = $this->db->get('vendor')->result_array();
            $this->load->view('back/admin/vendor_list', $page_data);
        } else if ($para1 == 'view') {
            $page_data['vendor_data'] = $this->db->get_where('vendor', array(
                'vendor_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/vendor_view', $page_data);
        } else if ($para1 == 'pay_form') {
            $page_data['vendor_id'] = $para2;
            $this->load->view('back/admin/vendor_pay_form', $page_data);
        } else if ($para1 == 'approval') {
            $page_data['vendor_id'] = $para2;
            $page_data['status'] = $this->db->get_where('vendor', array(
											'vendor_id' => $para2
										))->row()->status;
            $this->load->view('back/admin/vendor_approval', $page_data);
        } else if ($para1 == 'add') {
            $this->load->view('back/admin/vendor_add');
        } else if ($para1 == 'approval_set') {
            $vendor = $para2;
			$approval = $this->input->post('approval');
            if ($approval == 'ok') {
                $data['status'] = 'approved';
            } else {
                $data['status'] = 'pending';
            }
            $this->db->where('vendor_id', $vendor);
            $this->db->update('vendor', $data);
            $this->email_model->status_email('vendor', $vendor);
            recache();
        } elseif ($para1 == 'pay') {
            $vendor         = $para2;
            $method         = $this->input->post('method');
            $amount         = $this->input->post('amount');
            $amount_in_usd  = $amount/exchange('usd');
            if ($method == 'paypal') {
                $paypal_email  = $this->crud_model->get_type_name_by_id('vendor', $vendor, 'paypal_email');
                $data['vendor_id']      = $vendor;
                $data['amount']         = $this->input->post('amount');
                $data['status']         = 'due';
                $data['method']         = 'paypal';
                $data['timestamp']      = time();

                $this->db->insert('vendor_invoice', $data);
                $invoice_id           = $this->db->insert_id();
                $this->session->set_userdata('invoice_id', $invoice_id);
                
                /****TRANSFERRING USER TO PAYPAL TERMINAL****/
                $this->paypal->add_field('rm', 2);
                $this->paypal->add_field('no_note', 0);
                $this->paypal->add_field('cmd', '_xclick');
                
                $this->paypal->add_field('amount', $this->cart->format_number($amount_in_usd));

                //$this->paypal->add_field('amount', $grand_total);
                $this->paypal->add_field('custom', $invoice_id);
                $this->paypal->add_field('business', $paypal_email);
                $this->paypal->add_field('notify_url', base_url() . 'index.php/admin/paypal_ipn');
                $this->paypal->add_field('cancel_return', base_url() . 'index.php/admin/paypal_cancel');
                $this->paypal->add_field('return', base_url() . 'index.php/admin/paypal_success');
                
                $this->paypal->submit_paypal_post();
                // submit the fields to paypal

            }else if ($method == 'c2') {
                $data['vendor_id']      = $vendor;
                $data['amount']         = $this->input->post('amount');
                $data['status']         = 'due';
                $data['method']         = 'c2';
                $data['timestamp']      = time();

                $this->db->insert('vendor_invoice', $data);
                $invoice_id             = $this->db->insert_id();
                $this->session->set_userdata('vendor_id', $vendor);
                $this->session->set_userdata('invoice_id', $invoice_id);

                $c2_user = $this->db->get_where('vendor',array('vendor_id' => $vendor))->row()->c2_user; 
                $c2_secret = $this->db->get_where('vendor',array('vendor_id' => $vendor))->row()->c2_secret;
                

                $this->twocheckout_lib->set_acct_info($c2_user, $c2_secret, 'Y');
                $this->twocheckout_lib->add_field('sid', $this->twocheckout_lib->sid);              //Required - 2Checkout account number
                $this->twocheckout_lib->add_field('cart_order_id', $invoice_id);   //Required - Cart ID
                $this->twocheckout_lib->add_field('total',$this->cart->format_number($amount_in_usd));          
                
                $this->twocheckout_lib->add_field('x_receipt_link_url', base_url().'index.php/admin/twocheckout_success');
                $this->twocheckout_lib->add_field('demo', $this->twocheckout_lib->demo);                    //Either Y or N
                
                $this->twocheckout_lib->submit_form();
            } else if ($method == 'stripe') {
                if($this->input->post('stripeToken')) {
                                    
                    $vendor         = $para2;
                    $method         = $this->input->post('method');
                    $amount         = $this->input->post('amount');
                    $amount_in_usd  = $amount/$this->db->get_where('business_settings',array('type'=>'exchange'))->row()->value;
                    
                    $stripe_details      = json_decode($this->db->get_where('vendor', array(
                        'vendor_id' => $vendor
                    ))->row()->stripe_details,true);
                    $stripe_publishable  = $stripe_details['publishable'];
                    $stripe_api_key      =  $stripe_details['secret'];

                    require_once(APPPATH . 'libraries/stripe-php/init.php');
                    \Stripe\Stripe::setApiKey($stripe_api_key); //system payment settings
                    $vendor_email = $this->db->get_where('vendor' , array('vendor_id' => $vendor))->row()->email;
                    
                    $vendora = \Stripe\Customer::create(array(
                        'email' => $this->db->get_where('general_settings',array('type'=>'system_email'))->row()->value, // customer email id
                        'card'  => $_POST['stripeToken']
                    ));

                    $charge = \Stripe\Charge::create(array(
                        'customer'  => $vendora->id,
                        'amount'    => ceil($amount_in_usd*100),
                        'currency'  => 'USD'
                    ));

                    if($charge->paid == true){
                        $vendora = (array) $vendora;
                        $charge = (array) $charge;
                        
                        $data['vendor_id']          = $vendor;
                        $data['amount']             = $amount;
                        $data['status']             = 'paid';
                        $data['method']             = 'stripe';
                        $data['timestamp']          = time();
                        $data['payment_details']    = "Customer Info: \n".json_encode($vendora,true)."\n \n Charge Info: \n".json_encode($charge,true);
                        
                        $this->db->insert('vendor_invoice', $data);
                        
                        redirect(base_url() . 'index.php/admin/vendor/', 'refresh');
                    } else {
                        $this->session->set_flashdata('alert', 'unsuccessful_stripe');
                        redirect(base_url() . 'index.php/admin/vendor/', 'refresh');
                    }
                    
                } else{
                    $this->session->set_flashdata('alert', 'unsuccessful_stripe');
                    redirect(base_url() . 'index.php/admin/vendor/', 'refresh');
                }

            } else if ($method == 'cash') {
                $data['vendor_id']          = $para2;
                $data['amount']             = $this->input->post('amount');
                $data['status']             = 'due';
                $data['method']             = 'cash';
                $data['timestamp']          = time();
                $data['payment_details']    = "";
                $this->db->insert('vendor_invoice', $data);
                redirect(base_url() . 'index.php/admin/vendor/', 'refresh');
            }
        } else {
            $page_data['page_name'] = "vendor";
            $page_data['all_vendors'] = $this->db->get('vendor')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }


    
    /* FUNCTION: Verify paypal payment by IPN*/
    function paypal_ipn()
    {
        if ($this->paypal->validate_ipn() == true) {
            
            $data['status']             = 'paid';
            $data['payment_details']    = json_encode($_POST);
            $invoice_id                 = $_POST['custom'];
            $this->db->where('vendor_invoice_id', $invoice_id);
            $this->db->update('vendor_invoice', $data);
        }
    }
    

    /* FUNCTION: Loads after cancelling paypal*/
    function paypal_cancel()
    {
        $invoice_id = $this->session->userdata('invoice_id');
        $this->db->where('vendor_invoice_id', $invoice_id);
        $this->db->delete('vendor_invoice');
        $this->session->set_userdata('vendor_invoice_id', '');
        $this->session->set_flashdata('alert', 'payment_cancel');
        redirect(base_url() . 'index.php/admin/vendor/', 'refresh');
    }
    
    /* FUNCTION: Loads after successful paypal payment*/
    function paypal_success()
    {
        $this->session->set_userdata('invoice_id', '');
        redirect(base_url() . 'index.php/admin/vendor/', 'refresh');
    }
    
    function twocheckout_success()
    {

        //$this->twocheckout_lib->set_acct_info('532001', 'tango', 'Y');
        $c2_user = $this->db->get_where('vendor',array('vendor_id' => $this->session->userdata('vendor_id')))->row()->c2_user; 
        $c2_secret = $this->db->get_where('vendor',array('vendor_id' => $this->session->userdata('vendor_id')))->row()->c2_secret;
        
        $this->twocheckout_lib->set_acct_info($c2_user, $c2_secret, 'Y');
        $data2['response'] = $this->twocheckout_lib->validate_response();
        $status = $data2['response']['status'];
        if ($status == 'pass') {
            $data1['status']             = 'paid';
            $data1['payment_details']   = json_encode($this->twocheckout_lib->validate_response());
            $invoice_id                 = $data2['response']['cart_order_id'];
            $this->db->where('vendor_invoice_id', $invoice_id);
            $this->db->update('vendor_invoice', $data1);
            redirect(base_url() . 'index.php/admin/vendor/', 'refresh');

        } else {
            //var_dump($data2['response']);
            $invoice_id = $this->session->userdata('invoice_id');
            $this->db->where('vendor_invoice_id', $invoice_id);
            $this->db->delete('vendor_invoice');
            $this->session->set_userdata('invoice_id', '');
            $this->session->set_userdata('vendor_id', '');
            $this->session->set_flashdata('alert', 'payment_cancel');
            redirect(base_url() . 'index.php/admin/vendor', 'refresh');
        }
    }
    
	/* Pay to Vendor from Admin  */
	
	function pay_to_vendor($para1='',$para2=''){
		if (!$this->crud_model->admin_permission('pay_to_vendor')) {
            redirect(base_url() . 'index.php/admin');
        }
		if($para1 == 'list'){
			$this->db->order_by('vendor_invoice_id', 'desc');
            $page_data['vendor_payments'] = $this->db->get('vendor_invoice')->result_array();
            $this->load->view('back/admin/pay_to_vendor_list', $page_data);
		}
		elseif ($para1 == 'vendor_payment_status') {
            $page_data['vendor_invoice_id']         = $para2;
            $page_data['method']    = $this->db->get_where('vendor_invoice', array(
                'vendor_invoice_id' => $para2))->row()->method;
            $page_data['payment_details'] = $this->db->get_where('vendor_invoice', array(
                'vendor_invoice_id' => $para2
            ))->row()->payment_details;
            $page_data['status'] =	$this->db->get_where('vendor_invoice',array('vendor_invoice_id' => $para2))->row()->status;
            
            $this->load->view('back/admin/pay_to_vendor_payment_status', $page_data);
		}
		elseif($para1 == 'payment_status_set'){
			$data['status'] = $this->input->post('vendor_payment_status');
			$this->db->where('vendor_invoice_id',$para2);
			$this->db->update('vendor_invoice',$data);
		}
		else{
			$page_data['page_name'] = "pay_to_vendor";
            $page_data['vendor_payments'] = $this->db->get('vendor_invoice')->result_array();
            $this->load->view('back/index', $page_data);
		}
	}
	
    /* Membership Management */
    function membership($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('membership') || $this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'do_add') {
            $data['title']    = $this->input->post('title');
            $data['price']    = $this->input->post('price');
            $data['timespan']    = $this->input->post('timespan');
            $data['product_limit']    = $this->input->post('product_limit');
            $this->db->insert('membership', $data);
            $id = $this->db->insert_id();
            $this->crud_model->file_up("img", "membership", $id, '', '', '.png');
        } else if ($para1 == 'edit') {
            $page_data['membership_data'] = $this->db->get_where('membership', array(
                'membership_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/membership_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['title']    = $this->input->post('title');
            $data['price']    = $this->input->post('price');
            $data['timespan']    = $this->input->post('timespan');
            $data['product_limit']    = $this->input->post('product_limit');
            $this->db->where('membership_id', $para2);
            $this->db->update('membership', $data);
            $this->crud_model->file_up("img", "membership", $para2, '', '', '.png');
        } elseif ($para1 == "default_set") {
            $this->db->where('type', "default_member_product_limit");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('product_limit')
            ));
            $this->crud_model->file_up("img", "membership", 0, '', '', '.png');
        } elseif ($para1 == 'delete') {
            $this->db->where('membership_id', $para2);
            $this->db->delete('membership');
        } elseif ($para1 == 'list') {
            $this->db->order_by('membership_id', 'desc');
            $page_data['all_memberships'] = $this->db->get('membership')->result_array();
            $this->load->view('back/admin/membership_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['membership_data'] = $this->db->get_where('membership', array(
                'membership_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/membership_view', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/membership_add');
        } elseif ($para1 == 'default') {
            $this->load->view('back/admin/membership_default');
        } elseif ($para1 == 'publish_set') {
            $product = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'approved';
            } else {
                $data['status'] = 'pending';
            }
            $this->db->where('membership_id', $product);
            $this->db->update('membership', $data);
        } else {
            $page_data['page_name'] = "membership";
            $page_data['all_memberships'] = $this->db->get('membership')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /* Administrator Management */
    function admins($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('admin')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'do_add') {
            $data['name']      = $this->input->post('name');
            $data['email']     = $this->input->post('email');
			$password		   = $this->input->post('password');
            $data['password']  = sha1($password);
            $data['phone']     = $this->input->post('phone');
            $data['address']   = $this->input->post('address');
            $data['role']      = $this->input->post('role');
            $data['timestamp'] = time();
            $this->db->insert('admin', $data);
            $this->email_model->account_opening('admin', $data['email'], $password);
        } else if ($para1 == 'edit') {
            $page_data['admin_data'] = $this->db->get_where('admin', array(
                'admin_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/admin_edit', $page_data);
        } elseif ($para1 == "update") {
            $data['name']    = $this->input->post('name');
			$password		   = $this->input->post('password');
            $data['password']  = sha1($password);
            $data['phone']   = $this->input->post('phone');
            $data['address'] = $this->input->post('address');
            $data['role']    = $this->input->post('role');
            $this->db->where('admin_id', $para2);
            $this->db->update('admin', $data);
            $this->email_model->account_opening('admin', $data['email'], $password);
        } elseif ($para1 == 'delete') {
            $this->db->where('admin_id', $para2);
            $this->db->delete('admin');
        } elseif ($para1 == 'list') {
            $this->db->order_by('admin_id', 'desc');
            $page_data['all_admins'] = $this->db->get('admin')->result_array();
            $this->load->view('back/admin/admin_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['admin_data'] = $this->db->get_where('admin', array(
                'admin_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/admin_view', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/admin_add');
        } else {
            $page_data['page_name']  = "admin";
            $page_data['all_admins'] = $this->db->get('admin')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /* Account Role Management */
    function role($para1 = '', $para2 = '')
    {
        if (!$this->crud_model->admin_permission('role')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'do_add') {
            $data['name']        = $this->input->post('name');
            $data['permission']  = json_encode($this->input->post('permission'));
            $data['description'] = $this->input->post('description');
            $this->db->insert('role', $data);
        } elseif ($para1 == "update") {
            $data['name']        = $this->input->post('name');
            $data['permission']  = json_encode($this->input->post('permission'));
            $data['description'] = $this->input->post('description');
            $this->db->where('role_id', $para2);
            $this->db->update('role', $data);
        } elseif ($para1 == 'delete') {
            $this->db->where('role_id', $para2);
            $this->db->delete('role');
        } elseif ($para1 == 'list') {
            $this->db->order_by('role_id', 'desc');
            $page_data['all_roles'] = $this->db->get('role')->result_array();
            $this->load->view('back/admin/role_list', $page_data);
        } elseif ($para1 == 'view') {
            $page_data['role_data'] = $this->db->get_where('role', array(
                'role_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/role_view', $page_data);
        } elseif ($para1 == 'add') {
            $page_data['all_permissions'] = $this->db->get('permission')->result_array();
            $this->load->view('back/admin/role_add', $page_data);
        } else if ($para1 == 'edit') {
            $page_data['all_permissions'] = $this->db->get('permission')->result_array();
            $page_data['role_data']       = $this->db->get_where('role', array(
                'role_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/role_edit', $page_data);
        } else {
            $page_data['page_name'] = "role";
            $page_data['all_roles'] = $this->db->get('role')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    
    /* Checking if email exists*/
    function load_dropzone()
    {
        $this->load->view('back/admin/dropzone');
    }

    /* Checking if email exists*/
    function exists()
    {
        $email  = $this->input->post('email');
        $admin  = $this->db->get('admin')->result_array();
        $exists = 'no';
        foreach ($admin as $row) {
            if ($row['email'] == $email) {
                $exists = 'yes';
            }
        }
        echo $exists;
    }
    
    /* Login into Admin panel */
    function login($para1 = '')
    {
        if ($para1 == 'forget_form') {
            $page_data['control'] = 'admin';
            $this->load->view('back/forget_password',$page_data);
        } else if ($para1 == 'forget') {
			
        	$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');			
            if ($this->form_validation->run() == FALSE)
            {
                echo validation_errors();
            }
            else
            {
				$query = $this->db->get_where('admin', array(
					'email' => $this->input->post('email')
				));
				if ($query->num_rows() > 0) {
					$admin_id         = $query->row()->admin_id;
					$password         = substr(hash('sha512', rand()), 0, 12);
					$data['password'] = sha1($password);
					$this->db->where('admin_id', $admin_id);
					$this->db->update('admin', $data);
					if ($this->email_model->password_reset_email('admin', $admin_id, $password)) {
						echo 'email_sent';
					} else {
						echo 'email_not_sent';
					}
				} else {
					echo 'email_nay';
				}
			}
        } else {
        	$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');
			
            if ($this->form_validation->run() == FALSE)
            {
                echo validation_errors();
            }
            else
            {
				$login_data = $this->db->get_where('admin', array(
					'email' => $this->input->post('email'),
					'password' => sha1($this->input->post('password'))
				));
				if ($login_data->num_rows() > 0) {
					foreach ($login_data->result_array() as $row) {
						$this->session->set_userdata('login', 'yes');
						$this->session->set_userdata('admin_login', 'yes');
						$this->session->set_userdata('admin_id', $row['admin_id']);
						$this->session->set_userdata('admin_name', $row['name']);
						$this->session->set_userdata('title', 'admin');
						echo 'lets_login';
					}
				} else {
					echo 'login_failed';
				}
			}
        }
    }
    
    /* Loging out from Admin panel */
    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'index.php/admin', 'refresh');
    }
    
    /* Sending Newsletters */
    function newsletter($para1 = "")
    {
        if (!$this->crud_model->admin_permission('newsletter')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == "send") {
            $users       = explode(',', $this->input->post('users'));
            $subscribers = explode(',', $this->input->post('subscribers'));
            $text        = $this->input->post('text');
            $title       = $this->input->post('title');
            $from        = $this->input->post('from');
            foreach ($users as $key => $user) {
                if ($user !== '') {
                    $this->email_model->newsletter($title, $text, $user, $from);
                }
            }
            foreach ($subscribers as $key => $subscriber) {
                if ($subscriber !== '') {
                    $this->email_model->newsletter($title, $text, $subscriber, $from);
                }
            }
        } else {
            $page_data['users']       = $this->db->get('user')->result_array();
            $page_data['subscribers'] = $this->db->get('subscribe')->result_array();
            $page_data['page_name']   = "newsletter";
            $this->load->view('back/index', $page_data);
        }
    }
    
    /* Add, Edit, Delete, Duplicate, Enable, Disable Sliders */
    function slider($para1 = '', $para2 = '', $para3 = '')
    {
        if ($para1 == 'list') {
            $this->db->order_by('slider_id', 'desc');
            $page_data['all_slider'] = $this->db->get('slider')->result_array();
            $this->load->view('back/admin/slider_list', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/slider_set');
        } elseif ($para1 == 'add_form') {
            $page_data['style_id'] = $para2;
            $page_data['style']    = json_decode($this->db->get_where('slider_style', array(
                'slider_style_id' => $para2
            ))->row()->value, true);
            $this->load->view('back/admin/slider_add_form', $page_data);
        } else if ($para1 == 'delete') { //ll
            $elements = json_decode($this->db->get_where('slider', array(
                'slider_id' => $para2
            ))->row()->elements, true);
            $style    = $this->db->get_where('slider', array(
                'slider_id' => $para2
            ))->row()->style;
            $style    = json_decode($this->db->get_where('slider_style', array(
                'slider_style_id' => $style
            ))->row()->value, true);
            $images   = $style['images'];
            if (file_exists('uploads/slider_image/background_' . $para2 . '.jpg')) {
                unlink('uploads/slider_image/background_' . $para2 . '.jpg');
            }
            foreach ($images as $row) {
                if (file_exists('uploads/slider_image/' . $para2 . '_' . $row . '.png')) {
                    unlink('uploads/slider_image/' . $para2 . '_' . $row . '.png');
                }
            }
            $this->db->where('slider_id', $para2);
            $this->db->delete('slider');
            recache();
        } else if ($para1 == 'serial') {
            $this->db->order_by('serial', 'desc');
            $this->db->order_by('slider_id', 'desc');
            $page_data['slider'] = $this->db->get_where('slider', array(
                'status' => 'ok'
            ))->result_array();
            $this->load->view('back/admin/slider_serial', $page_data);
        } else if ($para1 == 'do_serial') {
            $input  = json_decode($this->input->post('serial'), true);
            $serial = array();
            foreach ($input as $r) {
                $serial[] = $r['id'];
            }
            $serial  = array_reverse($serial);
            $sliders = $this->db->get('slider')->result_array();
            foreach ($sliders as $row) {
                $data['serial'] = 0;
                $this->db->where('slider_id', $row['slider_id']);
                $this->db->update('slider', $data);
            }
            foreach ($serial as $i => $row) {
                $data1['serial'] = $i + 1;
                $this->db->where('slider_id', $row);
                $this->db->update('slider', $data1);
            }
            recache();
        } else if ($para1 == 'slider_publish_set') {
            $slider = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
                $data['serial'] = 0;
            }
            $this->db->where('slider_id', $slider);
            $this->db->update('slider', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['slider_data'] = $this->db->get_where('slider', array(
                'slider_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/slider_edit_form', $page_data);
        } elseif ($para1 == 'create') {
            $data['style']  = $this->input->post('style_id');
            $data['title']  = $this->input->post('title');
            $data['serial'] = 0;
            $data['status'] = 'ok';
            $style          = json_decode($this->db->get_where('slider_style', array(
                'slider_style_id' => $data['style']
            ))->row()->value, true);
            $images         = array();
            $texts          = array();
            foreach ($style['images'] as $image) {
                if ($_FILES[$image['name']]['name']) {
                    $images[] = $image['name'];
                }
            }
            foreach ($style['texts'] as $text) {
                if ($this->input->post($text['name']) !== '') {
                    $texts[] = array(
                        'name' => $text['name'],
                        'text' => $this->input->post($text['name']),
                        'color' => $this->input->post($text['name'] . '_color'),
                        'background' => $this->input->post($text['name'] . '_background')
                    );
                }
            }
            $elements         = array(
                'images' => $images,
                'texts' => $texts
            );
            $data['elements'] = json_encode($elements);
            $this->db->insert('slider', $data);
            $id = $this->db->insert_id();
            
            move_uploaded_file($_FILES['background']['tmp_name'], 'uploads/slider_image/background_' . $id . '.jpg');
            foreach ($elements['images'] as $image) {
                move_uploaded_file($_FILES[$image]['tmp_name'], 'uploads/slider_image/' . $id . '_' . $image . '.png');
            }
            recache();
        } elseif ($para1 == 'update') {
            $data['style'] = $this->input->post('style_id');
            $data['title'] = $this->input->post('title');
            $style         = json_decode($this->db->get_where('slider_style', array(
                'slider_style_id' => $data['style']
            ))->row()->value, true);
            $images        = array();
            $texts         = array();
            foreach ($style['images'] as $image) {
                if ($_FILES[$image['name']]['name'] || $this->input->post($image['name'] . '_same') == 'same') {
                    $images[] = $image['name'];
                }
            }
            foreach ($style['texts'] as $text) {
                if ($this->input->post($text['name']) !== '') {
                    $texts[] = array(
                        'name' => $text['name'],
                        'text' => $this->input->post($text['name']),
                        'color' => $this->input->post($text['name'] . '_color'),
                        'background' => $this->input->post($text['name'] . '_background')
                    );
                }
            }
            $elements         = array(
                'images' => $images,
                'texts' => $texts
            );
            $data['elements'] = json_encode($elements);
            $this->db->where('slider_id', $para2);
            $this->db->update('slider', $data);
            
            move_uploaded_file($_FILES['background']['tmp_name'], 'uploads/slider_image/background_' . $para2 . '.jpg');
            foreach ($elements['images'] as $image) {
                move_uploaded_file($_FILES[$image]['tmp_name'], 'uploads/slider_image/' . $para2 . '_' . $image . '.png');
            }
            recache();
        } else {
            $page_data['page_name'] = "slider";
            $this->load->view('back/index', $page_data);
        }
    }
	function activation(){
		if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
		$page_data['page_name'] = "activation";
        $this->load->view('back/index', $page_data);
	}
	function faqs(){
		if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
		$page_data['page_name'] = "faq_settings";
        $this->load->view('back/index', $page_data);
	}
	function payment_method(){
		if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
		$page_data['page_name'] = "payment_method";
        $this->load->view('back/index', $page_data);
	}
	function curency_method(){
		if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
		$page_data['page_name'] = "curency_method";
        $this->load->view('back/index', $page_data);
	}
    
    /* Manage Frontend User Interface */
    function set_def_curr($para1 = '', $para2 = '',$para3 = '',$para4 = '')
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
		if($para1 == 'home'){
			$this->db->where('type', "home_def_currency");
			$this->db->update('business_settings', array(
				'value' => $this->input->post('home_def_currency')
			));
		} 
		if($para1 == 'system'){
			$this->db->where('type', "currency");
			$this->db->update('business_settings', array(
				'value' => $this->input->post('currency')
			));
			
			$this->db->where('currency_settings_id', $this->input->post('currency'));
			$this->db->update('currency_settings', array(
				'exchange_rate_def' => '1'
			));
		} 
		recache();
		
    }
	
	
    /* Manage Frontend User Interface */
    function ui_settings($para1 = '', $para2 = '',$para3 = '',$para4 = '')
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == "ui_home") {
			if ($para2 == 'update_home_page') {
                $this->db->where('type', "home_page_style");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('home_page')
                ));
				recache();
			}
			elseif ($para2 == 'home_vendor') {
				if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {
					redirect(base_url() . 'index.php/admin');
				}
				$this->db->where('type', "parallax_vendor_title");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('pv_title')
                ));
				$this->db->where('type', "no_of_vendor");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('vendor_no')
                ));
				if($_FILES["par"]['tmp_name']){
					move_uploaded_file($_FILES["par"]['tmp_name'], 'uploads/others/parralax_vendor.jpg');
				}
				recache();
			}
			elseif ($para2 == 'home_search') {
				$this->db->where('type', "parallax_search_title");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('ps_title')
                ));
				if($_FILES["par3"]['tmp_name']){
					move_uploaded_file($_FILES["par3"]['tmp_name'], 'uploads/others/parralax_search.jpg');
				}
				recache();
			}
			elseif ($para2 == 'home_blog') {
				$this->db->where('type', "parallax_blog_title");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('pb_title')
                ));
				$this->db->where('type', "no_of_blog");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('blog_no')
                ));
				if($_FILES["par2"]['tmp_name']){
					move_uploaded_file($_FILES["par2"]['tmp_name'], 'uploads/others/parralax_blog.jpg');
				}
				recache();
			}
			elseif ($para2 == 'top_slide_categories') {
                $this->db->where('type', "top_slide_categories");
                $this->db->update('ui_settings', array(
                    'value' => json_encode($this->input->post('top_category'))
                ));
				
				$this->db->where('type', "no_of_todays_deal");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('deal_no')
                ));
				recache();
			}
			elseif ($para2 == 'home_brand') {
				$this->db->where('type', "no_of_brands");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('brand_no')
                ));
				recache();
			}
			elseif ($para2 == 'home_featured') {
				$this->db->where('type', "no_of_featured_products");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('featured_no')
                ));
				
                $this->db->where('type', "featured_product_box_style");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('fea_pro_box')
                ));
				recache();
			}
			else if ($para2 == 'feature_publish_set') {
				if ($para4 == 'true') {
					$data['value'] = 'ok';
				} else if ($para4 == 'false') {
					$data['value'] = 'no';
				}
				$this->db->where('ui_settings_id', $para3);
				$this->db->update('ui_settings', $data);
				recache();
			}
			elseif ($para2 == 'home1_category') {
				$category = $this->input->post('category');
				$sub_category = $this->input->post('sub_category');
				$color_back = $this->input->post('color1');
				$color_text = $this->input->post('color2');
				$result= array();
				foreach($category as $i=>$row){
					$result[] = array(
									'category' => $row,
									'sub_category' => $sub_category[$row],
									'color_back' => $color_back[$row],
									'color_text' => $color_text[$row]
								);
				}
				$data['value'] = json_encode($result);
				$this->db->where('type', 'home_categories');
				$this->db->update('ui_settings', $data);
				
				$this->db->where('type', "category_product_box_style");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('box_style')
                ));
				recache();
			}
			elseif ($para2 == 'home2_category') {
				//$box = $this->input->post('box');
				$category = $this->input->post('category');
				$sub_category = $this->input->post('sub_category');
				$color_back = $this->input->post('color1');
				$color_text = $this->input->post('color2');
				$result= array();
				foreach($category as $i=>$row){
					$result[] = array(
									//'no'	=>$row,
									'category' => $row,
									'sub_category' => $sub_category[$row],
									'color_back' => $color_back[$row],
									'color_text' => $color_text[$row]
								);
				}
				$data['value'] = json_encode($result);
				$this->db->where('type', 'home_categories');
				$this->db->update('ui_settings', $data);
				recache();
			}
			elseif ($para2 == 'cat_colors') {
				var_dump($para3);
			}
        }
        elseif ($para1 == "ui_category") {
            if ($para2 == 'update') {
                $this->db->where('type', "side_bar_pos_category");
                $this->db->update('ui_settings', array(
                    'value' => $this->input->post('side_bar_pos')
                ));
                recache();
            }
        }
		elseif ($para1 == 'sub_by_cat') {
            echo $this->crud_model->select_html('sub_category','sub-category','sub_category_name','add','demo-cs-multiselect','','category',$para2,'check_sub_length');
        }
        //$this->load->view('back/index', $page_data);
    }
    
    /* Checking Login Stat */
    function is_logged()
    {
        if ($this->session->userdata('admin_login') == 'yes') {
            echo 'yah!good';
        } else {
            echo 'nope!bad';
        }
    }
    
    /* Manage Frontend User Interface */
    function page_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        $page_data['page_name'] = "page_settings";
        $page_data['tab_name']  = $para1;
        $this->load->view('back/index', $page_data);
    }
    
    /* Manage Frontend User Messages */
    function contact_message($para1 = "", $para2 = "")
    {
        if (!$this->crud_model->admin_permission('contact_message')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'delete') {
            $this->db->where('contact_message_id', $para2);
            $this->db->delete('contact_message');
        } elseif ($para1 == 'list') {
            $this->db->order_by('contact_message_id', 'desc');
            $page_data['contact_messages'] = $this->db->get('contact_message')->result_array();
            $this->load->view('back/admin/contact_message_list', $page_data);
        } elseif ($para1 == 'reply') {
            $data['reply'] = $this->input->post('reply');
            $this->db->where('contact_message_id', $para2);
            $this->db->update('contact_message', $data);
            $this->db->order_by('contact_message_id', 'desc');
            $query = $this->db->get_where('contact_message', array(
                'contact_message_id' => $para2
            ))->row();
            $this->email_model->do_email($data['reply'], 'RE: ' . $query->subject, $query->email);
        } elseif ($para1 == 'view') {
            $page_data['message_data'] = $this->db->get_where('contact_message', array(
                'contact_message_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/contact_message_view', $page_data);
        } elseif ($para1 == 'reply_form') {
            $page_data['message_data'] = $this->db->get_where('contact_message', array(
                'contact_message_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/contact_message_reply', $page_data);
        } else {
            $page_data['page_name']        = "contact_message";
            $page_data['contact_messages'] = $this->db->get('contact_message')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /* Manage Logos */
    function logo_settings($para1 = "", $para2 = "", $para3 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == "select_logo") {
            $page_data['page_name'] = "select_logo";
        } elseif ($para1 == "delete_logo") {
            if (file_exists("uploads/logo_image/logo_" . $para2 . ".png")) {
                unlink("uploads/logo_image/logo_" . $para2 . ".png");
            }
            $this->db->where('logo_id', $para2);
            $this->db->delete('logo');
            recache();
        } elseif ($para1 == "set_logo") {

            $type    = $this->input->post('type');
            $logo_id = $this->input->post('logo_id');
            $this->db->where('type', $type);
            $this->db->update('ui_settings', array(
                'value' => $logo_id
            ));
            recache();
        } elseif ($para1 == "show_all") {
            $page_data['logo'] = $this->db->get('logo')->result_array();
            if ($para2 == "") {
                $this->load->view('back/admin/all_logo', $page_data);
            }
            if ($para2 == "selectable") {
                $page_data['logo_type'] = $para3;
                $this->load->view('back/admin/select_logo', $page_data);
            }
        } elseif ($para1 == "upload_logo") {
            foreach ($_FILES["file"]['name'] as $i => $row) {
                $data['name'] = '';
                $this->db->insert("logo", $data);
                $id = $this->db->insert_id();
                move_uploaded_file($_FILES["file"]['tmp_name'][$i], 'uploads/logo_image/logo_' . $id . '.png');
				
            }
            return;
        } elseif ($para1 == "upload_logo1") {
                $data['name'] = '';
                $this->db->insert("logo", $data);
                $id = $this->db->insert_id();
				echo $_FILES["logo"]['name'];
                move_uploaded_file($_FILES["logo"]['tmp_name'], 'uploads/logo_image/logo_' . $id . '.png');
				
        }else {
            $this->load->view('back/index', $page_data);
        }
    }
    
    /* Manage Favicons */
    function favicon_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        $name = $_FILES['img']['name'];
        $ext  = end((explode(".", $name)));
		$this->db->where('type', 'fav_ext');
        $this->db->update('ui_settings', array(
            'value' =>$ext
        ));
        move_uploaded_file($_FILES['img']['tmp_name'], 'uploads/others/favicon.'.$ext);
        recache();
    }
    
    /* Manage Frontend Facebook Login Credentials */
    function social_login_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        $this->db->where('type', "fb_appid");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('appid')
        ));
        $this->db->where('type', "fb_secret");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('secret')
        ));
        $this->db->where('type', "application_name");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('application_name')
        ));
        $this->db->where('type', "client_id");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('client_id')
        ));
        $this->db->where('type', "client_secret");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('client_secret')
        ));
        $this->db->where('type', "redirect_uri");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('redirect_uri')
        ));
        $this->db->where('type', "api_key");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('api_key')
        ));
    }
    
    /* Manage Frontend Facebook Login Credentials */
    function product_comment($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        $this->db->where('type', "discus_id");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('discus_id')
        ));
        $this->db->where('type', "comment_type");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('type')
        ));
        $this->db->where('type', "fb_comment_api");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('fb_comment_api')
        ));
    }
    
   /* Manage Frontend Captcha Settings Credentials */
    function captcha_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        $this->db->where('type', "captcha_public");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('cpub')
        ));
        $this->db->where('type', "captcha_private");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('cprv')
        ));
    }
    
    /* Manage Site Settings */
    function site_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        $page_data['page_name'] = "site_settings";
        $page_data['tab_name']  = $para1;
        $this->load->view('back/index', $page_data);
    }
	
	/* Manage Email Template */
    function email_template($para1 = "", $para2 = "")
    {
        if (!$this->crud_model->admin_permission('email_template')) {
            redirect(base_url() . 'index.php/admin');
        }
		
		if($para1 = "update"){
			$data['subject'] = $this->input->post('subject');
			$data['body'] = $this->input->post('body');
			
			$this->db->where('email_template_id', $para2);
            $this->db->update('email_template', $data);
		}
		$page_data['page_name'] = "email_template";
		$page_data['table_info']  = $this->db->get('email_template')->result_array();;
		$this->load->view('back/index', $page_data);
    }
    
    /* Manage Languages */
    function language_settings($para1 = "", $para2 = "", $para3 = "")
    {
        if (!$this->crud_model->admin_permission('language')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'add_lang') {
            $this->load->view('back/admin/language_add');
        } elseif ($para1 == 'edit_lang') {
            $page_data['lang_data'] = $this->db->get_where('language_list',array('language_list_id'=>$para2))->result_array();
            $this->load->view('back/admin/language_edit',$page_data);
        } elseif ($para1 == 'lang_list') {
            //if($para2 !== ''){
            $this->db->order_by('word_id', 'desc');
            $page_data['words'] = $this->db->get('language')->result_array();
            $page_data['lang']  = $para2;
            $this->load->view('back/admin/language_list', $page_data);
            //}
        } elseif ($para1 == 'list_data') {
            $limit      = $this->input->get('limit');
            $search     = $this->input->get('search');
            $order      = $this->input->get('order');
            $offset     = $this->input->get('offset');
            $sort       = $this->input->get('sort');
            if($search){
                $this->db->like('word', $search, 'both');
            }
            $total      = $this->db->get('language')->num_rows();
            $this->db->limit($limit);
            if($sort == ''){
                $sort = 'word_id';
                $order = 'DESC';
            }
            $this->db->order_by($sort,$order);
            if($search){
                $this->db->like('word', $search, 'both');
            }
            $lang       = $para2;
            if ($lang == 'undefined' || $lang == '') {
                if ($lang = $this->session->userdata('language')) {
                } else {
                    $lang = $this->db->get_where('general_settings', array(
                        'type' => 'language'
                    ))->row()->value;
                }
            }
            $words      = $this->db->get('language', $limit, $offset)->result_array();
            $data       = array();
            foreach ($words as $row) {

                $res    = array(
                             'no' => '',
                             'word' => '',
                             'translation' => '',
                             'options' => ''
                          );

                $res['no']  = $row['word_id'];
                $res['word']  = '<div class="col-md-12 abv">'.str_replace('_', ' ', $row['word']).'</div>';
                $res['translation']  =   form_open(base_url() . 'index.php/admin/language_settings/upd_trn/'.$row['word_id'], array(
                                            'class' => 'form-horizontal trs',
                                            'method' => 'post',
                                            'id' => $lang.'_'.$row['word_id']
                                        ));
                $res['translation']  .=      '   <div class="col-md-8">';
                $res['translation']  .=      '      <input type="text" name="translation" value="'.$row[$lang].'" class ="form-control ann" />';
                $res['translation']  .=      '      <input type="hidden" name="lang" value="'.$lang.'" />';
                $res['translation']  .=      '   </div>';
                $res['translation']  .=      '   <div class="col-md-4">';
                $res['translation']  .=      '       <span class="btn btn-success btn-xs btn-labeled fa fa-wrench submittera" data-wid="'.$lang.'_'.$row['word_id'].'"  data-ing="'.translate('saving').'" data-msg="'.translate('updated!').'" >'.translate('save').'</span>';
                $res['translation']  .=      '   </div>';
                $res['translation']  .=      '</form>';

                //add html for action
                $res['options'] = "<a onclick=\"delete_confirm('".$row['word_id']."','".translate('really_want_to_delete_this_word?')."')\" 
                                class=\"btn btn-danger btn-xs btn-labeled fa fa-trash\" data-toggle=\"tooltip\" data-original-title=\"Delete\" data-container=\"body\">
                                    ".translate('delete')."
                            </a>";
                $data[] = $res;
            }
            $result = array(
                             'total' => $total,
                             'rows' => $data
                           );

            echo json_encode($result);

        } elseif ($para1 == 'upd_trn') {
            $word_id     = $para2;
            $translation = $this->input->post('translation');
            $language    = $this->input->post('lang');
            $word        = $this->db->get_where('language', array(
                'word_id' => $word_id
            ))->row()->word;
            add_translation($word, $language, $translation);
            recache();
        } elseif ($para1 == 'do_add_lang') {
            $data['name']   = $this->input->post('language');
            $this->db->insert('language_list',$data);

            $id             = $this->db->insert_id();
            $this->crud_model->file_up("icon", "language_list", $id, '', '', '.jpg');

            $language       = 'lang_'.$id;

            $this->db->where('language_list_id', $id);
            $this->db->update('language_list', array(
                'db_field' => $language,
                'status' => 'ok'
            ));

            add_language($language);
            recache();
        } elseif ($para1 == 'do_edit_lang') {
            $this->db->where('language_list_id', $para2);
            $this->db->update('language_list', array(
                'name' => $this->input->post('language')
            ));
            $this->crud_model->file_up("icon", "language_list", $para2, '', '', '.jpg');
            recache();
        } else if ($para1 == "lang_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('language_list_id', $para2);
            $this->db->update('language_list', array(
                'status' => $val
            ));
            recache();
        } elseif ($para1 == 'check_existed') {
            echo lang_check_exists($para2);
        } elseif ($para1 == 'lang_select') {
            $page_data['lang'] = $para2;
            $this->load->view('back/admin/language_select',$page_data);
        } elseif ($para1 == 'dlt_lang') {
            $this->db->where('db_field', $para2);
            $this->db->delete('language_list');
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $para2);
            recache();
        } elseif ($para1 == 'dlt_word') {
            $this->db->where('word_id', $para2);
            $this->db->delete('language');
            recache();
        } else {
            $page_data['page_name'] = "language";
            $this->load->view('back/index', $page_data);
        }
    }
    
    /* Manage Business Settings */
    function business_settings($para1 = "", $para2 = "", $para3 = "")
    {
        if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        else if ($para1 == "cash_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "cash_set");
            $this->db->update('business_settings', array(
                'value' => $val
            ));
            recache();
        }
        else if ($para1 == "paypal_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "paypal_set");
            $this->db->update('business_settings', array(
                'value' => $val
            ));
            recache();
        }
        else if ($para1 == "stripe_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "stripe_set");
            $this->db->update('business_settings', array(
                'value' => $val
            ));
            recache();
        }
		else if ($para1 == "c2_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "c2_set");
            $this->db->update('business_settings', array(
                'value' => $val
            ));
            recache();
        }
		else if ($para1 == "cur_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
			$data['status']    = $val;
            $this->db->where('currency_settings_id', $para2);
            $this->db->update('currency_settings', $data);
            recache();
        }
		else if ($para1 == "vendor_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "vendor_system");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
            recache();
        }
		else if ($para1 == "physical_product_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "physical_product_activation");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
            recache();
        }
		else if ($para1 == "digital_product_set") {
            $val = '';
            if ($para3 == 'true') {
                $val = 'ok';
            } else if ($para3 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "digital_product_activation");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
            recache();
        }
        else if ($para1 == 'set') {
			echo $this->input->post('stripe_set');
			$this->db->where('type',"paypal_set");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('paypal_set')
            ));
			$this->db->where('type', "stripe_set");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('stripe_set')
            ));
			$this->db->where('type', "cash_set");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('cash_set')
            ));
		}
		else if ($para1 == 'faq_set') {
			$faqs = array();
            $f_q  = $this->input->post('f_q');
            $f_a  = $this->input->post('f_a');
            foreach ($f_q as $i => $r) {
                $faqs[] = array(
                    'question' => $f_q[$i],
                    'answer' => $f_a[$i]
                );
            }
            $this->db->where('type', "faqs");
            $this->db->update('business_settings', array(
                'value' => json_encode($faqs)
            ));
		}
		else if ($para1 == 'set1') {
            $this->db->where('type', "paypal_email");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('paypal_email')
            ));
			
            $this->db->where('type', "paypal_type");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('paypal_type')
            ));
            $this->db->where('type', "stripe_secret");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('stripe_secret')
            ));
            $this->db->where('type', "stripe_publishable");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('stripe_publishable')
            ));
			$this->db->where('type', "c2_user");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('c2_user')
            ));
            $this->db->where('type', "c2_secret");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('c2_secret')
            ));
            $this->db->where('type', "c2_type");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('c2_type')
            ));
			$this->db->where('type', "shipping_cost_type");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('shipping_cost_type')
            ));
            $this->db->where('type', "shipping_cost");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('shipping_cost')
            ));
            $this->db->where('type', "shipment_info");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('shipment_info')
            ));
		}
        else if ($para1 == 'set_currency') {
            $this->db->where('type', "currency");
            $this->db->update('business_settings', array(
                'value' => $para2
            ));
        } 
        elseif ($para1 == 'currencies_select') {
            $currency = $this->db->get_where('business_settings',array('type'=>"currency"))->row()->value;
            echo $this->crud_model->select_html('currency_settings','currency','name','edit','demo-chosen-select currency_o',$currency,'status','ok'); 
        } 
        else if ($para1 == 'set2') {
            $this->db->where('type', "currency");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('currency')
            ));
            $this->db->where('type', "currency_name");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('currency_name')
            ));
            $this->db->where('type', "exchange");
            $this->db->update('business_settings', array(
                'value' => $this->input->post('exchange')
            ));
			$this->db->where('type', "vendor_system");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('vendor_system')
            ));
            recache();
        }else if($para1 =='set_3'){
			$data['exchange_rate']    = $this->input->post('exchange');
            $this->db->where('currency_settings_id', $para2);
            $this->db->update('currency_settings', $data);
			$this->db->where('type', "vendor_system");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('vendor_system')
            ));
		}else {
            $page_data['page_name'] = "business_settings";
            $this->load->view('back/index', $page_data);
        }
    }
    
    /* Manage Admin Settings */
    function manage_admin($para1 = "")
    {
        if ($this->session->userdata('admin_login') != 'yes') {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'update_password') {
            $user_data['password'] = $this->input->post('password');
            $account_data          = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('admin_id')
            ))->result_array();
            foreach ($account_data as $row) {
                if (sha1($user_data['password']) == $row['password']) {
                    if ($this->input->post('password1') == $this->input->post('password2')) {
                        $data['password'] = sha1($this->input->post('password1'));
                        $this->db->where('admin_id', $this->session->userdata('admin_id'));
                        $this->db->update('admin', $data);
                        echo 'updated';
                    }
                } else {
                    echo 'pass_prb';
                }
            }
        } else if ($para1 == 'update_profile') {
            $this->db->where('admin_id', $this->session->userdata('admin_id'));
            $this->db->update('admin', array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address'),
                'phone' => $this->input->post('phone')
            ));
        } else {
            $page_data['page_name'] = "manage_admin";
            $this->load->view('back/index', $page_data);
        }
    }
    
    /*Page Management */
    function page($para1 = '', $para2 = '', $para3 = '')
    {
        if (!$this->crud_model->admin_permission('page')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'do_add') {
            $parts             = array();
            $data['page_name'] = $this->input->post('page_name');
            $data['tag'] 	   = $this->input->post('tag');
            $data['parmalink'] = $this->input->post('parmalink');
            $size              = $this->input->post('part_size');
            $type              = $this->input->post('part_content_type');
            $content           = $this->input->post('part_content');
            $widget            = $this->input->post('part_widget');
            //var_dump($widget);
            foreach ($size as $in => $row) {
                $parts[] = array(
                    'size' => $size[$in],
                    'type' => $type[$in],
                    'content' => $content[$in],
                    'widget' => $widget[$in]
                );
            }
            $data['parts']  = json_encode($parts);
            $data['status'] = '';
            $this->db->insert('page', $data);
            recache();
        } else if ($para1 == 'edit') {
            $page_data['page_data'] = $this->db->get_where('page', array(
                'page_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/page_edit', $page_data);
        } elseif ($para1 == "update") {
            $parts             = array();
            $data['page_name'] = $this->input->post('page_name');
            $data['tag'] 	   = $this->input->post('tag');
            $data['parmalink'] = $this->input->post('parmalink');
            $size              = $this->input->post('part_size');
            $type              = $this->input->post('part_content_type');
            $content           = $this->input->post('part_content');
            $widget            = $this->input->post('part_widget');
            //var_dump($widget);
            foreach ($size as $in => $row) {
                $parts[] = array(
                    'size' => $size[$in],
                    'type' => $type[$in],
                    'content' => $content[$in],
                    'widget' => $widget[$in]
                );
            }
            $data['parts'] = json_encode($parts);
            $this->db->where('page_id', $para2);
            $this->db->update('page', $data);
            recache();
        } elseif ($para1 == 'delete') {
            $this->db->where('page_id', $para2);
            $this->db->delete('page');
            recache();
        } elseif ($para1 == 'list') {
            $page_data['all_page'] = $this->db->get('page')->result_array();
            $this->load->view('back/admin/page_list', $page_data);
        } else if ($para1 == 'page_publish_set') {
            $page = $para2;
            if ($para3 == 'true') {
                $data['status'] = 'ok';
            } else {
                $data['status'] = '0';
            }
            $this->db->where('page_id', $page);
            $this->db->update('page', $data);
            recache();
        } elseif ($para1 == 'view') {
            $page_data['page_data'] = $this->db->get_where('page', array(
                'page_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/page_view', $page_data);
        } elseif ($para1 == 'add') {
            $this->load->view('back/admin/page_add');
        } else {
            $page_data['page_name'] = "page";
            $page_data['all_pages'] = $this->db->get('page')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
    
    /* Manage General Settings */
    function general_settings($para1 = "", $para2 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == "terms") {
            $this->db->where('type', "terms_conditions");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('terms')
            ));
        }
		if ($para1 == "preloader") {
            $this->db->where('type', "preloader_bg");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('preloader_bg')
            ));
            $this->db->where('type', "preloader_obj");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('preloader_obj')
            ));
            $this->db->where('type', "preloader");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('preloader')
            ));
        }
        if ($para1 == "privacy_policy") {
            $this->db->where('type', "privacy_policy");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('privacy_policy')
            ));
        }
        if ($para1 == "set_slider") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "slider");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_slides") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "slides");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_admin_notification_sound") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }            $this->db->where('type', "admin_notification_sound");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set_home_notification_sound") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            $this->db->where('type', "home_notification_sound");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "fb_login_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "fb_login_set");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "g_login_set") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "g_login_set");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
        if ($para1 == "set") {
            $this->db->where('type', "system_name");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('system_name')
            ));
            $this->db->where('type', "system_email");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('system_email')
            ));

            $file_folder = $this->db->get_where('general_settings', array('type' => 'file_folder'))->row()->value;
            if(rename("uploads/file_products/".$file_folder,"uploads/file_products/".$this->input->post('file_folder'))){
                $this->db->where('type', "file_folder");
                $this->db->update('general_settings', array(
                    'value' => $this->input->post('file_folder')
                ));
            }

            $this->db->where('type', "system_title");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('system_title')
            ));
            $this->db->where('type', "cache_time");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('cache_time')
            ));
            $this->db->where('type', "language");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('language')
            ));
            $volume = $this->input->post('admin_notification_volume');
            $this->db->where('type', "admin_notification_volume");
            $this->db->update('general_settings', array(
                'value' => $volume
            ));
            $volume = $this->input->post('homepage_notification_volume');
            $this->db->where('type', "homepage_notification_volume");
            $this->db->update('general_settings', array(
                'value' => $volume
            ));
        }
        if ($para1 == "contact") {
            $this->db->where('type', "contact_address");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_address')
            ));
            $this->db->where('type', "contact_email");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_email')
            ));
            $this->db->where('type', "contact_phone");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_phone')
            ));
            $this->db->where('type', "contact_website");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_website')
            ));
            $this->db->where('type', "contact_about");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('contact_about')
            ));
			
        }
        if ($para1 == "footer") {
            $this->db->where('type', "footer_text");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('footer_text', 'chaira_de')
            ));
            $this->db->where('type', "footer_category");
            $this->db->update('general_settings', array(
                'value' => json_encode($this->input->post('footer_category'))
            ));
        }
		 if ($para1 == "font") {
            $this->db->where('type', "font");
            $this->db->update('ui_settings', array(
                'value' => $this->input->post('font')
            ));
        }
        if ($para1 == "color") {
            $this->db->where('type', "header_color");
            $this->db->update('ui_settings', array(
                'value' => $this->input->post('header_color')
            ));
			$this->db->where('type', "footer_color");
            $this->db->update('ui_settings', array(
                'value' => $this->input->post('header_color')
            ));
        }
		if ($para1 == "mail_status") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'smtp';
            } else if ($para2 == 'false') {
                $val = 'mail';
            }
            echo $val;
            $this->db->where('type', "mail_status");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
		if ($para1 == "captcha_status") {
            $val = '';
            if ($para2 == 'true') {
                $val = 'ok';
            } else if ($para2 == 'false') {
                $val = 'no';
            }
            echo $val;
            $this->db->where('type', "captcha_status");
            $this->db->update('general_settings', array(
                'value' => $val
            ));
        }
		
		
        recache();
    }
    function smtp_settings($para1 = "", $para2 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
		if ($para1 == "set") {
            $this->db->where('type', 'smtp_host');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_host')));
			
			$this->db->where('type', 'smtp_port');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_port')));
			
			$this->db->where('type', 'smtp_user');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_user')));
			
			$this->db->where('type', 'smtp_pass');
            $this->db->update('general_settings', array('value' => $this->input->post('smtp_pass')));
			
			redirect(base_url() . 'index.php/admin/site_settings/smtp_settings/', 'refresh');
		}
	}
    /* Manage Social Links */
    function social_links($para1 = "")
    {
        if (!$this->crud_model->admin_permission('site_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == "set") {
            $this->db->where('type', "facebook");
            $this->db->update('social_links', array(
                'value' => $this->input->post('facebook')
            ));
            $this->db->where('type', "google-plus");
            $this->db->update('social_links', array(
                'value' => $this->input->post('google-plus')
            ));
            $this->db->where('type', "twitter");
            $this->db->update('social_links', array(
                'value' => $this->input->post('twitter')
            ));
            $this->db->where('type', "skype");
            $this->db->update('social_links', array(
                'value' => $this->input->post('skype')
            ));
            $this->db->where('type', "pinterest");
            $this->db->update('social_links', array(
                'value' => $this->input->post('pinterest')
            ));
            $this->db->where('type', "youtube");
            $this->db->update('social_links', array(
                'value' => $this->input->post('youtube')
            ));
            redirect(base_url() . 'index.php/admin/site_settings/social_links/', 'refresh');
        }
        recache();
    }
    /* Manage SEO relateds */
    function seo_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('seo')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == "set") {
            $this->db->where('type', "meta_description");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('description')
            ));
            $this->db->where('type', "meta_keywords");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('keywords')
            ));
            $this->db->where('type', "meta_author");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('author')
            ));

            $this->db->where('type', "revisit_after");
            $this->db->update('general_settings', array(
                'value' => $this->input->post('revisit_after')
            ));
            recache();
        }
        else {
            require_once (APPPATH . 'libraries/SEOstats/bootstrap.php');
            $page_data['page_name'] = "seo";
            $this->load->view('back/index', $page_data);
        }
    }
	
	function ticket($para1 = "", $para2 = "", $para3 = "")
    {
        if (!$this->crud_model->admin_permission('ticket')) {
            redirect(base_url() . 'index.php/admin');
        }
        if ($para1 == 'delete') {
            $this->db->where('ticket_id', $para2);
            $this->db->delete('ticket');
        } elseif ($para1 == 'list') {
            $this->db->order_by('ticket_id', 'desc');
            $page_data['tickets'] = $this->db->get('ticket')->result_array();
            $this->load->view('back/admin/ticket_list', $page_data);
        } elseif ($para1 == 'reply') {
            $data['message'] = $this->input->post('reply');
			$data['time'] = time();
			$data['from_where'] = json_encode(array('type'=>'admin','id'=>''));
			$data['to_where'] = $this->db->get_where('ticket_message',array('ticket_id'=>$para2))->row()->from_where;
			$data['ticket_id']= $para2;
			$data['view_status']= json_encode(array('user_show'=>'no','admin_show'=>'ok'));
			$data['subject']  = $this->db->get_where('ticket_message',array('ticket_id'=>$para2))->row()->subject;
            $this->db->insert('ticket_message',$data);
        } elseif ($para1 == 'view') {
            $page_data['message_data'] = $this->db->get_where('ticket', array(
                'ticket_id' => $para2
            ))->result_array();
			$this->crud_model->ticket_message_viewed($para2,'admin');
			$page_data['tic']=$para2;
            $this->load->view('back/admin/ticket_view', $page_data);
        } else if ($para1 == 'view_user') {
            $page_data['user_data'] = $this->db->get_where('user', array(
                'user_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/user_view', $page_data);
        } elseif ($para1 == 'reply_form') {
            $page_data['message_data'] = $this->db->get_where('ticket', array(
                'ticket_id' => $para2
            ))->result_array();
            $this->load->view('back/admin/ticket_reply', $page_data);
        } else {
            $page_data['page_name']        = "ticket";
            $page_data['tickets'] = $this->db->get('ticket')->result_array();
            $this->load->view('back/index', $page_data);
        }
    }
	function display_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('display_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        $page_data['page_name'] = "display_settings";
        $page_data['tab_name']  = $para1;
        $this->load->view('back/index', $page_data);
    }
	function preloader_view($para1 = "")
    {
        if (!$this->crud_model->admin_permission('display_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        $page_data['from_admin'] = true;
        $page_data['preloader']  = $para1;
        $this->load->view('front/preloader', $page_data);
    }
	function captha_n_social_settings($para1 = "")
    {
        if (!$this->crud_model->admin_permission('captha_n_social_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        $page_data['page_name'] = "captha_n_social_settings";
        $page_data['tab_name']  = $para1;
        $this->load->view('back/index', $page_data);
    }
	function google_api_key($para1 = "")
    {
        if (!$this->crud_model->admin_permission('captha_n_social_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
        $this->db->where('type', "google_api_key");
        $this->db->update('general_settings', array(
            'value' => $this->input->post('api_key')
        ));
        recache();
    }
	function currency_settings($para1 = "",$para2 = ""){
		if (!$this->crud_model->admin_permission('business_settings')) {
            redirect(base_url() . 'index.php/admin');
        }
		if($para1 =='set_rate'){
			if($this->input->post('exchange')){
				echo $data['exchange_rate']    		= $this->input->post('exchange');
			}
			if($this->input->post('exchange_def')){
				echo $data['exchange_rate_def']    	= $this->input->post('exchange_def');
			}
			if($this->input->post('name')){
				echo $data['name']    	= $this->input->post('name');
			}
			if($this->input->post('symbol')){
				echo $data['symbol']    	= $this->input->post('symbol');
			}
            $this->db->where('currency_settings_id', $para2);
            $this->db->update('currency_settings', $data);
            recache();
		}
	}
	function default_images($para1 = "",$para2 = "")
    {
        if (!$this->crud_model->admin_permission('default_images')) {
            redirect(base_url() . 'index.php/admin');
        }
		if($para1 == "set_images"){
			move_uploaded_file($_FILES[$para2]['tmp_name'], 'uploads/'.$para2.'/default.jpg');
			recache();
		}
		$page_data['default_list'] = array('product_image','digital_logo_image','category_image','sub_category_image','brand_image','blog_image','banner_image','user_image','vendor_logo_image','vendor_banner_image','membership_image','slides_image');
        $page_data['page_name'] = "default_images";
        $this->load->view('back/index', $page_data);
    }
	function theme_part(){
        $this->load->view('back/admin/theme_part');
	}
	function logo_part(){
        $this->load->view('back/admin/logo_part');
	}
	function preloader_part(){
		
        $this->load->view('back/admin/preloader_settings');
	}
	function font_part(){
		
        $this->load->view('back/admin/font');
	}
	function favicon_part(){
		
        $this->load->view('back/admin/favicon');
	}
	function home_part(){
        $this->load->view('back/admin/home_settings');
	}
	function contact_part(){
        $this->load->view('back/admin/contact_set');
	}
	function footer_part(){
        $this->load->view('back/admin/footer_set');
	}
	function home_item_change($para1=""){
        $this->load->view('back/admin/home_change_'.$para1);
	}

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */