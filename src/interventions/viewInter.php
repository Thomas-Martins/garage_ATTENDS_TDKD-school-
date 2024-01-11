<?php
require_once("../connexion.php");

if (!isset($_GET['id']) || intval($_GET['id']) == 0) {
    header('Location:./index.php');
}

$id = $_GET['id'];
$sql = "SELECT * FROM intervention WHERE id = :id;";
$query = $db->prepare($sql);
$query->execute([
    'id' => $id
]);

$intervention = $query->fetch();

if ($intervention === false) {
    header('Location:./index.php');
}

$sql = "SELECT * FROM client WHERE id = :id;";
$query = $db->prepare($sql);
$query->execute([
    'id' => $intervention["id_client"]
]);
    
$client = $query->fetch();



$sql = "SELECT * FROM employe WHERE id = :id;";
$query = $db->prepare($sql);
$query->execute([
    'id' => $intervention["id_employe"]
]);
    
$employe = $query->fetch();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Intervention</title>
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
                <h1>Intervention numéro <?= $intervention["id"] ?></h1><br>
                <a href=""><i class="fa-regular fa-circle-user fa-2xl"></i></a>
            </div>
            <div class="content">
                <section class="infos"> 
                    <h4>Informations Client</h4>
                    <p><?= $client['prenom']."  ".$client['nom']?></p>
                    <p>Téléphone: <?= $client['telephone']?></p>
                    <p>Email: <a href="mailto:<?= $client['email']?>"><?= $client['email']?></a></p>
                </section>
                <section class="infos">
                    <h4>Mécanicien en charge de l'intervention</h4>
                    <p><?= $employe['prenom']."  ".$employe['nom']?></p>
                    <p>Téléphone: <?= $employe['telephone']?></p>
                </section>
                <section class="infos">
                    <h4>Informations supplémentaire sur l'intervention</h4>
                    <p>Description: <?= $intervention['description_longue']?></p><br>
                    <p>Date d'intervention: <?= date('j/m/y' , strtotime($intervention['debut_intervention']))?></p><br>
                    <p>Durée de l'intervention: <?= $intervention['duree']?>h</p>
                </section>
                <div>
                    <a class="blueBtn" href="editInter.php?id=<?= $intervention['id'] ?>">Modifier l'intervention</a>
                    <a class="redBtn" href="deleteInter.php?id=<?=$intervention['id']?>">Annulation de l'intervention</a>
                </div>
            </div>
            <footer>
                <h4>Copyright© by Thomas, Dylan, Khalid, David<br><small>2023 - ViaFormation</small></h4>
             </footer>
        </div>
    </main>
</body>
</html>