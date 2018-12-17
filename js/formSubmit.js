/**
 * Created by isakl on 03/08/2018.
 */


$(document).ready(function (){

    $('#submitReviewBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: 'https://demofashant.com/partials/parseReview.php',
            data: $('#reviewForm').serialize(),
            success: function (msg) {
                // alert(msg);
                var result = msg.substr(0, msg.indexOf(' '));
                var text = msg.substr(msg.indexOf(' ')+1);

                if(result === "success"){
                    swal({
                            title: "Success",
                            text: "You've successfully left a review.",
                            type: "success"
                        }).then(function(){
                            window.location.reload(true);
                        }
                    );
                }
                if (result === "failed") {
                    swal("Oops!", text, "error");
                }
            }
        });
    });

    $('#newsletterBtn').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: 'https://demofashant.com/partials/parseSubscribe.php',
            data: $('#newsletterRegister').serialize(),
            success: function (msg) {
                var result = msg.substr(0, msg.indexOf(' '));

                if(result === "success"){
                    swal({
                            title: "Success",
                            text: "You've successfully signed up for our newsletter.",
                            type: "success"
                        }).then(function(){
                            window.location.reload(true);
                        }
                    );
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
            url: 'https://demofashant.com/partials/parseAddBrand.php',
            data: $('#addBrandForm').serialize(),
            success: function (msg) {
                // alert(msg);
                var result = msg.substr(0, msg.indexOf(' '));

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
                            title: "Success",
                            text: "You created a new brand successfully.",
                            type: "success"
                        }).then(function(){
                            window.location.reload(true);
                        }
                    );
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
            url: 'https://demofashant.com/partials/parseUploadImages.php',
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
            url: 'https://demofashant.com/partials/parseUploadImages.php',
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
            url: 'https://demofashant.com/partials/parseLogin.php',
            data: $('#login-form').serialize(),
            success: function (msg) {
                console.log(msg);
                var result = msg.substr(0, msg.indexOf(' '));

                if(result === "success"){
                    var link = msg.substr(msg.indexOf(' ')+1);
                    if(link != ""){
                        window.location.href = link;
                    } else {
                        swal({
                                title: "Logged in!",
                                text: "Welcome back.",
                                type: "success"
                            }).then(function(){
                                var url_string = window.location.href;
                                var url = new URL(url_string);
                                var returnUrl = url.searchParams.get("returnURL");
                                if(returnUrl !== null) {
                                    window.location.href = "https://demofashant.com/" + returnUrl;
                                } else {
                                    window.location.href = "https://demofashant.com";
                                }
                            }
                        );
                    }
                }
                if (result === "failed") {
                    swal("You seem to have entered an invalid username or password!",
                         "If you don't have an account yet, please create one. Else, please hit the forgot password button to reset your password.", {
                        buttons: {
                            cancel: "Ok",
                            catch: {
                                text: "Forgot password",
                                value: "forgot",
                            },
                            defeat: false,
                        },
                    })
                        .then((value) => {
                        switch (value) {

                        case "forgot":
                            window.location.href = "https://demofashant.com/forgot_password.php";
                            break;

                        default:

                        }
                    });

                    // document.getElementById('error_container').innerHTML =  msg.substr(msg.indexOf(' ') + 1);
                }
            }
        });

    });

    $('#signupBtn').click(function (e) {

        e.preventDefault();

        $.ajax({
            type: 'post',
            url: 'https://demofashant.com/partials/parseSignup.php',
            data: $('#register-form').serialize(),
            success: function (msg) {
                // alert(msg);
                var result = msg.substr(0, msg.indexOf(' '));
                var text = msg.substr(msg.indexOf(' ')+1);

                if(result === "success"){
                    var link = msg.substr(msg.indexOf(' ')+1);
                    if(link != ""){
                        window.location.href = link;
                    } else {
                        swal({
                                title: "Congratulations!",
                                text: "An verification email has been sent to complete your account setup. Please check spam if you can't see the email.",
                                type: "success"
                            }).then(function(){
                                window.location.reload(true);
                            }
                        );
                    }
                }
                if (result === "failed") {
                    swal("Oops!", text, "error");
                }
            }
        });

    });


    $('#addUser').click(function (e) {
        e.preventDefault();

        $.ajax({
            type: 'post',
            url: 'https://demofashant.com/partials/parseAddUser.php',
            data: $('#addUserForm').serialize(),
            success: function (msg) {
                var result = msg.substr(0, msg.indexOf(' '));

                if (result === "success") {
                    swal({
                            title: "Success",
                            text: "You created a new user successfully.",
                            type: "success"
                        }).then(function(){
                            window.location.reload(true);
                        }
                    );
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
    //         url: 'https://demofashant.com/partials/parseSearch.php',
    //         data: {value:value},
    //         success: function (msg) {
    //             document.getElementById('autocompleteScript').innerHTML = msg;
    //         }
    //     });
    // });

    $("#editFirstnameBtn").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            async: false,
            url: 'https://demofashant.com/partials/parseUpdateUser.php',
            data: {firstname:document.getElementById('editFirstname').value},
            success: function (msg) {
                var result = msg.substr(0, msg.indexOf(' '));

                if (result === "success") {
                    swal({
                            title: "Success",
                            text: "You've update your firstname.",
                            type: "success"
                        }).then(function(){
                            window.location.reload(true);
                        }
                    );

                }
                if (result === "failed") {
                    swal("Oops!", "Something went wrong, please try again.", "error");
                }
            }
        });
    });

    $("#editLastnameBtn").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            async: false,
            url: 'https://demofashant.com/partials/parseUpdateUser.php',
            data: {lastname:document.getElementById('editLastname').value},
            success: function (msg) {
                var result = msg.substr(0, msg.indexOf(' '));

                if (result === "success") {
                    swal({
                            title: "Success",
                            text: "You've update your lastname.",
                            type: "success"
                        }).then(function(){
                            window.location.reload(true);
                        }
                    );
                }
                if (result === "failed") {
                    swal("Oops!", "Something went wrong, please try again.", "error");
                }
            }
        });
    });

    $("#editPasswordBtn").click(function(e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            async: false,
            url: 'https://demofashant.com/partials/parseUpdateUser.php',
            data: {password:document.getElementById('editPassword').value},
            success: function (msg) {
                var result = msg.substr(0, msg.indexOf(' '));

                if (result === "success") {
                    swal({
                            title: "Success",
                            text: "You've update your password.",
                            type: "success"
                        }).then(function(){
                            window.location.reload(true);
                        }
                    );
                }
                if (result === "failed") {
                    swal("Oops!", "Something went wrong, please try again.", "error");
                }
            }
        });
    });


});

function filterListings(type, value){
    var mobile = window.location.href;
    var isMobile = "false";

    if (mobile.indexOf("m.demofashant.com") !=-1) {
        isMobile = "true";
    }


    if(type !== "all"){
        history.pushState({}, "", updateQueryStringParameter(window.location.href, type, value));
    }

    var url = window.location.href;

    $.ajax({
        url : "https://demofashant.com/partials/parseFilterListings.php",
        type: "POST",
        data : {value:value, type:type, url:url, mobile:isMobile},
        success: function(msg, textStatus, jqXHR)
        {
            //data - response from server
            var result = msg.substr(0, msg.indexOf(' '));
            var data = msg.substr(msg.indexOf(' ')+1);

            if(msg === "0 "){
                document.getElementById('listingContainer').innerHTML = "<h2 style='text-align:center; padding-top:5%; padding-bottom:5%;'>No brand result.</h2>";
            } else {
                var numBrands = msg.substr(0,msg.indexOf(' '));

                document.getElementById('listingContainer').innerHTML = data;

                // CREATE NUMBERS WITH LINKS TO BRANDS
                pageLinksList(numBrands, url, 'filterListings');
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    });

}

function pageLinksList(num, url, func){
    var page = 1;
    if(url.indexOf('page=')>=0){
        page = parseInt(getPageNumber(url));
    }

    var newUrl = new URL(url);
    var page = newUrl.searchParams.get("page");

    $.ajax({
        url: "https://demofashant.com/partials/parsePagination.php",
        type: "POST",
        data : {pagination:num, selected:page, func:func}
    }).done(function(data) {
        // alert(data);
        $( "#pagination_list" ).html( data );
    });
}

function getPageNumber(url){
    return $.ajax({
        url :  "https://demofashant.com/partials/parseFilterListings.php",
        type: "POST",
        async: false,
        data : {pageNumber:url},
        success: function(data, textStatus, jqXHR)
        {
            //data - response from server
            return data;

        },
        error: function (jqXHR, textStatus, errorThrown)
        {

        }
    }).responseText;
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
        if(key === "pc[]"){
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


