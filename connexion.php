<?php
session_start(); // Démarre la session PHP

// Inclure le fichier de connexion
include "connec.php";

$pdo = new \PDO(DSN, USER, PASS);

// Vérifie si le formulaire de connexion a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Requête SQL pour récupérer les informations de l'administrateur
    $adminSql = "SELECT * FROM admin WHERE email = :email";
    $adminStmt = $pdo->prepare($adminSql);
    $adminStmt->bindValue(':email', $email, \PDO::PARAM_STR);
    $adminStmt->execute();
    $admin = $adminStmt->fetch(PDO::FETCH_ASSOC);

    // Vérifie si l'administrateur existe et si le mot de passe est correct
    if ($admin && $password == $admin['password']) {
        // Stocke l'identifiant et l'email de l'administrateur dans la session
        $_SESSION['id'] = $admin['idadmin'];
        $_SESSION['login_admin'] = $admin['email']; 

        // Redirige l'administrateur vers la page d'accueil de l'administration
        header("Location: accueil.php");
        exit;
    }

    // Requête SQL pour récupérer les informations du client
    $clientSql = "SELECT * FROM client WHERE email = :email";
    $clientStmt = $pdo->prepare($clientSql);
    $clientStmt->bindValue(':email', $email, \PDO::PARAM_STR);
    $clientStmt->execute();
    $client = $clientStmt->fetch(PDO::FETCH_ASSOC);

    // Vérifie si le client existe et si le mot de passe est correct
    if ($client && $password == $client['password']) {
        // Stocke l'identifiant et l'email du client dans la session
        $_SESSION['id'] = $client['idclient'];
        $_SESSION['login'] = $client['email']; 

        // Redirige le client vers la page d'accueil des clients
        header("Location: accueil.php");
        exit;
    }

    // Si ni l'administrateur ni le client n'ont été trouvés ou si le mot de passe est incorrect
    $errorMessage = "Adresse e-mail ou mot de passe incorrect.";
}
?>

<!-- Formulaire de connexion -->
<form action="connexion.php" method="POST">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@example.com">
        <div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>

<?php
// Afficher un message d'erreur si nécessaire
if (isset($errorMessage)) {
    echo "<p>$errorMessage</p>";
}
?>