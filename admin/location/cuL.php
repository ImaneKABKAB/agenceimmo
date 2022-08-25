<?php
session_start();
include_once("../../BDtest.php");
if($_SESSION){
if(isset($_POST['butt'])){
    $a=htmlspecialchars($_POST['code']);
    $b=htmlspecialchars($_POST['adr']);
    $c=htmlspecialchars($_POST['date']);
    $d=htmlspecialchars($_POST['d1']);
    $e=htmlspecialchars($_POST['d2']);
    $date= substr($c,0,10)." ".substr($c,11,5);
    $duree= (strtotime($e)-strtotime($d))/(3600*24*30);
    $tab= getPrix($b);
    $prix= ($tab['prix_men'])*$duree;
       if(addupdateL($a,$b,$date,$d,$e,$duree,$prix)) header("location:location.php");
        else $msg="try again";
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
        <li><a href="../client/client.php">CLIENT</a></li>
        <li><a href="../bien/bien.php">BIEN</a></li>
        <li><a href="location.php">LOCATION</a></li>
         <li><h3><?php 
         $sol= getAdmin($_SESSION['pass']);
         echo $sol['prenom']; ?></h3></li>
         <li><a href="../logout.php">Logout</a></li>
</ul>
</nav><br><br><br><br><br><br>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
         <form method="post" action="cul.php" >
         <div class="form-group">
             <label for="id">CNI</label>
             <select  name="code" id="id" required>
                 <?php
                 $var=getClients();
                 for($i=0;$i<count($var);$i++){
                     echo "<option value='".$var[$i]['CNI']."'>".$var[$i]['CNI']."</option>";
                 }
                 ?>
             </select>
                </div>
                <div class="form-group">
             <label for="ad">ADRESSE</label>
             <select name="adr" id="ad" required>
                 <?php
                 $tableau=getBiens();
                 for($i=0;$i<count($tableau);$i++){
                     echo "<option value='".$tableau[$i]['adresse']."'>".$tableau[$i]['adresse']."</option>";
                 }
                 ?>
                 </select>
                </div>
                <div class="form-group">
             <label for="da">DATE</label>
             <input type="datetime-local" name="date" id="da" required>
                </div>
                <div class="form-group">
             <label>DUREE :</label>
             <label for="du">DE</label>
             <input type="date" name="d1" id="du" required>
                </div>
                <div class="form-group">
             <label for="d">A</label>
             <input type="date" name="d2" id="d" required>
                </div>
             <input type="submit" name="butt" class="btn btn-default" value="Submit">
         </form>
        <?php if(isset($msg)) echo "<h3 style='text-align: center;' class='alert alert-info'>".$msg."</h3>";
         else echo "if the location does not figure in the locations table ,then the property is already token,delete it from the table if you want to add/update the location ! " ;?>
</div>
                </div>
                </div>
</body>
</html>