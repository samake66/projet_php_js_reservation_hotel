<?php
// CONNEXION À LA BASE DE DONNÉES AVEC PDO
include 'header.php';
?>

<body>
<script type="text/javascript" src="hotel.js"></script>  

<div id="titre_acciueil" class="titre_acciueil">
  <h3>les meilleurs hôtels désignés par nos clients </h3>
</div>
<div class="card-group">
  <div class="card">
    <img src="image/palace.jpeg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title" ><a href="list_hotel.php" id="hotel1"> Card title</a></h5>
      <script type="text/javascript">
          document.getElementById('hotel1').textContent = 'PALACE';
      </script>
      <p class="card-text" id="p_hotel1">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      <script type="text/javascript">
          document.getElementById('p_hotel1').textContent = 'Un hotel qui offre un service hébergement payant en chambres meublées à une clientèle de passage.';
      </script>
    </div>
    <div class="card-footer">
      <small class="text-body-secondary">
      <?php
        for($i=0; $i<5; $i++){ ?>
          <i class="fa-sharp fa-solid fa-star"></i>
        <?php }
        ?>
      </small>
    </div>
  </div>
  <div class="card">
    <img src="image/novotel.jpeg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title" ><a href="list_hotel.php" id="hotel2"> Card title</a></h5>
      <script type="text/javascript">
          document.getElementById('hotel2').textContent = 'NOVOTEL';
      </script>
      <p class="card-text" id="p_hotel2">This card has supporting text below as a natural lead-in to additional content.</p>
      <script type="text/javascript">
          document.getElementById('p_hotel2').textContent = 'Les cinq étoiles sont logiquement les établissements qui doivent remplir le plus de critères, classés en trois catégories.';
      </script>
    </div>
    <div class="card-footer">
      <small class="text-body-secondary">
        <?php
        for($i=0; $i<4; $i++){ ?>
          <i class="fa-sharp fa-solid fa-star"></i>
        <?php }
        ?>
        <i class="fa-regular fa-star"></i>
      </small>
    </div>
  </div>
  </body>
  <div class="card">
    <img src="image/eden.jpeg" class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title"><a href="list_hotel.php" id="hotel3"> Card title</a></h5>
      <script type="text/javascript">
          document.getElementById('hotel3').textContent = 'EDEN';
      </script>
      <p class="card-text" id="p_hotel3">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
      <script type="text/javascript">
          document.getElementById('p_hotel3').textContent = 'la qualité est bien sûr l’affaire de tous, du directeur jusqu’au plus jeune apprenti, en passant par le plongeur et la femme de chambre.';
      </script>
    </div>
    <div class="card-footer">
      <small class="text-body-secondary">
      <?php
        for($i=0; $i<4; $i++){ ?>
          <i class="fa-sharp fa-solid fa-star"></i>
        <?php }
        ?>
        <i class="fa-regular fa-star"></i>
      </small>
    </div>
  </div>
</div>
<div class="separateur">

</div>
<div class="footer_accueil">
<div class="row row-cols-1 row-cols-md-3 g-4">
  <div class="col">

        <h5 class="card-title">Hébergement</h5>
        <p class="card-text">Hébergements indépendants<br>
Appartements<br>
Complexes hôteliers<br>
Villas<br>
Auberges de jeunesse<br>
B&B/Chambres d'hôtes<br>
Maisons d'Hôtes</p>

  </div>
  <div class="col">

        <h5 class="card-title">Recherche</h5>
        <p class="card-text">Toutes les destinations de vacances<br>
Commentaires<br>
Découvrir les séjours au mois<br>
Articles<br>
Offres de voyage saisonnières<br>
Traveller Review Awards</p>

  </div>
  <div class="col">

        <h5 class="card-title">Nos destinations</h5>
        <p >Pays<br>
Régions<br>
Villes<br>
Quartiers<br>
Aéroports<br>
Hôtels<br>
Sites d'intérêt </p>

  </div>
</div>
<div class="card">

  <div class="card-body">
    <blockquote class="blockquote mb-0">
      <p>Touchez une clientèle internationale unique</p>
      <footer class="blockquote-footer">@avril 2024 <cite title="Source Title">VIP hôtel</cite></footer>
    </blockquote>
  </div>
</div>
</div>

