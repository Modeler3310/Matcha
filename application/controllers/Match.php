<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Match extends CI_Controller 
{

    private $matchs;

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

    private function _search()
    {
        $res = $this->User_managment->getLastLocation($this->session->uid);
        $data = array('matchs' => $this->matchs, 'res' => $res);
        $data['csslist'] = array ( base_url().'assets/css/main.css', base_url().'assets/css/chat.css', base_url().'assets/css/style.css' );
        $data['jslist'] = array (  base_url().'assets/js/notif.js',base_url().'assets/js/chat.js', base_url().'assets/js/match.js', base_url().'assets/js/search_slider.js', base_url().'assets/js/search.js',base_url().'assets/js/userlocation.js' );
        $data['meetphoto'] = base_url() . '/assets/pics/meet.jpg';
        $data['baseurl'] = base_url();
        $this->load->view('layout/header', $data);
        $this->load->view('search/index', $data);
        $this->load->view('chat', $data);
        $this->load->view('layout/footer', $data);
    }

    private function _classic($agelow = 18, $ageHigh = 45, $distance = 5000, $commonTags = 0)
    {
        $this->matchs = $this->User_ressources->getMatchingProfiles($agelow, $ageHigh, $distance, $commonTags);
    }

    public function index($by = 'none', $agelow = 18, $ageHigh = 45, $distance = 5000, $commonTags = 0)
    {

        if (!$this->User_ressources->profileCompleted())
            header ('Location: /edit/');
        $tags = $this->input->post('tags');

        if ($by != 'none')
        {
            if ($tags != '')
            {
                $this->_searchTagsBy($tags, $by, $agelow, $ageHigh, $distance, $commonTags);
            }
            else
            {
                $this->_searchBy($by, $agelow, $ageHigh, $distance, $commonTags);
            }
        }
        else if ($tags != '')
        {
            $this->_searchTags($tags, $agelow, $ageHigh, $distance, $commonTags);
        }
        else
        {
            $this->_classic($agelow, $ageHigh, $distance, $commonTags);
        }
        $this->_search();
    }


    private function _searchBy($by, $agelow = 18, $ageHigh = 45, $distance = 5000, $commonTags = 0)
    {
        if (!($by === 'age' || $by === 'distance' || $by === 'pop_score' || $by === 'tags_in_common'))
            $by = 'age';
        $this->matchs = $this->User_ressources->getMatchingProfilesBy($by, $agelow, $ageHigh, $distance, $commonTags);
    }

    private function _searchTags($tags, $agelow = 18, $ageHigh = 45, $distance = 5000, $commonTags = 0)
    {
        $this->matchs = $this->User_ressources->getMatchingProfiles($agelow, $ageHigh, $distance, $commonTags);
    }

    private function _searchTagsBy( $tags, $by, $agelow = 18, $ageHigh = 45, $distance = 5000, $commonTags = 0)
    {
        $this->matchs = $this->User_ressources->getMatchingProfiles($agelow, $ageHigh, $distance, $commonTags);

    }

    public function sid()
    {
        echo session_id();
    }

    public function json($agelow = 18, $ageHigh = 99, $distance = 50000, $commonTags = 0)
    {
        echo json_encode($this->User_ressources->getMatchingProfiles($agelow, $ageHigh, $distance, $commonTags)->result_array());
    }

    public function json_photo($id)
    {
        echo json_encode($this->User_ressources->getUserPictures($id));
    }

    public function test()
    {
       echo  $this->User_ressources->profileCompleted();
    }

}