<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <header>
        <h1>Page de Connexion</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="inscription.php">Inscription</a>
        </nav>
    </header>

    <?php if (!empty($_SESSION['info'])): ?>
        <p><?php echo $_SESSION['info']; ?></p>
        <?php $_SESSION['info'] = ''; ?>
    <?php endif; ?>

    <section>
        <form action="traitement_connexion.php" method="post">
            <fieldset>
                <legend>Identifiez-vous</legend>
                
                <div>
                    <label for="email">E-mail :</label>
                    <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <div>
                    <label for="motdepasse">Mot de Passe (8 caractères minimum) :</label>
                    <input type="password" name="motdepasse" id="motdepasse">
                </div>

                <button type="submit">Se connecter</button>
            </fieldset>
        </form>
    </section>
</body>
</html>
