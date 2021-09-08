<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("location: index.php");
    exit;
} else {
    
    include_once("./dbconfig.php");

   if(isset($_GET['token'])){

        $id= $_GET['token'];
        $result_produto = " DELETE FROM produtos  WHERE id='$id'";
        $resultado_produto = mysqli_query($conection, $result_produto);

        if($resultado_produto = mysqli_query($conection, $result_produto)){

            $_SESSION['msgSucesso'] = "Produto excluido";
            header("location: listaProdutos.php");
            echo $_SESSION['msgSucesso'];
        } else {
            echo "Error ao deletar";

        }

    
   }
}




















?>