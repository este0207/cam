<?php
session_start();


if (!isset($_SESSION['user_name'])) {
    header("Location: index.php");
    exit();
}

$ticket_type = isset($_GET['ticket_type']) ? $_GET['ticket_type'] : '';

$ticket_code = strtoupper(uniqid('TICKET-', true));

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = "Voici votre billet !";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Billet - Parc de la Barben</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style-billetterie.css">
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
        <div class="user-dropdown">
            <span><?php echo $_SESSION['user_name']; ?></span>
            <div class="dropdown-content">
                <a href="logout.php">Se déconnecter</a>
            </div>
        </div>
    </header>

    <main>
        <h1>Confirmation d'Achat</h1>
        <p>Merci pour votre achat !</p>

        <div class="ticket">
            <div class="ticket-header">
                <img src="images_i/logoparc.png" alt="Logo du Parc" class="ticket-logo">
                <h2>Parc de la Barben</h2>
            </div>
            <div class="ticket-details">
                <p><strong>Nom :</strong> <?php echo $_SESSION['user_name']; ?></p>
                <p><strong>Type de billet :</strong> <?php echo ucfirst($ticket_type); ?></p>
                <p><strong>Code du billet :</strong> <?php echo $ticket_code; ?></p>
            </div>
            <div class="ticket-footer">
                <p>Présentez ce billet à l'entrée. Merci et profitez de votre visite !</p>
            </div>
        </div>

        <p><a href="billetterie.php" class="back-btn">Retour à la billetterie</a></p>
    </main>
</body>
</html>
