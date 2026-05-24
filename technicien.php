<?php
 include('connexion.php');
 session_start();
 $sl = "SELECT * FROM domaine";
 $stmt = $monPDO->prepare($sl);
 $stmt->execute();
 $domaines = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql ="SELECT * FROM technicien, maitriser WHERE technicien.ID_TECH = maitriser.ID_TECH AND maitriser.NUMERO = :num";
$stmt = $monPDO->prepare($sql);
$stmt->execute([':num' => $_GET['num']]);
$techniciens = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sql1 = "SELECT AVG(NOTE) AS moyenne, NOM_TECHNICIEN FROM note, technicien WHERE note.ID_TECH = technicien.ID_TECH AND technicien.ID_TECH IN (SELECT ID_TECH FROM maitriser WHERE NUMERO = :num) GROUP BY technicien.ID_TECH";
$stmt1 = $monPDO->prepare($sql1);
$stmt1->execute([':num' => $_GET['num']]);
$moyennes = $stmt1->fetchAll(PDO::FETCH_ASSOC);

$st = "SELECT NOM_DOMAINE FROM domaine WHERE NUMERO = :num";
$stmt=$monPDO->prepare($st);
$stmt->execute([':num' => $_GET['num']]);
$dm=$stmt->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste de techniciens</title>
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
      <link rel="stylesheet" href="assets/css/style.css">
</head>
        <style>
            body {
                background-color: #fcfefe;
            }

            .card {
                border: none;
                border-radius: 10px;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                width: 300px !important;
                height: 400px !important;
            }
            .card:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            }
            .card-img-top {
                height: 200px;
                object-fit: cover;
            }
            .btn-primary {
                background-color: #007bff;
                border: none;
                transition: background-color 0.3s ease;
            }
            .btn-primary:hover {
                background-color: #0056b3;
            }
            .py-5 {
                padding-top: 3rem !important;
                padding-bottom: 3rem !important;
            }

                

            .container{
                animation: fadeIn 1s ease-in-out;
            }

             @keyframes fadeIn {
                from { opacity: 0; }
                to { opacity: 1; }
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
                            <?php for($i=0; $i<count($domaines); $i++): ?>
                                <li><a class="nav-link" href="technicien.php?num=<?= $domaines[$i]['NUMERO'] ?>"><i class="fa-solid fa-house-flood-water"></i> <?= $domaines[$i]['NOM_DOMAINE'] ?></a></li>
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

        <div class="row align-items-center py-5">

            <div class="col-md-6">
                <h2 class="fw-bold"><?= $dm['NOM_DOMAINE'] ?></h2>
                <p>Ici, vous trouverez une liste des techniciens en <?= $dm['NOM_DOMAINE'] ?> disponibles pour vos besoins de réparation et d'installation.</p>
            </div>

            <div class="row shadow-sm mt-4 mb-5 ms-auto" style="width: 600px; height: auto;">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Statistiques Techniciens sur les demandes de services effectuées</h5>
                    <div class="d-flex gap-2">
                        <input type="number" id="numFilter" class="form-control form-control-sm" placeholder="Numéro (ex: 15)" value="<?= htmlspecialchars($_GET['num']) ?>" style="width: 100px;">
                        <button onclick="chargerGraphe()" class="btn btn-sm btn-light">Actualiser</button>
                    </div>
                </div>
                <div class="main">
                    <canvas id="monGraphe"></canvas>
                </div>
            </div>
        </div>
        <div class="container" style="margin-top: 150px;">
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            

            <div class="row">
                <?php for($i = 0; $i < count($techniciens); $i++): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-30 shadow-sm">
                        <img src="images/img2.jpg" class="card-img-top" alt="Technicien 1">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($techniciens[$i]['NOM_TECHNICIEN']); ?></h5>
                            <p class="card-text placeholder-glow">Spécialisé en réparation de fuites et installation de sanitaires.</p>
                            <p class="card-text">Note moyenne : 
                                <?php 
                                    $moyenne = 0;
                                    foreach($moyennes as $m) {
                                        if($m['NOM_TECHNICIEN'] == $techniciens[$i]['NOM_TECHNICIEN']) {
                                            $moyenne = round($m['moyenne'], 2);
                                            break;
                                        }
                                    }
                                    echo $moyenne . " ⭐";
                                ?></p>
                            <a href="demande.php?id=<?= $techniciens[$i]['ID_TECH'] ?>" class="btn btn-primary">Contacter</a>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
        </div>

    </div>

    <script>
        let chartInstance = null;

        function chargerGraphe() {
            // 1. Récupérer la valeur du filtre
            const numValue = document.getElementById('numFilter').value;

            // 2. Appeler aaaa.php en passant le paramètre 'num' dans l'URL
            fetch(`aaaa.php?num=${numValue}`)
                .then(response => {
                    if (!response.ok) throw new Error('Erreur réseau');
                    return response.json();
                })
                .then(data => {
                    const ctx = document.getElementById('monGraphe').getContext('2d');
                    
                    // Détruire l'ancien graphe s'il existe
                    if (chartInstance) {
                        chartInstance.destroy();
                    }

                    // 3. Création du graphe avec les données du PHP (labels et counts)
                    chartInstance = new Chart(ctx, {
                        type: 'bar', 
                        data: {
                            labels: data.labels, 
                            datasets: [{
                                label: `Demandes (Filtre n°${numValue})`,
                                data: data.counts,
                                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: { beginAtZero: true }
                            }
                        }
                    });
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    alert("Erreur lors du chargement des données. Vérifiez le fichier PHP.");
                });
        }

        // Lancement au démarrage
        window.onload = chargerGraphe;
    </script>
    <script src="assets/js/utilities/popper.min.js"></script> 
    <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script src="assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>