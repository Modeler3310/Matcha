
<div class="mask rgba-gradient align-items-center rounded mt-4 mx-5">

    <!-- Main jumbotron for a primary marketing message or call to action -->

<div id = 'large-photo'></div>
<div class="container pt-3">
    <div class="container  m-4">
    <div class="row">
            <div class="col-md-6">
            <?php //$this->load->view('profile/show_rating'); ?>
            <?php // $this->load->view('profile/matched'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php
                if (isset($photos[0]))
                {
                if (strncmp ($photos[0]['path'], 'http', 4) == 0)
                    $path = $photos[0]['path'];
                else
                    $path =  $baseurl.$photos[0]['path'];
                echo '<img class="img-responsive" src="'.$path.'" alt="avatar">';
                } ?>
                
            </div>
            <div class="col-md-4">
            <?php $this->load->view('profile/layouts/show_online', $user); ?>
            <?php $this->load->view('profile/layouts/show_info', $user); ?>
                <br><br>
                <?php $this->load->view('profile/layouts/show_tags'); ?>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
                <?php $this->load->view('profile/layouts/like_report_block_btns', $user); ?>
            </div>
        </div>
        <br>
        <div class="row">
            <?php
            foreach ($photos as $photo) {
                if (strncmp ($photo['path'], 'http', 4) == 0)
                            $path = $photo['path'];
                        else
                            $path =  $baseurl.$photo['path'];
                echo '<div class="container col-md-2 photo-preview" id="img' . $photo['id'] . '"><img class="img-responsive" src="' . $path . '"></div>';
            }
            ?>
        </div>
        <br>
        <div class="row">
            <div class="col-md-6">
            <?php //$this->load->view('profile/show_map'); ?>
            </div>
        </div>
    </div>
    </div>