<?php

class Produtos
{

    private $pdo;

    public $SKU;
    public $nome;
    public $preco;
    public $descricao;
    public $quant;
    public $categoria;
    public $msgError;


    public function conectar($host, $user, $pass, $dbname)
    {
        global $pdo;
        try {
            $pdo = new PDO("mysql: mysql: host=$host;dbname=" . $dbname, $user, $pass);
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
        }
    }

    public function cadastrar($SKU, $nome, $preco, $descricao, $quant, $categoria, $foto)
    {
        global $pdo;

        //Verificar se user já tem cadastro

        try {

            $sql = $pdo->prepare("SELECT id FROM produtos WHERE nome = :n");
            
            $sql->bindValue(":n", $nome);
            
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return false;
            } else {

                $sql = $pdo->prepare("INSERT INTO produtos (SKU, nome,preco ,descricao, quantidade, categorias, foto) VALUES (:sku, :n, :p, :d, :q, :c, :f)");
                
                $category = implode(",", $categoria);
                
                
                $sql->bindValue(":sku", $SKU);
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":p", $preco);
                $sql->bindValue(":d", $descricao);
                $sql->bindValue(":q", $quant);
                $sql->bindValue(":c", $category);
                $sql->bindValue(":f", $foto);
                $sql->execute();
                return true;

               
            }
            //code...
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
        }
    }

    public function listar()
    {
        global $pdo;

        try {

            
           include_once("./dbconfig.php");

            

                $result_usuario = "SELECT * FROM produto";
                $resultado_usuario = mysqli_query($conection, $result_usuario);

                if($resultado_usuario > 0){
                    while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
                        $_POST['skuBD'] =   $row_usuario['SKU'];
                        $_POST['nomeDB'] =   $row_usuario['nome'];
                        $_POST['preoDB'] =   $row_usuario['preco'];
                        $_POST['quantDB'] =   $row_usuario['quant'];
                        $_POST['categoDB'] =   $row_usuario['categoria'];
                        $_POST['descriDB'] =   $row_usuario['descricao'];
     
     
                         echo  $_POST['skuBD'];
                         echo  $_POST['nomeDB'];
                         echo  $_POST['preoDB'];
                         echo  $_POST['quantDB'];
                         echo  $_POST['categoDB'];
                         echo  $_POST['skuBdescriDBD'];
     
                }

                return true;

                 }else{
                     return false;
                 }
                //Entrar na area privada

                $dados = $sql->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dados['id'];
           


            //code...
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
        }
    }
};
