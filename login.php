<?php
session_start();

// Database connection parameters
$host = 'localhost'; // or your host
$dbname = 'gisubizo_louange_iems';
$username = 'gisubizo';
$password = '222010931';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $password = $_POST['password'];

        // SQL query to authenticate the user
        $sql = "SELECT name FROM user WHERE name = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $password]);

        if ($stmt->rowCount() == 1) {
            // Authentication successful
            $_SESSION['name'] = $name;
            header("Location: home.php"); // Redirect to home page
            exit();
        } else {
            // Authentication failed
            echo "<script>alert('Invalid username or password.'); window.location.href='login&register.html';</script>";
        }
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
