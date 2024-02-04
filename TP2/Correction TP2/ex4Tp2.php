<!DOCTYPE html>



<?php

if (isset($_POST['ref'])  and isset($_POST['lib']) and isset($_POST['frs'])  and  isset($_POST['pr']) and isset($_POST['qt']) and isset($_POST['pv']) and !empty($_POST['ref']) and !empty($_POST['lib']) and !empty($_POST['frs']) and !empty($_POST['pv']) and !empty($_POST['pr']) and !empty($_POST['qt'])) {
	$r = $_POST['ref'];
	$l = $_POST['lib'];
	$frs = $_POST['frs'];
	$pv = $_POST['pv'];
	$pr = $_POST['pr'];
	$qt = $_POST['qt'];

	echo "reference : $r <br>";
	echo "libellé : $l <br>";
	echo "liste des fournisseurs <ul>";
	foreach ($frs as $fr)
		echo "<li>fournisseur : $fr</li>";
	echo "</ul> liste des points de ventes <ul>";
	foreach ($pv as $v)
		echo "<li>point de vente $v </li>";
	echo "</ul>prix : $pr <br>";
	echo "quantité : $qt<br>";
} else {

?>


<html>

<head>
    <title>Article</title>
    <meta charset="utf-8" />

</head>

<body>
    <form action="ex4Tp2.php" method="POST">
        <br><label for="ref">Référence de l'article : </label>
        <br><input type="text" name="ref" value='<?php if (isset($_POST['ref'])) {
															echo $_POST['ref'];
														} ?>'>
        <?php if (isset($_POST['ref']) and empty($_POST['ref']))
				echo "<span style='color:red'> champs obligatoire </span>"; ?>
        <br>
        <br><label for="lib">Libellé de l'article : </label>
        <br><input type="text" name="lib" value='<?php if (isset($_POST['lib'])) {
															echo $_POST['lib'];
														} ?>'>
        <?php if (isset($_POST['lib']) and empty($_POST['lib'])) echo "<span style='color:red'> champs obligatoire </span>"; ?>
        <br>
        <br><label for="frs">Fournisseur de l'article :
        </label><?php if (isset($_POST['ref']) and !isset($_POST['frs'])) echo "<span style='color:red'> champs obligatoire </span>"; ?>
        <br><select multiple name="frs[]">
            <option <?php if (isset($_POST['frs']) and (in_array('Fournisseur1', $_POST['frs'])))  echo "selected"; ?>>
                Fournisseur1</option>
            <option <?php if (isset($_POST['frs']) and (in_array('Fournisseur2', $_POST['frs'])))  echo "selected"; ?>>
                Fournisseur2</option>
            <option <?php if (isset($_POST['frs']) and (in_array('Fournisseur3', $_POST['frs'])))  echo "selected"; ?>>
                Fournisseur3</option>
        </select><br>
        <br><label for="pv">Point de vente :
        </label><?php if (isset($_POST['ref']) and !isset($_POST['pv'])) echo "<span style='color:red'> champs obligatoire </span>"; ?><br>
        <input type="checkbox" name="pv[]" value="PV1"
            <?php if (isset($_POST['pv']) and (in_array('PV1', $_POST['pv'])))  echo "checked"; ?>>Point de vente 1 <br>
        <input type="checkbox" name="pv[]" value="PV2"
            <?php if (isset($_POST['pv']) and (in_array('PV2', $_POST['pv'])))  echo "checked"; ?>>Point de vente 2 <br>
        <input type="checkbox" name="pv[]" value="PV3"
            <?php if (isset($_POST['pv']) and (in_array('PV3', $_POST['pv'])))  echo "checked"; ?>>Point de vente 3 <br>
        <br><label for="prix">Prix de l'article : </label>
        <br><input type="number" name="pr" min="0" value='<?php if (isset($_POST['pr'])) {
																	echo $_POST['pr'];
																} ?>'>
        <?php if (isset($_POST['pr']) and empty($_POST['pr'])) echo "<span style='color:red'> champs obligatoire </span>"; ?><br>
        <br><label for="qte">Quantité disponible : </label>
        <br><input type="number" name="qt" min="0" value='<?php if (isset($_POST['qt'])) {
																	echo $_POST['qt'];
																} ?>'>
        <?php if (isset($_POST['qt']) and empty($_POST['qt'])) echo "<span style='color:red'> champs obligatoire </span>"; ?><br>
        <br><input type="submit" value="Soumettre" name="sub">
    </form>
</body>

</html>

<?php
}
?>