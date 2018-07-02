<?php
    namespace app\server;

    use app\server\Conn;

    class Login {

        public static function logar($login, $pass){
            $senha = password_hash($pass);
            $result = Conn::getConn()->prepare("SELECT * FROM cadastro WHERE login=? AND senha=?");
            $result->bindValue(1, $login);
            $result->bindValue(2, $senha);
            try{
                $result->execute();
                return $result->rowCount();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            
        }        

    }