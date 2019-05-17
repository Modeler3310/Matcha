<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Manage extends CI_Controller 
{

    private $id, $uname;


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


    public function report(  )
    {
        $this->id = $this->input->post('uid'); 
        echo  $this->id;
        if ( $this->id == NULL)
            exit;
        echo $this->User_managment->requireValidation( $this->id );
    }

    public function block(  )
    {
        $this->id = $this->input->post('uid'); 
        echo  $this->id;
        if ( $this->id == NULL)
            exit;
        echo $this->User_managment->blockSomebody( $this->id );
    }

    public function unblock(  )
    {
        $this->id = $this->input->post('uid'); 
        echo  $this->id;
        if ( $this->id == NULL)
            exit;
        echo $this->User_managment->unblockSomebody( $this->id );
    }

    public function like(  )
    {
        $this->id = $this->input->post('uid'); 
        echo  $this->id;
        if ( $this->id == NULL)
            exit;
        echo $this->User_managment->likeSomebody( $this->id );
    }

    public function unlike( )
    {
        $this->id = $this->input->post('uid'); 
        echo  $this->id;
        if ( $this->id == NULL)
            exit;
        echo $this->User_managment->unlikeSomebody( $this->id );
    }

    public function test()
    {
        echo 'test';
    }

    public function update()
    {
        echo '<pre>';
        print_r($_POST);
        echo('</pre>');
        if ($this->input->post('first_name') == '' OR $this->input->post('last_name') == '' OR 
        $this->input->post('email') == '' OR $this->input->post('birthday') == '' OR 
        $this->input->post('gender') == '' OR $this->input->post('sex_pref') == '' OR
        $this->input->post('about') == '')
        {
            echo 'fail';
            header('Location: /edit');
        }
        else
        {
            $data = array(
                'email' => $this->input->post('email', true),
                'genre' => $this->input->post('gender'),
                'biography' => $this->input->post('about', true),
                'orientation' => $this->input->post('sex_pref'),
                'birthday' => $this->input->post('birthday'),
                'name' => $this->input->post('first_name', true),
                'lastname' => $this->input->post('last_name', true),
            );
           echo 'updade '. $this->User_managment->updateProfile($data);
            header('Location: /edit');
        }
    }

    public function deltag( $tag )
    {
        echo $tag;
        echo $this->User_managment->deleteTag('#'.$tag);
    }

    public function addtag( )
    {
        $tag = $this->input->post('tag', true);
        if ($tag != '')
            echo $this->User_managment->updateInterests(array('#'.str_replace('#', '', $tag)));
        else 
        {
            echo '0';
        }
        header('Location: /edit');
    }

     public function delpic()
     {
        $pid = $this->input->post('pid');
        if ($pid != '')
            echo $this->User_managment->deletePicture($pid);
        else 
            echo '0';
     }

     public function setProfilePicture()
     {
        $pid = $this->input->post('pid');
        if ($pid != '')
            echo $this->User_managment->changeProfilePicture($pid);
        else 
        {
            echo '0';
        }
        header('Location: /photos');
     }

    public function getNotifs()
    {
        echo json_encode($this->User_ressources->fetchNotifications());
    }

    public function getNotifsNumber()
    {
        echo $this->User_ressources->fetchNotificationsNumber();
    }

    public function checkEmail( )
    {
        echo $this->User_managment->checkUniqUser($this->session->username, $this->input->post('email'), $this->session->uid);
    }

    public function changePass()
    {
        echo $this->User_managment->initChangePassword();
    }

    public function testLoc()
    {
       echo $this->User_managment->checkLocationAndUpdate(0,0,1);
    }
}