<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <header>
        <h1>Bienvenue</h1>
        <nav>
            <?php if (!isset($_SESSION['utilisateur'])): ?>
                <a href="connexion.php">Connexion</a>
                <a href="inscription.php">Inscription</a>
            <?php else: ?>
                <a href="transactions.php">Mes Transactions</a>
                <a href="deconnexion.php">Déconnexion</a>
            <?php endif; ?>
        </nav>
    </header>

    <section>
        <?php
        echo !empty($_SESSION['message']) ? $_SESSION['message'] : '';
        $_SESSION['message'] = '';
        ?>
    </section>
</body>
</html>
