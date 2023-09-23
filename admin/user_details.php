<?php
include_once('../config.php');

if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];

    $sql = "select * from users WHERE user_id = $userId";
    $result = mysqli_query($conn, $sql) or die("Selecting user profile failed");
    $row1 = mysqli_fetch_array($result);
    $query = "SELECT c.certificates_name, uc.degree_name 
              FROM usercertificates uc
              JOIN certificates c ON uc.certificate_id = c.certificates_id 
              WHERE uc.user_id = $userId";
    
    $result = mysqli_query($conn, $query) or die("Selecting user certificates failed");
    
    $certificates = array();

    while ($row2 = mysqli_fetch_array($result)) {
        $certificates[] = array(
            'certificates_name' => $row2['certificates_name'],
            'degree_name' => $row2['degree_name']
        );
    }
} else {
    echo "User ID not provided.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
</head>
<body>
<?php include_once('./dashboard.php') ?>
<div class="container p-5 w-75 border mt-5 bg-light box-shadow rounded">
<h2>Information</h2>

    <div class="row mt-5">
        <div class="col-md-3 col-sm-6 ">
            <h5 class="text-primary ">User Name:</h5>
            <p><?php echo $row1['name']?></p>
        </div>
        <div class="col-md-3 col-sm-6 ">
            <h5 class="text-primary ">email:</h5>
            <p><?php echo $row1['email']?></p>
        </div>
        <div class="col-md-3 col-sm-6 ">
            <h5 class="text-primary ">blood_type:</h5>
            <p><?php echo $row1['blood_type']?></p>
        </div>
        <div class="col-md-3 col-sm-6 ">
            <h5 class="text-primary ">gender:</h5>
            <p><?php echo $row1['gender']?></p>
        </div>
    </div>
    <hr>
    <h2>Certeficates</h2>
    <div class="mb-5"> 
    <ul>
        <?php
        foreach ($certificates as $certificate) {
            echo "<li class='fs-4'> " . $certificate['certificates_name'] . " Degree: " . $certificate['degree_name'] . "</li>";
        }
        ?>
    </ul>
    </div>
</div>
   
</body>
</html>
