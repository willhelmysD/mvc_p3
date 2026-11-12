<?php

require_once "Model/ProgramaModel.php";

class ProgramaController{

    private $model_programa;

    public function __construct(){
        $this->model_programa = new ProgramaModel();
    }

    public function inicio(){
        $listado_programas = $this->model_programa->ListarProgramas();
        require_once "View/Programa/index.php";
    }

    public function detalle($id){
        $id_programa = $id;
        $detalle = $this->model_programa->buscarPrograma($id_programa);
        require_once "View/Programa/detalleView.php";
    }

    public function nuevo(){
        require_once "View/Programa/nuevoView.php";
    }

    public function eliminar($id){
        $id_programa = $id;
        $detalle = $this->model_programa->buscarPrograma($id_programa);        
        require_once "View/Programa/eliminarView.php";
    }

    public function editar(){
        $id = trim($_POST['id'] ?? '');
        $nom = trim($_POST['nombre'] ?? '');
        $est = trim($_POST['estado'] ?? '');
        if($id === '' || $nom === '' || $est === ''){
            $result = "Todos los campos son requeridos";
            require_once "View/Programa/errorView.php";
        }else{
            $prog = new Programa($id, $nom, $est);
            $editar = $this->model_programa->EditarPrograma($prog);
            if($editar){
                $result = "Proceso exitoso";
            }else{
                $result = "Nada que editar";
            }
            require_once "View/Programa/resultView.php";
        }
    }

    public function cambiarEstado(){
        $id = trim($_POST['id'] ?? '');
        if($id === ''){
            $result = "Todos los campos son requeridos";
            require_once "View/Programa/errorView.php";
        }else{
            $eliminar = $this->model_programa->EliminarPrograma($id);
            if($eliminar){
                $result = "Proceso exitoso (Estado cambiado a 0)";
            }else{
                $result = "Nada que eliminar";
            }
            require_once "View/Programa/resultView.php";
        }
    }

    public function guardar(){
        $nom = trim($_POST['nombre'] ?? '');
        $est = trim($_POST['estado'] ?? '1');

        if($nom === '' || $est === ''){
            $result = "Todos los campos son requeridos";
            require_once "View/Programa/errorView.php";
        }else{
            $prog = new Programa(null, $nom, $est);
            $guardar = $this->model_programa->GuardarPrograma($prog);
            if($guardar){
                $result = "Proceso exitoso";
            }else{
                $result = "Error al almacenar";
            }
            require_once "View/Programa/resultView.php";
        }        
    }

}
