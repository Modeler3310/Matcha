<h4><em><?= $name ?>
        <?= $lastname ?></em></h4><br>
<?php
echo '<span id="uid" data-id='.$id.'></data>';

    echo "<em>Score de popularité: </em><strong id='pop_score' >$pop_score</strong><br>";

if (isset($age)) {
    echo "<em>Age: </em><strong>$age</strong><br>";
}

if (isset($genre)) {
    echo "<em>Gender: </em><strong>{$genre}</strong><br>";
}

if (isset($orientation)) {
    echo "<em>Sexual preferences: </em><strong>{$orientation}</strong><br>";
}

if (isset($biography)) {
    $about = nl2br($biography);
    echo "<br><em>$about</em>";
}
?>