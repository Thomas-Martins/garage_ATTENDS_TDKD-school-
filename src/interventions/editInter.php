<?php
require_once("../connexion.php");

if (!isset($_GET['id']) || intval($_GET['id']) == 0) {
    header('Location:./index.php');
}


$id = $_GET['id'];
$sql = "SELECT *, client.prenom, client.nom FROM `intervention` 
        LEFT JOIN client ON client.id = intervention.id_client
        WHERE intervention.id = :id;";
$query = $db->prepare($sql);
$query->execute([
    'id' => $id
]);

$intervention = $query->fetch();
if ($intervention === false) {
    header('Location:./index.php');
}

$msg = '';
if (isset($_POST['submit'])) {
    if (
        isset($_POST['debut_intervention']) && $_POST['debut_intervention'] != ''
        && isset($_POST['fin_intervention']) && $_POST['fin_intervention'] != ''
        && isset($_POST['duree']) && $_POST['duree'] != ''
        && isset($_POST['id']) && intval($_POST['id']) != 0
    ) {
        $id = intval(trim($_POST['id']));
        $debut_intervention = trim($_POST['debut_intervention']);
        $fin_intervention = trim($_POST['fin_intervention']);
        $duree = htmlspecialchars(trim($_POST['duree']));

        $sqlUpdate = "UPDATE intervention SET debut_intervention = :debut_intervention, fin_intervention = :fin_intervention, duree = :duree
            WHERE id = :id";
        $queryUpdate = $db->prepare($sqlUpdate);
        $queryUpdate->execute([
            "debut_intervention" => $debut_intervention,
            "fin_intervention" => $fin_intervention,
            "duree" => $duree,
            "id" => $id,
        ]);
        header('Location:viewInter.php?id=' . $id);
    }
} else {
    $msg = '';
}


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification Intervention</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../../assets/css/style.css">
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
                <h1>Modifier l'ntervention</h1><br>
                <div class="avatarBtn">
                    <a href=""><i class="fa-regular fa-circle-user fa-2xl"></i></a>
                    <div class="logoutBtn">
                        <p>Connecté en tant que : User</p>
                        <a class="redBtn" href="#">Deconnexion</a>
                    </div>
                </div>
            </div>
            <div class="content">
                <h3><?= $intervention['prenom'] . " " . $intervention['nom'] ?></h3><br>
                <form method="post">
                    <input type="hidden" name="id" value="<?= $id; ?>">

                    <div>
                        <input type="date" value="<?= $intervention['debut_intervention'] ?>" name="debut_intervention" required="required">
                    </div>
                    <div>
                        <input type="date" value="<?= $intervention['fin_intervention'] ?>" name="fin_intervention" required="required">
                    </div>
                    <div>
                        <input type="number" value="<?= $intervention['duree'] ?>" name="duree" required="required">

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