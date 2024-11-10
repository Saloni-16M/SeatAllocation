<?php
// Include the DB connection file
include 'db.php';

// Fetch all seats for display
$seats_result = $conn->query("SELECT * FROM seats");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Allocation Table</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            color: #333;
            padding: 30px;
            margin: 0;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.5rem;
            color: #0056b3;
        }

        .table-container {
            max-width: 1000px;
            margin: 30px auto;
            background-color: white;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            font-size: 1.1rem;
        }

        td {
            background-color: #f9f9f9;
            font-size: 1rem;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            font-size: 18px;
            color: #007bff;
            text-decoration: none;
            padding: 8px 15px;
            border: 2px solid #007bff;
            border-radius: 4px;
            text-align: center;
            width: 100%;
        }

        .back-link:hover {
            background-color: #007bff;
            color: white;
        }

        .message {
            margin-top: 20px;
            padding: 10px;
            color: white;
            border-radius: 5px;
            text-align: center;
        }

        .message.success {
            background-color: #28a745;
        }

        .message.error {
            background-color: #dc3545;
        }
    </style>
</head>
<body>

    <h1>Seat Allocation Table</h1>

    <!-- Link to go back to the assignment page -->
    <a href="index.php" class="back-link">Back to Seat Assignment</a>

    <!-- Seat Allocation Table -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Seat Number</th>
                    <th>Ticket Number</th>
                    <th>Assigned Timestamp</th>
                    <th>Removed Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display seat allocation data
                while ($row = $seats_result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['seat_number']}</td>";
                    echo "<td>{$row['ticket_number']}</td>";
                    echo "<td>{$row['created_at']}</td>";
                    echo "<td>{$row['removed_at']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>
