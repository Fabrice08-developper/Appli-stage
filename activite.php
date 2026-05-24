<?php
    session_start();
    include('connexion.php');

    $sl = "SELECT * FROM domaine";
    $stmt = $monPDO->prepare($sl);
    $stmt->execute();
    $dm = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $nom = $_SESSION['nom'];

    $sl = "SELECT * FROM client WHERE NOM_CLIENT = :nom";
    $stmt = $monPDO->prepare($sl);
    $stmt->execute([':nom' => $nom]);
    $client = $stmt->fetch(PDO::FETCH_ASSOC);

    $sr= "SELECT NOM_DEMANDE, NOM_TECHNICIEN, NOM_SERVICE, STATUT, technicien.ID_TECH, service.ID_SERVICE FROM demander, service, technicien 
    WHERE demander.ID_SERVICE = service.ID_SERVICE AND service.ID_TECH = technicien.ID_TECH 
    AND demander.ID = :id";
    $stmt = $monPDO->prepare($sr);
    $stmt->execute([':id' => $client['ID']]);
    $activites = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = "SELECT ID_TECH FROM technicien WHERE NOM_TECHNICIEN = :nom";
    $stmt = $monPDO->prepare($sql);
    $id_tech = [];
    foreach ($activites as $activite) {
        $stmt->execute([':nom' => $activite['NOM_TECHNICIEN']]);
        $id_tech[] = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if(isset($_GET['statut']) && $_GET['statut'] == 'noté'){

        $sql = "UPDATE demander SET STATUT = :statut WHERE ID = :id AND ID_SERVICE = :ids";
        $stmt=$monPDO->prepare($sql);
        $stmt->execute([
          ':statut' => 'noté',
          ':id' => $client['ID'],
          ':ids' => $_GET['ids']
        ]);
    }

    if(isset($_GET['action']) && $_GET['action'] == "supprimer"){

      $sql ="DELETE FROM demander WHERE ID = :id AND ID_SERVICE = :ids";
      $stmt = $monPDO->prepare($sql);
      $stmt->execute([
        ':id' => $client['ID'],
        ':ids' => $_GET['id']
      ]);

      header("Location: activite.php");
      exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServXpert</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
</head>
<style>
    body{
        background-image: url('images/WhatsApp\ Image\ 2025-08-22\ at\ 21.25.46_91e5e87c.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        text-align: center;
        padding-top: 10px;
        font-family: Arial, sans-serif;
        padding: 17px;
        animation: change 10s ease-in-out infinite;
    }
    h1{
        font-size: 36px;
        margin-bottom: 20px;
    }
    .cadres {
        margin: 100px !important;
      }
    .fa-arrow-left{
        position: absolute;
        top: 30px;
        left: 30px;
        font-size: 24px;
        cursor: pointer;
        color: black;
        width: 60px !important;
        height: 60px !important;
    }
    .card{
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 20px auto;
        max-width: 400px;
    }

    .container-fluid{
            animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
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
              <?php 
                if(isset($_SESSION['nom'])){
                  echo "Bonjour, " . htmlspecialchars($_SESSION['nom']);
                } else {
                  echo "Invité";
                }
              ?>
              <br><span style="color: #2163b8;">Client</span>
            </p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="accueil.php"><i class="fa-solid fa-house"></i> Accueil</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="activite.php"><i class="fa-solid fa-briefcase"></i> Mon activité</a>
                </li>

                <li>
                  <div class="dropdown mb-2">
                      <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-gear"></i> Services
                      </button>
                      <ul class="dropdown-menu">
                        <?php for($i=0; $i<count($dm); $i++): ?>
                          <li><a class="nav-link" href="technicien.php?num=<?= $dm[$i]['NUMERO'] ?>"> <?= $dm[$i]['NOM_DOMAINE'] ?></a></li>
                        <?php endfor; ?>
                      </ul>
                  </div>
                </li>

                <li class="nav-item"> 
                  <a class="nav-link" href="message.php"><i class="fa-solid fa-envelope"></i> Messagerie</a>
                </li>

                <li>
                  <div class="dropdown mb-2">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
      <?php if(empty($activites)): ?>
          <h2>Aucune activité trouvée.</h2>
      <?php else: ?>
      <?php for($i=0; $i < count($activites) ; $i++): ?>
        <div class="cadres d-flex flex-wrap justify-content-center">
            <div class="card border-0 col-12 col-md-6 col-lg-4">
            <div class="card-body">
                <h5 class="card-title"><?php echo htmlspecialchars($activites[$i]['NOM_DEMANDE']); ?></h5>
                <p class="card-text">Technicien : <?php echo htmlspecialchars($activites[$i]['NOM_TECHNICIEN']); ?><br>Date : 12 nov. 2025<br>Statut : <?php if($activites[$i]['STATUT'] == 'terminée'): ?><span class="badge bg-success"><?= htmlspecialchars($activites[$i]['STATUT']) ?></span><?php elseif($activites[$i]['STATUT'] == 'refusée'): ?><span class="badge bg-danger"><?= htmlspecialchars($activites[$i]['STATUT']) ?></span><?php else: ?><span class="badge bg-warning"><?= htmlspecialchars($activites[$i]['STATUT']) ?></span><?php endif; ?></p>

                <?php if($activites[$i]['STATUT'] == 'terminée'): ?>
                    <a href="star.php?id=<?php echo $activites[$i]['ID_TECH']; ?>&ids=<?= $activites[$i]['ID_SERVICE'] ?>&idc=<?= $client['ID'] ?>"><button class="btn btn-outline-primary btn-sm">Noter</button></a>
                <?php endif; ?>
                <?php if($activites[$i]['STATUT'] == 'noté'): ?>
                  <a href="activite.php?action=supprimer&id=<?= $activites[$i]['ID_SERVICE'] ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-trash"></i>Supprimer</a>
                <?php endif?>

                <?php if($activites[$i]['STATUT'] == 'refusée'): ?>
                  <a href="activite.php?action=supprimer&id=<?= $activites[$i]['ID_SERVICE'] ?>" class="btn btn-outline-primary btn-sm"><i class="fas fa-trash"></i>Supprimer</a>
                <?php endif?>  
                
            </div>
            </div>
        </div>
      <?php endfor; ?>
    <?php endif; ?>
    </div>

   
</body>
<script src="assets/js/utilities/popper.min.js"></script> 
  <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
  <script src="assets/js/bootstrap/bootstrap.js"></script>
</html>