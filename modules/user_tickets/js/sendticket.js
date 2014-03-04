$(document).ready(function(){
  $("#send").click(function(){
    subject=$("#subject").val();
    description=$("#description").val();
    $.post("index.php?page=utickets",{subject:subject,description:description },function(result){
      location.href="index.php?page=utickets";
    });
  });
});