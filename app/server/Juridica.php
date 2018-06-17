<?php
    namespace app\server;
    use app\server\Conn;
    use PDO;

    class Juridica {

        public function getAll()
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM juridica")->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function find($id)
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM juridica WHERE id=".$id)->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function save( $juridica )
        {
            if( $juridica->razaoSocial <> "" and $juridica->cnpj <> "" and $juridica->telefone1 <> ""  )
            {
                $st = Conn::getConn()->prepare("INSERT INTO juridica VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
                $st->bindParam(1, $juridica->nome);
                $st->bindParam(2, $juridica->razaoSocial);
                $st->bindParam(3, $juridica->cnpj);
                $st->bindParam(4, $juridica->telefone1);
                $st->bindParam(5, $juridica->telefone2);
                $st->bindParam(6, $juridica->facebook);
                $st->bindParam(7, $juridica->email);
                $st->bindParam(8, $juridica->descricao);
                return $st->execute();
            }
            else
                return false;
        }

        public function update( $juridica )
        {
            if( $juridica->razaoSocial <> "" and $juridica->cnpj <> "" and $juridica->telefone1 <> "" )
            {
                $st = Conn::getConn()->prepare(" UPDATE juridica SET nome=?, razaoSocial=?, cnpj=?, telefone1=?, telefone2=?, facebook=?, email=?, descricao=? WHERE id=? ");
                $st->bindParam(1, $juridica->nome);
                $st->bindParam(2, $juridica->razaoSocial);
                $st->bindParam(3, $juridica->cnpj);
                $st->bindParam(4, $juridica->telefone1);
                $st->bindParam(5, $juridica->telefone2);
                $st->bindParam(6, $juridica->facebook);
                $st->bindParam(7, $juridica->email);
                $st->bindParam(8, $juridica->descricao);
                $st->bindParam(9, $juridica->id);
                return $st->execute();
            }
            else
                return false;
        }

        public function trash($id)
        {
            $st = Conn::getConn()->prepare(" DELETE FROM juridica WHERE id=? ");
            $st->bindParam(1, $id);
            return $st->execute();
        }

    }