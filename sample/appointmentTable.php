<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retrieve Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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
            padding: 5px;
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
            padding: 12px;
            text-align: center;
            
        }

        th {
            background-color: red;
            color: black;
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
            padding: 6px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 12px;
            cursor: pointer;
            border-radius: 4px;
        }
        .butonRow{
            display: flex;
            justify-content: space-evenly;
        }
    </style>
</head>
<body>

<div id="container">
    <h2 style="text-align: center;">Appointment Table</h2>

    <?php
include 'includes/db_connection.php';

try {
    $conn = connectDB();

    if ($conn) {
        $sql = "SELECT
                    appoint.appointment_id,
                    
                    users.name,
                    
                    sched.sched_date,
                    sched.schedule
                FROM
                    appoint
                INNER JOIN users ON appoint.user_id = users.user_id
                INNER JOIN sched ON appoint.sched_id = sched.sched_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table class='table table-striped'>
                <tr class='table-green'>
                    <th>Appointment ID</th>
                    <th>Patient Name</th>
                    <th>Schedule Date</th>
                    <th>Schedule </th>
                </tr>";

        foreach ($result as $row) {
            echo "<tr>
                    <td>{$row['appointment_id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['sched_date']}</td>
                    <td>{$row['schedule']}</td>
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
    <a href="schedule_table.php" class="add-button">Add Appointments</a>
</div>

</div>

</body>
</html>