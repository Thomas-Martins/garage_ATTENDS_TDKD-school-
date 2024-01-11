<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage Attens</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <main>
        <header class="header">
            <div class="wrapper">
                <nav class="navbar">
                    <a class="logo" href="accueil.php"><img src="assets/img/logo.png" alt="logo"></a>
                    <h3>Dashboard</h3>
                    <input type="checkbox" name="" id="toggle">
                    <label for="toggle"><i class="fa-solid fa-bars"></i></label>
                    <div class="menu">
                        <ul>
                            <li><a class="link" href="src/interventions/index.php">Interventions</a></li>
                            <li><a class="link" href="src/employes/index.php">Employés</a></li>
                            <li><a class="link" href="src/user/index.php">Utilisateurs</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <div class="container">
            <div class="title">
                <h1>Bienvenue sur votre outils de Gestion</h1>
                <div class="avatarBtn">
                    <a href=""><i class="fa-regular fa-circle-user fa-2xl"></i></a>
                    <div class="logoutBtn">
                        <p>Connecté en tant que : User</p>
                        <a class="redBtn" href="#">Deconnexion</a>
                    </div>
                </div>
            </div>
            <div class="content">
                <h3>Grâce à cet outils de gestion, vous allez pouvoir organiser votre agenda d'interventions en toutes simplicités.</h3><br>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ad, voluptatum fuga explicabo quae harum repellendus doloremque alias iure facere consectetur molestiae accusamus voluptatem aut, eos quasi quisquam nihil soluta cumque.</p>
            </div>
            <footer>
                <h4>Copyright© by Thomas, Dylan, Khalid, David<br><small>2023 - ViaFormation</small></h4>
            </footer>
        </div>
    </main>
</body>
</html>