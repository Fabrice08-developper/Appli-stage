<?php
 include('connexion.php');
 session_start();

        $sql1 = "SELECT * FROM technicien";
        $stmt = $monPDO->prepare($sql1);
        $stmt->execute();
        $techniciens = $stmt->fetchAll(PDO::FETCH_ASSOC);

   if(isset($_POST['nom']) && isset($_POST['tech'])){

        $nom = $_POST['nom'];
        $tech = $_POST['tech'];

        $sql = "SELECT * FROM technicien WHERE NOM_TECHNICIEN = :tech";
        $stmt = $monPDO->prepare($sql);
        $stmt->execute([':tech' => $tech]);
        $id_tech = $stmt->fetch(PDO::FETCH_ASSOC);
        var_dump($id_tech);
        $sql2 ="INSERT INTO service (ID_SERVICE, ID_TECH, NOM_SERVICE) VALUES (:ids, :id_tech, :nom)";
        $stmt = $monPDO->prepare($sql2);
        $stmt->execute([
            ':ids' => rand(1, 1000),
            ':id_tech' => $id_tech['ID_TECH'],
            ':nom' => $nom
        ]);

        header("location: admin.php?succes");
        exit();
   }else{
    echo "<script>Ajout service...</script>";
   }

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Ajout des services par l'administrateur</title>
   <link rel="stylesheet" href="styl.css">
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
                        <a href="admin.php" class="sidebar-link">
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
            </nav>
            <div class="content p-4">
               <h4>Ajouter un service</h4>
               <form method="post" class="mt-4">
                  <div class="mb-3 align-items-center">
                     <label for="nom" class="form-label">Nom du service</label>
                     <input type="text" class="form-control w-75" id="nom" name="nom" required>
                  </div>
                  <div class="mb-3">
                     <label for="domaine" class="form-label">Réalisé par</label>
                     <select class="form-select w-75" id="domaine" name="tech" required>
                        <option value="">Sélectionnez le technicien</option>
                        <?php for($i=0; $i<count($techniciens); $i++): ?>
                           <option value="<?= $techniciens[$i]['NOM_TECHNICIEN'] ?>"><?= $techniciens[$i]['NOM_TECHNICIEN'] ?></option>
                        <?php endfor; ?>
                     </select>
                  </div>
                  <button type="submit" name="Add" class="btn btn-outline-success btn-sm">Ajouter</button>
               </form>
        </div>
    </div> 
    
    <script src="assets/js/utilities/popper.min.js"></script> 
    <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script src="assets/js/bootstrap/bootstrap.js"></script>
    <script>
        const sidebarToggle = document.querySelector('#sidebar-toggle');
        sidebarToggle.addEventListener("click", function(){
            document.querySelector('#slidebar').classList.toggle('collapsed');
            document.querySelector('#nom').classList.toggle('w-100');
            document.querySelector('#prenom').classList.toggle('w-100');
            document.querySelector('#email').classList.toggle('w-100');
            document.querySelector('#telephone').classList.toggle('w-100');

        });
    </script>
</body>
</html>