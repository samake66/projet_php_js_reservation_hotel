<?php
session_start();
$id=$_GET['id'];
unset($_SESSION['panier'][$id]);
echo "supprimer avec succès!";

header('location:panier.php');