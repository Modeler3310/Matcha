<?php

class Password extends CI_Model
{
    public static function hashpassword( $password )
    {
        $hash = hash('whirlpool', 'Anrv_' . $password . 'Jdk4_8');
        return $hash;
    }
}