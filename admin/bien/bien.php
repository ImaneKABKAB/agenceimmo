<?php
session_start();
include_once("../../BDtest.php");
if($_SESSION){
    $tab= getBiens();
    if(isset($_POST['export'])) exportCSV("bien.csv",$tab);
    if(isset($_GET['id'])){
        deleteBien($_GET['id']);
        header("location:bien.php");
    }
    if(isset($_GET['id1'])){
        $fup=fopen("exportImage.xls","w");
        fwrite($fup,"<table><tr><th>image</th></tr>");
        for($i=0;$i<count($tab);$i++){
        fwrite($fup,"<tr style='height:120px;'><td><img src='http://localhost/agence immo/admin/bien/".$tab[$i]['path']."' height='110' width='130'></td></tr>");
        }
        fwrite($fup,"</table>");
        fclose($fup);
     readfile("exportImage.xls");
     exit; 
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
</nav><br><br><br>
    <table class="table table-striped table-bordered" id="tab">
        <thead>
            <tr>
                <th>Ordre</th>
                <th>Type</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Superficie</th>
                <th>Nbre_chambre</th>
                <th>Prix mensuel</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $j=0;
            for($i=0;$i<count($tab);$i++){
                echo "<tr>";
                echo "<td>".++$j."</td>";
                echo "<td>".$tab[$i]['type']."</td>";
                echo "<td>".$tab[$i]['adresse']."</td>";
                echo "<td>".$tab[$i]['ville']."</td>";
                echo "<td>".$tab[$i]['superficie']."</td>";
                echo "<td>".$tab[$i]['nbr_chambre']."</td>";
                echo "<td>".$tab[$i]['prix_men']."</td>";
                echo "<td><img src='".$tab[$i]['path']."' height='90' width='90'></td>";
                echo "<td><a href='bien.php?id=".$tab[$i]['adresse']."'><img src='https://toppng.com/uploads/preview/free-recycle-bin-icon-vector-recycle-bin-icon-115534132079jvhnualpn.png' alt='trash can' height='10' width='10'></a></td>";
                echo "</tr>";
            }
           ?>
        </tbody>
    </table><br>
        <br>
    <a class="cu" href="cuB.php"><img src="../../icone-image/add.png" alt="add icone" height="25" width="25"><img src="../../icone-image/refresh.png" alt="update icone" height="25" width="25" ></a>
    <br>
    <form method="post" action="bien.php">
        <button type="submit" name="export">Exporter la liste des biens</button>
        </form><br>
    <a href="bien.php?id1=image" download='image.xls'>Exporter les images des biens</a>   
</body>
</html>