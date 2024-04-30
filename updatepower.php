<?php
// Database connection parameters
$host = 'localhost';
$dbname = 'gisubizo_louange_iems';
$username = 'gisubizo';
$password = '222010931';

try {
    // Create a PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usageID = $_POST['usageID'];
        $buildingID = $_POST['buildingID'];
        $usageValue = $_POST['usagevalue'];
        $date = $_POST['timestamp'];

        // Prepare SQL statement to update data based on usage ID
        $sql = "UPDATE powerusage SET  usagevalue = ?, timestamp = ? WHERE usageID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usageValue, $date, $usageID]);

        // Redirect to the homepage or display a success message
        header("Location: home.php");
        exit();
    }
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>
