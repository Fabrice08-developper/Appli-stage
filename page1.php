<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
      <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <style>
      body{
          background-image: url('images/WhatsApp\ Image\ 2025-08-22\ at\ 21.25.46_91e5e87c.jpg');
          background-repeat: no-repeat;
          background-size: cover;
          background-attachment: fixed;
          background-position: center;
          font-family: Arial, sans-serif;
          animation: change 10s ease-in-out infinite;
      }
      nav {
              backdrop-filter: blur(25px);
              background-color: none !important;
              margin-top: 10px;
              border-radius: 15px;
          }
      .card{
        margin: 20px !important;
      }
      .cadres {
        margin: 100px !important;
      }
              @keyframes change {
              0%{
                  background-image: url('images/img1.jpg');
              }
              25%{
                  background-image: url('images/img2.jpg');
              }
              50%{
                  background-image: url('images/img3.jpg');
              }
              75%{
                  background-image: url('images/img4.jpg');
              }
              100%{
                  background-image: url('images/img1.jpg');
              }
              
          }

              
  </style>
  <body>
    <div class="container-fluid">
      <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">

          <a class="navbar-brand" href="#">ServExpert</a>
          <img src="images/OIP-removebg-preview.png" alt="" style="width: 80px; height: auto;">
          <p>
            <?php echo $_SESSION['nom']; ?>
            <br><span style="color: #2163b8;">Client</span>
          </p>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="essai.php"><i class="fa-solid fa-house"></i> Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="activite.php"><i class="fa-solid fa-briefcase"></i> Mon activité</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" style="color: #2163b8;" href="#"><i class="fa-solid fa-magnifying-glass"></i> Recherche</a>
              </li>
              <li class="nav-item"> 
                <a class="nav-link" href="conversation2.html"><i class="fa-solid fa-envelope"></i> Messagerie</a>
              </li>

              <li>
                <div class="dropdown mb-2">
                  <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-gear"></i> Paramètres
                  </button>
                  <ul class="dropdown-menu">
                    <li><a class="nav-link" href="Login.php"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a> </li>
                    <li><a class="nav-link" href="profil2.php"><i class="fa-solid fa-user"></i> Profil</a></li>
                  </ul>
                </div>
              </li>

            </ul>
          </div>
        </div>
      </nav>
      <div class="container d-flex justify-content-end align-items-end mb-2">
        <div class="dropdown mb-2">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Specifiez le domaine
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">metallique</a></li>
            <li><a class="dropdown-item" href="#">Plomberie</a></li>
            <li><a class="dropdown-item" href="#">Electronique</a></li>
            <li><a href="#" class="dropdown-divider"></a></li>
            <li><a href="#" class="dropdown-item">Informatique</a></li>
          </ul>
        </div>
        <form action="">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Rechercher un technicien" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-primary" type="button" id="button-addon2"><i class="fa-solid fa-magnifying-glass"></i></button>
          </div>
        </form>
      </div>
      <?php
        include('connexion.php');
        $sql = "SELECT * FROM technicien, domaine, maitriser WHERE technicien.ID_TECH = 503 AND technicien.ID_TECH = maitriser.ID_TECH AND domaine.NUMERO = maitriser.NUMERO";
        $stmt = $monPDO->prepare($sql);
        $stmt->execute();
        $techniciens = $stmt->fetchAll();

        $sql2 = "SELECT * FROM technicien, domaine, maitriser WHERE technicien.ID_TECH = 167 AND technicien.ID_TECH = maitriser.ID_TECH AND domaine.NUMERO = maitriser.NUMERO";
        $stmt = $monPDO->prepare($sql2);
        $stmt->execute();
        $techniciens3 = $stmt->fetchAll();

        $sql5 = "SELECT * FROM technicien, domaine, maitriser WHERE technicien.ID_TECH = 952 AND technicien.ID_TECH = maitriser.ID_TECH AND domaine.NUMERO = maitriser.NUMERO";
        $stmt = $monPDO->prepare($sql5);
        $stmt->execute();
        $techniciens4 = $stmt->fetchAll();

        $sql4 = "SELECT * FROM maitriser, domaine, technicien WHERE technicien.ID_TECH = 20 AND technicien.ID_TECH = maitriser.ID_TECH AND domaine.NUMERO = maitriser.NUMERO";
        $stmt = $monPDO->prepare($sql4);
        $stmt->execute();
        $techniciens2= $stmt->fetchAll();

        $sql3 = "SELECT * FROM maitriser, domaine, technicien WHERE technicien.ID_TECH = 506 AND technicien.ID_TECH = maitriser.ID_TECH AND domaine.NUMERO = maitriser.NUMERO";
        $stmt = $monPDO->prepare($sql3);
        $stmt->execute();
        $domaine= $stmt->fetchAll();
      ?>
      
      <?php if(!empty($techniciens)):?>
      <div class="cadres d-flex flex-wrap justify-content-center" style="margin-top: 40px;">
        <?php foreach ($techniciens as $tech): ?>
        <div class="card shadow-lg border-0 col-12" style="width: 18rem;margin-right: 40px;">
          <img src="images/OIP.jpeg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-title">
              Nom: <span style="color: #2163b8;"><?= htmlspecialchars($tech['NOM_TECHNICIEN']) ?></span>
              </br>
              domaine: <span style="color: #2163b8;"><?= htmlspecialchars($tech['NOM_DOMAINE']) ?></span>
              <a href="dem2.php" class="btn btn-primary">Solliciter</a>
            </p>
          </div>
        </div>
        <?php endforeach; ?>
        <?php foreach($domaine as $dm): ?>
        <div class="card shadow-lg border-0 col-12" style="width: 18rem;margin-right: 40px;">
          <img src="images/OIP.jpeg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-title">
              Nom: <span style="color: #2163b8;"><?= htmlspecialchars($dm['NOM_TECHNICIEN']) ?></span>
        </br>
              domaine: <span style="color: #2163b8;"><?= htmlspecialchars($dm['NOM_DOMAINE']) ?></span>
              <a href="dem1.php" class="btn btn-primary">Solliciter</a>
            </p>
          </div>
        </div>
          <?php endforeach; ?>

          <?php foreach($techniciens2 as $tech2):?>
        <div class="card shadow-lg border-0 col-12" style="width: 18rem;margin-right: 40px;">
          <img src="images/OIP.jpeg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-title">
              Nom: <span style="color: #2163b8;"><?= htmlspecialchars($tech2['NOM_TECHNICIEN']) ?></span>
              <br>
              Domaine: <span style="color: #2163b8;"><?= htmlspecialchars($tech2['NOM_DOMAINE']) ?></span>
              <a href="" class="btn btn-primary">Solliciter</a>
            </p>
          </div>
        </div>
        <?php endforeach?>
        <?php foreach($techniciens3 as $tech3):?>    
        <div class="card shadow-lg border-0 col-12" style="width: 18rem;margin-right: 40px;">
          <img src="images/OIP.jpeg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-title">
              Nom: <span style="color: #2163b8;"><?= htmlspecialchars($tech3['NOM_TECHNICIEN']) ?></span>
              <br>
              Domaine: <span style="color: #2163b8;"><?= htmlspecialchars($tech3['NOM_DOMAINE']) ?></span>
              <a href="" class="btn btn-primary">Solliciter</a>
            </p>
          </div>
        </div>
        <?php endforeach?>
        
        <?php foreach($techniciens4 as $tech4):?>
        <div class="card shadow-lg border-0 col-12" style="width: 18rem;margin-right: 40px;">
          <img src="images/OIP.jpeg" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-title">
              Nom: <span style="color: #2163b8;"><?= htmlspecialchars($tech4['NOM_TECHNICIEN']) ?></span>
              <br>
              Domaine: <span style="color: #2163b8;"><?= htmlspecialchars($tech4['NOM_DOMAINE']) ?></span>
              <a href="" class="btn btn-primary">Solliciter</a>
            </p>
          </div>
        </div>
        <?php endforeach?>
      </div>
    <?php endif; ?>

    </div>
      
      
    <script src="assets/js/utilities/popper.min.js"></script> 
    <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script src="assets/js/bootstrap/bootstrap.js"></script>

</body>
</html>