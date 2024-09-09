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
    const rowsPerPage = 10;
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