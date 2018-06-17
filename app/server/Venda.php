<?php
    namespace app\server;
    use app\server\Conn;
    use PDO;

    class Venda {

        public function getAll()
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM venda")->fetchAll(PDO::FETCH_ASSOC) );
        }

        public function find($id)
        {
            return json_encode( Conn::getConn()->query("SELECT * FROM venda WHERE id=".$id)->fetchAll(PDO::FETCH_ASSOC) );
        }
       
        public function save( $venda )
        {
            if( $venda->nomeProduto_id <> "" and $venda->quantidade <> "" and $venda->formaPagamento <> "" and $venda->valorTotal <> ""  )
            {
                $st = Conn::getConn()->prepare("INSERT INTO venda VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $st->bindParam(1, $venda->itensVenda_id);
                $st->bindParam(3, $venda->pessoaFisica_id);
                $st->bindParam(4, $venda->pessoaJuridica_id);
                $st->bindParam(5, $venda->valorDesconto);
                $st->bindParam(6, $venda->porcentagemDesconto);
                $st->bindParam(7, $venda->formaPagamento);
                $st->bindParam(8, $venda->parcelamento);
                $st->bindParam(9, $venda->valorTotal);
                return $st->execute();
            }
            else
                return false;
        }

        public function update( $venda )
        {
            if( $venda->nomeProduto_id <> "" and $venda->quantidade <> "" and $venda->formaPagamento <> "" and $venda->valorTotal <> "" )
            {
                $st = Conn::getConn()->prepare(" UPDATE venda SET nomeProduto_id=?, quantidade=?, pessoaFisica_id=?, pessoaJuridica_id=?, valorDesconto=?, porcentagemDesconto=?, formaPagamento=?, descricao=? WHERE id=? ");
                $st->bindParam(1, $venda->nomeProduto_id);
                $st->bindParam(2, $venda->quantidade);
                $st->bindParam(3, $venda->pessoaFisica_id);
                $st->bindParam(4, $venda->pessoaJuridica_id);
                $st->bindParam(5, $venda->valorDesconto);
                $st->bindParam(6, $venda->porcentagemDesconto);
                $st->bindParam(7, $venda->formaPagamento);
                $st->bindParam(8, $venda->parcelamento);
                $st->bindParam(9, $venda->valorTotal);
                $st->bindParam(10, $venda->id);
                return $st->execute();
            }
            else
                return false;
        }

        public function trash($id)
        {
            $st = Conn::getConn()->prepare(" DELETE FROM venda WHERE id=? ");
            $st->bindParam(1, $id);
            return $st->execute();
        }

    }