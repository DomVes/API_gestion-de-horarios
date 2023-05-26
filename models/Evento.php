<?php
    class Evento extends Conectar{

        /* TODO: Obtener todos los registros */
        public function get_evento(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM eventos";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert Registro*/
        public function insert_evento($codigo,$fecha,$duracion,$objetivo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO eventos (ID_evento, codigo, fecha,duracion, objetivo) VALUES (NULL,?,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $codigo);
            $sql->bindValue(2, $fecha);
            $sql->bindValue(3, $duracion);
            $sql->bindValue(4, $objetivo);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update Registro*/
        public function update_evento($ID_evento,$codigo,$fecha,$duracion,$objetivo){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE eventos set
                codigo = ?,
                fecha = ?,
                duracion = ?,
                objetivo = ?
                WHERE
                ID_evento = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $codigo);
            $sql->bindValue(2, $fecha);
            $sql->bindValue(3, $duracion);
            $sql->bindValue(4, $objetivo);
            $sql->bindValue(5, $ID_evento);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete Registro*/
        public function delete_evento($ID_evento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM eventos
                WHERE 
                ID_evento = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_evento);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO: Total de eventos*/
        public function get_total_eventos(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM eventos";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_evento_x_id($ID_evento){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM eventos WHERE ID_evento = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_evento);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>