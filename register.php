<?php
session_start();
require 'config.php';

if (isset($_POST['submit'])) {
    try {
        $sql = "INSERT INTO users (lastname, firstname, email, password) 
                VALUES (?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $_POST['lastname'],
            $_POST['firstname'],
            $_POST['email'],
            password_hash($_POST['password'], PASSWORD_DEFAULT)
        ]);

        // Si l'insertion réussit, créer la session et rediriger
        $_SESSION['user_id'] = $conn->lastInsertId();
        $_SESSION['lastname'] = $_POST['lastname'];
        $_SESSION['firstname'] = $_POST['firstname'];
        $_SESSION['email'] = $_POST['email'];

        header('Location: index.php');
        exit();
        
    } catch (PDOException $e) {
        $message = "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style-register.css">
</head>
<body>
    <div class="wrapper">
        <div class="form-box register">
            <h2>Inscription</h2>
            
            <?php if (isset($message)): ?>
                <div class="message"><?php echo $message; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="input box">
                    <input type="text" name="lastname" required>
                    <label>Nom</label>
                </div>
                <div class="input box">
                    <input type="text" name="firstname" required>
                    <label>Prénom</label>
                </div>
                <div class="input box">
                    <input type="email" name="email" required>
                    <label>Email</label>
                </div>
                <div class="input box">
                    <input type="password" name="password" required>
                    <label>Mot de passe</label>
                </div>
                <button type="submit" name="submit" class="btnlog">S'inscrire</button>
            </form>
        </div>
    </div>
</body>
</html>