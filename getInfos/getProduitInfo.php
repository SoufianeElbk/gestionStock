<?php
require_once("../conf.php");
$id_produit = $_GET["id_produit"];
$data = $_GET["data"];
$result = $bd->query("SELECT $data FROM produit WHERE id_produit = '$id_produit'");
$row = $result->fetch();
if ($row) {
    echo $row["$data"];
}