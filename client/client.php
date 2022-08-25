<?php
include_once("../BDtest.php");
$tab=getBiens();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <?php include_once("nav.php"); ?>
  <h3>Nos propositions</h3>
  <div class='card'>
<?php
for($i=0;$i<count($tab);$i++){
    echo "<div class='image'>";
    echo "<a href='demande.php?id=".$tab[$i]['adresse']."'><img src='../admin/bien/".$tab[$i]['path']."' alt='image de bien'></a>";
    echo "</div>";
}
?>
</div>
<?php include_once("footer.php"); ?>
</body>
</html>