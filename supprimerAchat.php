<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un achat</title>
    <link rel="stylesheet" href="css/styleAchat.css">
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
        <div class="title">Supprimer un achat</div>
        <form action="supprimerAchat.php" method="post" class="form">
            <div class="infos">
                <div class="info"><label>Id d'achat</label><input type="text" name="id_achat" id="id_achat" required>
                </div>
                <div class="info"><label>CIN</label><input type="text" name="cin" id="cin" readonly></div>
                <div class="info"><label>Nom du client</label><input type="text" name="nom_client" id="nom_client"
                        readonly></div>
                <div class="info"><label>Id de produit</label><input type="text" name="id_produit" id="id_produit"
                        readonly></div>
                <div class="info"><label>Nom du produit</label><input type="text" name="nom_produit" id="nom_produit"
                        readonly></div>
                <div class="info"><label>Date d'achat</label><input type="datetime-local" name="date_achat"
                        id="date_achat" readonly></div>
                <div class="info"><label>Quantite</label><input type="number" id="quantite" name="quantite" min="0"
                        readonly></div>
                <div class="info"><label>Prix totale</label><input type="number" id="prix_totale" name="prix_totale"
                        readonly></div>
            </div>
            <div class="submit"><input type="submit" value="Supprimer" onclick="return confirmSubmit();"></div>
            <?php
            require_once('conf.php');

            if (isset($_POST['id_achat'])) {
                $delete = $bd->prepare("DELETE FROM acheter WHERE id_achat=?");
                if ($delete->execute([$_POST['id_achat']]))
                    echo '<div class="ok">L\'achat a été supprimer avec succès.</div>';
                else
                    echo '<div class="alert alert-danger">Une erreur s\'est produite lors de la suppression de l\'achat.</div>';

            }
            ?>
        </form>
    </div>

    <script>
        function getNomClient() {
            var cin = document.getElementById("cin").value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("nom_client").value = this.responseText;
                }
            };
            xhttp.open("GET", "getInfos/getClientInfo.php?cin=" + cin + "&data=" + "nom,prenom", true);
            xhttp.send();
        }

        function getProduitInfo(data) {
            var id_produit = document.getElementById("id_produit").value;
            var quantite = Number(document.getElementById("quantite").value);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (data == 'nom_produit') document.getElementById(data).value = this.responseText;
                    else if (data == 'prix') document.getElementById("prix_totale").value = Number(this.responseText) * quantite;
                    else if (this.responseText < quantite) { alert("Il reste que " + this.responseText + " unites"); document.getElementById('quantite').value = Number(this.responseText); getProduitInfo(data) }
                }
            };
            xhttp.open("GET", "getInfos/getProduitInfo.php?id_produit=" + id_produit + "&data=" + data, true);
            xhttp.send();
        }

        function getAchatInfo(data) {
            var id_achat = document.getElementById("id_achat").value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById(data).value = this.responseText;
                    document.getElementById(data).removeAttribute("readonly");
                    getNomClient();
                    getProduitInfo("nom_produit");
                    if (document.getElementById(data).value == "") {
                        document.getElementById(data).setAttribute("readonly", "");
                    }
                }
            };
            xhttp.open("GET", "getInfos/getAchatInfo.php?id_achat=" + id_achat + "&data=" + data, true);
            xhttp.send();
        }

        let timeout;
        document.getElementById("id_achat").addEventListener('input', () => {
            clearTimeout(timeout);
            timeout = setTimeout(getAchatInfo("cin"), 500);
            timeout = setTimeout(getAchatInfo("id_produit"), 500);
            timeout = setTimeout(getAchatInfo("date_achat"), 500);
            timeout = setTimeout(getAchatInfo("quantite"), 500);
            timeout = setTimeout(getAchatInfo("prix_totale"), 500);
        });

        function confirmSubmit() {
            if (document.getElementById("quantite").value == "") {
                alert("Entrer l'id d'une achat valide pour la modifier");
                return false;
            }
            var confirmMsg = confirm("Êtes-vous sûr de vouloir modifier les donnees de cette achat?");
            if (confirmMsg == true) {
                document.getElementById("form").submit();
            } else {
                return false;
            }
        }

    </script>

</body>

</html>