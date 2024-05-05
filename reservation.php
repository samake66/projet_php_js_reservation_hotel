<?php
include "connec.php";

session_start();

$id_chambre=$_GET['id'];
$date_debut=$_GET['date_debut'];
$date_fin=$_GET['date_fin'];
if(empty($_SESSION)){
    header("location:form_connexion.php?id=<?=$id_chambre?>&amp;date_debut=<?=$date_debut?>&amp;date_fin=<?=$date_fin?>"); 
}

$email=$_SESSION['login'];

$query="SELECT * FROM client WHERE email= '$email' ";
$statement=$pdo->query($query);
$client=$statement->fetch();
$id_client=$client['idclient'];


//verification si le même client n'a pas une reservation encours de la même chambre
$query="SELECT * FROM reservation WHERE chambre_idchambre= '$id_chambre' AND client_idclient='$id_client'";
$statement=$pdo->query($query);
$reservations=$statement->fetchAll();

if(!empty($reservations)){
    echo "Vous avez une reservation en cours de la même chambre<br> Veillez choisir une autre chambre, Merci !";
    exit();
}

else{

$statement=$pdo->prepare("INSERT INTO `reservation` (`chambre_idchambre`, `client_idclient`, `date_debut`, `date_fin`) VALUES (:id_chambre, :id_client, :date_debut, :date_fin)");
$statement->bindValue(':id_chambre', $id_chambre, \PDO::PARAM_INT);
$statement->bindValue(':id_client', $id_client, \PDO::PARAM_INT);
$statement->bindValue(':date_debut', $date_debut, \PDO::PARAM_STR);
$statement->bindValue(':date_fin', $date_fin, \PDO::PARAM_STR);
$statement->execute();

echo "réservation éffectuée avec succès !";

/*header('location:mes_reservation.php?id_chambre=<?=$id_chambre ?>'); */
}
