<?php

include 'db_connection.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $pid = $_POST["sched_id"];
    $pname = $_POST["sched_date"];
    $pstock = $_POST["schedule"];

    // Perform database update
    try {

        $conn = connectDB();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE sched SET sched_date = :pname, schedule = :pstock WHERE sched_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $pid);
        $stmt->bindParam(':pname', $pname);
        $stmt->bindParam(':pstock', $pstock);

        $stmt->execute();

        // Redirect to the page displaying the updated user or any other page
        header("Location: ../schedule_table.php?error=success");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        $conn = null;
    }
}
?>
