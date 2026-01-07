<?php

    include('connexion.php');
    
        session_start();
    




        $req = " INSERT INTO service(ID_SERVICE, ID_TECH, NOM_SERVICE)
                VALUES (:id, :id_tech, :nom)";
        $stmt= $monPDO->prepare($req);
        $stmt->execute([
            ':id' => rand(1, 1000),
            ':id_tech' => 506,
            ':nom' => 'Gestion des parc informatique'
        ]); 
        
        
?>