<?php
    session_start();
    include('connexion.php');

    $sql = "SELECT COUNT(NOM_CLIENT) as total_clients FROM client";
    $stmt = $monPDO->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql2 = "SELECT COUNT(NOM_TECHNICIEN) as total_techniciens FROM technicien";
    $stmt2 = $monPDO->prepare($sql2);
    $stmt2->execute();
    $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/styl.css">
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
</head>
<style>
    @import url('https://fonts.googleaois.com/css2?family=Poppins&display=swap');
    
    *,
    ::after,
    ::before{
        box-sizing: border-box;
    }

    body{
        font-family: 'Poppins', sans-serif;
        font-size: 0.875rem;
        opacity: 1;
        overflow: scroll;
        margin: 0;
    }

    a{
        cursor: pointer;
        text-decoration: none;
        font-family: 'Poppins', sans-serif;
    }

    li{
        list-style: none;
    }

    h4{
        font-family: 'Poppins', sans-serif;
        font-size: 1.275rem;
        color: var(--bs-primary-text-emphasis);
    }

    .wrapper{
        align-items: stretch !important;
        display: flex !important;
        width: 100% !important;
    }

    #slidebar{
        max-width: 264px !important;
        min-width: 264px !important;
        background: var(--bs-dark) !important;
        transition: all 0.35s ease-in-out;
    }

    .main{
        display: flex !important;
        flex-direction: column !important;
        min-height: 100vh !important;
        min-width: 0 !important;
        overflow: hidden !important;
        transition: all 0.35s ease-in-out;
        width: 100% !important;
        background: var(--bs-dark-bg-subtle) !important;
    }
    
    .sidebar-logo{
        padding: 1.15rem;
    }

    .sidebar-logo a {
        color: #e9ecef;
        font-size: 1.15rem;
        font-family: 600;
    }

    .sidebar-nav{
        flex-grow: 1;
        list-style: none;
        margin-bottom: 0;
        padding-left: 0;
        margin-left: 0;
    }

    .sidebar-header{
        color: #e9ecef;
        font-size: .75rem;
        padding: 1.5rem 1.5rem .375rem;
    }

    a.sidebar-link{
        padding: .625rem 1.625rem;
        color: #e9ecef;
        position: relative;
        display: block;
        font-size: 0.875rem;
    }

    nav{
        position: stiky !important;
        margin-top: 0 !important;
    }

    .sidebar-link[data-bs-toggle="collapse"]::after{
        border: solid;
        border-width: 0 .075rem .075rem 0;
        content: '';
        display: inline-block;
        padding: 2px;
        position: absolute;
        right: 1.25rem;
        top: 50%;
        transform: translateY(-50%) rotate(45deg);
        transition: all 0.35s ease-in-out;
    }

    .sidebar-link[data-bs-toggle="collapse"].collapsed::after{
        transform: translateY(-50%) rotate(-135deg);
        transition: all 0.35s ease-in-out;
    }

    .avatar{
        width: 2.5rem;
        height: 2.5rem;
    }

    .navbar-expand .navbar-nav{
        margin-left: auto;
    }

    .content{
        flex: 1;
        max-width: 100vw;
        width: 100vw;
    }

    @media (max-width: 768px) {
        .content {
            max-width: auto;
            width: auto;
        }
    }

    .card{
        box-shadow: 0 0 .875rem rgba(34, 46, 60, 0.5);
        margin-bottom: 24px;
    }

    .illustration{
        background-color: var(--bs-primary-bg-subtle);
        color: var(--bs-primary-text-emphasis);
    }

    #slidebar.collapsed{
        margin-left: -264px !important;
    }

    .illustration-img{
        max-width: 150px;
        width: 100%; 
    }
</style>
<body>
    <div class="wrapper">
        <aside id="slidebar">
            <div class="h-100">
                <div class="sidebar-logo">
                    <a href="#">ServXpert</a>
                </div>
                <ul class="sidebar-nav">
                    <li class="sidebar-header">
                        Admin Elements
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link">
                            <i class="fa-solid fa-list pe-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="" class="sidebar-link collapsed" data-bs-target="#pages" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-user pe-2"></i>
                            Utilisateurs
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#slidebar">
                            <li class="sidebar-item">
                                <a href="ListeClt.php" class="sidebar-link">
                                    <i class="fa-solid fa-circle pe-2"></i>
                                    Client
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="ListeTech.php" class="sidebar-link">
                                    <i class="fa-solid fa-circle pe-2"></i>
                                    Technicien
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="sidebar-item">
                        <a href="" class="sidebar-link collapsed" data-bs-target="#page" data-bs-toggle="collapse" aria-expanded="false">
                            <i class="fa-solid fa-plus pe-2"></i>
                            Ajout
                        </a>
                        <ul id="page" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#slidebar">
                            <li class="sidebar-item">
                                <a href="service.php" class="sidebar-link">
                                    <i class="fa-solid fa-circle pe-2"></i>
                                    service
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="ajout.php" class="sidebar-link">
                                    <i class="fa-solid fa-circle pe-2"></i>
                                    Technicien
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a href="domaine.php" class="sidebar-link">
                                    <i class="fa-solid fa-circle pe-2"></i>
                                    domaine
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="images/GC.jpg" alt="" class="avatar img-fluid rounded">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="profil3.php" class="dropdown-item">
                                    <i class="fa-solid fa-user pe-2"></i>
                                    Profile
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="fa-solid fa-gear pe-2"></i>
                                    Settings
                                </a>
                                <a href="#" class="dropdown-item">
                                    <i class="fa-solid fa-right-from-bracket pe-2"></i>
                                    Logout
                                </a>
                            </div>    
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container">
                    <div class="mb-3">
                        <h4>Admin Dashboard</h4>
                    </div>
                    <div class="col">
                        <div class="col-12- col-md-6 d-block">
                            <div class="card flex-fill border-0 shadow-sm align-items-center illustration">
                                <div class="card-body p-0 d-flex flex-fill">
                                    <div class="row g-0 w-100">
                                        <div class="col-6">
                                            <div class="p-3 m-15">
                                                <h3 class="mb-3">Bienvenue, <?= htmlspecialchars($_SESSION['nom2']) ?></h3>
                                                <p>Ici est votre espace d'administration où vous avez le droit de gestion sur toute les activités faites au sein de cette plateforme collaborative entre techniciens et clients</p>
                                            </div>
                                        </div>
                                        <div class="col-6 align-soft-end text-end">
                                            <img src="images/GC.jpg" alt="Dashboard Illustration" class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="col-12 col-md-6 d-flex">
                                
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card shadow">
                                            <div class="card-header bg-dark text-white">
                                                <h5 class="mb-0">Répartition des demandes effectuées par Technicien</h5>
                                            </div>
                                            <div class="card-body">
                                                <canvas id="techChart"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        
                            <div class="col-12 col-md-6 d-block">
                                <div class="card flex-fill border-0 shadow-sm">
                                    <div class="card-body py-4">
                                        <div class="d-flex align-items-start">
                                            <div class="flex-grow-1">
                                                <h4 class="mb-2">
                                                    <i class="fa-solid fa-user pe-2"></i>
                                                    Utilisateurs
                                                </h4>
                                                <p class="mb-2">Gérez les comptes clients et techniciens, ajoutez de nouveaux utilisateurs, modifiez les informations et surveillez les activités.</p>
                                                <div class="mb-0">
                                                    <span class="badge text-success me-2">
                                                        <i class="fa-solid fa-circle pe-1"></i>
                                                        <?= htmlspecialchars($result['total_clients']) ?> Clients
                                                    </span>
                                                    <span class="badge text-primary">
                                                        <i class="fa-solid fa-circle pe-1"></i>
                                                        <?= htmlspecialchars($result2['total_techniciens']) ?> Techniciens
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                    </div>
                </div>
            </main>
        </div>
    </div>
    

<script>
    // Appel AJAX pour récupérer les données du fichier PHP (a.php dans ton image)
    fetch('a.php')
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('techChart').getContext('2d');
            
            new Chart(ctx, {
                type: 'pie', // Type de graphique : Secteurs
                data: {
                    labels: data.labels, // Noms des techniciens récupérés via PHP
                    datasets: [{
                        label: 'Nombre de demandes',
                        data: data.counts, // Nombre de demandes récupérées via PHP
                        backgroundColor: [
                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                            '#36A', 'rgb(63, 194, 89)', '#fa9908', '#ff11df',
                            'rgba(7, 205, 255, 0.87)', '#540505', 'rgb(1, 255, 26)'
                            , '#2b0cf8', '#rgba(3, 200, 255, 0.50)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { position: 'bottom' }
                    }
                }
            });
        })
        .catch(error => console.error('Erreur lors de la récupération des données:', error));
</script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="assets/js/utilities/popper.min.js"></script> 
    <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script src="assets/js/bootstrap/bootstrap.js"></script>
    <script>
        const sidebarToggle = document.querySelector('#sidebar-toggle');
        sidebarToggle.addEventListener("click", function(){
            document.querySelector('#slidebar').classList.toggle('collapsed');
            document.querySelector('.col').classList.toggle('row');
        });
    </script>
</body>
</html>