<?php
/*
 * Auteur   : Sekri Marouan
 * Objectif : Pied de page : date du jour (exercice 6.3.1) et nombre de jours
 *            restants avant la fin du semestre avec DateTime et diff() (6.3.2)
 * Date     : 18/10/2026
 */
?>
<footer>
    <hr />
    <p>Date du jour : <?php echo date("d/m/Y"); ?></p>
<?php
$aujourdhui = new DateTime();
$finSemestre = new DateTime("2027-01-31");
$interval = $aujourdhui->diff($finSemestre);
echo '    <p>Jours restants avant la fin du semestre (31/01/2027) : ' . $interval->format("%a") . '</p>' . "\n";
?>
</footer>
