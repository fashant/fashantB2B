$(document).ready(function () {
    $('#mLoginBtn').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'partials/parseLogin.php',
            data: $('#login-form').serialize(),
            success: function (msg) {
                var result = msg.substr(0, msg.indexOf(' '));
                if (result === "success") {
                    var link = msg.substr(msg.indexOf(' ') + 1);
                    if (link != "") {
                        window.location.href = link;
                    } else {
                        swal({title: "Logged in!", text: "Welcome back.", type: "success"}).then(function () {
                            var url_string = window.location.href;
                            var url = new URL(url_string);
                            var returnUrl = url.searchParams.get("returnURL");
                            if (returnUrl !== null) {
                                window.location.href = "https://m.demofashant.com/" + returnUrl;
                            } else {
                                window.location.href = "https://m.demofashant.com";
                            }
                        });
                    }
                }
                if (result === "failed") {
                    swal("You seem to have entered an invalid username or password!", "If you don't have an account yet, please create one. Else, please hit the forgot password button to reset your password.", {
                        buttons: {
                            cancel: "Ok",
                            catch: {text: "Forgot password", value: "forgot",},
                            defeat: false,
                        },
                    }).then((value) = > {
                        switch(value) {                        case
                            "forgot"
                        :
                            window.location.href = "https://demofashant.com/forgot_password.php";
                            break;
                        default:
                        }
                    }
                )
                    ;
                    // document.getElementById('error_container').innerHTML =  msg.substr(msg.indexOf(' ') + 1);
                }
            }
        });
    });
    $('#mSignupBtn').click(function (e) {
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: 'partials/parseSignup.php', data: $('#register-form').serialize(),
            success: function (msg) {
                // alert(msg);
                var result = msg.substr(0, msg.indexOf(' '));
                var text = msg.substr(msg.indexOf(' ') + 1);
                if (result === "success") {
                    var link = msg.substr(msg.indexOf(' ') + 1);
                    if (link != "") {
                        window.location.href = link;
                    } else {
                        swal({
                            title: "Congratulations!",
                            text: "An verification email has been sent to complete your account setup. Please check spam if you can't see the email.",
                            type: "success"
                        }).then(function () {
                            window.location.reload(true);
                        });
                    }
                }
                if (result === "failed") {
                    swal("Oops!", text, "error");
                }
            }
        });
    });
});