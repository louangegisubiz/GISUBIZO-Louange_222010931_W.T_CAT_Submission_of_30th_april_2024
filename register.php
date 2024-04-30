<?php
$host = 'localhost'; // Database host
$dbname = 'gisubizo_louange_iems'; // Database name
$username = 'gisubizo'; // Database user
$password = '222010931'; // Database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $password = $_POST['password']; // Consider using password_hash() in real applications
        $email = $_POST['email'];

        // Prepare SQL statement to prevent SQL injection
        $sql = "INSERT INTO user (name, password, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$name, $password, $email]);

        // Redirect the user to the homepage after successful registration
        header("Location: home.php");
        exit(); // Ensure no further code is executed after the redirection
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
