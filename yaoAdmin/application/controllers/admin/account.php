<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->pageData = array();
    }

    function login()
    {
        $userName = $this->input->post('userName');
        $userPass = md5($this->input->post('password'));

        $this->db->select('u.id,u.name');
        $this->db->from('admin_user as u');
        $this->db->where(array('u.name'=>$userName, 'u.passwd'=>$userPass));
        $row = $this->db->get()->row_array();
        if ($row) {
            $admin_id = $row['id'];
            $admin_name = $row['name'];
            $this->session->set_userdata('admin_id', $admin_id);
            $this->session->set_userdata('admin_name', $admin_name);
            header('Location: /admin/index');
        } else {
            header('Location: /admin?login=error');
        }
    }

    function logout()
    {
        $this->session->sess_destroy();
        header('Location: /admin');
    }
}
