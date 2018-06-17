<?php
    namespace app\server;
    use app\server\Conn;
    use PDO;

    class Fechamento {

        public function getAll()
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM caixafechamento")->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function find($id)
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM caixafechamento WHERE id=".$id)->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function save( $fechamento )
        {
            if( $fechamento->funcionario <> "" and $fechamento->fechamento <> "" )
            {
                $st = Conn::getConn()->prepare("INSERT INTO caixafechamento VALUES (NULL, ?, ?, ?)");
                $st->bindParam(1, $fechamento->data);
                $st->bindParam(2, $fechamento->funcionario);
                $st->bindParam(3, $fechamento->fechamento);
                return $st->execute();
                
            }
            else
                return false;
        }
        public function trash($id)
        {
            $st = Conn::getConn()->prepare(" DELETE FROM caixafechamento WHERE id=? ");
            $st->bindParam(1, $id);
            return $st->execute();
        }

    }