<?php

require 'flight/Flight.php';
require 'models/Aula.php';
require 'models/Evento.php';
require 'models/Grupo.php';
require 'models/Horarios.php';
require 'models/Inscrip_Evento.php';
require 'models/Materia.php';

Flight::register('db','PDO',array('mysql:host=localhost;dbname=administracion_horarios','root',''));

// Definir las credenciales de autenticación
$usuario = 'admin';
$contrasena = 'admin123';

// Middleware de autenticación
Flight::route('*', function(){
    // Obtener los encabezados de la solicitud HTTP
    $headers = getallheaders();

    // Verificar si se proporcionaron las credenciales de autenticación
    if (isset($headers['Authorization'])) {
        $authHeader = $headers['Authorization'];
        // El encabezado Authorization debe tener el formato "Basic base64(username:password)"
        $authHeaderData = explode(' ', $authHeader);
        $authHeaderEncoded = $authHeaderData[1];
        $authHeaderDecoded = base64_decode($authHeaderEncoded);
        $authHeaderDecodedData = explode(':', $authHeaderDecoded);
        $usuario = $authHeaderDecodedData[0];
        $contrasena = $authHeaderDecodedData[1];

        // Verificar las credenciales
        if (verificarCredenciales($usuario, $contrasena)) {
            return true;
        }
    }

    // Si las credenciales no son válidas, se envía un código de respuesta 401 (No autorizado)
    Flight::response()->status(401);
    Flight::json(['mensaje' => 'Autenticación fallida']);
    return false;
});

// Verificar las credenciales de autenticación
function verificarCredenciales($usuario, $contrasena) {
    // Comprueba las credenciales almacenadas en algún sistema de almacenamiento seguro (base de datos, servicio de autenticación, etc.)
    // En este ejemplo, simplemente comparamos las credenciales con valores estáticos
    return ($usuario === 'admin' && $contrasena === 'admin123');
}

// Obtener todos los registros de aulas
Flight::route('GET /aulas', function () {
    $aula = new Aula();
    $datos = $aula->get_aula();
    Flight::json($datos);
});

// Obtener el total de aulas
Flight::route('GET /aulas/total', function () {
    $aula = new Aula();
    $total = $aula->get_total_aulas();
    Flight::json($total);
});

// Insertar un registro de aula
Flight::route('POST /aulas', function () {
    $bloque = Flight::request()->data->bloque;
    $numero = Flight::request()->data->numero;
    $descripcion = Flight::request()->data->descripcion;

    $aula = new Aula();
    $resultado = $aula->insert_aula($bloque, $numero, $descripcion);
    Flight::jsonp(["mensaje" => "Registro de aula insertado"]);
});

// Actualizar un registro de aula
Flight::route('PUT /aulas/@id', function ($id) {
    $bloque = Flight::request()->data->bloque;
    $numero = Flight::request()->data->numero;
    $descripcion = Flight::request()->data->descripcion;

    $aula = new Aula();
    $resultado = $aula->update_aula($id, $bloque, $numero, $descripcion);
    Flight::jsonp(["mensaje" => "Registro de aula actualizado"]);
});

// Eliminar un registro de aula
Flight::route('DELETE /aulas/@id', function ($id) {
    $aula = new Aula();
    $resultado = $aula->delete_aula($id);
    Flight::jsonp(["mensaje" => "Registro de aula eliminado"]);
});

// Obtener un registro de aula por ID
Flight::route('GET /aulas/@id', function ($id) {
    $aula = new Aula();
    $datos = $aula->get_aula_x_id($id);
    Flight::json($datos);
});

// Obtener todos los registros de eventos
Flight::route('GET /eventos', function () {
    $evento = new Evento();
    $datos = $evento->get_evento();
    Flight::json($datos);
});

// Insertar un registro de evento
Flight::route('POST /eventos', function () {
    $codigo = Flight::request()->data->codigo;
    $fecha = Flight::request()->data->fecha;
    $duracion = Flight::request()->data->duracion;
    $objetivo = Flight::request()->data->objetivo;

    $evento = new Evento();
    $resultado = $evento->insert_evento($codigo, $fecha, $duracion, $objetivo);
    Flight::jsonp(["mensaje" => "Registro de evento insertado"]);
});

// Actualizar un registro de evento
Flight::route('PUT /eventos/@id', function ($id) {
    $codigo = Flight::request()->data->codigo;
    $fecha = Flight::request()->data->fecha;
    $duracion = Flight::request()->data->duracion;
    $objetivo = Flight::request()->data->objetivo;

    $evento = new Evento();
    $resultado = $evento->update_evento($id, $codigo, $fecha, $duracion, $objetivo);
    Flight::jsonp(["mensaje" => "Registro de evento actualizado"]);
});

// Eliminar un registro de evento
Flight::route('DELETE /eventos/@id', function ($id) {
    $evento = new Evento();
    $resultado = $evento->delete_evento($id);
    Flight::jsonp(["mensaje" => "Registro de evento eliminado"]);
});

// Obtener un registro de evento por ID
Flight::route('GET /eventos/@id', function ($id) {
    $evento = new Evento();
    $datos = $evento->get_evento_x_id($id);
    Flight::json($datos);
});

// Obtener todos los registros de grupos
Flight::route('GET /grupos', function () {
    $grupo = new Grupo();
    $datos = $grupo->get_grupo();
    Flight::json($datos);
});

// Insertar un registro de grupo
Flight::route('POST /grupos', function () {
    $codigo = Flight::request()->data->codigo;
    $numero_de_grupo = Flight::request()->data->numero_de_grupo;
    $cantidad_de_estudiantes = Flight::request()->data->cantidad_de_estudiantes;

    $grupo = new Grupo();
    $resultado = $grupo->insert_grupo($codigo, $numero_de_grupo, $cantidad_de_estudiantes);
    Flight::jsonp(["mensaje" => "Registro de grupo insertado"]);
});

// Actualizar un registro de grupo
Flight::route('PUT /grupos/@id', function ($id) {
    $codigo = Flight::request()->data->codigo;
    $numero_de_grupo = Flight::request()->data->numero_de_grupo;
    $cantidad_de_estudiantes = Flight::request()->data->cantidad_de_estudiantes;

    $grupo = new Grupo();
    $resultado = $grupo->update_grupo($id, $codigo, $numero_de_grupo, $cantidad_de_estudiantes);
    Flight::jsonp(["mensaje" => "Registro de grupo actualizado"]);
});

// Eliminar un registro de grupo
Flight::route('DELETE /grupos/@id', function ($id) {
    $grupo = new Grupo();
    $resultado = $grupo->delete_grupo($id);
    Flight::jsonp(["mensaje" => "Registro de grupo eliminado"]);
});

// Obtener un registro de grupo por ID
Flight::route('GET /grupos/@id', function ($id) {
    $grupo = new Grupo();
    $datos = $grupo->get_grupo_x_id($id);
    Flight::json($datos);
});

// Obtener todos los registros de horarios
Flight::route('GET /horarios', function () {
    $horarios = new Horarios();
    $datos = $horarios->get_horario();
    Flight::json($datos);
});

// Insertar un registro de horario
Flight::route('POST /horarios', function () {
    $ID_aula = Flight::request()->data->ID_aula;
    $ID_materia = Flight::request()->data->ID_materia;
    $ID_grupo = Flight::request()->data->ID_grupo;
    $hora_inicio = Flight::request()->data->hora_inicio;
    $hora_fin = Flight::request()->data->hora_fin;
    $dia_de_la_semana = Flight::request()->data->dia_de_la_semana;

    $horarios = new Horarios();
    $resultado = $horarios->insert_horario($ID_aula, $ID_materia, $ID_grupo, $hora_inicio, $hora_fin, $dia_de_la_semana);
    Flight::jsonp(["mensaje" => "Registro de horario insertado"]);
});

// Actualizar un registro de horario
Flight::route('PUT /horarios/@id', function ($id) {
    $ID_aula = Flight::request()->data->ID_aula;
    $ID_materia = Flight::request()->data->ID_materia;
    $ID_grupo = Flight::request()->data->ID_grupo;
    $hora_inicio = Flight::request()->data->hora_inicio;
    $hora_fin = Flight::request()->data->hora_fin;
    $dia_de_la_semana = Flight::request()->data->dia_de_la_semana;

    $horarios = new Horarios();
    $resultado = $horarios->update_horario($id, $ID_aula, $ID_materia, $ID_grupo, $hora_inicio, $hora_fin, $dia_de_la_semana);
    Flight::jsonp(["mensaje" => "Registro de horario actualizado"]);
});

// Eliminar un registro de horario
Flight::route('DELETE /horarios/@id', function ($id) {
    $horarios = new Horarios();
    $resultado = $horarios->delete_horario($id);
    Flight::jsonp(["mensaje" => "Registro de horario eliminado"]);
});

// Obtener un registro de horario por ID
Flight::route('GET /horarios/@id', function ($id) {
    $horarios = new Horarios();
    $datos = $horarios->get_horario_x_id($id);
    Flight::json($datos);
});

// Obtener todos los registros de inscripciones a eventos
Flight::route('GET /inscripciones', function () {
    $inscripciones = new Inscrip_Evento();
    $datos = $inscripciones->get_inscrip_evento();
    Flight::json($datos);
});

// Insertar un registro de inscripción a evento
Flight::route('POST /inscripciones', function () {
    $evento_id = Flight::request()->data->evento_id;
    $grupo_id = Flight::request()->data->grupo_id;

    $inscripciones = new Inscrip_Evento();
    $resultado = $inscripciones->insert_inscrip_evento($evento_id, $grupo_id);
    Flight::jsonp(["mensaje" => "Registro de inscripción a evento insertado"]);
});

// Actualizar un registro de inscripción a evento
Flight::route('PUT /inscripciones/@id', function ($id) {
    $evento_id = Flight::request()->data->evento_id;
    $grupo_id = Flight::request()->data->grupo_id;

    $inscripciones = new Inscrip_Evento();
    $resultado = $inscripciones->update_inscrip_evento($id, $evento_id, $grupo_id);
    Flight::jsonp(["mensaje" => "Registro de inscripción a evento actualizado"]);
});

// Eliminar un registro de inscripción a evento
Flight::route('DELETE /inscripciones/@id', function ($id) {
    $inscripciones = new Inscrip_Evento();
    $resultado = $inscripciones->delete_inscrip_evento($id);
    Flight::jsonp(["mensaje" => "Registro de inscripción a evento eliminado"]);
});

// Obtener un registro de inscripción a evento por ID
Flight::route('GET /inscripciones/@id', function ($id) {
    $inscripciones = new Inscrip_Evento();
    $datos = $inscripciones->get_inscrip_evento_x_id($id);
    Flight::json($datos);
});


// Obtener todos los registros de materias
Flight::route('GET /materias', function () {
    $materias = new Materia();
    $datos = $materias->get_materia();
    Flight::json($datos);
});

// Insertar un registro de materia
Flight::route('POST /materias', function () {
    $id_grupo = Flight::request()->data->id_grupo;
    $nombre = Flight::request()->data->nombre;
    $docente_id = Flight::request()->data->docente_id;
    $aula_id = Flight::request()->data->aula_id;

    $materias = new Materia();
    $resultado = $materias->insert_materia($id_grupo, $nombre, $docente_id, $aula_id);
    Flight::jsonp(["mensaje" => "Registro de materia insertado"]);
});

// Actualizar un registro de materia
Flight::route('PUT /materias/@id', function ($id) {
    $id_grupo = Flight::request()->data->id_grupo;
    $nombre = Flight::request()->data->nombre;
    $docente_id = Flight::request()->data->docente_id;
    $aula_id = Flight::request()->data->aula_id;

    $materias = new Materia();
    $resultado = $materias->update_materia($id, $id_grupo, $nombre, $docente_id, $aula_id);
    Flight::jsonp(["mensaje" => "Registro de materia actualizado"]);
});

// Eliminar un registro de materia
Flight::route('DELETE /materias/@id', function ($id) {
    $materias = new Materia();
    $resultado = $materias->delete_materia($id);
    Flight::jsonp(["mensaje" => "Registro de materia eliminado"]);
});

// Obtener un registro de materia por ID
Flight::route('GET /materias/@id', function ($id) {
    $materias = new Materia();
    $datos = $materias->get_materia_x_id($id);
    Flight::json($datos);
});

// Obtener el total de materias
Flight::route('GET /materias/total', function () {
    $materias = new Materia();
    $datos = $materias->get_total_materias();
    Flight::json($datos);
});

Flight::start();
