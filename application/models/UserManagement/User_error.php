<?php

class User_error extends CI_Model
{
    public static function toMsg( $errno )
    {
        if ($errno === USER_ALREADY_EXISTS)
         return 'User already exists';
        if ($errno === USER_NOT_VALIDATED)
         return 'Please check your email to find validation link';
        if ($errno === USER_ALREADY_EXISTS)
         return 'User already exists';
        if ($errno === WRONG_PASSWORD)
         return 'Incorrect password';
        return 'Error '.$errno;
    }
}