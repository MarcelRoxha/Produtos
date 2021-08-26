<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("location: Home.php");
    exit;
} else {

    include_once("./dbconfig.php");
    $result_produtos = "SELECT * FROM produto";
    $resultado_produtos = mysqli_query($conection, $result_produtos);
}
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

    <div class="container justify-center-center">
        <div class="col-md-12 mt-4">
            <h2 ><strong>PRODUTOS CADASTRADOS</strong></h2>
           
            <br>
            <div class="form-group text-start">
                <a href="insertPD.php" class="btn btn-primary">Adicionar Produto</a>
            </div><br>
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <div class="justify-center-center">
                        <table class="table table-dark table-hover mt-4 text-center ">
                            <thead class="justify-center-center">
                                <tr>
                                    <th>Codigo(SKU)</th>
                                    <th>Nome</th>
                                    <th>Quantidade</th>
                                    <th>Preco</th>
                                    <th>Descricao</th>
                                    <th>Categorias</th>
                                    <th>Editar</th>
                                    <th>Deletar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                            if(!empty($resultado_produtos)){



                                while ($row_usuario = mysqli_fetch_assoc($resultado_produtos)) {


                                    ?>
                                        <tr>
                                            <td><?php echo  $row_usuario['SKU']; ?></td>
                                            <td><?php echo  $row_usuario['nome']; ?></td>
                                            <td><?php echo $row_usuario['quant']; ?></td>
                                            <td><?php echo  $row_usuario['preco']; ?></td>
                                            <td><?php echo  $row_usuario['descricao']; ?></td>
                                            <td><?php echo  $row_usuario['categoria']; ?></td>
                                            <td>
                                                <a href="editproduto.php?token=<?php echo $key ?>" class="btn btn-primary">EDITAR</a>
                                            </td>
                                            <td>
                                                <a href="deletarproduto.php?token=<?php echo $key ?>" class="btn btn-danger">DELETAR</a>
                                            </td>
                                        </tr>
                                       <?php
    
                                            }
                                   
                                    


                            }else{
                                ?>
                                <tr>
                                <td colspan="8">Banco de dados sem informações inseridas</td>
                            </tr>
<?php
                            }
?>

                            </tbody>
                        </table><br>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>