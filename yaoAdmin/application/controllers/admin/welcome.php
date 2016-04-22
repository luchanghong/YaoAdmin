<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->pageData = array();
    }

    function index()
    {
        $this->pageData['title'] = '欢迎使用yaoAdmin';
        $this->load->view('admin/welcome', $this->pageData);
    }

}
