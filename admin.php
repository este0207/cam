<?php
session_start();
include 'config.php';

if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    header("Location: index.php");
    exit();
}

$message = $error = '';
$message_meal = $error_meal = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['meal_submit'])) {
    $enclosureId = $_POST['id'];
    $mealTime = $_POST['meal'];

    if ($enclosureId && $mealTime) {
        try {
            $sqlQuery = 'UPDATE enclosures SET meal = ? WHERE id = ?';
            $stmt = $conn->prepare($sqlQuery);
            $stmt->execute([$mealTime, $enclosureId]);
            $message_meal = "L'heure des repas a été mise à jour avec succès.";
        } catch (PDOException $e) {
            $error_meal = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    } else {
        $error_meal = "Veuillez entrer un ID valide et une heure de repas.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_enclosure'])) {
    $enclosureId = $_POST['id'];
    $isInMaintenance = isset($_POST['in_maintenance']) ? 1 : 0;  
    
    if ($enclosureId) {
        try {
            $sqlQuery = 'UPDATE enclosures SET maintenance = :maintenance WHERE id = :id';
            $stmt = $conn->prepare($sqlQuery);
            $stmt->execute([
                'maintenance' => $isInMaintenance, 
                'id' => $enclosureId
            ]);
            $message = "L'enclos a été mis à jour avec succès.";
        } catch (PDOException $e) {
            $error = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    } else {
        $error = "Veuillez entrer un ID valide.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau Administrateur</title>
    <link rel="stylesheet" href="style-admin.css">
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
    </header>

    <section>
        <h2>Gestion des paramètres</h2>
        <p>Vous pouvez ici gérer les horaires des repas et autres paramètres du site.</p>

        <form action="" method="POST">
            <div>
                <label>ID de l'enclos :</label>
                <input name="id" id="id" min="1" required>
            </div>
            <div>
                <label>Nouvelle heure des repas :</label>
                <input name="meal" id="meal" required>
            </div>
            <button type="submit" name="meal_submit">Mettre à jour</button>
        </form>

        <?php if ($message_meal): ?>
            <div class="success"><?php echo htmlspecialchars($message_meal); ?></div>
        <?php elseif ($error_meal): ?>
            <div class="error"><?php echo htmlspecialchars($error_meal); ?></div>
        <?php endif; ?>

    </section>

    <section>
        <h2>Mettre un Enclos en Travaux</h2>

        <form action="" method="POST">
            <div>
                <label>ID de l'enclos :</label>
                <input name="id" id="id" min="1" required>
            </div>
            <div>
                <label>Mettre en travaux :</label>
                <input type="checkbox" name="in_maintenance" id="in_maintenance" value="1">
            </div>
            <button type="submit" name="update_enclosure">Mettre à jour</button>
        </form>

        <?php if ($message): ?>
            <div class="success"><?php echo htmlspecialchars($message); ?></div>
        <?php elseif ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
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
