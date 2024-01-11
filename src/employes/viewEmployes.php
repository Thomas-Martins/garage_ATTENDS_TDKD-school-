<?php

require_once("../connexion.php");

if (!isset($_GET['id']) || intval($_GET['id']) == 0) {
    header('Location:./index.php');
}

if ($employes === false) {
    header('Location:./index.php');
}


if (!isset($_GET['id']) || intval($_GET['id']) == 0) {
    header('Location:./index.php');
}

$id = $_GET['id'];

$sql = "SELECT nom, prenom, telephone, email, adresse, code_postal, ville,id_user, user.username FROM employe 
        LEFT JOIN user ON user.id = employe.id_user
        WHERE employe.id = :id;";
$query = $db->prepare($sql);
$query->execute([
    'id' => $id
]);
    
$employe = $query->fetch();
if ($employe === false) {
    header('Location:./index.php');
}

$sqlintervention = "SELECT *, client.nom, client.prenom FROM intervention
                    LEFT  JOIN client ON intervention.id_client = client.id
                    WHERE intervention.id= :id";
$queryintervention = $db->prepare($sqlintervention);
$queryintervention->execute([
    'id' => $id
]);

$interventions = $queryintervention->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visuel employé</title>
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
                            <li><a class="link" href="../interventions/index.php">Interventions</a></li>
                            <li><a class="link" href="../employes/index.php">Employés</a></li>
                            <li><a class="link" href="../user/index.php">Utilisateurs</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <div class="container">
                <!-- H1 titre du tableau -->
            <div class="title">
                <h1>Information employé :</h1><br>
                <div class="avatarBtn">
                    <a href=""><i class="fa-regular fa-circle-user fa-2xl"></i></a>
                    <div class="logoutBtn">
                        <p>Connecté en tant que : User</p>
                        <a class="redBtn" href="#">Deconnexion</a>
                    </div>
                </div>
            </div>
            <div class="content">
            <h2><?= $employe['prenom'] . " " . $employe["nom"]; ?></h2>
                <section class="infos"> 
                    <p>Adresse: <?= $employe['adresse'] . ' ' . $employe['code_postal']. ' ' . $employe['ville']; ?> </p>
                    <p>Téléphone: <?= $employe['telephone']?></p>
                    <p>Email: <a href="mailto:<?= $employe['email']?>"><?= $employe['email']?></a></p>
                    <p>Username: <?= $employe['username']; ?></p>
                </section>
                <div>
                    <a class="blueBtn" href="editEmployes.php?id=<?= $employe['id'] ?>">Modifier</a>
                    <a class="redBtn" href="../user/index.php">Supprimer</a>
                </div>
                <br><a href="histEmployes.php?id=<?= $employe['id'] ?>">Historique des intervention de <?= $employe['prenom'] . " " . $employe["nom"]; ?>.</a>
                <h2>Intervention future :</h2>
                <?php foreach ($interventions  as $intervention) :?>
                    <div class="card">
                        <div>
                            <p>Client: <?= $intervention['nom'] . ' ' . $intervention['prenom']; ?></a></p>
                        </div>
                        <div>
                            <p>Date: <?= date('j/m/y' , strtotime($intervention['debut_intervention']))?> </p>
                        </div>
                        <div>
                            <p>Durée: <?= $intervention['duree']?>h</p>
                        </div>
                        <div>
                            <p>Description: <?= $intervention['description_courte']?></p>
                        </div>
                    </div>
                <?php endforeach;?>
                
            </div>
        </div>
        <footer>
            <h4>Copyright© by Thomas, Dylan, Khalid, David<br><small>2023 - ViaFormation</small></h4>
        </footer>
    </main>   
</body>
</html>