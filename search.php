<?php
session_start();
include 'config.php'; 

$message = '';
$animals = [];

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    $stmt = $conn->prepare("SELECT animals.id AS animal_id, animals.name, relation_enclos_animals.id_enclos
                            FROM animals
                            JOIN relation_enclos_animals ON animals.id = relation_enclos_animals.id_animal
                            WHERE animals.name LIKE :query");
    
    $stmt->bindValue(':query', '%' . $query . '%', PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $message = "Aucun animal trouvé pour \"$query\".";
    }
} else {
    $message = "Veuillez entrer un nom d'animal pour la recherche.";
}

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de la recherche</title>
    <link rel="stylesheet" href="style-search.css">
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

    <h1>Résultats de la recherche</h1>
    <section class="search-results">
        <?php if (!empty($animals)): ?>
            <h2>Animaux trouvés :</h2>
            <ul>
                <?php foreach ($animals as $animal): ?>
                    <li>
                        <a href="enclosures.php?id=<?php echo $animal['id_enclos']; ?>">
                            <?php echo htmlspecialchars($animal['name']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p><?php echo $message; ?></p>
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
                    <input type="text" name="query" placeholder="Rechercher un animal" value="<?php echo isset($query) ? htmlspecialchars($query) : ''; ?>">
                    <button type="submit"><ion-icon name="search"></ion-icon></button>
                </form>
            </div>
        </div>
    </footer>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
