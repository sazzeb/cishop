<?php
class Templates extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function _draw_top_nav_jqm($customer_id)
{
  $top_nav_btns = [
    ['text' => 'Home', 'icon' => 'home', 'btn_target_url' => base_url()],
    ['text' => 'Login', 'icon' => 'action', 'btn_target_url' => base_url().'youraccount/login'],
    ['text' => 'Account', 'icon' => 'user', 'btn_target_url' => base_url().'youraccount/welcome'],
    ['text' => 'Contact', 'icon' => 'phone', 'btn_target_url' => base_url().'contactus'],
    ['text' => 'Basket', 'icon' => 'shop', 'btn_target_url' => base_url().'cart'],
  ];

  if((is_numeric($customer_id)) AND ($customer_id>0))
  {
    //customer is logged in
    unset($top_nav_btns['1']);
  }else{
    unset($top_nav_btns['2']);
  }
  $data['top_nav_btns'] = $top_nav_btns;
  $data['current_url'] = current_url();
  $this->load->view('top_nav_jqm', $data);
}

function _draw_page_top()
{
  $this->load->module('site_security');
  $shopper_id = $this->site_security->_get_user_id();
  $this->_draw_page_top_lhs();
  $this->_draw_page_top_min($shopper_id);
  $this->_draw_page_top_rhs($shopper_id);
}

function _draw_page_top_min($shopper_id)
{
  if((is_numeric($shopper_id)) AND ($shopper_id>0))
  {
    $view_file = 'page_top_mid_in';
  }else{
    $view_file = 'page_top_mid_out';
  }
  $this->load->view($view_file);
}


function _draw_page_top_rhs($shopper_id)
{
  $this->load->module('cart');
  $this->load->module('site_settings');
  $cart_data['shopper_id'] = $shopper_id;
  $cart_data['customer_session_id'] = $this->session->session_id;
  $cart_data['table'] = 'store_basket';
  $cart_data['add_shipping'] = FALSE;
  $cart_total = $this->cart->_cal_cart_total($cart_data);
  if ($cart_total< 0.01)
  {
    $cart_info = 'Your Basket Is Empty';
  }else{
    $cart_total_desc = number_format($cart_total, 2);
    $cart_total_desc = str_replace('.00', '', $cart_total_desc);
    $currency_symbol = $this->site_settings->_get_currency_symbol();
    $cart_info = 'Basket Total: '.$currency_symbol.$cart_total_desc;
  }
  $data['cart_info'] = $cart_info;
  $this->load->view('page_top_rhs', $data);
}


function _draw_page_top_lhs()
{
  $this->load->view('page_top_lhs');

}

function _draw_breadcrumbs($data)
{
  //NOTE: for this to work, data must contain;
  //template, current_page_title, breadcrumbs_array
  $this->load->view('breadcrumbs_public_bootstrap', $data);
}

function test() 
{
    $data = "";
    $this->public_bootstrap($data);    
}

function login($data) 
{
    if (!isset($data['view_module'])) {
      $data['view_module'] = $this->uri->segment(1);
    }

    $this->load->view('login_page', $data);
}

function public_bootstrap($data) 
{
    if (!isset($data['view_module'])) {
      $data['view_module'] = $this->uri->segment(1);
    }

    $this->load->module('site_security');
    $data['customer_id'] = $this->site_security->_get_user_id();

    $this->load->view('public_bootstrap', $data);
}

function public_jqm($data) 
{

    if (!isset($data['view_module'])) {
      $data['view_module'] = $this->uri->segment(1);
    }
    $this->load->module('site_security');
    $data['customer_id'] = $this->site_security->_get_user_id();
    $this->load->view('public_jqm', $data);
}

function admin($data) 
{

    if (!isset($data['view_module'])) {
      $data['view_module'] = $this->uri->segment(1);
    }

    $this->load->view('admin', $data);
}

}