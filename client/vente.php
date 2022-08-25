<?php
include_once('../BDtest.php');
if(isset($_POST['vbtn'])){
    $rprop="Merci, votre proposition sera traitée dans les prochains délais!";
    insertPropositon($_POST['vnp'],$_POST['vmail'],$_POST['vtel'],$_POST['vty'],$_POST['vad']);
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
</head>
<body>
    <?php include_once("nav.php"); ?>
    <br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
    <form method="post" action="vente.php" >
    <div class="form-group">
    <input type="text" name="vnp" placeholder="Nom complet" required>
</div>
    <div class="form-group">
    <input type="email" name="vmail" placeholder="Entrer votre email" required>
</div>
    <div class="form-group">
    <input type="tel" name="vtel" placeholder="Entrer votre numero de telephone" required>
</div>
<div class="form-group">
    <input  list="propo" name="vty" placeholder="Type du bien" required>
    <datalist id="propo">
        <option value="Appartement">
        <option value="Commercial">
        <option value="Maison">
        <option value="Studio">
        <option value="Villa">
        <option value="Mini-Villa"> 
    </datalist>
</div>
<div class="form-group">
    <input type="text" name="vad" placeholder="Entrer l'adresse et la ville du bien" required>
</div>
    <input type="submit" name="vbtn" class="btn btn-default" value="Proposer">
    </form>
    <?php if(isset($rprop)) echo "<h3 style='text-align: center;' class='alert alert-info'>".$rprop."</h3>";?>
</div>
</div>
</div>
    <?php include_once("footer.php"); ?>
</body>
</html>
