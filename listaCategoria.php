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


<form method="POST">
<h3 class="text-center mt-12 text-info">Categorias Cadastrasdas</h3>

<div class="card border-primary mb-3">
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
                                            <td><input type="checkbox" name="ckCategoryAdd[]" value="<?php echo $row_categoria['id'];?>"></td>
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