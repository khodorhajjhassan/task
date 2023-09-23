
<?php
require('../../config.php')
?>
<?php
$sql = "SELECT * FROM user_statistics ";
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