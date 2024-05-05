<?php
include "header.php";
session_destroy();
header('location:accueil.php');
exit();