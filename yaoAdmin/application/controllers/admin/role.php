<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->pageData = array();
        $this->load->library('AdminAction');
    }

    function index()
    {
        $this->adminaction->act_verify = 'ROLE_LIST';
        $this->pageData['actionInfo'] = $this->adminaction->checkCurrentAction();

        $data['roles'] = $this->db->get('admin_role')->result_array();
        $this->pageData['content'] = $this->load->view('admin/role_index', $data, TRUE);
        $this->load->view('admin/layout', $this->pageData);
    }

    function edit($id)
    {
        $this->adminaction->act_verify = 'ROLE_EDIT';
        $this->pageData['actionInfo'] = $this->adminaction->checkCurrentAction();

        $id = intval($id);
        if ( $this->input->post('submit') ) {
            $save_data = array(
                'name'=>$this->input->post('roleName'),
                'act'=>serialize($this->input->post('roleAct')),
            );
            $this->db->where('id', $id);
            $this->db->update('admin_role', $save_data);
            header('Location: /admin/role/index');
        }
        $this->pageData['title'] = '权限管理';
        $data['act'] = $this->adminaction->getAllAdminActions();
        $data['role'] = $this->db->get_where('admin_role', array('id'=>$id), 1)->row_array();
        $this->pageData['content'] = $this->load->view('admin/role_add', $data, TRUE);
        $this->load->view('admin/layout', $this->pageData);
    }

    function add()
    {
        $this->adminaction->act_verify = 'ROLE_ADD';
        $this->pageData['actionInfo'] = $this->adminaction->checkCurrentAction();

        if ( $this->input->post('submit') ) {
            $save_data = array(
                'name'=>$this->input->post('roleName'),
                'act'=>serialize($this->input->post('roleAct')),
            );
            $this->db->insert('admin_role', $save_data);
            header('Location: /admin/role/index');
        }
        $data['act'] = $this->adminaction->getAllAdminActions();
        $data['role'] = array('name'=>'', 'act'=>"a:0:{}");
        $this->pageData['content'] = $this->load->view('admin/role_add', $data, TRUE);
        $this->load->view('admin/layout', $this->pageData);
    }

    function delete($id)
    {
        $this->adminaction->act_verify = 'ROLE_DELETE';
        $this->adminaction->checkCurrentAction();

        $id = intval($id);
        $this->db->where('id', $id);
        $this->db->delete('admin_role');
        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

}
