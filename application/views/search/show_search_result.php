<?php foreach ($matchs->result_array() as $match): 
$pics = $this->User_ressources->getUserPictures($match['id']);
?>

    <div class="container">
        <div class="row">
            <div class="col-md-2 pt-2">
                <div class="card" style="width: 18rem">
                    <a href="/profile/show/<?= $match['id'] ?>" style="text-decoration: none">
                        <?php
                        echo '<img class="card-img-left" src="' . $pics[0]['path'] . '" alt="avatar" width="60">';
                        ?>
                    </a>
                </div>
            
                <div class="card-body">
                <p class="card-text">
                <strong><em><?= $match['name'] ?>
                        <?= $match['lastname'] ?></em></strong><br>
                <?php
                    echo "<em>".$match['age']."</em><br>";
                    echo "<em>{$match['genre']}</em><br>";
                    echo "<em>{$match['orientation']}</em><br>";
                ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <br>
<?php endforeach; ?>