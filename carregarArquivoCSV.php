<?php 

include_once("./dbconfig.php");
include_once("./CLASSES/Produtos.php");

session_start();

$produto = new Produtos();
$produto->conectar("localhost", "root", "", "projetoprodutos");

ini_set('max_execution_time', 0);   
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



<div class="text-center">
<label >Carregar Arquivo para banco de dados</label>



<form method="POST" action="" enctype="multipart/form-data">
<div>
<label>Arquivo</label>
<input type="file" name="arquivo"><br><br>        
<input type="submit" name="btSetar" value="Enviar">
</div>
</form>
</div>
</html>

<?php

        if(isset($_POST['btSetar'])){
            $caminhoArquivo = $_FILES['arquivo']['tmp_name']; // arquivo recebido processaimport
            $nomeArquivo = $_FILES['arquivo']['name']; // arquivo recebido processaimport
        
            $ext = explode(".", $nomeArquivo); //Dividindo o arquivo onde fica o . na string nomeArquivo passado 
            $extensao = end($ext); // pegando os ultimos caracteres da string nomeArquivo passado    
            
            if($extensao !="csv"){
            echo "Tipo de arquivo invalido, favor carregar arquivo com extensão CSV";
            }else{

                $produto->conectar("localhost", "root", "", "projetoprodutos");

                if($produto->msgError == ""){

                    
               
                 $cont = 0;       
                $objeto = fopen($caminhoArquivo, 'r'); //Abrindo o arquivo passado na tela processaimport 
                while(($dados = fgetcsv($objeto, 1000, ";"))){ // perconrrendo o arquivo que foi convertido em Array 

                  
                    if($cont > 0){
                        
                        $nome = utf8_decode($dados[0]);
                        $SKU = utf8_decode($dados[1]);
                        $descricao = utf8_decode($dados[2]);    
                        $quantidade = utf8_decode($dados[3]);
                        $preco = utf8_decode($dados[4]);
                        $cate =  utf8_decode($dados[5]);
                        $foto =  utf8_decode($dados[6]);
    
                        $produto->carregarArquivoCSV($nome, $SKU, $descricao, $quantidade, $preco, $cate, $foto);

                    }
                        $cont++;
                   
                    
                }                    

                $_SESSION['msgSucesso'] = "sucesso ao carregar arquivo CSV";
                header("location: listaProdutos.php");
                echo $_SESSION['msgSucesso'];
                    } 
             
            }
        }

?>