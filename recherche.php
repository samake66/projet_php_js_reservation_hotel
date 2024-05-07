<?php

include "header.php";
$ville=$_POST['ville'];
$date_debut=$_POST['date_debut'];
$date_fin=$_POST['date_fin'];
$type=$_POST['type'];



//if(isset($val_search) && !empty(trim($ville))){

  //requette
  $query="SELECT * FROM chambre as c
  INNER JOIN hotel as h ON c.hotel_idhotel = h.idhotel
  INNER JOIN type as t ON c.type_idtype = t.idtype
  WHERE h.adresse LIKE '%$ville%' OR t.idtype= '$type' ";

  $statement=$pdo->prepare($query);
  $statement->setFetchMode(PDO::FETCH_ASSOC);
  $statement->execute();
  $chambres=$statement->fetchAll();
  
  $affiche_resultat="oui";
//}

?>
<div class="div_resultat">
    <?php
    //{}
    if(empty($chambres)){ ?>
    <div class="resultat2"> 
    <?php
      echo "Aucune chambre disponible dans la ville ou le code postal saisi ".$ville;
    }
    else{?>
      
    <div class="resultat1"> 
        <div class="titre_resultat">
        <h2> Les résultats de votre recherche : </h2>
        </div>
      <div class="row row-cols-1 row-cols-md-4 g-4">
      <?php
      foreach($chambres as $list_chambre){

        $id_chambre=$list_chambre['idchambre'];

          //verification de la date de réservation
        /*$query="SELECT * FROM reservation as r
        INNER JOIN chambre as c ON r.chambre_idchambre = c.idchambre
        WHERE r.chambre_idchambre='$id_chambre' ";

        $statement=$pdo->prepare($query);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        $statement->execute();
        $reservations=$statement->fetchAll();
        //var_dump($reservation);
        if(!empty($reservation)){ 
          foreach($reservations as $reservation){
            if($reservation['date_fin'].date("m") != $date_debut.date("m")){
              echo "des mois differents <br><hr>";
            }
          }
        }*/
            //requette nom de hotel
            $id_hotel=$list_chambre['hotel_idhotel'];
            $statement1=$pdo->query("select * from hotel where idhotel='$id_hotel'");
            //type de chambre
            $id_type=$list_chambre['type_idtype'];
            $statement2=$pdo->query("select name from type where idtype='$id_type'");
            //image de la chambre
            $query="SELECT * FROM image as i
              WHERE i.chambre_idchambre=$id_chambre ";
            $statement3=$pdo->query($query);


            //Recupere
            $hotel=$statement1->fetch(PDO::FETCH_ASSOC);
            $type=$statement2->fetch(PDO::FETCH_ASSOC);
            $image=$statement3->fetch(PDO::FETCH_ASSOC);
            ?>
          
          <div class="col">
            <h2><?=$hotel['name']?></h2>
            <img src="<?=$image['name']?>" alt="<?=$image['name']?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h3><?=$type['name']?></h3>
              <p class="card-text">(superficie: <?=$list_chambre['superficie'] ?>, prix: <?=$list_chambre['prix'] ?> $)</p>
              <a href="details.php?id=<?=$list_chambre['idchambre']?>&amp;date_debut=<?=$date_debut?>&amp;date_fin=<?=$date_fin?>" class="btn btn-primary" >voir l'ofrre</a>
            </div>
          </div>
            <?php
        /* }
         else{
        
         }*/
      }
      ?>
      </div>
    </div>
      <?php
    } 
    ?>
  </div>
</div>
