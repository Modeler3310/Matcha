<form method="post">
    <?php
        $like = 'inline';
        $unlike = 'none';
        if ($liked) {
            $unlike = 'inline';
            $like = 'none';
        }
        echo '<span id="like_span" style="display: ' . $like . ';"><button id="like" class="btn btn-success btn-xs" name="like"><strong>L I K E</strong></button></span>&#32';
        echo '<span id="unlike_span" style="display: ' . $unlike . ';"><button data-id="'.$id.'" id="unlike" class="btn btn-warning btn-xs" name="unlike">Unlike</button></span>&#32';

    $block = 'inline';
    $unblock = 'none';
    if ($blocked) {
        $block = 'none';
        $unblock = 'inline';
    }
    echo '<span id="block_span" style="display: '.$block.';"><button id="block"  class="btn btn-danger btn-xs" name="block">Block</button></span>';
    echo '<span id="unblock_span" style="display: '.$unblock.';"><button id="unblock" class="btn btn-danger btn-xs" name="unblock">Unblock</button></span>';
    if ($reported) {
    ?>
        <span id='report_fake'><button class="btn btn-danger btn-xs" name="report_fake">Report a fake account</button></span>
    <?php } ?>
</form>