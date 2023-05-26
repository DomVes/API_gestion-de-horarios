<?php
require 'config/conexion.php';
    class Aula extends Conectar{

        /* TODO: Obtener todos los registros */
        public function get_aula(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM aulas";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        function get_total_aulas(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM aulas";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        /* TODO:Insert Registro*/
        public function insert_aula($bloque,$numero,$descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO aulas (ID_aula, numero_de_aula, bloque, descripcion) VALUES (NULL,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $bloque);
            $sql->bindValue(2, $numero);
            $sql->bindValue(3, $descripcion);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update Registro*/
        public function update_aula($ID_aula,$bloque,$numero,$descripcion){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE aulas set
                numero_de_aula = ?,
                bloque = ?,
                descripcion = ?
                WHERE
                ID_aula = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $bloque);
            $sql->bindValue(2, $numero);
            $sql->bindValue(3, $descripcion);
            $sql->bindValue(4, $ID_aula);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete Registro*/
        public function delete_aula($ID_aula){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM aulas
                WHERE 
                ID_aula = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_aula);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_aula_x_id($ID_aula){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM aulas WHERE ID_aula = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_aula);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>