<?php
    include('connexion.php');
    session_start();

    $sql = 'SELECT * FROM technicien, domaine, maitriser 
        WHERE technicien.ID_TECH = maitriser.ID_TECH AND domaine.NUMERO = maitriser.NUMERO 
        AND technicien.ID_TECH = maitriser.ID_TECH
    ';
    $stmt = $monPDO->prepare($sql);
    $stmt->execute();
    $tech = $stmt->fetchAll(PDO::FETCH_ASSOC);


    if(isset($_GET['action']) && $_GET['action'] == 'delete'){

        $sq="DELETE FROM maitriser WHERE maitriser.ID_TECH = :id";
        $stmt=$monPDO->prepare($sq);
        $stmt->execute([':id'=> $_GET["id"]]);

        $sr = "DELETE FROM service WHERE ID_TECH = :id";
        $stmt=$monPDO->prepare($sr);
        $stmt->execute([':id'=>$_GET['id']]);

        $sr = "DELETE FROM messages WHERE ID_TECH = :id";
        $stmt=$monPDO->prepare($sr);
        $stmt->execute([':id'=>$_GET['id']]);

        $sr = "DELETE FROM note WHERE ID_TECH = :id";
        $stmt=$monPDO->prepare($sr);
        $stmt->execute([':id'=>$_GET['id']]);

        $sql="DELETE FROM technicien WHERE technicien.ID_TECH = :id";
        $stmt=$monPDO->prepare($sql);
        $stmt->execute([':id'=> $_GET["id"]]);

        header("Location: ListeTech.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Liste de techniciens</title>
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
                                <a href="#" class="sidebar-link">
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
            <div class="container mt-4">
                
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4>Liste des techniciens</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Nom du technicien</th>
                                        <th>Email</th>
                                        <th>Domaine</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for($i=0; $i<count($tech); $i++):?>
                                    <tr>
                                        <td><?php echo $tech[$i]['NOM_TECHNICIEN']; ?></td>
                                        <td><?php echo $tech[$i]['Email_tech']; ?></td>
                                        <td><?php echo $tech[$i]['NOM_DOMAINE']; ?></br><a href="ListeTech.php?id=<?= $tech[$i]['ID_TECH']; ?>&action=delete" class="btn btn-outline-danger btn-sm">Supprimer</a></td>
                                    </tr>
                                    <?php endfor?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <script src="assets/js/utilities/popper.min.js"></script> 
    <script src="assets/js/utilities/jquery-3.7.1.min.js"></script> 
    <script src="assets/js/bootstrap/bootstrap.js"></script>
    <script>
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const slidebar = document.getElementById('slidebar');

        sidebarToggle.addEventListener('click', () => {
            slidebar.classList.toggle('collapsed');
        });
    </script>
</body>
</html>