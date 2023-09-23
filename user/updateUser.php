<?php
include_once('../config.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['id'];
    $name = $_POST['name'];
    $blood_type = $_POST['blood_type'];
    $gender = $_POST['gender'];

    $query = 'UPDATE users SET name=?, blood_type=?, gender=? WHERE user_id=?';
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'sssi', $name, $blood_type, $gender, $user_id);
        if (mysqli_stmt_execute($stmt)) {
            echo "Success: User information updated.";
            header("location:user.php?msg=update");
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}

mysqli_close($conn);
?>
