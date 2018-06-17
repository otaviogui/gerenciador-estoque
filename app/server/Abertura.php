<?php
    namespace app\server;
    use app\server\Conn;
    use PDO;

    class Abertura {

        public function getAll()
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM caixaabertura")->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function find($id)
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM caixaabertura WHERE id=".$id)->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function save( $abertura )
        {
            if( $abertura->funcionario <> "" and $abertura->abertura <> "" )
            {
                $st = Conn::getConn()->prepare("INSERT INTO caixaabertura VALUES (NULL, ?, ?, ?)");
                $st->bindParam(1, $abertura->data);
                $st->bindParam(2, $abertura->funcionario);
                $st->bindParam(3, $abertura->abertura);
                return $st->execute();
            }
            else
                return false;
        }
        public function trash($id)
        {
            $st = Conn::getConn()->prepare(" DELETE FROM caixaabertura WHERE id=? ");
            $st->bindParam(1, $id);
            return $st->execute();
        }

    }