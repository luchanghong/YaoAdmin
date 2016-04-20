<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
echo 'aaaa';exit;

class Index extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->library('AdminAction');
    }

    function index()
    {
        $data = array();
        $today_timestamp = strtotime(date('Y-m-d'));

        /*
        $data['new_register_count'] = $this->db->select('count(1) c', false)
            ->get_where('user', array('register_time >=' => $today_timestamp))
            ->row()->c;

        $data['new_song_count'] = $this->db->select('count(1) c', false)
            ->get_where('user_song', array('add_time >=' => $today_timestamp))
            ->row()->c;
        $data['new_song_user'] = $this->db->select('count(distinct uid) c', false)
            ->get_where('user_song', array('add_time >=' => $today_timestamp))
            ->row()->c;

        $data['new_song_liked_count'] = $this->db->select('count(1) c', false)
            ->get_where('user_song_liked', array('add_time >=' => $today_timestamp))
            ->row()->c;
        $data['new_song_liked_user'] = $this->db->select('count(distinct uid) c', false)
            ->get_where('user_song_liked', array('add_time >=' => $today_timestamp))
            ->row()->c;
        $data['new_song_liked_song'] = $this->db->select('count(distinct usid) c', false)
            ->get_where('user_song_liked', array('add_time >=' => $today_timestamp))
            ->row()->c;

        $data['song_collected_count'] = $this->db->select('count(1) c', false)
            ->get_where('user_song_collected', array('add_time >=' => $today_timestamp))
            ->row()->c;
        $data['song_collected_user'] = $this->db->select('count(distinct uid) c', false)
            ->get_where('user_song_collected', array('add_time >=' => $today_timestamp))
            ->row()->c;
        $data['song_collected_song'] = $this->db->select('count(distinct usid) c', false)
            ->get_where('user_song_collected', array('add_time >=' => $today_timestamp))
            ->row()->c;

        $data['all_user'] = $this->db->select('max(id) id', false)->get_where('user')->row()->id;
        $data['all_song'] = $this->db->select('max(id) id', false)->get_where('user_song')->row()->id;
         */

        $main = $this->load->view('admin/index_main', $data, TRUE);
        $this->load->view('admin/index', array('content'=>$main));
    }
}
