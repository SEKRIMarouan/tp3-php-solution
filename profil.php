<?php
/*
 * Auteur   : Sekri Marouan
 * Objectif : Exercices 6.1 et 6.3 : page protégée par la session (bienvenue,
 *            lien de déconnexion) et validation d'une date avec checkdate()
 * Date     : 18/10/2026
 */

session_start();

require 'config.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil</title>
</head>
<body>
<?php
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';
?>
<h2>Profil</h2>
<p>Bienvenue <?php echo htmlspecialchars($_SESSION['login']); ?> !</p>
<p><a href="deconnexion.php">Se déconnecter</a></p>

<h3>Exercice 6.3.3 : validation d'une date (checkdate)</h3>
<form action="profil.php" method="get">
    <p>Jour : <input type="text" name="jour" size="2" />
       Mois : <input type="text" name="mois" size="2" />
       Année : <input type="text" name="annee" size="4" />
       <input type="submit" value="Valider la date"></p>
</form>
<?php
if (isset($_GET['jour']) && isset($_GET['mois']) && isset($_GET['annee'])) {
    $jour = (int) $_GET['jour'];
    $mois = (int) $_GET['mois'];
    $annee = (int) $_GET['annee'];

    if (checkdate($mois, $jour, $annee)) {
        echo '<p style="color: green;">La date ' . $jour . '/' . $mois . '/' . $annee . ' est valide.</p>';
    } else {
        echo '<p style="color: red;">La date ' . $jour . '/' . $mois . '/' . $annee . ' n\'est pas valide.</p>';
    }
}
?>
<?php include 'includes/pied_inc.php'; ?>
</body>
</html>
