<!--<li class="left clearfix">-->
<!--                     <span class="chat-img pull-left">-->
<!--                     <img src="https://lh6.googleusercontent.com/-y-MY2satK-E/AAAAAAAAAAI/AAAAAAAAAJU/ER_hFddBheQ/photo.jpg" alt="User Avatar" class="img-circle">-->
<!--                     </span>-->
<!--    <div class="chat-body clearfix">-->
<!--        <div class="header_sec">-->
<!--            <strong class="primary-font">Jack Sparrow</strong>-->
<!--        </div>-->
<!--    </div>-->
<!--</li>-->

<?php foreach ($matchs as $match)
{
    echo '<a href="/message/'.$match['id'].'">'.$match['username'].'</a>';
}?>