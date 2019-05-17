<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $sql = file_get_contents('assets/c0matcha.sql');
        if (!$this->db->db_select('c0matcha'))
        {
            $this->session->sess_destroy();
            $this->db->query($sql);
            echo 'Initialized';
        }
        if (array_diff(array('block', 'chat', 'dislikes', 'interests', 'likes', 'notifications', 'profile_pictures', 'visit_history', 'users'), $this->db->list_tables()) !== array())
        {
            echo 'Missing tab corrected';
            $this->db->query($sql);
        }
    }

    public function index()
    {
        if (isset($this->session->uid))
            header('Location: /match/index');
        $data['csslist'] = array ( base_url().'assets/css/main.css', base_url().'assets/css/style.css');
        $data['meetphoto'] = base_url() . 'assets/pics/meet.jpg';
        $data['baseurl'] = base_url();
        $this->load->view('layout/header', $data);
        $this->load->view('index', $data);
        $this->load->view('layout/footer', $data);
    }


    public function validate( $uid )
    {
        echo $this->User_managment->validateAccount($uid);
        echo 'Your account have been validated. You can now login <a href="/">HERE</a>';
    }
}