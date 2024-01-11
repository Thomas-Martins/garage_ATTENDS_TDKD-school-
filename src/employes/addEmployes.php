<?php
//               Login session à faire

// session_start();
// if(empty($_SESSION[''])){
//     header('Location:');
// }

require_once('../connexion.php');

$erreur = "";

// Ajout username

if (isset($_POST['submit'])) {
    if (
        isset($_POST['username']) && $_POST['username'] != ''
        && isset($_POST['password']) && $_POST['password'] != ''
    ) {
        $username = trim($_POST['username']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }
    $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
    $query = $db->prepare($sql);
    $query->execute([
        'username' => $username,
        'password' => $password,
    ]);
}

// Ajout employé

if (isset($_POST['submit'])) {
    if (
        isset($_POST['nom']) && $_POST['nom'] != ''
        && isset($_POST['prenom']) && $_POST['prenom'] != ''
        && isset($_POST['telephone']) && $_POST['telephone'] != ''
        && isset($_POST['email']) && $_POST['email'] != ''
        && isset($_POST['adresse']) && $_POST['adresse'] != ''
        && isset($_POST['code_postal']) && $_POST['code_postal'] != ''
        && isset($_POST['ville']) && $_POST['ville'] != ''
    ) {
        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $telephone = htmlspecialchars(trim($_POST['telephone']));
        $email = htmlspecialchars(trim($_POST['email']));
        $adresse = htmlspecialchars(trim($_POST['adresse']));
        $code_postal = htmlspecialchars(trim($_POST['code_postal']));
        $ville = htmlspecialchars(trim($_POST['ville']));


        $objectPdo = new PDO('mysql:host=localhost;dbname=garage_attens_tdkd', 'root', '');

        $pdoStat = $objectPdo->prepare('INSERT INTO employe VALUES(NULL, :nom, :prenom, :telephone, :email, :id_user, :adresse, :code_postal, :ville)');
        $pdoStat->execute(array( 
            'nom' => $nom,
            'prenom' => $prenom,
            'telephone' => $telephone,
            'email' => $email,
            'adresse' => $adresse,
            'code_postal' => $code_postal,
            'ville' => $ville,
            'id_user' => $db->lastInsertId(),
        ));

        

        header('Location:./index.php');
    }
} else {
    $erreur = "<p class='error'>Vous m'avez pas renseigné tous les champs obligatoires.</p>";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Employé</title>
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <main>
        <header class="header">
            <div class="wrapper">
                <nav class="navbar">
                    <a class="logo" href="../../accueil.php"><img src="../../assets/img/logo.png" alt="logo"></a>
                    <h3>Dashboard</h3>
                    <input type="checkbox" name="" id="toggle">
                    <label for="toggle"><i class="fa-solid fa-bars"></i></label>
                    <div class="menu">
                        <ul>
                            <li><a class="link" href="../../src/interventions/index.php">Interventions</a></li>
                            <li><a class="link" href="../../src/employes/index.php">Employés</a></li>
                            <li><a class="link" href="../../src/user/index.php">Utilisateurs</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <div class="container">
            <div class="title">
                <h1>Ajout d'un employé :</h1>
                <div class="avatarBtn">
                    <a href=""><i class="fa-regular fa-circle-user fa-2xl"></i></a>
                    <div class="logoutBtn">
                        <p>Connecté en tant que : User</p>
                        <a class="redBtn" href="#">Deconnexion</a>
                    </div>
                </div>
            </div>
            <div class="content">
                <form action="" method="POST">
                    <div class="field">
                        <input type="text" placeholder="Nom" name="nom" required="required">
                        <input type="text" placeholder="Prenom" name="prenom" required="required">
                        <input type="tel" name="telephone" placeholder="Téléphone" required="required">
                        <input type="text" placeholder="Email" name="email" required="required">
                        <input type="text" placeholder="Address" name="adresse" required="required">
                        <input type="number" placeholder="Postal Code" name="code_postal" required="required">
                        <input type="text" placeholder="Ville" name="ville" required="required">
                        <input type="text" name="username" id="username" placeholder="username">
                        <input type="password" name="password" id="password" placeholder="password">
                    </div>
                    <input type="submit" id="submit" name="submit">
                    <?=$erreur?>
                </form>
            </div>
            <footer>
                <h4>Copyright© by Thomas, Dylan, Khalid, David<br><small>2023 - ViaFormation</small></h4>
            </footer>
        </div>
</body>
</html>