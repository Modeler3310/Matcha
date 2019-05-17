uid = $('#uid').data('id');

$("#block").click(function(e) {
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "/manage/block",
        data: {
            uid: uid,
        }
    }).done(function(data){
        console.log(data);
        $('#block_span').hide();
        $('#unblock_span').show();
});
});

$("#unblock").click(function(e) {
    e.preventDefault();
    $.ajax({
        type: "POST",
        url: "/manage/unblock",
        data: {
            uid: uid,
        },
    }).done(function(data){
        console.log(data),
        $('#block_span').show();
        $('#unblock_span').hide();
});
});