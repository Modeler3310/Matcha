<?php

if ($user['online']) {
    echo "<strong style='color: red'>online</strong>";
} else {
        date_default_timezone_set('Europe/Paris');
        echo "<span style='color: lightseagreen'>Was online: </span>";
        echo $user['last_login'];
}