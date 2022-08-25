<?php
include_once("../BDtest.php");
session_start();
if($_SESSION){
    if(isset($_POST['but'])){
        $a=htmlspecialchars($_POST['prenom']);
        $b=htmlspecialchars($_POST['nom']);
        $c=htmlspecialchars($_POST['login']);
        $d=htmlspecialchars($_POST['pass']);
        if(addupdateAD($a,$b,$c,$d)) $msg="admin added/updated successfuly";
        else $msg="try again";
    }
}
else header("location:authentification.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
</head>
<body>
    <nav>
    <div class="logo">
        <p>Agence IMMO</p>
</div>
<ul>
        <li><a href="admin.php">DASHBORD</a></li>
        <li><a href="client/client.php">CLIENT</a></li>
        <li><a href="bien/bien.php">BIEN</a></li>
        <li><a href="location/location.php">LOCATION</a></li>
         <li><h3><?php 
         $sol= getAdmin($_SESSION['pass']);
         echo $sol['prenom']; ?></h3></li>
         <li><a href="logout.php">Logout</a></li>
</ul>
</nav><br><br><br><br><br><br>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
    <form action="cu.php" method="post">
        <div class="form-group">
        <label for="pr">PRENOM</label>
        <input type="text" name="prenom" id="pr" required>
</div>
<div class="form-group">
        <label for="nm">NOM</label>
        <input type="text" name="nom" id="nm" required>
</div>
<div class="form-group">
        <label for="lg">LOGIN</label>
        <input type="text" name="login" id="lg" required>
</div>
<div class="form-group">
        <label for="ps">PASSWORD</label>
        <input type="password" name="pass" id="ps" required>
</div>
        <input type="submit" name="but" class="btn btn-default" value="Submit">
    </form>
  <?php if(isset($msg)) echo "<h3 style='text-align: center;' class='alert alert-info'>".$msg."</h3>" ?>
</div>
</div>
</div>
</body>
</html>