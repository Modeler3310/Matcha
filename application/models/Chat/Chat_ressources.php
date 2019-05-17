<?php

class Chat_ressources extends CI_Model
{
    private $uid;

    public function __construct()
    {
        parent::__construct();
        $this->uid = $this->session->uid;

    }

    public function sendMessage($content, $user_dest)
    {
        $sql = 'INSERT INTO chat (id_user1, id_user2, msg, `time`, new) VALUES (?, ?, ?, CURRENT_TIMESTAMP, 1)';
        $stmt = $this->db->query($sql, array($this->uid, $user_dest, htmlspecialchars($content)));
        $this->User_managment->addNotifiction( $this->session->username . ' vous a envoyé un message', $user_dest);
        return $stmt;

    }

    public function getMessagesOf($uid_with)
    {
        $sql = 'SELECT chat.id as mid, users.username as username, msg, `time` FROM chat LEFT JOIN users ON users.id = chat.id_user1 WHERE (id_user1 = ? and id_user2 = ?) or (id_user2 = ? and id_user1 = ?) ORDER BY `time`';
        $msg = $this->db->query($sql, array(
                $this->uid, 
                $uid_with,
                $this->uid, 
                $uid_with
        ));
        return $this->Database_transform->fetchAll($msg);
    }

    public function getNewMessagesOf($uid_with, $lasttime, $mid)
    {
        $sql = 'SELECT chat.id as mid, users.username as username, msg, `time` FROM chat LEFT JOIN users ON users.id = chat.id_user1 WHERE ((id_user1 = ? and id_user2 = ?) or (id_user2 = ? and id_user1 = ?)) and chat.id != ? and `time` > ? ORDER BY `time`';
        $msg = $this->db->query($sql, array(
            $this->uid, 
            $uid_with,
            $this->uid, 
            $uid_with,
            $mid,
            $lasttime
        ));
        $sql = 'UPDATE chat SET new = 0 WHERE ((id_user1 = ? and id_user2 = ?) or (id_user2 = ? and id_user1 = ?)) and new=1';
        $stmt = $this->db->query($sql, array(
            $this->uid, 
            $uid_with,
            $this->uid, 
            $uid_with
        ));
        return json_encode($this->Database_transform->fetchAll($msg));
    }
}