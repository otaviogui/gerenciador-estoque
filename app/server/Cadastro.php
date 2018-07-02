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
            if($cadastro->nome <> "" and $cadastro->login <> "" and $cadastro->senha <> "")
            {
                /* $senha = password_hash($cadastro->senha); */
                $st = Conn::getConn()->prepare("INSERT INTO cadastro VALUES (null,?, ?, ?, ?, ?)");
                $st->bindParam(1, $cadastro->nome);
                $st->bindParam(2, $cadastro->sobre_nome);
                $st->bindParam(3, $cadastro->email);
                $st->bindParam(4, $cadastro->login);
                $st->bindParam(5, $cadastro->senha);
                $st->execute();
                return $st->fetch(PDO::FETCH_ASSOC);
            }
            else
                return false;
        }

        public function update( $cadastro )
        {
            if( $cadastro->id <> "" and $cadastro->nome <> "" and $cadastro->descricao <> "" and $cadastro->raca <> "" and $cadastro->cor <> "" and $cadastro->idade <> "" and $cadastro->sexo <> "" and $cadastro->imagem <> "" )
            {
                $st = Conn::getConn()->prepare(" UPDATE cadastro SET nome=?, descricao=?, raca=?, cor=?, idade=?, sexo=?, imagem=? WHERE id=? ");
                $st->bindParam(1, $cadastro->nome);
                $st->bindParam(2, $cadastro->descricao);
                $st->bindParam(3, $cadastro->raca);
                $st->bindParam(4, $cadastro->cor);
                $st->bindParam(5, $cadastro->idade);
                $st->bindParam(6, $cadastro->sexo);
                $st->bindParam(7, $cadastro->imagem);
                $st->bindParam(8, $cadastro->id);
                return $st->execute();
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