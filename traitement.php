<?php
/*
 * Auteur   : Sekri Marouan
 * Objectif : Exercices 4.3 et 5.1 : valider les données du formulaire saisie.html
 *            (POST), afficher un récapitulatif et ajouter l'apprenant dans
 *            data/notes.csv
 * Date     : 18/10/2026
 */

require 'config.php';

$erreur = "";
$nom = "";
$info = 0;
$math = 0;

// Exercice 4.3 : validation
if (!isset($_POST['nom']) || !isset($_POST['note_info']) || !isset($_POST['note_math'])) {
    $erreur = "Le formulaire n'a pas été envoyé correctement.";
} else {
    $nom = trim($_POST['nom']);
    $info = $_POST['note_info'];
    $math = $_POST['note_math'];

    if (empty($nom)) {
        $erreur = "Le nom est obligatoire.";
    } elseif ((float) $info != $info || (float) $math != $math) {
        $erreur = "Les notes doivent être des nombres.";
    } elseif ($info < NOTE_MIN || $info > NOTE_MAX || $math < NOTE_MIN || $math > NOTE_MAX) {
        $erreur = "Les notes doivent être comprises entre " . NOTE_MIN . " et " . NOTE_MAX . ".";
    }
}

// Exercice 5.1
if ($erreur == "") {
    $info = (float) $info;
    $math = (float) $math;

    // 1.
    $fp = fopen("data/notes.csv", "a");
    if (!$fp) {
        $erreur = "Impossible d'ouvrir le fichier data/notes.csv.";
    } else {
        // 2.
        fputcsv($fp, [$nom, $info, $math], ";");
        // 3.
        fclose($fp);
    }
}

/*
 * Questions de l'exercice 4.3 :
 *  - Pourquoi préférer POST à GET pour un mot de passe ?
 *    Avec GET, les données sont ajoutées à l'URL : elles sont visibles dans
 *    la barre d'adresse, l'historique du navigateur et les favoris. Avec
 *    POST, elles sont transmises dans le corps de la requête HTTP et
 *    n'apparaissent pas dans l'URL.
 *  - Que contient $_REQUEST ?
 *    Les variables de requête HTTP : elle regroupe les données reçues par
 *    $_GET et $_POST (et $_COOKIE selon la configuration de PHP).
 *
 * Question de l'exercice 5.1 :
 *  - Que se passerait-il avec le mode "w" au lieu de "a" ?
 *    Le mode "w" ouvre le fichier en écriture seulement en le vidant : son
 *    contenu précédent serait effacé à chaque saisie, il ne resterait que le
 *    dernier apprenant. Le mode "a" ajoute la ligne à la fin du fichier.
 */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Traitement de la saisie</title>
</head>
<body>
<?php
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';
?>
<h2>Résultat de la saisie</h2>
<?php
if ($erreur != "") {
    echo '<p style="color: red;">Erreur : ' . htmlspecialchars($erreur) . '</p>';
    echo '<p><a href="saisie.html">Retour au formulaire</a></p>';
} else {
    $moyenne = ($info + $math) / 2;
    echo '<p>Données enregistrées dans data/notes.csv :</p>';
    echo '<ul>';
    echo '<li>Nom : ' . htmlspecialchars($nom) . '</li>';
    echo '<li>Note d\'informatique : ' . $info . '</li>';
    echo '<li>Note de mathématiques : ' . $math . '</li>';
    echo '<li>Moyenne : ' . $moyenne . ' (' . mention($moyenne) . ')</li>';
    echo '</ul>';
    echo '<p><a href="saisie.html">Saisir un autre apprenant</a> | <a href="liste.php">Voir la liste</a></p>';
}
?>
<?php include 'includes/pied_inc.php'; ?>
</body>
</html>
