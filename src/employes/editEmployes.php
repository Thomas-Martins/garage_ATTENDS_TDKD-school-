<?php
require_once("../connexion.php");

if (!isset($_GET['id']) || intval($_GET['id']) == 0) {
    header('Location:./index.php');
}


$id = $_GET['id'];
$sql = "SELECT * FROM `employe` WHERE id = :id;";
$query = $db->prepare($sql);
$query->execute([
    'id' => $id
]);

$employe = $query->fetch();

if ($employe === false) {
    header('Location:./index.php');
}


$msg = '';
if (isset($_POST['submit'])) {
    if (
        isset($_POST['nom']) && $_POST['nom'] != ''
        && isset($_POST['prenom']) && $_POST['prenom'] != ''
        && isset($_POST['telephone']) && $_POST['telephone'] != ''
        && isset($_POST['email']) && $_POST['email'] != ''
        && isset($_POST['adresse']) && $_POST['adresse'] != ''
        && isset($_POST['code_postal']) && $_POST['code_postal'] != ''
        && isset($_POST['ville']) && $_POST['ville'] != ''
        && isset($_POST['id']) && intval($_POST['id']) != 0
    ) {
        $id = intval(trim($_POST['id']));
        $nom = htmlspecialchars(trim($_POST['nom']));
        $prenom = htmlspecialchars(trim($_POST['prenom']));
        $telephone = htmlspecialchars(trim($_POST['telephone']));
        $email = htmlspecialchars(trim($_POST['email']));
        $adresse = htmlspecialchars(trim($_POST['adresse']));
        $code_postal = htmlspecialchars(trim($_POST['code_postal']));
        $ville = htmlspecialchars(trim($_POST['ville']));

        $sqlUpdate = "UPDATE `employe` SET nom = :nom, prenom = :prenom, telephone = :telephone, email= :email, adresse = :adresse, code_postal = :code_postal, ville = :ville
        WHERE id = :id";
        $queryUpdate = $db->prepare($sqlUpdate);
        $queryUpdate->execute([
            "nom" => $nom,
            "prenom" => $prenom,
            "telephone" => $telephone,
            "email" => $email,
            "adresse" => $adresse,
            "code_postal" => $code_postal,
            "ville" => $ville,
            "id" => $id,
        ]);
        header('Location:viewEmployes.php?id=' . $id);
    }
} else {
    $msg = 'Echec critique';
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Employé</title>
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
            <!-- H1 titre du tableau -->
            <div class="title">
                <h1>Modifier information de <?= $employe['prenom'] . " " . $employe['nom']; ?></h1><br>
                <div class="avatarBtn">
                    <a href=""><i class="fa-regular fa-circle-user fa-2xl"></i></a>
                    <div class="logoutBtn">
                        <p>Connecté en tant que : User</p>
                        <a class="redBtn" href="#">Deconnexion</a>
                    </div>
                </div>
            </div>
            <div class="content">
                <form method="post">
                    <?= $msg; ?>
                    <input type="hidden" name="id" value="<?= $id; ?>">
                    <div>
                        <input type="text" value="<?= $employe['nom'] ?>" name="nom" required="required">
                        <input type="text" value="<?= $employe['prenom'] ?>" name="prenom" required="required">
                    </div>
                    <div>
                        <input type="tel" name="telephone" value="<?= $employe['telephone'] ?>" required="required">
                    </div>
                    <div>
                        <input type="text" value="<?= $employe['email'] ?>" name="email" required="required">
                    </div>
                    <div>
                        <input type="text" value="<?= $employe['adresse'] ?>" name="adresse" required="required">
                    </div>
                    <div>
                        <input type="number" value="<?= $employe['code_postal'] ?>" name="code_postal" required="required">
                        <input type="text" value="<?= $employe['ville'] ?>" name="ville" required="required">
                    </div>
                    <input type="submit" id="submit" name="submit">
                </form>
            </div>
            <footer>
                <h4>Copyright© by Thomas, Dylan, Khalid, David<br><small>2023 - ViaFormation</small></h4>
            </footer>
        </div>
    </main>
</body>
</html>