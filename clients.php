<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
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
                <th>CIN</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Date de naissance</th>
                <th>E-mail</th>
                <th>Telephone</th>
                <th>Adresse</th>
                <th>Date d'ajoute</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            require_once("conf.php");
            $requete = $bd->query("SELECT * FROM client");
            $clients = $requete->fetchAll();
            foreach ($clients as $client) {
                echo "<tr>";
                echo "<td>".$client['cin']."</td>";
                echo "<td>".$client['nom']."</td>";
                echo "<td>".$client['prenom']."</td>";
                echo "<td>".$client['date_naissance']."</td>";
                echo "<td>".$client['email']."</td>";
                echo "<td>".$client['telephone']."</td>";
                echo "<td>".$client['adresse']."</td>";
                echo "<td>".$client['created_at']."</td>";
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