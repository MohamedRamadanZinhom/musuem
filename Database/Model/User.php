<?php

class User
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    // Create a new user
    public function createUser($firstName, $lastName, $username, $email, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO User (first_name, last_name, username, email, password, isblocked, deleted)
                VALUES (?, ?, ?, ?, ?, 0, 0)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$firstName, $lastName, $username, $email, $hashedPassword]);

        return $this->pdo->lastInsertId();
    }

    public function Register($firstName, $lastName, $username, $email, $password,$role)
    {
        if(!$this->isUsernameAvailable($username) && ! $this->isUserEmailAvailable($email))
        {
            $userId=$this->createUser($firstName, $lastName, $username, $email, $password);
            $this->assignUserRole($userId, $role);
            session_start();
            $_SESSION['user_id'] = $userId; // Store user ID in the session
            $_SESSION["authenticationMessage"]="";
            $_SESSION["ISauthenticated"] ="true";
            $_SESSION["Role"] =$role;
            $_SESSION['admin_name']=$username;
            header("Location: index.php"); //
            exit();
        }
        else
        {
            $_SESSION["authenticationMessage"] ="your username or email is Exist";
            $_SESSION["ISauthenticated"] ="true";
            $_SESSION['admin_name']="";
            header("Location: Register.php");
            exit();
        }
    }

    // Read user by ID
    public function getUserById($userId)
    {
        $sql = "SELECT * FROM User WHERE id = ? AND deleted = 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Read user by username
    public function getUserByUsername($username)
    {
        $sql = "SELECT * FROM User WHERE username = ? AND deleted = 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update user by ID
    public function updateUser($userId, $firstName, $lastName, $username, $email)
    {
        $sql = "UPDATE User SET first_name = ?, last_name = ?, username = ?, email = ? WHERE id = ? AND deleted = 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$firstName, $lastName, $username, $email, $userId]);

        return $stmt->rowCount();
    }

    // Soft delete user by ID
    public function softDeleteUser($userId)
    {
        $sql = "UPDATE User SET deleted = 1 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->rowCount();
    }

    // Block user by ID
    public function blockUser($userId)
    {
        $sql = "UPDATE User SET blocked = 1 WHERE id = ? AND deleted = 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->rowCount();
    }

    // Undelete user by ID
    public function undeleteUser($userId)
    {
        $sql = "UPDATE User SET deleted = 0 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->rowCount();
    }

    // Unblock user by ID
    public function unblockUser($userId)
    {
        $sql = "UPDATE User SET blocked = 0 WHERE id = ? AND deleted = 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->rowCount();
    }

    // Check if a user is deleted
    public function isUserDeleted($userId)
    {
        $sql = "SELECT deleted FROM User WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return (bool) $stmt->fetchColumn();
    }

    // Check if a user is blocked
    public function isUserBlocked($userId)
    {
        $sql = "SELECT blocked FROM User WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return (bool) $stmt->fetchColumn();
    }

    // Check if a username is available (not taken)
    public function isUsernameAvailable($username)
    {
        $sql = "SELECT COUNT(*) FROM User WHERE username = ? AND deleted = 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);

        return $stmt->fetchColumn() === 0;
    }

    // Check if a username is available (not taken)
    public function isUserEmailAvailable($email)
    {
        $sql = "SELECT COUNT(*) FROM User WHERE email = ? AND deleted = 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);

        return $stmt->fetchColumn() === 0;
    }

    // Authenticate user by username and password
    public function authenticateUser($username, $password)
    {
    
        $sql = "SELECT * FROM User WHERE username = ? AND deleted = 0 AND isblocked = 0";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
     
        if ($user && password_verify($password, $user['password'])) {
            $role=$this->getUserRoles($user['id']);
            $_SESSION["Role"] =$role[0];
            return $user;
        }

        return null;
    }

    // Assign a role to a user
    public function assignUserRole($userId, $role)
    {
        $sql = "INSERT INTO user_role (user_id, role) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId, $role]);

        return $this->pdo->lastInsertId();
    }

    // Get roles for a user
    public function getUserRoles($userId)
    {
        $sql = "SELECT role FROM user_role WHERE user_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId]);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}

?>
