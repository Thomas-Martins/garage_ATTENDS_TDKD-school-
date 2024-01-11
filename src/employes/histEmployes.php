<?php

require_once("../connexion.php");

if (!isset($_GET['id']) || intval($_GET['id']) == 0) {
    header('Location:./index.php');
}

$id = $_GET['id'];
$sql = "SELECT client.prenom , client.nom, client.telephone, intervention.debut_intervention AS date_intervention, intervention.description_courte, intervention.description_longue, intervention.duree FROM intervention
INNER JOIN client ON client.id = intervention.id_client
INNER JOIN employe ON employe.id = intervention.id_employe
WHERE employe.id = :id;";
$query = $db->prepare($sql);
$query->execute([
    'id' => $id
]);

$employes = $query->fetchAll();

if ($employes === false) {
    header('Location:./index.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique Intervention</title>
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
                <h1>Historique des Interventions</h1><br>
                <div class="avatarBtn">
                    <a href=""><i class="fa-regular fa-circle-user fa-2xl"></i></a>
                    <div class="logoutBtn">
                        <p>Connecté en tant que : User</p>
                        <a class="redBtn" href="#">Deconnexion</a>
                    </div>
                </div>
            </div>
            <div class="content">
                <?php foreach ($employes as $employe) : ?>
                    <div class="card">
                        <div>
                            <p>Client: <?= $employe['nom'] . ' ' . $employe['prenom']?></a></p>
                        </div>
                        <div>
                            <p>Téléphone: <?$employe['telephone']?></p>
                        </div>
                        <div>
                            <p>Date : <?=' le ' . date('j/m/y', strtotime($employe['date_intervention'])); ?></p>
                        </div>
                        <div>
                            <p>Durée : <?= $employe['duree']; ?>h</p>
                        </div>
                        <div>
                            <p>Description : <?= $employe['description_courte']?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <footer>
                <h4>Copyright© by Thomas, Dylan, Khalid, David<br><small>2023 - ViaFormation</small></h4>
            </footer>
        </div>
    </main>
</body>
</html>