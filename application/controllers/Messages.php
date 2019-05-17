<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Messages extends CI_Controller 
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
        $data['csslist'] = array ( base_url().'assets/css/main.css', base_url().'assets/css/chat.css', base_url().'assets/css/style.css' );
        $data['jslist'] = array ( base_url().'assets/js/chat.js', base_url().'assets/js/match.js', base_url().'assets/js/notif.js', base_url().'assets/js/like.js');
        $data['matchs'] = $this->User_ressources->getMatches();
        $data['meetphoto'] = base_url() . '/assets/pics/meet.jpg';
        $data['baseurl'] = base_url();
        $this->load->view('layout/header', $data);
        $this->load->view('message/index', $data);
        //$this->load->view('chat', $data);
        $this->load->view('layout/footer', $data);
    }



}
