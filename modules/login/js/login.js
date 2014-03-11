$('document').ready(function() {
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

    $('#remeber').click(rememberpass);

    $('#register').click(registry);

});

function login() {
    var email = $('#email_login').val();
    var pass = $('#pass_login').val();
    clean();
    var error = 0;

    error = validateEmail(email);

    if (error === 2) {
        error = validatePass(pass);
    }
    if (error === 2) { //Send Ajax
        var token;
        if ($('#checkboxprov').prop('checked')) { //provider
            token = 1;
        } else { //user
            token = 0;
        }
        $.post("index.php", {token: token, email: email, pass: pass, ajax: "login"}, function(result) {
            result = $.trim(result);
            result = parseInt(result);
            paint(result);
        });
    } else {
        paint(error);
    }
}

function rememberpass() {
    var email = $('#email_login').val();
    clean();
    var error = 0;

    error = validateEmail(email);
    if (error === 0) {
        error = 5;
    }

    if (error === 2) { //Send Ajax
        var token;
        if ($('#checkboxprov').prop('checked')) { //provider
            token = 1;
        } else { //user
            token = 0;
        }
        $.post("index.php", {token: token, email: email, new_pass: "", ajax: "login"}, function(result) {
            result = $.trim(result);
            if (isNaN(result)) {
                resetOk(result);
            } else {
                result = parseInt(result);
                if (result === 0) {
                    result = 5;
                }
                paint(result);
            }
        });
    } else {
        paint(error);
    }
}

function validateEmail(email) {
    var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;
    var error_;
    if (email !== "") {
        if (emailReg.test(email)) {
            error_ = 2;
        } else {//email incorrect
            error_ = 0;
        }
    } else { //email empy
        error_ = 0;
    }
    return error_;
}

function validatePass(pass) {
    var passReg = /^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%? "]).*$/;
    var error_;
    if (pass !== "") {
        if (passReg.test(pass)) {
            error_ = 2;
        } else { //pass incorrect
            error_ = 1;
        }
    } else { //pass empty
        error_ = 1;
    }
    return error_;
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
        case 2: //All correct
            document.location.href = document.URL;
            break;
        case 3: //The user is banned
            $('#login').prepend("<img id='banned' src='modules/login/images/banned.png'>");
            $('#banned').lightbox_me();
            break;
        case 4: //The user is admin
            document.location.href = document.URL;
            break;
        case 5: //email empty || email incorrect
            $('#email_login').css("border-color", "red");
            $('#email_login').css("border-width", "3px");
            $('#email_login').effect('shake');
            break;
    }

}

function resetOk(result) {
    alert(result);
    /*$('#login').prepend("<div id='dialog' title='Basic dialo'></div>");
     $("#dialog").dialog({
     autoOpen: true,
     show: {
     effect: "blind",
     duration: 1000
     },
     hide: {
     effect: "explode",
     duration: 1000
     }
     });*/
}

function registry() {
    var currenturl = document.URL;
    currenturl = currenturl.split("#")[0];
    var allurl = "";
    if (/\?/.test(currenturl)) {
        var url = currenturl.split("?")[0];
        var par = currenturl.split("?")[1];
        if (/lang/.test(par)) {
            var params = par.split("&");
            for (var i = 0; i < params.length; i++) {
                var hash = params[i].split("=");
                if (hash[0] === "lang") {
                    var lang = hash[1];
                    allurl = url + "?page=registry&lang=" + lang;
                }
            }
        } else {
            allurl = url + "?page=registry";
        }
    } else {
        allurl = currenturl + "?page=registry";
    }
    document.location.href = allurl;
}
