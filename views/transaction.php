<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Transactions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <header>
        <h1>Transactions</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <?php if (isset($_SESSION['utilisateur'])): ?>
                <a href="transactions/creer.php">Créer une Transaction</a>
                <a href="deconnexion.php">Déconnexion</a>
            <?php endif; ?>
        </nav>
    </header>

    <?php if (!empty($_SESSION['alerte'])): ?>
        <p><?= $_SESSION['alerte']; ?></p>
        <?php $_SESSION['alerte'] = ''; ?>
    <?php endif; ?>

    <section>
        <?php if ($transactionSeule != null): ?>
            <article>
                <hr>
                <p><?= date("d/m/Y H:i:s", strtotime($transactionSeule["date_modif"])) ?></p>
                <h2><?= htmlspecialchars($transactionSeule["titre"]) ?></h2>
                <p>Par <?= htmlspecialchars($transactionSeule["nom_utilisateur"]) ?></p>
                <p>Montant : <?= htmlspecialchars($transactionSeule["montant"]) ?></p>
            </article>
        <?php elseif (!empty($toutesTransactions)): ?>
            <?php foreach ($toutesTransactions as $transaction): ?>
                <article>
                    <hr>
                    <p><?= date("d/m/Y H:i:s", strtotime($transaction["date_modif"])) ?></p>
                    <h2><?= htmlspecialchars($transaction["titre"]) ?></h2>
                    <p>Par <?= htmlspecialchars($transaction["nom_utilisateur"]) ?></p>
                    <p>Montant : <?= htmlspecialchars($transaction["montant"]) ?></p>
                    <a href="transactions/modifier.php?id=<?= $transaction["id"] ?>">Modifier</a>
                    <a href="transactions/supprimer.php?id=<?= $transaction["id"] ?>">Supprimer</a>
                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Aucune transaction pour le moment.</p>
        <?php endif; ?>
    </section>
</body>
</html>
