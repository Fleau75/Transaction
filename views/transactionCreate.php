<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Transaction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <header>
        <h1>Création de Transaction</h1>
        <nav>
            <a href="../index.php">Accueil</a>
            <a href="../transactions/liste.php">Mes Transactions</a>
        </nav>
    </header>

    <?php if (!empty($_SESSION['notification'])): ?>
        <p><?= $_SESSION['notification']; ?></p>
        <?php $_SESSION['notification'] = ''; ?>
    <?php endif; ?>

    <section>
        <form action="traitement_creation.php" method="post">
            <fieldset>
                <legend>Saisissez les Détails de la Transaction</legend>

                <div>
                    <label for="etiquette">Libellé :</label>
                    <input type="text" name="etiquette" id="etiquette" value="<?= isset($_POST['etiquette']) ? htmlspecialchars($_POST['etiquette']) : ''; ?>">
                </div>

                <div>
                    <label for="montant">Montant :</label>
                    <input type="number" name="montant" id="montant" value="<?= isset($_POST['montant']) ? htmlspecialchars($_POST['montant']) : ''; ?>">
                </div>

                <button type="submit">Créer</button>
            </fieldset>
        </form>
    </section>
</body>
</html>
