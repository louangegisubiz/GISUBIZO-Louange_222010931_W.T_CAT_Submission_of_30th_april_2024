<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'your_database_name';
$username = 'your_username';
$password = 'your_password';

try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];

        // Prepare SQL statement to insert data into the schedules table
        $sql = "INSERT INTO schedules (title, description, date) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$title, $description, $date]);

        // Redirect to the homepage or display a success message
        header("Location: home.php");
        exit();
    }
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
