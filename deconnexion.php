<?php
/*
 * Auteur   : Sekri Marouan
 * Objectif : Exercice 6.1 : déconnexion (vider et détruire la session) puis
 *            redirection vers login.php
 * Date     : 18/10/2026
 */

session_start();

session_unset();

session_destroy();

header("Location: login.php");
exit;
