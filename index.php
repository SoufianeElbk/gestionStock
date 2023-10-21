<?php
session_start();
if (!isset($_SESSION["autoriser"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <style>
      *{
        font-family: 'Ubuntu';
      }
      nav{
        margin-bottom: 20px;
      }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="home.php"><img src="images/logo.png" width="70px"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Clients
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="clients.php">La liste de clients</a></li>
                  <li><a class="dropdown-item" href="ajouterClient.php">Ajouter un client</a></li>
                  <li><a class="dropdown-item" href="modifierClient.php">Modifier un client</a></li>
                  <li><a class="dropdown-item" href="supprimerClient.php">Supprimer un client</a></li>
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Produits
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="produits.php">La liste de produits</a></li>
                  <li><a class="dropdown-item" href="ajouterProduit.php">Ajouter un produit</a></li>
                  <li><a class="dropdown-item" href="modifierProduit.php">Modifier un produit</a></li>
                  <li><a class="dropdown-item" href="supprimerProduit.php">Supprimer un produit</a></li>                
                </ul>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Achats
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="achats.php">La liste d'Achats</a></li>
                  <li><a class="dropdown-item" href="ajouterAchat.php">Ajouter un achat</a></li>
                  <li><a class="dropdown-item" href="modifierAchat.php">Modifier un achat</a></li>
                  <li><a class="dropdown-item" href="supprimerAchat.php">Supprimer un achat</a></li>
                </ul>
              </li>
              <li class="nav-item"><a class="nav-link" href="deconnexion.php">Deconnexion <i class="fa-solid fa-right-to-bracket"></i></a></li>
            </ul>
          </div>
        </div>
      </nav>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
</body>
</html>