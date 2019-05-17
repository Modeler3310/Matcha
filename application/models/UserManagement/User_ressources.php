<?php

class User_ressources extends CI_Model
{
    private $uid;

    public function __construct()
    {
        parent::__construct();
        $this->uid = $this->session->uid;
    }

    public function getMatchingProfiles($lowAge = 18, $highAge = 99, $distance = 50000, $tagsInCommon = 0)
    {
        $user_id = $this->uid;
        $MyTags = $this->getUserTags($user_id);
        $res = $this->interestedIn($user_id);

        $sql = 'SELECT last_location as `location` FROM users WHERE id=?';
        $req = $this->db->query($sql, array($this->uid));
        $loc = $req->row_array()['location'];

        $sql = 'SELECT `sess_id`!="" AND TIMEDIFF(NOW(), last_login) < "02:00:00" as online, last_login, validated, users.id, username, `name`, lastname, genre, orientation, birthday, COUNT(likes.id) as pop_score, FLOOR(DATEDIFF(NOW(), users.birthday)/365.25) as age, 
        ST_Y(users.last_location) as lon, ST_X(users.last_location) as lat,
        ST_Distance_Sphere(users.last_location, ?) / 1000 as distance, (SELECT GROUP_CONCAT(interest) FROM interests WHERE interests.user_id = users.id) as tags,
            (SELECT COUNT(interest) FROM interests WHERE interests.user_id = users.id AND find_in_set(interest, ?)) as tags_in_common,
            (SELECT path FROM profile_pictures WHERE profile_pictures.user_id = users.id AND image_number = 1 LIMIT 1) as profilepicture
        FROM users 
                LEFT JOIN block ON block.id_user2=users.id OR block.id_user1=users.id
                LEFT JOIN likes ON likes.id_user2=users.id
                WHERE FLOOR(DATEDIFF(NOW(), users.birthday)/365) BETWEEN ? and ?
                AND ((find_in_set(genre, ?) AND find_in_set(orientation, ?))
                OR (find_in_set(genre, ?) AND find_in_set(orientation, ?)))
                AND block.id_user1 IS NULL
                AND NOT users.id = ?
                AND NOT users.id IN (SELECT id_user2 FROM likes WHERE id_user1 = ? and id_user2 = users.id)
                AND ST_Distance_Sphere(users.last_location, ?) / 1000 <= ?
                AND validated = 1
                AND (SELECT COUNT(interest) FROM interests WHERE interests.user_id = users.id AND find_in_set(interest, ?)) >= ?
                AND `biography` != "" AND birthday != "0000-00-00"
                GROUP BY users.id
                #ORDER BY distance, tags_in_common, pop_score DESC, age
                ORDER BY (age * distance * 3 / tags_in_common), pop_score DESC';
        $stmt = $this->db->query($sql, array(
                $loc,
                implode(",", $MyTags),
                $lowAge,
                $highAge,
                $res[0]['genre'], 
                $res[0]['orientation'], 
                $res[1]['genre'],
                $res[1]['orientation'],
                $user_id,
                $user_id,
                $loc,
                $distance,
                implode(",", $MyTags),
                $tagsInCommon
            )
        );
        return $stmt;
    }

    private function interestedIn($userid)
    {
        $sql = 'SELECT orientation, genre FROM users WHERE `id`=?';
        $stmt = $this->db->query($sql, array($userid));
        $user = $stmt->row_array();
        $orientation = $user['orientation'];
        $genre = $user['genre'];
        $res = array();

        if ($genre == 'male')
        {
            if ($orientation == 'hetero')
            {
                $res[0]['genre'] = 'female';
                $res[0]['orientation'] = 'hetero,bi';
                $res[1]['genre'] = 'female';
                $res[1]['orientation'] = 'hetero,bi';
            }
            if ($orientation == 'homo')
            {
                $res[0]['genre'] = 'male';
                $res[0]['orientation'] = 'homo,bi';
                $res[1]['genre'] = 'male';
                $res[1]['orientation'] = 'homo,bi';
            }
            if ($orientation == 'bi')
            {
                $res[0]['genre'] = 'male';
                $res[0]['orientation'] = 'homo,bi';
                $res[1]['genre'] = 'female';
                $res[1]['orientation'] = 'hetero,bi';
            }
        }
        if ($genre == 'female')
        {
            if ($orientation == 'hetero')
            {
                $res[0]['genre'] = 'male';
                $res[0]['orientation'] = 'hetero,bi';
                $res[1]['genre'] = 'male';
                $res[1]['orientation'] = 'hetero,bi';
            }
            if ($orientation == 'homo')
            {
                $res[0]['genre'] = 'female';
                $res[0]['orientation'] = 'homo,bi';
                $res[1]['genre'] = 'female';
                $res[1]['orientation'] = 'homo,bi';
            }
            if ($orientation == 'bi')
            {
                $res[0]['genre'] = 'female';
                $res[0]['orientation'] = 'homo,bi';
                $res[1]['genre'] = 'male';
                $res[1]['orientation'] = 'hetero,bi';
            }
        }
        if ($genre == 'other')
        {
            $res[0]['genre'] = 'male,female,other';
            $res[0]['orientation'] = 'hetero,homo,bi';
            $res[1]['genre'] = 'male,female,other';
            $res[1]['orientation'] = 'hetero,homo,bi';
        }
        return $res;
    }

    public function getUserPictures( $id )
    {
        $sql = 'SELECT profile_pictures.image_number as id, profile_pictures.path FROM profile_pictures WHERE `user_id`=? ORDER BY image_number';
        $stmt = $this->db->query($sql, array($id));
        return $stmt->result_array();
    }

    public function getUserInfos( $uid )
    {
        $sql = 'SELECT `sess_id`!="" AND TIMEDIFF(NOW(), last_login) < "02:00:00" as online,last_login,users.id, username, email, biography, `name`, lastname, genre, orientation, birthday, COUNT(likes.id) as pop_score, FLOOR(DATEDIFF(NOW(), users.birthday)/365.25) as age, 
        ST_Y(users.last_location) as lon, ST_X(users.last_location) as lat
        FROM users
        LEFT JOIN likes ON likes.id_user2=users.id
        WHERE users.id = ?
        GROUP BY users.id';
        $stmt = $this->db->query($sql, array($uid));
        return $stmt->row_array();
    }

    public function getUserTags( $id )
    {
        $sql = 'SELECT interests.interest as it FROM interests WHERE `user_id`=?';
        $stmt = $this->db->query($sql, array($id));
        return array_column($stmt->result_array(), 'it');
    }

    
    public function isAMatch($fuid)
    {
        $sql = 'SELECT users.id, username FROM likes as t2
        LEFT JOIN likes on likes.id_user1 = t2.id_user2
        LEFT JOIN users on users.id = t2.id_user1
        WHERE likes.id_user1 = ? AND t2.id_user1 = likes.id_user2 AND users.id = ?';
        $stmt = $this->db->query($sql, array($this->uid,$fuid));
        return $stmt->num_rows();
    }

    public function getMatches()
    {
        $sql = 'SELECT users.id, username FROM likes as t2
        LEFT JOIN likes on likes.id_user1 = t2.id_user2
        LEFT JOIN users on users.id = t2.id_user1
        WHERE likes.id_user1 = ? AND t2.id_user1 = likes.id_user2';
        $stmt = $this->db->query($sql, array($this->uid));
        return $stmt->result_array();
    }

    public function fetchNotifications()
    {
        //save notifs
        $sql = 'SELECT notifications.id as id, users.username AS username, `msg` FROM notifications LEFT JOIN users ON users.id = notifications.fk_user_from WHERE fk_user_dst = ?';
        $notifs = $this->db->query($sql, array($this->uid));
        //delete notifs
        $sql = 'DELETE FROM notifications WHERE fk_user_dst = ?';
        $stmt = $this->db->query($sql, array($this->uid));
        return $notifs->result_array();
    }

    public function fetchNotificationsNumber()
    {
        //save notifs
        $sql = 'SELECT id FROM notifications WHERE fk_user_dst = ?';
        $notifs = $this->db->query($sql, array($this->uid));
        return $notifs->num_rows();
    }

    public function GetVisitHistory()
    {
        $sql = 'SELECT username, users.id as id, date FROM visit_history LEFT JOIN users ON users.id = visit_history.visitor_id WHERE user_id = ?';
        $stmt = $this->db->query($sql, array($this->uid));
        return $stmt->result_array();
    }

    public function isLiked( $fid )
    {
        $sql = 'SELECT * FROM `likes` WHERE `id_user1`=? AND `id_user2` = ?';
        $stmt = $this->db->query($sql, array($this->uid, $fid));
        return $stmt->num_rows();
    }

    public function isBlocked( $fid )
    {
        $sql = 'SELECT * FROM `block` WHERE `id_user1`=? AND `id_user2` = ?';
        $stmt = $this->db->query($sql, array($this->uid, $fid));
        return $stmt->num_rows();
    }

    public function isFake($uid)
    {
        $sql = $this->db->query('SELECT validated FROM users WHERE id=?', array($uid));
        $user = $sql->row_array();
        return (strncmp($user['validated'], 'fake_', 5));
    }

    public function profileCompleted()
    {
        $sql = 'SELECT * FROM users WHERE id=? AND birthday != "0000-00-00" AND biography != ""';
        $stmt = $this->db->query($sql, array($this->uid));
        return $stmt->num_rows();
    }
}