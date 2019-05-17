<?php
    $src = "/template/pictures/no_photo.svg.png";
if (!file_exists(ROOT.'/src/users_photos/'))
    mkdir(ROOT.'/src/users_photos/');
    $path = "/src/users_photos/";


   if (!empty($user['avatar'])) {
        $src = $path . Profile::getPhotoSrc($user['avatar'], $user['id']);
    } else if ($photos = Profile::getAllPhoto($user['id'])){
        Profile::setAvatar($photos['0']['id'], $user['id']);
        $src = $path . Profile::getPhotoSrc($photos['0']['id'], $user['id']);
    }
    else {

    }

    echo '<img class="img-responsive" src="'.$src.'" alt="avatar">';
?>