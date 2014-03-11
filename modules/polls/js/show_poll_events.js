$(document).ready(function() {
    $('#polls_list .option').click(function() {
        $option_value = $('input[name=option]:checked', '#polls_list').val();
        try {
            $.post("index.php", {option_id: $option_value}, function(data) {
                $('body').html(data);
                //location.reload();
            });
        }
        catch (error) {
            console.log('ERROR:' + error);
        }
        ;
    });
});

