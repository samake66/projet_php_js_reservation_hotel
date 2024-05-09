<?php
include "connec.php";
session_start();

?>
<h1>votre panier:<?=$_SESSION['login']?></h1>
<?php


if(isset($_SESSION['panier'])){
  @$id_chambre=$_GET['id'];
  echo $id_chambre;
  @$date_debut=$_GET['date_debut'];
  @$date_fin=$_GET['date_fin'];

  
    if(in_array($id_chambre, $_SESSION['panier'])){
      var_dump($paniers);
      echo "cette chambre est déjà dans votre panier <br><hr> Merci de choisir une autre"; 
      exit();
    }
    
    foreach($_SESSION['panier'] as $keys=>$paniers){
      
      //foreach($paniers as $panier){
      $id_chambre=$paniers['idchambre'];
      $date_debut=$paniers['datedebut'];
      $date_fin=$paniers['datefin'];

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
      /*$query="SELECT * FROM reservation WHERE chambre_idchambre= '$id_chambre' AND client_idclient='$id_client'";
      $statement=$pdo->query($query);
      $reservations=$statement->fetchAll();*/

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

    
    <div class="row row-cols-1 row-cols-md-4 g-4">

    <div class="col">
        <h2>Hôtel: <?=$hotel['name']?></h2>
        <img src="<?=$image['name']?>" alt="<?=$image['name']?>" class="card-img-top" alt="...">
        <div class="card-body">
          <h4>chambre <?=$chambre['name']?> de type: <?=$type['name']?></h4>
          <p class="card-text">(superficie: <?=$chambre['superficie'] ?>, prix: <?=$chambre['prix'] ?> $)</p>
          <p class="card-text">Réservation: du <?=$date_debut?> au <?=$date_fin ?> </p>
          <a href="supprimer.php?id=<?=$keys?>" class="btn btn-primary" >supprimer</a>
        </div>
      </div>
      </div>
 
      <?php
      
   }

?>
     <div class="card-body">
      <a href="reservation.php" class="btn btn-primary" >valider mon panier</a>
      <a href="vider_panier.php" class="btn btn-primary" >vider mon panier</a>
      </div>
<?php
}
else{
  
  echo "votre panier est vide";
}
