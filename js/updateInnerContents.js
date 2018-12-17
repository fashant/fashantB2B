/**
 * Created by isakl on 03/08/2018.
 */

function updateInnerContents(id, page){
    var url = "resources/updateInnerContents.php";

    $.ajax({
        url : url,
        type: "POST",
        data : {page:"../"+page},
        success: function(data, textStatus, jqXHR)
        {
            //data - response from server
            document.getElementById(id).innerHTML = data;
            $(document).ready(function() {
                $.getScript("js/formSubmit.js");
            });

        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}


function updateUserContainer(id, page){
    var url = "resources/updateUserContainer.php";

    $.ajax({
        url : url,
        async: false,
        type: "POST",
        data : {page:"../"+page},
        success: function(data, textStatus, jqXHR)
        {
            //data - response from server
            document.getElementById(id).innerHTML = data;
            $(document).ready(function() {
                $.getScript("js/formSubmit.js");
                $.getScript("js/social.js");
                $.getScript("https://apis.google.com/js/platform.js");
            });

        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });
}




