<?php
// Include the DB connection file
include 'db.php';

$message = '';
$message_type = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assign_ticket'])) {
    $ticket_number = $_POST['ticket_number'];

    // Check if ticket number exists or is valid
    if (!empty($ticket_number)) {
        // Try assigning seat
        $assign_seat_query = "INSERT INTO seats (ticket_number, created_at) VALUES ('$ticket_number', NOW())";
        if ($conn->query($assign_seat_query) === TRUE) {
            $message = "Seat successfully allocated!";
            $message_type = 'success';
        } else {
            $message = "Error: " . $conn->error;
            $message_type = 'error';
        }
    } else {
        $message = "Please enter a valid ticket number.";
        $message_type = 'error';
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seat Assignment</title>
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

        .form-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        input[type="number"] {
            padding: 12px;
            font-size: 16px;
            width: 250px;
            border: 2px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        button {
            padding: 12px 30px;
            font-size: 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
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

        .back-link {
            display: block; /* Make it block-level to center */
            width: fit-content; /* Allow the width to fit the content */
            margin: 20px auto; /* Center horizontally */
            font-size: 18px;
            color: #007bff;
            text-decoration: none;
            padding: 8px 15px;
            border: 2px solid #007bff;
            border-radius: 4px;
            text-align: center;
        }

        .back-link:hover {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>

    <h1>Seat Assignment</h1>

    <!-- Display success or error message -->
    <?php if ($message != ''): ?>
        <div class="message <?= $message_type ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="form-container">
        <!-- Form to input ticket number -->
        <form method="POST" action="">
            <label for="ticket_number">Enter Ticket Number:</label><br>
            <input type="number" id="ticket_number" name="ticket_number" required>
            <button type="submit" name="assign_ticket">Assign Seat</button>
        </form>
    </div>

    <!-- Link to Seat Allocation Table -->
    <a href="seat_allocation.php" class="back-link">View Seat Allocation Table</a>

</body>
</html>
