<?php
// Function to securely hash passwords
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// Function to add an admin user
function addAdminUser($conn, $username, $password) {
    $hashedPassword = hashPassword($password);
    $query = "INSERT INTO adminUsers (username, password) VALUES ('$username', '$hashedPassword')";
    return mysqli_query($conn, $query);
}

// Function to verify admin credentials
function verifyAdminUser($conn, $username, $password) {
    $query = "SELECT * FROM adminUsers WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        return password_verify($password, $user['password']);
    }

    return false;
}
?>
