<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServXpert</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=DM+Serif+Display:ital@0;1&family=Faustina:ital,wght@0,300..800;1,300..800&family=Send+Flowers&display=swap');
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
</head>
<body>
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
                <a class="nav-link active" aria-current="page" href="#" style="color: #2163b8;"><i class="fa-solid fa-house"></i> Accueil</a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link" href="interventions.php"><i class="fa-solid fa-briefcase"></i> Mes interventions</a>
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

        <div class="container text-center" style="margin-top: 100px;">
            <h1 style="color: white !important;font-family: 'Clicker Script' , cursive !important;">Bienvenue sur la plateforme ServExpert</h1>
            <p style="color: white !important;">Votre plateforme de mise en relation avec des techniciens qualifiés.</p>
        </div>

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Salut, <span style="color: #2163b8;"><?php echo htmlspecialchars($_SESSION['nom1']) ?></span></h5>
            <p class="card-text">Mettez votre savoir-faire au service de ceux qui en ont besoin.</p>
            <a href="interventions.php" class="btn btn-primary">Consulter</a>
        </div>
    </div>

    <script src="assets/js/utilities/popper.min.js"></script> 
    <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script src="assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>