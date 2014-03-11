$(document).ready(function() {
    $('#treat_polls_content button').click(function() {
        $option_selected = $('input[name=to_do]:checked', '#treat_polls_content').val();
        var option_selected = $('#treat_polls_list').find(":selected").val();
        try {
            //alert($option_selected);
            if ($option_selected === 'state') {
                $.post("index.php?page=admin_polls", {poll_id: option_selected, option: 'state'}, function(data) {
                    $('body').html(data);
                    location.reload();
                });
            }
            else if ($option_selected === 'modify') {
                /*$.post("index.php?page=admin_polls", {poll_id: option_selected}, function(data) {
                 $('body').html(data);
                 location.reload();
                 });
                 */
                alert('Implementación en breve. Gracias por la espera');
            }
            else if ($option_selected === 'delete') {
                /*$.post("index.php?page=admin_polls", {poll_id: option_selected}, function(data) {
                 $('body').html(data);
                 location.reload();
                 });
                 */
                alert('Implementación en breve. Gracias por la espera');
            }
            else{
                alert('Por favor, selecciona una opción.');                
            }
        }
        catch (error) {
            console.log('ERROR:' + error);
        }
        ;
    });
});



