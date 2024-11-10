<?php
// Check if userId is provided in the POST request
if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    
    // Establish database connection
    $conn = new mysqli('localhost', 'root', '', 'seating_db');
    
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    // Query to find an available seat
    $sql = "SELECT * FROM seats WHERE user_id IS NULL LIMIT 1"; // Find an available seat

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // If a seat is available, assign it to the user
        $seat = $result->fetch_assoc();
        $seatId = $seat['id'];
        
        $updateSql = "UPDATE seats SET user_id = '$userId' WHERE id = $seatId";

        if ($conn->query($updateSql) === TRUE) {
            // Success: Redirect to a confirmation page or show success message
            header("Location: seat_booked_success.php");
            exit();
        } else {
            echo "Error booking the seat: " . $conn->error;
        }
    } else {
        echo "No available seat found.";
    }

    // Close the database connection
    $conn->close();
} else {
    echo "Please enter a valid user ID.";
}
?>
