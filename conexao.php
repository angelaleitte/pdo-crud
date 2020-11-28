<?php
    $db_name = 'u728442474_aulasajax;charset=utf8';
    $db_host = '177.234.145.195';
    $db_user = 'u728442474_angelaleite';
    $db_pass = 'nAg0Hk3An';

    try{
       $pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);
       echo "ok";
    }catch(PDOException $e){
       echo "Erro com BD: ".$e->getMessage();
    }catch(Exception $e){
        echo "Erro genérico".$e->getMessage();
    }

?>