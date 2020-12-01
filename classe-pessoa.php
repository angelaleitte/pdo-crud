<?php
class Pessoa{

    private $pdo;
    public function __construct($db_name, $db_host, $db_user, $db_pass){
       try{
        $this->pdo = new PDO("mysql:dbname=".$db_name.";host=".$db_host, $db_user, $db_pass);
        //echo "ok";   
    }catch(PDOException $e){
         echo "Erro BD: ".$e->getMessage();
         exit();
       }catch(Exception $e){
        echo "Erro Qualquer: ".$e->getMessage();
       }
    }


    public function buscarDados(){
        $res = [];
        $sql = $this->pdo->query("SELECT * from PESSOA order by nome");
        $res = $sql->fetchAll(PDO::FETCH_ASSOC);

        return $res;
    }

    public function cadastrarPessoa($nome, $telefone, $email){
        $sql = $this->pdo->prepare("SELECT *  from PESSOA where email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();

        if($sql->rowCount() > 0){
            return false;
        }else{
            $sql = $this->pdo->prepare("INSERT INTO PESSOA(nome, telefone, email) VALUES(:nome, :telefone, :email)");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":telefone", $telefone);
            $sql->bindValue(":email", $email);
            $sql->execute();
            return true;
        }
    }


    public function excluirPessoa($id){
        
            $sql = $this->pdo->prepare("DELETE FROM PESSOA where id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();


    }

    public function buscarDadosPessoa($id){
        $dados = [];
        $sql = $this->pdo->prepare("SELECT * FROM PESSOA where id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
        $dados = $sql->fetch(PDO::FETCH_ASSOC);

        return $dados;
    }




    public function atualizarPessoa($id, $nome, $telefone, $email){  
        //verifico se o e-mail já está cadastrado
        $sql = $this->pdo->prepare("SELECT * from PESSOA where email = :email");
        $sql->bindValue(":email", $email);
        $sql->execute();
        
        //caso esteja, verifico se o e-mail cadastrado é do id que estou editando
        //se não for eu não deixo alterar
        if($sql->rowCount() > 0){
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if($result['id'] == $id){
                $sql = $this->pdo->prepare("UPDATE PESSOA SET nome = :nome, telefone = :telefone, email = :email where id = :id");
                $sql->bindValue(':id', $id);
                $sql->bindValue(':nome', $nome);
                $sql->bindValue(':telefone', $telefone);
                $sql->bindValue(':email', $email);
                $sql->execute();
                return true;
            }else{
                return false;
            }
        }
    }
}

?>