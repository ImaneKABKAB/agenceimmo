<?php
session_start();
include_once("../../BDtest.php");
if($_SESSION){
    $tab= getLocations();
    if(isset($_POST['bt'])){
        $file=$_FILES['csvl']['tmp_name'];
        $type=$_FILES['csvl']['type'];
          if(strpos($type,"/csv")){
              $fp=fopen($file,'r');
              $i=0;
              while($str=fgets($fp)){
                  if($i!=0){
                      $tab=explode(",",$str);
                     if(addupdateL($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5],$tab[6])){
                     header("location:location.php");
                     }
                  }
                  else {$i++;}
              }
              fclose($fup);
          }
          else $msg="enter a csv file";
    }
    if(isset($_POST['exp'])) exportCSV("location.csv",$tab);
    if(isset($_GET['id'])){
        deleteLocation($_GET['id']);
        header("location:location.php");
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
</nav><br><br><br>
    <table class="table table-striped table-bordered" id="tab">
        <thead>
            <tr>
                <th>Ordre</th>
                <th>CNI</th>
                <th>Adresse_bien</th>
                <th>Date</th>
                <th>De</th>
                <th>A</th>
                <th>Durée en mois</th>
                <th>Prix </th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $j=0;
            for($i=0;$i<count($tab);$i++){
                echo "<tr>";
                echo "<td>".++$j."</td>";
                echo "<td>".$tab[$i]['CNI']."</td>";
                echo "<td>".$tab[$i]['adresse']."</td>";
                echo "<td>".$tab[$i]['date']."</td>";
                echo "<td>".$tab[$i]['de']."</td>";
                echo "<td>".$tab[$i]['a']."</td>";
                echo "<td>".$tab[$i]['duree']."</td>";
                echo "<td>".$tab[$i]['prix']."</td>";
                echo "<td><a href='location.php?id=".$tab[$i]['CNI']."'><img src='https://toppng.com/uploads/preview/free-recycle-bin-icon-vector-recycle-bin-icon-115534132079jvhnualpn.png' alt='trash can' height='10' width='10'></a></td>";
                echo "</tr>";
            }
           ?>
        </tbody>
    </table><br>
    <a  class="cu" href="cuL.php"><img src="../../icone-image/add.png" alt="add icone" height="25" width="25"><img src="../../icone-image/refresh.png" alt="update icone" height="25" width="25" ></a>
    <form method="post" action="location.php" enctype="multipart/form-data">
    <input type="file" name="csvl">
    <input type="submit" name="bt" value="Importer la liste des locations">
        </form><br>
    <form method="post" action="location.php">
        <button type="submit" name="exp">Exporter la liste des locations</button>
        </form>
</body>
</html>