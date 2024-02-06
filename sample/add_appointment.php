<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        #container {
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 80%;
            max-width: 600px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-bottom: 8px;
        }

        input, #selectOption {
            padding: 10px;
            margin-bottom: 16px;
            width: 100%;
            box-sizing: border-box;
        }

        .button-container {
            text-align: center;
        }

        .update-button {
            background-color: #2196f3;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
        }
        .th{
            color:red;
        }
    </style>
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Add Appointment</h2>

    <?php
include 'includes/db_connection.php';

    try {
        $conn = connectDB();

        if ($conn && isset($_POST['edit_sched_id'])) {
            $schedID = $_POST['edit_sched_id'];
            $sql = "SELECT sched_id, sched_date, schedule FROM sched WHERE sched_id = :pid";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':pid', $schedID);
            $stmt->execute();

            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($userData) {
    ?>
                <form action="includes/insert_appoint.php" method="post">
                    <input type="hidden" name="pid" value="<?php echo $userData['sched_id']; ?>">
                    <label for="selectOption">Select a User:</label>
                    <select name="selectOption" id="selectOption">
                        <?php
                           try {

                                $stmt = $conn->query("SELECT * FROM users");   
                                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            } catch (PDOException $e) {
                                die("Query failed: " . $e->getMessage());
                            }
                            
                        foreach ($result as $row) {
                            echo "<option value='{$row['user_id']}'>{$row['name']}</option>";
                        }
                        ?>
                    </select>
                    <label for="dates">Date:</label>
                    <input type="date" name="date" id="sched_date" value="<?php echo $userData['sched_date']; ?>" readonly>

                    <label for="schedules">Schedule:</label>
                    <input type="time" name="time" id="schedule" value="<?php echo $userData['schedule']; ?>" readonly>

                    

                    <div class="button-container">
                        <button type="submit" class="update-button">ADD</button>
                    </div>
                </form>
    <?php
            } else {
                echo "<p>User not found.</p>";
            }
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        if ($conn) {
            $conn = null;
        }
    }
    ?>
</div>

</body>
</html>
