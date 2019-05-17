<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Photos extends CI_Controller 
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
        $data['jslist'] = array( base_url().'assets/js/delphoto.js', base_url().'assets/js/chat.js', base_url().'assets/js/notif.js' );
        $data['photos'] = $this->User_ressources->getUserPictures( $this->session->uid );
        $data['meetphoto'] = base_url() . '/assets/pics/meet.jpg';
        $data['baseurl'] = base_url();
        $this->load->view('layout/header', $data);
        $this->load->view('profile/photos', $data);
        $this->load->view('chat', $data);
        $this->load->view('layout/footer', $data);
    }

    public function upload()
    {
        echo $this->User_managment->addPhoto();
        header('Location: /photos/');
    }
}