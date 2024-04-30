 <?php  
require_once 'databaseconnection.php';
session_start();


 if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve data from POST request
        $name = $_POST['name'];
        $address = $_POST['address'];
        $owner = $_POST['owner'];

        // Prepare SQL statement
        $sql = "INSERT INTO building (name, address, owner) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Execute the statement with the provided data
        if ($stmt->execute([$name, $address, $owner])) {
            // If successful, output a JavaScript alert and then redirect
            echo "<script>alert('Query OK. Building added successfully.'); window.location.href='building.html';</script>";
        } else {
            echo "<script>alert('Failed to add building.'); window.location.href='building.html';</script>";
        }
    }
$conn->close();     
?>