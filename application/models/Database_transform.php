<?php
 
 class Database_transform extends CI_Model
 {
     public static function fetchAll($stmt)
     {
        $TagsArray = array();
        foreach ($stmt->result_array() as $row) {
            array_push($TagsArray, $row);
        }
        return $TagsArray;
     }
 }