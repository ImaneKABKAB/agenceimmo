<?php
include_once("../BDtest.php");
session_start();
if(isset($_SESSION['pass']) && isset($_SESSION['user']) ){
    if(isset($_GET['id'])){
        deleteAdmin($_GET['id']);
        header("location:admin.php");
    }
    $dem=getDemandes();
    $count=count($dem);
    $prop=getPropositions();
    $som=count($prop);
}
else  header("location:authentification.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/1a1db964cb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
    
</head>
<body>
<nav>
    <div class="logo">
        <p><img src="../icone-image/logo.jpeg" height=40px width=40px>Agence IMMO</p>
</div>
<ul>
                    <li class="active"><a href="admin.php">DASHBORD</a></li>
                    <li><a href="client/client.php">CLIENT</a></li>
                    <li><a href="bien/bien.php">BIEN</a></li>
                    <li><a href="location/location.php">LOCATION</a></li>
                    <li><a href="notification.php?id1=dem"><i class="fa-solid fa-bell"></i></a><span class="badge bg-danger" id="badge"><?php echo $count ?></span><li>
     <li><a href="notification.php?id2=prop"><i class="fa-solid fa-bell"></i></a><span class="badge bg-primary" id="badge"><?php echo $som ?></span><li>
     <li><h3><?php 
         $sol= getAdmin($_SESSION['pass']);
         echo $sol['prenom']; ?></h3></li>
   <li><a href="logout.php">Logout</a></li>
</ul>
    </nav>
    <br><br><br>
         <table class="table table-striped table-bordered" id="tab">
        <thead>
            <tr>
                <th>Ordre</th>
                <th>Prenom</th>
                <th>Nom</th>
                <th>Login</th>
                <th>Password</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $tab= getAdmins();
            $j=0;
            for($i=0;$i<count($tab);$i++){
                echo "<tr>";
                echo "<td>".++$j."</td>";
                echo "<td>".$tab[$i]['prenom']."</td>";
                echo "<td>".$tab[$i]['nom']."</td>";
                echo "<td>".$tab[$i]['login']."</td>";
                echo "<td>".$tab[$i]['pass']."</td>";
                echo "<td><a href='admin.php?id=".$tab[$i]['pass']."'><img src='https://toppng.com/uploads/preview/free-recycle-bin-icon-vector-recycle-bin-icon-115534132079jvhnualpn.png' alt='trash can' height='10' width='10'></a></td>";
                echo "</tr>";
            }
           ?>
        </tbody>
    </table><br>
    <a  class="cuA" href="cuA.php"><img src="../icone-image/add.png" alt="add icone" height="25" width="25"><img src="../icone-image/refresh.png" alt="update icone" height="25" width="25" ></a>

    </body>
</html>