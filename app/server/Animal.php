<?php
    namespace app\server;
    use app\server\Conn;
    use PDO;

    class Animal {

        public function getAll()
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM animais")->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function find($id)
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM animais WHERE id=".$id)->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function save( $animal )
        {
            if( $animal->nome <> "" and $animal->descricao <> "" and $animal->raca <> "" and $animal->cor <> "" and $animal->idade <> "" and $animal->sexo <> "" and $animal->imagem <> "" )
            {
                $st = Conn::getConn()->prepare("INSERT INTO animais VALUES (NULL, ?, ?, ?, ?, ?, ?, ?)");
                $st->bindParam(1, $animal->nome);
                $st->bindParam(2, $animal->descricao);
                $st->bindParam(3, $animal->raca);
                $st->bindParam(4, $animal->cor);
                $st->bindParam(5, $animal->idade);
                $st->bindParam(6, $animal->sexo);
                $st->bindParam(7, $animal->imagem);
                return $st->execute();
            }
            else
                return false;
        }

        public function update( $animal )
        {
            if( $animal->id <> "" and $animal->nome <> "" and $animal->descricao <> "" and $animal->raca <> "" and $animal->cor <> "" and $animal->idade <> "" and $animal->sexo <> "" and $animal->imagem <> "" )
            {
                $st = Conn::getConn()->prepare(" UPDATE animais SET nome=?, descricao=?, raca=?, cor=?, idade=?, sexo=?, imagem=? WHERE id=? ");
                $st->bindParam(1, $animal->nome);
                $st->bindParam(2, $animal->descricao);
                $st->bindParam(3, $animal->raca);
                $st->bindParam(4, $animal->cor);
                $st->bindParam(5, $animal->idade);
                $st->bindParam(6, $animal->sexo);
                $st->bindParam(7, $animal->imagem);
                $st->bindParam(8, $animal->id);
                return $st->execute();
            }
            else
                return false;
        }

        public function trash($id)
        {
            $st = Conn::getConn()->prepare(" DELETE FROM animais WHERE id=? ");
            $st->bindParam(1, $id);
            return $st->execute();
        }

    }