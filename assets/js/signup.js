$('#signup').submit(function(e) {
    e.preventDefault();
    $('#errors').empty();
    if (!validateEmail($('#email').val()))
        $('#errors').append(`<p>Email incorrecte</p>`);
    else if (!validatePassword($('#password').val()))
        $('#errors').append(`<p>Le mot de passe doit contenir au moins 8 caracteres, une majuscule, un chiffre et un caractere special</p>`);
    else
    {
        $.post("/login/signup",
        {
            username: $('#username').val(),
            password: $('#password').val(),
            email: $('#email').val(),
            name: $('#name').val(),
            lname: $('#lname').val(),
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