<?php
    class Materia extends Conectar{

        /* TODO: Obtener todos los registros */
        public function get_materia(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT 
            materias.ID_materia,
            materias.id_grupo,
            materias.nombre,
            materias.docente_id,
            aulas.bloque,
            aulas.numero_de_aula,
            tm_usuario.usu_nom,
            grupos.codigo
            FROM materias 
            INNER JOIN tm_usuario ON materias.docente_id = tm_usuario.usu_id
            INNER JOIN grupos ON materias.id_grupo = grupos.ID_grupo
            INNER JOIN aulas ON materias.aula_id = aulas.ID_aula;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert Registro*/
        public function insert_materia($id_grupo,$nombre,$docente_id,$aula_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO materias (ID_materia, id_grupo, nombre,docente_id,aula_id) VALUES (NULL,?,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_grupo);
            $sql->bindValue(2, $nombre);
            $sql->bindValue(3, $docente_id);
            $sql->bindValue(4, $aula_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update Registro*/
        public function update_materia($ID_materia,$id_grupo,$nombre,$docente_id,$aula_id){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE materias set
                id_grupo = ?,
                nombre = ?,
                docente_id = ?, 
                aula_id = ?             
                WHERE
                ID_materia = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $id_grupo);
            $sql->bindValue(2, $nombre);
            $sql->bindValue(3, $docente_id);
            $sql->bindValue(4, $aula_id);
            $sql->bindValue(5, $ID_materia);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete Registro*/
        public function delete_materia($ID_materia){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM materias
                WHERE 
                ID_materia = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_materia);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        function get_total_materias(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) as TOTAL FROM materias";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
        /* TODO:Registro x id */
        public function get_materia_x_id($ID_materia){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM materias WHERE ID_materia = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_materia);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>