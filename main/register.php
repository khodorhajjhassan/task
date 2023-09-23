<?php
if(isset($_GET['msg']) && ($_GET['msg']=="emailfailed")){
    $errorMessage = "Email already exists!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
<title>Register</title>
</head>
<body>
<div class="center">
<h1>Register</h1>
<form action="process_register.php" method="POST" onsubmit="return validateForm()">
  <div class="txt_field">
    <input type="text"  value="<?php echo isset($_GET['name']) ? $_GET['name'] : ''; ?>" name="name">
    <span></span>
    <label for="">Full Name</label>
  </div>
  <div class="txt_field">
    <input type="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : ''; ?>"  name="email">
    <span></span>
    <label for="">Email address</label>
  </div>
  <div class="txt_field">
    <input type="password"  name="password" id="password">
    <span></span>   
    <label for="">Password</label>   
  </div>  
  <div class="flex">
    <select required name="gender" class="select" id="">
      <option value="" selected disabled>Gender</option>
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
    <select required name="blood_type" class="select" id="">
      <option value="" selected disabled>Blood type</option>
      <option value="A+">A+</option>
      <option value="B+">B+</option>
      <option value="A-">A-</option>
      <option value="B-">B-</option>
      <option value="O+">O+</option>
      <option value="O-">O-</option>
      <option value="AB+">AB+</option>
      <option value="AB-">AB-</option>
    </select>
  </div>
  <input type="submit" value="Register">
  <div class="signup_link">
    Not a member? <a href="../index.php">Login</a>
  </div>     
  <div style="height:30px;color:red;text-align:center">
    <span class="text-danger" id="err"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></span>
  </div>
</form>
<script>
function validateForm() {
  let password = document.getElementById("password").value;
  let email = document.querySelector("input[name='email']").value;
  let name = document.querySelector("input[name='name']").value;
  let errorDiv = document.getElementById("err");

  if (name.trim() === "") {
    errorDiv.innerHTML = "Name cannot be empty";
    return false;
  }
  if (email.trim() === "") {
    errorDiv.innerHTML = "Email cannot be empty";
    return false;
  }
  if (password.length < 6) {
    errorDiv.innerHTML = "Password must be at least 6 characters long";
    return false;
  }



  errorDiv.innerHTML = ""; 
  return true;
}

setTimeout(function() {
  document.getElementById("err").innerHTML = "";
}, 4000);
</script>
</div>
</body>
</html>
