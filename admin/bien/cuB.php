<?php
session_start();
include_once("../../BDtest.php");
if($_SESSION){
if(isset($_POST['btn'])){
    $a=htmlspecialchars($_POST['type']);
    $b=htmlspecialchars($_POST['adresse']);
    $c=htmlspecialchars($_POST['ville']);
    $d=htmlspecialchars($_POST['super']);
    $e=htmlspecialchars($_POST['cham']);
    $f=htmlspecialchars($_POST['prix']);
    $file=$_FILES['img']['tmp_name'];
    $name=$_FILES['img']['name'];
    $path="image/".$name;
   move_uploaded_file($file,$path);
    if(addupdateBn($a,$b,$c,$d,$e,$f,$path)) {
      $msg="bien added/updated successfuly";
    }
    else {
      $msg="try again";
}
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
        <li><a href="bien.php">BIEN</a></li>
        <li><a href="../location/location.php">LOCATION</a></li>
         <li><h3><?php 
         $sol= getAdmin($_SESSION['pass']);
         echo $sol['prenom']; ?></h3></li>
         <li><a href="../logout.php">Logout</a></li>
</ul>
</nav><br><br><br><br<<br>
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
         <form method="post" action="cuB.php" enctype="multipart/form-data">
         <div class="form-group">
             <label for="t">TYPE</label>
             <input list="bien" name="type" id="t" required>
              <datalist id="bien">
                <option value="Appartement">
                <option value="Commercial">
                <option value="Maison">
                <option value="Studio">
                <option value="Villa">
                <option value="Mini-Villa"> 
                </datalist>
</div>
<div class="form-group">
                <label for="adr">ADRESSE</label>
                <input list="adresse" name="adresse" id="adr" required>
                <datalist id="adresse">
             <?php
                  $tab=getBiens();
                for($i=0;$i<count($tab);$i++){
                  echo  "<option value='".$tab[$i]['adresse']."'>";
                 }
                 ?>
                 </datalist>
                </div>
                <div class="form-group">
                <label for="v">VILLE</label>
                <input list="vil" name="ville" id="v" required>
                <datalist id="vil">
                  <option value="Rabat">
                  <option value="Casablanca">
                  <option value="Meknes">
                  <option value="Oujda">
                  <option value="Bouznika">
                  <option value="Skhirat">
                  <option value="Marrakech">
                  <option value="Safi">
                  </datalist>
                </div>
                <div class="form-group">
                <label for="sup">SUPERFICIE</label>
                <input list="super" name="super" id="sup" required>
                <datalist id="super">
                <?php
                  $tab=getBiens();
                for($i=0;$i<count($tab);$i++){
                  echo  "<option value='".$tab[$i]['superficie']."'>";
                 }
                 ?>
                 </datalist>
                </div>
                <div class="form-group">
                <label for="nb">NB_CHAMBRE</label>
                <input list="nombre" name="cham" id="nb" required>
                <datalist id="nombre">
                <?php
                  $tab=getBiens();
                for($i=0;$i<count($tab);$i++){
                  echo  "<option value='".$tab[$i]['nbr_chambre']."'>";
                 }
                 ?>  
                </datalist>
                </div>
                <div class="form-group">
                <label for="pr">PRIX_MENSUEL</label>
                <input list="prix" name="prix" id="pr" required>
                <datalist id="prix">
                <?php
                  $tab=getBiens();
                for($i=0;$i<count($tab);$i++){
                  echo  "<option value='".$tab[$i]['prix_men']."'>";
                 }
                 ?>  
                </datalist>
                </div>
                <div class="form-group"> 
                <input type="file" name="img">
                </div>
                <input type="submit" name="btn" class="btn btn-default" value="Submit">
         </form>
      <?php if(isset($msg)) echo "<h3 style='text-align: center;' class='alert alert-info'>".$msg."</h3>"; ?>
                </div>
                </div>
                </div>
</body>
</html>