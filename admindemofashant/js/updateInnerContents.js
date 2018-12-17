/**
 * Created by isakl on 03/08/2018.
 */

var isChecked = false;

function updateInnerContents(id, page){
    var url = "resources/updateInnerContents.php";

    var page_nr = window.location.href;

    $.ajax({
        url : url,
        type: "POST",
        data : {page:"../"+page, page_nr:page_nr},
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

function deleteBrand(id){
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover the brand!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: 'post',
                url: '../partials/parseDeleteBrand.php',
                data: {id:id},
                success: function (msg) {
                    // alert(msg);
                    var result = msg.substr(0, msg.indexOf(' '));

                    if(result === "success"){
                        swal({
                            title:"Success!",
                            text:"You've successfully deleted the brand.",
                            icon:"success",
                            timer: 3000
                        }).then(function () {
                            window.location.href = "http://admin.fashant.com/admin-all-listing.php";
                        });
                    }
                    if (result === "failed") {
                        swal("Oops!", "Something went wrong, please try again.", "error");
                    }
                }
            });
        } else {
            swal("Your brand is safe!");
}
});
}

function deleteSelectedBrands(){
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover the brand!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                var checkboxes = document.getElementsByName('deleteBrandCheckbox');
                var checkboxesChecked = [];
                // loop over them all
                for (var i=0; i<checkboxes.length; i++) {
                    // And stick the checked ones onto an array...
                    if (checkboxes[i].checked) {
                        checkboxesChecked.push(checkboxes[i]);
                    }
                }

                if(checkboxesChecked.length > 0) {
                    for (var i = 0; i<checkboxesChecked.length; i++) {
                        id = checkboxesChecked[i].value;

                        $.ajax({
                            type: 'post',
                            url: '../partials/parseDeleteBrand.php',
                            data: {id: id},
                            success: function (msg) {
                                // alert(msg);
                                var result = msg.substr(0, msg.indexOf(' '));

                            }
                        });
                    }

                    swal({
                        title:"Success!",
                        text:"You've successfully deleted the brand.",
                        icon:"success",
                        timer: 3000
                    }).then(function () {
                        window.location.href = "http://admin.fashant.com/admin-all-listing.php";
                    });
                } else {
                    swal("Oops!", "Something went wrong, please try again.", "error");
                }
            } else {
                swal("Your brand is safe!");
            }
        });
}

function selectAllBrands(){
    // deleteBrandCheckbox

    var checkboxes = document.getElementsByName('deleteBrandCheckbox');
    if (isChecked) {
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox') {
                checkboxes[i].checked = false;
            }
        }
    } else {
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox') {
                checkboxes[i].checked = true;
            }
        }
    }
    isChecked = !isChecked;
}

function updateAdminAllListingTable(value){
    var obj = {Page:'admin-all-listing', Url:'admin-all-listing.php'};
    history.pushState(obj, obj.Page, obj.Url);
    history.pushState({}, '', updateQueryStringParameter(window.location.href, 'page', value));
    updateInnerContents('innerContents', 'admin-all-listing.php');
}

function updateAdminReviewsTable(value){
    var obj = {Page:'admin-reviews', Url:'admin-reviews.php'};
    history.pushState(obj, obj.Page, obj.Url);
    history.pushState({}, '', updateQueryStringParameter(window.location.href, 'page', value));
    updateInnerContents('innerContents', 'admin-reviews.php');
}