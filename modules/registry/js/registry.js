$(document).ready(function() {
    $('#name_registry').blur(function() {
        checkString(this.id);
    });

    $('#surname_registry').blur(function() {
        checkString(this.id);
    });

    $('#fiscalid_registry').blur(function() {
        checkString(this.id);
    });

    $('#email_registry').blur(function() {
        checkEmail(this.id);
    });

    $('#pass_registry').blur(function() {
        checkPass(this.id);
    });

    $('#pass_registry_2').blur(function() {
        checkPass2(this.id);
    });

    $('#button_registry').click(function() {
        registry(this.id);
    });
});

var content = {};
var id = {};
id['name'] = "name_registry";
id['surname'] = "surname_registry";
id['fiscalid'] = "fiscalid_registry";
id['email'] = "email_registry";
id['pass'] = "pass_registry";
id['pass2'] = "pass_registry_2";


function checkString(id) {
    var name = value(id);
    if (name === "") {
        drawNone(id);
        delete(content[id.split("_")[0]]);
    } else {
        if (name.length > 2) {
            drawGreen(id);
            content[id.split("_")[0]] = name;
        } else {
            delete(content[id.split("_")[0]]);
            drawRed(id);
        }
    }
}

function checkEmail(id) {
    var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;
    var email = value(id);
    $('#emailerror').remove();
    $('#emailerrorbr').remove();
    if (email === "") {
        delete(content[id.split("_")[0]]);
        drawNone(id);
    } else {
        if (emailReg.test(email)) {
            $.post("index.php", {token: 0, ajax: "registry", email: email}, function(result) {
                result = $.trim(result);
                if (!isNaN(result)) {
                    drawGreen(id);
                    content[id.split("_")[0]] = email;
                } else {
                    $($("#" + id)).after('<br id="emailerrorbr"><label id="emailerror" style="padding-left: 25%; color: red;">' + result + '</label>');
                    drawRed(id);
                }
            });
        } else {
            delete(content[id.split("_")[0]]);
            drawRed(id);
        }
    }
}

function checkPass(id) {
    var passReg = /^.*(?=.{8,})(?=.*[a-zA-Z])(?=.*\d)(?=.*[!#$%? "]).*$/;
    var pass = value(id);
    if (pass === "") {
        delete(content[id.split("_")[0]]);
        drawNone(id);
        checkPass2(id + "_2");
    } else {
        if (passReg.test(pass)) {
            content[id.split("_")[0]] = pass;
            drawGreen(id);
            checkPass2(id + "_2");
        } else {
            delete(content[id.split("_")[0]]);
            drawRed(id);
            checkPass2(id + "_2");
        }
    }
}

function checkPass2(id_) {
    var id = id_.split("_")[0] + "_" + id_.split("_")[1];
    var id2 = id + "_2";
    var pass1 = value(id);
    var pass2 = value(id2);
    if (typeof (content[id.split("_")[0]]) === "undefined") {
        delete(content[id.split("_")[0] + "_2"]);
        if (pass2 === "") {
            if (pass1 !== "") {
                drawRed(id);
            } else {
                drawNone(id2);
            }
        } else {
            drawRed(id);
            drawRed(id2);
        }
    } else {
        if (pass2 === "") {
            delete(content[id.split("_")[0] + "_2"]);
            drawNone(id2);
        } else {
            if (pass1 === pass2) {
                drawGreen(id2);
                content[id.split("_")[0] + "_2"] = pass2;
            } else {
                delete(content[id.split("_")[0] + "_2"]);
                drawRed(id2);
            }
        }
    }
}

function drawRed(id) {
    $("#" + id).css("border-color", "red");
}

function drawGreen(id) {
    $("#" + id).css("border-color", "green");
}

function drawNone(id) {
    $("#" + id).css("border-color", "none");
}

function value(id) {
    return $("#" + id).val();
}

function registry() {
    $('#errors').css("display", "none");
    checkString(id['name']);
    checkString(id['surname']);
    checkString(id['fiscalid']);
    checkEmail(id['email']);
    checkPass(id['pass']);
    checkPass2(id['pass2']);
    var size = Object.keys(content).length;
    $.each(content, function(key) {
        if (key === "fiscalid") {
            size--;
        }
    });
    if (size === 5) {
        $.post("index.php", {token: 0, ajax: "registry", data: JSON.stringify(content)}, function(result) {
            result = $.trim(result);
            result = $.parseJSON(result);
            console.log(result);
            response(result);
        });
    } else {
        $('#errors').css("display", "inline");
    }
}

function response(result) {
    var size = Object.keys(result).length;
    $.each(result, function(key) {
        if (key === "fiscalid") {
            size--;
        }
    });
    if (size === 5) {
        window.history.back();
        alert(result['email'].toString());
    } else {
        $.each(id, function(key) {
            drawRed(key);
        });
        $.each(result, function(key) {
            drawNone(id['fiscalid']);
            switch (key) {
                case 'name':
                    drawGreen(id['name']);
                    break;
                case 'surname':
                    drawGreen(id['surname']);
                    break;
                case 'fiscalid':
                    drawGreen(id['fiscalid']);
                    break;
                case 'email':
                    drawGreen(id['email']);
                    break;
                case 'pass':
                    drawGreen(id['pass']);
                    break;
                case 'pass_2':
                    drawGreen(id['pass_2']);
                    break;
            }
        });
    }
}