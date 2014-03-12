$(document).ready(function() {
    $("#sendg").click(function() {
        $("#passwordt").css("border-color", "none");
        passReg = /^(?=.*\d)(?=.*[a-z]).{12}$/;
        password = $("#passwordt").val();
                if (password.match(passReg)) {
                    $("#listticketform").submit();
                } else {
                    $("#passwordt").css("border-color", "red");
                    $("#passwordt").effect("shake");
                }

    });
});