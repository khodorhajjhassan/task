<?php
include_once('../config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['certificateId'])) {
    $certificateId = $_POST['certificateId'];

    $query = 'DELETE FROM usercertificates WHERE userCertificates_id = ?';
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'i', $certificateId);
        if (mysqli_stmt_execute($stmt)) {
            echo $certificateId;
        } else {
            echo "Error deleting certificate: " . mysqli_stmt_error($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        http_response_code(500); 
        echo "Error preparing statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    // Invalid request
    http_response_code(400); 
    echo "Invalid request.";
}
?>
