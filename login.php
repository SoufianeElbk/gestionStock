<?php
            session_start();
            require_once('conf.php');
            ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container">
        <div class="left-side">
            <img src="https://cdn-icons-png.flaticon.com/128/6828/6828668.png" width="150px">
            <img src="https://cdn-icons-png.flaticon.com/256/7648/7648749.png" width="200px">
        </div>
        <form action="login.php" method="post" class="form">
            <div class="title">Login</div>
            <div class="info">
                <div class="username">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="password">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
            </div>
            <div class="submit">
                <input type="submit" id="submit" class="btn btn-success" value="S'authentifier">
            </div>
            <?php
            


            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $requete = $bd->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
                $requete->bindValue(1, $username);
                $requete->bindValue(2, $password);
                $requete->execute();
                while ($ligne = $requete->fetch(PDO::FETCH_ASSOC))
                    if ($ligne['username'] == $username && $ligne['password'] == $password) {
                        $_SESSION["autoriser"] = "ok";
                        $_SESSION['username'] = $username;
                        header("Location: home.php");
                        exit();
                    }
                echo '<div class="alert alert-danger">Nom d\'utilisateur ou Mot de passe est incorrecte.</div>';
            }
            ?>
        </form>
    </div>
    <script>

    </script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
</body>

</html>