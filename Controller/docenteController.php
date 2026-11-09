<?php

require_once "Model/DocenteModel.php";

class DocenteController{

    private $model_docente;

    public function __construct(){
        $this->model_docente = new DocenteModel();
    }

    public function inicio(){
        $listado_docentes = $this->model_docente->ListarDocentes();
        require_once "View/Docente/index.php";
    }

    public function detalle($id){
        $id_docente = $id;
        $detalle = $this->model_docente->buscarDocente($id_docente);
        require_once "View/Docente/detalleView.php";
        

    }

    public function nuevo(){
        require_once "View/Docente/nuevoView.php";
    }

    public function eliminar($id){
        $id_docente = $id;
        $detalle = $this->model_docente->buscarDocente($id_docente);        
        require_once "View/Docente/eliminarView.php";
    }

    public function editar(){
        $id = trim($_POST['id'] ?? '');
        $nom = trim($_POST['nombre'] ?? '');
        $ape = trim($_POST['apellido'] ?? '');
        $est = trim($_POST['estado'] ?? '');
        if(empty($id) || empty($nom) || empty($ape) || empty($est)){
            $result = "Todos los campos son requeridos";
            require_once "View/Docente/errorView.php";
        }else{
            $doc = new Docente($id,$nom,$ape,$est);
            $editar = $this->model_docente->EditarDocente($doc);
            if($editar){
                $result = "Proceso exitoso";
            }else{
                $result = "Nada que editar";
            }
            require_once "View/Docente/resultView.php";
        }
    }

    public function guardar(){
        $nom = trim($_POST['nombre'] ?? '');
        $ape = trim($_POST['apellido'] ?? '');
        $est = trim($_POST['estado'] ?? '');

        if(empty($nom) || empty($ape) || empty($est)){
            $result = "Todos los campos son requeridos";
            require_once "View/Docente/errorView.php";
        }else{
            $doc = new Docente(null,$nom,$ape,$est);
            $guardar = $this->model_docente->GuardarDocente($doc);
            if($guardar){
                $result = "Proceso exitoso";
            }else{
                $result = "Error al almacenar";
            }
            require_once "View/Docente/resultView.php";
        }        
    }

}

