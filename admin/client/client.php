<?php
session_start();
include_once("../../BDtest.php");
if($_SESSION){
    $tab=getClients();
    if(isset($_POST['btn'])){
        $file=$_FILES['csv']['tmp_name'];
        $type=$_FILES['csv']['type'];
          if(strpos($type,"/csv")){
              $fp=fopen($file,'r');
              $i=0;
              while($str=fgets($fp)){
                  if($i!=0){
                      $tab=explode(",",$str);
                     if(addupdateCl($tab[0],$tab[1],$tab[2],$tab[3],$tab[4],$tab[5])){
                     header("location:client.php");
                     }
                  }
                  else {$i++;}
              }
              fclose($fup);
          }
          else $msg="enter a csv file";
    }
    if(isset($_POST['upload'])) exportCSV("client.csv",$tab);
    if($_GET){
        deleteClient($_GET['id']);
        header("location:client.php");
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
</nav>
<br><br><br>
    <table class="table table-striped table-bordered" id="tab">
        <thead>
            <tr>
                <th>Ordre</th>
                <th>CNI</th>
                <th>Nom</th>
                <th>Genre</th>
                <th>Adresse</th>
                <th>Mail</th>
                <th>Tel</th>
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
                echo "<td>".$tab[$i]['nom']."</td>";
                echo "<td>".$tab[$i]['genre']."</td>";
                echo "<td>".$tab[$i]['adresse']."</td>";
                echo "<td>".$tab[$i]['mail']."</td>";
                echo "<td>".$tab[$i]['tel']."</td>";
                echo "<td><a href='client.php?id=".$tab[$i]['CNI']."'><img src='https://toppng.com/uploads/preview/free-recycle-bin-icon-vector-recycle-bin-icon-115534132079jvhnualpn.png' alt='trash can' height='10' width='10'></a></td>";
                echo "</tr>";
            }
           ?>
        </tbody>
    </table><br>
    <a class="cu" href="add-update.php"><img src="../../icone-image/add.png" alt="add icone" height="25" width="25"></a>
    <a class="cu" href="add-update.php"><img src="../../icone-image/refresh.png" alt="update icone" height="25" width="25" ></a>
<r>
    <form method="post" action="client.php" enctype="multipart/form-data">
    <input type="file" name="csv">
    <input type="submit" name="btn" value="Importer la liste des clients">
        </form><br><br>
    <form method="post" action="client.php">
        <button type="submit" name="upload">Exporter la liste des clients</button>
        </form><br>
  <label><?php if(isset($msg)) echo "<h3 style='text-align: center;' class='alert alert-info'>".$msg."</h3>" ?></label>
</body>
</html>