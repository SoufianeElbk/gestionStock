<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un client</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styleClient.css">
</head>

<body>
    <?php require_once("index.php") ?>
    <div class="container">
        <div class="title">Ajouter un nouveau client</div>
        <form action="ajouterClient.php" method="post" class="form">
            <div class="infos">
                <div class="info"><label>CIN</label><input type="text" name="cin" required></div>

                <div class="info"><label>Nom</label><input type="text" name="nom" required></div>

                <div class="info"><label>Prenom</label><input type="text" name="prenom" required></div>

                <div class="info"><label>Date de naissance</label><input type="date"
                        name="date_naissance" required></div>

                <div class="info"><label>E-mail</label><input type="email" name="email"> </div>

                <div class="info"><label>Telephone</label><input type="text" name="telephone" required></div>

                <div class="info"><label>Adresse</label><input type="text" name="adresse" required></div>
            </div>
            <div class="submit"><input type="submit" value="Ajouter"></div>
            <?php
            require_once('conf.php');
            if (isset($_POST['cin'], $_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['telephone'], $_POST['adresse'])) 
            {
                $requete_check = $bd->prepare("SELECT COUNT(*) FROM client WHERE cin = ?");
                $requete_check->execute([$_POST['cin']]);

                if ($requete_check->fetchColumn() == 0) {
                    $requete = $bd->prepare("INSERT INTO client(cin,nom,prenom,date_naissance,email,telephone,adresse) VALUES(?,?,?,?,?,?,?)");
                    
                    if ($requete->execute([$_POST['cin'], $_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['email'], $_POST['telephone'], $_POST['adresse']]))
                        echo '<div class="ok">Le client a été ajouté avec succès.</div>';
                    else
                        echo '<div class="alert alert-danger">Une erreur s\'est produite lors de l\'ajout du client.</div>';

                } else
                    echo '<div class="alert alert-danger">Le client avec ce CIN existe déjà.</div>';

            }
            ?>
        </form>
    </div>
</body>

</html>