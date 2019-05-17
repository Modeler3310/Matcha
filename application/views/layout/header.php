<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Matcha</title>

    <?php if (isset($csslist))
    {
        foreach ($csslist as $css)
        {
            echo '<link rel="stylesheet" href="'.$css.'">';
        }
    } ?>

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>    
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp"
          crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
<link rel="icon" href="<?= $baseurl ?>assets/pics/matcha_ico.ico" />
<script>window['console']['log'] = function() {};
    //To disable debug</script>

</head>
<body class="view" style="background-image: url(<?= $meetphoto ?>); background-repeat: no-repeat; background-size: cover; background-position: center unset;">

<header>
        <nav class="mask navbar navbar-expand-lg navabar-inverse fixed-top scrolling-navbar shadow p-3 mb-5 bg-white rounded">
            <div class="container-fluid">           
                <a class="navbar-brand" style="color: white" href="<?= '/' ?>"><strong> Matcha</strong></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar" aria-controls="mynavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mynavbar">
                    <ul class="navbar-nav mr-auto">
                       <!-- <li><a href="<?= '/' ?>">Home</a></li> -->
                          <?php if (isset($this->session->uid)): ?>
                            <li class="nav-item active"><a class="nav-link" href="<?= '/match/index' ?>"> Search</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= '/photos/' ?>"><i class="far fa-image"></i>Edit Photos</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= '/edit/' ?>"><i class="far fa-user"></i>  Edit profile</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= '/chat' ?>"><i class="far fa-envelope"></i>  Chat</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= '/visitors' ?>">  Visiteurs</a></li>
                            <li class="nav-item"><a id='notif_button' class="nav-link" href="#"><span id='notif_counter'></span>Notifs</a></li>
                            <li class="nav-item"><a class="nav-link" href="<?= '/login/logout/' ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </li>
                      
                    </ul>
                    

                       
                </div><!--/.nav-collapse -->
                
                <?php else: ?>
                <?php endif; ?>
            </div>
        </nav>

        
</header>

