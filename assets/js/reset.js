$('#init').submit(function(e) {
    e.preventDefault();
    $('#errors').empty();
$.post("/login/forgot_password",
    {
        username: $('#username').val(),
        email: $('#email').val()
    },
    function(data, status){
        console.log(data);
        if (parseInt(data) <= 0)
        {
            $('#errors').append(`<p>${error[data]}</p>`);
        }
        else
            $('#errors').append(`<p>Vous avez maintenant recu un email</p>`);
        
    }).fail(
        function (error)
        {
            console.log(error.responseText);
        }
    );
    });

    $('#confirm').submit(function(e) {
        e.preventDefault();
        $('#errors').empty();
        if ($('#password').val() != $('#pass2').val())
            $('#errors').append(`<p>Les mot de passe ne correspondent pas</p>`);
        else if (!validatePassword($('#password').val()))
            $('#errors').append(`<p>Le mot de passe doit contenir au moins 8 caracteres, une majuscule, un chiffre et un caractere special</p>`);
        else
        {
            $.post("/login/reset/" + $('#confirm').data('token'),
            {
                newpwd: $('#password').val()
            },
            function(data, status){
                console.log(data);
                if (parseInt(data) == 0)
                {
                    $('#errors').append(`<p>Token invalide</p>`);
                }
                else
                    $('#errors').append(`<p>Votre mot de passe a bien ete reinitialisé</p>`);
                
            }).fail(
                function (error)
                {
                    console.log(error.responseText);
                }
            );
        }
     });
    
    