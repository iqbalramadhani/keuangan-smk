<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
    {
        // To inherit directly the attributes of the parent class.
        parent::__construct();

        $CI =& get_instance();
        date_default_timezone_set("Asia/Jakarta");

    }

    public function render($view,$data=null){
        $data['title'] =  $this->title;
        $data['module'] = $this->module;
        $this->load->view('template/header',$data);
        $this->load->view($this->module.'/css');
        $this->load->view($this->module.'/'.$view,$data);
        $this->load->view($this->module.'/js');
        $this->load->view('template/footer');
    }

    public function renderCss($module){
        $this->load->view($module.'/css');
    }
}
