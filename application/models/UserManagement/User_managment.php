<?php

class User_managment extends CI_Model
{
    private $validation_link = 0;
    private $uid = 0;

    public function __construct()
    {
        parent::__construct();
        if (isset($this->session->uid))
            $this->uid = $this->session->uid;
    }

    public function addUserToDB( $username, $password, $email, $name, $lastname)
    {
        if ($this->checkUniqUser( $username, $email ))
            return USER_ALREADY_EXISTS;
        $this->validation_link = uniqid('user_', true);
        if ($this->sendMail($username, $email))
        {
            $users = $this->db->query('INSERT INTO users(username, `password`, email, validated, `name`, lastname, genre, orientation) VALUES (?, ?, ?, ?, ? , ?, "male", "bi")', 
            array( $username, Password::hashpassword($password), $email, $this->validation_link, $name, $lastname));
            return $users;
        }
        else
            return SENDMAIL_ERROR;
    }

    public function requireValidation( $uid )
    {
        $sql = $this->db->query('SELECT email FROM users WHERE id=?', array($uid));
        $user = $sql->row_array();
        $this->validation_link = uniqid('fake_', true);
        if ($this->sendMailFake($user['email']))
        {
            $upd = $this->db->query('UPDATE users SET validated = ? WHERE id = ?', 
            array( $this->validation_link, $uid ));
            return $upd;
        }
        else
            return SENDMAIL_ERROR;
    }

    
    private function sendMailFake($email )
    {
        $msg = 'Hi, ';
        $msg .= "You've beek reported as fake account, please visit the following link to unlock: \r\n";
        $msg .= base_url() ."index.php/index/validate/" . $this->validation_link . "\r\n\r\n" ;
        $msg .= "Regards, \r\nMatcha team.";
        try {
            return mail($email, 'Validate your account', $msg);
        } catch( Exception $e ) {
            return 0;
        }
    }

 

    public function connectUser($username, $password)
    {
        $sql = $this->db->query('SELECT id, `password`, validated, username FROM users WHERE username=?', array($username));
        $user = $sql->row_array();
        if ($user == False)
            return USER_NOT_EXIST;
        if (strncmp($user['validated'], 'user_', 5) === 0)
            return USER_NOT_VALIDATED;
        if (strncmp($user['validated'], 'fake_', 5) === 0)
            return USER_REPORTED;
        if ($user['password'] === Password::hashpassword( $password ))
        {
            $this->uid = $user['id'];
            $this->session->uid = $user['id'];
            $this->session->username = $user['username'];
            $this->updateLastLogin(session_id());
            $this->validateAccount($user['id']);
            $this->checkLocationAndUpdate(0,0,1);
            return $user['id'];
        }
        else
            return WRONG_PASSWORD;
    }


    private function sendMail( $uname, $email )
    {
        $msg = 'Welcome '.$uname.", \r\n\r\n";
        $msg .= "To use your account please validate your email with the following link: \r\n";
        $msg .= base_url() ."index.php/index/validate/" . $this->validation_link . "\r\n\r\n" ;
        $msg .= "Regards, \r\nMatcha team.";
        try {
            return mail($email, 'Validate your account', $msg);
        } catch( Exception $e ) {
            return 0;
        }
    }

    public function validateAccount( $val )
    {
        $sql = 'UPDATE users SET validated = "1" WHERE validated = ?';
        $req = $this->db->query($sql, array($val));
        return $req;
    }

    public function updateInterests( Array $new_interests )
    {
        foreach ($new_interests as $interest)
        {
            //delete if exists
            $sql = 'DELETE FROM interests WHERE user_id = ? AND interest = ?';
            $del = $this->db->query($sql, array($this->uid, $interest));
            //insert
            $sql = 'INSERT INTO interests(`user_id`, interest) VALUES (?, ?)';
            $req = $this->db->query($sql, array($this->uid, $interest));
        }
        return $req; 
    }

    public function deleteTag( $tag )
    {
        $sql = 'DELETE FROM interests WHERE user_id = ? AND interest = ?';
        return $this->db->query($sql, array($this->uid, $tag));
    }

    private function updatePictures($pictures_path)
    {
        foreach ($pictures_path as $id => $path)
        {
            $sql = 'INSERT INTO profile_pictures(`user_id`, `path`, image_number) VALUES (?, ?, ?)';
            $req = $this->db->querye($sql, array($this->uid, $path, $id + 1));
        }
        return $req->num_rows();
    }


    private function photosNumber()
    {
        print $this->uid;
        $sql = $this->db->query('SELECT image_number as id FROM profile_pictures WHERE user_id = ? ORDER BY image_number', array($this->uid));
        return $sql;
    }

    public function addPhoto()
    {
        $sql = $this->photosNumber();
        $number = $sql->num_rows();
        $array = $sql->result_array();


        print_r($array);


        $i = 1;
        foreach ($array as $col)
        {
            if ($col['id'] == $i)
                $i++;
        }
        
        
        if ($number >= 5) {
            return MAX_PHOTO;
        }
        $path = 'assets/pictures/';

        if (!file_exists($path)) {
            mkdir($path);
        }

        $photo_src = $_FILES['picture']['name'] . uniqid();

        if (!copy($_FILES['picture']['tmp_name'], $path . $photo_src)) {
            return -7;
        }
        else {

            $sql = 'INSERT INTO profile_pictures (user_id, image_number, `path`) VALUES (?, ?, ?)';
            $stmt = $this->db->query($sql, array(
                $this->uid,
                $i,
                $path . $photo_src
            ));
        }

    }

    public function deletePicture( $pid )
    {
        $sql = 'SELECT path, image_number FROM profile_pictures WHERE `user_id`=? AND image_number = ?';
        $stmt = $this->db->query($sql, array($this->uid, $pid));
        $res = $stmt->result_array();
        if (isset($res[0]))
        {
            unlink($res[0]['path']);
            $sql = 'DELETE FROM profile_pictures WHERE `user_id`=? AND image_number = ?';
            return $this->db->query($sql, array($this->uid, $pid));
        }
    }

    public function checkUniqUser( $username, $email, $id = -1)
    {
        $sql = $this->db->query('SELECT * FROM users WHERE (username=? OR email=?) AND id != ?', array($username, $email, $id));
        $user = $sql->num_rows();
        return $user;
    }

    public function updateProfile( Array $data )
    {
        $upd = true;
        foreach ($data as $id => $data)
        {
            if (($id == 'email' && $this->checkUniqUser($this->session->username, $data, $this->uid) == 0)  || $id != 'email') 
            {
                $sql = 'UPDATE users SET '.$id.' = ? WHERE id = ?';
                $upd |= $this->db->query($sql ,array( $data, $this->uid ));
            }
        }
        return $upd;
    }

    private function updateLastLogin($sid)
    {
        $sql = 'UPDATE users SET last_login = CURRENT_TIMESTAMP, sess_id = ? WHERE id = ?';
        $stmt = $this->db->query($sql, array($sid,$this->uid));
        return $stmt;
    }

    public function logout()
    {
        $sql = 'UPDATE users SET sess_id = "" WHERE id = ?';
        $stmt = $this->db->query($sql, array($this->uid));
        $this->session->sess_destroy();
    }

    public function checkLocationAndUpdate($lon, $lat, $err = 0)
    {
        if ($err)
        {
            $ch = curl_init();
            //curl_setopt($ch, CURLOPT_URL, 'http://ip-api.com/json/'.$_SERVER['REMOTE_ADDR']);
            curl_setopt($ch, CURLOPT_URL, 'http://ip-api.com/json/');
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $json = curl_exec($ch);
            $arr = json_decode($json, true);
            if ($arr['status'] == 'success')
            {
                $lat = $arr['lat'];
                $lon = $arr['lon'];
            }
            else
            {
                $lat = 0;
                $lon = 0;
            }
        }
        return ($this->updateLocation($lat, $lon)  . ' ' . $lat. ' ' .$lon);
    }

    private function updateLocation($lat, $lon)
    {
        if ($this->uid != 0)
        {
            $sql = "UPDATE users SET `last_location`=POINT(?, ?) WHERE id=?";
            $req = $this->db->query($sql, array(
                $lon,
                $lat, 
                $this->uid));
            return $req;
        }
    }

    public function getLastLocation($id)
    {
        $sql = 'SELECT ST_Y(users.last_location) as lon, ST_X(users.last_location) as lat FROM users WHERE id=?';
        $req = $this->db->query($sql, array($id));
        $loc = $req->row_array();
        return $loc;
    }

    public function likeSomebody($fuid)
    {
        $fusername = $this->User_ressources->getUserInfos( $fuid )['username'];
        //delete if exists
        $sql = 'DELETE FROM likes WHERE id_user1 = ? AND id_user2 = ?';
        $del = $this->db->query($sql, array($this->uid, $fuid));
        //delete if exists
        $sql = 'DELETE FROM dislikes WHERE id_user1 = ? AND id_user2 = ?';
        $del = $this->db->query($sql, array($this->uid, $fuid));
        //insert
        $sql = 'INSERT INTO likes (`id_user1`, id_user2) VALUES (?, ?)';
        $req = $this->db->query($sql, array($this->uid, $fuid));
        $this->User_managment->addNotifiction('<a href="/profile/show/'. $this->session->uid . '">' . $this->session->username.'</a> vous like', $fuid);
        if ($this->checkIfMatch($fuid))
        {
            $this->addNotifiction('Vous avez match avec ' . $this->session->username, $fuid);
            $this->addNotifiction('Vous avez match avec ' . $fusername, $this->uid);
        }
        return $req;
    }

    private function checkIfMatch($fuid)
    {
        $sql = 'SELECT * FROM likes WHERE id_user2 = ? AND id_user1 = ?';
        $stmt = $this->db->query($sql, array($this->uid, $fuid));
        $match = $stmt->num_rows();
        return $match;
    }


    public function addNotifiction($text, $uid_dest)
    {
        $sql = 'DELETE FROM notifications WHERE fk_user_dst = ? AND fk_user_from = ? AND `msg` = ?';
        $del = $this->db->query($sql, array($uid_dest, $this->uid, $text));
        $sql = 'INSERT INTO notifications (fk_user_dst, fk_user_from, `msg`) VALUES(?, ?, ?)';
        $stmt = $this->db->query($sql, array($uid_dest, $this->uid, $text));
    }

    public function addToVisitHistory($id)
    {
        $sql = 'INSERT INTO visit_history (user_id, visitor_id) VALUES(?, ?)';
        $stmt = $this->db->query($sql, array($id, $this->uid));
    }



    public function dislikeSomebody($fuid)
    {
        //delete if exists
        $sql = 'DELETE FROM likes WHERE id_user1 = ? AND id_user2 = ?';
        $del = $this->db->query($sql, array($this->uid, $fuid));
        //delete if exists
        $sql = 'DELETE FROM dislikes WHERE id_user1 = ? AND id_user2 = ?';
        $del = $this->db->query($sql, array($this->uid, $fuid));
        //insert
        $sql = 'INSERT INTO dislikes(`id_user1`, id_user2 VALUES (?, ?)';
        $req = $this->db->query($sql, array($this->uid, $fuid));
        return $req;
    }

    public function unlikeSomebody($fuid)
    {
                //notifyIfMatch
        if ($this->User_ressources->isAMatch($fuid))
            $this->User_managment->addNotifiction( $this->session->username.' ne vous like plus', $fuid);
        //delete if exists
        $sql = 'DELETE FROM likes WHERE id_user1 = ? AND id_user2 = ?';
        $del = $this->db->query($sql, array($this->uid, $fuid));

        return $del;
    }

    public function undislikeSomebody($fuid)
    {
        //delete if exists
        $sql = 'DELETE FROM likes WHERE id_user1 = ? AND id_user2 = ?';
        $del = $this->db->query($sql, array($this->uid, $fuid));
    }

    public function initResetPassword( $email, $username )
    {

        $sql = 'SELECT * FROM users WHERE email=? AND username=?';
        $stmt = $this->db->query($sql, array(
            $email,
            $username
        ));
        if ($stmt->num_rows() === 0)
            return USER_NOT_EXIST;

        $token = uniqid('reset_', true);

        $msg = 'Hi '.$username.", \r\n\r\n";
        $msg .= "To reset your password use the following link: \r\n";
        $msg .= base_url() ."index.php/login/reset/" . $token . "\r\n\r\n" ;
        $msg .= "If you sudenly remeber your password just ignore this email and log-in as usual.\r\n" ;
        $msg .= "Regards, \r\nMatcha team.";
        try {
            mail($email, 'Reset your password', $msg);
            $sql = 'UPDATE users SET validated=? WHERE email=?';
            $stmt = $this->db->query($sql, array(
                $token,
                $email
            ));
            return $this->db->affected_rows();
        } catch( Exception $e ) {
            return SENDMAIL_ERROR;
        }
    }

    public function resetPassword( $token, $newpwd )
    {
        if (strncmp($token, 'reset_', 6) !== 0)
            return TOKEN_ERROR;
        $sql = 'UPDATE users SET validated=1, password = ? WHERE validated=?';
        $stmt = $this->db->query($sql, array(
            $this->Password->hashpassword($newpwd),
            $token
        ));
        return $this->db->affected_rows();
    }

    public function blockSomebody( $fuid )
    {
        //delete if exists
        $sql = 'DELETE FROM block WHERE id_user1 = ? AND id_user2 = ?';
        $del = $this->db->query($sql, array($this->uid, $fuid));
        //insert
        $sql = 'INSERT INTO block (`id_user1`, id_user2) VALUES (?, ?)';
        $req = $this->db->query($sql, array($this->uid, $fuid));
    }

    public function unblockSomebody( $fuid )
    {
        //delete if exists
        $sql = 'DELETE FROM block WHERE id_user1 = ? AND id_user2 = ?';
        $del = $this->db->query($sql, array($this->uid, $fuid));

    }

    public function ChangeProfilePicture($pid)
    {
        $req = $this->db->query('SELECT `path` FROM profile_pictures WHERE user_id = ? AND image_number = 1', array($this->uid));
        $pathpp = $req->row_array()['path'];
        $req = $this->db->query('SELECT `path` FROM profile_pictures WHERE user_id = ? AND image_number = ?', array($this->uid, $pid));
        $path = $req->row_array()['path'];
        $req = $this->db->query('UPDATE profile_pictures SET path = ? WHERE user_id = ? AND image_number = 1', array($path,$this->uid));
        $req = $this->db->query('UPDATE profile_pictures SET path = ? WHERE user_id = ? AND image_number = ?', array( $pathpp, $this->uid, $pid));
    }

    public function initChangePassword()
    {

        $token = uniqid('reset_', true);
            $sql = 'UPDATE users SET validated=? WHERE id=?';
            $stmt = $this->db->query($sql, array(
                $token,
                $this->session->uid
            ));
            return $token;
    }
}