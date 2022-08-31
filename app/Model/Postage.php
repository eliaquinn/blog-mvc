<?php
//MODEL
// essa model fica responsavel de se conectar com o banco e trazer todos os posts e jogar para o controller (HomeController)

class Postage {
    public static function selectAll () { //o static significa que vc pode chamar a classe e metodo sem precisar criar um objeto
        $conn = Connection::getConn();
        
        $sql = "SELECT * FROM  postagem ORDER BY id DESC";
        $sql = $conn->prepare($sql);
        $sql->execute();

        //para não recuperar os dados como array é feito isso abaixo.
        $result = array();

        while($row = $sql->fetchObject('Postage')) { //pega item a item e joga no array result
            $result[] = $row;
        }

        if(!$result) { //caso o array não existir ele vai lançar uma exceção.
            throw new Exception("Não foi encontrado nenhum registro no banco!");
        }

        return $result;
    }

    public static function selectForId ($id) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM postagem WHERE id = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        $result = $sql->fetchObject('Postage');

        if(!$result) {
            throw new Exception("A postagem que procura deve ter sido apagada.");
        } else {
            $result->comentarios = Coments::selectComents($result->id);
        }

        return $result;
    }

    public static function insert ($dataPost) {
        if(empty($dataPost['titulo']) OR  empty($dataPost['content'])) {
            throw new Exception('Preecha todos os campos!');

            return false;
        }

        $conn = Connection::getConn();

        $sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:title, :content);";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':title', $dataPost['titulo']);
        $sql->bindValue(':content', $dataPost['content']);
        $result = $sql->execute();

        // não usar if dentro do controle, apenas do model
        if($result == 0) {
            throw new Exception('Falha ao inserir post!');

            return false;
        }

        return true;
    }

    public static function update ($params) {
        $con = Connection::getConn();

        $sql = "UPDATE postagem SET titulo = :title, conteudo = :content WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $params['id']);
        $sql->bindValue(':title', $params['titulo']);
        $sql->bindValue(':content', $params['content']);
        $result = $sql->execute();

        if($result == 0) {
            throw new Exception('Falha ao modificar a publicação!');

            return false;
        }

        return true;
    }

    public static function delete ($id) {
        $con = Connection::getConn();

        $sql = "DELETE FROM postagem WHERE id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);
        $result = $sql->execute();

        if($result == 0) {
            throw new Exception('Falha ao deletar a publicação!');

            return false;
        }

        return true;
    }
}