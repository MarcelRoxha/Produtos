<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit;
} else {
    require_once './CLASSES/Produtos.php';
    $p = new Produtos;

    include_once("./dbconfig.php");

   if(isset($_GET['token'])){

        $id= $_GET['token'];
        $resultProduto = "SELECT * FROM produtos WHERE id = $id";
        $resultadoProdutos = mysqli_query($conection, $resultProduto);
        $produtoRecuperado = mysqli_fetch_assoc($resultadoProdutos);


        $result_categorias = "SELECT * FROM categorias";
        $resultado_categorias = mysqli_query($conection, $result_categorias);

    
   }
}
if(isset($_POST['atualizarproduto'])){

    $sku = addslashes($_POST['sku']);
    $nome = addslashes($_POST['nome']);
    $preco = addslashes($_POST['preco']);
    $quantidade = addslashes($_POST['quantidade']);
    $descricao = addslashes($_POST['descricao']);
    $categoria = $_POST['categoria'];
    $foto = $_FILES['imagem'];

    if (!empty($sku) && !empty($nome) && !empty($preco) && !empty($quantidade) && !empty($descricao) && isset($_FILES['imagem'])) {


        $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
        $novo_nome = md5(time()) . $extensao;
        $diretorio = "imagens/";

        move_uploaded_file($_FILES['imagem']['tmp_name'],  $diretorio . $novo_nome);

        $result_produto = " UPDATE produtos SET nome='$nome', SKU='$sku', descricao='$descricao', quantidade='$quantidade', preco='$preco', categorias='$categoria', foto='$novo_nome' WHERE id='$id'";
        $resultado_produto = mysqli_query($conection, $result_produto);

        if($resultado_produto = mysqli_query($conection, $result_produto)){

            $_SESSION['msgSucesso'] = "sucesso ao atualizar";
            header("location: listaProdutos.php");
            echo $_SESSION['msgSucesso'];
        } else {
            echo "Error ao atualizar";

        }

    
}}



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
                    <strong>
                        <h4 class="tituloCadastrarProduto">CADASTRAR PRODUTO</h4>
                    </strong>



                    <form method="POST" action="" enctype="multipart/form-data">


                        <div class="text-center">
                            <label label>Selecione a imagem</label>
                            <img style="width: 300px; height: 300px"><br><br>
                            <input type="file" name="imagem" id="image" onchange="previewImagem()"></input><br><br>

                        </div>


                        <div class="form-group">
                            <label>NOME:</label>
                            <input type="text" name="sku" class="form-control" required autocomplete="off" value="<?php echo $produtoRecuperado['SKU'] ?>">
                        </div>

                        <div class="form-group">
                            <label>SKU:</label>
                            <input type="text" name="nome" class="form-control" required autocomplete="off" value="<?php echo $produtoRecuperado['nome'] ?>">
                        </div>

                        <div class="form-group">
                            <label>DESCRI????O:</label>
                            <input type="text" name="preco" class="form-control" required autocomplete="off" value="<?php echo $produtoRecuperado['preco'] ?>">
                        </div>

                        <div class="form-group">
                            <label>QUANTIDADE:</label>
                            <input type="text" name="descricao" class="form-control" required autocomplete="off" value="<?php echo $produtoRecuperado['descricao'] ?>">
                        </div>

                        <div class="form-group">
                            <label>CATEGORIAS CADASTRADAS DO PRODUTO:</label>
                            <input type="text" name="categoria" class="form-control" required autocomplete="off" value="<?php echo $produtoRecuperado['categorias'] ?>">
                        </div>

                        <div class="form-group">
                            <label>PRE??O:</label>
                            <input type="text" name="quantidade" class="form-control" required autocomplete="off" value="<?php echo $produtoRecuperado['quantidade'] ?>">
                        </div>
                        <br>
                        <div class="form-control">

                            <div class="card border-primary mb-3">
                                <p class="text-center mt-12 text-info">Categorias Cadastrasdas</p>
                                <div class="card-body">
                                    <div class="justify-center-center">
                                        <table class="table table-dark table-hover mt-4 text-center ">
                                            <thead class="justify-center-center">
                                                <tr>
                                                    <th>SELECT#:</th>
                                                    <th>NOME</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                if (!empty($resultado_categorias)) {
                                                    while ($row_categoria = mysqli_fetch_assoc($resultado_categorias)) {
                                                ?>
                                                        <tr>
                                                            <td><input type="checkbox" name="ckCategoryAdd[]" value="<?php echo $row_categoria['nome']; ?>"></td>
                                                            <td><?php echo  $row_categoria['nome']; ?></td>


                                                        </tr>
                                                    <?php

                                                    }
                                                } else {
                                                    ?>
                                                    <tr>
                                                        <td colspan="8">Banco de dados sem informa????es inseridas</td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>

                                            </tbody>
                                        </table><br>

                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="form-control">
                                <a href="listaProdutos.php" class="btn btn-info">VOLTAR</a>
                                <input type="submit" name="atualizarproduto" class="btn btn-danger" value="ATUALIZAR PRODUTO"></input>
                            </div>


                    </form>

                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

                    <script>
                        function previewImagem() {
                            var imagem = document.querySelector('input[name=imagem]').files[0];
                            var preview = document.querySelector('img');
                            var reader = new FileReader();
                            reader.onload = function() {

                                preview.src = reader.result;

                            }

                            if (imagem) {
                                reader.readAsDataURL(imagem);
                            } else {
                                preview.src = "";
                            }
                        }
                    </script>
                </div>
            </div>
        </div>


    </div>
</body>

</html>