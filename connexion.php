<?php
    const HOST = 'localhost';
    const DBNAME = 'base_servexpert';
    const USER = 'root';
    const PASS = '';

    try{
        $connexion = 'mysql:host='.HOST.';dbname='.DBNAME.';charset=utf8';
        $monPDO = new PDO($connexion, USER, PASS, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e){
        $message = "Erreur de connexion a la base de donnees".$e->getMessage();
        die($message);
    }
?>