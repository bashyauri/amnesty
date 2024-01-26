$(document).ready(function () {
    // Handle checkbox change
    $(document).on("change", ".recommend-checkbox", function () {
        // Check if the checkbox is checked
        if ($(this).is(":checked")) {
            // Get the row with the hidden-row class.
            var $row = $(this).closest("tr");

            // Get the value of the criteria field

            var messageContainer = $row.find(".message-container");

            // Perform client-side validation

            // Get the values of the form elements in the row.
            var data = {
                comments: $row.find(".comments").val(),
                accountId: $row.find(".recommend-checkbox").val(),
                recommend: 1, // Set to 1 when checked
            };

            // Send an Ajax request to the server.
            $.ajax({
                url: "recommend",
                type: "POST",
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                success: function (response) {
                    messageContainer
                        .text("Recommended successfully")
                        .removeClass("error")
                        .addClass("success text-success");

                    console.log("The request was successful.");
                    console.log(response);
                },
                error: function (error) {
                    // If the request failed, show an error message.
                    alert(error);
                    console.log(error);

                    messageContainer
                        .text("error")
                        .removeClass("success")
                        .addClass("error text-danger");
                },
            });
        }
    });
});
