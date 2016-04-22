<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Action extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->pageData = array();
        $this->load->library('AdminAction');
        $this->uid = $this->session->userdata('admin_id');
        $this->uname = $this->session->userdata('admin_name');
    }

    function index()
    {
        $this->adminaction->act_verify = 'ACTION_LIST';
        $this->pageData['actionInfo'] = $this->adminaction->checkCurrentAction();

        $data['act'] = $this->adminaction->getAllAdminActions();
        $this->pageData['content'] = $this->load->view('admin/action_index', $data, true);
        $this->load->view('admin/layout', $this->pageData);
    }

    function edit($id)
    {
        $this->adminaction->act_verify = 'ACTION_EDIT';
        $this->pageData['actionInfo'] = $this->adminaction->checkCurrentAction();

        // for save
        if ( $this->input->post('submit') ) {
            $save_data = array(
                'pid'=>$this->input->post('pid'),
                'icon'=>$this->input->post('icon'),
                'title'=>$this->input->post('title'),
                'target'=>$this->input->post('target'),
                'verify'=>$this->input->post('verify'),
                'display'=>$this->input->post('display'),
                'orderby'=>$this->input->post('orderby'),
            );
            $this->db->where('id', $id);
            $this->db->update('admin_action', $save_data);
            header('Location: /admin/action/index');
        }

        $data['act'] = $this->adminaction->getActionInfoById($id);
        $data['top_act'] = $this->adminaction->getAllAdminActions();
        $this->pageData['content'] = $this->load->view('admin/action_add', $data, true);
        $this->load->view('admin/layout', $this->pageData);
    }

    function add()
    {
        $this->adminaction->act_verify = 'ACTION_ADD';
        $this->pageData['actionInfo'] = $this->adminaction->checkCurrentAction();
        // for save
        if ( $this->input->post('submit') ) {
            $save_data = array(
                'pid'=>$this->input->post('pid'),
                'icon'=>strval($this->input->post('icon')),
                'title'=>$this->input->post('title'),
                'target'=>$this->input->post('target'),
                'verify'=>$this->input->post('verify'),
                'display'=>$this->input->post('display'),
                'orderby'=>$this->input->post('orderby'),
            );
            $this->db->insert('admin_action', $save_data);
            header('Location: /admin/action/index');
        }

        $data['act'] = array('pid' => '', 'title'=>'', 'icon'=>'', 'target'=>'', 'verify'=>'', 'display'=>'', 'orderby'=>'');
        $data['top_act'] = $this->adminaction->getAllAdminActions();
        $this->pageData['content'] = $this->load->view('admin/action_add', $data, true);
        $this->load->view('admin/layout', $this->pageData);
    }

    function delete($id)
    {
        $this->adminaction->act_verify = 'ACTION_DELETE';
        $this->adminaction->checkCurrentAction();

        $id = intval($id);
        $this->db->where('id', $id);
        $this->db->or_where('pid', $id);
        $this->db->delete('admin_action');

        header('Location: /admin/action/index');
    }
}
