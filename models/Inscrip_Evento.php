<?php
    class Inscrip_Evento extends Conectar{

        /* TODO: Obtener todos los registros */
        public function get_inscrip_evento(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            inscripcion_eventos.ID_inscrip,
            inscripcion_eventos.evento_id,
            inscripcion_eventos.grupo_id,
            eventos.codigo AS COD_EVENTO,
            grupos.codigo AS COD_GRUPO
            FROM inscripcion_eventos
            INNER JOIN eventos ON inscripcion_eventos.evento_id = eventos.ID_evento
            INNER JOIN grupos ON inscripcion_eventos.grupo_id = grupos.ID_grupo;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert Registro*/
        public function insert_inscrip_evento($evento_id,$grupo_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO inscripcion_eventos (ID_inscrip,evento_id, grupo_id) VALUES (null,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $evento_id);
            $sql->bindValue(2, $grupo_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update Registro*/
        public function update_inscrip_evento($ID_inscrip,$evento_id,$grupo_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE inscripcion_eventos set
                evento_id = ?,  
                grupo_id = ?        
                WHERE
                ID_inscrip = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $evento_id);
            $sql->bindValue(2, $grupo_id);
            $sql->bindValue(3, $ID_inscrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete Registro*/
        public function delete_inscrip_evento($ID_inscrip){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM inscripcion_eventos
                WHERE 
                ID_inscrip = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_inscrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_inscrip_evento_x_id($ID_inscrip){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM inscripcion_eventos WHERE ID_inscrip = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_inscrip);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>