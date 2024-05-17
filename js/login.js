// Check if the browser supports local storage
if (typeof(Storage) !== "undefined") {
    // Retrieve values from local storage and set them as input values
    document.getElementById("username").value = localStorage.getItem("username");
    document.getElementById("password").value = localStorage.getItem("password");

    // Store input values in local storage when the form is submitted
    document.getElementById("submitBtn").addEventListener("click", function() {
        localStorage.setItem("username", document.getElementById("username").value);
        localStorage.setItem("password", document.getElementById("password").value);

        // Mark the form as submitted
        document.querySelector("form").submitted = true;
    });

    // Clear input fields when the clear form button is clicked
    document.getElementById("clearBtn").addEventListener("click", function() {
        document.getElementById("username").value = "";
        document.getElementById("password").value = "";

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
