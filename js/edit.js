// Check if the browser supports local storage
if (typeof(Storage) !== "undefined") {
    // Retrieve values from local storage and set them as input values
    document.getElementById("phone_number").value = localStorage.getItem("phone_number");
    document.getElementById("password").value = localStorage.getItem("password");
    document.getElementById("Last_name").value = localStorage.getItem("Last_name");
    document.getElementById("First_name").value = localStorage.getItem("First_name");
    document.getElementById("Middle_name").value = localStorage.getItem("Middle_name");
    document.getElementById("Email").value = localStorage.getItem("Email");
    document.getElementById("address").value = localStorage.getItem("address");
    document.getElementById("date_of_birth").value = localStorage.getItem("date_of_birth");
    document.getElementById("gender").value = localStorage.getItem("gender");
    document.getElementById("social_media").value = localStorage.getItem("social_media");
    document.getElementById("profile_picture").value = localStorage.getItem("profile_picture");

    // Store input values in local storage when the form is submitted
    document.getElementById("submitBtn").addEventListener("click", function() {
        localStorage.setItem("phone_number", document.getElementById("phone_number").value);
        localStorage.setItem("password", document.getElementById("password").value);
        localStorage.setItem("Last_name", document.getElementById("Last_name").value);
        localStorage.setItem("First_name", document.getElementById("First_name").value);
        localStorage.setItem("Middle_name", document.getElementById("Middle_name").value);
        localStorage.setItem("Email", document.getElementById("Email").value);
        localStorage.setItem("address", document.getElementById("address").value);
        localStorage.setItem("date_of_birth", document.getElementById("date_of_birth").value);
        localStorage.setItem("gender", document.getElementById("gender").value);
        localStorage.setItem("social_media", document.getElementById("social_media").value);
        localStorage.setItem("profile_picture", document.getElementById("profile_picture").value);

        // Mark the form as submitted
        document.querySelector("form").submitted = true;
    });

    // Clear input fields when the clear form button is clicked
    document.getElementById("clearBtn").addEventListener("click", function() {
        document.getElementById("username").value = "";
        document.getElementById("password").value = "";
        document.getElementById("Last_name").value = "";
        document.getElementById("First_name").value = "";
        document.getElementById("Middle_name").value = "";
        document.getElementById("Email").value = "";
        document.getElementById("Status").value = "";

         // Hide the error message if it is currently displayed
    var errorAlert = document.getElementById("errorAlert");
    if (errorAlert) {
        errorAlert.style.display = "none";
    }
    });

    // Clear local storage when navigating away from the page without submitting the form
    window.addEventListener('beforeunload', function(event) {
        if (!document.querySelector("form").submitted) {
            localStorage.removeItem("username");
            localStorage.removeItem("password");
            localStorage.removeItem("Last_name");
            localStorage.removeItem("First_name");
            localStorage.removeItem("Middle_name");
            localStorage.removeItem("Email");
            localStorage.removeItem("Status");

            // Hide the error message if it is currently displayed
        var errorAlert = document.getElementById("errorAlert");
        if (errorAlert) {
            errorAlert.style.display = "none";
        }
    }
    });

    // Clear all input fields on "Clear All Fields" button click
    document.getElementById('clearFieldsBtn').addEventListener('click', function() {
        document.querySelectorAll('input').forEach(input => {
            input.value = '';
        });
    });
} else {
    // Local storage is not supported
    alert("Sorry, your browser does not support web storage. Your inputs will not be saved.");
}
