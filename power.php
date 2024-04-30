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

        // Prepare SQL statement to retrieve data based on usage ID
        $sql = "SELECT buildingID, timestamp, usagevalue FROM powerusage WHERE usageID= ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$usageID]);

        // Check if a matching record was found
        if ($stmt->rowCount() > 0) {
            // Fetch the data
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $buildingid = $row['buildingID'];
            $usageValue = $row['usagevalue'];
            $date = $row['timestamp'];
                }
    }
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Power Usage Details</title>
    <style type="text/css">
body{

 background-image: url(assets/img/img1.jpg);
 background-size: cover;
 background-repeat: no-repeat;
 }
 .container {
 align-items: center;
 justify-content: center;
 max-width: 400px;
 
 border: 1px solid #ccc;
 border-radius: 5px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    color: whitesmoke;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    margin-top: 5px;
}

button[type="submit"] {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

    </style>
</head>
<body>
    <div class="container">
        <form action="updatepower.php" method="POST">
            <div class="form-group">
                <label for="usageID">Usage ID:</label>
                <input type="text" id="usageID" name="usageID" value="<?php echo htmlspecialchars($usageID); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="buildingID">building ID:</label>
                <input type="text" id="buildingID" name="buildingID" value="<?php echo htmlspecialchars($buildingid); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="usageValue">Usage Value:</label>
                <input type="text" id="usageValue" name="usageValue" value="<?php echo htmlspecialchars($usageValue); ?>" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="text" id="date" name="date" value="<?php echo htmlspecialchars($date); ?>" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
</body>
</html>