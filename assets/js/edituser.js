function deltag(tag)
{

console.log(tag);
    $.post("/manage/deltag/" + tag,
    {

    },
    function(data, status){
        console.log(data);
        $('#' + tag).hide();
    }).fail(
        function (error)
        {
            console.log(error.responseText);
        }
    );
}

function changepass()
{
    $.post("/manage/changePass",
        {
        
        },
        function(data, status){
            token = data;
            window.location.replace("/index.php/login/reset/" + token);
        }).fail(
            
        );

};