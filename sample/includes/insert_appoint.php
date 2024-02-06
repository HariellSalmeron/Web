<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_POST['selectOption'];
    $sched_Id = $_POST['pid'];
    

    try {
        // Use the function to get a PDO connection
        $conn = connectDB();

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO appoint(user_id, sched_id) VALUES (:usid, :scid)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usid', $userId);
        $stmt->bindParam(':scid', $sched_Id);  
        $stmt->execute();

        // Redirect back to the user data page after successful insertion
        header("Location: ../appointmentTable.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Always close the connection
        if ($conn) {
            $conn = null;
        }
    }
}
?>