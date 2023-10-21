<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un client</title>
    <link rel="stylesheet" href="css/styleClient.css">
</head>
<body>
    <?php require_once("index.php"); ?>
    <div class="container">
        <div class="title">Modifier un client</div>
        <form action="modifierClient.php" method="post" class="form" id="form">
    <div class="infos">
        <div class="info cin">
            <label>CIN</label>
            <input type="text" id="cin" name="cin" required>
        </div>
        <div class="info nom">
            <label>Nom</label>
            <input type="text" name="nom" id="nom" readonly>
        </div>
        <div class="info prenom">
            <label>Prenom</label>
            <input type="text" name="prenom" id="prenom" readonly>
        </div>
        <div class="info date_naissance">
            <label>Date de naissance</label>
            <input type="date" name="date_naissance" id="date_naissance" readonly>
        </div>
        <div class="info email">
            <label>E-mail</label>
            <input type="email" name="email" id="email" readonly>
        </div>
        <div class="info telephone">
            <label>Telephone</label>
            <input type="text" name="telephone" id="telephone" readonly>
        </div>
        <div class="info adresse">
            <label>Adresse</label>
            <input type="text" name="adresse" id="adresse" readonly>
        </div>
    </div>
    <div class="submit">
        <input type="submit" name="update" onclick="return confirmSubmit();" value="Modifier">
    </div>
            <?php
            require_once('conf.php');
            if (isset($_POST['cin'], $_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['telephone'], $_POST['adresse'])) 
            {
                $update = $bd->prepare("UPDATE  client SET cin=?,nom=?,prenom=?,date_naissance=?,email=?,telephone=?,adresse=? where cin=?");
                if ($update->execute([$_POST['cin'],$_POST['nom'],$_POST['prenom'],$_POST['date_naissance'],$_POST['email'],$_POST['telephone'],$_POST['adresse'],$_POST['cin']]))
                    echo '<div class="ok">Le client a été modifié avec succès.</div>';
                else
                    echo '<div class="alert alert-danger">Une erreur s\'est produite lors de la modification du client.</div>';
            }
            ?>
        </form>
    </div>

    <script>
        function getClientInfo(data) {
            var cin = document.getElementById("cin").value;
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                document.getElementById(data).value = this.responseText;
                document.getElementById(data).removeAttribute("readonly");
                if(document.getElementById(data).value==""){
                    document.getElementById(data).setAttribute("readonly","");
                }
                }
            };
            xhttp.open("GET", "getInfos/getClientInfo.php?cin=" + cin + "&data=" + data, true);
            xhttp.send();
        }
        
        let timeout;
        document.getElementById("cin").addEventListener('input', () => {
        clearTimeout(timeout);
        timeout = setTimeout(getClientInfo("nom"), 500);
        timeout = setTimeout(getClientInfo("prenom"), 500);
        timeout = setTimeout(getClientInfo("date_naissance"), 500);
        timeout = setTimeout(getClientInfo("email"), 500);
        timeout = setTimeout(getClientInfo("telephone"), 500);
        timeout = setTimeout(getClientInfo("adresse"), 500);
        });

        function confirmSubmit() {
            if(document.getElementById("nom").value==""){
                alert("Entrer un CIN d'un client valide pour le modifier");
                return false;
            }
            var confirmMsg = confirm("Êtes-vous sûr de vouloir modifier les donnees de ce client?");
            if (confirmMsg == true) {
                document.getElementById("form").submit();
            } else {
                return false;
            }
        }
        
    </script>
</body>
</html>