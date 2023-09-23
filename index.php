<?php
if(isset($_GET['msg']) && ($_GET['msg']=="failed")){
    $errorMessage = "Invalid Email or Password!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="main/style.css">
<title>Log In</title>
<style>
  .text-danger {
    color: red;
  }
</style>
</head>
<body>
<div class="center">
<h1>Login</h1>
<form action="main/processLogin.php" method="POST" onsubmit="return validateForm()">
  <div class="txt_field">
    <input type="email" value="<?php echo isset($_GET['email']) ? $_GET['email'] :"" ?>"  name="email">
    <span></span>
    <label for="">Email address</label>
  </div>
  <div class="txt_field">
    <input type="password"  name="password" id="password">
    <span></span>   
    <label for="">Password</label>   
  </div>  
  <input type="submit" value="Login">
  <div class="signup_link">
    Not a member? <a href="main/register.php">Register</a>
  </div>
  <div style="height:30px;color:red;text-align:center">
    <span class="text-danger" id="err"><?php echo isset($errorMessage) ? $errorMessage : ''; ?></span>
  </div>     
</form>
</div>

<script>
function validateForm() {
  let password = document.getElementById("password").value;
  let email = document.querySelector("input[name='email']").value;
  let errorDiv = document.getElementById("err");

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
</body>
</html>
