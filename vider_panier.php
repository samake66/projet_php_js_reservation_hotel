<?php
session_start();
$id=$_GET['id'];
unset($_SESSION['panier']);
echo "supprimer avec succès!";

header('location:list_chambre.php');