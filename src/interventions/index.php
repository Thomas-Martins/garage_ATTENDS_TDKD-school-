<?php
require_once('../connexion.php');

$sql = "SELECT client.prenom, client.nom, client.id, employe.prenom as eprenom, employe.nom as enom, employe.id as eid, intervention.id as iid, intervention.debut_intervention, intervention.duree, intervention.description_courte, intervention.description_longue
        FROM intervention INNER JOIN client ON intervention.id_client=client.id INNER JOIN employe ON intervention.id_employe=employe.id
        ORDER BY  debut_intervention DESC LIMIT 50";          
$query = $db->prepare($sql);
$query->execute();

$clients = $query->fetchALL();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <title>Listes interventions</title>
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
                <h1>Liste des Interventions</h1><br>
                <div class="avatarBtn">
                    <a href=""><i class="fa-regular fa-circle-user fa-2xl"></i></a>
                    <div class="logoutBtn">
                        <p>Connecté en tant que : User</p>
                        <a class="redBtn" href="#">Deconnexion</a>
                    </div>
                </div>
            </div>
            <div class="content">
                <a class="greenBtn" href="addInter.php">Ajoutez une Intervention</a> 
                <?php foreach ($clients as $client) : ?>
                    <div class="card">
                        <div>
                            <p>Client: <a href="./viewInter.php?id=<?= $client['iid'] ?>"><?=$client['nom']." ".$client['prenom']; ?></a></p>
                        </div>
                        <div>
                            <p>Mécanicien: <?=$client['enom']." ".$client['eprenom']; ?></p>
                        </div>
                        <div>
                            <p>Date d'intervention: <?= date('j/m/y', strtotime($client['debut_intervention'])); ?></p>
                        </div>
                        <div>
                            <p>Durée de l'intervention: <?= $client['duree']; ?>h</p>
                        </div>
                        <div>
                            <p>Description: <?= $client['description_courte']; ?></p>
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
