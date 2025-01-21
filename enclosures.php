<?php 
session_start();
include 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    if ($result->rowCount() > 0) {
        $user = $result->fetch(PDO::FETCH_ASSOC);
        $_SESSION['user_name'] = $user['firstname'];
        $_SESSION['user_id'] = $user['id']; 
        header("Location: index.php");
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}

if (isset($_GET['id'])) {
    $enclosure_id = $_GET['id'];
    $sql_enclosure = "SELECT * FROM enclosures WHERE id = $enclosure_id";
    $result_enclosure = $conn->query($sql_enclosure);
    $enclosure = $result_enclosure->fetch(PDO::FETCH_ASSOC);
    
    $sql_animals = "SELECT animals.name FROM animals 
                    JOIN relation_enclos_animals ON animals.id = relation_enclos_animals.id_animal 
                    WHERE relation_enclos_animals.id_enclos = $enclosure_id";
    $result_animals = $conn->query($sql_animals);
    $animals = [];
    while ($row = $result_animals->fetch(PDO::FETCH_ASSOC)) {
        $animals[] = $row['name'];
    }
    $biome_folder = "biomes/enclosure_$enclosure_id/";
    $biome_images = is_dir($biome_folder) ? array_diff(scandir($biome_folder), array('..', '.')) : [];
} else {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['review_submit'])) {
    if (isset($_SESSION['user_id'])) { 
        $user_id = $_SESSION['user_id']; 
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];
        if (empty($rating) || empty($comment)) {
            $error_review = "Tous les champs doivent être remplis.";
        } else {
            $sql_review = "INSERT INTO reviews (id_users, id_enclos, rating, comment) 
                           VALUES ($user_id, $enclosure_id, $rating, '$comment')";
            if ($conn->query($sql_review)) {
                $message_review = "Votre avis a été ajouté avec succès !";
            } else {
                $error_review = "Erreur lors de l'ajout de votre avis.";
            }
        }
    } else {
        $error_review = "Vous devez être connecté pour laisser un avis.";
    }
}

$enclosure_id = $_GET['id'];

$sql_reviews = "SELECT users.firstname, reviews.rating, reviews.comment
                FROM reviews 
                JOIN users ON reviews.id_users = users.id 
                WHERE reviews.id_enclos = $enclosure_id
                ORDER BY reviews.id DESC";
$result_reviews = $conn->query($sql_reviews);

$reviews = [];
while ($row = $result_reviews->fetch(PDO::FETCH_ASSOC)) {
    $reviews[] = $row;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parc de la Barben</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style-enclosures.css">
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

    <section class="enclosure-details">
        <h1>Enclos -  <?php foreach ($animals as $animal): ?><?php echo htmlspecialchars($animal); ?> , <?php endforeach; ?></h1>

        <div class="carousel">
            <div class="carousel-images">
                <?php foreach ($biome_images as $index => $image): ?>
                    <img class="carousel-image" id="i<?php echo $index + 1; ?>" src="<?php echo $biome_folder . $image; ?>" alt="Image du Biome">
                <?php endforeach; ?>
            </div>
        </div>

        <div class="carousel-nav">
            <?php foreach ($biome_images as $index => $image): ?>
                <a href="#i<?php echo $index + 1; ?>"></a>
            <?php endforeach; ?>
        </div>
        <button class="carousel-arrow carousel-prev"><ion-icon name="chevron-back-outline"></ion-icon></button>
        <button class="carousel-arrow carousel-next"><ion-icon name="chevron-forward-outline"></ion-icon></button>  
        <div class="enclosure-info">
            <h2>Heure des Repas : </h2>
            <p><?php echo htmlspecialchars($enclosure['meal']); ?></p>
        </div>
    </section>

    <section class="leave-review">
        <h2>Laisser un avis</h2>

        <?php if (isset($_SESSION['user_name'])): ?>
            <form action="enclosures.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <div>
                    <label for="rating">Note (1 à 5) :</label>
                    <input type="number" name="rating" id="rating" min="1" max="5" required>
                </div>
                <div>
                    <label for="comment">Commentaire :</label>
                    <textarea name="comment" id="comment" required></textarea>
                </div>
                <button type="submit" name="review_submit">Soumettre l'avis</button>
            </form>

            <?php if (isset($message_review)): ?>
                <div class="success"><?php echo $message_review; ?></div>
            <?php elseif (isset($error_review)): ?>
                <div class="error"><?php echo $error_review; ?></div>
            <?php endif; ?>
        <?php else: ?>
            <p>Vous devez être connecté pour laisser un avis.</p>
        <?php endif; ?>
    </section>

    <section class="reviews">
        <h2>Avis sur cet enclos :</h2>
        <?php if (count($reviews) > 0): ?>
            <ul>
                <?php foreach ($reviews as $review): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($review['firstname']); ?></strong> 
                        (Note: <?php echo $review['rating']; ?>/5)
                        <p><?php echo nl2br(htmlspecialchars($review['comment'])); ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun avis pour cet enclos pour le moment.</p>
        <?php endif; ?>
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
