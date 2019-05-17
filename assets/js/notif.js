var notifs = $('#notifs');
var iid;

console.log('notifs loaded');
function getNotifs()
{
    $.post("/manage/getNotifs",
    {

    },
    function(data, status){

        //console.log(data);
        var obj = JSON.parse(data);
        $.each(obj, function(index, data) {
            $('#notifs').append(`<div id='${data.id}' class="message">
                <p>${data.msg}</p>
            </div>`);
            /*setTimeout(function ()
            {
                $('#' + data.id).hide();
            }, 10000)*/
        });

    }).fail(
        function (error)
        {
            console.log(error);
        }
    );
}

function getNotifsNumber()
{
    $.post("/manage/getNotifsNumber",
    {

    },
    function(data, status){
        //console.log(data);
        if (data > 0)
            $('#notif_counter').css('visibility', 'visible');
        else
            $('#notif_counter').css('visibility', 'hidden');
        $('#notif_counter')[0].innerHTML = data;
    }).fail(
        function (error)
        {
            console.log(error);
        }
    );
}

$('#notif_button').click(function (e)
{
    if (notifs.css('visibility') == 'visible')
    {
        notifs.css('visibility', 'hidden');
        $('#notifs').empty();
        window.clearInterval(iid);
    }
    else{
        notifs.css('visibility', 'visible');
        getNotifs();
        $('#notif_counter')[0].innerHTML = '';
        $('#notif_counter').css('visibility', 'hidden');
        iid = window.setInterval(getNotifs.bind(null), 2000);
    }

});

getNotifsNumber();
//window.setInterval(getNotifs.bind(null), 2000);
window.setInterval(getNotifsNumber.bind(null), 2000);