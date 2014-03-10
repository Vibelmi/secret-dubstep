$(document).ready(function() {

    function GetURLParameter(sParam)
    {
        var sPageURL = window.location.search.substring(1);
        var sURLVariables = sPageURL.split('&');
        for (var i = 0; i < sURLVariables.length; i++)
        {
            var sParameterName = sURLVariables[i].split('=');
            if (sParameterName[0] == sParam)
            {
                return sParameterName[1];
            }
        }
    }
    
    //Send new poll to database
    $('#new_poll #button').click(function() {
        $title = $('#new_poll #title_ipt').val();
        options = $('#new_poll #options_ta').val();
        options = options.split('\n');


        $lang = GetURLParameter('lang');
        if($lang===undefined){
            $url="index.php?page=admin_polls"+'&'+$lang;
            }
            else{
            $url="index.php?page=admin_polls";
            }
            
        try {
            $.post("index.php?page=admin_polls", {title: $title, options: options}, function(data) {
                $('body').html(data);
                location.reload();
            });
        }
        catch (error) {
            console.log('ERROR:' + error);
        }
        ;
    });
});






