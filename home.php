<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    
    <style>
        .bonjour{
            text-align:center;
            font-size: 90px;
            font-weight: bold;
            margin-top: 100px;
        }
    </style>

</head>


<body>
<?php
require_once("index.php");

echo '<div class="bonjour">Bonjour '.$_SESSION['username'].'</div>' ;
?>
</body>

</html>