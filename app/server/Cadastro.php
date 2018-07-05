<?php
    namespace app\server;
    use app\server\Conn;
    use PDO;

    class Cadastro {

        public function getAll()
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM cadastro")->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function find($id)
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM cadastro WHERE id=".$id)->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function save($cadastro)
        {
            if($cadastro->nome != "" && $cadastro->login != "" && $cadastro->senha != "")
            {
                $pass = $cadastro->senha;
                $senha = password_hash($pass, PASSWORD_DEFAULT);
                $st = Conn::getConn()->prepare("INSERT INTO cadastro VALUES (null, ?, ?, ?, ?, ?)");
                $st->bindParam(1, $cadastro->nome);
                $st->bindParam(2, $cadastro->sobre_nome);
                $st->bindParam(3, $cadastro->email);
                $st->bindParam(4, $cadastro->login);
                $st->bindParam(5, $senha);
                if($st->execute()){
                    return true;
                } else {
                    return false;
                }
                // return $st->fetch(PDO::FETCH_ASSOC);
            }
            else
                return false;
        }

        public function trash($id)
        {
            $st = Conn::getConn()->prepare(" DELETE FROM cadastro WHERE id=? ");
            $st->bindParam(1, $id);
            return $st->execute();
        }

    }