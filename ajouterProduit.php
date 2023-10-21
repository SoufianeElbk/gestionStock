<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="css/styleProduit.css">
</head>

<body>
    <?php require_once("index.php"); ?>
    <div class="container">
        <div class="title">Ajouter un nouveau produit</div>
        <form action="ajouterProduit.php" method="post" class="form">
            <div class="infos">
                <div class="info nom"><label>Nom</label><input type="text" name="nom_produit" required></div>
                <div class="info prix"><label>Prix</label><input type="" name="prix" required></div>
                <div class="info qte"><label>Quantite disponible</label><input type="number" name="quantite_disponible"
                        min="0" required></div>
            </div>
            <div class="submit"><input type="submit" value="Ajouter"></div>
            <?php
            require_once('conf.php');

            if (isset($_POST['nom_produit'], $_POST['prix'], $_POST['quantite_disponible'])) {
                $requete = $bd->prepare("INSERT INTO produit(nom_produit,prix,quantite_disponible) VALUES (?,?,?)");
                if ($requete->execute([$_POST['nom_produit'], $_POST['prix'], $_POST['quantite_disponible']]))
                    echo '<div class="ok">Le Produit a été ajouté avec succès.</div>';
                else
                    echo '<div class="alert alert-danger">Une erreur s\'est produite lors de l\'ajout du produit.</div>';
            }

            ?>
        </form>
    </div>
</body>

</html>