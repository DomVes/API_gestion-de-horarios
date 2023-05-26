<?php
    class Grupo extends Conectar{

        /* TODO: Obtener todos los registros */
        public function get_grupo(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM grupos";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert Registro*/
        public function insert_grupo($codigo,$numero_de_grupo,$cantidad_de_estudiantes){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO grupos (ID_grupo, codigo, numero_de_grupo,cantidad_de_estudiantes) VALUES (NULL,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $codigo);
            $sql->bindValue(2, $numero_de_grupo);
            $sql->bindValue(3, $cantidad_de_estudiantes);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update Registro*/
        public function update_grupo($ID_grupo,$codigo,$numero_de_grupo,$cantidad_de_estudiantes){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE grupos set
                codigo = ?,
                numero_de_grupo = ?,
                cantidad_de_estudiantes = ?
                WHERE
                ID_grupo = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $codigo);
            $sql->bindValue(2, $numero_de_grupo);
            $sql->bindValue(3, $cantidad_de_estudiantes);
            $sql->bindValue(4, $ID_grupo);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete Registro*/
        public function delete_grupo($ID_grupo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM grupos
                WHERE 
                ID_grupo = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_grupo);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_grupo_x_id($ID_grupo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM grupos WHERE ID_grupo = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_grupo);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>