<div class="container theme-showcase mask rgba-gradient align-items-center rounded  mt-15" role="main">

<!-- Main jumbotron for a primary marketing message or call to action -->

<div class="main_chat_box">

<div class="left">
<?php foreach ($matchs as $match)
{
    echo '<p id="m'.$match['id'].'" class="col"><span class="btn btn-outline-light" onclick="newChatBox('.$match['id'].');">'.$match['username'] . '</span>
    <span data-id="'.$match['id'].'" id="unlike_span'.$match['id'].'" style="display: inline;" >
    <button data-id="'.$match['id'].'" id="unlike'.$match['id'].'" class="btn btn-warning btn-xs ml-2" name="unlike">Unlike</button>
    </span></p>';
}?>
</div>
    
    <div id='main' class="right"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</div>
</div>