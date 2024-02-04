<?php
define("mes", "hello world");
// echo mes;
if (defined("mes")) {
    echo '<br><br>mes est defini : ' . mes . '<br>';
}

$tab4[0] = 12;
$tab4[1] = "fraise";
$tab4[2] = 30;
$tab4[5] = "el5";
echo "<br>" . count($tab4);
