window.onload = function() {
    $('#btnlogin').click(function(e) {
        $('#sign_up').lightbox_me({
            centered: true,
            onLoad: function() {
                $('#sign_up').find('input:first').focus();
            }
        });
        //e.preventDefault();
    });

    $('#ximg').click(function() {
        $('#sign_up').trigger('close');
        closing();
    });

    $('#btnenter').click(login);

    $('#pass').keyup(function(e) {
        if (e.keyCode === 13) {
            login();
        }
    });

    $('#checkboxprov').click(function() {
        $('#sign_in').slideToggle("slow");
    });

};

function login() {
    var email = $('#email').val();
    var pass = $('#pass').val();
    clean();
    var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;
    var passReg = /^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%? "]).*$/;
    var correct = false;
    var error = "";

    if (email !== "") {
        if (emailReg.test(email)) {
            correct = true;
        } else {//email incorrect
            correct = false;
            error = 2;
        }
    } else { //email empy
        correct = false;
        error = 1;
    }

    if (correct) {
        if (pass !== "") {
            if (passReg.test(pass)) {
                correct = true;
            } else { //pass incorrect
                correct = false;
                error = 4;
            }
        } else { //pass empty
            correct = false;
            error = 3;
        }
    }

    switch (error) {
        case 1: //email empyborder-width
        case 2: //email incorrect
            $('#email').css("border-color", "red");
            $('#pass').css("border-color", "red");
            $('#email').css("border-width", "3px");
            $('#pass').css("border-width", "3px");
            break;
        case 3: //pass empty
        case 4: //pass incorrect
            $('#pass').css("border-color", "red");
            $('#pass').css("border-width", "3px");
            break;
    }

    if (correct) {
        if ($('#checkboxprov').prop('checked')) {
            $.post("index.php", {token: 1, email: email, pass: pass, ajax: "login"}, function(result) {
                alert(result);
            });
            alert("enviar ajax com a provider");
        } else {
            $.post("index.php", {token: 0, email: email, pass: pass, ajax: "login"}, function(result) {
                alert(result);
            });
            alert("enviar ajax com a user");
        }
    }

}

function clean() {
    $('#email').css("border-color", "none");
    $('#pass').css("border-color", "none");
    $('#email').css("border-width", "1px");
    $('#pass').css("border-width", "1px");
}

function closing() {
    $('#sign_in').slideDown("slow");
    $('.lb_overlay').remove();
    $('#email').val("");
    $('#pass').val("");
    clean();
}