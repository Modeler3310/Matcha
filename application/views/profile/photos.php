<div class="mask rgba-gradient align-items-center rounded pb-4 mt-5" >     
    <div class="container">
        <div class="row pt-4">
            <div class="container mx-auto">
                <p class="bg-primary"><em><?php if (!empty($errors)) echo array_shift($errors); ?></em></p>
                <form class="form-horizontal" enctype="multipart/form-data" method="post" action="/photos/upload">
                    <div class="form-group">
                        <label for="picture">Add photo</label>
                        <input type="file" id="picture" name="picture" accept=".jpg,.jpeg,.png">
                        <p class="help-block">You can upload up to 5 photo</p>
                        <button type="submit" class="btn btn-outline-success" name="add_photo">Add</button>
                    </div>
                </form>
            </div>
            <?php
                    foreach ($photos as $photo) {
                        if (strncmp ($photo['path'], 'http', 4) == 0)
                            $path = $photo['path'];
                        else
                            $path =  $baseurl.$photo['path'];
                        echo '<div class="container col-2 pt-4"><a href="#">
                    <img onclick="delpic(this);" class="img-fluid rounded mx-auto d-block" data-id='. $photo['id'] . ' id="pic'. $photo['id'] .'" src="' . $path . '"></a>';
                    if ($photo['id'] != 1)
                     echo '<button data-id='. $photo['id'] .' onclick="setpp(this);" class="btn btn-outline-warning mx-auto">Set as profile picture</button>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
</div>
