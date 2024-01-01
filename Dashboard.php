<?php
include './Views/public/layout.php';


echo '
<div class="container-fluid" >
    <div class="row">

        <!-- Left Side Menu -->
        <div class="col-md-3">
            <div class="list-group"  style="background-color: rgba(255, 255, 255, 0.7);">
                <a href="#" class="list-group-item list-group-item-action" onclick="loadTable(\'users\')">Manage Users</a>
                <a href="#" class="list-group-item list-group-item-action" onclick="loadTable(\'user_roles\')">Manage User Roles</a>
                <a href="#" class="list-group-item list-group-item-action" onclick="loadTable(\'content\')">Manage Content</a>
                <a href="#" class="list-group-item list-group-item-action" onclick="loadTable(\'souvenirs\')">Manage Souvenirs</a>
                <a href="#" class="list-group-item list-group-item-action" onclick="loadTable(\'tickets\')">Manage Tickets</a>
                <a href="#" class="list-group-item list-group-item-action" onclick="loadTable(\'ticket_types\')">Manage Ticket Types</a>
                <a href="#" class="list-group-item list-group-item-action" onclick="loadTable(\'orders\')">Manage Orders</a>
                <!-- Add more links as needed -->
            </div>
        </div>

        <!-- Right Side Content -->
        <div class="col-md-9">
            <div id="tableContainer">
                <!-- Table content will be loaded here dynamically -->
            </div>
        </div>

    </div>
</div>
';
?>





<script>
    // Function to load table content dynamically
    function loadTable(tableName) {
        // Your code to load data and display the table content goes here
        // For now, let's just print the selected table name
        console.log('Loading table:', tableName);
    }
</script>


