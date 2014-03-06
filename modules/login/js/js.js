window.onload = function() {
    $('#btnlogin').click(function(e) {
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

    if (error===2) {
        if (pass !== "") {
            if (passReg.test(pass)) {
                error===2;
            } else { //pass incorrect
                error = 1;
            }
        } else { //pass empty
            error = 1;
        }
    }

    paint(error);

    if (error===2) {
        if ($('#checkboxprov').prop('checked')) {
            $.post("index.php", {token: 1, email: email, pass: pass, ajax: "login"}, function(result) {
                alert("$"+result+"$");
            });
            //alert("enviar ajax com a provider");
        } else {
            $.post("index.php", {token: 0, email: email, pass: pass, ajax: "login"}, function(result) {
                alert("$"+result+"$");
            });
            //alert("enviar ajax com a user");
        }
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
    $('.lb_overlay').remove();
    $('#email_login').val("");
    $('#pass_login').val("");
    clean();
}

function paint(error){
    switch (error) {
        case 0: //email empty || email incorrect
            $('#email_login').css("border-color", "red");
            $('#pass_login').css("border-color", "red");
            $('#email_login').css("border-width", "3px");
            $('#pass_login').css("border-width", "3px");
            break;
        case 1: //pass empty || pass incorrect
            $('#pass_login').css("border-color", "red");
            $('#pass_login').css("border-width", "3px");
            break;
        case 3: //The user is banned
            break;
    }
}