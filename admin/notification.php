<?php
include_once("../BDtest.php");
session_start();
if($_SESSION){
    if(isset($_GET['id1'])){
 $dem=getDemandes();
  updateDemandes();
  deleteDemandes();
    }
    if(isset($_GET['id2'])){
    $prop=getPropositions();
    updatePropositions();
    deletePropositions();
    }
    if(isset($_GET['idd'])){
        $to=$_GET['idd'];
        $subject="Demande de location";
        $message="Bonjour\r\nMerci pour choisir AGENCE IMMO\r\nOn vous contactera le plutot possible\r\nGardez votre GSM près de vous !\r\nMerci\r\nAGENCE IMMO.";
        $headers=array(
            'From'=> 'AGENCE IMMO <ikabkab13@gmail.com>',
            'Reply-To'=> 'AGENCE IMMO <ikabkab13@gmail.com>',
            'X-Mailer'=> 'PHP/'.phpversion()
        );
        mail($to,$subject,$message,$headers);
    }
    if(isset($_GET['idp']) && $_GET['name']=='Aprop'){
        $to=$_GET['idp'];
        $subject="Proposition de vente";
        $message="Bonjour\r\nMerci pour choisir AGENCE IMMO\r\nVotre proposition est bel et bien acceptée\r\nOn vous contactera pour confirmer la vente\r\nGardez votre GSM près de vous !\r\nMerci\r\nAGENCE IMMO.";
        $headers=array(
            'From'=> 'AGENCE IMMO <ikabkab13@gmail.com>',
            'Reply-To'=> 'AGENCE IMMO <ikabkab13@gmail.com>',
            'X-Mailer'=> 'PHP/'.phpversion()
        );
        mail($to,$subject,$message,$headers);
    }
    if(isset($_GET['idp']) && $_GET['name']=='Rprop'){
        $to=$_GET['idp'];
        $subject="Proposition de vente";
        $message="Bonjour\r\nMerci pour choisir AGENCE IMMO\r\nNous sommes désolés\r\nLe bien n'est pas adéquat\r\nMerci\r\nAGENCE IMMO.";
        $headers=array(
            'From'=> 'AGENCE IMMO <ikabkab13@gmail.com>',
            'Reply-To'=> 'AGENCE IMMO <ikabkab13@gmail.com>',
            'X-Mailer'=> 'PHP/'.phpversion()
        );
        mail($to,$subject,$message,$headers);
    }
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
    <link rel="stylesheet" href="main.css">
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
</nav><br><br><br><br><br>
<?php if(isset($_GET['id1'])){ ?>
<table class="table table-striped table-bordered" id="tab">
    <thead>
        <tr>
            <th>Ordre</th>
            <th>Nom complet</th>
            <th>Mail</th>
            <th>Tel</th>
            <th>Commentaire</th>
            <th>Action</th>
</tr>
</thead>
<tbody>
    <?php $j=0;
    for($i=0;$i<count($dem);$i++){
        echo "<tr>";
        echo "<td>".++$j."</td>";
        echo "<td>".$dem[$i]['nom_complet']."</td>";
        echo "<td>".$dem[$i]['mail']."</td>";
        echo "<td>".$dem[$i]['tel']."</td>";
        echo "<td>".$dem[$i]['text']."</td>";
        echo "<td><a href='notification.php?idd=".$dem[$i]['mail']."'>Envoyer un mail</a></td>";
        echo "</tr>"; 
    }
    ?>
</tbody>
</table>
<?php } ?>
<?php if(isset($_GET['id2'])){ ?>
<table class="table table-striped table-bordered" id="tab">
    <thead>
        <tr>
            <th>Ordre</th>
            <th>Nom complet</th>
            <th>Mail</th>
            <th>Tel</th>
            <th>Type</th>
            <th>Adresse du bien</th>
            <th colspan=2>Action</th>
</tr>
</thead>
<tbody>
    <?php $j=0;
    for($i=0;$i<count($prop);$i++){
        echo "<tr>";
        echo "<td>".++$j."</td>";
        echo "<td>".$prop[$i]['nom_complet']."</td>";
        echo "<td>".$prop[$i]['mail']."</td>";
        echo "<td>".$prop[$i]['tel']."</td>";
        echo "<td>".$prop[$i]['type']."</td>";
        echo "<td>".$prop[$i]['addr_bien']."</td>";
        echo "<td><a href='notification.php?idp=".$prop[$i]['mail']."&name=Aprop'>Accepter</a></td>";
        echo "<td><a href='notification.php?idp=".$prop[$i]['mail']."&name=Rprop'>Rejeter</a></td>";
        echo "</tr>";
    }
    ?>
</tbody>
</table>
<?php } ?>
</body>
</html>