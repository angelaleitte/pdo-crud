

<?php
require_once "conexao.php";
require_once "classe-pessoa.php";

$p = new Pessoa($db_name, $db_host, $db_user, $db_pass);



?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Cadastro</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="estilo.css" rel="stylesheet">
    </head>
    <body>
        <?php
           if(isset($_POST['nome'])){
                if(isset($_GET['id_up']) && !empty($_GET['id_up'])){
                    $id          = addslashes($_GET['id_up']);
                    $nome        = addslashes($_POST['nome']);
                    $telefone    = addslashes($_POST['telefone']);
                    $email       = addslashes($_POST['email']);
                    if(!empty($nome) && !empty($telefone) && !empty($email)){
                        if($p->atualizarPessoa($id, $nome, $telefone, $email)){
                            echo "Dados atualizados!"; 
                            header("location: index.php");
                        }else{
                            echo "E-mail já está cadastrado!";
                        }
                    }else{
                        echo "Preencha todos os campos!";
                    }
                }else{
                    $nome        = addslashes($_POST['nome']);
                    $telefone    = addslashes($_POST['telefone']);
                    $email       = addslashes($_POST['email']);
                    if(!empty($nome) && !empty($telefone) && !empty($email)){
                        if(!$p->cadastrarPessoa($nome, $telefone, $email)){
                            echo "E-mail já está cadastrado";
                        }
                    }else{
                        echo "Preencha todos os campos!";
                    }
                }

               

               
           }

           if(isset($_GET['id_up'])){
               $id_update = addslashes($_GET['id_up']);
               $res = $p->buscarDadosPessoa($id_update);
           }



        ?>
        <section id="esquerda">
            <form method="POST">
                <h2>Cadastrar Pessoa</h2>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" value="<?php if(isset($res)){echo $res['nome'];}?>"></input>

                <label for="telefone">Telefone</label>
                <input type="phone" name="telefone" id="telefone" value="<?php if(isset($res)){echo $res['telefone'];}?>"></input>

                <label for="email">E-mail</label>
                <input type="email"  name="email" id="email" value="<?php if(isset($res)){echo $res['email'];}?>"></input>

                <input type="submit" value="<?php if(isset($res)){echo "Atualizar";}else{echo "Cadastrar";}?>">
            </form>
        </section>

        <section id="direita">
            <table>
                    <tr id="titulo">
                        <td>NOME</td>
                        <td>TELEFONE</td>
                        <td colspan="2">EMAIL</td>
                    </tr>
                            <?php 
                                $dados = $p->buscarDados();
                                if(count($dados) > 0){
                                    for($i=0; $i < count($dados); $i++){
                                        echo "<tr>";
                                        foreach($dados[$i] as $k => $v){
                                            if($k != "id"){
                                                echo "<td>".$v."</td>";
                                            }
                                        } 
                                        echo "<td><a href='index.php?id_up=".$dados[$i]['id']."'>Editar</a>";
                                        echo "<a href='index.php?id=".$dados[$i]['id']."'>Excluir</a></td>";
                                        echo "</tr>"; 
                                    }
                                    
                                }else{
                                    echo "Ainda não há pessoas cadastradas!";
                                }
                            ?>
                 </tr>

             </table>
        </section>

    </body>
</html>

<?php

if(isset($_GET['id'])){
    $id = addslashes($_GET['id']);

    echo $p->excluirPessoa($id);
    header("location: index.php");

    


}

?>