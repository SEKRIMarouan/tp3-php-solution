<?php
/*
 * Auteur   : Sekri Marouan
 * Objectif : Exercice 5.4 : construire un tableau de résultats à partir de
 *            data/notes.csv, l'écrire en JSON dans data/notes.json, le
 *            relire, et comparer serialize() et json_encode()
 * Date     : 18/10/2026
 */

require 'config.php';

$fichier = "data/notes.csv";
$fichier_json = "data/notes.json";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Export JSON</title>
</head>
<body>
<?php
include 'includes/entete_inc.php';
include 'includes/menu_inc.php';
?>
<h2>Exercice 5.4 : sérialisation des résultats</h2>
<?php
$fp = false;
if (file_exists($fichier)) {
    $fp = fopen($fichier, "r");
}
if (!$fp) {
    echo '<p>Aucune note à exporter. <a href="saisie.html">Saisir des notes</a></p>';
    include 'includes/pied_inc.php';
    echo '</body></html>';
    exit;
}

// 1.
$resultats = [];
$i = 0;
while (($data = fgetcsv($fp, 1000, ";")) !== FALSE) {
    if (count($data) < 3) {
        continue;
    }
    $info = (float) $data[1];
    $math = (float) $data[2];
    $resultats[$i] = [
        "nom" => $data[0],
        "info" => $info,
        "math" => $math,
        "moyenne" => ($info + $math) / 2
    ];
    $i++;
}
fclose($fp);

// 2.
$json = json_encode($resultats);
file_put_contents($fichier_json, $json);
echo '<p>Fichier ' . $fichier_json . ' écrit (' . $i . ' apprenants).</p>';

// 3.
$contenu = file_get_contents($fichier_json);
$relu = json_decode($contenu, true);
echo '<h3>Contenu relu avec json_decode et affiché avec print_r</h3>';
echo '<pre>';
print_r($relu);
echo '</pre>';

// 4.
echo '<h3>Résultat de serialize()</h3>';
echo '<pre>' . htmlspecialchars(serialize($resultats)) . '</pre>';
echo '<h3>Résultat de json_encode()</h3>';
echo '<pre>' . htmlspecialchars(json_encode($resultats)) . '</pre>';

/*
 * Comparaison :
 *  - serialize() produit un format propre à PHP qui indique le type et la
 *    taille de chaque élément (a:2:{...}, s:4:"nom", d:14;...). Il se relit
 *    avec unserialize().
 *  - json_encode() produit du JSON : un format standard, lisible, utilisé
 *    pour l'échange de données entre le serveur et le client (API). Il se
 *    relit avec json_decode().
 *
 * Question : lequel de ces formats est directement exploitable par une
 *            application JavaScript ?
 * Réponse  : le JSON (json_encode). JSON est un standard compatible avec de
 *            nombreuses technologies, dont JavaScript. Le format de
 *            serialize() n'est compréhensible que par PHP.
 */
?>
<?php include 'includes/pied_inc.php'; ?>
</body>
</html>
