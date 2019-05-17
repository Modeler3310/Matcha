<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller 
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
    
    public function index_signin()
    {
        if (isset($this->session->uid))
            exit ;
            $data['csslist'] = array ( base_url().'assets/css/main.css', base_url().'assets/css/style.css' );
            $data['jslist'] = array( base_url().'assets/js/login.js',  base_url().'assets/js/errors.js');
            $data['meetphoto'] = base_url() . '/assets/pics/meet.jpg';
            $data['baseurl'] = base_url();
            $this->load->view('layout/header', $data);
            $this->load->view('sign_in', $data);
            $this->load->view('layout/footer', $data);
    }

    public function index_signup()
    {
        $data['csslist'] = array ( base_url().'assets/css/main.css', base_url().'assets/css/style.css' );
        $data['jslist'] = array( base_url().'assets/js/signup.js', base_url().'assets/js/errors.js');
        $data['meetphoto'] = base_url() . '/assets/pics/meet.jpg';
        $data['baseurl'] = base_url();
        $this->load->view('layout/header', $data);
        $this->load->view('sign_up', $data);
        $this->load->view('layout/footer', $data);
    }

    public function logout()
    {
        $this->User_managment->logout();
        header('Location: /');
    }

    public function signin()
    {
        if (isset($this->session->uid))
            exit ;
        if ($this->input->post('username') == '' OR $this->input->post('password') == '')
        {
            echo '-11';
            return;
        }
        if (($uid = $this->User_managment->connectUser($this->input->post('username', TRUE), $this->input->post('password', TRUE))) > 0)
        {
             $this->session->uid = $uid;
             $this->session->username = $this->input->post('username', TRUE);
             echo $uid;
        }
        else
        {
            echo $uid;
        }
    }

    public function signup()
    {
        if (isset($this->session->uid))
            exit ;
        if ($this->input->post('username') === '' 
            OR $this->input->post('password') === ''
            OR $this->input->post('email') === ''
            OR $this->input->post('name') === ''
            OR $this->input->post('lname') === ''
            OR $this->input->post('password2') === '')
        {
            echo '-11';
        }
        else if ($this->input->post('password') != $this->input->post('password2'))
        {
            echo WRONG_PASSWORD;
        }
        else
        {
            if (($res = $this->User_managment->addUserToDB($this->input->post('username'), 
                $this->input->post('password'), 
                $this->input->post('email'),
                $this->input->post('name'), 
                $this->input->post('lname'))) > 0)
            {
                echo $res;
            }
            else
                echo $res;
                //echo $this->User_error->toMsg($uid);
        }
    }

    public function reset( $token )
    {
        if (strncmp ($token, 'reset_', 6) != 0)
            header('Location: /');
        $newpwd = $this->input->post('newpwd');
        if ($newpwd === NULL)
        {
            $data['csslist'] = array ( base_url().'assets/css/main.css', base_url().'assets/css/style.css' );
            $data['jslist'] = array( base_url().'assets/js/reset.js',  base_url().'assets/js/errors.js');
            $data['meetphoto'] = base_url() . '/assets/pics/meet.jpg';
            $data['token'] = $token;
            $data['baseurl'] = base_url();
            $this->load->view('layout/header', $data);
            $this->load->view('reset', $data);
            $this->load->view('layout/footer', $data);
        }
        else
            echo $this->User_managment->resetPassword( $token, $newpwd );
    }

    public function forgot_password()
    {
        if ($this->input->post('email') === NULL || $this->input->post('username') === NULL)
        {
            $data['csslist'] = array ( base_url().'assets/css/main.css', base_url().'assets/css/style.css' );
            $data['jslist'] = array( base_url().'assets/js/reset.js', base_url().'assets/js/errors.js');
            $data['meetphoto'] = base_url() . '/assets/pics/meet.jpg';
            $data['baseurl'] = base_url();
            $this->load->view('layout/header', $data);
            $this->load->view('forgot', $data);
            $this->load->view('layout/footer', $data);
        }
        else
        {
            echo $this->User_managment->initResetPassword($this->input->post('email') ,$this->input->post('username'));
        }
    }
}