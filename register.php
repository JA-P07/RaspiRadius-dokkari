<?php
// Database connection settings
$host = 'localhost'; // Database host
$dbname = 'radius'; // Database name (as per daloRADIUS configuration)
$user = 'radius_user'; // Database user
$password = 'radius_password'; // Database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to save a user to the radcheck table
function saveUser($username, $password, $pdo) {
    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare("INSERT INTO radcheck (username, attribute, op, value) VALUES (:username, 'Cleartext-Password', ':=', :password)");

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);

        // Execute the statement
        $stmt->execute();

        echo "User successfully added to radcheck table.\n";
    } catch (PDOException $e) {
        echo "Error adding user: " . $e->getMessage() . "\n";
    }
}

// Function to check if a user already exists
function userExists($username, $pdo) {
    try {
        // Prepare the SQL statement
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM radcheck WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Fetch the result
        $count = $stmt->fetchColumn();

        return $count > 0;
    } catch (PDOException $e) {
        echo "Error checking user existence: " . $e->getMessage() . "\n";
        return false;
    }
}

// Get username and password from POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (empty($username) || empty($password)) {
        echo "Username and password cannot be empty.\n";
    } else {
        if (userExists($username, $pdo)) {
            echo "User already exists in radcheck table.\n";
        } else {
            saveUser($username, $password, $pdo);
        }
    }
} else {
    echo "Invalid request method. Please use POST.\n";
}
?>
