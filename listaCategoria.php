<?php
if (!isset($_SESSION['id_usuario'])) {
    header("location: Home.php");
    exit;
} else {
    
    include_once("./dbconfig.php");
    $result_categorias = "SELECT * FROM categorias";
    $resultado_categorias = mysqli_query($conection, $result_categorias);
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
<form method="POST">
<h3 class="text-center mt-12 text-info">Categorias Cadastrasdas</h3>

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

                            if(!empty($resultado_categorias)){



                                while ($row_categoria = mysqli_fetch_assoc($resultado_categorias)) {


                                    ?>
                                        <tr>
                                            <td><input type="checkbox" name="ckCategoryAdd[]" value="<?php echo $row_categoria['nome'];?>"></td>
                                            <td><?php echo  $row_categoria['nome']; ?></td>
                                            
                                            
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
</form>
</body>

</html>

