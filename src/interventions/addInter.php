<?php
//               Login session à faire

// session_start();
// if(empty($_SESSION[''])){
//     header('Location:');
// }

require_once('../connexion.php');

$sql = "SELECT intervention.id, intervention.id_client, intervention.id_employe, client.id, employe.id FROM intervention
INNER JOIN client ON intervention.id_client = client.id
INNER JOIN employe ON intervention.id_employe = employe.id";
$query = $db->prepare($sql);
$query->execute();

$addemployes = $query->fetchAll();

$sqlclient = "SELECT * FROM client";
$queryclient = $db->prepare($sqlclient);
$queryclient->execute();
$clients = $queryclient->fetchAll();

$sqlemploye = "SELECT * FROM employe";
$queryemploye = $db->prepare($sqlemploye);
$queryemploye->execute();
$employes = $queryemploye->fetchAll();

$erreur = "";

if (isset($_POST['submit'])) {
    if (
        isset($_POST['debut_intervention']) && $_POST['debut_intervention'] != ''
        && isset($_POST['fin_intervention']) && $_POST['fin_intervention'] != ''
        && isset($_POST['description_longue']) && $_POST['description_longue'] != ''
        && isset($_POST['client']) && $_POST['client'] != ''
        && isset($_POST['employe']) && $_POST['employe'] != ''
    ) {
        $debut_intervention = htmlspecialchars(trim($_POST['debut_intervention']));
        $fin_intervention = htmlspecialchars(trim($_POST['fin_intervention']));
        $duree = isset($_POST['duree']) ? htmlspecialchars(trim($_POST['duree'])) : null;
        $description_courte = isset($_POST['description_courte']) ? htmlspecialchars(trim($_POST['description_courte'])) : null;
        $description_longue = htmlspecialchars(trim($_POST['description_longue']));
        $clientid = htmlspecialchars(trim($_POST['client']));;
        $employeid = htmlspecialchars(trim($_POST['employe']));;

        $sqlintervention="INSERT INTO `intervention` VALUES(NULL, :id_client, :id_employe, :debut_intervention, :duree, :fin_intervention, :description_courte, :description_longue)";
        $queryintervention= $db->prepare($sqlintervention);
        $queryintervention->execute([
            'id_client' => $clientid,
            'id_employe' => $employeid,
            'debut_intervention' => $debut_intervention,
            'duree' => $duree,
            'fin_intervention' => $fin_intervention,
            'description_courte' => $description_courte,
            'description_longue' => $description_longue,
        ]);

        header('Location:index.php');
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
    <title>Ajout intervention</title>
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
                <h1>Ajout d'une intervention :</h1>
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
                    <input type="date" name="debut_intervention" required="required">
                    <input type="date" name="fin_intervention" required="required">
                    <input type="number" placeholder="duree" name="duree">
                    <input type="text" placeholder="description_courte" name="description_courte">
                    <input type="textarea" placeholder="description_longue" name="description_longue" required="required">
                </div>
                <div class="select">
                    <select name="client" id="client">
                        <?php foreach ($clients as $client) { ?>
                            <option value="<?= $client['id'] ?>"><?php echo $client['nom'] . " " . $client['prenom'] ?></option>
                        <?php }; ?>
                    </select>
                    <select name="employe" id="employe">
                        <?php foreach ($employes as $employe) { ?>
                            <option value="<?= $employe['id'] ?>"><?php echo $employe['nom'] . " " . $employe['prenom'] ?></option>
                        <?php }; ?>
                    </select>
                </div>
                <input class="submitBtn" type="submit" id="submit" name="submit" value="Ajouter">
                <?=$erreur?>
            </form>
            </div>
            <footer>
                <h4>Copyright© by Thomas, Dylan, Khalid, David<br><small>2023 - ViaFormation</small></h4>
            </footer>
        </div>
    </main>
</body>

</html>