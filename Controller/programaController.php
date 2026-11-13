<?php

require_once "Model/ProgramaModel.php";

class ProgramaController
{
    private $model_programa;

    public function __construct()
    {
        $this->model_programa = new ProgramaModel();
    }

    public function inicio()
    {
        $listado_programas = $this->model_programa->ListarProgramas();
        require_once "View/Programa/index.php";
    }

    public function nuevo()
    {
        require_once "View/Programa/nuevoView.php";
    }

    public function guardar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE . "/programa");
            exit;
        }

        $nombre = trim($_POST['nombre'] ?? '');

        if ($nombre === '') {
            $result = "El nombre del programa es obligatorio.";
            require_once "View/Programa/errorView.php";
            return;
        }

        if (mb_strlen($nombre) > 45) {
            $result = "El nombre no puede superar los 45 caracteres.";
            require_once "View/Programa/errorView.php";
            return;
        }

        $programa = new Programa(null, $nombre);
        $guardar = $this->model_programa->GuardarPrograma($programa);

        if ($guardar) {
            $result = "Programa registrado exitosamente.";
            require_once "View/Programa/resultView.php";
        } else {
            $result = "Error al guardar el programa.";
            require_once "View/Programa/errorView.php";
        }
    }

    public function detalle($id = null)
    {
        if ($id === null || !ctype_digit((string)$id)) {
            $result = "Identificador de programa no válido.";
            require_once "View/Programa/errorView.php";
            return;
        }

        $detalle = $this->model_programa->buscarPrograma((int)$id);

        if (!$detalle) {
            $result = "El programa solicitado no existe.";
            require_once "View/Programa/errorView.php";
            return;
        }

        require_once "View/Programa/detalleView.php";
    }

    public function editar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE . "/programa");
            exit;
        }

        $id = trim($_POST['id'] ?? '');
        $nombre = trim($_POST['nombre'] ?? '');

        if ($id === '' || !ctype_digit($id) || $nombre === '') {
            $result = "Todos los campos son requeridos y deben ser válidos.";
            require_once "View/Programa/errorView.php";
            return;
        }

        if (mb_strlen($nombre) > 45) {
            $result = "El nombre no puede superar los 45 caracteres.";
            require_once "View/Programa/errorView.php";
            return;
        }

        $programa = new Programa((int)$id, $nombre);
        $editar = $this->model_programa->EditarPrograma($programa);

        if ($editar) {
            $result = "Programa actualizado exitosamente.";
        } else {
            $result = "No se realizaron cambios en el registro.";
        }
        require_once "View/Programa/resultView.php";
    }

    public function eliminar($id = null)
    {
        if ($id === null || !ctype_digit((string)$id)) {
            $result = "Identificador de programa no válido.";
            require_once "View/Programa/errorView.php";
            return;
        }

        $detalle = $this->model_programa->buscarPrograma((int)$id);

        if (!$detalle) {
            $result = "El programa solicitado no existe.";
            require_once "View/Programa/errorView.php";
            return;
        }

        require_once "View/Programa/eliminarView.php";
    }

    public function borrar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . BASE . "/programa");
            exit;
        }

        $id = trim($_POST['id'] ?? '');

        if ($id === '' || !ctype_digit($id)) {
            $result = "Identificador no válido para eliminar.";
            require_once "View/Programa/errorView.php";
            return;
        }

        $eliminado = $this->model_programa->EliminarPrograma((int)$id);

        if ($eliminado) {
            $result = "Programa eliminado exitosamente.";
            require_once "View/Programa/resultView.php";
        } else {
            $result = "No se pudo eliminar el programa (puede tener estudiantes asociados o no existir).";
            require_once "View/Programa/errorView.php";
        }
    }
}