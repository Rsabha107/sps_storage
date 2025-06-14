    $(document).ready(function() {
        $('#find_ref_number').focus();
    });

$("#visitor_form").on("submit", function (event) {
    console.log("Form submitted");
    event.preventDefault();

    var refNumber = $("#find_ref_number").val();
    $("#cover-spin").show();
    console.log("inside #visitor_form: " + refNumber);
    var btn = $("#submitBtn");
    btn.prop("disabled", true);
    $.ajax({
        url: "/spss/admin/visitor/mv/get/" + refNumber,
        method: "GET",
        async: true,
        success: function (response) {
            console.log("inside success");
            console.log(response.error);
            if (!response.error) {
                g_response = response.view;
                $('#find_ref_number').val("");
                $('#find_ref_number').focus();
                $("#visitor-stored-item-content").empty("").append(g_response);
                // $("#stored_item_detail_modal").modal("show");
                $("#cover-spin").hide();
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-center",
                    timeOut: "3000",
                };
                toastr.success(response.message);
                btn.prop("disabled", false);
            } else {
                console.log("inside else");
                $("#visitor-stored-item-content").empty("");
                $('#find_ref_number').focus();
                $('#find_ref_number').select();
                $("#cover-spin").hide();
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-center",
                    timeOut: "3000",
                };
                toastr.error(response.message);
                btn.prop("disabled", false);
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
            $("#cover-spin").hide();
            btn.prop("disabled", false);
        },
    });
});
