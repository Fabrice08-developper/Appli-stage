<?php
    session_start();
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
</head>
<style>
     body{
        background-image: url('images/WhatsApp\ Image\ 2025-08-22\ at\ 21.25.46_91e5e87c.jpg');
        background-repeat: no-repeat;
        background-size: cover;
        background-attachment: fixed;
        }
    .img{
        text-align: center;
        margin-top: 20px;
    }
    .card{
        margin: 20px auto;
        width: 80%;
        max-width: 600px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 70px !important;
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
</style>
<body>
    <div class="container">
        <div class="img justify-content-center">
            <a href="essai.html" style="text-decoration: none;"><i class="fa-solid fa-arrow-left" style="color: black;"><h2>Mon profil</h2></i></a>
            <img src="images/OIP-removebg-preview.png" alt="" style="width: 80px; height: auto;">
        </div>
        <div class="card">
            <div class="card-body">
                <i class="fa-solid fa-user"></i><h5 class="card-title">Nom d'utilisateur: <?php if(isset($_SESSION['nom'])){
                    echo htmlspecialchars($_SESSION['nom']);
                }?></h5>
                <i class="fa-solid fa-envelope"></i><p class="card-text">Email: <?php if(isset($_SESSION['email'])){
                    echo htmlspecialchars($_SESSION['email']);
                }?></p>
                <i class="fa-solid fa-cake-candles"></i><p class="card-text">Date de naissance: <?php if(isset($_SESSION['date'])){
                    echo htmlspecialchars($_SESSION['date']);
                }?></p>
                <p>Client</p>
            </div>
        </div>
    </div>        
    <script src="assets/js/utilities/popper.min.js"></script> 
  <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
  <script src="assets/js/bootstrap/bootstrap.js"></script>
</body>
</html>