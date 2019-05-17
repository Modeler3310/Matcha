    <div class="container theme-showcase mask rgba-gradient align-items-center rounded pb-4 mt-5" role="main">
        <div class="container  col-md-6 text-center col-md-offset-1 pt-4">
            <p class="bg-primary"><em id='errors'></em></p>
            <form id='update' class="form-horizontal" method="post" action="/manage/update">
                <div class="form-group">
                    <label for="first_name">First name</label>
                    <input type="text" class="form-control text-center" name="first_name"
                           value="<?php echo @$user['name'] ?>"><br>
                    <label for="last_name">Last name</label>
                    <input type="text" class="form-control text-center" name="last_name"
                           value="<?php echo @$user['lastname'] ?>"><br>
                    <label for="email">Email</label>
                    <input type="email" class="form-control text-center" id="email" name="email" placeholder="Email"
                           value="<?php echo @$user['email'] ?>">
                    <br>
                    <div class="container col-md-4">
                        <label for="date">Birthday</label><br>
                        <input id="date" type="date" name="birthday" value="<?php echo @$user['birthday'] ?>">
                    </div>
                    <div class="container col-md-4">
                    <h5>Gender</h5>
                    <div class="radio">
                        <label>
                            <input type="radio" name="gender" id="optionsRadios1" value="male"
                                <?php if (!isset($user['genre']) || $user['genre'] == 'male') echo 'checked'; ?> >
                            male
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="gender" id="optionsRadios2" value="female"
                                <?php if (isset($user['genre']) && $user['genre'] == 'female') echo 'checked'; ?> >
                            female
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="gender" id="optionsRadios3" value="other"
                                <?php if (!isset($user['genre']) || $user['genre'] == 'other') echo 'checked'; ?> >
                            other
                        </label>
                    </div>
                    </div>
                    <div class="container col-md-4">
                    <h5>Sexual Preferences</h5>
                    <div class="radio">
                        <label>
                            <input type="radio" name="sex_pref" id="optionsRadios1" value="hetero"
                                <?php if (!isset($user['orientation']) || $user['orientation'] == 'hetero') echo 'checked'; ?> >
                            hetero
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="sex_pref" id="optionsRadios2" value="homo"
                                <?php if (isset($user['orientation']) && $user['orientation'] == 'homo') echo 'checked'; ?> >
                            homo
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="sex_pref" id="optionsRadios3" value="bi"
                                <?php if (isset($user['orientation']) && $user['orientation'] == 'bi') echo 'checked'; ?> >
                            bi
                        </label>
                    </div>
                    <br>
                    </div>
                    <br>
                    <h5>About yourself<br>
                        <small>200 characters max</small>
                    </h5>
                    <textarea class="form-control" rows="5" name="about"><?php echo @$user['biography'] ?></textarea><br>
                    <button type="submit" class="btn btn-outline-success btn-block" name="save_btn">Save</button>
                </div>
            </form>
            <a data-username="<?= $user['username'] ?>" href="#" onclick='changepass();' class="btn btn-danger btn-xs btn-block">Change password</a><br><br>
            <form class="form-horizontal" method="post" action='/manage/addtag'>
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">#</span>
                        <input type="text" class="form-control" aria-describedby="basic-addon1" name="tag">
                    </div>
                    <button type="submit" class="btn btn-warning btn-xs btn-block" name="add_tag">Add tag</button>
                </div>
            </form>
            <h5>Click on tag to remove</h5>
            <?php
            foreach ($tags as $tag) {
                if ($tag) {
                    if ($tag[0] = '#')
                        $sub = substr($tag,1);
                    else
                        $sub = $tag;
                    echo '<a id='. $sub .' href="#" onclick="deltag(\''. $sub .'\');" style="color: red">' . $tag . '</a>&#32';
                }
            }
            ?>
        </div>
    </div>
