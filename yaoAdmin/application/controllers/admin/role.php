<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Role extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('AdminAction');
    }

    function index()
    {
        $this->adminaction->act_verify = 'ROLE_LIST';
        $this->adminaction->checkCurrentAction();
        $data = array(
            'title'=>'权限管理',
            'subtitle'=>'权限列表',
        );
        $data['roles'] = $this->db->get('admin_role')->result_array();
        $main = $this->load->view('admin/role_index', $data, TRUE);
        $this->load->view('admin/index', array('content'=>$main));
    }

    function edit($id)
    {
        $this->adminaction->act_verify = 'ROLE_EDIT';
        $this->adminaction->checkCurrentAction();
        $id = isLegalId($id);
        if ( $this->input->post('submit') ) {
            $save_data = array(
                'name'=>$this->input->post('roleName'),
                'act'=>serialize($this->input->post('roleAct')),
            );
            $this->db->where('id', $id);
            $this->db->update('admin_role', $save_data);
            header('Location: /admin/role/index');
        }
        $data = array(
            'title'=>'权限管理',
            'subtitle'=>'权限编辑',
        );
        $data['act'] = $this->adminaction->getAllAdminActions();
        $data['role'] = $this->db->get_where('admin_role', array('id'=>$id), 1)->row_array();
        $main = $this->load->view('admin/role_add', $data, TRUE);
        $this->load->view('admin/index', array('content'=>$main));
    }

    function add()
    {
        $this->adminaction->act_verify = 'ROLE_ADD';
        $this->adminaction->checkCurrentAction();
        if ( $this->input->post('submit') ) {
            $save_data = array(
                'name'=>$this->input->post('roleName'),
                'act'=>serialize($this->input->post('roleAct')),
            );
            $this->db->insert('admin_role', $save_data);
            header('Location: /admin/role/index');
        }
        $data = array(
            'title'=>'权限管理',
            'subtitle'=>'添加权限',
        );
        $data['act'] = $this->adminaction->getAllAdminActions();
        $data['role'] = array('name'=>'', 'act'=>"a:0:{}");
        $main = $this->load->view('admin/role_add', $data, TRUE);
        $this->load->view('admin/index', array('content'=>$main));
    }

    function match()
    {
        $this->adminaction->act_verify = 'ROLE_MATCH';
        $this->adminaction->checkCurrentAction();
        if ($this->input->post('submit')) {
            $uid = $this->input->post('userid');
            $rid = $this->input->post('rid');
            $this->db->delete('admin_user', array('uid'=>$uid));
            $this->db->insert('admin_user', array('uid'=>$uid, 'rid'=>$rid));
        }
        $data = array(
            'title'=>'权限管理',
            'subtitle'=>'分配权限',
        );
        $data['roles'] = $this->db->get('admin_role')->result_array();
        $main = $this->load->view('admin/role_match', $data, TRUE);
        $this->load->view('admin/index', array('content'=>$main));
    }

    function delete($id)
    {
        $this->adminaction->act_verify = 'ROLE_DELETE';
        $this->adminaction->checkCurrentAction();
        $id = isLegalId($id);
        $this->db->where('id', $id);
        $this->db->delete('admin_role');

        header('Location: '.$_SERVER['HTTP_REFERER']);
    }

}
