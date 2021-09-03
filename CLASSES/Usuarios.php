<?php

class Usuarios
{

    private $pdo;

    public $nome;
    public $email;
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

    public function cadastrar($nome, $email, $senha)
    {
        global $pdo;

        //Verificar se user já tem cadastro

        try {

            $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e");
            $sql->bindValue(":e", $email);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                return false;
            } else {

                $sql = $pdo->prepare("INSERT INTO usuarios (nome, email,senha) VALUES (:n, :e, :s)");
                $sql->bindValue(":n", $nome);
                $sql->bindValue(":e", $email);
                $sql->bindValue(":s",$senha);
                $sql->execute();
                return true;
            }
            //code...
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
        }
    }

    public function logar($email, $senha)
    {
        global $pdo;

        try {

            $sql = $pdo->prepare("SELECT id FROM usuarios WHERE email = :e AND senha = :s");
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", $senha);
            $sql->execute();

            if ($sql->rowCount() > 0) {
                //Entrar na area privada

                $dados = $sql->fetch();
                session_start();
                $_SESSION['id_usuario'] = $dados['id'];
                echo $_SESSION['id_usuario'];
                return true;
            } else {

                return false;
            }


            //code...
        } catch (PDOException $e) {
            $msgError = $e->getMessage();
        }
    }
};
