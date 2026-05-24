<?php session_start(); 

  include('connexion.php');

  $nom1 = $_SESSION['nom1'];

  $rf ="SELECT * FROM technicien WHERE NOM_TECHNICIEN = :nom1";
  $stmt= $monPDO->prepare($rf);
  $stmt->execute([':nom1' => $nom1]);
  $technicien = $stmt->fetch(PDO::FETCH_ASSOC);

  $fr= "SELECT demander.ID, demander.ID_SERVICE, NOM_CLIENT, NOM_DEMANDE, STATUT FROM service, demander, client WHERE service.ID_TECH = :id_tech AND service.ID_SERVICE = demander.ID_SERVICE AND demander.ID = client.ID";
  $stmt= $monPDO->prepare($fr);
  $stmt->execute([':id_tech' => $technicien['ID_TECH']]);
  $services = $stmt->fetchAll(PDO::FETCH_ASSOC);

 $dem = $services;

$decliner = isset($_POST['decliner']) ? $_POST['decliner'] : '';

if (isset($_GET['action']) && $_GET['action'] == 'accept') {
        $update = "UPDATE demander SET STATUT = :statut WHERE ID = :id AND ID_SERVICE = :id_service";
        $stmt = $monPDO->prepare($update);
        $stmt->execute([
            ':statut' => 'en cours',
            ':id' => (int)$_GET['id'],
            ':id_service' => (int)$_GET['id_serv']
        ]);
        header("Location: interventions.php");
    }

    if (isset($_GET['action']) && $_GET['action'] == 'decline') {
        $update = "UPDATE demander SET STATUT = :statut WHERE ID = :id AND ID_SERVICE = :id_service";
        $stmt = $monPDO->prepare($update);
        $stmt->execute([
            ':statut' => 'refusée',
            ':id' => (int)$_GET['id'],
            ':id_service' => (int)$_GET['id_serv']
        ]);
        header("Location: interventions.php");
    }

    if (isset($_GET['action']) && $_GET['action'] == 'terminer') {
        $update = "UPDATE demander SET STATUT = :statut WHERE ID = :id AND ID_SERVICE = :id_service";
        $stmt = $monPDO->prepare($update);
        $stmt->execute([
            ':statut' => 'terminée',
            ':id' => (int)$_GET['id'],
            ':id_service' => (int)$_GET['id_serv']
        ]);
        header("Location: interventions.php");
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
        background-image: url('images/refrigeration-7363620_1280.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        padding: 17px;
        animation: change 10s ease-in-out infinite;
        }
        .card{
            margin: 20px auto;
            width: 80%;
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        } 
        @keyframes change {
          0%{
            background-image: url(images/img5.jpg);
          }
          25%{
            background-image: url(images/img6.jpg);
          }
          50%{
            background-image: url(images/img7.jpg);
          }
          75%{
            background-image: url(images/img8.jpg);
          }
          100%{
            background-image: url(images/img5.jpg);
          }
          
        }
</style>
<body class="fade-out">
    <div class="container-fluid">

        <nav class="navbar navbar-expand-lg">
          <div class="container-fluid">

            <a class="navbar-brand" href="#">ServExpert</a>
            <img src="images/OIP-removebg-preview.png" alt="" style="width: 80px; height: auto;">
            <p>
            <?php echo htmlspecialchars($_SESSION['nom1']) ?>
            <br><span style="color: #2163b8;">Technicien</span>
            </p>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link" href="accueil2.php"><i class="fa-solid fa-house"></i> Accueil</a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="" style="color: #2163b8;"><i class="fa-solid fa-briefcase"></i> Mes interventions</a>
                </li>
                <li class="nav-item"> 
                <a class="nav-link" href="message2.php"><i class="fa-solid fa-envelope"></i> Messagerie</a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link" href="avis.php"><i class="fa-solid fa-circle-info"></i>Avis des clients</a>
                </li>

                <li>
                    <div class="dropdown mb-2">
                        <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-gear"></i> Paramètres
                        </button>
                        <ul class="dropdown-menu">
                        <li><a class="nav-link" href="Login.html"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a> </li>
                        <li><a class="nav-link" href="profil.php"><i class="fa-solid fa-user"></i> Profil</a></li>
                        </ul>
                    </div>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        
        <div class="row">
          <?php if (count($dem) === 0): ?>
            <div class="card">
              <div class="card-body">
                  <h5 class="card-title">Aucune intervention assignée</h5>
                <p class="card-text">Vous n'avez actuellement aucune intervention assignée. Veuillez revérifier ultérieurement pour les mises à jour.</p>
              </div>
            </div>
          <?php else: ?>
          <?php for($i = 0; $i < count($dem); $i++): ?>

            <div class="col-md-6 mb-3">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?= $dem[$i]['NOM_DEMANDE'] ?></h5>
                    <p class="card-text">Client : <?= $dem[$i]['NOM_CLIENT'] ?><br>Statut : <span class="badge bg-success"><?= htmlspecialchars($dem[$i]['STATUT']) ?></span></p>
                    <?php if ($dem[$i]['STATUT'] == 'en attente'): ?>
                    <a href="interventions.php?id=<?= $dem[$i]['ID']; ?>&id_serv=<?= $dem[$i]['ID_SERVICE'] ?>&action=accept" class="btn btn-outline-success btn-sm" name="accepter">accepter</a>
                    
                    <a href="interventions.php?id=<?= $dem[$i]['ID']; ?>&id_serv=<?= $dem[$i]['ID_SERVICE'] ?>&action=decline" class="btn btn-outline-danger btn-sm" name="decliner">decliner</a>
                    <?php elseif ($dem[$i]['STATUT'] == 'en cours'): ?>
                    <a href="conversation.php?id=<?= $dem[$i]['ID']; ?>" class="btn btn-outline-primary btn-sm">Messagerie</a>
                    <a href="interventions.php?id=<?= $dem[$i]['ID']; ?>&id_serv=<?= $dem[$i]['ID_SERVICE'] ?>&action=terminer" class="btn btn-outline-success btn-sm">Terminer</a>
                    <?php elseif ($dem[$i]['STATUT'] == 'refusée'): ?>
                    <p class="card-text">Cette intervention a été refusée.</p>
                    <?php endif; ?>
                </div>
                </div>
            </div>
          <?php endfor; ?>
        </div>
        <?php endif; ?>
    </div>
    
</body>
    <script type="text/javascript" src="assets/js/utilities/popper.min.js"></script> 
    <script type="text/javascript" src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
</html>