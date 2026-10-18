<?php
/*
 * Auteur   : Sekri Marouan
 * Objectif : Exercice 4.2 : traiter le formulaire info.html (données GET)
 *            et afficher « Bonjour Monsieur/Madame » suivi du prénom et du nom
 * Date     : 18/10/2026
 */

require 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultat du formulaire GET</title>
</head>
<body>
<?php
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';
?>
<h2>Résultat</h2>
<?php
if (isset($_GET['nom']) && isset($_GET['prenom']) && isset($_GET['sexe'])) {
    $nom = htmlspecialchars($_GET['nom']);
    $prenom = htmlspecialchars($_GET['prenom']);

    if ($_GET['sexe'] == 'M') {
        echo '<p>Bonjour Monsieur ' . $prenom . ' ' . $nom . '</p>';
    } elseif ($_GET['sexe'] == 'F') {
        echo '<p>Bonjour Madame ' . $prenom . ' ' . $nom . '</p>';
    } else {
        echo '<p>Bonjour ' . $prenom . ' ' . $nom . '</p>';
    }
} else {
    echo '<p>Aucune donnée reçue. <a href="info.html">Retour au formulaire</a></p>';
}

/*
 * 3. Observation de l'URL après l'envoi :
 *    Les données sont visibles dans la barre d'adresse, par exemple :
 *    http://localhost:8000/info.php?nom=Sekri&prenom=Marouan&sexe=M
 *    Elles sont placées après le ? et séparées par le symbole &.
 */
?>
<?php include 'includes/pied_inc.php'; ?>
</body>
</html>
