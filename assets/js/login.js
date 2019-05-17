$('#form').submit(function(e) {
    e.preventDefault();
    $('#errors').empty();
$.post("/login/signin",
    {
        username: $('#username').val(),
        password: $('#password').val()
    },
    function(data, status){
        console.log(data);
        if (parseInt(data) <= 0)
        {
            $('#errors').append(`<p>${error[data]}</p>`);
        }
        else
            window.location.replace("/match/index");
        
    }).fail(
        function (error)
        {
            console.log(error.responseText);
        }
    );
    });

