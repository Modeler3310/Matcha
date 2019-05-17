<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller 
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

    public function show( $id )
    {
        $this->User_managment->addNotifiction($this->session->username . ' visite votre profile', $id);
        $this->User_managment->addToVisitHistory( $id );
        $data['csslist'] = array ( base_url().'assets/css/main.css', base_url().'assets/css/chat.css', base_url().'assets/css/style.css' );
        $data['jslist'] = array(base_url().'assets/js/notif.js', base_url().'assets/js/block.js', base_url().'assets/js/like.js', base_url().'assets/js/show_image.js', base_url().'assets/js/chat.js');
        $data['meetphoto'] = base_url() . '/assets/pics/meet.jpg';
        $data['photos'] = $this->User_ressources->getUserPictures( $id );
        $data['user'] = $this->User_ressources->getUserInfos( $id );
        $data['tags'] = $this->User_ressources->getUserTags( $id );
        $data['liked'] = $this->User_ressources->isLiked( $id );
        $data['blocked'] = $this->User_ressources->isBlocked( $id );
        $data['reported'] = $this->User_ressources->isFake( $id );
        $data['baseurl'] = base_url();
        $this->load->view('layout/header', $data);
        $this->load->view('profile/index', $data);
        $this->load->view('chat', $data);
        $this->load->view('layout/footer', $data);
    }
}