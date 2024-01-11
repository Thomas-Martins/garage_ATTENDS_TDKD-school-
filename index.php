<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Garage Attens</title>
    <link rel="stylesheet" href="assets/css/styleLogin.css">
</head>
<body>
    <main>
        <div class="container">
        <div class="area" >
            <ul class="circles">
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
            </ul>
        </div >
            <div class="login">
                <div class="login-header">
                    <h1>Connexion</h1>
                    <p>Connectez-vous pour utilisez votre outils de gestion.</p>
                </div>
                <form action="accueil.php" method="POST" class="login-form">
                    <div class="login-form-content">
                        <div class="form-item">
                            <label for="email">Username</label>
                            <input type="text" name="email" id="email">
                        </div>
                        <div class="form-item">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div class="form-item">
                            <div class="checkbox">
                                <input type="checkbox" id="rememberMeCheckbox" checked>
                                <label for="rememberMeCheckbox" class="checkboxLabel">Remember me</label>
                            </div>
                        </div>
                        <button type="submit" name="submit">Se connecter</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
</body>
</html>