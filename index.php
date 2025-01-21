<?php  
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = :email AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email, 'password' => $password]);

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_name'] = $user['firstname'];
        $_SESSION['user_id'] = $user['id'];

        if ($email === 'admin@gmail.com') {
            $_SESSION['is_admin'] = true;
            header("Location: admin.php");
        } else {
            $_SESSION['is_admin'] = false;
            header("Location: index.php");
        }
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parc de la Barben</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    
<header>
        <img class="logo" src="images_i/logoparc.png" alt="Logo du Parc">
        <nav class="nav">
            <a href="index.php">Accueil</a>
            <a href="billetterie.php">Billetterie</a>
            <a href="animaux.php">Animaux</a>
            <a href="services.php">Services</a>
        </nav>
        <?php if (isset($_SESSION['user_name'])): ?>
            <div class="user-dropdown">
                <span><?php echo $_SESSION['user_name']; ?></span>
                <div class="dropdown-content">
                    <a href="logout.php">Se déconnecter</a>
                </div>
            </div>
        <?php else: ?>
            <button class="btnlogin"><ion-icon name="person"></ion-icon></button>
        <?php endif; ?>
    </header>

    
<div class="wrapper hidden" id="popup">
    <span class="icon-close"><ion-icon name="close"></ion-icon></span>
    <div class="form-box login">
        <h2>Connexion</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="index.php" method="POST">
            <div class="input box">
                <span class="icon"><ion-icon name="mail"></ion-icon></span>
                <input type="email" name="email" required>
                <label>Email</label>
            </div>
            <div class="input box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="password" required>
                <label>Mot de Passe</label>
            </div>
            <div class="remember-forgot">
                <a href="#forgot-pass">Mot de Passe oublié</a>
            </div>
            <button type="submit" class="btnlog">Se connecter</button>
            <div class="login-register">
                <p>Vous n’avez pas de compte ? <a href="register.php" class="register-link">Inscrivez-vous</a></p>
            </div>
        </form>
    </div>
</div>

<section class='log'>
    <?php if (isset($_SESSION['user_name'])): ?>*
        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
            <h1>Bienvenue Administrateur</h1>
            <p>Vous pouvez modifier les paramètres du site <a href="admin.php">ici.</a></p>
        <?php else: ?>
            <h1>Bienvenue <?php echo $_SESSION['user_name']; ?></h1>
        <?php endif; ?> 
    <?php else: ?>
        <h1>Bienvenue au Parc de la Barben</h1>
    <?php endif; ?> 
</section>




    <section class="container">
        <div class="slider-wrapper">
            <div class="slider">
                <img id="tigre" src="images_i/tigre.jpg" alt="Tigre">
                <img id="girafe" src="images_i/girafe.jpg" alt="Girafe">
                <img id="panda-roux" src="images_i/panda-roux.jpg" alt="Panda Roux">
                <img id="ara" src="images_i/ara.jpg" alt="Ara">
            </div>
            <div class="slider-nav">
                <a href="#tigre"></a>
                <a href="#girafe"></a>
                <a href="#panda-roux"></a>
                <a href="#ara"></a>
            </div>
            <button class="slider-arrow slider-prev"><ion-icon name="chevron-back-outline"></ion-icon></button>
            <button class="slider-arrow slider-next"><ion-icon name="chevron-forward-outline"></ion-icon></button>  
        </div>
    </section>

    
    <section class="parc-plan">
        <h2>Bienvenue au Parc Animalier de la Barben !</h2>
        <h3>Le parc est ouvert tous les jours, y compris les jours fériés.</h3>
        <p>Au cœur de la Provence et d’un site Natura 2000, le Parc animalier de La Barben est une invitation à l’évasion.
        9 km de sentiers vous guident à la rencontre de 130 espèces différentes, à l’ombre des chênes.</p>
        <h2>Plan du Parc</h2>
        <img src="images_i/zoo-map.jpg" alt="Plan du Parc" class="plan-image">
    </section>

    
<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <img src="images_i/logoparc.png" alt="Logo">
        </div>
        <div class="footer-contact">
            <h3>Contact</h3>
            <ul>
                <li><a href="#">Nous contacter</a></li>
                <li><a href="#">Mentions légales</a></li>
                <li><a href="#">Conditions d’utilisation</a></li>
                <li><a href="gps.html">Plan du site</a></li>
            </ul>
        </div>
        <div class="footer-search">
            <form action="search.php" method="GET">
                <input type="text" name="query" placeholder="Rechercher un animal">
                <button type="submit"><ion-icon name="search"></ion-icon></button>
            </form>
        </div>
    </div>
</footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
