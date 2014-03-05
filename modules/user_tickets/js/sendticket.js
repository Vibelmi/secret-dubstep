$(document).ready(function() {
    $("#send").click(function() {
        subject = $("#subject").val();
        description = $("#description").val();
        if ((subject !== "") && (description !== "")) {
            $("#ticketform").submit();
        }else{
            alert("VACIO");
        }
    });
});