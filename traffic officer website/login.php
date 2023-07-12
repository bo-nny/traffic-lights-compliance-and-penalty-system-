<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $officerid = $_POST['officerid'];
    $password = $_POST['password'];

    $conn = mysqli_connect('localhost', 'root', 'password', 'tlcps');

    // Check the connection
    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }
        // $sql = $conn->prepare("SELECT * FROM trafficofficer WHERE officerid = ? AND password = ?");
        $query = "SELECT * FROM trafficofficer WHERE officerid = ? AND password = ?";
        // $stmt = mysqli_prepare($conn, $query);

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $officerid, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // Check officer's login details
        if (mysqli_num_rows($result) > 0) {
            // Successful login, redirect to dashboard or perform other actions
            header('Location: dashboard.php');
            exit;
        } else {
            // $errorMessage = 'Invalid officer ID or password. Please try again.';
            header('Location: index.php');
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
}
    ?>
