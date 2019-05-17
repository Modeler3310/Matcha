<?php

$tab = $this->User_ressources->getUserInfos( $this->session->uid );


echo ('Location : <a href="https://www.google.com/maps/place/'. $res['lon']. ',' .$res['lat'] . '">Maps</a><br />');

foreach ($matchs->result_array() as $match)
{

    $pics = $this->User_ressources->getUserPictures($match['id']);
    echo ('Id : '. $match['id'] . '<br />');
    echo ('Nom : '. $match['lastname'] . '<br />');
    echo ('Age : '. $match['age']  . '<br />');
    echo ('Sexe : '. $match['genre'] . '<br />');
    echo ('Popularity : '. $match['pop_score'] . '<br />');
    echo ('Tags : '. $match['tags'] . '<br />');
    echo ('Tags in common : '. $match['tags_in_common'] . '<br />');
    echo ('Distance : '. $match['distance'] . '<br />');
    echo ('Location : <a href="https://www.google.com/maps/place/'. $match['lon']. ',' .$match['lat'] . '">Maps</a><br />');
    foreach ($pics as $pic)
    {
        echo ('<img width="50px" src="' . $pic['path'] . '" >');
    }
     echo ('<br />');
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="/assets/js/userlocation.js"></script>
<script>getUserLocation();</script>