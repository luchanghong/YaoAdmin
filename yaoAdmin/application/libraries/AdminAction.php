<?php
if ( !defined('BASEPATH') ) { exit( 'No direct script access allowed' ); }

class AdminAction {
    private $CI;
    private $db;
    private $admin_id;
    private $act_arr = array();
    public $cur_act = array();
    public $act_verify;

    function __construct() {
        $this->CI = & get_instance();
        $this->db = $this->CI->db;
        $this->admin_id = $this->CI->session->userdata('admin_id');

        $this->cur_act = $this->getCurrentRoleActions();
    }

    function checkCurrentAction() {
        $role_status = false;
        if ($this->act_verify) {
            $cur_role = $this->cur_act;
            foreach ($cur_role as $value) {
                foreach ($value['subact'] as $act) {
                    if ($act['verify'] == $this->act_verify ) {
                        $role_status = true;
                    }
                }
            }
        }
        if (!$role_status) {
            exit('无权限访问');
        }
        return $this->getActionInfoByVerify($this->act_verify);
    }

    function getCurrentRoleActions() {
        $act_arr = $this->getAdminUserActions();
        $all_act = $this->getAllAdminActions();
        foreach ($all_act as $key=>&$val) {
            if (!empty($val['subact'])) {
                foreach ($val['subact'] as $k=>&$v) {
                    if (!in_array($v['id'], $act_arr)) {
                        unset($val['subact'][$k]);
                    }
                }
            }

            if (empty($val['subact'])) { unset($all_act[$key]); }
        }

        return $all_act;
    }

    function getAdminUserActions() {
        $this->db->select('r.act');
        $this->db->from('admin_role as r');
        $this->db->join('admin_user as u', 'u.rid = r.id', 'left');
        $this->db->where('u.id', $this->admin_id);
        $query = $this->db->get();

        if ( $query->num_rows() > 0 ) {
            $act = $query->row()->act;
            return unserialize($act);
        }
        else {
            header('Location: /admin');
            exit('请登陆！');
        }
    }

    function getAllAdminActions($pid = 0) {
        $this->db->select('id,pid,icon,title,target,verify,display,orderby');
        $this->db->from('admin_action');
        $this->db->where('pid', $pid);
        $this->db->order_by('orderby', 'asc');
        $query = $this->db->get();

        if ( $query->num_rows() > 0 ) {
            foreach ( $query->result_array() as $act ) {
                if ( 0 == $act['pid'] ) {
                    $act['subact'] = array();
                    $this->act_arr[$act['id']] = $act;
                }
                else {
                    $this->act_arr[$act['pid']]['subact'][] = $act;
                }
                $this->getAllAdminActions($act['id']);
            }
        }
        return $this->act_arr;
    }

    function getActionInfoByVerify($verify)
    {
        $this->db->select('id,pid,icon,title,target,verify,display,orderby');
        $this->db->from('admin_action');
        $this->db->where('verify', $verify);
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) {
            return $query->row_array();
        }
        return array();
    }

    function getActionInfoById($id)
    {
        $this->db->select('id,pid,icon,title,target,verify,display,orderby');
        $this->db->from('admin_action');
        $this->db->where('id', $id);
        $query = $this->db->get();
        if ( $query->num_rows() > 0 ) {
            return $query->row_array();
        }
        return array();
    }
}
