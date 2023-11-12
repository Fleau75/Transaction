<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <header>
        <h1>Inscription</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="connexion.php">Connexion</a>
        </nav>
    </header>

    <?php if (isset($_SESSION['notification'])): ?>
        <p><?= $_SESSION['notification']; ?></p>
        <?php $_SESSION['notification'] = ''; ?>
    <?php endif; ?>

    <section>
        <form action="traitement_inscription.php" method="post">
            <fieldset>
                <legend>Créez votre compte</legend>
                
                <div>
                    <label for="nomUtilisateur">Nom d'utilisateur :</label>
                    <input type="text" name="nomUtilisateur" id="nomUtilisateur" value="<?= isset($_POST['nomUtilisateur']) ? htmlspecialchars($_POST['nomUtilisateur']) : ''; ?>">
                </div>

                <div>
                    <label for="email">E-mail :</label>
                    <input type="email" name="email" id="email" value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                </div>

                <div>
                    <label for="motDePasse">Mot de passe (8 caractères minimum) :</label>
                    <input type="password" name="motDePasse" id="motDePasse">
                </div>

                <button type="submit">S'inscrire</button>
            </fieldset>
        </form>
    </section>
</body>
</html>
