<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php include_once('./dashboard.php') ;

$host = $_SERVER['HTTP_HOST'];
$jsonData = file_get_contents("http://$host/task/api/admin/stats.php");
$data = json_decode($jsonData, true);


if($data){
    
    
    foreach ($data as $row) {
    ?>
<div class=" mt-5 container w-75" m-auto>
    <div class="row d-flex">

            <div class="card col-md-5 m-2">
                <div class="card-body bus">
                    <h5 class="card-title text-center mb-4">Number of users:</h5>
                    <div class=" d-flex justify-content-around align-items-center mt-4 mb-3">

                    <i class="fa-solid fa-users text-success fa-2xl"></i>
                    <h5 class="card-text  "><?php echo $row['total_users']  ?></h5>
                     </div>
            
            
                    </div>
                    </div>
                    <div class="card col-md-5 m-2">
                <div class="card-body bus">
                    <h5 class="card-title text-center mb-4">Number of users apply:</h5>
                    <div class=" d-flex justify-content-around align-items-center mt-4 mb-3">

                    <i class="fa-solid fa-user text-danger fa-2xl"></i>
                    <h5 class="card-text  "><?php echo $row['users_not_approved']  ?></h5>
                     </div>
            
            
                    </div>
                    </div>
                    
                    
                    </div>
                     <div class="row ">

            <div class="card col-md-5 m-2">
                <div class="card-body bus">
                    <h5 class="card-title text-center mb-4">Number of  bachelor degree:</h5>
                    <div class=" d-flex justify-content-around align-items-center mt-4 mb-3">

                    <i class="fa-solid fa-certificate text-primary fa-2xl"></i>
                    <h5 class="card-text  "><?php echo $row['users_with_bachelor']  ?></h5>
                     </div>
            
            
                    </div>
                    </div>
                    <div class="card col-md-5 m-2">
                <div class="card-body bus">
                    <h5 class="card-title text-center mb-4">Number of  Master degree:</h5>
                    <div class=" d-flex justify-content-around align-items-center mt-4 mb-3">

                    <i class="fa-solid fa-file text-warning fa-2xl"></i>
                    <h5 class="card-text  "><?php echo $row['users_with_Master']  ?></h5>
                     </div>
            
            
                    </div>
                    </div>
                    <div class="card col-md-5 m-2">
                <div class="card-body bus">
                    <h5 class="card-title text-center mb-4">Number of  Phd :</h5>
                    <div class=" d-flex justify-content-around align-items-center mt-4 mb-3">

                    <i class="fa-solid fa-building-columns  fa-2xl"></i>
                    <h5 class="card-text  "><?php echo $row['users_with_Phd']  ?></h5>
                     </div>
            
            
                    </div>
                    </div>
                    
                    
                    </div>
                    
        </div>
        <?php }
}
?>
</body>
</html>