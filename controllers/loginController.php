<?php

require_once "../modeles/Utilisateur.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $motDePasse = $_POST['motDePasse'] ?? '';

    if (!empty($email) && !empty($motDePasse)) {
        $utilisateurEnBdd = trouverUtilisateurParEmail($email);

        if ($utilisateurEnBdd !== null) {
            if (password_verify($motDePasse, $utilisateurEnBdd['mot_de_passe'])) {
                $_SESSION['utilisateur'] = $utilisateurEnBdd;
                header('Location: accueil.php');
                exit();
            } else {
                $_SESSION['alerte'] .= "<p>L'email ou le mot de passe est incorrect</p>";
            }
        } else {
            $_SESSION['alerte'] .= "<p>Cet utilisateur n'existe pas</p>";
        }
    } else {
        $_SESSION['alerte'] .= "<p>Veuillez saisir un email et un mot de passe</p>";
    }
}

require_once "../vues/connexion.php";

?>
