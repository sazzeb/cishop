<?php
class Contactus extends MX_Controller 
{

function __construct() {
parent::__construct();
}

function submit()
{
    $submit = trim($this->input->post('submit', TRUE));
    $refer_url = $_SERVER['HTTP_REFERER'];
    $target_refer_url = base_url().'contactus';
    $firstname = trim($this->input->post('firstname', TRUE));

    if($firstname != '')
    {
        $this->_blacklist_user();
    }

    if (($submit=="Submit") AND ($refer_url == $target_refer_url)) {
        //process the form
        $this->load->library('form_validation');
        $this->form_validation->set_rules('yourname', 'your name', 'required|max_length[60]');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('telnum', 'telephone number', 'required|max_length[20]');
        $this->form_validation->set_rules('message', 'message', 'required');

        if ($this->form_validation->run() == TRUE) {
            //get the variables
            $posted_data = $this->fetch_data_from_post();
            $this->load->module('enquiries');
            $this->load->module('site_security');

            //insert the message
            $data['code'] = $this->site_security->generate_random_string(6);
            $data['subject'] = 'Contact Form';
            $data['message'] = $this->build_msg($posted_data);
            $data['sent_to'] = 0;
            $data['date_created'] = time();
            $data['opened'] = 0;
            $data['sent_by'] = 0;
            $data['urgent'] = 0;
            $this->enquiries->_insert($data);
            redirect('contactus/thankyou');
            
        } else {
            //form submission error
            $this->index();
        }
    }
}

function build_msg($posted_data)
{
    $yourname = ucfirst($posted_data['yourname']);
    $msg = $yourname.' submitted the following information:<br><br>';
    $msg.= 'Name: '.$yourname."<br>";
    $msg.= 'Email: '.$posted_data['email']."<br>";
    $msg.= 'Telephone Number: '.$posted_data['telnum']."<br>";
    $msg.= 'Message: '.$posted_data['message']."<br>";
    return $msg;
}

function index()
{
    $this->load->module('site_settings');
    $is_mobile = $this->site_settings->is_mobile();
    $data = $this->fetch_data_from_post();
    $data['our_address'] = $this->site_settings->_get_our_address();
    $data['our_telnum'] = $this->site_settings->_get_our_telnum();
    $data['our_name'] = $this->site_settings->_get_our_name();
    $data['map_code'] = $this->site_settings->_get_map_code();
    $data['flash'] = $this->session->flashdata('item');
    $data['form_location'] = base_url().'contactus/submit';
    $data['view_file'] = "contactus";
    if($is_mobile==FALSE){
        $template = 'public_bootstrap';
    }else{
        $template = 'public_jqm';
        $data['view_file'].='_jqm';
    }
    $this->load->module('templates');
    $this->templates->$template($data);  
}

function thankyou()
{
    $this->load->module('site_settings');
    $is_mobile = $this->site_settings->is_mobile();
    $data['view_file'] = "thankyou";
    $this->load->module('templates');
    if($is_mobile == FALSE)
    {
        $template = 'public_bootstrap';
    }else{
        $template = 'public_jqm';
        $data['view_file'].= '_jqm';
    }
    $this->templates->$template($data);  
}

function fetch_data_from_post()
{
    $data['yourname'] = $this->input->post('yourname', TRUE);
    $data['email'] = $this->input->post('email', TRUE);
    $data['telnum'] = $this->input->post('telnum', TRUE);
    $data['message'] = $this->input->post('message', TRUE);
    return $data;
}


function _blacklist_user()
{
    $this->load->module('blacklist');
    $data['date_created'] = time();
    $data['ip_address'] = $this->input->ip_address;
    $this->blacklist->_insert($data);
}
}