<?php
session_start();
include_once("../../BDtest.php");
if($_SESSION){
    if(isset($_POST['cni'])&&isset($_POST['nom'])&&isset($_POST['adresse'])&&isset($_POST['genre'])&&isset($_POST['mail'])&&isset($_POST['tel'])){
    $a=htmlspecialchars($_POST['cni']);
    $b=htmlspecialchars($_POST['nom']);
    $c=htmlspecialchars($_POST['adresse']);
    $d=htmlspecialchars($_POST['genre']);
    $e=htmlspecialchars($_POST['mail']);
    $f=htmlspecialchars($_POST['tel']);
    if(addupdateCl($$a,$b,$c,$d,$e,$f)) {
       $msg="client added/updated successfuly !";
        } 
    else $msg="try again !"; 
    }
    }

else header("location:../authentification.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
</head>
<body>
<nav>
    <div class="logo">
        <p>Agence IMMO</p>
</div>
<ul>
        <li><a href="../admin.php">DASHBORD</a></li>
        <li><a href="client.php">CLIENT</a></li>
        <li><a href="../bien/bien.php">BIEN</a></li>
        <li><a href="../location/location.php">LOCATION</a></li>
         <li><h3><?php 
         $sol= getAdmin($_SESSION['pass']);
         echo $sol['prenom']; ?></h3></li>
         <li><a href="../logout.php">Logout</a></li>
</ul>
</nav><br><br><br><br><br>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
    <form method="post" action="add-update.php">
    <div class="form-group">
        <label for="cn">CNI</label>
        <input type="text" name="cni" id="cn" required>
</div>
<div class="form-group">
        <label for="nm">NOM</label>
        <input type="text" name="nom" id="nm" required>
</div>
<div class="form-group">
        <label for="a">ADRESSE</label>
        <input type="text" name="adresse" id="a" required>
</div>
<div class="form-group">
        <label for="gnd">GENRE</label>
        <select name="genre" id="gnd" required>
            <option value="femme">femme</option>
            <option value="homme">homme</option>
        </select>
</div>
<div class="form-group">
        <label for="mail">E-MAIL</label>
        <input type="email" name="mail" id="mail" required>
</div>
<div class="form-group">
        <label for="tel">TELEPHONE</label>
        <input type="tel" name="tel" id="tel"  required>
</div>
        <input type="submit" class="btn btn-default" value="Submit">
    </form>
   <?php if(isset($msg)) echo "<h3 style='text-align: center;' class='alert alert-info'>".$msg."</h3>"?>
</div>
</div>
</div>
</body>
</html>