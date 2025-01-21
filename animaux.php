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
        header("Location: index.php");
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}

// Structure des biomes
$biomes = [
    1 => [
        'id' => 1,
        'name' => 'Savane',
        'color' => '#F4A460'
    ],
    2 => [
        'id' => 2,
        'name' => 'Forêt Tropicale',
        'color' => '#228B22'
    ],
    3 => [
        'id' => 3,
        'name' => 'Désert',
        'color' => '#DEB887'
    ],
    4 => [
        'id' => 4,
        'name' => 'Montagne',
        'color' => '#808080'
    ]
];

// Récupération des enclos
$enclosures = [];
$sql_enclosures = "SELECT e.* FROM enclosures e";
$stmt_enclosures = $conn->query($sql_enclosures);
while ($row = $stmt_enclosures->fetch(PDO::FETCH_ASSOC)) {
    $biome_id = ($row['id'] % 4) + 1;
    if (!isset($enclosures[$biome_id])) {
        $enclosures[$biome_id] = [];
    }
    
    // Vérification des images disponibles
    $baseImagePath = "images_i/biomes/enclosure_" . $row['id'] . "/";
    for ($i = 1; $i <= 4; $i++) {
        $imagePath = $baseImagePath . "i" . $i . ".jpg";
        if (file_exists($imagePath)) {
            // Si l'image existe, on utilise la première trouvée
            $row['images'] = $imagePath;
            break;
        }
    }
    
    $enclosures[$biome_id][] = $row;
}

// Récupération des animaux
$animals = [];
$sql_animals = "SELECT a.name, rea.id_enclos 
                FROM animals a
                JOIN relation_enclos_animals rea ON a.id = rea.id_animal";
$stmt_animals = $conn->query($sql_animals);
while ($animal = $stmt_animals->fetch(PDO::FETCH_ASSOC)) {
    if (!isset($animals[$animal['id_enclos']])) {
        $animals[$animal['id_enclos']] = [];
    }
    $animals[$animal['id_enclos']][] = $animal['name'];
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parc de la Barben</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style-animaux.css">
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

<section class="hero-section">
        <div class="hero-text">
            <h1>Animaux</h1>
            <h2>ILS VOUS ATTENDENT</h2>
        </div>
    </section>

    <h1>Les Biomes</h1>
    <?php foreach ($biomes as $biome): ?>
        <section class="biome" style="background-color: <?php echo htmlspecialchars($biome['color']); ?>;">
            <h2><?php echo htmlspecialchars($biome['name']); ?></h2>
            <div class="enclosures">
                <?php 
                if (isset($enclosures[$biome['id']])) {
                    foreach ($enclosures[$biome['id']] as $enclosure): ?>
                        <div class="enclosure">
                            <a href="enclosures.php?id=<?php echo $enclosure['id']; ?>">
                            <div class="image-container">
                                <img src="<?php echo $enclosure['images']; ?>" alt="Enclos <?php echo $enclosure['id']; ?>">
                                <div class="animals-list">
                                    <?php 
                                    if (isset($animals[$enclosure['id']])) {
                                        foreach ($animals[$enclosure['id']] as $animal_name): ?>
                                            <p class="animal-name" ><?php echo htmlspecialchars($animal_name); ?></p>
                                        <?php endforeach;
                                    }
                                    ?>
                                </div>
                            </div>
                        </a>    
                        </div>
                    <?php endforeach;
                } ?>
            </div>
        </section>
    <?php endforeach; ?>


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
