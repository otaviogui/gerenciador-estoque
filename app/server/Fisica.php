<?php
    namespace app\server;
    use app\server\Conn;
    use PDO;

    class Fisica {

        public function getAll()
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM fisica")->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function find($id)
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM fisica WHERE id=".$id)->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function save( $fisica )
        {
            if( $fisica->nome <> "" and $fisica->cpf <> "" and $fisica->telefone1 <> ""  )
            {
                $st = Conn::getConn()->prepare("INSERT INTO fisica VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $st->bindParam(1, $fisica->nome);
                $st->bindParam(2, $fisica->sobreNome);
                $st->bindParam(3, $fisica->rg);
                $st->bindParam(4, $fisica->cpf);
                $st->bindParam(5, $fisica->telefone1);
                $st->bindParam(6, $fisica->telefone2);
                $st->bindParam(7, $fisica->whatsApp);
                $st->bindParam(8, $fisica->facebook);
                $st->bindParam(9, $fisica->email);
                $st->bindParam(10, $fisica->descricao);
                return $st->execute();
            }
            else
                return false;
        }

        public function update( $fisica )
        {
            if( $fisica->id <> "" and $fisica->nome <> "" and $fisica->sobreNome <> "" and $fisica->cpf <> "" )
            {
                $st = Conn::getConn()->prepare(" UPDATE fisica SET nome=?, sobreNome=?, rg=?, cpf=?, telefone1=?, telefone2=?, whatsApp=?, facebook=?, email=?, descricao=? WHERE id=? ");
                $st->bindParam(1, $fisica->nome);
                $st->bindParam(2, $fisica->sobreNome);
                $st->bindParam(3, $fisica->rg);
                $st->bindParam(4, $fisica->cpf);
                $st->bindParam(5, $fisica->telefone1);
                $st->bindParam(6, $fisica->telefone2);
                $st->bindParam(7, $fisica->whatsApp);
                $st->bindParam(8, $fisica->facebook);
                $st->bindParam(9, $fisica->email);
                $st->bindParam(10, $fisica->descricao);
                $st->bindParam(11, $fisica->id);
                return $st->execute();
            }
            else
                return false;
        }

        public function trash($id)
        {
            $st = Conn::getConn()->prepare(" DELETE FROM fisica WHERE id=? ");
            $st->bindParam(1, $id);
            return $st->execute();
        }

    }