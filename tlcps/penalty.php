<?php
//require __DIR__ . '/vendor';

// Your Account SID and Auth Token from console.twilio.com
$sid = "AC7789c750477c3947220d11a196e99c05";
$token = "940a8098a6cac93fa6b1d36825807dae";
$client = new Twilio\Rest\Client($sid, $token);

// Connect to your database (replace with your database credentials)
// $servername = "localhost";
// $username = "your_username";
// $password = "your_password";
// $dbname = "your_database";

// Create a database connection
$conn = new mysqli($localhost, $root, $root, $tlcps);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve the latest number from the database
$sql = "SELECT contact FROM captured ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the latest number from the query result
    $row = $result->fetch_assoc();
    $recipientNumber = $row['contact'];

    // Use the latest number as the sender number for the SMS
    $message = $client->messages->create(
        $recipientNumber,
        [
            'from' => '+14066455856',
            'body' => "YOU HAVE BEEN FINED Ugs 100,000 FOR VIOLATING THE TRAFFIC LIGHTS AT WANDEGEYA"
        ]
    );

    echo "SMS sent successfully!";
} else {
    echo "No numbers found in the database.";
}

// Close the database connection
$conn->close();
?>
