<?php

require_once "Model/CursoModel.php";

class CursoController
{
    private $model_curso;

    public function __construct()
    {
        $this->model_curso = new CursoModel();
    }

    public function inicio()
    {
        $listado_cursos = $this->model_curso->ListarCursos();
        require_once "View/Curso/index.php";
    }

    public function nuevo()
    {
        require_once "View/Curso/nuevoView.php";
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE . "/curso");
            exit;
        }

        $nombre = trim($_POST['nombre'] ?? '');

        if ($nombre === '') {
            $result = "El nombre del curso es obligatorio.";
            require_once "View/Curso/errorView.php";
            return;
        }

        if (mb_strlen($nombre) > 45) {
            $result = "El nombre no puede superar los 45 caracteres.";
            require_once "View/Curso/errorView.php";
            return;
        }

        $curso = new Curso(null, $nombre);
        $guardar = $this->model_curso->GuardarCurso($curso);

        if ($guardar) {
            $result = "Curso registrado exitosamente.";
            require_once "View/Curso/resultView.php";
        } else {
            $result = "Error al guardar el curso.";
            require_once "View/Curso/errorView.php";
        }
    }

    public function detalle($id = null)
    {
        if ($id === null || !ctype_digit((string)$id)) {
            $result = "Identificador de curso no válido.";
            require_once "View/Curso/errorView.php";
            return;
        }

        $detalle = $this->model_curso->buscarCurso((int)$id);

        if (!$detalle) {
            $result = "El curso solicitado no existe.";
            require_once "View/Curso/errorView.php";
            return;
        }

        require_once "View/Curso/detalleView.php";
    }

    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE . "/curso");
            exit;
        }

        $id = trim($_POST['id'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');

        if ($id === '' || !ctype_digit($id) || $nombre === '') {
            $result = "Todos los campos son requeridos y deben ser válidos.";
            require_once "View/Curso/errorView.php";
            return;
        }

        if (mb_strlen($nombre) > 45) {
            $result = "El nombre no puede superar los 45 caracteres.";
            require_once "View/Curso/errorView.php";
            return;
        }

        $curso = new Curso((int)$id, $nombre);
        $editar = $this->model_curso->EditarCurso($curso);

        if ($editar) {
            $result = "Curso actualizado exitosamente.";
        } else {
            $result = "No se realizaron cambios en el registro.";
        }
        require_once "View/Curso/resultView.php";
    }

    public function eliminar($id = null)
    {
        if ($id === null || !ctype_digit((string)$id)) {
            $result = "Identificador de curso no válido.";
            require_once "View/Curso/errorView.php";
            return;
        }

        $detalle = $this->model_curso->buscarCurso((int)$id);

        if (!$detalle) {
            $result = "El curso solicitado no existe.";
            require_once "View/Curso/errorView.php";
            return;
        }

        require_once "View/Curso/eliminarView.php";
    }

    public function borrar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE . "/curso");
            exit;
        }

        $id = trim($_POST['id'] ?? '');

        if ($id === '' || !ctype_digit($id)) {
            $result = "Identificador no válido para eliminar.";
            require_once "View/Curso/errorView.php";
            return;
        }

        $eliminado = $this->model_curso->EliminarCurso((int)$id);

        if ($eliminado) {
            $result = "Curso eliminado exitosamente.";
            require_once "View/Curso/resultView.php";
        } else {
            $result = "No se pudo eliminar el curso (puede tener matrículas asociadas o no existir).";
            require_once "View/Curso/errorView.php";
        }
    }
}