<?php

class Coments {
    public static function selectComents ($idPost) {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM comentarios WHERE id_postagem = :id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();

        $result = array();

        while($row = $sql->fetchObject('Coments')) {
            $result[] = $row;
        }

        return $result;
    }

    public static function insertComent ($reqPost) {
        $conn = Connection::getConn();

        $sql = "INSERT INTO comentarios (nome, mensagem, id_postagem) VALUES (:nom, :msg, :idp)";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':nom', $reqPost['nome']);
        $sql->bindValue(':msg', $reqPost['comentario']);
        $sql->bindValue(':idp', $reqPost['id']);
        $sql->execute();

        if($sql->rowCount()) {
            return true;
        }

        throw new Exception("Falha na inserção do comentário!");
    }
}