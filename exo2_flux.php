<?php
/*
 * Auteur   : Sekri Marouan
 * Objectif : Partie 2 : structures de contrôle et boucles
 *            (if/elseif/else, switch, for, while, do-while, break, continue)
 * Date     : 18/10/2026
 */

require 'config.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Exercice 2 : structures de contrôle</title>
</head>
<body>
<h1>Partie 2 : structures de contrôle et boucles</h1>

<h2>Exercice 2.1 : if / elseif / else</h2>
<?php
$notes_test = [18, 16, 15, 14, 12.5, 12, 11, 10, 9.5, 0];
foreach ($notes_test as $n) {
    echo 'Note ' . $n . ' : ' . mention($n) . '<br />';
}
?>

<h2>Exercice 2.2 : switch</h2>
<?php
// 1.
$numeroDeMois = date("m");

// 2.
switch ($numeroDeMois) {
    case 1:
        $moisFrancaisActuel = 'Janvier';
        break;
    case 2:
        $moisFrancaisActuel = 'Février';
        break;
    case 3:
        $moisFrancaisActuel = 'Mars';
        break;
    case 4:
        $moisFrancaisActuel = 'Avril';
        break;
    case 5:
        $moisFrancaisActuel = 'Mai';
        break;
    case 6:
        $moisFrancaisActuel = 'Juin';
        break;
    case 7:
        $moisFrancaisActuel = 'Juillet';
        break;
    case 8:
        $moisFrancaisActuel = 'Août';
        break;
    case 9:
        $moisFrancaisActuel = 'Septembre';
        break;
    case 10:
        $moisFrancaisActuel = 'Octobre';
        break;
    case 11:
        $moisFrancaisActuel = 'Novembre';
        break;
    case 12:
        $moisFrancaisActuel = 'Décembre';
        break;
    default:
        $moisFrancaisActuel = 'mois inconnu';
}
echo 'Nous sommes au mois de ' . $moisFrancaisActuel . '.';

/*
 * 3. Question : que se passe-t-il si on oublie un break dans un case ?
 *    Réponse  : PHP continue d'exécuter les instructions jusqu'à la fin du
 *               bloc switch (ou jusqu'au prochain break). Les instructions
 *               du case suivant sont donc exécutées aussi : la variable
 *               $moisFrancaisActuel serait écrasée par la valeur du case
 *               suivant (ex. : sans break après « Octobre », on obtiendrait
 *               « Novembre », puis « Décembre »).
 */
?>

<h2>Exercice 2.3 : boucles</h2>

<h3>1. Triangle d'étoiles (deux boucles for imbriquées)</h3>
<?php
for ($i = 1; $i <= 6; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo '*';
    }
    echo '<br />';
}
?>

<h3>2. Nombres de 0 à 20 par pas de 2 (while)</h3>
<?php
$k = 0;
while ($k <= 20) {
    if ($k == 10) {
        echo '<strong>' . $k . '</strong>';
    } else {
        echo $k;
    }
    echo '<br />';
    $k = $k + 2;
}
?>

<h3>3. Nombres pairs de 0 à 10 (for et continue)</h3>
<?php
for ($i = 0; $i <= 10; ++$i) {
    if ($i % 2) {
        continue;
    }
    echo $i . '<br />';
}
?>

<h3>4. while, switch et break 2</h3>
<?php
$i = 0;
while (++$i) {
    switch ($i) {
        case 5:
            echo "At 5<br />\n";
            break 1;
        case 10:
            echo "At 10; quitting<br />\n";
            break 2;
        default:
            break;
    }
}
?>

<h3>5. Question 2 réécrite avec do-while</h3>
<?php
$k = 0;
do {
    if ($k == 10) {
        echo '<strong>' . $k . '</strong>';
    } else {
        echo $k;
    }
    echo '<br />';
    $k = $k + 2;
} while ($k <= 20);

/*
 * Différence essentielle entre while et do-while :
 *  - while évalue la condition AVANT chaque itération : si elle est fausse
 *    dès le départ, le corps de la boucle n'est jamais exécuté.
 *  - do-while évalue la condition APRÈS l'itération : la première itération
 *    est toujours exécutée, même si la condition est fausse.
 */
?>
</body>
</html>
