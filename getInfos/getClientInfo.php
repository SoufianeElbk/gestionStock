<?php
require_once("../conf.php");
$cin = $_GET["cin"];
$data = $_GET["data"];
if ($data == "nom,prenom") {
    $result = $bd->query("SELECT $data FROM client WHERE cin = '$cin'");
    $row = $result->fetch();
    if ($row)
        echo $row["nom"] . ' ' . $row["prenom"];
} else {
    $result = $bd->query("SELECT $data FROM client WHERE cin = '$cin'");
    $row = $result->fetch();
    if ($row)
        echo $row["$data"];
}
