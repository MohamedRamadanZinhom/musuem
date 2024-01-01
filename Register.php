<?php
include 'Views/public/layout.php';


$message;
(isset($_SESSION["authenticationMessage"]))?$message=$_SESSION["authenticationMessage"]:$message="";

echo '

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Register</h3>
                </div>
                <div class="card-body">
                    <p style="color: red;">'.$message.'</p>
                    <form action="Authentication.php" method="POST">
                        <div class="mb-3">
                        <label for="first_name" class="form-label">first name</label>
                        <input type="text" name="first_name" class="form-control" id="first_name" placeholder="Enter your first name" required>
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">last name</label>
                            <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Enter your last name" required>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">user name</label>
                            <input type="text" name="username" class="form-control" id="username" placeholder="Enter your full name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Enter your password" required>
                        </div>
                        <label for="role">Visitor Type:</label>
                        <select id="role" name="role">
                            <option value="Visitor">Visitor</option>
                            <option value="Student">Student</option>
                        </select>
                       
                        <button type="submit"  name="Register" class="btn btn-primary btn-block">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

';