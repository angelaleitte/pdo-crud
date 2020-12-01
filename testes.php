<?php
    //$db_name = 'u728442474_aulasajax;charset=utf8';
    $db_name = 'u728442474_aulasajax';
    $db_host = '177.234.145.195';
    $db_user = 'u728442474_angelaleite';
    $db_pass = 'nAg0Hk3An';

    try{
       $pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);
       //echo "ok";
    }catch(PDOException $e){   
       echo "Erro com BD: ".$e->getMessage();
    }catch(Exception $e){
        echo "Erro genérico".$e->getMessage();
    }



    //---------- insert -----------//
    //prepare -> é um comando usado para quando queremos modificar algo no banco
    //query -> é quando queremos passar os valores diretamente e já executar
    /*$sql = $pdo->prepare("INSERT INTO PESSOA(nome, telefone, email) VALUES (:n, :t, :e)");
    $sql->bindValue(":n", "Welliton");
    $sql->bindValue(":t", "16999999");
    $sql->bindValue(":e", "wel@gmail.com");
    $sql->execute();*/

    //$pdo->query("INSERT INTO PESSOA(nome, telefone, email) VALUES ('Angela', '16999999', 'angela@g.com.br')");
 
    //----------delete ----//
    /*$sql = $pdo->prepare("DELETE FROM PESSOA where id = :id");
    $sql->bindValue(':id', '2');
    $sql->execute();*/


    //---- atualizar ---->
    /*$sql = $pdo->prepare("UPDATE PESSOA SET email = :e where id= :id");
    $sql->bindValue(":e", 'angelita@gmail.com');
    $sql->bindValue(":id", '1');
    $sql->execute();*/


    //-- selecionar --->
    $sql = $pdo->prepare("SELECT * FROM PESSOA where id = :id");
    $sql->bindValue(':id', 1);
    $sql->execute();

    if($sql->rowCount() > 0){
        $dado = $sql->fetch(PDO::FETCH_ASSOC);
        echo "<pre>";
           print_r($dado);
        echo "</pre>";
        //echo $dado['nome'];

        echo "<table border='1'>";
        foreach($dado as $key => $value){
            echo "<tr>";
               echo "<td>".$key."</td><td>".$value."</td>";
            echo "</tr>";
        }
        echo "<table>";

        echo "<br>";
        echo "<br>";


        echo "<table border='1'>";
        echo "<tr>";
        foreach($dado as $key => $value){
               echo "<th>".$key."</th>";
        }
        echo "</tr>";
        echo "<tr>";
        foreach($dado as $key => $value){
            
               echo "<td>".$value."</td>";
            
        }
        echo "</tr>";
        echo "<table>";
    }

?>