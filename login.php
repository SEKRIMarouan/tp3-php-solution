<?php
/*
 * Auteur   : Sekri Marouan
 * Objectif : Exercices 6.1 et 6.2 : formulaire de connexion (login) avec
 *            session, redirection vers profil.php et cookies
 * Date     : 18/10/2026
 */

session_start();

require 'config.php';

// Exercice 6.1
if (isset($_POST['login']) && !empty($_POST['login'])) {
    $login = $_POST['login'];

    $_SESSION['login'] = $login;

    // Exercice 6.2.1
    setcookie("dernier_login", $login, time() + 86400, "/");

    // Exercice 6.2.3
    $infos = ["login" => $login, "date" => date("d/m/Y H:i:s")];
    setcookie("derniere_connexion", json_encode($infos), time() + 86400, "/");

    header("Location: profil.php");
    exit;
}

// Exercice 6.2.2
$valeur = "";
if (isset($_COOKIE['dernier_login'])) {
    $valeur = htmlspecialchars($_COOKIE['dernier_login']);
}

/*
 * Questions de l'exercice 6.2 :
 *  - Où est stockée une session ? Où est stocké un cookie ?
 *    Une session est stockée côté serveur (le navigateur ne garde que
 *    l'identifiant de session). Un cookie est stocké côté client, dans le
 *    navigateur.
 *  - Pourquoi setcookie() et header() doivent-ils être appelés avant tout
 *    affichage ?
 *    Les cookies et la redirection font partie des en-têtes HTTP. Les
 *    en-têtes sont envoyés avant le contenu de la page : dès que du texte
 *    ou du HTML est affiché, ils sont déjà partis et ne peuvent plus être
 *    modifiés (même raison pour session_start() en première instruction).
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
<?php
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';
?>
<h2>Connexion</h2>
<?php
if (isset($_COOKIE['derniere_connexion'])) {
    $derniere = json_decode($_COOKIE['derniere_connexion'], true);
    echo '<p>Dernière connexion : ' . htmlspecialchars($derniere['login']) . ' le ' . htmlspecialchars($derniere['date']) . '</p>';
}
?>
<form action="login.php" method="post">
    <p>Login : <input type="text" name="login" value="<?php echo $valeur; ?>" /></p>
    <p><input type="submit" value="Se connecter"></p>
</form>
<?php include 'includes/pied_inc.php'; ?>
</body>
</html>
