<?php
    namespace app\server;
    use app\server\Conn;
    use PDO;

    class Produto {

        public function getAll()
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM produto")->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function find($id)
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM produto WHERE id=".$id)->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function save( $produto )
        {
            if( $produto->nome <> "" and $produto->quantidade <> "" and $produto->tamanho <> "" and $produto->valorAtacado <> ""  )
            {
                $st = Conn::getConn()->prepare("INSERT INTO produto VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $st->bindParam(1, $produto->nome);
                $st->bindParam(2, $produto->quantidade);
                $st->bindParam(3, $produto->tamanho);
                $st->bindParam(4, $produto->cor);
                $st->bindParam(5, $produto->tipo);
                $st->bindParam(6, $produto->modelo);
                $st->bindParam(7, $produto->valorCompra);
                $st->bindParam(8, $produto->valorVenda);
                $st->bindParam(9, $produto->valorAtacado);
                return $st->execute();
            }
            else
                return false;
        }

        public function update( $produto )
        {
            if( $produto->nome <> "" and $produto->quantidade <> "" and $produto->tamanho <> "" and $produto->valorAtacado <> "" )
            {
                $st = Conn::getConn()->prepare(" UPDATE produto SET nome=?, quantidade=?, tamanho=?, cor=?, tipo=?, modelo=?, valorCompra=?, valorVenda=?, valorAtacado=? WHERE id=? ");
                $st->bindParam(1, $produto->nome);
                $st->bindParam(2, $produto->quantidade);
                $st->bindParam(3, $produto->tamanho);
                $st->bindParam(4, $produto->cor);
                $st->bindParam(5, $produto->tipo);
                $st->bindParam(6, $produto->modelo);
                $st->bindParam(7, $produto->valorCompra);
                $st->bindParam(8, $produto->valorVenda);
                $st->bindParam(9, $produto->valorAtacado);
                $st->bindParam(10, $produto->id);
                return $st->execute();
            }
            else
                return false;
        }

        public function trash($id)
        {
            $st = Conn::getConn()->prepare(" DELETE FROM produto WHERE id=? ");
            $st->bindParam(1, $id);
            return $st->execute();
        }

    }