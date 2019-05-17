$('#update').submit(function(e) {
    e.preventDefault();
    $('#errors').empty();
    var uniq = '1';

    $.post("/manage/checkEmail/" ,
        {
            email : $('#email').val()
        },
        function(data, status){
            uniq = data;
            if (uniq == '0')
            $('#errors').append(`<p>Email deja utilisee</p>`);
            else
            {
                $.post("/manage/update",
                {
                    birthday: $('#date').val(),
                    email: $('#email').val(),
                    name: $('#name').val(),
                    lastname: $('#lastname').val(),
                    password2: $('#password2').val()
                },
                function(data, status){
                    console.log(data);
                    if (parseInt(data) <= 0)
                    {
                        $('#errors').empty();
                        $('#errors').append(`<p>${error[data]}</p>`);
                    }
                    else
                    window.location.replace("/");
                
                }).fail(
                    function (error)
                    {
                        console.log(error.responseText);
                    }
                );
            }
            });
});