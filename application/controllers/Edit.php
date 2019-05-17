<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller 
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
        $data['csslist'] = array ( base_url().'assets/css/main.css', base_url().'assets/css/style.css' );
        $data['jslist'] = array ( base_url().'assets/js/edituser.js', base_url().'assets/js/notif.js' );
        $data['user'] = $this->User_ressources->getUserInfos( $this->session->uid );
        $data['tags'] = $this->User_ressources->getUserTags( $this->session->uid );
        $data['meetphoto'] = base_url() . '/assets/pics/meet.jpg';
        $data['baseurl'] = base_url();
        $this->load->view('layout/header', $data);
        $this->load->view('profile/edit', $data);
        $this->load->view('layout/footer', $data);
    }
}