<?php
    namespace app\server;

    use app\server\Conn;

    class Login {

        public static function logar($login){
            $result = Conn::getConn()->prepare("SELECT * FROM cadastro WHERE login=? ");
            $result->bindValue(1, $login->login);
            
            try{
                $result->execute();
                
                $user = $result->fetch();

                if ($user && password_verify($login->senha, $user['senha']))
                {
                   $_SESSION['login'] = $login->login;
                   $_SESSION['senha'] = $login->senha;
                } else {
                    return false;
                }
                
                
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            
        }        

    }