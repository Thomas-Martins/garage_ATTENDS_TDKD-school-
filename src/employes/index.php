<?php
//               Login session à faire

// session_start();
// if(empty($_SESSION[''])){
//     header('Location:');
// }

require_once('../connexion.php');
// nom, prenom, employe.id, telephone, email, adresse, code_postal, ville, id_user
$sql = "SELECT *, user.username as username FROM employe 
INNER JOIN user ON employe.id_user = user.id
ORDER BY employe.id ASC";
$query = $db->prepare($sql);
$query->execute();

$employes = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employés Liste</title>
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
                <h1>Liste des employés</h1><br>
                <div class="avatarBtn">
                    <a href=""><i class="fa-regular fa-circle-user fa-2xl"></i></a>
                    <div class="logoutBtn">
                        <p>Connecté en tant que : User</p>
                        <a class="redBtn" href="#">Deconnexion</a>
                    </div>
                </div>
            </div>
            <div class="content">
                <a class="greenBtn" href="./addEmployes.php">Ajoutez un employé</a> 
                <?php foreach ($employes as $employe) : ?>
                    <div class="card">
                        <div>
                            <p>Nom: <a href="./viewEmployes.php?id=<?= $employe['id'] ?>"><?= $employe['nom'] . ' ' . $employe['prenom']; ?></a></p>
                        </div>
                        <div>
                            <p>Adresse: <?= $employe['adresse'] . ' ' . $employe['code_postal']. ' ' . $employe['ville']; ?> </p>
                        </div>
                        <div>
                            <p>Email: <?= $employe['email']; ?></p>
                        </div>
                        <div>
                            <p>Téléphone: <?= $employe['telephone']; ?></p>
                        </div>
                        <div>
                            <p>Username: <?= $employe['username']; ?></p>
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