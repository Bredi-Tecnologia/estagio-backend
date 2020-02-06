<?php

class Conexao {
    private static $pdo;

    public static function getConection(){
        if(!isset(self::$pdo)){
            try {
                self::$pdo = new PDO("mysql:host=localhost;dbname=db_cadastro;charset=utf8", "root", "");
            } catch (PDOException $e){
                echo $e->getMessage();
            }
        }
        return self::$pdo;
    }
}