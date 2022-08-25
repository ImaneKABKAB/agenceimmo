<?php
include_once("../BDtest.php");
session_start();
if(isset($_GET['id'])){
    $request=$con->prepare("SELECT * FROM biens WHERE adresse=?");
    $request->bindParam(1,$_GET['id']);
    $request->execute();
    $tab=$request->fetch();
    $_SESSION['type']=$tab['type'];
    $_SESSION['adresse']=$tab['adresse'];
    $_SESSION['ville']=$tab['ville'];
    $_SESSION['superficie']=$tab['superficie'];
    $_SESSION['nbr_chambre']=$tab['nbr_chambre'];
    $_SESSION['prix_men']=$tab['prix_men'];
    $_SESSION['path']=$tab['path'];
}
if(isset($_POST['demande'])){
    $dmsg="Votre réponse est bien envoyée";
    insertDemande($_POST['nmclient'],$_POST['mailclient'],$_POST['telclient'],$_POST['question']);
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
    <br>
    <div class="ech">
    <?php
        echo "<div class='photo'>";
        echo "<img src='../admin/bien/".$_SESSION['path']."' alt='image de bien' >";
        echo "</div>";
        echo "<div class='info'>";
        echo "<p><b>Type: </b>".$_SESSION['type']."</p>";
        echo "<p><b>Adresse: </b>".$_SESSION['adresse']."</p>";
        echo "<p><b>Ville: </b>".$_SESSION['ville']."</p>";
        echo "<p><b>Superficie: </b>".$_SESSION['superficie']."</p>";
        echo "<p><b>Nombre de chambres: </b>".$_SESSION['nbr_chambre']."</p>";
        echo "<p><b>Prix mensuel: </b>".$_SESSION['prix_men']."DH</p>";
        echo "</div>";
        ?>
        </div>
        <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
        <form method="post" action="demande.php">
        <div class="form-group">
            <input type="text" name="nmclient" placeholder="enter your full name" required>
</div>
<div class="form-group">
            <input type="email" name="mailclient" placeholder="enter your email" required>
</div>
<div class="form-group">
            <input type="tel" name="telclient" placeholder="enter your phone number" required>
</div>
<div class="form-group">
            <textarea name="question" placeholder="Interested"  required></textarea>
</div>
            <input type="submit" name="demande" class="btn btn-default" value="Contacter">
</form>
<?php if(isset($dmsg)) echo "<h3 style='text-align: center;' class='alert alert-info'>".$dmsg."</h3>" ;?>
</div>
</div>
</div>
    <?php include_once("footer.php"); ?>
</body>
</html>