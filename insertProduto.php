<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit;
}else{
require_once './CLASSES/Produtos.php';
$p = new Produtos;

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

</head>
<title>CADASTRAR PODUTOS</title>

<body> 
    <div class="container">


<div class="box-insertP">
            <div class="row">
                <div class="col-md-6 insert-produto">
                    <h4>CADASTRAR PRODUTO</h4>
                    <form  method="POST" action="">
                        <div class="form-group">
                            <label>SKU:</label>
                            <input type="text" name="sku" class="form-control" required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>NOME:</label>
                            <input type="text" name="nome" class="form-control" required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>PREÇO:</label>
                            <input type="number" name="preco" class="form-control" required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>DESCRIÇÃO:</label>
                            <input type="text" name="descricao" class="form-control" required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>QUANTIDADE:</label>
                            <input type="number" name="quantidade" class="form-control" required autocomplete="off">
                        </div>

                        <div class="form-control">
<input type="submit" name="cadastrarproduto" class="btn btn-danger" value="CADASTRAR PRODUTO"></input>
</div>
                        
                        <div class="form-control">
                            <?php include('listaCategoria.php')?>
                        </div>
                        <br>

                        
                        
                    </form>
                </div>
            </div>
    </div>

    <?php

        if(isset($_POST['cadastrarproduto'])){
            $sku = addslashes($_POST['sku']);
            $nome = addslashes($_POST['nome']);
            $preco = addslashes($_POST['preco']);
            $quantidade = addslashes($_POST['quantidade']);
            $descricao = addslashes($_POST['descricao']);
            $categoria = $_POST['ckCategoryAdd'];
            
            if(!empty($sku) && !empty($nome) && !empty($preco) && !empty($quantidade) && !empty($descricao)){
                $p->conectar("localhost", "root", "", "projetoprodutos");

                if($p->msgError == ""){

                    if($p->cadastrar($sku, $nome, $preco, $quantidade, $descricao, $categoria)){
                        
                        echo "sucesso ao cadastrar"; 
                    }else{
                        echo "Error ao cadastrar"; 
                    }

                }
            }
        

        }


?>

</div>   
</body>

</html>
