$(document).ready(function() {
    $("#send").click(function() {
        $("#email").css("border-color", "none");
        $("#subject").css("border-color", "none");
        $("#description").css("border-color", "none");
        emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.([a-zA-Z]{2,4})+$/;
        email = $("#email").val();
        subject = $("#subject").val();
        description = $("#description").val();
        if (email.match(emailReg)) {
            if (subject !== "") {
                if (description !== "") {
                    $("#ticketform").submit();
                } else {
                    $("#description").css("border-color", "red");
                }
            } else {
                $("#subject").css("border-color", "red");
            }
        } else {
            $("#email").css("border-color", "red");
        }
    });
});