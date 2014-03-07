window.onload = function() {
    $('#btnlogin').click(function(e) {
        $('#email_login').val("");
        $('#pass_login').val("");
        clean();
        $('#login').lightbox_me({
            centered: true,
            onLoad: function() {
                $('#login').find('input:first').focus();
            }
        });
        //e.preventDefault();
    });

    $('#ximg').click(function() {
        $('#login').trigger('close');
        closing();
    });

    $('#btnenter').click(login);

    $('#pass_login').keyup(function(e) {
        if (e.keyCode === 13) {
            login();
        }
    });

    $('#checkboxprov').click(function() {
        $('#sign_in').slideToggle("slow");
    });

};

function login() {
    var email = $('#email_login').val();
    var pass = $('#pass_login').val();
    clean();
    var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;
    var passReg = /^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%? "]).*$/;
    var error = 0;

    if (email !== "") {
        if (emailReg.test(email)) {
            error = 2;
        } else {//email incorrect
            error = 0;
        }
    } else { //email empy
        error = 0;
    }

    if (error === 2) {
        if (pass !== "") {
            if (passReg.test(pass)) {
                error === 2;
            } else { //pass incorrect
                error = 1;
            }
        } else { //pass empty
            error = 1;
        }
    }

    paint(error);

    if (error === 2) { //Enviar Ajax
        var token;
        if ($('#checkboxprov').prop('checked')) { //provider
            token = 1;
        } else { //user
            token = 0;
        }
        $.post("index.php", {token: token, email: email, pass: pass, ajax: "login"}, function(result) {
            result = $.trim(result);
            result = parseInt(result);
            if (result === 2) {
                result = 5;
            }
            paint(result);
        });
    }
}

function clean() {
    $('#email_login').css("border-color", "none");
    $('#pass_login').css("border-color", "none");
    $('#email_login').css("border-width", "1px");
    $('#pass_login').css("border-width", "1px");
}

function closing() {
    $('#sign_in').slideDown("slow");
    $('.js_lb_overlay').remove();
    $('#banned').remove();
    $('#login').css("display", "none");
    $('#email_login').val("");
    $('#pass_login').val("");
    clean();
}

function paint(error) {
    switch (error) {
        case 0: //email empty || email incorrect
            $('#email_login').css("border-color", "red");
            $('#pass_login').css("border-color", "red");
            $('#email_login').css("border-width", "3px");
            $('#pass_login').css("border-width", "3px");
            $('#email_login').effect('shake');
            $('#pass_login').effect('shake');
            break;
        case 1: //pass empty || pass incorrect
            $('#pass_login').css("border-color", "red");
            $('#pass_login').css("border-width", "3px");
            $('#pass_login').effect('shake');
            break;
        case 3: //The user is banned
            $('#login').prepend("<img id='banned' src='modules/login/images/banned.png'>");
            $('#banned').lightbox_me();
            break;
        case 4: //The user is admin
            document.location.href = document.URL;
            break;
        case 5: //All correct
            document.location.href = document.URL;
            break;
    }
}