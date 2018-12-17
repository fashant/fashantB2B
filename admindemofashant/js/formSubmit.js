/**
 * Created by isakl on 03/08/2018.
 */


$(document).ready(function (){

    $('#submitReviewBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../partials/parseReview.php',
            data: $('#reviewForm').serialize(),
            success: function (msg) {
                // alert(msg);
                var result = msg.substr(0, msg.indexOf(' '));

                if(result === "success"){
                    swal({
                        title:"Success!",
                        text:"You've successfully left a review.",
                        icon:"success",
                        timer: 3000
                    });
                }
                if (result === "failed") {
                    swal("Oops!", "Something went wrong, please try again.", "error");
                }
            }
        });
    });



    $('#newsletterBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../partials/parseSubscribe.php',
            data: $('#newsletterRegister').serialize(),
            success: function (msg) {
                var result = msg.substr(0, msg.indexOf(' '));

                if(result === "success"){
                    swal({
                        title:"Success!",
                        text:"You've successfully signed up for our newsletter.",
                        icon:"success",
                        timer: 3000
                    }).then(function () {
                        window.location.reload(true);
                    });
                }
                if (result === "failed") {
                    swal("Oops!", "Something went wrong, please try again.", "error");

                }
            }
        });
    });

    $('#submitNewBrand').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: '../partials/parseAddBrand.php',
            data: $('#addBrandForm').serialize(),
            success: function (msg) {
                // alert(msg);
                var result = msg.substr(0, msg.indexOf(' '));
                var message = msg.substr(msg.indexOf(' ')+1); // "melding"


                if(result === "success"){
                    // Upload logo
                    var logo = document.getElementById('uploadLogo').files[0];
                    var brandId = msg.substr(msg.indexOf(' ')+1);

                    var formData = new FormData();
                    formData.append('logo', logo);
                    formData.append('brandId', brandId);
                    uploadLogo(formData);

                    // Upload images
                    var fd = new FormData();
                    fd.append('brandId', brandId);
                    var ins = document.getElementById('brandImages').files.length;
                    for (var x = 0; x < ins; x++) {
                        fd.append("brandImages[]", document.getElementById('brandImages').files[x]);
                    }

                    uploadImages(fd);

                    swal({
                        title:"Success!",
                        text:"You created a new brand successfully.",
                        icon:"success",
                        timer: 2000
                    }).then(function () {
                        window.location.href = "http://admin.fashant.com/admin-list-edit.php?id=" + message;
                        window.location.reload(true);
                    });
                }
                if (result === "failed") {
                    document.getElementById('error_container').innerHTML =  msg.substr(msg.indexOf(' ') + 1);
                    //document.getElementById('error_container').innerHTML =  msg;

                }
            }
        });

    });

    $("#uploadLogo").on("change", function() {
        // Check dimention of logo
        var img = new Image();

        img.src = window.URL.createObjectURL(document.getElementById('uploadLogo').files[0]);

        img.onload = function() {
            var width = img.naturalWidth,
                height = img.naturalHeight;

            window.URL.revokeObjectURL( img.src );

            if( width !== 1350 && height !== 500 ) {
                swal("Oops!", "Wrong dimensions on image", "error");
                $('#uploadLogo').removeAttr('value');
            }
        };

    });

    $("#brandImages").on("change", function() {
        // Check numbers of images
        if($("#brandImages")[0].files.length > 5) {
            swal("Oops!", "You can select only 5 images", "error");
            $('#brandImages').removeAttr('value');
        } else {

        }

        // Check dimention of images
        var i;
        for(i = 0 ; i < $("#brandImages")[0].files.length; i++){
            var img = new Image();

            img.src = window.URL.createObjectURL(document.getElementById('brandImages').files[i]);

            img.onload = function() {
                var width = img.naturalWidth,
                    height = img.naturalHeight;

                window.URL.revokeObjectURL( img.src );

                if( width !== 750 && height !== 500 ) {
                    swal("Oops!", "Wrong dimensions on images", "error");
                    $('#brandImages').removeAttr('value');
                }
            };
        }

    });

    function uploadLogo(formData){
        $.ajax({
            type: 'post',
            url: '../partials/parseUploadImages.php',
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success: function (msg) {
                var result = msg.substr(0, msg.indexOf(' '));

                if(result === "success"){

                }
                if (result === "failed") {
                    // document.getElementById('error_container').innerHTML =  msg.substr(msg.indexOf(' ') + 1);
                    document.getElementById('error_container').innerHTML =  msg;

                    // TODO Delete brand

                }
            }
        });
    }

    function uploadImages(formData){
        $.ajax({
            type: 'post',
            url: '../partials/parseUploadImages.php',
            data: formData,
            processData: false,  // tell jQuery not to process the data
            contentType: false,  // tell jQuery not to set contentType
            success: function (msg) {
                var result = msg.substr(0, msg.indexOf(' '));

                if(result === "success"){

                }
                if (result === "failed") {
                    // document.getElementById('error_container').innerHTML =  msg.substr(msg.indexOf(' ') + 1);
                    document.getElementById('error_container').innerHTML =  msg;

                    // TODO Delete brand

                }
            }
        });
    }

    $('#loginBtn').click(function (e) {

        e.preventDefault();

        $.ajax({
            type: 'post',
            url: 'partials/parseLogin.php',
            data: $('#login-form').serialize(),
            success: function (msg) {
                console.log(msg);
                var result = msg.substr(0, msg.indexOf(' '));

                if(result === "success"){
                    var link = msg.substr(msg.indexOf(' ')+1);
                    if(link != ""){
                        window.location.href = link;
                    } else {
                        window.location.href = 'listingPanel.php';
                    }
                }
                if (result === "failed") {
                    document.getElementById('error_container').innerHTML =  msg.substr(msg.indexOf(' ') + 1);
                }
            }
        });

    });

    $('#addUser').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: 'partials/parseAddUser.php',
            data: $('#addUserForm').serialize(),
            success: function (msg) {
                var result = msg.substr(0, msg.indexOf(' '));

                if (result === "success") {
                    swal({
                        title:"Success!",
                        text:"You created a new user successfully.",
                        icon:"success",
                        timer: 2000
                    }).then(function () {
                        window.location.reload(true);
                    });
                }
                if (result === "failed") {
                    document.getElementById('error_container').innerHTML = msg.substr(msg.indexOf(' ') + 1);
                }
            }
        });

    });

    // $("#select-search").on("input", function() {
    //     var value = this.value;
    //     $.ajax({
    //         type: 'post',
    //         url: '../partials/parseSearch.php',
    //         data: {value:value},
    //         success: function (msg) {
    //             document.getElementById('autocompleteScript').innerHTML = msg;
    //         }
    //     });
    // });

});


function filterListings(type, value){
    if(type !== "all"){
        history.pushState({}, "", updateQueryStringParameter(window.location.href, type, value));
    }

    var url = window.location.href;

    $.ajax({
        url : "../partials/parseFilterListings.php",
        type: "POST",
        data : {value:value, type:type, url:url},
        success: function(msg, textStatus, jqXHR)
        {
            //data - response from server
            var result = msg.substr(0, msg.indexOf(' '));
            var data = msg.substr(msg.indexOf(' ')+1);

            if(result === "success"){
                document.getElementById('listingContainer').innerHTML = data;
            }
            if (result === "failed") {
                document.getElementById('listingContainer').innerHTML = "<h2 style='text-align:center; padding-top:5%; padding-bottom:5%;'>No brand result.</h2>";
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });



}

function updateQueryStringParameter(uri, key, value) {
    uri = decodeURIComponent(uri);
    value = decodeURIComponent(value);

    var re = new RegExp("([?&])" + key + "=.*?(&|$)", "i");
    var separator = uri.indexOf('?') !== -1 ? "&" : "?";

    var duplication_exp = "&" + key + "=" + value;

    if(uri.indexOf(duplication_exp) === -1){
        if (uri.match(re)) {
            var url = uri.replace(re, '$1' + key + "=" + value + '$2');

            // REMOVE KEY IF VALUE IS EMPTY
            if(value === ""){
                // var exp = "&" + key + "=";
                // url = url.replace(exp, "");
                re = new RegExp("([?&])" + key +"=.*?(&|$)", "i");
                url = url.replace(re, "");
            }

            // REMOVE MODEL IF BRAND IS UPDATED
            // if(key === "brand" && uri.indexOf('model') > -1){
            //     re = new RegExp("([?&])model=.*?(&|$)", "i");
            //     url = url.replace(re, "&");
            //     if (url.substring(url.length-1) == "&")
            //     {
            //         url = url.substring(0, url.length-1);
            //     }
            // }

            url = url.replace('&&', '&');
            return url;
        } else {
            url = uri + separator + key + "=" + value;
            url = url.replace('&&', '&');
            return url;
        }
    } else {
        url = uri.replace(re, "&"); // Removes key and value if value is empty

        if(key === "items[]"){
            url = uri.replace(duplication_exp, "");
        }
        if(key === "categories[]"){
            url = uri.replace(duplication_exp, "");
        }
        if(key === "sc[]"){
            url = uri.replace(duplication_exp, "");
        }
        if(key === "brands[]"){
            url = uri.replace(duplication_exp, "");
        }

        // REMOVE MODEL IF BRAND IS UPDATED
        // if(key === "brand" && uri.indexOf('model') > -1){
        //     re = new RegExp("([?&])model=.*?(&|$)", "i");
        //     url = url.replace(re, "&");
        //     if (url.substring(url.length-1) == "&")
        //     {
        //         url = url.substring(0, url.length-1);
        //     }
        // }

        url = url.replace('&&', '&');
        return url;
    }
}

function uploadExcel(){
    var excel = $('#excelUpload').prop('files')[0];

    var formData = new FormData();
    formData.append('excel', excel);

    $.ajax({
        type: 'post',
        url: '../partials/excelBrandsUpload.php',
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success: function (msg) {
            var result = msg.substr(0,msg.indexOf(' ')); // "failed"
            var message = msg.substr(msg.indexOf(' ')+1); // "melding"

            document.getElementById('uploadInfo').innerHTML = message;

            if(result === "success"){
                swal({
                    title:"Success!",
                    text:"You've successfully added new brands.",
                    icon:"success",
                    timer: 3000
                }).then(function () {
                    window.location.reload(true);
                });
            }
            if (result === "failed") {
                swal("Oops!", message, "error");
            }
        }
    });
}

function updateExcel(){
    var excel = $('#excelUpdate').prop('files')[0];

    var formData = new FormData();
    formData.append('excel', excel);

    $.ajax({
        type: 'post',
        url: '../partials/excelBrandsUpdate.php',
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success: function (msg) {
            var result = msg.substr(0,msg.indexOf(' ')); // "failed"
            var message = msg.substr(msg.indexOf(' ')+1); // "melding"

            document.getElementById('updateInfo').innerHTML = message;

            if(result === "success"){
                swal({
                    title:"Success!",
                    text:"You've successfully added new brands.",
                    icon:"success",
                    timer: 3000
                }).then(function () {
                    window.location.reload(true);
                });
            }
            if (result === "failed") {
                swal("Oops!", message, "error");
            }
        }
    });
}

