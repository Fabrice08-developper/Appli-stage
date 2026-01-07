<?php session_start();
include('connexion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <style>
        li{
            padding: 10px;
        }
        nav {
            backdrop-filter: blur(25px);
            background-color: none !important;
            margin-top: 10px;
            border-radius: 15px;
        }
        body {
            background-image: url('images/WhatsApp\ Image\ 2025-08-22\ at\ 21.25.46_91e5e87c.jpg');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            font-family: Arial, sans-serif;
            padding: 17px;
            animation: change 10s ease-in-out infinite;
        }
        button.navbar-toggler {
            color: white;
            padding-right: 8px;
            border: none;
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
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="#" >ServExpert</a>
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

                <button class="navbar-toggler" data-bs-toggle="collapse" type="button" name="button"
                    data-bs-target="#monMenu" >
                    <span class="navbar-toggler-icon"></span>
                </button>

             
                <div class="collapse navbar-collapse" id="monMenu">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#" style="color: #2163b8;"><i class="fa-solid fa-house"></i> Accueil</a>
                        </li>

                        <li class="nav-item">
                        <a class="nav-link" href="activite.php"><i class="fa-solid fa-briefcase"></i> Mon activité</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="page1.php"><i class="fa-solid fa-magnifying-glass"></i> Recherche</a>
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
        <div class="container text-center" style="margin-top: 100px;">
            <h1>Bienvenue sur la plateforme ServExpert</h1>
            <p>Votre plateforme de mise en relation avec des techniciens qualifiés.</p>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Salut, <span style="color: #2163b8;"><?php if(isset($_SESSION['nom'])){
                            echo  htmlspecialchars($_SESSION['nom']);
                        } ?></span></h5>
                <p class="card-text">Vous pouvez rechercher des techniciens dans différents domaines.</p>
                <a href="page1.php" class="btn btn-primary">Commencer</a>
            </div>
        </div>
    </div>
    
    <script type="text/javascript" src="assets/js/utilities/popper.min.js"></script> 
    <script type="text/javascript" src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script type="text/javascript" src="assets/js/bootstrap/bootstrap.min.js"></script>
</body>
</html>