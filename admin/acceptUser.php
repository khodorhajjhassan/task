<?php
require_once '../config.php';

if (isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];

    $sql = "UPDATE users SET is_approved=1 where users_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userId);

    $response = array();

    if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'User accepet successfuly.';
    } else {
        $response['success'] = false;
    }

    $stmt->close();
    $conn->close();
} else {
    $response = array('success' => false);
}
?>

