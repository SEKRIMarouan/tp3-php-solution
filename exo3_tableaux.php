<?php
/*
 * Auteur   : Sekri Marouan
 * Objectif : Partie 3 et exercice 4.1 : tableaux (création, affichage HTML,
 *            statistiques, tri, opérateurs) avec interface factorisée
 *            (entête, menu et pied de page inclus)
 * Date     : 18/10/2026
 */

require 'config.php';

// Exercice 3.4 : fonction afficher($tab)
function afficher($tab)
{
    echo '<table border="1">';
    echo '<tr><th>Nom</th><th>Note</th></tr>';
    foreach ($tab as $nom => $note) {
        echo '<tr><td>' . $nom . '</td><td>' . $note . '</td></tr>';
    }
    echo '</table>';
}

// Exercice 3.1
$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Rafik" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];

$modules = ["Programmation Web", "Base de données", "Algorithmique"];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice 3 : tableaux</title>
</head>
<body>
<?php
/*
 * Exercice 4.1 - Expérience 1 : nom de fichier inexistant
 *   include 'includes/inexistant_inc.php';
 *     -> avertissement (Warning : « Failed to open stream » puis « Failed
 *        opening ... for inclusion ») et le reste du script s'exécute
 *        quand même.
 *   require 'includes/inexistant_inc.php';
 *     -> erreur fatale (Fatal error) : l'exécution du script s'arrête
 *        immédiatement, le reste de la page n'est pas affiché.
 *
 * Exercice 4.1 - Expérience 2 : deux inclusions de menu_inc.php
 *   include 'includes/menu_inc.php'; include 'includes/menu_inc.php';
 *     -> le menu est affiché DEUX fois.
 *   include_once 'includes/menu_inc.php'; include_once 'includes/menu_inc.php';
 *     -> le menu n'est affiché qu'UNE seule fois : include_once n'inclut
 *        pas un fichier déjà inclus.
 */
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';
?>

<h2>Exercice 3.1 : création des tableaux</h2>
<h3>Tableau indexé $modules avec foreach</h3>
<?php
foreach ($modules as $module) {
    echo $module . '<br />';
}
?>
<h3>Tableau indexé $modules avec les indices</h3>
<?php
for ($i = 0; $i < count($modules); $i++) {
    echo '$modules[' . $i . '] = ' . $modules[$i] . '<br />';
}
?>

<h2>Exercice 3.2 : affichage HTML des notes</h2>
<table border="1">
    <tr><th>Nom</th><th>Note</th><th>Mention</th></tr>
<?php
foreach ($notes as $nom => $note) {
    if ($note < SEUIL) {
        echo '    <tr style="color: red;">';
    } else {
        echo '    <tr>';
    }
    echo '<td>' . $nom . '</td><td>' . $note . '</td><td>' . mention($note) . '</td></tr>' . "\n";
}
?>
</table>

<h2>Exercice 3.3 : statistiques</h2>
<h3>1. Calcul avec une boucle (sans array_sum)</h3>
<?php
$somme = 0;
$nb = 0;
$meilleure = NOTE_MIN;
$faible = NOTE_MAX;
foreach ($notes as $note) {
    $somme = $somme + $note;
    $nb++;
    if ($note > $meilleure) {
        $meilleure = $note;
    }
    if ($note < $faible) {
        $faible = $note;
    }
}
$moyenne = $somme / $nb;
echo 'Somme : ' . $somme . '<br />';
echo 'Moyenne : ' . $moyenne . '<br />';
echo 'Meilleure note : ' . $meilleure . '<br />';
echo 'Plus faible note : ' . $faible . '<br />';
?>
<h3>2. Vérification avec array_sum, count, max et min</h3>
<?php
echo 'array_sum : ' . array_sum($notes) . '<br />';
echo 'count : ' . count($notes) . '<br />';
echo 'Moyenne (array_sum / count) : ' . (array_sum($notes) / count($notes)) . '<br />';
echo 'max : ' . max($notes) . '<br />';
echo 'min : ' . min($notes) . '<br />';
?>
<h3>3. Effectifs par mention</h3>
<?php
$effectifs = [
    "Très bien" => 0,
    "Bien" => 0,
    "Assez bien" => 0,
    "Passable" => 0,
    "Ajourné" => 0
];
foreach ($notes as $note) {
    $effectifs[mention($note)]++;
}
echo '<table border="1"><tr><th>Mention</th><th>Effectif</th></tr>';
foreach ($effectifs as $m => $effectif) {
    echo '<tr><td>' . $m . '</td><td>' . $effectif . '</td></tr>';
}
echo '</table>';
?>

<h2>Exercice 3.4 : tri</h2>
<?php
echo '<h3>Tableau trié par noms croissants (ksort)</h3>';
$t = $notes;
ksort($t);
afficher($t);

echo '<h3>Tableau trié par notes décroissantes (arsort)</h3>';
$t = $notes;
arsort($t);
afficher($t);

echo '<h3>Tableau trié par noms décroissants (krsort)</h3>';
$t = $notes;
krsort($t);
afficher($t);

echo '<h3>Tableau trié par notes croissantes (asort)</h3>';
$t = $notes;
asort($t);
afficher($t);

/*
 * Question : quelle fonction de tri pour un tableau indexé comme $modules ?
 * Réponse  : sort() (ordre croissant) ou rsort() (ordre décroissant).
 *            asort/ksort/arsort/krsort sont réservées aux tableaux
 *            associatifs : elles conservent le lien clé => valeur.
 */
echo '<h3>Tableau indexé $modules trié avec sort()</h3>';
$m = $modules;
sort($m);
foreach ($m as $module) {
    echo $module . '<br />';
}
?>

<h2>Exercice 3.5 : opérateurs de tableaux</h2>
<?php
$a = ["x" => 1, "y" => 2];
$b = ["y" => 2, "x" => 1];

/*
 * Prédictions :
 *   $a + $b   : union -> ["x" => 1, "y" => 2] (les clés de $a sont conservées,
 *               les clés de $b déjà présentes dans $a sont ignorées)
 *   $a == $b  : true  (mêmes paires clé/valeur, l'ordre n'est pas pris en compte)
 *   $a === $b : false (mêmes paires clé/valeur mais PAS dans le même ordre :
 *               "x" puis "y" dans $a, "y" puis "x" dans $b)
 */
echo '<p>$a + $b :</p><pre>';
print_r($a + $b);
echo '</pre>';
echo '<p>$a == $b : ';
var_dump($a == $b);
echo '</p>';
echo '<p>$a === $b : ';
var_dump($a === $b);
echo '</p>';
?>

<?php include 'includes/pied_inc.php'; ?>
</body>
</html>
