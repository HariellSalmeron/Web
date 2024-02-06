<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Products</title>
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

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: white;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .add-button {
            background-color: #4caf50;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .edit-button {
            background-color: #2196f3;
            color: white;
            border: none;
            padding: 6px 21px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            cursor: pointer;
            border-radius: 4px;
        }
        .appoint-button {
            background-color: green;
            color: white;
            border: none;
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">SCHEDULE</h2>

<?php
include 'includes/db_connection.php';

try {
    $conn = connectDB();

    if ($conn) {
        $sql = "SELECT sched_id, sched_date, schedule FROM sched";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>
                <tr>
                    <th>Schedule ID</th>
                    <th>Date</th>
                    <th>Schedule</th>
                    <th>Action</th>
                    <th>Action</th>
                </tr>";
        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['sched_id']}</td>
                    <td>{$row['sched_date']}</td>
                    <td>{$row['schedule']}</td>
                    <td>
                    <form action='edit_schedule.php' method='post'>
                        <input type='hidden' name='edit_sched_id' value='{$row['sched_id']}'>
                        <button type='submit' class='edit-button'>Edit</button>
                    </form>
                    </td>
                    <td>
                    <form action='add_appointment.php' method='post'>
                        <input type='hidden' name='edit_sched_id' value='{$row['sched_id']}'>
                        <button type='submit' class='appoint-button'>Appoint</button>
                    </form>
                    </td>
                
                </tr>";
        }
        echo "</table>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
} finally {
    if ($conn) {
        $conn = null;
    }
}
?>

<div class="button-container">
    <a href="add_schedule.php" class="add-button">Add Schedule</a>
</div>
<div class="button-container">
        <a href="user_table.php" class="add-button">Back to Patient List</a>
    </div>

</div>

</body>
</html>
