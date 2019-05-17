var liked = 0;

$("#like").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/manage/like",
        data: {
            uid:uid
        }
    }).done(function(data){
        console.log(data);

            $('#pop_score').html(parseInt($('#pop_score').html()) + 1);
 
        
        $('#like_span').css('display', 'none');
        $('#unlike_span').css('display', 'inline');
    }).fail(function(data){
        console.log(data);
    });

});

$("[id*='unlike_span']").click(function(e) {
    e.preventDefault();
    console.log(e);
    uid = e.target.dataset.id;
    console.log(uid);

console.log(uid);
    $.ajax({
        type: "POST",
        url: "/manage/unlike",
        data: {
            uid: uid
        }
    }).done(function(data){
        $('#pop_score').html(parseInt($('#pop_score').html()) - 1);
        console.log(data);
        $('#like_span').css('display', 'inline');
        $('#unlike_span').css('display', 'none');
        $('#unlike_span'+uid).css('display', 'none');
    }).fail(function(data){
        console.log(data);
    });
});


//report fake
$("#report_fake").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/manage/report",
        data: {
            uid: uid
        }
    }).done(function(data){
        console.log(data);
        $("#report_fake").css('display', 'none');
    }).fail(function(data){
        console.log(data);
    });
});