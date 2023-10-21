<?php
require_once("../conf.php");
$id_achat = $_GET["id_achat"];
$data = $_GET["data"];
$result = $bd->query("SELECT $data FROM acheter WHERE id_achat = '$id_achat'");
$row = $result->fetch();
if ($row) {
    echo $row["$data"];
}