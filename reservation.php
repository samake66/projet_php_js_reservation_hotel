<?php
include "connec.php";

session_start();

/*$id_chambre=$_GET['id'];
$date_debut=$_GET['date_debut'];
$date_fin=$_GET['date_fin'];
var_dump($_SESSION);
if(empty($_SESSION)){
    header("location:form_connexion.php?id=<?=$id_chambre?>&amp;date_debut=<?=$date_debut?>&amp;date_fin=<?=$date_fin?>"); 
}

//requette
$query="SELECT * FROM chambre WHERE idchambre=:id_chambre";

$statement=$pdo->prepare($query);
$statement->bindValue(':id_chambre', $id_chambre, \PDO::PARAM_INT);
$statement->execute();
$chambre=$statement->fetch();

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
    
    //foreach($chambres as $list_chambre){
      //requette nom de hotel
      $id_hotel=$chambre['hotel_idhotel'];
      $statement1=$pdo->query("select * from hotel where idhotel='$id_hotel'");
      //type de chambre
      $type=$chambre['type_idtype'];
      $statement2=$pdo->query("select name from type where idtype='$type'");
      //image de la chambre
      $query="SELECT * FROM image as i
        WHERE i.chambre_idchambre=$id_chambre ";
      $statement3=$pdo->query($query);


      //Recupere
      $hotel=$statement1->fetch(PDO::FETCH_ASSOC);
      $type=$statement2->fetch(PDO::FETCH_ASSOC);
      $image=$statement3->fetch(PDO::FETCH_ASSOC);
      ?>

    <div><p>votre panier:<?=$_SESSION['login']?></p></div>
    <div class="row row-cols-1 row-cols-md-4 g-4">

    <div class="col">
        <h2>Hôtel: <?=$hotel['name']?></h2>
        <img src="<?=$image['name']?>" alt="<?=$image['name']?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h4>chambre <?=$chambre['name']?> de type: <?=$type['name']?></h4>
          <p class="card-text">(superficie: <?=$chambre['superficie'] ?>, prix: <?=$chambre['prix'] ?> $)</p>
          <a href="#?id=<?=$chambre['idchambre']?>" class="btn btn-primary" >supprimer</a>
        </div>
      </div>
      </div>
        <?php
     }
      */
      var_dump($_SESSION);
      foreach($_SESSION['panier'] as $keys=>$paniers){

        //foreach($paniers as $panier){
        $id_client=$_SESSION['idclient'];
        $id_chambre=$paniers['idchambre'];
        $date_debut=$paniers['datedebut'];
        $date_fin=$paniers['datefin'];
      

$statement=$pdo->prepare("INSERT INTO `reservation` (`chambre_idchambre`, `client_idclient`, `date_debut`, `date_fin`) VALUES (:id_chambre, :id_client, :date_debut, :date_fin)");
$statement->bindValue(':id_chambre', $id_chambre, \PDO::PARAM_INT);
$statement->bindValue(':id_client', $id_client, \PDO::PARAM_INT);
$statement->bindValue(':date_debut', $date_debut, \PDO::PARAM_STR);
$statement->bindValue(':date_fin', $date_fin, \PDO::PARAM_STR);
$statement->execute();


/*header('location:mes_reservation.php?id_chambre=<?=$id_chambre ?>');*/
        }
        echo "réservation éffectuée avec succès !";
?>