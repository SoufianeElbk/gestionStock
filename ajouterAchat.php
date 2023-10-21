<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un achat</title>
    <link rel="stylesheet" href="css/styleAchat.css">
</head>
<body>
    <?php require_once("index.php"); ?>
    <div class="container">
        <div class="title">Ajouter un nouveau achat</div>
        <form action="ajouterAchat.php" method="post" class="form">
            <div class="infos">
                <div class="info"><label>CIN</label><input type="text" name="cin" id="cin" required></div>
                <div class="info"><label>Nom du client</label><input type="text" name="nom_client" id="nom_client" readonly></div>
                <div class="info"><label>Id de produit</label><input type="text" name="id_produit" id="id_produit" required></div> 
                <div class="info"><label>Nom du produit</label><input type="text" name="nom_produit" id="nom_produit" readonly></div>
                <div class="info"><label>Quantite</label><input type="number" id="quantite" name="quantite" min="0" required></div> 
                <div class="info"><label>Prix totale</label><input type="number" id="prix_totale" name="prix_totale" readonly></div> 
            </div>
            <div class="submit"><input type="submit" value="Valider" onclick="return confirmSubmit();"></div>
            <?php
            require_once('conf.php');

            if (isset($_POST['cin'],$_POST['nom_client'],$_POST['id_produit'],$_POST['nom_produit'],$_POST['quantite'],$_POST['prix_totale'])) {
                $requete = $bd->prepare("INSERT INTO acheter(cin,id_produit,quantite,prix_totale) VALUES(?,?,?,?)");
                if($requete->execute([$_POST['cin'],$_POST['id_produit'],$_POST['quantite'],$_POST['prix_totale']]))
                    echo '<div class="ok">L\'achat a été ajouté avec succès.</div>';
                else
                    echo '<div class="alert alert-danger">Une erreur s\'est produite lors de l\'ajout de l\'achat.</div>';

                $update = $bd->prepare("UPDATE produit SET quantite_disponible = quantite_disponible - ? where id_produit =?");
                $update->execute([$_POST['quantite'],$_POST['id_produit']]);
            }
        ?>
        </form>
    </div>

            <script>
                function getNomClient() {
                    var cin = document.getElementsByName("cin")[0].value;
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.getElementById("nom_client").value = this.responseText;
                        }
                    };
                    xhttp.open("GET", "getInfos/getClientInfo.php?cin="+cin+"&data="+"nom,prenom", true);
                    xhttp.send();
                }

                function getProduitInfo(data) {
                    var id_produit = document.getElementById("id_produit").value;
                    var quantite = Number(document.getElementById("quantite").value);
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            if(data=='nom_produit') document.getElementById(data).value = this.responseText;
                            else if(data=='prix') document.getElementById("prix_totale").value = Number(this.responseText) * quantite;
                            else if(this.responseText < quantite) { alert("Il reste que "+this.responseText+" unites"); document.getElementById('quantite').value = Number(this.responseText); getProduitInfo(data) }
                        }
                    };
                    xhttp.open("GET", "getInfos/getProduitInfo.php?id_produit=" + id_produit + "&data=" + data, true);
                    xhttp.send();
                }

                let timeout;

                document.getElementById("cin").addEventListener('input', ()=>{
                    clearTimeout(timeout);
                    timeout = setTimeout(getNomClient,500);
                });
                
                document.getElementById("id_produit").addEventListener('input', () => {
                    clearTimeout(timeout);
                    timeout = setTimeout(getProduitInfo("nom_produit"), 500)
                });
                document.getElementById("quantite").addEventListener('input', () => {
                    clearTimeout(timeout);
                    timeout = setTimeout(getProduitInfo("quantite_disponible"), 500);
                    timeout = setTimeout(getProduitInfo("prix"), 500);
                });

                function confirmSubmit() {
                    if(document.getElementById("nom_client").value==""){
                        alert("Entrer un CIN d'un client valide");
                        return false;
                    }
                    if(document.getElementById("nom_produit").value==""){
                        alert("Entrer un id d'un produit valide");
                        return false;
                    }
                }
                
</script>

</body>
</html>