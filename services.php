<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user_name'] = $user['firstname'];
        header("Location: index.php");
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
    <title>Services - Parc de la Barben</title>
    <link rel="stylesheet" href="style-services.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
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

    <section class="services">
        <div class="container">
            <h1>Nos Services</h1>
            <p>Découvrez tous les services disponibles pour rendre votre visite mémorable.</p>
            <div class="service-grid">
                <div class="service-card">
                    <img src="images_i/restaurants.jpg" alt="Restaurants">
                    <h2>Restaurants</h2>
                    <p>Des repas variés pour tous les goûts et tous les âges.</p>
                </div>
                <div class="service-card">
                    <img src="images_i/parking.jpg" alt="Parking">
                    <h2>Parking</h2>
                    <p>Des parkings sécurisés pour tous nos visiteurs.</p>
                </div>
                <div class="service-card">
                    <img src="images_i/accessibility.jpg" alt="Accessibilité">
                    <h2>Accessibilité</h2>
                    <p>Un parc accessible pour tous, y compris les personnes à mobilité réduite.</p>
                </div>
                <div class="service-card">
                    <img src="images_i/Toilletes.jpg" alt="Toilletes">
                    <h2>Toilletes</h2>
                    <p>Des toilettes accessibles dans tout le parc.</p>
                </div>
                <div class="service-card">
                    <img src="images_i/point-eau.jpg" alt="Point d'eau">
                    <h2>Point d'eau</h2>
                    <p>Des points d'eau pour vous rafraîchir.</p>
                </div>
                <div class="service-card">
                    <img src="images_i/boutique.jpg" alt="Boutique">
                    <h2>Boutique</h2>
                    <p>Des souvenirs et produits exclusifs disponibles à la boutique.</p>
                </div>
                <div class="service-card">
                    <img src="images_i/train.jpg" alt="Trajet train">
                    <h2>Trajet train</h2>
                    <p>Un train pour explorer facilement le parc.</p>
                </div>
                <div class="service-card">
                    <img src="images_i/lodge.jpg" alt="Lodge">
                    <h2>Lodge</h2>
                    <p>Des hébergements confortables pour prolonger votre visite.</p>
                </div>
                <div class="service-card">
                    <img src="images_i/tente.jpg" alt="Tente pédagogique">
                    <h2>Tente pédagogique</h2>
                    <p>Des ateliers éducatifs pour tous les âges.</p>
                </div>
                <div class="service-card">
                    <img src="images_i/paillote.jpg" alt="Paillote">
                    <h2>Paillote</h2>
                    <p>Un espace de détente avec restauration rapide.</p>
                </div>
                <div class="service-card">
                    <img src="images_i/cafe.jpg" alt="Petit Café">
                    <h2>Petit Café</h2>
                    <p>Un endroit chaleureux pour déguster une boisson chaude.</p>
                </div>
                <div class="service-card">
                    <img src="images_i/jeux.jpg" alt="Plateau des jeux">
                    <h2>Plateau des jeux</h2>
                    <p>Des espaces de jeux pour divertir les enfants.</p>
                </div>
                <div class="service-card">
                    <img src="images_i/pique-nique.jpg" alt="Espace Pique-nique">
                    <h2>Espace Pique-nique</h2>
                    <p>Un espace ombragé pour partager un repas en plein air.</p>
                </div>
            </div>
        </div>
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