<!DOCTYPE HTML>
<html>  
<body>

<?php

    $ref = $_GET["ref"];
	$libelle = $_GET["libelle"];
    $four = $_GET["four"];
    $PV = $_GET["PV"];
	$prix = $_GET["prix"];
	$qtestock = $_GET["qtestock"];

?>

<h4 align=center><FONT size="10" align=center> <I><B>Informations de l'article</B></I></FONT></h3><br><br>
R&eacute;f&eacute;rence: <?php echo $ref;?><br>
Libell&eacute;: <?php echo $libelle;?><br>

Fournisseurs: 
<ul>
<?php 
foreach($four as $f)
    echo "<li> $f </li>" ;  
    ?>
    </ul>
    <br>
Points de vente: 
<ul>
<?php 

foreach($PV as $p)
    echo "<li> $p </li>" ;  
?>
</ul>
Prix: <?php echo $prix;?><br>
Qte en Stock: <?php echo $qtestock;?><br>
</body>
</html>