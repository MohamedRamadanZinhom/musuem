// Add this script to your existing JavaScript

document.addEventListener("DOMContentLoaded", function () {
    const itemsPerPage = 8; // Set the desired number of items per page
    const gridContainer = document.getElementById("gridContainer");
    const pagination = document.getElementById("pagination");
    const totalItems = /* Set the total number of items from your database or other source */;

    function updateGrid(page) {
        gridContainer.innerHTML = ""; // Clear existing content
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        
        // Use your data source to populate the grid items dynamically
        for (let i = startIndex; i < endIndex && i < totalItems; i++) {
            const box = document.createElement("div");
            box.className = "box";
            // Customize the content based on your data source
            box.innerHTML = `<h4>Item ${i + 1}</h4>`;
            gridContainer.appendChild(box);
        }
    }

    function updatePagination() {
        pagination.innerHTML = "";
        const totalPages = Math.ceil(totalItems / itemsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const pageLink = document.createElement("a");
            pageLink.href = "#";
            pageLink.textContent = i;
            pageLink.addEventListener("click", function () {
                updateGrid(i);
            });
            pagination.appendChild(pageLink);
        }
    }

    // Initial setup
    updateGrid(1); // Show the first page
    updatePagination();
});
