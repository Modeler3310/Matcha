<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Location extends CI_Controller 
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

    public function updatelocation()
    {
        if ($this->input->post('lat') === NULL 
        OR $this->input->post('lon') === NULL
        OR $this->input->post('err') === NULL)
            return ;
        echo $this->User_managment->checkLocationAndUpdate($this->input->post('lat', TRUE), $this->input->post('lon', TRUE), $this->input->post('err', TRUE));
    }
}