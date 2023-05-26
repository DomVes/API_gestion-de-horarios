<?php
    class Horarios extends Conectar{

        /* TODO: Obtener todos los registros */
        public function get_horario(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
            asignacion_horarios.ID_horario,
            asignacion_horarios.ID_aula,
            asignacion_horarios.ID_materia,
            asignacion_horarios.ID_grupo,
            asignacion_horarios.hora_inicio,
            asignacion_horarios.hora_fin,
            asignacion_horarios.dia_de_la_semana,
            aulas.ID_aula,
            aulas.numero_de_aula,
            aulas.bloque,
            aulas.descripcion,
            materias.ID_materia,
            materias.nombre,
            grupos.ID_grupo,
            grupos.codigo
            FROM asignacion_horarios
            INNER JOIN aulas ON asignacion_horarios.ID_aula = aulas.ID_aula
            INNER JOIN materias ON asignacion_horarios.ID_materia = materias.ID_materia
            INNER JOIN grupos ON asignacion_horarios.ID_grupo = grupos.ID_grupo;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Insert Registro*/
        public function insert_horario($ID_aula,$ID_materia,$ID_grupo,$hora_inicio,$hora_fin,$dia_de_la_semana){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="INSERT INTO asignacion_horarios (
                ID_horario, 
                ID_aula, 
                ID_materia,
                ID_grupo, 
                hora_inicio,
                hora_fin,
                dia_de_la_semana) 
                VALUES (NULL,?,?,?,?,?,?);";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_aula);
            $sql->bindValue(2, $ID_materia);
            $sql->bindValue(3, $ID_grupo);
            $sql->bindValue(4, $hora_inicio);
            $sql->bindValue(5, $hora_fin);
            $sql->bindValue(6, $dia_de_la_semana);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Update Registro*/
        public function update_horario($ID_horario,$ID_aula,$ID_materia,$ID_grupo,$hora_inicio,$hora_fin,$dia_de_la_semana){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="UPDATE asignacion_horarios set
                ID_aula = ?, 
                ID_materia= ?,
                ID_grupo= ?, 
                hora_inicio= ?,
                hora_fin= ?,
                dia_de_la_semana = ?
                WHERE
                ID_horario = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_aula);
            $sql->bindValue(2, $ID_materia);
            $sql->bindValue(3, $ID_grupo);
            $sql->bindValue(4, $hora_inicio);
            $sql->bindValue(5, $hora_fin);
            $sql->bindValue(6, $dia_de_la_semana);
            $sql->bindValue(7,$ID_horario);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Delete Registro*/
        public function delete_horario($ID_horario){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="DELETE FROM asignacion_horarios
                WHERE 
                ID_horario = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_horario);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        /* TODO:Registro x id */
        public function get_horario_x_id($ID_horario){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM asignacion_horarios WHERE ID_horario = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $ID_horario);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

    }
?>