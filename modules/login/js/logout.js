$('document').ready(function() {
    $('#btnlogout').click(logout);
});

function logout() {
    $.post("index.php", {ajax: "login", logout:""}, function() {
        location.reload();
    });
}