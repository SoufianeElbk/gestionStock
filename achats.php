<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Achats</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <style>
        *{
            font-size: 14px;
        }
        table{
            background-color: rgb(192, 200, 225);
        }
    </style>
</head>

<body>
    <?php require_once("index.php"); ?>
    <table id="myTable" class="display">
        <thead>
            <tr>
                <th>Reference d'achat</th>
                <th>CIN</th>
                <th>Reference du produit</th>
                <th>Date d'achat</th>
                <th>Quantite</th>
                <th>Prix totale</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            require_once("conf.php");
            $requete = $bd->query("SELECT * FROM acheter");
            $achats = $requete->fetchAll();
            foreach ($achats as $achat) {
                echo "<tr>";
                echo "<td>".$achat['id_achat']."</td>";
                echo "<td>".$achat['cin']."</td>";
                echo "<td>".$achat['id_produit']."</td>";
                echo "<td>".$achat['date_achat']."</td>";
                echo "<td>".$achat['quantite']."</td>";
                echo "<td>".$achat['prix_totale']."</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
</body>

</html>