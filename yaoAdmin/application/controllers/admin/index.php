<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('AdminAction');
        $this->pageData = array();
    }

    function index()
    {
        $this->adminaction->act_verify = 'ADMIN_INDEX';
        $this->pageData['actionInfo'] = $this->adminaction->checkCurrentAction();
        $content = $this->load->view('admin/index', array(), TRUE);
        $this->pageData['content'] = $content;
        $this->load->view('admin/layout', $this->pageData);
    }
}
