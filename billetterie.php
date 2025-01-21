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
    <title>Billetterie - Parc de la Barben</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style-billetterie.css">
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

<main>
    <h1>Billetterie</h1>
    <p>Choisissez le billet qui vous convient et profitez d'une journée inoubliable au Parc de la Barben !</p>

    <div class="ticket-grid">
        <div class="ticket-card">
            <img src="images_i/individual.jpg" alt="Photo du billet individuel" style="width:100%; height:auto; border-radius:10px;">
            <h2>Billet Individuel</h2>
            <p>Accès à tout le parc pour une personne.</p>
            <p class="price">Prix : 20€</p>
            <a href="ticket.php?ticket_type=individual" class="buy-btn">Acheter</a>
        </div>

        <div class="ticket-card">
            <img src="images_i/family.jpg" alt="Photo du pack familial" style="width:100%; height:auto; border-radius:10px;">
            <h2>Pack Familial</h2>
            <p>Accès pour 2 adultes et 2 enfants. Idéal pour passer une journée en famille !</p>
            <p class="price">Prix : 60€</p>
            <a href="ticket.php?ticket_type=family" class="buy-btn">Acheter</a>
        </div>

        <div class="ticket-card">
            <img src="images_i/student.jpg" alt="Photo du pack étudiant" style="width:100%; height:auto; border-radius:10px;">
            <h2>Pack Étudiant</h2>
            <p>Tarif réduit pour les étudiants (sur présentation d'une carte étudiant valide).</p>
            <p class="price">Prix : 15€</p>
            <a href="ticket.php?ticket_type=student" class="buy-btn">Acheter</a>
        </div>

        <div class="info-section">
            <h2>Informations Complémentaires</h2>
            <ul>
                <li>Les enfants de moins de 3 ans entrent gratuitement.</li>
                <li>Les billets ne sont pas remboursables.</li>
                <li>Les packs familiaux incluent un accès aux animations spéciales.</li>
                <li>Des tarifs de groupe sont disponibles pour les groupes de 10 personnes ou plus. Contactez-nous pour plus d'informations.</li>
            </ul>
        </div>
    </main>

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
