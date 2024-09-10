document.addEventListener("DOMContentLoaded", function() {
    const login = document.getElementById("login");
    const loginDropdown = document.getElementById("loginDropdown");

    // Toggle dropdown on click
    login.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default action
        loginDropdown.style.display = loginDropdown.style.display === "block" ? "none" : "block";
    });

    // Close the loginDropdown if the user clicks outside of it
    document.addEventListener("click", function(event) {
        if (!login.contains(event.target) && !loginDropdown.contains(event.target)) {
            loginDropdown.style.display = "none";
        }
    });
});