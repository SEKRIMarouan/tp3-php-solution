<?php
/*
 * Auteur   : Sekri Marouan
 * Objectif : Fichier de configuration : constantes de l'application et
 *            fonction mention() réutilisée par exo2, exo3 et liste.php
 * Date     : 18/10/2026
 */

const ETABLISSEMENT = "Faculté des Sciences Semlalia - Marrakech";

define("NOTE_MIN", 0);
define("NOTE_MAX", 20);
define("SEUIL", 10);

// Exercice 2.1 : fonction mention($note)
function mention($note)
{
    if ($note >= 16) {
        return "Très bien";
    } elseif ($note >= 14) {
        return "Bien";
    } elseif ($note >= 12) {
        return "Assez bien";
    } elseif ($note >= SEUIL) {
        return "Passable";
    } else {
        return "Ajourné";
    }
}
?>
