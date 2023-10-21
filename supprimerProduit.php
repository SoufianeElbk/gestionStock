<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un produit</title>
    <link rel="stylesheet" href="css/styleProduit.css">
    <style>
        input[type='submit'] {
            background-color: red;
            border-color: red;
        }
    </style>
</head>

<body>
    <?php require_once("index.php"); ?>
    <div class="container">
        <div class="title">Supprimer un produit</div>
        <form action="SupprimerProduit.php" method="post" class="form">
            <div class="infos">
                <div class="info"><label>Id</label><input type="number" id="id_produit" name="id_produit" required>
                </div>
                <div class="info"><label>Nom</label><input type="text" id="nom_produit" name="nom_produit" readonly>
                </div>
                <div class="info"><label>Prix</label><input type="text" id="prix" name="prix" readonly></div>
                <div class="info"><label>Quantite disponible</label><input type="number" id="quantite_disponible"
                        name="quantite_disponible" min="0" readonly></div>
            </div>
            <div class="submit"><input type="submit" value="Supprimer" onclick="return confirmSubmit();"></div>
            <?php
            require_once('conf.php');

            if (isset($_POST['id_produit'])) {
                $delete = $bd->prepare("DELETE FROM produit WHERE id_produit=?");
                if ($delete->execute([$_POST['nom_produit'], $_POST['prix'], $_POST['quantite_disponible']]))
                    echo '<div class="ok">Le Produit a été supprimer avec succès.</div>';
                else
                    echo '<div class="alert alert-danger">Une erreur s\'est produite lors de la suppression du produit.</div>';
            }

            ?>
        </form>
    </div>
    <script>
        
        document.getElementById("nom_produit").setAttribute("readonly", "");
        document.getElementById("prix").setAttribute("readonly", "");
        document.getElementById("quantite_disponible").setAttribute("readonly", "");
        function getProduitInfo(data) {
            var id_produit = document.getElementById("id_produit").value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById(data).value = this.responseText;
                    document.getElementById(data).removeAttribute("readonly");
                    if (document.getElementById(data).value == "") {
                        document.getElementById(data).setAttribute("readonly", "");
                    }
                }
            };
            xhttp.open("GET", "getInfos/getProduitInfo.php?id_produit=" + id_produit + "&data=" + data, true);
            xhttp.send();
        }

        let timeout;
        document.getElementById("id_produit").addEventListener('input', () => {
            clearTimeout(timeout);
            timeout = setTimeout(getProduitInfo("nom_produit"), 500);
            timeout = setTimeout(getProduitInfo("prix"), 500);
            timeout = setTimeout(getProduitInfo("quantite_disponible"), 500);
        });

        function confirmSubmit() {
            if (document.getElementById("nom_produit").value == "") {
                alert("Entrer l'id d'un produit valid pour le modifier");
                return false;
            }
            var confirmMsg = confirm("Êtes-vous sûr de vouloir modifier les donnees de ce produit?");
            if (confirmMsg == true) {
                document.getElementById("form").submit();
            } else {
                return false;
            }
        }

    </script>
</body>

</html>