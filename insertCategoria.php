<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("location: Home.php");
    exit;
} else {
    require_once './CLASSES/Categorias.php';
    $c = new Categorias;  
    include_once("./dbconfig.php");
   
}?>

<?php

if (isset($_POST['save_categoria'])) {
    $codigo = addslashes($_POST['codigo']);
    $nome = addslashes($_POST['nome']);
    

    if (!empty($codigo) && !empty($nome)) {
        $c->conectar("localhost", "root", "", "projetoprodutos");

        if ($c->msgError == "") {

            if ($c->cadastrar($codigo, $nome)) {
                $_SESSION['msgSucesso'] = "sucesso ao cadastrar";
                header("location: listaCategoria.php");
                echo $_SESSION['msgSucesso'];
                
                
            } else {
                echo "Error ao cadastrar";
            }
        }
    }
}


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Annie+Use+Your+Telescope&family=Handlee&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">





<div class="container justify-center-center">

<div class="col-md-12"><br>
<h3 class="text-center mt-4">Cadastrar Categoria</h3>
<div>
<a href="./Produt/insertPD.php" class="btn btn-primary mt-4">Cadastrar Produto</a>
</div>
<div class="card border-primary mb-3 mt-4">
<fieldset class="texte-center">

    <form method="POST" action="">
    <br>
    <div class="form-group">
                            <label>CODIGO:</label><br>
                            <input type="text" name="codigo" class="form-control" required autocomplete="off">
                        </div>
                        <br>

                        <div class="form-group">
                            <label>NOME:</label>
                            <input type="text" name="nome" class="form-control" required autocomplete="off">
                        </div>
                        <br>
    <div class="form-group text-center">
        <button type="text" name="save_categoria" class="btn btn-success">Salvar Categoria</button>
        <a href="listaCategoria.php" class="btn btn-secondary">Categorias cadastradas</a>
        <br>
    </div>
    <br class="mt-4">
    </form>
    </fieldset> 


</div>

    </div>      
</div>


