<?php
/*
 * Auteur   : Sekri Marouan
 * Objectif : Exercices 5.2 et 5.3 : lire data/notes.csv (avec fgetcsv puis
 *            avec fgets/feof/explode) et afficher les notes, les moyennes,
 *            les mentions et la moyenne générale de la classe
 * Date     : 18/10/2026
 */

require 'config.php';

$fichier = "data/notes.csv";

function terminer_page()
{
    include 'includes/pied_inc.php';
    echo '</body></html>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des notes</title>
</head>
<body>
<?php
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';
?>
<h2>Exercice 5.2 : liste des notes (fgetcsv)</h2>
<?php
// 1.
if (!file_exists($fichier)) {
    echo '<p>Aucune note enregistrée pour le moment. <a href="saisie.html">Saisir des notes</a></p>';
    terminer_page();
}

// 2.
$fp = fopen($fichier, "r");
if (!$fp) {
    echo "<p>Echec de l'ouverture du fichier.</p>";
    terminer_page();
}

// 3. et 4.
echo '<table border="1">';
echo '<tr><th>Nom</th><th>Info</th><th>Math</th><th>Moyenne</th><th>Mention</th></tr>';

$somme_moyennes = 0;
$nb = 0;
while (($data = fgetcsv($fp, 1000, ";")) !== FALSE) {
    if (count($data) < 3) {
        continue;
    }
    $nom = $data[0];
    $info = (float) $data[1];
    $math = (float) $data[2];
    $moyenne = ($info + $math) / 2;

    $somme_moyennes = $somme_moyennes + $moyenne;
    $nb++;

    if ($moyenne < SEUIL) {
        echo '<tr style="color: red;">';
    } else {
        echo '<tr>';
    }
    echo '<td>' . htmlspecialchars($nom) . '</td>';
    echo '<td>' . $info . '</td>';
    echo '<td>' . $math . '</td>';
    echo '<td>' . $moyenne . '</td>';
    echo '<td>' . mention($moyenne) . '</td>';
    echo '</tr>';
}
echo '</table>';
fclose($fp);

// 5.
if ($nb > 0) {
    echo '<p><strong>Moyenne générale de la classe : ' . ($somme_moyennes / $nb) . '</strong> (' . $nb . ' apprenants)</p>';
} else {
    echo '<p>Le fichier ne contient aucun apprenant.</p>';
}
?>

<h2>Exercice 5.3 : lecture « bas niveau » (fgets, feof, explode)</h2>
<?php
$fp = fopen($fichier, "r");
if (!$fp) {
    echo "<p>Echec de l'ouverture du fichier.</p>";
    terminer_page();
}

echo '<table border="1">';
echo '<tr><th>Nom</th><th>Info</th><th>Math</th></tr>';
while (!feof($fp)) {
    $ligne = fgets($fp, 250);
    if (strlen($ligne) > 0) {
        $tab = explode(';', $ligne, 3);
        echo '<tr><td>' . htmlspecialchars($tab[0]) . '</td><td>' . $tab[1] . '</td><td>' . $tab[2] . '</td></tr>';
    }
}
echo '</table>';
fclose($fp);

/*
 * Comparaison fgetcsv() / fgets() + explode() :
 *
 * fgetcsv()
 *   + Avantages : découpe directement la ligne en tableau ; gère les champs
 *     entourés de guillemets (fputcsv met des guillemets autour d'un nom
 *     contenant un espace ou le séparateur) ; supprime le retour à la ligne ;
 *     retourne false à la fin du fichier, donc une boucle while simple.
 *   - Inconvénients : spécifique au format CSV ; il faut connaître le
 *     séparateur (;) à passer en paramètre.
 *
 * fgets() + feof() + explode()
 *   + Avantages : fonctionne pour n'importe quel fichier texte ; on contrôle
 *     le découpage et le traitement de chaque ligne.
 *   - Inconvénients : plus de code ; il faut tester feof() et la longueur de
 *     la ligne ; le \n final reste collé au dernier champ ; les guillemets
 *     ajoutés par fputcsv restent dans les valeurs ; un séparateur présent
 *     dans une valeur casserait le découpage de explode().
 */
?>
<?php terminer_page(); ?>
