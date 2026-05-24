<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ServXpert</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"/>
    <link rel="icon" type="image/x-icon" href="images/logo-app.png">
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">-->
</head>
  <style>
        body {
            height: 100vh;
            background: url(images/accueil.jpg);
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
        }
        .btn-custom {
            width: 200px;
            padding: 12px;
            border-radius: 30px;
            font-size: 18px;
            font-weight: 600;
            margin: 10px;
            background: linear-gradient(to right, #031c3e, #9ad7e8);
            border: none;
            color: white;
        }

        .btn-custom:hover {
            background:  #031c3e;
            transition: 0.3s ease-in-out;
            transform: translateY(-7px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            color: white;
        }
        .img{
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div>
        <div class="img">
            <img src="images/logo-app.png" alt="">
        </div>
        <h1 class="fw-bold mb-3">ServExpert</h1>
        <p class="mb-4">La plateforme qui répond à tous vos besoins techniques.</p>

        <a href="signup.php" class="btn btn-light btn-custom">Commencer</a>
    </div>

    
    
    <!--<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>-->

    <script src="assets/js/utilities/popper.min.js"></script> 
    <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script src="assets/js/bootstrap/bootstrap.js"></script> 
</body>
</html>
<?php
    include('connexion.php');
?>