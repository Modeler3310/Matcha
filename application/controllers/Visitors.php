<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Visitors extends CI_Controller 
{

    public function __construct()
    {
        parent::__construct();
        $this->db->db_select('c0matcha');
        if (!isset($this->session->uid))
        {
            echo 'You are not logged';
            exit ;
        }

    }

    public function index()
    {
        $data['visitors'] = $this->User_ressources->GetVisitHistory();
        $data['csslist'] = array ( base_url().'assets/css/main.css', base_url().'assets/css/chat.css', base_url().'assets/css/style.css' );
        $data['jslist'] = array ( base_url().'assets/js/notif.js' );
        $data['meetphoto'] = base_url() . '/assets/pics/meet.jpg';
        $data['baseurl'] = base_url();
        $this->load->view('layout/header', $data);
        $this->load->view('visitors', $data);
        $this->load->view('layout/footer', $data);
    }
}