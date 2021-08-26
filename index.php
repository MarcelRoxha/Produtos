<?php
require_once './CLASSES/Usuarios.php';
$u = new Usuarios;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Annie+Use+Your+Telescope&family=Handlee&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">

</head>
<title>Projeto Cadastro</title>

<body>

    <div class="container">
        <h2><strong>PROJETO CADASTRO DE PRODUTOS E CATEGORIAS</strong></h2>

     <?php  /***
      *     $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


        if (!empty($dados['cadastrar'])) {
            unset($dados['cadastrar']);


            $query_usuario = "INSERT INTO usuarios (nome, email,senha) VALUES ('" . $dados['nomeuserregistrarion'] . "', '" . $dados['emailregistration'] . "' , '" . $dados['senharegistration'] . "')";

            $cad_usuario =  $conection->prepare($query_usuario);
            $cad_usuario->execute();
        }

      */
    

        ?>
        <div class="login-box">
            <div class="row">
                <div class="col-md-6 login-left">
                    <h4>ACESSAR</h4>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" name="email" class="form-control" required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Senha:</label>
                            <input type="password" name="senha" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">ACESSAR</button>
                    </form>
                </div>
        

    
                <div class="col-md-6 login-right">
                    <h4>CADASTRAR</h4>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" name="nomeuserregistrarion" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>E-mail:</label>
                            <input type="email" name="emailregistration" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Senha:</label>
                            <input type="password" name="senharegistration" class="form-control" required>
                        </div>
                        <input type="submit" name="cadastrar" value="CADASTRAR" class="btn btn-primary"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if(isset($_POST['nomeuserregistrarion'])){

        $nome = addslashes($_POST['nomeuserregistrarion']);
        $email = addslashes($_POST['emailregistration']);
        $senha = addslashes($_POST['senharegistration']);

        if(!empty($nome) && !empty($email) && !empty($senha)){

            $u->conectar("localhost", "root", "", "usuario");
            if($u->msgError == ""){

                if($u->cadastrar($nome, $email, $senha)){
                   echo "sucesso ao cadastrar";     
                }else{
                    echo "E-mail ja cadastrado";
                }

            }else{
                echo "Error: ".$u->msgError;
            }
        }
        
    }
    

    if(isset($_POST['email'])){
        
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);

        if(!empty($email) && !empty($senha)){
        $u->conectar("localhost", "root", "", "usuario");

        if($u->msgError == ""){
            if($u->logar($email, $senha)){
                    header("location: Home.php");

            }else{

            }
        }
          
        }
        
    }
    
    ?>





</body>

</html>