var msg = $('#main');
var updateid;

console.log('js loaded');

function clickButton(e)
{
    console.log(e);
    uid = $(e.target).data('id');
    e.preventDefault();
    $.post("/index.php/chat/sendmessages/" + uid,
    {
        content: $('#msgto' + uid).val()
    },
    function(data, status){
        console.log(data);
        getNewMessages(uid);
        $('#msgto' + uid).val('');
    }).fail(
        function (error)
        {
            console.log(error.responseText);
        }
    );;
}

function scrollTopUid(uid)
{
    $('#' + uid + ' .list_msg').scrollTop($('#' + uid + ' .list_msg').prop("scrollHeight"));
}

function hide(e)
{
    console.log(e);
    uid = $(e.srcElement).data('id');
    console.log(uid);
    $('#chat' + uid)[0].hidden = !$('#chat' + uid)[0].hidden;
    $('#' + uid).css('height', $('#chat' + uid)[0].hidden ? 0 : 472);
    scrollTopUid(uid)
}

function getMessages(uid)
{
    console.log(uid);
    $.post("/index.php/chat/getmessages/" + uid,
    {
    },
    function(data, status){
        console.log("Incoming");
        console.log(data);
        var jsondata = JSON.parse(data);
        if (!$('#' + uid).length)
        {
            obj = jsondata.messages;
            msg.append(`<div class='chatbox' id='${uid}'><p class='hidebox' onclick='hide(event);' id='hide${uid}' data-id='${uid}'>${jsondata.username}</p><div class='chat' id='chat${uid}'><div class='list_msg'></div></div></div>`);
            $.each(obj, function(index, data) {
                $('#' + uid+" .list_msg").append(`<p data-mid="${data.mid}" data-time="${data.time}"><span class="data_name">${data.username}</span><span class="data_time"> at ${data.time}</span><br><br><span type="text" >"${data.msg}"</span></p>`);
            });
            $('#chat' + uid).append("<form class='msgbox'> \
            <input type='text' id='msgto" + uid +  "' /> \
            <input onclick='clickButton(event);' class='sendbutton' data-id="+uid+" id='submit" + uid +  "' type='submit' value='Envoyer' /> \
            </form></div>");
            scrollTopUid(uid)
        }
    }).fail(function (e){ console.log(e); });
}

function getNewMessages(uid)
{
    var lastmid = $('#chat' + uid + ' .list_msg p').last().data('mid');
    var lasttime = $('#chat' + uid + ' .list_msg p').last().data('time');
    if (typeof lastmid === "undefined")
    {
        lastmid = 0;
        lasttime = 0;
    }
    $.post("/index.php/chat/getnewmessages/" + uid,
    {
        time: lasttime,
        mid: lastmid
    },
    function(data, status){
        //console.log(data);
        if (data != '')
            var obj = JSON.parse(data);
        $.each(obj, function(index, data) {
            $('#chat' + uid)[0].hidden = false;
            $('#' + uid).css('height', '472');
            var lastmid = $('#chat' + uid + ' .list_msg p').last().data('mid');
            if (typeof lastmid === "undefined" || lastmid != data.mid)
                $('#' + uid+" .list_msg").append(`<p data-mid="${data.mid}" data-time="${data.time}"><span class="data_name">${data.username}</span><span class="data_time"> at ${data.time}</span><br><br><span type="text" >"${data.msg}"</span></p>`);
            scrollTopUid(uid);
            console.log('new messages' + uid);
            
        })
    }).fail(
        function (error)
        {
            console.log(error);
        }
    );
}

function newChatBox(uid)
{
    msg.empty();
    window.clearInterval(updateid);
    $.post("/chat/ismatch/",
    {
       
    },
    function(data, status){
        var obj = JSON.parse(data);
        found = obj.find(item => {
            return item.id == uid
         });
         console.log(found);
         if (typeof found === 'undefined')
         {

         }
         else
         {
            getMessages(uid);
            updateid = window.setInterval(getNewMessages.bind(null, uid), 2000);
         }
    }).fail(
        function (error)
        {
            console.log(error.responseText);
        }
    );
}
