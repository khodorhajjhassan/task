<?php
require('../../config.php');

$sql = "SELECT * FROM users where is_admin=0 And is_approved=1";
$result = $conn->query($sql);

$users = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($users);
?>