function delpic(pic)
{
    if ($(pic).data('id') == 1)
    {
        alert('You cant delete your profile picture');
        return ;
    }
    
    if (confirm('Do you really want to delete this picture ?'))
    {
            $.ajax({
                type: "POST",
                url: "/manage/delpic",
                data: {
                    pid: $(pic).data('id')
                }
            }).done(function(data){
                console.log(data);
                $(pic).parent().parent().hide();
        }).fail(function(data){
            console.log(data);
    });

    }
}

function setpp(pic)
{
    console.log('setpp');
    $.ajax({
        type: "POST",
        url: "/manage/setProfilePicture",
        data: {
            pid: $(pic).data('id')
        }
    }).done(function(data){
        console.log(data);
        window.location.replace("/photos");
}).fail(function(data){
    console.log(data);
});
}