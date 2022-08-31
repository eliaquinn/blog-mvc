<?php

abstract class Connection { //o abstract serve para não deixar estanciar um objeto da classe
    private static $conn;
    
    public static function getConn () {
        if(self::$conn == null) { //esse if permite chamar apenas uma conexão por vez ao banco, conhecido como singleton
            //self é um atributo estatico, caso não seja eu uso o this->
            self::$conn = new PDO('pgsql:host=localhost;port=5432;dbname=mvc;', 'postgres', 'elha2');
        }

        return self::$conn;
    }
}
