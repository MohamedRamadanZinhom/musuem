<?php

class UserController
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function registerUser($data)
    {
        // Validate and sanitize input data
        // ...

        // Check if the username is available
        if (!$this->user->isUsernameAvailable($data['username'])) {
            // Handle username not available
            return 'Username is not available';
        }

        // Create a new user
        $userId = $this->user->createUser($data['first_name'], $data['last_name'], $data['username'], $data['email'], $data['password']);

        // Assign a default role to the user (e.g., 'visitor')
        $this->user->assignUserRole($userId, 'visitor');

        // Redirect to the login page or perform other actions
        // ...

        return 'Registration successful';
    }

    public function loginUser($username, $password)
    {
        // Authenticate the user
        $user = $this->user->authenticateUser($username, $password);

        if ($user) {
            // Check if the user is blocked
            if ($this->user->isUserBlocked($user['id'])) {
                // Handle blocked user
                return 'User is blocked';
            }

            // Log in the user (e.g., set session variables)
            // ...

            // Redirect to the home page or perform other actions
            // ...

            return 'Login successful';
        } else {
            // Handle authentication failure
            return 'Invalid username or password';
        }
    }

    public function viewUserProfile($userId)
    {
        // Check if the user is deleted
        if ($this->user->isUserDeleted($userId)) {
            // Handle deleted user
            return 'User not found';
        }

        // Get user details from the model
        $user = $this->user->getUserById($userId);

        // Display user profile view
        // ...

        return $user; // This could be used to pass user data to the view
    }

    // Other methods for updating, deleting, blocking, unblocking users, etc.
    // ...
}

?>
