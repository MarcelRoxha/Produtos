<?php
include("./dbconfig.php");
session_start();

    
if(isset($_POST['btSetar'])){

    $caminhoArquivo = $_FILES['arquivo']['tmp_name']; // arquivo recebido processaimport
    $nomeArquivo = $_FILES['arquivo']['name']; // arquivo recebido processaimport

    $ext = explode(".", $nomeArquivo); //Dividindo o arquivo onde fica o . na string nomeArquivo passado 
    $extensao = end($ext); // pegando os ultimos caracteres da string nomeArquivo passado    
    
    if($extensao !="csv"){
    echo "Tipo de arquivo invalido, favor carregar arquivo com extensão CSV";
    }else{
        $row = 0;
        $objeto = fopen($caminhoArquivo, 'r'); //Abrindo o arquivo passado na tela processaimport 
        while(($dados = fgetcsv($objeto, 1000, ";"))){ // perconrrendo o arquivo que foi convertido em Array 
                                                       //do tipo String separado por ponto e virgula (CSV)
    
            $result[] = $dados;    
            $row++;  //Percorrendo o arquivo em array e contando as linhas do arquivo
            } 
            if($row > 410){ //Verificando se o arquivo tem o tamanho permitido para transição de dados do Firebase, ao todo da 280 linhas de excel
?>
                <div class="form-control text-center mt-4"><?php
                                echo "Arquivo excede o tamanho limite por upload, favor verifique se o arquivo contêm no máximo 400 linhas de dados <br />"
                                ?>
                </div>
                 <?php
            
            }else{
                    
$contador = 0;
$totallinhas = 15; //Limitação de tempo fire base            
$help = 0;
                        for($cc=0;$cc<=$totallinhas; $cc++){//Criando um for para percorrer os dados por linha e já salvando do FirebaseDatabase
                                
                            if($cc > 0 ){
                                $verificaCategoria = $database->getReference('categorias')->getSnapshot()->getValue();
                                $recebido [] = $result[$cc];
                            
                                    foreach($recebido as $re):

                                        $nome = utf8_decode($re[0]);
                                        $SKU = utf8_decode($re[1]);
                                        $descricao = utf8_decode($re[2]);    
                                        $quantidade = utf8_decode($re[3]);
                                        $preco = utf8_decode($re[4]);
                                        $cate =  utf8_decode($re[5]);
                                        $categoria = explode("|", $cate);
                                                                                           
                                             $novoImport = [                                       
                                                'Nome' => $nome,
                                                'SKU' => $SKU,
                                                'informacoescomplementares'=> $descricao,
                                                'quantidade'=> $quantidade,
                                                'preço' => $preco,
                                                'categorias'=> $categoria,
                                            ];             
                                            $itemImport = $database->getReference('produtos')->push($novoImport);
                                            unset($recebido); //Ao final está sendo reiniciada o Array que está recebendo os dados por linha 
                                        
                                                 endforeach;  
                                    }                         
                             }                
                        }
?> <br>
        <div class="form-control text-center mt-4"><?php
        echo 'Carregamento finalizado total de arquivos salvos:  '.$totallinhas.'<br />';
        ?><br>
        <a href="../Produt/listagemproduto.php" class="btn btn-primary">Listagem de Produtos</a><br><br>
        <?php '<br />\n' ?>
        <div>
        <a href="../Produt/processaimport.php" class="btn btn-danger">Importar outro arquivo</a><br>
        </div>
        </div>
                      
  <?php     
    }
}
?>