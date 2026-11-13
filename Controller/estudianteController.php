<?php

require_once "Model/EstudianteModel.php";

class EstudianteController
{
    private $model_estudiante;

    public function __construct()
    {
        $this->model_estudiante = new EstudianteModel();
    }

    public function inicio()
    {
        $listado_estudiantes = $this->model_estudiante->ListarEstudiantes();
        require_once "View/Estudiante/index.php";
    }

    public function detalle($id)
    {
        $detalle = $this->model_estudiante->buscarEstudiante($id);
        $programas = $this->model_estudiante->ListarProgramas();
        require_once "View/Estudiante/detalleView.php";
    }

    public function nuevo()
    {
        $programas = $this->model_estudiante->ListarProgramas();
        require_once "View/Estudiante/nuevoView.php";
    }

    public function eliminar($id)
    {
        $detalle = $this->model_estudiante->buscarEstudiante($id);
        require_once "View/Estudiante/eliminarView.php";
    }

    public function guardar()
    {
        $nom = trim($_POST['nombres'] ?? '');
        $ape = trim($_POST['apellidos'] ?? '');
        $edad = trim($_POST['edad'] ?? '');
        $prog = trim($_POST['programaFK'] ?? '');

        if (empty($nom) || empty($ape) || empty($edad) || empty($prog)) {
            $result = "Todos los campos son requeridos";
            require_once "View/Estudiante/errorView.php";
        } else {
            $est = new Estudiante(null, $nom, $ape, (int)$edad, (int)$prog);
            $guardar = $this->model_estudiante->GuardarEstudiante($est);
            if ($guardar) {
                $result = "Proceso exitoso";
            } else {
                $result = "Error al almacenar";
            }
            require_once "View/Estudiante/resultView.php";
        }
    }

    public function editar()
    {
        $id = trim($_POST['id'] ?? '');
        $nom = trim($_POST['nombres'] ?? '');
        $ape = trim($_POST['apellidos'] ?? '');
        $edad = trim($_POST['edad'] ?? '');
        $prog = trim($_POST['programaFK'] ?? '');

        if (empty($id) || empty($nom) || empty($ape) || empty($edad) || empty($prog)) {
            $result = "Todos los campos son requeridos";
            require_once "View/Estudiante/errorView.php";
        } else {
            $est = new Estudiante((int)$id, $nom, $ape, (int)$edad, (int)$prog);
            $editar = $this->model_estudiante->EditarEstudiante($est);
            if ($editar) {
                $result = "Proceso exitoso";
            } else {
                $result = "Nada que editar";
            }
            require_once "View/Estudiante/resultView.php";
        }
    }

    public function borrar()
    {
        $id = trim($_POST['id'] ?? '');

        if (empty($id)) {
            $result = "El ID del estudiante es requerido";
            require_once "View/Estudiante/errorView.php";
        } else {
            $eliminar = $this->model_estudiante->EliminarEstudiante((int)$id);
            if ($eliminar) {
                $result = "Estudiante eliminado correctamente";
            } else {
                $result = "No se pudo eliminar el estudiante";
            }
            require_once "View/Estudiante/resultView.php";
        }
    }
}