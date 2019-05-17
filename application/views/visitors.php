<div class="container theme-showcase mask rgba-gradient align-items-center rounded pb-4" role="main">

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="container" style='margin-top: 6%;'>
<div class="mx-auto col-md-4 col-md-offset-4 text-center">

<?php foreach ($visitors as $visitor)
{
    echo '<a href="/profile/show/' . $visitor['id'] . '">' . $visitor['username'] . '</a> ' . $visitor['date'] . ' <br />';
} ?>

</div>
</div>
</div>