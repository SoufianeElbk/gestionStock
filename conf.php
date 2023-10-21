<?php
try {
    $bd = new PDO('mysql:host=localhost;dbname=gestionStock', 'root', '');
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}
?>