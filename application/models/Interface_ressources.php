<?php

class Interface_ressources extends CI_Model
{
    private $uid;

    public function __construct()
    {
        parent::__construct();
        $this->uid = $this->session->uid;
    }

    public function getListOfTags()
    {
        $sql = 'SELECT interest as it FROM `interests` WHERE 1 GROUP BY `interest`';
        $tags = $this->db->query($sql, array());
        return $tags->result_array();
    }

    public function getListOfTagsExcluding($uid)
    {
        $sql = 'SELECT interest as it FROM `interests` WHERE NOT find_in_set(interest, (SELECT GROUP_CONCAT(interest) FROM `interests` WHERE user_id = ?)) GROUP BY `interest`';
        $tags = $this->db->query($sql, array($uid));
        return $tags->result_array();
    }
}