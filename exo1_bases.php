<?php
/*
 * Auteur   : Sekri Marouan
 * Objectif : Partie 0 et Partie 1 : variables, constantes, types et chaînes
 * Date     : 18/10/2026
 */

// Partie 0 - Commentaire sur une seule ligne avec //
# Partie 0 - Commentaire sur une seule ligne avec #
/*
   Partie 0 - Commentaire
   sur plusieurs lignes
   (délimité par une barre-étoile et une étoile-barre)
*/

// Exercice 1.2
require 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice 1 : bases du PHP</title>
</head>
<body>
<h1>Partie 0 et Partie 1 : bases du PHP</h1>

<h2>Partie 0 : Hello PHP</h2>
<?php echo 'Hello PHP'; ?>

<h2>Exercice 1.1 : noms de variables</h2>
<?php
/*
 * Noms valides / invalides :
 *   $x        : valide   (commence par une lettre)
 *   $_x       : valide   (commence par un souligné)
 *   $2x       : invalide (commence par un chiffre)
 *   $x-y      : invalide (le caractère - n'est pas autorisé)
 *   $Prix_HT  : valide   (lettres et souligné)
 *   $prix ht  : invalide (l'espace n'est pas autorisé)
 *   $état     : valide   (le cours indique que $état est un nom valide)
 */

$x = 10;
$_x = 20;
$Prix_HT = 60;
$état = "valide";

echo '$x = ' . $x . '<br />';
echo '$_x = ' . $_x . '<br />';
echo '$Prix_HT = ' . $Prix_HT . '<br />';
echo '$état = ' . $état . '<br />';

$a = "variable en minuscule";
$A = "variable en MAJUSCULE";
echo '$a = ' . $a . '<br />';
echo '$A = ' . $A . '<br />';
echo "<em>\$a et \$A sont deux variables distinctes.</em><br />";
?>

<h2>Exercice 1.2 : constantes</h2>
<?php
echo 'ETABLISSEMENT = ' . ETABLISSEMENT . '<br />';
echo 'NOTE_MIN = ' . NOTE_MIN . '<br />';
echo 'NOTE_MAX = ' . NOTE_MAX . '<br />';
echo 'SEUIL = ' . SEUIL . '<br />';

echo "defined('SEUIL') : ";
var_dump(defined('SEUIL'));
echo '<br />';
echo "defined('INCONNUE') : ";
var_dump(defined('INCONNUE'));
echo '<br />';

/*
 * Question 1 : que se passe-t-il si on affiche une constante non définie ?
 * Réponse    : une Error est renvoyée (« Undefined constant "INCONNUE" ») et
 *              le script s'arrête.
 *
 * Question 2 : différence entre const et define() ?
 * Réponse    : const est évalué à la compilation : il doit être déclaré au
 *              plus haut niveau du script (pas dans un if, une boucle ou
 *              une fonction). define() est une fonction appelée à
 *              l'exécution : elle peut être utilisée à l'intérieur d'une
 *              structure conditionnelle ou d'une fonction.
 */
?>

<h2>Exercice 1.3 : calcul du prix TTC</h2>
<?php
$prix_ht = 60;
$tva = 20;
$prix_ttc = $prix_ht * (1 + ($tva / 100));
echo 'Le prix TTC du produit est de ' . $prix_ttc . ' €.';
?>

<h2>Exercice 1.4 : types et conversions</h2>
<h3>1. Conversion en string</h3>
<?php
$test = 42;
$test = (string) $test;
var_dump($test);
?>

<h3>2. Conversions en booléen</h3>
<?php
/*
 * Prédictions :
 *   (bool) 0     -> false
 *   (bool) 0.0   -> false
 *   (bool) "0"   -> false
 *   (bool) ""    -> false
 *   (bool) "abc" -> true
 *   (bool) []    -> false
 *   (bool) null  -> false
 */
echo '(bool) 0 : ';     var_dump((bool) 0);     echo '<br />';
echo '(bool) 0.0 : ';   var_dump((bool) 0.0);   echo '<br />';
echo '(bool) "0" : ';   var_dump((bool) "0");   echo '<br />';
echo '(bool) "" : ';    var_dump((bool) "");    echo '<br />';
echo '(bool) "abc" : '; var_dump((bool) "abc"); echo '<br />';
echo '(bool) [] : ';    var_dump((bool) []);    echo '<br />';
echo '(bool) null : ';  var_dump((bool) null);  echo '<br />';
?>

<h3>3. Conversions en int et float</h3>
<?php
/*
 * Prédictions :
 *   (int) 3.9         -> 3
 *   (int) "12abc"     -> 12
 *   (float) "1.5e3"   -> 1500.0
 *   (int) true        -> 1
 */
echo '(int) 3.9 : ';       var_dump((int) 3.9);       echo '<br />';
echo '(int) "12abc" : ';   var_dump((int) "12abc");   echo '<br />';
echo '(float) "1.5e3" : '; var_dump((float) "1.5e3"); echo '<br />';
echo '(int) true : ';      var_dump((int) true);      echo '<br />';
?>

<h3>4. Le nombre 255 en différentes notations</h3>
<?php
$decimal = 255;
$hexadecimal = 0xFF;
$octal = 0377;
$binaire = 0b11111111;

echo 'Décimal : ' . $decimal . '<br />';
echo 'Hexadécimal (0xFF) : ' . $hexadecimal . '<br />';
echo 'Octal (0377) : ' . $octal . '<br />';
echo 'Binaire (0b11111111) : ' . $binaire . '<br />';
?>

<h2>Exercice 1.5 : chaînes de caractères</h2>
<?php
$traitees = "égales à";
$ici = 2;

// 1.
echo 'Ahmed a dit : "J\'ai réussi"';
echo '<br />';

// 2.
echo 'Voulez-vous supprimer C:\\*.*?';
echo '<br />';

// 3.
echo 'Ceci n\'affichera pas \n de nouvelle ligne';
echo '<br />';

// 4.
echo 'Les variables ne seront pas $traitees $ici';
echo '<br />';

// 5.
echo "Les variables seront $traitees $ici";
echo '<br />';

$phrase = "*Bonjour les développeurs*";
$phrase = trim($phrase, "*");
echo $phrase . '<br /><br />';

$ch = "*Bonjour les developpeurs*";
$ch = trim($ch, "*");
for ($i = 0; $i < strlen($ch); $i++) {
    echo "$ch[$i] <br>";
}
?>
</body>
</html>
