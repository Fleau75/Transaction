<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Transaction</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <header>
        <h1>Modification de Transaction</h1>
        <nav>
            <a href="../index.php">Accueil</a>
            <a href="../transactions/liste.php">Mes Transactions</a>
        </nav>
    </header>

    <?php if (!empty($_SESSION['alerte'])): ?>
        <p><?= $_SESSION['alerte']; ?></p>
        <?php $_SESSION['alerte'] = ''; ?>
    <?php endif; ?>

    <section>
        <form action="traitement_modification.php" method="post">
            <fieldset>
                <legend>Détails de la Transaction</legend>

                <div>
                    <label for="etiquette">Libellé :</label>
                    <input type="text" name="etiquette" id="etiquette" value="<?= htmlspecialchars($transactionEnBdd['label']); ?>">
                </div>

                <div>
                    <label for="montant">Montant :</label>
                    <input type="number" name="montant" id="montant" value="<?= htmlspecialchars($transactionEnBdd['amount']); ?>">
                </div>

                <input type="hidden" name="id" value="<?= htmlspecialchars($_GET['id']); ?>">

                <button type="submit">Modifier</button>
            </fieldset>
        </form>
    </section>
</body>
</html>
