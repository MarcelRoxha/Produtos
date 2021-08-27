<?php

class Categorias
{

    private $pdo;

    public $codigo;
    public $nome;
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

    public function cadastrar($codigo, $nome)
    {
        global $pdo;

        //Verificar se user já tem cadastro

        try {

            $sql = $pdo->prepare("SELECT id FROM categorias WHERE nome = :n");

            $sql->bindValue(":n", $nome);

            $sql->execute();

            if ($sql->rowCount() > 0) {
                return false;
            } else {

                $sql = $pdo->prepare("INSERT INTO categorias (codigo, nome) VALUES (:c, :n)");
                $sql->bindValue(":sku", $codigo);
                $sql->bindValue(":n", $nome);
                $sql->execute();
                return true;
            }
            //code...
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
        }
    }

    public static function listar()
    {
        global $pdo;

        try {


            include_once("./dbconfig.php");



            $result_categorias = "SELECT * FROM categorias";
            $resultado_categorias = mysqli_query($conection, $result_categorias);

            if ($resultado_categorias !== null) {
                $a = [];

                while ($row_usuario = mysqli_fetch_assoc($resultado_categorias)) {                    
                    $a['catego'] =   $row_usuario['nome'];              
                }

                return $a;
            } else {
                return false;
            }
            
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
        }
    }
};
