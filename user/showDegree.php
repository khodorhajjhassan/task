<?php
include_once('../config.php');

session_start();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_SESSION['id']) && ($_SESSION['is_admin'] == 0)) {
        $user_id = $_SESSION['id'];

        $query = 'SELECT * FROM usercertificates WHERE user_id=?';
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, 'i', $user_id);
            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
                echo '<div class="container mt-4">';
                echo '<div class="row">';
                if (mysqli_num_rows($result) === 0) {
                    echo '<h4 class="text-center text-warning">No degree, please add a degree</h4>';
                } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col-md-6">';
                        echo '<div class="card mb-3">';
                        echo '<div class="card-body bg-warning text-white">';
                        echo '<p class="card-text fs-4">Degree Name: ' . $row['degree_name'] . '</p>';

                        echo '<button class="btn btn-danger m-2" onclick="removeCertificate(' . $row['userCertificates_id'] . ')">Remove</button>';

                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
                echo '</div>';
                echo '</div>';
            } else {
                echo "Error: " . mysqli_stmt_error($stmt);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    } else {
        header('location:../index.php?msg=please_login');
        mysqli_close($conn);
    }
}
?>
