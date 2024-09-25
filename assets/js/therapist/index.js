document.addEventListener("DOMContentLoaded", function() {
    const userIcon = document.getElementById("user-icon");
    const dropdown = document.getElementById("dropdown");

    // Toggle dropdown on click
    userIcon.addEventListener("click", function(event) {
        event.preventDefault(); // Prevent the default action
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    });

    // Close the dropdown if the user clicks outside of it
    document.addEventListener("click", function(event) {
        if (!userIcon.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = "none";
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const rowsPerPage = 7;
    const table = document.getElementById("patients");
    const rows = table.querySelectorAll("tbody tr");
    const paginationControls = document.getElementById("pagination-controls");
    let currentPage = 1;
    const totalPages = Math.ceil(rows.length / rowsPerPage);

    function displayRows(page) {
        const start = (page - 1) * rowsPerPage;
        const end = start + rowsPerPage;
        
        rows.forEach((row, index) => {
            if (index >= start && index < end) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    function createPaginationButtons() {
        paginationControls.innerHTML = "";

        const prevButton = document.createElement("button");
        prevButton.textContent = "Previous";
        prevButton.classList.add("pagination-button");
        prevButton.addEventListener("click", () => {
            if (currentPage > 1) {
                currentPage--;
                updateTable();
            }
        });
        paginationControls.appendChild(prevButton);

        for (let i = 1; i <= totalPages; i++) {
            const button = document.createElement("button");
            button.textContent = i;
            button.classList.add("pagination-button");
            if (i === currentPage) {
                button.classList.add("active");
            }
            button.addEventListener("click", () => {
                currentPage = i;
                updateTable();
            });
            paginationControls.appendChild(button);
        }

        const nextButton = document.createElement("button");
        nextButton.textContent = "Next";
        nextButton.classList.add("pagination-button");
        nextButton.addEventListener("click", () => {
            if (currentPage < totalPages) {
                currentPage++;
                updateTable();
            }
        });
        paginationControls.appendChild(nextButton);

        updateButtonStates();
    }

    function updateTable() {
        displayRows(currentPage);
        createPaginationButtons();
    }

    function updateButtonStates() {
        const buttons = paginationControls.querySelectorAll(".pagination-button");
        buttons.forEach(button => {
            button.classList.remove("active");
        });
        buttons[currentPage].classList.add("active");

        const prevButton = buttons[0];
        const nextButton = buttons[buttons.length - 1];

        if (currentPage === 1) {
            prevButton.classList.add("disabled");
            prevButton.disabled = true;
        } else {
            prevButton.classList.remove("disabled");
            prevButton.disabled = false;
        }

        if (currentPage === totalPages) {
            nextButton.classList.add("disabled");
            nextButton.disabled = true;
        } else {
            nextButton.classList.remove("disabled");
            nextButton.disabled = false;
        }
    }

    updateTable(); // Initialize the table with the first page
});

// document.addEventListener('DOMContentLoaded', function() {
//     // Get all follow-up buttons
//     const followupButtons = document.querySelectorAll('.followup-button');

//     // Loop through each button and attach a click event
//     followupButtons.forEach(function(button) {
//         button.addEventListener('click', function() {
//             const userId = this.getAttribute('data-user-id');
//             let needsFollowup = this.getAttribute('data-followup') == '1'; // Get current follow-up state
//             console.log(needsFollowup)

//             // Toggle follow-up state (true -> false, false -> true)
//             needsFollowup = !needsFollowup;
//             this.setAttribute('data-needs-followup', needsFollowup ? '1' : '0');

//             // Update the row background color based on the follow-up state
//             const row = document.getElementById('row_' + userId);
//             if (needsFollowup) {
//                 row.style.backgroundColor = '#ff9b9b'; // Indicate follow-up needed
//             } else {
//                 row.style.backgroundColor = '#fff'; // Reset background color
//             }

//             // Send an AJAX request to update the follow-up status in the database
//             const xhr = new XMLHttpRequest();
//             xhr.open('POST', '../assets/php/updateUserFollowup.php', true);
//             xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
//             xhr.onreadystatechange = function() {
//                 if (xhr.readyState === 4 && xhr.status === 200) {
//                     console.log(xhr.responseText);
//                 }
//             };
//             xhr.send('user_id=' + userId + '&needs_followup=' + (needsFollowup ? 1 : 0));
//         });
//     });
// });

document.addEventListener('DOMContentLoaded', function() {
    // Get all follow-up buttons
    const followupButtons = document.querySelectorAll('.followup-button');

    // Loop through each button and attach a click event
    followupButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-user-id');
            let needsFollowup = this.getAttribute('data-followup') === '1'; // Get current follow-up state

            // Toggle follow-up state (true -> false, false -> true)
            needsFollowup = !needsFollowup;
            this.setAttribute('data-followup', needsFollowup ? '1' : '0');

            // Update the row background color based on the follow-up state IMMEDIATELY
            const row = document.getElementById('row_' + userId);
            if (needsFollowup) {
                row.style.backgroundColor = '#ff9b9b'; // Follow-up needed (red)
            } else {
                row.style.backgroundColor = '#ffffff'; // Reset background to white
            }

            // Send an AJAX request to update the follow-up status in the database
            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../assets/php/updateUserFollowup.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            // Send user ID and new follow-up state
            xhr.send('user_id=' + userId + '&needs_followup=' + (needsFollowup ? 1 : 0));

            // Handle the server response
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log('Follow-up status updated successfully.');
                    } else {
                        console.error('Failed to update follow-up status. Error: ' + xhr.status);
                        alert('There was an error updating the follow-up status.');
                    }
                }
            };
        });
    });
});
