<?php
session_start();
include_once('../BDtest.php');
if($_POST){
    $pass=sha1(htmlspecialchars($_POST['pass']));
    $user=htmlspecialchars($_POST['user']);
    $_SESSION['pass']=$pass;
    $_SESSION['user']=$user;
   $sol= checkAdmin($user,$pass);
   if($sol==true) 
   header("location:admin.php");
   else 
  $prob="Try again !";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
</head>
<body>
<h1 style="text-align: center;">AUTHENTIFIEZ-VOUS</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
    <form method="post" action="authentification.php">
    <div class="form-group">
        <input type="text" name="user" placeholder="login" required>
</div>
<div class="form-group">
        <input type="password" name="pass" placeholder="password" required>
</div>
        <input type="submit" class="btn btn-default" value="LOGIN"><br>
    </form>
    <label><?php if(isset($prob)) echo "<h3 style='text-align: center;' class='alert alert-info'>".$prob."</h3>" ?></label>
</div>
</div>
</div>
</body>
</html>