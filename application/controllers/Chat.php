<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chat extends CI_Controller 
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

	public function getnewmessages($uid)
	{
        if ($this->input->post('time') === NULL OR $this->input->post('mid') === NULL)
            return ;
        $time = $this->input->post('time', TRUE);
        $mid = $this->input->post('mid', TRUE);
        $msg = $this->Chat_ressources->getNewMessagesOf($uid, $time, $mid);
        echo $msg;
    }
    
	public function getmessages($uid)
	{

        $msg = $this->Chat_ressources->getMessagesOf($uid);
        $data['messages'] = $msg;
        $data['username'] = $this->User_ressources->getUserInfos($uid)['username'];
        echo json_encode($data);
    }

    public function sendmessages($uid)
	{
        echo intval($this->User_ressources->isAMatch($uid));
        if (intval($this->User_ressources->isAMatch($uid)) === 0)
            return ;
        echo 'call';
        if ($this->input->post('content') === NULL)
            return ;
        echo $this->Chat_ressources->sendMessage($this->input->post('content', TRUE), $uid);
    }

    public function index()
    {
        $data['csslist'] = array ( base_url().'assets/css/main.css', base_url().'assets/css/chat.css', base_url().'assets/css/style.css' );
        $data['jslist'] = array ( base_url().'assets/js/chat.js', base_url().'assets/js/match.js', base_url().'assets/js/notif.js', base_url().'assets/js/like.js');
        $data['matchs'] = $this->User_ressources->getMatches();
        $data['meetphoto'] = base_url() . '/assets/pics/meet.jpg';
        $data['baseurl'] = base_url();
        $this->load->view('layout/header', $data);
        $this->load->view('matchs', $data);
        $this->load->view('chat', $data);
        $this->load->view('layout/footer', $data);
    }

    public function test()
    {
        $data['csslist'] = array ( base_url().'assets/css/chat.css' );
        $data['jslist'] = array ( base_url().'assets/js/chat.js');
        $data['matchs'] = $this->User_ressources->getMatches();
        $data['meetphoto'] = base_url() . '/assets/pics/meet.jpg';
        $data['baseurl'] = base_url();
        $this->load->view('layout/header', $data);
        $this->load->view('chat', $data);
        $this->load->view('layout/footer', $data);
    }

    public function isMatch()
    {
        echo json_encode($this->User_ressources->getMatches());
    }

    public function test2()
    {
        echo $_SERVER['SERVER_NAME'];
    }


}
