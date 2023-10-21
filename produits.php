<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produits</title>
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
                <th>Reference du produit</th>
                <th>Nom du produit</th>
                <th>prix</th>
                <th>Quantite disponible</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            require_once("conf.php");
            $requete = $bd->query("SELECT * FROM produit");
            $produits = $requete->fetchAll();
            foreach ($produits as $produit) {
                echo "<tr>";
                echo "<td>".$produit['id_produit']."</td>";
                echo "<td>".$produit['nom_produit']."</td>";
                echo "<td>".$produit['prix']."</td>";
                echo "<td>".$produit['quantite_disponible']."</td>";
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