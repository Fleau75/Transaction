<?php
// Vérification de l'ID valide dans la requête
if (isset($_GET['id_article']) && is_numeric($_GET['id_article'])) {
    // Connexion à la base de données
    $baseDeDonnees = new PDO('mysql:host=localhost;dbname=evaldev2;charset=utf8', 'root', 'root');
    $requeteArticle = 'SELECT p.titre, p.contenu, p.derniere_modif, u.nom_utilisateur 
                       FROM articles p 
                       JOIN utilisateurs u ON p.id_auteur = u.id 
                       WHERE p.id = :id';

    $stmt = $baseDeDonnees->prepare($requeteArticle);
    $stmt->bindValue(':id', $_GET['id_article'], PDO::PARAM_INT);
    $stmt->execute();

    // Récupération de l'article s'il est disponible
    if ($stmt->rowCount() > 0) {
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        $_SESSION['retour'] = '<p>ID d\'article invalide.</p>';
    }
} else {
    $_SESSION['retour'] = '<p>ID de l\'article requis.</p>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Chercheur d'Articles</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Recherche d'un Article</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <?php if (empty($_SESSION['utilisateur_actuel'])): ?>
                <a href="connexion.php">Connexion</a>
                <a href="inscription.php">Inscription</a>
            <?php else: ?>
                <a href="profil.php">Mon Profil</a>
                <a href="deconnexion.php">Déconnexion</a>
            <?php endif; ?>
        </nav>
    </header>

    <?= $_SESSION['retour'] ?? ''; $_SESSION['retour'] = ''; ?>
    
    <main>
        <form method="get">
            <label for="id_article">Sélectionnez un Article par ID :</label>
            <input type="number" name="id_article" id="id_article">
            <button type="submit">Voir l'Article</button>
        </form>

        <?php if (!empty($article)): ?>
            <article>
                <p>Publié le : <?= date('d/m/Y H:i', strtotime($article['derniere_modif'])) ?></p>
                <h2><?= htmlspecialchars($article['titre']) ?></h2>
                <p>Par <?= htmlspecialchars($article['nom_utilisateur']) ?></p>
                <div><?= nl2br(htmlspecialchars($article['contenu'])) ?></div>
            </article>
        <?php endif; ?>
    </main>
</body>
</html>
