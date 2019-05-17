<?php 
$pics = $this->User_ressources->getUserPictures($match['id']);
?>

    <div class="container">
        <div class="row">
            <div class="col-md-1">
                <a href="/profile/show/<?= $match['id'] ?>" style="text-decoration: none">
                    <?php
                    $src = "/template/pictures/no_photo.svg.png";
                        echo '<img class="img-responsive" src="' . $pics[0]['path'] . '" alt="avatar" width="60">';
                    ?>
                </a>
            </div>
            <div class="col-md-8">
                <strong><em><?= $match['name'] ?>
                        <?= $match['lastname'] ?></em></strong><br>
                <?php
                    echo "<em>".$match['age']."</em><br>";
                    echo "<em>{$match['genre']}</em><br>";
                    echo "<em>{$match['orientation']}</em><br>";
                ?>
            </div>
        </div>
    </div>
<br>