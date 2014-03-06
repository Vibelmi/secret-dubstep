$(document).ready(function() {
    $("#send").click(function() {
        $("#temail").css("border-color", "none");
        $("#subject").css("border-color", "none");
        $("#description").css("border-color", "none");
        emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;
        email = $("#temail").val();
        subject = $("#subject").val();
        description = $("#description").val();
        if (email.match(emailReg)) {
            if (subject !== "") {
                if (description !== "") {
                    $("#ticketform").submit();
                } else {
                    $("#description").css("border-color", "red");
                    $("#description").effect("shake");
                }
            } else {
                $("#subject").css("border-color", "red");
                $("#subject").effect("shake");
            }
        } else {
            $("#temail").css("border-color", "red");
            $("#temail").effect("shake");
        }
    });
});